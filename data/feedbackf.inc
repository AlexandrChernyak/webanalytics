<?php
 /** модуль обратной связи
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 $check_code = (($_POST['actfeedback'] == 'do') && isset($_SESSION["sendnumby"])) ? $_SESSION["sendnumby"] : ''; 
 $_SESSION["sendnumby"] = $CONTROL_OBJ->generate_password(7);
 //отправка сообщения
 $feedback_result = ($_POST['actfeedback'] == 'do') ? $CONTROL_OBJ->SendMessageFromFeedBack(array(
  'from'      => $_POST['ymail'], 
  'name'      => $_POST['yname'], 
  'title'     => $_POST['ytitle'],
  'data'      => $_POST['ymessage'], 
  'chcode'    => $_POST['yegcode'], 
  'chcodeval' => $check_code, 
 )) : false;  
 $CONTROL_OBJ->smarty->assign('feedback_result', $feedback_result);
 //-------------------------------------------------------------------------------------
?>