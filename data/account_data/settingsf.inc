<?php
 /** настройки пользователя
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 if (!$CONTROL_OBJ->IsOnline()) { $CONTROL_OBJ->LocaleToHost(); }
 //-------------------------------------------------------------------------------------
 $account_options_result = array();
 /* аватар */
 switch ($_POST['avtaction']) {
  case 'load':
   $account_options_result['avatar'] = $CONTROL_OBJ->SetUserAvatar('avedit');
   $account_options_result['avatar'] = ($account_options_result['avatar'] === false) ? 
   $CONTROL_OBJ->GetText('errorsetnewavatar') : 
   ((@is_string($account_options_result['avatar'])) ? $account_options_result['avatar'] : 
   $CONTROL_OBJ->GetText('avatarisset'));
  break;
  case 'delete':
   $account_options_result['avatar'] = ($CONTROL_OBJ->DeleteUserAvatar()) ? $CONTROL_OBJ->GetText('avatardeleted') : '';   
  break;
  default: $account_options_result['avatar'] = ''; break; 	
 }
 //-------------------------------------------------------------------------------------
 /* личные настройки */
 if ($_POST['generalsettingsdata'] == 'do') {
  $account_options_result['gensettings'] = $CONTROL_OBJ->ModifyUserInfo(array(
   'email'    => $_POST['setmail'],
   'url'      => $_POST['seturl'],
   'newpass'  => $_POST['setpass'],
   'lastpass' => $_POST['lastpass']   
  ));  	
 }
 //-------------------------------------------------------------------------------------
 /* дополнительные параметры */
 if ($_POST['additionaloptionsact'] == 'do') {
  $temp_str = $account_options_result['additionalopt'];	
  $list_ontions = array(
   //show menu on all pages of site 
   'SHOWUSMENU' => ($CONTROL_OBJ->CheckPostValue('shusermenuall')) ? 1 : 0,
   //show my e-mail on personal page
   'SHOWEMAIL'  => ($CONTROL_OBJ->CheckPostValue('shuseremaili')) ? 1 : 0,
   //show my site on personal page
   'SHOWSITE'   => ($CONTROL_OBJ->CheckPostValue('shusersitei')) ? 1 : 0
  );
  foreach ($list_ontions as $name => $value) {
   if ($CONTROL_OBJ->WriteOption($name, $value) === false) { unset($list_ontions[$name]); }   	
  }  
  if (!$list_ontions) { $account_options_result['additionalopt'] = $CONTROL_OBJ->GetText('optionsisnochok'); }   
  //pay index site on personal page
  if (W_USERSCANPAYFOREVERINDEXLINK && $CONTROL_OBJ->CheckPostValue('payindexsite') && 
     !$CONTROL_OBJ->ReadOption('INDEXSITE') && W_USERSCANPAYFOREVERINDEXLINKPRICE > 0) {
   $account_options_result['additionalopt'] = $CONTROL_OBJ->MoneyProcess(
    $CONTROL_OBJ->userdata, $CONTROL_OBJ->GetText('activeindexsiteon'), 
    ($CONTROL_OBJ->userdata['iduser'] + 1), W_USERSCANPAYFOREVERINDEXLINKPRICE, false, 'sub'
   );
   if (!$account_options_result['additionalopt']) {
	$CONTROL_OBJ->WriteOption('INDEXSITE', 1);
	$account_options_result['additionalopt'] = $temp_str;	
   } else {
   	//correct error result
    $account_options_result['additionalopt'] .= ' ['.$CONTROL_OBJ->GetText('activeindexsiteon').']';	
   }   	
  }   	   
  //save
  $CONTROL_OBJ->UpdateOptions();  	
 }
 //-------------------------------------------------------------------------------------
 /*  */
 //-------------------------------------------------------------------------------------
 $CONTROL_OBJ->smarty->assign('account_options_result', $account_options_result); 
?>