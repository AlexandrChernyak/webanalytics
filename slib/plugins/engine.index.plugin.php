<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** Модуль плагина индекса поисковиков
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 abstract class ss_Plugin_IndexTemplate extends ss_Plugin_EnginesOpt {
  
  function __construct(ss_Plugin_obj_List $AOwner, $id, $shortname, $daysstored=2, $checkYandexXML=false) {   
   //создание плагина по шаблону  	
   parent::__construct($AOwner, $id, $shortname, 'Индекс ', 'Проиндексировано ', $daysstored, $checkYandexXML);	
  }//__construct	  
  	 	  	
 }//ss_Plugin_IndexTemplate 
 //-----------------------------------------------------------------
  
 /** индекс Яндекс */
 final class ss_Plugin_IndexYandex extends ss_Plugin_IndexTemplate {  	
  const LINK_QUERY = 'http://yandex.ru/yandsearch?text=[url_link]&site=[url_host]&ras=1&site_manually=true&lr=225';
  const LINK_QUERY_SEARCH_TUT_BY = 'http://search.tut.by/?status=1&ru=1&encoding=1&page=0&how=rlv&query=&new_req=%2B&sv=[url_host]';
  const LINK_QUERY_XML = '[url_host_no_www] site:[url_host]';  
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'IndexYandex', 'Яндекс', 2, true);	 
  }//__construct  
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect();
   //xml      
   if ($this->_yandex_use_xml_pack) { return $this->_DoXMLYandexIBAction($Request, $connect, self::LINK_QUERY_XML); }   
   //стандартный запрос  
   $type_number = 0;
   $link_query = '';
   if (!$this->_DoActionDefaultData(
    $Request, array(self::LINK_QUERY, self::LINK_QUERY_SEARCH_TUT_BY), $type_number, $link_query)
   ) { 
   	return false; 
   }   
   switch ($type_number) {
	case 0: /* default */ return $this->GetYandexCountBack($Request->GetData(), $Request->GetTitle());
	case 1: /* search.tut.by */ return $this->GetSearch_Tut_By_CountSearch($Request->GetData(), $Request->GetTitle());	
   }
   $this->SetUnknowNameError();
   return false;      	
  }//ExecPlugin  
  	
 }//ss_Plugin_IndexYandex
 //-----------------------------------------------------------------
 /** Индекс Google */
 final class ss_Plugin_IndexGoogle extends ss_Plugin_IndexTemplate {
  const LINK_QUERY = 'https://www.google.com/search?hl=en&q=site:[url_link]&newwindow=1&filter=0';
 
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'IndexGoogle', 'Google', 2);	 
  }//__construct
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect();    
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
    	
 }//ss_Plugin_IndexGoogle	  
 //-----------------------------------------------------------------
 /** Индекс Yahoo */
 final class ss_Plugin_IndexYahoo extends ss_Plugin_IndexTemplate {
  const LINK_QUERY = 'http://siteexplorer.search.yahoo.com/search?p=[url_host]&fr=sfp';
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'IndexYahoo', 'Yahoo', 2);	 
  }//__construct
  
  protected function _DoGetIndexFromDataText(ss_ConnectQuery &$Request) {
   $Ext = '/pages[\s]*\(([0-9,\.\-\s]+?)\)/isU';
   if (!@preg_match($Ext, $Request->GetData(), $ar)) { return 0; }
   return $this->GetNormalSeparation(trim($ar[1]));   	
  }//_DoGetIndexFromDataText
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect(); 
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
  	
 }//ss_Plugin_IndexYahoo	  
 //-----------------------------------------------------------------
 /** Индекс Rambler */
 final class ss_Plugin_IndexRambler extends ss_Plugin_IndexTemplate {
  const LINK_QUERY = 'http://nova.rambler.ru/search?sort=0&oe=1251&limit=50&filter=[url_host]';
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'IndexRambler', 'Rambler', 2);	 
  }//__construct
  
  protected function _DoGetIndexFromDataText(ss_ConnectQuery &$Request) {
   $Ext = DoEncodeDataToDef('/найдено[\s]*([0-9а-я\.\s,]+?)докум/isu');   
   if (!@preg_match($Ext, $Request->GetData(), $ar)) { return 0; }   
   return $this->ParseRamblerTextResult($this->GetNormalSeparation(trim($ar[1])));      	
  }//_DoGetIndexFromDataText
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect(); 
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
  	
 }//ss_Plugin_IndexRambler	  
 //-----------------------------------------------------------------
 /** Индекс bing.com */
 final class ss_Plugin_IndexBing extends ss_Plugin_IndexTemplate {
  const LINK_QUERY = 'http://www.bing.com/search?q=site%3A[url_host]';
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'IndexBing', 'Bing.com', 2);	 
  }//__construct
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect(); 
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
  	
 }//ss_Plugin_IndexBing	   
 //-----------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>