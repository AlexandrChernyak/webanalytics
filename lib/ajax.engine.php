<?php
 /** Модуль подключения библиотек для ajax операций 
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 //----------------------------------------------------------------- 
 @define('W_IS_AJAX_MODE_RUN', 1);
 //-----------------------------------------------------------------
 require_once dirname(__FILE__)."/engine.php";
 //header('Content-Type: text/plain; charset=utf-8');
 header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
 header("Last-Modified: " . gmdate( "D, d M Y H:i:s") . " GMT"); 
 header("Cache-Control: no-cache, must-revalidate"); 
 header("Pragma: no-cache");
 //-----------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>