<?php
 /** Модуль управления контентом, общий
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */  
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-----------------------------------------------------------------
 class cs_Exception extends Exception { }
 //-----------------------------------------------------------------
 /** общий шаблон класса доступа элементов */
 class w_defext {
  private $f_priffix = '';	
  
  function __construct() {
   if (2 == (@ini_get('mbstring.func_overload') & 2)) {
	$this->f_priffix = 'mb_orig_';
   } elseif (@function_exists('mb_strlen')) {
    $this->f_priffix = 'mb_';	
   } else { 
   	$this->f_priffix = ''; 
   } 	
  }//__construct
  
  protected function utf8_substr_replace($str, $repl, $start , $length=NULL) {
   @preg_match_all('/./us', $str, $ar);
   @preg_match_all('/./us', $repl, $rar);
   if($length === NULL ) { $length = $this->strlen($str); }
   @array_splice($ar[0], $start, $length, $rar[0]);
   return @join('', $ar[0]);
  }//utf8_substr_replace	
  
  function __call($name, $arguments) {	  	
   switch ($name) {  		
	case 'strlen':	       	
	case 'strpos':
	case 'stripos':       
	case 'strrpos':      
	case 'substr':
	case 'strstr':       
	case 'strtolower':   
	case 'strtoupper':   
	case 'substr_count': 
    
      if (!@function_exists($this->f_priffix.$name)) throw new cs_Exception("Function '".
       $this->f_priffix.$name."' not found!");
      
      return @call_user_func_array($this->f_priffix.$name, $arguments);    
    
	case 'substr_replace': return @call_user_func_array(array($this, 'utf8_substr_replace'), $arguments); 	
	default: throw new cs_Exception("Unknown '$name' Metchod");	 
   }
   return $this->$name;	
  }//__call
  
  function GetThisDate() { return date("Y-m-d"); }
  function GetThisDateEX($f) { return date($f); }   
  function GetThisTime() { return date("H:i:s"); }  
  function GetThisDateTime() { return date("Y-m-d H:i:s"); }
  
  /** текущий ip */
  function GetCurrentIP() {
   $ip = (getenv('HTTP_X_FORWARDED_FOR')) ? getenv('HTTP_X_FORWARDED_FOR') : getenv('REMOTE_ADDR');  
   $pos = @$this->strpos($ip, ","); 
   if ($pos > 0) { $ip = trim($this->substr($ip, 0, $pos)); } 
   return /*(!@preg_match("/(d+).(d+).(d+).(d+)/", $ip)) ? "0.0.0.0" : */$ip;
  }//GetCurrentIP
  
  function HTMLspecialChars($source, $charset='') { 
   return htmlspecialchars($source, ENT_QUOTES,($charset == '') ? 'UTF-8' : $charset); 
  }//HTMLspecialChars
  
  function HTMLspecialCharsDecode($source) {	 
   return htmlspecialchars_decode($source, ENT_QUOTES); 
  }//HTMLspecialCharsDecode
  
  /** удаление переносов строк в тексте */
  function ClearBreake($source,$r = true, $n = true, $r_to='', $n_to='') {
   if ($r) { $source = @preg_replace("/\r/", $r_to, $source); }
   if ($n) { $source = @preg_replace("/\n/", $n_to, $source); }
   return $source;	
  }//ClearBreake
  
  /** fetch для строки
  * @return string
  */  
  function StrFetch(&$S, $delim) {
   $I = @$this->strpos($S, $delim);
   $R = ($I === false) ? $S : @$this->substr($S, 0, $I);
   $S = ($I === false) ? '' : @$this->substr($S, $I + @$this->strlen($delim));
   return $R;	
  }//StrFetch
  
  /** проверка на не нулевое значение пост запроса */
  function CheckPostValue($Lparam) { return (@isset($_POST[$Lparam]) && $_POST[$Lparam]); }//CheckPostValue  
  
  /** корректировка однолинейной строки */
  function CorrectSymplyString($str) { return $this->HTMLspecialChars($this->ClearBreake($str)); }
  //function CorrectSimplyString($str) { return $this->CorrectSymplyString($str); }
    
  /** идентификатор сессии сайта */
  function GetSessionIdentify($name = '') {
   return md5(W_DOMAINIDENTIFIER.W_COOKIESDOMAIN.$this->strtolower($name));	
  }//GetSessionIdentify
  
  /** Устанвока куков для сайта
  * @name - (string) идентификатор куки
  * @value - (string) значение
  * @exptime - (int) если установлено - время хранения
  * 
  * @return bool    
  */   
  function SetCookies($name, $value = '', $exptime=-1) {
   return @setcookie($this->GetSessionIdentify($name), $value, 
   (($exptime == -1) ? W_COOKIESTIME : $exptime), W_COOKIESPATH, W_COOKIESDOMAIN);	
  }//SetCookies
  
  /** генерация пароля */
  function generate_password($number) {
  $arr = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S',
               'T','U','V','X','Y','Z','1','2','3','4','5','6','7','8','9','0');
   $pass = "";
   for($i = 0; $i < $number; $i++)      {
     $index = rand(0, count($arr) - 1);
     $pass .= $arr[$index];
   }
   return $pass;
  } //generate_password
     
  /** соответствие шаблону
  * @return bool  
  */
  function ChTable($s, $ext) { return @preg_match("/[$ext]/", $s); }
  
  /** проверка e-mail адреса */
  function validmail($ml){
   return (@preg_match("/^[a-z0-9]+([-_\.]?[a-z0-9])+@[a-z0-9]+([-_\.]?[a-z0-9])+\.[a-z]{2,4}/i", $ml)) ? true : false;
  }//validmail
  
  /** обработка строки для обработки в javascript eval
  * в качестве оконтовки - одинарная кавычка (')
  */
  function ToJavaScriptEval($str, $toeval=true, $quotechar="'", $tocombine=true, $withbreaks=false) {  	
   $str = $this->ClearBreake($str, true, false);   
   $str = @str_replace($quotechar, "\\".$quotechar, $str);   
   $arr = @explode("\n", $str);
   $result = '';
   foreach ($arr as &$line) {
	if ($line = trim($line)) {
	 $result .= (($tocombine) ? ($quotechar."$line".$quotechar.'+') : $line).(($withbreaks) ? "\r\n" : '');	
	}	
   }
   $result = ($result && $tocombine) ? $this->substr($result, 0, -1) : $result;
   return ($result && $toeval) ? "eval($result)" : $result;  	
  }//ToJavaScriptEval  
  
  function StripHTML($source) { 
   while ($source != @strip_tags($source)) { $source = @strip_tags($source); }
   return $source;    
  }//StripHTML
    	  	
 }//w_defext
 //-----------------------------------------------------------------
 /** объект управления базой */
 class sc_DB extends w_defext {
  var $bdLink = null;
  var $control = null;
  
  function __construct($control, $host, $user, $password, $basename, $charset = 'utf8') {
   parent::__construct();
   $this->control = $control;		  	  	
   $this->bdLink = @mysql_connect($host, $user, $password);
   if (!$this->bdLink) { 
    //throw new cs_Exception("Can`t connect to database! [".@mysql_error($this->bdLink).']'); 
    exit("Can`t connect to database! [".@mysql_error($this->bdLink).']');
   }
   @mysql_query("SET NAMES $charset", $this->bdLink);
   @mysql_query("set character_set_client='$charset'", $this->bdLink);
   @mysql_query("set character_set_results='$charset'", $this->bdLink);
   @mysql_query("set collation_connection='{$charset}_bin'", $this->bdLink);	 
   @mysql_select_db($basename, $this->bdLink);	
   if (!$this->bdLink) {
    //throw new cs_Exception("Can`t connect to database!");
    exit("Can`t connect to database!");	
   }
   return true;	
  }//__construct
  
  //query to db
  function mPost($query) {	    	
   $result = @mysql_query($query, $this->bdLink);
   //if (!$result) {
    //throw new cs_Exception("mysql error ".$this->GetError());	 
   //}		
   return $result;   	
  }//mPost
  
  function GetLineArray($tResult) { return @mysql_fetch_array($tResult, MYSQL_ASSOC); }
   	
  function InseredIndex() { return @mysql_insert_id($this->bdLink); }
  
  function GetTable($tableName, $where_id='', $limit_id='') {
   $query = "SELECT * FROM $tableName";
   if ($where_id) { $query .= " where $where_id"; }
   if ($limit_id) { $query .= " limit $limit_id"; }   	
   return $this->mPost($query);   
  }//GetTable 
  
  function Delete($tName, $where_id='', $limit_id='') {	
   $query = "DELETE FROM $tName";
   if ($where_id) { $query .= " where $where_id"; }
   if ($limit_id) { $query .= " limit $limit_id"; }   	
   return $this->mPost($query);	
  }//Delete
  
  function GetResult($tResult,$R,$C) { return @mysql_result($tResult,$R,$C); }
  function GetRowCountBd($tResult) { return @mysql_num_rows($tResult); }
  function GetColumnCountBd($tResult) { return @mysql_num_fields($tResult); } 
  function EscapeString($string) { return @mysql_real_escape_string($string, $this->bdLink); } 
  function GetError() { return @mysql_error($this->bdLink);	}
  
  /** получение постраничной выборки от элемента запроса
  * @selectidentifier  - string параметр выборки, например select * from t1 where order 
  * @activapage - int текущая активная страница
  * @perpagecount - int количество записей на страницу
  * @countallrecords - int всего записей в таблице, если false - определит сам (не желательно - выборка будет полной)
  * 
  * @path - путь до идентификатора страницы
  * @path1 - пусть после идентификатора страницы
  * @page_label_class - имя класса идентификатора активной страницы
  * @no_page_label_class  - имя класса всех остальных страниц
  * @page_priffex - приффикс если используется чпу
  * @pagesslash  - string разделитель элементов, если используется чпу     
  */
  function GetDataByPages($selectidentifier, $activapage=false, $perpagecount=10,
  $countallrecords=false, $path='', $path1='', $page_priffex='page', $pagesslash='/', $page_label_class='pageSelected',
  $no_page_label_class='pageNoSelected') {
   $result = array(
    'pagestext'    => '',
    'source'       => array(),
    'recordscount' => $countallrecords
   );
   $page = (!$activapage || !@is_numeric($activapage) || ($activapage <= 0)) ? 1 : $activapage;
   $perpagecount = (!$perpagecount || !@is_numeric($perpagecount)) ? 10 : $perpagecount;
   $countallrecords = ($countallrecords === false) ? $this->GetRowCountBd($this->mPost($selectidentifier)) : $countallrecords;
   if (!$countallrecords) { return $result; }
   //math  	
   $ShowcountPages = @ceil($countallrecords / $perpagecount);	
   if ($page > $ShowcountPages) { $page = $ShowcountPages; }	
   $data_page_int = @floor($page / 10);
   if ($data_page_int * 10 == $page) { $data_page_int = $data_page_int - 1; } 
   $data_start = $data_page_int * 10 + 1;
   $data_end   = $data_start + 10 - 1;		
   $ddst       = $data_start - 1;	
   if ($data_end > $ShowcountPages) {$data_end = $ShowcountPages;}
   //ссылки на страницы
   if ($pagesslash == '/') { if ($this->substr($path, -1, 1) != "/") { $path .= "/"; } }
   if ($data_page_int > 0) { 
    $result['pagestext'] = 
    "<label class='$no_page_label_class'>&nbsp;<a href=\"".$path.$page_priffex.$pagesslash."1".$pagesslash.
    "$path1\">1</a>&nbsp;</label>&nbsp;<label class='$no_page_label_class'>&nbsp;<a href=\"".
    $path.$page_priffex.$pagesslash."$ddst".$pagesslash.
    "$path1\">...</a>&nbsp;</label> ";
   }
   if ($ShowcountPages <= $data_start - 1) {
    $result['pagestext'] ="<label id='Ut' class='$page_label_class'><b>&nbsp;1&nbsp;</b></label>";
   } else {
    for ($I=$data_start; $I<=$data_end; $I++) { 	
     if ($I == $page) { 
	  $result['pagestext'] .= "<label id='Ut$I' class='$page_label_class'>&nbsp;<b>$I</b>&nbsp;</label> "; 
	 } else { 
	  $result['pagestext'] .= "<label class='$no_page_label_class'>&nbsp;<a href=\"".
	  $path.$page_priffex.$pagesslash."$I".$pagesslash."$path1\">$I</a>&nbsp;</label> ";	
	 }
    } //for
    if ($ShowcountPages > $data_end) {
     $ddfup = $data_end + 1;
     $result['pagestext'] .= "<label class='$no_page_label_class'>&nbsp;<a href=\"".$path.$page_priffex.$pagesslash.
	 "$ddfup".$pagesslash."$path1\">...</a>&nbsp;</label>&nbsp;<label class='$no_page_label_class'>&nbsp;<a href=\"".
	 $path.$page_priffex.$pagesslash."$ShowcountPages".$pagesslash."$path1\">$ShowcountPages</a>&nbsp;</label>";
    }
   }
   $fromline = $page * $perpagecount - $perpagecount;
   $selectidentifier .= " limit $fromline,$perpagecount";
   $res = $this->mPost($selectidentifier);
   if (!$res) { return $result; }
   while ($row = $this->GetLineArray($res)) {
    $result['source'][] = $row;   	
   }
   return $result;	
  }//GetDataByPages  
    	
  /** вставка элементов в таблицу
  * @tb_shortname - сокращенное имя таблици
  * @items - array(
  *  'имя_полня' => значение (значение обрамляется одинарными ковычками автоматически)
  * )
  * @doescapevalues - bool если true - строки автоматически экранируются mysql_real_escape_string    
  */
  function INSERTAction($tb_shortname, $items, $doescapevalues=false) {
   if (!$tb_shortname || !$items) { return false; }
   $query = "INSERT INTO ".$this->control->tables_list[$tb_shortname]." SET ";
   $incer = 0;
   foreach ($items as $name => $value) {
	$s = $name."='".((!$doescapevalues) ? $value : $this->EscapeString($value))."'";
	$query .= ($incer == 0) ? $s : ", $s";	
	$incer++;
   }
   return $this->mPost($query);   	
  }//INSERTAction
  
  /** обновление элементов таблицы
  * @tb_shortname - сокращенное имя таблици
  * @items - array(
  *  'имя_полня' => значение (значение обрамляется одинарными ковычками автоматически)
  * )
  * @doescapevalues - bool если true - строки автоматически экранируются mysql_real_escape_string    
  */
  function UPDATEAction($tb_shortname, $items, $where='', $limit='', $doescapevalues=false) {
   if (!$tb_shortname || !$items) { return false; }
   $query = "UPDATE ".$this->control->tables_list[$tb_shortname]." SET ";
   $incer = 0;
   foreach ($items as $name => $value) {
	$s = $name."='".((!$doescapevalues) ? $value : $this->EscapeString($value))."'";
	$query .= ($incer == 0) ? $s : ", $s";	
	$incer++;
   }
   if ($where) {
	if ($this->substr($where, 0, 1) != ' ') { $where = " $where"; }
	if ($this->strtolower($this->substr($where, 0, 7)) != ' where') { $where = " where $where"; }
	while ($this->strpos($where, "  ") !== false) { $where = @str_replace("  ", " ", $where); }
	$query .= $where;
   }
   if ($limit) { $query .= " limit $limit"; }
   return $this->mPost($query);   	
  }//UPDATEAction   	
    	
 }//sc_DB   
 //-----------------------------------------------------------------
 /** объект строковых данных */
 class w_string_obj extends w_defext {
  private $owner = null;
  private $globaluniq = false;
  
  function __construct($Aowner) {
   parent::__construct();
   $this->owner = $Aowner;	
  }//__construct
    
  function CheckLinkNoOur($link) {
   if (!$link) { return true; }	
   //проверка индексации
   $noindex_t = (@$this->substr($link, 0, 1) == '/') ? false : true;
   $hinfo = ($noindex_t) ? @parse_url($link) : false;
   //получаем хосты с и без www
   if ($hinfo) {
    $h = @$this->strtolower(W_HOSTMYSITE);
    $h_w = (@$this->substr($h, 0, 4) == 'www.') ? $h : 'www.'.$h;
    $h_n = (@$this->substr($h, 0, 4) == 'www.') ? @$this->substr($h, 4) : $h;	  
    $noindex_t = (@in_array(@$this->strtolower($hinfo['host']), array($h_w, $h_n))) ? false : true;
   }
   return $noindex_t;	 	
  }//CheckLinkOur
  
  protected function ParseStringTagsOne($tag, $source, $onlytext = false) {
   $count_close = 0;
   $tag = $this->strtoupper($tag);
   $param1 = '['.$tag.']';
   $param2 = '[/'.$tag.']';
   $res = "";
   $i = $this->stripos($source, $param1);
   if ($i === false) { return $source; }
   $temp_i = $i;  
   $i = $this->stripos($source, $param2, $i+$this->strlen($param1));
   if ($i === false) { return $source; } 
   $res = $this->substr($source, $temp_i+$this->strlen($param1), $i-$temp_i-$this->strlen($param1));
   if ($res == "") {$res = " ";} 
   $k = 0;
   $q = $this->stripos($res, $param1);
   while ($q !== false) {
  	$k = $q;
    $q = $q + $this->strlen($param1);
    $q = $this->stripos($res, $param1, $q);
	$count_close++;	
   }  
   $q = $i;
   if ($count_close > 0 && $k > 0) { 	  	
    $temp_i = $k + $temp_i + $this->strlen($param1);
    $i = $temp_i;   
    $res = $this->substr($source, $temp_i+$this->strlen($param1), $q-$temp_i-$this->strlen($param1));
   }
   $Lparam = $this->substr($source, $temp_i, $q-$temp_i+$this->strlen($param2));
   if ($Lparam == "") { return $source; }   
   $s = $res;
   switch ($tag) {
   	case 'B': 
	case "I":	
	case "U":
   	 if (!$onlytext) { 
	  $s = '<'.$this->strtolower($tag).'>'.$res.'</'.$this->strtolower($tag).'>'; 
	 } else { 
	  $s = $res; 
	 }
   	 break;
    case "DEF":
     if (!$onlytext) { 
	  $s = '<span class="" style="font-style: normal">'.$res.'</span>'; 
	 } else { 
	  $s = $res; 
	 }
     break;    	
   	//case "B": if (!$onlytext) { $s = '<b>'.$res.'</b>'; } else { $s = $res; } break; 
    //case "I": if (!$onlytext) { $s = '<i>'.$res.'</i>'; } else { $s = $res; } break;
    //case "U": if (!$onlytext) { $s = '<u>'.$res.'</u>'; } else { $s = $res; } break;
    case "URL":
     if ($onlytext) { $s = $res; break; }
	 $noindex_t = $this->CheckLinkNoOur($res);	      
     $s = (($noindex_t) ? '<noindex>' : '').
	 '<a '.(($noindex_t) ? 'rel="nofollow" ' : '').'href="'.$res.'" target="_blank">'.$res.'</a>'.
	 (($noindex_t) ? '</noindex>' : '');    
    break;
    case 'IMG':
     if ($onlytext) { $s = '[**image**]'; break; }
     $noindex_t = $this->CheckLinkNoOur($res);
     $s = (($noindex_t) ? '<noindex>' : '').'<img src="'.$res.'" alt="Image">'.(($noindex_t) ? '</noindex>' : '');     
    break;    
    case "QUOTE":
     if ($onlytext) { $s = $res; break; }  
     $this->owner->smarty->assign('quote_item_source', $res);
	 $s = $this->owner->smarty->fetch('items/quote_item.tpl');    	 
    break;
    case 'XML':
     if ($onlytext) { $s = $res; break; }
     $s = $this->highlight_xml($res);
    break;    
    case 'PRE':
     if ($onlytext) { $s = $res; break; }
     $s = '<pre style="width: 550px; overflow: auto;">'.$res.'</pre>';    
    break;
    case "PHP":
     if ($onlytext) { $s = $res; break; }
     //повтор, не используется статик метод    
     $s = @stripslashes($res); 
     if(!$this->strpos($s, "<?") && $this->substr($s, 0, 2) != "<?") {
       $s = "<?php\n".@trim($s)."\n?>"; 
     }  
     $s = @trim($s); 
     $s = @htmlspecialchars_decode($s, ENT_QUOTES);
     $s = @str_replace("<br>", "\r\n", $s); 
     $s = '<div style="overflow: auto; height: auto; width: 99%">'.@highlight_string($s, true).'</div>';
    break;
   }//switch  
   $s = @$this->substr_replace($source, $s, @$this->stripos($source, $Lparam), $this->strlen($Lparam)); 
   $w = @$this->substr_count($s, $param2);   
   for ($i=1; $i<=$w; $i++) { $s = $this->ParseStringTagsOne($tag, $s, $onlytext); }
   return $s;   	
  }//ParseStringTagsOne
  
  static function HiglPHPCode($res, $control) {
   $s = @stripslashes($res); 
   if(!$control->strpos($s, "<?") && $control->substr($s, 0, 2) != "<?") {
     $s = "<?php\n".@trim($s)."\n?>"; 
   }  
   $s = @trim($s); 
   $s = @htmlspecialchars_decode($s, ENT_QUOTES);
   $s = @str_replace("<br>", "\r\n", $s); 
   $s = '<div style="overflow: auto; height: auto; width: 99%">'.@highlight_string($s, true).'</div>';
   return $s;    
  }//HiglPHPCode
  
  private function GetPicParameters($source) {
   $res = array('h'=>'', 'w'=>'',);
   if (!trim($source)) {return $res;}
   $spl = @explode(':', $source);   
   for ($i=0; $i<=@count($spl)-1; $i++) {
	if (!trim($spl[$i])) { continue; }
	$word = $this->substr($spl[$i], 0, 1);	
	$num  = $this->substr($spl[$i], 1);
	if ((@is_numeric($num)) and ($num <= 1500) and ($num > 0)) {
	 if (@array_key_exists($word,$res)) { $res[$word] = $num; }
 	}	
   } 
   return $res;   	
  }//GetPicParameters	
  
  protected function ParseStringTags($tag, $source, $slash='\\', $incerdata=0, $onlytext=false, $unigue_prifix='') {
   $count_close = 0;
   if ($this->globaluniq === false) { $this->globaluniq = $unigue_prifix; } 
   $tag    = $this->strtoupper($tag); 
   $param1 = '['.$tag.'='.$slash.'"';
   $param2 = '[/'.$tag.']';
   $param3 = '"]';
   
   $res = array('name'=>'', 'source'=>'',);
   $i = $this->stripos($source, $param1);
   if ($i === false) { return $source; }
   $temp_i = $i;
  
   $j = $this->stripos($source, $param3, $i);
   if ($j === false) { return $source; }
  
   $res['name'] = $this->substr($source, $i+$this->strlen($param1), $j-$i-$this->strlen($param1));
  
   $i = $this->stripos($source, $param2, $j);
   if ($i === false) { return $source; }
  
   $res['source'] = $this->substr($source, $j+$this->strlen($param3), $i-$j-$this->strlen($param3));
  
   $k = 0;
   $q = $this->stripos($res['source'], $param1);
   while ($q !== false) {
  	$k = $q;
    $q = $q + $this->strlen($param1);
    $q = $this->stripos($res['source'], $param1, $q);
	$count_close++;	
   }
  
   $q = $i;
   if (($count_close > 0) and ($k > 0)) { 	  	
    $temp_i = $k + $j + $this->strlen($param3);
    $i = $temp_i;
    $j = $this->stripos($source, $param3, $i);
    if ($j === false) { return $source; }  
    $res['name']   = $this->substr($source, $i+$this->strlen($param1), $j-$i-$this->strlen($param1)); 
    $res['source'] = $this->substr($source, $j+$this->strlen($param3), $q-$j-$this->strlen($param3));
   }

   $Lparam = $this->substr($source, $temp_i, $q-$temp_i+$this->strlen($param2));
   if ($Lparam == "") { return $source; }
  
   $s = $res['source'];
   $incerdata1 = $incerdata;
   
   switch ($tag) {
   	case "LINK"  :
	case "URL"   :
    case "URLX2"   :	
	 if ($onlytext) { $s = $res['source']; break; }
	 if (!$res['name']) { $res['name'] = $res['source']; }	 
	 $noindex_t = ($tag == 'URLX2') ? false : $this->CheckLinkNoOur($res['source']);	 	      
     $s = (($noindex_t) ? '<noindex>' : '').
	 '<a '.(($noindex_t) ? 'rel="nofollow" ' : '').'href="'.$res['name'].'" target="_blank">'.$res['source'].'</a>'.
	 (($noindex_t) ? '</noindex>' : '');
	break;
	case "COLOR" : 
	 if ($onlytext) {$s = $res['source']; break; }
	 $s = '<font color="'.$res['name'].'">'.$res['source'].'</font>';
	break;
    case "HIDE"  :
     if ($onlytext) { $s = $res['source']; break; }
     if (!trim($res['name'])) { $res['name'] = $this->owner->GetText('hiddensourcetext'); }
     $s = '<div id="hide_spase"><div id="hideblock">&nbsp;&nbsp;<span id="roll_down" onclick="RollHide(this,\''.
	 $unigue_prifix.$incerdata1.'\')">&nbsp;</span>&nbsp;'.$res['name'].
	 '<div id="hidetext'.$unigue_prifix.$incerdata1.'" class="hidetext">'.$res['source'].'</div></div></div>'; 
     $incerdata1++;
    break;
    case "IMG":
     if ($onlytext) { $s = '[**image**]'; break; }
     if (!trim($res['name'])) { $res['name'] = "h0:w0"; } 
     $spl = $this->GetPicParameters($res['name']);
     if ($spl['h']) { $spl['h'] = ' height="'.$spl['h'].'"'; }
     if ($spl['w']) { $spl['w'] = ' width="'.$spl['w'].'"'; }  
     $s = "<span id='pic'><noindex><a rel='nofollow' href='{$res['source']}' ".
	 "target='_blank' title='".$this->owner->GetText('viewinnewwindowopened')."'>".
	 "<img {$spl['h']}{$spl['w']} src='{$res['source']}'></a></noindex></span>";
    break; 
	case 'LK':
	 if ($onlytext) { $s = $res['source']; break; }
	 $res['name'] =  $this->HTMLspecialChars(trim($res['name']));
	 if (!$res['name'] || !@is_numeric($res['name'])) { $res['name'] = "0"; }
	 $res['name'] = 'lk_'.$res['name'].$this->globaluniq;
	 $s = '<label id="'.$res['name'].'">'.$res['source'].'</label>';	  
	break; 
	case 'VIE':
	 if ($onlytext) { $s = $res['source']; break; }
	 $res['name'] =  $this->HTMLspecialChars(trim($res['name']));
	 if (!$res['name'] || !@is_numeric($res['name'])) { $res['name'] = "0"; }
	 $res['name'] = 'lk_'.$res['name'].$this->globaluniq;
	 $s = '<a href="#'.$res['name'].'">'.$res['source'].'</a>';	  
	break;
	case 'SIZE':
	 if ($onlytext) { $s = $res['source']; break; }
	 $res['name'] =  $this->HTMLspecialChars(trim($res['name']));
	 if (!$res['name']) { $res['name'] = "100%"; }	 
	 $s = '<label style="font-size: '.$res['name'].'">'.$res['source'].'</label>';	  
	break;
    case 'PADDING':
     if ($onlytext) { $s = $res['source']; break; }
	 $res['name'] =  $this->HTMLspecialChars(trim($res['name']));
	 if (!$res['name'] || !@is_numeric($res['name'])) { $res['name'] = "1"; }	 
	 $s = '<span style="margin-left: '.$res['name'].'px">'.$res['source'].'</span>';
    break; 		
   }//switch 
   //$s = str_replace($Lparam,$s,$source);
   $s = @$this->substr_replace($source, $s, @$this->stripos($source, $Lparam), $this->strlen($Lparam));
   //$s = substr($source,0,$temp_i).$s.substr($source,$q+strlen($param2));
   $w = @$this->substr_count($s, $param2);   
   for ($i=1; $i<=$w; $i++) { $s = $this->ParseStringTags($tag, $s, $slash, $incerdata1, $onlytext, $unigue_prifix); }   
   return $s;	
  }//ParseStringTags
  
  protected function highlight_xml($text) {
   return '<pre style="width: 550px; overflow: auto;">'.
   @preg_replace("~(&quot;|&#039;)[^<>]*(&quot;|&#039;)~iU", '<span style="color: #DD0000">$0</span>',
   @preg_replace("~&lt;!--.*--&gt;~iU", '<span style="color: #FF8000">$0</span>',
   @preg_replace("~(&lt;[^\s!]*\s)([^<>]*)([/?]?&gt;)~iU", '$1<span style="color: #007700">$2</span>$3',
   @preg_replace("~&lt;[^<>]*&gt;~iU", '<span style="color: #0000BB">$0</span>',
   $text)))).'</pre>';
  }//highlight_xml

  /** обработка тэгов в тексте */
  function ConvertTextToHTML($source, $tags=W_DEFTAGSTOPARSEINTEXT, $onlytext=false) {
   if (!$tags) { return $source; }
   $result = " ".@stripcslashes($source)." ";  
   //double
   $tags2 = @explode(',', W_DEFTAGSTOPARSEINTEXT2);
   foreach ($tags2 as $tag) {     
    if ($onlytext) {
     $result = @preg_replace("/\[$tag=(.*)\]/iU", '', $result);
     $result = @preg_replace("/\[\/$tag\]/iU", '', $result);     
    } else {    
	 $result = $this->ParseStringTags($tag, $result, '', 0, $onlytext, @rand());
    } 
   }
   if (!$onlytext) {  
    //correct elements links
    $result = @preg_replace(
     "/([\s|\r|\n|>])(http|https|ftp|telnet|news|gopher|file|wais):\/\/([a-z0-9.\-\/]+?)/iU", 
	 '\\1[URL]\\2://\\3[/URL]', $result
    );      
   }
   //once
   $tags = (!@is_array($tags)) ? @explode(',', $tags.',def') : $tags;	
   foreach ($tags as $tag) {
    if ($onlytext) {
     $result = @preg_replace("/\[$tag\]/iU", '', $result);
     $result = @preg_replace("/\[\/$tag\]/iU", '', $result);        
    } else {
	 $result = $this->ParseStringTagsOne($tag, $result, $onlytext);
    }
   }   
   $result = @str_ireplace('\"', '"', $result);
   $result = @str_replace('sp$sp', '&nbsp;', $result);
   if ($onlytext) {
    while ($this->strpos($result, "<br><br>") !== false) { $result = @str_replace("<br><br>", "<br>", $result); }   
   }
   return @ltrim(@rtrim($result));   	
  }//ConvertTextToHTML
  
  /** подготовка текста для сохранения в базу */
  function CorrectTextToDB($source) {
   $source = $this->ClearBreake($source, true, false);
   $source = preg_replace("/\n/", ":nnbr:", $source);
   $source = str_replace('"', ":dbcompl:", $source); 
   $source = str_replace("'", ":docompl:", $source);
   return $this->HTMLspecialChars($source);   	
  }//CorrectTextToDB
  
  /** обработка текста для отображения из базы */
  function CorrectTextFromDB($source, $tags=false, $onlytext=false, $ishtmlcode=false, $prevlenght=250, $dosubstr=false) {
   //only as html format
   if ($ishtmlcode) {    
    return (!$onlytext) ? @stripcslashes($source) : $this->StripHTML($this->substr($source, 0, $prevlenght)).'...';      
   }     
   //formatted string    
   if ($tags === false) { $tags = W_DEFTAGSTOPARSEINTEXT; }
   
   $source = @preg_replace("/:nnbr:/", "<br>", $source);
   $source = @str_replace(':dbcompl:', '"', $source);
   $source = @str_replace(':docompl:', "'", $source);
   $source = $this->ConvertTextToHTML($source, $tags, $onlytext);
   
   return (!$onlytext) ? $source : $this->StripHTML(($dosubstr) ? $this->substr($source, 0, $prevlenght) : $source);	
  }//CorrectTextFromDB
  
  /** обработка текста для изминения текста */
  function CorrectTextForModify($source) {
   $source = preg_replace("/:nnbr:/",  "\n", $source);
   $source = str_replace(':dbcompl:', '"', $source);
   $source = str_replace(':docompl:', "'", $source);
   return $this->HTMLspecialCharsDecode($source);	
  }//CorrectTextForModify   	

 }//w_string_obj 
 //-----------------------------------------------------------------  
 /** общий шаблон класса управления */
 class w_Control_obj extends w_defext {
  /* данные sql */	
  private $tempHost = '';
  private $tempUser = '';
  private $tempPass = '';
  private $tempDBNS = ''; 
  private $tempCHRT = '';
  /* данные админестратора */    
  private $temp_mail = W_HOSTMYSITE;
  private $temp_mhost= W_ADMINEMAIL;
  /* дамп временных данных */
  private $dump_block = array();
  /** активный язык */
  private $active_language = false;
  /** активный скин сайта */
  private $active_skin = false;
  /** список таблиц */
  var $tables_list = array();
  /* объекты управления */
  var $smarty = null;
  var $db = null;
  var $lang = null;
  var $strings = null;
  /** ошибка авторизации */
  var $auth_error_str = '';
  /** данные текущего пользователя */
  var $userdata = false;
  /** флаг админестратора */
  var $isadminstatus = false;  
  
  function __construct($sq_host, $sq_user, $sq_pass, $sq_dbname, $tableslist, $sq_charset = 'utf8') {
   unset($this->smarty);
   unset($this->db);
   unset($this->lang);
   unset($this->strings);
   $this->tempHost = $sq_host;
   $this->tempPass = $sq_pass;
   $this->tempUser = $sq_user;
   $this->tempDBNS = $sq_dbname;
   $this->tempCHRT = $sq_charset;
   $this->tables_list = $tableslist;
   parent::__construct();
   /* возврат забытых элементов */
   $this->RestoreSessionSource();	
  }//constructor  	  
  
  function __get($propName) {
   switch ($this->strtolower($propName)) {
	//template obj
	case 'smarty':
	 if (!isset($this->smarty)) {
	  require_once W_LIBPATH.'/sm/Smarty.class.php';
	  $this->smarty = new Smarty();
	  //шаблоны
	  $this->smarty->template_dir = W_SITEDIR.'/sm_ff/'.$this->GetActiveLanguage().'/templates/'.$this->GetActiveSkin().'/';	  
	  //компелированные версии
	  $this->smarty->compile_dir = W_SITEDIR.'/sm_ff/'.$this->GetActiveLanguage().'/templates_c/'.$this->GetActiveSkin();
	  if (!@file_exists($this->smarty->compile_dir)) { @mkdir($this->smarty->compile_dir, 0777); }
	  $this->smarty->compile_dir .= '/';
	  //конфиги	  
	  $this->smarty->config_dir = W_SITEDIR.'/sm_ff/'.$this->GetActiveLanguage().'/configs/'.$this->GetActiveSkin();
	  if (!@file_exists($this->smarty->config_dir)) { @mkdir($this->smarty->config_dir, 0777); }
	  $this->smarty->config_dir .= '/';
	  //$this->smarty->cache_dir = W_SITEDIR.'/sm_ff/'.$this->GetActiveLanguage().'/cache/'.$this->GetActiveSkin().'/';
	  //$this->smarty->caching = true;		
	 }	
	break;	
	//database obj
	case 'db':
	 if (!isset($this->db)) {
	  $this->db = new sc_DB(
	   $this, $this->tempHost, $this->tempUser, $this->tempPass, $this->tempDBNS, $this->tempCHRT
	  );	 	
	 }	
	break;
	//language
	case 'lang':
	 if (!isset($this->lang)) {
	  $file_lang = W_LIBPATH.'/language/lang.'.$this->strtolower($this->GetActiveLanguage()).'.lib.php';
	  if (!@file_exists($file_lang)) {
	   throw new cs_Exception("Language file not found!");	
	  }
	  require_once $file_lang;
	  $this->lang = new w_language_obj($this);
	 }	
	break;
	case 'strings':
	 if (!isset($this->strings)) {
	  $this->strings = new w_string_obj($this);	  	
	 }
	break;		
	//no found prop type	
	default: throw new cs_Exception("Unknown '$propName' property");
   } 
   return $this->$propName;	   	
  }//__get	 
  
  /** простая отправка сообщения */
  function DoMail($to, $title, $Message, $from = "") {
   $fr = $this->temp_mhost; 
   if ($from) { $fr = $from; }
   $adds = "From: $fr\n";
   return mail($to, $title, $Message, $adds);   	
  }//DoMail
  
  /** отправка указанного сообщения в кодировке */
  function DoMailX($to, $subj, $body, $from = W_INFORMATIONEMAIL, $charset="utf-8") { 
   $content_type = @preg_match("/<html>.*</html>/si", $body) ? "text/html" : "text/plain";
   $headers  = "Content-Type:".$content_type.";charset=".$charset."\n"; 
   $headers .= "From: ".$from."\n"; 
   $headers .= "Subject: ".$subj."\n"; 
   $headers .= "Content-Type:".$content_type.";charset=".$charset."\n"; 
   if ("koi8-r" == $charset) { 
    $headers = @convert_cyr_string($headers, "w", "k"); 
    $body    = @convert_cyr_string($body, "w", "k"); 
   } 
   if (@mail($to, $subj, $body, $headers)) return true; 
   return false;
  }//DoMailX	
  
  /** отправка текстового сообщения с вложением */
  function DoMailWithFile($to, $subj, $text, $filename, $psevdofilename = "", $from=W_INFORMATIONEMAIL) {
   if ($psevdofilename == "") { $psevdofilename = @basename($filename); }	
   $f         = @fopen($filename,"rb");
   $un        = @strtoupper(uniqid(time()));
   $head      = "From: $from\n";
   $head     .= "To: $to\n";
   $head     .= "Subject: $subj\n";
   $head     .= "X-Mailer: PHPMail Tool\n";
   $head     .= "Reply-To: $from\n";
   $head     .= "Mime-Version: 1.0\n";
   $head     .= "Content-Type:multipart/mixed;";
   $head     .= "boundary=\"----------".$un."\"\n\n";
   $zag       = "------------".$un."\nContent-Type:text/plain;\n";
   $zag      .= "charset=\"utf-8\"\n\n$text\n\n";
   $zag      .= "------------".$un."\n";
   $zag      .= "Content-Type: application/octet-stream;";
   $zag      .= "name=\"".$psevdofilename."\"\n";
   $zag      .= "Content-Transfer-Encoding:base64\n";
   $zag      .= "Content-Disposition:attachment;";
   $zag      .= "filename=\"".$psevdofilename."\"\n\n";
   $zag      .= @chunk_split(@base64_encode(@fread($f, @filesize($filename))))."\n";
   if (!@mail("$to", "$subj", $zag, $head))
    return 0;
   else
   return 1;
  }//DoMailWithFile 
  
  /** установка куков авторизации */
  function DoSetCookiesAuth($n,$p) {	
   if ((!$n) and (!$p)) {
    $sm = ''; 
    $this->SetCookies('name');
    $this->SetCookies('pass');	
   } else { 
   	$sm = '1'; 
    $this->SetCookies('name',$n);
    $this->SetCookies('pass',$p);   
   }    
   $this->SetCookies('sm_data',$sm);	
  }//DoSetCookies   
  
  /** проверка реинициализация сессии */
  function RestoreSessionSource($onlylangandskin=false) {
   global $_GLOBAL_LANGUAGE_LIST, $_GLOBAL_SKIN_LIST;   	
   //авторизация
   if (!$onlylangandskin && $_COOKIE[$this->GetSessionIdentify('name')] && $_COOKIE[$this->GetSessionIdentify('pass')]) { 	
	$_SESSION[$this->GetSessionIdentify('name')] = $_COOKIE[$this->GetSessionIdentify('name')];
    $_SESSION[$this->GetSessionIdentify('pass')] = $_COOKIE[$this->GetSessionIdentify('pass')];	
   }
   //язык
   if ($_COOKIE[$this->GetSessionIdentify('lang')] && 
   @isset($_GLOBAL_LANGUAGE_LIST[$_COOKIE[$this->GetSessionIdentify('lang')]])) {
    $_SESSION[$this->GetSessionIdentify('lang')] = $_COOKIE[$this->GetSessionIdentify('lang')];
   } elseif (isset($_SESSION[$this->GetSessionIdentify('lang')])) {
	unset($_SESSION[$this->GetSessionIdentify('lang')]);
   }
   //шкура
   if ($_COOKIE[$this->GetSessionIdentify('skin')] && 
   @isset($_GLOBAL_SKIN_LIST[$_COOKIE[$this->GetSessionIdentify('skin')]])) {
    $_SESSION[$this->GetSessionIdentify('skin')] = $_COOKIE[$this->GetSessionIdentify('skin')];
   } elseif (isset($_SESSION[$this->GetSessionIdentify('skin')])) {
	unset($_SESSION[$this->GetSessionIdentify('skin')]);
   }   	
  }//RestoreSessionSource
  
  /** получение текущего языка */
  function GetActiveLanguage() {
   global $_GLOBAL_LANGUAGE_LIST;	
   if ($this->active_language !== false) { return $this->active_language; }
   $this->active_language = (isset($_SESSION[$this->GetSessionIdentify('lang')]) && 
   @isset($_GLOBAL_LANGUAGE_LIST[$this->strtoupper($_SESSION[$this->GetSessionIdentify('lang')])]) && 
   @file_exists(W_LIBPATH.'/language/lang.'.$this->strtolower($_SESSION[$this->GetSessionIdentify('lang')]).'.lib.php'))
   ? $this->strtoupper($_SESSION[$this->GetSessionIdentify('lang')]) : W_LANGUAGEDEFAULT;
   return $this->active_language;   	
  }//GetActiveLanguage
  
  /** установка языка */
  function SetActiveLanguage($lang) {
   global $_GLOBAL_LANGUAGE_LIST;
   if ($this->GetActiveLanguage() == $lang || !isset($_GLOBAL_LANGUAGE_LIST[$lang])) { return true; }
   $_SESSION[$this->GetSessionIdentify('lang')] = $lang;
   $this->SetCookies('lang', $lang);
   $this->active_language = $lang;
   //$this->RestoreSessionSource(true);
   return true;   	
  }//SetActiveLanguage
  
  /** получение текущего скина сайта */
  function GetActiveSkin() {
   global $_GLOBAL_SKIN_LIST;	
   if ($this->active_skin !== false) { return $this->active_skin; }
   $this->active_skin = (isset($_SESSION[$this->GetSessionIdentify('skin')]) && 
   @isset($_GLOBAL_SKIN_LIST[$this->strtoupper($_SESSION[$this->GetSessionIdentify('skin')])]))
   ? $this->strtoupper($_SESSION[$this->GetSessionIdentify('skin')]) : W_SKINDOMAINDEFAULT;
   if (!@file_exists(W_SITEDIR.'/sm_ff/'.$this->GetActiveLanguage().'/templates/'.$this->active_skin.'/main.tpl')) {
   	
	//print 'no';
   	//exit;
   	
	$this->active_skin = W_SKINDOMAINDEFAULT;
   }
      
   //print $this->active_skin; exit;
         
   return $this->active_skin;	
  }//GetActiveSkin
  
  /** установка текущего активного скина сайта */
  function SetActiveScin($skin) {
   global $_GLOBAL_SKIN_LIST;
   if ($this->GetActiveSkin() == $skin || !isset($_GLOBAL_SKIN_LIST[$skin])) { return true; }
   $_SESSION[$this->GetSessionIdentify('skin')] = $skin;
   $this->SetCookies('skin', $skin);
   $this->active_skin = $skin;
   //$this->RestoreSessionSource(true);
   return true;       	
  }//SetActiveScin
  
  /** проверка активности пользователя */
  function CheckCurrentSession() {
   return ($_SESSION[$this->GetSessionIdentify('name')] && $_SESSION[$this->GetSessionIdentify('pass')]);   	
  }//CheckCurrentSession 
  
  /** получение строки по языку интерфейса */
  function GetText($name, $list=false, $def=false) { return $this->lang->GetLang($name, $list, $def); }
  
  /** получение пользователя по идентификатору */
  protected function GetUserInfoByID($userid=false) {
   if (!$userid) {
   	if (!$this->IsOnline()) { return false; }
   	return $this->userdata;
   }
   $userid = $this->CorrectSymplyString($userid);
   return $this->db->GetLineArray($this->db->GetTable($this->tables_list['users'], "iduser='$userid'", "1"));   	
  }//GetUserInfoByID
  
  /** получение информации о пользователе
  * @username - если false - получает текущие данные активного пользователя, установка данных,
  *             или возвращает данные указанного пользователя
  *             если $IsgetbyID - $username должно быть идентификатором пользователя 
  * @IsgetbyID - получать пользователя по идентификатору
  *  
  * @return array - информация о пользователе   
  */
  function GetUserInfo($username=false, $IsgetbyID=false) {
   global $_GLOBAL_ADMINS_LIST;
   if ($IsgetbyID) { return $this->GetUserInfoByID($username); }   
   if ($username) { 
    $username = $this->CorrectSymplyString($username);
	return $this->db->GetLineArray($this->db->GetTable($this->tables_list['users'], 
	"Lower(username) = Lower('$username')", "1"));		
   }
   //info of current active user
   if (!$this->CheckCurrentSession()) { return false; }
   $us_name = trim($this->CorrectSymplyString($_SESSION[$this->GetSessionIdentify('name')]));
   $us_pass = trim($this->CorrectSymplyString($_SESSION[$this->GetSessionIdentify('pass')]));
   if (!$us_name || !$us_pass) { return false; }
   $this->userdata = $this->db->GetLineArray($this->db->GetTable($this->tables_list['users'],
   "Lower(username) = Lower('$us_name') and userhash='$us_pass'", "1"));
   if (!$this->userdata) { return false; }
   if ($this->CheckCurrentSession() && !$_COOKIE[$this->GetSessionIdentify('sm_data')]) {
	$this->DoSetCookiesAuth($us_name, $us_pass);	
   }
   if ($this->userdata['userlocked'] && (!@in_array($this->strtolower($this->userdata['username']), 
   $_GLOBAL_ADMINS_LIST) || W_CANBLOCKADMINACCOUNT)) {
   	$this->ExitOfAccount();
	$this->userdata = false;
	$this->isadminstatus = false; 
   	return false; 
   } 
   //get admins from group
   $this->SetAdminStatusFromAdminGroup();
   //check status
   $this->isadminstatus = $this->userdata && @in_array($this->strtolower($us_name), $_GLOBAL_ADMINS_LIST);   
   //update date info
   if ($this->userdata && ($this->userdata['datelastin'] != $this->GetThisDate())) {	
    $date = $this->GetThisDate();
    $this->db->mPost(
	 "UPDATE {$this->tables_list['users']} SET datelastin='$date' where iduser='{$this->userdata['iduser']}' limit 1"
	);	
   }   
   return $this->userdata;   	
  }//GetUserInfo
  
  /** принудительный выход из аккаунта */
  function ExitOfAccount() {
   if (isset($_SESSION[$this->GetSessionIdentify('name')])) unset($_SESSION[$this->GetSessionIdentify('name')]);
   if (isset($_SESSION[$this->GetSessionIdentify('pass')])) unset($_SESSION[$this->GetSessionIdentify('pass')]);	
   $this->DoSetCookiesAuth(false, false);  
  }//ExitOfAccount
  
  /** генерация кода активации аккаунта */
  function GenerateActivationCode($userinfo) {
   return $this->strtoupper(
    md5($userinfo['iduser'].$userinfo['datereg'].$userinfo['username'].$userinfo['useremail'])
   );	
  }//GenerateActivationCode
  
  /** отправка сообщения о активации аккаунта */
  function SendActivationCode($useinfo, $DORETURN=TRUE) {
   if (!$useinfo || !$useinfo['useremail']) { return $DORETURN; }
   $active_code = $this->GenerateActivationCode($useinfo);   
   $link_activated = 'http://'.W_HOSTMYSITE."/activate/";
   $mail_text = $this->GetText('activemailtext', 
    array($useinfo['username'], $link_activated.$active_code.'/', $active_code, $link_activated)
   );
   if (!$mail_text) { return $DORETURN; }
   $this->DoMailX($useinfo['useremail'], $this->GetText('activregisteracc', array($useinfo['username'])), $mail_text);
   return $DORETURN;   	
  }//SendActivationCode
  
  /** вход в кабинет
  * @info - array(
  *  'login' => логин для авторизации
  *  'pass'  => пароль для авторизации
  * )
  * @return string   
  */
  function EnterToAccount($info,$domd5=true) {
   global $_GLOBAL_ADMINS_LIST;	
   if (!isset($info['login'])) { return $this->GetText('setlogindata'); }
   if (!isset($info['pass'])) { return $this->GetText('setpassdata'); }
   foreach ($info as $name => $val) {
   	if ($name != 'pass') { $info[$name] = trim($this->CorrectSymplyString($val)); }		
   }
   $info['hash'] = ($domd5) ? md5($info['pass']) : $info['pass'];
   $res = $this->db->GetLineArray($this->db->GetTable($this->tables_list['users'], 
   "Lower(username) = Lower('{$info['login']}') and userhash='{$info['hash']}'", "1"));
   if (!$res) { return $this->GetText('unknowloginorpass'); }
   if (!$res['confreg']) { return $this->SendActivationCode($res, $this->GetText('usernotactive')); }
   if ($res['userlocked'] && (!@in_array($this->strtolower($res['username']), 
   $_GLOBAL_ADMINS_LIST) || W_CANBLOCKADMINACCOUNT)) {
   	$this->ExitOfAccount(); 
   	return $this->GetText('accountisblock', array($res['username'], $res['userlocked'])); 
   }   
   $_SESSION[$this->GetSessionIdentify('name')] = $res['username'];
   $_SESSION[$this->GetSessionIdentify('pass')] = $info['hash'];   
   return '';   	
  }//EnterToAccount
  
  /** инициализация пользователя на сайте
  * @username - string если false - текущий активный, иначе - указанный пользователь
  * @loginfo - array(login,pass) если $username указано
  * @processEnter - true если выполнить вход
  *   
  * @return bool   
  */
  function DoInitializeAccount($username=false, $loginfo = false, $processEnter=false) {
   if ($username) {
   	if (!$this->isadminstatus) { return false; } 
	$info = $this->GetUserInfo($username);
	if (!$info) { return false; }
	$this->ExitOfAccount();
	$this->auth_error_str = $this->EnterToAccount(
	 array(
	  'login' => $info['username'],
	  'pass' => $info['userhash']
	 ), false
	);
	$this->GetUserInfo();
	return $this->userdata;	
   }
   if ($processEnter) { 
   	$this->auth_error_str = $this->EnterToAccount(
     array('login'=>$loginfo['login'], 'pass'=>$loginfo['pass'])
    ); 
   }
   $this->GetUserInfo();
   return $this->userdata;  	
  }//DoInitializeAccount
  
  /** проверка пользователя online */
  function IsOnline() {
   return ($this->userdata && ($_SESSION[$this->GetSessionIdentify('name')] == $this->userdata['username']) &&
   ($_SESSION[$this->GetSessionIdentify('pass')] == $this->userdata['userhash']));   	
  }//CheckOnlineStatus
  
  /** добавление пользователя */
  function AddNewUser($login, $mail, $pass, $url, $invite, $chcode, $autoactivate=0, $chcodeval=false, $noinforms=false) {
   if (!W_CANBEREGISTERED && !$this->isadminstatus) { return $this->GetText('cantregisteruser'); }   
   if ($chcode != (($chcodeval === false) ? $_SESSION["sendnumbq"] : $chcodeval)) { 
   	return $this->GetText('numbisnotvalid'); 
   }      
   $login = trim($this->ClearBreake($this->substr($login, 0, 99)));
   if (!$login) { return $this->GetText('selectlogin'); }
   if (!$this->ChTable($login, '^0-9{3,40}') || $this->ChTable($login, '^0-9a-zA-z_{3,40}')) {
	return $this->GetText('incorrectlogin');
   }
   $mail = trim($this->CorrectSymplyString($this->substr($mail, 0, 149)));   
   if (!$mail || !$this->validmail($mail)) { return $this->GetText('selectmail'); }       
   $res = $this->db->GetLineArray($this->db->GetTable($this->tables_list['users'],
   "Lower(username) = Lower('$login') or Lower(useremail) = Lower('$mail')", "1"));
   if ($res) { return $this->GetText('loginalredy'); }   
   $url    = trim($this->CorrectSymplyString($this->substr($url, 0, 199)));
   //ok
   $date = $this->GetThisDateTime(); 
   $ip = $this->GetCurrentIP(); 
   $pass2 = md5($pass);
   $balance = W_TOBALANCEONREGISTER;
   if (!W_MOSTEMAILCONFIRMED) { $autoactivate = 1; } else {
    $autoactivate = (!$this->isadminstatus) ? 0 : $autoactivate;	
   }  
   $def_options = $this->CorrectSymplyString(W_DEFAULTACCOUNTOPTIONS); 
   $query = 
   "INSERT INTO {$this->tables_list['users']} SET ".
   "username='$login', datereg='$date', useremail='$mail', usersite='$url', userip='$ip', userhash='$pass2', ".
   "purcedata='$balance', confreg='$autoactivate', genoptions='$def_options'";
   if (!$this->db->mPost($query)) { return 'Error in add new user ['.$this->db->GetError().']'; }
   //ok 
   if (!$autoactivate) {
   	$link_activated = 'http://'.W_HOSTMYSITE."/activate/";
    $active_code = $this->GenerateActivationCode(
     array(
      'iduser'    => $this->db->InseredIndex(),
	  'datereg'   => $date,
      'username'  => $login,
      'useremail' => $mail
     )
    );      
    $this->DoMailX(
     $mail, 
	 $this->GetText('registernewsuc', array(W_HOSTMYSITE)), 
	 $this->GetText('registermailb', array(
	  $login, $login, $pass, $date, $link_activated.$active_code.'/', $active_code, $link_activated 
	 ))
    );
   } else {
   	if ($noinforms) { return ''; } 
   	//пользователю
	$this->DoMailX(
     $mail, 
	 $this->GetText('registernewsuc2', array(W_HOSTMYSITE)), 
	 $this->GetText('registermailb2', array($login, $login, $pass, $date))
    );
    //админу
    if (W_INFORMADMINOBREGIST) {
	 $this->DoMailX(
      W_ADMINEMAIL, 
	  $this->GetText('registernewsuc3', array($login, W_HOSTMYSITE)), 
	  $this->GetText('registermailb3', array($login, $login, $pass, $mail, $ip, $url, $date))
     );		
	}	
   } 
   //активация инвайт кода
   $this->ActivateInviteCode($login, $invite);     
   return '';
  }//AddNewUser
  
  /**
   * Активация инвайт кода
   * @inviteType - 0 or 1
   */
  function ActivateInviteCode($login, $invite, $inviteType=0) {
    if (!$invite) { return false; }
    $invite = md5($invite);
    
    if (!$res = $this->db->GetLineArray($this->db->GetTable(
     $this->tables_list['invites'], 
     "md5(invcode)='$invite' and ((invtype='$inviteType') or (invtype='2'))", "1")
    )) return false;
    
	//options
	if ($res['invopt']) {	   
	 $def_options = $this->CorrectSymplyString(@W_DEFAULTACCOUNTOPTIONS);  
	 $do_save = false;	
	 if (!$this->ReadOption('INDEXSITE', $def_options)) {
	  $def_options = $this->WriteOption('INDEXSITE', '1', $def_options);	  	
	  if (!$do_save) { $do_save = true; }	
	 }
	 if ($do_save) { $this->UpdateOptions($login, $def_options); }    	 	
	}
    
	//summ
	if ($res['sumdata'] > 0) { 
      $this->MoneyProcess(
       $login, $this->GetText('paytoinvitecode'), rand(1,1000000), $res['sumdata']
      ); 
    }
    
	//ok delete
	$this->db->mPost("delete from {$this->tables_list['invites']} where iditem='{$res['iditem']}' limit 1");	
    return true;    
  }//ActivateInviteCode
  
  /** возвращение элемента при условии */
  function GetPostElement($name, $ifname='regaction', $ifvalue='do', $defvalue='', $nospecchars=false) {
   return (isset($_POST[$ifname]) && ($_POST[$ifname] == $ifvalue) && isset($_POST[$name])) ?
   (($nospecchars) ? $_POST[$name] : $this->HTMLspecialChars($_POST[$name])) : $defvalue; 	
  }//GetPostElement
   	
  /** активация аккаунта */
  function ActivateUser($activecode, $chcode, $chcodeval=false) { 
   $activecode = $this->CorrectSymplyString($this->strtolower($activecode));
   if ($this->strlen($activecode) != 32) { return $this->GetText('codeincorrectu'); }
   if ($chcode != (($chcodeval === false) ? $_SESSION["sendnumbw"] : $chcodeval)) { 
   	return $this->GetText('numbisnotvalid'); 
   }
   $res = $this->db->GetLineArray($this->db->GetTable($this->tables_list['users'],
    "md5(CONCAT(iduser,datereg,username,useremail))='$activecode'", "1"
   ));   
   if (!$res) { return $this->GetText('codeincorrectu'); } 
   if ($res['confreg']) { return ''; }   
   if (!$this->db->mPost(
    "UPDATE {$this->tables_list['users']} SET confreg='1' where iduser='{$res['iduser']}' limit 1"
   )) { return 'Error in update activate status'; }
   //ok send about this
   if (W_INFORMADMINOBREGIST) {
   	$this->DoMailX(
     W_ADMINEMAIL, 
	 $this->GetText('registernewsuc3', array($res['username'], W_HOSTMYSITE)), 
     $this->GetText('registermailb3', array(
	  $res['username'], $res['username'], $res['userhash'], $res['useremail'], 
	  $res['userip'], $res['usersite'], $res['datereg'])
	 )
    );		
   }
   return '';      
  }//ActivateUser
  
  /** перенаправление на главную */
  function LocaleToHost($fromhost='') {
   @header("Location: ".((!W_SITEPATH) ? '/': W_SITEPATH).$fromhost); exit; 	
  }//LocaleToHost
  
  /** генерация нового пароля */
  function RestoreUserPassword($loginmail, $newpass, $chcode, $chcodeval=false, $issetpass=false) {
   $loginmail = $this->CorrectSymplyString($loginmail);
   if ($chcode != (($chcodeval === false) ? $_SESSION["sendnumbe"] : $chcodeval)) {
   	return $this->GetText('numbisnotvalid'); 
   }
   $date = $this->GetThisDate();
   //данные идентифицированны
   if ($issetpass) {   	
	if ($this->strlen($loginmail) != 32 || $this->strlen($newpass) != 32) { return $this->GetText('paramsincorrect'); }
	$loginmail = md5($this->strtolower($loginmail));
	$newpass   = $this->CorrectSymplyString($newpass);	
	$res = $this->db->GetLineArray($this->db->mPost(
     "select iduser from {$this->tables_list['users']} where ".
	 "md5(md5(CONCAT(iduser,datereg,username,useremail,'$date',userhash)))='$loginmail' limit 1"
    ));
    if (!$res) { $this->GetText('paramsincorrect'); } 
    $res = $this->db->mPost(
     "UPDATE {$this->tables_list['users']} SET userhash='$newpass' where iduser='{$res['iduser']}' limit 1"
    );
    if (!$res) { return 'Error change password!'; }
    return '2'.$this->GetText('passissendto');		
   }   
   //подготовка к смене
   $loginmail = $this->strtolower($loginmail);
   $res = $this->db->GetLineArray($this->db->GetTable($this->tables_list['users'],
    "Lower(username)='$loginmail' or Lower(useremail)='$loginmail'", "1"
   ));
   if (!$res) { return $this->GetText('logormailincorr'); }
   //ok generate
   $rest_code = md5($res['iduser'].$res['datereg'].$res['username'].$res['useremail'].$date.$res['userhash']);
   $link_rest = 'http://'.W_HOSTMYSITE."/restore/$rest_code&p=".md5($newpass);
   //send info
   $this->DoMailX(
     $res['useremail'], 
	 $this->GetText('boutrestpasswff', array(W_HOSTMYSITE,$res['username'])), 
     $this->GetText('restmessagepsw', array(
	  $res['username'], $res['username'], $res['username'], $newpass, $link_rest	  
	 )
    )
   );
   return '2'.$this->GetText('infoofrestissendt');   	
  }//RestoreUserPassword
  
  /** проверка параметров изображения */
  function CheckPicWols($h,$w,$picname,$type) {
   $pic_info = @getimagesize($picname); $stype = '';
   if (!$pic_info) { return $this->GetText('cantparseimginfo'); }
   $arrt = array();  
   switch ($pic_info[2]) {
    case '1': $arrt[] = '.gif'; break;
    case '2': $arrt[] = '.jpeg'; $arrt[] = '.jpg'; break;
    case '3': $arrt[] = '.png'; break;	
   }
   if (!@in_array($type, $arrt)) { return $this->GetText('typenotsupport'); }
   if ($w < $pic_info[0]) { return $this->GetText('imgwidthnomatch', array($w)); }
   if ($h < $pic_info[1]) { return $this->GetText('imgheightnomatch', array($h)); }
   return array('height'=>$pic_info[1],'width'=>$pic_info[0]);  	
  }//CheckPicWols
  
  //генерация строки из массива
  function GenerateArrayString($array,$empty = "", $startValue='', $endValue='') {
   $res = "";
   $scount = count($array);
   for ($i=0;$i<=$scount-1;$i++) {
	$res .= $startValue.$array[$i].$endValue;
	if ($i < $scount-1) { $res .= $empty; }	
   }
   return $res;	
  }//GenerateArrayString
  
  /** загрузка файла на сервер
  * @fileidentifier - string идентификатор массива $_FILE[идентификатор]
  * @types - array() - список допустимых типов файлов в формате: array(".png", ".gif", и так далее )
  * @max_size - float - максимальный размер файла (в Kb) (false - не проверяется) 
  * @dir  - string - каталог, в который файл будет загружен
  * @max_height - int если изображение - проверка соответствия высоты
  * @max_width - int если изображение - проверка соответствия ширины
  * @is_pic  - bool true если загружается изображение
  * @fileCMD - int если не -1 - установит права доступа на файл после загрузки
  * @fileExtension - string расширение файла после загрузки (добавляется к оригинальному расширению)
  * 
  * @return array(
  *  'newname'      => новое имя файла в виде md5 уникального хэша с расширением файла и fileExtension
  *  'filesize'     => размер файла в Kb
  *  'filesizebyte' => размер файла вбайтах
  *  'result'       => ошибка, если она возникнит при загрузке
  *  'originalname' => оригинальное имя файла
  *  'height'       => высота, если это изображение
  *  'width'        => ширина, если загружается изображение
  *  'type'         => расширение файла в нижнем регистре (например: .rar)     
  * )    
  */
  function UpLoadFile($fileidentifier, $types, $max_size, $dir, $max_height=0, $max_width=0, $is_pic=false, 
   $fileCMD = -1, $fileExtension='.inc') {
   $snameuser = $this->userdata['username'];
   $res = array(
    'newname'      => '',
	'filesize'     => 0,
	'filesizebyte' => 0,
	'result'       => '',
	'originalname' => '',
	'height'       => 0,
	'width'        => 0,
	'type'         => ''
   );
   $filetypeIDstr = @strrchr($_FILES[$fileidentifier]["name"], "." );
   if (!$filetypeIDstr) { 
   	$res['result'] = $this->GetText('fileformatnotmatch'); 
	return $res; 
   }
   $filetypeIDstr = $this->strtolower($filetypeIDstr);
   if (!@in_array($filetypeIDstr, $types)) { 
   	$res['result'] = $this->GetText('filetypenoident', array(
	  $filetypeIDstr, $this->GenerateArrayString($types,'<label style="color: #0000FF">,</label> ')
	 )
	); 
    return $res; 
   }
   $bytesize = $_FILES[$fileidentifier]["size"];
   $flsize = round($bytesize/1024,2);
   if ($max_size && $flsize > $max_size) {
   	$res['result'] = $this->GetText('filesizenomathon', array($flsize, $max_size, ($flsize - $max_size))); 
	return $res; 
   }
   if ($flsize <= 0) { $res['result'] = $this->GetText('fileisempty'); return $res; }
   if (!@is_uploaded_file($_FILES[$fileidentifier]['tmp_name'])) { 
    $res['result'] = $this->GetText('errorindwloadfile'); 
	return $res; 
   }  
   if ($is_pic) {
    $str = $this->CheckPicWols($max_height, $max_width, $_FILES[$fileidentifier]['tmp_name'], $filetypeIDstr);
    if (!@is_array($str)) { $res['result'] = $str; return $res; }
   } 
   $newpicname = md5($snameuser."_".$this->GetThisDateTime()."_temp_filed_".$this->generate_password(4)).$filetypeIDstr;
   if (!$is_pic) { $newpicname .= $fileExtension; }
   if (@file_exists($dir.$newpicname)) { @unlink($dir.$newpicname); }
   if (!@move_uploaded_file($_FILES[$fileidentifier]['tmp_name'], $dir.$newpicname)) { 
   	$res['result'] = $this->GetText('errorindwloadfile'); 
	return $res;
   }  
   if ($fileCMD != -1) { @chmod($dir.$newpicname,$fileCMD);  }	  
   $res['result']       = "";
   $res['newname']      = $newpicname;
   $res['filesize']     = $flsize;
   $res['filesizebyte'] = $bytesize;
   $res['originalname'] = $this->strtolower($this->CorrectSymplyString($_FILES[$fileidentifier]["name"]));
   if ($is_pic) {
    $res['height']      = $str['height'];
    $res['width']       = $str['width'];
   }
   $res['type']         = $filetypeIDstr;
   return $res;	  	
  }//UpLoadFile
  
  /** чтение надстройки
  * @name - string имя надстройки
  * @value - string если false - настрйоки текущего пользователя, или текст надстроек
  * 
  * @return === false если не авторизирован или нет надстройки, или string - значение     
  */
  function ReadOption($name, $value=false) {
   if ($name == '' || ($value !== false && $value == '') || ($value === false && !$this->IsOnline())) { return false; }     
   $value = ($value === false) ? $this->userdata['genoptions'] : $value;
   if (!$value) { return false; }   
   if (@preg_match("/\[".$name."\](.*?)\[\/".$name."\]/isU", $value, $ar)) { return $ar[1]; }
   return false;   	
  }//ReadOption
  
  /** изминение надстройки
  * @name - string имя надстройки
  * @value - string текст надстроек
  * @replaceto - === false or string если false - надстройка удаляется 
  * 
  * @return bool, false - if not exists, 0-if not change, true - if change    
  */
  function ChangeOption($name,&$value,$replaceto,$correctstring=true) {
   $val = $this->ReadOption($name, $value);	
   if ($val === false) { return false; }
   $val = ($replaceto === false) ? '' : 
   (($correctstring) ? $this->CorrectSymplyString("[$name]{$replaceto}[/$name]") : "[$name]{$replaceto}[/$name]");
   $value1 = @preg_replace("/\[".$name."\](.*?)\[\/".$name."\]/isU", $val, $value, 1);
   if ($value == $value1) { return 0; }
   $value = $value1;
   return true;   	
  }//ChangeOption
    
  /** установка надстройки 
  * @name - string имя надстройки
  * @setval - string новое значение надстройки
  * @value - string если false - настройки текущего пользователя, или текст надстроек
  * 
  * @return === false или новый текст всех надстроек     
  */
  function WriteOption($name, $setval, $value=false, $correctstring=true) {  	
   if ($name == '' || ($value === false && !$this->IsOnline())) { return false; }
   if ($value === false) {
	$value = $this->userdata['genoptions'];
	$online = true;
   } else { $online = false; }
   $setval = ($setval === false) ? '' : $setval;
   $res = $this->ChangeOption($name, $value, $setval, $correctstring);
   if ($res === 0) { return false; }
   elseif ($res === false) { 
	$value .= ($correctstring) ? $this->CorrectSymplyString("[$name]{$setval}[/$name]") : "[$name]{$setval}[/$name]";
   }
   $value = ($correctstring) ?  $this->CorrectSymplyString($value) : $value;
   if ($online) { $this->userdata['genoptions'] = $value; }
   return $value;   	
  }//WriteOption
  
  /** удаление надстройки 
  * @name - string имя надстройки
  * @value - string если false - настройки текущего пользователя, или текст надстроек
  * 
  * @return === false или новый текст всех надстроек*/
  function DeleteOption($name, $value=false) {
   if ($name == '' || ($value !== false && $value == '') || ($value === false && !$this->IsOnline())) { return false; }
   if ($value === false) {
	$value = $this->userdata['genoptions'];
	$online = true;
   } else { $online = false; }
   $val = $this->ChangeOption($name, $value, false);
   if ($val === false || $val === 0) { return false; }
   if ($online) { $this->userdata['genoptions'] = $value; }
   return $value;   	
  }//DeleteOption
  
  /** обновление надстроек пользователя
  * @username - если false - обновление надстроек текущего пользователя или по имени
  * @options - если false и !username надстройки текущего пользоваетля или из текста
  * 
  * @return bool     
  */
  function UpdateOptions($username=false,$options=false) {
   $user_id = false;
   if ($username) {
	$us_info = $this->GetUserInfo($username);
	if (!$us_info) { return false; }
	$user_id = $us_info['iduser'];
	$user_op = ($options !== false) ? $this->CorrectSymplyString($options) : $us_info['genoptions'];	
   } else {
	if (!$this->IsOnline()) { return false; }
	$user_id = $this->userdata['iduser'];
	$user_op = ($options !== false) ? $this->CorrectSymplyString($options) : $this->userdata['genoptions'];
   }      
   if (!$user_id) { return false; }
   $this->db->mPost("UPDATE {$this->tables_list['users']} SET genoptions='$user_op' where iduser = '$user_id' limit 1");
   if (!$username && $user_op != $this->userdata['genoptions']) {
	$this->userdata['genoptions'] = $user_op;
   }     
   return true;   	
  }//UpdateOptions
  
  /** удаление аватара */
  function DeleteUserAvatar($username=false) {
   if ($username) {
	$us_info = $this->GetUserInfo($username);
	if (!$us_info) { return false; }
	$user_id = $us_info['iduser'];
	$user_op = $us_info['genoptions'];
   } else {
	if (!$this->IsOnline()) { return false; }
	$user_id = $this->userdata['iduser'];
	$user_op = $this->userdata['genoptions'];
   }
   if (!$user_id) { return false; }
   $filename = $this->ReadOption('AVATAR', $user_op);
   $val = $this->DeleteOption('AVATAR', $user_op);
   if ($val === false) { return false; }   
   //delete image file
   if ($this->UpdateOptions($username, $val)) {
   	if ($filename) {
   	 $file = W_FILESPATH.'/images/'.$filename;
     if (@file_exists($file)) { @unlink($file); }
    }
	return true;	
   }   	
   return false;
  }//DeleteAvatarPic
  
  /** создание аватарки */
  function SetUserAvatar($file_identifier, $username=false) {
   global $_AVATAR_IMAGE_TYPES_LIST;	
   if ($username) {
	$us_info = $this->GetUserInfo($username);
	if (!$us_info) { return false; }
	$user_id = $us_info['iduser'];
	$user_op = $us_info['genoptions'];
   } else {
	if (!$this->IsOnline()) { return false; }
	$user_id = $this->userdata['iduser'];
	$user_op = $this->userdata['genoptions'];
   }
   if (!$user_id) { return false; }  
   //upload image   
   $s = $this->UpLoadFile(
    $file_identifier, $_AVATAR_IMAGE_TYPES_LIST, W_MAXAVATARFILESIZE, W_FILESPATH.'/images/', 128, 128, true 
   );   
   if ($s['result'] != '') { return $s['result']; }
   $val = $this->WriteOption('AVATAR', $s['newname'], $user_op);
   if ($lval = $this->ReadOption('AVATAR', $user_op)) {
	$file = W_FILESPATH.'/images/'.$lval;
    if (@file_exists($file)) { @unlink($file); }
   }   
   if ($val === false) { return true; }   
   return $this->UpdateOptions($username, $val);   	
  }//SetUserAvatar
  
  /** получение изображения аватара пользователя */
  function GetUserAvatarInfo($username, $userinfoblock=false) {
   if (!$userinfoblock && isset($this->dump_block['avatarinfo_'.$username])) { return $this->dump_block['avatarinfo_'.$username]; }
   $userinfo = (!$userinfoblock) ? $this->GetUserInfo($username) : $userinfoblock;
   if ($userinfo && $lval = $this->ReadOption('AVATAR', $userinfo['genoptions'])) { 
   	$file = W_FILESPATH.'/images/'.$lval; 
   } else { $file = false; }
   $val_us = array(
    'sitepath' => ($file && @file_exists($file)) ? $file : false,
    'webpath'  => W_SITEPATH.'pfiles/images/'.(($lval && $file && @file_exists($file)) ? $lval : 'avatar.png')
   );
   if (!$userinfoblock) { $this->dump_block['avatarinfo_'.$username] = $val_us; } 
   return $val_us;     	
  }//GetUserAvatarInfo
 
  /** изминение параметров пользователя
  * @newinfo - array(
  *  'email'    => новый e-mail, (может отсутствовать)
  *  'url'      => новый сайт,   (может отсутствовать)
  *  'newpass'  => новый пароль, (может отсутствовать или быть пустым)
  *  'lastpass' => старый пароль (обязателен)  
  * )
  * @username - false или имя пользователя
  * 
  *  @return string     
  */
  function ModifyUserInfo($newinfo, $username=false) {
   $user_inf = ($username) ? $this->GetUserInfo($username) : $this->userdata;
   if (!$user_inf || !$user_inf['iduser']) { return $this->GetText('errorgetuserinfo'); }
   if (!isset($newinfo['lastpass'])) { return $this->GetText('paramsincorrect'); }
   $newinfo['lastpass'] = md5($newinfo['lastpass']);
   if ($newinfo['lastpass'] != $user_inf['userhash']) { return $this->GetText('passisincorrect'); } 
   //ok check data   
   $array_list = array(); 
   //mail
   if (isset($newinfo['email'])) {  
    if (!$this->validmail($newinfo['email'])) { return $this->GetText('selectmail'); }
    $newinfo['email'] = trim($this->CorrectSymplyString($newinfo['email']));   
    if ($this->strtolower($user_inf['useremail']) != $this->strtolower($newinfo['email'])) {
	 $array_list['useremail'] = $this->substr($newinfo['email'], 0, 149);	 
	 $res = $this->db->GetLineArray($this->db->mPost(
	  "select iduser from {$this->tables_list['users']} where ".	 
      "iduser <> '{$user_inf['iduser']}' and Lower(useremail) = Lower('{$array_list['useremail']}') limit 1"
	 ));
     if ($res) { return $this->GetText('emailalridyisset'); }
    }
   }
   //url
   if (isset($newinfo['url'])) {
	$newinfo['url'] = trim($this->CorrectSymplyString($newinfo['url']));
	if ($this->strtolower($user_inf['usersite']) != $this->strtolower($newinfo['url'])) {
	 $array_list['usersite'] = $this->substr($newinfo['url'], 0, 199);
    }	
   }
   //new pass
   if (isset($newinfo['newpass']) && $newinfo['newpass'] != '') {
   	//if ($newinfo['newpass'] == '') { return $this->GetText('plssetpasswnew'); }
   	$newinfo['newpass'] = md5($newinfo['newpass']);
   	if ($user_inf['userhash'] != $newinfo['newpass']) {   	
     $array_list['userhash'] = $newinfo['newpass'];
	}		
   }
   //ok check this data
   if (!$array_list) { return '2'.$this->GetText('optnochangeredy'); }
   $query = "UPDATE {$this->tables_list['users']} SET ";
   $inc = 0;
   foreach ($array_list as $name => $val) {
	$query .= ((!$inc) ? "$name='$val'" : ", $name='$val'");
	$inc++;	
   }
   $query .= " where iduser='{$user_inf['iduser']}' limit 1";
   if (!$this->db->mPost($query)) { return 'Error in update user profile ['.$this->db->GetError().']'; }
   if (isset($array_list['userhash'])) {
	$this->ExitOfAccount();
	$s = $this->EnterToAccount(array(
	 'login' => $user_inf['username'],
	 'pass'  => $array_list['userhash']
	), false);
	if ($s == '') {
	 $s = '2'.$this->GetText('optionsissavedok');	 
	 $this->GetUserInfo(); 
	}
	return $s;	
   } 
   $this->GetUserInfo();  
   return '2'.$this->GetText('optionsissavedok');   	
  }//ModifyUserInfo
  
  /** отправка сообщения пользователю */
  private function _SendMessagePrivate($touser, $toid, $from, $subj, $message) {
   if ($toid && @is_numeric($toid)) { 
   	$touser = false;
   	$toid2 = $toid;
   	$toid  = trim($this->CorrectSymplyString($toid));
   	$toid  = $this->db->GetLineArray($this->db->mPost(
	 "select idmess, touser, fromuser from {$this->tables_list['insmail']} where idmess='$toid' limit 1"
	));	
	if (!$toid) { return $this->GetText('nomessagefoundonu', array($toid2)); }     
   } else {
   	$touser2 = $touser;	
   	$touser  = ($touser) ? $this->GetUserInfo($touser) : false;
	if (!$touser) { return $this->GetText('nouserfoundbe', array($touser2)); }   	    
   }
   $query = "INSERT INTO {$this->tables_list['insmail']} SET ";
   if ($toid) {
   	$from2  = ($from == $toid['fromuser']) ? $toid['touser'] : $toid['fromuser']; 
	$query .= "touser='$from2', idansw='{$toid['idmess']}', fromuser='$from', readable='1', ";
	$touser = $this->GetUserInfo($from2);
   } elseif ($touser) { 
	$query .= "touser='{$touser['username']}', fromuser='$from', ";	
   } else { return $this->GetText('noinfoforsendmess'); }
   $query .= "dateadd='".$this->GetThisDateTime()."', datasource='$message', subject='$subj'";
   if (!$this->db->mPost($query)) {	return $this->GetText('Error in save new message! ['.$this->db->GetError().']'); } 
   $message = $this->GetText('newmessageonypuraccount', array(
    $touser['username'], $from, (($toid) ? "{$toid['idmess']}/" : ""), $subj, $this->GetThisDate()
   )); 
   $this->DoMailX($touser['useremail'], $this->GetText('newmessagesubg', array(W_HOSTMYSITE, $from)), $message);
   if ($toid) {
	$this->db->mPost(
	 "UPDATE {$this->tables_list['insmail']} SET readable='0' where readable='1' and idmess='{$toid['idmess']}' limit 1"	
	);	
   }   
   return '';   	
  }//_SendMessagePrivate
  
  /** отправка нового сообщения пользователю, ответ на сообщение
  * @info - array(
  *  'subj' => тема сообщения,
  *  'to'   => список получателей (через ;),
  *  'toid' => ответ на идентификатор сообщения,
  *  'from' => имя пользователя от кого сообщения,
  *  'body' => текст сообщения   
  * )  
  */
  function DoSendNewPrivateMessage($info) {
   if (!$info) { return $this->GetText('noinfoforsendmess'); }
   $info['from'] = (!isset($info['from']) && $this->IsOnline()) ? $this->userdata['username'] : $info['from'];
   if (!$info['from']) { return $this->GetText('noinfoforsendmess'); }
   $info['subj'] = (isset($info['subj'])) ? $this->CorrectSymplyString($info['subj']) : $this->GetText('nosubjectmess');
   $info['body'] = $this->strings->CorrectTextToDB($info['body']);
   if (isset($info['toid']) && @is_numeric($info['toid']) && isset($info['to'])) {
	unset($info['to']);
   }
   if (!isset($info['to']) && !isset($info['toid'])) { return $this->GetText('noinfoforsendmess'); }
   if (isset($info['toid'])) { 
   	if ($this->substr($info['subj'], 0, 3) != 'Re:') { $info['subj'] = 'Re: '.$info['subj']; }
   	return $this->_SendMessagePrivate(false, $info['toid'], $info['from'], $info['subj'], $info['body']); 
   }
   $users_list = @explode(';', $this->strtolower($info['to']), W_MAXUSERSCOUNTTOPRIVATESEND);
   $users_list = @array_unique($users_list);
   $incer = 0;
   foreach ($users_list as $user) {
	$user = trim($this->CorrectSymplyString($user));
	$str  = $this->_SendMessagePrivate($user, false, $info['from'], $info['subj'], $info['body']);
	if (!$str) { $incer++; } //else { return $str; }	
   }//foreach
   if ($incer == 0) { return $this->GetText('nomessagessended'); }
   return $incer; 	
  }//DoSendNewPrivateMessage
  
  /** получение количества непрочитанных сообщений */
  function GetUnreadMessagesCount($username=false) {   		
   $username = ($username) ? $this->GetUserInfo($username) : $this->userdata;
   if (!$username) { return 0; }
   $res = $this->db->GetLineArray($this->db->mPost( 
    "select count(idmess) as countids from {$this->tables_list['insmail']} where ".
    "touser='{$username['username']}' and readable='0' and idansw='0'"
   ));
   return (!$res) ? 0 : ((@is_numeric($res['countids']) && $res['countids']) ? $res['countids'] : 0);	
  }//GetUnreadMessagesCount
  
  /** получение количества сообщений всего */
  function GetMyMessagesCount($username=false) {   		
   $username = ($username) ? $this->GetUserInfo($username) : $this->userdata;
   if (!$username) { return 0; }
   $res = $this->db->GetLineArray($this->db->mPost( 
    "select count(idmess) as countids from {$this->tables_list['insmail']} where touser='{$username['username']}' ".
	"and idansw='0'"	
   ));   
   return (!$res) ? 0 : ((@is_numeric($res['countids']) && $res['countids']) ? $res['countids'] : 0);	
  }//GetUnreadMessagesCount
  
  /** получение количества сообщений отправленных */
  function GetMySendMessagesCount($username=false) {   		
   $username = ($username) ? $this->GetUserInfo($username) : $this->userdata;
   if (!$username) { return 0; }
   $res = $this->db->GetLineArray($this->db->mPost( 
    "select count(idmess) as countids from {$this->tables_list['insmail']} where ".
	"fromuser='{$username['username']}' and idansw='0'"
   ));
   return (!$res) ? 0 : ((@is_numeric($res['countids']) && $res['countids']) ? $res['countids'] : 0);	
  }//GetUnreadMessagesCount
  
  /** получение количества ответов на сообщение */
  function GetAnsversCountByMessage($messid) {
   $messid = $this->CorrectSymplyString($messid);
   if (!$messid) { return 0; }
   $res = $this->db->GetLineArray($this->db->mPost( 
    "select count(idmess) as countids from {$this->tables_list['insmail']} where idansw='$messid'"
   ));
   return (!$res) ? 0 : ((@is_numeric($res['countids']) && $res['countids']) ? $res['countids'] : 0);	
  }//GetAnsversCountByMessage
  
  /** перечисление средств рефералу */
  protected function MoneyProcessToReferal($sum) {
   if (!W_REFERPERSENTOFTRANSACTION || W_REFERPERSENTOFTRANSACTION < 0) { return false; }   	
   $identify = $this->GetSessionIdentify('referer');	
   if (
    !$this->IsOnline() || $this->isadminstatus || !isset($_COOKIE[$identify]) || 
	!$_COOKIE[$identify] || !@is_numeric($_COOKIE[$identify])
   ) { return false; }
   $userinfo = $this->GetUserInfo($_COOKIE[$identify], true);
   if (!$userinfo || $userinfo['iduser'] == $this->userdata['iduser']) { return false; }
   $persent_sum = round(($sum / 100) * W_REFERPERSENTOFTRANSACTION, 2);
   if ($persent_sum < 0) { return false; }
   return ($this->MoneyProcess(
    $userinfo, $this->GetText('getmoneyfromrefer', array($this->userdata['username'])),
    $userinfo['iduser'], $persent_sum, true
   ) == '');   	
  }//MoneyProcessToReferal
  
  /** операции с счетом пользователя
  * @username string or array (имя пользователя, или информация о пользователе)
  * @transaction_n int - счет оплаты
  * @sum numeric - сумма
  * @isrefer bool - реферальные зачисления
  * @metchod string - 
  *  add - добавить
  *  sub - убрать
  *  set - установить
  * @domessages bool - отправлять уведомления на почты
  * @ignz bool - игнорировать смещение баланса к нудю (если админ)
  * 
  * @return '' or error  
  */
  function MoneyProcess($username, $description, $transaction_n=0, $sum=0.00, $isrefer=false, 
  $metchod='add', $domessages=true, $ignz=false) {
   if (!$username) { return $this->GetText('errorgetuserinfo'); }
   if (!@is_numeric($sum)) { return $this->GetText('errorpaycheckpar'); }   
   $username = (@is_array($username)) ? $username : (($this->IsOnline() && $this->userdata['username'] == $username) ?
   $this->userdata : $this->GetUserInfo($username));
   if (!$username) { return $this->GetText('errorgetuserinfo'); }
   switch ($metchod) {
   	//добавление средств
	case 'add':
	 $username['purcedata']+=$sum;
	 if ($domessages) {
	  $subject = $this->GetText('addmoneytouser', array($username['username'], $sum));
	  $message = $this->GetText('addmoneytouser_message', array($username['username'], $sum, $description));
	  $message_admin = $this->GetText('addmoneytouser_message_admin', array(
	   $username['username'], $sum, $description, $username['purcedata']
	  ));	  
	 }	 
	break;
	//снятие средств
	case 'sub':
	 if (!$ignz || !$this->IsOnline() || !$this->isadminstatus) {
	  if ($username['purcedata'] - $sum < 0) { return $this->GetText('nomoneyforaction'); }
	 }	
	 $username['purcedata']-=$sum;
	 if ($username['purcedata'] < 0) { $username['purcedata'] = 0.00; }
	 if ($domessages) {
	  $subject = $this->GetText('submoneytouser', array($username['username'], $sum));
	  $message = $this->GetText('submoneytouser_message', array($username['username'], $sum, $description));
	  $message_admin = $this->GetText('submoneytouser_message_admin', array(
	   $username['username'], $sum, $description, $username['purcedata']
	  ));	  
	 }	 	 
	break;
	//установка средств
	case 'set':	 	
	 $username['purcedata'] = $sum;
	 if ($domessages) {
	  $subject = $this->GetText('setmoneytouser', array($username['username'], $sum));
	  $message = $this->GetText('setmoneytouser_message', array($username['username'], $sum, $description));
	  $message_admin = $this->GetText('setmoneytouser_message_admin', array(
	   $username['username'], $sum, $description, $username['purcedata']
	  ));
	 }	 
	break;
	default: return $this->GetText('errorpaycheckpar');	
   }
   if ($this->IsOnline() && $this->userdata['username'] == $username['username']) {
	$this->userdata = $username;
   }
   if (!$this->db->mPost(
    "UPDATE {$this->tables_list['users']} SET purcedata='{$username['purcedata']}' where ".
    "iduser='{$username['iduser']}' and userhash='{$username['userhash']}' limit 1"
   )) { return 'Error update user info (money set)'; }
   $description = $this->CorrectSymplyString($description);
   //transactions   
   $this->db->mPost(
    "INSERT INTO {$this->tables_list['moneyhis']} SET sumdata='$sum', opertype='$metchod', ".
    "datedata='".$this->GetThisDateTime()."', username='{$username['username']}', descript='$description', ".
    "specidtran='$transaction_n'".(($isrefer) ? ", isrefer='1'" : '')
   );
   /* проверка отдачи рефералу */
   if ($metchod == 'sub' && !$isrefer) { $this->MoneyProcessToReferal($sum); }
   //inform   
   if ($domessages) {
    //send messages to user
    $this->DoMailX($username['useremail'], $subject, $message);
    //send messages to admin
    $this->DoMailX(W_ADMINEMAIL, $subject, $message_admin);
   }
   return '';   	
  }//MoneyProcess
  
  /** получение количества элементов таблици */
  function GetCountInTable($messidname='idmess', $tablename='insmail', $where='') {
   $res = $this->db->GetLineArray($this->db->mPost( 
    "select count($messidname) as countids from ".$this->tables_list[$tablename].(($where) ? " $where" : '')
   ));
   return (!$res) ? 0 : ((@is_numeric($res['countids']) && $res['countids']) ? $res['countids'] : 0);	
  }//GetCountInTable
  
  /** количество финансовых операций */
  function GetFinanceTransactionsCount($username=false, $isrefer=false) {
   $username = ($username) ? $this->GetUserInfo($username) : $this->userdata;
   if (!$username) { return 0; }
   return $this->GetCountInTable('iditem', 'moneyhis', 
    "where username='{$username['username']}'".(($isrefer) ? " and isrefer='1'" : '')
   );   	
  }//GetFinanceTransactionsCount
  
  /** сумма от всех рефераллов */
  function GetReferalSum($username=false) {
   $username = ($username) ? $this->GetUserInfo($username) : $this->userdata;
   if (!$username) { return 0.00; }
   $res = $this->db->GetLineArray($this->db->mPost(
    "select sum(sumdata) as resdata from {$this->tables_list['moneyhis']} where ".
    "username='{$username['username']}' and isrefer='1'"
   ));
   return (!$res) ? 0.00 : ((@is_numeric($res['resdata']) && $res['resdata']) ? $res['resdata'] : 0.00);   	
  }//GetReferalSum
  
  /** корректировка сайта для отображения */
  function GetCorrectUserSite($username=false) {
   $username = (!$username) ? $this->userdata : ((@is_array($username)) ? $username : 
   (($this->IsOnline() && $this->userdata['username'] == $username) ? $this->userdata : $this->GetUserInfo($username)));
   if (!$username['usersite']) { return ''; } 
   $P = @parse_url($username['usersite']);
   return ((isset($P['scheme'])) ? '' : 'http://').$username['usersite'];
  }//GetCorrectUserSite
  
  /** устанвока куков реферала для текущего посетителя */
  function InitializeReferalCookies($touserid) {  	
   if (!$touserid || !@is_numeric($touserid)) { return false; }
   $identify = $this->GetSessionIdentify('referer');   
   $userinfo = false;
   if (!W_REFERCANCHANGEHOST && isset($_COOKIE[$identify]) && $_COOKIE[$identify] && @is_numeric($_COOKIE[$identify])) {
	$userinfo = $this->GetUserInfo($_COOKIE[$identify], true);
	if ($userinfo) { return false; }	
   }
   if ((!W_REFERCANBEAUTORIZED && $this->IsOnline()) || ($this->IsOnline() && $this->isadminstatus)) { return false; }
   //ok далее   
   $userinfo = (!$userinfo) ? $this->GetUserInfo($touserid, true) : $userinfo;
   //ok set
   if (!$userinfo || ($this->IsOnline() && $this->userdata['iduser'] == $userinfo['iduser'])) { return false; }
   if (!$this->setcookies('referer', $userinfo['iduser'], W_REFERLIFETIMEPERIOD)) { return false; }
   //ok refresh
   if (W_REFERTABLEREFRESHEVERY > 0) {
	$this->db->mPost(
    "delete from {$this->tables_list['refersl']} where DATEDIFF(NOW(),DATE(dateadd)) > ".W_REFERTABLEREFRESHEVERY
    );
   }   
   //ok exists
   if ($this->db->GetLineArray($this->db->mPost(
    "select iditem from {$this->tables_list['refersl']} where touserid='{$userinfo['iduser']}' limit 1"
   ))) { return true; }   
   //ok save   
   $this->db->mPost(
    "INSERT INTO {$this->tables_list['refersl']} SET touserid='{$userinfo['iduser']}', dateadd='".
	$this->GetThisDateTime()."'"
   );  
   return true;   	
  }//InitializeReferalCookies
  
  /** количество рефералов пользователя */
  function GetUserRefersCount($userid=false) {
   if (!$userid) {
    if (!$this->IsOnline()) { return 0; }
	$userid = $this->userdata['iduser'];	
   } else {
	$userid = $this->CorrectSymplyString($userid);
   }   
   return $this->GetCountInTable('iditem', 'refersl', "where touserid='$userid'");	
  }//GetUserRefersCount
  
  /** разность между датами */
  function DateDiff($interval, $date1, $date2, $time_data = 0) {	
   if ($time_data > 0) { $timedifference = $time_data; } else { $timedifference = $date2 - $date1; }
   switch ($interval) {   	  	
   	case 'y':  $retval = bcdiv($timedifference, 86400*364, 0); break; //год
   	case 'm':  $retval = bcdiv($timedifference, 604800*4, 0); break; //месяц
    case 'w':  $retval = bcdiv($timedifference, 604800, 0); break; //неделя
    case 'd':  $retval = bcdiv($timedifference, 86400, 0); break; //день
    case 'h':  $retval = bcdiv($timedifference, 3600, 0); break; //час
    case 'n':  $retval = bcdiv($timedifference, 60, 0); break; //мин
    case 's':  $retval = $timedifference; break; //сек
   }
   return $retval;
  }//DateDiff
  
  /** число даты из строки Y-m-d H:i:s или Y-m-d */
  function GetIntDateFromStr($str=false, $withTime=false, $timeData='00:00:00') {
   if (!$str) { $str = $this->GetThisDate(); }	
   $date_list = explode(' ', $str, 2);
   if (!$date_list) { $date_list = array($this->GetThisDate()); }
   if (!isset($date_list[1])) { $date_list[] = $timeData; } elseif (!$withTime) {
	$date_list[1] = $timeData;
   }   
   $d = explode('-', $date_list[0]);
   $t = explode(':', $date_list[1]);
   if (!$d || !$t) { return -1; }   
   return mktime($t[0], $t[1], $t[2], $d[1], $d[2], $d[0]); 
  }//GetIntDateFromStr
  
  /** разница дат в днях */
  function GetDateDiff($date1, $date2) {
   $date1 = (!$date1) ? $this->GetThisDate() : $date1;
   $date2 = (!$date2) ? $this->GetThisDate() : $date2;
   return $this->DateDiff('d', $this->GetIntDateFromStr($date1), $this->GetIntDateFromStr($date2));   	
  }//GetDateDiff
  
  /** корректировка отстования в днях */
  function GetLastIntervalInDays($date1, $date2=false) {
   $diff = $this->GetDateDiff($date1, $date2);
   switch ($diff) {
	case '':
	case '0': return $this->GetText('istodaynowstr');
	case '1': return $this->GetText('isyestodaynowstr');
	case '2': return $this->GetText('isafteryestodaystr');
	default: return $this->GetText('dayslastperiod', array($diff));
   }   	
  }//GetLastIntervalInDays
  
  /** добалвение инвайт кодов
  * @info - array(
  *  'count' => количество создаваемых кодов
  *  'price' => сумма для зачисления на счет
  *  'index' => включить индексацию сайта пользователя
  *  'type'  => 0,1,2  
  * )  
  */
  function AddNewInviteCodes($info) {
   if (!$this->IsOnline() || !$this->isadminstatus) { return $this->GetText('adnnoadminuseris'); }
   //ok check params
   if (
    !isset($info['count']) || !$info['count'] || !@is_integer($info['count'] + 0) || $info['count'] < 0 || $info['count'] > 50
   ) { return $this->GetText('errorpaycheckpar'); }
   //ok reset params
   if (!isset($info['price']) || !@is_float($info['price'] + 0.00) || $info['price'] <= 0) { $info['price'] = 0.00; }   
   $info['opt'] = '';
   if (isset($info['index']) && $info['index']) { $info['opt'] .= '[INDEXSITE]1[/INDEXSITE]'; }
   $info['opt'] = $this->CorrectSymplyString($info['opt']);
   
   if (!$info['type'] || !@is_numeric($info['type'])) {
     $info['type'] = '0';
   }
    
   //ok action
   for ($i=1; $i<=$info['count']; $i++) {
	$inv_code = md5(
	 $i.$info['opt'].($date = $this->GetThisDateTime()).$this->generate_password(5).rand(0,600).$info['price'].
	 $info['count'].(($i > 1) ? $this->db->InseredIndex() : ' ')
	);
	$this->db->mPost(
	 "INSERT INTO {$this->tables_list['invites']} SET dateadd='$date', ".
     "invcode='$inv_code', sumdata='{$info['price']}', invopt='{$info['opt']}', invtype='{$info['type']}'"
	);	
   }
   return '1';   	
  }//AddNewInviteCodes 
  
  /** добавление апдейта 
  * @info - array(
  *  'to'   => int (from 1 - to 4)
  *  'date' => string дата или false для текущей даты
  * ) 
  */
  function AddNewEngineUpdate($info) {
   if (!$this->IsOnline() || !$this->isadminstatus) { return $this->GetText('adnnoadminuseris'); }
   if (!isset($info['to']) || !@is_integer($info['to'] + 0) || $info['to'] <= 0 || $info['to'] > 4) {
    return $this->GetText('errorpaycheckpar');	
   }
   $info['date'] = (!$info['date']) ? $this->GetThisDate() : $this->CorrectSymplyString($info['date']);
   $info['to']   = $this->CorrectSymplyString($info['to']);
   $d = explode('-', $info['date'], 3);
   if (
    !$d || count($d) < 3 || !@is_integer($d[0] + 0) || $d[0] <= 0 || $d[0] > date('Y') ||
    !@is_integer($d[1] + 0) || $d[1] <= 0 || $d[1] > 12 ||
    !@is_integer($d[2] + 0) || $d[2] <= 0 || $d[2] > 31    
   ) { return $this->GetText('errorpaycheckpar'); }
   $info['date'] = "{$d[0]}-{$d[1]}-{$d[2]}";   
   if ($this->db->GetLineArray($this->db->mPost(
    "select iditem from {$this->tables_list['updates']} where dateupd='{$info['date']}' and engtype='{$info['to']}' limit 1"
   ))) { return $this->GetText('dateupdateisexists', array($info['date'])); }
   if (!$this->db->mPost(
    "INSERT INTO {$this->tables_list['updates']} SET dateupd='{$info['date']}', engtype='{$info['to']}'"
   )) { return 'Can`t add updates item!'; }
   return '1';	
  }//AddNewEngineUpdate
  
  /** получение описания апдейта */
  function GetEngineUpdateDescription($id_type) {
   switch ($id_type) { 
	case '1':
	case '2':
	case '3':
	case '4': return $this->GetText('getupdatesdesc'.$id_type);
	default: return 'Unknow type!';
   }	
  }//GetEngineUpdateDescription
  
  /** добавление апдейта
  * @info - array(
  *  'to'   => от 0 до 4
  *  'date' => дата
  * )  
  */
  protected function AddNewEngineUpdateItem($info, $returnonlydate=false) {
   if (!isset($info['date']) || !$info['date']) { return false; }
   $info['date'] = explode(' ', $info['date'], 2);
   $info['date'] = $info['date'][0];
   if (!$info['date']) { return false; } 
   $d = explode('.', $info['date'], 3);
   if (
    !$d || count($d) < 3 || !@is_integer($d[2] + 0) || $d[2] <= 0 || $d[2] > date('Y') ||
    !@is_integer($d[1] + 0) || $d[1] <= 0 || $d[1] > 12 ||
    !@is_integer($d[0] + 0) || $d[0] <= 0 || $d[0] > 31    
   ) { return false; }
   $info['date'] = "{$d[2]}-{$d[1]}-{$d[0]}"; 
   if ($returnonlydate) { return $info['date']; }
   //check exists
   if ($this->db->GetLineArray($this->db->mPost(
    "select iditem from {$this->tables_list['updates']} where dateupd='{$info['date']}' and engtype='{$info['to']}' limit 1"
   ))) { return $info['date']; }
   //add   	      		
   $this->db->mPost(
    "INSERT INTO {$this->tables_list['updates']} SET dateupd='{$info['date']}', engtype='{$info['to']}'"
   );
   return $info['date'];
  }//AddNewEngineUpdate
  
  /** получение апдейтов поисковиков
  * @return - array(
  *  '1' => cy
  *  '2' => ya search
  *  '3' => yaca
  *  '4' => pr   
  * )  
  */
  function GetEngineUpdatesInfo() {
   global $FWM_UPDATES_CHECK_TIMES_DATA; 
   if (isset($this->dump_block['updates_now_session'])) return $this->dump_block['updates_now_session']; 
   $info_list = array('1' => '', '2' => '', '3' => '', '4' => '');  
   
   $d_info = array(  
    'Y' => @date('Y'),
    'm' => @date('m'),
    'd' => @date('d'),
    'H' => @date('H'),
    'i' => @date('i')   
   );   
   $now_time = @mktime($d_info['H'], $d_info['i'], 0, $d_info['m'], $d_info['d'], $d_info['Y']);
   
   //даты обновления апдейтов (hour = час, minute = минута)
   $update_times = (isset($FWM_UPDATES_CHECK_TIMES_DATA)) ? $FWM_UPDATES_CHECK_TIMES_DATA : array(
     
     //первая проверка в 2.30 ночи
     array(
      'hour'   => 02,
      'minute' => 40
     ),
     
     //вторая проверки 12.45 в обед
     array(
      'hour'   => 12,
      'minute' => 45      
     
     )
   
   );
   
   $res = $this->db->GetLineArray($this->db->mPost(
    "select iditem, dateupd from {$this->tables_list['updates']} where engtype = '0' limit 1"
   )); 
   
   $do_update = false; 
   if ($res) {
    
    //update old check method
    if (!@is_numeric($res['dateupd']) || !$res['dateupd']) {       
     $res['dateupd'] = $this->GetIntDateFromStr($res['dateupd'], true, '00:01:00');        
    } 
    
    $t = $this->DateDiff('n', '', '', $now_time - $res['dateupd']);     
    //check for can update dates, if pass more then 5 minutes
    if ($t > 5) {
     foreach ($update_times as $item) {
      if ($do_update) { break; } 
     
      $t = @mktime($item['hour'], $item['minute'], 0, $d_info['m'], $d_info['d'], $d_info['Y']); 
      if ($now_time < $t) {
      
       $t = $this->DateDiff('n', '', '', $t - $now_time);  
       if ($t <= 5 && $t >= 0) {
        
         $do_update = true;
         break;
                 
       }        
        
      }          
        
     }
    }// $t > 5 
    
   } else { $do_update = true; } 
   
   //if ($res) { $do_update = $res['dateupd'] != $this->GetThisDate(); } else { $do_update = true; }      
   if ($do_update) {  
    $this->db->mPost(($res) ? 
	 "UPDATE {$this->tables_list['updates']} SET dateupd='".$now_time.
	 "' where iditem='{$res['iditem']}' and engtype='0' limit 1" :
     "INSERT INTO {$this->tables_list['updates']} SET dateupd='".$now_time."', engtype='0'"
    );
    $connect = new ss_HTTP_obj();
    $connect->connect_mime_types = array();
    $source = ($connect->RequestPOST('http://seobudget.ru/downloads/updates.xml')) ? $connect->GetData() : '';        
    unset($connect);	
	$source = @simplexml_load_string(ltrim($source));    
    $ok4 = (@defined('W_AUTOCREATEPRUPDATESLIST') && @constant('W_AUTOCREATEPRUPDATESLIST'));
    if ($source) {	
	 $info_list['1'] = @$source->update[0]->date[0];
     $info_list['2'] = @$source->update[1]->date[0];
     $info_list['3'] = @$source->update[2]->date[0];
     if ($ok4) { $info_list['4'] = @$source->update[3]->date[0]; }
    } 
	foreach ($info_list as $ident => &$value) {
	 if ($ident == '4' && !$ok4) { continue; }  
	 if ($value) { $value = $this->AddNewEngineUpdateItem(array('to'=>$ident, 'date'=>$value)); }	
	}	    
   }
   foreach ($info_list as $ident => &$value) {
	if (!$value) {
	 $res = $this->db->GetLineArray($this->db->mPost(
      "select dateupd from {$this->tables_list['updates']} where engtype='$ident' order by dateupd DESC limit 1"
     ));
	 if ($res) { $value = $res['dateupd']; }	 	
	}
	$value2 = array(
	 'value'          => $value,
	 'value_original' => $value
	);
    $value = $value2;	    
	$value['value'] = ($value['value']) ? $this->DateToSpecialFormat($value['value'], W_ADMENGINEUPDATESFORMATVIEW) : '';
	$value['bold']  = ($value['value'] && $this->GetThisDate() == $value['value_original']) ? 1 : 0;			 	
   }
   $this->dump_block['updates_now_session'] = $info_list;
   return $info_list;   	
  }//GetEngineUpdatesInfo
  
  function GetEngineUpdatesInfoDateOnly() {
   $data  = $this->GetEngineUpdatesInfo(); 
   $data2 = array();   
   foreach ($data as $name => $value) {
    if (!$value) { $value2 = '?'; } 
    elseif (@is_array($value) && $value['value']) {
     $value2 = $value['value'];   
    } else {
      $value2 = '?';   
    }
    $data2[$name] = $value2; 
   }   
   return $data2;    
  }//GetEngineUpdatesInfoDateOnly
  
  /** корректирвока даты под формат
  * @date - string = дата в формате YYYY-mm-dd или false для текущией даты
  * @format - string = формат вывода даты    
  */
  function DateToSpecialFormat($date=false, $format=W_DATEDEFAULTFORMAT, $nogettext=false) {
   if (!$nogettext) { $format = $this->GetText($format); }	
   $s  = ($date) ? $date : $this->GetThisDate();
   $s1 = $this->StrFetch($s, ' '); 		
   $d = @explode('-', ($s1) ? $s1 : $this->GetThisDate(), 3);   
   if (
    !$d || count($d) < 3 || !@is_integer($d[0] + 0) || $d[0] <= 0 ||
    !@is_integer($d[1] + 0) || $d[1] <= 0 || $d[1] > 12 ||
    !@is_integer($d[2] + 0) || $d[2] <= 0 || $d[2] > 31    
   ) { return $date; }
   $format = @str_replace('dd', $d[2], $format);
   $format = @str_replace('mm', $d[1], $format);
   $format = @str_replace('YYYY', $d[0], $format);
   return $format;	
  }//DateToSpecialFormat
  
  /** корректировка даты и времени в указанный формат */
  function DateTimeToSpecialFormat($datetime=false, $format=W_DATETIMEDEFAULTFORMAT) {
   $format = $this->GetText($format);   	
   $datetime2 = (!$datetime) ? $this->GetThisDateTime() : $datetime;
   $date = $this->StrFetch($datetime2, ' ');
   $date = (!$date) ? $this->GetThisDate() : $date;
   $format = $this->DateToSpecialFormat($date, $format, true);
   if (!$datetime2) { return $format; }   
   $t = @explode(':', $datetime2, 3);
   foreach ($t as &$value) { if ($value < 0 || $value > 60) { $value = 0; } }
   $format = @str_replace('hh', $t[0], $format);
   $format = @str_replace('ii', $t[1], $format);
   $format = @str_replace('ss', $t[2], $format);
   return $format;
  }//DateTimeToSpecialFormat
  
  /** определение текущего браузера */
  function GetUserAgent() {  
   $str = getenv('HTTP_USER_AGENT');  
   if ($this->strpos($str,"Avant Browser",0)!==false) { return "Avant Browser"; } 
   elseif ($this->strpos($str,"Acoo Browser",0)!==false) { return "Acoo Browser"; } 
   elseif (preg_match("/Iron\/([0-9a-z\.]*)/i",$str,$pocket)) { return "SRWare Iron ".$pocket[1]; } 
   elseif (preg_match("/Chrome\/([0-9a-z\.]*)/i",$str,$pocket)) { return "Google Chrome ".$pocket[1]; } 
   elseif (preg_match("/(Maxthon|NetCaptor)( [0-9a-z\.]*)?/i",$str,$pocket)) { return $pocket[1].$pocket[2]; } 
   elseif ($this->strpos($str,"MyIE2",0)!==false) { return "MyIE2"; } 
   elseif (preg_match("/(NetFront|K-Meleon|Netscape|Galeon|Epiphany|Konqueror|". 
          "Safari|Opera Mini)\/([0-9a-z\.]*)/i",$str,$pocket)) { return $pocket[1]." ".$pocket[2]; } 
   elseif (preg_match("/Opera[\/ ]([0-9a-z\.]*)/i",$str,$pocket)) { return "Opera ".$pocket[1]; } 
   elseif (preg_match("/Orca\/([ 0-9a-z\.]*)/i",$str,$pocket)) { return "Orca Browser ".$pocket[1]; } 
   elseif (preg_match("/(SeaMonkey|Firefox|GranParadiso|Minefield|". 
          "Shiretoko)\/([0-9a-z\.]*)/i",$str,$pocket)) { return "Mozilla ".$pocket[1]." ".$pocket[2]; } 
   elseif (preg_match("/rv:([0-9a-z\.]*)/i",$str,$pocket) && $this->strpos($str,"Mozilla/",0)!==false) { return "Mozilla ".$pocket[1]; } 
   elseif (preg_match("/Lynx\/([0-9a-z\.]*)/i",$str,$pocket)) { return "Lynx ".$pocket[1]; } 
   elseif (preg_match("/MSIE ([0-9a-z\.]*)/i",$str,$pocket)) { return "Internet Explorer ".$pocket[1]; } 
   else { return "Unknown"; } 
  }//GetUserAgent
  
  /** получение шрифта
  * @fontid - int идентификатор шрифта, если false или 0 - стандартный шрифт Arial
  * @return array(
  *  'iditem'    => идентификатор шрифта
  *  'datecreat' => дата загрузки шрифта
  *  'fontname'  => имя файла шрифта (оригинальное имя)
  *  'fontsize'  => размер шрифта в байтах
  *  'dwname'    => имя файла шрифта после загрузки (уникальное)
  *  'fontuse'   => флаг использования шрифта (0 или 1)
  *  'filename'  => полное имя файла до файла     
  * ) 
  */
  function GetFont($fontid=false, $onlyActive=false) {
   $fontid = ($fontid !== false) ? $this->CorrectSymplyString($fontid) : false;
   //шрифт из базы
   if ($fontid) {
   	$res = $this->db->GetLineArray($this->db->GetTable(
     $this->tables_list['fontslist'], "iditem='$fontid'", "1"
    ));
    //шрифт загруженный
    if ($res) {
	 if ($onlyActive && !$res['fontuse']) { return false; }
	 //взять шрифт	 
	 $res['filename'] = W_FONTSFILESPATH.'/'.$res['dwname']; 
	 if (@file_exists($res['filename'])) { return $res; } 
	}	
   }
   //шрифт по умолчанию
   $filename = W_SITEDIR.'/slib/files/fonts/arial.ttf';
   return (!@file_exists($filename)) ? false : array(
    'iditem'    => 0,
    'datecreat' => '',
    'fontname'  => 'arial.ttf',
    'fontsize'  => 0,
    'dwname'    => 'arial.ttf',
    'fontuse'   => 1,
    'filename'  => $filename
   );   	
  }//GetFont
  
  /** получить список шрифтов */
  function GetFontList($onlyActive=true) {
   $table = $this->db->GetTable($this->tables_list['fontslist'], (!$onlyActive) ? '' : "fontuse='1'");
   $result = array();
   while ($row = $this->db->GetLineArray($table)) {
	$row['filename'] = W_FONTSFILESPATH.'/'.$row['dwname'];
	if (@file_exists($row['filename'])) {
	 $result[] = $row;	 	
	}	
   }
   return $result;   	
  }//GetFontList
  
  /** запись заголовков для скачивания файла */
  function WriteDownLoadFileHeader($name, $bytes) {
   Header("Pragma: no-cache"); 
   Header("Cache-control: no-cache, must-revalidate"); 
   Header("Expires: Mon, 01 Jan 1990 01:01:01 GMT"); 
   Header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");
   header('Content-Type: application/octetstream');
   header("Accept-Ranges: bytes");
   header("Content-Length: ".$bytes); 
   header('Content-Disposition: attachment; filename="'.$name.'";');   	
  }//WriteDownLoadFileHeader
  
  /** проверка и запись\ обновление единичной проверки данных
  * @identifier - int идентификатор операции
  * @time_minute - int будет доступ, если прошло >= $time_minute минут, если 0 - доступа не будет никогда
  * 
  * @return bool (true - можно выполнить, false - нет)    
  */
  function CheckForCanActionOperation($identifier, $time_minute) {
   if (!$time_minute || $time_minute < 0) { return false; }	
   $data = $this->db->GetLineArray($this->db->mPost(
    "select *, TIME_TO_SEC(TIMEDIFF(NOW(), `dateitem`)) / 60 AS `lastmin` from {$this->tables_list['updtblws']}".
    " where identifier='$identifier' limit 1"
   ));
   if (!$data) {
	$this->db->INSERTAction('updtblws', array('dateitem' => $this->GetThisDateTime(), 'identifier' => $identifier));
	return true;
   }
   if ($data['lastmin'] >= $time_minute) {
	$this->db->UPDATEAction('updtblws', array('dateitem' => $this->GetThisDateTime()), "identifier='$identifier'", "1");
	return true;	
   }
   return false;   	
  }//CheckForCanActionOperation
   
  /** получение данных о изображении инструмента */
  function GetToolImageRecord($toolid, $skin=false) {
   if (!$toolid = $this->CorrectSymplyString($toolid)) { return false; }    
   $skin = (!$skin) ? $this->GetActiveSkin() : $skin;
   $item = $this->db->GetLineArray($this->db->mPost(
    "select * from {$this->tables_list['toolimglst']} where skin='$skin' and toolid='$toolid' limit 1"
   ));
   return (!$item) ? false : $item;
  }//GetToolImageRecord
  
  /** получение изображения инфтрумента */
  function GetToolImageStyle($toolident, $imgType=16, $st='background: transparent url(', $fn=') no-repeat left top') {
   //get from bd
   if (isset($this->dump_block['toolimage_'.$toolident])) {
    $image = $this->dump_block['toolimage_'.$toolident];    
   } else {
    $image = $this->dump_block['toolimage_'.$toolident] = $this->GetToolImageRecord($toolident);
   }
   if ($image) {  
    //16
    if ($imgType == 16 && $image['image16'] && @file_exists(W_FILESPATH.'/images/'.$image['image16'])) {            
      return $st.W_SITEPATH.W_FILESWEBPATH.'/images/'.$image['image16'].$fn;
    } 
    //64
    elseif ($imgType == 128 && $image['image64'] && @file_exists(W_FILESPATH.'/images/'.$image['image64'])) {            
      return $st.W_SITEPATH.W_FILESWEBPATH.'/images/'.$image['image64'].$fn;
    }        
   }    
   //get by default 
   $img_p = 'img/ico/general/'.(($this->GetActiveSkin()) ? ($this->GetActiveSkin().'/') : '');	
   $filename = ($toolident) ? ($toolident.$imgType.'.png') : false;
   $filename = ($filename) ? ($img_p.(($imgType == 16) ? 'tool_mini/' : '').$filename) : false;
   $ch_ff = ($filename) ? ( W_SITEDIR.'/'.$filename) : false;
   $filename = ($ch_ff && @file_exists($ch_ff)) ? W_SITEPATH.$filename : 
   W_SITEPATH.$img_p.(($imgType == 16) ? 'def16' : 'def128').'.png'; 
   return $st.$filename.$fn;   	
  }//GetToolImage
  
  /** получение списка наиболее популярных инструментов */
  function GetFeaturedToolsList($limit=10) {
   if (isset($this->dump_block['featuredtools'])) { return $this->dump_block['featuredtools']; }
   $this->dump_block['featuredtools'] = array();
   $result = $this->db->mPost("select * from {$this->tables_list['featutool']} order by tcount DESC limit $limit");
   while ($row = $this->db->GetLineArray($result)) { $this->dump_block['featuredtools'][] = $row; }
   return $this->dump_block['featuredtools'];   	
  }//GetFeaturedToolsList
  
  /** получение количества просмотров инструмента */
  function GetToolVisitorsCount($toolident) {
   if (!$this->CorrectSymplyString($toolident)) { return 0; }
   $item = $this->db->GetLineArray($this->db->mPost(
    "select tcount from {$this->tables_list['featutool']} where Lower(tident)=Lower('$toolident') limit 1"
   ));
   return ($item && $item['tcount']) ? $item['tcount'] : 0;
  }//GetToolVisitorsCount
  
  function GetToolsListByDEFAULTtamplateMain() {
   global $_TOOLSNOLIMITACTIVATIONDATAINFO;  
   $result = array(); $def_tools_list = array();
   //groups list
   $groups = $this->db->mPost("select * from {$this->tables_list['tgroupslt']} order by posident");
   while ($group = $this->db->GetLineArray($groups)) {
    $group['name'] = (!$group['nameident']) ? 'No Name' : $this->GetText($group['nameident']);
    $group_data = array(
     'group' => $group,
     'data'  => array()
    );
    //get groups list
    $tools_g = $this->db->mPost(
     "select * from {$this->tables_list['tgroupslx']} where groupid='{$group['iditem']}' order by shortid"
    );
    while ($tool = $this->db->GetLineArray($tools_g)) {
     if (!isset($_TOOLSNOLIMITACTIVATIONDATAINFO[$tool['toolident']])) { continue; }
     //def param block  
     $item = $_TOOLSNOLIMITACTIVATIONDATAINFO[$tool['toolident']];
     //save temp
     if (!isset($def_tools_list[$tool['toolident']])) {
      $def_tools_list[$tool['toolident']] = 1;
     }
     $group_data['data'][] = array(
	  'name'  => $tool['toolident'],
	  'value' => $item
	 );          
    }  
    $result[] = $group_data;   
   } 
   $group_default = false;  
   //as default list
   foreach ($_TOOLSNOLIMITACTIVATIONDATAINFO as $name => $item) {
    if (isset($def_tools_list[$name])) { continue; }
    if ($group_default === false) {
     $group_default = array(
      'group' => array(
       'iditem'     => 0,
       'datecreate' => '',
       'nameident'  => 'groupdefaultidentifytxt',
       'name'       => $this->GetText('groupdefaultidentifytxt'),
       'posident'   => -1
      ),
      'data'  => array()      
     );    
    }
    //combine       
	$group_default['data'][] = array(
	 'name'  => $name,
	 'value' => $item
	);	 
   }  
   if ($group_default) { $result[] = $group_default; }
   return $result;
  }//GetToolsListByDEFAULTtamplateMain
  
  /** получение списка инструментов по группам */
  function GetToolsListByGroupDevision() {
   global $_TOOLSNOLIMITACTIVATIONDATAINFO;  
   $result = array();
   $def_tools_list = array();
   //get groups list
   $groups = $this->db->mPost("select * from {$this->tables_list['tgroupslt']} order by posident");
   while ($group = $this->db->GetLineArray($groups)) {
    $group['name'] = (!$group['nameident']) ? 'No Name' : $this->GetText($group['nameident']);    
    $group_data = array(
     'group' => $group,
     'data'  => array(
      'data1' => array(),
      'data2' => array(),
      'count' => 0
     )
    );
    //get groups list
    $tools_g = $this->db->mPost(
     "select * from {$this->tables_list['tgroupslx']} where groupid='{$group['iditem']}' order by shortid"
    );
    $index = 0;
    while ($tool = $this->db->GetLineArray($tools_g)) {
     if (isset($_TOOLSNOLIMITACTIVATIONDATAINFO[$tool['toolident']])) {
      //def param block  
      $item = $_TOOLSNOLIMITACTIVATIONDATAINFO[$tool['toolident']];
      //save temp
      if (!isset($def_tools_list[$tool['toolident']])) {
       $def_tools_list[$tool['toolident']] = 1;
      }
      //combine       
	  if ($index == 0) {
	   $group_data['data']['data1'][] = array(
	    'name'  => $tool['toolident'],
	    'value' => $item
	   );	
	   $index++;
	   continue;
	  }
	  $group_data['data']['data2'][] = array(
	   'name'  => $tool['toolident'],
	   'value' => $item
	  );	
	  $index = 0;       
     }//ok element    
    }
    $group_data['data']['count'] = @count($group_data['data']['data1']);    
    $result[] = $group_data;    
   }
   $group_default = false;
   //as default list
   foreach ($_TOOLSNOLIMITACTIVATIONDATAINFO as $name => $item) {
    if (isset($def_tools_list[$name])) { continue; }
    if ($group_default === false) {
     $index = 0;   
     $group_default = array(
      'group' => array(
       'iditem'     => 0,
       'datecreate' => '',
       'nameident'  => 'groupdefaultidentifytxt',
       'name'       => $this->GetText('groupdefaultidentifytxt'),
       'posident'   => -1
      ),
      'data'  => array(
       'data1' => array(),
       'data2' => array(),
       'count' => 0
      )      
     );    
    }
    //combine       
	if ($index == 0) {
	 $group_default['data']['data1'][] = array(
	  'name'  => $name,
	  'value' => $item
	 );	
	 $index++;
	 continue;
	}
	$group_default['data']['data2'][] = array(
	 'name'  => $name,
	 'value' => $item
	);	
	$index = 0; 
   }  
   if ($group_default) {
    $group_default['data']['count'] = @count($group_default['data']['data1']);
    $result[] = $group_default; 
   }
   return $result;
  }//GetToolsListByGroupDevision  
  
  /** получение списка всех инструментов на 2 колонки */
  function GetToolsListStandart() {
   global $_TOOLSNOLIMITACTIVATIONDATAINFO;   
   if (isset($this->dump_block['stlisttools'])) { return $this->dump_block['stlisttools']; }
   $this->dump_block['stlisttools'] = array(
    'data1'  => array(),
    'data2'  => array(),
    'count'  => 0
   );
   $index = 0;
   foreach ($_TOOLSNOLIMITACTIVATIONDATAINFO as $name => $item) {
	if ($index == 0) {
	 $this->dump_block['stlisttools']['data1'][] = array(
	  'name'  => $name,
	  'value' => $item
	 );	
	 $index++;
	 continue;
	}
	$this->dump_block['stlisttools']['data2'][] = array(
	 'name'  => $name,
	 'value' => $item
	);	
	$index = 0;
   }
   $this->dump_block['stlisttools']['count'] = @count($this->dump_block['stlisttools']['data1']);
   return $this->dump_block['stlisttools'];   	
  }//GetToolsListStandart
  
  /** получение списка витрины ссылок */
  function GetVitrinaLinksList() {
   global $_VITRINALINKSOPTIONS;
   //if (!$_VITRINALINKSOPTIONS['enabled']) { return false; }
   if (isset($this->dump_block['vitrinalinckslist'])) { return $this->dump_block['vitrinalinckslist']; }
   $this->dump_block['vitrinalinckslist'] = array();   
   $result = $this->db->mPost(
    "select * from {$this->tables_list['linksvit']} order by ldate DESC limit {$_VITRINALINKSOPTIONS['countinblock']}"
   );
   while ($row = $this->db->GetLineArray($result)) {
	$this->dump_block['vitrinalinckslist'][] = $row;
   }
   return $this->dump_block['vitrinalinckslist'];   	
  }//GetVitrinaLinksList
  
  /** блок новостей для быстрого предпросмотра */
  function GetNewsListByBlockData($newstype=2, $limit=10) {
   if (isset($this->dump_block['newslist'.$newstype])) { return $this->dump_block['newslist'.$newstype]; }
   $this->dump_block['newslist'.$newstype] = array();
   $result = $this->db->mPost(
    "select * from {$this->tables_list['newslist']} where newtype='$newstype' and ".
	"lang='".$this->GetActiveLanguage()."' order by datecreate DESC limit $limit"
   );
   while ($row = $this->db->GetLineArray($result)) {
	$this->dump_block['newslist'.$newstype][] = $row;
   }
   return $this->dump_block['newslist'.$newstype];   	
  }//GetNewsListByBlockData  
  
  /** кол-во комментариев для указанного объекта */
  function GetCommentCountForElement($commenttype, $commentfor, $objectID='0') {
   if (!$commentfor = $this->CorrectSymplyString($commentfor)) { return 0; }
   if (!$commenttype = $this->CorrectSymplyString($commenttype)) { $commenttype = ''; }
   if ($commenttype) {
	$commenttype = "commtype='$commenttype' and ";
   }   
   return $this->GetCountInTable(
    'iditem', 'commtbl', "where $commenttype"."commfor='$commentfor' and commisactive='1' and objectid='$objectID'"
   );   	
  }//GetCommentCountForElement
  
  /** добавление комментария к объекту
  * @info - array(
  *  'commentsource' => текст комментария
  *  'useinform' => bool информировать о новых ответах
  *  'restcode' => string проверочный код
  *  'codeorig' => оригинал проверочного кода 
  *  'commtype' => int тип комментария
  *  'commfor' => int объект комментария
  *  'pathtorestore' => string каталог, куда перенаправить по окончании (false - никуда)
  *  'commentto' => string - название объекта, куда добавить         
  * ) 
  */
  function DoActionAddNewComment($info, $objectID='0', $params=false) {
   global $_GLOBALUSECOMMENTOPTIONS;   	   
   $user_inf = ($this->IsOnline()) ? $this->userdata : false;
   if (!$user_inf || !$user_inf['iduser']) { return $this->GetText('errorgetuserinfo'); }   
   //user is ok, next 
   if (!$info['commentsource']) { return $this->GetText('setcommentsource'); }   
   $params = ($params) ? $params : $_GLOBALUSECOMMENTOPTIONS[$objectID][$info['commtype']]; 
       
   if ($params['withcaptcha'] && $info['restcode'] != $info['codeorig']) {
	return $this->GetText('numbisnotvalid'); 	
   }   
   //ok, insert new record
   if (!$this->db->INSERTAction('commtbl', array(
    'datecreate'   => $this->GetThisDateTime(),
    'username'     => $user_inf['username'],
    'commisactive' => ($params['withmodercomment']) ? 0 : 1,
    'commtype'     => $info['commtype'],
    'commfor'      => $info['commfor'],
    'comminform'   => ($info['useinform']) ? 1 : 0,
    'commsource'   => $this->strings->CorrectTextToDB($info['commentsource']),
    'objectid'     => $objectID
   ))) { return 'Error in write new comment..'; }   
   $ident = $this->db->InseredIndex();
   //restore last info items
   $this->db->UPDATEAction(
    'commtbl', array('comminform' => 0), "commtype='{$info['commtype']}' and commfor='{$info['commfor']}' ".
	"and objectid='$objectID' and username='{$user_inf['username']}' and iditem<>'$ident'"
   );
   //comment is ok, inform current user if moder active
   if (/*!$this->isadminstatus && */$params['withmodercomment']) {
	$this->DoMailX(
     $user_inf['useremail'], 
	 $this->GetText('addnewcomment3', array(W_HOSTMYSITE, $info['commentto'])), 
	 $this->GetText('addcommenttomoderinform', array($info['commentto']))
    );	
   }
   //inform all users if not moder status
   if (!$params['withmodercomment']) {
	$result = $this->db->mPost(
	 "select username from {$this->tables_list['commtbl']} where comminform='1' and commtype='{$info['commtype']}' and ".
	 "objectid='$objectID' and commfor='{$info['commfor']}' and iditem<>'$ident' ".
     "and username<>'{$user_inf['username']}'"
	);
	$list_users = '';
	while ($row = $this->db->GetLineArray($result)) {
	 if ($this->strpos($list_users, " {$row['username']} ") == false && $userinfo = $this->GetUserInfo($row['username'])) {
	  $list_users .= " {$row['username']} ";
	  //inform about new comment
	  $this->DoMailX(
       $userinfo['useremail'], 
	   $this->GetText('addnewcommentinf', array(W_HOSTMYSITE, $info['commentto'])), 
	   $this->GetText('newcommentbeaddedtoitem', array(
	    $user_inf['username'], $info['commentto'], W_HOSTMYSITE, 'http://'.W_HOSTMYSITE.$info['pathtorestore']
	   ))
      );	  	
	 }	 	
	}	
   }
   //ok, next inform admin
   if (!$this->isadminstatus) {
	$this->DoMailX(
     W_ADMINEMAIL, 
	 $this->GetText('addnewcommentinf', array(W_HOSTMYSITE, $info['commentto'])), 
	 $this->GetText('newcommentbeaddedtoitemadmin', array(
	  $user_inf['username'], $info['commentto'], W_HOSTMYSITE, 
	  'http://'.W_HOSTMYSITE.$info['pathtorestore'], $info['commentsource']
	 ))
    );
   }
   return ($params['withmodercomment']) ? '0' : '1';	
  }//DoActionAddNewComment
  
  /** отправка сообщения администратору
  * @info - array(
  *  'from'      => email отправителя
  *  'name'      => имя отправителя
  *  'title'     => тема сообщения
  *  'data'      => текст сообщения
  *  'chcode'    => код првоерки
  *  'chcodeval'     
  * )  
  */
  function SendMessageFromFeedBack($info) {
   if (!$info['from'] || !$this->validmail($info['from'])) { return $this->GetText('selectmail'); }
   if (!trim($info['name'])) { return $this->GetText('selectanameusers'); }
   if (!trim($info['title'])) { return $this->GetText('selectatitlemess'); }
   if (!trim($info['data'])) { return $this->GetText('selectadatamess'); }
   if ($info['chcode'] != (($info['chcodeval'] === false) ? $_SESSION["sendnumby"] : $info['chcodeval'])) { 
   	return $this->GetText('numbisnotvalid'); 
   }
   //ok, send message
   $this->DoMailX(
    W_ADMINEMAIL, $this->GetText('messagefeedtitle', array($info['name'], W_HOSTMYSITE, $info['title'])),
	$this->GetText('messagefeedbody_listendata', array(
	 $info['name'], W_HOSTMYSITE, $info['name'], $info['from'], $this->GetCurrentIP(), $info['title'], $info['data']
	)), $info['from'] 
   ); 
   return '';	
  }//SendMessageFromFeedBack
  
  /** is админ */
  function UserIsAdmin($username) {
   global $_GLOBAL_ADMINS_LIST;
   return @in_array($this->strtolower($username), $_GLOBAL_ADMINS_LIST);
  }//UserIsAdmin
  
  private function PreperseAndSetNewsValueElement(&$dataItem, $name, $value, $isbool=false, $default=false) {
   if ($value === false && isset($dataItem[$name])) { return true; }
   $dataItem[$name] = ($isbool) ? (($value) ? true : false) : (($value === false) ? $default : $value);   
  }//PreperseAndSetNewsValueElement
  
  function GetNewsSectionInfoData($sectionid, $noparseparams=false, $fromdataopt=false, $lang=false, $typeID='0') {
   global $_GLOBALUSECOMMENTOPTIONS;
 
   switch ($typeID) {
    
    //special pages
    case '1':
     
     if (!$fromdataopt) {
      if (!$data = $this->db->GetLineArray($this->db->mPost(
       "select * from {$this->tables_list['tplitemsl']} where iditem='$sectionid' limit 1"   
      ))) { return false; }
     } else { $data = $sectionid; }
         
     $item = (!isset($_GLOBALUSECOMMENTOPTIONS[$typeID][$data['iditem']])) ? array() : 
     $_GLOBALUSECOMMENTOPTIONS[$typeID][$data['iditem']];
     
     $this->PreperseAndSetNewsValueElement($item, 'enabled', 1, true, true);    
     $this->PreperseAndSetNewsValueElement($item, 'perpagecount', $data['commperpa'], false, 15);
     $this->PreperseAndSetNewsValueElement($item, 'withmodercomment', $data['commcheck'], true);
     $this->PreperseAndSetNewsValueElement($item, 'withcaptcha', $data['commcaptcha'], true, true);
     $this->PreperseAndSetNewsValueElement($item, 'pathobjects', $data['sid'], false, '');
     $item['showimages'] = false;
     $item['newstitletospec'] = false;
     $item['noelementstext'] = '';
          
     if ($fromdataopt) { return $item; }
     $_GLOBALUSECOMMENTOPTIONS[$typeID][$data['iditem']] = $item;     
    
     return $data;
    break;    
   } 
   
   //news by default data 
   if (!$fromdataopt) {
    if (!$sectionid = $this->CorrectSymplyString($sectionid)) { return false; }
    if (!$lang) { $lang = $this->GetActiveLanguage(); }
    $data = $this->db->GetLineArray($this->db->mPost(
     "select * from {$this->tables_list['newssectq']} where iditem='$sectionid' and lang='$lang' limit 1"   
    ));
    if (!$data) { return false; }
    if ($noparseparams) { return $data; }
   } else { $data = $sectionid; }   
    
   //parse params listen   
   $item = (!isset($_GLOBALUSECOMMENTOPTIONS[$typeID][$data['iditem']])) ? array() : 
   $_GLOBALUSECOMMENTOPTIONS[$typeID][$data['iditem']];
     
   if (!$data['soptions']) { $data['soptions'] = ''; }
   //set   
   $this->PreperseAndSetNewsValueElement(
    $item, 'enabled', $this->ReadOption('enabled', $data['soptions']), true, true
   ); 
   $this->PreperseAndSetNewsValueElement(
    $item, 'perpagecount', $this->ReadOption('perpagecount', $data['soptions']), false, 15
   );
   $this->PreperseAndSetNewsValueElement(
    $item, 'withmodercomment', $this->ReadOption('withmodercomment', $data['soptions']), true, true
   );
   $this->PreperseAndSetNewsValueElement(
    $item, 'withcaptcha', $this->ReadOption('withcaptcha', $data['soptions']), true, true
   );
   $this->PreperseAndSetNewsValueElement(
    $item, 'pathobjects', $this->ReadOption('pathobjects', $data['soptions']), false, 'news'
   );
   $this->PreperseAndSetNewsValueElement(
    $item, 'showimages', $this->ReadOption('showimages', $data['soptions']), true, true
   );
   $this->PreperseAndSetNewsValueElement(
    $item, 'newstitletospec', $this->ReadOption('newstitletospec', $data['soptions']), false, ''
   ); 
   $this->PreperseAndSetNewsValueElement(
    $item, 'noelementstext', $this->ReadOption('noelementstext', $data['soptions']), false, ''
   );
   if ($fromdataopt) { return $item; }
   $_GLOBALUSECOMMENTOPTIONS[$typeID][$data['iditem']] = $item;   
   return $data;   
  }//GetNewsSectionInfoData
  
  /** получение информации о новости \ разделе 
  * @return array(
  *  'data'    => array(),
  *  'section' => array(),
  *  
  *  or return === false  
  * )
  */
  function GetNewsSectionItemTypeData($ident, $getsection=false, $sectioninfo=false) {
   global $_GLOBALUSECOMMENTOPTIONS;	
   if ($getsection) { return $this->GetNewsSectionInfoData($ident); }
   if (!$ident = $this->CorrectSymplyString($ident)) { return false; }   
   $data = $this->db->GetLineArray($this->db->mPost(
    "select * from {$this->tables_list['newslist']} where iditem='$ident' and lang='".
    $this->GetActiveLanguage()."' limit 1"   
   ));	
   if (!$data) { return false; }
   return array(
    'data'    => $data,
    'section' => ($sectioninfo) ? $sectioninfo : $this->GetNewsSectionInfoData($data['newtype']),
    'setinfo' => (isset($_GLOBALUSECOMMENTOPTIONS['0'][$data['newtype']])) ? 
    $_GLOBALUSECOMMENTOPTIONS['0'][$data['newtype']] : array()
   );
  }//GetNewsSectionItemTypeData
  
  /** получение списка новостей */
  function GetNewsSectionListElements($lang=false, $toway=false, $ordered='sname') {
   if (!$lang) { $lang = $this->GetActiveLanguage(); }
   $list = $this->db->mPost(
    "select * from {$this->tables_list['newssectq']} where lang='$lang' order by $ordered"   
   );
   $result = array();
   while ($row = $this->db->GetLineArray($list)) {
   	if (!$row['soptions']) { $row['soptions'] = ''; }
	$item = array(
	 'data' => $row,
	 'opt'  => $this->GetNewsSectionInfoData($row, false, true)
	);    
    if ($toway && $toway != $item['opt']['pathobjects']) { continue; }    
	$avatar = $this->ReadOption('AVATAR', $row['soptions']);
	$file = (!$avatar) ? false : (W_FILESPATH.'/images/'.$avatar);
	$item['avatar'] =
	W_SITEPATH.(($avatar && $file && @file_exists($file)) ? ('pfiles/images/'.$avatar) : 'img/ico/general/news_site.png');
	//$item['file'] = ($file && @file_exists($file)) ? $file : false;	
	$result[] = $item;	
   }
   return $result;   	
  }//GetNewsSectionListElements
  
  /** получение списка доступных разделов новостей\статей */
  function GetAllAvRecordsList() {
   $list = $this->db->mPost(
    "select * from {$this->tables_list['newssectq']} where lang='".$this->GetActiveLanguage()."' order by datecreate"
   );
   $result = array();
   while ($row = $this->db->GetLineArray($list)) {
    if (!$row['soptions']) { continue; }
    $path = $this->ReadOption('pathobjects', $row['soptions']);
    if (!$path) { continue; }
    $path = $this->strtolower($path);
    if (isset($result[$path])) { continue; }   
    $name = $this->ReadOption('newstitletospec', $row['soptions']); 
    $result[$path] = (!$name) ? 'No named' : $name; 
   }
   return $result;
  }//GetAllAvailiableRecordsList
  
  /** идентификационный хэш код */
  function GetHashCodeByActiveUser() {
   return @md5(
    $this->userdata['iduser'].$this->userdata['datereg'].$this->GetSessionIdentify().
    $this->userdata['username'].$this->userdata['userhash']
   );    
  }//GetHashCodeByActiveUser
  
  /** информация о состоянии api */
  function GetApiInformationBlock($apiID, $userID, $fromrequst=false, $apiInfo=false) { 
   if (!$apiID = $this->CorrectSymplyString($apiID)) { return false; }
   $data = $this->db->GetLineArray($this->db->mPost(
    "select * from {$this->tables_list['xmpapitemp']} where apiid='$apiID' and userid='$userID' limit 1"
   ));
   //update if need
   if (!$fromrequst && $data && $data['nowdater'] != ($d = $this->GetThisDate())) {
    $rec_info = array('nowcount' => 0);
    $data['nowcount'] = 0;
    if ($apiInfo) {   
     if ($apiInfo['price']['freecount']) {
      if (!$apiInfo['price']['value'] || 
         ($apiInfo['price']['value'] && $apiInfo['price']['freecount'] > $data['usecount'])) {          
       $rec_info['usecount'] = $apiInfo['price']['freecount'];
       $data['usecount'] = $rec_info['usecount'];
       //$rec_info['nowdater'] = $d;    
      }     
     } 
    }    
    $this->db->UPDATEAction('xmpapitemp', $rec_info, "iditem='{$data['iditem']}'", "1");
   }
   return $data;   
  }//GetApiInformationBlock
  
  function CheckPrivateApiUser($data, $named=false) {
   if ($named === false) { $named = $this->userdata['username']; }
   $named = $this->strtolower($named);
   return isset($data[$named]);
  }//CheckPrivateApiUser 
  
  function GetPublicNewsCount($sectionID) {
   return $this->GetCountInTable(
    'iditem', 'newslist', "where lang='".$this->GetActiveLanguage()."' and newtype='$sectionID'"
   );    
  }//GetPublicNewsCount
  
  /** получение списка баннеров */
  function GetReferBannersList($isflash=false) {
   $isflash = (!$isflash) ? 0 : 1;
   $list = $this->db->mPost("select * from {$this->tables_list['refbunner']} where isflash='$isflash'");
   $result = array();
   while ($row = $this->db->GetLineArray($list)) {
    $name  = ($row['bheight']) ? "{$row['bheight']}px" : 'Auto';
    $name .= ' / '.(($row['bwidth']) ? "{$row['bwidth']}px" : 'Auto');
    if (!isset($result[$name])) { $result[$name] = array(); }
    $result[$name][] = $row;    
   }
   return $result;
  }//GetReferBannersList
  
  /** список финансовых операций пользователя */
  function GetUserTransactions($username) {
   $res = $this->db->mPost(
    "select * from {$this->tables_list['moneyhis']} where username='$username' order by datedata DESC"
   );
   $result = array();
   while ($row = $this->db->GetLineArray($res)) {
    $result[] = $row;
   }
   return $result;    
  }//GetUserTransactions 
  
  /** список доступных групп пользователей */
  function GetAvaileableUserGroups() {
   $list = $this->db->mPost(
    "select * from {$this->tables_list['glbsectlst']} where groupid='1' and lang='".$this->GetActiveLanguage()."'"
   );
   $res = array();
   while ($row = $this->db->GetLineArray($list)) {
    $res[] = $row;    
   }
   return $res;    
  }//GetAvaileableUserGroups
  
  /** получение групп, к которым относится пользователь + данные пользователя в группе */
  function GetUserGroups($userid, $labelstyle='', $nostyledstr=false) {
   $res = array(
    'str'  => '',
    'data' => array()
   );
   
   if (!$userid = $this->CorrectSymplyString($userid)) { return false; }    
   
   if (!$list = $this->db->mPost(
    "select t1.*,t2.groupname,t2.iditem as groupiditem,t2.groupdescr from {$this->tables_list['groupusrs']} as t1 ".
    "INNER JOIN {$this->tables_list['glbsectlst']} as t2 ".
    "ON (t1.userid='$userid' and t1.groupid=t2.iditem and t2.lang='".$this->GetActiveLanguage()."')"
   )) { return false; }  
   
   while ($row = $this->db->GetLineArray($list)) {
    $res['data'][] = $row;
    
    if (!$nostyledstr) {
     $str = '<label class="" id="groupstr'.$row['iditem'].'">'; 
     $nm = '<label class="" id="groupstr'.$row['iditem'].'name"'.(($labelstyle) ? " style=\"$labelstyle\"" : '').'>'.
     $row['groupname'].'</label>';
    
     $res['str'] .= (!$res['str']) ? "$str{$nm}</label>" : "$str, {$nm}</label>";
    }       
   }      
    
   return $res; 
  }//GetUserGroups
  
  /** получение списка групп (имена) по ID групп */
  function GetGroupsListAsStr($groupIDs, $labelstyle='') {
   if (!$groupIDs || !@is_array($groupIDs)) { return ''; } 
    
   $res = '';
   foreach ($groupIDs as $item) {
    
    if (!$info = $this->db->GetLineArray($this->db->mPost(
     "select groupname from {$this->tables_list['glbsectlst']} where iditem='$item' limit 1"     
    ))) { continue; }
    
    $str = '<label class="" id="groupstr'.$item.'">'; 
    $nm = '<label class="" id="groupstr'.$item.'name"'.(($labelstyle) ? " style=\"$labelstyle\"" : '').'>'.
    $info['groupname'].'</label>';
    
    $res .= (!$res) ? "$str{$nm}</label>" : "$str, {$nm}</label>"; 
   }    
   return $res; 
  }//GetGroupsListAsStr
  
  /** установка статуса `администратор` из группы админов проекта */
  private function SetAdminStatusFromAdminGroup() {
   global $_GLOBAL_ADMINS_LIST; 

   if (!@defined('W_USEADMINISTRATIVEGROUPFORADMLIST') || !W_USEADMINISTRATIVEGROUPFORADMLIST) {
    return false;
   }
   
   if (!$s = $this->GetText('administatorsgroupZ')) { return false; }        
   $list = $this->db->mPost(
    "select t1.username from {$this->tables_list['users']} as t1 INNER JOIN {$this->tables_list['groupusrs']} as t2 ".
    "INNER JOIN {$this->tables_list['glbsectlst']} as t3 ON ".
    "(t2.userid=t1.iduser and t2.groupid=t3.iditem and t3.groupname='$s')"
   );
   
   if (!$list) { return false; }    
       
   while ($row = $this->db->GetLineArray($list)) {
    if (!$row['username'] = $this->strtolower($row['username'])) { continue; }    
    
    if (!@in_array($row['username'], $_GLOBAL_ADMINS_LIST))
     $_GLOBAL_ADMINS_LIST[] = $row['username'];
    }  
   return true;    
  }//SetAdminStatusFromAdminGroup
  
  /** получеие кол-ва вложений для объекта */
  function GetObjectFilesCount($fileID, $objectID) {
   if (!$fileID = $this->CorrectSymplyString($fileID)) { return 0; }
   if (!$objectID = $this->CorrectSymplyString($objectID)) { return 0; } 
   return $this->GetCountInTable('iditem', 'filestblst', "where fsection='$fileID' and fobjectid='$objectID'"); 
  }//GetObjectFilesCount 
  
  /** получение списка файлов вложений указанного объекта */
  function GetAttachmentsObjectList($fileID, $objectID) {
   require_once W_LIBPATH.'/files.lib.php';  
   if (!$files = w_dw_files_object::CreateFromObjectID($fileID, $objectID, $this)) {
    return false;
   } 
   $files  = $files->GetFilesList();
   $result = array();
   
   foreach ($files as $item) {   
    if ($item['groupname']) { continue; }
    $result['-'][] = $item;
   }
   
   foreach ($files as $item) {   
    if (!$item['groupname']) { continue; }
    $result[$item['groupname']][] = $item;
   }
   return $result;   
  }//GetAttachmentsObjectList
    
  function GetStrSizeFromBytes($size) { return ss_HTMLPageInfo::GetSizeStrX($size); }
  
  protected function GetBannerItemByRandomElement($groupID) {
   return $this->db->GetLineArray($this->db->mPost(
    "SELECT t1.*,t2.groupname,t2.groupwidth,t2.widthpersent,t2.groupheight,t2.heightpersent FROM {$this->tables_list['bunnerlist']} as t1 INNER JOIN {$this->tables_list['bunnerssec']} as t2 ON (t2.iditem='$groupID' and t1.ispayed='1' and t1.activeobj='1' and t1.groupid=t2.iditem) ORDER BY RAND() LIMIT 1"
   ));     
  }//GetBannerItemByRandomElement 
  
  /** вывод блока места под баннеры
  *   @placeID - int (идентификатор места баннеров, можно узнать идентификатор места в админке
  *   в подписи к месту баннеров!)
  *   
  *   @additionalDivStyleParams - string (определяет параметры блока div (параметр style),
  *   который строит каркас места под баннеры. 
  *   Параметры по умолчанию, такие как width и height ставятся вначале и поэтому будут 
  *   перекрыты, если указать их в данном параметре.
  *   
  *   @noBannerLink - string (определяет ссылку на файл баннера `не flash`, который необходимо
  *   показывать в месте блока, если в данном месте нет активных баннеров).
  *   Может использоваться как реклама для привлечения посетителей для размещения баннеров.
  * 
  *   @noBannerInside - bool (определяет параметр noBannerLink как внешную ссылку или внутреннюю).
  *   если данный параметр установлен в true - ссылка на отсутствующие баннеры (замещение баннера)
  *   должна быть внутри проекта и начинаться от (например: img/nobanner/468x60.gif и т.д),
  *   если данный параметр установлен в true - значение noBannerLink должно содержать полный адрес ссылки
  *   до файла баннера (например: http://site.com/bannerfile.gif) 
  *   
  *   @h - int,
  *   @w - int - определяют ширину и высоту баннера, который будет замещать пустое место (в px).
  *   
  *   @return string (если в указанном месте нет ни одного активного баннера - 
  *   результат всегда будет `` (пусто) или замещающий баннер (если таковой указан), иначе - 
  *   вернет html код баннера с уже обработанным каркасом места.
  */
  function GetBannerPlaceByID($placeID, $additionalDivStyleParams='', $noBannerLink='', $noBannerInside=true, $h=0, $w=0) {
   if (@defined('W_IS_AJAX_MODE_RUN') || $this->IsAllowBotOnProject()) { return ''; }
   
   if (!$item = $this->GetBannerItemByRandomElement($placeID)) {
    if (!$noBannerLink) return '';
    
    //banner group
    if (!$place = $this->db->GetLineArray($this->db->mPost(
     "select iditem,groupwidth,widthpersent,groupheight,heightpersent from {$this->tables_list['bunnerssec']}".
     " where iditem='$placeID' and groupactive='1' limit 1"
    ))) { return ''; }
    
    //replace original banner item
    $place['isflashobj'] = false;
    $place['additionalstyle'] = $additionalDivStyleParams;
    $place['heightobj'] = $h;
    $place['widthobj'] = $w;
    $place['hrefdata'] = 'http://'.W_HOSTMYSITE.'/advertising/';
    $place['webimagefile'] = ($noBannerInside) ? W_SITEPATH.$noBannerLink : $noBannerLink;
 
    $this->smarty->assign('banner_item', $place);
    return $this->smarty->fetch('banner-place-block.tpl');
   }   
 
   $updateparams = array();
   $item['lookcount']++;
   
   if ($item['datenow'] != $this->GetThisDate()) {    
    $updateparams['datenow']    = $this->GetThisDate();
    $updateparams['looktoday']  = 0;
    $updateparams['visittoday'] = 0;   
    
    if ($item['setbytype'] == '1') { 
     $item['lookdcount']++; 
    }        
   }
   
   //check available 
   switch ($item['setbytype']) {    
    //by looks
    case '0':    
     if ($item['lookcount'] > $item['forlooks']) {
      $updateparams['ispayed'] = 0; 
     }      
    break;    
    //by days
    case '1':     
     if ($item['lookdcount'] > $item['fordays']) {
      $updateparams['ispayed'] = 0;
      break; 
     }      
     if (isset($updateparams['datenow'])) {
      $updateparams['lookdcount'] = $item['lookdcount'];  
     }   
    break;   
    //unknow
    default: return '';    
   }       
   
   //get params to update record  
   if (isset($updateparams['ispayed']) && !$updateparams['ispayed']) { 
    
    $updateparams['datecreate'] = $this->GetThisDateTime(); 
    
   } else {
    
    //inc elements, follow ok
    $updateparams['lookcount'] = $item['lookcount'];  
    $updateparams['looktoday'] = (!isset($updateparams['looktoday'])) ? ($item['looktoday']+1) : 1;
        
   }
   
   /*
     eliminate re-cheat days with concurrent queries
     reduces counter hits, eliminates premature discharge of banner impressions
     banner will show, if time is off, only one time for current thread
   */
   $where_additional = '';
   if ($item['setbytype'] && isset($updateparams['datenow']) && $updateparams['datenow']) {
    $where_additional = " and datenow<>'{$updateparams['datenow']}'";    
   }
   
   //ok, rewrite
   $this->db->UPDATEAction('bunnerlist', $updateparams, "iditem='{$item['iditem']}'$where_additional", "1");  
   
   if (isset($updateparams['ispayed']) && !$updateparams['ispayed']) {      
    
    //inform about disabled banner
    if ($userinfo = $this->GetUserInfo($item['userid'], true)) {
     $this->DoMailX($userinfo['useremail'],
      $this->GetText('inactiveparamslook', W_HOSTMYSITE),
      $this->GetText('inactivebannersetdata', array(
      $userinfo['username'], W_HOSTMYSITE, $item['groupname'],
      'http://'.W_HOSTMYSITE.'/account/my-banners-list/?moderl=1'
     )).$this->GetText('bottmessageline')
     );
    }  
    
    //return with new banner
    if (!$where_additional) {
     return $this->GetBannerPlaceByID($placeID); 
    }    
   }
   
   //correct image filename
   $item['webimagefile'] = ($item['rname']) ? W_SITEPATH.W_FILESWEBPATH.'/images/'.$item['rname'] : $item['lname'];
   $item['additionalstyle'] = $additionalDivStyleParams;
   
   //ok, show banner in place 
   $this->smarty->assign('banner_item', $item);
   return $this->smarty->fetch('banner-place-block.tpl');    
  }//GetBannerPlaceByID 
  
  function CheckInArray($item, $list) {
   return @in_array($item, (@is_array($list)) ? $list : @explode(',', $list));
  }//CheckInArray
  
  function IsAllowBotOnProject() {
   if (!$s = @getenv("HTTP_USER_AGENT")) return false; 
      
   $list = array(
    'Yandex',
    'StackRambler',
    'msnbot',
    'stack',
    'rambler',
    'ia_archiver',
    //'Googlebot',
    'google',
    'scooter',
    'lycos',
    'WebAlta',
    'yahoo',
    'aport'  
   );
   
   foreach ($list as $agent) {    
     if ($this->stripos($s, $agent)) return true;
   }
   
   return false;    
  }//IsAllowBotOnProject
  
  function CorrectURLByShemeItem($url) {
    $P = @parse_url($url);
    return ((isset($P['scheme'])) ? '' : 'http://').$url;
  }//CorrectURL  
  
     
 }//w_Control_obj  
 //-----------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>