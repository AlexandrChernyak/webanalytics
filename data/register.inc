<?php
 /** модуль регистрации пользователя
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 /* инициализация реферала */
 if ($CONTROL_OBJ->InitializeReferalCookies($_GET['p'])) { $CONTROL_OBJ->LocaleToHost('register/'); };
 //-------------------------------------------------------------------------------------
 $check_code = (($_POST['regaction'] == 'do') && isset($_SESSION["sendnumbq"])) ? $_SESSION["sendnumbq"] : ''; 
 $_SESSION["sendnumbq"] = $CONTROL_OBJ->generate_password(7);
 //регистрация
 $register_result = ($_POST['regaction'] == 'do') ? $CONTROL_OBJ->AddNewUser(
   $_POST['reglogin'], $_POST['regemail'], $_POST['regpass'], 
   $_POST['regurl'], $_POST['reginvite'], $_POST['regcode'], 0, $check_code
 ) : false;
 $CONTROL_OBJ->smarty->assign('register_result', $register_result); 
 //-------------------------------------------------------------------------------------
?>