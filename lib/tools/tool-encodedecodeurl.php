<?php
 /** Модуль управления инструментом `encode \ decode url`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_encodedecodeurl extends w_toolitem_noajax_method {	
  protected
   $result;
      
  function _DoActionThisTool() {	  	 
   if ($_POST['doactiontool'] != 'do') { return false; }   
   $this->result = array(
    'encode'    => @urlencode($_POST['source']),
    'decode'    => @urldecode($_POST['source']),
	'rawencode' => @rawurlencode($_POST['source']),
	'rawdecode' => @rawurldecode($_POST['source']),    
   );  
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_encodespecchars

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>