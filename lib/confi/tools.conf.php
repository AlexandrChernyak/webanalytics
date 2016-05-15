<?php
 /** Файл конфигурации инструментов
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */ 
 //-------------------------------------------------------------------------------------
 if (!defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //------------------------------------------------------------------------------------- 
 /* настройки инструментов
    формат:
	'идентификатор_инструмента' => array(
	 'enabled' => использовать ограничение (true или false) действует только для оплаты
	 'price'   => сумма в USD, формат 0.00
	 
	 'count'   => количество в ограниченном режиме (int) по умолчанию 10, < 0 - без ограничений
	 'sleep'   => задержка при проверки массовой в секундах, по умолчанию 0.4
	 'timeout' => время ожидания ответа (по умолчанию 50)
	)  
	** Значения по умолчанию определены в классах инструментов. **
 */
 $_TOOLSNOLIMITACTIVATIONDATAINFO = array(
  //массовая проверка доменов (не учитываются: timeout)
  'massdomcheck' => array(
   'descr'   => 'toolmasscheckdom',  
   'keywords'=> '', //идентификатор строки - ключевые слова (пусто - используются по умолчанию)
   'metadesc'=> '', //идентификатор строки - мета description (пусто - не используется) 
   'Ldescr'  => '', //'идентификатор_строки' - для указания описания инструмента, доступно во всех инструментах
   'tdescr'  => '', /* развернутое описание инструмента на странице инструмента, описывает идентификатор 
                       html текста, который будет отображаться на странице иснтрумента, Если пусто - будет 
					   отображаться стандартное описание инструмента, указанное в файле шаблона инструмента */
   'onlyforadmin' => false, //доступен только для админа (например при изминении)  
   'onlineonly' => false, //доступен только для авторизированных пользователей, доступно во всех инструментах   
   'enabled' => true,
   'price'   => 0.60,
   'sleep'   => 0.4 
  ),
  //массовая проверка скорости сайта
  'massurlspeedtest' => array(
   'descr'   => 'toolmassurlspeedt', //описание
   'keywords'=> '',
   'metadesc'=> '', 
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false,   
   'enabled' => true,
   'price'   => 0.60   
  ),
  //проверка редиректов сайта
  'urlredirectedl' => array(
   'descr'   => 'toolmassredirectge', //описание
   'keywords'=> '',
   'metadesc'=> '', 
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false,
   'enabled' => true,
   'price'   => 0.60,
   'timeout' => 35 
  ),
  //просмотр заголовков сайта
  'headersviewl' => array(
   'descr'   => 'toolheadersview', //описание
   'keywords'=> '',
   'metadesc'=> '', 
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false,
   'enabled' => true,
   'price'   => 0.83,
   'timeout' => 35,
   'count'   => 6 
  ),
  //ping \ tracerout (не учитываются: enabled, price, timeout, count)
  'pingtracerout' => array(
   'descr'    => 'toolpingtracerout',
   'keywords' => '',
   'metadesc' => '',
   'Ldescr'   => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false,
   'sleep'    => 0.4, //опционально, по умолчанию 0.3
   'maxsteps' => 6, //максимальное количество прыжков (опционально, по умолчанию - 5)
   'stepsel'  => 5 //выбрано по умолчанию прыжков (опционально, по умолчанию - 5)  
  ),
  //punycode конвертер (не учитываются:  timeout)
  'punycodeconv' => array(
   'descr'   => 'toolpunycodeconv',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false,
   'enabled' => true,
   'price'   => 0.4,
   'sleep'   => 0.3,
   'count'   => 12  
  ),
  //массовая проверка тиц пр
  'massprcy' => array(
   'descr'   => 'toolmassprcychecke',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false,
   'enabled' => true,
   'price'   => 0.6,
   'sleep'   => 0.4,
   'count'   => 6
  ),
  //проверка пр по датацентрам
  'prbydcgoogle' => array(
   'descr'   => 'toolgooglebydcchec',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false,
   'enabled' => true,
   'price'   => 0.6,
   'sleep'   => 0.6,
   'count'   => 5,
   'direct'  => '' //направление: DESC - по убыванию дат, '' по возрастанию дат добавления датацентра
  ),
  //стоимость ссылки с сайта
  'linkpriceget' => array(
   'descr'   => 'toolgetlinkprice', //описание
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false,
   'enabled' => true,
   'price'   => 0.5,
   'sleep'   => 0.4,
   'count'   => 4
  ),
  //анализ контента сайта
  'contentcheck' => array(
   'descr'          => 'toolcontentanalise', //описание
   'keywords'       => '',
   'metadesc'       => '',
   'Ldescr'         => '',
   'tdescr'         => '',
   'onlyforadmin'   => false,
   'onlineonly'     => false,
   'docachonget'    => true,  /* кэшировать и получать данные из кэша при открытии постоянной страницы анализа
                                 пример: /tool/contentcheck/forwebm.net  - данные кэшируются с интервалом в 5 дней */
   'docachonpost'   => false, /* использовать и принудительно обновлять кэш при пост проверке сайта, данные в кэше 
                                 будут постоянно обновляться при анализе с страницы анализа */
                                 
   'usehistory'     => true,  /* вести историю выполненных анализов инструментом */
   'historyperpage' => 15,     /* количество элементов на страницу в истории */
   
   'pagespeedapi' => '', //api ключ google page speed online
   'pagespeedapi-userip' => false, //использовать или нет проверку ограничения по IP
  ),
  //whois up сайта
  'whoisdomain' => array(
   'descr'          => 'toolgetwhoisdomain', //описание
   'keywords'       => '',
   'metadesc'       => '',
   'Ldescr'         => '',
   'tdescr'         => '',
   'onlyforadmin'   => false,
   'onlineonly'     => false,
   'usehistory'     => true,  /* вести историю выполненных анализов инструментом */
   'historyperpage' => 15     /* количество элементов на страницу в истории */
  ),
  //whois ip сайта
  'whoisurlip' => array(
   'descr'          => 'toolgetwhoisipurl', //описание
   'keywords'       => '',
   'metadesc'       => '',
   'Ldescr'         => '',
   'tdescr'         => '',
   'onlyforadmin'   => false,
   'onlineonly'     => false,
   'usehistory'     => true,  /* вести историю выполненных анализов инструментом */
   'historyperpage' => 15     /* количество элементов на страницу в истории */
  ),
  //анализ сайта
  'analysis' => array(
   'descr'          => 'toolurlsiteanalise', //описание
   'keywords'       => '',
   'metadesc'       => '',
   'Ldescr'         => '',
   'tdescr'         => '',
   'onlyforadmin'   => false,
   'onlineonly'     => false,
   'docachonget'    => true,  /* кэшировать и получать данные из кэша при открытии постоянной страницы анализа
                                 пример: /tool/analysis/forwebm.net  - данные кэшируются с интервалом в 5 дней */
   'docachonpost'   => true,  /* использовать и принудительно обновлять кэш при пост проверке сайта, данные в кэше 
                                 будут постоянно обновляться при анализе с страницы анализа */
                                 
   'usehistory'     => true,  /* вести историю выполненных анализов инструментом */
   'historyperpage' => 15,     /* количество элементов на страницу в истории */
   
   /* данные о предоставлении списка запросов топа по Яндекс Гугл */
   'usemegaindextop'=> false, /* отображать в топе по ключевым словам */
   'megaindexlogin' => '', //логин на www.megaindex.ru
   'megaindexpass'  => '', //пароль на www.megaindex.ru
   
   /* данные ведения истории изменения параметров */
   'enabledphistory'=> false, //вести историю
   'updatehistoryifexists' => true, //обновить запись истории, если такая дата уже есть
   'showonlyactualy' => true, //отображать только актуальные для текущей проверки значения
   'grathcount' => 0, //отображать на графике последние n проверок (0 - все проверки)
   
   
   'pagespeedapi' => '', //api ключ google page speed online
   'pagespeedapi-userip' => false, //использовать или нет проверку ограничения по IP
         
  ),
  //генератор ключевых слов с сайта
  'keygeneratorurl' => array(
   'descr'          => 'toolkeygeneratorurl', //описание
   'keywords'       => '',
   'metadesc'       => '',
   'Ldescr'         => '',
   'tdescr'         => '',
   'onlyforadmin'   => false,
   'onlineonly'     => false,
   'allwordsforuse' => 1000   /* Общее количество слов, которое следует обработать для выявления ключевых слов
                                 <= 0 - все слова */
  ),
  //генератор ключевых слов с текста
  'keygeneratortext' => array(
   'descr'          => 'toolkeygeneratortxt',
   'keywords'       => '',
   'metadesc'       => '',
   'Ldescr'         => '',
   'tdescr'         => '',
   'onlyforadmin'   => false,
   'onlineonly'     => false,
   'allwordsforuse' => 1000   /* Общее количество слов, которое следует обработать для выявления ключевых слов
                                 <= 0 - все слова */
  ),
  //зашифровка html
  'htmlcrapt' => array(
   'descr'         => 'toolhtmlcrapt',
   'keywords'      => '',
   'metadesc'      => '',
   'Ldescr'        => '',
   'tdescr'        => '',
   'onlyforadmin'  => false,
   'onlineonly'    => false,
   'maxcharscount' => 3200     /* максимальное количество символов для обработки, 0 - все (по умолчанию - все) */
  ),
  //сравнение строк
  'textcompere' => array(
   'descr'         => 'tooltextcompere',
   'keywords'      => '',
   'metadesc'      => '',
   'Ldescr'        => '',
   'tdescr'        => '',
   'onlyforadmin'  => false,
   'onlineonly'    => false,
   'maxcharscount' => 700      /* максимальное количество символов для сравнения текстов (0 - все) (по умолчанию - 0) */
  ),
  //генератор статических url
  'staturlgenerator' => array(
   'descr'       => 'toolstaturlgenerat',
   'keywords'    => '',
   'metadesc'    => '',
   'Ldescr'      => '',
   'tdescr'      => '',
   'onlyforadmin' => false,
   'onlineonly'  => false,
   'maxurlcount' => 30        /* максимальное количество страниц для обработки - по умолчанию 0, 0 - без ограничения */
  ),
  //извлечение e-mail
  'extractemails' => array(
   'descr'   => 'toolextractemails',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false,
   'enabled' => true,
   'price'   => 0.4,
   'sleep'   => 0.5,
   'count'   => 6  
  ),
  //извлечение ссылок
  'extractlinks' => array(
   'descr'   => 'toolextractlinks',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false,
   'enabled' => true,
   'price'   => 0.6,
   'sleep'   => 0.4,
   'count'   => 4  
  ),
  //проверка установленной ссылки
  'checklinktoback' => array(
   'descr'   => 'toolchecklinktobac',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false,
   'enabled' => true,
   'price'   => 0.8,
   'sleep'   => 0.5,
   'count'   => 4  
  ),
  //генератор favorit иконки
  'favoritgenerator' => array(
   'descr'        => 'toolfavoritgenerat',
   'keywords'     => '',
   'metadesc'     => '',
   'Ldescr'       => '',
   'tdescr'       => '',
   'onlyforadmin' => false,
   'onlineonly'   => false,
   'maximagesize' => 2048,     /* максимальный размер загружаемых изображений в Kb */
   'imagetypes'   => array(".gif", ".jpg", ".png", ".jpeg", ".ico") /* список допустимых типов изображений */
  ),
  //нанесение текста на иображение
  'texttoimage' => array(
   'descr'        => 'tooltexttoimage',
   'keywords'     => '',
   'metadesc'     => '',
   'Ldescr'       => '',
   'tdescr'       => '',
   'onlyforadmin' => false,
   'onlineonly'   => false,
   'maximagesize' => 2048,     /* максимальный размер загружаемых изображений в Kb */
   'imagetypes'   => array(".gif", ".jpg", ".png", ".jpeg") /* список допустимых типов изображений */
  ),
  //информер ip адреса
  'ipinformer' => array(
   'descr'             => 'toolipinformer',
   'keywords'          => '',
   'metadesc'          => '',
   'Ldescr'            => '',
   'tdescr'            => '',
   'onlyforadmin'      => false,
   'onlineonly'        => false,
   'updateeveryminute' => 4320,  /* обновлять данные через каждые (минут) 4320 = 3 дня */
   'updateifexistsinf' => false, /* обновлять информер при создании, если информер такого ip уже есть */
   'deleteoldaccminf'  => 5760,  /* удалять запись информера, если указанное кол-во минут 
                                    небыло запроса информера, 5760 = 4 дня, 0 - никогда не удалять */
   'checkfordeletels'  => 150    /* интервал проверки удаления устаревших записей, 0 - никогда не проверять
                                    150 минут = 2,5 часа */
  ),
  //информер pr cy
  'prcyinformer' => array(
   'descr'             => 'toolprcyinformer',
   'keywords'          => '',
   'metadesc'          => '',
   'Ldescr'            => '',
   'tdescr'            => '',
   'onlyforadmin'      => false,
   'onlineonly'        => false,
   'updateeveryminute' => 4320,  /* обновлять данные через каждые (минут) 4320 = 3 дня */
   'updateifexistsinf' => false, /* обновлять информер при создании, если информер такого сайта уже есть */
   'checkforurlexists' => false, /* создавать информеры только для существующих сайтов */
   'deleteoldaccminf'  => 5760,  /* удалять запись информера, если указанное кол-во минут 
                                    небыло запроса информера, 5760 = 4 дня, 0 - никогда не удалять */
   'checkfordeletels'  => 150    /* интервал проверки удаления устаревших записей, 0 - никогда не проверять
                                    150 минут = 2,5 часа */
  ),
  //информер скорости интернета
  'internetspeed' => array(
   'descr'             => 'toolinternetspeed', //описание
   'keywords'          => '',
   'metadesc'          => '',
   'Ldescr'            => '',
   'tdescr'            => '',
   'onlyforadmin'      => false,
   'onlineonly'        => false,
   'updateeveryminute' => 4320,  /* обновлять данные через каждые (минут) 4320 = 3 дня */
   'updateifexistsinf' => false, /* обновлять информер при создании, если информер такого ip уже есть */
   'deleteoldaccminf'  => 5760,  /* удалять запись информера, если указанное кол-во минут 
                                    небыло запроса информера, 5760 = 4 дня, 0 - никогда не удалять */
   'checkfordeletels'  => 150    /* интервал проверки удаления устаревших записей, 0 - никогда не проверять
                                    150 минут = 2,5 часа */
  ),
  //информация о браузере
  'browserinfo' => array(
   'descr'  => 'toolbrowserinfo', //описание
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //анализ ссылок
  'checkurllinks' => array(
   'descr' => 'toolcheckurllinks', // описание
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //сайт глазами поискового робота
  'robotslookurl' => array(
   'descr' => 'toolviewurlasrobot',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //получение ip сайта
  'getipsite' => array(
   'descr' => 'toolgetipsite',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //получение сервера сайта
  'getserver' => array(
   'descr' => 'toolgetserversite',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //гениратор мета тэгов
  'metagenerator' => array(
   'descr' => 'toolmetagenerator',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //гениратор ссылок
  'linkgenerator' => array(
   'descr' => 'toollinkgenerator',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //гениратор заголовков
  'titlegenerator' => array(
   'descr' => 'tooltitlegenerator',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //генератор robots.txt
  'robotsgenerator' => array(
   'descr' => 'toolrobotsgenerat',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //анализ текста
  'textanalisis' => array(
   'descr' => 'tooltextanalisis',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //encode decode url
  'encodedecodeurl' => array(
   'descr' => 'toolencodedecodeu',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //рашифровка текста
  'stringencrapted' => array(
   'descr' => 'toolstrencrapt',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //генератор паролей
  'passgenerator' => array(
   'descr' => 'toolpassgenerator',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //удаление дубликатов
  'norepeatlines' => array(
   'descr' => 'toolnorepeatlines',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //экранировнаие спец символов
  'encodespecchars' => array(
   'descr' => 'toolencodespecchar',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //транслит переводчик
  'stringtranslit' => array(
   'descr' => 'toolstringtranslit',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //упаковка js
  'javascriptpack' => array(
   'descr' => 'tooljavascriptpack',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //упаковка css
  'csspack' => array(
   'descr' => 'toolcsspack',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),
  //массовая проверка посещаемости сайта(ов)
  'massvischeck' => array(
   'descr'   => 'toolmassvischeck',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false,
   'enabled' => true,
   'price'   => 0.40,
   'timeout' => 35,
   'count'   => 8,
   'sleep'   => 0.4 
  ),
  //генератор опечаток слепой печати
  'typosinkeyboard' => array(
   'descr'   => 'toolstyposinkeyboard',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false,
   'maxcharscount' => 2000,
  ),
  //объединение изображений CSS Sprites 
  'cssspritesgen' => array(
   'descr'   => 'toolnamedcssspritesgen',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false,
   'maximagesize' => 100, /* максимальный размер загружаемых изображений в Kb */
   'maximagescount' => 30, /* максимальное кол-во изображений для загрузки */
  ), 
  //информер апдейтов
  'updatesinformer' => array(
   'descr'             => 'toolupdatesinformer',
   'keywords'          => '',
   'metadesc'          => '',
   'Ldescr'            => '',
   'tdescr'            => '',
   'onlyforadmin'      => false,
   'onlineonly'        => false,
   'updateeveryminute' => 4320,  /* обновлять данные через каждые (минут) 4320 = 3 дня */   
   'deleteoldaccminf'  => 5760,  /* удалять запись информера, если указанное кол-во минут 
                                    небыло запроса информера, 5760 = 4 дня, 0 - никогда не удалять */
   'checkfordeletels'  => 150    /* интервал проверки удаления устаревших записей, 0 - никогда не проверять
                                    150 минут = 2,5 часа */
  ),
  //base64 кодирование
  'base64encode' => array(
   'descr' => 'toolbase64encodedecode',
   'keywords'=> '',
   'metadesc'=> '',
   'Ldescr'  => '',
   'tdescr'  => '',
   'onlyforadmin' => false,
   'onlineonly' => false
  ),    
 );
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */  
?>