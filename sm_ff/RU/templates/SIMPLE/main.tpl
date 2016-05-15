<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8">
 <meta name="author" content="forwebm.net">
 <title>{$section_info.title}</title>
 <meta name="keywords" content="{$section_info.key}"/> 
 {if $section_info.description}<meta name="description" content="{$section_info.description}"/>{/if}
 
 <link rel="stylesheet" href="{$smarty.const.W_SITEPATH}athemes/SIMPLE/css.css" type="text/css"> 
 {if $section_info.csslist}
  {foreach from=$section_info.csslist item=val name=val}    
   <link rel="stylesheet" href="{$smarty.const.W_SITEPATH}css/{$val}" media="screen" type="text/css"> 	   
  {/foreach}
 {/if} 
 
 {if !$CONTROL_OBJ->IsOnline()}
  <link rel="stylesheet" href="{$smarty.const.W_SITEPATH}css/ui/jquery-ui-1.8.11.custom.css" media="screen" type="text/css">
 {/if}
 
 <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/jquery-latest.js"></script>
 <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/js.js"></script>
 <script type="text/javascript" src="{$smarty.const.W_SITEPATH}athemes/SIMPLE/footer.js"></script>
 
 {* tools wait script *}
 {if isset($tool_object)}
 {assign var="allowwaittoolsidents" value=$CONTROL_OBJ->CheckInArray($smarty.get.t1, 'w_toolitem_contentcheck,w_toolitem_whoisdomain,w_toolitem_whoisurlip,w_toolitem_analysis,w_toolitem_typosinkeyboard,w_toolitem_textanalisis,w_toolitem_robotslookurl,w_toolitem_checkurllinks,w_toolitem_keygeneratorurl')}
 {/if}
 
 {if $allowwaittoolsidents}
 <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/waitelements-tools.js"></script>
 <script type="text/javascript" src="{$smarty.const.W_SITEPATH}css/panel/jquery.corner.js"></script>
 {/if}
 
 {if !$CONTROL_OBJ->IsOnline()}
  <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/jquery.ui.custom.min.js"></script>
 {/if}
 
 {if $section_info.jslist}
  {foreach from=$section_info.jslist item=val name=val}    
   <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/{$val}"></script>	   
  {/foreach}
 {/if} 
</head>
<body id="globalbodydata">
 
 {* tools wait script, preload image data *}
 {if $allowwaittoolsidents}
  {literal}
  <script type="text/javascript">
	$(document).ready(function() {
	 wait_progress_element.initImage(
      '{/literal}{$smarty.const.W_SITEPATH}athemes/SIMPLE/img/ajax-loader.gif{literal}'
     ); 
     
     var toolform_obj = document.getElementById('toolform');
     if (toolform_obj) {
         
      toolform_obj.onsubmit = function () {
       
       if (typeof window['PrepereToSend'] == 'function') {
        if (!PrepereToSend(this)) { return false; }        
       }
       
       wait_progress_element.Wait('Запрос обрабатывается, подождите..');
        
       return true;
        
      };        
     }     
           
    });   
  </script>
  {/literal} 
 {/if} 
 
 {include file="init_sape_code.tpl"}
 
 <div class="toplinebg"></div>

 <div class="bodycontainer"> 
  
 <!-- header begin --> 
 <div class="headerspace"><span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0"> 
 <tr>
  <td valign="top" align="left" width="210px" style="padding-left: 25px; padding-right: 3px;{if $smarty.post.doactiontool == 'do' && !$ismain_page} background: #F9F9F9;{/if}">
   <div><a href="{$smarty.const.W_SITEPATH}" class="logo"></a></div>
   <!-- lang list begin -->
   <div class="languagelist">   
    <form method="post" style="display: inline" name="langselect" id="langselect">
     {foreach from=$_GLOBAL_LANGUAGE_LIST key=lang item=val name=val}
     <span {if $smarty.foreach.val.index > 0}style="margin-left: 3px"{/if}>
	  <noindex><a rel="nofollow" title="{$val}" href="{$smarty.const.W_SITEPATH}?ln={$lang}"{if $CONTROL_OBJ->GetActiveLanguage() != $lang} onclick="this.href='javascript:'; $('#langtosetnew').val('{$lang}'); $('#langselect').submit();"{/if}><img src="{$smarty.const.W_SITEPATH}img/ico/language/{$lang}.gif" border="0" alt="{$lang}" title="{$val}" style="width: 26px; height: 18px; {if $CONTROL_OBJ->GetActiveLanguage() != $lang}opacity:0.25;filter:alpha(opacity=25); cursor: pointer; {/if}"></a></noindex>
	 </span>
     {/foreach}
     <input type="hidden" value="do" name="setnewlanguage">
     <input type="hidden" value="" name="langtosetnew" id="langtosetnew">
    </form> 
   </div>
   <!-- lang list end -->
   
   <!-- general menu list begin -->
   <div class="menulistblock">
    <a href="{$smarty.const.W_SITEPATH}" class="home">На главную</a>    
    <a href="{$smarty.const.W_SITEPATH}tools/" class="tools"{if $smarty.get.section == 'toolsaction'} style="font-weight: bold; text-decoration: none;"{/if}>Инструменты</a>
    <a href="{$smarty.const.W_SITEPATH}panel/" class="admuserslistenclass"{if $smarty.get.section == 'panelitemsaction'} style="font-weight: bold; text-decoration: none;"{/if}>Панель оптимизатора</a>
	
	<div style="margin-top: 10px"></div>
	
    {* all dinamic sections *}
    {assign var="dinamicmenuitemslist" value=$CONTROL_OBJ->GetAllAvRecordsList()}    
    {if !$dinamicmenuitemslist}    
     <a href="{$smarty.const.W_SITEPATH}news/"{if $smarty.get.section == 'newslisten'} style="font-weight: bold; text-decoration: none;"{/if}>Новости</a>
    {else}
     {foreach from=$dinamicmenuitemslist key=path item=nval name=nval}    
      <a href="{$smarty.const.W_SITEPATH}{$path}/"{if $smarty.get.identway == $path} style="font-weight: bold; text-decoration: none;"{/if}>{$nval}</a>    
     {/foreach}
    {/if}   
    
    <a href="{$smarty.const.W_SITEPATH}advertising/"{if $smarty.get.section == 'advertisingpagefile'} style="font-weight: bold; text-decoration: none;"{/if}>Реклама у нас</a>  
	<a href="{$smarty.const.W_SITEPATH}feedback/"{if $smarty.get.section == 'feedbackpt'} style="font-weight: bold; text-decoration: none;"{/if}>Обратная связь</a>   
     
             
    <!-- account menu begin -->
    {if ($smarty.get.section == 'accountff' || $CONTROL_OBJ->ReadOption('SHOWUSMENU')) && $CONTROL_OBJ->IsOnline()}
     <div style="margin-top: 35px">
      <div style="margin-bottom: 10px; font-weight: bold">Управление кабинетом</div>      
	  <a class="home" href="{$smarty.const.W_SITEPATH}account/"{if !$smarty.get.hrzd && $smarty.get.section == 'accountff'} style="font-weight: bold; text-decoration: none;"{/if}><b>{$CONTROL_OBJ->userdata.username}</b></a>
	  <a class="settings" href="{$smarty.const.W_SITEPATH}account/settings/"{if $smarty.get.hrzd == 'settings'} style="font-weight: bold; text-decoration: none;"{/if}>Изменить настройки</a>
	  <a class="money" href="{$smarty.const.W_SITEPATH}account/payhistory/"{if $smarty.get.hrzd == 'payhistory'} style="font-weight: bold; text-decoration: none;"{/if}>Операции со счетом</a>
	  <a class="mail" href="{$smarty.const.W_SITEPATH}account/mail/"{if $smarty.get.hrzd == 'mail'} style="font-weight: bold; text-decoration: none;"{/if}>Почта 
	  ({if $global_user_info.privatenew}<label id="red">{$global_user_info.privatenew}</label>/{/if}<label style="color: #000000">{$global_user_info.privateall}</label>)</a>     
      <a class="admlinkvitrina" style="background: transparent url({$smarty.const.W_SITEPATH}img/ico/general/alliance_banner.png) no-repeat left top{if $smarty.get.hrzd == 'my-banners-list'}; font-weight: bold; text-decoration: none;{/if}" href="{$smarty.const.W_SITEPATH}account/my-banners-list/">Мои баннеры</a>       
	 </div>    
    {/if}
    <!-- account menu and -->
    
    {if $smarty.get.section == 'accountff' && $CONTROL_OBJ->IsOnline() && $CONTROL_OBJ->isadminstatus}
    <!-- account admin menu begin -->
     <div style="margin-top: 35px">
      <div style="margin-bottom: 10px; font-weight: bold">Администрирование</div>      	  
	   <a class="adminformersfiles" href="{$smarty.const.W_SITEPATH}account/admmain/"{if $smarty.get.hrzd == 'admmain'} style="font-weight: bold; text-decoration: none;"{/if}>Общая информация</a>
	   <a class="invitecode" href="{$smarty.const.W_SITEPATH}account/adminvitecodes/"{if $smarty.get.hrzd == 'adminvitecodes'} style="font-weight: bold; text-decoration: none;"{/if}>Инвайт коды регистрации</a> 
	   <a class="engineupdates" href="{$smarty.const.W_SITEPATH}account/admengupdates/"{if $smarty.get.hrzd == 'admengupdates'} style="font-weight: bold; text-decoration: none;"{/if}>Апдейты поисковиков</a>
	   <a class="googlecenters" href="{$smarty.const.W_SITEPATH}account/admgooglecenters/"{if $smarty.get.hrzd == 'admgooglecenters'} style="font-weight: bold; text-decoration: none;"{/if}>Датацентры Google</a>
	   <a class="fontssection" href="{$smarty.const.W_SITEPATH}account/admfontssection/"{if $smarty.get.hrzd == 'admfontssection'} style="font-weight: bold; text-decoration: none;"{/if}>Файлы шрифтов</a>
	   <a class="adminformersfiles" href="{$smarty.const.W_SITEPATH}account/adminformersfiles/"{if $smarty.get.hrzd == 'adminformersfiles'} style="font-weight: bold; text-decoration: none;"{/if}>Изображения информеров</a>
	   <a class="admlinkvitrina" href="{$smarty.const.W_SITEPATH}account/admlinksvitrina/"{if $smarty.get.hrzd == 'admlinksvitrina'} style="font-weight: bold; text-decoration: none;"{/if}>Витрина ссылок</a>            
       <a class="admlinkvitrina" style="background: transparent url({$smarty.const.W_SITEPATH}img/ico/general/alliance_banner.png) no-repeat left top{if $smarty.get.hrzd == 'admbunnerscontrol'}; font-weight: bold; text-decoration: none;{/if}" href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/">Реклама баннеров</a>
  	   
       <a class="adminetnews" href="{$smarty.const.W_SITEPATH}account/admnewsitems/"{if $smarty.get.hrzd == 'admnewsitems'} style="font-weight: bold; text-decoration: none;"{/if}>Новости/Статьи/записи</a>
       
	   <a class="admcommentssect" href="{$smarty.const.W_SITEPATH}account/admcommentslist/"{if $smarty.get.hrzd == 'admcommentslist'} style="font-weight: bold; text-decoration: none;"{/if}>Комментарии</a>
	   <a class="admtoolsoptions" href="{$smarty.const.W_SITEPATH}account/admtoolsoptions/"{if $smarty.get.hrzd == 'admtoolsoptions'} style="font-weight: bold; text-decoration: none;"{/if}>Параметры инструментов</a>
	   
	   <a class="admtoolsoptions" href="{$smarty.const.W_SITEPATH}account/admgroupingtools/"{if $smarty.get.hrzd == 'admgroupingtools'} style="font-weight: bold; text-decoration: none;"{/if}>Группировка инструментов</a>
       
       <a class="adminformersfiles" style="background: transparent url({$smarty.const.W_SITEPATH}img/ico/general/word_files.png) no-repeat left top{if $smarty.get.hrzd == 'admtoolsimages'}; font-weight: bold; text-decoration: none;{/if}" href="{$smarty.const.W_SITEPATH}account/admtoolsimages/">Иконки инструментов</a>
	   
	   <a class="admstringstable" href="{$smarty.const.W_SITEPATH}account/admstringstable/"{if $smarty.get.hrzd == 'admstringstable'} style="font-weight: bold; text-decoration: none;"{/if}>Таблица строк</a>
	   <a class="admtoolsoptions" href="{$smarty.const.W_SITEPATH}account/admgeneralsuboptions/"{if $smarty.get.hrzd == 'admgeneralsuboptions'} style="font-weight: bold; text-decoration: none;"{/if}>Надстройки сайта</a>
	   <a class="admredirectlktable" href="{$smarty.const.W_SITEPATH}account/admredirectlktable/"{if $smarty.get.hrzd == 'admredirectlktable'} style="font-weight: bold; text-decoration: none;"{/if}>Перенаправления ссылок</a>
	   <a class="admuserslistenclass" href="{$smarty.const.W_SITEPATH}account/admuserslisten/"{if $smarty.get.hrzd == 'admuserslisten'} style="font-weight: bold; text-decoration: none;"{/if}>Пользователи сайта</a>
       
       <a class="admuserslistenclass" href="{$smarty.const.W_SITEPATH}account/admusersgroups/"{if $smarty.get.hrzd == 'admusersgroups'} style="font-weight: bold; text-decoration: none;"{/if}>Группы пользователей</a>
       
       <a class="adminformersfiles" href="{$smarty.const.W_SITEPATH}account/admrefbunners/"{if $smarty.get.hrzd == 'admrefbunners'} style="font-weight: bold; text-decoration: none;"{/if}>Реферальные баннеры</a>
       
       <a class="adminformersfiles" style="background: transparent url({$smarty.const.W_SITEPATH}img/ico/general/pages.png) no-repeat left top{if $smarty.get.hrzd == 'admpspageslist'}; font-weight: bold; text-decoration: none;{/if}" href="{$smarty.const.W_SITEPATH}account/admpspageslist/">Отдельные страницы проекта</a>       
       	  	   
	 </div>    
    <!-- account admin menu and -->
	{/if}
    
   </div>
   <!-- general menu list end -->
   
   <!-- news list begin -->
   {if !$ismain_page}
    <div class="leftmenudwblocknews">
     <div>
	  <a class="black" href="{$smarty.const.W_SITEPATH}news/1/" style="font-weight: bold; text-decoration: none;">Новости сайта</a>
	 </div>
	 <div style="margin-top: 8px; font-size: 95%">
	  {include file="items/last_news_block.tpl" newstype='1' limit='5' fontsize='100%' fontsizeallnews='95%' fulldate='1' noshowallnews='1' marginleft='0px'}
	 </div>
	</div>
   {/if}   
   <!-- news list end -->
   
   {if $smarty.post.doactiontool == 'do' && !$ismain_page}
    <!-- updates begin -->
	<div class="leftmenudwblockupdates">
     <div>
	  <a class="black" href="{$smarty.const.W_SITEPATH}updates/" style="font-weight: bold; text-decoration: none;">Апдейты поисковиков</a>
	 </div>
     <div style="margin-top: 8px">
	  {include file="items/updates_block.tpl"}
	 </div>
	</div>
	<!-- updates end --> 
  
	
	<!-- links vitrina begin -->
    <div class="leftmenudwblockupdates">
     {include file="items/links_vitrina_block.tpl" linkfontsize='95%' linkleftmargin='0px'}
    </div>  
    <!-- links vitrina end -->  
    
    {if $smarty.const.W_HTMLCODERIGHTDOWNBLOCK}
     <div class="leftmenudwblockupdates"><div>{$CONTROL_OBJ->GetText($smarty.const.W_HTMLCODERIGHTDOWNBLOCK)}</div></div>
    {/if}
    
    <div style="margin-top: 15px; padding-left: 7px; color: #C0C0C0; font-size: 95%">{include file="sape_code.tpl"}</div>
    
   {/if}
   
   {if $ismain_page}
    {* блок по левому краю, после основного меню - указывается в админке - отображается только на главной *}

    
    {if $smarty.const.W_HTMLCODELEFTDOWNBLOCKAFTMENU}
     <div class="leftmenudwblockupdates" style="margin-left: 0px">
      <div>{$CONTROL_OBJ->GetText($smarty.const.W_HTMLCODELEFTDOWNBLOCKAFTMENU)}</div>
     </div>
    {/if}  
   {/if}
   
   		
  </td>
  <td valign="top" align="left">
   <!-- header info line block begin -->
   <div id="rounded-box-5">
	 <b class="r5"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b><b class="r1"></b>
	 <div class="inner-box">
	  <span style="width: 100%">
	   <table width="100%" cellpadding="0" cellspacing="0">
       <tr>
	    <td valign="center" align="left">
	     {* information title info *}
	     <div><span style="width: 100%">
		 <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
	       <td valign="top" align="left" width="{if isset($tool_object)}20px{else}1px{/if}">
	       {if isset($tool_object)}
	        {* иконка инструмента *}
	        <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 16, '', '')}" style="width: 16px; height: 16px;">
	       {/if}		   
		   </td>
	       <td valign="center" align="left">
	        <div class="content_title"><h1 style="font-size: 105%">{if $section_info.stitle}{$section_info.stitle}{else}Инструменты для вебмастера и оптимизатора{/if}</h1></div>
		   </td>
          </tr>
         </table>
		 </span></div>
		</td>
	    <td valign="center" align="right" width="200px" style="white-space: nowrap;">
		 {if $CONTROL_OBJ->IsOnline()}
		  {* online info *}
		  <div>Здравствуйте, <b><a href="{$smarty.const.W_SITEPATH}account/">{$CONTROL_OBJ->userdata.username}</a></b>! <span style="margin-left: 6px">[ <a href="{$smarty.const.W_SITEPATH}exit/" class="black" style="margin-left: 0px; font-size: 95%">Выход</a> ]</span></div>
		  <div style="margin-top: 5px; font-size: 95%">
		  Баланс: <a href="{$smarty.const.W_SITEPATH}account/payhistory/"><b style="color: #000000">{$CONTROL_OBJ->userdata.purcedata} USD</b></a>, новых сообщений: <a href="{$smarty.const.W_SITEPATH}account/mail/"><b style="color: #FF0000">{$global_user_info.privatenew}</b></a>
		  </div>
		 {else}
		  {* no online info *}		  
		  <div><a href="#" onclick="ShowDialogInput()" class="black_dashed">Войти</a> или <a class="black" href="{$smarty.const.W_SITEPATH}register/">зарегистрироваться</a></div>
		  <div style="margin-top: 5px; font-size: 95%">		  
		   <a class="gray" href="{$smarty.const.W_SITEPATH}restore/">Забыли пароль?</a>
		  </div>		 		 
		 {/if}		
		</td>
       </tr>
       </table>
	  </span>	 
	 </div>
	 <b class="r1"></b><b class="r1"></b><b class="r2"></b><b class="r3"></b><b class="r5"></b>
	</div>
   <!-- header info line block end -->
   
   {* поле входа в кабинет *}
   {if !$CONTROL_OBJ->IsOnline()}
        {literal}
	    <script type="text/javascript">
	     function OnBl(th,val) { if (th.value == '') { th.value = val; } }
	     function OnFs(th,val) { if (th.value == val) { th.value = ''; } }
	     function OnSd(th) {
		  if (th.qlogin.value == '' || th.qlogin.value == 'Логин' || th.qpassw.value == '' || th.qpassw.value == 'Пароль') {
		   alert('Укажите логин и пароль для авторизации!');
		   th.qlogin.focus();
		   return false;	
		  }
		  return true;
	     }
	     
	     function ShowDialogInput() {	 	
          $("#dialog_input").dialog({
           title: "Вход в кабинет", 
           width:  275,            
           height: 115,
		   position: ["right","top"],         
           modal: true,            
           buttons: {},
           resizable: false,
           create: function(event, ui) {
		   	
		   	
		   }
           });	
          }//ShowDialogSaveData
        </script>
	    {/literal}
   <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
       <span id="ui-dialog-title-dialog" class="ui-dialog-title">Вход в кабинет</span>
       <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
    </div>
    <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_input">
       <div class="typelabel">        
        
		<form method="post" name="qinput" id="qinput" onsubmit="return OnSd(this)">
	    <div>	   	      
	     <input type="text" class="inpt" style="width: 165px" name="qlogin" id="qlogin" maxlength="99" onblur="OnBl(this,'Логин')" onfocus="OnFs(this,'Логин')" value="{if $smarty.post.actionlog == 'do'}{$CONTROL_OBJ->HTMLspecialChars($smarty.post.qlogin)}{else}Логин{/if}">
	     <span class="qinpbuttonplace">
		  <input type="button" class="butt" style="width: 55px" value="&nbsp;Отмена&nbsp;" onclick="$('#dialog_input').dialog('close')">
	 	 </span>
	    </div>
        <div>
	     <input type="password" class="inpt" style="width: 165px; margin-top: 8px" name="qpassw" id="qpassw" onblur="OnBl(this,'Пароль')" onfocus="OnFs(this,'Пароль')" value="Пароль">
		 <span class="qinpbuttonplace">
		  <input type="submit" class="butt" style="width: 55px" value="&nbsp;Вход&nbsp;">
	 	 </span>
	    </div>
	    <input type="hidden" value="do" name="actionlog">	   
	    </form>
        
        
       </div>   	      
    </div>
   </div>
    
   {/if}
   
   <!-- navigation line begin -->
   {if $section_way}
   <div class="contentway"> 
   {foreach from=$section_way item=val name=val}    
    {if $smarty.foreach.val.index > 0}
     <label>&nbsp;</label>
    {/if}  
    <a href="{$val.path}">{$val.name}</a>		   
   {/foreach}
   </div>  
  {/if}
   <!-- navigation line end -->
   
   {if !$ismain_page && $smarty.const.W_HTMLCODETOPCENTERBLOCK}
    <div style="margin-top: 2px"></div>
    <div style="padding-left: 14px">{$CONTROL_OBJ->GetText($smarty.const.W_HTMLCODETOPCENTERBLOCK)}</div>
   {/if}

   
   <!-- content here begin -->
   <div class="contentdata">
    <span style="width: 100%">
	<table width="100%" cellpadding="0" cellspacing="0">
     <tr>
	  <td valign="top" align="left" style="padding-right: 6px">
	   
	   {* content here *}
	   {include file=$section_info.file}
	   
	  </td>
	  <td valign="top" align="left" width="{if $smarty.post.doactiontool == 'do' || $ismain_page}0px{else}260px{/if}">	  
	  	   
	   {if $smarty.post.doactiontool != 'do' && !$ismain_page}	
	    <!-- links vitrina begin -->
        <div class="leftmenudwblockupdates" style="margin-top: 0px">
         {include file="items/links_vitrina_block.tpl" linkfontsize='100%' linkleftmargin='0px'}
        </div>  
        <!-- links vitrina end -->
		
		<!-- updates begin -->
	    <div class="leftmenudwblockupdates">
         
         
	    </div>
	    <!-- updates end -->

	    
	    <!-- news begin -->
	    
        
        {if $smarty.const.W_HTMLCODERIGHTDOWNBLOCK}
         <div class="leftmenudwblockupdates"><div>{$CONTROL_OBJ->GetText($smarty.const.W_HTMLCODERIGHTDOWNBLOCK)}</div></div>
        {/if}
        
        <div style="margin-top: 15px; padding-left: 7px; color: #C0C0C0; font-size: 95%">{include file="sape_code.tpl"}</div>
			   
	   {/if}
	  </td>
     </tr>
    </table>
	</span>
   </div>  
   <!-- content here end -->
     
  </td>
 </tr>
 </table>
 </span></div>
 <!-- header end -->  
 </div>
 
 <div style="padding-left: 260px; color: #C0C0C0{if $smarty.post.doactiontool == 'do'}; margin-top: 29px;{/if}">
 {if $ismain_page}{include file="sape_code.tpl"}{else}{include file="sape_code2.tpl"}{/if}
 </div>
 
 
 
 
 {if $smarty.post.actionlog == 'do'}
  {if $CONTROL_OBJ->auth_error_str}
   <script type="text/javascript">
	alert('{$CONTROL_OBJ->auth_error_str}');
   </script>
  {/if} 
 {/if}
 
</body>
</html>