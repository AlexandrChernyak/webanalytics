<?php /* Smarty version 2.6.26, created on 2016-05-15 08:54:26
         compiled from seo-panel/url_line_data.tpl */ ?>
<?php if ($this->_tpl_vars['PANEL_CONTROL']->GetResult('params')): ?>
 <tr id="urllistitem<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('urllineinfo.iditem'); ?>
" class="urlpitemtr" urlrealid="<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('urllineinfo.iditem'); ?>
" urlsectionid="<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('urllineinfo.sectionid'); ?>
" onmouseover="DoEventMOver(this)" onmouseout="DoEventMOut(this)">
 
 <td align="center" valign="center" class="urlblockidentmove"> </td>
 	
 <td align="center" valign="center" width="20px" style="border-left: none">	 
  <input type="checkbox" class="checkboxitem" id="checkpitem<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('urllineinfo.iditem'); ?>
" onclick="SetCheckedItem('<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('urllineinfo.iditem'); ?>
', this)" urlrealid="<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('urllineinfo.iditem'); ?>
">	 
 </td>
 
 <td align="center" valign="center" width="22px">
  <a href="javascript:" title="Просмотр скриншота" onclick="previewImageURL('<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('urllineinfo.iditem'); ?>
')"><img src="http://favicon.yandex.net/favicon/<?php echo $this->_tpl_vars['PANEL_CONTROL']->line_obj->GetURL(); ?>
" width="16" height="16" align='absmiddle' alt="?"></a>
 </td> 
 	
 <?php $_from = $this->_tpl_vars['PANEL_CONTROL']->GetResult('params'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
  <td align="<?php echo $this->_tpl_vars['val']['data']['align']; ?>
" valign="center" style="<?php if ($this->_tpl_vars['val']['sid'] == 'url'): ?>min-<?php endif; ?>width: <?php echo $this->_tpl_vars['val']['data']['width']; ?>
<?php if ($this->_tpl_vars['val']['data']['bgcolor']): ?>; background: <?php echo $this->_tpl_vars['val']['data']['bgcolor']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['val']['data']['color']): ?>; color: <?php echo $this->_tpl_vars['val']['data']['color']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['val']['data']['canwrap']): ?>; white-space: normal<?php endif; ?>" id="tdurlitem<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('urllineinfo.iditem'); ?>
" urlrealid="<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('urllineinfo.iditem'); ?>
" paramrealid="<?php echo $this->_tpl_vars['val']['id']; ?>
" isurlident="<?php if ($this->_tpl_vars['val']['sid'] == 'url'): ?>1<?php else: ?>0<?php endif; ?>" bgcolorsave="<?php echo $this->_tpl_vars['val']['data']['bgcolor']; ?>
"<?php if ($this->_tpl_vars['val']['data']['bgcolor']): ?> isbgexists="1"<?php endif; ?> <?php if ($this->_tpl_vars['val']['data']['type'] != 3): ?> onclick="SetCheckedItem('<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('urllineinfo.iditem'); ?>
', false)"<?php endif; ?>>
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "seo-panel/url_param_data.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>		  
  </td>	  
 <?php endforeach; endif; unset($_from); ?>
 
 </tr> 
<?php endif; ?>