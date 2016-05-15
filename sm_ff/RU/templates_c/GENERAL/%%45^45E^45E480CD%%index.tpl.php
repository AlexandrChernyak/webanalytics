<?php /* Smarty version 2.6.26, created on 2013-11-14 13:02:50
         compiled from index.tpl */ ?>
<!-- analisys begin -->
  <div>
  <?php echo '
  <script type="text/javascript">
   function PrepereActionQuickAnalisys(th) {
	if (!th.url.value || th.url.value == \'http://\') {
	 alert(\'Укажите сайт для анализа!\');
	 th.url.focus();
	 return false;	
	}	
	return true;
   }	
  </script>
  '; ?>

  <form method="post" name="qanalisys" id="qanalisys" action="<?php echo @W_SITEPATH; ?>
tools/analysis/" onsubmit="return PrepereActionQuickAnalisys(this)">
  <div>
  <span style="width: 100%">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
	<td class="qanalisys_label" align="left" valign="center">
	 Анализ сайта
	</td>
	<td align="left" valign="center">
	 <input type="text" class="inpt" style="width: 100%" name="url" id="url" value="http://">
	</td>
	<td align="right" valign="center" width="90px">
	 <input type="submit" class="butt" value="Отправить" style="width: 80px"> 
	</td>
  </tr>
  </table>
  </span>
  </div>
  
  <div>
  <span style="width: 100%">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
	<td width="110px" height="20px"></td>
	<td valign="top" height="20px">
	<span class="prep_label_analisys">
	 Например: <a href="javascript:" onclick="$('#url').val('<?php echo @W_HOSTMYSITE; ?>
');"><?php echo @W_HOSTMYSITE; ?>
</a>
	</span>
	</td>
	<td width="90px" height="20px"></td>
  </tr>
  </table>
  </span>
  </div>
  <input type="hidden" value="do" name="doactiontool">
  </form>
  </div>
  <!-- analisys end -->
  
  <!-- vitrina begin, first block begin -->
  <div style="margin-top: 30px">
   <span style="width: 100%"> 
   <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
	<td valign="top" align="left">
	 
	 <!-- featured tools list BEGIN --> 
   <div class="apdates_title">
    <a href="<?php echo @W_SITEPATH; ?>
tools/" class="upd_title">Наиболее популярные инструменты</a>
   </div>
   <?php if (! $this->_tpl_vars['CONTROL_OBJ']->GetFeaturedToolsList()): ?>
    <div style="margin-left: 5px; margin-top: 5px">Нет активных инструментов</div>
   <?php else: ?>
    <div style="margin-left: 5px">
     <span style="width: 100%">
     <table width="100%" cellpadding="0" cellspacing="0" border="0">
     <?php $_from = $this->_tpl_vars['CONTROL_OBJ']->GetFeaturedToolsList(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
      <tr>
      
      <td valign="top" align="center" width="22px">
	   <div style="margin-top: 5px">
	    <img src="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetToolImageStyle($this->_tpl_vars['val']['tident'],16,'',''); ?>
" width="16" height="16">    
	   </div>
	  </td>
    
      <td valign="top" align="left" style="padding-left: 2px">
       <div style="margin-top: 5px">   
	    <a href="<?php echo @W_SITEPATH; ?>
tools/<?php echo $this->_tpl_vars['val']['tident']; ?>
/"><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText($this->_tpl_vars['val']['tdescript']); ?>
</a>	    
	   </div>	  
	  </td>
	  
	  </tr>    
     <?php endforeach; endif; unset($_from); ?>   
     </table>
     </span>
	</div>   
   <?php endif; ?>
   <!-- featured tools list END -->
   
	</td>
	<td valign="top" align="left" width="280px">
     <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "items/links_vitrina_block.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
	</td>
   </tr>
   </table>    
   </span>
  </div>  
  <!-- vitrina end, first block end -->
  
  <!-- last added datas begin -->
  <div style="margin-top: 26px">
   
   <!-- last news block begin -->
   <div class="apdates_title"><a href="<?php echo @W_SITEPATH; ?>
news/1/" class="upd_title">Новости сайта</a></div>
   <div style="margin-top: 4px">
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "items/last_news_block.tpl", 'smarty_include_vars' => array('newstype' => '1','limit' => '10','fontsize' => '100%','fontsizeallnews' => '95%','fulldate' => '1')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   </div>   
   <!-- last news block end -->
   
   
   
   
  </div>
  <!-- last added datas end -->