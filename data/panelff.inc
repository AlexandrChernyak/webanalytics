<?php
 /** модуль подготовки панели оптимизатора
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 /* скрыть правую часть сайта, имитация выполнения инструмента */
 $_POST['doactiontool'] = 'do';
 /* объект управление, инициализация */
 require_once W_LIBPATH.'/panel.control.lib.php';
 $PANEL_CONTROL = new w_panelcontrolobjid($CONTROL_OBJ);
 $PANEL_CONTROL->ActionElements(); 
 //-------------------------------------------------------------------------------------
?>