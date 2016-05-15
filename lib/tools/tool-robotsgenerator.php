<?php
 /** Модуль управления инструментом `генератор файлов robots.txt`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_robotsgenerator extends w_toolitem_noajax_method {	
  protected
   $result,
   $rules_list;
   
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $rules_list = null;	
  }//__construct
       
  function _DoActionThisTool() {	  	 
   if ($_POST['doactiontool'] != 'do') { return false; }   
   $this->result = array();      
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_robotsgenerator

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>