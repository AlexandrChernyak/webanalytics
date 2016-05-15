<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** Модуль дополнительных надстроек Поисковиков
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 abstract class ss_Plugin_EnginesOpt extends ss_Plugin_obj {
  public $_yandex_use_xml_pack = false;
  public $_only_xml_yandex_bodyget = false;
  
  function __construct(ss_Plugin_obj_List $AOwner, $id, $shortname, $longname1='Индекс ',
   $longname2='Проиндексировано ', $daysstored=2, $checkYandexXML=false) {
   global $_SS_READ_PLUGIN_PARAMETERS_DATA_PL, $_SS_CACH_EVENT_CLASS_LISTENER_WS, $_SS_READ_YANDEX_XML_API_PROG_PL;
   //данные плагина
   $res = ($_SS_READ_PLUGIN_PARAMETERS_DATA_PL !== false) ? 
   @call_user_func($_SS_READ_PLUGIN_PARAMETERS_DATA_PL, $id) : false;
   //параметры плагина, идентификаторы данных   
   $name = ($res && @is_array($res) && isset($res['name'])) ? $res['name'] : DoEncodeDataToDef($longname1.$shortname);
   $descr = ($res && @is_array($res) && isset($res['descr'])) ? $res['descr'] : 
   DoEncodeDataToDef($longname2.$shortname);
   $dayss = ($res && @is_array($res) && isset($res['daysstored'])) ? $res['daysstored'] : $daysstored;
   //создание плагина по шаблону  	
   parent::__construct($AOwner, $id, $name, $descr, $dayss);
   //устанвока кэша как первоначальный элемент
   if ($_SS_CACH_EVENT_CLASS_LISTENER_WS) { $this->SetCach($_SS_CACH_EVENT_CLASS_LISTENER_WS); }
   //xml yandex
   $this->_yandex_use_xml_pack = ($checkYandexXML && ($_SS_READ_YANDEX_XML_API_PROG_PL !== false)) ?   
   @call_user_func($_SS_READ_YANDEX_XML_API_PROG_PL, $this) : false;   
  }//__construct
  
  /** стандартный запрос данных */
  function _DoActionDefaultData(ss_ConnectQuery &$Request, $DataSources, &$resType, &$reslink) {
   $resType = 0;
   $reslink = '';
   $reslink = $this->GetActiveDataSourceCenter($DataSources, $resType);
   if (!$reslink) { 
   	$reslink = (@is_array($DataSources)) ? $DataSources[0]: $DataSources; 
	$type_number = 0; 
   }
   if (!$reslink) {
	$this->SetError('Error get default link query');
	return false;
   }
   if (!$Request->RequestGET($this->GetConnect()->ReplaceCorrect($reslink))) {
	$this->SetError($Request->res_error);
	return false;	
   }
   return true;   	
  }//_DoActionDefaultData
  
  /** ошибка распределения */
  function SetUnknowNameError() { return $this->SetError('Unknow Data Source center for get info!'); }
  
  /** данные из заголовка */
  function GetTitledNumber($title) {
   $ext_string = '/[\s]*([0-9]+?)[\s]*/isU';
   $i = $this->strlen($title) - 1;
   $s = '';
   while ($i > 5) {
	$ch = $this->substr($title, $i, 1);		
	if ($ch == ':') { break; }
	if (($ch != ',') and ($ch != '.')) { $s = $ch.$s; }
	$i--;
   }         
   $s = trim($s);        
   if ($s == '') { return 0; }   
   $m = 1;   
   if ($this->stripos($s, DoEncodeDataToDef('млн')) > 1) { $m = 1000000; } 
   elseif ($this->stripos($s, DoEncodeDataToDef('тыс')) > 1) { $m = 1000; }
   if (!@preg_match($ext_string, $s, $ar)) { return false; }
   $s = trim($ar[1]);
   if (!@is_numeric($s)) { return false; }   	    
   return $s * $m;	
  }//GetTitledNumber
  
  /** получение данных от Яндекс */
  function GetYandexCountBack($Content, $Title) {
   $res = '';
   if ($this->_yandex_use_xml_pack) {
   	$p = new ss_HTMLTagParser();
   	$p->use_regext_preg_to_search = true;   	
   	$p->SetData($Content, 'found-human');
   	if ($p->GetTag()) { 
	 $res = $p->GetParamValue('');
	 if ($res === false) { return 0; }	 
	 $res = trim($res); 
	}
   	//unset($p);	
   } else { $res = $Title; }
   return $this->GetTitledNumber($res);   	
  }//GetYandexCountBack
  
  /** msn (bing) */
  function GetMsnCountBack($Content, $Title) {
   $Ext = DoEncodeDataToDef('/[0-9]*[\s]*[из|of][\s]*([^a-zа-я]+?)[\s]*<[\s]*\/[\s]*span[\s]*>/isU');
   if (!@preg_match($Ext, $Content, $ar)) { return 0; }   
   return $this->DeleteAllNoNumber(trim($ar[1]));   	
  }//GetMsnCountBack
  
  /** aport */
  function GetAportCountSearchDir($Content, $Title) {
   $ExtSites1 = DoEncodeDataToDef(
    '/[\s|&nbsp;]*<[\s]*b[\s]*>([0-9,\.\s]+?)<[\s]*\/[\s]*b[\s]*>[\s|&nbsp;]*[сайтов|сайт|сайта]/isU'
   );
   $ExtSites2 = DoEncodeDataToDef(
    '/([0-9,\.\s]+?)[\s|&nbsp;][сайтов|сайт|сайта][\s|&nbsp;]*/isU'
   );	
   if (!@preg_match($ExtSites1, $Content, $ar)) { 
	if (!@preg_match($ExtSites2, $Title, $ar)) { return 0; }	
   }
   return $this->ParseRamblerTextResult(trim($ar[1])); 	
  }//GetAportCountSearchDir
  
  /** корректировка данных */
  function GetNormalSeparation($s) {
   if ($s === false) { return $s; }	
   $array = array(
    '.' => '',
    ',' => '',
    " " => '',
    '&nbsp;' => ''   
   );
   foreach ($array as $key => $val) {
	$s = @str_replace($key, $val, $s);
   }	
   return $s;    	
  }//GetNormalSeparation
  
  /** обработка элементов стандарта по rambler */
  function ParseRamblerTextResult($s) {
   if ($s === false) { return $s; }
   $i = $this->strlen($s) - 1;
   $s1 = '';
   while ($i >= 0) {
	$ch = $s[$i];
	if ($this->ChTable($ch,'0-9')) {
	 $s1 = $this->substr($s, 0, $i+1);
	 break;	
	}	
	$i--;
   }    
   if ($s1 == '') { $s1 = $s; }
   $s = '  '.$s;
   $m = 1;   
   if ($this->stripos($s, DoEncodeDataToDef('млн')) > 1) { $m = 1000000; } 
   elseif ($this->stripos($s, DoEncodeDataToDef('тыс')) > 1) { $m = 1000; }
   $s1 = trim($this->GetNormalSeparation($s1));
   if (!@is_numeric($s1)) { return false; }
   return $s1 * $m;     	
  }//ParseRamblerTextResult
  
  /** rambler */
  function GetRamblerCountSites($Content, $Title) {
   $ExtSites = DoEncodeDataToDef('/запросу[\s]*найдено[\s]*([^a-z><;:,]+?)[\s]*сайтов/isU');
   if (!@preg_match($ExtSites, $Content, $ar)) { return 0; }
   return $this->ParseRamblerTextResult(trim($ar[1]));   	
  }//GetRamblerCountSites     
  
  /** получение с Search_Tut_By */
  function GetSearch_Tut_By_CountSearch($Content, $Title) {
   $Ext = DoEncodeDataToDef('/нашёл[^a-z><;:,]*<[\s]*b[\s]*>(.+?)<[\s]*\/[\s]*b[\s]*>[^a-z><;:,]*страниц[^a-z><;:,]*,/isU');  
   if (!@preg_match($Ext, $Content, $ar)) { return 0; }      
   return $this->GetTitledNumber('-      '.trim($ar[1]));   	
  }//GetSearch_Tut_By_CountSearch
  
  /** получение с specpoinsk.ru */
  function Get_Specpoisk_ru_CountSearch($Content, $Title) {
   $Ext = DoEncodeDataToDef('/нашел[\s]*([0-9][^a-z><;:,]+?)[^a-z><;:,]*страниц[^a-z><;:,]*</isU');
   if (!@preg_match($Ext, $Content, $ar)) { return 0; }   
   return $this->GetTitledNumber('-      '.trim($ar[1]));	
  }//Get_Specpoisk_ru_CountSearch 
  
  /** генерация ссылки запроса xml yandex */
  function GenerateXMLAPIYandexLink($user, $key, $page, $region) {
   return 'http://xmlsearch.yandex.ru/xmlsearch?user='.$user.'&key='.$key.
   (($page != '') ? ('&page='.$page) : '').
   (($region != '') ? ('&lr='.$region.'&rstr=-'.$region) : '');	
  }//GenerateXMLAPIYandexLink
  
  /** генерация текста для отправки яндексу */
  function GenerateXMLAPIYandexBody($query, $region, $page) {
   return 
   	'<?xml version="1.0" encoding="UTF-8"?>'."\r\n".
   	" <request>\r\n".
   	"  <query>".$query."</query>\r\n".
   	(($page != '') ? "  <page>$page</page>\r\n" : '').
   	"  <groupings>\r\n".
   	'   <groupby attr="d" mode="deep" groups-on-page="10"  docs-in-group="1" />'."\r\n".
   	"  </groupings>\r\n".
   	" </request>";
  }//GenerateXMLAPIYandexBody
  
  /** xml запрос параметров (индекса, обраток) яндекс */
  function _DoXMLYandexIBAction(ss_ConnectQuery &$Request, ss_ConnectQuery $connect, $link) {
   global $_SS_ERROR_YANDEX_XML_BY_CODE;	   	
   $L = $this->GenerateXMLAPIYandexLink($this->_yandex_use_xml_pack['username'], 
   $this->_yandex_use_xml_pack['key'], '', '');      
   $query = DoDecodeDataToDef($Request->GetEcranedURL($connect->ReplaceCorrect($link)));
   $query = $this->GenerateXMLAPIYandexBody($query, '', '');
   $Request->connect_specidy_encoded_page = 'utf-8';
   //запрос
   $this->SetError('');
   if (!$Request->RequestPOST($L, $query)) {   	
	$this->SetError('Yandex XML Error: '.$Request->res_error);
	$Request->connect_specidy_encoded_page = false;
	return false;	
   }   
   $Request->connect_specidy_encoded_page = false;
   //проверка ответа     
   $p = new ss_HTMLTagParser();
   $p->use_regext_preg_to_search = true;
   $p->SetData($Request->GetData(), 'error', $Request->GetDataRealLength());
   if ($p->GetTag()) { 
    $code  = $p->GetParamValue('code');   
    $error = $p->GetParamValue('');    
    if (!$error && @isset($_SS_ERROR_YANDEX_XML_BY_CODE[$code])) {
	 $error = $_SS_ERROR_YANDEX_XML_BY_CODE[$code];	
	}
    $this->SetError('Yandex XML Error: '.$error);
	return false;	
   }
   //unset($p);   
   //результат   
   return ($this->_only_xml_yandex_bodyget) ? true : 
    $this->GetYandexCountBack($Request->GetData(), $Request->GetTitle());   	
  }//_DoXMLYandexIBAction
  
  /** Выбор активного источника данных */
  function GetActiveDataSourceCenter($datasources, &$type_number) {
   global $_SS_READ_SOURCE_DATA_TYPE_NUMBER_PL;
   if (!@is_array($datasources)) { $datasources = array($datasources); }
   $type_number = ($_SS_READ_SOURCE_DATA_TYPE_NUMBER_PL !== false) ? 
   @call_user_func($_SS_READ_SOURCE_DATA_TYPE_NUMBER_PL, $this, $datasources) : 0;
   if (!@is_numeric($type_number)) { $type_number = 0; }   
   return $datasources[$type_number];   	
  }//GetActiveDataSourceCenter
  
  /** парсинг по умолчанию google */
  function _DoParseResultsGoogleData(ss_ConnectQuery &$Request) {
   $Ext = '/[of about|of|about|resultstats>][\s]*([0-9\.,]+?)[\s]*results/isU';   
   if (!@preg_match($Ext, $Request->GetData(), $ar)) { return 0; }
   return $this->GetNormalSeparation(trim($ar[1]));   	
  }//_DoParseResultsData
  
  /** удаление не числовых элементов */
  function DeleteAllNoNumber($s) {
   if (!$s) { return false; }
   $I = 0;
   $res = '';
   while ($I < $this->strlen($s)) {
	if (($s[$I] == '&') || ($s[$I] == '#')) {
	 while ($I < $this->strlen($s)) {
	  if ($s[$I] == ';') { break; } else { $I++; }	  	
	 }	
	 if ($I >= $this->strlen($s)) { break; }	 	
	}
	if ($this->ChTable($s[$I], '0-9')) {
	 $res .= $s[$I];	
	}
	$I++;	
   }
   return (!$res) ? false : $res;   	
  }//DeleteAllNoNumber
  	
 }//ss_Plugin_IndexTemplate  
 //-----------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>