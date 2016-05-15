<?php
 /** модуль страницы апдейтов поисковиков
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 $global_data_list_info = array(
  '1' => array(),
  '2' => array(),
  '3' => array(),
  '4' => array() 
 );
 //список всех данных по всем апдейтам
 $array_max_items = array();
 foreach ($global_data_list_info as $name => &$value) {
  $value['count'] = $CONTROL_OBJ->GetCountInTable('iditem', 'updates', "where engtype='$name'");
  $array_max_items[] = $value['count'];
  $value['data']  = $CONTROL_OBJ->db->GetDataByPages(
   "select * from {$_TABLES_NAMES_LIST['updates']} where engtype='$name' order by dateupd DESC", 
   $_GET['page'], W_PUBLICENGINEUPDATESPERPAGE, $value['count'], W_SITEPATH.'updates/&page=', '', '', '' 
  );		
 }
 //корректировка недостающих элементов
 $array_max_items   = max($array_max_items);
 $pages_text_global = '';
 foreach ($global_data_list_info as $name => &$value) {
  if ($value['count'] < W_PUBLICENGINEUPDATESPERPAGE) {
   for ($i=$value['count']; $i<W_PUBLICENGINEUPDATESPERPAGE; $i++) {
    $value['data']['source'][] = array();
   }   	
  } elseif ($value['count'] == $array_max_items && !$pages_text_global) {
   $pages_text_global = $value['data']['pagestext'];	
  }	
 }
 //формирование пакета данных для вывода
 $global_data_list_info = array(
  'maxcount' => $array_max_items,
  'data'     => $global_data_list_info,
  'pages'    => $pages_text_global
 ); 
 //-------------------------------------------------------------------------------------
 $CONTROL_OBJ->smarty->assign('global_data_list_info', $global_data_list_info); 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>