<?php
 /** модуль активации пользователя
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 if ($_POST['activeact'] != 'do' && $_GET['fromurl']) { 
  $_POST['activeact'] = 'do';
  $_POST['scode'] = $_GET['fromurl']; 
 } elseif ($_POST['activeact'] == 'do') {
  $_GET['fromurl'] = false; 
 }
 //подготовка текста 
 $check_code = (($_POST['activeact'] == 'do') && isset($_SESSION["sendnumbw"])) ? $_SESSION["sendnumbw"] : ''; 
 $_SESSION["sendnumbw"] = $CONTROL_OBJ->generate_password(7);
 //активация
 $activate_result = ($_POST['activeact'] == 'do') ? $CONTROL_OBJ->ActivateUser(
   $_POST['scode'],((($_POST['activeact'] == 'do' && $_GET['fromurl'])) ? $check_code: $_POST['actcode']), $check_code
 ) : false;
 $CONTROL_OBJ->smarty->assign('activate_result', $activate_result); 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>