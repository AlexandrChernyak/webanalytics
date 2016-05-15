<?php
 /** Модуль управления инструментом `получение сервера сайта`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_getserver extends w_tools_gen_obj {
  const W_COUNT_OF_URL_ANALISYS = 6;
  const W_SLEEP_INTERVAL = 0.3;	
  protected
   $urls,
   $http;
  
  function GetHttp() { return $this->http; }
  function GetResult() { return ($this->urls) ? $this->urls : array(); }
  function GetLimitCount() { return self::W_COUNT_OF_URL_ANALISYS; }
  
  protected function PrepereUrlsList() {
   $_POST['urls'] = $this->ClearBreake($_POST['urls'], true, false);   	
   $this->urls = @preg_split("/\n/", $_POST['urls'], self::W_COUNT_OF_URL_ANALISYS);
   $this->urls = ($this->urls) ? @array_unique($this->urls) : false;
   if (!$this->urls) { return $this->SetError($this->GetText('nourlsforanalize')); }
   return true;   	
  }//PrepereUrlsList
  
  protected function IsIP($s) {
   return ($s && @preg_match('/(\d+).(\d+).(\d+).(\d+)/', $s));	
  }//IsIP
  	
  function _DoActionThisTool() {
   if ($_POST['doactiontool'] != 'do') { return false; }
   //подготовка сайтов
   if (!$this->PrepereUrlsList()) { return false; }
   $http = new ss_HTTP_obj();
   $this->http = $http;
   $result = array();
   $_POST['urls'] = '';
   //$index = 1;
   foreach ($this->urls as $url) {
   	$info = false;
   	if ($this->IsIP($url)) {
	 $info = array(
	  'host'   => $url,
	  'ip'     => $url,
	  'server' => $http->GetIPServer($url)
	 );	 	
	} elseif ($http->SetURL($url)) {	
	 $info = array();
	 $info['host']   = $http->url_host;
	 $info['ip']     = ($info['host']) ? $http->GetURLip($http->url_real_host) : false;
	 $info['server'] = ($info['ip']) ? $http->GetIPServer($info['ip']) : false;	 	
	}
	if ($info && $info['host'] && $info['ip'] && $this->IsIP($info['ip'])) {
	 $info['ipview'] = ss_Plugin_GenDomainsOnIP::LINK_QUERY.$info['ip'];	 	 
	 $result[] = $info;
	 if ($_POST['urls'] == '') { $_POST['urls'] = $info['host']; } else { $_POST['urls'] .= "\r\n".$info['host']; } 
	}
	if (self::W_SLEEP_INTERVAL > 0) { sleep(self::W_SLEEP_INTERVAL); }
	//if (self::W_COUNT_OF_URL_ANALISYS > 0 && $index > self::W_COUNT_OF_URL_ANALISYS) { break; }
	//$index++;		
   }
   if (!$result) { return $this->SetError($this->GetText('nourlsforanalize')); }
   $this->urls = $result;
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_getserver

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>