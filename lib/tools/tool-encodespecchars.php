<?php
 /** Модуль управления инструментом `экранирование \ деэкранирвоание спец символов`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_encodespecchars extends w_toolitem_noajax_method {	
  protected
   $http,
   $result;
      
  function _DoActionThisTool() {	  	 
   if ($_POST['doactiontool'] != 'do') { return false; }   
   $this->result = array(
    'encode' => $this->HTMLspecialChars($this->HTMLspecialChars($_POST['source'])),
    'decode' => $this->HTMLspecialChars($this->HTMLspecialCharsDecode($_POST['source']))    
   );  
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_encodespecchars

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>