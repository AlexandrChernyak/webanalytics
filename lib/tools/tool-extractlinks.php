<?php
 /** Модуль управления инструментом `извлечение ссылок`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 require_once dirname(__FILE__).'/tool-extractemails.php';

 class w_toolitem_extractlinks extends w_toolitem_extractemails {	
  const W_COUNT_OF_URL_ANALISYS = 10;
  const W_SLEEP_INTERVAL = 0.5;  
  const W_PAYTRANSACTIONNUMBER = 11; /* не изменять */ 	
  protected
   $result;

  protected function GetExtractType() { return 0; }
  	
 }//w_toolitem_extractlinks

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>