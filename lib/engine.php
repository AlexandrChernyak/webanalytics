<?php
 /** Подключение стандартных управления
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */  
 //-------------------------------------------------------
 if (!@defined('W_ENGINED_L')) {
  require_once dirname(__FILE__).'/confi/pengine.php';
 }
 //-------------------------------------------------------
 //lib каталог
 define('W_LIBPATH', W_SITEDIR.'/lib');
 //каталог сео библиотеки
 define('W_SEOLIBPATH', W_SITEDIR.'/slib');
 //каталог хранения файлов
 define('W_FILESWEBPATH', 'pfiles');
 define('W_FILESPATH', W_SITEDIR.'/'.W_FILESWEBPATH);
 //каталог шрифтов
 define('W_FONTSFILESPATH', W_FILESPATH.'/fonts');
 //каталог стандартных информеров
 define('W_DEFAULTINFORMERSPATH', W_FILESPATH.'/generalinformers');
 //-------------------------------------------------------
 ini_set('display_errors',1);
 error_reporting(E_ALL & ~E_NOTICE);
 //-------------------------------------------------------
 /* подключение элементов управления */
 require_once W_LIBPATH.'/confi/conf.php';
 require_once W_LIBPATH.'/control.lib.php'; 
 //-------------------------------------------------------
 /* инициализация элементов */
 $CONTROL_OBJ = new w_Control_obj(
  $_MYSQL_CONNECT_PARAMS['host'], $_MYSQL_CONNECT_PARAMS['user'],
  $_MYSQL_CONNECT_PARAMS['pass'], $_MYSQL_CONNECT_PARAMS['db'],
  $_TABLES_NAMES_LIST
 ); 
 //-------------------------------------------------------
 /* set language */
 if ($_POST['setnewlanguage'] != 'do' && $_GET['ln'] && isset($_GLOBAL_LANGUAGE_LIST[$_GET['ln']])) {  	
  $_POST['langtosetnew'] = $_GET['ln'];
  $_POST['setnewlanguage'] = ($CONTROL_OBJ->GetActiveLanguage() != $_GET['ln']) ? 'do' : '';	
 }
 if ($_POST['setnewlanguage'] == 'do' && $_POST['langtosetnew'] && isset($_GLOBAL_LANGUAGE_LIST[$_POST['langtosetnew']])) {
  $CONTROL_OBJ->SetActiveLanguage($_POST['langtosetnew']);  	
 }
 /* set skin */
 if ($_POST['setnewskin'] != 'do' && $_GET['sk'] && isset($_GLOBAL_SKIN_LIST[$_GET['sk']])) {
  $_POST['skintosetnew'] = $_GET['sk'];
  $_POST['setnewskin'] = ($CONTROL_OBJ->GetActiveSkin() != $_GET['sk']) ? 'do' : '';	
 }
 if ($_POST['setnewskin'] == 'do' && $_POST['skintosetnew'] && isset($_GLOBAL_SKIN_LIST[$_POST['skintosetnew']])) {
  $CONTROL_OBJ->SetActiveScin($_POST['skintosetnew']);  	
 }
 //------------------------------------------------------- 
 //if not api
 if ($_GET['wtpath'] != 'xml/' && $_GET['wtpath'] != 'xml') {
  //авторизация
  $CONTROL_OBJ->DoInitializeAccount(false, 
   array(
    'login' => $_POST['qlogin'],
    'pass'  => $_POST['qpassw']
   ),
   $_POST['actionlog'] == "do"
  );
 }
 //-------------------------------------------------------
 require_once W_LIBPATH.'/preload-get.lib.php';
 require_once W_LIBPATH.'/preloadoptions.lib.php';
 //-------------------------------------------------------
 $CONTROL_OBJ->smarty->assign('CONTROL_OBJ', $CONTROL_OBJ);
 $CONTROL_OBJ->smarty->assign('_GLOBAL_LANGUAGE_LIST', $_GLOBAL_LANGUAGE_LIST);
 $CONTROL_OBJ->smarty->assign('_GLOBAL_SKIN_LIST', $_GLOBAL_SKIN_LIST);
 //-------------------------------------------------------
 require_once W_SITEDIR.'/slib/engine.php'; 
 //-------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */     
?>