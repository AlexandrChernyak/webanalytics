<?php
 /** почта пользователя (список)
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 if (!$CONTROL_OBJ->IsOnline()) { $CONTROL_OBJ->LocaleToHost(); }
 //-------------------------------------------------------------------------------------
 class w_messages_list extends w_defext {
  protected 
   $control;
  
  function __construct(w_Control_obj $control) {
   parent::__construct();
   $this->control = $control;	
  }
  
  protected function TransformPostItems($iter) {
   if (!W_MAXMESSAGESPRIVATECOUNTPERPAGE) { return false; } 
   for ($i=0; $i<=W_MAXMESSAGESPRIVATECOUNTPERPAGE; $i++) {
	if ($this->CheckPostValue('chid'.$i) && isset($_POST['idm'.$i]) && $_POST['idm'.$i]) {
	 @call_user_func($iter, $this->CorrectSymplyString($_POST['idm'.$i]));	 	
	}	
   }
   return true;      	
  }//TransformPostItems
  
  protected function ActionToDeleteItem($id) {
   if ($this->control->db->mPost(
    "delete from {$this->control->tables_list['insmail']} where ".
    "idmess='$id' and touser='{$this->control->userdata['username']}' limit 1"   
   )) {
	return $this->control->db->mPost(
     "delete from {$this->control->tables_list['insmail']} where idansw='$id'"   
    );
   }
   return false;   	
  }//ActionToDeleteItem
  
  protected function ActionToReadItem($id) {
   return $this->control->db->mPost(
    "UPDATE {$this->control->tables_list['insmail']} SET readable='1' ".
    "where idmess='$id' and readable='0' and touser='{$this->control->userdata['username']}' limit 1"   
   );   	
  }//ActionToReadItem
  
  function ProcessAction($action) {
   global $global_user_info;	
   $func = array($this);
   switch ($action) {
	case 'delete': $func[] = 'ActionToDeleteItem'; break;
	case 'read'  : $func[] = 'ActionToReadItem'; break;
	default: return false;
   }
   $res = $this->TransformPostItems($func);
   //количество непрочитанных сообщений
   $global_user_info['privatenew'] = $this->control->GetUnreadMessagesCount();
   //количество сообщений всего
   $global_user_info['privateall'] = $this->control->GetMyMessagesCount();
   //количество сообщений отправлено
   $global_user_info['privatesend'] = $this->control->GetMySendMessagesCount();
   return $res;      	
  }//ProcessAction
  	
 }//w_messages_list
 //-------------------------------------------------------------------------------------
 $w_message = new w_messages_list($CONTROL_OBJ);
 //------------------------------------------------------------------------------------- 
 /* операции с почтой */
 switch ($_POST['actionmailslist']) {	
  case 'delete': case 'read': $w_message->ProcessAction($_POST['actionmailslist']); break;	
 }//switch 
 //-------------------------------------------------------------------------------------
 //вывод элементов почтового ящика
 $query = "select * from {$_TABLES_NAMES_LIST['insmail']} where idansw='0' and ".
 (($_GET['send']) ? "fromuser='{$CONTROL_OBJ->userdata['username']}'" : "touser='{$CONTROL_OBJ->userdata['username']}'").
 " order by dateadd DESC"; 
 $RECORDS_COUNT = ($_GET['send']) ? $global_user_info['privatesend'] : $global_user_info['privateall']; 
 $mail_block_data = $CONTROL_OBJ->db->GetDataByPages(
  $query, $_GET['page'], W_MAXMESSAGESPRIVATECOUNTPERPAGE, $RECORDS_COUNT, W_SITEPATH.'account/mail/&page=', 
  (($_GET['send']) ? '&send=1' : ''), '', '' 
 ); 
 $CONTROL_OBJ->smarty->assign('global_user_mail_info', $mail_block_data); 
 //------------------------------------------------------------------------------------- 
?>