<?php /* Smarty version 2.6.26, created on 2016-05-15 08:55:08
         compiled from items/last_news_block.tpl */ ?>
<!-- news begin -->
<div>
 <?php if ($this->_tpl_vars['CONTROL_OBJ']->GetNewsListByBlockData($this->_tpl_vars['newstype'],$this->_tpl_vars['limit'])): ?>
  <?php $_from = $this->_tpl_vars['CONTROL_OBJ']->GetNewsListByBlockData($this->_tpl_vars['newstype'],$this->_tpl_vars['limit']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
   <div style="margin-left: 4px; margin-top: 4px">
    <span style="font-size: <?php echo $this->_tpl_vars['fontsize']; ?>
"><?php if (! $this->_tpl_vars['fulldate']): ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->DateToSpecialFormat($this->_tpl_vars['val']['datecreate']); ?>
<?php else: ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->DateTimeToSpecialFormat($this->_tpl_vars['val']['datecreate'],@W_SITENEWSDATETIMEFORMATONHOST); ?>
<?php endif; ?></span> 
	<a style="text-decoration: none; font-size: <?php echo $this->_tpl_vars['fontsize']; ?>
" href="<?php echo @W_SITEPATH; ?>
news/<?php echo $this->_tpl_vars['newstype']; ?>
/<?php echo $this->_tpl_vars['val']['iditem']; ?>
/"><?php echo $this->_tpl_vars['val']['newtitle']; ?>
</a>
   </div>     
  <?php endforeach; endif; unset($_from); ?>
  <div class="contentway" style="font-size: <?php if ($this->_tpl_vars['fontsizeallnews']): ?><?php echo $this->_tpl_vars['fontsizeallnews']; ?>
<?php else: ?><?php echo $this->_tpl_vars['fontsize']; ?>
<?php endif; ?>; margin-top: 5px; margin-left: 4px">
   <a style="color: #000000" href="<?php echo @W_SITEPATH; ?>
news/<?php echo $this->_tpl_vars['newstype']; ?>
/">Все новости</a><label>&nbsp;</label>
  </div>  
 <?php else: ?>
  <div style="margin-left: 4px">Нет новостей!</div> 
 <?php endif; ?> 	
</div>  
<!-- news end -->