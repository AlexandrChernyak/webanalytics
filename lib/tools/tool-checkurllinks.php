<?php
 /** Модуль управления инструментом `анализ ссылок сайта`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_checkurllinks extends w_toolitem_noajax_method {	
  protected
   $http,
   $result;
  
  function _DoActionThisTool() { 
   if ($_POST['doactiontool'] != 'do') { 
   	if (!isset($_GET['t2']) || !$_GET['t2']) { return false; }
	$_POST['url'] = ($_GET['plink']) ? $_GET['plink'] : $_GET['t2'];
	$_POST['doactiontool'] = 'do';
	$_POST['ignoreresh'] = 1;
	$_POST['getonlyhost'] = 1;  
   }
   $http = new ss_HTTP_obj();
   $this->http = $http;  
   if (!$http->SetURL($_POST['url'])) { return $this->SetError('Error in parse url!'); }
   $_POST['url'] = $http->url_self_no_protocol;
   //анализ ссылок   
   $error  = $value = '';
   $params = array(
    'usestrongregext' => 1,
    //'fetch_proc'    => array($this, 'PrepereLinkToGet')
    'ignoredoubled'   => $this->CheckPostValue('ignoredoubled'),
	'ignoreresh'      => $this->CheckPostValue('ignoreresh'),
	'getonlyhost'     => $this->CheckPostValue('getonlyhost'),
	'noinside'        => $this->CheckPostValue('noinside'),
	'nooutside'       => $this->CheckPostValue('nooutside'),
	'nosubdom'        => $this->CheckPostValue('nosubdom'),
	'dorequsturl'     => 1 //выполнять запрос только при новом обращении	 
   ); 	  
   if (!$http->RunPluginEx(SS_PAGELINKSLIST, $error, $this->result, $params)) {
	return $this->SetError((!$error) ? $this->GetText('erroractiontool', array('Links List')) : $error);
   }  
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_checkurllinks

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>