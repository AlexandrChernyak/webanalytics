<?php
 /** Модуль управления инструментом `сайт глазами поискового робота`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_robotslookurl extends w_toolitem_noajax_method {	
  protected
   $http,
   $result;
  
  function _DoActionThisTool() { 
   if ($_POST['doactiontool'] != 'do') { 
   	if (!isset($_GET['t2']) || !$_GET['t2']) { return false; }
	$_POST['url'] = ($_GET['plink']) ? $_GET['plink'] : $_GET['t2'];
	$_POST['doactiontool'] = 'do';    
   }
   $http = new ss_HTTP_obj();
   $this->http = $http;     
   if (!$http->RequestGET($_POST['url'])) {
    return $this->SetError(($http->res_error) ? $http->res_error : 'Error in parse url!');	
   }
   $_POST['url'] = $http->url_self_no_protocol;
   //заголовок
   $head = array(
    'data' => $http->res_header_source,
	'code' => $http->res_http_code,
	'link' => $http->url_self
   );
   //если есть перенаправления
   if ($http->res_redirect_list) {
	$list   = $http->res_redirect_list;
	$list[] = $head;
	$head   = $list;
   } else { $head = array($head); }
   //результат   
   $this->result = array(
    /* ответ сервера */
    'header'   => $head, 
    /* контент экранированный */
    'source'   => @str_replace("\n", "<br />", $this->ClearBreake($this->HTMLspecialChars($http->GetData()), true, false)),
    /* кодировка */
    'encoded'  => $http->GetEncodeName(),
    /* только текст со страницы */
    'textpage' => $http->GetSimplyTextFromPage(),
    /* ссылка */
    'link'     => $http->url_host //@urlencode($http->url_self)
   ); 
   //файл robots.txt
   if ($http->RequestGET($http->url_host.'/robots.txt')) {   	
	$this->result['robotstxt'] = $http->GetData();	
	/* проверить кодировку дополнительный вариант */
	if ($this->result['encoded'] && $this->result['encoded'] != 'UTF-8') {
	 $this->result['robotstxt'] = @iconv($this->result['encoded'], 'UTF-8', $this->result['robotstxt']);
	 if (!$this->result['robotstxt']) { $this->result['robotstxt'] = $http->GetData(); }	 	
	}	
   }   
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_robotslookurl

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>