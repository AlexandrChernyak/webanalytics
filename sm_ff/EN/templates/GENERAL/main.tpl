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
       
       wait_progress_element.Wait('Processed, please wait ..');
        
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
	  <a href="{$smarty.const.W_SITEPATH}" class="logo" title="Home"></a>
	 </div>	
	</td>
	<td class="hc" valign="center" align="left">
	 
	 {literal}
	 <style type="text/css">
	  .langdiv { position: absolute; top: 10px; left: 365px; }
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
	 </div>
	 	 
	 <div class="menubar">
	  <a class="menuItem" href="{$smarty.const.W_SITEPATH}tools/">Tools</a> 
	  <a class="menuItem" href="{$smarty.const.W_SITEPATH}news/">News</a>  
	  <a class="menuItem" href="{$smarty.const.W_SITEPATH}feedback/">Feedback</a>	 
	 </div>	 
	</td>
	<td class="rc" valign="top" align="right">
	  
	  {if $CONTROL_OBJ->IsOnline()}
	  <!-- online info begin -->	  
	  <div class="regplace">
	   <div>Hello, <b><a href="{$smarty.const.W_SITEPATH}account/">{$CONTROL_OBJ->userdata.username}</a></b>!  
	   [ <a href="{$smarty.const.W_SITEPATH}exit/" class="restpsw" style="margin-left: 0px">Exit</a> ]</div>
	   <div style="margin-top: 10px">Balance: <a href="{$smarty.const.W_SITEPATH}account/payhistory/">
	   <b style="color: #000000">{$CONTROL_OBJ->userdata.purcedata} USD</b></a></div>	   
	   <div>New Messages: <a href="{$smarty.const.W_SITEPATH}account/mail/">
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
		if (th.qlogin.value == '' || th.qlogin.value == 'Username' || th.qpassw.value == '' || th.qpassw.value == 'Password') {
		 alert('Enter the username and password to login!');
		 th.qlogin.focus();
		 return false;	
		}
		return true;
	   }
      </script>
	  {/literal}
	  <div class="regplace">
	   <div>
	    <a href="{$smarty.const.W_SITEPATH}register/">Register</a>
	    <a class="restpsw" href="{$smarty.const.W_SITEPATH}restore/">Forgot your password?</a>
	    <span style="width: 45px; display: inline-block"></span>
	   </div>
	   <div>
	   <form method="post" name="qinput" id="qinput" onsubmit="return OnSd(this)">
	   <div>	   	      
	    <input type="text" class="inpt" style="width: 180px" name="qlogin" id="qlogin" 
		maxlength="99" onblur="OnBl(this,'Username')" onfocus="OnFs(this,'Username')" 
		value="{if $smarty.post.actionlog == 'do'}{$CONTROL_OBJ->HTMLspecialChars($smarty.post.qlogin)}{else}Username{/if}">
	    <span style="width: 45px; display: inline-block"></span>
	   </div>
       <div>
	    <input type="password" class="inpt" style="width: 180px; margin-top: 8px" name="qpassw" id="qpassw" 
		onblur="OnBl(this,'Password')" onfocus="OnFs(this,'Password')" value="Password">
		<span class="qinpbuttonplace">
		  <input type="submit" class="butt" style="width: 43px" value="Login">
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
     <div><a href="{$smarty.const.W_SITEPATH}account/" class="upd_title">Account Control Panel</a></div>
	 <div class="tdata">
    
	  <div class="sub_section_menu">
	   <label style="cursor: pointer" onclick="RollUpDownIdItem('account_block_items', document.getElementById('paccount_block_items'))">Account</label>
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
	  <a class="settings" href="{$smarty.const.W_SITEPATH}account/settings/">Edit settings</a>
	  <a class="money" href="{$smarty.const.W_SITEPATH}account/payhistory/">Transactions with balance</a>
	  <a class="mail" href="{$smarty.const.W_SITEPATH}account/mail/">Mail 
	  ({if $global_user_info.privatenew}<label id="red">{$global_user_info.privatenew}</label>/{/if}<label style="color: #000000">{$global_user_info.privateall}</label>)</a>
      <a class="admlinkvitrina" style="background: transparent url({$smarty.const.W_SITEPATH}img/ico/general/alliance_banner.png) no-repeat left top{if $smarty.get.hrzd == 'my-banners-list'}; font-weight: bold; text-decoration: none; color: #000000{/if}" href="{$smarty.const.W_SITEPATH}account/my-banners-list/">My banners</a>  
	  <div style="margin-top: 20px"></div>	  
	  </div>	  
	 </div> 
	  {* меню администратора *}
	  {if $CONTROL_OBJ->isadminstatus}
	  <div class="tdata">  
	   <div class="sub_section_menu">
	    <label style="cursor: pointer" onclick="RollUpDownIdItem('account_admin_info_block', document.getElementById('paccount_admin_info_block'))">Administrative Section</label>
		<span class="ln_up_sect_inf" id="paccount_admin_info_block" onclick="RollUpDownIdItem('account_admin_info_block', this)">&nbsp;</span>
	   </div>
	   <div id="account_admin_info_block">
	   
	   <div style="margin-top: 10px"></div>
	   <a class="adminformersfiles" href="{$smarty.const.W_SITEPATH}account/admmain/"{if $smarty.get.hrzd == 'admmain'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>General Information</a>
	   <div style="margin-top: 10px"></div>	  
	   <a class="invitecode" href="{$smarty.const.W_SITEPATH}account/adminvitecodes/"{if $smarty.get.hrzd == 'adminvitecodes'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Invite registration codes</a>
	   <div style="margin-top: 10px"></div>	  
	   <a class="engineupdates" href="{$smarty.const.W_SITEPATH}account/admengupdates/"{if $smarty.get.hrzd == 'admengupdates'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Updates search engine</a>
	   <div style="margin-top: 10px"></div>	  
	   <a class="googlecenters" href="{$smarty.const.W_SITEPATH}account/admgooglecenters/"{if $smarty.get.hrzd == 'admgooglecenters'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Google Datacentres</a>
	   <div style="margin-top: 10px"></div>	  
	   <a class="fontssection" href="{$smarty.const.W_SITEPATH}account/admfontssection/"{if $smarty.get.hrzd == 'admfontssection'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Font files</a>
	   <div style="margin-top: 10px"></div>	  
	   <a class="adminformersfiles" href="{$smarty.const.W_SITEPATH}account/adminformersfiles/"{if $smarty.get.hrzd == 'adminformersfiles'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Images Informer</a>
	   <a class="admlinkvitrina" href="{$smarty.const.W_SITEPATH}account/admlinksvitrina/"{if $smarty.get.hrzd == 'admlinksvitrina'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Showcase Links</a>
       
       <a class="admlinkvitrina" style="background: transparent url({$smarty.const.W_SITEPATH}img/ico/general/alliance_banner.png) no-repeat left top{if $smarty.get.hrzd == 'admbunnerscontrol'}; font-weight: bold; text-decoration: none; color: #000000{/if}" href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/">Advertising banners</a>
       
       <a class="admsitenews" href="{$smarty.const.W_SITEPATH}account/admnewsitems/"{if $smarty.get.hrzd == 'admnewsitems'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>News/Articles/Records</a>      
       
	   <a class="admcommentssect" href="{$smarty.const.W_SITEPATH}account/admcommentslist/"{if $smarty.get.hrzd == 'admcommentslist'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Comments</a>
	   <a class="admtoolsoptions" href="{$smarty.const.W_SITEPATH}account/admtoolsoptions/"{if $smarty.get.hrzd == 'admtoolsoptions'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Tools Options</a>
	   <a class="admtoolsoptions" href="{$smarty.const.W_SITEPATH}account/admgroupingtools/"{if $smarty.get.hrzd == 'admgroupingtools'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Grouping tools</a>
       
       <a class="adminformersfiles" style="background: transparent url({$smarty.const.W_SITEPATH}img/ico/general/word_files.png) no-repeat left top{if $smarty.get.hrzd == 'admtoolsimages'}; font-weight: bold; text-decoration: none; color: #000000{/if}" href="{$smarty.const.W_SITEPATH}account/admtoolsimages/">Tools Icons</a>
       
	   <a class="admstringstable" href="{$smarty.const.W_SITEPATH}account/admstringstable/"{if $smarty.get.hrzd == 'admstringstable'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Strings Table</a>
	   <a class="admtoolsoptions" href="{$smarty.const.W_SITEPATH}account/admgeneralsuboptions/"{if $smarty.get.hrzd == 'admgeneralsuboptions'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Add-Ins site</a>
	   <a class="admredirectlktable" href="{$smarty.const.W_SITEPATH}account/admredirectlktable/"{if $smarty.get.hrzd == 'admredirectlktable'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Redirect links</a>
	   <a class="admuserslistenclass" href="{$smarty.const.W_SITEPATH}account/admuserslisten/"{if $smarty.get.hrzd == 'admuserslisten'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Site Users</a>
       
       <a class="admuserslistenclass" href="{$smarty.const.W_SITEPATH}account/admusersgroups/"{if $smarty.get.hrzd == 'admusersgroups'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Users Groups</a>
       
       <a class="adminformersfiles" href="{$smarty.const.W_SITEPATH}account/admrefbunners/"{if $smarty.get.hrzd == 'admrefbunners'} style="font-weight: bold; text-decoration: none; color: #000000"{/if}>Referral banners</a>
       
       <a class="adminformersfiles" style="background: transparent url({$smarty.const.W_SITEPATH}img/ico/general/pages.png) no-repeat left top{if $smarty.get.hrzd == 'admpspageslist'}; font-weight: bold; text-decoration: none; color: #000000{/if}" href="{$smarty.const.W_SITEPATH}account/admpspageslist/">Individual pages in project</a>
	   
	   </div> 
	   <div style="margin-top: 20px"></div>	  	  	  
	  </div>
	  {literal}<script type="text/javascript">initListCookiesMenu(['account_admin_info_block']);</script>{/literal}	 
	  {/if}	 
	 {/if}	
	 {literal}<script type="text/javascript">initListCookiesMenu(['account_block_items']);</script>{/literal}  	    
	 <div><a href="{$smarty.const.W_SITEPATH}tools/" class="upd_title">Tools</a></div>
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
  <!-- right menu begin -->
  <div class="apdates_title"><a href="{$smarty.const.W_SITEPATH}updates/" class="upd_title">Updates</a></div>
  <div class="apdates_data">
   {include file="items/updates_block.tpl"} 
  </div>
  
  {if !$ismain_page}
  <div style="margin-top: 22px">
   {include file="items/links_vitrina_block.tpl"}
  </div>
  
  {if $smarty.get.section != 'newslisten'}
   <div style="margin-top: 20px"></div>
   <div class="apdates_title">
    <a href="{$smarty.const.W_SITEPATH}news/" class="upd_title">News</a>
   </div>
   <div style="margin-top: 5px; margin-left: 8px">
    <div class="contentway"> 
     <a href="{$smarty.const.W_SITEPATH}news/1/">Site News</a><label>&nbsp;</label>
    </div>
   </div>
   <div style="margin-top: 5px; margin-left: 8px">
    <div class="contentway" style="position: relative; top: -7px">
     <a href="{$smarty.const.W_SITEPATH}news/2/">Internet News</a><label>&nbsp;</label>
    </div> 
   </div>
   {/if}
    
  {/if}
  
  {if $ismain_page}
  <div style="margin-top: 20px"></div>
  <div class="apdates_title"><a href="{$smarty.const.W_SITEPATH}news/2/" class="upd_title">Internet News</a></div>
  {include file="items/last_news_block.tpl" newstype='2' limit='10' fontsize='95%'}  
  {/if}  
  
  {if $smarty.const.W_HTMLCODERIGHTDOWNBLOCK}
   <div style="margin-top: 20px"></div>
   <div>{$CONTROL_OBJ->GetText($smarty.const.W_HTMLCODERIGHTDOWNBLOCK)}</div>
  {/if}
  
  <!-- right menu end -->
  </td>
 </tr>
 </table>
 </span>
 </div>
 <!-- data end -->
 

 <!-- footer begin -->
 <div style="margin-top: 18px"></div>
 
 {if $smarty.const.W_HTMLCODEDOWNCENTERBLOCK}
  <div style="text-align: center">{$CONTROL_OBJ->GetText($smarty.const.W_HTMLCODEDOWNCENTERBLOCK)}</div>
 {/if}
 
 <div class="footer">
  <span style="width: 100%">
   <table width="100%" cellpadding="0" cellspacing="0">
   <tr>
   
	<td valign="top" align="left" style="padding-left: 4px; padding-top: 4px; white-space: nowrap; width: 210px">
	 <div>Copyright &copy; {if 2011 != $CONTROL_OBJ->GetThisDateEX('Y')}2011 - {/if}{$CONTROL_OBJ->GetThisDateEX('Y')} <a href="http://{$smarty.const.W_HOSTMYSITE}" target="_blank">{$smarty.const.W_HOSTMYSITE}</a></div>
	 
	 <div><a style="color: #FFFFFF" href="http://www.thumbshots.com" target="_blank" title="This site uses Thumbshots previews">This site uses Thumbshots previews</a></div>
	 
	 <div style="position: relative; top: -6px">
	  {if $smarty.const.W_HTMLCODEVISIBLECOUNTER}{$CONTROL_OBJ->GetText($smarty.const.W_HTMLCODEVISIBLECOUNTER)}{/if}
	 </div>
	 
	 {if $smarty.const.W_HTMLCODEINVISIBLECOUNTER}
	  <div style="position: absolute; top: -100%; visibility: hidden;">
	   {$CONTROL_OBJ->GetText($smarty.const.W_HTMLCODEINVISIBLECOUNTER)}
	  </div>	 
	 {/if}
	 
	</td>
	
	<td valign="top" align="left" style="padding-left: 4px; padding-top: 4px; white-space: nowrap; width: 150px">
	{if $smarty.const.W_ADMINICQ || $smarty.const.W_ADMINEMAIL}
	 <div><b>Support</b></div>
     {if $smarty.const.W_ADMINICQ}<div style="margin-top: 4px">ICQ: {$smarty.const.W_ADMINICQ}</div>{/if}
     {if $smarty.const.W_ADMINEMAIL}<div style="margin-top: 4px">E-mail: <a href="{$smarty.const.W_SITEPATH}feedback/">Ask a question</a></div>{/if}
    {/if}
	</td>
	
	<td valign="top" align="left" style="padding-left: 4px; padding-top: 4px">
	{if $_GLOBAL_SKIN_LIST}
	 <div style="margin-left: 14px"><b>Change style shell</b></div>
     <div style="margin-left: 14px; margin-top: 4px">
	  {literal}
	  <script type="text/javascript">
	   function DoSelectSkinItem(th) {
		$('#skintosetnew').val(th.value);
		$('#skinselect').submit();	
	   }//DoSelectSkinItem
      </script>
	  {/literal}     
	  <form method="post" style="display: inline" name="skinselect" id="skinselect">
	   <select size="1" name="skinselector" id="skinselector" onchange="DoSelectSkinItem(this)">	    
       {foreach from=$_GLOBAL_SKIN_LIST key=skin item=val name=val}
        <option{if $CONTROL_OBJ->GetActiveSkin() == $skin} selected="selected"{/if} value="{$skin}">{$val}</option>	
       {/foreach}
       </select>
       <input type="hidden" value="do" name="setnewskin">
       <input type="hidden" value="" name="skintosetnew" id="skintosetnew">
      </form>
	 </div>
    {/if}
	</td>		
	
	<td valign="top" align="right" style="padding-right: 4px; padding-top: 4px; width: 250px">
	 Site development: <a href="http://wm-scripts.ru" target="_blank">wm-scripts.ru</a>
	</td>
   </tr>
   </table>
  </span> 
 </div>
 <!-- footer end -->
 
 {if $smarty.post.actionlog == 'do'}
  {if $CONTROL_OBJ->auth_error_str}
   <script type="text/javascript">
	alert('{$CONTROL_OBJ->auth_error_str}');
   </script>
  {/if} 
 {/if}
 
</body>
</html>