<?php
 /** модуль главной страницы сайта
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 /* инициализация реферала */
 if ($CONTROL_OBJ->InitializeReferalCookies($_GET['p'])) { $CONTROL_OBJ->LocaleToHost(); };
 //-------------------------------------------------------------------------------------
 $ismain_page = true;
 $CONTROL_OBJ->smarty->assign('ismain_page', $ismain_page);
 
 
 
 
 
 //-------------------------------------------------------------------------------------
?>