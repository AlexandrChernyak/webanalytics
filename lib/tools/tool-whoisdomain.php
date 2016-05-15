<?php
 /** Модуль управления инструментом `whois владельца сайтаа`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_whoisdomain extends w_toolitem_noajax_method {	
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
   $params = array(
    'createddate' => 1,
    'expdate' => 1,
    'registrar' => 1,
    'ignorecach' => 1    
   );
   if (!$http->RunPluginEx(SS_WHOISDOMAINEX, $error, $this->result, $params)) {
	return $this->SetError((!$error) ? $this->GetText('erroractiontool', array('Whois Domain')) : $error);
   }
   if (!$this->result['nofound']) { $this->AddDataToHistory($http->url_host); }
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_whoisdomain

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>