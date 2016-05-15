<?php
 /** Обработка инициализации секций
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 
 //-------------------------------------------------------------------------------------
 $section_info = array(
  'file'        => 'index.tpl',
  'title'       => $CONTROL_OBJ->GetText(W_DEFAULTDOMAINTITLE),
  'key'         => $CONTROL_OBJ->GetText(W_DEFAULTKEYWORDS),
  'stitle'      => '',
  'jslist'      => false,
  'csslist'     => false,
  'description' => (@defined('W_DEFAULTDOMAINDESCRIPTION') && W_DEFAULTDOMAINDESCRIPTION) ? 
                   $CONTROL_OBJ->GetText(W_DEFAULTDOMAINDESCRIPTION) : ''
 );
 $section_way = array(
  array(
   'name' => $CONTROL_OBJ->GetText('genhostdomain'),
   'path' => W_SITEPATH
  )
 );
 $global_user_info = array();
//-------------------------------------------------------------------------------------
 if ($CONTROL_OBJ->IsOnline()) {
  //аватарка пользователя	 	
  $global_user_info['avatar'] = (!$val = $CONTROL_OBJ->ReadOption('AVATAR')) ? 'avatar.png' :
  ((@file_exists(W_FILESPATH.'/images/'.$val)) ? $val : 'avatar.png');
  //количество непрочитанных сообщений
  $global_user_info['privatenew'] = $CONTROL_OBJ->GetUnreadMessagesCount();
  //количество сообщений всего
  $global_user_info['privateall'] = $CONTROL_OBJ->GetMyMessagesCount();      	
 } 
 //-------------------------------------------------------------------------------------
 /* инициализация данных раздела */
 switch ($CONTROL_OBJ->strtolower($_GET['section'])) {
  /* регистрация */	
  case 'register':
   if ($CONTROL_OBJ->IsOnline()) { $CONTROL_OBJ->LocaleToHost(); }
   $section_info['stitle'] = $CONTROL_OBJ->GetText('registerl');
   $section_info['file']   = 'register.tpl';
   $section_info['title']  = $CONTROL_OBJ->GetText('register').' - '.$section_info['title']; 
   //for ($i=0; $i<=10; $i++) {
   $section_way[] = array(
    'name' => $CONTROL_OBJ->GetText('register'),
    'path' => W_SITEPATH.'register/'
   );
   //}   
   require_once W_SITEDIR.'/data/register.inc';       
  break;
  /* восстановление пароля */
  case 'restorepsw':
   if ($CONTROL_OBJ->IsOnline()) { $CONTROL_OBJ->LocaleToHost(); }
   $section_info['stitle'] = $CONTROL_OBJ->GetText('restorepsw');
   $section_info['file']   = 'restorepswf.tpl';
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title'];
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH.'restore/'
   );
   require_once W_SITEDIR.'/data/restorepswf.inc';  
  break;
  /* активация аккаунта */
  case 'activateact':
   if ($CONTROL_OBJ->IsOnline()) { $CONTROL_OBJ->LocaleToHost(); }
   $section_info['stitle'] = $CONTROL_OBJ->GetText('activateact');
   $section_info['file']   = 'activateactf.tpl';
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title'];
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH.'activate/'
   );
   require_once W_SITEDIR.'/data/activatef.inc';  
  break;
  /* кабинет */
  case 'accountff':
   if (!$CONTROL_OBJ->IsOnline()) { $CONTROL_OBJ->LocaleToHost(); }
   $temp_title = $CONTROL_OBJ->GetText('accountuserdef', array($CONTROL_OBJ->userdata['username']));   
   $section_info['stitle'] = $CONTROL_OBJ->GetText('accountuserdef2', array($CONTROL_OBJ->userdata['username']));
   $section_info['file']   = 'accountuser.tpl';
   $section_info['title']  = $temp_title.' - '.$section_info['title'];
   $section_way[] = array(
    'name' => $temp_title,
    'path' => W_SITEPATH.'account/'
   );
   require_once W_SITEDIR.'/data/accountfft.inc';
  break;
  /* информация о пользователе */ 
  case 'userinfoget':
   $section_info['stitle'] = $CONTROL_OBJ->GetText('usernotfoundond');   
   $section_info['file'] = 'userinfo.tpl';
   require_once W_SITEDIR.'/data/userinfot.inc';  
  break;
  /* список апдейтов */
  case 'engineupdateslist':
   $section_info['stitle'] = $CONTROL_OBJ->GetText('admengineupdatest');
   $section_info['file']   = 'engineupdates.tpl';
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title'];
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH.'updates/'
   );
   require_once W_SITEDIR.'/data/updatesf.inc';  
  break;
  /* инструменты */
  case 'toolsaction':
   $section_info['stitle'] = $CONTROL_OBJ->GetText('toolstextsourced');
   $section_info['file']   = 'toolslist.tpl';
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title'];
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH.'tools/'
   );
   require_once W_SITEDIR.'/data/toolsf.inc';  
  break;
  /* витрина ссылок */
  case 'linksvitrinasection':
   $section_info['stitle'] = $CONTROL_OBJ->GetText('linksvitrinasect');
   $section_info['file']   = 'vitrina_links.tpl';
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title'];
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH.'vitrinalinks/'
   );
   require_once W_SITEDIR.'/data/vitrinalinksf.inc';  
  break;
  /* новости */
  case 'newslisten':
   $section_info['stitle'] = $CONTROL_OBJ->GetText('newslistensection');
   $section_info['file']   = 'news_list.tpl';
   $wayinfostpath = 'news';
   //parse get parameters
   $incer = 0;
   $item = $CONTROL_OBJ->StrFetch($_GET['vari'], '/');
   while ($item || $_GET['vari']) {
    $incer++;	
    if ($item) {
     //identifier	
     if ($incer == 1 && @is_numeric($item)) { $_GET['newid'] = $item; continue; }
     //next all parameters
     if ($CONTROL_OBJ->substr($item, 0, 1) == '?') { $item = $CONTROL_OBJ->substr($item, 1); }
     $val = $CONTROL_OBJ->StrFetch($item, '=');
     if ($val) { $_GET[$CONTROL_OBJ->CorrectSymplyString($val)] = $item; }   	
    }  	
    $item = $CONTROL_OBJ->StrFetch($_GET['vari'], '/');	
   }
   //get data of section
   $section_info['sectiondatainfo'] = ($_GET['ntype'] && @is_numeric($_GET['ntype'])) ? 
   $CONTROL_OBJ->GetNewsSectionItemTypeData($_GET['ntype'], true) : false;
      //section options
   $section_info['sectiondataopt'] = 
   ($_GET['ntype'] && @is_numeric($_GET['ntype']) && isset($_GLOBALUSECOMMENTOPTIONS['0'][$_GET['ntype']])) ?
   $_GLOBALUSECOMMENTOPTIONS['0'][$_GET['ntype']] : false;
   //section host title
   if ($section_info['sectiondataopt']['newstitletospec']) {
	$section_info['stitle'] = $section_info['sectiondataopt']['newstitletospec'];
   }   
   //section host path
   if ($section_info['sectiondataopt']) {
   	if ($section_info['sectiondataopt']['pathobjects']) { 
   	    
     $wayinfostpath = $CONTROL_OBJ->strtolower($section_info['sectiondataopt']['pathobjects']);
        
      //запрет доступа с другого адреса         
      if (@W_LOCKARTICLESBYUNKNOWPATHS && $CONTROL_OBJ->strtolower($CONTROL_OBJ->CorrectSymplyString($_GET['identway'])) != $wayinfostpath) {           
       @header('HTTP/1.0 404 Not Found');
       //header('Location: '.W_SITEPATH.'index.php?section=errordocument&errcode=404');
       exit;         
      }
             
    }	 
   }  
   
   //check for alternate path is specified
   if (!$section_info['sectiondataopt']) {
    $_GET['identway'] = $CONTROL_OBJ->strtolower($CONTROL_OBJ->CorrectSymplyString($_GET['identway']));  
    if ($_GET['identway'] && $_GET['identway'] != $wayinfostpath) {
     //get as info
     if ($info = $CONTROL_OBJ->db->GetLineArray($CONTROL_OBJ->db->mPost(
      "select soptions from {$CONTROL_OBJ->tables_list['newssectq']} where lang='".$CONTROL_OBJ->GetActiveLanguage()."'".
      " and LOCATE('[pathobjects]{$_GET['identway']}[/pathobjects]',soptions) > 0 limit 1"
     ))) {
      //read
      $name_locale = ($info['soptions']) ? $CONTROL_OBJ->ReadOption('newstitletospec', $info['soptions']) : false;
      if ($name_locale) {
       $section_info['stitle'] = $name_locale;
       $wayinfostpath = $_GET['identway'];       
      }            
     }   
    }   
   }
   //set to global news section   
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH.$wayinfostpath.'/'
   );
   //to news listen
   if ($section_info['sectiondatainfo']) {
   	$section_info['stitle'] = $section_info['sectiondatainfo']['sname'];  	
	$section_way[] = array(
     'name' => $section_info['stitle'],
     'path' => W_SITEPATH.$wayinfostpath.'/'.$_GET['ntype'].'/'.
	           (($_GET['oldpage'] && @is_numeric($_GET['oldpage'])) ? 'page='.$_GET['oldpage'] : '')
    );
   }   
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title'];
   require_once W_SITEDIR.'/data/newslistsectionsf.inc';  
  break;
  /* обратная связь */
  case 'feedbackpt':
   $section_info['stitle'] = $CONTROL_OBJ->GetText('feedbacksectgetis');
   $section_info['file']   = 'tplfeedback.tpl';
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title'];
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH.'feedback/'
   );
   require_once W_SITEDIR.'/data/feedbackf.inc';  
  break;
  /* перенаправление на сайт */
  case 'gotositeredirect':
   if ($_GET['urlid'] = $CONTROL_OBJ->CorrectSymplyString($_GET['urlid'])) {
	if ($urlItem = $CONTROL_OBJ->db->GetLineArray($CONTROL_OBJ->db->mPost(
	 "select iditem, rhref, reqcount from {$CONTROL_OBJ->tables_list['redirtbl']} where iditem='{$_GET['urlid']}' limit 1"
	))) {
	 $urlItem['rhref'] = $CONTROL_OBJ->HTMLspecialCharsDecode($urlItem['rhref']);
	 //ad-on components
	 if ($_GET['paramslist']) {
	  $s = @trim($CONTROL_OBJ->StrFetch($_GET['paramslist'], '/'));
	  while ($s || $_GET['paramslist']) {
	   if ($CONTROL_OBJ->strpos($urlItem['rhref'], '%s') === false) { break; }	   
	   $urlItem['rhref'] = @preg_replace("/\%s/", @urlencode($s), $urlItem['rhref'], 1);
	   $s = @trim($CONTROL_OBJ->StrFetch($_GET['paramslist'], '/'));   	
	  }	
	 }
	 //update req-st count
	 $urlItem['reqcount']++;
	 $CONTROL_OBJ->db->UPDATEAction('redirtbl', array(
	  'reqcount' => $urlItem['reqcount']
	 ), "iditem='{$urlItem['iditem']}'", "1");	 
	 //location	 
	 @header("Location: {$urlItem['rhref']}");
	 exit;	 	 	
	}		
   }   
   $CONTROL_OBJ->LocaleToHost();
  break;
  /* ошибка обращения */
  case 'errordocument':
   if (@in_array($_GET['errcode'], array('400', '401', '403', '404'))) {
	$section_info['stitle'] = $CONTROL_OBJ->GetText('errorgetdocument'.$_GET['errcode']);	
   } else { $section_info['stitle'] = 'Error get document..'; }
   $section_info['title']  = $section_info['stitle'];
   $section_info['file']   = 'errordocumentcode.tpl';
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH//$_SERVER['REQUEST_URI']
   );
   @header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
  break;
  /* панель оптимизатора */
  case 'panelitemsaction': 
   $section_info['stitle'] = $CONTROL_OBJ->GetText('seopanelstitledid');
   $section_info['file']   = 'seo-panel/index.tpl';
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title'];
   
   $ppf = W_SITEPATH.'panel/';  
   if ($CONTROL_OBJ->isadminstatus && $_GET['manageuser']) {
    $ppf .= $CONTROL_OBJ->CorrectSymplyString($_GET['manageuser']);
   }
   
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => $ppf
   );
   require_once W_SITEDIR.'/data/panelff.inc';
  break;
  /* xml api */
  case 'xmlapiproject':
   require_once W_LIBPATH.'/confi/api.conf.php';
   require_once W_SITEDIR.'/data/xml-api-data.inc';
   exit;
  break;
  /* независимые страницы проекта */
  case 'specialdinamicpagesection':    
   require_once W_LIBPATH.'/sp.page.lib.php';
   $sp_page_object = new w_sp_page_object($CONTROL_OBJ, $_GET['pageid']); 
   
   //set info
   if ($sp_page_object->GetIncerAutoMode()) {
    $sp_page_object->IncLookCount();    
   }
   
   //get info
   if (!$section_info['stitle'] = $sp_page_object->GetTitle()) {
     $section_info['stitle'] = 'Unknow Page';
   }
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title'];
   $section_info['file']   = $sp_page_object->GetTemplateFileName();
   
   $section_way[] = array(
    'name' => $sp_page_object->GetProjectWayName(),
    'path' => $sp_page_object->GetFullPath()
   );
   
   if ($sp_page_object->GetKeywords()) {
    $section_info['key'] = $sp_page_object->GetKeywords();
   }
   
   if ($sp_page_object->GetDescription()) {
    $section_info['description'] = $sp_page_object->GetDescription();
   }
   
   $sp_page_object->ExecPage();           
   $CONTROL_OBJ->smarty->assign('page_object', $sp_page_object);
  break;
  /* загрузки файлов */
  case 'downloadfile':
   
   $_GET['filesid']   = $CONTROL_OBJ->CorrectSymplyString($_GET['filesid']);
   $_GET['objectsid'] = $CONTROL_OBJ->CorrectSymplyString($_GET['objectsid']);
   $_GET['attachid']  = $CONTROL_OBJ->CorrectSymplyString($_GET['attachid']);
   
   require_once W_LIBPATH.'/files.lib.php';   
   $fileobject = w_dw_files_object::CreateFromObjectID($_GET['filesid'], $_GET['objectsid'], $CONTROL_OBJ);
   
   if (!$fileobject) {
    $filename = 'Object not found!';
    $fileID = false;    
   } else {
    $fileID = w_dw_files_object::_GetFileInfo($_GET['attachid'], $CONTROL_OBJ);
    $filename = ($fileID) ? $fileID['fname'] : 'File not found!';        
   }   
   
   $section_info['stitle'] = $CONTROL_OBJ->GetText('downloadingfiledata', array($filename));
   $section_info['file']   = 'downloads.tpl';
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title'];
   
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH.'download/'.$_GET['filesid'].'/'.$_GET['objectsid'].'/'.$_GET['attachid']
   );
   require_once W_SITEDIR.'/data/downloadfile.inc';     
   $object_file = new w_downloadfile_ext($CONTROL_OBJ, $fileID, $fileobject);
   $object_file->ExecFile();
   
   $CONTROL_OBJ->smarty->assign('curfile_object', $object_file);
  break;
  /* реклама */
  case 'advertisingpagefile': 
   $section_info['stitle'] = $CONTROL_OBJ->GetText('advertisingoursitebyselect');
   $section_info['file']   = 'advertisingt.tpl';
   $section_info['title']  = $section_info['stitle'].' - '.$section_info['title'];
   
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => W_SITEPATH.'advertising/'
   );
   require_once W_SITEDIR.'/data/advertisingff.inc';
  break;
  
	
  default:
   /* главная */
   require_once W_SITEDIR.'/data/maint.inc'; 
   $section_way = array(); 
  break;	
 }
 //-------------------------------------------------------------------------------------
 $CONTROL_OBJ->smarty->assign('global_user_info', $global_user_info); 
 $CONTROL_OBJ->smarty->assign('section_info', $section_info); 
 $CONTROL_OBJ->smarty->assign('section_way', $section_way);
 $CONTROL_OBJ->smarty->assign('engine_updates_list', $CONTROL_OBJ->GetEngineUpdatesInfo());  
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>