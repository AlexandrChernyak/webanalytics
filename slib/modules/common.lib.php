<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** Технические элементы пакета
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 class ss_Exception extends Exception { }
 //-----------------------------------------------------------------
 function _ssDoError($s) { throw new ss_Exception($s); }
 //-----------------------------------------------------------------
 /** элемент общего управления */
 class ss_text_control {
  private $timedata = 0;	
  
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
	case 'substr_count': return @call_user_func_array(_SS_STR_IDENT_FUNC.$name, $arguments); break;	
	//no found metchod type	
	default: _ssDoError("Unknown '$name' Metchod");	 
   }
   return $this->$name;	
  }//__call
  
  function Get_MB_preffix() { return _SS_STR_IDENT_FUNC; }  
  function GetThisDate() { return date("Y-m-d"); }  
  function GetThisTime() { return date("H:i:s"); }
  function GetThisDateTime() { return date("Y-m-d H:i:s"); }
  
  function format_number($number='', $divchar = ',', $divat = 3) {
   $decimals = '';
   $formatted = '';			
   $minus = '';
   if ($this->substr($number, 0, 1) == '-') { 
    $minus = '-';
    $number = $this->substr($number, 1);
   }
   $number = str_replace(",", "", $number);
   $number = str_replace(".", "", $number);
   $number = str_replace(" ", "", $number);			
   if ($this->strstr($number, '.')) {
   	$pieces = explode('.', $number);
   	$number = $pieces[0];
   	$decimals = '.' . $pieces[1];
   } else {
   	$number = (string) $number;
   }
   if ($this->strlen($number) <= $divat)
   	return $minus.$number;
   	$j = 0;
   for ($i = $this->strlen($number) - 1; $i >= 0; $i--) {
  	if ($j == $divat) {
  		$formatted = $divchar . $formatted;
  		$j = 0;
   	}
   	$formatted = $number[$i] . $formatted;
   	$j++;
   }
   if ($formatted . $decimals == "") {return "0";}
   return $minus.$formatted.$decimals;
  }//format_number
  
  function GetCurrentIP() {
   $ip = (getenv('HTTP_X_FORWARDED_FOR')) ? getenv('HTTP_X_FORWARDED_FOR') : getenv('REMOTE_ADDR');  
   $pos = @$this->strpos($ip, ","); 
   if ($pos > 0) { $ip = trim($this->substr($ip, 0, $pos)); } 
   return /*(!@preg_match("/(d+).(d+).(d+).(d+)/", $ip)) ? "0.0.0.0" : */$ip;
  }//GetCurrentIP
  
  function HTMLspecialChars($source, $charset='') { 
   return htmlspecialchars($source, ENT_QUOTES,($charset == '') ? SEOSCRIPTDEFENCODE : $charset); 
  }//HTMLspecialChars
  
  function HTMLspecialCharsDecode($source) {	 
   return htmlspecialchars_decode($source, ENT_QUOTES); 
  }//HTMLspecialChars
  
  /** соответствие шаблону
  * @return bool  
  */
  function ChTable($s, $ext) { return @preg_match("/[$ext]/", $s); }  
  
  function StringToPatternList($s) {
   $I = $this->strlen($s);
   $res = '';
   for ($j=0; $j<=$I; $j++) {
    $ch = $s[$j];
	if ($ch != '') {
	 $res .= '['.$this->strtolower($ch).'|'.$this->strtoupper($ch).']';	 	
	}	
   }
   return $res;	
  }//StringToPatternList
  
  /** засекание времени */
  function StartTime() {
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$this->timedata = $mtime[1] + $mtime[0];
  }//StartTime
  
  /** получение времени от последнего засекания
  * @return int  
  */
  function GetCurTimeOfStart() {
   if ($this->timedata == 0) { return 0; }	
   $mtime = microtime();
   $mtime = explode(" ",$mtime);
   $mtime = $mtime[1] + $mtime[0];
   return $mtime - $this->timedata;	
  }//GetCurTimeOfStart
  
  /** извлечение строки */
  function ExtractString($str, $start, $end) {   
   $pos_start = @$this->stripos($str, $start);
   $pos_end = @$this->stripos($str, $end, ($pos_start + $this->strlen($start)));
   if (($pos_start !== false) && ($pos_end !== false)) {
	$pos1 = $pos_start + $this->strlen($start);
	$pos2 = $pos_end - $pos1;
	return $this->substr($str, $pos1, $pos2);
   }
   return false;  	
  }//ExtractString
  
  /** удаление переносов строк в тексте */
  function ClearBreake($source,$r = true, $n = true) {
   if ($r) { $source = @preg_replace("/\r/","",$source); }
   if ($n) { $source = @preg_replace("/\n/","",$source); }
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
  
  /** корректировка offset функции preg_match для utf8 */
  function Correct_offset_to_preg_math_utf8($source, &$matches) {
   if (SEOSCRIPTDEFENCODE != 'UTF-8') { return false; }  	
   foreach ($matches as &$match) {
     $byteStr = substr($source, 0, $match[1]);
     $chrLen  = $this->strlen($byteStr);
     if ($match[1] > $chrLen)
      $match[1] = $chrLen;   
    }		
  }//Correct_offset_to_preg_math_utf8
  
  /** удаление лишних элементов из текста - возврат "чистого текста" */
  function ClearElementsInText($data, $nodeletechars='') {	
   $data = @preg_replace("/(<[\s]*br[\s]*\/[\s]*>)/is", " ", $data);
   $data = @preg_replace('/(<[\s]*\/[\s]*li[\s]*>)/is', '$1 ', $data);        
   while($data != @strip_tags($data)) { $data = @strip_tags($data); }          
   $data = @str_replace('&nbsp;', ' ', $data);
   $data = @preg_replace(DoEncodeDataToDef("/[^a-zA-Zа-яА-ЯёЁ0-9\-_".$nodeletechars."]/u"), " ", $data);
   $data = @preg_replace("/[\s\r\n0-9]([\-|_])/u", " ", $data);
   $data = @preg_replace("/([\-|_])[\s\r\n0-9]/u", " ", $data);    
   $data = @preg_replace(DoEncodeDataToDef("/[\s]([0-9\-\s]*)[\s]/su"), " ", " $data ");   
   while (@$this->strpos($data, "  ") !== false) { $data = @str_replace("  ", " ", $data); }
   return @trim($data);	
  }//ClearElementsInText      
     		
 }//ss_text_control
 //-----------------------------------------------------------------
 /** парсер текста */
 class ss_HTMLTextParser extends ss_text_control {
 	
  private $FData = '';
  private $FDataLength = 0;
  private $FPosition = 0;
  /** удалять спец элементы, скрипты, css и т.д */
  var $IsFreeSpecialData = false;
  /** удалять тэг noindex */
  var $DeleteTagNoIndex = false;
   
  function __construct() {
   $this->FData = '';
   $this->FDataLength = 0;
   $this->DeleteTagNoIndex = false;
   $this->IsFreeSpecialData = false;
   $this->FPosition = 0;    	
  }//construct
  
  /** установка текста */
  function SetData($data, $dataLength=-1) {
   $this->FData = $data;
   $this->FDataLength = ($dataLength < 0) ? $this->strlen($data) : $dataLength;
   $this->FPosition = 0;    	
  }//SetData
  
  /** текст */
  function GetData() { return $this->FData; }
  
  /** размер
  * @return int  
  */
  function GetDataLength() { return $this->FDataLength; }
  
  /** позиция
  * @return int  
  */
  function GetPosition() { return $this->FPosition; }
  function SetPosition($newPos) { $this->FPosition = $newPos; }
  
  /** конец
  * @return bool  
  */
  function Eof() { return ($this->FPosition > $this->FDataLength) or ($this->FPosition < 0); }
  
  /** далее
  * @return bool
  */
  function Next() {
   $this->FPosition++;
   while ($this->CheckToken("\r\n")) { $this->FPosition++; }
   return !$this->Eof();	
  }//Next  
  
  /** символ
  * @return char
  */
  function Token() { return ($this->Eof()) ? '' : $this->FData[$this->FPosition]; }
  
  /** соотношение символу
  * @return bool
  */
  function CheckSympols($symbol, $list) { return !$this->Eof() && $this->ChTable($symbol, $list); }
  function CheckToken($list) { return $this->CheckSympols($this->Token(), $list); }      	
	
  /** устанвока символа 
  * @return bool
  */
  function SetToken($char) {
   if ($this->Eof()) { return false; }
   $this->FData[$this->FPosition] = $char;
   return true;   	
  }//SetToken  
  
  /** пропуск пробелов
  * @return bool
  */
  function FreeSpace() {	
   while ($this->CheckToken(" \r\n")) { $this->Next(); }
   return !$this->Eof();	
  }//FreeSpace
     
  /** удаление спец элементов */
  function EraseSpecialElements() {	    	
   //script  
   $this->FData = @preg_replace(
    "/(\<[\s]*".$this->StringToPatternList('script').")(.*?)(\<[\s]*\/[\s]*".
	$this->StringToPatternList('script')."[\s]*>)/si",
    " ",$this->FData
   );
   //style
   $this->FData = @preg_replace(
    "/(\<[\s]*".$this->StringToPatternList('style').")(.*?)(\<[\s]*\/[\s]*".
	$this->StringToPatternList('style')."[\s]*>)/si",
    " ",$this->FData
   );
   //comment
   $this->FData = @preg_replace("/(\<!--(.*?)-->)/si", "", $this->FData);
   //noindex
   if ($this->DeleteTagNoIndex) {
    $this->FData = @preg_replace(
     "/(\<[\s]*".$this->StringToPatternList('noindex')."[\s]*>)(.*?)(<[\s]*\/[\s]*".
	 $this->StringToPatternList('noindex')."[\s]*>)/si",
     " ",$this->FData
    );	
   }   	
   $this->IsFreeSpecialData = true;	
   $this->FDataLength = $this->strlen($this->FData);	
  }//EraseSpecialElements
  
  /** поиск строки с позиции на позицию 
  * @return bool
  */
  function FindStringInPosition($s) { 
   $this->FPosition = $this->stripos($this->FData, $s, $this->FPosition);
   if ($this->FPosition === false) { $this->FPosition = -1; }   
   return !$this->Eof(); 
  }//FindStringInPosition
  
  /** строку под позицей по символам
  * @return string
  */
  function StringToken($ListEnd='', $ListOK='', $ToUpper=false, $limit=0) {
   $res = '';
   $I = $this->FPosition;
   $incer = ($limit == 0) ? $limit : ($limit + 1);   
   while ((!$this->Eof()) and (!$this->CheckToken($ListEnd)) and 
   (($ListOK == '') or ($this->CheckToken($ListOK)))) {
   	if ($limit > 0) {
	 if ($incer <= 0) { break; }
	 $incer--;	 	
	}  
   	$this->Next(); 
   }
   $res = $this->substr($this->FData, $I, $this->FPosition - $I);   
   return ($ToUpper) ? $this->strtoupper($res) : $res;   	
  }//StringToken  
  
  /** поднятие токена (регистр) */
  function UpToken() {
   while ($this->CheckToken("a-zA-Z0-9_\-")) {
	if ($this->CheckToken("a-z")) { $this->SetToken($this->strtoupper($this->Token())); }
	$this->Next();	
   }	
  }//UpToken     
  
  /** считывание значения
  * @return string
  */
  function ReadParamValue() {
   //pass spaces
   if (!$this->FreeSpace()) { return ''; }
   //текущий символ   
   $EndCh = $this->Token();
   if (!$this->CheckSympols($EndCh, "\"'")) { /* первые слова */ return $this->StringToken(" >"); } else {
	//в оконтовке
	$this->Next();
	$res = $this->StringToken($EndCh/*,'>'*/);
	if ($this->Eof()) { return $res; }
	if ($this->Token() == $EndCh) { $this->Next(); }		
	return $res;	
   }	
  }//ReadParamValue  
  
  /** поиск строки 
  * @return int
  */
  function FindString($s, $fromPos=0) { return $this->strpos($this->FData, $s, $fromPos); }      	
	
 }//ss_HTMLTextParser
 //-----------------------------------------------------------------
 /** парсер тэгов */
 class ss_HTMLTagParser extends ss_text_control {
  private $UpTagName = '';
  private $TagNameEnd = '';
  private $P = null;
  private $tP = null;
  private $TagLength = 0;
  /** удалять спец блоки */
  var $DeleteSpecialBloks = true;
  /** использовать обход по шаблону рег экст, если отключено - по парсингу */
  var $use_regext_preg_to_search = true;
  /** строгое соответствие тэга */
  var $strongle_tag_name = true;   
  /* параметры текущего активного тэга - доступны после успешного поиска тэга */
  var $TagParamsSource = '';
  var $TagSource = '';
  var $TagParamsSourceLength = 0;
  var $TagSourceLength = 0;
  var $TagPosition = 0;  
   
  function __construct() {
   $this->UpTagName = '';
   $this->TagNameEnd = '';
   $this->TagSource = '';
   $this->TagParamsSource = '';	
   $this->TagParamsSourceLength = 0;
   $this->TagSourceLength = 0;
   $this->TagPosition = 0;
   $this->P = new ss_HTMLTextParser();
   $this->tP = new ss_HTMLTextParser();
   $this->use_regext_preg_to_search = @defined('SS_TAG_PARSER_TYPE_STEP_REGEXT') && SS_TAG_PARSER_TYPE_STEP_REGEXT;
   $this->strongle_tag_name = @defined('SS_TAG_STRONGLE_NAME_SEARCH') && SS_TAG_STRONGLE_NAME_SEARCH;
   $this->DeleteSpecialBloks = @defined('SS_DELETE_SPECIAL_BLOCKS_HTML') && SS_DELETE_SPECIAL_BLOCKS_HTML;      	
  }//__construct
  
  /** получение данных следующего тэга 
  * @return bool
  */
  protected function GetNextTag($IsSymply) {	
   //сброс данных
   $this->TagSource = '';
   $this->TagParamsSourceLength = 0;
   $this->TagPosition = 0;
   $TempStartPos = 0;
   if ($this->P->Eof()) { return false; }	
   //up
   $s_named = ($this->strongle_tag_name) ? ('<'.$this->UpTagName.' ') : '<';
   while (true) {
	if (!$this->P->FindStringInPosition($s_named)) { return false; }			
	$StartPos = $this->P->GetPosition();
	$this->P->Next();
	if (!$this->P->FreeSpace()) { return false; }
	if ($this->P->StringToken(" >", "a-zA-Z0-9_\-", true, $this->TagLength) != $this->UpTagName) { continue; }
	//break;	      
    if (!$this->ReadTagParametersData()) { if ($this->P->Eof()) { return false; } continue;	} else { break; }
   }//while (up)    
   $this->TagParamsSource = $this->substr($this->P->GetData(), $StartPos, $this->P->GetPosition() - $StartPos). '>';
   $this->TagParamsSourceLength = $this->strlen($this->TagParamsSource);// $this->P->GetPosition() - $StartPos + 1;
   $this->TagPosition = $StartPos;   
   $res = $IsSymply;
   if ($res) {
	$this->TagSource = $this->TagParamsSource;
	$this->TagSourceLength = $this->TagParamsSourceLength;	
   }
   if (!$this->P->Next() || $res) { return $res; }
   $StartPos = $this->P->GetPosition();
   $Incer = 1;
   //Step2
   while (true) {
	//обнуление общих показателей
	$this->TagSource = '';
	$this->TagSourceLength = 0;
	$this->TagPosition = 0;
	$TempStartPos = 0;
	if ($this->P->Eof() || !$this->P->FindStringInPosition('<')) { return $res; }
	$TempStartPos = $this->P->GetPosition();
	$this->P->Next();
	if (!$this->P->FreeSpace()) { return $res; }
	//проверка закрывающего тэга
	if ($this->P->Token() == '/') {
	 if (!$this->P->Next()) { return $res; }
	 if (!$this->P->FreeSpace()) { return $res; }
	 //имя тэга, проверка совпадения
	 if ($this->P->StringToken(" >", "a-zA-Z0-9_\-", true) != $this->UpTagName) { continue; }
	 //пропуск пробелов
	 if (!$this->P->FreeSpace()) { return $res; }
	 //тэг наш - закрыть
	 if ($this->P->Token() != '>') { if (!$this->ReadTagParametersData()) { continue; } }
	 $this->P->Next();
	 $Incer--;
	 //проверить соотношение
	 if ($Incer > 0) { continue; }
	 //получить общие параметры тэга
	 $this->TagSource = $this->TagParamsSource.$this->substr(
	  $this->P->GetData(), $StartPos, $TempStartPos - $StartPos
	 ).$this->TagNameEnd;
	 $this->TagSourceLength = $this->TagParamsSourceLength + 
	 ($TempStartPos - $StartPos + $this->strlen($this->TagNameEnd));
	 $this->TagPosition = $StartPos;
	 //завершить	 	 	
	 return true;	
	}// token == /
	$PName = $this->P->StringToken(" >", "a-zA-Z0-9_\-", true);
	//проверка повторного открывающего тэга
	if ($PName == $this->UpTagName) {
	 if ($this->CheckForListWords($PName, array('A'))) {
	  $this->TagSource = $this->TagParamsSource.$this->substr(
	   $this->P->GetData(), $StartPos, $TempStartPos - $StartPos
	  ).$this->TagNameEnd;
	  $this->TagSourceLength = $this->TagParamsSourceLength + 
	  ($TempStartPos - $StartPos + $this->strlen($this->TagNameEnd));
	  $this->TagPosition = $StartPos;
	  $this->P->SetPosition($TempStartPos);
	  return true;	  	
	 } else {
	  //пропустить параметры тэга, увеличить счетчик тэгов	
	  if (!$this->ReadTagParametersData()) { $Incer++; }	  	
	 }		
	}//$PName ==
	//продолжить обход
	if (!$this->P->Eof()) { continue; }
	break;	
   }//while Step2
   return $res;    	
  }//GetNextTag
  
  /** проверка строки */
  protected function CheckForListWords($s, $list) { return @in_array($s, $list); }
  
  /** получение содержимого параметра по текущему тэгу 
  * @return === false or string value
  */
  function GetParamValue($ParamName) {
   return $this->GetParamValueX(
    $ParamName, $this->TagParamsSource, $this->TagSource, $this->TagNameEnd, 
	$this->TagParamsSourceLength, $this->TagSourceLength
   );
  }//GetParamValue    
    
  /** получение идентифицированного параметра 
  * @return === false or string value
  */
  protected function GetParamValueX($ParamName, $ParamValue, $SourceValue, $CloseTag, $ParamLength, $SourceLength) {   
   if ($ParamLength <= 0) { return false; }   
   $S = trim($this->strtoupper($ParamName));
   //если S='' - получить общее содержимое
   if ($S == '') {
   	if ($SourceLength > $ParamLength) { 
   	 return $this->substr($SourceValue, $ParamLength, $SourceLength - $ParamLength - $this->strlen($CloseTag));  
    }
    return '';
   }    
   //по шаблону элемента
   if ($this->use_regext_preg_to_search) { return $this->GetRealParamValue($ParamName, $ParamValue); }
   $tP = $this->tP;
   $tP->SetData($ParamValue, $ParamLength);   
   if (!$tP->FreeSpace()) { return false; }   
   if ($tP->Token() != '<') { return false; } elseif (!$tP->Next()) { return false; }  
   if (!$tP->FreeSpace()) { return false; }         
   //$arr_z = @array_merge(@range('a','z'), @range('A','Z'), array('-', '_'));
   //$arr = @array_merge($arr_z, @range('0','9'));   
   while ($tP->CheckToken("a-zA-Z0-9_\-")) { if ($tP->Token() == ' ') { break; } $tP->Next(); }     
   //начинаем считывать имена
   while ((!$tP->Eof()) and ($tP->Token() != '>')) {
    if (!$tP->FreeSpace()) { return false; }	
	$PName = $tP->StringToken(" =", "a-zA-Z_\-", true);	
    if (!$tP->FreeSpace()) { return false; }
    if ($tP->Token() != '=') { $tP->Next(); continue; }
    if (!$tP->Next()) { return false; }
    $PValue = $tP->ReadParamValue();    
	//проверить имя
	if ($PName == $S) { return $PValue; }		
   }
   return false;	
  }//GetParamValueX
  
  /** получить одиночный тэг
  * @return bool  
  */
  function GetSympleTag() { 
   return ($this->use_regext_preg_to_search) ? $this->GetRealSympleTag($this->UpTagName) : $this->GetNextTag(true); 
  }//GetSympleTag
  
  /** получить стандартный тэг
  * @return bool
  */
  function GetTag() { 
   return ($this->use_regext_preg_to_search) ? $this->GetRealTag($this->UpTagName) : $this->GetNextTag(false); 
  }//GetTag
  
  /** получение тэга по регэкст с возвращением содержимого, всего и параметров
  * @return bool  
  */
  protected function GetRealTag($tagName='title') {   	    	
   $query = "/<[\s]*".$this->StringToPatternList($tagName)."[\s]*(.*?)>(.*?)(<[\s]*\/[\s]*".
   $this->StringToPatternList($tagName)."[\s]*>)/is";
   //поиск     
   if (@preg_match($query, $this->GetData(), $ar, PREG_OFFSET_CAPTURE, $this->P->GetPosition())) {
	//получить элементы
	$ar1 = $ar;
	$this->Correct_offset_to_preg_math_utf8($this->GetData(), $ar);			
	//print_r($ar);
	//exit;		
	$this->TagSource = $this->substr($this->GetData(), $ar[0][1], $ar[3][1] - $ar[0][1]).$this->TagNameEnd;	
	//$this->TagSource = ($this->TagSource == '') ? $ar[0][0] : ($this->TagSource.$this->TagNameEnd);	
	$this->TagSourceLength = $this->strlen($this->TagSource);	
	$this->TagParamsSource = $this->substr($this->GetData(), $ar[0][1], $ar[2][1] - $ar[0][1]);
	$this->TagParamsSourceLength = $this->strlen($this->TagParamsSource);
	$this->TagPosition = $ar[0][1];
	$this->P->SetPosition($ar1[0][1] + $this->TagSourceLength);
	return true;
   }
   $this->P->SetPosition($this->P->GetDataLength());
   return false;	
  }//GetRealTag
  
  /** получение следующего, первого e-mail адреса в тексте
  * @return bool  
  */
  function GetEmailFromText() {
   $query = "/[\.\-_A-Za-z0-9]+?@[\.\-A-Za-z0-9]+?[\.A-Za-z0-9]{2,}/is";
   //поиск     
   if (@preg_match($query, $this->GetData(), $ar, PREG_OFFSET_CAPTURE, $this->P->GetPosition())) {
	//получить элементы
	$ar1 = $ar;	
	$this->Correct_offset_to_preg_math_utf8($this->GetData(), $ar);	
	$this->TagSource = $ar[0][0];			
	$this->TagSourceLength = $this->strlen($this->TagSource);		
	$this->TagParamsSource = '';
	$this->TagParamsSourceLength = 0;
	$this->TagPosition = $ar[0][1];
	$this->P->SetPosition($ar1[0][1] + $this->TagSourceLength);
	return true;
   }
   $this->P->SetPosition($this->P->GetDataLength());
   return false;	
  }//GetEmailFromText  
  
  /** получение одиночного тэга по шаблону
  * @return bool
  */
  protected function GetRealSympleTag($tagName='meta') {
   //идентификатор спереди
   $_params1 = "([a-zA-Z0-9_\-]+[\s]*=[\s]*(['|\"](.*?)['|\"]|([^\s\/]?)))";
   //идентификатор сзади
   $_params2 = "(['|\"](.*?)['|\"][\s]*=[\s]*[a-zA-Z0-9_\-]+)";
   //запрос 
   $query = "/<[\s]*".$this->StringToPatternList($tagName).
   "(([\s]*>)|[\s](".$_params1."|".$_params2.")?[\s]*(.*?)[\s]*>)/is";	
   //поиск
   if (@preg_match($query, $this->GetData(), $ar, PREG_OFFSET_CAPTURE, $this->P->GetPosition())) {
	//получить элементы        
	$ar1 = $ar;
	$this->Correct_offset_to_preg_math_utf8($this->GetData(), $ar);
	//print_r($ar);  
	$this->TagSource = $ar[0][0];	
	$this->TagSourceLength = $this->strlen($this->TagSource);	
	$this->TagParamsSource = $this->TagSource;
	$this->TagParamsSourceLength = $this->TagSourceLength;
	$this->TagPosition = $ar[0][1];
	$this->P->SetPosition($ar1[0][1] + $this->TagSourceLength - 1);
	return true;
   }   
   $this->P->SetPosition($this->P->GetDataLength());
   return false;  		
  }//GetSympleTag    
  
  /** получение параметра по шаблону
  * @return bool === false or string  
  */
  protected function GetRealParamValue($ParamName, $ParamValue) { 
   $query = "/[^a-zA-Z0-9]".$this->StringToPatternList($ParamName)."[\s]*=[\s]*(['|\"](.*?)['|\"]|([^\s\/>]*))/si";
   if (@preg_match($query, $ParamValue, $ar)) {
   	return $ar[@count($ar)-1];   	
   }   
   return false;	
  }//GetRealParamValue  
  
  /** чтение параметров
  * @return bool  
  */
  protected function ReadTagParametersData() {
   $P = $this->P;
   $first_step = true;
   $cha = '';   
   while ((!$P->Eof()) and ($P->Token() != '>')) {	      	   	
	//если ковычки - пропустить параметры
	if ($P->CheckToken("\"'")) {
	 if ((!$first_step) and ($cha != '=')) { return false; }		
	 $EndCh = $P->Token();
	 if (!$P->Next()) { return false; }
	 //считываем все комменты
	 while ((!$P->Eof()) and ($P->Token() != $EndCh)) {
	  //print $P->Token()."\r\n";		
	  if (!$P->Next()) { return false; }	  	
	 }
	 //print "\r\n\r\n";
	 if ($first_step) { $first_step = false; }
	 $cha = '';
	 //$P->Next();
	 //continue;		
	}
	//print 'word- '.$P->Token()."\r\n";
	if (!$first_step && !$P->CheckToken(" \r\n"))  { $cha = $P->Token(); }	
	$P->Next();	
   }
   return !$P->Eof() && $P->CheckToken(">");	
  }//ReadTagParametersData  
  
  /** Установка текста для анализа */
  function SetData($Data, $TagName, $DataLength=-1, $dorestoreoncheck=true) {
   $this->UpTagName = $this->strtoupper($TagName);
   $this->TagNameEnd = '</'.$TagName.'>';
   $this->TagSource = '';
   $this->TagParamsSource = '';
   $this->TagParamsSourceLength = 0;
   $this->TagSourceLength = 0;
   $this->TagLength = $this->strlen($TagName);  
   $this->P->SetData($Data, $DataLength);
   //удалить элементы специальных блоков если нужно и еще не удалены
   if ($dorestoreoncheck && $this->DeleteSpecialBloks) { $this->P->EraseSpecialElements(); }  	
  }//SetData
  
  /** получение содержимого */
  function GetData() { return (@isset($this->P)) ? $this->P->GetData() : ''; } 	
  
  /** размер текста */
  function GetDataLength() { return (@isset($this->P)) ? $this->P->GetDataLength() : 0; }
	
 }//ss_HTMLTagParser
 //-----------------------------------------------------------------
 /** извлечение, хранение данных о текущем состоянии страницы */
 class ss_HTMLPageInfo extends ss_text_control {
  private $data = '';
  private $data_length = 0;
  private $data_real_length = 0;
  private $parser = null;
  private $list_info = array();
  private $encode_content = '';
  protected $header_source_inf = '';
  /** экранировать символы в получаемых тэгах */
  var $do_special_chars_in_tags = true;
  /** удалять переносы строк в получаемых тэгах */
  var $do_delete_line_breaks_in_tags = false;
  /** указать конкретную кодировку страницы (принудительно)*/
  var $connect_specidy_encoded_page = false;  
  
  function __construct() {
   $this->data = '';
   $this->list_info = array();
   $this->parser = new ss_HTMLTagParser();
   $this->do_special_chars_in_tags = @defined('SS_HTMLSPECCHARS_TAGS_ON_GET') && SS_HTMLSPECCHARS_TAGS_ON_GET;
   $this->do_delete_line_breaks_in_tags = @defined('SS_DELETEBREAKS_TAGS_ON_GET') && SS_DELETEBREAKS_TAGS_ON_GET;   	
  }//__construct
  
  /** установка текста 
  * $do_delete_special_tags = -1 - по умолчанию
  * $do_delete_special_tags = 0 - нет
  * $do_delete_special_tags = 1 - да  
  */
  function SetContent($data, $dataLength = 0, $do_encoded_content = true, $do_delete_special_tags = -1) {
   $this->data = $data;
   $this->data_length = ($dataLength > 0) ? $dataLength : $this->strlen($data);
   $this->list_info = array();
   $this->encode_content = '';
   $this->data_real_length = $this->data_length;
   switch ($do_delete_special_tags) {
    case 0: if ($this->parser->DeleteSpecialBloks) { $this->parser->DeleteSpecialBloks = false; } break;
	case 1: if (!$this->parser->DeleteSpecialBloks) { $this->parser->DeleteSpecialBloks = true; } break;
	default: 
	 $this->parser->DeleteSpecialBloks = @defined('SS_DELETE_SPECIAL_BLOCKS_HTML') && SS_DELETE_SPECIAL_BLOCKS_HTML;
	 break;	
   }
   if ($do_encoded_content) { $this->TransformEncodedContent(); }  	
  }//SetContent
  
  protected function _DoTransformEncoded($from) {
   if ($this->encode_content != '') { return false; }	
   $this->encode_content = trim($this->strtoupper($from));
   if ($this->encode_content == '') { return false; }   
   //обработка кодировки страницы
   if (@defined('SS_CONTENT_ENCODE_PROG') && @function_exists(SS_CONTENT_ENCODE_PROG)) {
    $this->data = @call_user_func(SS_CONTENT_ENCODE_PROG, $this->encode_content, SEOSCRIPTDEFENCODE, $this->data);  	 
   } else {
    //обработать, если кодировки различаются
    if (($this->encode_content != '') and (SEOSCRIPTDEFENCODE != $this->encode_content)) {
     $this->data = @iconv($this->encode_content, SEOSCRIPTDEFENCODE, $this->data);				
    }	   	
   }
   return true;
  }//_DoTransformEncoded
  
  /** трансформация текущей кодировки */
  function TransformEncodedContent() {   
   //check content meta item
   $P = $this->parser;
   $P->SetData($this->data, 'meta', $this->data_length);
   //обновление содержимого
   $this->data_real_length = $P->GetDataLength(); 
   $this->data = $P->GetData();    
   //проверка принудительной кодировки
   if ($this->connect_specidy_encoded_page) {
	$this->_DoTransformEncoded($this->connect_specidy_encoded_page);
	return true;	
   }     
   //check header item  
   $query = "/content-type[\s]*:(.*?)[\s]charset[\s]*=[\s]*([^\n\s;]+?)/isU";
   if (@preg_match($query, $this->header_source_inf, $ar)) {
    $this->_DoTransformEncoded($ar[2]);
    return true;    
   } 
   //начало     
   $query = "/".$this->StringToPatternList('charset')."[\s]*=(.*?)/isU";        
   //проход по всем мета
   while ($P->GetSympleTag()) {	       
	$content = $P->GetParamValue('content');    
	//проверка и получение кодировки, если не найдена до этого
	if ($this->encode_content == '') {
	   
	 //if ($content === false) { continue; }		
	 if (@preg_match($query, $content, $ar)) {
	  $this->_DoTransformEncoded($ar[1]); 	
	  if ($this->encode_content != '') { break; }	    	
	 }
     
     //with slashes or on all meta source
     elseif (@preg_match("/charset[\s]*=[\s]*['|\"](.*?)['|\"]/isU", $content, $ar) || 
      @preg_match("/charset[\s]*=[\s]*['|\"](.*?)['|\"]/isU", $P->TagParamsSource, $ar)) {   
        
      $this->_DoTransformEncoded($ar[1]); 	
	  if ($this->encode_content != '') { break; }      
     }     
     	
	} else { break; }				
   }//while   	
  }//TransformEncodedContent
  
  /** добавление элемента */
  protected function AddNewElementTag($TagGroup, $TagName, $Value_name, $Value) {
   if ($TagName == '') { return false; }	
   $TagGroup = $this->strtoupper($TagGroup);	
   $TagName  = $this->strtoupper($TagName.'_'.$Value_name);   	
   if (!@isset($this->list_info[$TagGroup])) { $this->list_info[$TagGroup] = array(); }
   $this->list_info[$TagGroup][$TagName] = $Value;
   return $Value;   	
  }//AddNewElementTag
  
  /** получение элемента
  * @return === false or value  
  */
  protected function GetNewElementTag($TagGroup, $TagName, $Value_name, $DefValue=false) {
   if ($TagName == '') { return false; }	
   $TagGroup = $this->strtoupper($TagGroup);	
   $TagName  = $this->strtoupper($TagName.'_'.$Value_name);   	
   $ar = (!$this->list_info) ? false : $this->list_info[$TagGroup];   
   return (!$ar || !@is_array($ar) || !@isset($ar[$TagName])) ? $DefValue : $ar[$TagName];   
  }//GetNewElementTag
  
  /** экранирвоание символов */
  private function EncodeTextSource($s) {
   $s = ($this->do_special_chars_in_tags) ? $this->HTMLspecialChars($s) : $s;
   return ($this->do_delete_line_breaks_in_tags) ? $this->ClearBreake($s) : $s;   	
  }//EncodeTextSource
  
  /** текущая кодировка страницы 
  * @return string
  */
  function GetEncodeName() { return $this->encode_content; }
  
  /** получение дампа сохраненных элементов 
  * @return array
  */
  function GetCachDump() { return $this->list_info; }
  
  /** получение парсера 
  * @return ss_HTMLTagParser
  */
  function GetParser() { return $this->parser; }
  
  /** получение содержимого */
  function GetData() { return $this->data; }
  
  /** размер содердимого */
  function GetDataLength() { return $this->data_length; }
  
  /** текущий размер страницы, после обрезаний лишнего */
  function GetDataRealLength() { return $this->data_real_length; }
  
  /** получение заголовка (title)
  * @return === false if not exists or string value  
  */
  function GetTitle() { return $this->GetFirstTag('title');	}
  
  /** получение h тэгов 
  * @return === false if not exists or string value
  */    
  function GetHTag($h_number=1) { return $this->GetFirstTag("h$h_number"); }
  
  /** получение фаворит иконки 
  * @return === false or value
  */
  function GetFavoritIconLink() { return $this->GetLinkTag(); }  
  
  /** получение ключевых слов
  * @return === false or value
  */
  function GetKeyWords() {
   return $this->GetMetaTag('keywords', array('name', 'http-equiv'));	
  }//GetKeywords  
  
  /** получение мета тэга robots
  * @return === false or value
  */
  function GetMetaRobots() {
   return $this->GetMetaTag('robots', array('name', 'http-equiv'));	
  }//GetMetaRobots
   
  /** получение мета тэга description
  * @return === false or value
  */
  function GetDescription() {
   return $this->GetMetaTag('description', array('name', 'http-equiv'));	
  }//GetDescription  
  
  /** получение мета тега
  * @return === false or value
  * 
  * @nameValue - string or array of string
  * @nameAttr - string or array of string    
  */
  function GetMetaTag($nameValue, $nameAttr='name', $valueAttr='content', $cachalltags=true) {
   return $this->GetTagEx('meta', $nameValue, $nameAttr, $valueAttr, $cachalltags);	
  }//GetMetaTag
  
  /** получение тэга link
  * @return === false or value
  * 
  * @nameValue - string or array of string
  * @nameAttr - string or array of string
  */
  function GetLinkTag($nameValue=array('icon','shortcut icon'), $nameAttr='rel', $valueAttr='href', $cachalltags=true) {
   return $this->GetTagEx('link', $nameValue, $nameAttr, $valueAttr, $cachalltags);	
  }//GetLinkTag
  
  /** получение обычного тэга (двойного) (первое вхождение) 
  * @return === false if not exists or string value 
  */
  function GetFirstTag($tagName, $identifier_group='def_one') {
   //проверка кэша
   $res = $this->GetNewElementTag($tagName, $identifier_group, 'def_two');
   if ($res !== false) { return $res; }
   //получить   
   $this->SetParserTag($tagName, $this->parser);
   if ($this->parser->GetTag()) { 
   	$res = $this->parser->GetParamValue('');
	if ($res === false) { $res = ''; }  
   } else { return false; }
   //запись
   $res = $this->EncodeTextSource($res);
   if (@defined('SS_CACHE_CONTENT_TAGS') && SS_CACHE_CONTENT_TAGS) {
	$this->AddNewElementTag($tagName, $identifier_group, 'def_two', $res);
   }
   return $res;	
  }//GetFirstTag  
    
  /** получение одиночного (двойного) тэга по параметру
  * @return === false or value
  *  
  * @tagName - string (имя искомого тэга)
  * @nameValue - string or array of string
  * @nameAttr - string or array of string
  * @valueAttr  - string
  * 
  * @cachalltags - bool (кэшировать все тэги или остановить на найденном)  
  * @asSimple - bool (искать полный тэг или одиночный без </tagname> если asSimple)
  *    
  * возвращает значение параметра valueAttr из тэга
  * по критерию что:
  * nameValue или один из nameValue параметров равен nameAttr или одному из nameAttr   
  */
  function GetTagEx($tagName, $nameValue, $nameAttr='name', $valueAttr='content', $cachalltags=true, $asSimple=true) {
   if (!@is_array($nameAttr)) { $nameAttr = array($nameAttr); }
   if (!@is_array($nameValue)) { $nameValue = array($nameValue); }
   //check data
   if (($tagName == '') or (!$nameAttr) or (!$nameValue)) { return false; }
   //получить из кэша
   $res = false;
   foreach ($nameValue as &$val) {
   	$val = $this->strtoupper($val);
    foreach ($nameAttr as $attr) {	
     $res = $this->GetNewElementTag($tagName, $val.'_'.$attr, $valueAttr);
     if ($res !== false) { return $res; }	 	
    }      	
   }   
   //обработка
   $do_cach = @defined('SS_CACHE_CONTENT_TAGS') && SS_CACHE_CONTENT_TAGS;
   $P = $this->parser;
   $P->SetData($this->data, $tagName, $this->data_real_length, false);
   while (($asSimple) ? $P->GetSympleTag() : $P->GetTag()) {
	//val data
	$val_data = $P->GetParamValue($valueAttr);
	if ($val_data === false) { $val_data = ''; }
	$val_data = $this->EncodeTextSource($val_data);
	//val id
	foreach ($nameAttr as $attr) {
	 $item = $P->GetParamValue($attr);
	 if ($item === false) { continue; }	 
	 //текущий элемент есть		
	 $item = $this->strtoupper($item);	 
	 if (($res === false) and (@in_array($item, $nameValue))) { $res = $val_data; }
	 //cache
	 if ($do_cach) { $this->AddNewElementTag($tagName, $item.'_'.$attr, $valueAttr, $val_data); }
	 //exit of
	 if (($res !== false) and (!$cachalltags)) { return $res; }	 	
	}
	//дополнительная проверка
	if (($res !== false) and (!$cachalltags)) { break; }	
   }//while
   return $res;   	
  }//GetSimpleTag
          
  /** установка тэга на парсер */
  function SetParserTag($tagName, ss_HTMLTagParser $parser) {
   $parser->SetData($this->data, $tagName, $this->data_real_length, false);	
  }//SetParserTag
 
  /** получение текущего размера строкой */
  function GetDataSizeStr($size=-1) {
   if ($size == -1) { $size = $this->data_length; }
   return self::GetSizeStrX($size);	
  }//GetDataSizeStr
  
  /** размер строкой */
  static function GetSizeStrX($size, $suff='') {
   //gb
   if (@floor($size / (1024 * 1024 * 1024)) > 0) { return @round($size / (1024 * 1024 * 1024), 2)." Gb$suff"; } 
   //mb
   elseif (@floor($size / (1024 * 1024)) > 0) { return @round($size / (1024 * 1024), 2)." Mb$suff"; }
   //kb
   elseif (@floor($size / 1024) > 0) { return @round($size / 1024, 2)." Kb$suff"; }
   //byte
   else { return $size." Byte(s)"; }	
  }//GetSizeStrX
  
  /** получение скорости с форматированием */
  function GetSpeedAsStr($speedin_bytes) {
   if ($speedin_bytes < 0) { return '0 Kb/s'; }
   //gb
   if (@floor($speedin_bytes / (1024 * 1024 * 1024)) > 0) { return @round($speedin_bytes / (1024 * 1024 * 1024), 2)." Gb/s"; } 
   //mb
   elseif (@floor($speedin_bytes / (1024 * 1024)) > 0) { return @round($speedin_bytes / (1024 * 1024), 2)." Mb/s"; }
   //kb
   elseif (@floor($speedin_bytes / 1024) > 0) { return @round($speedin_bytes / 1024, 2)." Kb/s"; }
   //byte
   else { return $speedin_bytes." Byte/s"; }	
  }//GetSpeedAsStr
  
  /** получение чистого текста, без тэгов и вего прочего */
  function GetSimplyTextFromPage($source=false, $frombody=true) {
   $p = new ss_HTMLTagParser();
   $p->DeleteSpecialBloks = true;
   $p->use_regext_preg_to_search = true;
   if ($source === false) { $this->SetParserTag('body', $p); } else { $p->SetData($source, 'body'); }
   $data = ($frombody && $p->GetTag()) ? $p->TagSource : $p->GetData();
   return $this->ClearElementsInText($data);   	
  }//GetSimplyTextFromPage	
 	
 }//ss_HTMLPageInfo
 //-----------------------------------------------------------------
 /** доступ к внешним источникам */
 class ss_ConnectQuery extends ss_HTMLPageInfo {
  private $idna_obj = null;
  private $plugins = null;
  private $tempurl_ip = array(); 	
  
  /* информационные данные о текущем активном, установленном url */
  /** url полностью */
  var $url_self = '';
  /** url полностью, но без протокола */
  var $url_self_no_protocol = '';
  /** ссылка для запроса, формируется произвольно */
  var $url_query_link = false;
  /** хост без протокола */
  var $url_host = '';
  /** хост в раскодированном варинате,если на кириллице */
  var $url_real_host = '';
  var $url_real_host_with_www = '';
  var $url_real_host_without_www = '';    
  /** хост с протоколом */
  var $url_host_and_protocol = '';
  /** хост без www */
  var $url_host_without_www = '';
  /** хост с www */
  var $url_host_and_www = '';
  /** протокол */
  var $url_protocol = '';
  /** остальная информация парсинга url */
  var $url_array_info = array();
  
  /* данные, доступные поле выполнения запроса, содержат данные о выполненом запресе */
  /** ответ сервера */
  var $res_http_code = 404;
  /** сервер */
  var $res_server = '';  
  /** заголовок ответа */
  var $res_header_source = '';  
  /** ссылка на редирект */
  var $res_redirect_link = '';
  /** список перенаправлений запроса */
  var $res_redirect_list = array();
  /** ошибка при запросе */
  var $res_error = '';
  /** время, за которое был выполнен запрос */
  var $res_time_query = 0;
  /** общая информация о полученных данных запроса */
  var $res_general_answer_info = false;
  /** размер полученных данных в байтах */
  var $res_url_size = 0;
  /** скорость загрузки сайта Kb\s */
  var $res_load_speed = 0;  
      
  /* параметры соединения для индивидуального обращения*/	
  /** timeout соединения */
  var $connect_time_out = 50;
  /** список разрешенных mime типов - пусто - все типы */
  var $connect_mime_types = array(); //array('text/html', 'text/plain', 'text/richtext', 'text/xml', 'application/xml')
  /** декодировать строки из encodeurl в url */
  var $connect_decode_encoded_string = true;
  /** получать результат запроса без текста заголовка */
  var $connect_delete_header_source = true;
  /** использовать куки для запросов, если да - имя файла для кукиес или false */
  var $connect_use_cookies = 'mydefcookies.txt';
  /** использовать cookies как строку, не файл */
  var $connect_use_cookies_as_string = false;  
  /** обходить по перенаправлениям */
  var $connect_follow_redirect = true;
  /** использовать сертификат при запросах - имя файла или false */
  var $connect_caiinfo = false;
  /** логин для авторизации */
  var $connect_login = '';
  /** пароль для авторизации */
  var $connect_password = '';
  /** удалять спец символы из кода страницы -1 or 0 or 1*/
  var $connect_delete_spec_tags = -1;
  /** выполнять раскодировку страницы (для вывода в указанной кодировке) */
  var $connect_do_encoded_page = true;
  /** использовать прокси сервер */
  var $connect_use_proxy = false;
  /** метод получения прокси */
  var $connect_proxy_get_prog = false; 
  /** рефферер отправителя */
  var $connect_refferer_send = false; 
   
  
  function __construct() {
   global $_SS_CONNECT_MIMETYPES_WS, $_SS_CONNECT_PROXY_GET_PROG_WS;	
   parent::__construct();
   unset($this->plugins);
   $this->connect_time_out = (@defined('SS_CONNECT_TIMEOUT_WS')) ? SS_CONNECT_TIMEOUT_WS : 50;
   if ($_SS_CONNECT_MIMETYPES_WS && @is_array($_SS_CONNECT_MIMETYPES_WS)) { 
   	$this->connect_mime_types = $_SS_CONNECT_MIMETYPES_WS; 
   }
   if (@defined('SS_DO_AUTO_DECODE_ENCODE_PUNY_DOMAIN_WS') && 
   SS_DO_AUTO_DECODE_ENCODE_PUNY_DOMAIN_WS && @class_exists('idna_convert')) {
	$this->idna_obj = new idna_convert();
   } 
   $this->connect_decode_encoded_string = @defined('SS_DODECODE_LINKS_FROM_ENCODEURL_WS') && 
   SS_DODECODE_LINKS_FROM_ENCODEURL_WS;
   $this->connect_use_cookies = (@defined('SS_USE_COOKIES_ON_QUERYES_WS') && SS_USE_COOKIES_ON_QUERYES_WS) ? 
   SS_USE_COOKIES_ON_QUERYES_WS : false;
   $this->connect_caiinfo = (@defined('SS_CAIINFO_USE_ON_QUERY_CONNECT_WS') && SS_CAIINFO_USE_ON_QUERY_CONNECT_WS) ? 
   SS_CAIINFO_USE_ON_QUERY_CONNECT_WS : false;
   $this->connect_use_proxy = @defined('SS_USE_PROXY_CONNECT_INFO_WS') && SS_USE_PROXY_CONNECT_INFO_WS;
   $this->connect_proxy_get_prog = $_SS_CONNECT_PROXY_GET_PROG_WS;        	
  }//__construct
  
  function __get($propName) {
   switch ($propName) {
   	case 'plugins': 
	  if (!isset($this->plugins)) { $this->plugins = new ss_Plugin_obj_List($this); } 
	  return $this->plugins;	 
   }
   return $this->$propName;  	
  }//__get
  
  /** получение плагинов
  * @return ss_Plugin_obj_List  
  */
  function GetPlugins() { return $this->plugins; }
  
  /** Выполнение указанного плагина
  * @input $runparams (параметры запуска плагина при необходимости) 
  * @return === false or value  
  */
  function RunPlugin($plugin_id, $runparams=false) {
   return $this->plugins->RunPlugin($plugin_id, $runparams);   	
  }//RunPlugin
  
  /** Выполнение плагина с параметрами 
  * @return === false or value
  * 
  * @out $error - Ошибка выполнения плагина
  * @out $value - Результат выполнения
  * @input $runparams - параметры выполнения (если требуются)
  * @input $asNumeric - (если true) - пустое значение бует равным 0     
  */
  function RunPluginEx($plugin_id, &$error, &$value, $runparams=false, $asNumeric=false) {
   $error = '';
   $value = false;	
   $plugin = $this->GetPlugin($plugin_id);
   if (!$plugin) { $plugin = $this->AddPlugin($plugin_id); }
   if (!$plugin) { $error = 'Plugin [ss_Plugin_'.$plugin_id.'] not found!'; return false; }
   $value = $plugin->ActionPlugin($runparams);
   if ($value === false) { $error = $plugin->GetError(); return false; }
   if ($asNumeric && ($value == '')) { 
   	$value = 0;	
   }   
   return true;	
  }//RunPluginEx
  
  /** выполнение плагина с получением даты последнего обновления в кэше, если данные из кэша */
  function RunPluginEx2($plugin_id, &$error, &$value, &$cachdate, $runparams=false, $asNumeric=false) {
   $cachdate = false;
   if (!$this->RunPluginEx($plugin_id, $error, $value, $runparams, $asNumeric)) { return false; }
   $cachdate = $this->GetPlugin($plugin_id)->GetLastCachUpdateDate();
   return true;   	 
  }//RunPluginEx2	    
  
  /** проверка существования плагина, если существет - возвращает его
  * @return наследника от ss_Plugin_obj or === false
  */
  function GetPlugin($plugin_id) {
   return $this->plugins->GetPlugin($plugin_id);	
  }//GetPlugin
  
  /** добавление плагина, создание
  * @return наследника от ss_Plugin_obj or === false
  */
  function AddPlugin($plugin_id) {
   return $this->plugins->CreatePlugin($plugin_id);	
  }//AddPlugin
  
  /** замена в строке всех идентификационны данных на значения url
  * @return string  
  */
  function ReplaceCorrect($s) {
   $s = @str_replace('[url_link]', $this->url_self, $s);
   $s = @str_replace('[url_host]', $this->url_host, $s);	
   $s = @str_replace('[url_host_www]', $this->url_host_and_www, $s);
   $s = @str_replace('[url_host_no_www]', $this->url_host_without_www, $s);
   $s = @str_replace('[url_host_http]', $this->url_host_and_protocol, $s);
   $s = @str_replace('[url_real_host]', $this->url_real_host, $s);
   $s = @str_replace('[url_real_host_www]', $this->url_real_host_with_www, $s);
   $s = @str_replace('[url_real_host_no_www]', $this->url_real_host_without_www, $s);   
   //if ($this->strpos($s, '[url_host_ip]') !== false) {
	//$s = @str_replace('[url_host_ip]', $this->GetURLip(), $s); 
   //}   
   return $s;   	
  }//ReplaceCorrect
  
  /** Экранирвоание url */
  function GetEcranedURL($s) {
   $array = array(
    '&amp;' => '&',
    '&'     => '&amp;',
    "'"     => '&apos;',
    '"'     => '&quot;',
    '>'     => '&gt;',
    '<'     => '&lt;'   
   );
   foreach ($array as $key => $val) {
	$s = @str_replace($key, $val, $s);
   }	
   return $s;   	
  }//GetEcranedURL          
  
  /** технические методы работ с url */
  private function _CheckForReshotkaLink($qURL, $IgnoreIfReshotka) {
   if ((!$IgnoreIfReshotka) or ($qURL == '')) { return $qURL; }
   $res = $qURL;
   if ($this->substr($res, 0, 1) == '#') { return ''; }
   //$arr = str_split($res, 1);
   //проверка конечного результата
   for ($j=$this->strlen($res)-1; $j >= 0; $j--) {//for ($j=count($arr)-1; $j >= 0; $j--) {	    
	switch ($res[$j]) { //($arr[$j]) {
	 case '#': return '';
	 case '/': return $res;	 	
	}   	
   }    
   return $res;	
  }//CheckForReshotkaLink
  
  private function _GetRight(&$S, $delim) {
   $res = '';   
   //$arr = str_split($S, 1);   
   for ($j=$this->strlen($S)-1; $j >= 0; $j--) {//for ($j=count($arr)-1; $j >= 0; $j--) {
	$C = $S[$j];//$arr[$j];	
	if ($C != $delim) { $res.= $C; }	
	$S = @substr_replace($S, '', $j, 1);	
	if ($C == $delim) { return $res; }	
   }
   return $res;   	
  }//GetRight
  
  private function _GetUpedPath($S, $CurPage) {
   $P = @parse_url($CurPage);
   if (!$P) { return ''; }
   if (!isset($P['host'])) {
    $CurPage = ((isset($P['scheme'])) ? $P['scheme'] : 'http').'://'.$CurPage;
    $P = @parse_url($CurPage);		
   } 
   if (!$P || !isset($P['host']) || !isset($P['scheme'])) { return ''; }
   $Prot = $P['scheme'].'://';
   $Path = (isset($P['path'])) ? $P['path'] : '';
   $S1 = $S;
   $URI = $this->StrFetch($S1, '/'); 
   //убираем все вхождения в точки
   while ($URI == '.') { $URI = $this->StrFetch($S1, '/'); }
   //если первое вхождение не сработало - вернуть полный путь
   if ($URI == '') { return $CurPage.$S1; }
   //если нет хода вверх - вернуть как есть + каталог
   if ($URI != '..') {
	if ($URI != '') { if ($this->substr($Path, -1) != '/') { $Path.= '/'; } }
	if ($S1 != '') { $S1 = '/'.$S1; }
	return $Prot.$P['host'].$Path.$URI.$S1;	
   }
   //проверка обхода по каталогам
   if ((trim($Path) == '') or (trim($Path) == '/')) {
    while ($URI == '..') { $URI = $this->StrFetch($S1, '/'); }
    if ($URI != '') { if ($Path == '') { $Path .= '/'; } }
    if ($S1 != '') { $S1 = '/'.$S1; }
    return $Prot.$P['host'].$Path.$URI.$S1;		
   }
   //проверка на завершающий слэш
   $S3 = '';
   if ($this->substr($Path, -1) == '/') { $Path = @substr_replace($Path, '', -1); } else {
    $this->_GetRight($Path, '/');	
   }
   if (($S1 != '') and ($this->substr($S1, -1) == '/')) { $S3 = '/'; }
   //обход по всем вложения - переходам
   while ($URI == '..') {
	$S2 = $this->_GetRight($Path, '/');
	//получить следующий параметр на обход
	$URI = $this->StrFetch($S1, '/');	
   }
   //убираем все вхождения в точки
   while ($URI == '.') { $URI = $this->StrFetch($S1, '/'); }
   //закладываем путь
   if ($URI != '') { $URI = '/'.$URI; }
   if ($S1 != '') { $URI .= '/'.$S1; }
   $Path .= $URI.$S3;
   return $Prot.$P['host'].$Path;	
  }//_GetUpedPath

  private function _CheckIgnored($S, $LowerS, $IgnoredBeginsLink) {  	
   if (!$IgnoredBeginsLink || !@is_array($IgnoredBeginsLink)) { return false; }
   foreach ($IgnoredBeginsLink as $item) {
	if ($this->substr($LowerS, 0, $this->strlen($item)) == $item) { return true; }	
   }
   return false;	
  }//_CheckIgnored
  
  private function _CheckBeginInsided($S, $FURL, $LowerHost) {
   $res = $FURL;
   $P = @parse_url($res);
   if ((!isset($P)) or (!isset($P['host'])) or (!isset($P['path'])) or ($P['path'] == '') or ($P['path'] == '/')) {
    return ((isset($P['scheme'])) ? $P['scheme'] : 'http').'://'.$P['host'].'/'.$S;	
   }   
   if ($this->substr($P['path'], 0, 1) != '/') { $P['path'] .= '/'; }
   $res = ((isset($P['scheme'])) ? $P['scheme'] : 'http').'://'.$P['host'].$P['path'];      
   $this->_GetRight($res, '/');   
   return $res.'/'.$S;   	
  }//_CheckBeginInsided 
     
  /** корреткировка ссылки под хост и порт
  * @uHost - хост с которым происходит сравнение
  * @uPort - протокол если пусто - используется http
  * @FURL - страница, с которой идет сравнение (полный путь)
  * @URL - страница для обработки (например: ../index.php)
  * 
  * @IgnoreIfReshotka - игнорировать ссылки с # в url
  * @CompereHostWWWandNotSympleLink - если ссылка указана без протокола, но начинается с хоста сайта -
  * будет воспринято как путь от начала.
  * @IgnoredBeginsLink - список начал ссылок, игнорируемые при проверки (нижний регистр) 
  * (сравнение идет до первого вхождения части ссылки)
  *   
  * Если не успешно, или пропущено - пусто, иначе трансформированная ссылка 
  * @return string  
  */
  function CorrectLinkToHostAndPort($uHost, $uPort, $FURL, $URL, $IgnoreIfReshotka=false, 
   $CompereHostWWWandNotSympleLink = false, $IgnoredBeginsLink = array('mailto:', 'emailto:', 'javascript:', 'wmk:')) {
   global $_SS_GLOBAL_PROTOCOL_LIST_WS; 	
   $res = '';
   if ($uPort == '') { $uPort = 'http'; }
   $S = $this->_CheckForReshotkaLink(trim($URL), $IgnoreIfReshotka);
   if ($S == '') { return $res; }
   $LowerS = $this->strtolower($S);
   $LowerHost = $this->strtolower($uHost);
   //если обращение на главную страницу
   if ($S == '/') { return $uPort.'://'.$uHost; }
   //если обращение от первой страницы
   if ($S[0] == '/') {
	//внешняя
	if ($this->substr($S, 0, 2) == '//') { return $uPort.':'.$S; }
	return $uPort.'://'.$uHost.$S;	
   }
   //если решетка - взять тот же адрес
   if ($S[0] == '#') { return $FURL.$S; }
   //проверка существования протокола,если протокол не установлен - ссылка сторонняя   
   if ($this->substr($LowerS, 0, $this->strlen($uPort.'://')) != $this->strtolower($uPort).'://') { 
	//проверка на внешнюю ссылку заранее
	foreach ($_SS_GLOBAL_PROTOCOL_LIST_WS as $item) {	
	 if ($this->substr($LowerS, 0, $this->strlen($item.'://')) == $item.'://') {
	  //прямо
	  if ($LowerS != $item.'://') { $res = $S; }
	  return $res;	  	
	 }	
	}//forech	
	if ($CompereHostWWWandNotSympleLink) {
	 //проверка на обращение к хосту
	 if (($this->substr($LowerS, 0, $this->strlen($LowerHost)) == $LowerHost) or 
	  ($this->substr($LowerS, 0, $this->strlen('www.'.$LowerHost)) == 'www.'.$LowerHost)) {
	  return $uPort.'://'.$S;	
	 } elseif (($this->substr('www.'.$LowerS, 0, $this->strlen($LowerHost)) == $LowerHost)) {
	 	return $uPort.'://www.'.$S; 
	 }	 	
	}//$CompereHostWWWandNotSympleLink 
	//проверка на идентификаторы скриптов
	if ($this->_CheckIgnored($S, $LowerS, $IgnoredBeginsLink)) { return $res; }
	//проверка устанвоки перехода на текущей ссылке
	if ($this->substr($S, 0, 2) == './') {
	 //удалить все вхождения
	 while ($this->substr($S, 0, 2) == './') { $S = @substr_replace($S, '', 0, 2); }
	 //обработать как текущий каталог
	 return $this->_CheckBeginInsided($S, $FURL, $LowerHost);		
	}
	//проверка на уход в верх от каталога текущего
	if ($S[0] == '.') { return $this->_GetUpedPath($S, $FURL); }
	//составление ссылки общей по структуре
	if ($S[0] != '/') { return $this->_CheckBeginInsided($S, $FURL, $LowerHost); }	
   }//inside (passible)
   return $S;   	
  }//CorrectLinkToHostAndPort  
  
  /** получение типа ссылки
  * SS_IK_LINK_ERROR - ошибка
  * SS_IK_LINK_INSIDE - внутренняя ссылка
  * SS_IK_LINK_OUTSIDE - внешняя
  * SS_IK_LINK_SUBDOM - ссылка на поддомен
  * 
  * ссылка должна быть в полной форме (прмиер: http://ссылка, возможно без протокола, но с доменом!)      
  * @return int 
  */
  function GetLinkType($uHost, $URL, $WWWandNoWWWasLikeOne=true) {
   if (trim($URL) == '') { return SS_IK_LINK_ERROR; }
   $P = @parse_url($this->strtolower($URL));
   if (!$P) { return SS_IK_LINK_ERROR; }
   if (!isset($P['host'])) {
    $URL = ((isset($P['scheme'])) ? $P['scheme'] : 'http').'://'.$URL;
    $P = @parse_url($this->strtolower($URL));		
   } 
   if (!$P || !isset($P['host']) || !isset($P['scheme'])) { return SS_IK_LINK_ERROR; }
   $Para = $this->strtolower($uHost);
   $res = SS_IK_LINK_INSIDE;
   //обработка основного хоста
   if ($WWWandNoWWWasLikeOne) {
	//основной хост
	if ($this->substr($Para, 0, 4) == 'www.') { $Para = @substr_replace($Para, '', 0, 4); }
	//проверяемый хост
	if ($this->substr($P['host'], 0, 4) == 'www.') { $P['host'] = @substr_replace($P['host'], '', 0, 4); }	
   }
   //проверка
   if ($Para != $P['host']) { $res = SS_IK_LINK_OUTSIDE; }
   $I = $this->strlen($P['host']);
   $J = $this->strlen($Para);
   if ($I <= $J) { return $res; }      
   $URL = $this->substr($P['host'],(($I-$J-1 < 0) ? 0 : $I-$J-1), $J+1);
   if ($URL == '.'.$Para) { $res = SS_IK_LINK_SUBDOM; }   
   return $res;	
  }//GetLinkType
  
  /** получение ip сайта */
  function GetURLip($host=false) {
   $h = ($host) ? $host : $this->url_real_host;
   if ($this->tempurl_ip && $h && isset($this->tempurl_ip[$h]) && ($this->tempurl_ip[$h] != '')) {
    return $this->tempurl_ip[$h];	
   }   
   $ip = ($host) ? @gethostbyname($host) : @gethostbyname($this->url_real_host);
   $this->tempurl_ip[$h] = $ip;  //= array("$h" => $ip);
   return $ip;      	
  }//GetURLip
  
  /** получение сервера сайта
  * @return false or value  
  */
  function GetIPServer($ip=false) {
   $h = ($ip) ? $ip : $this->GetURLip();
   return (@preg_match('/(\d+).(\d+).(\d+).(\d+)/', $h) && ($hh = @gethostbyaddr($ip))) ? $hh : false;	
  }//GetIPServer  
  
  /** получение расширения файла по mime типу (для изображений)
  * @return === false or string
  */
  function GetImageMimeTypeFileExt($mimetype='image/png') {
   global $_SS_GLOBAL_MIME_TYPES_DESCR;
   $mimetype = $this->strtolower($mimetype);
   return (@isset($_SS_GLOBAL_MIME_TYPES_DESCR[$mimetype])) ? $_SS_GLOBAL_MIME_TYPES_DESCR[$mimetype] : false;   	
  }//GetImageMimeTypeFileExt  
  
  /** получение idna_convert класса
  * @return idna_convert or false 
  */
  function GetIdna_converter() { return (!$this->idna_obj) ? false : $this->idna_obj; }
  
  /** уничтожение idna_convert класса */
  function UnsetIdna_converter() { if ($this->idna_obj) { unset($this->idna_obj); } }
  
  /** декодировка кириллического адреса с учетом текущей активной кодировки
  * @input string 
  * @return string
  */
  function PunDecode($s) {  	
   return (!$this->idna_obj) ? $s : DoEncodeDataToDef(@$this->idna_obj->decode(DoDecodeDataToDef($s)));   	
  }//PunDecode
  
  /** кодирование кириллического домена с учетом активной кодировки 
  * @input string 
  * @return string
  */
  function PunEncode($s) {
   return (!$this->idna_obj) ? $s : DoEncodeDataToDef(@$this->idna_obj->encode(DoDecodeDataToDef($s)));  	
  }//PunEncode    
  
  /** комбинирование url из массива информации о ссылке
  * @input array (as parse_url)
  * @return === false or string
  */
  function CombineURLByInfo($info) {   	
   if (!$info || !isset($info['scheme']) || !isset($info['host'])) { return false; }
   return $info['scheme'].'://'.$info['host'].((isset($info['port']) ? (':'.$info['port']) : '')).
   ((isset($info['path']) ? $info['path'] : '')).((isset($info['query']) ? ('?'.$info['query']) : '')).
   ((isset($info['fragment']) ? ('#'.$info['fragment']) : ''));   	
  }//CombineURLByInfo
  
  /** проверка необходимости конвертации из utf-8 */
  protected function NeedCharsetConversion($s) {
   return !@preg_replace('#[\x00-\x7F]|\xD0[\x81\x90-\xBF]|\xD1[\x91\x80-\x8F]#s', '', $s);	  	
   /*$I = $this->strlen($s);      
   for ($j=0; $j<=$I-1; $j++) {   	
    if ((ord($s[$j]) > 127) or (ord($s[$j]) == 0)) { return true; }	
   }
   return false;*/   	
  }//NeedCharsetConversion  
  
  /** обработка информации о url на предмет раскодировки, расконвертации и т.п
  * @input array
  * @return array
  */
  function CorrectInputURLInfo($info) {
   if (!$info || !@is_array($info)) { return $info; } 
   if (!$this->idna_obj && !$this->connect_decode_encoded_string) { return $info; }
   foreach ($info as $name => $item) {
	switch ($name) {
	 case 'host': 
	  if ($this->idna_obj) { $info[$name] = $this->PunDecode($info[$name]); } 
	  if (!$this->connect_decode_encoded_string) { return $info; }
	  break;
	 case 'path'://default:
	  if (!$this->connect_decode_encoded_string) { break; }
	  //конвертация элементов	  
	  $info[$name] = @urldecode($info[$name]);
	  //кодировка строки
	  $temp = '';
	  $n_ch = $this->NeedCharsetConversion($info[$name]);
	  if ((SEOSCRIPTDEFENCODE != 'UTF-8') and ($n_ch)) {
	   $temp = @iconv("UTF-8", SEOSCRIPTDEFENCODE, $info[$name]);
	  } 
	  //по умолчанию используется как windows-1251
	  //закомментировать, чтобы убрать поддержку
	  elseif ((SEOSCRIPTDEFENCODE == 'UTF-8') and (!$n_ch)) {
	   $temp = @iconv('WINDOWS-1251', "UTF-8", $info[$name]);	
	  }
	  //передать данные, если получены
	  if ($temp != '') { $info[$name] = $temp; }	   	
	  break;	   	
	}//switch
   }//foreach
   return $info;   	
  }//CorrectInputURLInfo
  
  /** обработка информации о url на предмет закодирвоки, конвертации и т.п для корректного
  *   соединения 
  * @input array
  * @getas_url если true - возвращает сформированный url для запроса иначе массив информации
  *   
  * @return array or (=== false or string)
  */
  function CorrectSendURLInfo($info, $getas_url=false) {
   if (!$info || !@is_array($info)) { return ($getas_url) ? false : $info; }
   foreach ($info as $name => $item) {
	switch ($name) {
	 case 'host': 
	  if ($this->idna_obj) { $info[$name] = $this->PunEncode($info[$name]); } 
	  break;
	 case 'path': //default:
	  if (!$this->connect_decode_encoded_string) { break; }	  
	  //кодировка строки
	  //закомментировать, если убрать данную поддержку
	  $temp = (!$this->NeedCharsetConversion($info[$name])) ? 
	  @iconv('WINDOWS-1251', "UTF-8", $info[$name]) : $info[$name];
	  if ($temp != '') { $info[$name] = $temp; }	  	 
	  //конвертация элементов
	  $s_dd = 'stripedslashcommadeltocorrect';
	  $info[$name] = @str_replace('/', $s_dd, $info[$name]);	  	  
	  $info[$name] = @urlencode($info[$name]);
	  $info[$name] = @str_replace($s_dd, '/', $info[$name]);
	  break;	   	
	}//switch
   }//foreach
   return ($getas_url) ? $this->CombineURLByInfo($info) : $info; 	
  }//CorrectSendURLInfo
  
  /** возвращение текущей активной и пригодной для запроса ссылки соединения
  * @return === false or string  
  */
  function GetCorrectedSendLink() {
   return (!$this->url_array_info) ? false : $this->CorrectSendURLInfo($this->url_array_info, true);  	
  }//GetCorrectedSendLink              
  
  /** устанвока url для последующего запроса, если не указывать url при запросе
  * @return bool 
  */
  function SetURL($url) {
   if (trim($url) == '') { return false; }
   //correct url   	
   $this->url_self = $url;   
   $P = @parse_url($this->url_self);
   if (!$P) { return false; }
   if (!isset($P['host'])) {
    $this->url_self = ((isset($P['scheme'])) ? $P['scheme'] : 'http').'://'.$this->url_self;
    $P = @parse_url($this->url_self);		
   }
   if (!$P) { return false; }
   //url without protocol
   $this->url_self_no_protocol = ($this->strtolower($this->substr($this->url_self, 0, 7)) == 'http://') ? 
   @substr_replace($this->url_self, '', 0, 7) : $this->url_self;   
   //check url corrected
   $P = $this->CorrectInputURLInfo($P);      
   //combine url
   $this->url_self = $this->CombineURLByInfo($P);
   if ($this->url_self === false) { return false; }   
   //host
   $this->url_host = $P['host'];
   //real host
   $this->url_real_host = ($this->idna_obj) ? $this->PunEncode($this->url_host) : $this->url_host; 
   //protocol
   $this->url_protocol = $P['scheme'];
   //host and prot
   $this->url_host_and_protocol = $this->url_protocol.'://'.$this->url_host;
   //host and www
   $this->url_host_and_www = 
   (($this->strtolower($this->substr($this->url_host, 0, 4)) != 'www.') ? 'www.' : '').$this->url_host;  
   
   $this->url_real_host_with_www = 
   (($this->strtolower($this->substr($this->url_real_host, 0, 4)) != 'www.') ? 'www.' : '').$this->url_real_host;  
   //host without www
   $this->url_host_without_www = 
   (($this->strtolower($this->substr($this->url_host, 0, 4)) == 'www.') ? 
   @substr_replace($this->url_host, '', 0, 4) : $this->url_host);
   
   $this->url_real_host_without_www = 
   (($this->strtolower($this->substr($this->url_real_host, 0, 4)) == 'www.') ? 
   @substr_replace($this->url_real_host, '', 0, 4) : $this->url_real_host);      
   //ather info
   $this->url_array_info = $P;
   return true;   	
  }//SetURL
  
  /** получение заголовка */
  private function GetHeader($ch,$allcontent) {
   $header_size = @curl_getinfo($ch, CURLINFO_HEADER_SIZE);
   $headers = $this->substr($allcontent, 0, $header_size - 4);	
   return $headers;	
  }//GetHeader
  
  /** получение текста запроса, удаление заголовка */
  private function GetBodyData($ch, $allcontent) {
   return (!$this->connect_delete_header_source) ? $allcontent : 
   $this->substr($allcontent, curl_getinfo($ch, CURLINFO_HEADER_SIZE) - 4);	
  }//GetBodyData
  
  /** установка текста ошибки
  * @return bool (false)  
  */
  private function _doError($s) {
   $this->res_error = DoEncodeDataToDef($s);
   return false;
  }//_doError
  
  /** обход запроса curl */
  protected function _DoWayToPathURL($ch) {	
   static $curl_loops = 0;
   if ($curl_loops++ >= SS_MAX_REDIRECT_COUNT_WS) { $curl_loops = 0; return false; }
   @curl_setopt($ch, CURLOPT_HEADER, 1);
   @curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
   if ($this->connect_refferer_send) @curl_setopt($ch, CURLOPT_REFERER, $this->connect_refferer_send);   
   $data = @curl_exec($ch);
   $debbbb = $data;
   list($header, $data) = @explode("\n\n", $data, 2);
   $http_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
   $this->res_http_code = $http_code;
   if ($this->connect_follow_redirect && ($http_code == 301 || $http_code == 302)) {
    $matches = array();
    @preg_match('/Location:(.*?)\n/', $header, $matches);
	$last_url = @parse_url(@curl_getinfo($ch, CURLINFO_EFFECTIVE_URL)); 	
	if (!isset($last_url['host'])) { $last_url['host'] = $this->url_host; }
	if (!isset($last_url['scheme'])) { $last_url['scheme'] = $this->url_protocol; }		
	$url = @parse_url($this->CorrectLinkToHostAndPort($last_url['host'], $last_url['scheme'], 
	$this->CombineURLByInfo($last_url), trim(array_pop($matches)), false, true)); 
    if (!$url) { 
	 $curl_loops = 0; 
	 $this->res_header_source = $this->GetHeader($ch, $header);
	 return $this->GetBodyData($ch, $debbbb); 
	}    
    $new_url = $this->CombineURLByInfo($url);
	if ($new_url === false) { 
	 $curl_loops = 0;
	 $this->res_header_source = $this->GetHeader($ch, $header); 
	 return $this->GetBodyData($ch, $debbbb); 
	}    
    @curl_setopt($ch, CURLOPT_URL, $new_url);
    @curl_setopt($ch, CURLOPT_TIMEOUT, $this->connect_time_out);
    $this->res_redirect_link = $new_url;	
	$this->res_redirect_list[] = array(
     'link'=>$this->res_redirect_link,
     'code'=>$http_code,
     'data'=>$this->GetHeader($ch, $header)		    
    );   
    return $this->_DoWayToPathURL($ch);
   } else { 
   	$curl_loops = 0;
	$this->res_header_source = $this->GetHeader($ch, $header);
    $this->header_source_inf = $this->res_header_source;	
	$this->res_server = (@preg_match('/Server:(.*?)\n/i', $this->res_header_source, $arr)) ? $arr[1] : '';		 
	return $this->GetBodyData($ch, $debbbb); 
   }	   	
  }//_DoWayToPathURL
  
  /** установка пароля и логина для авторизации при запросе */
  function SetLoginAndPass($login='',$password='') {
   $this->connect_login = $login;
   $this->connect_password = $password;	
  }//SetLoginAndPass
  
  /** проверка типа ссылки */
  private function CheckTypeLink($cont_type) {
   if ((trim($cont_type) == '') or (!$this->connect_mime_types)) { return true; }
   $val = explode(";", $cont_type);
   return (!$val[0]) ? true : @in_array($this->strtolower(trim($val[0])), $this->connect_mime_types);  	
  }//CheckTipeLink
  
  /** внешний запрос, по указанному методу */
  function RequestAction($metchod='GET', $postdata='') {
   global $_SS_ERROR_BY_CODE;	
   $this->res_header_source = '';
   $this->res_http_code = 404;
   $this->res_redirect_link = '';
   $this->res_redirect_list = array();
   $this->res_error = '';
   $this->res_server = '';
   $this->res_time_query = 0;
   $this->res_general_answer_info = false;
   $this->res_url_size = 0;
   $this->res_load_speed = 0;
   $this->url_query_link = false;
   if (!$this->url_array_info) { return $this->_doError(SS_NO_INITIALIZE_URL_TO_CONNECT); }
   $ch = @curl_init();
   if (!$ch) { return $this->_doError(SS_CURL_NO_FOUND); }
   $this->url_query_link = $this->GetCorrectedSendLink();   
   if (!$this->url_query_link) { return $this->_doError(SS_ERROR_SET_URL_TO_CONNECT); }
   //устанвока параметров     
   @curl_setopt($ch, CURLOPT_URL, $this->url_query_link);
   @curl_setopt($ch, CURLOPT_TIMEOUT, $this->connect_time_out);
   @curl_setopt($ch, CURLOPT_USERAGENT, SS_USERAGENTDATASET);
   switch ($this->strtoupper($metchod)) {
	case 'POST':
	 @curl_setopt($ch, CURLOPT_POST, 1);
	 if (@is_array($postdata)) {
	  $p_data = array();
	  foreach ($pdata as $name => $value) {
	   $p_data[] = $name.'='.urlencode($value);	
	  } 	
	 } else { $p_data = $postdata; }	 
	 @curl_setopt($ch, CURLOPT_POSTFIELDS,((@is_array($p_data)) ? join('&', $p_data) : $p_data));
	 break;
	case 'HEAD':
	 @curl_setopt($ch, CURLOPT_NOBODY, 1);
	 break; 
   }//switch
   
   if ($this->connect_caiinfo && @file_exists($this->connect_caiinfo)) {
	@curl_setopt($ch, CURLOPT_CAINFO, $this->connect_caiinfo);
	@curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);	
   } 
    elseif (@strtolower($this->url_protocol) == 'https') {    
     @curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
     @curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);   
   }
   
   if ($this->connect_login != '') {
    @curl_setopt($ch, CURLOPT_USERPWD, $this->connect_login.':'.$this->connect_password);	
   }
   if ($this->connect_use_cookies) {
   	if ($this->connect_use_cookies_as_string) {
	 @curl_setopt($ch, CURLOPT_COOKIE, $this->connect_use_cookies);	 	
	} else {	    
	 @curl_setopt($ch, CURLOPT_COOKIEJAR,  $this->connect_use_cookies);
	 @curl_setopt($ch, CURLOPT_COOKIEFILE, $this->connect_use_cookies);
	} 
   }
   if ($this->connect_use_proxy && ($this->connect_proxy_get_prog !== false)) {
   	$res = false;
   	if ((@is_array($this->connect_proxy_get_prog) && @method_exists($this->connect_proxy_get_prog[0], 
	$this->connect_proxy_get_prog[1])) || @function_exists($this->connect_proxy_get_prog)) {
	 $res = @call_user_func($this->connect_proxy_get_prog, $this); 	
	}
	if ($res && @is_array($res) && isset($res['host'])) {
	 @curl_setopt($ch, CURLOPT_PROXY, $res['host']);
	 if (isset($res['type'])) {
	  switch ($res['type']) {
	   case CURLPROXY_SOCKS4:
	   case CURLPROXY_SOCKS5:
	    @curl_setopt($ch, CURLOPT_PROXYTYPE, $res['type']);
		break;	   	
	  }	
	 }
	 if (isset($res['auth'])) {
	  @curl_setopt($ch, CURLOPT_PROXYUSERPWD, $res['auth']);	  	
	 }	 	
	}//do set	
   }   
   //запрос
   $this->StartTime();
   $data = $this->_DoWayToPathURL($ch);      
   //if ($data === false) { return false; }
   $this->res_time_query = $this->GetCurTimeOfStart();
   //получение данных  
   $this->res_general_answer_info = @curl_getinfo($ch);   
   $this->res_http_code = $this->res_general_answer_info['http_code'];   
   if ($this->res_http_code == '') { return $this->_doError(_SS_ERROR_NO_EXISTS); } 
   //elseif (isset($_SS_ERROR_BY_CODE[$this->res_http_code]) && ($_SS_ERROR_BY_CODE[$this->res_http_code] != '')) {
   // return $this->_doError($_SS_ERROR_BY_CODE[$this->res_http_code]);
   //}    
   if (isset($this->res_general_answer_info['content_type']) && 
   !$this->CheckTypeLink($this->res_general_answer_info['content_type'])) {
    return $this->_doError($_SS_ERROR_BY_CODE['17'].' ['.$this->res_general_answer_info['content_type'].']');	
   }
   $scode = $this->substr($this->res_http_code,0,1);
   if (@in_array($scode, array('4','5'))) { return $this->_doError($_SS_ERROR_BY_CODE[$this->res_http_code]); }
   if ($this->res_general_answer_info['request_size'] > 0) {
	$this->res_general_answer_info['size_download'] = $this->res_general_answer_info['request_size'];
   }   
   $d_size = 0;
   //if ($this->res_general_answer_info['size_download'] <= 0) {
//	$d_size = $this->strlen($data);
//	$this->res_general_answer_info['size_download'] = $d_size;	
//   }
   $this->SetContent($data, $d_size, $this->connect_do_encoded_page, $this->connect_delete_spec_tags);
   
   $this->res_url_size = $this->GetDataLength(); //$this->res_general_answer_info['size_download'];
   
   $this->res_load_speed = @round((($this->res_url_size /* / 1024 */ ) / (($this->res_time_query == 0) ? 1: 
   $this->res_time_query)) /* * 8*/, 2);
   $this->res_time_query = @round($this->res_time_query, 2);
   
   //$this->res_url_size = ($this->res_url_size) ? round($this->res_url_size / 1024, 2) : 0;
   
   return ($this->res_error == '') ? true : false;   	
  }//RequestAction
  
  /** GET запрос
  * @return bool  
  */
  function RequestGET($url) {
   return (!$this->SetURL($url)) ? $this->_doError(SS_ERROR_SET_URL_TO_CONNECT) : 
   $this->RequestAction();   	
  }//RequestGET
  
  /** POST запрос
  * @return bool  
  */
  function RequestPOST($url, $post_data='') {
   return (!$this->SetURL($url)) ? $this->_doError(SS_ERROR_SET_URL_TO_CONNECT) : 
   $this->RequestAction('POST', $post_data);
  }//RequestGET
  
  /** COOKIES из заголовка */
  function GetCOOKIESfromHeader($header_str=false) {
   $header_str = ($header_str) ? $header_str : (($this->res_header_source) ? $this->res_header_source : '');
   @preg_match_all("!Set\-Cookie\: (.*)=(.*);!siU", $header_str, $m);
   $result = '';
   foreach($m[1] as $i=>$k){ $result .= "$k={$m[2][$i]}; "; }
   return $result;  	
  }//GetCOOKIESfromHeader  
   	 	
 }//ss_ConnentQuery
 //-----------------------------------------------------------------
 /** объект пользовательский, для доступа к внешним ресурсам с авто отключенным прокси */
 class ss_HTTP_obj extends ss_ConnectQuery {
  
  function __construct() {
   parent::__construct();
   $this->connect_use_proxy = false;	
  }
  	
 }//ss_HTTP_obj  
 //-----------------------------------------------------------------
 /** список плагинов */
 class ss_Plugin_obj_List {
  private $owner = null;
  private $Request = false;
  var $pluginslist = array();
  
  function __construct(ss_ConnectQuery $AOwner) {
   $this->owner = $AOwner;
   if (!$this->owner) { _ssDoError(SS_ERROR_GET_OWNER_OBJ_DATA); }
   $this->pluginslist = array();
   $this->Request = false;      	
  }//__construct
  
  function CheckRequest() {  	
   if (!$this->Request) { $this->Request = new ss_ConnectQuery(); }
   return $this->Request;   	
  }//CheckRequest
  
  function GetRequest() { return $this->Request; }
  function GetOwner() { return $this->owner; }
  
  /** получение списка плагинов */
  function GetPlugins() { return $this->pluginslist; }
  
  /** добавление плагина
  * @return extends ss_Plugin_obj or === false  
  */
  function CreatePlugin($clazz_name) {
   $f2clazz_name = $clazz_name; 
   $clazz_name = 'ss_Plugin_'.$clazz_name;
   
   if (@class_exists($clazz_name)) return new $clazz_name($this);
    
   $file_plugin = SEOSCRIPTLIBPATHX.'/plugins/lt/'.$f2clazz_name.'.php';
   if (!@file_exists($file_plugin)) return false;
   
   require_once $file_plugin;
 
   return (@class_exists($clazz_name)) ? new $clazz_name($this) : false;   	
  }//CreatePlugin
  
  /** выполнение плагина
  * @return === false or value  
  */
  function RunPlugin($id, $runparams=false) {
   $clazz = isset($this->pluginslist[$id]) ? $this->pluginslist[$id] : $this->CreatePlugin($id); 
   if (!$clazz) { _ssDoError('Plugin [ss_Plugin_'.$id.'] not found!'); }   
   return @call_user_func(array($clazz, 'ActionPlugin'), $runparams);     		
   //return ($clazz) ? @call_user_func(array($clazz, 'ActionPlugin')) : false;   	
  }//RunPlugin
  
  /** получение плагина
  * @return extends ss_Plugin_obj or === false  
  */    
  function GetPlugin($id) {
   return (isset($this->pluginslist[$id])) ? $this->pluginslist[$id] : false;   	
  }//GetPlugin
	
 }//ss_Plugin_obj_List 
 //-----------------------------------------------------------------
 /** плагин элемент */
 interface ss_Plugin_obj_Interface {
  function ExecPlugin(ss_ConnectQuery &$Request);  	
 }
 //-----------------------------------------------------------------
 /** плагин элемент, шаблон */
 abstract class ss_Plugin_obj extends ss_text_control implements ss_Plugin_obj_Interface {
  private $owner = null;
  private $cach_obj = null;
  private $runparams = false;
  protected
   $id,
   $name,
   $descr,
   $storeddays,
   $error,
   $Request;
  /** использовать новый элемент $Request */ 
  var $use_new_Request = false;
  var $lastupdatecachdate = false;
  
  function __construct(ss_Plugin_obj_List $AOwner, $id=false, $name='No name', $descr='Unnamed plugin', $storeddays=2) {
   $this->owner = $AOwner;
   if (!$this->owner) { _ssDoError(SS_ERROR_GET_OWNER_OBJ_DATA); } 
   $this->id = ($id === false) ? md5($this->GetThisDateTime().(@rand(0,5000))) : $id;
   $this->name = $name;
   $this->descr = $descr;
   $this->storeddays = $storeddays;
   $this->owner->pluginslist[$this->id] = $this;
   $this->error = '';
   $this->Request = false;        	
  }//__construct
  
  function GetPluginID() { return $this->id; }
  function GetPluginName() { return $this->name; }
  function GetPluginDescr() { return $this->descr; }
  function GetPluginStoredDays() { return $this->storeddays; }
  function GetError() { return ($this->error == '') ? false : DoEncodeDataToDef($this->error); }
  function SetError($s) { $this->error = $s; return false; }
  function GetOwner() { return $this->owner; }
  function GetRunParams() { return $this->runparams; }
  function GetConnect() { return $this->owner->GetOwner(); }
  function GetSelfRequest() { return $this->Request; }
  
  /** получение идентификатора секции сайта для кэша */
  function GetCachURLmd5() { return @md5($this->strtolower($this->GetConnect()->url_self));	}
  
  /** флаг использования большого объема данных */
  function GetFlagUseLongData() { return false; }
  
  /** дата последнего обновления кэша, если данные получены с кэша */
  function GetLastCachUpdateDate() { return $this->lastupdatecachdate; }
  
  /** Установка объекта кэша */
  function SetCach($cachObj) { $this->cach_obj = $cachObj; }
  
  protected function PrepereInfoToCach() {
   if (!$this->cach_obj || ($this->storeddays <= 0)) { return false; }
   $this->cach_obj->SetObjInfo(
    array(
	 'url' => $this->owner->GetOwner(), //объект url
	 'plugins' => $this->owner, //список плагинов
	 'plugin' => $this //текущий плагин	
	)   
   );
   return true;   	
  }//PrepereInfoToCach
  
  /** выполнение
  *  @return === false or value  
  */
  function ActionPlugin($runparams=false) {
   $this->lastupdatecachdate = false;	
   $this->runparams = $runparams;		   	
   $val = false;
   $use_cach = $this->PrepereInfoToCach() && (!$this->runparams || !isset($this->runparams['ignorecach']));
   //чтение из кэша
   if ($use_cach) {
   	$this->cach_obj->UpdateCach();
   	//проверить автоудаление кэша при загрузки
   	if ($this->runparams && isset($this->runparams['dodeletecachonread']) && $this->runparams['dodeletecachonread']) {
	 $this->cach_obj->DeleteCachItem();	  	
	} else {
	 //получить данные	 
	 $val = $this->cach_obj->Read(); 
	}					
	if ($val !== false) { return $val; }
	//remember obj info for multithreads action
    $info = $this->cach_obj->GetObjInfo();	
   }
   //проверка выполнения запроса
   if ($this->runparams && isset($this->runparams['dorequsturl']) && $this->runparams['dorequsturl']) {
   	if (!$this->GetConnect()->RequestAction(
	 ((isset($this->runparams['dorequsturlmetchod'])) ? $this->runparams['dorequsturlmetchod'] : 'GET'),
	 ((isset($this->runparams['dorequsturlpostfields'])) ? $this->runparams['dorequsturlpostfields'] : '')	  
	)) { return $this->SetError($this->GetConnect()->res_error); }
   }    
   //обработка новая
   if (!$this->Request) { 
   	$this->Request = ($this->use_new_Request) ? new ss_ConnectQuery() : $this->owner->CheckRequest();		
   }   
   $val = $this->ExecPlugin($this->Request);
   //запись в кэш
   if (($val !== false) && $use_cach) {   	
   	//restore this plugin info
    $this->cach_obj->SetObjInfo($info);
	$this->cach_obj->Write($val);	
   }
   return $val;   	
  }//ActionPlugin 
  	
 }//ss_Plugin_obj
 //-----------------------------------------------------------------
 /** объект списка стоп слов */
 class ss_StopWords_obj extends ss_text_control {
 	
  /** каталог файлов стоп-слов */	
  private $path = STOPWORDSPATH;
  /** список файлов стоп-слов */
  private $files = false;
  /** список стоп-слов */
  private $stop_words = '';
  
  /** Конструктор
  * @path - string or false (если false - каталог по умолчанию, или указанный каталог без / на конце)
  * @options - array or false (если false - список по умолчанию, или массив в формате:
  *  array(
  *   'имя_файла (например: myfile.txt)' => array(
  *     'encode' => кодировка_файла (например: UTF-8)  
  *   )  
  *  )  
  * )
  */   
  function __construct($path=false, $options=false) {
   global $_STOP_WORDS_FILES_LIST;	
   if ($path) { $this->path = $path; }
   $this->files = ($options && @is_array($options)) ? $options : $_STOP_WORDS_FILES_LIST;   	
  }//__construct
  
  /** обработка содержимого файла, генерация сиска слов */
  protected function PrepereTextForLoad($data) {
   $data = @str_replace("\n", " ", $data);
   return " $data ";   	
  }//PrepereTextForLoad
  
  /** подготовка списка стоп-слов
  * @dorestore - bool true for reset and load list
  *   
  * @return bool   
  */
  protected function PrepereToGetStopWordsList($dorestore=false) {
   if (!$dorestore && $this->stop_words) { return true; }
   $this->stop_words = '';
   if (!$this->files || !$this->path) { return false; }
   foreach ($this->files as $name => $item) {
	if (@file_exists($this->path.'/'.$name)) {
	 if ($data = @file_get_contents($this->path.'/'.$name)) {
	  if ($item['encode'] != SEOSCRIPTDEFENCODE) { $data = @iconv($item['encode'], SEOSCRIPTDEFENCODE, $data); }
	  $data = $this->ClearBreake($data, true, false);
	  $this->stop_words .= $this->PrepereTextForLoad($data);	  	
	 }	 	
	}	
   }
   return ($this->stop_words) ? true : false;   	
  }//PrepereToGetStopWordsList
  
  /** проверка слова на принадлежность стоп-слову */
  function CheckWord($word) {
   return ($word && $this->PrepereToGetStopWordsList() && $this->stripos($this->stop_words, " $word "));	
  }//CheckWord
  
  /** перезагрузить файлы стоп-слов */
  function ReloadStopWordFiles() { return $this->PrepereToGetStopWordsList(true); }
  
  /** получить список стоп-слов */
  function GetStopWordsList($norepeatwords=true) {
   if (!$this->PrepereToGetStopWordsList()) { return false; }
   while ($this->strpos($this->stop_words, "  ") !== false) { $this->stop_words = @str_replace("  ", " ", $this->stop_words); }
   return ($norepeatwords) ? @array_unique(@explode(" ", @trim($this->stop_words))) : @explode(" ", @trim($this->stop_words)); 
  }//GetStopWordsList  
  	
 }//ss_StopWords_obj
 //-----------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */   
?>