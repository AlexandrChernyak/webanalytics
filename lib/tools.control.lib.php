<?php
 /** Модуль обработки секции инструментов
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */  
 //-------------------------------------------------------
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 //-------------------------------------------------------
 /** шаблон элемента инструментов единичной секции */
 abstract class w_tools_gen_obj extends w_defext {
  var $section_id = '';
  var $control = null;
  var $global_user_info = false;
  var $global_string_identifier = false;
  var $error = false;
  var $class_full_name = 'w_toolitem_';	
  var $canrun = true;
  var $onlyforadmin = false;
  
  function __construct(w_Control_obj $control, $section_id) {
   global $global_user_info;	
   parent::__construct();
   $this->section_id = $section_id;
   $this->control = $control;
   $this->global_user_info = $global_user_info;
   $this->class_full_name .= $this->section_id;
   $this->global_string_identifier = $this->GetToolLimitInfoEx('descr');
  }//__construct
  
  /** статистика посещения инструмента */
  protected function DoIncVisitorsCount() {
   if (!$this->section_id || !$this->global_string_identifier || $this->control->IsAllowBotOnProject() ) { 
    return false; 
   }	
   $item = $this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem, tcount from {$this->control->tables_list['featutool']} ".
	"where Lower(tident)=Lower('{$this->section_id}') limit 1"
   ));
   if (!$item) {
	$this->control->db->INSERTAction('featutool', array(
	 'tident'    => $this->section_id,
	 'tdescript' => $this->global_string_identifier
	));
	return true;
   }
   $item['tcount']++;
   $this->control->db->UPDATEAction('featutool', array(
    'tcount'    => $item['tcount'],
    'tdescript' => $this->global_string_identifier
   ), "iditem='{$item['iditem']}'", "1");
   return true;	
  }//DoIncVisitorsCount	
  
  /** выполнение плагина */
  function ActionThisTool() {
   $this->SetSection_file('tools/tpl_'.$this->section_id.'.tpl');
   if ($this->global_string_identifier) {
	$this->AddSectionWay($this->global_string_identifier);
    $this->SetSection_stitle($this->global_string_identifier);
    $this->SetSection_title($this->global_string_identifier);
   }   
   if ($this->GetToolLimitInfoEx('keywords') && $this->GetText($this->GetToolLimitInfoEx('keywords'))) { 
   	$this->SetSectionInfo('key', $this->GetText($this->GetToolLimitInfoEx('keywords'))); 
   }  
   if ($this->GetToolLimitInfoEx('metadesc') && $this->GetText($this->GetToolLimitInfoEx('metadesc'))) { 
   	$this->SetSectionInfo('description', $this->GetText($this->GetToolLimitInfoEx('metadesc'))); 
   } 
   $this->onlyforadmin = $this->GetToolLimitInfoEx('onlyforadmin') && !$this->control->isadminstatus;
   $this->canrun = ($this->onlyforadmin) ? false : (!$this->GetToolLimitInfoEx('onlineonly') || $this->control->IsOnline());
   //inc visitors
   if ($this->canrun && !$this->IsAjax() && $_POST['doactiontool'] != 'do' && !$_GET['getimage'] && $_GET['q'] != 'get') {
	$this->DoIncVisitorsCount();
   }
   //action, only if can do it      
   if ($this->canrun || ($_GET['t2'] && $_GET['q'] == 'get')) { 
   	$this->_DoActionThisTool(); 
   } else { 
   	$this->SetError('Can`t access to this tool. Your not online, or not admin.'); 
   }
   //post this object 
   $this->control->smarty->assign('tool_object', $this);  	
  }//ActionThisTool
  
  abstract function _DoActionThisTool();
  
  /** получение информации о секции */
  function GetSectionInfo($name) {
   global $section_info;	
   return (isset($section_info[$name])) ? $section_info[$name] : '';   	
  }//GetSectionInfo
  
  /** установка информации о секции
  * @name - string идентификатор информации о секции
  * @value - string значение
  */
  function SetSectionInfo($name, $value) {
   global $section_info;
   $section_info[$name] = $value;   	
  }//SetSectionInfo
  
  /** добавление информации о секции */
  function AddSectionInfoNew($name, $value) {
   global $section_info;
   if (isset($section_info[$name])) {
	return $section_info[$name][] = $value;
   }	
   $section_info[$name] = array($value);
   return $value;   	
  }//AddSectionInfoNew   
  
  /** методы быстрой установки информации о секции */
  function SetSection_stitle($stringident) { $this->SetSectionInfo('stitle', $this->GetText($stringident)); }
  function SetSection_file($filename) { $this->SetSectionInfo('file', $filename); }
  function SetSection_title($stringident) {	 
   $this->SetSectionInfo('title', $this->GetText($stringident).' - '.$this->GetSectionInfo('title')); 
  }//SetSection_title  
  
  /** получение пути всего */
  function GetAllSectionWay() {
   global $section_way;
   return $section_way;	
  }//GetAllSectionWay
  
  /** добавление пути секции
  * @stringident - идентификатор строкового ресурса текущего языка
  * @path - пусть от /секция/
  */
  function AddSectionWay($stringident, $path='') {
   global $section_way;
   return $section_way[] = array(
    'name' => $this->control->GetText($stringident),
    'path' => W_SITEPATH.'tools/'.$this->section_id.'/'.$path    
   );   	
  }//AddSectionWay
  
  /** экранирование метода вывода текста по ресурсам */
  function GetText($name, $list=false, $def=false) { return $this->control->GetText($name, $list, $def); }
    
  /** установка ошибки, возврат false */
  function SetError($str) { $this->error = $str; return false; }
  
  /** проверка активации безлимитного использования сервиса по идентификатору
  * @ident - int номер счета оплаты без идентификатора пользователя
  */
  function IsNoLimitTool($ident) {
   if (!$this->control->IsOnline()) { return false; }
   $ident = $this->control->userdata['iduser'] + $ident + 0;
   $res = $this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem from {$this->control->tables_list['moneyhis']} where specidtran='$ident' and".
	" username='{$this->control->userdata['username']}' limit 1"
   ));
   return (!$res) ? false : true;	
  }//IsNoLimitTool
  
  function GetConstant($name) { return @constant($this->class_full_name.'::'.$name); }
  
  function CorrectURLLink($url, $count=0) {	
   if ($count <= 0 || $this->strlen($url) < $count) { return $url; }
   return $this->substr($url, 0, ($count > 3) ? ($count - 3) : $count).(($count > 3) ? '...' : '');	
  }//CorrectURLLink
  
  function CorrectLinkToProtocol($link) {
   $P = @parse_url($link);
   return ((isset($P['scheme'])) ? '' : 'http://').$link;	
  }//CorrectLinkToProtocol
  
  /** получение информации о ограничениях инструмнета */
  function GetToolLimitInfo() {
   global $_TOOLSNOLIMITACTIVATIONDATAINFO;
   return (isset($_TOOLSNOLIMITACTIVATIONDATAINFO[$this->section_id]) && $_TOOLSNOLIMITACTIVATIONDATAINFO[$this->section_id]) ?
   $_TOOLSNOLIMITACTIVATIONDATAINFO[$this->section_id] : false;   	
  }//GetLimitInfo
  
  /** получение отдельной информации лимита */
  function GetToolLimitInfoEx($name) {
   $info = $this->GetToolLimitInfo();
   return ($info && isset($info[$name])) ? $info[$name] : false; 	
  }//GetToolLimitInfoEx
  
  /** интервал задержки */
  protected function GetSleepInterval() {
   return ($val = $this->GetToolLimitInfoEx('sleep')) ? $val : $this->GetConstant('W_SLEEP_INTERVAL');	
  }//GetSleepInterval
  
  /** запрос по ajax */
  function IsAjax() { return @defined('W_IS_AJAX_MODE_RUN'); }     
  	
 }//w_tools_gen_obj
 //------------------------------------------------------- 
 /** шаблон объекта массовых проверок через ajax */
 abstract class w_tools_def_mass_ajax extends w_tools_gen_obj {
  const W_COUNT_OF_URL_ANALISYS = 10; //by default
  const W_SLEEP_INTERVAL = 0.4; 	  //by default
  const W_PAYTRANSACTIONNUMBER = 2;   //by default
  protected
   $isnolimit,
   $result;
   
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->isnolimit = null;	
   $this->result = false;
  }//__construct 
  
  protected function CorrectPostData() {
   $_POST['item']  = $this->CorrectSymplyString($_POST['item']);
   $_POST['count'] = $this->CorrectSymplyString($_POST['count']);
   $_POST['index'] = $this->CorrectSymplyString($_POST['index']);
   return (@is_numeric($_POST['count']) && @is_numeric($_POST['index']));	
  }//CorrectPostData
  
  function GetCurrentIndex() { return $_POST['index']; }
  function GetItemsCount() { return $_POST['count']; }
  function GetCurrentItem() { return $_POST['item']; }
  
  /** проверка инициализации объекта массовых проверок*/
  function CheckAjaxInitMassObj() { return parent::IsAjax() && $this->CorrectPostData(); } 
  
  /** инициализация js файлов массовых проверок */
  function InitJsFiles() {
   //$this->SetSectionInfo('csslist', array(
    //'jquery.tablesorter.pager.css'
   //));
   $this->SetSectionInfo('jslist', array(
    'jquery.tablesorter.min.js'//, 'jquery.tablesorter.pager.js'
   ));   	
  }//InitJsFiles
  
  /** количество на ограничение */
  function GetLimitCount() { 
   return ($val = $this->GetToolLimitInfoEx('count')) ? $val : $this->GetConstant('W_COUNT_OF_URL_ANALISYS');
  }//GetLimitCount 
  
  /** проверка идентификатора безлимитного использования сервиса */
  function IsNoLimitTool() {  	
   if ($this->isnolimit !== null) { return $this->isnolimit; }	 
   return $this->isnolimit = $this->GetLimitCount() <= 0 || !$this->GetToolLimitInfoEx('enabled') || 
   parent::IsNoLimitTool($this->GetConstant('W_PAYTRANSACTIONNUMBER')); 
  }//IsNoLimitTool
  
  /** оплата снятия ограничения */
  protected function BeginToPayLimitedData() {
   if (isset($_POST['tolimitoff']) && $_POST['tolimitoff'] && !$this->IsNoLimitTool() && $this->GetLimitCount() > 0) {
	//попытка оплатить снятие ограничения
	$price = $this->GetToolLimitInfoEx('price');
	if ($price <= 0 || !$this->control->IsOnline()) { return false; }
	//цена установлена - начало
	$str = $this->control->MoneyProcess($this->control->userdata['username'], 
	 $this->GetText('toolnolimitdescri', array($this->GetText($this->global_string_identifier))),
	 ($this->control->userdata['iduser'] + $this->GetConstant('W_PAYTRANSACTIONNUMBER')), $price, false, 'sub'
	);
	//вывод данных о результате
	if (!$str) { $this->isnolimit = null; }
	$result = "isnolimitednow = ".(($str) ? 'false' : 'true').';';
	if ($str) { $result .= "resultpaymessage = ".$this->ToJavaScriptEval($str, false, "'", true, false).";"; }
	print $this->ToJavaScriptEval($result);	
	exit;
   }	
  }//BeginToPayLimitedData  
  
  function GetResultValue($name='', $subname='', $data=false) { 
   //return ($this->result && isset($this->result[$name])) ? $this->result[$name] : false;
   $data = ($data !== false) ? $data : $this->result;	
   if (!$name) { return $data; }
   if ($subname) { $name .= '.'.$subname; }	
   $s   = $name;
   $s1  = $this->StrFetch($s, '.');
   $val = false;
   while ($s || $s1) {
   	if (($val === false && !isset($data[$s1])) || ($val !== false && !isset($val[$s1]))) { return false; }
    $val = ($val === false) ? $data[$s1] : $val[$s1];    
	$s1  = $this->StrFetch($s, '.');	
   }
   return $val;  
  }//GetResultValue
  
  function GetResult($name='', $subname='', $data=false) { return $this->GetResultValue($name, $subname, $data); }
  
  /** вывод лимита использования запросов */
  function PrintLimitCountOfItems() {
   print $this->ToJavaScriptEval('incerdata_count = '.
   ((!$this->IsNoLimitTool() && $this->GetLimitCount() > 0) ? $this->GetLimitCount() : '0').';').';';	
  }//PrintLimitCountOfItems
  
  /** вывод стандартного содержимого по указнным шаблонам */
  function PrintDefaultSourceDataInfo($template_start, $template_next, $withlimit=false) {
   //limit print
   if ($withlimit) { $this->PrintLimitCountOfItems(); }	
   //получить содержимое элементов	
   $data = $this->control->smarty->fetch(
    'tools/'.$this->section_id.'/'.(($this->GetCurrentIndex() == '1') ? $template_start : $template_next)
   );
   $data = @str_replace("</script>", "<\/script>", $data);
   //вывод данных	
   print $this->ToJavaScriptEval(
	(($this->GetCurrentIndex() == '1') ? "$('#processedsource').html('" : "$('#tableresultsourceid > tbody').append('").  
	$this->ToJavaScriptEval(
	 $this->ToJavaScriptEval(
	  $data, false, "'", false, true
	 ), false, "'", false, true
	)."');"
   );	
  }//PrintDefaultSourceDataInfo  
  	
 }//w_tools_def_mass_ajax 
 //-------------------------------------------------------
 /** экземпляр стандартного запроса */
 abstract class w_toolitem_noajax_method extends w_tools_gen_obj {
  protected $isfromget = null;
  protected $historydata = null;
  
  function CheckForGetQuery() {
   if ($this->isfromget !== null) { return $this->isfromget; }
   return $this->isfromget = ($_POST['doactiontool'] != 'do' && isset($_GET['t2']) && $_GET['t2']) ? true : false;
  }//CheckForGetQuery
  
  /** возвращает объект http */
  function GetHttp() { return $this->http; }
  
  function GetIndex($sum) { return $sum + 1; }
  
  /** возвращает параметр из массива $this->result
  *   В качестве пути по массиву указывается ключ с разделителем,
  *   пример:
  *   GetResult('item')
  *   или
  *   GetResult('item.subitem')
  *   или 
  *   GetResult('item.subitem.subitem')
  *   и т.д. В качестве вложения используется точка в имени ключа результата        
  */
  function GetResult($name='', $subname='', $data=false) {
   $data = ($data !== false) ? $data : $this->result;	
   if (!$name) { return $data; }
   if ($subname) { $name .= '.'.$subname; }	
   $s   = $name;
   $s1  = $this->StrFetch($s, '.');
   $val = false;
   while ($s || $s1) {
   	if (($val === false && !isset($data[$s1])) || ($val !== false && !isset($val[$s1]))) { return false; }
    $val = ($val === false) ? $data[$s1] : $val[$s1];    
	$s1  = $this->StrFetch($s, '.');	
   }
   return $val; 
  }//GetResult
  
  /** инициализация js файлов массовых проверок */
  function InitJsFiles() {
   $this->SetSectionInfo('csslist', array(
    'jquery.tablesorter.pager.css'
   ));
   $this->SetSectionInfo('jslist', array(
    'jquery.tablesorter.min.js', 'jquery.tablesorter.pager.js'
   ));   	
  }//InitJsFiles
  
  /** получение данных о истории проверок текущего сервиса ($_GET[$pageident] - активная страница) */
  function GetHistoryData($pageident='page', $listinfo='') {
   if (!$pageident && $this->historydata) { return $this->GetResult($listinfo, '', $this->historydata); }	
   if ($this->historydata !== null) { return $this->historydata; }	
   $perpage = $this->GetToolLimitInfoEx('historyperpage');	
   if (!$this->GetToolLimitInfoEx('usehistory') || !$perpage || $perpage < 0) { return false; }   
   $records_count = $this->control->GetCountInTable('iditem', 'toolhist', "where tollident='{$this->section_id}'");
   if (!$records_count) { return $this->historydata = false; }
   return $this->historydata = $this->control->db->GetDataByPages(
    "select linkcheck, datecreat from {$this->control->tables_list['toolhist']} where tollident='{$this->section_id}' ".
    "order by datecreat DESC", $_GET[$pageident], $perpage, $records_count, 
	W_SITEPATH.'tools/'.$this->section_id.'/&'.$pageident.'=', '', '', ''
   );    	
  }//GetHistoryData
  
  /** добавление сайта в историю */
  function AddDataToHistory($data) {
   if (!$this->GetToolLimitInfoEx('usehistory')) { return false; }   	
   $data = trim($this->CorrectSymplyString($data));	
   if (!$data || $this->strlen($data) > 149) { return false; }
   $data = $this->strtolower($data);   
   if ($this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem from {$this->control->tables_list['toolhist']} where tollident='{$this->section_id}' and ".
	"linkcheck='$data' limit 1" 
   ))) { return false; }
   //запись
   $this->control->db->mPost(
    "INSERT INTO {$this->control->tables_list['toolhist']} SET tollident='{$this->section_id}', ".
    "linkcheck='$data', datecreat='".$this->GetThisDateTime()."'"
   );
   return true;   	
  }//AddDataToHistory
  	
 }//w_toolitem_noajax_method
 //-------------------------------------------------------
 
// require_once W_LIBPATH.'/graph.lib.php';
// foreach ($_TOOLSNOLIMITACTIVATIONDATAINFO as $name => $tool) {
//  $filename = W_SITEDIR.'/img/ico/general/'.$name.'128.png';
//  if (@file_exists($filename)) {	
//   $image = w_image_obj::CreateFromFile($filename);
//   $image->ResizeImage(16, 16);
//   $image->OutImage(W_SITEDIR.'/img/ico/general/tool_mini/'.$name.'16.png');
//   $image->DestroyImage();
//   unset($image);   
//  }	
// }

 /* Copyright (с) 2011 forwebm.net */
?>