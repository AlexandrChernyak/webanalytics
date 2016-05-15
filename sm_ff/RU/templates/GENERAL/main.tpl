<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8">
 <meta name="author" content="forwebm.net">
 <title>{$section_info.title}</title>
 <meta name="keywords" content="{$section_info.key}"/> 
 {if $section_info.description}<meta name="description" content="{$section_info.description}"/>{/if}
 
 <link rel="stylesheet" href="{$smarty.const.W_SITEPATH}css/css.php" type="text/css">
 {if $section_info.csslist}
  {foreach from=$section_info.csslist item=val name=val}    
   <link rel="stylesheet" href="{$smarty.const.W_SITEPATH}css/{$val}" media="screen" type="text/css"> 	   
  {/foreach}
 {/if} 
 <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/jquery-latest.js"></script>
 <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/js.js"></script>
 {if $section_info.jslist}
  {foreach from=$section_info.jslist item=val name=val}    
   <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/{$val}"></script>	   
  {/foreach}
 {/if} 
 {* tools wait script *}
 {if isset($tool_object)}
 {assign var="allowwaittoolsidents" value=$CONTROL_OBJ->CheckInArray($smarty.get.t1, 'w_toolitem_contentcheck,w_toolitem_whoisdomain,w_toolitem_whoisurlip,w_toolitem_analysis,w_toolitem_typosinkeyboard,w_toolitem_textanalisis,w_toolitem_robotslookurl,w_toolitem_checkurllinks,w_toolitem_keygeneratorurl')}
 {/if} 
 {if $allowwaittoolsidents}
 <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/waitelements-tools.js"></script>
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
  
 <!-- шапка begin ++ -->
 <div class="head_listen">
 <span style="width: 100%">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
	<td class="lc" valign="top" align="left" width="410">
	 <div class="logocontaner"> 
	  <a href="{$smarty.const.W_SITEPATH}" class="logo" title="На главную"></a>
	 </div>	
	</td>
	<td class="hc" valign="center" align="left">
	 
	 {literal}
	 <style type="text/css">
	  .langdiv { position: absolute; top: 10px; left: 365px; }
	  #linktohomeback { position: relative; top: -3px;  }
     </style>
	 {/literal}
	 <div class="langdiv">
	  <form method="post" style="display: inline" name="langselect" id="langselect">
       {foreach from=$_GLOBAL_LANGUAGE_LIST key=lang item=val name=val}
        <span {if $smarty.foreach.val.index > 0}style="margin-left: 3px"{/if}>		 
		 <a title="{$val}" href="{$smarty.const.W_SITEPATH}?ln={$lang}"{if $CONTROL_OBJ->GetActiveLanguage() != $lang} onclick="this.href='javascript:'; $('#langtosetnew').val('{$lang}'); $('#langselect').submit();"{/if}><img src="{$smarty.const.W_SITEPATH}img/ico/language/{$lang}.gif" border="0" alt="{$lang}" title="{$val}" style="width: 24px; height: 16px; {if $CONTROL_OBJ->GetActiveLanguage() != $lang}opacity:0.25;filter:alpha(opacity=25); cursor: pointer; {/if}"></a>
		</span>
       {/foreach}
       <input type="hidden" value="do" name="setnewlanguage">
       <input type="hidden" value="" name="langtosetnew" id="langtosetnew">
      </form>
	  <span style="margin-left: 14px">
	   <a id="linktohomeback" href="/">Вернуться на <label style="color: #333333">Главную</label></a>
	  </span>	  
	 </div>
	 	 
	 <div class="menubar">
	  <a class="menuItem" href="{$smarty.const.W_SITEPATH}tools/">Инструменты</a> 
	  <a class="menuItem" href="{$smarty.const.W_SITEPATH}news/">Новости</a>  
	  <a class="menuItem" href="{$smarty.const.W_SITEPATH}feedback/">Контакты</a> 
	 </div>	 
	</td>
	<td class="rc" valign="top" align="right">
	  
	  {if $CONTROL_OBJ->IsOnline()}
	  <!-- online info begin -->	  
	  <div class="regplace">
	   <div>Здравствуйте, <b><a href="{$smarty.const.W_SITEPATH}account/">{$CONTROL_OBJ->userdata.username}</a></b>!  
	   [ <a href="{$smarty.const.W_SITEPATH}exit/" class="restpsw" style="margin-left: 0px">Выход</a> ]</div>
	   <div style="margin-top: 10px">Баланс: <a href="{$smarty.const.W_SITEPATH}account/payhistory/">
	   <b style="color: #000000">{$CONTROL_OBJ->userdata.purcedata} USD</b></a></div>	   
	   <div>Новых сообщений: <a href="{$smarty.const.W_SITEPATH}account/mail/">
	   <b style="color: #FF0000">{$global_user_info.privatenew}</b></a></div>
	  </div>
	  <!-- online info end -->
	  {else}
	  <!-- auth info begin -->
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
      </script>
	  {/literal}
	  <div class="regplace">
	   <div>
	    <a href="{$smarty.const.W_SITEPATH}register/">Регистрация</a>
	    <a class="restpsw" href="{$smarty.const.W_SITEPATH}restore/">Забыли пароль?</a>
	    <span style="width: 45px; display: inline-block"></span>
	   </div>
	   <div>
	   <form method="post" name="qinput" id="qinput" onsubmit="return OnSd(this)">
	   <div>	   	      
	    <input type="text" class="inpt" style="width: 180px" name="qlogin" id="qlogin" 
		maxlength="99" onblur="OnBl(this,'Логин')" onfocus="OnFs(this,'Логин')" 
		value="{if $smarty.post.actionlog == 'do'}{$CONTROL_OBJ->HTMLspecialChars($smarty.post.qlogin)}{else}Логин{/if}">
	    <span style="width: 45px; display: inline-block"></span>
	   </div>
       <div>
	    <input type="password" class="inpt" style="width: 180px; margin-top: 8px" name="qpassw" id="qpassw" 
		onblur="OnBl(this,'Пароль')" onfocus="OnFs(this,'Пароль')" value="Пароль">
		<span class="qinpbuttonplace">
		  <input type="submit" class="butt" style="width: 43px" value="Вход">
		</span>
	   </div>
	   <input type="hidden" value="do" name="actionlog">	   
	   </form>
	   </div>   
	  </div>
	  <!-- auth info end -->
	  {/if}
	  	 
	</td>
  </tr>
  </table>
  </span> 
 </div> 
 <!-- шапка end -->  
 
 <!-- data begin -->
 <div class="content_spacer">
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
 <tr>
  <td class="def_td" valign="top" width="261px">
  <!-- left menu begin -->
  <div class="left_menu_data">
   {literal}
   <script type="text/javascript">
	function RollUpDownIdItem(idname, th) {
	 var id = document.getElementById(idname);
	 var up = (id.style.visibility == 'hidden') ? false : true;		
	 $('#'+idname).css('visibility', (up) ? 'hidden' : 'visible');
	 $('#'+idname).css('display', (up) ? 'none' : 'block');
	 th.className = (up) ? 'ln_dw_sect_inf' : 'ln_up_sect_inf';
	 setCookie('q_'+idname, (up) ? '0' : '1', false, '{/literal}{$smarty.const.W_COOKIESPATH}{literal}', '{/literal}{$smarty.const.W_COOKIESDOMAIN}{literal}');	 	
	}
	function initListCookiesMenu(list) {
	 var rdata = '';	
	 for (var i=0; i < list.length; i++) {
	  rdata = getCookie('q_'+list[i]);
	  if (rdata != null && rdata == '0') {
	   RollUpDownIdItem(list[i], document.getElementById('p'+list[i]));	   	
	  }	  	
	 }	 	
	}
	var Images = new Array();
	function PreloadImagesList(list) {
	 for (var i=0; i < list.length; i++) {
	  Images[i] = new Image();
	  Images[i].src = list[i];	
	 }	 	
	}//PreloadImagesList
	
	PreloadImagesList([{/literal}'{$smarty.const.W_SITEPATH}img/items/buttonbg_disabled.png'{literal}]);	
   </script>
   {/literal}     
   <!-- menu begin -->
   <div class="l_menu_space">
    <div class="ins">
     {if ($CONTROL_OBJ->strtolower($smarty.get.section) == 'accountff' || $CONTROL_OBJ->ReadOption('SHOWUSMENU')) 
	 && $CONTROL_OBJ->IsOnline()}
     <div><a href="{$smarty.const.W_SITEPATH}account/" class="upd_title">Управление кабинетом</a></div>
	 <div class="tdata">
    
	  <div class="sub_section_menu">
	   <label style="cursor: pointer" onclick="RollUpDownIdItem('account_block_items', document.getElementById('paccount_block_items'))">Кабинет</label>
	   <span id="paccount_block_items" class="ln_up_sect_inf" onclick="RollUpDownIdItem('account_block_items', this)">&nbsp;</span>
	  </div>
	  <div id="account_block_items">
	  <div style="margin-top: 10px"></div>
	  <div style="margin-left: 6px">
	  <img width="99" height="99" 
	  src="{$smarty.const.W_SITEPATH}{$smarty.const.W_FILESWEBPATH}/images/{$global_user_info.avatar}">
	  </div>
	  <div style="margin-top: 10px"></div>
	  
	  <a class="home" href="{$smarty.const.W_SITEPATH}account/"><b>{$CONTROL_OBJ->userdata.username}</b></a>
	  <a class="settings" href="{$smarty.const.W_SITEPATH}account/settings/">Изменить настройки</a>
	  <a class="money" href="{$smarty.const.W_SITEPATH}account/payhistory/">Операции со счетом</a>
	  <a class="mail" href="{$smarty.const.W_SITEPATH}account/mail/">Почта 
	  ({if $global_user_info.privatenew}<label id="red">{$global_user_info.privatenew}</label>/{/if}<label style="color: #000000">{$global_user_info.privateall}</label>)</a>
      <a class="admlinkvitrina" style="background: transparent url({$smarty.const.W_SITEPATH}img/ico/general/alliance_banner.png) no-repeat left top{if $smarty.get.hrzd == 'my-banners-list'}; font-weight: bold; text-decoration: none; color: #000000{/if}" href="{$smarty.const.W_SITEPATH}account/my-banners-list/">Мои баннеры</a>
        
	  <div style="margin-top: 20px"></div>	  
	  </div>	  
	 </div> 
	  {* меню администратора *}
	  {if $CONTROL_OBJ->isadminstatus}
	  <div class="tdata">  
	   <div class="sub_section_menu">
	    <label style="cursor: pointer" onclick="RollUpDownIdItem('account_admin_info_block', document.getElementById('paccount_admin_info_block'))">Административный раздел</label>
		<span class="ln_up_sect_inf" id="paccount_admin_info_block" onclick="RollUpDownIdItem('account_admin_info_block', this)">&nbsp;</span>
	   </div>
	   <div id="account_admin_info_block">	   
	   <div style="margin-top: 10px"></div>
	   <a class="adminformersfiles" href="{$smarty.const.W_SITEPATH}account/admmain/"{if $smarty.get.hrzd == 'admmain'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Общая информация</a>	   
	   <div style="margin-top: 10px"></div>	  
	   <a class="invitecode" href="{$smarty.const.W_SITEPATH}account/adminvitecodes/"{if $smarty.get.hrzd == 'adminvitecodes'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Инвайт коды регистрации</a>
	   <div style="margin-top: 10px"></div>	  
	   <a class="engineupdates" href="{$smarty.const.W_SITEPATH}account/admengupdates/"{if $smarty.get.hrzd == 'admengupdates'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Апдейты поисковиков</a>
	   <div style="margin-top: 10px"></div>	  
	   <a class="googlecenters" href="{$smarty.const.W_SITEPATH}account/admgooglecenters/"{if $smarty.get.hrzd == 'admgooglecenters'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Датацентры Google</a>
	   <div style="margin-top: 10px"></div>	  
	   <a class="fontssection" href="{$smarty.const.W_SITEPATH}account/admfontssection/"{if $smarty.get.hrzd == 'admfontssection'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Файлы шрифтов</a>
	   <div style="margin-top: 10px"></div>	  
	   <a class="adminformersfiles" href="{$smarty.const.W_SITEPATH}account/adminformersfiles/"{if $smarty.get.hrzd == 'adminformersfiles'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Изображения информеров</a>
	   <a class="admlinkvitrina" href="{$smarty.const.W_SITEPATH}account/admlinksvitrina/"{if $smarty.get.hrzd == 'admlinksvitrina'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Витрина ссылок</a>
       
       <a class="admlinkvitrina" style="background: transparent url({$smarty.const.W_SITEPATH}img/ico/general/alliance_banner.png) no-repeat left top{if $smarty.get.hrzd == 'admbunnerscontrol'}; font-weight: bold; text-decoration: none; color: #000000{/if}" href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/">Реклама баннеров</a>
             
       <a class="admsitenews" href="{$smarty.const.W_SITEPATH}account/admnewsitems/"{if $smarty.get.hrzd == 'admnewsitems'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Новости/Статьи/записи</a>
	   
	   <a class="admcommentssect" href="{$smarty.const.W_SITEPATH}account/admcommentslist/"{if $smarty.get.hrzd == 'admcommentslist'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Комментарии</a>
	   <a class="admtoolsoptions" href="{$smarty.const.W_SITEPATH}account/admtoolsoptions/"{if $smarty.get.hrzd == 'admtoolsoptions'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Параметры инструментов</a>
	   <a class="admtoolsoptions" href="{$smarty.const.W_SITEPATH}account/admgroupingtools/"{if $smarty.get.hrzd == 'admgroupingtools'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Группировка инструментов</a>
       
       <a class="adminformersfiles" style="background: transparent url({$smarty.const.W_SITEPATH}img/ico/general/word_files.png) no-repeat left top{if $smarty.get.hrzd == 'admtoolsimages'}; font-weight: bold; text-decoration: none; color: #000000{/if}" href="{$smarty.const.W_SITEPATH}account/admtoolsimages/">Иконки инструментов</a>
       
	   <a class="admstringstable" href="{$smarty.const.W_SITEPATH}account/admstringstable/"{if $smarty.get.hrzd == 'admstringstable'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Таблица строк</a>
	   <a class="admtoolsoptions" href="{$smarty.const.W_SITEPATH}account/admgeneralsuboptions/"{if $smarty.get.hrzd == 'admgeneralsuboptions'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Надстройки сайта</a>
	   <a class="admredirectlktable" href="{$smarty.const.W_SITEPATH}account/admredirectlktable/"{if $smarty.get.hrzd == 'admredirectlktable'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Перенаправления ссылок</a>
	   <a class="admuserslistenclass" href="{$smarty.const.W_SITEPATH}account/admuserslisten/"{if $smarty.get.hrzd == 'admuserslisten'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Пользователи сайта</a>
       
       <a class="admuserslistenclass" href="{$smarty.const.W_SITEPATH}account/admusersgroups/"{if $smarty.get.hrzd == 'admusersgroups'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Группы пользователей</a>
       
       <a class="adminformersfiles" href="{$smarty.const.W_SITEPATH}account/admrefbunners/"{if $smarty.get.hrzd == 'admrefbunners'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Реферальные баннеры</a>
       
       <a class="adminformersfiles" style="background: transparent url({$smarty.const.W_SITEPATH}img/ico/general/pages.png) no-repeat left top{if $smarty.get.hrzd == 'admpspageslist'}; font-weight: bold; text-decoration: none; color: #000000{/if}" href="{$smarty.const.W_SITEPATH}account/admpspageslist/">Отдельные страницы проекта</a>
	   
	   </div> 
	   <div style="margin-top: 20px"></div>	  	  	  
	  </div>
	  {literal}<script type="text/javascript">initListCookiesMenu(['account_admin_info_block']);</script>{/literal}	 
	  {/if}	 
	 {/if}	
	 {literal}<script type="text/javascript">initListCookiesMenu(['account_block_items']);</script>{/literal}  	    
	 <div><a href="{$smarty.const.W_SITEPATH}tools/" class="upd_title">Инструменты</a></div>
	 <div class="tdata">
	        
      {assign var="listtoolsX" value=$CONTROL_OBJ->GetToolsListByDEFAULTtamplateMain()} 
      {foreach from=$listtoolsX item=val name=val}
       <div style="margin-top: 6px"></div>
       <div class="sub_section_menu">{$val.group.name}</div>
       <div style="margin-top: 10px"></div>
       {foreach from=$val.data item=val1 name=val1}
         <span style="width: 100%">
          <table width="100%" cellpadding="0" cellspacing="0">
           <tr>
            
            <td valign="top" align="left" width="22px" style="padding-left: 2px">
             <img src="{$CONTROL_OBJ->GetToolImageStyle($val1.name, 16, '', '')}" style="width: 16px; height: 16px">  
            </td>
            
            <td valign="top" align="left">             
             <a class="massurlspeedtest" style="margin-left: 0px; padding-left: 0px; height: auto; {if $smarty.get.t1 == 'w_toolitem_'|cat:$val1.name}; color: #000000;{/if}" href="{$smarty.const.W_SITEPATH}tools/{$val1.name}/">{$CONTROL_OBJ->GetText($val1.value.descr)}</a>          
            </td>
            
           </tr>
          </table>
         </span>
       {/foreach}
      {/foreach}
	  	  	  
	 </div>
	 
	</div>
   </div>
   <!-- menu end -->
   
  </div>
  <!-- left menu end -->
  
  </td>
  <td class="def_td" valign="top" align="left">
  <div class="c_content">
  <!-- content begin -->
  {if $section_way}
  <div class="contentway"> 
   {foreach from=$section_way item=val name=val}    
    {if $smarty.foreach.val.index > 0}
     <label>&nbsp;</label>
    {/if}  
    <a href="{$val.path}">{$val.name}</a>	   
   {/foreach}
  </div>
  <div class="contentway_btn"></div>  
  {/if}
  
  {if $smarty.const.W_HTMLCODETOPCENTERBLOCK}
   <div style="margin-top: 2px"></div>
   <div>{$CONTROL_OBJ->GetText($smarty.const.W_HTMLCODETOPCENTERBLOCK)}</div>
  {/if}
  
  {if $section_info.stitle}
   <div class="content_title">
    <span>{$section_info.stitle}</span>
   </div>
  {/if}    
  {include file=$section_info.file}  
  <!-- content end -->
  
  </div>
  </td>
  <td class="def_td_r" valign="top">  

  </td>
 </tr>
 </table>
 </span>
 </div>
 <!-- data end -->
 


 
 {if $smarty.post.actionlog == 'do'}
  {if $CONTROL_OBJ->auth_error_str}
   <script type="text/javascript">
	alert('{$CONTROL_OBJ->auth_error_str}');
   </script>
  {/if} 
 {/if}
 
</body>
</html>