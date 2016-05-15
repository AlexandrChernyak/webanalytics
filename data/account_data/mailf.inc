<?php
 /** почта пользователя
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 //количество сообщений отправлено
 $global_user_info['privatesend'] = $CONTROL_OBJ->GetMySendMessagesCount();
 //путь 
 switch ($_GET['hrzd2']) {
  /* new message */
  case 'new':
   $section_info['stitle'] = $CONTROL_OBJ->GetText('newmaildoit');
   $section_info['file']   = 'account/new_mail.tpl';
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title']; 
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH.'account/mail/new/'
   );
   $section_info['stitle'] = $CONTROL_OBJ->GetText('newprivatemessage');  
   require_once W_SITEDIR.'/data/account_data/mail/new.inc'; 
  break;
  /* read exists, get list */
  default:
   //read
   if (@is_numeric($_GET['hrzd2'])) {
	$_GET['hrzd2'] = $CONTROL_OBJ->CorrectSymplyString($_GET['hrzd2']);
	$section_info['file']   = 'account/readthreadl.tpl';	
	require_once W_SITEDIR.'/data/account_data/mail/view.inc';	
	break;
   } 
   //list messages   
   $section_info['stitle'] = $CONTROL_OBJ->GetText('privatemessages');
   require_once W_SITEDIR.'/data/account_data/mail/index.inc';
  break;	
 }
 //------------------------------------------------------------------------------------- 
?>