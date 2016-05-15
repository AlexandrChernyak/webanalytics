<?php
 /** Файл конфигурации динамических данных, переменные (изменяемых в админке)
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */ 
 //-------------------------------------------------------------------------------------
 if (!defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 /*
  список констант, определяемых в административном разделе сайта.
  Содержат названия констант и их тип, заведомо должен быть определен идентификатор описания.
  Константа не должна быть установлена до этого файла, проверка установки стандартного значения
  константы выполняется в файле dinamic.conf.php
  
  Тип `string` определяет список добавленных в админке `мультиязычных` идентификаторов строк, для 
  установки непосредственно строки - используйте тип `stringex` 
 */ 
 $_GLOBALDINAMICCONSTOPTIONS = array(  
  /** заголовок по умолчанию */
  'W_DEFAULTDOMAINTITLE' => array(
   'type' => 'string'
  ),
  /** ключевые слова по умолчанию */
  'W_DEFAULTKEYWORDS' => array(
   'type' => 'string'
  ),
  /** мета description */
  'W_DEFAULTDOMAINDESCRIPTION' => array(
   'type' => 'string'
  ),
  /** формат даты-времени по умолчанию, */
  'W_DATETIMEDEFAULTFORMAT' => array(
   'type' => 'string'
  ),
  /** формат отображения даты по умолчанию */
  'W_DATEDEFAULTFORMAT' => array(
   'type' => 'string'
  ),
  /** формат отображения дат в апдейтах на страницах сайта */
  'W_ADMENGINEUPDATESFORMATVIEW' => array(
   'type' => 'string'
  ),
  /** формат даты новостей сайта в списке на главной странице */
  'W_SITENEWSDATETIMEFORMATONHOST' => array(
   'type' => 'string'
  ),
  /** разрешить регистрацию новых пользователей */
  'W_CANBEREGISTERED' => array(
   'type' => 'boolean'
  ),
  /** html код `видимого` счетчика посещаемости сайта */
  'W_HTMLCODEVISIBLECOUNTER' => array(
   'type' => 'string'
  ),
  /** html код `НЕ видимых` счетчиков посещаемости сайта */
  'W_HTMLCODEINVISIBLECOUNTER' => array(
   'type' => 'string'
  ),
  /** HTML код, отображаемый в правой части сайта, `блоком новостей` */
  'W_HTMLCODERIGHTDOWNBLOCK' => array(
   'type' => 'string'
  ),
  /** HTML код, отображаемый в левой части сайта, следующий за (ниже) `блоком основного меню` */
  'W_HTMLCODELEFTDOWNBLOCKAFTMENU' => array(
   'type' => 'string'
  ),
  /** HTML код, отображаемый в верхней, центральной части сайта */ 
  'W_HTMLCODETOPCENTERBLOCK' => array(
   'type' => 'string'
  ),
  /** HTML код, отображаемый перед подвалом сайта */
  'W_HTMLCODEDOWNCENTERBLOCK' => array(
   'type' => 'string'
  ),
  /** автоматически пополнять апдейты google pr, если возвожно */
  'W_AUTOCREATEPRUPDATESLIST' => array(
   'type' => 'boolean'
  ) 
 );
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */  
?>