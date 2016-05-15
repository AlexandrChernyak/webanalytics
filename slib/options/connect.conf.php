<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 //-----------------------------------------------------------------
 /** Модуль установки\управления настройками внешних запросов пакета
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 /* timeout соединения по умолчанию 
    может быть перекрыт при создании класса
 */
 define('SS_CONNECT_TIMEOUT_WS', 50);
 
 /* список mime типов страниц по умолчанию, которые могут быть обработаны
    может быть перекрыт при создании класса
 */
 $_SS_CONNECT_MIMETYPES_WS = array(
  'text/html', 'text/plain', 'text/richtext', 'text/xml', 'application/xml', 'application/x-javascript'
 ); 
 
 /* глобальный список возможных протоколов, которые считать внешним источником */
 $_SS_GLOBAL_PROTOCOL_LIST_WS = array('http','https','ftp','telnet','news','gopher','file','wais');
 
 /* использовать автоперекодирвоание url если на кириллице,
    имеет смысл если дополнительный модуль конвертации домена подключен в файле engine.php
    Также конвертирует указанный при запросе закодированный хост, пример если выполнять запрос
    адресом http://xn--d1abbgf6aiiy.xn--p1ai/ - в результате будет принят адрес http://президент.рф/
    и только перед внешним соединением - будет закодирован. 
 */
 define('SS_DO_AUTO_DECODE_ENCODE_PUNY_DOMAIN_WS', true);
 
 /* декодировать ссылки, экранированные через EncodeURL 
    Декодирует все элементы url, за исключением хоста сайта.
    Преабразует элементы, закодированные через EncodeURL в их раскодированные эквиваленты. 
    Работает как с закодированными utf-8 строками, так и кириллицей.
    Например строки:
    http://site.zone/%D0%BD%D0%BE%D0%B2%D0%BE%D1%81%D1%82%D0%B8/info.php или
    http://site.zone/%ED%EE%E2%EE%F1%F2%E8/info.php
    будут приняты как: 
    http://site.zone/новости/info.php
    может быть перекрыт при создании класса
    Если параметр установлен - кодирует ссылку в обратном направлении при отправке запроса.
 */
 define('SS_DODECODE_LINKS_FROM_ENCODEURL_WS', true);
 
 /* при запросах использовать куки, false или имя файла cookies (например: mycookies.txt и т.д) 
    может быть перекрыта при создании класса запросов
    
    пример:
    define('SS_USE_COOKIES_ON_QUERYES_WS', 'mycookiesdata.txt');
 */
 define('SS_USE_COOKIES_ON_QUERYES_WS', false);
 
 /* максимальное количество обходов редиректа */
 define('SS_MAX_REDIRECT_COUNT_WS', 20);
 
 /* файл сертификата по умолчанию (false или имя файла .crt)
    может быть перекрыта при создании класса запросов
 */
 define('SS_CAIINFO_USE_ON_QUERY_CONNECT_WS', false);
 
 /* Использовать прокси сервер(а) при внешних запросах
    может быть перекрыта при создании класса запросов
 */
 define('SS_USE_PROXY_CONNECT_INFO_WS', false);
 
 /* Метод получения прокси сервера для запроса
    Может быть передан из класса, в таком случае array(класс, 'метод')
    Если не использовать = false
    Пример:
    
    function GetNewProxy($obj) {
	 return false; //не активирует прокси
	 
	 return array(
	  'type'=> (если отсутствует или -1 = используется http пркоси) 
	           или тип прокси (CURLPROXY_SOCKS4 или CURLPROXY_SOCKS5)
	  'host'=> хост и порт прокси в формате (хост:порт) (!должен присутствовать!),
	           если отсутствует - прокси не активируется
	  'auth'=> имя пользователя и пароль для авторизации, не устанавливается если отсутствует
	           предоставляться в формате (логин:пароль)
	 );	 	
	}
	в функцию передается один параметр ($obj) - весь объект ss_ConnectQuery
    
    может быть перекрыта при создании класса запросов
 */
 $_SS_CONNECT_PROXY_GET_PROG_WS = false;
 //-----------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>