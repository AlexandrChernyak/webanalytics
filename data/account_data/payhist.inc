<?php
 /** финансовые операции пользователя
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 $transactions_count = array(
  'all' => $CONTROL_OBJ->GetFinanceTransactionsCount(false, false),
  'ref' => $CONTROL_OBJ->GetFinanceTransactionsCount(false, true)
 ); 
 $CONTROL_OBJ->smarty->assign('transactions_count', $transactions_count);
 //-------------------------------------------------------------------------------------
 if ($_GET['new']) {
  /* пополнение баланса ----------------------------------- */	
  $section_info['stitle'] = $CONTROL_OBJ->GetText('balancehistoryadd'); 
  $section_way[] = array(
   'name' => $section_info['stitle'],
   'path' => W_SITEPATH.'account/payhistory/&new=1'
  );
  
  /* robokassa --------------- begin */
  if (W_USEROBOXCHANGEPAYPROCESS && $_ROBOXCHANGEPAYLISTDATA && $_POST['actpayrobox'] == 'do') {
   $robokassa_info = array(
    'login' => $_ROBOXCHANGEPAYLISTDATA['login'],
    'descr' => $CONTROL_OBJ->GetText('paybalanceuser', array($CONTROL_OBJ->userdata['username'])),
    'summ'  => ($_POST['rxsumm'] && @is_numeric($_POST['rxsumm']) && $_POST['rxsumm'] > 0) ? $_POST['rxsumm'] : 
	           $_ROBOXCHANGEPAYLISTDATA['sumdef'],
    'stype' => $_ROBOXCHANGEPAYLISTDATA['mtype'],
    'lang'  => ($CONTROL_OBJ->GetActiveLanguage() == 'RU') ? 'ru' : 'en',
    'shit'  => ($CONTROL_OBJ->userdata['iduser'] + 1),
    'InvId' => 0,//$CONTROL_OBJ->userdata['iduser'], //сделать код
    'test'  => $_ROBOXCHANGEPAYLISTDATA['test'],
    'SHPppt'=> md5($CONTROL_OBJ->userdata['username'].':'.$CONTROL_OBJ->userdata['iduser'].':'.$CONTROL_OBJ->userdata['userhash'])
   );
   $robokassa_info['crc'] = md5(
    "{$robokassa_info['login']}:{$robokassa_info['summ']}:{$robokassa_info['InvId']}:".
	"{$_ROBOXCHANGEPAYLISTDATA['pass']}:Shp_item={$robokassa_info['shit']}:SHP_ppt={$robokassa_info['SHPppt']}"
   );    
   $CONTROL_OBJ->smarty->assign('robokassa_info', $robokassa_info);   	
  } else
    { $CONTROL_OBJ->smarty->assign('_ROBOXCHANGEPAYLISTDATA', $_ROBOXCHANGEPAYLISTDATA); }
     
  /* robokassa --------------- end */
  
  
  /* webmoney merchant info begin --------------------------- */
  if (@W_USEWEBMONEYMERCHANT) {
   $CONTROL_OBJ->smarty->assign('_WEBMONEYMERCHANTLISTDATA', $_WEBMONEYMERCHANTLISTDATA);
   $webmoney_merchant_infp = array(
    //code
    'user_unigue_id' => md5(md5($CONTROL_OBJ->userdata['username'].
                        '_pay_data_balans_'.$CONTROL_OBJ->userdata['iduser'].'_looking_money')),
    //descr
    'descr' => @base64_encode($CONTROL_OBJ->GetText('paybalanceuser', array($CONTROL_OBJ->userdata['username']))) 
   );
   $CONTROL_OBJ->smarty->assign('webmoney_merchant_infp', $webmoney_merchant_infp);
  } 
  /* webmoney merchant info end --------------------------- */
  
    
    	
 } elseif ($_GET['status'] && $_GET['t']) {
  /* статус платежей ------------------------------------------ */
  
  $section_info['stitle'] = $CONTROL_OBJ->GetText('statuspaydoneprc');
  $status_list_text = array(
   'status' => $CONTROL_OBJ->GetText('errorpaycheckpar'),
   'descr'  => $CONTROL_OBJ->GetText('unknowpaymetchod'),
   'isok'   => $_GET['status'] == 'success'
  );  
  switch ($_GET['status']) {
   case 'success': $status_list_text['status'] = $CONTROL_OBJ->GetText('payisdoneok'); break;
   case 'fail': $status_list_text['status'] = $CONTROL_OBJ->GetText('payisdonenook'); break;	
  }
  
  //select engine
  switch ($_GET['t']) {
    
   /* roboxchange.com */
   case 'robox':
    $status_list_text['descr'] = $CONTROL_OBJ->GetText('paymoneyfromrbx', array(
	 '<b style="color: #0000FF">ROBO</b><b style="color: #FF0000">KASSA</b> [roboxchange.com]'
	));
    $status_list_text['isok']  = ($_GET['status'] == 'success') and (
	 $_POST['OutSum'] && @is_numeric($_POST['OutSum']) && $_POST['OutSum'] > 0 &&
	 $_POST['InvId'] && $_POST['SignatureValue'] && 
	 ($CONTROL_OBJ->strtoupper($_POST['SignatureValue']) == $CONTROL_OBJ->strtoupper(md5(
	  "{$_POST['OutSum']}:{$_POST['InvId']}:{$_ROBOXCHANGEPAYLISTDATA['pass']}:".
	  "Shp_item={$_POST['Shp_item']}:SHP_ppt={$_POST['SHP_ppt']}"
	 ))) 
	);    
   break;

   /* webmoney merchant */
   case 'webmoney': 
    $status_list_text['descr'] = $CONTROL_OBJ->GetText('paymoneyfromrbx', array(
	 '<b style="color: #0000FF">WebMoney Merchant</b> [webmoney.ru]'
	));
    $status_list_text['isok']  = ($_GET['status'] == 'success');
   break; 
   
   
   /* неизвестные */
   default:
    $status_list_text['status'] = $CONTROL_OBJ->GetText('payisdonenook');
    $status_list_text['isok'] = false;
   break;   	
  }  
  $CONTROL_OBJ->smarty->assign('status_list_text', $status_list_text); 	
 } else {
    
  /* список транзакций ---------------------------------------- */
  $RECORDS_COUNT = ($_GET['fromref']) ? $transactions_count['ref'] : $transactions_count['all'];
  $query = "select * from {$_TABLES_NAMES_LIST['moneyhis']} where ".
           "username='{$CONTROL_OBJ->userdata['username']}'".(($_GET['fromref']) ? " and isrefer='1'" : '').
		   " order by datedata DESC";
  $transactions_list = $CONTROL_OBJ->db->GetDataByPages(
   $query, $_GET['page'], W_MAXFINANCEITEMSPERPAGE, $RECORDS_COUNT,
   W_SITEPATH.'account/payhistory/&page=', ($_GET['fromref']) ? '&fromref=1' : '', '', ''
  );
  $CONTROL_OBJ->smarty->assign('transactions_list', $transactions_list);  	
 } 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */ 
?>