<?php
 /** Модуль управления инструментом `упаковка css`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_csspack extends w_toolitem_noajax_method {	
  protected
   $result;
      
  function _DoActionThisTool() {	  	 
   if ($_POST['doactiontool'] != 'do') { return false; }   
   require_once W_SITEDIR.'/ather_lib/css_compressor/css-compression.php';
   $this->result = array(
    'css' => @iconv('windows-1251', 'UTF-8', $CSSC->compress(@iconv('UTF-8', 'windows-1251', $_POST['source'])))
   );
   $this->result['before'] = $CSSC->stats['before'];
   $this->result['after']  = $CSSC->stats['after'];
   $this->result['after']['compress'] = ($this->result['before']['size'] - $this->result['after']['size']);
   $this->result['before']['size'] = $CSSC->displaySizes($this->result['before']['size']);
   $this->result['after']['size'] = $CSSC->displaySizes($this->result['after']['size']);
   $this->result['after']['timeexec'] = @round($this->result['after']['time'] - $this->result['before']['time'], 2);  
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_csspack

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>