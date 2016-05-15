<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /**
 * Модуль констант 
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
/*   
    элементы идентификаторов стандартного набора плагинов.
    Пример вызова:
    $http = new ss_HTTP_obj();
    $http->SetURL('forwebm.net');
    
    $params = array(
     'createddate' => 1,
     'expdate'     => 1,
     'registrar'   => 1
    );
    
    if ($http->RunPluginEx2(SS_WHOISDOMAINEX, $error, $value, $cachedDate, $params)) {
	  print_r($value);
      
      //if ($cachedDate) {
      //print "Кэшировано, последнее обновление - $cachedDate";
      //}
      
    } else {
     print 'Error: '.$error;	
    }
    
 Параметры, учитывающиеся во всех плагинах 
 
 Параметр 'ignorecach' => 1 при передачи в любой плагин - отключает использование кэша для текущего выполнения плагина
 Параметр 'dodeletecachonread' => 1 при передачи - очистит кэш если есть записи принудительно перед чтением, после чего 
                            заново выполнит получение данных
 
 Параметр 'dorequsturl' => 1 - будет выполнено обращение к сайту (к GetConnect()->url_self) (по умолчанию - 0)
 Параметр 'dorequsturlmetchod' - определяет метод запроса для параметра 'dorequsturl' может быть одним из
                            GET, POST, HEAD - по умолчанию - GET
 Параметр 'dorequsturlpostfields' - определяет данные для POST запросе, если параметр 'dorequsturlmetchod' = POST
                            по умолчанию = ''
 
 стандартный набор плагинов
 */
 $_GLOBAL_CONST_PLUGIN_IDS_LIST = array(
 'SS_INDEXYANDEX' => 'IndexYandex', //индек ЯНДЕКС (int)
 
 'SS_INDEXYANDEXIMAGES' => 'IndexYandexImages', /*
  индекс изображений по Яндексу
  return int
 
 */
 
 'SS_URLADRESSBYYANDEXGEO' => 'URLOrganizationAdressBYandex', /*
  адрес организации по Яндексу
  return (string) адрес или пусто
 
 */
 
 'SS_YANDEXCACHEINFO' => 'GetYandexCacheLinkData', /*
  кэш яндекса (требует включенную опцию Y.xml), не кэшируется.
  
  return array(
   'indexed' => число, сколько проиндексированно страниц
   'cachedlink' => ссылка на кэш страницы
  )  
 */
 
 'SS_INDEXGOOGLE' => 'IndexGoogle', //индек GOOGLE 
 'SS_INDEXGOOGLEIMAGES' => 'IndexGoogleImages', //индекс картинок на сайте по Google (int)
 
 'SS_GOOGLECACHDATE' => 'GoogleCachedDocDate', /*
  дата сохраненной в кэше версии страницы
  
  return (string) Y-m-d H:i:s 
 */
 
 'SS_INDEXYAHOO' => 'IndexYahoo', //индек YAHOO
 'SS_INDEXRAMBLER' => 'IndexRambler', //индек RAMBLER
 'SS_INDEXBING' => 'IndexBing', //индек BING
 
 /* стандартный набор плагинов обратных ссылок */
 'SS_BACKYANDEX' => 'BackYandex', //обратные с Яндекс
 'SS_BACKYANDEXBLOGS' => 'BackYandexBlogs', //обратные с Яндекс блогов 
 'SS_BACKGOOGLE' => 'BackGoogle', //обратные с Google
 'SS_BACKYAHOO' => 'BackYahoo', //обратные с Yahoo
 'SS_BACKRAMBLER' => 'BackRambler', //обратные (ДОКУМЕНТЫ + САЙТЫ) с Rambler (return array('docs','sites'))
 'SS_BACKBING' => 'BackBing', //обратные с Bing
 'SS_BACKALTAVISTA' => 'BackAltaVista', //обратные с AltaVista
 
 /* стандартный набор плагинов проверки наличия в каталогах */
 'SS_INDIRYANDEX' => 'InDirYandex', //в каталоге Яндекс
 'SS_INDIRFROMYANDEX' => 'InDirFromYandex', //сайты в каталоге Яндекс, которые ссылкаются на сайт
 'SS_INDIRDMOZ' => 'InDirDMOZ', //в каталоге dmoz
 'SS_INDIRRAMBLERTOP100' => 'InDirRamblerTop100', //в каталоге rambler top 100 (return array('sites', 'resources'))
 'SS_INDIRMAIL' => 'InDirMail', //в каталоге mail.ru
 'SS_INDIRAPORT' => 'InDirAport', //в каталоге aport (return array('docs','sites') ) 
 
 /* стандартный набор плагинов общего назначения */
 'SS_YANDEXCY' => 'GenYandexCY', /*
  Яндекс ТиЦ (return array(
   'image_with_www' = картинка с www
   'image_without_www' = картинка без www
   'value' = значение тиц
   'rang' = ранг
   'yacacatalog' = описание в каталоге
   'comperewww' = true - если склеен с www, false - если нет
   'regionurl' = регион если есть, или отсутствует или пусто
   )) 
 */
 'SS_GOOGLEPR' => 'GenGooglePR', /*
  Google PR 
  Может принимать параметры:
  array('датацентр', 'еще', 'и так далее')
  Если плагину переданы параметры - параметры должны содержать массив датацентров,
  из которых выбирать сервер для проверки.
  
  Результат:
  (return array(
   'value' = значение
   'host' = откуда получен
   'time' = время ответа
  ))
 */
 'SS_ALEXARANK' => 'GenAlexaRank', /*
  alexa rank (return array(
   'value' = значение
   'graph' = ссылка на изображение графика
  ))
  плагин может принимать параметры:
  array(
  'h'=> высота графика (по умолчанию 100)
  'w'=> ширина графика (по умолчанию 180)
  )
 */
 'SS_WHOISDOMAIN' => 'GenWhoisDomain', //WHOIS владельца домена сайта
 'SS_WHOISDOMAINEX' => 'GenWhoisDomainEx', /* WHOIS владельца домена с получением параметров
  может принимать параметры:
  array(
   'data' => если есть - будет пропарсен данный текст, иначе получен whois заново
   'createddate' => 1 - будет включено дата регистрации домена
   'expdate' => 1 - будет включена дата окончания регистрации домена
   'registrar' => 1 - будет получена информация о регистраторе домена
   'cashonlythis' => 1 - будет кэшироваться только пропарсенная информация, без двойного кэширования
   'status' => 1 - будет добавлена информация о статусе
   'owner' => 1 - будет извлечена информация о владельце домена
  )
  Возвращает:
  return array(
   'source' => вся whois информация
   
   'createddate' => дата регистрации (может отсутствовать)
   'domainold' => возраст домена полностью (если есть createddate)
   'old_days' => возраст домена в днях (если есть createddate)
   
   'expdate' => дата окончания регистрации (может отсутствовать)
   'pass' => осталось дней до окончания регистрации домена (если есть expdate)
   
   'registrar' => регитсратор (может отсутствовать)
   'status' => статус (может отсутствовать) 
   'owner' => владелец (может отсутствовать)  
  )
 */
 'SS_WHOISIP' => 'GenWhoisIP', //WHOIS владельца ip сайта
 'SS_DOMAINSCOUNTONIP' => 'GenDomainsOnIP', //количество сайтов на ip
 'SS_GEOLOCALEIP' => 'GenGeoLocaleIP', /* локализация ip
 Может принимать параметры:
 array(
  'ip' => ip для анализа, если отсутствует или параметров нет - берет ip сайта
 )
 
 Возвращает:
 return Array
 (
    [geoplugin_city] => 
    [geoplugin_region] => 
    [geoplugin_areaCode] => 0
    [geoplugin_dmaCode] => 0
    [geoplugin_countryCode] => RU
    [geoplugin_countryName] => Russian Federation
    [geoplugin_continentCode] => AS
    [geoplugin_latitude] => 60
    [geoplugin_longitude] => 100
    [geoplugin_regionCode] => 
    [geoplugin_regionName] => 
    [geoplugin_currencyCode] => RUB
    [geoplugin_currencySymbol] => &#1088;&#1091;&#1073;
    [geoplugin_currencyConverter] => 30.0097015897
 )
 */
 'SS_LINKPROCEFROMSITE' => 'GenLinkPriceWUV', /* цена ссылки с сайта
 Определяет цену ссылки по тиц, пр и с учетом ув.
 Может принимать параметры:
 array(
  'cy' => тиц (может отсутствовать, тогда будет получен для сайта)
  'pr' => пр (может отсутствовать, тогда будет получен для сайта)
  'uv' => если отсутствует - будет равным 1, иначе от 1 до 3
  
  'tousd' => если 1 - сумма будет выдана с учетом долларов (по умолчанию - 1)
  'usprice' => сумма 1 доллара (по умолчанию = 30)
  'rto' => округлять до знаков после запятой (по умолчанию = 2)
 )
 
 Возвращает число. 
 */
 'SS_PAGELINKSLIST' => 'GenPageLinksList', /* ссылки со страницы
  Обрабатывает и выводит все ссылки со страницы.
  Может принимать параметры.
  array(
   'fetch_proc' => процедура для проверки ссылки (и\или дополнительной обработки)
                   может принимать и метод класса в виде array('object', 'metchodname')
                   представляет собой конструкцию вида:
                   function имя_($plugin, $parser, $originallink, $correctlink, $typelink, $text, $innoindex, $nofollow) {
				    return 
				     0 - прервать извлечение ссылок
				     1 - принять ссылку и продолжить
				     2 - пропустить ссылку и продолжить						
				   }
				   $plugin - класс плагина (наследник от ss_Plugin_obj)
				   $parser - объект ss_HTMLTagParser, выполняющий анализ ссылок
				   $originallink - ссылка в оригенале взятая со страницы
				   $correctlink - обработанная(приведенная к полному пути) ссылка (с протоколом)
				   $typelink - тип ссылки, один из:
				    SS_IK_LINK_ERROR    (неверная)
					SS_IK_LINK_INSIDE   (внутренняя)
					SS_IK_LINK_OUTSIDE  (внешняя)
					SS_IK_LINK_SUBDOM   (на поддомен)
				  $text - текст ссылки
				  $innoindex - true если находится в тэге noindex
				  $nofollow - true если имеет значение nofollow в параметре rel
				  	
   'source' => если присутствует - содержит текст для парсинга
   'ignoreresh' => 1 -  игнорировать ссылки с # (по умолчанию 0)
   'getonlyhost' => 0 - не принимать ссылки без протокола, но с текущим хостом (по умолчанию - 1)
   'ignoredoubled' => 0 - не пропускать дубликаты ссылок (по умолчанию - 1)
   
   'noinside' => 1 - не собирать внутренние ссылки (по умолчанию - 0)
   'nooutside' => 1 - не собирать внешние ссылки (по умолчанию - 0)
   'nosubdom' => 1 - не собирать ссылки на поддомены (по умолчанию - 0)
   
   'strip_tags_in_text' => 0 - html тэги останутся в тексте ссылки (по умолчанию - 1)
   
   'usestrongregext' => 1 - если использовать для парсинга регулярки в любом случае (по умолчанию - 0)
   'checknoindex' => 1 - проверять скрытие в тэге noindex (по умолчанию - 1)
   checknofol => 1 - проверять запрет nofollow (по умолчанию - 1)
  )
  
  Возвращает массив:
  array(
   'errors' => список ссылок поврежденных
   'inside' => внутренние
   'outside' => внешние
   'subdom' => на поддомены
   
   'inside_info' => array(
    'index' => количество индексируемых
    'noindex' => количество не индексируемых
    'all' => всего ссылок
   )
   'outside_info' => as inside_info
   'subdom_info'  => as inside_info
  ) 
  Каждый из списков содержит список массивов
  array(
   'href' => Оригинальная ссылка
   'href_full' => Полная ссылка (с протоколом и доменом)
   'text' => Текст ссылки
   'noindex' => true если в тэге noindex
   'nofollow' => true если есть параметр nofollow
  )
 */
 'SS_PAGEIMAGESLIST' => 'GenPageImagesList', /* Получение изображений с текста
  Принимает следующие параметры:
  array(
   'fetch_proc' => идентична плагину SS_PAGELINKSLIST, но принимает дополнительно 2 параметра:
                   function имя_($plugin, $parser, $originallink, $correctlink, $typelink, $alt, $width, $height) {
                   если $width или $height или $alt отсутствует - вместо них передается false
   'ignoredoubled' => идентично плагину SS_PAGELINKSLIST
   'source' => идентично плагину SS_PAGELINKSLIST
   'usestrongregext' => идентично плагину SS_PAGELINKSLIST
   'noinside' => идентично плагину SS_PAGELINKSLIST
   'nooutside' => идентично плагину SS_PAGELINKSLIST
   'nosubdom' => идентично плагину SS_PAGELINKSLIST  
  )
 
 Возвращает массив:
  array(
   'errors' => список изображений поврежденных
   'inside' => внутренние
   'outside' => внешние
   'subdom' => на поддомены  
  ) 
  Каждый из списков содержит список массивов
  array(
   'src' => Оригинальная ссылка
   'src_full' => Полная ссылка (с протоколом и доменом)
   
   'alt' => Текст (может отсутстовать если нет параметра alt)
   'width' => ширина указанная (может отсутстовать если нет параметра width)
   'height' => высота указанная (может отсутстовать если нет параметра height) 
  )
 */
 'SS_TCPPINGACTION' => 'ActionTCPPing', /*
  ping указанного сайта
  Принимает следующие параметры:
  array(
   'host'  => хост куда отсылать запросы, если нет - используется текущий активный
   'count' => количество прыжков, по умолчанию 5
   'sleep' => задержка между запросами, по умолчанию нет
  )
  
  Возвращает массив:
  array(
   'time' => время в миллисекундах
   'to'   => ip, куда шли запросы
   'obj'  => весь объект пинга
   'tl'   => порядковый номер прыжка
  ) 
 */
 'SS_CONTENTANALIZE' => 'ActionContentAnalize', /*
  анализ контента
  Принимает следующие параметры:
  array(
   //список тэгов, чье содержимое получать (просто содержимое)
   'gettagssource' => array(
     'имя_тэга_или_уникальный_идентификатор' => array(
     
      'id' => если существует - должен содержать уникальный идентификатор блока информации о тэге в результатирующем массиве
     
      'name'   => имя тэга на случай, если есть одинаковые имена
	  'ones'   => 1 - одиночный тэг (как <img >), 0 - двойной (как <a></a>)
	  
	  'action' => 0 - не анализировать, просто получить содержимое, 1 - проанализировать тэг
	  'separ'  => разделитель слов в тэге (только если action)
	  
	  //только если одиночный тэг ('ones')
	  'nameValue' => string or array of string
	  'nameAttr'  => string or array of string - идентификатор имени тэга (например: <meta здесь_имя="значение">)
	  'valueAttr' => string or array of string - значение(я) идентификаторов имен, пример: <meta name="здесь значение">
	  
	 )
   ),
   
   'keywordsbyspace' => 1 - разделитель ключевых слов пробел, 0 - запятая (по умолчанию - 0)
      
  )
  
  Возвращает массив:
  array(
   
   информация о сайте
   'pageinfo' => array(
	  'size'            => размер страницы
	  'time'            => время загрузки
	  'speed'           => скорость загрузки
	  'encode'          => кодировка страницы
	  'ip'              => ip сайта
	  'text'            => текс страницы без тэгов
	  'textnostopwords' => текст страници без тэгов и стоп слов
	  'charscount'      => всего символов, вместе с html тэгами
	  'textcount'       => количество символов только текста страницы
	  'textnospace'     => текст контента без пробелов
	  'nospcount'       => длина текста без пробелов
	  'compereto'       => доля текста без тэгов к всему содержимому страницы (в процентах 0.00)
	  'linkcheck'       => анализируемая страница
	  'linknorot'       => анализируемая страница без протокола
	  'redirectto'      => перенаправление на
	  'host'            => хост сайта
	  'htmldata'        => html код с экранированными тэгами
	  'headresponse'    => ответ сервера
    )
    
   текст страницы
   'contentinfo' => array(
     'wordslist' => список слов в формате 
	 [слово_нижний_регистр] => array(
	   'word'       => слово,
	   'tfherz'     => частота (TF),
	   'inputs'     => вхождений
	   'intitle'    => в заголовке (title) (1 или 0)
	   'inkeywords'	=> в ключевых словах (keywords) (1 или 0)   
	 )
	 'stopwordscount'           => количество стоп-слов
	 'stopwordslist'            => список стоп-слов в тексте
	 'wordscount'               => количество слов (без стоп-слов)
	 'allwordscount'            => всего слов (и стоп-слов и нет)
	 'wordsnorepeatnostopwords' => слов без повтором и стоп-слов	 
   )
   
   заголовок (title) (отсутствует, если на странице нет тэга <title>)
   'titleinfo' => array(
    'tagname'                  => имя тэга
    'text'                     => текст заголовка исходный
    'textclear'                => текст без отформатированный под перебор слов
    'textnostopwords'          => текст без стоп-слов
    'allwordscount'            => всего слов в заголовке включая стоп-слова
    'stopwordscount'           => количество стоп-слов
    'stopwordslist'            => список стоп-слов в тексте
    'wordscount'               => всего слов в тексте
    'wordsnorepeatnostopwords' => слов без повторов и стоп-слов
    'fullplotnost'             => общая плотность всех слов к контенту
	'relevanttocontent'        => релевантность к контенту (в процентах)
	'fullrepeatincontent'      => общее количество повторов в контенте (количество слов с вхождением)
	'wordscountinrepeatin'     => количество слов в тэге с количеством повторов больше 1   
     //список слов
    'wordslist' => список слов, формат:
     [слово_нижний_регистр] => array(
	  'word'              => слово
	  'inputs'            => вхождений в тэге
	  'plotnost'          => плотность относительно контента
	  'tfherz'            => частота (TF)
	  'inputs_in_content' => повторов в контенте страницы	  	  
	 )	    
   )
   
   ключевые слова (отсутствует, если их нет на странице (нет тэга, если тэг пустой - будет выполнен анализ))
   'keywordsinfo' => идентично titleinfo
   
   //по параметрам переданным перед выполнением
   
   //получение только содержимого тэга (отсутствует если тэга нет)----------------- start
   'tag_имятэга' => array(
    'name' => имя тэга
    'data' => содержимое тэга
   )
   если тэг одиночный - имя тэга строится по критерию:
   tag_ + имя тэга + 
   $params['имя_тэга']['nameValue'] - если строка 
   - то (+ $params['имя_тэга']['nameValue']), если массив
   - то + implode('', $params['имя_тэга']['nameValue'])
   //получение только содержимого тэга (отсутствует если тэга нет)----------------- end
   
   //анализ содержимого тэга (отсутствует если тэга нет)----------------- start
   'tag_имятэга' => идентично titleinfo
   имя тэга строится по тамуже критерию, что и при только получении содержимого   
   //анализ содержимого тэга (отсутствует если тэга нет)----------------- and
  ) 
 */
 'SS_SITESTATISTICSLI' => 'ActionLIstatSite', /* Статистика посещаемости сайта по Live Internet
  Возвращает массив
  return array(
   'LiDayStatistic'   => посетителей в сутки
   'LiToDayStatistic' => посетителей за сегодня
   'LiWeekStatistic'  => посетителей в неделю
   'LiMonthStatistic' => посетителей в месяц
  )
  вернет array() - если сайт не зарегитсрирован в LI
 */ 
 
 
 'SS_URLANALIZE' => 'ActionURLAnalize', /* анализ сайта
    
  Возвращает массив:
  array(
   
   информация о сайте
   'pageinfo' => array(
	  'size'            => размер страницы
	  'time'            => время загрузки
	  'speed'           => скорость загрузки
	  'encode'          => кодировка страницы
	  'ip'              => ip сайта
	  'redirectto'      => перенаправление на
	  //'redirlist'       => список перенаправлений 
	  'host'            => хост сайта
	  'realhost'        => закодированный хост сайта
	  'htmldata'        => html код с экранированными тэгами
	  'headresponse'    => ответ сервера
	  'title'           => заголовок
	  'keywords'        => ключевые слова
	  'h1tag'           => тэг h1
	  'description'     => описание
	  'server'          => сервер сайта
	  'servergeo'       => страна расположения сервера сайта
	  'robots'          => файл robots.txt
	  'res_server'      => сервер хостинга
	  'getmoneyfromb'   => сколько можно заработать на бирже
    )
    //информация о Яндекс тиц
    'cyvalue' => array(
      'image_with_www' = картинка с www
      'image_without_www' = картинка без www
      'value' = значение тиц
      'rang' = ранг
      'yacacatalog' = описание в каталоге
      'comperewww' = true - если склеен с www, false - если нет	
	),
	//информация о Google pr
	'prvalue' => array(
      'value' = значение
      'host' = откуда получен
      'time' = время ответа	
	),
	//alexa rang
	'alexavalue' => array(
      'value' = значение
      'graph' = ссылка на изображение графика	
	),
	//статистика посещений по Live Internet (array() - если сайт не числится в статистике)
	'LIvalue' => array(
      'LiDayStatistic'   => посетителей в сутки
      'LiToDayStatistic' => посетителейза сегодня
      'LiWeekStatistic'  => посетителей в неделю
      'LiMonthStatistic' => посетителей в месяц	
	),
	//
  ) 
 */
 'SS_KEYWORDSGENERATOR' => 'ActionKeywordsGenerator', /* Генератор ключевых лов
  Принимает следующие параметры:
  array(
   'ignorestopwords' => 1 - игнорировать стоп-слова (по умолчанию - 0)
   'source' => '' - текст, из которого генерировать слова (по умолчанию с контента сайта)
   'getfrombody' => 1 - текст будет получен из тэга <body>, или весь текст (по умолчанию - 1)
   'separator' => ', ' - разделитель ключевых слов (по умолчанию - ', ')
   'usecount' => 18 (количество слов, которое нужно сгенерировать), по умолчанию - 18
   'minlenght' => 3 - минимальная длина слова (по умолчанию - 3)
   'allcount' => 1000 - количество слов для анализа (0 - все слова, по умолчанию - 1000)
  )
  
  Возвращает массив:
  return array(
   'result' => '' - текст, результат генерации ключевых слов
   'wordscount' => - всего слов в тексте
   'wordsnorepeat' => - всего слов в тексте без повторов после обработки
   'wordslist' => список слов в формате:
   [] => array(
    'word'    => слово
    'inputs'  => вхождений
    'freg'    => частота слова tf
   )   
  ) 
 
 */
  'SS_TEXTANALISISACTION' => 'ActionTextanalisis', /* Анализатор ключевых слов
  Принимает следующие параметры:
  array(
   'source' => '' - текст для анализа
   'ignorestopwords' => 1 - игнорировать стоп-слова (по умолчанию - 0)
  )
  
  Возвращает массив:
  return array(
   'wordscount' => - всего слов в тексте
   'wordsnorepeat' => - всего слов в тексте без повторов
   'stopwordscount' => всего стоп-слов
   'stopwordslist' => список стоп-слов array(слово, слово)
   'allcharscount' => всего символов
   'allcharscount_nospaces' => всего символов без пробелов
   'correctedsource' => текст без тэгов и лишних символов
   'textnostopwords' => текст без стоп-слов
   'textnorepeatandstopwords' => текст без повторов и стоп-слов
   'resultlenght' => символов вобработанном тексте
   'allcharsnospacesandbreaks' => количество символов без пробелов и переносов строк
   
  ) 
 
 */
 
 'SS_URLINTOPBYKEYWORDS' => 'URLinTOPbyKeywords', /* В топе по ключевым словам
  Принимает следующие параметры:
  array(
   'url'      => если не установлен, используется сайт GetConnect()->url_real_host
   'date'     => дата
   'login'    => логин на megaindex.ru
   'password' => пароль на megaindex.ru
   
   //включение следующих параметров добавляет в результат соответствующие параметры,
   //по умолчанию данные параметры возвращаются пустыми 
   'wordstat'  => false, //показов в месяц по яндексу wordstat.yandex.ru
   'wordstat2' => false, //кол-во запросов в Yandex за месяц по данным direct.yandex.ru
   'jump_li'   => false, //число переходов на страницы по данным liveinternet.ru
   'price'     => false  //Стоимость - Оценочная стоимость продвижения сайта в первую 10-ку результатов поиска
  )
  
  Возвращает массив:
  array(
   //общие данные ответа
   'resultfor' => array(
    'report' => string тип репорта (siteAnalyze),
    'url'    => сайт, для которого произведен анализ,
    'date'   => используемая дата
   ),
   
   //результат
   'result' => array(
    [] = array(
	 'word'       => запрос,
	 'pos_y'      => позиция сайта по запросу в Yandex
	 'pos_g'      => позиция сайта по запросу в Google
	 'vis'        => видимость сайта (в %) по данному запросу в различных поисковых системах
	 'show_month' => показов за месяц
	 'wordstat'   => показов в месяц по яндексу wordstat.yandex.ru
	 'wordstat2'  => кол-во запросов в Yandex за месяц по данным direct.yandex.ru
	 'jump_li'    => число переходов на страницы по данным liveinternet.ru
	 'price'      => Оценочная стоимость продвижения сайта в первую 10-ку результатов поиска
	)  
   ), 
   
  ) 
 */
 
 'SS_PAGESPEEDONLINE' => 'GooglePageSpeedOnline', /*
  выполнение Google PageSpeed Online (скорость загрузки указанной страницы) + остальные показатели скорости
  загрузки страницы
  
  принимает следующие параметры:
  array(
   'url' => страница для проверки (если нет - страница запроса)
   'userIp' => может принимать ip для ограничения доступа
   'key' => google api key
   'additionalparams' => 'если есть передает дополнительные параметры запроса в url',
   'ref' => реферрер. Если false - пусто, если не существует - сам url запроса  
  )
  
  возвращает массив:
  return array(
   'score' => числовое значение от 0 до 100 - скорость загрузки страницы общая (процент),
   "numberResources" => всего ресурсов,
   "numberHosts" => хостов,
   "totalRequestBytes" => всего размер запроса в байтах,
   "numberStaticResources" => всего статичных ресурсов,
   "htmlResponseBytes" => размер html кода страницы в байтах,
   "cssResponseBytes" => общий размер css ресурсов вбайтах,
   "imageResponseBytes" => общий размер изображений на страницах в байтах,
   "javascriptResponseBytes" => размер js ресурсов в байтах,
   "otherResponseBytes" => размер остальных ресурсов в байтах,
   "numberJsResources" => всего js ресурсов,
   "numberCssResources" => всего css ресурсов на странице
  
  
  
  ); 
 */
 
 'SS_SOLOMONOPLUGIN' => 'SolomonoDataPlugin', /*
  Выполняет анализ данных по http://solomono.ru/ с использованием их xml api
  Принимает параметры:
  array(
   'url' => сайт для првоерки, если нет - использует сайт запроса
  )
  
  возвращает данные:
  return array(
   'host' => имя хоста, для которого выводятся данные
   'index' => кол-во проиндексированных страниц
   'index_date' => дата последнего обновления
   'mr' => кол-во зеркал домена
   'ip' => кол-во доменов на том же IP
   'hin' => кол-во ссылок на домен
   'hin_l1' => кол-во ссылок на домен 1 уровень вложенности
   'hin_l2' => кол-во ссылок на домен 2 уровень вложенности
   'hin_l3' => кол-во ссылок на домен 3 уровень вложенности
   'hin_l....'
   
   'din' => кол-во доноров
   'din_l1' => кол-во доноров 1 уровня вложенности
   'din_l2' => кол-во доноров 2 уровня вложенности
   'din_l3' => кол-во доноров 3 уровня вложенности
   'din_l....'
   
   'hout' => исходящие (внешние) ссылки домена
   'hout_l1' ..... 'hout_l...'
   
   'dout' => кол-во получателей (доменов, на которые ссылается данный хост)   
   'anchors' => кол-во найденных анкоров
   'anchors_out' => кол-во исходящих анкоров
   'igood' => iGood доноров 
  )
 */
 
 'SS_MAJESTICSEOGENERALINFO' => 'GeneralMajesticseoInfo', /*
  данные от сайта majesticseo.com
  
  Принимает параметры:
  array(
   'url' => сайт для првоерки, если нет - использует сайт запроса
  )
  
  возвращает данные:
  return array(
    [ItemNum] => 0
    [Item] => forwebm.net
    [ResultCode] => OK
    [Status] => Found
    [ExtBackLinks] => 13984
    [RefDomains] => 1340
    [AnalysisResUnitsCost] => 13984
    [ACRank] => -1
    [ItemType] => 1
    [IndexedURLs] => 9514
    [GetTopBackLinksAnalysisResUnitsCost] => 5000
    [DownloadBacklinksAnalysisResUnitsCost] => 25000
    [RefIPs] => 953
    [RefSubNets] => 681
    [RefDomainsEDU] => 0
    [ExtBackLinksEDU] => 0
    [RefDomainsGOV] => 0
    [ExtBackLinksGOV] => 0
    [RefDomainsEDU_Exact] => 0
    [ExtBackLinksEDU_Exact] => 0
    [RefDomainsGOV_Exact] => 0
    [ExtBackLinksGOV_Exact] => 0
    [CrawledFlag] => False
    [LastCrawlDate] =>  
    [LastCrawlResult] =>  
    [RedirectFlag] => False
    [FinalRedirectResult] =>  
    [OutDomainsExternal] => 0
    [OutLinksExternal] => 0
    [OutLinksInternal] => 0
    [LastSeen] =>  
    [Title] => 
    [RedirectTo] =>  
    [Reserved1DoNotUse] => 0
    [Reserved2DoNotUse] => 0
    [Reserved3DoNotUse] => 0
    [Reserved4DoNotUse] => 0
    [Reserved5DoNotUse] => 0
  ) 
  
  Описание данных результата:
  http://translate.google.ru/translate?sl=en&tl=ru&js=n&prev=_t&hl=ru&ie=UTF-8&layout=2&eotf=1&u=http%3A%2F%2Fdeveloper-support.majesticseo.com%2Fapi%2Fcommands%2Fget-index-item-info.shtml&act=url
  
 */
 
 'SS_MIRRORLISTENELEMENTS' => 'GetURLHostMirrorsListElem', /*
  получения списка зеркал указанного хостинга (по учету кол-ва полученных зеркал)
  
  params = array(
   'url' => 'сайт или пусто\отсутствует, если пусто - основной сайт'
  )
  
  return array(
   'url',
   'url',
   '...'
  ) - список сайтов.
 
 
 */
 
 ); 
 foreach ($_GLOBAL_CONST_PLUGIN_IDS_LIST as $pname => $pid) {
   @define($pname, $pid);  
 }
 //-----------------------------------------------------------------
 /** перекодировка данных из utf-8 в указанную активную кодировку */
 function DoEncodeDataToDef($Data) {
  if (SEOSCRIPTDEFENCODE == 'UTF-8') { return $Data; }		
  return (@is_array($Data)) ? @array_map('DoEncodeDataToDef', $Data) : @iconv("UTF-8", SEOSCRIPTDEFENCODE, $Data);
 }//DoEncodeDataToDef
 //-----------------------------------------------------------------
 /** перекодировка данных из указанной кодировки в utf-8 */
 function DoDecodeDataToDef($Data) {
  if (SEOSCRIPTDEFENCODE == 'UTF-8') { return $Data; }		
  return (@is_array($Data)) ? @array_map('DoDecodeDataToDef', $Data) : @iconv(SEOSCRIPTDEFENCODE, "UTF-8", $Data); 
 }//DoEncodeDataToDef 
 //-----------------------------------------------------------------
 /* константы */
 if (!defined('SS_USERAGENTDATASET')) {
  define('SS_USERAGENTDATASET', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.2) Gecko/20070219 Firefox/2.0.0.2');
 }
 //-----------------------------------------------------------------
 /* errors */
 if (!defined('_SS_ERROR_NO_EXISTS')) { 
   define('_SS_ERROR_NO_EXISTS', 'I think, site is missing or not available!'); 
 }
 
 $_SS_ERROR_BY_CODE = array(
  "400" => "400 Испорченный Запрос, Bad Request.",
  "401" => "401 Несанкционированно, Unauthorized.",
  "402" => "402 Требуется оплата, Payment Required.",
  "403" => "403 Запрещено, Forbidden.",
  "404" => "404 Не найден, Not Found.",
  "405" => "405 Метод не дозволен, Method Not Allowed.",
  "406" => "406 Не приемлем, Not Acceptable.",
  "407" => "407 Требуется установление подлинности через прокси-сервер, Proxy Authentication Required.",	
  "408" => "408 Истекло время ожидания запроса, Request Timeout.",
  "409" => "409 Конфликт, Conflict.",
  "410" => "410 Удален, Gone.",
  "411" => "411 Требуется длина, Length Required.",
  "412" => "412 Предусловие неверно, Precondition Failed.",
  "413" => "413 Объект запроса слишком большой, Request Entity Too Large.",
  "414" => "414 URI запроса слишком длинный, Request-URI Too Long.",
  "415" => "415 Неподдерживаемый медиа тип, Unsupported Media Type.",
	 
  "500" => "500 Внутренняя ошибка сервера, Internal Server Error.",
  "501" => "501 Не реализовано, Not Implemented.",
  "502" => "502 Ошибка шлюза, Bad Gateway.",
  "503" => "503 Сервис недоступен, Service Unavailable.",
  "504" => "504 Истекло время ожидания от шлюза, Gateway Timeout.",
  "505" => "505 Не поддерживаемая версия HTTP, HTTP Version Not Supported.",
	 
  "17"  => "--- Тип запрашиваемой страницы не соответствует разрешенным!, Type requested page does not match the resolution!"  
 );
 
 define('SS_ICONV_NO_FOUND', 'Библиотека iconv не найдена!, iconv not found!');
 define('SS_CURL_NO_FOUND', 'Библиотека cURL не найдена!, cURL not found!');
 define('SS_NO_INITIALIZE_URL_TO_CONNECT', 'Не установлен url для запроса!');
 define('SS_ERROR_SET_URL_TO_CONNECT', 'Ошибка установки url для запроса!');
 define('SS_ERROR_GET_OWNER_OBJ_DATA', 'Error get owner object');
 
 
 $_SS_ERROR_YANDEX_XML_BY_CODE = array(
  '1'  => 'Синтаксическая ошибка — ошибка в языке запросов',
  '2'  => 'Задан пустой поисковый запрос — элемент query не содержит данных',
  '18' => 'Ошибка в XML-запросе — проверьте валидность отправляемого XML и корректность параметров',
  '19' => 'Заданы несовместимые параметры запроса — проверьте корректность группировочных атрибутов',
  '20' => 'Неизвестная ошибка — при повторяемости ошибки обратитесь к разработчикам с описанием проблемы',
  '31' => 'Пользователь не зарегистрирован на сервисе — проверьте, что запросы отправляются от лица правильного пользователя',
  '32' => 'Лимит запросов исчерпан — увеличьте лимит запросов, став партнёром Рекламной Сети Яндекса',
  '33' => 'Запрос пришёл с IP-адреса, не входящего в список разрешённых — настройте правильный IP-адрес',
  '34' => 'Пользователь не зарегистрирован в Яндекс.Паспорте — проверьте, что запросы отправляются от лица правильного пользователя',
  '37' => 'Неверное значение параметра запроса — проверьте полноту и корректность отправляемых вами параметров запроса',
  '42' => 'Ключ неверен — проверьте, что вы используете правильный адрес для совершения запросов, выданный вам на странице настроек',
  '43' => 'Версия ключа неверна — скопируйте со страницы настроек новый адрес для совершения запросов и используйте его',
  '44' => 'Данный адрес для совершения запросов больше не поддерживается — используйте адрес, выданный вам на странице настроек' 
 );  	
 //-----------------------------------------------------------------
 /* идентификатор методов */
 $do_mb_typed = 0; 
 if (2 == (@ini_get('mbstring.func_overload') & 2)) { $do_mb_typed = 1; } else if (@function_exists('mb_strlen')) { $do_mb_typed = 2; }
 switch ($do_mb_typed) { 
  case 1 : $do_mb_typed = 'mb_orig_'; break;
  case 2 : $do_mb_typed = 'mb_'; break;
  default: $do_mb_typed = ''; break;
 }
 if (!defined('_SS_STR_IDENT_FUNC')) { define('_SS_STR_IDENT_FUNC', $do_mb_typed); } 
 //-----------------------------------------------------------------
 define('SS_IK_LINK_ERROR', 0); //ошибка в ссылке
 define('SS_IK_LINK_INSIDE', 1); //ссылка внутренняя
 define('SS_IK_LINK_OUTSIDE', 2); //ссылка внешняя
 define('SS_IK_LINK_SUBDOM', 3); //ссылка на поддомен 
 //-----------------------------------------------------------------
 /* список описаний mime типов */
 $_SS_GLOBAL_MIME_TYPES_DESCR = array(
  'image/fif'=>'.fif', 
  'image/gif'=>'.gif',
  'image/ief'=>'.ief',
  'image/jpeg'=>'.jpeg',
  'image/png'=>'.png',
  'image/tiff'=>'.tif',
  'image/vasa'=>'.mcf',
  'image/x-cmu-raster'=>'.ras',
  'image/x-freehand'=>'.fhc',
  'image/x-ico'=>'.ico',
  'image/x-jps'=>'.jps',
  'image/x-portable-anymap'=>'.pnm',
  'image/x-portable-bitmap'=>'.pbm',  
  'image/x-portable-graymap'=>'.pgm',
  'image/x-portable-pixmap'=>'.ppm',
  'image/x-rgb'=>'.rgb',
  'image/bitmap'=>'.bmp'
 );
 //-----------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */ 
?>