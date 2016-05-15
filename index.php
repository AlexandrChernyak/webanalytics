<?php
 /** Гланый направляющий модуль
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */   
 $reqfile = (isset($_POST['is_ajax_mode']) && $_POST['is_ajax_mode']) ? 'ajax.engine.php' : 'engine.php';
 require_once dirname(__FILE__).'/lib/'.$reqfile;
 //-------------------------------------------------------------------------------------   
 /*  проверка секций*/
 require_once W_LIBPATH.'/prepsection.lib.php';  
 /* инициализация контента */ 
 $CONTROL_OBJ->smarty->display('main.tpl'); 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>