<?php /* Smarty version 2.6.26, created on 2016-05-15 08:54:16
         compiled from seo-panel/list_params_data.tpl */ ?>
   <tr id="urllisthead">
    
    <th align="center" valign="center" width="10px" id="thimagetableall" style="border: none">	
	 <img src="<?php echo @W_SITEPATH; ?>
css/panel/img/urlmoveobj.png" width="8" height="16" align='absmiddle' title="Переместить сайт">	
	</th>
   
    <th align="center" valign="center" width="20px" style="border-left: none" id="thcheckboxall">
	 <input type="checkbox" class="checkboxitem" id="challitemslist" onclick="SetAllChecked(this)">
	</th>    
    <th align="center" valign="center" width="22px" id="thimagetableall">	
	 <img src="<?php echo @W_SITEPATH; ?>
css/panel/img/pictures_2.png" width="16" height="16" align='absmiddle' title="Иконка сайта">	
	</th>
		
		
	<?php if ($this->_tpl_vars['PANEL_CONTROL']->GetResult('params')): ?>	
	 <?php $_from = $this->_tpl_vars['PANEL_CONTROL']->GetResult('params'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
	  <th align="<?php echo $this->_tpl_vars['val']['data']['align']; ?>
" valign="center" style="<?php if ($this->_tpl_vars['val']['sid'] == 'url'): ?>min-<?php endif; ?>width: <?php echo $this->_tpl_vars['val']['data']['width']; ?>
" id="paramitem<?php echo $this->_tpl_vars['val']['id']; ?>
" paramrealid="<?php echo $this->_tpl_vars['val']['id']; ?>
" itemsbgcolor="<?php echo $this->_tpl_vars['val']['data']['bgcolor']; ?>
" itemsparamtype="<?php echo $this->_tpl_vars['val']['data']['type']; ?>
" itemslistcolor="<?php if ($this->_tpl_vars['val']['data']['color']): ?><?php echo $this->_tpl_vars['val']['data']['color']; ?>
<?php endif; ?>" isdinamicparam="1" relparamtype="<?php echo $this->_tpl_vars['val']['sid']; ?>
">
	   <?php echo $this->_tpl_vars['val']['data']['name']; ?>
	  
	  </th>	  
	 <?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>	
   </tr>