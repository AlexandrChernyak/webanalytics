<?php
 /** модуль административного раздела [апдейты поисковиков]
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 if (!$CONTROL_OBJ->IsOnline() || !$CONTROL_OBJ->isadminstatus) { $CONTROL_OBJ->LocaleToHost('account/'); }  
 //-------------------------------------------------------------------------------------
 class w_engineupdates_act extends w_defext {
  protected 
   $control,
   $listtosave;
  
  function __construct(w_Control_obj $control) {
   if (!$control->isadminstatus) { exit('Can`t access to this file data!'); }	
   parent::__construct();
   $this->control = $control;
   $this->listtosave = '';	
  }
  
  protected function TransformPostItems($iter) {
   if (!W_ADMENGINEUPDATESPERPAGE) { return false; } 
   for ($i=0; $i<=W_ADMENGINEUPDATESPERPAGE; $i++) {
	if ($this->CheckPostValue('chid'.$i) && isset($_POST['idm'.$i]) && $_POST['idm'.$i]) {
	 @call_user_func($iter, $this->CorrectSymplyString($_POST['idm'.$i]));	 	
	}	
   }
   return true;      	
  }//TransformPostItems
  
  protected function ActionToDeleteItem($id) {
   return $this->control->db->mPost(
    "delete from {$this->control->tables_list['updates']} where iditem='$id' limit 1"   
   );   	
  }//ActionToDeleteItem
  
  protected function ActionDeleteAll() {
   return $this->control->db->mPost("delete from {$this->control->tables_list['updates']}");	
  }//ActionDeleteAll
  
  function ProcessAction($action) {	
   switch ($action) {
	case 'dall': return $this->ActionDeleteAll();
	case 'delete': return $this->TransformPostItems(array($this, 'ActionToDeleteItem'));
   }	   
   return false;
  }//ProcessAction 
  
  function GetCountAllDatas() {
   return array(
    '0' => $this->control->GetCountInTable('iditem', 'updates', "where engtype <> '0'"),
    '1' => $this->control->GetCountInTable('iditem', 'updates', "where engtype = '1'"),
    '2' => $this->control->GetCountInTable('iditem', 'updates', "where engtype = '2'"),
    '3' => $this->control->GetCountInTable('iditem', 'updates', "where engtype = '3'"),
    '4' => $this->control->GetCountInTable('iditem', 'updates', "where engtype = '4'")
   );	
  }//GetCountAllDatas  	
	
 }//w_invitecodes_act
 //-------------------------------------------------------------------------------------
 $act_obj = new w_engineupdates_act($CONTROL_OBJ);
 //добавление элемента
 if ($_GET['new']) {	
  $section_info['stitle'] = $CONTROL_OBJ->GetText('addnewengineupdate');
  $section_way[] = array(
   'name' => $section_info['stitle'],
   'path' => W_SITEPATH.'account/'.$_GET['hrzd'].'&new=1'
  );
  //action
  if ($_POST['updatesactionnew'] == 'do') {
   $CONTROL_OBJ->smarty->assign('err_str_inv', 
    $CONTROL_OBJ->AddNewEngineUpdate(array(
	 'to'   => $_POST['updtype'],
	 'date' => $_POST['upddate']
	))   
   );   	
  }  
  $global_updates_count_info = $act_obj->GetCountAllDatas();	
 } else {
  /* операции со список */
  if ($_POST['actionlistmakes'] && $_POST['actionlistmakes'] != 'none') {  	
   switch ($_POST['actionlistmakes']) {
	case 'delete': 
	case 'dall': break;
	default: $_POST['actionlistmakes'] = 'none'; break;	
   }   	
   $act_obj->ProcessAction($_POST['actionlistmakes']);	
  }
  /* вывести список всех апдейтов */ 
  //check sort
  if (!$_GET['etype'] || !@is_integer($_GET['etype'] + 0) || $_GET['etype'] > 4 || $_GET['etype'] < 0) { $_GET['etype'] = 0; }
  //get all codes  
  $_GET['etype'] = $CONTROL_OBJ->CorrectSymplyString($_GET['etype']);
  $global_updates_count_info = $act_obj->GetCountAllDatas(); 
  //ok source 
  $query = "select * from {$_TABLES_NAMES_LIST['updates']} where ".
  (($_GET['etype'] == '0') ? "engtype <> '0'" : "engtype = '{$_GET['etype']}'")  
  ." order by dateupd DESC";     
  $CONTROL_OBJ->smarty->assign('global_data_list_info', 
   $CONTROL_OBJ->db->GetDataByPages(
    $query, $_GET['page'], W_ADMENGINEUPDATESPERPAGE, $global_updates_count_info[$_GET['etype']], 
	W_SITEPATH.'account/'.$_GET['hrzd'].'&page=', (!$_GET['etype']) ? '' : "&etype={$_GET['etype']}" , '', '' 
   )
  );  
 }
 //-------------------------------------------------------------------------------------
 $CONTROL_OBJ->smarty->assign('global_updates_count_info', $global_updates_count_info);
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>