<?php
 /** Модуль строк русского языка
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 class w_language_obj {
  private $control = null;	
  protected
   $data = array(
    /* v1.4.4 */
    'id_pagespeed_online:paramname' => 'Page Speed',
    'id_linkstodomain_p:paramname' => 'Ссылок на домен',
    'id_donorscount_p:paramname' => 'Кол-во доноров',
    'id_outlinkscount_p:paramname' => 'Внешних ссылок',
    
    'toolopt_pagespeedapi' => "Api код Google PageSpeed Online (если пусто - блок не используется!)",
    'toolopt_pagespeedapi-userip' => "Использовать в блоке Google PageSpeed Online ограничения по IP (передается параметр userIp для дальнейшего ограничения по параметрам аккаунта в Google)",
    
    
    
    /* v1.4.3 */
    'toolbase64encodedecode' => 'Base64 кодирование текста',
    
    /* v1.4.1 */
    'toolupdatesinformer' => "Информеры апдейтов поисковых машин",   
   
    /* v1.4.0 */
    'W_HTMLCODELEFTDOWNBLOCKAFTMENU_dsc' => "HTML код, отображаемый в левой части сайта, следующий за (ниже) `блоком основного меню`",
    'admtoolsimagesdescrtext' => 'Иконки инструментов',
    'toolconfigureopticons'  => "Иконки `[%s]`",
    'toolnamedcssspritesgen' => 'CSS Sprites - объединение изображений',
    'toolopt_maximagescount' => "<label id='red'>*</label> Максимальное кол-во изображений для загрузки (объединения)",
    'admadmusersgroupstext' => 'Группы пользователей',
    'admfilescontroltext' => 'Управление вложением',
    'nospecifiedidentfiles' => 'Не определен идентификатор группы файлов!',
    'nospecifiedidentfilesid' => 'Не определен идентификатор объекта вложения или указан некорректный ID!',
    'recordstitlenamed' => 'Записи',
    'recordstitlenamedpers' => 'Отдельные страницы',
    'payfilesdescriptionhistory' => 'Оплата скачивания файла [@s]',
    'administatorsgroupZ' => 'Администраторы', //название группы админов - все пользователи в группе с этим названием будут иметь права администратора проекта
    'administatorsgroupZdescr' => 'Администраторы',
    'downloadingfiledata' => 'Загрузка файла [[%s]]',
    'errorindownloadfile' => 'Произошла ошибка при получении доступа к файлу! Возможно у Вас нет прав на скачивание данного файла!',
    'subjdownloadfiledata' => 'Копия файла [[%s]] на сайте [[%s]]',
    'bodydownloadfiledata' => "Вы скачали файл [[%s]], предоставляемый на платной основе!\r\nКопия файла была Выслана Вам на e-mail, указанный в аккаунте.\r\n\r\nКопия файла приложена к письму!\r\n",
    'admbunnerscontroltext' => 'Показ баннеров на сайте',
    'setalinktobannerfile' => 'Укажите ссылку на файл баннера (ссылка на изображение или flash ролик)',
    'setalinktohrefdataf' => 'Укажите ссылку, на которую необходимо перейти, нажимая на баннер!',
    'bannocorrectcountlook' => 'Укажите желаемое кол-во показов баннера (не меньше 100, значение должно быть числовое)',
    'pricebannerlookcount' => 'Баннер в [[%s]] на [%s] показов',
    'bannocorrectcountday' => 'Укажите желаемое кол-во дней показов баннера (не меньше 1, значение должно быть числовое)',
    'pricebannerdayscount' => 'Баннер в [[%s]] на [%s] дней',
    'banneraddtomoderst' => 'Добавлен баннер, ожидает проверки перед оплатой!',
    'banneraddtomoderstdata' => "Пользователь [[%s]] запросил размещение баннера в [[%s]]!\r\n\r\nПроверить и подтвердить разрешение на оплату баннера Вы можете в административном разделе, по адресу\r\n[%s]\r\n\r\n",
    'banneractivatemessage' => "Вами был активирован показ баннера в [[%s]]\r\n\r\nОбщий срок показа баннера (показов/дней): [%s]/[%s]\r\n\r\n",
    'activatebannertitle' => 'Добавлен баннер в `[%s]` на сайте `[%s]`',
    'activatebanneraddwadmin' => "Пользователь [[%s]] добавил новый баннер в [[%s]]!\r\nБаннер активен!\r\nУправление баннерами: [%s]\r\n",
    'activateuserbannerst' => 'Подтверждение проверки баннера администратором на [%s]',
    'activateuserbannerstdata' => "Здравствуйте, [%s]!\r\n\r\nСообщаем Вам, что добавленный Вами баннер успешно прошел проверку администратором!\r\nВы можете оплатить размещение Вашего баннера на сайте [%s] в Вашем личном кабинете по адресу [%s]\r\n",
    'advertisingoursitebyselect' => 'Ваша реклама на нашем сайте',
    'inactiveparamslook' => 'На одном из Ваших баннеров на сайте [%s] закончились показы',
    'inactivebannersetdata' => "Здравствуйте, [%s]!\r\n\r\nУведомляем Вас о том, что у одного из Ваших баннеров, размещенных на сайте [%s] ([%s]) закончились показы!\r\nБаннер переведен в режим `Ожидает оплаты`.\r\n\r\nВы можете продлить показ баннера оплатив желаемый срок показа в разделе `Мои баннеры` по адресу\r\n[%s]\r\n",
    'id_alexarank_value:paramname' => 'Alexa Rank',
    
    
    /* v1.3.8 */
    'admspecpageslistnamemenu' => 'Отдельные страницы проекта',
    'pageidentifierisexists' => 'Данный идентификатор страницы уже существует! Задайте другой путь!',
    
    /* v1.3.5 */
    'admsectiongroupingtools' => 'Группировка инструментов',
    'groupisalridyexists' => 'Группа с идентификатором [[%s]] уже существует!',
    'groupdefaultidentifytxt' => 'Другие инструменты',
    
    'xml-api-description-1' => 'Апдейты поисковиков',
    'xml-api-description-2' => 'Витрина ссылок',
    'admrefbunnerssection' => 'Реферальные баннеры',
    
    
    /* v1.3.1 */
	'setcorrectnameofpathnews' => "Путь раздела должен состоять из символов [a-z,а-я,A-Z,А-Я,-,_] и не должен быть пустым!",   
    'selsectionnameof' => "Укажите название блока раздела!",
    'allsectionslistentblck' => "Все разделы [новости/статьи]",
    'toolopt_metadesc' => "Идентификатор строки мета тэга description (пусто - тэг не используется)",   
    'W_DEFAULTDOMAINDESCRIPTION_dsc' => "Мета description по умолчанию (пусто - не используется).",
    'hiddensourcetext' => 'Скрытый текст',
    'viewinnewwindowopened' => "Открыть изображение (откроется в новом окне)",
    
    /* v1.3.0 */
    'toolstyposinkeyboard' => "Генератор опечаток слепой печати",
    
    /* v1.2.9 */
    'toolmassvischeck' => "Массовая проверка посещаемости по LI",
    
    /* v1.2.7 */  
    'accessdinedbyadmin' => "Доступ к данному разделу временно закрыт администратором! Приносим извинения за вызванные неудобства. Попробуйте обратиться к данному разделу через 5 минут.",
    
    'p_paramisdisabledn'=> "Параметр запрещен к использованию!",
	'paramisexistsalridyp' => "Параметр [[%s]] уже существует!",    
    'seopanelstitledid' => "Панель оптимизатора",
    'p_selectnewsection'=> "Укажите название нового раздела!",
    'p_sectisexistsalr' => "Раздел [%s] уже существует! Выберите другое название раздела!",
    'p_identsectnotfou' => 'Неизвестный идентификатор секции!',
    'p_youlockedinpanel'=> "Вы не имеете доступа к панели оптимизатора! Причина: [%s]",
    
	'defurltdname:paramname'          => 'Сайт',
    'p_id_cy_value:paramname'         => 'ТиЦ',
    'p_id_pr_value:paramname'         => 'PR',
    'id_yaca_dir_value:paramname'     => 'YACA',
    'id_dmoz_dir_value:paramname'     => 'DMOZ',
    'id_yandexindex_value:paramname'  => 'Индекс Яндекс',
    'id_googleindex_value:paramname'  => 'Индекс Google',
    'id_liveinternet_value:paramname' => 'LiveInternet',
    'id_dateupdate_value:paramname'   => 'Обновление',
    'id_domain_expire:paramname'      => 'Продлен до',
    'id_dateformat:paramname'         => 'dd.mm.YYYY',
    'controlpanel:paramname'          => 'Действия',  
    'id_yandexback_value:paramname'   => 'Ссылок с Яндекс',
    'id_googleback_value:paramname'   => 'Ссылок с Google',
    'id_yahooindex_value:paramname'   => 'Индекс Yahoo',
    'id_yahooback_value:paramname'    => 'Ссылок с Yahoo',
    'id_bingindex_value:paramname'    => 'Индекс Bing',
    'id_bingback_value:paramname'     => 'Ссылок с Bing',
    
    'p_urlisexiststhis' => 'Сайт [[%s]] уже существует!',
    'yesstringidentsimply' => 'Да',
    'nostringidentsimply' => 'Нет',
    
    
    /* v1.1.0 */
    'simplethemeidw'    => "По умолчанию",
    /* v1.0.0 */
    'getdefaultlangit'  => "Альтернативный (пустой)",
    'setlogindata'      => "Укажите Ваш логин!",
    'setpassdata'       => "Укажите Ваш пароль!",
    'unknowloginorpass' => "Неверно указан логин или пароль!",
	'activregisteracc'  => "Подтверждение регистрации аккаунта [%s]",
	'accountisblock'    => "Аккаунт [%s] заблокирован!\r\nПричина:\r\n[%s]",
	'register'          => "Регистрация",
	'registerl'         => "Регистрация нового пользователя",
	'restorepsw'        => "Восстановление пароля",
	'activateact'       => "Активация аккаунта",
	'cantregisteruser'  => "Регистрация временно запрещена! Приносим извинения за неудобства.",
	'selectlogin'       => "Выбирите логин!",
	'incorrectlogin'    => "Логин может состоять из [0-9A-Za-z_], и не должен состоять только из цифр!",
	'selectmail'        => "Выбирите e-mail!",
	'loginalredy'       => "Такой логин или e-mail уже используется!",
	'emailalridyisset'  => "Такой E-mail уже используется другим пользователем!",
	'numbisnotvalid'    => "Текст с изображения указан не верно!",
	'registernewsuc'    => "Подтверждение регистрации на сайте [%s]",
    'registernewsuc2'   => "Регистрация на сайте [%s]",
	'registernewsuc3'   => "Регистрация пользователя [%s] на сайте [%s]",		    
    'codeincorrectu'    => "Код активации поврежден или указан не верно!",
    'paramsincorrect'   => "Неверно переданы параметры! Один из идентификаторов не опознан!",
    'passissendto'      => "Новый пароль успешно активирован! Вы можете использовать его для входа в кабинет!",
    'logormailincorr'   => "Неверно указан логин или e-mail!",
    'boutrestpasswff'   => "Активация нового пароля на сайте [%s] для [%s]",
    'infoofrestissendt' => "Инструкции по смене пароля высланы Вам на e-mail, указанный при регистрации!",
    'genhostdomain'     => "Главная",
    'accountuserdef'    => "Пользователь [%s]",
    'accountuserdef2'   => "Кабинет пользователя [%s]",
    'settings'          => "Настройки",
    'avatardeleted'     => "Аватар удален!",
	'cantparseimginfo'  => "Невозможно получить информацию о изображении!",
	'typenotsupport'    => "Тип файла не соответствует своему разширению!",
	'imgwidthnomatch'   => "Ширина картинки превышает допустимую по выбранному формату в [[%s]px]!",
	'imgheightnomatch'  => "Высота картинки превышает допустимую по выбранному формату в [[%s]px]!",
	'fileformatnotmatch'=> "Неверный формат файла!",
	'filetypenoident'   => "Недопустимый формат файла [[%s]]! Возможные типы файлов [<b>[%s]</b>]",
	'fileisempty'       => "Вы пытаетесь загрузить пустой файл!",
	'errorindwloadfile' => "Возникла ошибка загрузки файла! Не получилось загрузить файл...",
	'errorsetnewavatar' => "Ошибка установки аватара!",
	'avatarisset'       => "Аватар успешно установлен!",
	'errorgetuserinfo'  => "Ошибка получения информации о пользователе!",
	'passisincorrect'   => "Пароль указан неверно!",
	'plssetpasswnew'    => "Необходимо указать не пустой пароль!",
	'optnochangeredy'   => "Настройки не отличаются от установленных. Параметры не изменены.",
	'optionsissavedok'  => "Настройки успешно сохранены!",
	'optionsisnochok'   => "Настройки не изменены!",
	'mailaccount'       => "Почта",
	'privatemessages'   => "Личные сообщения",
	'newmaildoit'       => "Новое сообщение",
	'newprivatemessage' => "Новое личное сообщение",
	'noinfoforsendmess' => "Некорректные данные для отправки сообщения!",
	'nosubjectmess'     => "Без темы",
	'nomessagefoundonu' => "Сообщение с идентификатором [[%s]] не найдено!",
	'nouserfoundbe'     => "Пользователь [[%s]] не найден!",
	'newmessagesubg'    => "Новое сообщение на [%s] от [%s]",
	'nomessagessended'  => "Сообщение не отправлено! Ошибка при отправки сообщения..",
	'messagebesended'   => "Сообщение успешно отправлено!",	   
    'threadmeilmess'    => "Переписка",
    'threadsoutput'     => "Исходящие потоки",
    'threadsinput'      => "Входящие потоки",
    'balancehistory'    => "Финансовые операции",
    'balancehistoryadd' => "Пополнение баланса",
    'paybalanceuser'    => "Пополнение баланса аккаунта [%s]",
    'errorpaycheckpar'  => "Ошибка идентификации параметров!",
    'addmoneytouser'    => 'Пополнение баланса аккаунта [%s] на сумму [%s] $',
    'submoneytouser'    => 'Снятие с баланса аккаунта [%s] суммы в размере [%s] $',
    'setmoneytouser'    => 'Установка баланса аккаунту [%s] в сумму [%s] $',
    'nomoneyforaction'  => "Недостаточно средств на балансе!",
    'payisdoneok'       => "Платеж успешно завершен!",
    'payisdonenook'     => "Произошла ошибка платежа, или Вы отказались от оплаты!",
    'statuspaydoneprc'  => "Статус платежа",
    'paymoneyfromrbx'   => "Пополнение баланса через [%s]",
    'unknowpaymetchod'  => "Неизвестный метод пополнения баланса",
    'getmoneyfromrefer' => "Получение средств от реферала [%s]",  
	'useringopage'      => "Информация о пользователе [%s]",
    'usernotfoundond'   => "Пользователь не найден или аккаунт пользователя не активирован!",
    'activeindexsiteon' => "Активация индексации сайта на странице аккаунта",
    'dayslastperiod'    => "[%s] дней назад",   
	'istodaynowstr'     => "сегодня",
    'isyestodaynowstr'  => "вчера",
    'isafteryestodaystr'=> "позавчера",
    'paytoinvitecode'   => "Активация инвайт кода",
    'adminsectionaccout'=> "Административный раздел",
	'adminvitesections' => "Инвайт коды регистрации",
	'admaddnewinvite'   => "Создание инвайт кодов",
	'adnnoadminuseris'  => "Для выполнения операции необходимо иметь права администратора!",
	'admengineupdatest' => "Апдейты поисковиков",
	'addnewengineupdate'=> "Добавление апдейтов поисковиков",
	'admgooglecentersl' => "Датацентры Google",
	'admgooglecentadd'  => "Добавление датацентра Google",
	'addeddatacenters'  => "Добавлено датацентров - [%s]",
	'admfontssectionn'  => "Файлы шрифтов",
	'noidentfontdata'   => "Неизвестный идентификатор шрифта!",
	'adminformersfilesp'=> "Изображения информеров",
	'admnewssectinterne'=> "Новости интернета",
	'admnewssectsite'   => "Новости сайта",
	'newsisnotfoundnow' => "Новость не найдена!",
	'setcommentsource'  => "Укажите текст комментария!",
	'addnewcomment3'    => "Вы добавили комментарий на сайте [%s] к [%s]",
	
	'unknowinformdata'  => "Данные не идентифицированы!",
	'pleasuresettitle'  => "Укажите название новости",
	'pleasuresetsource' => "Укажите текст новости",
	'newsalridyexistsw' => "Новость [[%s]] уже существует! Задайте другое название новости!",
	'newslistensection' => "Новости",
	
	'dateupdateisexists'=> "Дата [%s] уже существует!",	
	'getupdatesdesc1'   => "Яндекс ТиЦ",
	'getupdatesdesc2'   => "Яндекс поиск",
	'getupdatesdesc3'   => "Яндекс каталог",
	'getupdatesdesc4'   => "Google PR",
	'toolstextsourced'  => "Инструменты",
	'linksvitrinasect'  => "Витрина ссылок",
	'linksaddnewlink'   => "Добавление ссылки",
	'nocorrecturlforset'=> "Некорректный URL (ошибка анализа URL адреса ссылки)",
	'younotonlineuser'  => "Вы не авторизированны! Пожалуйста, авторизируйтесь..",
	'moneytolinkvitrina'=> "Добавление ссылки на витрину ссылок.",
	'summlinkpaynocorre'=> "Сумма добавления ссылки на витрину ссылок - некорректна!",
	
	'toolgetserversite' => "Получение сервера сайта",
	'toolgetipsite'     => "Получение ip сайта",
	'toolmasscheckdom'  => "Массовая проверка доменов на занятость",
	'toolmassurlspeedt' => "Массовая проверка скорости сайта",
	'toolmassredirectge'=> "Проверка перенаправлений сайта",
	'toolheadersview'   => "Просмотр заголовков сайта",
	'toolpingtracerout' => "Доступность сайта Ping\Tracerout",
	'toolpunycodeconv'  => "Конвертер кирилл. домена (Punycode)",
	'toolgetwhoisipurl' => "WHOIS IP сайта",
	'toolgetwhoisdomain'=> "WHOIS владельца домена сайта",
	'toolmassprcychecke'=> "Массовая проверка PR\ТиЦ",
	'toolgooglebydcchec'=> "Проверка Google PageRank по датацентрам",
	'toolgetlinkprice'  => "Оценка стоимости ссылки с сайта",
	'toolcheckurllinks' => "Анализ внешних и внутренних ссылок",
	'toolviewurlasrobot'=> "Сайт глазами поискового робота",
	'toolcontentanalise'=> "Анализ контента сайта",
	'toolurlsiteanalise'=> "Анализ сайта",
	'toolkeygeneratorurl' => "Генератор ключевых слов с сайта",
	'toolkeygeneratortxt' => "Генератор ключевых слов с текста",
	'toolbrowserinfo'   => "Информация о Вашем IP, браузере",
	'toolinternetspeed' => "Скорость соединения с интернет",
	'tooltextanalisis'  => "Анализ текста (длина, стоп-слова...)",
	'toolencodespecchar'=> "Экранирование\Де спец. символов",
	'toolencodedecodeu' => "Кодирование\Декодирование URL",
	'toolstrencrapt'    => "Шифрование строк",
	'toolpassgenerator' => "Генератор паролей",
	'tooljavascriptpack'=> "Упаковка кода JavaScript",
	'toolcsspack'       => "Упаковка кода CSS",
	'toolhtmlcrapt'     => "Зашифровка HTML в код JavaScript",
	'tooltextcompere'   => "Процентное сравнение текста",
	'toolnorepeatlines' => "Удаление дубликатов строк",
	'toolstringtranslit'=> "Транслит переводчик текста",
	'toolstaturlgenerat'=> "Генератор статических URL",
	'toolrobotsgenerat' => "Генератор файлов robots.txt",
	'tooltitlegenerator'=> "Генератор заголовков (title)",
	'toollinkgenerator' => "Генератор уникальных ссылок",
	'toolextractemails' => "Извлечение E-Mail адресов",
	'toolextractlinks'  => "Извлечение ссылок сайта",
	'toolchecklinktobac'=> "Проверка обратной ссылки",
	'toolmetagenerator' => "Генератор META тэгов",
	'toolfavoritgenerat'=> "Генератор иконки FavIcon",
	'tooltexttoimage'   => "Нанесение текста на изображение",
	'toolipinformer'    => "Информер IP адреса",
	'toolprcyinformer'  => "Информер PR и ТиЦ",	
	
	'toolnolimitdescri' => "Снятие лимита проверки [[%s]]",
	'erroractiontool'   => "Ошибка выполнения действия [[%s]]",
	
	
	'nocorrectpage'     => "Ошибка целостности страницы",
	'nourlsforanalize'  => "Нет данных для анализа",
	'gotonextitemlist'  => "Ожидание следующего сайта...<br />(<b>[%s]</b> из <b>[%s]</b>)",
	'ispausedactionbe'  => "Превышено максимальное количество проверяемых сайтов! [[%s]]",
	'ispausedonactionl' => "Проверка приостановлена на (страница <b>Arrayindexed</b> из <b>Arraylenght</b>)...<br />&nbsp;",
	'preperetostartajax'=> "Подготовка к остановке проверок...<br />(<b>[%s]</b> из <b>[%s]</b>)",
	'preptopausedajms'  => "Подготовка к приостановке проверок на позиции <b>Arrayindexed</b> из <b>Arraylenght</b>...<br />(<b>[%s]</b> из <b>[%s]</b>)",
	'actionisstoppedb'  => "Проверка остановлена...",
	'actionisfinishedb' => "Проверка завершена...",
	'isprocessactionit' => "Анализ : <b>Linkfcheck</b>..<br />(<b>Arrayindexed</b> из <b>Arraylenght</b>)",
	'actiontopayststusq'=> "Обработка запроса, подождите..", 
	
	'listinyadirget'    => "Наличие в каталогах",
	'nonameforsection'  => "Укажите название секции!",
	'sectisexistsnow'   => "Раздел [[%s]] уже существует! Задайте другое имя раздела..",  
    'addnewcommentinf'  => "Добавлен новый комментарий на сайте [%s] для [%s]",
    'admcommentslabel'  => "Комментарии",
    'admtoolsoptions'   => "Настройки инструментов",
    'toolconfigureopt'  => "Настройка [%s]",
    'admstringstablesec'=> "Таблица строк",
    'setidentnametoset' => "Укажите идентификатор строки!",
    'identisalrexists'  => "Идентификатор [[%s]] уже существует! Укажите другой вариант идентификатора..",
    'issystemidentuse'  => "Идентификатор [[%s]] используется системно и не может быть указан для пользовательских строк! Укажите другой вариант идентификатора..",
    'defaultvaluedtr'   => "Системное",
    'emptyvaluestrp'    => "пусто",
    'feedbacksectgetis' => "Обратная связь",
    'selectanameusers'  => "Укажите Ваше имя!",
    'selectatitlemess'  => "Укажите тему сообщения!",
    'selectadatamess'   => "Укажите текст сообщения!",
    'messagefeedtitle'  => "Сообщение от [[%s]] с сайта [%s] [[%s]]",
    'admgeneralsubopt'  => "Надстройки сайта",
    'admredirectlktable'=> "Перенаправления ссылок",
    'setlinkhreftoredir'=> "Укажите URL ссылки для перенаправления..",
    'linkhrefisexistsnw'=> "Такой URL уже существует! Его идентификатор: <b>[%s]</b>",
    
    'errorgetdocument400' => "400 Испорченный Запрос, Bad Request.",
    'errorgetdocument401' => "401 Несанкционированно, Unauthorized.",
    'errorgetdocument403' => "403 Запрещено, Forbidden.",
    'errorgetdocument404' => "404 Не найден, Not Found.",
    
    'admuserslistenstrtbl'=> "Пользователи сайта",
    'modifylabeliditemstr'=> "Изменить",
    'admsectiongeneralinf'=> "Общая информация",
    
    
    //--------------------------- названия параметров инструментов begin -----------
    'toolopt_descr' => "<label id='red'>*</label> Идентификатор строки `краткого` описания инструмента (название)",
    'toolopt_Ldescr' => "Идентификатор строки `среднего` описания инструмента (опционально), отображается в списке инструментов.",
    'toolopt_onlineonly' => 'Предоставлять доступ к инструменту только если посетитель авторизован на сайте.',
    'toolopt_enabled' => "Включить оплату снятия лимита использования инструмента.",
    'toolopt_price' => "<label id='red'>*</label> Цена (в USD) снятия лимита использования инструмента. (формат: 0.00)",
    'toolopt_sleep' => "<label id='red'>*</label> Задержка перед выполнением проверки (в секундах)",
    'toolopt_timeout' => "<label id='red'>*</label> Максимальное время ожидания ответа при запросе. (в секундах)",
    'toolopt_count' => "<label id='red'>*</label> Максимальное кол-во проверок в ограниченном режиме.",
    'toolopt_maxsteps' => "<label id='red'>*</label> Максимальное кол-во прыжков.",
    'toolopt_stepsel' => "<label id='red'>*</label> Максимальное кол-во прыжков (выбрано по умолчанию).",
    'toolopt_direct' => "Направление проверки: DESC - по убыванию дат, '' - по возрастанию дат добавления датацентра.",
    'toolopt_docachonget' => "Кэшировать и получать данные из кэша при открытии постоянной страницы анализа. (пример: /tool/contentcheck/forwebm.net  - данные кэшируются с интервалом в 5 дней)",
    'toolopt_docachonpost' => "Использовать и принудительно обновлять кэш при пост проверке сайта, данные в кэше будут постоянно обновляться при анализе со страницы инструмента. Если отключено - данные обновляются на постоянной странице по истечении срока кэширования.",
    'toolopt_usehistory' => "Вести историю выполненных анализов инструментом.",
    'toolopt_historyperpage' => "Кол-во элементов на 1 страницу в истории анализов инструмента.",
    'toolopt_allwordsforuse' => "<label id='red'>*</label> Общее количество слов, которое следует обработать для выявления ключевых слов <= 0 - все слова",
    'toolopt_maxcharscount' => "<label id='red'>*</label> Максимальное кол-во символов для обработки, 0 - все",
    'toolopt_maxurlcount' => "<label id='red'>*</label> Максимальное кол-во страниц для обработки, 0 - без ограничения",
    'toolopt_maximagesize' => "<label id='red'>*</label> Максимальный размер загружаемых изображений в Kb.",
    'toolopt_imagetypes' => "<label id='red'>*</label> Список допустимых типов изображений для загрузки (по 1 на строку, регистр - нижний).",
    'toolopt_updateeveryminute' => "<label id='red'>*</label> Обновлять данные через каждые (минут) 4320 = 3 дня.",
    'toolopt_updateifexistsinf' => "Обновлять информер при создании, если информер такого идентификатора (ip, сайта и т.д) уже существует.",
    'toolopt_deleteoldaccminf' => "<label id='red'>*</label> Удалять запись информера, если указанное кол-во минут не было запроса информера, 5760 = 4 дня, 0 - никогда не удалять.",
    'toolopt_checkfordeletels' => "<label id='red'>*</label> Интервал проверки удаления устаревших записей, 0 - никогда не проверять, 150 минут = 2,5 часа.",
    'toolopt_checkforurlexists' => "Создавать информеры только для существующих сайтов.",    
    'toolopt_keywords' => "Идентификатор ключевых слов страницы (пусто - используются основные ключевые слова сайта).",
    'toolopt_onlyforadmin' => "Предоставлять доступ к инструменту только администратору сайта.",
    'toolopt_tdescr' => "Идентификатор html текста `подробного` описания инструмента. (отображается на странице инструмента, иконку инструмента не убирает). (Пусто - используется описание по умолчанию).",   
    'toolopt_usemegaindextop' => "Отображать `Сайт в топе по ключевым словам` (от www.megaindex.ru)",
    'toolopt_megaindexlogin' => "Логин на сайте www.megaindex.ru",
    'toolopt_megaindexpass' => "Пароль на сайте www.megaindex.ru",   
    'toolopt_enabledphistory' => "Вести историю параметров сайта (ТиЦ, PR и т.д)",
	'toolopt_updatehistoryifexists' => "Обновить запись проверки в истории, если проверка с такой датой уже существует.",
	'toolopt_showonlyactualy' => "Отображать историю только для актуальных для данной проверки значений. (т.е - если значения посещаемости отсутствуют при текущей проверки - они не будут отображены на графике истории)",
	'toolopt_grathcount' => "Отображать на графике последние N проверок (0 - все проверки)",
	//--------------------------- названия параметров инструментов end -----------
	
	//--------------------------- названия идентификаторов параметров begin ------
	'id_cy_value:paramname' => 'Яндекс ТиЦ',
	'id_pr_value:paramname' => 'Google PR',
    'id_lidaystat_value:paramname' => 'Посетителей в сутки по LI',
    'id_limonthstat_value:paramname' => 'Посетителей в месяц по LI',
    //--------------------------- названия идентификаторов параметров and ------
    
    'showallitemslabel' => 'Показать всё',
    'graphhelpidentuse' => '<![CDATA[Кликните по графику, чтобы включить/отключить показ значений <br/><br/>Кликните по значению легенды, чтобы показать/скрыть график<br/><br/>Выделите область графика, которую хотите увеличить]]>',
    'grathtitlelabelid' => '<b>История изменения показателей[%s]</b>',
    
    //--------------------------- динамические надстройки сайта begin -------------
    'defaultsitetitleid' => "Инструменты для вебмастера и оптимизатора, анализ сайта, проверка ТиЦ и PR",
    'defaultkeywordssiteid' => "анализ сайта, инструменты вебмастера, позиции сайта, оптимизация, проверка домена, продвижение сайтов, анализ контента, whois, pagerang, ТиЦ, cy, проверка pr, вебмастеру, бесплатно, раскрутка, статьи, webmaster, утилиты, сайт, раскрутка сайта",
    'defaultdatetimesiteformat' => "dd.mm.YYYY hh:ii:ss",
    'defaultdatesiteformatid' => "dd.mm.YYYY",
    'defaultdateformatinupdatesid' => "dd.mm.YYYY",
    'defaultdatetimenewshostpageid' => "dd.mm.YYYY в hh:ii",
    
    //описание полей
    'W_DEFAULTDOMAINTITLE_dsc' => "Заголовок сайта по умолчанию (дописывается к `динамическому`, отображается на главной странице).",
    'W_DEFAULTKEYWORDS_dsc' => "Ключевые слова сайта по умолчанию. (используются, если ключевые слова не были переопределены для какого-либо раздела).",
    'W_DATETIMEDEFAULTFORMAT_dsc' => "Формат отображения даты/времени по умолчанию. (системная константа равна: <b>dd.mm.YYYY hh:ii:ss</b>)",
    'W_DATEDEFAULTFORMAT_dsc' => "Формат отображения даты по умолчанию. (системная константа равна: <b>dd.mm.YYYY</b>)",
    'W_ADMENGINEUPDATESFORMATVIEW_dsc' => "Формат отображения даты в апдейтах на страницах сайта. (системная константа равна: <b>dd.mm.YYYY</b>)",
    'W_SITENEWSDATETIMEFORMATONHOST_dsc' => "Формат отображения даты/времени создания новости в списке последних новостей на главной странице сайта. (системная константа равна: <b>dd.mm.YYYY в hh:ii</b>)",
    'W_CANBEREGISTERED_dsc' => "Разрешить регистрацию новых пользователей",
    'W_HTMLCODEVISIBLECOUNTER_dsc' => "HTML код `видимого` счетчика посещаемости сайта. (отображается в левом нижним углу подвала). Пусто - не отображается ничего.",
    'W_HTMLCODEINVISIBLECOUNTER_dsc' => "HTML код `<b>НЕ</b> видимых` счетчиков посещаемости сайта. (например для более точного сбора статистики). Пусто - код не используется на сайте.",
    'W_HTMLCODERIGHTDOWNBLOCK_dsc' => "HTML код, отображаемый в правой боковой части сайта, следующий за (ниже) `блоком новостей`",
    'W_HTMLCODETOPCENTERBLOCK_dsc' => "HTML код, отображаемый в верхней, центральной части сайта, следующий за (ниже) `полосой (путь) навигации`",
    'W_HTMLCODEDOWNCENTERBLOCK_dsc' => "HTML код, отображаемый в нижний, центральной части сайта, перед подвалом сайта",    
    'W_AUTOCREATEPRUPDATESLIST_dsc' => "Пополнять апдейты Google PR автоматически (если возможно) `включить режим (auto) для Google PR`",
    //--------------------------- динамические надстройки сайта end -------------
    
    'optionsisresetedrestpage' => "Надстройки успешно сброшены! При следующем открытии страниц сайта изменения вступят в силу. На данный момент Вы можете видеть в полях ранее установленные идентификаторы, при повторном открытии этой страницы - значения сменятся на `системные`.",
    
    'noresulttext' => 'нет',
    
   );
   
   function __construct(w_Control_obj $control) {
   	$this->control = $control;
   	/* имя администратора */
   	$this->data['mynameidentifieris'] = 'Евгений';
	    
   	$this->data['bottmessageline'] = 
	 "----------------\r\n".
	 "** Сообщение отправлено автоматически, отвечать на него не нужно! **\r\n".
	 "----------------\r\n\r\n".
	 "С уважением, {$this->data['mynameidentifieris']}!\r\n".
	 "Администратор http://".W_HOSTMYSITE;
	//-----------------
	
	$this->data['messagefeedbody_listendata'] = 
	 "Сообщение от посетителя [%s] с сайта [%s].\r\n\r\n------ Данные сообщения--------\r\n".
	 "Имя: [%s]\r\n".
	 "E-mail: [%s]\r\n".
	 "IP: [%s]\r\n\r\n".
	 "Тема сообщения:\r\n[%s]\r\n\r\n".
	 "Текст сообщения:\r\n[%s]\r\n";
	
	$this->data['newcommentbeaddedtoitem_temp'] =
	"[%s] только что добавил новый комментарий к [%s] на сайте [%s]!\r\n".
	"Для просмотра комментария пройдите по ссылке:\r\n[%s]\r\n\r\n";
	
	$this->data['newcommentbeaddedtoitem'] = 
	 $this->data['newcommentbeaddedtoitem_temp'].$this->data['bottmessageline'];
	
	$this->data['newcommentbeaddedtoitemadmin'] = 
	 $this->data['newcommentbeaddedtoitem_temp']."----Текст комментария---\r\n[%s]\r\n\r\n".
	 $this->data['bottmessageline'];	
	
	$this->data['addcommenttomoderinform'] = 
	 "Вы запросили добавление комментария к [[%s]].\r\n\r\n".
	 "Администрация сайта требует проверку комментариев перед их публикацией! Ваш комментарий будет проверен в ".
	 "ближайшее время. В случае, если Ваш комментарий не нарушает правил - он будет опубликован. О размещении Вашего ".
	 "комментария Вас проинформирует сообщение с информацией о состоянии Вашего комментария.\r\n".
	 $this->data['bottmessageline'];
	
	$this->data['addcommenttomoderinformok'] = 
	 "Ваш комментарий к [[%s]] на сайте [%s] успешно проверен и опубликован!\r\n".
	 "Для просмотра комментария пройдите по ссылке:\r\n[%s]\r\n\r\n".$this->data['bottmessageline']; 	 
	
	$this->data['actiontopaynolimit'] = "Вы действительно хотите отменить лимит проверки?\\r\\nС вашего счета будет снята".
	 " сумма в размере [%s] USD\\r\\nПродолжить?";
	
	$this->data['setmoneytouser_message_admin'] =
	 "Баланс пользователя [%s] установлен в [%s] USD!\r\n".
	 "------------\r\n".
	 "Описание платежа: [%s]\r\n".
	 "Всего на балансе пользователя: [%s] USD\r\n\r\n".	 	 
   	 $this->data['bottmessageline'];     	
   	
   	$this->data['setmoneytouser_message'] =
   	 "Здравствуйте, [%s]!\r\n".
   	 "Ваш баланс установлен в [%s] USD!\r\n".
   	 "История финансовых операций доступна по ссылке:\r\n".
   	 "http://".W_HOSTMYSITE."/account/payhistory/\r\n".
   	 "------------\r\n".
   	 "Описание платежа: [%s]\r\n\r\n".   	 
   	 $this->data['bottmessageline'];	
	
	$this->data['submoneytouser_message_admin'] =
	 "С баланса пользователя [%s] сняты средства в размере [%s] USD!\r\n".
	 "------------\r\n".
	 "Описание платежа: [%s]\r\n".
	 "Всего на балансе пользователя: [%s] USD\r\n\r\n".	 	 
   	 $this->data['bottmessageline'];     	
   	
   	$this->data['submoneytouser_message'] =
   	 "Здравствуйте, [%s]!\r\n".
   	 "С Вашего счета аккаунта сняты средства в размере [%s] USD!\r\n".
   	 "История финансовых операций доступна по ссылке:\r\n".
   	 "http://".W_HOSTMYSITE."/account/payhistory/\r\n".
   	 "------------\r\n".
   	 "Описание платежа: [%s]\r\n\r\n".   	 
   	 $this->data['bottmessageline'];		
	
	$this->data['addmoneytouser_message_admin'] =
	 "Пользователю [%s] зачислены средства в размере [%s] USD!\r\n".
	 "------------\r\n".
	 "Описание платежа: [%s]\r\n".
	 "Всего на балансе пользователя: [%s] USD\r\n\r\n".	 	 
   	 $this->data['bottmessageline'];     	
   	
   	$this->data['addmoneytouser_message'] =
   	 "Здравствуйте, [%s]!\r\n".
   	 "На Ваш счет аккаунта поступили средства в размере [%s] USD!\r\n".
   	 "История финансовых операций доступна по ссылке:\r\n".
   	 "http://".W_HOSTMYSITE."/account/payhistory/\r\n".
   	 "------------\r\n".
   	 "Описание платежа: [%s]\r\n\r\n".   	 
   	 $this->data['bottmessageline'];   	
   	
   	$this->data['newmessageonypuraccount'] =
   	 "Здравствуйте, [%s]!\r\n".
   	 "Вам поступило новое личное сообщение на сайте ".W_HOSTMYSITE." от пользователя [%s]\r\n\r\n".
   	 "Чтобы прочесть сообщение, пройдите по ссылке в Ваш кабинет:\r\n".
   	 "http://".W_HOSTMYSITE."/account/mail/[%s]\r\n\r\n".
   	 "Данные сообщения:\r\n".
   	 "Тема: [%s]\r\n".
   	 "Дата отправки: [%s]\r\n\r\n".
   	 $this->data['bottmessageline'];
	   	
   	$this->data['filesizenomathon'] =
   	 "Размер файла [[%s] Kb] больше максимально допустимого размера загружаемого файла [[%s] Kb] на [[%s] Kb]";
   	 
    $this->data['usernotactive'] = 
	 "Аккаунт не активирован! На указанный при регистрации e-mail выслан повторно код ".
     "активации аккаунта! Проверьте Вашу почту!";
     
	$this->data['activemailtext'] = 
	 "Здравствуйте, [%s]\r\n".
	 "\r\n".
	 "Для завершения регистрации необходимо подтвердить существование Вашего e-mail адреса!\r\n".
	 "\r\n".
	 "Для завершения регистрации пройдите по ссылке\r\n".
	 "[%s]"."\r\n".
	 "или используйте код: [%s]"."\r\n".
     "на странице [%s]"."\r\n".
	 "для ручной активации аккаунта!\r\n\r\n".
	 $this->data['bottmessageline'];
	 
	$this->data['registermailb'] =
	 "Здравствуйте, [%s]!\r\n\r\n".
	 "Вы, или кто-то другой использовал данный e-mail для регистрации на сайте ".W_HOSTMYSITE."\r\n".
	 "Если это были не Вы - просто проигнорируйте данное сообщение.\r\n\r\n".
	 "-------------\r\n".
	 "Данные для входа:\r\n".
	 "Логин: [%s]\r\n".
	 "Пароль: [%s]\r\n".
	 "Дата: [%s]\r\n\r\n".
	 "Для возможности входа в Ваш кабинет, необходимо подтвердить Ваш e-mail!\r\n".
	 "Для завершения реистрации пройдите по ссылке\r\n".
	 "[%s]"."\r\n".
	 "или используйте код: [%s]"."\r\n".
     "на странице [%s]"."\r\n".
	 "для ручной активации аккаунта!\r\n\r\n".
	 $this->data['bottmessageline'];
	 
	$this->data['registermailb2'] =
	 "Здравствуйте, [%s]!\r\n\r\n".
	 "Вы, или кто-то другой использовал данный e-mail для регистрации на сайте ".W_HOSTMYSITE."\r\n".
	 "Если это были не Вы - просто проигнорируйте данное сообщение.\r\n\r\n".
	 "-------------\r\n".
	 "Данные для входа:\r\n".
	 "Логин: [%s]\r\n".
	 "Пароль: [%s]\r\n".
	 "Дата: [%s]\r\n\r\n".
	 $this->data['bottmessageline'];
	 
	$this->data['registermailb3'] =
	 "Зарегистрирован новый пользователь: [%s]!\r\n\r\n".
	 "-------------\r\n".
	 "Данные пользователя:\r\n".
	 "Логин: [%s]\r\n".
	 "Пароль: [%s]\r\n\r\n".
	 "E-mail: [%s]\r\n".
	 "IP: [%s]\r\n".
	 "URL: [%s]\r\n".	 
	 "Дата: [%s]\r\n\r\n".
	 $this->data['bottmessageline'];
	 
	$this->data['restmessagepsw'] = 
	 "Здравствуйте, [%s]!\r\n".
	 "Вы запросили изменение пароля для аккаунта [%s].\r\n\r\n".
	 "----------\r\n".
	 "Новые данные:\r\n".
	 "Логин: [%s]\r\n".
	 "Пароль: [%s]\r\n".
	 "----------\r\n\r\n".
	 "Для активации нового пароля пройдите по ссылке:\r\n".
	 "[%s]\r\n".
	 "!!**Важно!! Ссылка на активацию нового пароля действительна в течении суток (текущих)!\r\n".
	 $this->data['bottmessageline'];	
	 	  	 	
   }//__construct
   
   protected function CorrectList($list, $s) {
   	if (!$list || !@is_array($list)) { return $s; }
	foreach ($list as $val) {
	 $s = @preg_replace("/\[\%s\]/", $val, $s, 1);	 	
	}
	return $s;	
   }//CorrectList
   
   /** проверка существования идентификатора */
   function IdentExists($ident) { return ($ident && isset($this->data[$ident])); }
   
   /** установка идентификатора */
   function AddIdent($ident, $value) { return (!$ident) ? false : ($this->data[$ident] = $value); }
   
   /** альтернативный идентификатор */
   protected function GetUserLangID($ident) {
	if (!$ident = $this->control->CorrectSymplyString($ident)) { return false; }
	$item = $this->control->db->GetLineArray($this->control->db->mPost(
	 "select strsource from {$this->control->tables_list['stringstb']} where strident='$ident' and ".
	 "lang='".$this->control->GetActiveLanguage()."' limit 1"
	));
	return $this->data[$ident] = (!$item) ? false : @stripcslashes($item['strsource']);	
   }//GetUserLangID
   
   /** получение строки по идентификатору */
   function GetLang($name, $list=false, $def=false) {
   	if ($list && !@is_array($list)) { 
	 if (@is_string($list)) { $list = @explode(';', $list); } else { $list = array($list); } 
	}   	
	$value = ($this->IdentExists($name)) ? $this->data[$name] : $this->GetUserLangID($name);
	return ($value === false) ? $def : $this->CorrectList($list, $value);	
   }//GetLang	
	
 }//w_language_obj 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>