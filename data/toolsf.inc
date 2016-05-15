<?php
 /** модуль списка и инициализации инструментов
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 /* проверка инициализации иструмента */
 $Do404 = false;
 
 if ($_GET['t1']) {
  $Do404 = true;
    
  require_once W_LIBPATH.'/tools.control.lib.php';	
  $_GET['t1'] = $CONTROL_OBJ->strtolower($CONTROL_OBJ->CorrectSymplyString($_GET['t1']));
  $string_nam = $_GET['t1'];  
  //get an file 
  $file_tool = W_LIBPATH.'/tools/tool-'.$_GET['t1'].'.php';
  if (@file_exists($file_tool)) {
   require_once $file_tool; 
   $_GET['t1'] = (!@class_exists('w_toolitem_'.$_GET['t1'])) ? false : 'w_toolitem_'.$_GET['t1'];     
  } else {
    $_GET['t1'] = false;
  }  
 }
 //ok check next
 if ($_GET['t1']) {
  $tool_obj = new $_GET['t1']($CONTROL_OBJ, $string_nam);
  $tool_obj->ActionThisTool();	
 } elseif ($Do404) {
    
   $section_info['stitle'] = $CONTROL_OBJ->GetText('errorgetdocument404');	 
   $section_info['title']  = $section_info['stitle'];
   $section_info['file']   = 'errordocumentcode.tpl';
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH//$_SERVER['REQUEST_URI']
   );  
   @header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");    
 }  
 //-------------------------------------------------------------------------------------
?>