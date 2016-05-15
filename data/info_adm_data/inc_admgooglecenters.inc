<?php
 /** модуль административного раздела [датацентры google]
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 if (!$CONTROL_OBJ->IsOnline() || !$CONTROL_OBJ->isadminstatus) { $CONTROL_OBJ->LocaleToHost('account/'); }  
 //-------------------------------------------------------------------------------------
 class w_googlecenters_act extends w_defext {
  protected 
   $control;
  
  function __construct(w_Control_obj $control) {
   if (!$control->isadminstatus) { exit('Can`t access to this file data!'); }	
   parent::__construct();
   $this->control = $control;	
  }
  
  protected function TransformPostItems($iter) {
   if (!W_GOOGLEDATACENTERSPERONEPAGE) { return false; } 
   for ($i=0; $i<=W_GOOGLEDATACENTERSPERONEPAGE; $i++) {
	if ($this->CheckPostValue('chid'.$i) && isset($_POST['idm'.$i]) && $_POST['idm'.$i]) {
	 @call_user_func($iter, $this->CorrectSymplyString($_POST['idm'.$i]));	 	
	}	
   }
   return true;      	
  }//TransformPostItems
  
  protected function ActionToDeleteItem($id) {
   return $this->control->db->mPost(
    "delete from {$this->control->tables_list['googlecen']} where iditem='$id' limit 1"   
   );   	
  }//ActionToDeleteItem
  
  protected function ActionToEnabledItem($id) {
   return $this->control->db->mPost(
    "update {$this->control->tables_list['googlecen']} SET enabledit='1' where enabledit<>'1' and iditem='$id' limit 1"   
   );	
  }//ActionToEnabledItem
  
  protected function ActionToDisabledItem($id) {
   return $this->control->db->mPost(
    "update {$this->control->tables_list['googlecen']} SET enabledit='0' where enabledit<>'0' and iditem='$id' limit 1"   
   );	
  }//ActionToEnabledItem
  
  protected function ActionDeleteAll() {
   return $this->control->db->mPost("delete from {$this->control->tables_list['googlecen']}");	
  }//ActionDeleteAll
  
  function ProcessAction($action) {	
   switch ($action) {
	case 'dall': return $this->ActionDeleteAll();
	case 'delete': return $this->TransformPostItems(array($this, 'ActionToDeleteItem'));
	case 'enabled': return $this->TransformPostItems(array($this, 'ActionToEnabledItem'));
	case 'disabled': return $this->TransformPostItems(array($this, 'ActionToDisabledItem'));
   }	   
   return false;
  }//ProcessAction 
  
  function GetCountAllDatas() {
   return array(
    'all' => $this->control->GetCountInTable('iditem', 'googlecen')
   );	
  }//GetCountAllDatas
  
  /** добавление датацентров 
  * @info - array(
  *  'enabled' => 0 or 1
  *  'list' => список центров, разделитель перенос строки
  * )
  */  
  function AddNewDataCentersList($info) {
   if (!$info || !$info['list']) { return $this->control->GetText('unknowinformdata'); }
   $info['enabled'] = ($info['enabled']) ? '1' : '0';
   $info['list'] = $this->ClearBreake($info['list'], true, false);
   $info['list'] = @explode("\n", $info['list'], W_MAXADDCOUNTOFGOOGLEDATACENTERS);
   if (!$info['list']) { return $this->control->GetText('unknowinformdata'); }
   $incer = 0;
   foreach ($info['list'] as &$item) {
	$item = $this->strtolower($this->CorrectSymplyString($item));
	if ($item) {
	 //проверка поторного добавления
	 $res = $this->control->db->GetLineArray($this->control->db->mPost(
	  "select iditem from {$this->control->tables_list['googlecen']} where data='$item' limit 1"
	 ));
	 if (!$res) {
	  if ($this->control->db->mPost(
	   "INSERT INTO {$this->control->tables_list['googlecen']} SET datecreat='".$this->GetThisDateTime()."', ".
	   "enabledit='{$info['enabled']}', data='$item'"
	  )) { $incer++; }	  	
	 }	 	
	}	
   }
   return $this->control->GetText('addeddatacenters', array($incer));   	
  }//AddNewDataCentersList  	
	
 }//w_invitecodes_act
 //-------------------------------------------------------------------------------------
 $act_obj = new w_googlecenters_act($CONTROL_OBJ);
 //добавление элемента
 if ($_GET['new']) {	
  $section_info['stitle'] = $CONTROL_OBJ->GetText('admgooglecentadd');
  $section_way[] = array(
   'name' => $section_info['stitle'],
   'path' => W_SITEPATH.'account/'.$_GET['hrzd'].'&new=1'
  );
  //action
  if ($_POST['googlecentersnew'] == 'do') {
   $CONTROL_OBJ->smarty->assign('err_str_inv', 	
	$act_obj->AddNewDataCentersList(array(
	 'enabled' => $CONTROL_OBJ->CheckPostValue('enabled'),
	 'list'    => $_POST['list']
	))  
   );   	
  }  
  $global_googlecenters_count_info = $act_obj->GetCountAllDatas();	
 } else {
  /* операции со список */
  if ($_POST['actionlistmakes'] && $_POST['actionlistmakes'] != 'none') {  	
   switch ($_POST['actionlistmakes']) {
	case 'delete': 
	case 'dall':
	case 'enabled':
	case 'disabled': break;
	default: $_POST['actionlistmakes'] = 'none'; break;	
   }   	
   $act_obj->ProcessAction($_POST['actionlistmakes']);	
  }
  /* вывести список всех датацентров */ 
  $global_googlecenters_count_info = $act_obj->GetCountAllDatas(); 
  //ok source 
  $query = "select * from {$_TABLES_NAMES_LIST['googlecen']} order by datecreat";     
  $CONTROL_OBJ->smarty->assign('global_data_list_info', 
   $CONTROL_OBJ->db->GetDataByPages(
    $query, $_GET['page'], W_GOOGLEDATACENTERSPERONEPAGE, $global_googlecenters_count_info['all'], 
	W_SITEPATH.'account/'.$_GET['hrzd'].'&page=', '', '', '' 
   )
  );  
 }
 //-------------------------------------------------------------------------------------
 $CONTROL_OBJ->smarty->assign('global_googlecenters_count_info', $global_googlecenters_count_info);
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>