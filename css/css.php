<?php 
 require_once dirname(__FILE__).'/../lib/confi/pengine.php'; 
 header("Content-type: text/css; charset: UTF-8");
 // по умолчанию цвет выделения ссылок
 define('DEF_LINK_HOVER', '#473421');
 // по умолчанию цвет ссылок
 define('DEF_LINK', '#917C66');
?>
*{margin:0; padding:0;}
a img,fieldset { border: none }
a { color: <?php echo DEF_LINK?>; }
a:hover { color: <?php echo DEF_LINK_HOVER?> }
a:active { position: relative; top: 1px; left: 1px; }
body { 
 font: 12px arial; background: #FFFFFF; color:#000000; text-align: left; height:100%;
 min-width: 1000px;   
}
/** head begin */
.head_listen { margin-top: 3px; height: 97px; }
.head_listen .lc { 
 background: url(<?php echo W_SITEPATH?>img/head/left.png) no-repeat top left;
 /*//background: url(<?php echo W_SITEPATH?>img/head/left_explorer.png) no-repeat top left;*/ 
 height: 97px; width: 410px; 
}
.head_listen .logocontaner { margin-top: 10px; width: 410px }
a.logo {
 background: url(<?php echo W_SITEPATH?>) no-repeat; 
 display: block; height: 67px; width: 327px;	
}
.head_listen .hc { background: url(<?php echo W_SITEPATH?>img/head/center.png) repeat-x; height: 97px; }
.head_listen .hc .menubar { margin-top: 55px; white-space: nowrap; }
a.menuItem {
 display: inline-block; margin: 0 3px 0 3px; color: #775D41;
 padding: 3px; font-size: 14px; font-weight: bold; text-decoration: none;
 position: relative; left: -50px; border: 1px dashed transparent;	
}
a.menuItem:hover {
 /*background: #EEE6DD;/**url(<?php echo W_SITEPATH?>img/head/menuactive.png) repeat; */
 color: #473421; border: 1px solid #473421; border-right: 1px dashed transparent; 	
}
.head_listen .rc {
 background: url(<?php echo W_SITEPATH?>img/head/right.png) repeat-x; height: 97px; width: 358px;
}
.regplace { margin-top: 5px; margin-right: 8px; }
a.restpsw { margin-left: 25px; color: <?php echo DEF_LINK?>; text-decoration: none; font-size: 92%; }
a.restpsw:hover { color: <?php echo DEF_LINK_HOVER?>; text-decoration: underline; }
#qinput { display: inline-block; margin-top: 8px; }
.qinpbuttonplace { margin-left: 2px; }
/** head ш end */
.inpt, .inpt_r {
 background: transparent; border: 1px solid #775D41; padding: 2px; height: 17px;	
}
.inpt_r { border: 1px solid #FF0000; }
.int_text { background: transparent; border: 1px solid #775D41; padding: 2px; }

/* кнопка входа */
.butt { 
 border: 1px solid #775D41; border-left: transparent; background: transparent; height: 23px; font-weight: bold;
 vertical-align: baseline; color: #785e41; padding-left: 2px; padding-right: 2px; cursor: pointer; 	
}
/* все кнопки */
.button {
 border: none;	
 background: transparent url(<?php echo W_SITEPATH?>img/items/buttonbg.png) repeat-x; height: 23px;
 vertical-align: baseline; color: #FFFFFF; padding-left: 2px; padding-right: 2px; cursor: pointer;	
}
.button:disabled { background: transparent url(<?php echo W_SITEPATH?>img/items/buttonbg_disabled.png) repeat-x; }

.butt:hover { color: <?php echo DEF_LINK_HOVER?> }
.butt:active { position: relative; top: 1px; left: 1px; }
.button:active { position: relative; top: 1px; left: 1px; }
/* body data */
.content_spacer { margin-top: 12px }
.def_td, .def_td_r { vertical-align: top; text-align: left; }
.def_td_r { margin-right: 8px; width: 248px; }
.c_content { margin-right: 18px; }
#red { color: #FF0000 }
/* updates data */
a.upd_title { color: #775D41; font-size: 14px; font-weight: bold; text-decoration: none; }
a.upd_title:hover { color: <?php echo DEF_LINK_HOVER?> }
.apdates_data { margin-top: 13px; margin-right: 8px; }
.upd_td, .upd_td_r, .upd_td_v { vertical-align: top; text-align: left; height: 18px; }
.upd_td_v { background: transparent url(<?php echo W_SITEPATH?>img/items/dashed_p.gif) repeat-x 13px; width: 105px; //width: 96px; }
#fone_l { background: #FFFFFF; }
.upd_td_r { 
 background: transparent url(<?php echo W_SITEPATH?>img/items/dashed_p.gif) repeat-x 13px;
 text-align: right; white-space: nowrap; 
}
.yandex_logo_upd { display: inline-block; background: transparent url(<?php echo W_SITEPATH?>img/items/fav_yandex.png) no-repeat left top; }
.yandex_logo_upd .text { margin-left: 22px; font-weight: bold; }
.google_logo_upd { display: inline-block; background: transparent url(<?php echo W_SITEPATH?>img/items/fav_google.png) no-repeat left top; }
.google_logo_upd .text { margin-left: 22px; font-weight: bold; }
/* footer */
.footer { border-top: 5px solid #C4B8AC; height: 70px; }


/* left menu data */
.left_menu_data { margin-right: 18px; margin-left: 18px; }
.l_menu_space { 
 width: 260px;  
}
.l_menu_space .ins { margin: 4px 2px 12px 12px; }
.l_menu_space .tdata { margin-top: 13px; }
.l_menu_space .tdata a{
 display: block; margin: 0px 0px 6px 8px; height: 19px; vertical-align: baseline; padding-left: 20px; 
 background: transparent url(<?php echo W_SITEPATH?>img/items/fav_yandex.png) no-repeat left top; text-decoration: none;
 /*border-bottom: 1px solid #C7BCB0;*/	
}
/* почта */
.l_menu_space .tdata a.mail {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/mail.png) no-repeat left top;	
}
/* финансовые операции */
.l_menu_space .tdata a.money {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/money.png) no-repeat left top;	
}
/* настройки */
.l_menu_space .tdata a.settings {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/settings.png) no-repeat left top;	
}
/* на главную */
.l_menu_space .tdata a.home {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/home.png) no-repeat left top;	
}
/*  invite коды */
.l_menu_space .tdata a.invitecode {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/invite_code.png) no-repeat left top;	
}
/* апдейты поисковиков */
.l_menu_space .tdata a.engineupdates {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/engine_updates.png) no-repeat left top;	
}
/* датацентры google */
.l_menu_space .tdata a.googlecenters {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/google_centers.png) no-repeat left top;	
}
/* файлы шрифтов */
.l_menu_space .tdata a.fontssection {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/fonts_section.png) no-repeat left top;	
}
/* файлы общих информеров */
.l_menu_space .tdata a.adminformersfiles {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/info.png) no-repeat left top;	
}
/* витрина ссылок */
.l_menu_space .tdata a.admlinkvitrina {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/vitrinalinks.png) no-repeat left top;	
}
/* новости интернета */
.l_menu_space .tdata a.adminetnews {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/inetnews.png) no-repeat left top;	
}
/* новости сайта */
.l_menu_space .tdata a.admsitenews {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/sitenews.png) no-repeat left top;	
}
/* комментарии */
.l_menu_space .tdata a.admcommentssect {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/commentsico.png) no-repeat left top;	
}
/* настройки инструментов */
.l_menu_space .tdata a.admtoolsoptions {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/toolsoptions.png) no-repeat left top;	
}
/** таблица строк */
.l_menu_space .tdata a.admstringstable {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/stringslist.png) no-repeat left top;	
}
/** перенаправления ссылок */
.l_menu_space .tdata a.admredirectlktable {
 background: transparent url(<?php echo W_SITEPATH?>img/items/target_link.png) no-repeat left top;	
}
/** пользователи сайта */
.l_menu_space .tdata a.admuserslistenclass { 
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/admuserslistenclass_img.png) no-repeat left top;	
}


/* сервисы */
.l_menu_space .tdata a.internetspeed {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/internetspeed.png) no-repeat left top;	
}
.l_menu_space .tdata a.massurlspeedtest {
 background: transparent url(<?php echo W_SITEPATH?>img/ico/general/massurlspeedtest16.png) no-repeat left top;	
}


.sub_section_menu { color: #775D41; font-weight: bold; background: url(<?php echo W_SITEPATH?>img/head/right.png) no-repeat -95px; }

/* content data */
.qanalisys_label { 
 color: #775D41; font-weight: bold; background: url(<?php echo W_SITEPATH?>img/head/right.png) no-repeat -165px; 
 width: 110px; padding-left: 4px; font-size: 14px;
}
.prep_label_analisys { font-size: 95%; padding-left: 4px }
.prep_label_analisys a { text-decoration: none; border-bottom: 1px dashed #775D41; padding-left: 0px }
.typelabel { margin: 6px 0px 2px 0px }
.captcha_img { margin-left: 3px; border: none; //position: relative; //top: 2px; }
.contentway { margin-bottom: 8px; }
.contentway a{ display: inline-block; height: 20px; vertical-align: baseline; text-decoration: none; }
.contentway label{
 display: inline-block; height: 20px; width: 20px; vertical-align: baseline;
 background: url(<?php echo W_SITEPATH?>img/items/arrow_1.png) no-repeat;	
}
.contentway_btn { 
 background: url(<?php echo W_SITEPATH?>img/items/menubtnline.png) no-repeat left top; display: block; height: 4px; 
}
.content_title { text-transform: uppercase; margin-bottom: 12px; padding: 10px 5px 6px 0px; }
.content_title span{ font-weight: bold; }
.title_sub_rzd { margin-bottom: 4px; padding-bottom: 4px; border-bottom: 1px solid #DCCDBB }


/* vitrina link classes */
.vitrinaclass { margin-top: 12px; }
.vitrinaclass a {
 display: block; margin: 0px 0px 6px 8px; vertical-align: baseline; padding-left: 20px; 
 background: transparent url(<?php echo W_SITEPATH?>img/items/fav_yandex.png) no-repeat left top; 	
}

/* форма сообщения */
.text_borders { border: 1px solid #775D41; background: #F1EBE4; }	
.inp_new_text { border: none;  border-top: 1px solid #775D41; padding: 2px; width: 100%; }
.heat_titles_b{ margin: 5px 2px 5px 10px; }
.buttons_head {  }
.buttons_head span { 
 margin-left: 2px; background: transparent; border: 1px solid transparent;
 display: inline-block; height: 20px; 
}
.buttons_head span:hover { background: #EFE8E0; border: 1px solid #7F6345;  }
/* цитаты */
.quoty_div {
 background: url(<?php echo W_SITEPATH?>img/items/comma.png) no-repeat top left;
 padding: 21px 4px 4px 20px;  font-style: italic;	
}
/* страници */
.pageSelected {	
 background-color: #E4D9CB; width: auto; height: 18px; display: inline-block; font-size: 12px;
 line-height: 18px; color: #FFFFFF;
}
.pageNoSelected { 
 background-color:#EBEBEB; width: auto; height: 18px; display: inline-block;
 font-size: 12px; line-height: 18px;
}
/* ссылка темы сообщения */
a.subjlinkedmail{ color: #C0C0C0; }
a.subjlinkedmail:hover { color: #808080 }
.deletemessbut, .readmessbut, .saveselectlist, .activatelistit, .deactivatelistit {
 background: url(<?php echo W_SITEPATH?>img/items/erase.png) transparent no-repeat top left; cursor: pointer;
 padding-left: 17px; vertical-align: baseline; border: none; height: 20px; text-align: left;	
}
.deletemessbut:hover { color: #FF0000 }
.deletemessbut:active { position: relative; top: 1px; left: 1px; }
.readmessbut { background: url(<?php echo W_SITEPATH?>img/items/readedmail.png) transparent no-repeat top left; }
.readmessbut:hover { color: #008000 } 
.readmessbut:active { position: relative; top: 1px; left: 1px; }
.saveselectlist { background: url(<?php echo W_SITEPATH?>img/items/saveas.png) transparent no-repeat top left; }
.saveselectlist:hover { color: #426D95 } 
.saveselectlist:active { position: relative; top: 1px; left: 1px; }

.activatelistit { background: url(<?php echo W_SITEPATH?>img/items/button_ok.png) transparent no-repeat top left; }
.activatelistit:hover { color: #008000 } 
.activatelistit:active { position: relative; top: 1px; left: 1px; }

.deactivatelistit { background: url(<?php echo W_SITEPATH?>img/items/button_no.png) transparent no-repeat top left; }
.deactivatelistit:hover { color: #008000 } 
.deactivatelistit:active { position: relative; top: 1px; left: 1px; }

/*  */
.ln_dw_sect_inf, .ln_up_sect_inf {
 display: inline-block; margin-left: 0px; width: 12px; cursor: pointer;
 background: url(<?php echo W_SITEPATH?>img/ico/formats/dw_ln_1.png) transparent no-repeat center left;	
}
.ln_up_sect_inf { background: url(<?php echo W_SITEPATH?>img/ico/formats/up_ln_1.png) transparent no-repeat center left; }

/* блок страниц на таблици */
.bgshort {
 display: inline-block; //width: 25px; //margin-left: 5px; //cursor: pointer;	 
 //background: url(<?php echo W_SITEPATH?>img/items/bg.gif) transparent no-repeat center left; 
}
.bgshortq {
 display: inline-block; width: 25px; margin-left: 5px; cursor: pointer;	 
 background: url(<?php echo W_SITEPATH?>img/items/bg.gif) transparent no-repeat center left; 
}

a.gotoregurl {
 padding-right: 10px; background: url(../img/items/emblem_symbolic_link.png) no-repeat right top;
 color: #008000; font-weight: bold; 
}

/* hide */
#hideblock { 
 border-style: solid; border-color: #D7D7D7; border-width: 1px; display: block; 
 padding-top: 4px; padding-bottom: 4px; background-color: #F8F8F8; height: auto; 
}
.hidetext { 
 border-top-style: solid; border-top-color: #D7D7D7; border-top-width: 1px; height: auto; 
 background-color: #FFFFFF; padding: 4px 4px 4px 8px; font-weight: normal; 
 margin-top: 4px; display: none; /* visibility: hidden; */
}
#hide_spase { 
 height: auto; padding-bottom: 2px; padding-top:  2px; 
}
#roll_down {
 background: url(../img/items/plus.gif) no-repeat center; height: 9px; width: 9px; 
 padding-left: 13px; cursor: pointer;
}
#roll_up {
 background: url(../img/items/minus.gif) no-repeat center; height: 9px; width: 9px; 
 padding-left: 13px; cursor: pointer;
}