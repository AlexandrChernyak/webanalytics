<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** Модуль плагина обраток поисковиков
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 abstract class ss_Plugin_BackTemplate extends ss_Plugin_EnginesOpt {
  
  function __construct(ss_Plugin_obj_List $AOwner, $id, $shortname, $daysstored=2, $checkYandexXML=false) {   
   //создание плагина по шаблону  	
   parent::__construct($AOwner, $id, $shortname, 'Ссылок с ', 'Обратных ссылок с ', $daysstored, $checkYandexXML);	
  }//__construct	
  
  /** получение идентификатора секции сайта для кэша */
  function GetCachURLmd5() {
   return @md5($this->strtolower($this->GetConnect()->url_host_without_www));	
  }//GetCachURLmd5
  	 	  	
 }//ss_Plugin_BackTemplate 
 //-----------------------------------------------------------------
 /** ссылок с Яндекс */
 final class ss_Plugin_BackYandex extends ss_Plugin_BackTemplate {  	
  const LINK_QUERY = 'http://yandex.ru/yandsearch?text=%22[url_host_no_www]%22';
  const LINK_QUERY_SEARCH_TUT_BY = 
  'http://search.tut.by/?status=1&ru=1&encoding=1&page=0&how=rlv&query=%22[url_host_no_www]%22&new_req=%2B';
  const LINK_QUERY_SPECPOINSK_RU = 'http://specpoisk.ru/?query=%22[url_host_no_www]%22&gde=3';
  const LINK_QUERY_XML = '"[url_host]"';  
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'BackYandex', 'Яндекс', 2, true);	 
  }//__construct  
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect();
   //xml
   if ($this->_yandex_use_xml_pack) { return $this->_DoXMLYandexIBAction($Request, $connect, self::LINK_QUERY_XML); }
   //стандартный запрос  
   $type_number = 0;
   $link_query = '';
   if (!$this->_DoActionDefaultData(
    $Request, array(
	 self::LINK_QUERY, self::LINK_QUERY_SEARCH_TUT_BY, self::LINK_QUERY_SPECPOINSK_RU
	), $type_number, $link_query)
   ) { 
   	return false; 
   }   
   switch ($type_number) {
	case 0: /* default */ return $this->GetYandexCountBack($Request->GetData(), $Request->GetTitle());
	case 1: /* search.tut.by */ return $this->GetSearch_Tut_By_CountSearch($Request->GetData(), '');
	case 2: /* specpoisk.ru */ return $this->Get_Specpoisk_ru_CountSearch($Request->GetData(), '');	
   }
   $this->SetUnknowNameError();
   return false;      	
  }//ExecPlugin  
  	
 }//ss_Plugin_BackYandex
 //-----------------------------------------------------------------
 /** ссылок с Яндекс блогов */
 final class ss_Plugin_BackYandexBlogs extends ss_Plugin_BackTemplate {  	
  //const LINK_QUERY = 'http://blogs.yandex.ru/search.xml?text=[url_host]';  
  const LINK_QUERY = 'http://blogs.yandex.ru/search.rss?text=[url_real_host_no_www]&ft=all';   
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'BackYandexBlogs', 'Yandex Blogs', 2);	 
  }//__construct  
  
  protected function _DoGetIndexFromDataText(ss_ConnectQuery &$Request) {
   //$Ext = DoEncodeDataToDef('/из[\s]*<[\s]*b[\s]*>([^a-z><;:,]+?)<[\s]*\/[\s]*b[\s]*>[\s]*[а-я]/isU');   
   $Ext = DoEncodeDataToDef('/<[\s]*yablogs:count[\s]*>(.*)<[\s]*\/[\s]*yablogs:count[\s]*>/isu');
   
   if (!@preg_match($Ext, $Request->GetData(), $ar)) { return 0; }       
   return $this->GetTitledNumber('-      '.trim($ar[1]));   	
  }//_DoGetIndexFromDataText
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect();
   //стандартный запрос  
   $type_number = 0;
   $link_query = '';
   if (!$this->_DoActionDefaultData($Request, self::LINK_QUERY, $type_number, $link_query)) { 
   	return false; 
   }   
   switch ($type_number) {
	case 0: /* default */ return $this->_DoGetIndexFromDataText($Request);	
   }
   $this->SetUnknowNameError();
   return false;      	
  }//ExecPlugin  
  	
 }//ss_Plugin_BackYandexBlogs
 //-----------------------------------------------------------------
 /** ссылок с Google */
 final class ss_Plugin_BackGoogle extends ss_Plugin_BackTemplate {  	
  const LINK_QUERY = 'http://www.google.com/search?hl=en&lr=&ie=UTF-8&q=link%3A[url_host]';  
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'BackGoogle', 'Google', 2);	 
  }//__construct  
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect();
   //стандартный запрос  
   $type_number = 0;
   $link_query = '';
   if (!$this->_DoActionDefaultData($Request, self::LINK_QUERY, $type_number, $link_query)) { 
   	return false; 
   }   
   switch ($type_number) {
	case 0: /* default */ return $this->_DoParseResultsGoogleData($Request);	
   }
   $this->SetUnknowNameError();
   return false;      	
  }//ExecPlugin  
  	
 }//ss_Plugin_BackGoogle
 //-----------------------------------------------------------------
 /** ссылок с Yahoo */
 final class ss_Plugin_BackYahoo extends ss_Plugin_BackTemplate {  	
  const LINK_QUERY = 'http://siteexplorer.search.yahoo.com/search?p=[url_host]&fr=sfp';  
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'BackYahoo', 'Yahoo', 2);	 
  }//__construct
  
  protected function _DoGetBackFromDataText(ss_ConnectQuery &$Request) {
   $Ext = '/inlinks[\s]*\(([0-9,\.\-\s]+?)\)/isU';
   if (!@preg_match($Ext, $Request->GetData(), $ar)) { return 0; }
   return $this->GetNormalSeparation(trim($ar[1]));   	
  }//_DoGetIndexFromDataText  
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect();
   //стандартный запрос  
   $type_number = 0;
   $link_query = '';
   if (!$this->_DoActionDefaultData($Request, self::LINK_QUERY, $type_number, $link_query)) { 
   	return false; 
   }   
   switch ($type_number) {
	case 0: /* default */ return $this->_DoGetBackFromDataText($Request);	
   }
   $this->SetUnknowNameError();
   return false;      	
  }//ExecPlugin  
  	
 }//ss_Plugin_BackYahoo
 //-----------------------------------------------------------------
 /** ссылок с Rambler */
 final class ss_Plugin_BackRambler extends ss_Plugin_BackTemplate {  	
  const LINK_QUERY = 'http://nova.rambler.ru/srch?query=link:[url_host]';  
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'BackRambler', 'Rambler', 2);	 
  }//__construct
  
  protected function _DoGetBackFromDataText(ss_ConnectQuery &$Request) {
   //документов	
   $Ext = DoEncodeDataToDef('/сайтов[,\s]*([^a-z><;:,]+?)[\s|\r|\n]*документов/isU');
   $res = array('docs' => 0, 'sites' => 0);      
   if (@preg_match($Ext, $Request->GetData(), $ar)) {
   	$res['docs'] = $this->ParseRamblerTextResult(trim($ar[1])); 
   }
   //сайтов
   $sites = $this->GetRamblerCountSites($Request->GetData(), '');
   if ($sites !== false) { $res['sites'] = $sites; }   
   return ($res) ? $res : false;   	
  }//_DoGetIndexFromDataText  
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect();
   //стандартный запрос  
   $type_number = 0;
   $link_query = '';
   if (!$this->_DoActionDefaultData($Request, self::LINK_QUERY, $type_number, $link_query)) { 
   	return false; 
   }   
   switch ($type_number) {
	case 0: /* default */ return $this->_DoGetBackFromDataText($Request);	
   }
   $this->SetUnknowNameError();
   return false;      	
  }//ExecPlugin  
  	
 }//ss_Plugin_BackRambler
 //-----------------------------------------------------------------
 /** ссылок с Bing */
 final class ss_Plugin_BackBing extends ss_Plugin_BackTemplate {  	
  const LINK_QUERY = 'http://www.bing.com/search?q=-site%3A[url_host]+[url_host]&go=&form=QBNO';  
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'BackBing', 'Bing.com', 2);	 
  }//__construct  
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect();
   //стандартный запрос  
   $type_number = 0;
   $link_query = '';
   if (!$this->_DoActionDefaultData($Request, self::LINK_QUERY, $type_number, $link_query)) { 
   	return false; 
   }   
   switch ($type_number) {
	case 0: /* default */ return $this->GetMsnCountBack($Request->GetData(),'');	
   }
   $this->SetUnknowNameError();
   return false;      	
  }//ExecPlugin  
  	
 }//ss_Plugin_BackBing
 //-----------------------------------------------------------------
 /** ссылок с AltaVista */
 final class ss_Plugin_BackAltaVista extends ss_Plugin_BackTemplate {  	
  const LINK_QUERY = 'http://www.altavista.com/web/results?itag=ody&q=-site:[url_host]+[url_host]&kgs=0&kls=0';  
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'BackAltaVista', 'AltaVista', 2);	 
  }//__construct  
  
  protected function _DoGetBackFromDataText(ss_ConnectQuery &$Request) {
   $Ext  = '/found[\s|&nbsp;]([0-9,\.\s]+?)[\s|&nbsp;]results/isU';
   $Ext1 = '/id="resultcount">([0-9,\.\s]+?)</isU';
   if (!@preg_match($Ext, $Request->GetData(), $ar)) {
   	if (!@preg_match($Ext1, $Request->GetData(), $ar)) { return 0; }
   }
   return $this->GetNormalSeparation(trim($ar[1]));     	
  }//_DoGetIndexFromDataText
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect();
   //стандартный запрос  
   $type_number = 0;
   $link_query = '';
   if (!$this->_DoActionDefaultData($Request, self::LINK_QUERY, $type_number, $link_query)) { 
   	return false; 
   }   
   switch ($type_number) {
	case 0: /* default */ return $this->_DoGetBackFromDataText($Request);	
   }
   $this->SetUnknowNameError();
   return false;      	
  }//ExecPlugin  
  	
 }//ss_Plugin_BackAltaVista
 //-----------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>