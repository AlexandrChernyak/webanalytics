<?php
 /** модуль восстановления пароля пользователя
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //------------------------------------------------------------------------------------- 
 if ($_POST['restaction'] != 'do' && $_GET['nepsw'] && $_GET['p']) { 
  $_POST['restaction'] = 'do';
  $_POST['restmail'] = $_GET['nepsw'];
  $_POST['restpass'] = $_GET['p'];   
 } elseif ($_POST['restaction'] == 'do') {
  $_GET['nepsw'] = false;
  $_GET['p'] = false; 
 } 
 //ok check text 
 $check_code = (($_POST['restaction'] == 'do') && isset($_SESSION["sendnumbe"])) ? $_SESSION["sendnumbe"] : ''; 
 $_SESSION["sendnumbe"] = $CONTROL_OBJ->generate_password(7);
 //восстановление
 $restore_result = ($_POST['restaction'] == 'do') ? $CONTROL_OBJ->RestoreUserPassword(
   $_POST['restmail'], $_POST['restpass'], 
   ((($_POST['restaction'] == 'do' && $_GET['nepsw'] && $_GET['p'])) ? $check_code: $_POST['restcode']),
    $check_code, $_GET['nepsw'] && $_GET['p']
 ) : false;
 $CONTROL_OBJ->smarty->assign('restore_result', $restore_result); 
 //------------------------------------------------------------------------------------- 
?>