<?php
 /** модуль административного раздела [инвайт коды]
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 if (!$CONTROL_OBJ->IsOnline() || !$CONTROL_OBJ->isadminstatus) { $CONTROL_OBJ->LocaleToHost('account/'); } 
 //-------------------------------------------------------------------------------------
 class w_invitecodes_act extends w_defext {
  protected 
   $control,
   $listtosave,
   $invitetype;
  
  function __construct(w_Control_obj $control) {
   if (!$control->isadminstatus) { exit('Can`t access to this file data!'); }	
   parent::__construct();
   $this->control = $control;
   $this->listtosave = '';
   $this->invitetype = ($_GET['selinvtt'] != '' && @is_numeric($_GET['selinvtt'])) ? $_GET['selinvtt'] : ''; 	
  }
  
  function GetInvType() { return $this->invitetype; }
  
  function GetIncTypeWhere($and=' and ') {
    return ($this->GetInvType() != '') ? ($and.'invtype="'.$this->GetInvType().'"') : ''; 
  }
  
  protected function TransformPostItems($iter) {
   if (!W_ADMINVITECODESPERPAGE) { return false; } 
   for ($i=0; $i<=W_ADMINVITECODESPERPAGE; $i++) {
	if ($this->CheckPostValue('chid'.$i) && isset($_POST['idm'.$i]) && $_POST['idm'.$i]) {
	 @call_user_func($iter, $this->CorrectSymplyString($_POST['idm'.$i]));	 	
	}	
   }
   return true;      	
  }//TransformPostItems
  
  protected function ActionToDeleteItem($id) {
   return $this->control->db->mPost(
    "delete from {$this->control->tables_list['invites']} where iditem='$id'".
    $this->GetIncTypeWhere()." limit 1"   
   );   	
  }//ActionToDeleteItem
  
  protected function ActionToGetItem($id) {
   $res = $this->control->db->GetLineArray($this->control->db->mPost(
    "select invcode from {$this->control->tables_list['invites']} where iditem='$id' limit 1"   
   ));
   return ($res) ? ($this->listtosave .= $res['invcode']."\r\n") : false;   	
  }//ActionToGetItem
  
  protected function ActionToSaveItems() {
   $res = $this->control->db->mPost(
    "select invcode from {$this->control->tables_list['invites']}".$this->GetIncTypeWhere(' where ')   
   );
   if (!$res) { $this->listtosave = ''; return $this->listtosave; }
   while ($row = $this->control->db->GetLineArray($res)) {
	$this->listtosave .= $row['invcode']."\r\n";	
   }
   return $this->listtosave;	
  }//ActionToSaveItems
  
  protected function ActionDeleteAll() {
   return $this->control->db->mPost("delete from {$this->control->tables_list['invites']}".
    $this->GetIncTypeWhere(' where '));	
  }//ActionDeleteAll
  
  function ProcessAction($action) {	
   switch ($action) {
	case 'all': 
	case 'save': 
	 if ($action == 'all') { $this->ActionToSaveItems(); } else { $this->TransformPostItems(array($this, 'ActionToGetItem')); }
	 Header("Pragma: no-cache"); 
     Header("Cache-control: no-cache, must-revalidate"); 
     Header("Expires: Mon, 01 Jan 1990 01:01:01 GMT"); 
     Header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");
 	 header('Content-Type: application/octetstream');
 	 header("Accept-Ranges: bytes");
 	 header("Content-Length: ".$this->strlen($this->listtosave)); 
 	 header('Content-Disposition: attachment; filename="invite_code_list.txt";');
 	 print $this->listtosave;
	 exit;	
	break;
	case 'dall': return $this->ActionDeleteAll();
	case 'delete': return $this->TransformPostItems(array($this, 'ActionToDeleteItem'));
   }	   
   return false;
  }//ProcessAction   	
	
 }//w_invitecodes_act
 //-------------------------------------------------------------------------------------
 //добавление элемента
 $act_obj = new w_invitecodes_act($CONTROL_OBJ);
 
 if ($_GET['new']) {	
  $section_info['stitle'] = $CONTROL_OBJ->GetText('admaddnewinvite');
  $section_way[] = array(
   'name' => $section_info['stitle'],
   'path' => W_SITEPATH.'account/'.$_GET['hrzd'].'&new=1'
  );
  //action
  if ($_POST['inviteactionnew'] == 'do') {
   $CONTROL_OBJ->smarty->assign('err_str_inv', 
    $CONTROL_OBJ->AddNewInviteCodes(array(
	 'count' => $_POST['invcount'],
	 'price' => $_POST['invprice'],
     'type'  => $_GET['selinvtt'],
	 'index' => ($CONTROL_OBJ->CheckPostValue('invindexsite')) ? 1 : 0
	))   
   );   	
  }  
  $global_invite_code_count = $CONTROL_OBJ->GetCountInTable('iditem', 'invites',
   $act_obj->GetIncTypeWhere(' where '));
   	
 } else {
  /* операции со список */
  if ($_POST['actionlistinvitecode'] && $_POST['actionlistinvitecode'] != 'none') {  	
   switch ($_POST['actionlistinvitecode']) {
	case 'delete':
	case 'save': 
	case 'all':
	case 'dall': break;
	default: $_POST['actionlistinvitecode'] = 'none'; break;	
   }   	
   $act_obj->ProcessAction($_POST['actionlistinvitecode']);	
  }
  
  /* вывести список всех кодов */ 
  $global_invite_code_count = $CONTROL_OBJ->GetCountInTable('iditem', 'invites', 
   $act_obj->GetIncTypeWhere(' where '));
  
  //get all codes  
  $query = "select * from {$_TABLES_NAMES_LIST['invites']}".$act_obj->GetIncTypeWhere(' where ').
  " order by dateadd DESC";
       
  $CONTROL_OBJ->smarty->assign('global_invite_list_info', 
   $CONTROL_OBJ->db->GetDataByPages(
    $query, $_GET['page'], W_ADMINVITECODESPERPAGE, 
    $global_invite_code_count, W_SITEPATH.'account/'.$_GET['hrzd'].'&page=', 
    (($act_obj->GetInvType() != '') ? ('&selinvtt='.$act_obj->GetInvType()) : ''), '', '' 
   )
  );  
 }
 
 
 //-------------------------------------------------------------------------------------
 $CONTROL_OBJ->smarty->assign('global_invite_code_count', $global_invite_code_count);
 $CONTROL_OBJ->smarty->assign('act_obj_invite', $act_obj);
 //-------------------------------------------------------------------------------------
?>