<?php /* Smarty version 2.6.26, created on 2013-11-12 17:59:49
         compiled from tools/tpl_analysis.tpl */ ?>
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetToolImageStyle($this->_tpl_vars['tool_object']->section_id,128,'',''); ?>
" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 <?php if ($this->_tpl_vars['tool_object']->GetToolLimitInfoEx('tdescr')): ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText($this->_tpl_vars['tool_object']->GetToolLimitInfoEx('tdescr')); ?>
<?php else: ?>
  Данный инструмент поможет Вам Выполнить анализ сайта по наиболее значимым показателям сайта.<br /><br />
 <?php endif; ?>
  
 <div style="clear: both;"></div>
 </div>

 <?php if (! $this->_tpl_vars['tool_object']->canrun): ?>
  <div style="margin-top: 25px">
  <?php if ($this->_tpl_vars['tool_object']->onlyforadmin): ?>
  Инструмент временно отключен администратором! Приносим извинения за неудобства.. Пожалуйста, повторите попытку позже.
  <?php else: ?>  
  Для использования данного инструмента требуется авторизация на сайте. Пожалуйста, авторизируйтесь или <a href="<?php echo @W_SITEPATH; ?>
register/" target="_blank">зарегистрируйтесь</a> для получения доступа к инструменту.
  <?php endif; ?> 
  </div>
 <?php else: ?>
  
 <?php echo '
 <script type="text/javascript">
  function DoSetDefUrl(ident) {
   var str = '; ?>
'<?php echo @W_HOSTMYSITE; ?>
';<?php echo '
   var obj = $(\'#\'+ident);
   obj.val(str); 
   obj.focus();  	
  }//DoSetDefUrl
  function PrepereToSend(th) {
   if (trim(th.url.value) == \'\') {
	alert(\'Укажите URL!\');
	th.url.focus();
	return false;
   }
   $(\'#globalbodydata\').css(\'cursor\', \'wait\');
   th.rb.disabled = true;   
   return true;	
  }//PrepereToSend  	
 </script>
 '; ?>

 <form method="post" name="tollform" id="toolform" onsubmit="return PrepereToSend(this)">
  <div class="typelabel"><label id="red">*</label> URL<label class="prep_label_analisys">(пример: <a href="javascript:" onclick="DoSetDefUrl('url')"><?php echo @W_HOSTMYSITE; ?>
</a>)</label></div>
  <div class="typelabel">  
   <input type="text" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('url','doactiontool'); ?>
" style="width: 98%" class="inpt" name="url" id="url">
   
   <div class="typelabel">
    <input type="submit" value="&nbsp;Отправить&nbsp;" class="button" name="rb" id="rb">
   </div> 
  </div>
  <input type="hidden" value="do" name="doactiontool">  
 </form>
 <?php if ($_POST['doactiontool'] == 'do' && isset ( $this->_tpl_vars['tool_object'] )): ?>
  <div style="margin-top: 15px">
  <?php if ($this->_tpl_vars['tool_object']->error): ?>
  <div style="color: #FF0000"><?php echo $this->_tpl_vars['tool_object']->error; ?>
</div>
  <?php else: ?>
   <?php if ($this->_tpl_vars['tool_object']->GetResult()): ?> 
    <div>
     <?php echo '
     <script type="text/javascript">
	  function ShHdBlElement(th, ident) {	   
	   var hd = ($(\'#\'+ident).css(\'visibility\') == \'hidden\') ? true : false; 
	   $(th).html((hd) ? \'Скрыть\' : \'Показать\');
	   $(\'#\'+ident).css(\'visibility\', (hd) ? \'visible\' : \'hidden\');
	   $(\'#\'+ident).css(\'display\', (hd) ? \'block\' : \'none\');
	  }//ShHdBlElement 
	  
	  function DoHigl(th, n) {	
       if (n) { $(th).css(\'background\',\'#F8F5F1\'); } else {   	
        $(th).css(\'background\', \'none\');		
       }	
      }//DoHigl 
     </script>
     <style type="text/css">
      .h_th1, .h_td, .h_td2 { 
       border: 1px solid #E4D9CB; background: #EEE7DF; height: 25px; border-bottom: none; border-right: none; 
       border-right: none; font-weight: bold; 
      }
      .h_td { border-left: none; }
      .h_td2 { border-right: 1px solid #E4D9CB; border-left: none; }
      .btn_n { border: 1px solid #E4D9CB; border-top: none; height: 25px; margin-top: 4px; }
      .sth1 { border-bottom: 1px solid #E4D9CB; height: 25px; border-top: none; } 	
     </style>
     '; ?>

     <div><b>Общие данные о странице</b></div>
	 <div style="margin-top: 12px">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
	  
	  <?php if ($this->_tpl_vars['tool_object']->GetResult('cachlastupdatedate')): ?>
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px" style="color: #333399">
	    Последнее обновление данных:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px; color: #333399"> 
	    <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['tool_object']->GetResult('cachlastupdatedate')); ?>
 &nbsp;
	    (<?php echo $this->_tpl_vars['tool_object']->GetResult('cachlastupdatedate'); ?>
)
        
         <?php if ($this->_tpl_vars['tool_object']->NextUpdateDate()): ?>
         <label style="margin-left: 5px; font-size: 95%; color: #000000">
         (для обновления - зарегистрируйтесь, следующее обновление через: <?php echo $this->_tpl_vars['tool_object']->NextUpdateDate(); ?>
)
         </label>
         <?php endif; ?>
                  
	   </td>
      </tr>
      <?php endif; ?>
	  	  
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    <div style="margin-top: 4px; margin-bottom: 4px">
		<img src="http://mini.site-shot.com/1024x768/120/jpeg/?http://<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.realhost'); ?>
" 
		width="120" height="90"></div>			    
	   </td>	 
	   <td class="sth1" valign="top" align="left" style="padding-left: 8px"> 		
		<div style="margin-top: 4px"><a href="http://<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.host'); ?>
" target="_blank"><?php echo $this->_tpl_vars['tool_object']->CorrectURLLink($this->_tpl_vars['tool_object']->GetResult('pageinfo.host'),50); ?>
</a>
		<span style="margin-left: 2px">
		<img src="http://favicon.yandex.net/favicon/<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.host'); ?>
" width="16" height="16">
		</span>
		<label style="margin-left: 3px">(<a style="font-size: 95%; color: #808080" href="<?php echo @W_SITEPATH; ?>
tools/whoisurlip/<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.host'); ?>
" target="_blank">WHOIS IP</a>, <a style="font-size: 95%; color: #808080" href="<?php echo @W_SITEPATH; ?>
tools/whoisdomain/<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.host'); ?>
" target="_blank">WHOIS DOMAIN</a>)</label></div>	    
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Размер страницы:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    <?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.size'); ?>

	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Кодировка:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    <?php if ($this->_tpl_vars['tool_object']->GetResult('pageinfo.encode')): ?>
		 <?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.encode'); ?>

		<?php else: ?>
		 ?
		<?php endif; ?>
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    IP сайта:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    <?php if ($this->_tpl_vars['tool_object']->GetResult('pageinfo.ip')): ?>
		 <?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.ip'); ?>

		 <span style="margin-left: 12px">
		  <noindex><a href="<?php echo $this->_tpl_vars['tool_object']->GetResult('ipinfolink'); ?>
" target="_blank">Все сайты на IP</a></noindex>
		 </span>
		<?php else: ?>
		 ?
		<?php endif; ?>
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Скорость загрузки:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    <?php if ($this->_tpl_vars['tool_object']->GetResult('pageinfo.speed')): ?>
		 <?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.speed'); ?>

		<?php else: ?>
		 ?
		<?php endif; ?>
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Время загрузки:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    <?php if ($this->_tpl_vars['tool_object']->GetResult('pageinfo.time')): ?>
		 <?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.time'); ?>
 sec
		<?php else: ?>
		 ?
		<?php endif; ?>
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Перенаправление:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<?php if ($this->_tpl_vars['tool_object']->GetResult('pageinfo.redirectto')): ?>
		 <noindex><a rel="nofollow" href="<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.redirectto'); ?>
" target="_blank"><?php echo $this->_tpl_vars['tool_object']->CorrectURLLink($this->_tpl_vars['tool_object']->GetResult('pageinfo.redirectto'),100); ?>
</a></noindex>		 
		<?php else: ?>
		 <i>(нет)</i>
		<?php endif; ?> 
	   </td>
      </tr>
	  
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Внутренние / внешние ссылки:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<noindex><a rel="nofollow" href="<?php echo @W_SITEPATH; ?>
tools/checkurllinks/<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.host'); ?>
" target="_blank">Анализ</a></noindex>
	   </td>
      </tr>
	  
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Анализ контента страницы:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<noindex><a rel="nofollow" href="<?php echo @W_SITEPATH; ?>
tools/contentcheck/<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.host'); ?>
" target="_blank">Выполнить</a></noindex>
	   </td>
      </tr> 
	  
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Посетителей за сутки по 
		<label style="border-bottom: 1px dashed #333399; cursor: help" title="Live Internet">LI</label>:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<?php if ($this->_tpl_vars['tool_object']->GetResult('LIvalue.LiDayStatistic')): ?>
		 <?php echo $this->_tpl_vars['tool_object']->GetResult('LIvalue.LiDayStatistic'); ?>

		<?php else: ?>
		 ?
		<?php endif; ?> 
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Посетителей за месяц по 
		<label style="border-bottom: 1px dashed #333399; cursor: help" title="Live Internet">LI</label>:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<?php if ($this->_tpl_vars['tool_object']->GetResult('LIvalue.LiMonthStatistic')): ?>
		 <?php echo $this->_tpl_vars['tool_object']->GetResult('LIvalue.LiMonthStatistic'); ?>

		<?php else: ?>
		 ?
		<?php endif; ?> 
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Сервер сайта:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<?php if ($this->_tpl_vars['tool_object']->GetResult('pageinfo.server')): ?>
		 <?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.server'); ?>

		<?php else: ?>
		 ?
		<?php endif; ?> 
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Расположение датацентра:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<?php if ($this->_tpl_vars['tool_object']->GetResult('pageinfo.servergeo')): ?>
		 <?php if ($this->_tpl_vars['tool_object']->FlagExists()): ?>
		  <span style="margin-right: 3px"><img src="<?php echo $this->_tpl_vars['tool_object']->GetFlagName(); ?>
" width="22" height="16"></span>
		 <?php endif; ?>		 
		 <?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.servergeo'); ?>

		<?php else: ?>
		 ?
		<?php endif; ?> 
	   </td>
      </tr>     

      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Сервер:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<?php if ($this->_tpl_vars['tool_object']->GetResult('pageinfo.res_server')): ?>		 
		 <?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.res_server'); ?>

		<?php else: ?>
		 ?
		<?php endif; ?> 
	   </td>
      </tr>
	  
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Заработок:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<noindex><a href="http://u.to/6L7-BA" target="_blank" class="gotoregurl">Вы можете зарабатывать на сайте более <label style="color: #FF0000"><?php if ($this->_tpl_vars['tool_object']->GetResult('pageinfo.getmoneyfromb') === false): ?>50<?php else: ?><?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.getmoneyfromb'); ?>
<?php endif; ?>$</label></a></noindex> 
	   </td>
      </tr>  
	  	
	  </table>	
	 </span>	 
	 </div> 
    
	 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Постоянная ссылка на страницу</b>
	 </div>
	 <div style="margin-top: 12px; width: 96%">
	  <textarea style="border: none; background: #FFFFFF; width: 96%" readonly="readonly" onclick="this.select()">http://<?php echo @W_HOSTMYSITE; ?>
/tools/<?php echo $this->_tpl_vars['tool_object']->section_id; ?>
/<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.host'); ?>
</textarea>
	 </div>
	 
	 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Информационные тэги сайта</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'title1blocksource')">Скрыть</a>]</label>
	 </div>	  
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="title1blocksource">
	    
	   <div style="margin-top: 10px"><b style="color: #969696">Заголовок (title)</b></div>
       <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
        <?php if (! $this->_tpl_vars['tool_object']->GetResult('pageinfo.title')): ?>
         <div style="margin-left: 5px; color: #FF0000">Заголовок не найден!</div>
        <?php else: ?>
         <?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.title'); ?>

        <?php endif; ?> 
       </div>
       
       <div style="margin-top: 10px"><b style="color: #969696">Ключевые слова (keywords)</b></div>
       <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
        <?php if (! $this->_tpl_vars['tool_object']->GetResult('pageinfo.keywords')): ?>
         <div style="margin-left: 5px; color: #FF0000">Ключевые слова не найдены!</div>
        <?php else: ?>
         <?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.keywords'); ?>

        <?php endif; ?> 
       </div>
       
       <div style="margin-top: 10px"><b style="color: #969696">Описание (description)</b></div>
       <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
        <?php if (! $this->_tpl_vars['tool_object']->GetResult('pageinfo.description')): ?>
         <div style="margin-left: 5px; color: #FF0000">Описание не найдено!</div>
        <?php else: ?>        
         <?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.description'); ?>

        <?php endif; ?> 
       </div>
       
       <div style="margin-top: 10px"><b style="color: #969696">Тэг <b>h1</b></b></div>
       <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
        <?php if (! $this->_tpl_vars['tool_object']->GetResult('pageinfo.h1tag')): ?>
         <div style="margin-left: 5px; color: #FF0000">Тэг <b>h1</b> не найден!</div>
        <?php else: ?>         
         <?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.h1tag'); ?>
 
        <?php endif; ?> 
       </div>
	  
	 </div>
	 
	 
	 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Основные показатели сайта</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'genblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="genblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label id="red">Я</label>ндекс ТиЦ:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetResult('cyvalue.value') !== false): ?>
		  <b><?php echo $this->_tpl_vars['tool_object']->GetResult('cyvalue.value'); ?>
</b>
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
	   
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label id="red">Я</label>ндекс ТиЦ с WWW:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetResult('cyvalue.image_with_www')): ?>
		  <img src="<?php echo $this->_tpl_vars['tool_object']->GetResult('cyvalue.image_with_www'); ?>
" width="88" height="31">
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
	   
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label id="red">Я</label>ндекс ТиЦ без WWW:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetResult('cyvalue.image_without_www')): ?>
		  <img src="<?php echo $this->_tpl_vars['tool_object']->GetResult('cyvalue.image_without_www'); ?>
" width="88" height="31">
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Поднять ТиЦ:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <noindex><a href="http://wm-click.ru" target="_blank" class="gotoregurl">Поднять ТиЦ регистрируя сайт в каталогах</a></noindex> 
	    </td>
       </tr>  
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Склей домена:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetResult('cyvalue.comperewww')): ?>
		  <b style="color: #008000">Да</b>
		 <?php else: ?>
		  <b>Нет</b>
		 <?php endif; ?> 
	    </td>
       </tr>
	   
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label id="red">Я</label>ндекс Ранг:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetResult('cyvalue.rang') !== false): ?>
		  <b><?php echo $this->_tpl_vars['tool_object']->GetResult('cyvalue.rang'); ?>
</b> из <b>6</b>
		  <label style="margin-left: 6px">
		  <img src="<?php echo @W_SITEPATH; ?>
img/items/yrang/y_bar<?php echo $this->_tpl_vars['tool_object']->GetResult('cyvalue.rang'); ?>
.png">
		  </label>
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
	   
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Тема <label id="red">Я</label>ндекс.Каталога:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetResult('cyvalue.yacacatalog')): ?>
		  <?php echo $this->_tpl_vars['tool_object']->GetResult('cyvalue.yacacatalog'); ?>

		 <?php else: ?>
		  <i>(не описан в каталоге)</i>
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label> PageRank:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetResult('prvalue.value') !== false): ?>
		  <b><?php echo $this->_tpl_vars['tool_object']->GetResult('prvalue.value'); ?>
</b> из <b>10</b>
		  <label style="margin-left: 6px">
		  <img src="<?php echo @W_SITEPATH; ?>
img/items/pr/pr<?php echo $this->_tpl_vars['tool_object']->GetResult('prvalue.value'); ?>
.gif">
		  </label>
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Alexa Traffic Rank:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetResult('alexavalue.value') !== false): ?>
		  <b><?php echo $this->_tpl_vars['tool_object']->GetResult('alexavalue.value'); ?>
</b>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Alexa Traffic Rank (график):	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetResult('alexavalue.value') !== false): ?>
		  <img src="<?php echo $this->_tpl_vars['tool_object']->GetResult('alexavalue.graph'); ?>
">
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Статистика по Live Internet:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetResult('listatgraph') !== false): ?>
		  <img src="<?php echo $this->_tpl_vars['tool_object']->GetResult('listatgraph'); ?>
">
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>     
	
	  </table>	
	 </span>	  	  
	 </div>
	 
	 	 <?php if ($this->_tpl_vars['tool_object']->GetToolLimitInfoEx('enabledphistory')): ?> 
	  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tools/contentcheck/tpl_paramshistory_check_block.tpl", 'smarty_include_vars' => array('block_ident' => 'histanalisys','chart_width' => "98%",'chart_height' => '400px')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	 <?php endif; ?>
	 
	  
	 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tools/contentcheck/tpl_inenginetopresultblock.tpl", 'smarty_include_vars' => array('block_ident' => 'inenginetopq')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
     
          <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%"><b>Поисковый трафик с Google</b><label style="color: #000000; margin-left: 6px">[ <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'traffromgoole')">Скрыть</a> ]</label>
    </div>  
     <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="traffromgoole">    
      <object id="googlerfaphitem" width="700px" height="278px">
      <param name="wmode" value="transparent" />
      <param name="quality" value="high" />
      <param name="bgcolor" value="#ffffff" />
      <param name="allowScriptAccess" value="always" />
      <param name="movie" value="http://www.semrush.com/m/scripts/graph/graph_out.swf" />
      <param name="FlashVars" value="domain=<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.realhost'); ?>
&type=1&db=ru&w=700&h=278" />
      <embed src="http://www.semrush.com/m/scripts/graph/graph_out.swf" FlashVars="domain=<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.realhost'); ?>
&type=1&db=ru&w=700&h=278" quality="high" bgcolor="#ffffff" width="700px" height="278px" name="googlerfaphitem" align="middle" play="true" loop="false" quality="high" allowScriptAccess="always"type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer"></embed>
      </object>     
      </div>  
     
     <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%"><b>Backlink History (Majestic SEO)</b><label style="color: #000000; margin-left: 6px">[ <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'blinksviever')">Скрыть</a> ]</label>
    </div>  
     <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="blinksviever">   
     <img src="http://www.majesticseo.com/charts/backlinks-discovery/<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.realhost'); ?>
?w=600&h=270&IndexDataSource=F" border="0" /> 
     </div>   
	 
	 <?php echo '
	 <style type="text/css">
	  .fv{background:transparent url(http://favicon.yandex.ru/favicon/yandex.ru/www.dmoz.org/www.google.com/mail.ru/aport.ru/rambler.ru/www.bing.com/siteexplorer.search.yahoo.com/yaca.yandex.ru/blogs.yandex.ru/www.yahoo.com/images.yandex.ru/web.archive.org/otvet.mail.ru/www.copyscape.com/validator.w3.org/jigsaw.w3.org/network-tools.com/webo.in) no-repeat 0 0;width:16px;height:16px;display:block;float:left;margin-right:5px;}
	  .labfv { position: relative; top: 1px }
     </style>
	 '; ?>

	 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Наличие сайта в каталогах</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'indirsblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="indirsblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 0"></label>
		 <label class="labfv"><label id="red">Я</label>ндекс Каталог:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_InDirYandex')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_InDirYandex'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>
		  <label style="margin-left: 6px">
		  (<?php if ($this->_tpl_vars['tool_object']->GetResult('cyvalue.yacacatalog')): ?><b style="color: #008000">Да</b><?php else: ?><b>Нет</b><?php endif; ?>)
		  </label>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -16px"></label>
		 <label class="labfv"><label style="color: #008000">D</label>MOZ:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_InDirDMOZ')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_InDirDMOZ'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -32px"></label>
		 <label class="labfv">
		 <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label> каталог:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','GOOLE_DIR')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','GOOLE_DIR'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -48px"></label>
		 <label class="labfv">Mail.ru:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_InDirMail')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_InDirMail'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -62px"></label>
		 <label class="labfv">Aport:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_InDirAport')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_InDirAport'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -80px"></label>
		 <label class="labfv">Rambler Top 100:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_InDirRamblerTop100')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_InDirRamblerTop100'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>  
	
	  </table>	
	 </span>	  	  
	 </div>
	 
	 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Проиндексировано страниц</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'indexblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="indexblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 0"></label>
		 <label class="labfv"><label id="red">Я</label>ндекс:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_IndexYandex')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_IndexYandex'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -32px"></label>
		 <label class="labfv"><label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label>:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_IndexGoogle')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_IndexGoogle'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -96px"></label>
		 <label class="labfv">
		 Bing:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_IndexBing')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_IndexBing'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -112px"></label>
		 <label class="labfv">
		 Yahoo:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_IndexYahoo')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_IndexYahoo'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -80px"></label>
		 <label class="labfv">
		 Rambler:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_IndexRambler')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_IndexRambler'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
	  </table>	
	 </span>	  	  
	 </div>
	 
	 
	 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Ссылаются на сайт из</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'backurlblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="backurlblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 0"></label>
		 <label class="labfv"><label id="red">Я</label>ндекс:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_BackYandex')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_BackYandex'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -128px"></label>
		 <label class="labfv">
		 Сайты из <label id="red">Я</label>-Каталога:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','YANDEX_DIR_LINKS')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','YANDEX_DIR_LINKS'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -144px"></label>
		 <label class="labfv">
		 <label id="red">Я</label>ндекс блоги:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_BackYandexBlogs')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_BackYandexBlogs'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -32px"></label>
		 <label class="labfv">
		 <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label>:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_BackGoogle')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_BackGoogle'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -32px"></label>
		 <label class="labfv">
		 <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label> блоги:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','GOOGLE_BLOGS')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','GOOGLE_BLOGS'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -160px"></label>
		 <label class="labfv">
		 Yahoo:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_BackYahoo')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_BackYahoo'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -96px"></label>
		 <label class="labfv">
		 Bing:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_BackBing')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_BackBing'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -80px"></label>
		 <label class="labfv">
		 Rambler:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_BackRambler')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_Plugin_BackRambler'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -176px"></label>
		 <label class="labfv">
		 <label id="red">Я</label>ндекс картинки:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','YANDEX_IMAGES')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','YANDEX_IMAGES'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -32px"></label>
		 <label class="labfv">
		  <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label> картинки:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','GOOGLE_IMAGES')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','GOOGLE_IMAGES'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>       
       
	  </table>	
	 </span>	  	  
	 </div>
	 
	 
	 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Дополнительная информация</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'more1blocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="more1blocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -32px"></label>
		 <label class="labfv">
		 В кэше Google:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','GOOGLE_CACH')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','GOOGLE_CACH'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 0"></label>
		 <label class="labfv">
		 В кэше <label id="red">Y</label>andex:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','YANDEX_CACH')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','YANDEX_CACH'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
	   
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -32px"></label>
		 <label class="labfv">
		 Похожие сайты в Google:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','GOOGLE_RELAETED')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','GOOGLE_RELAETED'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
	   
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -192px"></label>
		 <label class="labfv">
		 История сайта:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','SITE_HISTORY')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','SITE_HISTORY'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
	   
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -208px"></label>
		 <label class="labfv">
		 Упоминания в Ответы@Mail.ru:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','MAIL_ANSWERS')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','MAIL_ANSWERS'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -224px"></label>
		 <label class="labfv">
		 Поиск плагиата:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','PLAGIAT_SEARCH')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','PLAGIAT_SEARCH'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>

	  </table>	
	 </span>	  	  
	 </div>
	 
	 
	 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Дополнительные инструменты</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'more2blocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="more2blocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -240px"></label>
		 <label class="labfv">
		 Проверка валидности HTML:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','HTML_VALIDATE')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','HTML_VALIDATE'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -256px"></label>
		 <label class="labfv">
		 Проверка валидности CSS:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','CSS_VALIDATE')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','CSS_VALIDATE'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -272px"></label>
		 <label class="labfv">
		 Ping\Traceroute\DNS:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','PING_TRACEROUT')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','PING_TRACEROUT'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -288px"></label>
		 <label class="labfv">
		 Скорость загрузки страницы:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 <?php if ($this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','PAGE_SPEED_LOAD')): ?>
		  <noindex> 
		   <a href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','PAGE_SPEED_LOAD'); ?>
" target="_blank">Посмотреть</a>
		  </noindex>		  
		 <?php else: ?>
		  ?
		 <?php endif; ?> 
	    </td>
       </tr>  

	  </table>	
	 </span>	  	  
	 </div>
	 
	 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Данные страницы</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'more3blocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="more3blocksource">
	  
	  <!-- html data -->
	  <div style="margin-top: 14px"><b style="color: #969696">Исходный контент страницы</b></div>
      <div style="margin-top: 10px">
       <textarea class="int_text" style="height: 120px; width: 100%"><?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.htmldata'); ?>
</textarea>
      </div>
      
      <!-- header -->
      <div style="margin-top: 14px"><b style="color: #969696">Ответ сервера</b></div>
      <div style="margin-top: 10px">
       <textarea class="int_text" style="height: 120px; width: 100%"><?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.headresponse'); ?>
</textarea>
      </div>
      
      <!-- robots.txt -->
      <div style="margin-top: 14px"><b style="color: #969696">Файл robots.txt</b>, размер: <u>
	  <?php echo $this->_tpl_vars['tool_object']->GetResult('headersize'); ?>

	  </u>, проверить на <noindex><a rel="nofollow" href="<?php echo $this->_tpl_vars['tool_object']->GetConstantElementValue('ss_BlockConstantValue','CHECK_ROBOTSTXT_WEBYAND'); ?>
" target="_blank">Яндекс.Вебмастер</a></noindex> </div>
      <div style="margin-top: 10px">
       <?php if ($this->_tpl_vars['tool_object']->GetResult('pageinfo.robots') === false): ?>
        <div style="margin-left: 5px; color: #FF0000">Файл <b>robots.txt</b> не найден!</div>
       <?php else: ?>
        <textarea class="int_text" style="height: 120px; width: 100%"><?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.robots'); ?>
</textarea>
       <?php endif; ?>
      </div>
	  	  
	 </div>
	 
     
	</div>
   <?php else: ?>
    <div style="color: #FF0000">Нет данных</div>
   <?php endif; ?>   
  <?php endif; ?>
  </div>
 <?php else: ?>
    <div style="margin-top: 26px">
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tools/tpl_toolhistorylist.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  </div> 
 <?php endif; ?> 
 
 <?php endif; ?> 
</div>