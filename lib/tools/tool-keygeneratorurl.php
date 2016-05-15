<?php
 /** Модуль управления инструментом `генератор ключевых слов с сайта`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_keygeneratorurl extends w_toolitem_noajax_method {	
  protected
   $http,
   $result;
  
  protected function IsURLGenerator() { return true; }
    
  function _DoActionThisTool() {	  	 
   if ($_POST['doactiontool'] != 'do') { 
   	if (!isset($_GET['t2']) || !$_GET['t2']) { return false; }
	$_POST['url'] = ($_GET['plink']) ? $_GET['plink'] : $_GET['t2'];
	$_POST['doactiontool'] = 'do';
	$_POST['minlenght'] = 3;
	$_POST['ignorestopwords'] = 1;
	$_POST['getfrombody'] = 1;
	$_POST['separator'] = ', ';
	$_POST['usecount'] = 10;	    
   }
   $this->InitJsFiles();
   $http = new ss_HTTP_obj();
   $this->http = $http;  
   if (!$_POST['url'] && !$this->IsURLGenerator()) { $_POST['url'] = W_HOSTMYSITE; }   
   if (!$http->SetURL($_POST['url'])) { return $this->SetError('Error in parse url!'); }
   //на запрос только хост
   $http->SetURL($http->url_host);
   $_POST['url'] = $http->url_host;
   //параметры выполнение
   $error  = '';
   //параметры
   $params = array(
    //игнорировать стоп-слова
    'ignorestopwords' => $this->CheckPostValue('ignorestopwords'),
    //обрабатывать текст только из тэга <body>
    'getfrombody' => $this->CheckPostValue('getfrombody'),
    //разделитель ключевых слов
    'separator' => $this->CorrectSymplyString($_POST['separator']),
	//всего работать с кол-вом слов
	'allcount' => ($this->GetToolLimitInfoEx('allwordsforuse') === false) ? 1000 : $this->GetToolLimitInfoEx('allwordsforuse')
   );
   //текст для анализа
   if (!$this->IsURLGenerator()) {
    $params['source'] = $_POST['source'];	
   } else {
   	//запросить текст с страницы
	$params['dorequsturl'] = 1;
   }
   //количество слов, которое нужно получить
   if ($_POST['usecount'] && @is_numeric($_POST['usecount']) && $_POST['usecount'] > 0) {
	$params['usecount'] = $_POST['usecount']; 
   } else { $_POST['usecount'] = 10; }
   //минимальная длина слова
   if ($_POST['minlenght'] && @is_numeric($_POST['minlenght']) && $_POST['minlenght'] > 0) {
	$params['minlenght'] = $_POST['minlenght']; 
   } else { $_POST['minlenght'] = 3; }
   //выполнение
   if (!$http->RunPluginEx(SS_KEYWORDSGENERATOR, $error, $this->result, $params)) {
	return $this->SetError((!$error) ? $this->GetText('erroractiontool', array('Keywords Generator')) : $error);
   }   
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_keygeneratorurl

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>