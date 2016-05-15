<?php
 /** распределение кабинета пользователя
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */ 
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!'); 
 //-------------------------------------------------------------------------------------
 $_GET['hrzd']  = (isset($_GET['hrzd'])) ? $CONTROL_OBJ->CorrectSymplyString($_GET['hrzd']) : '';
 $_GET['hrzd2'] = (isset($_GET['hrzd2'])) ? $CONTROL_OBJ->CorrectSymplyString($_GET['hrzd2']) : '';      
 switch ($CONTROL_OBJ->strtolower($_GET['hrzd'])) {
  /* настрйоки */
  case 'settings':
   $section_info['stitle'] = $CONTROL_OBJ->GetText('settings');
   $section_info['file']   = 'account/settings.tpl';
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title']; 
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH.'account/settings/'
   );  
   require_once W_SITEDIR.'/data/account_data/settingsf.inc';
  break;
  /* финансовые операции */
  case 'payhistory':
   $section_info['stitle'] = $CONTROL_OBJ->GetText('balancehistory');
   $section_info['file']   = 'account/payhistory.tpl';
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title']; 
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH.'account/payhistory/'
   );  
   require_once W_SITEDIR.'/data/account_data/payhist.inc';
  break;
  /* почта */
  case 'mail':
   $section_info['stitle'] = $CONTROL_OBJ->GetText('mailaccount');
   $section_info['file']   = 'account/mail.tpl';
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title']; 
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH.'account/mail/'
   );  
   require_once W_SITEDIR.'/data/account_data/mailf.inc';  
  break;
  /* xml api */
  case 'xml-api':
   $section_info['stitle'] = 'XML API';
   $section_info['file']   = 'account/xml-api-file.tpl';
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title']; 
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH.'account/xml-api/'
   );
   //save enabled if posted
   if ($_POST['actionsaveapien'] == 'do') {
    $update_do = false;
    if ($CONTROL_OBJ->CheckPostValue('apienabled') && !$CONTROL_OBJ->ReadOption('USEXMLAPI')) {
     $update_do = $CONTROL_OBJ->WriteOption('USEXMLAPI', 1);
    } 
    elseif (!$CONTROL_OBJ->CheckPostValue('apienabled') && $CONTROL_OBJ->ReadOption('USEXMLAPI')) {
     $update_do = $CONTROL_OBJ->DeleteOption('USEXMLAPI');   
    }
    if ($update_do !== false) { $CONTROL_OBJ->UpdateOptions(); }     
   }
   //init params
   require_once W_LIBPATH.'/confi/api.conf.php';
   $CONTROL_OBJ->smarty->assign('_API_CONFIGURATION_PACK', $_API_CONFIGURATION_PACK);
  break;
  /* ref banners */
  case 'ref-banner':
   $section_info['stitle'] = $CONTROL_OBJ->GetText('admrefbunnerssection');
   $section_info['file']   = 'account/ref-banner-file.tpl';
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title']; 
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH.'account/ref-banner/'
   );
  break;
  /* bunners list of account */
  case 'my-banners-list':
   $section_info['stitle'] = $CONTROL_OBJ->GetText('admbunnerscontroltext');
   $section_info['file']   = 'account/my-banners-list.tpl';
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title']; 
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH.'account/my-banners-list/'
   );   
   require_once W_LIBPATH.'/bunners.lib.php';   
   
   $mybanner_obj = new w_adv_bunners_object($CONTROL_OBJ);
   $mybanner_obj->ExecMyBanners();  
   $CONTROL_OBJ->smarty->assign('mybanner_obj', $mybanner_obj); 
  break;
     	
  //get general account info	
  default:
   /* проверка идентификации админовского хождения */
   if ($CONTROL_OBJ->isadminstatus && $CONTROL_OBJ->substr($_GET['hrzd'], 0, 3) == 'adm') {
	$section_way[] = array(
     'name' => '<span style="color: #0000FF">'.$CONTROL_OBJ->GetText('adminsectionaccout').'</span>',
     'path' => W_SITEPATH.'account/admmain/'
    );
	require_once W_SITEDIR.'/data/info_adm_data/indext.inc';	
	break;
   }
  //use default my account info    
  break;	
 }
 //------------------------------------------------------------------------------------- 
 /* Copyright (с) 2011 forwebm.net */
?>