<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** Google PageSpeed Online
 * @author [Eugene]
 * @copyright 2012
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 
 /** google pagespeed online
  *  данные не используют кэш. Для включения поддержки кэширования - укажите кол-во дней
  *  хранения кэша > 0 (в конструкторе класса)
  */
 final class ss_Plugin_GooglePageSpeedOnline extends ss_Plugin_GenTemplate {  	
  const LINK_QUERY = 'https://www.googleapis.com/pagespeedonline/v1/runPagespeed?url=';
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'GooglePageSpeedOnline', 'Google PageSpeed Online', 2);	 
  }//__construct  
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $params = $this->GetRunParams();
   
   if (!$params['key']) return $this->SetError('No api key found!');
   if (!$params['url']) $params['url'] = $this->GetConnect()->url_self;
     
   $Request->connect_refferer_send = (!isset($params['ref'])) ? $params['url'] : $params['ref'];  
   $Request->connect_mime_types = false;
   
   $url = self::LINK_QUERY.$params['url']."&key={$params['key']}".
    (($params['userIp']) ? "&userIp={$params['userIp']}" : '').
    (($params['additionalparams']) ? "&{$params['additionalparams']}" : '');
       
   if (!$Request->RequestGET($url)) return $this->SetError($Request->res_error);
   //ok, parse data
   $result = array();   
   
   foreach (array(
    'score', 'numberResources', 'numberHosts', 'totalRequestBytes', 'numberStaticResources',
    'htmlResponseBytes', 'cssResponseBytes', 'imageResponseBytes', 'javascriptResponseBytes',
    'otherResponseBytes', 'numberJsResources', 'numberCssResources'
   ) as $item) {
    
    if (@preg_match("/[\"|'][\s]*{$item}[\"|'][\s]*:[\s]*(.*)[,\r\n\}]/isU", $Request->GetData(), $arr)) {

      if ($arr[1]) {
        
       $arr[1] = @preg_replace("/[^0-9\.]/", '', $arr[1]);
       
       if ($arr[1] != '' && @is_numeric($arr[1])) {
         $result[$item] = $arr[1];        
       }  
        
      }   
                       
    }
 
   }
            
   return (!$result) ? $this->SetError('no result found!') : $result;      	
  }//ExecPlugin 
  
  /** получение идентификатора секции сайта для кэша */
  function GetCachURLmd5() {
   return @md5($this->strtolower($this->GetConnect()->url_real_host_without_www));	
  }//GetCachURLmd5
  
  function GetFlagUseLongData() { return true; } 
  	
 }//ss_Plugin_GooglePageSpeedOnline
 //-----------------------------------------------------------------
 /* Copyright (с) 2012 forwebm.net */ 
?>