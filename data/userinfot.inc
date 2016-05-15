<?php
 /** модуль информации о пользователе
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 $user_regional_info = ($_GET['user']) ? $CONTROL_OBJ->GetUserInfo($_GET['user']) : false;
 $user_regional_info = ($user_regional_info && $user_regional_info['useractive'] && !$user_regional_info['userlocked']) ?
 $user_regional_info : false;
 $section_info['stitle'] = ($user_regional_info) ? $CONTROL_OBJ->GetText('useringopage', array(
  $user_regional_info['username'])
 ) : $section_info['stitle']; 
 $section_info['title']  = $section_info['stitle'].' - '.$section_info['title'];
 if ($user_regional_info) { 
  $section_way[] = array(
   'name' => $section_info['stitle'],
   'path' => W_SITEPATH.'userinfo/'.$user_regional_info['username'].'/'
  );
  $user_regional_info['avatar'] = (!$val = $CONTROL_OBJ->ReadOption('AVATAR', $user_regional_info['genoptions'])) ? 'avatar.png' :
  ((@file_exists(W_FILESPATH.'/images/'.$val)) ? $val : 'avatar.png');
  $user_regional_info['indexsiteonpage'] = ($CONTROL_OBJ->ReadOption('INDEXSITE', $user_regional_info['genoptions'])) ? 1 : 0;   
 } 
 if ($user_regional_info) { $CONTROL_OBJ->smarty->assign('user_regional_info', $user_regional_info); } 
 //-------------------------------------------------------------------------------------
?>