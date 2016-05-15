<?php /* Smarty version 2.6.26, created on 2016-05-15 08:44:40
         compiled from tools/contentcheck/tpl_taganalisysresultblock.tpl */ ?>
 <?php if (! $this->_tpl_vars['iscontent_info']): ?>
 <div><b style="color: #969696">Оригинальный текст</b></div>
 <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
  <?php echo $this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'text'); ?>

 </div>
 
 <div style="margin-top: 10px"><b style="color: #969696">Обработанный текст (без стоп-слов)</b></div>
 <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
  <?php echo $this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'textnostopwords'); ?>

 </div>
 <?php endif; ?>
 
 <!-- info about tag -->
 <div style="margin-top: 14px"><b style="color: #969696">Общая информация</b></div>
 <div style="margin-top: 10px">
  <span style="width: 100%">
   <table width="100%" cellpadding="0" cellspacing="0" border="0">
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Всего слов в тексте:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  <?php echo $this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'allwordscount'); ?>

	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Слов в тексте (без стоп-слов):	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  <?php echo $this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'wordscount'); ?>

	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Слов без повторов и стоп-слов:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  <?php echo $this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'wordsnorepeatnostopwords'); ?>

	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Стоп-слов в тексте:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  <?php echo $this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'stopwordscount'); ?>

	 </td>
    </tr>
    
    <?php if ($this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'stopwordscount')): ?>
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Список стоп-слов:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	  <div>
	   <label style="color: #000000">[
	    <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, '<?php echo $this->_tpl_vars['block_ident']; ?>
stwords')">Показать</a>]
	   </label>
	  </div>
	  <div style="display: none; visibility: hidden; padding-top: 6px" id="<?php echo $this->_tpl_vars['block_ident']; ?>
stwords">
	   <?php echo $this->_tpl_vars['tool_object']->GetWordListByArray($this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'stopwordslist')); ?>

	  </div>	  
	 </td>
    </tr>
    <?php endif; ?>
    
    <?php if (! $this->_tpl_vars['iscontent_info']): ?>
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Плотность всех слов к контенту:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  <?php echo $this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'fullplotnost'); ?>

	 </td>
    </tr>
        
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Релевантность текста к контенту:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  <?php echo $this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'relevanttocontent'); ?>
 %
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Вхождений слов тэга в контенте:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  <?php echo $this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'fullrepeatincontent'); ?>
 из <?php echo $this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'wordscount'); ?>

	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Слов с повтором в тэге &gt; 1 раза:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  <?php echo $this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'wordscountinrepeatin'); ?>

	 </td>
    </tr>
    <?php endif; ?>
    
   </table>
  </span>
 </div>
 
 <!-- words info as list -->
 <div style="margin-top: 14px">
  <b style="color: #969696">Результат анализа слов <?php if (! $this->_tpl_vars['iscontent_info']): ?>тэга<?php else: ?>контента<?php endif; ?></b>
 </div>
 <div style="margin-top: 10px">
  <span style="width: 100%">
   <?php if (! $this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'wordslist')): ?>
   <div style="margin: 4px 2px 0px 5px; color: #FF0000">В <?php if (! $this->_tpl_vars['iscontent_info']): ?>тэге<?php else: ?>контенте<?php endif; ?> слова не обнаружены!</div>
   <?php else: ?>
   
   <?php if (! $this->_tpl_vars['iscontent_info']): ?>
    <div style="margin-top: 4px; margin-bottom: 4px; border: 1px dashed #808080; padding: 4px; font-size: 95%">
     <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
       <tr>
	    <td valign="top" align="left" width="24px">
	     <img src="<?php echo @W_SITEPATH; ?>
img/items/information2.png">
	    </td>
	    <td valign="top" align="left">
	     <div><b>Слово</b> - анализируемое слово</div>
         <div><b>Кол-во в тэге</b> - кол-во повторов текущего слова в анализируемом тэге</div>
         <div><b>Плотность</b> - плотность текущего слова относительно контента страницы</div>
         <div><b>Вхождений</b> - кол-во вхождений текущего слова в контенте страницы</div>
         <div><b>Частота (TF)</b> - Частота TF(Term Frequency) относительно контента страницы</div>
	    </td>
       </tr>
      </table>
	 </span>
    </div>
   <?php endif; ?>
   
   <table width="100%" cellpadding="0" cellspacing="0" border="0" id="<?php echo $this->_tpl_vars['block_ident']; ?>
tableq">
    <thead>	
     <tr>
 
      <th class="h_th1" valign="center" align="left">
       <label style="margin-left: 4px;">Слово</label><label class="bgshortq">&nbsp;</label>
      </th>
      
      <th class="h_td" valign="center" align="left" width="125px">
       <label style="margin-left: 4px;">
	   <?php if (! $this->_tpl_vars['iscontent_info']): ?>Кол-во в тэге<?php else: ?>Вхождений<?php endif; ?>
	   </label><label class="bgshortq">&nbsp;</label>
      </th>
      
      <th class="h_td" valign="center" align="left" width="100px">
       <label style="margin-left: 4px;">
	   <?php if (! $this->_tpl_vars['iscontent_info']): ?>Плотность<?php else: ?>В title<?php endif; ?>
	   </label><label class="bgshortq">&nbsp;</label>
      </th>
      
      <th class="h_td" valign="center" align="left" width="110px">
       <label style="margin-left: 4px;">
	   <?php if (! $this->_tpl_vars['iscontent_info']): ?>Вхождений<?php else: ?>В Keywords<?php endif; ?>
	   </label><label class="bgshortq">&nbsp;</label>
      </th>
  	  
      <th class="h_td2" valign="center" align="left" width="120px">
       <label style="margin-left: 4px;">Частота (TF)</label><label class="bgshortq">&nbsp;</label>
      </th>
      
     </tr>   	
    </thead>
    
    <?php $_from = $this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'wordslist'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
     <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
      
      <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E3E4E8; padding-left: 4px">
  	   <?php echo $this->_tpl_vars['val']['word']; ?>
  
      </td>
      
      <td class="sth1" valign="center" align="left" width="125px" style="padding-left: 4px">
       <?php echo $this->_tpl_vars['val']['inputs']; ?>

      </td>
      
      <td class="sth1" valign="center" align="left" width="100px" style="padding-left: 4px">
       <?php if (! $this->_tpl_vars['iscontent_info']): ?><?php echo $this->_tpl_vars['val']['plotnost']; ?>
<?php else: ?><?php if ($this->_tpl_vars['val']['intitle']): ?><label style="color: #0000FF">Да</label><?php else: ?>Нет<?php endif; ?><?php endif; ?>
      </td>
      
      <td class="sth1" valign="center" align="left" width="110px" style="padding-left: 4px">
       <?php if (! $this->_tpl_vars['iscontent_info']): ?><?php echo $this->_tpl_vars['val']['inputs_in_content']; ?>
<?php else: ?><?php if ($this->_tpl_vars['val']['inkeywords']): ?><label style="color: #0000FF">Да</label><?php else: ?>Нет<?php endif; ?><?php endif; ?>
      </td>
         
      <td class="sth1" valign="center" align="left" width="120px" style="border-right: 1px solid #E3E4E8; padding-left: 4px">
       <?php echo $this->_tpl_vars['val']['tfherz']; ?>

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

   
   <?php if ($this->_tpl_vars['iscontent_info']): ?>
   <!-- content data -->
   <div style="margin-top: 14px">
    <b style="color: #969696">Исходный контент страницы</b>, слов (<b><?php echo $this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'allwordscount'); ?>
</b>)
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 100%"><?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.text'); ?>
</textarea>    
   </div>
   
   <div style="margin-top: 14px">
    <b style="color: #969696">Контент страницы без стоп-слов</b>, слов (<b><?php echo $this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'wordscount'); ?>
</b>), без повторов (<b><?php echo $this->_tpl_vars['tool_object']->GetResult($this->_tpl_vars['block_ident'],'wordsnorepeatnostopwords'); ?>
</b>)
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 100%"><?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.textnostopwords'); ?>
</textarea>    
   </div>
   
   <div style="margin-top: 14px">
    <b style="color: #969696">HTML код страницы</b>, символов всего (<b><?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.charscount'); ?>
</b>)
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 100%"><?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.htmldata'); ?>
</textarea>    
   </div>
   
   <div style="margin-top: 14px">
    <b style="color: #969696">Ответ сервера</b>
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 100%"><?php echo $this->_tpl_vars['tool_object']->GetResult('pageinfo.headresponse'); ?>
</textarea>
   </div>
   <?php endif; ?>
   
   <?php endif; ?>   
  </span>
 </div>
 