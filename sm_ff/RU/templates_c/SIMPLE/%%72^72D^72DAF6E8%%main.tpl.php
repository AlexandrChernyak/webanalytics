<?php /* Smarty version 2.6.26, created on 2016-05-15 09:04:42
         compiled from main.tpl */ ?>
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
athemes/SIMPLE/css.css" type="text/css"> 
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
 
 <?php if (! $this->_tpl_vars['CONTROL_OBJ']->IsOnline()): ?>
  <link rel="stylesheet" href="<?php echo @W_SITEPATH; ?>
css/ui/jquery-ui-1.8.11.custom.css" media="screen" type="text/css">
 <?php endif; ?>
 
 <script type="text/javascript" src="<?php echo @W_SITEPATH; ?>
js/jquery-latest.js"></script>
 <script type="text/javascript" src="<?php echo @W_SITEPATH; ?>
js/js.js"></script>
 <script type="text/javascript" src="<?php echo @W_SITEPATH; ?>
athemes/SIMPLE/footer.js"></script>
 
  <?php if (isset ( $this->_tpl_vars['tool_object'] )): ?>
 <?php $this->assign('allowwaittoolsidents', $this->_tpl_vars['CONTROL_OBJ']->CheckInArray($_GET['t1'],'w_toolitem_contentcheck,w_toolitem_whoisdomain,w_toolitem_whoisurlip,w_toolitem_analysis,w_toolitem_typosinkeyboard,w_toolitem_textanalisis,w_toolitem_robotslookurl,w_toolitem_checkurllinks,w_toolitem_keygeneratorurl')); ?>
 <?php endif; ?>
 
 <?php if ($this->_tpl_vars['allowwaittoolsidents']): ?>
 <script type="text/javascript" src="<?php echo @W_SITEPATH; ?>
js/waitelements-tools.js"></script>
 <script type="text/javascript" src="<?php echo @W_SITEPATH; ?>
css/panel/jquery.corner.js"></script>
 <?php endif; ?>
 
 <?php if (! $this->_tpl_vars['CONTROL_OBJ']->IsOnline()): ?>
  <script type="text/javascript" src="<?php echo @W_SITEPATH; ?>
js/jquery.ui.custom.min.js"></script>
 <?php endif; ?>
 
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
 
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "init_sape_code.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 
 <div class="toplinebg"></div>

 <div class="bodycontainer"> 
  
 <!-- header begin --> 
 <div class="headerspace"><span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0"> 
 <tr>
  <td valign="top" align="left" width="210px" style="padding-left: 25px; padding-right: 3px;<?php if ($_POST['doactiontool'] == 'do' && ! $this->_tpl_vars['ismain_page']): ?> background: #F9F9F9;<?php endif; ?>">
   <div><a href="<?php echo @W_SITEPATH; ?>
" class="logo"></a></div>
   <!-- lang list begin -->
   <div class="languagelist">   
    <form method="post" style="display: inline" name="langselect" id="langselect">
     <?php $_from = $this->_tpl_vars['_GLOBAL_LANGUAGE_LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['lang'] => $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
     <span <?php if (($this->_foreach['val']['iteration']-1) > 0): ?>style="margin-left: 3px"<?php endif; ?>>
	  <noindex><a rel="nofollow" title="<?php echo $this->_tpl_vars['val']; ?>
" href="<?php echo @W_SITEPATH; ?>
?ln=<?php echo $this->_tpl_vars['lang']; ?>
"<?php if ($this->_tpl_vars['CONTROL_OBJ']->GetActiveLanguage() != $this->_tpl_vars['lang']): ?> onclick="this.href='javascript:'; $('#langtosetnew').val('<?php echo $this->_tpl_vars['lang']; ?>
'); $('#langselect').submit();"<?php endif; ?>><img src="<?php echo @W_SITEPATH; ?>
img/ico/language/<?php echo $this->_tpl_vars['lang']; ?>
.gif" border="0" alt="<?php echo $this->_tpl_vars['lang']; ?>
" title="<?php echo $this->_tpl_vars['val']; ?>
" style="width: 26px; height: 18px; <?php if ($this->_tpl_vars['CONTROL_OBJ']->GetActiveLanguage() != $this->_tpl_vars['lang']): ?>opacity:0.25;filter:alpha(opacity=25); cursor: pointer; <?php endif; ?>"></a></noindex>
	 </span>
     <?php endforeach; endif; unset($_from); ?>
     <input type="hidden" value="do" name="setnewlanguage">
     <input type="hidden" value="" name="langtosetnew" id="langtosetnew">
    </form> 
   </div>
   <!-- lang list end -->
   
   <!-- general menu list begin -->
   <div class="menulistblock">
    <a href="<?php echo @W_SITEPATH; ?>
" class="home">На главную</a>    
    <a href="<?php echo @W_SITEPATH; ?>
tools/" class="tools"<?php if ($_GET['section'] == 'toolsaction'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Инструменты</a>
    <a href="<?php echo @W_SITEPATH; ?>
panel/" class="admuserslistenclass"<?php if ($_GET['section'] == 'panelitemsaction'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Панель оптимизатора</a>
	
	<div style="margin-top: 10px"></div>
	
        <?php $this->assign('dinamicmenuitemslist', $this->_tpl_vars['CONTROL_OBJ']->GetAllAvRecordsList()); ?>    
    <?php if (! $this->_tpl_vars['dinamicmenuitemslist']): ?>    
     <a href="<?php echo @W_SITEPATH; ?>
news/"<?php if ($_GET['section'] == 'newslisten'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Новости</a>
    <?php else: ?>
     <?php $_from = $this->_tpl_vars['dinamicmenuitemslist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['nval'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nval']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['path'] => $this->_tpl_vars['nval']):
        $this->_foreach['nval']['iteration']++;
?>    
      <a href="<?php echo @W_SITEPATH; ?>
<?php echo $this->_tpl_vars['path']; ?>
/"<?php if ($_GET['identway'] == $this->_tpl_vars['path']): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>><?php echo $this->_tpl_vars['nval']; ?>
</a>    
     <?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>   
    
    <a href="<?php echo @W_SITEPATH; ?>
advertising/"<?php if ($_GET['section'] == 'advertisingpagefile'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Реклама у нас</a>  
	<a href="<?php echo @W_SITEPATH; ?>
feedback/"<?php if ($_GET['section'] == 'feedbackpt'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Обратная связь</a>   
     
             
    <!-- account menu begin -->
    <?php if (( $_GET['section'] == 'accountff' || $this->_tpl_vars['CONTROL_OBJ']->ReadOption('SHOWUSMENU') ) && $this->_tpl_vars['CONTROL_OBJ']->IsOnline()): ?>
     <div style="margin-top: 35px">
      <div style="margin-bottom: 10px; font-weight: bold">Управление кабинетом</div>      
	  <a class="home" href="<?php echo @W_SITEPATH; ?>
account/"<?php if (! $_GET['hrzd'] && $_GET['section'] == 'accountff'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>><b><?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['username']; ?>
</b></a>
	  <a class="settings" href="<?php echo @W_SITEPATH; ?>
account/settings/"<?php if ($_GET['hrzd'] == 'settings'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Изменить настройки</a>
	  <a class="money" href="<?php echo @W_SITEPATH; ?>
account/payhistory/"<?php if ($_GET['hrzd'] == 'payhistory'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Операции со счетом</a>
	  <a class="mail" href="<?php echo @W_SITEPATH; ?>
account/mail/"<?php if ($_GET['hrzd'] == 'mail'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Почта 
	  (<?php if ($this->_tpl_vars['global_user_info']['privatenew']): ?><label id="red"><?php echo $this->_tpl_vars['global_user_info']['privatenew']; ?>
</label>/<?php endif; ?><label style="color: #000000"><?php echo $this->_tpl_vars['global_user_info']['privateall']; ?>
</label>)</a>     
      <a class="admlinkvitrina" style="background: transparent url(<?php echo @W_SITEPATH; ?>
img/ico/general/alliance_banner.png) no-repeat left top<?php if ($_GET['hrzd'] == 'my-banners-list'): ?>; font-weight: bold; text-decoration: none;<?php endif; ?>" href="<?php echo @W_SITEPATH; ?>
account/my-banners-list/">Мои баннеры</a>       
	 </div>    
    <?php endif; ?>
    <!-- account menu and -->
    
    <?php if ($_GET['section'] == 'accountff' && $this->_tpl_vars['CONTROL_OBJ']->IsOnline() && $this->_tpl_vars['CONTROL_OBJ']->isadminstatus): ?>
    <!-- account admin menu begin -->
     <div style="margin-top: 35px">
      <div style="margin-bottom: 10px; font-weight: bold">Администрирование</div>      	  
	   <a class="adminformersfiles" href="<?php echo @W_SITEPATH; ?>
account/admmain/"<?php if ($_GET['hrzd'] == 'admmain'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Общая информация</a>
	   <a class="invitecode" href="<?php echo @W_SITEPATH; ?>
account/adminvitecodes/"<?php if ($_GET['hrzd'] == 'adminvitecodes'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Инвайт коды регистрации</a> 
	   <a class="engineupdates" href="<?php echo @W_SITEPATH; ?>
account/admengupdates/"<?php if ($_GET['hrzd'] == 'admengupdates'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Апдейты поисковиков</a>
	   <a class="googlecenters" href="<?php echo @W_SITEPATH; ?>
account/admgooglecenters/"<?php if ($_GET['hrzd'] == 'admgooglecenters'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Датацентры Google</a>
	   <a class="fontssection" href="<?php echo @W_SITEPATH; ?>
account/admfontssection/"<?php if ($_GET['hrzd'] == 'admfontssection'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Файлы шрифтов</a>
	   <a class="adminformersfiles" href="<?php echo @W_SITEPATH; ?>
account/adminformersfiles/"<?php if ($_GET['hrzd'] == 'adminformersfiles'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Изображения информеров</a>
	   <a class="admlinkvitrina" href="<?php echo @W_SITEPATH; ?>
account/admlinksvitrina/"<?php if ($_GET['hrzd'] == 'admlinksvitrina'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Витрина ссылок</a>            
       <a class="admlinkvitrina" style="background: transparent url(<?php echo @W_SITEPATH; ?>
img/ico/general/alliance_banner.png) no-repeat left top<?php if ($_GET['hrzd'] == 'admbunnerscontrol'): ?>; font-weight: bold; text-decoration: none;<?php endif; ?>" href="<?php echo @W_SITEPATH; ?>
account/admbunnerscontrol/">Реклама баннеров</a>
  	   
       <a class="adminetnews" href="<?php echo @W_SITEPATH; ?>
account/admnewsitems/"<?php if ($_GET['hrzd'] == 'admnewsitems'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Новости/Статьи/записи</a>
       
	   <a class="admcommentssect" href="<?php echo @W_SITEPATH; ?>
account/admcommentslist/"<?php if ($_GET['hrzd'] == 'admcommentslist'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Комментарии</a>
	   <a class="admtoolsoptions" href="<?php echo @W_SITEPATH; ?>
account/admtoolsoptions/"<?php if ($_GET['hrzd'] == 'admtoolsoptions'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Параметры инструментов</a>
	   
	   <a class="admtoolsoptions" href="<?php echo @W_SITEPATH; ?>
account/admgroupingtools/"<?php if ($_GET['hrzd'] == 'admgroupingtools'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Группировка инструментов</a>
       
       <a class="adminformersfiles" style="background: transparent url(<?php echo @W_SITEPATH; ?>
img/ico/general/word_files.png) no-repeat left top<?php if ($_GET['hrzd'] == 'admtoolsimages'): ?>; font-weight: bold; text-decoration: none;<?php endif; ?>" href="<?php echo @W_SITEPATH; ?>
account/admtoolsimages/">Иконки инструментов</a>
	   
	   <a class="admstringstable" href="<?php echo @W_SITEPATH; ?>
account/admstringstable/"<?php if ($_GET['hrzd'] == 'admstringstable'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Таблица строк</a>
	   <a class="admtoolsoptions" href="<?php echo @W_SITEPATH; ?>
account/admgeneralsuboptions/"<?php if ($_GET['hrzd'] == 'admgeneralsuboptions'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Надстройки сайта</a>
	   <a class="admredirectlktable" href="<?php echo @W_SITEPATH; ?>
account/admredirectlktable/"<?php if ($_GET['hrzd'] == 'admredirectlktable'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Перенаправления ссылок</a>
	   <a class="admuserslistenclass" href="<?php echo @W_SITEPATH; ?>
account/admuserslisten/"<?php if ($_GET['hrzd'] == 'admuserslisten'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Пользователи сайта</a>
       
       <a class="admuserslistenclass" href="<?php echo @W_SITEPATH; ?>
account/admusersgroups/"<?php if ($_GET['hrzd'] == 'admusersgroups'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Группы пользователей</a>
       
       <a class="adminformersfiles" href="<?php echo @W_SITEPATH; ?>
account/admrefbunners/"<?php if ($_GET['hrzd'] == 'admrefbunners'): ?> style="font-weight: bold; text-decoration: none;"<?php endif; ?>>Реферальные баннеры</a>
       
       <a class="adminformersfiles" style="background: transparent url(<?php echo @W_SITEPATH; ?>
img/ico/general/pages.png) no-repeat left top<?php if ($_GET['hrzd'] == 'admpspageslist'): ?>; font-weight: bold; text-decoration: none;<?php endif; ?>" href="<?php echo @W_SITEPATH; ?>
account/admpspageslist/">Отдельные страницы проекта</a>       
       	  	   
	 </div>    
    <!-- account admin menu and -->
	<?php endif; ?>
    
   </div>
   <!-- general menu list end -->
   
   <!-- news list begin -->
   <?php if (! $this->_tpl_vars['ismain_page']): ?>
    <div class="leftmenudwblocknews">
     <div>
	  <a class="black" href="<?php echo @W_SITEPATH; ?>
news/1/" style="font-weight: bold; text-decoration: none;">Новости сайта</a>
	 </div>
	 <div style="margin-top: 8px; font-size: 95%">
	  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "items/last_news_block.tpl", 'smarty_include_vars' => array('newstype' => '1','limit' => '5','fontsize' => '100%','fontsizeallnews' => '95%','fulldate' => '1','noshowallnews' => '1','marginleft' => '0px')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	 </div>
	</div>
   <?php endif; ?>   
   <!-- news list end -->
   
   <?php if ($_POST['doactiontool'] == 'do' && ! $this->_tpl_vars['ismain_page']): ?>
    <!-- updates begin -->
	<div class="leftmenudwblockupdates">
     <div>
	  <a class="black" href="<?php echo @W_SITEPATH; ?>
updates/" style="font-weight: bold; text-decoration: none;">Апдейты поисковиков</a>
	 </div>
     <div style="margin-top: 8px">
	  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "items/updates_block.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	 </div>
	</div>
	<!-- updates end --> 
  
	
	<!-- links vitrina begin -->
    <div class="leftmenudwblockupdates">
     <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "items/links_vitrina_block.tpl", 'smarty_include_vars' => array('linkfontsize' => '95%','linkleftmargin' => '0px')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>  
    <!-- links vitrina end -->  
    
    <?php if (@W_HTMLCODERIGHTDOWNBLOCK): ?>
     <div class="leftmenudwblockupdates"><div><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText(@W_HTMLCODERIGHTDOWNBLOCK); ?>
</div></div>
    <?php endif; ?>
    
    <div style="margin-top: 15px; padding-left: 7px; color: #C0C0C0; font-size: 95%"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sape_code.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
    
   <?php endif; ?>
   
   <?php if ($this->_tpl_vars['ismain_page']): ?>
    
    
    <?php if (@W_HTMLCODELEFTDOWNBLOCKAFTMENU): ?>
     <div class="leftmenudwblockupdates" style="margin-left: 0px">
      <div><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText(@W_HTMLCODELEFTDOWNBLOCKAFTMENU); ?>
</div>
     </div>
    <?php endif; ?>  
   <?php endif; ?>
   
   		
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
	     	     <div><span style="width: 100%">
		 <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
	       <td valign="top" align="left" width="<?php if (isset ( $this->_tpl_vars['tool_object'] )): ?>20px<?php else: ?>1px<?php endif; ?>">
	       <?php if (isset ( $this->_tpl_vars['tool_object'] )): ?>
	        	        <img src="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetToolImageStyle($this->_tpl_vars['tool_object']->section_id,16,'',''); ?>
" style="width: 16px; height: 16px;">
	       <?php endif; ?>		   
		   </td>
	       <td valign="center" align="left">
	        <div class="content_title"><h1 style="font-size: 105%"><?php if ($this->_tpl_vars['section_info']['stitle']): ?><?php echo $this->_tpl_vars['section_info']['stitle']; ?>
<?php else: ?>Инструменты для вебмастера и оптимизатора<?php endif; ?></h1></div>
		   </td>
          </tr>
         </table>
		 </span></div>
		</td>
	    <td valign="center" align="right" width="200px" style="white-space: nowrap;">
		 <?php if ($this->_tpl_vars['CONTROL_OBJ']->IsOnline()): ?>
		  		  <div>Здравствуйте, <b><a href="<?php echo @W_SITEPATH; ?>
account/"><?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['username']; ?>
</a></b>! <span style="margin-left: 6px">[ <a href="<?php echo @W_SITEPATH; ?>
exit/" class="black" style="margin-left: 0px; font-size: 95%">Выход</a> ]</span></div>
		  <div style="margin-top: 5px; font-size: 95%">
		  Баланс: <a href="<?php echo @W_SITEPATH; ?>
account/payhistory/"><b style="color: #000000"><?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['purcedata']; ?>
 USD</b></a>, новых сообщений: <a href="<?php echo @W_SITEPATH; ?>
account/mail/"><b style="color: #FF0000"><?php echo $this->_tpl_vars['global_user_info']['privatenew']; ?>
</b></a>
		  </div>
		 <?php else: ?>
		  		  
		  <div><a href="#" onclick="ShowDialogInput()" class="black_dashed">Войти</a> или <a class="black" href="<?php echo @W_SITEPATH; ?>
register/">зарегистрироваться</a></div>
		  <div style="margin-top: 5px; font-size: 95%">		  
		   <a class="gray" href="<?php echo @W_SITEPATH; ?>
restore/">Забыли пароль?</a>
		  </div>		 		 
		 <?php endif; ?>		
		</td>
       </tr>
       </table>
	  </span>	 
	 </div>
	 <b class="r1"></b><b class="r1"></b><b class="r2"></b><b class="r3"></b><b class="r5"></b>
	</div>
   <!-- header info line block end -->
   
      <?php if (! $this->_tpl_vars['CONTROL_OBJ']->IsOnline()): ?>
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
	    '; ?>

   <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
       <span id="ui-dialog-title-dialog" class="ui-dialog-title">Вход в кабинет</span>
       <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
    </div>
    <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_input">
       <div class="typelabel">        
        
		<form method="post" name="qinput" id="qinput" onsubmit="return OnSd(this)">
	    <div>	   	      
	     <input type="text" class="inpt" style="width: 165px" name="qlogin" id="qlogin" maxlength="99" onblur="OnBl(this,'Логин')" onfocus="OnFs(this,'Логин')" value="<?php if ($_POST['actionlog'] == 'do'): ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->HTMLspecialChars($_POST['qlogin']); ?>
<?php else: ?>Логин<?php endif; ?>">
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
    
   <?php endif; ?>
   
   <!-- navigation line begin -->
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
  <?php endif; ?>
   <!-- navigation line end -->
   
   <?php if (! $this->_tpl_vars['ismain_page'] && @W_HTMLCODETOPCENTERBLOCK): ?>
    <div style="margin-top: 2px"></div>
    <div style="padding-left: 14px"><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText(@W_HTMLCODETOPCENTERBLOCK); ?>
</div>
   <?php endif; ?>

   
   <!-- content here begin -->
   <div class="contentdata">
    <span style="width: 100%">
	<table width="100%" cellpadding="0" cellspacing="0">
     <tr>
	  <td valign="top" align="left" style="padding-right: 6px">
	   
	   	   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['section_info']['file'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	   
	  </td>
	  <td valign="top" align="left" width="<?php if ($_POST['doactiontool'] == 'do' || $this->_tpl_vars['ismain_page']): ?>0px<?php else: ?>260px<?php endif; ?>">	  
	  	   
	   <?php if ($_POST['doactiontool'] != 'do' && ! $this->_tpl_vars['ismain_page']): ?>	
	    <!-- links vitrina begin -->
        <div class="leftmenudwblockupdates" style="margin-top: 0px">
         <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "items/links_vitrina_block.tpl", 'smarty_include_vars' => array('linkfontsize' => '100%','linkleftmargin' => '0px')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </div>  
        <!-- links vitrina end -->
		
		<!-- updates begin -->
	    <div class="leftmenudwblockupdates">
         
         
	    </div>
	    <!-- updates end -->

	    
	    <!-- news begin -->
	    
        
        <?php if (@W_HTMLCODERIGHTDOWNBLOCK): ?>
         <div class="leftmenudwblockupdates"><div><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText(@W_HTMLCODERIGHTDOWNBLOCK); ?>
</div></div>
        <?php endif; ?>
        
        <div style="margin-top: 15px; padding-left: 7px; color: #C0C0C0; font-size: 95%"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sape_code.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
			   
	   <?php endif; ?>
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
 
 <div style="padding-left: 260px; color: #C0C0C0<?php if ($_POST['doactiontool'] == 'do'): ?>; margin-top: 29px;<?php endif; ?>">
 <?php if ($this->_tpl_vars['ismain_page']): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sape_code.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php else: ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sape_code2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
 </div>
 
 
 
 
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