<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** solomono.ru
 * @author [Eugene]
 * @copyright 2012
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 
 /** solomono.ru */
 final class ss_Plugin_SolomonoDataPlugin extends ss_Plugin_GenTemplate {  	
  const LINK_QUERY = 'http://xml.solomono.ru/?url=[url_real_host]';
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'SolomonoDataPlugin', 'Links back plugin info', 3);	 
  }//__construct  
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $params = $this->GetRunParams();
   
   if (!$params['url']) $params['url'] = $this->GetConnect()->url_self;
   if (!$Request->SetURL($params['url'])) return $this->SetError('Can`t parse url!');
   
   $url = $Request->ReplaceCorrect(self::LINK_QUERY);   
   $Request->connect_mime_types = false;
       
   if (!$Request->RequestGET($url)) return $this->SetError($Request->res_error);
   
   //ok, parse data
   $result = array();      
   $obj = @simplexml_load_string(trim($Request->GetData()));
   
   foreach ($obj as $name => $value) {  
    
    $result[$name] = (string) $value;  
    
    //if ($name == 'hin' || $name == 'din' || $name == 'hout') {   
  
     foreach($value->attributes() as $a => $b) {      
      $result[$name.'_'.$a] = (string) $b;        
     }        
        
    //}      
   }   
            
   return (!$result) ? $this->SetError('no result found!') : $result;      	
  }//ExecPlugin 
  
  function GetCachURLmd5() {
   return @md5($this->strtolower($this->GetConnect()->url_real_host_without_www));	
  }//GetCachURLmd5
  
  function GetFlagUseLongData() { return true; } 
  	
 }//ss_Plugin_SolomonoDataPlugin
 //-----------------------------------------------------------------
 /* Copyright (с) 2012 forwebm.net */ 
?>