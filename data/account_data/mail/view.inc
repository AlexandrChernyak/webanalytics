<?php
 /** почта пользователя (обслуживание потока)
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 if (!$CONTROL_OBJ->IsOnline()) { $CONTROL_OBJ->LocaleToHost(); }
 //-------------------------------------------------------------------------------------
 $query = "select * from {$_TABLES_NAMES_LIST['insmail']} where idmess='{$_GET['hrzd2']}' and ".
          "(touser='{$CONTROL_OBJ->userdata['username']}' or fromuser='{$CONTROL_OBJ->userdata['username']}') limit 1";
 $message_info = $CONTROL_OBJ->db->GetLineArray($CONTROL_OBJ->db->mPost($query));
 if ($message_info) {  
  if (!$message_info['readable'] && !$_GET['fromnew']) {
   $query = "UPDATE {$_TABLES_NAMES_LIST['insmail']} SET readable='1' where idmess='{$message_info['idmess']}'".
            " and touser='{$CONTROL_OBJ->userdata['username']}' limit 1";
   $CONTROL_OBJ->db->mPost($query);
   $message_info['readable'] = '1';   	
  }
  $section_info['stitle'] = $CONTROL_OBJ->GetText('threadmeilmess');
  $section_info['title']  = $section_info['stitle'].' - '.$section_info['title'];
  $section_info['stitle'] =
  $CONTROL_OBJ->GetText('threadmeilmess')." [{$message_info['fromuser']} -> {$message_info['touser']}]"; 
  $section_way[] = array(
   'name' => $CONTROL_OBJ->GetText(($_GET['send']) ? 'threadsoutput' : 'threadsinput'),
   'path' => W_SITEPATH.'account/mail/'.(($_GET['send']) ? '&send=1' : '')
  );  
  $section_way[] = array(
   'name' => $section_info['stitle'],
   'path' => W_SITEPATH.'account/mail/'.$message_info['idmess'].'/'
  );
  $section_info['stitle'] .= ', '.$message_info['subject'];  
  /* выполнение действия с сообщением */
  if ($_POST['actionnewprvmail'] == 'act') {
   $errornewmessage = $CONTROL_OBJ->DoSendNewPrivateMessage(array(
    'subj' => $message_info['subject'],
    'toid' => $message_info['idmess'],
    'body' => $_POST['userstext']
   ));
   if ($errornewmessage) { 
   	$CONTROL_OBJ->smarty->assign('errornewmessage', $errornewmessage); 
   } else {
	@header("Location: ".W_SITEPATH.'account/mail/'.$message_info['idmess'].'&fromnew=1');
	exit;
   }  	
  }  
  /* все сообщения */
  $RECORDS_COUNT = $CONTROL_OBJ->GetAnsversCountByMessage($message_info['idmess']);  
  $query = "select * from {$_TABLES_NAMES_LIST['insmail']} where idansw='{$message_info['idmess']}'".
           " and (touser='{$CONTROL_OBJ->userdata['username']}' or fromuser='{$CONTROL_OBJ->userdata['username']}')".
		   " order by dateadd DESC";
  $messages_list = $CONTROL_OBJ->db->GetDataByPages(
   $query, $_GET['page'], W_MAXMESSAGESPRIVATECOUNTPERPAGETHREAD, $RECORDS_COUNT,
   W_SITEPATH.'account/mail/'.$message_info['idmess'].'&page=', '', '', ''
  );
  if ($messages_list['source']) {
   foreach ($messages_list['source'] as &$val) {
	if ($val && $val['fromuser']) {	 
	 $val['userinfo'] = ($val['fromuser'] == $CONTROL_OBJ->userdata['username']) ? $CONTROL_OBJ->userdata : 
	 $CONTROL_OBJ->GetUserInfo($val['fromuser']);	 
	 $val['userinfo']['avatar'] = (!$val2 = $CONTROL_OBJ->ReadOption('AVATAR', $val['userinfo']['genoptions'])) ? 'avatar.png' :
     ((@file_exists(W_FILESPATH.'/images/'.$val2)) ? $val2 : 'avatar.png');	 	 
	}	
   }	
  }  
  $CONTROL_OBJ->smarty->assign('message_info', $message_info);
  $CONTROL_OBJ->smarty->assign('messages_list', $messages_list);  
 } 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */ 
?>