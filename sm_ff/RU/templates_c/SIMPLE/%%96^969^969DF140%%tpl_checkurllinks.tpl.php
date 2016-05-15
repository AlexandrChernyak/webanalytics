<?php /* Smarty version 2.6.26, created on 2016-05-15 09:43:05
         compiled from tools/tpl_checkurllinks.tpl */ ?>
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetToolImageStyle($this->_tpl_vars['tool_object']->section_id,128,'',''); ?>
" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 <?php if ($this->_tpl_vars['tool_object']->GetToolLimitInfoEx('tdescr')): ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText($this->_tpl_vars['tool_object']->GetToolLimitInfoEx('tdescr')); ?>
<?php else: ?>
 Данный инструмент поможет Вам провести анализ внутренних и внешних ссылок указанного сайта. Предоставить информацию о ссылках, доступных для индексации поисковиками и ссылках, запрещенных для индексации поисковиками.
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
	alert(\'Укажите url!\');
	th.url.focus();
	return false;
   }
   th.rb.disabled = true;
   $(\'#globalbodydata\').css(\'cursor\', \'wait\');   
   return true;	
  }//PrepereToSend  	
 </script>
 '; ?>

 <form method="post" name="tollform" id="toolform" onsubmit="return PrepereToSend(this)">
  <div class="typelabel"><label id="red">*</label> URL <label class="prep_label_analisys">(пример: <a href="javascript:" onclick="DoSetDefUrl('url')"><?php echo @W_HOSTMYSITE; ?>
</a>)</label></div>
  <div class="typelabel">  
   <input type="text" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('url','doactiontool'); ?>
" style="width: 450px" class="inpt" name="url" id="url">
   
   <div class="typelabel">
    <input type="checkbox" <?php if ($_POST['doactiontool'] == 'do' && $this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('ignoredoubled')): ?>checked="checked" <?php endif; ?>style="cursor: pointer" name="ignoredoubled" id="ignoredoubled"><label for="ignoredoubled" style="cursor: pointer">&nbsp;Не учитывать повторы ссылок</label>
   </div>
   
   <div class="typelabel">
    <input type="checkbox" <?php if ($_POST['doactiontool'] != 'do' || $this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('ignoreresh')): ?>checked="checked" <?php endif; ?>style="cursor: pointer" name="ignoreresh" id="ignoreresh"><label for="ignoreresh" style="cursor: pointer">&nbsp;Учитывать ссылки с #(параметр)</label>
   </div>
   
   <div class="typelabel">
    <input type="checkbox" <?php if ($_POST['doactiontool'] != 'do' || $this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('getonlyhost')): ?>checked="checked" <?php endif; ?>style="cursor: pointer" name="getonlyhost" id="getonlyhost"><label for="getonlyhost" style="cursor: pointer">&nbsp;Учитывать ссылки без протокола, но с текущим хостом</label>
   </div>
   
   <div class="typelabel">
    <input type="checkbox" <?php if ($_POST['doactiontool'] == 'do' && $this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('noinside')): ?>checked="checked" <?php endif; ?>style="cursor: pointer" name="noinside" id="noinside"><label for="noinside" style="cursor: pointer">&nbsp;Опустить внутренние ссылки</label>
   </div>
   
   <div class="typelabel">
    <input type="checkbox" <?php if ($_POST['doactiontool'] == 'do' && $this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('nooutside')): ?>checked="checked" <?php endif; ?>style="cursor: pointer" name="nooutside" id="nooutside"><label for="nooutside" style="cursor: pointer">&nbsp;Опустить внешние ссылки</label>
   </div>
   
   <div class="typelabel">
    <input type="checkbox" <?php if ($_POST['doactiontool'] == 'do' && $this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('nosubdom')): ?>checked="checked" <?php endif; ?>style="cursor: pointer" name="nosubdom" id="nosubdom"><label for="nosubdom" style="cursor: pointer">&nbsp;Опустить ссылки на поддомены</label>
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
    <div style="width: 530px; overflow: auto;">
     <?php echo '
	 <style type="text/css">
	  .numb_td { width: 50px; white-space: nowrap; }
     </style>
     <script type="text/javascript">
	  function ShHdBlElement(th, ident) {	   
	   var hd = ($(\'#\'+ident).css(\'visibility\') == \'hidden\') ? true : false; 
	   $(th).html((hd) ? \'Скрыть\' : \'Показать\');
	   $(\'#\'+ident).css(\'visibility\', (hd) ? \'visible\' : \'hidden\');
	   $(\'#\'+ident).css(\'display\', (hd) ? \'block\' : \'none\');
	  }//ShHdBlElement
	  var linksdata = new Array();
	  linksdata[\'ins_href\'] = new Array(); 
      linksdata[\'ins_href_full\'] = new Array();
      
      linksdata[\'out_href\'] = new Array();
      
      linksdata[\'sdm_href\'] = new Array();
      
      function LoadLinksList(ident, arrname, th) {
	   try {	   	
	   	th.disabled = true;
		$(\'#globalbodydata\').css(\'cursor\', \'wait\');
		var norepeat = document.getElementById(ident+\'norepeat\');
		norepeat = (norepeat && norepeat.checked) ? true : false;
		var id = $(\'#\'+ident);
		id.val(\'\');
		var arr2 = new Array();
		for (var i=0; i < linksdata[arrname].length; i++) {
		 linksdata[arrname][i] = trim(linksdata[arrname][i]);
		 if (linksdata[arrname][i] == \'\') { continue; }	
		 if (!norepeat || !InArray(arr2, linksdata[arrname][i])) {
		  if (id.val() == \'\') { id.val(linksdata[arrname][i]); } else { id.val(id.val() + "\\n" + linksdata[arrname][i]); }
		  if (norepeat) { arr2.push(linksdata[arrname][i]); }		  	
		 }		 	
		}		
	   } finally {
	   	$(\'#globalbodydata\').css(\'cursor\', \'auto\');
		th.disabled = false;		
	   }	   	
	  }//LoadLinksList
     </script>
     '; ?>

     
	 <?php if ($this->_tpl_vars['tool_object']->GetResult('inside')): ?>
      <div style="padding-bottom: 6px; border-bottom: 1px solid #003366"><b>Внутренние ссылки</b>
	   <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'insidel')">Скрыть</a>]</label>
	   <label style="margin-left: 4px; font-size: 95%; color: #000000">Индексируются: <b><?php echo $this->_tpl_vars['tool_object']->GetResult('inside_info.index'); ?>
</b>, не индексируются: <b><?php echo $this->_tpl_vars['tool_object']->GetResult('inside_info.noindex'); ?>
</b></label>
	  </div>
	  <div id="insidel">
	  <?php $_from = $this->_tpl_vars['tool_object']->GetResult('inside'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
	   <div style="margin-top: 15px">
	    <span style="width: 100%">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
         <tr>
	      <td class="numb_td" valign="top" align="right">
		   <label style="margin-right: 4px">№ <?php echo $this->_tpl_vars['tool_object']->GetIndex(($this->_foreach['val']['iteration']-1)); ?>
.</label>
		  </td>
	      <td valign="top" align="left">
		   <div>
		   <?php if ($this->_tpl_vars['val']['href']): ?>
		   <noindex><a href="<?php echo $this->_tpl_vars['val']['href_full']; ?>
" rel="nofollow" target="_blank"><?php if ($this->_tpl_vars['tool_object']->CorrectSymplyString($this->_tpl_vars['val']['text'])): ?><?php echo $this->_tpl_vars['tool_object']->CorrectSymplyString($this->_tpl_vars['val']['text']); ?>
<?php else: ?><?php echo $this->_tpl_vars['val']['href']; ?>
<?php endif; ?></a></noindex>
		   <label style="margin-left: 8px; font-size: 95%">
		   <?php if ($this->_tpl_vars['val']['noindex']): ?>
		    <b style="color: #FF0000">noindex</b>
		   <?php endif; ?>
		   <?php if ($this->_tpl_vars['val']['nofollow']): ?>
		    <?php if ($this->_tpl_vars['val']['noindex']): ?>, <?php endif; ?>
		    <b style="color: #FF0000">nofollow</b>
		   <?php endif; ?>
		   </label>
		   <?php else: ?>
		    Нет ссылки
		   <?php endif; ?> 
		   </div>
		   <div style="margin-top: 4px">
		    <?php if ($this->_tpl_vars['val']['href_full']): ?><?php echo $this->_tpl_vars['val']['href_full']; ?>

			&nbsp;&nbsp; <label style="font-size: 95%; color: #808080">[ <?php echo $this->_tpl_vars['val']['href']; ?>
 ]</label><?php else: ?>?<?php endif; ?>
		   </div>		  
		   <?php echo '
		    <script type="text/javascript">
	         linksdata[\'ins_href\'].push(\''; ?>
<?php echo $this->_tpl_vars['tool_object']->CorrectSymplyString($this->_tpl_vars['val']['href']); ?>
<?php echo '\');
	         linksdata[\'ins_href_full\'].push(\''; ?>
<?php echo $this->_tpl_vars['tool_object']->CorrectSymplyString($this->_tpl_vars['val']['href_full']); ?>
<?php echo '\');
            </script>
		   '; ?>

		  </td>
         </tr>
        </table>
		</span>	   
	   </div>
	  <?php endforeach; endif; unset($_from); ?>
	  <div style="margin-top: 15px"><b style="color: #808080">Ссылки списком:</b>
	   <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'blockinsidetext')">Показать</a>]</label>
	  </div>
	  <div id="blockinsidetext" style="visibility: hidden; display: none">
	   <div style="margin-top: 4px">
	    <textarea class="int_text" style="height: 120px; width: 95%" name="insidelist" id="insidelist"></textarea>
	   </div>
	   <div style="margin-top: 4px">
	    <input type="button" value="&nbsp;Исходный формат ссылок&nbsp;" class="button" onclick="LoadLinksList('insidelist', 'ins_href', this)"> &nbsp;
	    <input type="button" value="&nbsp;Полный формат ссылок&nbsp;" class="button" onclick="LoadLinksList('insidelist', 'ins_href_full', this)"> &nbsp;
	    <input type="checkbox" checked="checked" style="cursor: pointer" name="insidelistnorepeat" id="insidelistnorepeat"><label for="insidelistnorepeat" style="cursor: pointer">&nbsp;Без повторов</label>
	   </div>
	  </div>
	 </div>
     <?php endif; ?>
 
     <?php if ($this->_tpl_vars['tool_object']->GetResult('outside')): ?>
      <div style="padding-bottom: 6px; border-bottom: 1px solid #003366; <?php if ($this->_tpl_vars['tool_object']->GetResult('inside')): ?>margin-top: 34px<?php endif; ?>"><b>Внешние ссылки</b>
	   <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'outsidel')"><?php if ($this->_tpl_vars['tool_object']->GetResult('inside')): ?>Показать<?php else: ?>Скрыть<?php endif; ?></a>]</label>
	   <label style="margin-left: 4px; font-size: 95%; color: #000000">Индексируются: <b><?php echo $this->_tpl_vars['tool_object']->GetResult('outside_info.index'); ?>
</b>, не индексируются: <b><?php echo $this->_tpl_vars['tool_object']->GetResult('outside_info.noindex'); ?>
</b></label>
	  </div>
	  <div id="outsidel"<?php if ($this->_tpl_vars['tool_object']->GetResult('inside')): ?> style="visibility: hidden; display: none"<?php endif; ?>>
	  <?php $_from = $this->_tpl_vars['tool_object']->GetResult('outside'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
	   <div style="margin-top: 15px">
	    <span style="width: 100%">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
         <tr>
	      <td class="numb_td" valign="top" align="right">
		   <label style="margin-right: 4px">№ <?php echo $this->_tpl_vars['tool_object']->GetIndex(($this->_foreach['val']['iteration']-1)); ?>
.</label>
		  </td>
	      <td valign="top" align="left">
		   <div>
		   <?php if ($this->_tpl_vars['val']['href']): ?>
		   <noindex><a href="<?php echo $this->_tpl_vars['val']['href_full']; ?>
" rel="nofollow" target="_blank"><?php if ($this->_tpl_vars['tool_object']->CorrectSymplyString($this->_tpl_vars['val']['text'])): ?><?php echo $this->_tpl_vars['tool_object']->CorrectSymplyString($this->_tpl_vars['val']['text']); ?>
<?php else: ?><?php echo $this->_tpl_vars['val']['href']; ?>
<?php endif; ?></a></noindex>
		   <label style="margin-left: 8px; font-size: 95%">
		   <?php if ($this->_tpl_vars['val']['noindex']): ?>
		    <b style="color: #FF0000">noindex</b>
		   <?php endif; ?>
		   <?php if ($this->_tpl_vars['val']['nofollow']): ?>
		    <?php if ($this->_tpl_vars['val']['noindex']): ?>, <?php endif; ?>
		    <b style="color: #FF0000">nofollow</b>
		   <?php endif; ?>
		   </label>
		   <?php else: ?>
		    Нет ссылки
		   <?php endif; ?> 
		   </div>
		   <div style="margin-top: 4px">
		    <?php if ($this->_tpl_vars['val']['href_full']): ?><?php echo $this->_tpl_vars['val']['href_full']; ?>

			&nbsp;&nbsp; <label style="font-size: 95%; color: #808080">[ <?php echo $this->_tpl_vars['val']['href']; ?>
 ]</label><?php else: ?>?<?php endif; ?>
		   </div>		  
		   <?php echo '
		    <script type="text/javascript">
	         linksdata[\'out_href\'].push(\''; ?>
<?php echo $this->_tpl_vars['tool_object']->CorrectSymplyString($this->_tpl_vars['val']['href']); ?>
<?php echo '\');
            </script>
		   '; ?>

		  </td>
         </tr>
        </table>
		</span>	   
	   </div>
	  <?php endforeach; endif; unset($_from); ?>
	  <div style="margin-top: 15px"><b style="color: #808080">Ссылки списком:</b>
	   <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'blockoutsidetext')">Показать</a>]</label>
	  </div>
	  <div id="blockoutsidetext" style="visibility: hidden; display: none">
	   <div style="margin-top: 4px">
	    <textarea class="int_text" style="height: 120px; width: 95%" name="outsidelist" id="outsidelist"></textarea>
	   </div>
	   <div style="margin-top: 4px">
	    <input type="button" value="&nbsp;Получить список ссылок&nbsp;" class="button" onclick="LoadLinksList('outsidelist', 'out_href', this)"> &nbsp;
		<input type="checkbox" checked="checked" style="cursor: pointer" name="outsidelistnorepeat" id="outsidelistnorepeat"><label for="outsidelistnorepeat" style="cursor: pointer">&nbsp;Без повторов</label>
	   </div>
	  </div>
	 </div>
     <?php endif; ?>
     
     <?php if ($this->_tpl_vars['tool_object']->GetResult('subdom')): ?>
      <div style="padding-bottom: 6px; border-bottom: 1px solid #003366; <?php if ($this->_tpl_vars['tool_object']->GetResult('inside') || $this->_tpl_vars['tool_object']->GetResult('outside')): ?>margin-top: 34px<?php endif; ?>"><b>Ссылки на поддомены</b>
	   <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'subdoml')"><?php if ($this->_tpl_vars['tool_object']->GetResult('inside') || $this->_tpl_vars['tool_object']->GetResult('outside')): ?>Показать<?php else: ?>Скрыть<?php endif; ?></a>]</label>
	   <label style="margin-left: 4px; font-size: 95%; color: #000000">Индексируются: <b><?php echo $this->_tpl_vars['tool_object']->GetResult('subdom_info.index'); ?>
</b>, не индексируются: <b><?php echo $this->_tpl_vars['tool_object']->GetResult('subdom_info.noindex'); ?>
</b></label>
	  </div>
	  <div id="subdoml"<?php if ($this->_tpl_vars['tool_object']->GetResult('inside') || $this->_tpl_vars['tool_object']->GetResult('outside')): ?> style="visibility: hidden; display: none"<?php endif; ?>>
	  <?php $_from = $this->_tpl_vars['tool_object']->GetResult('subdom'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
	   <div style="margin-top: 15px">
	    <span style="width: 100%">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
         <tr>
	      <td class="numb_td" valign="top" align="right">
		   <label style="margin-right: 4px">№ <?php echo $this->_tpl_vars['tool_object']->GetIndex(($this->_foreach['val']['iteration']-1)); ?>
.</label>
		  </td>
	      <td valign="top" align="left">
		   <div>
		   <?php if ($this->_tpl_vars['val']['href']): ?>
		   <noindex><a href="<?php echo $this->_tpl_vars['val']['href_full']; ?>
" rel="nofollow" target="_blank"><?php if ($this->_tpl_vars['tool_object']->CorrectSymplyString($this->_tpl_vars['val']['text'])): ?><?php echo $this->_tpl_vars['tool_object']->CorrectSymplyString($this->_tpl_vars['val']['text']); ?>
<?php else: ?><?php echo $this->_tpl_vars['val']['href']; ?>
<?php endif; ?></a></noindex>
		   <label style="margin-left: 8px; font-size: 95%">
		   <?php if ($this->_tpl_vars['val']['noindex']): ?>
		    <b style="color: #FF0000">noindex</b>
		   <?php endif; ?>
		   <?php if ($this->_tpl_vars['val']['nofollow']): ?>
		    <?php if ($this->_tpl_vars['val']['noindex']): ?>, <?php endif; ?>
		    <b style="color: #FF0000">nofollow</b>
		   <?php endif; ?>
		   </label>
		   <?php else: ?>
		    Нет ссылки
		   <?php endif; ?> 
		   </div>
		   <div style="margin-top: 4px">
		    <?php if ($this->_tpl_vars['val']['href_full']): ?><?php echo $this->_tpl_vars['val']['href_full']; ?>

			&nbsp;&nbsp; <label style="font-size: 95%; color: #808080">[ <?php echo $this->_tpl_vars['val']['href']; ?>
 ]</label><?php else: ?>?<?php endif; ?>
		   </div>		  
		   <?php echo '
		    <script type="text/javascript">
	         linksdata[\'sdm_href\'].push(\''; ?>
<?php echo $this->_tpl_vars['tool_object']->CorrectSymplyString($this->_tpl_vars['val']['href']); ?>
<?php echo '\');
            </script>
		   '; ?>

		  </td>
         </tr>
        </table>
		</span>	   
	   </div>
	  <?php endforeach; endif; unset($_from); ?>
	  <div style="margin-top: 15px"><b style="color: #808080">Ссылки списком:</b>
	   <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'blocksubdomtext')">Показать</a>]</label>
	  </div>
	  <div>&nbsp;</div>
	  <div id="blocksubdomtext" style="visibility: hidden; display: none">
	   <div style="margin-top: 4px">
	    <textarea class="int_text" style="height: 120px; width: 95%" name="subdomlist" id="subdomlist"></textarea>
	   </div>
	   <div style="margin-top: 4px">
	    <input type="button" value="&nbsp;Получить список ссылок&nbsp;" class="button" onclick="LoadLinksList('subdomlist', 'sdm_href', this)"> &nbsp;
		<input type="checkbox" checked="checked" style="cursor: pointer" name="subdomlistnorepeat" id="subdomlistnorepeat"><label for="subdomlistnorepeat" style="cursor: pointer">&nbsp;Без повторов</label>
		<div>&nbsp;</div>
	   </div>
	  </div>
	 </div>
     <?php endif; ?>
     
	</div>
   <?php else: ?>
    <div style="color: #FF0000">Нет данных</div>
   <?php endif; ?>   
  <?php endif; ?>
  </div>
 <?php endif; ?> 
 
 <?php endif; ?>
</div>