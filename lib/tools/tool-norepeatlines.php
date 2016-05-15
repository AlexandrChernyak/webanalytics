<?php
 /** Модуль управления инструментом `удаление дубликатов строк`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_norepeatlines extends w_toolitem_noajax_method {	
  protected
   $result;
   
  function _do_maped($s) {
   return ($this->CheckPostValue('tolower')) ? $this->strtolower(trim($s)) : trim($s);	
  }//_do_maped 
       
  function _DoActionThisTool() {	  	 
   if ($_POST['doactiontool'] != 'do') { return false; }
   $_POST['source'] = $this->ClearBreake($_POST['source'], true, false);   
   $list  = @explode("\n", $_POST['source']);
   $list1 = @array_unique(@array_map(array($this, '_do_maped'), $list));
   $_POST['source'] = @implode("\r\n", $list1);
   $this->result = array(
    //всего сток в оригинале
    'linesoriginal' => @count($list),
    //строк после обработки
    'linesresult'   => @count($list1)    
   );    
   //удалено строк
   $this->result['div'] = $this->result['linesoriginal'] - $this->result['linesresult'];
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_norepeatlines

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>