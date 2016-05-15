<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** majesticseo.com
 * @author [Eugene]
 * @copyright 2012
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 
 /** majesticseo.com */
 final class ss_Plugin_GeneralMajesticseoInfo extends ss_Plugin_GenTemplate {  	
  const LINK_QUERY = 'http://enterprise.majesticseo.com/api_command?app_api_key=API_KEY&cmd=GetIndexItemInfo&items=1&item0=[url_real_host]';
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'GeneralMajesticseoInfo', 'info from majesticseo.com', 3);	 
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
   if (!$obj = @simplexml_load_string(trim($Request->GetData()))) return $this->SetError('no result found!');
 
   if (@$obj->attributes()->Code != 'OK') return $this->SetError('no result found!');
   if (!$hs = @$obj->DataTables->DataTable->attributes()->Headers) return $this->SetError('no result found!');
   if (!$rw = @$obj->DataTables->DataTable->Row) return $this->SetError('no result found!');
   
   $hs = @explode('|', @trim($hs));
   $rw = @explode('|', @trim($rw));
   
   $rw_c = @count($rw);
   
   for ($i=0; $i<= @count($hs) - 1; $i++) {
    if (!$hs[$i] || $i > $rw_c - 1) break;
    
    $result[$hs[$i]] = $rw[$i];
   }    
            
   return (!$result) ? $this->SetError('no result found!') : $result;      	
  }//ExecPlugin 
  
  function GetCachURLmd5() {
   return @md5($this->strtolower($this->GetConnect()->url_real_host_without_www));	
  }//GetCachURLmd5
  
  function GetFlagUseLongData() { return true; } 
  	
 }//ss_Plugin_GeneralMajesticseoInfo
 //-----------------------------------------------------------------
 /* Copyright (с) 2012 forwebm.net */ 
?>