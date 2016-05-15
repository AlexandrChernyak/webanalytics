<?php /* Smarty version 2.6.26, created on 2013-11-14 14:40:30
         compiled from main.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'main.tpl', 302, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8">
 <meta name="author" content="forwebm.net">
 <title><?php echo $this->_tpl_vars['section_info']['title']; ?>
</title>
 <meta name="keywords" content="<?php echo $this->_tpl_vars['section_info']['key']; ?>
"/> 
 <?php if ($this->_tpl_vars['section_info']['description']): ?><meta name="description" content="<?php echo $this->_tpl_vars['section_info']['description']; ?>
"/><?php endif; ?>
 
 <link rel="stylesheet" href="<?php echo @W_SITEPATH; ?>
css/css.php" type="text/css">
 <?php if ($this->_tpl_vars['section_info']['csslist']): ?>
  <?php $_from = $this->_tpl_vars['section_info']['csslist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>    
   <link rel="stylesheet" href="<?php echo @W_SITEPATH; ?>
css/<?php echo $this->_tpl_vars['val']; ?>
" media="screen" type="text/css"> 	   
  <?php endforeach; endif; unset($_from); ?>
 <?php endif; ?> 
 <script type="text/javascript" src="<?php echo @W_SITEPATH; ?>
js/jquery-latest.js"></script>
 <script type="text/javascript" src="<?php echo @W_SITEPATH; ?>
js/js.js"></script>
 <?php if ($this->_tpl_vars['section_info']['jslist']): ?>
  <?php $_from = $this->_tpl_vars['section_info']['jslist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>    
   <script type="text/javascript" src="<?php echo @W_SITEPATH; ?>
js/<?php echo $this->_tpl_vars['val']; ?>
"></script>	   
  <?php endforeach; endif; unset($_from); ?>
 <?php endif; ?> 
  <?php if (isset ( $this->_tpl_vars['tool_object'] )): ?>
 <?php $this->assign('allowwaittoolsidents', $this->_tpl_vars['CONTROL_OBJ']->CheckInArray($_GET['t1'],'w_toolitem_contentcheck,w_toolitem_whoisdomain,w_toolitem_whoisurlip,w_toolitem_analysis,w_toolitem_typosinkeyboard,w_toolitem_textanalisis,w_toolitem_robotslookurl,w_toolitem_checkurllinks,w_toolitem_keygeneratorurl')); ?>
 <?php endif; ?> 
 <?php if ($this->_tpl_vars['allowwaittoolsidents']): ?>
 <script type="text/javascript" src="<?php echo @W_SITEPATH; ?>
js/waitelements-tools.js"></script>
 <?php endif; ?> 
</head>
<body id="globalbodydata">

  <?php if ($this->_tpl_vars['allowwaittoolsidents']): ?>
  <?php echo '
  <script type="text/javascript">
	$(document).ready(function() {
	 wait_progress_element.initImage(
      \''; ?>
<?php echo @W_SITEPATH; ?>
athemes/SIMPLE/img/ajax-loader.gif<?php echo '\'
     ); 
     
     var toolform_obj = document.getElementById(\'toolform\');
     if (toolform_obj) {
         
      toolform_obj.onsubmit = function () {
       
       if (typeof window[\'PrepereToSend\'] == \'function\') {
        if (!PrepereToSend(this)) { return false; }        
       }
       
       wait_progress_element.Wait(\'Запрос обрабатывается, подождите..\');
        
       return true;
        
      };        
     }     
           
    });   
  </script>
  '; ?>
 
 <?php endif; ?>
  
 <!-- шапка begin ++ -->
 <div class="head_listen">
 <span style="width: 100%">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
	<td class="lc" valign="top" align="left" width="410">
	 <div class="logocontaner"> 
	  <a href="<?php echo @W_SITEPATH; ?>
" class="logo" title="На главную"></a>
	 </div>	
	</td>
	<td class="hc" valign="center" align="left">
	 
	 <?php echo '
	 <style type="text/css">
	  .langdiv { position: absolute; top: 10px; left: 365px; }
	  #linktohomeback { position: relative; top: -3px;  }
     </style>
	 '; ?>

	 <div class="langdiv">
	  <form method="post" style="display: inline" name="langselect" id="langselect">
       <?php $_from = $this->_tpl_vars['_GLOBAL_LANGUAGE_LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['lang'] => $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
        <span <?php if (($this->_foreach['val']['iteration']-1) > 0): ?>style="margin-left: 3px"<?php endif; ?>>		 
		 <a title="<?php echo $this->_tpl_vars['val']; ?>
" href="<?php echo @W_SITEPATH; ?>
?ln=<?php echo $this->_tpl_vars['lang']; ?>
"<?php if ($this->_tpl_vars['CONTROL_OBJ']->GetActiveLanguage() != $this->_tpl_vars['lang']): ?> onclick="this.href='javascript:'; $('#langtosetnew').val('<?php echo $this->_tpl_vars['lang']; ?>
'); $('#langselect').submit();"<?php endif; ?>><img src="<?php echo @W_SITEPATH; ?>
img/ico/language/<?php echo $this->_tpl_vars['lang']; ?>
.gif" border="0" alt="<?php echo $this->_tpl_vars['lang']; ?>
" title="<?php echo $this->_tpl_vars['val']; ?>
" style="width: 24px; height: 16px; <?php if ($this->_tpl_vars['CONTROL_OBJ']->GetActiveLanguage() != $this->_tpl_vars['lang']): ?>opacity:0.25;filter:alpha(opacity=25); cursor: pointer; <?php endif; ?>"></a>
		</span>
       <?php endforeach; endif; unset($_from); ?>
       <input type="hidden" value="do" name="setnewlanguage">
       <input type="hidden" value="" name="langtosetnew" id="langtosetnew">
      </form>
	  <span style="margin-left: 14px">
	   <a id="linktohomeback" href="/">Вернуться на <label style="color: #333333">Главную</label></a>
	  </span>	  
	 </div>
	 	 
	 <div class="menubar">
	  <a class="menuItem" href="<?php echo @W_SITEPATH; ?>
tools/">Инструменты</a> 
	  <a class="menuItem" href="<?php echo @W_SITEPATH; ?>
news/">Новости</a>  
	  <a class="menuItem" href="<?php echo @W_SITEPATH; ?>
feedback/">Контакты</a> 
	 </div>	 
	</td>
	<td class="rc" valign="top" align="right">
	  
	  <?php if ($this->_tpl_vars['CONTROL_OBJ']->IsOnline()): ?>
	  <!-- online info begin -->	  
	  <div class="regplace">
	   <div>Здравствуйте, <b><a href="<?php echo @W_SITEPATH; ?>
account/"><?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['username']; ?>
</a></b>!  
	   [ <a href="<?php echo @W_SITEPATH; ?>
exit/" class="restpsw" style="margin-left: 0px">Выход</a> ]</div>
	   <div style="margin-top: 10px">Баланс: <a href="<?php echo @W_SITEPATH; ?>
account/payhistory/">
	   <b style="color: #000000"><?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['purcedata']; ?>
 USD</b></a></div>	   
	   <div>Новых сообщений: <a href="<?php echo @W_SITEPATH; ?>
account/mail/">
	   <b style="color: #FF0000"><?php echo $this->_tpl_vars['global_user_info']['privatenew']; ?>
</b></a></div>
	  </div>
	  <!-- online info end -->
	  <?php else: ?>
	  <!-- auth info begin -->
	  <?php echo '
	  <script type="text/javascript">
	   function OnBl(th,val) { if (th.value == \'\') { th.value = val; } }
	   function OnFs(th,val) { if (th.value == val) { th.value = \'\'; } }
	   function OnSd(th) {
		if (th.qlogin.value == \'\' || th.qlogin.value == \'Логин\' || th.qpassw.value == \'\' || th.qpassw.value == \'Пароль\') {
		 alert(\'Укажите логин и пароль для авторизации!\');
		 th.qlogin.focus();
		 return false;	
		}
		return true;
	   }
      </script>
	  '; ?>

	  <div class="regplace">
	   <div>
	    <a href="<?php echo @W_SITEPATH; ?>
register/">Регистрация</a>
	    <a class="restpsw" href="<?php echo @W_SITEPATH; ?>
restore/">Забыли пароль?</a>
	    <span style="width: 45px; display: inline-block"></span>
	   </div>
	   <div>
	   <form method="post" name="qinput" id="qinput" onsubmit="return OnSd(this)">
	   <div>	   	      
	    <input type="text" class="inpt" style="width: 180px" name="qlogin" id="qlogin" 
		maxlength="99" onblur="OnBl(this,'Логин')" onfocus="OnFs(this,'Логин')" 
		value="<?php if ($_POST['actionlog'] == 'do'): ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->HTMLspecialChars($_POST['qlogin']); ?>
<?php else: ?>Логин<?php endif; ?>">
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
	  <?php endif; ?>
	  	 
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
   <?php echo '
   <script type="text/javascript">
	function RollUpDownIdItem(idname, th) {
	 var id = document.getElementById(idname);
	 var up = (id.style.visibility == \'hidden\') ? false : true;		
	 $(\'#\'+idname).css(\'visibility\', (up) ? \'hidden\' : \'visible\');
	 $(\'#\'+idname).css(\'display\', (up) ? \'none\' : \'block\');
	 th.className = (up) ? \'ln_dw_sect_inf\' : \'ln_up_sect_inf\';
	 setCookie(\'q_\'+idname, (up) ? \'0\' : \'1\', false, \''; ?>
<?php echo @W_COOKIESPATH; ?>
<?php echo '\', \''; ?>
<?php echo @W_COOKIESDOMAIN; ?>
<?php echo '\');	 	
	}
	function initListCookiesMenu(list) {
	 var rdata = \'\';	
	 for (var i=0; i < list.length; i++) {
	  rdata = getCookie(\'q_\'+list[i]);
	  if (rdata != null && rdata == \'0\') {
	   RollUpDownIdItem(list[i], document.getElementById(\'p\'+list[i]));	   	
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
	
	PreloadImagesList(['; ?>
'<?php echo @W_SITEPATH; ?>
img/items/buttonbg_disabled.png'<?php echo ']);	
   </script>
   '; ?>
     
   <!-- menu begin -->
   <div class="l_menu_space">
    <div class="ins">
     <?php if (( $this->_tpl_vars['CONTROL_OBJ']->strtolower($_GET['section']) == 'accountff' || $this->_tpl_vars['CONTROL_OBJ']->ReadOption('SHOWUSMENU') ) && $this->_tpl_vars['CONTROL_OBJ']->IsOnline()): ?>
     <div><a href="<?php echo @W_SITEPATH; ?>
account/" class="upd_title">Управление кабинетом</a></div>
	 <div class="tdata">
    
	  <div class="sub_section_menu">
	   <label style="cursor: pointer" onclick="RollUpDownIdItem('account_block_items', document.getElementById('paccount_block_items'))">Кабинет</label>
	   <span id="paccount_block_items" class="ln_up_sect_inf" onclick="RollUpDownIdItem('account_block_items', this)">&nbsp;</span>
	  </div>
	  <div id="account_block_items">
	  <div style="margin-top: 10px"></div>
	  <div style="margin-left: 6px">
	  <img width="99" height="99" 
	  src="<?php echo @W_SITEPATH; ?>
<?php echo @W_FILESWEBPATH; ?>
/images/<?php echo $this->_tpl_vars['global_user_info']['avatar']; ?>
">
	  </div>
	  <div style="margin-top: 10px"></div>
	  
	  <a class="home" href="<?php echo @W_SITEPATH; ?>
account/"><b><?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['username']; ?>
</b></a>
	  <a class="settings" href="<?php echo @W_SITEPATH; ?>
account/settings/">Изменить настройки</a>
	  <a class="money" href="<?php echo @W_SITEPATH; ?>
account/payhistory/">Операции со счетом</a>
	  <a class="mail" href="<?php echo @W_SITEPATH; ?>
account/mail/">Почта 
	  (<?php if ($this->_tpl_vars['global_user_info']['privatenew']): ?><label id="red"><?php echo $this->_tpl_vars['global_user_info']['privatenew']; ?>
</label>/<?php endif; ?><label style="color: #000000"><?php echo $this->_tpl_vars['global_user_info']['privateall']; ?>
</label>)</a>
      <a class="admlinkvitrina" style="background: transparent url(<?php echo @W_SITEPATH; ?>
img/ico/general/alliance_banner.png) no-repeat left top<?php if ($_GET['hrzd'] == 'my-banners-list'): ?>; font-weight: bold; text-decoration: none; color: #000000<?php endif; ?>" href="<?php echo @W_SITEPATH; ?>
account/my-banners-list/">Мои баннеры</a>
        
	  <div style="margin-top: 20px"></div>	  
	  </div>	  
	 </div> 
	  	  <?php if ($this->_tpl_vars['CONTROL_OBJ']->isadminstatus): ?>
	  <div class="tdata">  
	   <div class="sub_section_menu">
	    <label style="cursor: pointer" onclick="RollUpDownIdItem('account_admin_info_block', document.getElementById('paccount_admin_info_block'))">Административный раздел</label>
		<span class="ln_up_sect_inf" id="paccount_admin_info_block" onclick="RollUpDownIdItem('account_admin_info_block', this)">&nbsp;</span>
	   </div>
	   <div id="account_admin_info_block">	   
	   <div style="margin-top: 10px"></div>
	   <a class="adminformersfiles" href="<?php echo @W_SITEPATH; ?>
account/admmain/"<?php if ($_GET['hrzd'] == 'admmain'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Общая информация</a>	   
	   <div style="margin-top: 10px"></div>	  
	   <a class="invitecode" href="<?php echo @W_SITEPATH; ?>
account/adminvitecodes/"<?php if ($_GET['hrzd'] == 'adminvitecodes'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Инвайт коды регистрации</a>
	   <div style="margin-top: 10px"></div>	  
	   <a class="engineupdates" href="<?php echo @W_SITEPATH; ?>
account/admengupdates/"<?php if ($_GET['hrzd'] == 'admengupdates'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Апдейты поисковиков</a>
	   <div style="margin-top: 10px"></div>	  
	   <a class="googlecenters" href="<?php echo @W_SITEPATH; ?>
account/admgooglecenters/"<?php if ($_GET['hrzd'] == 'admgooglecenters'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Датацентры Google</a>
	   <div style="margin-top: 10px"></div>	  
	   <a class="fontssection" href="<?php echo @W_SITEPATH; ?>
account/admfontssection/"<?php if ($_GET['hrzd'] == 'admfontssection'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Файлы шрифтов</a>
	   <div style="margin-top: 10px"></div>	  
	   <a class="adminformersfiles" href="<?php echo @W_SITEPATH; ?>
account/adminformersfiles/"<?php if ($_GET['hrzd'] == 'adminformersfiles'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Изображения информеров</a>
	   <a class="admlinkvitrina" href="<?php echo @W_SITEPATH; ?>
account/admlinksvitrina/"<?php if ($_GET['hrzd'] == 'admlinksvitrina'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Витрина ссылок</a>
       
       <a class="admlinkvitrina" style="background: transparent url(<?php echo @W_SITEPATH; ?>
img/ico/general/alliance_banner.png) no-repeat left top<?php if ($_GET['hrzd'] == 'admbunnerscontrol'): ?>; font-weight: bold; text-decoration: none; color: #000000<?php endif; ?>" href="<?php echo @W_SITEPATH; ?>
account/admbunnerscontrol/">Реклама баннеров</a>
             
       <a class="admsitenews" href="<?php echo @W_SITEPATH; ?>
account/admnewsitems/"<?php if ($_GET['hrzd'] == 'admnewsitems'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Новости/Статьи/записи</a>
	   
	   <a class="admcommentssect" href="<?php echo @W_SITEPATH; ?>
account/admcommentslist/"<?php if ($_GET['hrzd'] == 'admcommentslist'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Комментарии</a>
	   <a class="admtoolsoptions" href="<?php echo @W_SITEPATH; ?>
account/admtoolsoptions/"<?php if ($_GET['hrzd'] == 'admtoolsoptions'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Параметры инструментов</a>
	   <a class="admtoolsoptions" href="<?php echo @W_SITEPATH; ?>
account/admgroupingtools/"<?php if ($_GET['hrzd'] == 'admgroupingtools'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Группировка инструментов</a>
       
       <a class="adminformersfiles" style="background: transparent url(<?php echo @W_SITEPATH; ?>
img/ico/general/word_files.png) no-repeat left top<?php if ($_GET['hrzd'] == 'admtoolsimages'): ?>; font-weight: bold; text-decoration: none; color: #000000<?php endif; ?>" href="<?php echo @W_SITEPATH; ?>
account/admtoolsimages/">Иконки инструментов</a>
       
	   <a class="admstringstable" href="<?php echo @W_SITEPATH; ?>
account/admstringstable/"<?php if ($_GET['hrzd'] == 'admstringstable'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Таблица строк</a>
	   <a class="admtoolsoptions" href="<?php echo @W_SITEPATH; ?>
account/admgeneralsuboptions/"<?php if ($_GET['hrzd'] == 'admgeneralsuboptions'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Надстройки сайта</a>
	   <a class="admredirectlktable" href="<?php echo @W_SITEPATH; ?>
account/admredirectlktable/"<?php if ($_GET['hrzd'] == 'admredirectlktable'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Перенаправления ссылок</a>
	   <a class="admuserslistenclass" href="<?php echo @W_SITEPATH; ?>
account/admuserslisten/"<?php if ($_GET['hrzd'] == 'admuserslisten'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Пользователи сайта</a>
       
       <a class="admuserslistenclass" href="<?php echo @W_SITEPATH; ?>
account/admusersgroups/"<?php if ($_GET['hrzd'] == 'admusersgroups'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Группы пользователей</a>
       
       <a class="adminformersfiles" href="<?php echo @W_SITEPATH; ?>
account/admrefbunners/"<?php if ($_GET['hrzd'] == 'admrefbunners'): ?> style="font-weight: bold; text-decoration: none; color: #000000"<?php endif; ?>>Реферальные баннеры</a>
       
       <a class="adminformersfiles" style="background: transparent url(<?php echo @W_SITEPATH; ?>
img/ico/general/pages.png) no-repeat left top<?php if ($_GET['hrzd'] == 'admpspageslist'): ?>; font-weight: bold; text-decoration: none; color: #000000<?php endif; ?>" href="<?php echo @W_SITEPATH; ?>
account/admpspageslist/">Отдельные страницы проекта</a>
	   
	   </div> 
	   <div style="margin-top: 20px"></div>	  	  	  
	  </div>
	  <?php echo '<script type="text/javascript">initListCookiesMenu([\'account_admin_info_block\']);</script>'; ?>
	 
	  <?php endif; ?>	 
	 <?php endif; ?>	
	 <?php echo '<script type="text/javascript">initListCookiesMenu([\'account_block_items\']);</script>'; ?>
  	    
	 <div><a href="<?php echo @W_SITEPATH; ?>
tools/" class="upd_title">Инструменты</a></div>
	 <div class="tdata">
	        
      <?php $this->assign('listtoolsX', $this->_tpl_vars['CONTROL_OBJ']->GetToolsListByDEFAULTtamplateMain()); ?> 
      <?php $_from = $this->_tpl_vars['listtoolsX']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
       <div style="margin-top: 6px"></div>
       <div class="sub_section_menu"><?php echo $this->_tpl_vars['val']['group']['name']; ?>
</div>
       <div style="margin-top: 10px"></div>
       <?php $_from = $this->_tpl_vars['val']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val1']):
        $this->_foreach['val1']['iteration']++;
?>
         <span style="width: 100%">
          <table width="100%" cellpadding="0" cellspacing="0">
           <tr>
            
            <td valign="top" align="left" width="22px" style="padding-left: 2px">
             <img src="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetToolImageStyle($this->_tpl_vars['val1']['name'],16,'',''); ?>
" style="width: 16px; height: 16px">  
            </td>
            
            <td valign="top" align="left">             
             <a class="massurlspeedtest" style="margin-left: 0px; padding-left: 0px; height: auto; <?php if ($_GET['t1'] == ((is_array($_tmp='w_toolitem_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['val1']['name']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['val1']['name']))): ?>; color: #000000;<?php endif; ?>" href="<?php echo @W_SITEPATH; ?>
tools/<?php echo $this->_tpl_vars['val1']['name']; ?>
/"><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText($this->_tpl_vars['val1']['value']['descr']); ?>
</a>          
            </td>
            
           </tr>
          </table>
         </span>
       <?php endforeach; endif; unset($_from); ?>
      <?php endforeach; endif; unset($_from); ?>
	  	  	  
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
  <?php if ($this->_tpl_vars['section_way']): ?>
  <div class="contentway"> 
   <?php $_from = $this->_tpl_vars['section_way']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>    
    <?php if (($this->_foreach['val']['iteration']-1) > 0): ?>
     <label>&nbsp;</label>
    <?php endif; ?>  
    <a href="<?php echo $this->_tpl_vars['val']['path']; ?>
"><?php echo $this->_tpl_vars['val']['name']; ?>
</a>	   
   <?php endforeach; endif; unset($_from); ?>
  </div>
  <div class="contentway_btn"></div>  
  <?php endif; ?>
  
  <?php if (@W_HTMLCODETOPCENTERBLOCK): ?>
   <div style="margin-top: 2px"></div>
   <div><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText(@W_HTMLCODETOPCENTERBLOCK); ?>
</div>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['section_info']['stitle']): ?>
   <div class="content_title">
    <span><?php echo $this->_tpl_vars['section_info']['stitle']; ?>
</span>
   </div>
  <?php endif; ?>    
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['section_info']['file'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>  
  <!-- content end -->
  
  </div>
  </td>
  <td class="def_td_r" valign="top">  
  <!-- right menu begin -->
  <div class="apdates_title"><a href="<?php echo @W_SITEPATH; ?>
updates/" class="upd_title">Апдейты</a></div>
  <div class="apdates_data">
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "items/updates_block.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>  
  </div>
  
  <?php if (! $this->_tpl_vars['ismain_page']): ?>
  <div style="margin-top: 22px">
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "items/links_vitrina_block.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  </div>
  
  <?php if ($_GET['section'] != 'newslisten'): ?>
   <div style="margin-top: 20px"></div>
   <div class="apdates_title">
    <a href="<?php echo @W_SITEPATH; ?>
news/" class="upd_title">Новости</a>
   </div>
   <div style="margin-top: 5px; margin-left: 8px">
    <div class="contentway"> 
     <a href="<?php echo @W_SITEPATH; ?>
news/1/">Новости сайта</a><label>&nbsp;</label>
    </div>
   </div>
   <div style="margin-top: 5px; margin-left: 8px">
    <div class="contentway" style="position: relative; top: -7px">
     <a href="<?php echo @W_SITEPATH; ?>
news/2/">Новости интернета</a><label>&nbsp;</label>
    </div> 
   </div>
   <?php endif; ?>
    
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['ismain_page']): ?>
  <div style="margin-top: 20px"></div>
  <div class="apdates_title"><a href="<?php echo @W_SITEPATH; ?>
news/2/" class="upd_title">Новости интернета</a></div>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "items/last_news_block.tpl", 'smarty_include_vars' => array('newstype' => '2','limit' => '10','fontsize' => '95%')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>  
  <?php endif; ?>  
  
  <?php if (@W_HTMLCODERIGHTDOWNBLOCK): ?>
   <div style="margin-top: 20px"></div>
   <div><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText(@W_HTMLCODERIGHTDOWNBLOCK); ?>
</div>
  <?php endif; ?>
  
  <!-- right menu end -->
  </td>
 </tr>
 </table>
 </span>
 </div>
 <!-- data end -->
 

 <!-- footer begin -->
 <div style="margin-top: 18px"></div>
 
 <?php if (@W_HTMLCODEDOWNCENTERBLOCK): ?>
  <div style="text-align: center"><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText(@W_HTMLCODEDOWNCENTERBLOCK); ?>
</div>
 <?php endif; ?>
 
 <div class="footer">
  <span style="width: 100%">
   <table width="100%" cellpadding="0" cellspacing="0">
   <tr>
   
	<td valign="top" align="left" style="padding-left: 4px; padding-top: 4px; white-space: nowrap; width: 210px">
	 <div>Copyright &copy; <?php if (2011 != $this->_tpl_vars['CONTROL_OBJ']->GetThisDateEX('Y')): ?>2011 - <?php endif; ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetThisDateEX('Y'); ?>
 <a href="http://<?php echo @W_HOSTMYSITE; ?>
" target="_blank"><?php echo @W_HOSTMYSITE; ?>
</a></div>
	 
	 <div><a style="color: #FFFFFF" href="http://www.thumbshots.com" target="_blank" title="This site uses Thumbshots previews">This site uses Thumbshots previews</a></div>
	 
	 <div style="position: relative; top: -6px">
	  <?php if (@W_HTMLCODEVISIBLECOUNTER): ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText(@W_HTMLCODEVISIBLECOUNTER); ?>
<?php endif; ?>
	 </div>
	 
	 <?php if (@W_HTMLCODEINVISIBLECOUNTER): ?>
	  <div style="position: absolute; top: -100%; visibility: hidden;">
	   <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText(@W_HTMLCODEINVISIBLECOUNTER); ?>

	  </div>	 
	 <?php endif; ?>
	 
	</td>
	
	<td valign="top" align="left" style="padding-left: 4px; padding-top: 4px; white-space: nowrap; width: 150px">
	<?php if (@W_ADMINICQ || @W_ADMINEMAIL): ?>
	 <div><b>Поддержка</b></div>
     <?php if (@W_ADMINICQ): ?><div style="margin-top: 4px">ICQ: <?php echo @W_ADMINICQ; ?>
</div><?php endif; ?>
     <?php if (@W_ADMINEMAIL): ?><div style="margin-top: 4px">E-mail: <a href="<?php echo @W_SITEPATH; ?>
feedback/">Задать вопрос</a></div><?php endif; ?>
    <?php endif; ?>
	</td>
	
	<td valign="top" align="left" style="padding-left: 4px; padding-top: 4px">
	<?php if ($this->_tpl_vars['_GLOBAL_SKIN_LIST']): ?>
	 <div style="margin-left: 14px"><b>Сменить стиль оболочки</b></div>
     <div style="margin-left: 14px; margin-top: 4px">
	  <?php echo '
	  <script type="text/javascript">
	   function DoSelectSkinItem(th) {
		$(\'#skintosetnew\').val(th.value);
		$(\'#skinselect\').submit();	
	   }//DoSelectSkinItem
      </script>
	  '; ?>
     
	  <form method="post" style="display: inline" name="skinselect" id="skinselect">
	   <select size="1" name="skinselector" id="skinselector" onchange="DoSelectSkinItem(this)">	    
       <?php $_from = $this->_tpl_vars['_GLOBAL_SKIN_LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['skin'] => $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
        <option<?php if ($this->_tpl_vars['CONTROL_OBJ']->GetActiveSkin() == $this->_tpl_vars['skin']): ?> selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['skin']; ?>
"><?php echo $this->_tpl_vars['val']; ?>
</option>	
       <?php endforeach; endif; unset($_from); ?>
       </select>
       <input type="hidden" value="do" name="setnewskin">
       <input type="hidden" value="" name="skintosetnew" id="skintosetnew">
      </form>
	 </div>
    <?php endif; ?>
	</td>		
	
	<td valign="top" align="right" style="padding-right: 4px; padding-top: 4px; width: 250px">
	 Готовые сайты: <a href="http://wm-scripts.ru" target="_blank">wm-scripts.ru</a>
	</td>
   </tr>
   </table>
  </span> 
 </div>
 <!-- footer end -->
 
 <?php if ($_POST['actionlog'] == 'do'): ?>
  <?php if ($this->_tpl_vars['CONTROL_OBJ']->auth_error_str): ?>
   <script type="text/javascript">
	alert('<?php echo $this->_tpl_vars['CONTROL_OBJ']->auth_error_str; ?>
');
   </script>
  <?php endif; ?> 
 <?php endif; ?>
 
</body>
</html>