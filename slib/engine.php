<?php
 /** Модуль подключения скрипта к проекту
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 @set_time_limit(90);
 @setlocale(LC_NUMERIC,"."); 
 
 //ini_set('display_errors',1);
 //error_reporting(E_ALL);
 
 //-----------------------------------------------------------------
 if (!defined('ISENGINEDSW')) { define('ISENGINEDSW', 1); }
 //-----------------------------------------------------------------
 if (!defined('SEOSCRIPTLIBPATHX')) { define('SEOSCRIPTLIBPATHX', dirname(__FILE__)); }
 if (!defined('SEOSCRIPTLIBPATHXFILES')) { define('SEOSCRIPTLIBPATHXFILES', SEOSCRIPTLIBPATHX."/files"); }
 if (!defined('STOPWORDSPATH')) { define('STOPWORDSPATH', SEOSCRIPTLIBPATHXFILES."/stopwords"); }
 if (!defined('SEOSCRIPTFONTSPATH')) { define('SEOSCRIPTFONTSPATH', SEOSCRIPTLIBPATHXFILES."/fonts"); } 
 //-----------------------------------------------------------------
 /** кодировка, в которой будут возвращаться и обрабатываться данные */
 if (!defined('SEOSCRIPTDEFENCODE')) { define('SEOSCRIPTDEFENCODE', 'UTF-8'); }
 //-----------------------------------------------------------------
 require_once SEOSCRIPTLIBPATHX."/modules/const.unit.lib.php";
 require_once SEOSCRIPTLIBPATHX."/modules/check.lib.php";
 require_once SEOSCRIPTLIBPATHX."/modules/cach.lib.php";
 //-----------------------------------------------------------------
 $_CONNECT_PACK_MODULES_LIST = array(
  /** список доступных настроек пакета, файлы настроек располагаются в каталоге /options/ */
  '/options/' => array(
   'stopwords.conf.php'        => 'Списки стоп-слов',
   'prepere_content.conf.php'  => 'Предварительная обработка контента страницы',
   'connect.conf.php'          => 'Внешние соединения пакета',
   'cach.conf.php'             => 'Глобальный кэш пакета',
   'plugins.conf.php'          => 'Параметры использования плагинов'  
  ),
  
  /** подключение дополнительных модулей (блок 1) */
  '/additional_modules/' => array(
   'idna_convert/idna_convert.class.php' => 'Конвертер кириллических доменов',
   
   //'google_pr/google.pr.class.php'       => 'Объект определения Google pr',
   'google_pr/google.pr2.class.php'       => 'Объект определения Google pr',
   
   'tcp_ping/tcp_ping.class.php'         => 'Объект ping',  
  ),
  
  /** инициализация системных модулей */
  '/modules/' => array(
   'common.lib.php' => 'system'
  ),
  
  /** подключение дополнительных модулей (блок 2) */
//  '/additional_modules/' => array(
//   'text_compere/compere.string.lib.php' => 'Процентное сравнение строк'  
//  ),  
  
  /** инициализация плагинов */
  '/plugins/' => array(
   'engines.options.plugin.php'  => 'Надстройки поисковиков',
   'engine.index.plugin.php'     => 'Плагины индексации сайта поисковиками',
   'engine.back.plugin.php'      => 'Плагины обратных ссылок с присковиков',
   'engine.indir.plugin.php'     => 'Плагины проверки наличия в каталогах',
   'engine.general.plugin.php'   => 'Плагины общих параметров сайта'
  )   
 );
 //-----------------------------------------------------------------
 foreach ($_CONNECT_PACK_MODULES_LIST as $path => $item) {	
  foreach ($item as $name => $descr) {	
   if (@file_exists(SEOSCRIPTLIBPATHX.$path.$name)) {
	require_once SEOSCRIPTLIBPATHX.$path.$name;	 
   }   	
  }  	
 }
 //-----------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>