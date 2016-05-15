<?php
 /** Файл конфигурации динамических данных (проверка установки) (изменяемых в админке)
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */ 
 //-------------------------------------------------------------------------------------
 if (!defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 /** description по умолчанию */
 if (!defined('W_DEFAULTDOMAINDESCRIPTION')) @define('W_DEFAULTDOMAINDESCRIPTION', '');
 
 /** заголовок по умолчанию */
 if (!defined('W_DEFAULTDOMAINTITLE')) @define('W_DEFAULTDOMAINTITLE', 'defaultsitetitleid');  
 
 /** ключевые слова по умолчанию */
 if (!defined('W_DEFAULTKEYWORDS')) @define('W_DEFAULTKEYWORDS', 'defaultkeywordssiteid');
 
 /** формат даты-времени по умолчанию, комбинация любая - элементы - строго по вхождению, время может отсутствовать */
 if (!defined('W_DATETIMEDEFAULTFORMAT')) @define('W_DATETIMEDEFAULTFORMAT', 'defaultdatetimesiteformat');
 
 /** формат отображения даты по умолчанию */
 if (!defined('W_DATEDEFAULTFORMAT')) @define('W_DATEDEFAULTFORMAT', 'defaultdatesiteformatid');
 
 /** формат отображения дат в апдейтах на страницах сайта */
 if (!defined('W_ADMENGINEUPDATESFORMATVIEW')) @define('W_ADMENGINEUPDATESFORMATVIEW', 'defaultdateformatinupdatesid');
 
 /** формат даты новостей сайта в списке на главной странице */
 if (!defined('W_SITENEWSDATETIMEFORMATONHOST')) @define('W_SITENEWSDATETIMEFORMATONHOST', 'defaultdatetimenewshostpageid');
 
 /** разрешить регистрацию новых пользователей */
 if (!defined('W_CANBEREGISTERED')) @define('W_CANBEREGISTERED', true);
 
 /** html код `видимого` счетчика посещаемости сайта */
 if (!defined('W_HTMLCODEVISIBLECOUNTER')) @define('W_HTMLCODEVISIBLECOUNTER', '');
 
 /** html код `НЕ видимых` счетчиков посещаемости сайта */
 if (!defined('W_HTMLCODEINVISIBLECOUNTER')) @define('W_HTMLCODEINVISIBLECOUNTER', '');
 
 /** HTML код, отображаемый в правой части сайта, следующий за (ниже) `блоком новостей` */
 if (!defined('W_HTMLCODERIGHTDOWNBLOCK')) @define('W_HTMLCODERIGHTDOWNBLOCK', '');

 /** HTML код, отображаемый в левой части сайта, следующий за (ниже) `блоком основного меню` */
 if (!defined('W_HTMLCODELEFTDOWNBLOCKAFTMENU')) @define('W_HTMLCODELEFTDOWNBLOCKAFTMENU', '');
 
 /** HTML код, отображаемый в верхней, центральной части сайта, следующий за (ниже) `полосой (путь) навигации` */
 if (!defined('W_HTMLCODETOPCENTERBLOCK')) @define('W_HTMLCODETOPCENTERBLOCK', '');
 
 /** HTML код, отображаемый в нижний, центральной части сайта, перед подвалом сайта */
 if (!defined('W_HTMLCODEDOWNCENTERBLOCK')) @define('W_HTMLCODEDOWNCENTERBLOCK', '');
 
 /** автоматически пополнять апдейты google pr, если возвожно */
 if (!defined('W_AUTOCREATEPRUPDATESLIST')) @define('W_AUTOCREATEPRUPDATESLIST', false);
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */  
?>