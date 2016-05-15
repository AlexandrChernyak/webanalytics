<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** index images yandex
 * @author [Eugene]
 * @copyright 2012
 * @url http://forwebm.net
 */
 //----------------------------------------------------------------- 
 final class ss_Plugin_IndexYandexImages extends ss_Plugin_IndexTemplate {  
  const LINK_QUERY = 'http://images.yandex.ru/yandsearch?site=[url_real_host_no_www]';
   
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'IndexYandexImages', 'Yandex Image Index', 3);	 
  }//__construct
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect();    
   $type_number = 0;
   $link_query = '';
   
   if (!$this->_DoActionDefaultData($Request, self::LINK_QUERY, $type_number, $link_query)) { 
   	return false; 
   }
   
   if (@preg_match("/найдено[\s]*картинок[\s]*:[\s]*<[\s]*strong[\s]*>(.*?)<[\s]*\/[\s]*strong[\s]*>/isu", 
    $Request->GetData(), $arr)) {

    $s = @preg_replace("/[^0-9]/", '', $arr[1]);   
    return ($s == '') ? 0 : $this->GetTitledNumber(" :w   $s  ");
    
   }  
   
   $this->SetUnknowNameError();
   return false;      	
  }//ExecPlugin 
  
  function GetCachURLmd5() { return @md5($this->strtolower($this->GetConnect()->url_real_host_without_www)); }
    	
 }//ss_Plugin_IndexYandexImages
 //-----------------------------------------------------------------
 /* Copyright (с) 2012 forwebm.net */ 
?>