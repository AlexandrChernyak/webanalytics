<?php /* Smarty version 2.6.26, created on 2016-05-15 08:55:01
         compiled from items/links_vitrina_block.tpl */ ?>
<!-- vitrina links begin -->
<div class="apdates_title"><a href="<?php echo @W_SITEPATH; ?>
vitrinalinks/" class="upd_title">Витрина ссылок</a>
<span style="margin-left: 10px">[<a href="<?php echo @W_SITEPATH; ?>
vitrinalinks/new=1" class="restpsw" style="margin: 0px 2px 0 2px">Добавить</a>]</span></div> 
<div class="vitrinaclass">
 <?php if ($this->_tpl_vars['CONTROL_OBJ']->GetVitrinaLinksList()): ?>
  <?php $_from = $this->_tpl_vars['CONTROL_OBJ']->GetVitrinaLinksList(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
   <?php if (! $this->_tpl_vars['val']['isindexed']): ?><noindex><?php endif; ?><?php if ($this->_tpl_vars['val']['isbolded']): ?><b><?php endif; ?><a href="<?php echo $this->_tpl_vars['CONTROL_OBJ']->CorrectURLByShemeItem($this->_tpl_vars['val']['lurl']); ?>
"<?php if (! $this->_tpl_vars['val']['isindexed']): ?> rel="nofollow"<?php endif; ?> target="_blank" style="background: transparent url(http://favicon.yandex.net/favicon/<?php echo $this->_tpl_vars['val']['lhost']; ?>
) no-repeat left top"><?php echo $this->_tpl_vars['val']['ltext']; ?>
</a><?php if ($this->_tpl_vars['val']['isbolded']): ?></b><?php endif; ?><?php if (! $this->_tpl_vars['val']['isindexed']): ?></noindex><?php endif; ?>  
  <?php endforeach; endif; unset($_from); ?>
 <?php endif; ?> 	
</div>  
<!-- vitrina links begin -->