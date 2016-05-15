<?php /* Smarty version 2.6.26, created on 2016-05-15 08:51:47
         compiled from items/updates_block.tpl */ ?>
<!-- updates block begin -->
 <?php if ($_POST['doactiontool'] == 'do' && ! $this->_tpl_vars['ismain_page']): ?>
 <?php echo '
 <style type="text/css">
  #fone_l { background: #F9F9F9; }	
 </style>
 '; ?>

 <?php endif; ?>
 
 <div style="width: <?php if (! $this->_tpl_vars['widthdiv']): ?>150px<?php else: ?><?php echo $this->_tpl_vars['widthdiv']; ?>
<?php endif; ?>"><span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 95%">
 
 <tr>
  <td valign="top" align="left" class="upd_td_v" style="padding-right: 3px">
   <label id="fone_l"><b><label style="color: #333399">G</label><label id="red">o</label><label style="color: #FFFF00">o</label><label style="color: #333399">gl</label><label id="red">e</label></b> pr</span>   
  </td>
  <td align="right" valign="top" width="30px">
   <label id="fone_l" style="border-bottom: 1px dashed #000000" title="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['engine_updates_list']['4']['value_original']); ?>
"><?php if (! isset ( $this->_tpl_vars['engine_updates_list'] ) || ! $this->_tpl_vars['engine_updates_list']['4'] || ! $this->_tpl_vars['engine_updates_list']['4']['value']): ?>?<?php else: ?><?php if ($this->_tpl_vars['engine_updates_list']['4']['bold']): ?><b><?php echo $this->_tpl_vars['engine_updates_list']['4']['value']; ?>
</b><?php else: ?><?php echo $this->_tpl_vars['engine_updates_list']['4']['value']; ?>
<?php endif; ?><?php endif; ?></label>  
  </td>
 </tr>
 
 <tr>
  <td valign="top" align="left">
   &nbsp;   
  </td>
  <td align="right" valign="top" width="30px">
   &nbsp;  
  </td>
 </tr>
  
 <tr>
  <td valign="top" align="left" class="upd_td_v" style="padding-right: 3px">
   <label id="fone_l"><b><label id="red">Y</label>andex</b> CY</span>   
  </td>
  <td align="right" valign="top" width="30px">
   <label id="fone_l" style="border-bottom: 1px dashed #000000" title="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['engine_updates_list']['1']['value_original']); ?>
"><?php if (! isset ( $this->_tpl_vars['engine_updates_list'] ) || ! $this->_tpl_vars['engine_updates_list']['1'] || ! $this->_tpl_vars['engine_updates_list']['1']['value']): ?>?<?php else: ?><?php if ($this->_tpl_vars['engine_updates_list']['1']['bold']): ?><b><?php echo $this->_tpl_vars['engine_updates_list']['1']['value']; ?>
</b><?php else: ?><?php echo $this->_tpl_vars['engine_updates_list']['1']['value']; ?>
<?php endif; ?><?php endif; ?></label>  
  </td>
 </tr>
 
 <tr>
  <td valign="top" align="left" class="upd_td_v" style="padding-right: 3px; padding-top: 4px">
   <label id="fone_l" style="padding-left: 10px">search</span>   
  </td>
  <td align="right" valign="top" width="30px" style="padding-top: 4px">
   <label id="fone_l" style="border-bottom: 1px dashed #000000" title="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['engine_updates_list']['2']['value_original']); ?>
"><?php if (! isset ( $this->_tpl_vars['engine_updates_list'] ) || ! $this->_tpl_vars['engine_updates_list']['2'] || ! $this->_tpl_vars['engine_updates_list']['2']['value']): ?>?<?php else: ?><?php if ($this->_tpl_vars['engine_updates_list']['2']['bold']): ?><b><?php echo $this->_tpl_vars['engine_updates_list']['2']['value']; ?>
</b><?php else: ?><?php echo $this->_tpl_vars['engine_updates_list']['2']['value']; ?>
<?php endif; ?><?php endif; ?></label>  
  </td>
 </tr>
 
 <tr>
  <td valign="top" align="left" class="upd_td_v" style="padding-right: 3px; padding-top: 4px">
   <label id="fone_l" style="padding-left: 10px">catalog</span>   
  </td>
  <td align="right" valign="top" width="30px" style="padding-top: 4px">
   <label id="fone_l" style="border-bottom: 1px dashed #000000" title="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['engine_updates_list']['3']['value_original']); ?>
"><?php if (! isset ( $this->_tpl_vars['engine_updates_list'] ) || ! $this->_tpl_vars['engine_updates_list']['3'] || ! $this->_tpl_vars['engine_updates_list']['3']['value']): ?>?<?php else: ?><?php if ($this->_tpl_vars['engine_updates_list']['3']['bold']): ?><b><?php echo $this->_tpl_vars['engine_updates_list']['3']['value']; ?>
</b><?php else: ?><?php echo $this->_tpl_vars['engine_updates_list']['3']['value']; ?>
<?php endif; ?><?php endif; ?></label>  
  </td>
 </tr> 
 
 </table>
 
 </span></div>  
<!-- updates block end -->