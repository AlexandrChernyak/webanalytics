<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** адрес огранизации по Яндексу
 * @author [Eugene]
 * @copyright 2012
 * @url http://forwebm.net
 */
 //----------------------------------------------------------------- 
 final class ss_Plugin_URLOrganizationAdressBYandex extends ss_Plugin_IndexTemplate {  
  const LINK_QUERY = 'http://yandex.ru/yandsearch?text=[url_host_no_www]&site=[url_real_host_no_www]&ras=1&site_manually=true';
   
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'URLOrganizationAdressBYandex', 'Yandex Org Adress', 3);	 
  }//__construct
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   
   //$Request->connect_use_cookies = 'dfcookies';
   if (!$Request->RequestGET($this->GetConnect()->ReplaceCorrect(self::LINK_QUERY))) {
    return $this->SetError($Request->res_error);
   }
   
   $p = new ss_HTMLTagParser();
   $p->SetData($Request->GetData(), 'div');
   
   $data = false;
   while ($p->GetTag()) {    
    if ($this->stripos($p->GetParamValue('class'), 'address') === false) continue;         
    $data = $p->GetParamValue('');
    break;    
   }
   
   if (!$data) return ''; // { print $Request->GetData(); exit; } 
   
   $p->SetData($data, 'a');
   $data = false;
   
   while ($p->GetTag()) {
    if ($this->stripos($p->GetParamValue('class'), 'address') === false) continue;         
    $data = $p->GetParamValue('');
    break;      
   }
   
   if (!$data) return '';
   
   //$data = $this->ClearElementsInText($data, ",\s0-9");
   while($data != @strip_tags($data)) { $data = @strip_tags($data); } 
   
   return (!$data) ? '' : $this->HTMLspecialChars($data);      	
  }//ExecPlugin 
  
  function GetCachURLmd5() { return @md5($this->strtolower($this->GetConnect()->url_real_host_without_www)); }
    	
 }//ss_Plugin_URLOrganizationAdressBYandex
 //-----------------------------------------------------------------
 /* Copyright (с) 2012 forwebm.net */ 
?>