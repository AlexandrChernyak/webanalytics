<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** Модуль плагинов наличия в каталогах
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 abstract class ss_Plugin_InDirTemplate extends ss_Plugin_EnginesOpt {
  
  function __construct(ss_Plugin_obj_List $AOwner, $id, $shortname, $daysstored=2, $checkYandexXML=false) {   
   //создание плагина по шаблону  	
   parent::__construct($AOwner, $id, $shortname, 'В каталоге ', 'Наличие в каталоге ', $daysstored, $checkYandexXML);	
  }//__construct	
  	 	  	
 }//ss_Plugin_InDirTemplate 
 //-----------------------------------------------------------------
 /** в каталоге Яндекс */
 final class ss_Plugin_InDirYandex extends ss_Plugin_InDirTemplate {  	
  const LINK_QUERY = 'http://search.yaca.yandex.ru/yandsearch?text=[url_link]&rpt=rs2';
  const USE_QUICK_CHECK = true; /* 1-quick, 0-count of links */
  const CONTINUE_ANY = false; /* continue, if no results found and USE_QUICK_CHECK is true */
    
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'InDirYandex', 'Яндекс', 2);	 
  }//__construct  
  
  protected function _DoGetInDirFromDataText(ss_ConnectQuery &$Request) {
   $Ext = '/\((.\d*)\)/isU';   
   if (!@preg_match($Ext, $Request->GetTitle(), $ar)) { return 0; }   
   return $this->GetTitledNumber('-      '.trim($ar[1]));   	
  }//_DoGetIndexFromDataText
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect();
   //switch method, if quick check
   if (self::USE_QUICK_CHECK && $connect->RunPluginEx(SS_YANDEXCY, $error, $value)) {
	//return ($value['yacacatalog']) ? 1 : 0;
	if ($value['yacacatalog']) { return 1; }
	if (self::CONTINUE_ANY) { return 0; }
   }
   //def query  
   $type_number = 0;
   $link_query = '';   
   if (!$this->_DoActionDefaultData($Request, self::LINK_QUERY, $type_number, $link_query)) { 
   	return false; 
   }   
   switch ($type_number) {
	case 0: /* default */ return $this->_DoGetInDirFromDataText($Request);	
   }
   $this->SetUnknowNameError();
   return false;      	
  }//ExecPlugin  
  	
 }//ss_Plugin_InDirYandex
 //-----------------------------------------------------------------
 /** сайты в каталоге Яндекс */
 final class ss_Plugin_InDirFromYandex extends ss_Plugin_InDirTemplate {  	
  const LINK_QUERY = 'http://yaca.yandex.ru/yca?text=%22[url_host_no_www]%22';
    
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'InDirFromYandex', 'Яндекс', 2);	 
  }//__construct  
  
  protected function _DoGetInDirFromDataText(ss_ConnectQuery &$Request) {
   $Ext = '/\((.\d*)\)/isU';   
   if (!@preg_match($Ext, $Request->GetTitle(), $ar)) { return 0; }   
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
	case 0: /* default */ return $this->_DoGetInDirFromDataText($Request);	
   }
   $this->SetUnknowNameError();
   return false;      	
  }//ExecPlugin  
  	
 }//ss_Plugin_InDirFromYandex
 //-----------------------------------------------------------------
 /** в каталоге DMOZ */
 final class ss_Plugin_InDirDMOZ extends ss_Plugin_InDirTemplate {  	
  const LINK_QUERY = 'http://www.dmoz.org/search?q=[url_host]';
    
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'InDirDMOZ', 'DMOZ', 2);	 
  }//__construct  
  
  protected function _DoGetInDirFromDataText(ss_ConnectQuery &$Request) {
   $Ext = '/\([0-9,\.\-\s]+[\s]*of[\s]*([0-9,\.\s]+?)\)<[\s]*\/[\s]*small[\s]*>/isU';      
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
	case 0: /* default */ return $this->_DoGetInDirFromDataText($Request);	
   }   
   $this->SetUnknowNameError();
   return false;      	
  }//ExecPlugin  
  	
 }//ss_Plugin_InDirDMOZ
 //-----------------------------------------------------------------
 /** в каталоге rambler top 100 */
 final class ss_Plugin_InDirRamblerTop100 extends ss_Plugin_InDirTemplate {  	
  const LINK_QUERY = 'http://search.rambler.ru/cgi-bin/counter_search?words=[url_host]&limit=10';
    
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'InDirRamblerTop100', 'Rambler Top 100', 2);	 
  }//__construct  
  
  protected function _DoGetInDirFromDataText(ss_ConnectQuery &$Request) {
   $ExtSites = DoEncodeDataToDef(
    '/[\s|&nbsp;]сайтов[\s]*:[\s|&nbsp;]*<[\s]*b[\s]*>([0-9,\.\s]+?)<[\s]*\/[\s]*b[\s]*>[\s|&nbsp;|,|.]/isU'
   );
   $ExtRes   = DoEncodeDataToDef(
    '/,[\s|&nbsp;]*ресурсов[\s]*:[\s|&nbsp;]*<[\s]*b[\s]*>([0-9,\.\s]+?)<[\s]*\/[\s]*b[\s]*>/isU'
   );
   $res = array('sites' => 0, 'resources' => 0);
   //сайтов
   if (@preg_match($ExtSites, $Request->GetData(), $ar)) {
   	$res['sites'] = $this->ParseRamblerTextResult(trim($ar[1])); 
   }
   //ресурсов
   if (@preg_match($ExtRes, $Request->GetData(), $ar)) {
   	$res['resources'] = $this->ParseRamblerTextResult(trim($ar[1])); 
   }
   return ($res) ? $res : false;   	
  }//_DoGetIndexFromDataText
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect();
   $Request->connect_specidy_encoded_page = 'windows-1251';   
   //стандартный запрос  
   $type_number = 0;
   $link_query = '';
   if (!$this->_DoActionDefaultData($Request, self::LINK_QUERY, $type_number, $link_query)) {
   	$Request->connect_specidy_encoded_page = false; 
   	return false; 
   }   
   switch ($type_number) {
	case 0: /* default */ return $this->_DoGetInDirFromDataText($Request);	
   }
   $this->SetUnknowNameError();
   $Request->connect_specidy_encoded_page = false;
   return false;      	
  }//ExecPlugin  
  	
 }//ss_Plugin_InDirRamblerTop100
 //-----------------------------------------------------------------
 /** в каталоге mail.ru */
 final class ss_Plugin_InDirMail extends ss_Plugin_InDirTemplate {  	
  const LINK_QUERY = 'http://search.list.mail.ru/?q=[url_host]';
    
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'InDirMail', 'Mail.ru', 2);	 
  }//__construct  
  
  protected function _DoGetInDirFromDataText(ss_ConnectQuery &$Request) {
   $Ext  = DoEncodeDataToDef(
    '/[\s]*сайтов[\s]*:[\s]*<(.+?)>[\s]*<[\s]*b[\s]*>([0-9,\.\s]+?)[\s]*<[\s]*\/[\s]*b[\s]*>/isU'
   );
   $Ext1 = DoEncodeDataToDef(
    '/totalsites[\s]*:[\s|\r\n]*([0-9\.]+?)[\s|\r\n]*,/isU'
   );      
   if (!@preg_match($Ext, $Request->GetData(), $ar)) { return 0; }
   $res = $this->ParseRamblerTextResult(trim($ar[2]));   
   if (($res == '0') and (@preg_match($Ext1, $Request->GetData(), $ar)) and ($ar)) {   	
	$res1 = $this->ParseRamblerTextResult(trim($ar[1]));
	if ($res1 > $res) { $res = $res1; }	
   }   
   return $res;   	
  }//_DoGetIndexFromDataText
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect();
   $Request->connect_delete_spec_tags = 0;
   //стандартный запрос  
   $type_number = 0;
   $link_query = '';
   if (!$this->_DoActionDefaultData($Request, self::LINK_QUERY, $type_number, $link_query)) {
   	$Request->connect_delete_spec_tags = -1; 
   	return false; 
   }   
   switch ($type_number) {
	case 0: /* default */ return $this->_DoGetInDirFromDataText($Request);	
   }
   $this->SetUnknowNameError();
   $Request->connect_delete_spec_tags = -1;
   return false;      	
  }//ExecPlugin  
  	
 }//ss_Plugin_InDirMail
 //-----------------------------------------------------------------
 /** в каталоге Aport */
 final class ss_Plugin_InDirAport extends ss_Plugin_InDirTemplate {  	
  const LINK_QUERY = 'http://search.aport.ru/search/?r=[url_host]&That=cat&Base=aportCat&Tn=6&CL=';      
    
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'InDirAport', 'Aport', 2);	 
  }//__construct  
  
  protected function _DoGetInDirFromDataText(ss_ConnectQuery &$Request) {
   $ExtDocs = DoEncodeDataToDef('/([0-9,\.\s]+?)[\s|&nbsp;]документ[а-я]*[\s|&nbsp;|\)]*/isU');
   $res = array('docs' => '0', 'sites' => '0');
   //документов
   if (@preg_match($ExtDocs, $Request->GetTitle(), $ar)) {
   	$res['docs'] = $this->ParseRamblerTextResult(trim($ar[1])); 
   }
   //сайтов
   $dd = $this->GetAportCountSearchDir($Request->GetData(), $Request->GetTitle());
   if ($dd !== false) { $res['sites'] = $dd; }
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
	case 0: /* default */ return $this->_DoGetInDirFromDataText($Request);	
   }
   $this->SetUnknowNameError();
   return false;      	
  }//ExecPlugin  
  	
 }//ss_Plugin_InDirAport 
 //-----------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>