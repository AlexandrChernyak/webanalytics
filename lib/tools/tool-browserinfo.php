<?php
 /** Модуль управления инструментом `информация о браузере`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_browserinfo extends w_toolitem_noajax_method {	
  protected
   $http,
   $result;
  
  function FlagExists() {
   return @file_exists(W_SITEDIR.'/img/items/flag/'.$this->GetResult('geoinfo.geoplugin_countryName').'.gif');	
  }//FlagExists
  
  function GetFlagName() { return W_SITEPATH.'img/items/flag/'.$this->GetResult('geoinfo.geoplugin_countryName').'.gif'; }
  function cList_($s) { return @str_replace(';', '; ', @str_replace(',', ', ', $s)); }
  
  function _DoActionThisTool() {
   $this->result = array(
    //информация о ip
	'ipinfo' => array('ip' => $this->GetCurrentIP())
   );	
   //geo
   $http = new ss_HTTP_obj();
   $params = array('ip' => $this->GetResult('ipinfo.ip')); $error = $value = '';
   if ($params['ip'] && $http->RunPluginEx(SS_GEOLOCALEIP, $error, $value, $params)) {
	$this->result['geoinfo'] = $value;	
   }
   //провайдер
   if ($ip = $this->GetResult('ipinfo.ip')) { 
   	$this->result['ipinfo']['hostip'] = @gethostbyaddr($ip);    
    //$this->result['ipinfo']['list_ip'] = @gethostbynamel($ip);
   }	     
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_browserinfo

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>