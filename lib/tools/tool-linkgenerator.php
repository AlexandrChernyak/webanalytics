<?php
 /** Модуль управления инструментом `генератор ссылок`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 require_once dirname(__FILE__).'/tool-titlegenerator.php';

 class w_toolitem_linkgenerator extends w_toolitem_titlegenerator {	
  protected
   $result;
  
  protected function GetURL() { return $_POST['url']; }
  protected function GetTarget() { return ($_POST['target']) ? ' target="'.$_POST['target'].'"' : ''; }
  protected function IsTitle() { return false; }   
  
 }//w_toolitem_linkgenerator

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>