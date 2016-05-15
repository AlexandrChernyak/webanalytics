<?php
 /** Модуль управления инструментом `whois ip сайта`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_whoisurlip extends w_toolitem_noajax_method {	
  protected
   $http,
   $result;
  	
  function _DoActionThisTool() {
   if ($_POST['doactiontool'] != 'do') { 
   	if (!isset($_GET['t2']) || !$_GET['t2']) { return false; }
	$_POST['url'] = $_GET['t2'];
	$_POST['doactiontool'] = 'do';    
   }
   $http = new ss_HTTP_obj();
   $this->http = $http;     
   if (!$http->SetURL($_POST['url'])) { return $this->SetError('Error in parse url!'); }
   $_POST['url'] = $http->url_host;
   $error = $value = ''; 	  
   if (!$http->RunPluginEx(SS_WHOISIP, $error, $this->result)) {
	return $this->SetError((!$error) ? $this->GetText('erroractiontool', array('Whois IP')) : $error);
   }
   $this->AddDataToHistory($http->url_host);
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_whoisurlip

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>