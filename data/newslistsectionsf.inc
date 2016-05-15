<?php
 /** модуль страницы новостей
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 $global_data_list_info = array('error'=>'');
 //new info record 
 if ($_GET['newid'] && ($_GET['newid'] = $CONTROL_OBJ->CorrectSymplyString($_GET['newid']))) { 
  
  $_GET['newid'] = $CONTROL_OBJ->GetNewsSectionItemTypeData($_GET['newid'], false, $section_info['sectiondatainfo']); 	
  
  if (!$_GET['newid']) { $global_data_list_info['error'] = $CONTROL_OBJ->GetText('newsisnotfoundnow'); } else {   
   $global_data_list_info['info'] = $_GET['newid']['data'];  
   //информация о новости
   $section_info['title']  = $global_data_list_info['info']['newtitle'].' - '.$section_info['title'];
   $section_info['stitle'] = $global_data_list_info['info']['newtitle'];
   
   if ($global_data_list_info['info']['keywords']) {
    $section_info['key'] = $global_data_list_info['info']['keywords'];
   }
   
   if ($global_data_list_info['info']['tdescription']) {
    $section_info['description'] = $global_data_list_info['info']['tdescription'];
   }  
   
   //path
   $path_q = W_SITEPATH.(($_GET['newid']['setinfo']['pathobjects']) ? $_GET['newid']['setinfo']['pathobjects'] : 'news').   
   '/'.$global_data_list_info['info']['newtype'].'/'.$global_data_list_info['info']['iditem'].'/';
   
   //block
   $section_way[] = array(
    'name' => $section_info['stitle'],
    'path' => $path_q
   );
   
   //update looks statistic
   $CONTROL_OBJ->db->UPDATEAction('newslist', array(
    'newlooks' => ($global_data_list_info['info']['newlooks'] + 1)
   ), "iditem='{$global_data_list_info['info']['iditem']}'", "1"); 
     
   //добавление комментария
   if ($CONTROL_OBJ->IsOnline() && $_GET['newid']['setinfo']['enabled']) {
   	$check_code = (($_POST['actionthissectionpost'] == 'do') && isset($_SESSION["sendnumbt"])) ? 
    $_SESSION["sendnumbt"] : '';
    
   	$_SESSION["sendnumbt"] = $CONTROL_OBJ->generate_password(7);
	if ($_POST['actionthissectionpost'] == 'do' && $_POST['actionnewprvmail'] == 'act') {     
     //add record	
	 $global_data_list_info['addstatus'] = $CONTROL_OBJ->DoActionAddNewComment(array(
	  'commentsource' => $_POST['commentsource'],
	  'useinform'     => $CONTROL_OBJ->CheckPostValue('useinform'),
	  'restcode'      => (isset($_POST['restcode'])) ? $_POST['restcode'] : '',
	  'commtype'      => $global_data_list_info['info']['newtype'],
	  'commfor'       => $global_data_list_info['info']['iditem'],
	  'pathtorestore' => $path_q,
	  'commentto'     => $global_data_list_info['info']['newtitle'],
	  'codeorig'      => $check_code	 
	 ), '0', $_GLOBALUSECOMMENTOPTIONS['0'][$global_data_list_info['info']['newtype']]);
	 //$global_data_list_info['pathtoreturn'] = $path_q;
	 //redirect if OK status
	 if ($global_data_list_info['addstatus'] == '1') {
	  $s = ($CONTROL_OBJ->substr($path_q, 0, 1) == '/') ? $CONTROL_OBJ->substr($path_q, 1) : $path_q;
	  $CONTROL_OBJ->LocaleToHost($s);
	  //exit;	  	
	 }
     		
	}   	
   }   
   //комментарии
   $global_data_list_info['commentscount'] = 
   (!$_GET['newid']['setinfo']['enabled']) ? 0 : $CONTROL_OBJ->GetCommentCountForElement(
    $global_data_list_info['info']['newtype'], $global_data_list_info['info']['iditem']
   );
   $global_data_list_info['commentsdata'] = (!$_GET['newid']['setinfo']['enabled']) ? 0 : 
   $CONTROL_OBJ->db->GetDataByPages(
    "select * from {$CONTROL_OBJ->tables_list['commtbl']} where commfor='{$global_data_list_info['info']['iditem']}' ".
    "and commisactive='1' and objectid='0' order by datecreate DESC", 
    $_GET['page'], $_GET['newid']['setinfo']['perpagecount'], $global_data_list_info['commentscount'], 
	 W_SITEPATH.(($_GET['newid']['setinfo']['pathobjects']) ? $_GET['newid']['setinfo']['pathobjects'] : 'news').
	 '/'.$global_data_list_info['info']['newtype'].'/'.$global_data_list_info['info']['iditem'].'/page=', 
	 '#comments', '', '' 
   );
   $global_data_list_info['commentusecaptcha'] = $_GET['newid']['setinfo']['withcaptcha'];
   //$CONTROL_OBJ->smarty->assign('_GLOBALUSECOMMENTOPTIONS', $_GLOBALUSECOMMENTOPTIONS);	
  }
 }
 //listen data, if specified type of news 
 elseif (@is_numeric($_GET['ntype'])) {
  $_GET['ntype'] = $CONTROL_OBJ->CorrectSymplyString($_GET['ntype']);
  $global_data_list_info['count'] = $CONTROL_OBJ->GetCountInTable(
   'iditem', 'newslist', "where newtype='{$_GET['ntype']}' and lang='".$CONTROL_OBJ->GetActiveLanguage()."'"
  );
  $global_data_list_info['data'] = $CONTROL_OBJ->db->GetDataByPages(
   "select * from {$CONTROL_OBJ->tables_list['newslist']} where newtype='{$_GET['ntype']}' and ".
   "lang='".$CONTROL_OBJ->GetActiveLanguage()."' order by datecreate DESC", 
   $_GET['page'], W_NEWSPERPAGEINPUBLICSECT, $global_data_list_info['count'], 
   W_SITEPATH.(($section_info['sectiondataopt']['pathobjects']) ? $section_info['sectiondataopt']['pathobjects'] : 'news').
   '/'.$_GET['ntype'].'/page=', '', '', '' 
  );  
  $global_data_list_info['showimages'] = $_GLOBALUSECOMMENTOPTIONS['0'][$_GET['ntype']]['showimages'];
 } else { $global_data_list_info['selectsection'] = true; }	
 //-------------------------------------------------------------------------------------
 $CONTROL_OBJ->smarty->assign('global_data_list_info', $global_data_list_info); 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>