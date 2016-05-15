<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** Получение списка зеркал сайта
 * @author [Eugene]
 * @copyright 2012
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 
 final class ss_Plugin_GetURLHostMirrorsListElem extends ss_Plugin_GenTemplate {  	
  const LINK_QUERY = 'http://seobudget.ru/mirrorlist/[url_real_host]/';
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'GetURLHostMirrorsListElem', 'Mirrors list info', 4);	 
  }//__construct  
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $params = $this->GetRunParams();
   
   if (!$params['url']) $params['url'] = $this->GetConnect()->url_self;
   if (!$Request->SetURL($params['url'])) return $this->SetError('Can`t parse url!');
   
   $url = $Request->ReplaceCorrect(self::LINK_QUERY);   
   $Request->connect_mime_types = false;
       
   if (!$Request->RequestGET($url)) return $this->SetError($Request->res_error);
   
   //parse list mirrors...
   $p = new ss_HTMLTagParser();
   $p->SetData($Request->GetData(), 'table');
   
   $result = array();
   
   while ($p->GetTag()) {    
    if ($p->GetParamValue('id') == 'mirlist') {
      
      $p->SetData($p->GetParamValue(''), 'td');
      
      while ($p->GetTag()) {
        
       if (!$url = @trim($p->GetParamValue(''))) continue;       
       
       if (@preg_match("/([0-9a-zа-я_\-]+)\.([a-zа-я\-]+?)([^a-zа-я\-_]*)/isU", $url, $ar)) { 
        
        //$result[] = ((($this->strtolower($this->substr($url, 0, 4)) == 'www.') ? 'www.' : '').($ar[1].'.'.$ar[2]));
        $result[] = $ar[1].'.'.$ar[2];
        
       } else continue;
        
      }
      
      return $result;  
    }      
   }
             
   return $result;      	
  }//ExecPlugin  
  
  function GetCachURLmd5() {
   return @md5($this->strtolower($this->GetConnect()->url_real_host_without_www));	
  }//GetCachURLmd5
  
  function GetFlagUseLongData() { return true; } 
  	
 }//ss_Plugin_GetURLHostMirrorsListElem
 //-----------------------------------------------------------------
 /* Copyright (с) 2012 forwebm.net */ 
?>