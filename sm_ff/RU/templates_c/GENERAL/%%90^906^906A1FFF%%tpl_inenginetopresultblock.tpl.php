<?php /* Smarty version 2.6.26, created on 2013-11-12 17:56:09
         compiled from tools/contentcheck/tpl_inenginetopresultblock.tpl */ ?>

 <?php if ($this->_tpl_vars['tool_object']->GetToolLimitInfoEx('usemegaindextop') && $this->_tpl_vars['tool_object']->GetToolLimitInfoEx('megaindexlogin')): ?> 
 
 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%"><b>В результатах выдачи поисковиков</b><label style="color: #000000; margin-left: 6px">[
 <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'inenginestopbykeywords<?php echo $this->_tpl_vars['block_ident']; ?>
')">Скрыть</a> ]</label>
 </div>
 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="inenginestopbykeywords<?php echo $this->_tpl_vars['block_ident']; ?>
">

 <!-- words info as list -->
 <div style="margin-top: 14px">
  <b style="color: #969696">В топе по ключевым словам<?php if ($this->_tpl_vars['tool_object']->GetResult('intop_engine_cached_day')): ?><label style="margin-left: 8px; color: #000000; font-size: 95%">[последнее обновление: <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['tool_object']->GetResult('intop_engine_cached_day')); ?>
 &nbsp; (<?php echo $this->_tpl_vars['tool_object']->GetResult('intop_engine_cached_day'); ?>
)]</label><?php endif; ?></b>
 </div>
 <div style="margin-top: 10px">
  <span style="width: 100%">
   <?php if ($this->_tpl_vars['tool_object']->GetResult('intop_engine_error')): ?>
    <div style="margin: 4px 2px 0px 5px; color: #FF0000"><?php echo $this->_tpl_vars['tool_object']->GetResult('intop_engine_error'); ?>
</div>
   <?php elseif (! $this->_tpl_vars['tool_object']->GetResult('intop_engine.result')): ?>
    <div style="margin: 4px 2px 0px 5px; color: #FF0000">Неизвестно!</div>
   <?php else: ?>
      
    <div style="margin-top: 4px; margin-bottom: 4px; border: 1px dashed #808080; padding: 4px; font-size: 95%">
     <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
       <tr>
	    <td valign="top" align="left" width="24px">
	     <img src="<?php echo @W_SITEPATH; ?>
img/items/information2.png">
	    </td>
	    <td valign="top" align="left">
	     <div><b>Слово</b> - ключевое слово (запрос)</div>
         <div><b>Яндекс</b> - позиция в поисковике Яндекс</div>
         <div><b>Google</b> - позиция в поисковике Google</div>
         <div><b>Показов в месяц</b> - общее кол-во показов за месяц</div>
         <div><b>Видимость</b> - видимость сайта (в %) по данному запросу в поисковых системах</div>
	    </td>
       </tr>
      </table>
	 </span>
    </div>
   
   <table width="100%" cellpadding="0" cellspacing="0" border="0" id="<?php echo $this->_tpl_vars['block_ident']; ?>
tableq">
    <thead>	
     <tr>
 
      <th class="h_th1" valign="center" align="left">
       <label style="margin-left: 4px;">Слово</label><label class="bgshortq">&nbsp;</label>
      </th>
      
      <th class="h_td" valign="center" align="center" width="125px">
       <label style="margin-left: 4px;">
	   Яндекс
	   </label><label class="bgshortq">&nbsp;</label>
      </th>
      
      <th class="h_td" valign="center" align="center" width="150px">
       <label style="margin-left: 4px;">
	   Google
	   </label><label class="bgshortq">&nbsp;</label>
      </th>
      
      <th class="h_td" valign="center" align="center" width="110px">
       <label style="margin-left: 4px;">
	   Показов в месяц
	   </label><label class="bgshortq">&nbsp;</label>
      </th>
  	  
      <th class="h_td2" valign="center" align="center" width="120px">
       <label style="margin-left: 4px;">Видимость</label><label class="bgshortq">&nbsp;</label>
      </th>
      
     </tr>   	
    </thead>
    
    <?php $_from = $this->_tpl_vars['tool_object']->GetResult('intop_engine.result'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
     <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
      
      <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E4D9CB; padding-left: 4px">
  	   <?php echo $this->_tpl_vars['val']['word']; ?>
  
      </td>
      
      <td class="sth1" valign="center" align="center" width="125px" style="padding-left: 4px">
       <noindex><a rel="nofollow" href="<?php echo $this->_tpl_vars['tool_object']->LinkToEngineItem('YANDEX_SEARCH_RESULT',$this->_tpl_vars['val']['word']); ?>
" target="_blank"><?php echo $this->_tpl_vars['val']['pos_y']; ?>
</a></noindex>
      </td>
      
      <td class="sth1" valign="center" align="center" width="100px" style="padding-left: 4px">
       <noindex><a rel="nofollow" href="<?php echo $this->_tpl_vars['tool_object']->LinkToEngineItem('GOOGLE_SEARCH_RESULT',$this->_tpl_vars['val']['word']); ?>
&hl=ru" target="_blank"><?php echo $this->_tpl_vars['val']['pos_g']; ?>
</a></noindex>
      </td>
      
      <td class="sth1" valign="center" align="center" width="150px" style="padding-left: 4px">
       <?php echo $this->_tpl_vars['val']['show_month']; ?>

      </td>
         
      <td class="sth1" valign="center" align="center" width="120px" style="border-right: 1px solid #E4D9CB; padding-left: 4px">
       <?php echo $this->_tpl_vars['val']['vis']; ?>

      </td>
     
     </tr>     
    <?php endforeach; endif; unset($_from); ?>   
   </table>
   
   <div id="<?php echo $this->_tpl_vars['block_ident']; ?>
pager" class="pager" style="height: auto">
	<form>
	 <div style="height: 25px; margin-top: 6px">
		<img src="<?php echo @W_SITEPATH; ?>
img/items/tables_pages/first.png" class="first">
		<img src="<?php echo @W_SITEPATH; ?>
img/items/tables_pages/prev.png" class="prev">
		<input type="text" class="pagedisplay" readonly="readonly" style="position: relative; top: -3px">
		<img src="<?php echo @W_SITEPATH; ?>
img/items/tables_pages/next.png" class="next">
		<img src="<?php echo @W_SITEPATH; ?>
img/items/tables_pages/last.png" class="last">
		<select class="pagesize" style="position: relative; top: -2px">
			<option selected="selected" value="20">20</option>			
			<option value="40">40</option>
			<option value="50">50</option>
			<option value="80">80</option>
			<option value="100">100</option>
			<option value="150">150</option>
		</select>
	 </div>	
	</form>   
   </div>
   
   <div style="margin-top: 6px">
    <noindex><a href="http://seo-tools.forwebm.net/goto/4" target="_blank" class="gotoregurl">Автоматическое продвижение запросов на megaindex.ru</a></noindex>
   </div>
   
   <?php echo '
   <script type="text/javascript">
    $(document).ready(function() { 
     $("#'; ?>
<?php echo $this->_tpl_vars['block_ident']; ?>
<?php echo 'tableq") 
      .tablesorter() 
      .tablesorterPager({container: $("#'; ?>
<?php echo $this->_tpl_vars['block_ident']; ?>
<?php echo 'pager"), size: 20, positionFixed: false}); 
    });	
   </script>
   '; ?>

   
   <?php endif; ?>   
  </span>
 </div>
 </div>
 <?php endif; ?>