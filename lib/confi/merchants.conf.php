<?php
 /** Файл конфигурации приема среств в проекте
 * @author [Eugene]
 * @copyright 2012
 * @url http://forwebm.net
 */ 
 //-------------------------------------------------------------------------------------
 if (!defined('W_ENGINED_L')) exit('Can`t access to this file data!');
  
  
  
 /** для www.roboxchange.com ******************************************************* */
 define('W_USEROBOXCHANGEPAYPROCESS', false);
 $_ROBOXCHANGEPAYLISTDATA = array(
  'login'  => 'логин',             //логин в системе
  'pass'   => 'пароль №1',  //пароль в интерфейсе инициализации оплаты #1
  'pass2'  => 'пароль №2',  //пароль оповещения #2
  'sumdef' => 5.00,                  //сумма по умолчанию
  'mtype'  => 'WMZM',                //тип валюты по умолчанию
  'test'   => true                  //тестовый режим
 );  
 /*
 Вход в кабинет мерчанта: https://auth.roboxchange.com/Auth/Login.aspx
 
 Result URL: - http://адрес_проекта/presdata/robox_result_query.php
 Success URL: - http://адрес_проекта/account/payhistory/&status=success&t=robox
 Fail URL: - http://адрес_проекта/account/payhistory/&status=fail&t=robox 
 */
 
 /** для webmoney merchant ******************************************************** */
 define('W_USEWEBMONEYMERCHANT', false);
 $_WEBMONEYMERCHANTLISTDATA = array(  
  
  'enabled' => false, //включено для всех, или только для админа
  'demo' => true, //тестовый режим - определяется в настройках на сайте webmoney
  
  //кашельки для оплаты
  'USDDATA' => 'Z000000000000', //usd счет
  'RURDATA' => 'R000000000000', //rur счет
   
  //данные мерчанта
  'usd_secret' => 'секретный-пароль-для-usd', //секрет для usd счета
  'rur_secret' => 'секретный-пароль-для-rur',  //секрет для rur счета
  
  //курс доллара к рублю по сайту
  'RF_CURS' => 30, 
  
  //wmid
  'WMID' => '000000000000'
 );
 
 /* https://merchant.webmoney.ru/conf/purses.asp
 Result URL: - http://адрес_проекта/paydata/wmuplfl.php
 Success URL: - http://адрес_проекта/account/payhistory/&status=success&t=webmoney
 Fail URL: - http://адрес_проекта/account/payhistory/&status=fail&t=webmoney 
 */
   
 
 
 
 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2012 forwebm.net */  
?>