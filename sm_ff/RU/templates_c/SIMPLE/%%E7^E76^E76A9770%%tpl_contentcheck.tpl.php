<?php /* Smarty version 2.6.26, created on 2016-05-15 08:44:40
         compiled from tools/tpl_contentcheck.tpl */ ?>
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetToolImageStyle($this->_tpl_vars['tool_object']->section_id,128,'',''); ?>
" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 <?php if ($this->_tpl_vars['tool_object']->GetToolLimitInfoEx('tdescr')): ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText($this->_tpl_vars['tool_object']->GetToolLimitInfoEx('tdescr')); ?>
<?php else: ?>
 Данный инструмент поможет Вам Выполнить анализ контента указанного сайта (страницы).<br /><br />
 Для успешного продвижения сайта, необходимо иметь релевантный контент и оптимальную плотность слов. При помощи данного сервиса вы сможите выполнить максимально полный анализ контента вашего сайта.<br />
При выполнении анализа будет проанализирован контент вашего сайта на: вес страницы; релевантность, плотность заголовка (title), ключевых слов (keywords) к тексту страницы; скорость, время загрузки страницы; анализирован текст страницы; обработаны стоп-слова; процентное соотношение вхождений слов с текстом страницы; рассчитана частота (TF) терминов содержимого страницы.
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
   
   <div class="typelabel">Разделитель ключевых слов (Keywords)</div>
   <div class="typelabel">
	 <select size="1" name="separatorkeywords" id="separatorkeywords" style="width: 200px">
	  <option>Запятая</option>
	  <option value="1"<?php if ($_POST['separatorkeywords'] == '1'): ?> selected="selected"<?php endif; ?>>Пробел</option>
     </select>   
   </div>
   
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
       if (n) { $(th).css(\'background\',\'#F9FAFB\'); } else {   	
        $(th).css(\'background\', \'none\');		
       }	
      }//DoHigl 
     </script>
     <style type="text/css">
      .h_th1, .h_td, .h_td2 { 
       border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; border-right: none; 
       border-right: none; font-weight: bold; 
      }
      .h_td { border-left: none; }
      .h_td2 { border-right: 1px solid #E3E4E8; border-left: none; }
      .btn_n { border: 1px solid #E3E4E8; border-top: none; height: 25px; margin-top: 4px; }
      .sth1 { border-bottom: 1px solid #E3E4E8; height: 25px; border-top: none; }	
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
	    URL:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    <noindex><a rel="nofollow" href="<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.linkcheck'); ?>
" target="_blank"><?php echo $this->_tpl_vars['tool_object']->CorrectURLLink($this->_tpl_vars['tool_object']->GetResult('pageinfo.linknorot'),50); ?>
</a></noindex>
		<label style="margin-left: 8px">(<a style="font-size: 95%; color: #808080" href="<?php echo @W_SITEPATH; ?>
tools/whoisurlip/<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.linknorot'); ?>
" target="_blank">WHOIS IP</a>, <a style="font-size: 95%; color: #808080" href="<?php echo @W_SITEPATH; ?>
tools/whoisdomain/<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.linknorot'); ?>
" target="_blank">WHOIS DOMAIN</a>)</label>	    
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
	    Всего символов (с html тэгами):	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.charscount'); ?>

	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Всего символов (текст):	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.textcount'); ?>

	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Всего символов (текст без пробелов):	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.nospcount'); ?>

	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Доля контента ко всему коду страницы:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.compereto'); ?>
 %
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
tools/checkurllinks/<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.linknorot'); ?>
" target="_blank">Анализ</a></noindex>
	   </td>
      </tr>      
	
	  </table>	
	 </span>	 
	 </div> 
    
	 <div class="analisislabelid"><b>Постоянная ссылка на страницу</b></div>
	 <div style="margin-top: 12px; width: 96%">
	  <textarea style="border: none; background: #FFFFFF; width: 96%" readonly="readonly" onclick="this.select()">http://<?php echo @W_HOSTMYSITE; ?>
/tools/contentcheck/<?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.host'); ?>
</textarea>
	 </div>
     
     <div class="analisislabelid"><b>Общие данные сайта</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'genblocksource4')">Скрыть</a> ]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="genblocksource4">    
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tools/contentcheck/tpl_block-general-sys-items-list.tpl", 'smarty_include_vars' => array('url_p' => $this->_tpl_vars['tool_object']->GetResult('pageinfo.host'))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	 	  	  
	 </div>
	 
	 <div class="analisislabelid"><b>Заголовок (title)</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'titleblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="titleblocksource">
	  <?php if (! $this->_tpl_vars['tool_object']->GetResult('titleinfo')): ?>
	   <div style="margin-left: 4px; color: #FF0000">Тэг &lt;title&gt; не найден на странице!</div>
	  <?php else: ?>
	   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tools/contentcheck/tpl_taganalisysresultblock.tpl", 'smarty_include_vars' => array('block_ident' => 'titleinfo')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	   
	  <?php endif; ?>
	 </div>
	 
	 <noindex>
	 <div class="analisislabelid"><b>Ключевые слова (keywords)</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'keywordsblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="keywordsblocksource">
	  <?php if (! $this->_tpl_vars['tool_object']->GetResult('keywordsinfo')): ?>
	   <div style="margin-left: 4px; color: #FF0000">Ключевые слова не найдены на странице!</div>
	  <?php else: ?>
	   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tools/contentcheck/tpl_taganalisysresultblock.tpl", 'smarty_include_vars' => array('block_ident' => 'keywordsinfo')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	   
	  <?php endif; ?>
	 </div>
	 
	 <div class="analisislabelid"><b>Описание страници (description)</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'descriptionblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="descriptionblocksource">
	  <?php if (! $this->_tpl_vars['tool_object']->GetResult('descriptioninfo')): ?>
	   <div style="margin-left: 4px; color: #FF0000">Описание не найдено на странице!</div>
	  <?php else: ?>
	   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tools/contentcheck/tpl_taganalisysresultblock.tpl", 'smarty_include_vars' => array('block_ident' => 'descriptioninfo')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	   
	  <?php endif; ?>
	 </div>
	 	 
	 <div class="analisislabelid"><b>Тэги h1 - h6</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'h1h6blocksource')">Скрыть</a>]</label>
	 </div>	  
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="h1h6blocksource">
	  <?php if (! $this->_tpl_vars['tool_object']->CheckForExists('h1info,h2info,h3info,h4info,h5info,h6info')): ?>
	   <div style="margin-left: 4px; color: #FF0000">Тэги с <b>h1</b> по <b>h6</b> не найдены!</div>
	  <?php else: ?>	  
	   <?php if ($this->_tpl_vars['tool_object']->GetResult('h1info')): ?>
	    <div style="margin-top: 10px"><b style="color: #969696">Тэг <b>h1</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         <?php echo $this->_tpl_vars['tool_object']->GetResult('h1info.data'); ?>

        </div>
	   <?php endif; ?>
	  
	   <?php if ($this->_tpl_vars['tool_object']->GetResult('h2info')): ?>
	    <div style="margin-top: 10px"><b style="color: #969696">Тэг <b>h2</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         <?php echo $this->_tpl_vars['tool_object']->GetResult('h2info.data'); ?>

        </div>
	   <?php endif; ?>
	  
	   <?php if ($this->_tpl_vars['tool_object']->GetResult('h3info')): ?>
	    <div style="margin-top: 10px"><b style="color: #969696">Тэг <b>h3</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         <?php echo $this->_tpl_vars['tool_object']->GetResult('h3info.data'); ?>

        </div>
	   <?php endif; ?>
	  
	   <?php if ($this->_tpl_vars['tool_object']->GetResult('h4info')): ?>
	    <div style="margin-top: 10px"><b style="color: #969696">Тэг <b>h4</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         <?php echo $this->_tpl_vars['tool_object']->GetResult('h4info.data'); ?>

        </div>
	   <?php endif; ?>
	  
	   <?php if ($this->_tpl_vars['tool_object']->GetResult('h5info')): ?>
	    <div style="margin-top: 10px"><b style="color: #969696">Тэг <b>h5</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         <?php echo $this->_tpl_vars['tool_object']->GetResult('h5info.data'); ?>

        </div>
	   <?php endif; ?>
	  
	   <?php if ($this->_tpl_vars['tool_object']->GetResult('h6info')): ?>
	    <div style="margin-top: 10px"><b style="color: #969696">Тэг <b>h6</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         <?php echo $this->_tpl_vars['tool_object']->GetResult('h6info.data'); ?>

        </div>
	   <?php endif; ?>
	   
	  <?php endif; ?>
	 </div>
	 
	 <div class="analisislabelid"><b>Контент страницы</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'contentblocksource')">Скрыть</a>]</label>
	 </div>	  
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="contentblocksource">
	  <?php if (! $this->_tpl_vars['tool_object']->GetResult('contentinfo')): ?>
	   <div style="margin-left: 4px; color: #FF0000">Не удалось получить контент страницы!</div>
	  <?php else: ?>
	   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tools/contentcheck/tpl_taganalisysresultblock.tpl", 'smarty_include_vars' => array('block_ident' => 'contentinfo','iscontent_info' => '1')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	   
	  <?php endif; ?>	 
	 </div>
	 </noindex>
     
	</div>
   <?php else: ?>
    <div style="color: #FF0000">Нет данных</div>
   <?php endif; ?>   
  <?php endif; ?>
  </div>
 <?php else: ?>
    <div style="margin-top: 26px">
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tools/tpl_toolhistorylist.tpl", 'smarty_include_vars' => array('noindexlinks' => '1')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  </div> 
 <?php endif; ?> 
 
 <?php endif; ?>
</div>