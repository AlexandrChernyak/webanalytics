<?php
 /** распределительный модуль административного раздела
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 if (!$CONTROL_OBJ->IsOnline() || !$CONTROL_OBJ->isadminstatus) { $CONTROL_OBJ->LocaleToHost('account/'); }
 //-------------------------------------------------------------------------------------
 $_GET['hrzd'] = $CONTROL_OBJ->CorrectSymplyString($_GET['hrzd']);
 /** инициализация стандартных объектов */
 function _init_and_add_section_info_unit_path($title) {
  global $section_info, $CONTROL_OBJ, $section_way;
  $section_info['stitle'] = $CONTROL_OBJ->GetText($title);
  $section_info['file']   = 'adm_account/adm_'.$_GET['hrzd'].'.tpl';
  $section_info['title']  = $section_info['stitle'].' - '.$section_info['title']; 
  $section_way[] = array(
   'name' => $section_info['stitle'],
   'path' => W_SITEPATH.'account/'.$_GET['hrzd'].'/'
  ); 
  return W_SITEDIR.'/data/info_adm_data/inc_'.$_GET['hrzd'].'.inc';  	
 }//_init_and_add_section_info_unit_path 
 //-------------------------------------------------------------------------------------
 switch ($_GET['hrzd']) {
  /* инвайт коды */
  case 'adminvitecodes': require_once _init_and_add_section_info_unit_path('adminvitesections'); break;
  /* апдейты поисковиков */
  case 'admengupdates': require_once _init_and_add_section_info_unit_path('admengineupdatest'); break;
  /* датацентры google */
  case 'admgooglecenters': require_once _init_and_add_section_info_unit_path('admgooglecentersl'); break;
  /* выбор других разделов секции */	
  default: 
   require_once W_LIBPATH.'/admin.control.lib.php';
   $clazz = 'w_admin_'.$_GET['hrzd'];
   if (!@class_exists($clazz)) { $CONTROL_OBJ->LocaleToHost('account/'); } else {
	$clazz_obj = new $clazz($CONTROL_OBJ, $_GET['hrzd']);
	$clazz_obj->ActionThisSection();	
   }	
 } 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>