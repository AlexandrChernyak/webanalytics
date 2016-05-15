<?php
 /** Модуль управления инструментом `генератор ключевых слов с текста`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 require_once dirname(__FILE__).'/tool-keygeneratorurl.php';
 
 class w_toolitem_keygeneratortext extends w_toolitem_keygeneratorurl {	
  protected
   $http,
   $result;
  
  protected function IsURLGenerator() { return false; }
  	
 }//w_toolitem_keygeneratorurl

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>