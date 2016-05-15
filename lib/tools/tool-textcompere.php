<?php
 /** Модуль управления инструментом `сравнение строк`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_textcompere extends w_toolitem_noajax_method {	
  protected
   $result;
       
  function _DoActionThisTool() {	  	 
   if ($_POST['doactiontool'] != 'do') { return false; }
   //корректировка длины
   if ($this->GetToolLimitInfoEx('maxcharscount')) {
    //next 1
    if ($this->strlen($_POST['source1']) > $this->GetToolLimitInfoEx('maxcharscount')) {
	 $_POST['source1'] = $this->substr($_POST['source1'], 0, $this->GetToolLimitInfoEx('maxcharscount'));	
	} 
	//next 2
    if ($this->strlen($_POST['source2']) > $this->GetToolLimitInfoEx('maxcharscount')) {
	 $_POST['source2'] = $this->substr($_POST['source2'], 0, $this->GetToolLimitInfoEx('maxcharscount'));	
	}	  
   } 
   //lib   
   require_once W_SITEDIR.'/ather_lib/compere.string.lib.php';
   $com = new StringMatch();
   $this->result = array(
    'result' => $com->Compere($_POST['source1'], $_POST['source2'])
   );   
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_textcompere

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>