<?php
 /** Файл конфигурации панели оптимизатора
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */ 
 //-------------------------------------------------------------------------------------
 if (!defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 /*
   Предварительные параметры панели оптимизатора.
   Блок `лист` содержит список параметров, которые пользователь может создать работая с панелью оптимизатора.
   Все параметры снабжены комментариями только при необходимости и без повторения в 
   ранее описанных блоках.
 */ 
 $_SEOPANELCONFIGUREBLOCK = array(
  
  /** кол-во символов в коротком названии разделов (не менее 10, 3 последних символа обрезаются) */
  'shortsectionnamecount' => 30,
  
  /** разрешить доступ к панели только администратору проекта */
  'accessforadminonly' => false,
  
  
  
  /** --------------------------- список доступных параметров проверки панели оптимзатора ---------------------- */
  'list' => array(
   
   /* url сайта (имя блока определяет идентификатор параметра) */
   'url' => array(
    //параметр недоступен пользователю для использования
    'disabled' => 0,
    //создавать при первом запуске панели
    'default' => 1,
    //ширина ячейки по умолчанию (для url используется min-width) 
    'width' => '120px',
    //тиц результата значения (0-число, 1-строка, 2-изображение, 3-блок управления)
    'type' => 1,
    //идентификатор плагина для выполнения
    'pluginid' => '',
    /* путь для получения значения строкового из результата плагина (разделитель `точка`) 
	   например: pageinfo.host (будет идентично как: $result['pageinfo']['host'])
	   Если пусто - использует прямой результат плагина
	*/
	'pluginvaluepath' => '',
	//цвет фона таблици (в hex формате, например: #FF0000)
	'bgcolor' => '',
	//название колонки по умолчанию (указывается идентификатор строки ресурсов)
	'name' => 'defurltdname:paramname',
	'align' => 'left',
	//разрешить перенос строк
	'canwrap' => 0	
   ),
   
   /* Яндекс ТиЦ */
   'id_cy_value' => array(
    'disabled'        => 0,
    'default'         => 1,
    'width'           => '140px',
    'type'            => 0,
    'pluginid'        => SS_YANDEXCY,
    //параметры выполнения плагина, могут отсутствовать - тогда передаваться не будут
    'pluginparams'    => array(),
    'pluginvaluepath' => 'value',
    'bgcolor'         => '',
    'name'            => 'p_id_cy_value:paramname',
    /* цвет значения в списке, если пусто - по умолчанию */
    'color'           => '',
    /* цвет положительного отклонения, если пусто - по умолчанию */
    'colorplus'       => '#008000',
    /* цвет отрицательного отклонения, если пусто - по умолчанию */
    'colorminus'      => '#FF0000',
	/* задержка перед проверкой */
	'sleep'           => 0.4,
	'align'           => 'center',
	'canwrap'         => 0,
	'nodisplaydiff'   => 0,
	//ссылка для ручного просмотра
	'linktoview'      => 'ss_BlockConstantValue::YANDEX_CY_RESULT'   
   ),
   
   /* Google PR */
   'id_pr_value' => array(
    'disabled'        => 0,
    'default'         => 1,
    'width'           => '100px',
    'type'            => 0,
    'pluginid'        => SS_GOOGLEPR,
    'pluginvaluepath' => 'value',
    'bgcolor'         => '',
    'name'            => 'p_id_pr_value:paramname',
    'color'           => '',
    'colorplus'       => '#008000',
    'colorminus'      => '#FF0000',
    'sleep'           => 0.4,
    'align'           => 'center',
    'canwrap'         => 0,
    'nodisplaydiff'   => 0,
    'linktoview'      => ''
   ),
   
   /* Яндекс каталог */
   'id_yaca_dir_value' => array(
    'disabled'        => 0,
    'default'         => 1,
    'width'           => '100px',
    'type'            => 0,
    'pluginid'        => SS_INDIRYANDEX,
    'pluginvaluepath' => '',
    'bgcolor'         => '',
    /* возвращать результат как Да\Нет */
    'returnasstring'  => 1, 
    /* цвет Да */
    'coloryes'        => '#666699',
    /* цвет Нет */
    'colorno'         => '#808000',    
    'name'            => 'id_yaca_dir_value:paramname',
    'color'           => '',
    'colorplus'       => '#008000',
    'colorminus'      => '#FF0000',
    /* не показывать отклонение (только для числовых значений) */
    'nodisplaydiff'   => 0,
    'sleep'           => 0.4,
    'align'           => 'center',
    'canwrap'         => 0,
    'linktoview'      => 'ss_Plugin_InDirYandex::LINK_QUERY'
   ),
   
   /* DMOZ каталог */
   'id_dmoz_dir_value' => array(
    'disabled'        => 0,
    'default'         => 1,
    'width'           => '100px',
    'type'            => 0,
    'pluginid'        => SS_INDIRDMOZ,
    'pluginvaluepath' => '',
    'bgcolor'         => '',
    'returnasstring'  => 1, 
    'coloryes'        => '#666699',
    'colorno'         => '#808000',
    'name'            => 'id_dmoz_dir_value:paramname',
    'color'           => '',
    'colorplus'       => '#008000',
    'colorminus'      => '#FF0000',
    'nodisplaydiff'   => 0,
    'sleep'           => 0.4,
    'align'           => 'center',
    'canwrap'         => 0,
    'linktoview'      => 'ss_Plugin_InDirDMOZ::LINK_QUERY'
   ),
   
   /* Индекс Яндекс */
   'id_yandexindex_value' => array(
    'disabled'        => 0,
    'default'         => 1,
    'width'           => '160px',
    'type'            => 0,
    'pluginid'        => SS_INDEXYANDEX,
    'pluginvaluepath' => '',
    'bgcolor'         => '',
    'name'            => 'id_yandexindex_value:paramname',
    'color'           => '',
    'colorplus'       => '#008000',
    'colorminus'      => '#FF0000',
    'sleep'           => 0.4,
    'align'           => 'center',
    'canwrap'         => 0,
    'nodisplaydiff'   => 0,
    'linktoview'      => 'ss_Plugin_IndexYandex::LINK_QUERY',
    
    //http://yandex.ru/yandsearch?text=host%3Aforwebm.net
    /* данные для доступа к Яндекс.XML Если параметры установены - использует их, если не установлены
       либо использует глобальные параметры Яндекс.XML всей панели (если установлены) или не использует
	*/
    'yxmllogin'       => '',
    'yxmlkey'         => '',
    //позволяет включить, отключить использование Яндекс.XML без удаления данных от Я.xml
    'nouseyandexxml'  => 0,
    //источник данных
    'valuefromserv'   => 1, //0-Яндекс, 1 - search.tut.by
    
    /* глобальный параметр Яндекс.XML (если пользовательские не используются - 
       используется как по умолчанию, если сам установлен, если нет - будут прямыезапросы к яндексу
       - черевато блокировкой ip)
    */
    'adminxmllogin'   => 'test',
    'adminxmlkey'     => 'test',     
   ),
   
   /* Индекс Google */
   'id_googleindex_value' => array(
    'disabled'        => 0,
    'default'         => 1,
    'width'           => '160px',
    'type'            => 0,
    'pluginid'        => SS_INDEXGOOGLE,
    'pluginvaluepath' => '',
    'bgcolor'         => '',
    'name'            => 'id_googleindex_value:paramname',
    'color'           => '',
    'colorplus'       => '#008000',
    'colorminus'      => '#FF0000',
    'sleep'           => 0.4,
    'align'           => 'center',
    'canwrap'         => 0,
    'nodisplaydiff'   => 0,
    'linktoview'      => 'ss_Plugin_IndexGoogle::LINK_QUERY'
   ), 
   
   /* Индекс yahoo */
   'id_yahooindex_value' => array(
    'disabled'        => 0,
    'default'         => 0,
    'width'           => '160px',
    'type'            => 0,
    'pluginid'        => SS_INDEXYAHOO,
    'pluginvaluepath' => '',
    'bgcolor'         => '',
    'name'            => 'id_yahooindex_value:paramname',
    'color'           => '',
    'colorplus'       => '#008000',
    'colorminus'      => '#FF0000',
    'sleep'           => 0.4,
    'align'           => 'center',
    'canwrap'         => 0,
    'nodisplaydiff'   => 0,
    'linktoview'      => 'ss_Plugin_IndexYahoo::LINK_QUERY'
   ),
   
   /* Индекс Bing */
   'id_bingindex_value' => array(
    'disabled'        => 1,
    'default'         => 0,
    'width'           => '160px',
    'type'            => 0,
    'pluginid'        => SS_INDEXBING,
    'pluginvaluepath' => '',
    'bgcolor'         => '',
    'name'            => 'id_bingindex_value:paramname',
    'color'           => '',
    'colorplus'       => '#008000',
    'colorminus'      => '#FF0000',
    'sleep'           => 0.4,
    'align'           => 'center',
    'canwrap'         => 0,
    'nodisplaydiff'   => 0,
    'linktoview'      => 'ss_Plugin_IndexBing::LINK_QUERY'
   ),
   
   /* ссылок с Яндекс */
   'id_yandexback_value' => array(
    'disabled'        => 1,
    'default'         => 0,
    'width'           => '160px',
    'type'            => 0,
    'pluginid'        => SS_BACKYANDEX,
    'pluginvaluepath' => '',
    'bgcolor'         => '',
    'name'            => 'id_yandexback_value:paramname',
    'color'           => '',
    'colorplus'       => '#008000',
    'colorminus'      => '#FF0000',
    'sleep'           => 0.4,
    'align'           => 'center',
    'canwrap'         => 0,
    'nodisplaydiff'   => 0,
    'linktoview'      => 'ss_Plugin_BackYandex::LINK_QUERY',
    'yxmllogin'       => '',
    'yxmlkey'         => '',
    'nouseyandexxml'  => 0,
    'valuefromserv'   => 1, //0-Яндекс, 1 - search.tut.by, 2-specpoisk.ru
    
    /* глобальный параметр Яндекс.XML (если пользовательские не используются - 
       используется как по умолчанию, если сам установлен, если нет - будут прямыезапросы к яндексу
       - черевато блокировкой ip)
    */
    'adminxmllogin'   => 'test',
    'adminxmlkey'     => 'test',
   ),
   
   /* ссылок с Google */
   'id_googleback_value' => array(
    'disabled'        => 1,
    'default'         => 0,
    'width'           => '160px',
    'type'            => 0,
    'pluginid'        => SS_BACKGOOGLE,
    'pluginvaluepath' => '',
    'bgcolor'         => '',
    'name'            => 'id_googleback_value:paramname',
    'color'           => '',
    'colorplus'       => '#008000',
    'colorminus'      => '#FF0000',
    'sleep'           => 0.4,
    'align'           => 'center',
    'canwrap'         => 0,
    'nodisplaydiff'   => 0,
    'linktoview'      => 'ss_Plugin_BackGoogle::LINK_QUERY'
   ),
   
   /* ссылок с Yahoo */
   'id_yahooback_value' => array(
    'disabled'        => 1,
    'default'         => 0,
    'width'           => '160px',
    'type'            => 0,
    'pluginid'        => SS_BACKYAHOO,
    'pluginvaluepath' => '',
    'bgcolor'         => '',
    'name'            => 'id_yahooback_value:paramname',
    'color'           => '',
    'colorplus'       => '#008000',
    'colorminus'      => '#FF0000',
    'sleep'           => 0.4,
    'align'           => 'center',
    'canwrap'         => 0,
    'nodisplaydiff'   => 0,
    'linktoview'      => 'ss_Plugin_BackYahoo::LINK_QUERY'
   ),
   
   /* ссылок с Bing */
   'id_bingback_value' => array(
    'disabled'        => 1,
    'default'         => 0,
    'width'           => '160px',
    'type'            => 0,
    'pluginid'        => SS_BACKBING,
    'pluginvaluepath' => '',
    'bgcolor'         => '',
    'name'            => 'id_bingback_value:paramname',
    'color'           => '',
    'colorplus'       => '#008000',
    'colorminus'      => '#FF0000',
    'sleep'           => 0.4,
    'align'           => 'center',
    'canwrap'         => 0,
    'nodisplaydiff'   => 0,
    'linktoview'      => 'ss_Plugin_BackBing::LINK_QUERY',
   ),    
   
   /* Alexa */
   'id_alexarank_value' => array(
    'disabled'        => 0,
    'default'         => 0,
    'width'           => '160px',
    'type'            => 0,
    'pluginid'        => SS_ALEXARANK,
    'pluginvaluepath' => 'value',
    'bgcolor'         => '',
    'name'            => 'id_alexarank_value:paramname',
    'color'           => '',
    'colorplus'       => '#FF0000',
    'colorminus'      => '#008000',
    'sleep'           => 0.4,
    'align'           => 'center',
    'canwrap'         => 0,
    'nodisplaydiff'   => 0,
    'linktoview'      => 'ss_Plugin_GenAlexaRank::LINK_QUERY',
   ),   
   
   /* изображение счетчика LiveInternet */
   'id_liveinternet_value' => array(
    'disabled'        => 0,
    'default'         => 1,
    'width'           => '100px',
    'type'            => 2,
	'imagefile'       => 'http://counter.yadro.ru/logo;[url_real_host]?25.1',
	//ширина и высота изображения, пусто - не устанавливаются
	'imageheight'     => '',
	'imagewidth'      => '',	
	'name'            => 'id_liveinternet_value:paramname',
	'align'           => 'center',
	'canwrap'         => 0,
	'linktoview'      => 'ss_BlockConstantValue::LIVEINTERNET_RESULT'
   ),
   
   /* --------------------------------- v1.4.4 begin --------------------------------- */
   /* Google PageSpeed Online */
   'id_pagespeed_online' => array(
    'disabled'        => 0,
    'default'         => 1,
    'width'           => '140px',
    'type'            => 0,
    'pluginid'        => SS_PAGESPEEDONLINE,
    'pluginvaluepath' => 'score',
    'pluginparams'    => array(
      'ignorecach' => 1, //не кэшировать данные
      'key' => '', //api код от google для pageSpeed Online
      'ref' => 'http://'.W_HOSTMYSITE //host сайта, должен быть добавлен в список рефереров у googl 
    ),
    'showdiffdays'    => 1,    
    'bgcolor'         => '',
    'name'            => 'id_pagespeed_online:paramname',
    'color'           => '',
    'colorplus'       => '#008000',
    'colorminus'      => '#FF0000',
    'sleep'           => 0.4,
    'align'           => 'center',
    'canwrap'         => 0,
    'linktoview'      => 'https://developers.google.com/pagespeed/#url=[url_link]&mobile=false',
    'ifemptydata'     => 'n/a',
    //прификс справа от значения
    'right-t'         => '%'
   ), 
   
   /* кол-во ссылок на домен */
   'id_linkstodomain_p' => array(
    'disabled'        => 0,
    'default'         => 0,
    'width'           => '140px',
    'type'            => 0,
    'pluginid'        => SS_SOLOMONOPLUGIN,
    'pluginvaluepath' => 'hin',
    'showdiffdays'    => 1,    
    'bgcolor'         => '',
    'name'            => 'id_linkstodomain_p:paramname',
    'color'           => '',
    'colorplus'       => '#008000',
    'colorminus'      => '#FF0000',
    'sleep'           => 0.4,
    'align'           => 'center',
    'canwrap'         => 0,
    'linktoview'      => '',
    'ifemptydata'     => 'n/a'
   ),
   
   /* кол-во доноров */
   'id_donorscount_p' => array(
    'disabled'        => 0,
    'default'         => 0,
    'width'           => '140px',
    'type'            => 0,
    'pluginid'        => SS_SOLOMONOPLUGIN,
    'pluginvaluepath' => 'din',
    'showdiffdays'    => 1,    
    'bgcolor'         => '',
    'name'            => 'id_donorscount_p:paramname',
    'color'           => '',
    'colorplus'       => '#008000',
    'colorminus'      => '#FF0000',
    'sleep'           => 0.4,
    'align'           => 'center',
    'canwrap'         => 0,
    'linktoview'      => '',
    'ifemptydata'     => 'n/a'
   ),
   
   /* кол-во внешних ссылок на сайте */
   'id_outlinkscount_p' => array(
    'disabled'        => 0,
    'default'         => 0,
    'width'           => '140px',
    'type'            => 0,
    'pluginid'        => SS_SOLOMONOPLUGIN,
    'pluginvaluepath' => 'hout',
    'showdiffdays'    => 1,    
    'bgcolor'         => '',
    'name'            => 'id_outlinkscount_p:paramname',
    'color'           => '',
    'colorplus'       => '#008000',
    'colorminus'      => '#FF0000',
    'sleep'           => 0.4,
    'align'           => 'center',
    'canwrap'         => 0,
    'linktoview'      => '',
    'ifemptydata'     => 'n/a'
   ),      
   /* --------------------------------- v1.4.4 end --------------------------------- */   
   
   /* домен продлен до */
   'id_domain_expire' => array(
    'disabled'        => 0,
    'default'         => 1,
    'width'           => '140px',
    'type'            => 1,
    'pluginid'        => SS_WHOISDOMAINEX,
    'pluginvaluepath' => 'expdate',
    'pluginparams'    => array('expdate' => 1, 'cashonlythis' => 1),
    /* показывать отклонение */
    'showdiffdays'    => 1,    
    'bgcolor'         => '',
    'name'            => 'id_domain_expire:paramname',
    'color'           => '',
    'colorplus'       => '#0000FF',
    'colorminus'      => '#FF0000',
    //ставить цвет плюс на минус, если осталось дней
    'swithifdayslost' => 3,
    'sleep'           => 0.4,
    /* формат вывода даты, если пусто - как есть */
    'dateformat'      => 'id_dateformat:paramname',
    'align'           => 'center',
    'canwrap'         => 0,
    'linktoview'      => 'ss_BlockConstantValue::DOMAINEXPIRE_RESULT_WHDM',
    //отображать если пустое значение
    'ifemptydata'     => 'n/a'
   ),       
   
   /* дата обновления */
   'dateupdated' => array(
    'disabled'        => 0,
    'default'         => 1,
    'width'           => '100px',
    'type'            => 1,
    'bgcolor'         => '',
    'name'            => 'id_dateupdate_value:paramname',
    'color'           => '',
    /* отображать кол-во дней с последнего обновления */
    'showdiffdays'    => 1,
	'colorplus'       => '#FF0000',
    'colorminus'      => '#0000FF',
    'dateformat'      => 'id_dateformat:paramname',
    'align'           => 'center',
    'canwrap'         => 0
   ),
   
   /* кнопки управления */
   'controlpanel' => array(
    'disabled'        => 0,
    'default'         => 1,
    'width'           => '100px',
    'type'            => 3,
    'bgcolor'         => '',
    'name'            => 'controlpanel:paramname',
    'align'           => 'center',
    'canwrap'         => 0
   ),
  )
 ); 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */  
?>