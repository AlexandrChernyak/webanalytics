<?php
 /** Модуль проверки платежа посредством roboxchange.com
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */   
 require_once dirname(__FILE__).'/../lib/engine.php';
 //-------------------------------------------------------------------------------------
 class w_pay_process_act extends w_defext {
  protected 
   $control,
   $userinfo;	
  
  function __construct(w_Control_obj $control) {
   parent::__construct();
   $this->control = $control;    
   $this->userinfo = $this->GetUserInfoObj();     	
  }//__construct
  
  protected function DisplayResult($s, $list=false) { print $this->control->GetText($s, $list); exit; }	
  
  protected function CheckData() {
   global $_ROBOXCHANGEPAYLISTDATA;	   
   $res = (
    $_POST['OutSum'] && @is_numeric($_POST['OutSum']) && 
    $_POST['OutSum'] > 0 && $_POST['InvId'] && $_POST['SignatureValue'] &&
    $_POST['Shp_item'] && $_POST['SHP_ppt']
   );
   return (!$res) ? false : ($this->strtoupper($_POST['SignatureValue']) == $this->strtoupper(md5(
    $_POST['OutSum'].':'.$_POST['InvId'].':'.$_ROBOXCHANGEPAYLISTDATA['pass2'].':'.
    "Shp_item={$_POST['Shp_item']}:SHP_ppt={$_POST['SHP_ppt']}"    
   )));      	
  }//CheckData
  
  protected function GetUserInfoObj() {
   if (!$this->CheckData()) { $this->DisplayResult('errorpaycheckpar'); }	   
   if (!$_POST['Shp_item'] || !@is_numeric($_POST['Shp_item']) || $_POST['Shp_item'] < 0) {
    $this->DisplayResult('errorpaycheckpar');	
   }
   $_POST['Shp_item']--;
   $_POST['Shp_item'] = $this->CorrectSymplyString($_POST['Shp_item']);
   $_POST['SHP_ppt']  = md5($_POST['SHP_ppt']);
   $res = $this->control->db->GetLineArray($this->control->db->mPost(
    "select * from {$this->control->tables_list['users']} where iduser='{$_POST['Shp_item']}' and ".
    "md5(md5(CONCAT(username,':',iduser,':',userhash)))='{$_POST['SHP_ppt']}' limit 1"
   ));
   if (!$res || $res['iduser'] != $_POST['Shp_item']) { $this->DisplayResult('errorpaycheckpar'); }
   return $res;   	
  }//GetUserInfoObj
  
  function ProcessAction() {
   if (!$this->userinfo) { $this->DisplayResult('errorpaycheckpar'); }
   $str = $this->control->MoneyProcess(
    $this->userinfo, $this->control->GetText('paybalanceuser', array($this->userinfo['username'])),
    $_POST['InvId'], $_POST['OutSum']    
   );
   return (!$str) ? "OK{$_POST['InvId']}" : $str;	
  }//ProcessAction	
	
 }//w_pay_process_act
 //-------------------------------------------------------------------------------------
 $w_obj = new w_pay_process_act($CONTROL_OBJ);
 print $w_obj->ProcessAction();  
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>