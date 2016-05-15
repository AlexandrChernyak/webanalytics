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
 
 {if !$CONTROL_OBJ->IsOnline()}
  <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/jquery.ui.custom.min.js"></script>
 {/if}
 
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
       
       wait_progress_element.Wait('Processed, please wait ..');
        
       return true;
        
      };        
     }     
           
    });   
  </script>
  {/literal} 
 {/if}
 
 
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
	  <a title="{$val}" href="{$smarty.const.W_SITEPATH}?ln={$lang}"{if $CONTROL_OBJ->GetActiveLanguage() != $lang} onclick="this.href='javascript:'; $('#langtosetnew').val('{$lang}'); $('#langselect').submit();"{/if}><img src="{$smarty.const.W_SITEPATH}img/ico/language/{$lang}.gif" border="0" alt="{$lang}" title="{$val}" style="width: 26px; height: 18px; {if $CONTROL_OBJ->GetActiveLanguage() != $lang}opacity:0.25;filter:alpha(opacity=25); cursor: pointer; {/if}"></a>
	 </span>
     {/foreach}
     <input type="hidden" value="do" name="setnewlanguage">
     <input type="hidden" value="" name="langtosetnew" id="langtosetnew">
    </form> 
   </div>
   <!-- lang list end -->
   
   <!-- general menu list begin -->
   <div class="menulistblock">
    <a href="{$smarty.const.W_SITEPATH}" class="home">Home</a>    
    <a href="{$smarty.const.W_SITEPATH}tools/" class="tools"{if $smarty.get.section == 'toolsaction'} style="font-weight: bold; text-decoration: none;"{/if}>Tools List</a>
    <a href="{$smarty.const.W_SITEPATH}panel/" class="admuserslistenclass"{if $smarty.get.section == 'panelitemsaction'} style="font-weight: bold; text-decoration: none;"{/if}>SEO Panel</a>
	
	<div style="margin-top: 10px"></div>
    
    {* all dinamic sections *}
    {assign var="dinamicmenuitemslist" value=$CONTROL_OBJ->GetAllAvRecordsList()}    
    {if !$dinamicmenuitemslist}    
     <a href="{$smarty.const.W_SITEPATH}news/"{if $smarty.get.section == 'newslisten'} style="font-weight: bold; text-decoration: none;"{/if}>News Section</a>
    {else}
     {foreach from=$dinamicmenuitemslist key=path item=nval name=nval}    
      <a href="{$smarty.const.W_SITEPATH}{$path}/"{if $smarty.get.identway == $path} style="font-weight: bold; text-decoration: none;"{/if}>{$nval}</a>    
     {/foreach}
    {/if}    
     
    <a href="{$smarty.const.W_SITEPATH}advertising/"{if $smarty.get.section == 'advertisingpagefile'} style="font-weight: bold; text-decoration: none;"{/if}>Advertise with us</a> 
	<a href="{$smarty.const.W_SITEPATH}feedback/"{if $smarty.get.section == 'feedbackpt'} style="font-weight: bold; text-decoration: none;"{/if}>Feedback</a> 
             
    <!-- account menu begin -->
    {if ($smarty.get.section == 'accountff' || $CONTROL_OBJ->ReadOption('SHOWUSMENU')) && $CONTROL_OBJ->IsOnline()}
     <div style="margin-top: 35px">
      <div style="margin-bottom: 10px; font-weight: bold">Account Control Panel</div>      
	  <a class="home" href="{$smarty.const.W_SITEPATH}account/"{if !$smarty.get.hrzd && $smarty.get.section == 'accountff'} style="font-weight: bold; text-decoration: none;"{/if}><b>{$CONTROL_OBJ->userdata.username}</b></a>
	  <a class="settings" href="{$smarty.const.W_SITEPATH}account/settings/"{if $smarty.get.hrzd == 'settings'} style="font-weight: bold; text-decoration: none;"{/if}>Edit settings</a>
	  <a class="money" href="{$smarty.const.W_SITEPATH}account/payhistory/"{if $smarty.get.hrzd == 'payhistory'} style="font-weight: bold; text-decoration: none;"{/if}>Transactions with balance</a>
	  <a class="mail" href="{$smarty.const.W_SITEPATH}account/mail/"{if $smarty.get.hrzd == 'mail'} style="font-weight: bold; text-decoration: none;"{/if}>Mail 
	  ({if $global_user_info.privatenew}<label id="red">{$global_user_info.privatenew}</label>/{/if}<label style="color: #000000">{$global_user_info.privateall}</label>)</a>
      <a class="admlinkvitrina" style="background: transparent url({$smarty.const.W_SITEPATH}img/ico/general/alliance_banner.png) no-repeat left top{if $smarty.get.hrzd == 'my-banners-list'}; font-weight: bold; text-decoration: none;{/if}" href="{$smarty.const.W_SITEPATH}account/my-banners-list/">My banners</a> 
	 </div>    
    {/if}
    <!-- account menu and -->
    
    {if $smarty.get.section == 'accountff' && $CONTROL_OBJ->IsOnline() && $CONTROL_OBJ->isadminstatus}
    <!-- account admin menu begin -->
     <div style="margin-top: 35px">
      <div style="margin-bottom: 10px; font-weight: bold">Administration</div>
	   <a class="adminformersfiles" href="{$smarty.const.W_SITEPATH}account/admmain/"{if $smarty.get.hrzd == 'admmain'} style="font-weight: bold; text-decoration: none;"{/if}>General Information</a>      	  
	   <a class="invitecode" href="{$smarty.const.W_SITEPATH}account/adminvitecodes/"{if $smarty.get.hrzd == 'adminvitecodes'} style="font-weight: bold; text-decoration: none;"{/if}>Invite registration codes</a> 
	   <a class="engineupdates" href="{$smarty.const.W_SITEPATH}account/admengupdates/"{if $smarty.get.hrzd == 'admengupdates'} style="font-weight: bold; text-decoration: none;"{/if}>Updates search engine</a>
	   <a class="googlecenters" href="{$smarty.const.W_SITEPATH}account/admgooglecenters/"{if $smarty.get.hrzd == 'admgooglecenters'} style="font-weight: bold; text-decoration: none;"{/if}>Google Datacentres</a>
	   <a class="fontssection" href="{$smarty.const.W_SITEPATH}account/admfontssection/"{if $smarty.get.hrzd == 'admfontssection'} style="font-weight: bold; text-decoration: none;"{/if}>Font files</a>
	   <a class="adminformersfiles" href="{$smarty.const.W_SITEPATH}account/adminformersfiles/"{if $smarty.get.hrzd == 'adminformersfiles'} style="font-weight: bold; text-decoration: none;"{/if}>Images Informer</a>
	   <a class="admlinkvitrina" href="{$smarty.const.W_SITEPATH}account/admlinksvitrina/"{if $smarty.get.hrzd == 'admlinksvitrina'} style="font-weight: bold; text-decoration: none;"{/if}>Showcase Links</a>
       
       <a class="admlinkvitrina" style="background: transparent url({$smarty.const.W_SITEPATH}img/ico/general/alliance_banner.png) no-repeat left top{if $smarty.get.hrzd == 'admbunnerscontrol'}; font-weight: bold; text-decoration: none;{/if}" href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/">Advertising banners</a>
	          
       <a class="adminetnews" href="{$smarty.const.W_SITEPATH}account/admnewsitems/"{if $smarty.get.hrzd == 'admnewsitems'} style="font-weight: bold; text-decoration: none;"{/if}>News/Articles/Records</a>
             
	   <a class="admcommentssect" href="{$smarty.const.W_SITEPATH}account/admcommentslist/"{if $smarty.get.hrzd == 'admcommentslist'} style="font-weight: bold; text-decoration: none;"{/if}>Comments</a>
	   <a class="admtoolsoptions" href="{$smarty.const.W_SITEPATH}account/admtoolsoptions/"{if $smarty.get.hrzd == 'admtoolsoptions'} style="font-weight: bold; text-decoration: none;"{/if}>Tools Options</a>
	   
	   <a class="admtoolsoptions" href="{$smarty.const.W_SITEPATH}account/admgroupingtools/"{if $smarty.get.hrzd == 'admgroupingtools'} style="font-weight: bold; text-decoration: none;"{/if}>Grouping tools</a>
       
       <a class="adminformersfiles" style="background: transparent url({$smarty.const.W_SITEPATH}img/ico/general/word_files.png) no-repeat left top{if $smarty.get.hrzd == 'admtoolsimages'}; font-weight: bold; text-decoration: none;{/if}" href="{$smarty.const.W_SITEPATH}account/admtoolsimages/">Tools Icons</a>
	   
	   <a class="admstringstable" href="{$smarty.const.W_SITEPATH}account/admstringstable/"{if $smarty.get.hrzd == 'admstringstable'} style="font-weight: bold; text-decoration: none;"{/if}>Strings Table</a>
	   <a class="admtoolsoptions" href="{$smarty.const.W_SITEPATH}account/admgeneralsuboptions/"{if $smarty.get.hrzd == 'admgeneralsuboptions'} style="font-weight: bold; text-decoration: none;"{/if}>Add-Ins site</a>
	   <a class="admredirectlktable" href="{$smarty.const.W_SITEPATH}account/admredirectlktable/"{if $smarty.get.hrzd == 'admredirectlktable'} style="font-weight: bold; text-decoration: none;"{/if}>Redirect links</a>
	   <a class="admuserslistenclass" href="{$smarty.const.W_SITEPATH}account/admuserslisten/"{if $smarty.get.hrzd == 'admuserslisten'} style="font-weight: bold; text-decoration: none;"{/if}>Site Users</a>
       
       <a class="admuserslistenclass" href="{$smarty.const.W_SITEPATH}account/admusersgroups/"{if $smarty.get.hrzd == 'admusersgroups'} style="font-weight: bold; text-decoration: none"{/if}>Users Groups</a>
       
       <a class="adminformersfiles" href="{$smarty.const.W_SITEPATH}account/admrefbunners/"{if $smarty.get.hrzd == 'admrefbunners'} style="font-weight: bold; text-decoration: none;"{/if}>Referral banners</a>	
       
       <a class="adminformersfiles" style="background: transparent url({$smarty.const.W_SITEPATH}img/ico/general/pages.png) no-repeat left top{if $smarty.get.hrzd == 'admpspageslist'}; font-weight: bold; text-decoration: none;{/if}" href="{$smarty.const.W_SITEPATH}account/admpspageslist/">Individual pages in project</a>  	   
	 </div>    
    <!-- account admin menu and -->
	{/if}
    
   </div>
   <!-- general menu list end -->
   
   <!-- news list begin -->
   {if !$ismain_page}
    <div class="leftmenudwblocknews">
     <div>
	  <a class="black" href="{$smarty.const.W_SITEPATH}news/1/" style="font-weight: bold; text-decoration: none;">Site News</a>
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
	  <a class="black" href="{$smarty.const.W_SITEPATH}updates/" style="font-weight: bold; text-decoration: none;">Updates</a>
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
	        <div class="content_title"><h1 style="font-size: 105%">{if $section_info.stitle}{$section_info.stitle}{else}Tools for webmasters and SEO{/if}</h1></div>
		   </td>
          </tr>
         </table>
		 </span></div>
		</td>
	    <td valign="center" align="right" width="200px" style="white-space: nowrap;">
		 {if $CONTROL_OBJ->IsOnline()}
		  {* online info *}
		  <div>Hello, <b><a href="{$smarty.const.W_SITEPATH}account/">{$CONTROL_OBJ->userdata.username}</a></b>! <span style="margin-left: 6px">[ <a href="{$smarty.const.W_SITEPATH}exit/" class="black" style="margin-left: 0px; font-size: 95%">Exit</a> ]</span></div>
		  <div style="margin-top: 5px; font-size: 95%">
		  Balance: <a href="{$smarty.const.W_SITEPATH}account/payhistory/"><b style="color: #000000">{$CONTROL_OBJ->userdata.purcedata} USD</b></a>, new messages: <a href="{$smarty.const.W_SITEPATH}account/mail/"><b style="color: #FF0000">{$global_user_info.privatenew}</b></a>
		  </div>
		 {else}
		  {* no online info *}		  
		  <div><a href="#" onclick="ShowDialogInput()" class="black_dashed">Login</a> or <a class="black" href="{$smarty.const.W_SITEPATH}register/">register</a></div>
		  <div style="margin-top: 5px; font-size: 95%">		  
		   <a class="gray" href="{$smarty.const.W_SITEPATH}restore/">Forgot your password?</a>
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
		  if (th.qlogin.value == '' || th.qlogin.value == 'Username' || th.qpassw.value == '' || th.qpassw.value == 'password') {
		   alert('Enter the username and password to login!');
		   th.qlogin.focus();
		   return false;	
		  }
		  return true;
	     }
	     
	     function ShowDialogInput() {	 	
          $("#dialog_input").dialog({
           title: "Login to account", 
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
       <span id="ui-dialog-title-dialog" class="ui-dialog-title">Login to account</span>
       <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
    </div>
    <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_input">
       <div class="typelabel">        
        
		<form method="post" name="qinput" id="qinput" onsubmit="return OnSd(this)">
	    <div>	   	      
	     <input type="text" class="inpt" style="width: 165px" name="qlogin" id="qlogin" maxlength="99" onblur="OnBl(this,'Username')" onfocus="OnFs(this,'Username')" value="{if $smarty.post.actionlog == 'do'}{$CONTROL_OBJ->HTMLspecialChars($smarty.post.qlogin)}{else}Username{/if}">
	     <span class="qinpbuttonplace">
		  <input type="button" class="butt" style="width: 55px" value="&nbsp;Cancel&nbsp;" onclick="$('#dialog_input').dialog('close')">
	 	 </span>
	    </div>
        <div>
	     <input type="password" class="inpt" style="width: 165px; margin-top: 8px" name="qpassw" id="qpassw" onblur="OnBl(this,'password')" onfocus="OnFs(this,'password')" value="password">
		 <span class="qinpbuttonplace">
		  <input type="submit" class="butt" style="width: 55px" value="&nbsp;Login&nbsp;">
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
         <div>
	      <a class="black" href="{$smarty.const.W_SITEPATH}updates/" style="font-weight: bold; text-decoration: none;">Updates</a>
	     </div>
         <div style="margin-top: 8px">
	      {include file="items/updates_block.tpl"}
	     </div>
	    </div>
	    <!-- updates end -->
	    
	    <!-- news begin -->
	    {if $smarty.get.section != 'newslisten'}
	    <div class="leftmenudwblockupdates">    
         <div>
		  <a class="black" href="{$smarty.const.W_SITEPATH}news/" style="font-weight: bold; text-decoration: none;">News</a>	 
		 </div>
         <div style="margin-top: 5px">
          <div class="contentway" style="padding-left: 5px"> 
           <a href="{$smarty.const.W_SITEPATH}news/1/">Site News</a><label>&nbsp;</label>
          </div>
         </div>
         <div style="margin-top: 5px">
          <div class="contentway" style="padding-left: 5px; position: relative; top: -7px">
           <a href="{$smarty.const.W_SITEPATH}news/2/">Internet News</a><label>&nbsp;</label>
          </div> 
         </div>
        </div> 
        {/if}		
        <!-- news end -->
        
        {if $smarty.const.W_HTMLCODERIGHTDOWNBLOCK}
         <div class="leftmenudwblockupdates"><div>{$CONTROL_OBJ->GetText($smarty.const.W_HTMLCODERIGHTDOWNBLOCK)}</div></div>
        {/if}
			   
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
 

 
 
 {if $smarty.post.actionlog == 'do'}
  {if $CONTROL_OBJ->auth_error_str}
   <script type="text/javascript">
	alert('{$CONTROL_OBJ->auth_error_str}');
   </script>
  {/if} 
 {/if}
 
</body>
</html>