<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** Модуль предварительной проверки
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 
 if (!@function_exists('iconv')) exit(DoEncodeDataToDef(SS_ICONV_NO_FOUND));
 
 if (!@function_exists('curl_init')) exit(DoEncodeDataToDef(SS_CURL_NO_FOUND));
 
 if (!@function_exists('bcdiv')) exit('Function bcdiv not found!');
 
 if (!@class_exists('DOMDocument')) exit('Class DOMDocument not found!');
 
 //-----------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>