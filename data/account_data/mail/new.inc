<?php
 /** почта пользователя (новое сообщение)
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 if (!$CONTROL_OBJ->IsOnline()) { $CONTROL_OBJ->LocaleToHost(); }
 //-------------------------------------------------------------------------------------
 if ($_POST['actionnewprvmail'] == 'act') {
  $res = $CONTROL_OBJ->DoSendNewPrivateMessage(array(
   'subj' => $_POST['userstitle'],
   'to'   => $_POST['userslist'],
   'body' => $_POST['userstext']
  ));
  if ($res && !@is_numeric($res)) { $CONTROL_OBJ->smarty->assign('errornewmessage', $res); } else {	
   @header('Location: '.W_SITEPATH.'account/mail/&send=1');
   exit;	
  }  	
 } 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */ 
?>