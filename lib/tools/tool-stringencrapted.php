<?php
 /** Модуль управления инструментом `шифрование строк`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_stringencrapted extends w_toolitem_noajax_method {	
  protected
   $result;
      
  function _DoActionThisTool() {	  	 
   if ($_POST['doactiontool'] != 'do') { return false; }   
   $this->result = array();
   $list_hashed = @hash_algos();
   foreach ($list_hashed as $item) {
   	$hash = @hash($item, $_POST['source']);
	$this->result[] = array(
	 'name' => $item,
	 'data' => $hash,
	 'size' => $this->strlen($hash)	
	);	
   }     
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_stringencrapted

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>