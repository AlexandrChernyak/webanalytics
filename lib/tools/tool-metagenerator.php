<?php
 /** Модуль управления инструментом `генератор мета тэгов`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_metagenerator extends w_toolitem_noajax_method {	
  protected
   $result;
       
  function _DoActionThisTool() {	  	 
   if ($_POST['doactiontool'] != 'do') { return false; }   
   $this->result = array();    
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_titlegenerator

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>