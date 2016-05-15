<?php
 /** Модуль управления панелью оптимизатора
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 require_once W_LIBPATH.'/confi/panel.conf.php';
 //-------------------------------------------------------------------------------------
 /** объект результатов элемента */
 class w_panelresultvalues extends w_defext {
  /** таблица для хранения истории проверок панели оптимизатора
  *   Может принимать значения идентичных таблиц.
  *   Таблица `phistlist` - альтернативная и предназначена для отдельного использования истории,
  *   если необходимо использовать историю панели совместно с историей проверок в инструменте 
  *   анализа сайта - необходимо указать таблицу `chhistory`    
  */	
  const TABLE_HISTORY = 'phistlist';
  	
  private $last_temp = array();
  private $now_temp = array();	
  protected
   $control,
   $result_last,
   $result_now,
   $url,
   $url_obj;  
  
  function __construct(w_Control_obj $control, $result_last, $result_now, $url) {
   parent::__construct();
   $this->control = $control;  
   $this->result_last = $result_last;
   $this->result_now = $result_now;
   $this->url = $url;
   $this->url_obj = false;   	
  }//__construct
  
  /** инициализация последних проверок по URL с загрузкой из истории */
  static function LoadAndCreate(w_Control_obj $control, $url, $specifyparam=false) {
   if (!$url = $control->strtolower($control->CorrectSymplyString($url))) { return false; }
   //get all by url
   if (!$specifyparam) {    	
    $list = $control->db->mPost(
     "select iditem, datecreate, valuesid from {$control->tables_list[self::TABLE_HISTORY]} where ".
     "urlident='$url' order by datecreate DESC limit 2"
    );
   } else {
	//short days by param check
	$specifyparam = $control->CorrectSymplyString($specifyparam);	
	$list = $control->db->mPost(
     "select iditem, datecreate, valuesid from {$control->tables_list[self::TABLE_HISTORY]} where ".
     "urlident='$url' and LOCATE('[$specifyparam]',valuesid)<>0 order by datecreate DESC limit 2"
    );	
   } 
   $row1 = $control->db->GetLineArray($list);
   $row2 = (!$row1) ? false : $control->db->GetLineArray($list);
   return new w_panelresultvalues($control, (!$row2) ? false : $row2, (!$row1) ? false : $row1, $url);   	
  }//LoadAndCreate
  
  function GetURL() { return $this->url; }
  function GetValueData($islast=false, $default='') { return $this->GetResultElement('valuesid', $islast, $default); }
  function GetValueDate($islast=false, $default='') { return $this->GetResultElement('datecreate', $islast, $default); }
  
  function GetResultElement($name, $islast=false, $default='') {
   $data = ($islast) ? $this->result_last : $this->result_now;
   return (!$name) ? $data : (($data) ? $data[$name] : $default);
  }//GetResultElement  
  
  /** значение по идентификатору */
  protected function ReadValue($identifier, $islast=false) {
   if (!$identifier) { return false; }
   $exists = ($islast) ? isset($this->last_temp[$identifier]) : isset($this->now_temp[$identifier]);
   $temp_value = ($exists) ? (($islast) ? $this->last_temp[$identifier] : $this->now_temp[$identifier]) : null;
   if ($temp_value !== null) { return $temp_value; }   
   $temp_value = $this->control->ReadOption($identifier, $this->GetValueData($islast));  
   return ($islast) ? ($this->last_temp[$identifier] = $temp_value) : ($this->now_temp[$identifier] = $temp_value); 	
  }//ReadValue
  
  /**  создание нового значения */
  protected function CreateNewValue($identifier, $value) {
   $data = '';
   if ($value === false) { $value = ''; }
   $data = $this->control->WriteOption($identifier, $value, $data);
   if (!$data) { return false; }
   $this->result_now = array(
    'datecreate' => $this->GetThisDate(),
    'urlident'   => $this->url,
    'valuesid'   => $data   
   );
   $this->control->db->INSERTAction(self::TABLE_HISTORY, $this->result_now, true);
   if ($this->now_temp) { $this->now_temp = array(); }
   return true;   	
  }//CreateNewValue
  
  protected function _CheckForCanUpdate($identifier, $onlyifnot=true) {	    	
   if (!$this->result_now) { return true; } elseif ($this->GetValueDate() != $this->GetThisDate()) {
	$this->result_last = $this->result_now;
	$this->last_temp = $this->now_temp;
	$this->result_now = false;
	$this->now_temp = array();
	return true;	
   }   
   return ($onlyifnot && $this->ReadValue($identifier)) ? false : true;
  }//_CheckForCanUpdate
  
  /** проверка доступности обновления данных */
  function CheckForCanUpdate($identifier, $onlyifnot=true, $quickcheck=true) {
   if (!$identifier) { return false; } 
   if ($quickcheck) { return $this->_CheckForCanUpdate($identifier, $onlyifnot); }     
   //check current date record 
   $result = $this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem, datecreate, valuesid from {$this->control->tables_list[self::TABLE_HISTORY]} where ".
    "datecreate='".$this->GetThisDate()."' and urlident='{$this->url}' limit 1"
   ));
   if ($result) {
   	if ($result['datecreate'] != $this->GetValueDate()) {
	 $this->result_last = $this->result_now;
	 $this->last_temp = $this->now_temp;
	}	
	$this->result_now = $result;
    $this->now_temp = array();	
   }      
   return $this->_CheckForCanUpdate($identifier, $onlyifnot);   	
  }//CheckForCanUpdate   
  
  /** обновить\добавить значение
  * @return false or 0 - not need update   
  */
  function UpdateValue($identifier, $newvalue, $onlyifnot=true) {  	
   if (!$this->CheckForCanUpdate($identifier, $onlyifnot, false)) { return 0; }   	
   if (!$this->result_now) { return $this->CreateNewValue($identifier, $newvalue); }  
   $value = $this->ReadValue($identifier);   
   if ($value !== false && $value == $newvalue) { return 0; }
   $data = $this->control->WriteOption($identifier, $newvalue, $this->result_now['valuesid']);
   if ($data === false) { return 0; }
   $this->control->db->UPDATEAction(
    self::TABLE_HISTORY, array('valuesid' => $data), "iditem='{$this->result_now['iditem']}'", "1", true
   );
   //restore temp info
   $this->result_now['valuesid'] = $data;
   if ($this->now_temp) { $this->now_temp = array(); }
   return true;   	
  }//UpdateValue
  
  /** установка объекта url */
  function SetURLObj($obj) { $this->url_obj = $obj; }
  
  protected function GetCorrectDate($date, $notnow=false) {
   if (!$date) { $date = ($notnow) ? false : $this->GetThisDate(); } elseif ($this->strpos($date, ':') !== false) {
	$date2 = $date;
	$date  = $this->StrFetch($date2, " ");
	if (!$date) { $date = ($notnow) ? false : $this->GetThisDate(); }
   }
   return $date;	
  }//GetCorrectDate
  
  protected function CheckCorrectDate($date) { 
   return @preg_match("/\d{4}\-\d{2}\-\d{2}/", $this->GetCorrectDate($date, true));
  }//CheckCorrectDate
  
  /** текущее значение идентификатора */
  function GetCurrentValue($identifier, $paramdata, $named='value') {
   if (isset($this->now_temp[$identifier.'_full'])) { 
    return (!$named) ? $this->now_temp[$identifier.'_full'] : ((isset($this->now_temp[$identifier.'_full'][$named])) ? 
	$this->now_temp[$identifier.'_full'][$named] : false);    
   }   
   $Lvalue = false;
   switch ($paramdata['type']) {
	//string data
	case '1':	
	 switch ($identifier) {
	  //date update
	  case 'dateupdated':
	   $value = $this->GetValueDate(false, false);
	   if ($value && $paramdata['showdiffdays']) { $Lvalue = $this->GetThisDate(); /*$this->GetValueDate(true, false);*/ }	   
	  break;
	  //date expire
	  case 'id_domain_expire':
	   $value  = $this->ReadValue($identifier);
	   //get last value, if current not exists
	   if ($value === false && $this->ReadValue($identifier, true) !== false) { 
	   	$value = $this->ReadValue($identifier, true);
	   }
	   if ($value) {
		if ($paramdata['showdiffdays']) { $Lvalue = $this->GetThisDate(); }
	   } //elseif ($value !== false) { $value = 'n/a'; }
	  break;	  	
	  //string values
	  default: 
	   $value = $this->ReadValue($identifier);
	   //get last value, if current not exists
	   if ($value === false && $this->ReadValue($identifier, true) !== false) { 
	   	$value = $this->ReadValue($identifier, true);
	   }	
	  break;
	 }
	 //set if empty
	 if ($value !== false && isset($paramdata['ifemptydata']) && $value == '') {
	  $value = $paramdata['ifemptydata'];
	  //reset lvalue
	  if ($Lvalue) { $Lvalue = false; }	  	
	 }	
	break;
	//image data
	case '2':
	 $value = ($this->url_obj) ? $this->url_obj->ReplaceCorrect($paramdata['imagefile']) : $paramdata['imagefile'];
	break;
	//control data
	case '3': return ($named == 'value') ? 1 : 0;	
	//ather datas
	default:
	 $value  = $this->ReadValue($identifier);	 
	 $Lvalue = (isset($paramdata['nodisplaydiff']) && $paramdata['nodisplaydiff']) ? false : $this->ReadValue($identifier, true);
	 //replace values, if last exists and current don't exists
	 if ($Lvalue !== false && $value === false) {
	  $value  = $Lvalue;
	  $Lvalue = false;	 
	 }
	break;
   }   
   //check value   
   if ($value === false) { return false; }
   //combine
   $result = array(
    'value'    => $value,
    'link'     => '',
    'diff'     => false,
    'diffreal' => false
   );
   //get link to hand view
   if ($paramdata['linktoview']) {
	if (@defined($paramdata['linktoview'])) { $result['link'] = @constant($paramdata['linktoview']); } else {
	 $result['link'] = $paramdata['linktoview'];
	}
	if ($result['link']) { $result['link'] = @str_replace('[MY_HOST]', W_HOSTMYSITE, $result['link']); }	
   }
   if ($this->url_obj) { $result['link'] = $this->url_obj->ReplaceCorrect($result['link']); }
   /* get difference value */
   if ($Lvalue !== false) {
	//string data
	if ($paramdata['type'] == '1') {
	 switch ($identifier) {
	  //date update
	  case 'dateupdated':
	   if ($this->CheckCorrectDate($value) && $this->CheckCorrectDate($Lvalue)) {
		$result['diff'] = $this->control->GetDateDiff($Lvalue, $value);
	   }	   
	  break;
	  //date expire
	  case 'id_domain_expire':
	   if ($this->CheckCorrectDate($value)) {
		$result['diff'] = $this->control->GetDateDiff($Lvalue, $value);		
	   }	   
	  break;
	 }	
	}
	//int values
	elseif ($value != $Lvalue && @is_numeric($value) && @is_numeric($Lvalue)) {
	 $result['diff'] = $value - $Lvalue;	 
	}		
   }
   $result['diffreal'] = $result['diff'];   
   //correct bumeric values
   if ($paramdata['type'] == '0' && $this->url_obj) {
    //current
    if ($result['value'] !== false) { $result['value'] = $this->url_obj->format_number($result['value']); }
	//diff 
    if ($result['diffreal'] !== false) { $result['diffreal'] = $this->url_obj->format_number($result['diffreal']); }
   }    
   
   //correct value view
   if (isset($paramdata['left-t'])) $result['value'] = $paramdata['left-t'].$result['value'];
   if (isset($paramdata['right-t'])) $result['value'] .= $paramdata['right-t'];  
   
   //save and return
   $this->now_temp[$identifier.'_full'] = $result;
   return (!$named) ? $result : ((isset($result[$named])) ? $result[$named] : false);
  }//GetCurrentValue 	
	
 }//w_panelresultvalues 
 //------------------------------------------------------------------------------------- 
 /** объект управления */
 class w_panelcontrolobjid extends w_defext {
  /* параметры по умолчанию */	 
  const W_DEFAULT_PARAMS = '[UPDATEONLYIFNOT]1[/UPDATEONLYIFNOT]';
  /* кол-во сайтов максимально для экспорта (0 - all) */
  const W_EXPORT_URLS_COUNTMAX = 40; 
  /* разделитель .csv файла экспорта */
  const W_CSV_DELIMITER = ';';  	
  protected 
   $control,
   $result,
   /* параметры панели:
      
      LOCKED - причина запрета доступа к панели!
      
      
      NOEXISTSURL  - если 1 - в панель будет возможным добавлять несуществующие сайты (default - 0)
      COUNTONGRAPH - кол-во дат на графике, по умолчанию - 0, все.
      NODISPLAYSELECTPARAM - если 1 - окно выбора параметров для обновления не будет отображаться 
	                         (обновляться будут все параметры), иначе будет выдан запрос на 
	                         желаемые параметры для обновлеия (default - 0)
	  NODISPLAYNOTNEEDUPDATEDLOG - 1 - в лог не будут записываться данные, если обновление для данного параметра не требуется
	                        (default - 0)
	  
	  UPDATEONLYIFNOT - если 1 - значения будут обновляться при доступности обновляния только если 
	                    значение пустое. (default - 1)
	                    
	  YXMLLOGIN - пусто или логин для Яндекс.XML
	  YXMLKEY - пусто или ключ для Яндекс.XML
	  
	  CANADDEXISTSPARAM - разрешить \ нет добавление параметра повторно
	  
   
   */
   $params,
   $temp_params,
   $temp_global_params,
   $run_params; 
   
  /* список доступных параметров для анализа в панели оптимизатора */ 
  public static $paramslistforuse = array();    
  /* параметры, которые обновлять не следует */
  public static $paramnoupdated = '[url][dateupdated][controlpanel]';
  /* параметры, которые не обновлять никогда */
  public static $paramnoupdatedever = '[url][controlpanel]';
  /* не экспортировать следующие типы параметров */
  public static $noexportfollowtypes = array('2', '3');
  
  /* доступные для загрузки идентификаторы (активируются как настройки параметра) */
  public static $opt_can_be_saved = '[colorminus][colorplus][showdiffdays][color][bgcolor][width][nodisplaydiff][colorno][coloryes][returnasstring][canwrap][swithifdayslost][yxmllogin][yxmlkey][nouseyandexxml][align]';
  
  /** ошибка доступа к панели */
  var $error = '';
  /** длина коротких имен */
  var $shortnamecount = 30;
  /** панель открыта первый раз */
  var $panelisnewnowtouse = true;
  /** временный объект обработки строки */
  var $line_obj = false;
  /** врменный список параметров идентификации */
  var $tempcolorlisten = false;
  var $tempcolorlisten_save = false;
  /** флаг отображения панели */
  var $paneldisplayed = false;
  /* управление пользователем, его панелью */
  var $manageID = false;
  var $manageIDinfo = false; 
  var $manageRealID = false;
  var $manageRealName = false;
  
  function __construct(w_Control_obj $control) {
   global $_SEOPANELCONFIGUREBLOCK;	
   parent::__construct();
   $this->run_params = $_SEOPANELCONFIGUREBLOCK;      
   $this->control = $control;
   $this->params = '';
   $this->manageID = ($this->control->isadminstatus && $_GET['manageuser']) ? 
   $this->CorrectSymplyString($_GET['manageuser']) : false; 
   if ($this->manageID) {
    $this->manageIDinfo = $this->control->GetUserInfo($this->manageID, true);    
   }    
   $this->manageRealID = ($this->manageIDinfo) ? $this->manageID : $this->control->userdata['iduser'];
   $this->manageRealName = ($this->manageIDinfo) ? $this->manageIDinfo['username'] : $this->control->userdata['username'];
   $this->result = array();
   $this->temp_params = array(); 
   $this->temp_global_params = array();
   self::$paramslistforuse = (isset($this->run_params['list'])) ? $this->run_params['list'] : array();
   $this->shortnamecount = $this->run_params['shortsectionnamecount'];
   if ($this->shortnamecount < 10) { $this->shortnamecount = 10; }   
  }//__construct
  
  function GetDifferenceNameShort() { return $this->shortnamecount - 3; }
  
  function RestoreTempIdents($issave=false) { 
   if ($issave) { $this->tempcolorlisten_save = array(); } else {
    $this->tempcolorlisten = array(); 
   }
  }//RestoreTempIdents
  
  function AddTempIdents($ident, $subname=false, $issave=false) {
   $arr = ($issave) ? $this->tempcolorlisten_save : $this->tempcolorlisten;
   if (!@is_array($arr)) { $this->RestoreTempIdents($issave); }
   if ($issave) {
    $this->tempcolorlisten_save[] = $ident.(($subname) ? ('_'.$subname) : '');
   } else {
	$this->tempcolorlisten[] = $ident.(($subname) ? ('_'.$subname) : '');
   } 
  }//AddTempIdents
  
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
   //add, if empty
   //if (!isset($section_info[$name])) { return $section_info[$name] = $value; }
   //check no exists   
   //if (!@is_array($value)) { return false; }
   //$data = $section_info[$name];   
   //for ($i=0; $i<=@count($value)-1; $i++) {
	//if (@in_array($value[$i], $data)) { 
	 //unset($value[$i]);
	//}	
   //}
   //update or add   
   $section_info[$name] = $value;   	
  }//SetSectionInfo
  
  /** добавление информации о секции */
  function AddSectionInfoNew($name, $value) {
   global $section_info;
   if (isset($section_info[$name])) { return $section_info[$name][] = $value; }	
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
  * @path - пусть от /panel/
  */
  function AddSectionWay($stringident, $path='') {
   global $section_way;
   return $section_way[] = array(
    'name' => $this->control->GetText($stringident),
    'path' => W_SITEPATH.'panel/'.$path    
   );   	
  }//AddSectionWay
  
  /** экранирование метода вывода текста по ресурсам */
  function GetText($name, $list=false, $def=false) { return $this->control->GetText($name, $list, $def); }
    
  /** установка ошибки, возврат false */
  function SetError($str) { $this->error = $str; return false; }
  
  /** запрос по ajax */
  function IsAjax() { return @defined('W_IS_AJAX_MODE_RUN'); }
  
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
   if (!$data) { return false; }	
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
  
  /** инициализация js, css файлов */
  protected function InitJsFiles() {
   $this->SetSectionInfo('csslist', array(
    //'jquery.tablesorter.pager.css', 
	'panel/css.css', 'ui/jquery-ui-1.8.11.custom.css'
   ));   
   $this->SetSectionInfo('jslist', array(
    //'jquery.tablesorter.min.js', 'jquery.tablesorter.pager.js', 
	'jquery.ui.custom.min.js'
   ));   	
  }//InitJsFiles
  
  /** получение параметра панели */
  function GetPanelOption($name) { 
   if (isset($this->temp_params[$name])) { return $this->temp_params[$name]; }
   return $this->temp_params[$name] = $this->control->ReadOption($name, $this->params); 
  }//GetPanelOption
  
  /** запись параметра настройки панели */
  protected function WritePanelOption($name, $value) {
   if (!$value) { $value = '0'; }
   if (!$this->params) { $this->params = ''; } 
   $res = $this->control->WriteOption($name, $value, $this->params);
   if ($res !== false) { $this->params = $res; }    	
   return $this->params;
  }//WritePanelOption
  
  /** сохранение параметров панели */
  protected function SavePanelOptions() {
   $this->control->db->UPDATEAction('poptionst', array(   
    'paramsdata' => $this->params    
   ), "userid='{$this->manageRealID}'", "1");   	
  }//SavePanelOptions
  
  /** инициализация параметров */
  protected function PreloadParamsPanel() {
   $this->params = self::W_DEFAULT_PARAMS;
   if ($this->temp_params) { $this->temp_params = array(); }
   $this->panelisnewnowtouse = true;
   $list = $this->control->db->GetLineArray($this->control->db->mPost(
    "select paramsdata from {$this->control->tables_list['poptionst']} where ".
	"userid='{$this->manageRealID}' limit 1"
   ));
   if ($list) {
	$this->params = $list['paramsdata'];
	$this->panelisnewnowtouse = false;
   } else {
	$this->control->db->INSERTAction('poptionst', array(
	 'userid'     => $this->manageRealID,
	 'paramsdata' => $this->CorrectSymplyString(self::W_DEFAULT_PARAMS)
	));	
   }   	
  }//PreloadParamsPanel
  
  /** подготовка раздела к использованию */
  protected function PrepereToStartPanel() {
   $this->control->smarty->assign('PANEL_CONTROL', $this);
   if (!$this->control->IsOnline()) { return $this->SetError($this->GetText('younotonlineuser')); }
   //admin check
   if ($this->run_params['accessforadminonly'] && !$this->control->isadminstatus) { 
   	return $this->SetError($this->GetText('accessdinedbyadmin')); 
   }
   //init params
   $this->PreloadParamsPanel();
   //check for blocked to use panel
   if ($error = $this->GetPanelOption('LOCKED')) {
	return $this->SetError($this->GetText('p_youlockedinpanel', array($error)));	
   }   
   //connect to js files   
   $this->InitJsFiles();
   return true;   	
  }//PrepereToStartPanel
  
  /** создание списка разделов */
  protected function GenerateSectionsList() {
   $this->result['sections'] = array(
    'data' => array()
   );
   $result = $this->control->db->mPost(
    "select * from {$this->control->tables_list['psections']} where username='{$this->manageRealName}'".
    " order by shortident ASC"
   );
   $isselected = 0;
   while ($row = $this->control->db->GetLineArray($result)) {
   	$row['urlcount'] = $this->GetCountURLSinSectionByID($row['iditem']);
	$this->result['sections']['data'][] = $row;
	if ($row['isactive']) { $isselected = $row['iditem']; }	
   }   
   $this->result['sections']['selected'] = $isselected;
   $this->result['sections']['allcount'] = $this->GetCountURLSinSectionByID(0);      
   return $this->result['sections'];	
  }//GenerateSectionsList 
  
  protected function AjaxError($str) { print 'error:'.$str; exit; }
  
  /** обработка ajax элементов */
  protected function ActionWithAjax() {
   //if (!$this->control->IsOnline()) { $this->AjaxError($this->GetText('younotonlineuser')); }
   if ($this->error) { $this->AjaxError($this->error); }
   switch ($_POST['action']) {
   	
   	/* добавление нового раздела */
   	case '1':
   	 $_POST['data'] = $this->substr($this->CorrectSymplyString($_POST['data']), 0, 120);   	 
   	 if (!$_POST['data']) { $this->AjaxError($this->GetText('p_selectnewsection')); }
   	 //check exists
   	 $item = $this->control->db->GetLineArray($this->control->db->mPost(
	  "select iditem from {$this->control->tables_list['psections']} where username='{$this->manageRealName}'".
	  " and Lower(sectname)=Lower('{$_POST['data']}') limit 1"	
	 ));
	 if ($item) { $this->AjaxError($this->GetText('p_sectisexistsalr', array($_POST['data']))); }
   	 //create record
   	 if (!$this->control->db->INSERTAction('psections', array(
	  'datecreate' => $this->GetThisDateTime(),
	  'username'   => $this->manageRealName,
	  'sectname'   => $_POST['data']	  	
	 ))) { $this->AjaxError('Error write new section record!'); }
   	 //ok, finished
   	 $ident     = $this->control->db->InseredIndex();
   	 $shortname = ($this->strlen($_POST['data']) > $this->shortnamecount) ? 
	 $this->substr($_POST['data'], 0, $this->shortnamecount - 3).'...' : $_POST['data'];
   	 print "{id:'$ident', name:'{$_POST['data']}', shortname:'$shortname'}";
   	break;
   	
	/* удаление раздела */
	case '2':
	 $_POST['data'] = $this->CorrectSymplyString($_POST['data']);
	 if (!$_POST['data']) { $this->AjaxError($this->GetText('p_selectnewsection')); }
	 $this->control->db->delete($this->control->tables_list['psections'], 
	  "iditem='{$_POST['data']}' and username='{$this->manageRealName}'", "1"
	 );	 
	 print $_POST['data'];
	break;
	
	/* сортировка разделов */
	case '3':
	 $_POST['data'] = $this->CorrectSymplyString($_POST['data']);   	 
   	 if (!$_POST['data']) { print '0'; exit; }
   	 $incerident = 0;
   	 $s = $this->StrFetch($_POST['data'], ',');
   	 while ($s || $_POST['data']) {
	  $s = $this->CorrectSymplyString($s);
	  $this->control->db->UPDATEAction('psections', array('shortident' => $incerident), "iditem='$s'", "1");	  
	  $incerident++; 		
	  $s = $this->StrFetch($_POST['data'], ',');		
	 }
	 print '1';
	break;
	
	/* изменение названия раздела */
	case '4':
	 if (!$_POST['idsect'] = $this->CorrectSymplyString($_POST['idsect'])) { 
	  $this->AjaxError($this->GetText('p_identsectnotfou')); 
	 }
	 //prepere
	 if (!$_POST['data'] = $this->substr($this->CorrectSymplyString($_POST['data']), 0, 120)) {
	  $this->AjaxError($this->GetText('p_selectnewsection'));	
	 }   	 
   	 //ok, get then identifier
   	 $item = $this->control->db->GetLineArray($this->control->db->mPost(
	  "select iditem, sectname from {$this->control->tables_list['psections']} ".
	  "where iditem='{$_POST['idsect']}' and username='{$this->manageRealName}' limit 1"	
	 ));
	 if (!$item) { $this->AjaxError($this->GetText('p_identsectnotfou')); }
	 //save check
   	 if ($item['sectname'] != $_POST['data']) {
   	  //ok, check exists this name
	  $item2 = $this->control->db->GetLineArray($this->control->db->mPost(
	   "select iditem from {$this->control->tables_list['psections']} ".
	   "where iditem<>'{$item['iditem']}' and username='{$this->manageRealName}' and ".
	   " Lower(sectname)=Lower('{$_POST['data']}') limit 1"	
	  ));
	  if ($item2) { $this->AjaxError($this->GetText('p_sectisexistsalr', array($_POST['data']))); }
	  //write	
	  $this->control->db->UPDATEAction('psections', array('sectname' => $_POST['data']), "iditem='{$item['iditem']}'", "1");
	 }
	 //combine
   	 $shortname = ($this->strlen($_POST['data']) > $this->shortnamecount) ? 
	 $this->substr($_POST['data'], 0, $this->shortnamecount-3).'...' : $_POST['data'];
   	 $count = $this->GetCountURLSinSectionByID($item['iditem']);
   	 print "{id:'{$item['iditem']}', name:'{$_POST['data']}', shortname:'$shortname', countu:'$count'}";
	break;
	
	/* добавление нового сайта */
	case '5':	 
	 $url = new ss_HTTP_obj();
	 if (!$url->SetURL($this->CorrectSymplyString($_POST['data']))) { return $this->AjaxError('Error in parse URL!'); }	 
	 //url is ok, check exists
	 $res = $this->control->db->GetLineArray($this->control->db->mPost(
	  "select iditem from {$this->control->tables_list['psitelist']} where userid='{$this->manageRealID}'".
	  " and Lower(urlid)=Lower('{$url->url_host}') limit 1"
	 ));
	 if ($res) { $this->AjaxError($this->GetText('p_urlisexiststhis', array($url->url_host))); }
	 //check for exists real, if enabled
	 if (!$this->GetPanelOption('NOEXISTSURL') && !$url->RequestGET($url->url_host)) {	 
	  $this->AjaxError($url->res_error);
	 }
	 //ok, check section
	 $_POST['sk'] = $this->CorrectSymplyString($_POST['sk']);
	 $_POST['sk'] = (!@is_numeric($_POST['sk']) || !$_POST['sk']) ? 0 : $_POST['sk'];
	 //ok, add new
	 $urlinfo = array(
	  'userid'     => $this->manageRealID,
	  'urlid'      => $url->url_host,
	  'sectionid'  => $_POST['sk'],
	  'paramsdata' => '',
	  'shortident' => $this->GetCountURLSinSectionByID(0) + 1
	 );
	 if (!$this->control->db->INSERTAction('psitelist', $urlinfo, true)) { 
	  $this->AjaxError('Error in write new record data! [MySql error]'); 
	 }
	 $urlinfo['iditem'] = $this->control->db->InseredIndex();
	 //get and combine url info. preload data	 
	 $html = $this->GenerateURLdataLineAsHtml($url, $urlinfo);
	 if ($html === false) { $this->AjaxError('No url data found! [not valid html template]'); }
	 print $html;	
	break;
	
	/* загрузка сайтов раздела */
	case '6':
	 $_POST['data'] = $this->CorrectSymplyString($_POST['data']);
	 if (!$_POST['data'] || !@is_numeric($_POST['data'])) { $_POST['data'] = 0; }
	 //ok, next to listen	 
	 $res = '';
	 $list = $this->control->db->mPost(
	  "select * from {$this->control->tables_list['psitelist']} where userid='{$this->manageRealID}'".
	  (($_POST['data']) ? " and sectionid='{$_POST['data']}'" : "")." order by shortident ASC"
	 );
	 //if no empty, get all
	 if ($list) { 
	  $url = new ss_HTTP_obj();	
	  while ($row = $this->control->db->GetLineArray($list)) {
	   if (!$url->SetURL($row['urlid'])) { continue; }
	   //sum source
	   if ($tdata = $this->GenerateURLdataLineAsHtml($url, $row)) {	$res .= $tdata; }		
	  }
	 } 
	 if (!$_POST['nosave']) {
	  //set current section as active
	  $this->control->db->UPDATEAction('psections', array('isactive' => 0), 
	   "username='{$this->manageRealName}' and iditem<>'{$_POST['data']}'"
	  );
	  $this->control->db->UPDATEAction('psections', array('isactive' => 1), 
	   "iditem='{$_POST['data']}' and username='{$this->manageRealName}'", "1"
	  );
	 }
	 //out 
	 print $res;	
	break;
	
	/* удаление сайтов */
	case '7':
	 $_POST['data'] = $this->CorrectSymplyString($_POST['data']);
	 if (!$_POST['data']) { print ''; exit; }
	 $result = '';
	 $s = $this->StrFetch($_POST['data'], ',');
	 while ($s || $_POST['data']) {
	  $s = $this->CorrectSymplyString($s);
	  if ($s) {
	   $this->control->db->Delete(
	    $this->control->tables_list['psitelist'], "iditem='$s' and userid='{$this->manageRealID}' limit 1"
	   );
	   $result .= (($result) ? ",$s" : $s);
	  }	
	  $s = $this->StrFetch($_POST['data'], ',');	
	 } 
	 print $result;
	break;
	
	/* перемещение сайтов по разделам */
	case '8':
	 $_POST['data'] = $this->CorrectSymplyString($_POST['data']); if (!$_POST['data']) { print ''; exit; }
	 $_POST['to']   = (!$_POST['to'] || !@is_numeric($_POST['to'])) ? 0 : $this->CorrectSymplyString($_POST['to']);
	 $_POST['from'] = (!$_POST['from'] || !@is_numeric($_POST['from'])) ? 0 : $this->CorrectSymplyString($_POST['from']);
	 $result = '';	 
	 $s = $this->StrFetch($_POST['data'], ',');
	 while ($s || $_POST['data']) {
	  $s = $this->CorrectSymplyString($s);
	  if (@is_numeric($s)) {	   	
	   //check for get data
	   $res = $this->control->db->GetLineArray($this->control->db->mPost(
	    "select iditem, sectionid from {$this->control->tables_list['psitelist']} where ".
	    "iditem='$s' and userid='{$this->manageRealID}' and sectionid<>'{$_POST['to']}' limit 1"
	   ));
	   if ($res) {
	    //update record info
		$this->control->db->UPDATEAction('psitelist', array('sectionid' => $_POST['to']), "iditem='{$res['iditem']}'", "1");
	    //combine answer
	    $result .= ($result) ? ';' : '';
		$result .= '{urlid: "'.$res['iditem'].'", fromsection: "'.
		           $res['sectionid'].'", tosection: "'.$_POST['to'].'", fromactive: "'.$_POST['from'].'"}'; 
	   }	
	  }
	  $s = $this->StrFetch($_POST['data'], ',');
	 }
	 print $result;	
	break;
	
	/* сохранение позиции сайтов в разделе */
	case '9':	 
	 $_POST['data'] = $this->CorrectSymplyString($_POST['data']);   	 
	 //$_POST['sk']   = $this->CorrectSymplyString($_POST['sk']);
   	 if (!$_POST['data']/* || $_POST['sk'] == '' || !@is_numeric($_POST['sk'])*/) { print ''; exit; }  	 
   	 $incerident = 0;
   	 $s = $this->StrFetch($_POST['data'], ',');
   	 while ($s || $_POST['data']) {
	  $s = $this->CorrectSymplyString($s);
	  $this->control->db->UPDATEAction('psitelist', array('shortident' => $incerident), "iditem='$s'", "1");	  
	  $incerident++; 		
	  $s = $this->StrFetch($_POST['data'], ',');		
	 }
	 print '';
	break;
	
	/* получение ссылки предпросмотра */
	case '10':
	 if (!$_POST['data'] = $this->CorrectSymplyString($_POST['data'])) {
	  $this->AjaxError('Error in get URL parameter!');	
	 }
	 $res = $this->control->db->GetLineArray($this->control->db->mPost(
	  "select urlid from {$this->control->tables_list['psitelist']} where ".
	  "iditem='{$_POST['data']}' and userid='{$this->manageRealID}' limit 1"
	 ));
	 if (!$res) { $this->AjaxError('URL not found!'); }
	 
	 $html = new ss_HTTP_obj();
	 if (!$html->SetURL($res['urlid'])) { $this->AjaxError('Error in parse URL!'); }
	 
	 print $html->ReplaceCorrect(ss_BlockConstantValue::URL_ATHER_RESOLUTION);
	break;
	
	/* инициализация, обработка графика */
	case '11': $this->ActionHistoryURLElements($_POST['data']); break;
	
	/* обновление показателей  */
	case '12': $this->ActionUpdateParamElement(); break;
	
	/* получение параметров панели */
	case '13': print $this->control->smarty->fetch('seo-panel/panel_global_options.tpl'); break;
	
	/* сохранение параметров панели */
	case '14': 	 	
	 $ok = 
	 $this->WritePanelOption('NOEXISTSURL', ($this->CheckPostValue('NOEXISTSURL')) ? 1 : 0) && 
	 $this->WritePanelOption('NODISPLAYSELECTPARAM', ($this->CheckPostValue('NODISPLAYSELECTPARAM')) ? 1 : 0) &&
	 $this->WritePanelOption('NODISPLAYNOTNEEDUPDATEDLOG', ($this->CheckPostValue('NODISPLAYNOTNEEDUPDATEDLOG')) ? 1 : 0) &&

	 $this->WritePanelOption('COUNTONGRAPH', (!@is_numeric($_POST['COUNTONGRAPH'])) ? 0 : $_POST['COUNTONGRAPH']) &&
	 
	 $this->WritePanelOption('YXMLLOGIN', $this->CorrectSymplyString($_POST['YXMLLOGIN'])) &&	 
	 $this->WritePanelOption('YXMLKEY', $this->CorrectSymplyString($_POST['YXMLKEY'])) &&
	 
	 $this->WritePanelOption('CANADDEXISTSPARAM', ($this->CheckPostValue('CANADDEXISTSPARAM')) ? 1 : 0);
	 
	 if (!$ok) { $this->AjaxError('Error in save params'); }
	 
	 $this->SavePanelOptions();
	break;
	
	/* добавление нового параметра */
	case '15':
	 $_POST['data'] = $this->CorrectSymplyString($_POST['data']);
	 if (!$_POST['data'] || !isset(self::$paramslistforuse[$_POST['data']])) { $this->AjaxError('Unknow parameter ID'); }
	 //check enabled
	 if (self::$paramslistforuse[$_POST['data']]['disabled']) { $this->AjaxError($this->GetText('p_paramisdisabledn')); }
	 //check to add, exists list
	 if (!$this->GetPanelOption('CANADDEXISTSPARAM')) {
	  $param = $this->control->db->GetLineArray($this->control->db->mPost(
	   "select iditem from {$this->control->tables_list['pparamstb']} where userid='{$this->manageRealID}' and ".
	   "paramid='{$_POST['data']}' limit 1"
	  ));
	  if ($param) { $this->AjaxError($this->GetText('paramisexistsalridyp', 
	   array($this->GetText(self::$paramslistforuse[$_POST['data']]['name']))
	   ));
	  }
	 }
	 //add new
	 if (!$this->control->db->INSERTAction('pparamstb', array(
	  'datecreate' => $this->GetThisDate(),
	  'userid'     => $this->manageRealID,
	  'paramid'    => $_POST['data'],
	  'paramsdata' => '',
	  'shortident' => $this->control->GetCountInTable(
	   'iditem', 'pparamstb', "where userid='{$this->manageRealID}'"
	  ) + 1
	 ), true)) { $this->AjaxError('Error in write new Param record [MySQL error]'); }
     print '2'; 
	break;
	
	/* получение списка параметров */
	case '16': 
	 $this->PreloadParamsList();
	 print $this->control->smarty->fetch('seo-panel/list_params_data.tpl'); 
	break;
	
	/* порядок параметров */
	case '17':
	 $_POST['data'] = $this->CorrectSymplyString($_POST['data']);
   	 if (!$_POST['data']) { print ''; exit; }  	 
   	 $incerident = 0;
   	 $s = $this->StrFetch($_POST['data'], ',');
   	 while ($s || $_POST['data']) {
	  $s = $this->CorrectSymplyString($s);
	  $this->control->db->UPDATEAction('pparamstb', array(
	   'shortident' => $incerident
	  ), "iditem='$s' and userid='{$this->manageRealID}'", "1");	  
	  $incerident++; 		
	  $s = $this->StrFetch($_POST['data'], ',');		
	 }
	 print '';	 
	break;
	
	/* удаление параметров */
	case '18':	
	 $_POST['data'] = $this->CorrectSymplyString($_POST['data']);
   	 if (!$_POST['data']) { print ''; exit; }  	 
   	 $incerident = 0;
   	 $s = $this->StrFetch($_POST['data'], ',');
   	 while ($s || $_POST['data']) {
	  $s = $this->CorrectSymplyString($s);
	  $this->control->db->Delete(
	   $this->control->tables_list['pparamstb'], "iditem='$s' and userid='{$this->manageRealID}'", "1"  
	  );	  
	  $incerident++; 		
	  $s = $this->StrFetch($_POST['data'], ',');		
	 }
	 print ''; 
	break;
	
	/* получение настроек параметра */
	case '19':
	 if (!$_POST['data'] = $this->CorrectSymplyString($_POST['data'])) { print ''; exit; }
	 //get param
	 $param = $this->GetAndLoadOneParamOptions($_POST['data']);
	 if (!$param) {
	  $this->AjaxError(($this->error) ? $this->error : 'Error in get parameter Info');	
	 }
	 //ok, action to get	 
	 $this->control->smarty->assign('val', $param);     
     print $this->control->smarty->fetch('seo-panel/param_options_element.tpl');	 
	break;
	
	/* сохранение настроек параметра */
	case '20':
	 if (!$_POST['dataid'] = $this->CorrectSymplyString($_POST['dataid'])) { $this->AjaxError('Unknow param ID'); } 
	 //ok, get param
	 $param = $this->GetAndLoadOneParamOptions($_POST['dataid']);
	 if (!$param) {
	  $this->AjaxError(($this->error) ? $this->error : 'Error in get parameter Info');	
	 }	 
	 //ok, process to write
	 foreach ($param['data'] as $name => &$value) {
	  if (!$this->CanConfThisOpt($name)) { continue; }
	  //ok, check for value
	  if (isset($_POST[$name.'_elemwidth'])) { $value = $this->CorrectSymplyString($_POST[$name.'_elemwidth']); } 
	  elseif (isset($_POST[$name.'_ch_sel_param'])) { $value = ($this->CheckPostValue($name.'_ch_sel_param')) ? 1 : 0; }
	  elseif (isset($_POST[$name.'_elemcc'])) { $value = $this->CorrectSymplyString($_POST[$name.'_elemcc']); }	
	 }
	 //save values data
	 if ($error = $this->WriteParamOptions($param)) { $this->AjaxError($error); }
     print '1';
	break;
	/* */	 
	
	default: $this->AjaxError('Unknow action ID');
   }   
   exit;	
  }//ActionWithAjax
  
  /** сохранение настройки параметра */
  protected function WriteParamOptions($param) {
   if (!$param) { return 'Unknow param data!'; }
   $str = ''; 
   foreach ($param['data'] as $name => $value) {
   	if (!$this->CanConfThisOpt($name)) { continue; }
   	$data = $this->control->WriteOption($name, $value, $str);
   	if ($data !== false) { $str = $data; }
   }
   if ($param['text'] != $str) {
	$this->control->db->UPDATEAction('pparamstb', array(
	 'paramsdata' => $str	 
	), "iditem='{$param['id']}' and userid='{$this->manageRealID}'", "1", true);	
   } 
   return '';   
  }//WriteParamOptions 
  
  function CanConfThisOpt($ident) { return $ident && $this->strpos(self::$opt_can_be_saved, "[$ident]") !== false;  }
  
  protected function ReturnNil() { print ''; return false; }
  
  /** выполнение обновления элемента */
  protected function ActionUpdateParamElement() {
   if (!$_POST['url'] = $this->CorrectSymplyString($_POST['url'])) { $this->AjaxError('Incorrect URL ID'); }
   if (!$_POST['opt'] = $this->CorrectSymplyString($_POST['opt'])) { $this->AjaxError('Incorrect Param ID'); }  
   //get and load param info
   $settings = $this->GetAndLoadOneParamOptions($_POST['opt']);
   if (!$settings) {
	if ($this->error) { $this->AjaxError($this->error); } else { $this->AjaxError('Error in get parameter info!'); }
   }
   //check for disabled param
   if (isset($settings['data']['disabled']) && $settings['data']['disabled']) {
	$this->AjaxError('Param is disabled!');
   }
   //quick check for not need in update   
   $doupdate = false;   
   switch ($settings['data']['type']) {
	//string, numeric values
	case '0':
	case '1':
	 //url param, never update	 
	 if ($settings['sid'] == 'url') { return $this->ReturnNil(); }
	 //date update param, update in template
	 elseif ($settings['sid'] == 'dateupdated') { break; }	 
	 //check for exists plugin id to execute
	 if (!$settings['data']['pluginid']) { $this->AjaxError('Unknow Plugin ID to Exec param!'); }
	 $doupdate = true;	 	  	
	break;	
	//images, update in template
	case '2': break;
	//control panel, never update
	case '3': return $this->ReturnNil();	
	//unknow param type
	default: $this->AjaxError('Unknow param type!');
   }        
   //param granted, get url by identifier
   $urlinfo = $this->control->db->GetLineArray($this->control->db->mPost(
    "select * from {$this->control->tables_list['psitelist']} where ".
    "iditem='{$_POST['url']}' and userid='{$this->manageRealID}' limit 1"
   ));
   if (!$urlinfo) { $this->AjaxError('URL not found!'); }   
   //init url by myself
   $html = new ss_HTTP_obj();
   if (!$html->SetURL($urlinfo['urlid'])) { $this->AjaxError('Error in parse URL!'); }
   //create and load update params info records   
   if (!$element = w_panelresultvalues::LoadAndCreate($this->control, $html->url_real_host)) {
    $this->AjaxError('Error in initialize update object!');		
   }
   $element->SetURLObj($html);    
   //update only if need this
   if ($doupdate) {   	 
    //check for can update element
    if (!$element->CheckForCanUpdate($settings['sid'], ($this->GetPanelOption('UPDATEONLYIFNOT')) ? true : false)) {
     print '1'; return true;
    }		 
    //action to parse params requist	 
    $sleep = (isset($settings['data']['sleep'])) ? $settings['data']['sleep'] : false;
    //sleep, if need
    if ($sleep) { @sleep($sleep); }
    //set global exec params
    $this->SetGlobalExecParams(false, $settings['data']);   
    //exec plugin
    $params = (isset($settings['data']['pluginparams']) && $settings['data']['pluginparams']) ? 
	$settings['data']['pluginparams'] : false;
	//run
    if (!$html->RunPluginEx($settings['data']['pluginid'], $error, $value, $params)) {
	 $this->AjaxError(($error) ? $error : 'Error in Exec Param plugin!');	
	}
	//ok, get value
	$result = (!$settings['data']['pluginvaluepath']) ? $value : 
	$this->GetResult($settings['data']['pluginvaluepath'], '', ($value) ? $value : array());
	//no update empty values
	//if ($result === false) { return $this->AjaxError('Param result value is Null'); }	
	//ok, update
	if ($element->UpdateValue($settings['sid'], $result, ($this->GetPanelOption('UPDATEONLYIFNOT')) ? true : false) === 0) {
	 print '1'; return true;	
	} 
   }    
   //object is loaded succesfully, set for template
   $this->line_obj = $element;
   $this->result['urllineinfo'] = $urlinfo;   
   $this->control->smarty->assign('val', $settings);   
   //get html line source   
   print $this->control->smarty->fetch('seo-panel/url_param_data.tpl');   
  }//ActionUpdateParamElement
  
  /** yandex xml */
  function GetYandexXML($plugin) {
   return (
    isset($this->temp_global_params['yxmllogin']) && isset($this->temp_global_params['yxmlkey']) && 
    $this->temp_global_params['yxmllogin'] && $this->temp_global_params['yxmlkey']	
   ) ? array(
    'username' => $this->temp_global_params['yxmllogin'],
    'key'      => $this->temp_global_params['yxmlkey']
   ) : false;   	
  }//GetYandexXML
  
  /** источник данных яндекса */
  function GetYandexServerPath($plugin, $datasource_list) {
   return (!$this->temp_global_params['yandexserverpath']) ? false : $this->temp_global_params['yandexserverpath'];
  }//GetYandexServerPath
  
  /** установка глобальных параметров плагина */
  protected function SetGlobalExecParams($restore=false, $paramopt=false) {
   global $_SS_READ_YANDEX_XML_API_PROG_PL, $_SS_READ_SOURCE_DATA_TYPE_NUMBER_PL;
   //yandex XML
   if ($restore || ($paramopt && isset($paramopt['nouseyandexxml']) && $paramopt['nouseyandexxml'])) {
   	$_SS_READ_YANDEX_XML_API_PROG_PL = false; 
   } else {
	//check for get from param specially
	if ($paramopt && $paramopt['yxmllogin'] && $paramopt['yxmlkey']) {
	 $this->temp_global_params['yxmllogin'] = $paramopt['yxmllogin'];
	 $this->temp_global_params['yxmlkey']   = $paramopt['yxmlkey'];	
	} else {
	 //global 
	 $this->temp_global_params['yxmllogin'] = $this->GetPanelOption('YXMLLOGIN');
	 $this->temp_global_params['yxmlkey']   = $this->GetPanelOption('YXMLKEY');		
	}
    //check for admin xml data
    if (!$this->temp_global_params['yxmllogin'] && !$this->temp_global_params['yxmlkey'] &&
         $paramopt['adminxmllogin'] && $paramopt['adminxmlkey']
       ) {
      
      $this->temp_global_params['yxmllogin'] = $paramopt['adminxmllogin'];
      $this->temp_global_params['yxmlkey']   = $paramopt['adminxmlkey'];  
        
    }
    //set by default prog    	
	$_SS_READ_YANDEX_XML_API_PROG_PL = array($this, 'GetYandexXML');	
   }
   //тип получения данных для Яндекса
   if ($restore || !$paramopt || !$paramopt['valuefromserv']) { 
   	$_SS_READ_SOURCE_DATA_TYPE_NUMBER_PL = false; 
   } else {
	$this->temp_global_params['yandexserverpath'] = $paramopt['valuefromserv'];
	$_SS_READ_SOURCE_DATA_TYPE_NUMBER_PL = array($this, 'GetYandexServerPath');
   } 
  }//SetGlobalExecParams
  
  /** обработка запросов отображения графика истории сайта */
  protected function ActionHistoryURLElements($ident) {
   if (!$ident = $this->CorrectSymplyString($ident)) { $this->AjaxError('Error get URL ident!'); }
   //get url by identifier
   $res = $this->control->db->GetLineArray($this->control->db->mPost(
    "select urlid from {$this->control->tables_list['psitelist']} where ".
    "iditem='$ident' and userid='{$this->manageRealID}' limit 1"
   ));
   if (!$res) { $this->AjaxError('URL not found!'); }
   //ok, process
   $html = new ss_HTTP_obj();
   if (!$html->SetURL($res['urlid'])) { $this->AjaxError('Error in parse URL!'); }
   //check for loading params list
   if (!$this->PreloadParamsList()) { $this->AjaxError('No params found!'); }   
   //connect to history object module
   require_once W_SITEDIR.'/lib/p.history.lib.php';
   if (!$history = w_historyparamslisten::CreateFromURL($this->control, $html->url_real_host, w_panelresultvalues::TABLE_HISTORY)) { 
    unset($html);
    $this->AjaxError('Error in initialize history object!');		
   }
   $history->SetShowURL($html->url_host);
   unset($html);
   //ok, process elements
   $items = array();
   foreach ($this->GetResult('params') as $item) {
	if ($item['data']['type'] == 0) {
	 $items[] = $item['sid'];	 	
	}	
   }   
   //check for not empty list of params
   if (!$items) { $this->AjaxError('No params found!'); }
   //action to get params list   
   if ($_POST['getparams']) {
	print $history->GenerateLineCharSettengsXML($items);
	return true;	
   }
   //action to get data CSV
   if ($_POST['getdata']) {
   	$count = ($this->GetPanelOption('COUNTONGRAPH')) ? $this->GetPanelOption('COUNTONGRAPH') : 0;	    	
	print $history->GenerateLineChartDataCSV($items, $count);
	return true;
   }  	
  }//ActionHistoryURLElements
  
  /** генерация строки 1 сайта */
  protected function GenerateURLdataLineAsHtml($url, $urlinfo) {
   $this->line_obj = false;		
   //check for create list params
   if (!$this->PreloadParamsList()) { return false; }
   //create and load url info   
   if (!$line_obj = w_panelresultvalues::LoadAndCreate($this->control, $url->url_real_host)) { return false; }
   $line_obj->SetURLObj($url);
   $this->line_obj = $line_obj;
   $this->result['urllineinfo'] = $urlinfo;
   //get html line source   
   $line = $this->control->smarty->fetch('seo-panel/url_line_data.tpl');
   //unset line data
   unset($line_obj);
   $this->line_obj = false; 
   return $line;
  }//GenerateURLdataLineAsHtml 
  
  /** кол-во сайтов в разделе */
  function GetCountURLSinSectionByID($sectid) {
   $sectid = $this->CorrectSymplyString($sectid);
   return $this->control->GetCountInTable('iditem', 'psitelist', 
    "where userid='{$this->manageRealID}'".((!$sectid) ? '' : " and sectionid='$sectid'")
   );   	
  }//GetCountURLSinSectionByID
  
  /** создание списка параметров по умолчанию */
  protected function CreateDefaultParamsList() {   	
   $params_list = array();	
   $this->control->db->Delete($this->control->tables_list['pparamstb'], "userid='{$this->manageRealID}'");
   //action
   $incerindex = 0;
   foreach (self::$paramslistforuse as $id => $data) {
   	if ($data['disabled'] || !$data['default']) { continue; }
	$item = array(
	 'id'   => false,
	 'sid'  => $id,
	 'data' => $data
	);
	//write record
	if (!$this->control->db->INSERTAction('pparamstb', array(
	 'datecreate' => $this->GetThisDateTime(),
	 'userid'     => $this->manageRealID,
	 'paramid'    => $id,
	 'paramsdata' => '',
	 'shortident' => $incerindex	 
	))) { continue; }
	//ok, follow to add item
	$item['id'] = $this->control->db->InseredIndex();
	//parse name as long name, and date format get
	$item['data']['name'] = $this->CorrectSymplyString($this->GetText($data['name'], false, 'No name'));
	if ($item['data']['dateformat']) { 
	 $item['data']['dateformat'] = $this->GetText($item['data']['dateformat'], false, ''); 
	}
	$params_list[] = $item;	
	$incerindex++;
   }  
   return $params_list; 	
  }//CreateDefaultParamsList
  
  /** загрузка параметров плагина */
  protected function LoadParamOptions($paramidentifier, $optionsdata) {   
   if (!isset(self::$paramslistforuse[$paramidentifier]) || 
      (isset(self::$paramslistforuse[$paramidentifier]['disabled']) && 
	   self::$paramslistforuse[$paramidentifier]['disabled'])) { return false;
   }
   if (!$optionsdata) { return true; }
   foreach (self::$paramslistforuse[$paramidentifier] as $name => &$value) {
	if ($this->strpos(self::$opt_can_be_saved, "[$name]") === false) { continue; }
	$val = $this->control->ReadOption($name, $optionsdata);
	if ($val !== false) { $value = $val; }	
   }
   return true;   	
  }//LoadParamOptions
  
  /** загрузка параметров панели */
  protected function LoadParamsListWorkSpace() {
   $params_list = array();
   $list = $this->control->db->mPost("select iditem, paramid, paramsdata from ".
    "{$this->control->tables_list['pparamstb']} where userid='{$this->manageRealID}' ".
    "order by shortident ASC"
   );
   while ($row = $this->control->db->GetLineArray($list)) {
	if (!$this->LoadParamOptions($row['paramid'], $row['paramsdata'])) { continue; }
	$item = array(
	 'id'   => $row['iditem'],
	 'sid'  => $row['paramid'],
	 'data' => self::$paramslistforuse[$row['paramid']]
	);
	$item['data']['name'] = $this->CorrectSymplyString($this->GetText($item['data']['name'], false, 'No name'));
	if ($item['data']['dateformat']) { 
	 $item['data']['dateformat'] = $this->GetText($item['data']['dateformat'], false, ''); 
	}
	$params_list[] = $item;	
   }
   return $params_list;	
  }//LoadParamsListWorkSpace
  
  /** загрузка единичного параметра панели */
  protected function GetAndLoadOneParamOptions($paramid) {
   $list = $this->control->db->GetLineArray($this->control->db->mPost("select iditem, paramid, paramsdata from ".
    "{$this->control->tables_list['pparamstb']} where iditem='$paramid' and userid='{$this->manageRealID}' limit 1"
   ));
   if (!$list) { return $this->SetError('Parameter not found or disabled!'); }
   //loading param options
   $this->LoadParamOptions($list['paramid'], $list['paramsdata']);  
   $data = self::$paramslistforuse[$list['paramid']]; 
   if ($data) {
    $data['name'] = $this->CorrectSymplyString($this->GetText($data['name'], false, 'No name'));
    if ($data['dateformat']) { $data['dateformat'] = $this->GetText($data['dateformat'], false, ''); }  
   }
   //return elements as options
   return array(
	'id'   => $list['iditem'],
	'sid'  => $list['paramid'],
	'data' => $data,
	'text' => (!$list) ? '' : $list['paramsdata']
   );	
  }//GetAndLoadOneParamOptions 
  
  /** инициализация списка параметров */
  protected function PreloadParamsList() {
   if (!isset($this->result['params'])) {
	$this->result['params'] = ($this->panelisnewnowtouse) ? $this->CreateDefaultParamsList() : 
	$this->LoadParamsListWorkSpace();
   }
   return $this->result['params'];	
  }//PreloadParamsList 
  
  /** export current data as natural values */
  protected function ActionToExportDataValues() {
   $res = '';
   if (!$_GET['data'] = $this->CorrectSymplyString($_GET['data'])) { return $this->SetError('No Data found!'); }
   $incer = 1;
   $url = new ss_HTTP_obj();
   $str = $this->StrFetch($_GET['data'], ',');
   while ($_GET['data'] || $str) {
   	if (self::W_EXPORT_URLS_COUNTMAX > 0) {   	
   	 if ($incer > self::W_EXPORT_URLS_COUNTMAX) { break; }
   	 $incer++;
	}
	if ($str) {
	 $list = $this->control->db->GetLineArray($this->control->db->mPost(
      "select * from {$this->control->tables_list['psitelist']} where userid='{$this->manageRealID}'".
      " and iditem='$str' limit 1"
     ));     
     //ok, load site info asline data
     $line = '';
     if ($list && $url->SetURL($list['urlid'])) {
	  //load or check params list
	  if (!$this->PreloadParamsList()) { return false; }
	  //create and load url info   
      if ($line_obj = w_panelresultvalues::LoadAndCreate($this->control, $url->url_real_host)) { 
	   $line_obj->SetURLObj($url);
	   $header = '';
	   foreach ($this->GetResult('params') as $param) {
		//combine header line, if first time action
		$canexport = !@in_array($param['data']['type'], self::$noexportfollowtypes);
		if (!$res && $canexport) {
		 if ($header) { $header .= self::W_CSV_DELIMITER; }
		 $header .= $param['data']['name'];		 
		}
		//values data
		if ($canexport) {		
		 switch ($param['sid']) {
		  case 'url': $value = $list['urlid']; break;
		  default   : $value = $line_obj->GetCurrentValue($param['sid'], $param['data'], 'value');	
		 }
		 $line .= ((($line) ? self::W_CSV_DELIMITER : '').$value);
		}
	   }
	   if (!$res && $header) { $res .= $header."\r\n"; }
	   if ($line) { $res .= $line."\r\n"; }  	     
	  } 	
	 }
    }
    $str = $this->StrFetch($_GET['data'], ',');
   }
   if (!$res) { return $this->SetError('No Data found!'); }
   //$res = @iconv('UTF-8', 'WINDOWS-1251', $res);   
   $this->control->WriteDownLoadFileHeader('export_'.$this->GetThisDate().'.csv', $this->strlen($res));
   print $res;
   return true;
  }//ActionToExportDataValues
  
  /** выполнение */
  function ActionElements() {  	
   if (!$this->PrepereToStartPanel()) { return false; }
   //ok, action begin
   if ($this->IsAjax()) { return $this->ActionWithAjax(); }
   /* check for export action */
   if ($_GET['export'] && $_GET['data']) { 
   	$this->ActionToExportDataValues(); if ($this->error) { print $this->error; } exit; 
   }
   /* css */
   $this->AddSectionInfoNew('csslist', 'colordlg/colorpicker.php');
   //combine sections list
   $this->GenerateSectionsList();
   //get params list, if is first start - create default list and return then
   $this->PreloadParamsList();
   //get update display params options
   $this->result['displayselectparam'] = ($this->GetPanelOption('NODISPLAYSELECTPARAM') ? 0 : 1);
   //list params for not updated
   $this->result['paramsnoupdated'] = self::$paramnoupdated;
   $this->result['paramsnoupdatedever'] = self::$paramnoupdatedever;   
   //display not need updated
   $this->result['displaynoupdateneed'] = ($this->GetPanelOption('NODISPLAYNOTNEEDUPDATEDLOG') ? 0 : 1);
   //return all params
   $this->result['deflistpr'] = self::$paramslistforuse;
   $this->paneldisplayed = true;    	
  }//ActionElements	
	
 }//w_panelcontrolobjid 
 //------------------------------------------------------------------------------------- 
 /* Copyright (с) 2011 forwebm.net */
?>