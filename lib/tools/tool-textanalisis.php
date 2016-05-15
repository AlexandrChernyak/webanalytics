<?php
 /** Модуль управления инструментом `анализ текста`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_textanalisis extends w_toolitem_noajax_method {	
  protected
   $http,
   $result;
  
  /** раскрытие стандартного массива */
  function GetWordListByArray($list, $separator=", ") {
   if (!$list || !@is_array($list)) { return ''; }
   return @implode($separator, @array_unique(@array_map(array($this, 'strtolower'), $list)));   	
  }//GetWordListByArray
    
  function _DoActionThisTool() {	  	 
   if ($_POST['doactiontool'] != 'do') { 
   	if (!isset($_GET['t2']) || !$_GET['t2']) { return false; }
	$_POST['url'] = ($_GET['plink']) ? $_GET['plink'] : $_GET['t2'];
	$_POST['doactiontool'] = 'do';	    
   }
   $this->InitJsFiles();
   $http = new ss_HTTP_obj();
   $this->http = $http;  
   //параметры выполнение
   $error  = '';
   //параметры
   $params = array(
    'ignorestopwords' => 1,
    'source' => $_POST['source']
   );
   //выполнение
   if (!$http->RunPluginEx(SS_TEXTANALISISACTION, $error, $this->result, $params)) {
	return $this->SetError((!$error) ? $this->GetText('erroractiontool', array('Text analisis')) : $error);
   }   
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_textanalisis

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>