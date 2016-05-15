<?php
 /** Модуль проверки платежа посредством webmoney merchant
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */   
 require_once dirname(__FILE__).'/../lib/engine.php';
 @header('Content-Type: text/plain; charset=utf-8');
 //-------------------------------------------------------------------------------------------------
 /* функция проверки hash кода */
 function CheckMD5hash($secret_key) {
  global $CONTROL_OBJ;  
  // Склеиваем строку параметров
  $common_string = $_POST['LMI_PAYEE_PURSE'].$_POST['LMI_PAYMENT_AMOUNT'].$_POST['LMI_PAYMENT_NO'].
  $_POST['LMI_MODE'].$_POST['LMI_SYS_INVS_NO'].$_POST['LMI_SYS_TRANS_NO'].
  $_POST['LMI_SYS_TRANS_DATE'].$secret_key.$_POST['LMI_PAYER_PURSE'].$_POST['LMI_PAYER_WM'];
  // Шифруем полученную строку в MD5 и переводим ее в верхний регистр
  $hash = $CONTROL_OBJ->strtoupper(@md5($common_string));
  // Прерываем работу скрипта, если контрольные суммы не совпадают
  if ($hash != $_POST['LMI_HASH']) { return false;} 
  return true;  	
 } 
 
 function DError($s) { echo $s; exit; } 
 
 //------------------------------------------------------------------------------------------------- 
 //если предварительный запрос...
 if ($_POST['LMI_PREREQUEST'] == 1) {   
  /* флаг на ok */
  $is_ok = true; 
  //получаем данные о пользователе
  $_POST['u_id'] = $CONTROL_OBJ->HTMLspecialChars(@trim($_POST['u_id'])); 
  //имя пользователя
  $_POST['nameuseronline'] = $CONTROL_OBJ->HTMLspecialChars(trim($_POST['nameuseronline'])); 
  
  $query = "select * from {$CONTROL_OBJ->tables_list['users']} where iduser='{$_POST['u_id']}' and username='{$_POST['nameuseronline']}' limit 1";
  $pr_data = $CONTROL_OBJ->db->mPost($query); 
  $pr_data = $CONTROL_OBJ->db->GetLineArray($pr_data);  
     
  //проверка идентификации пользователя, возможно подмена
  if ((!$pr_data) or ($pr_data['iduser'] != $_POST['u_id']) or ($_POST['u_id'] == "") or ($pr_data['iduser'] == "")) {
   $is_ok = false;	
   DError("Пользователь не идентифицирован!");
  }
  
  //проверка передаваемого хеша операции
  $user_unigue_id = md5(md5($pr_data['username'].'_pay_data_balans_'.$pr_data['iduser'].'_looking_money'));
  if ($user_unigue_id != trim($_POST['idhash'])) {
   $is_ok = false;
   DError("Операция не подтверждена!");
  }  
  
  //проверка кашелька
  if ((trim($_POST['LMI_PAYEE_PURSE']) != $_WEBMONEYMERCHANTLISTDATA['USDDATA']) and (trim($_POST['LMI_PAYEE_PURSE']) != $_WEBMONEYMERCHANTLISTDATA['RURDATA'])) {
   $is_ok = false;
   DError("Некорректно указан кашелек для получения средств..");
  } 
  
  //проверка на подмену цены  
  if ((trim($_POST['LMI_PAYMENT_AMOUNT']) <= 0) or (trim($_POST['LMI_PAYMENT_AMOUNT']) == '')) {
   $is_ok = false;	
   DError("Сумма некорректна...");
  }   
  //если все ok - можно приступить к реальной оплате.. 
  if ($is_ok) { DError("YES"); }   	
 }//тестовый режим	
 else
 {
  /*--------------------- оформление платежа, зачисление на счет - запись в базу ------------------------------------*/  
  //получаем данные о пользователе
  $_POST['u_id'] = $CONTROL_OBJ->HTMLspecialChars(@trim($_POST['u_id'])); 
  //имя пользователя
  $_POST['nameuseronline'] = $CONTROL_OBJ->HTMLspecialChars(trim($_POST['nameuseronline'])); 
  
  $query = "select * from {$CONTROL_OBJ->tables_list['users']} where iduser='{$_POST['u_id']}' and username='{$_POST['nameuseronline']}' limit 1";
  $pr_data = $CONTROL_OBJ->db->mPost($query); 
  $pr_data = $CONTROL_OBJ->db->GetLineArray($pr_data);  
   
  //проверка идентификации пользователя, возможно подмена
  if ((!$pr_data) or ($pr_data['iduser'] != $_POST['u_id']) or ($_POST['u_id'] == "") or ($pr_data['iduser'] == "")) {
    exit; 
  }
  
  //проверка хэш кода и кошелька
  if (trim($_POST['LMI_PAYEE_PURSE']) == $_WEBMONEYMERCHANTLISTDATA['USDDATA']) {
   if (!CheckMD5hash($_WEBMONEYMERCHANTLISTDATA['usd_secret'])) { exit; }
  } else if (trim($_POST['LMI_PAYEE_PURSE']) == $_WEBMONEYMERCHANTLISTDATA['RURDATA']) {
   if (!CheckMD5hash($_WEBMONEYMERCHANTLISTDATA['rur_secret'])) { exit; }
  } else { exit; } 
  //проверка передаваемого хеша операции
  $user_unigue_id = md5(md5($pr_data['username'].'_pay_data_balans_'.$pr_data['iduser'].'_looking_money'));
  if ($user_unigue_id != trim($_POST['idhash'])) { exit; }  
  //проверка на подмену цены  
  if ((trim($_POST['LMI_PAYMENT_AMOUNT']) <= 0) or (trim($_POST['LMI_PAYMENT_AMOUNT']) == '')) { exit; }  
  //пополнение баланса пользователя
  $data = $_POST['LMI_PAYMENT_AMOUNT'];
  if (trim($_POST['LMI_PAYEE_PURSE']) == $_WEBMONEYMERCHANTLISTDATA['RURDATA']) { 
    $data = round($data/$_WEBMONEYMERCHANTLISTDATA['RF_CURS'],2); 
  }
  DError($CONTROL_OBJ->MoneyProcess(
   $pr_data, $CONTROL_OBJ->GetText('paybalanceuser', array($pr_data['username'])),
   ($pr_data['iduser'] + 40), $data
  ));

  /*--------------------- оформление платежа, зачисление на счет - запись в базу ------------------------------------*/	
 }
?>