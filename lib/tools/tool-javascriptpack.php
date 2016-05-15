<?php
 /** Модуль управления инструментом `упаковка javascript`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_javascriptpack extends w_toolitem_noajax_method {	
  protected
   $result;
      
  function _DoActionThisTool() {	  	 
   if ($_POST['doactiontool'] != 'do') { return false; }   
   $this->result = array();
   require_once W_SITEDIR.'/ather_lib/class.JavaScriptPacker.php';
   $script = (@get_magic_quotes_gpc()) ? @stripslashes(trim($_POST['source'])) : trim($_POST['source']);
   $encoding = (int)$_POST['ascii_encoding'];
   $fast_decode = $this->CheckPostValue('fast_decode');  
   $special_char = $this->CheckPostValue('special_char');
   $t1 = @microtime(true);
   $packer = new JavaScriptPacker(@iconv('UTF-8', 'windows-1251', $script), $encoding, $fast_decode, $special_char);
   $this->result['packed'] = @iconv('windows-1251', 'UTF-8', $packer->pack());
   $t2 = @microtime(true); 
   //результат
   $this->result['originalLength'] = @$this->strlen($script);
   $this->result['packedLength'] = @$this->strlen($this->result['packed']);
   $this->result['ratio'] = @number_format($this->result['packedLength'] / $this->result['originalLength'], 3);
   $this->result['time'] = @sprintf('%.4f', ($t2 - $t1) );     
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_javascriptpack

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>