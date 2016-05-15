<?php
 /** модуль страницы витрины ссылок
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 $global_data_list_info = array('error'=>'');
 
 if ($_GET['new']) {
  //add new
  $section_way[] = array(
   'name' => $CONTROL_OBJ->GetText('linksaddnewlink'),
   'path' => W_SITEPATH.'vitrinalinks/new=1'
  );
  //ok next
  $html = new ss_HTTP_obj();
  if (!$html->SetURL($CONTROL_OBJ->CorrectSymplyString($_POST['url']))) {
   $global_data_list_info['error'] = $CONTROL_OBJ->GetText('nocorrecturlforset'); 	
  } else {
   $country = '';
   //locale ip
   if ($html->RunPluginEx(SS_GEOLOCALEIP, $error, $value, array('ip' => $CONTROL_OBJ->GetCurrentIP()))) {
	$country = $CONTROL_OBJ->CorrectSymplyString($value['servergeo']);
   } 
   //summ  
   $summ = 0;
   switch ($_POST['ptype']) {
	case '1': $summ = $_VITRINALINKSOPTIONS['defprice']; break;
	case '2': $summ = $_VITRINALINKSOPTIONS['boldprice']; break;
	case '3': $summ = $_VITRINALINKSOPTIONS['indexprice']; break;
	case '4': $summ = $_VITRINALINKSOPTIONS['indexboldprice']; break;
	default: $summ = 0; break;
   }
   $error = (!$summ) ? $CONTROL_OBJ->GetText('summlinkpaynocorre') : '';   
   //for money process
   if (!$error) { if (!$CONTROL_OBJ->IsOnline()) { $error = $CONTROL_OBJ->GetText('younotonlineuser'); } }
   //pay 
   $error = (!$error) ? $CONTROL_OBJ->MoneyProcess(
    $CONTROL_OBJ->userdata['username'], $CONTROL_OBJ->GetText('moneytolinkvitrina'), 
	$CONTROL_OBJ->userdata['iduser'] + 12, $summ, false, 'sub' 
   ) : $error;
   //check
   if ($error) { $global_data_list_info['error'] = $error; } else {
	//add record
	$CONTROL_OBJ->db->INSERTAction('linksvit', array(
	 'ldate'      => $CONTROL_OBJ->GetThisDateTime(),
	 'ltext'      => $CONTROL_OBJ->substr($CONTROL_OBJ->CorrectSymplyString($_POST['urltext']), 0, 80),
	 'lurl'       => $CONTROL_OBJ->substr($html->url_self_no_protocol, 0, 120),
	 'lhost'      => $html->url_real_host,
	 'isbolded'   => (@in_array($_POST['ptype'], array('2', '4'))) ? 1 : 0,
	 'isindexed'  => (@in_array($_POST['ptype'], array('3', '4'))) ? 1 : 0,
	 'lfromcountr'=> $country	 
	));		
   }   	
  }	
 } else {
  //listen	
  $result = $CONTROL_OBJ->db->mPost("select * from {$CONTROL_OBJ->tables_list['linksvit']} order by ldate DESC");
  $global_data_list_info['data'] = array();
  $global_data_list_info['count'] = 0;
  $incer = 0;
  while ($row = $CONTROL_OBJ->db->GetLineArray($result)) {
   $incer++;
   if ($incer <= $_VITRINALINKSOPTIONS['countinpage']) {   
    $global_data_list_info['data'][] = $row;
    $global_data_list_info['count']++;
   } else {
	//remove old
	$CONTROL_OBJ->db->Delete($CONTROL_OBJ->tables_list['linksvit'], "iditem='{$row['iditem']}'", "1");	
   }   	
  }	
 } 
 //-------------------------------------------------------------------------------------
 $CONTROL_OBJ->smarty->assign('global_data_list_info', $global_data_list_info); 
 $CONTROL_OBJ->smarty->assign('_VITRINALINKSOPTIONS', $_VITRINALINKSOPTIONS);
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>