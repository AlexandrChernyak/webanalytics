<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** кэш яндекса
 * @author [Eugene]
 * @copyright 2012
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 
 final class ss_Plugin_GetYandexCacheLinkData extends ss_Plugin_GenTemplate {  	
  const LINK_QUERY_XML = '[url_host_no_www] site:[url_host]';
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'GetYandexCacheLinkData', 'Yandex Cache', -1, true);	 
  }//__construct  
  
  function ExecPlugin(ss_ConnectQuery &$Request) {   
   $connect = $this->GetConnect();
   //xml      
   if (!$this->_yandex_use_xml_pack) return $this->SetError('No Yandex XML Active!');   
   //exec
   //$this->_only_xml_yandex_bodyget = true;
   
   $result = array('indexed' => $this->_DoXMLYandexIBAction($Request, $connect, self::LINK_QUERY_XML));
   
   if ($result['indexed'] === false) return false;
   
   //ok, preparse info
   $p = new ss_HTMLTagParser();
   $p->SetData($Request->GetData(), 'saved-copy-url');
   
   if ($p->GetTag()) {
    
    $result['cachedlink'] = $p->GetParamValue('');
       
   }
             
   return $result;      	
  }//ExecPlugin   
  	
 }//ss_Plugin_GetYandexCacheLinkData
 //-----------------------------------------------------------------
 /* Copyright (с) 2012 forwebm.net */ 
?>