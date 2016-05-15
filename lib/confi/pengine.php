<?php
 /** Распределение путей каталогов, предварительные настройки
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 //-------------------------------------------------------
 if (!@defined('SEO_TOOLS_SIMPLY_CONNECT')) {
  session_start();
  @mb_internal_encoding('UTF-8');
  header('Content-Type: text/html; charset=UTF-8');
 }
 //-------------------------------------------------------
 define('W_ENGINED_L', 1);
 //-------------------------------------------------------
 /*
  Использовать проект как каталог существующего сайта.
  Если необходимо установить проект как каталог на уже действующий сайт - указать полный путь 
  до каталога проекта (без слэшей на концах), пример: site-analysis
  К примеру проект устанавливается в каталог: site.com/seo-tools-path/ В таком случае необходимо указать:
   define('W_USEASPATHSERVER', 'seo-tools-path');
  если каталог вложенный (например site.com/seo-tools-path/project-path/), указать
   define('W_USEASPATHSERVER', 'seo-tools-path/project-path');
  Если проект устанавливается в корневую директорию домена, поддомена - оставте пустым. 
 */
 define('W_USEASPATHSERVER', '');  
 /* Каталог сайта для файловых операций внутри сервера */
 define('W_SITEDIR', $_SERVER['DOCUMENT_ROOT'].((W_USEASPATHSERVER) ? '/'.W_USEASPATHSERVER : ''));
 /* Корень сайта для внешних путей */
 define('W_SITEPATH', '/'.((W_USEASPATHSERVER) ? W_USEASPATHSERVER.'/' : ''));
 //-------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */ 
?>