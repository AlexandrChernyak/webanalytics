<?php /* Smarty version 2.6.26, created on 2016-05-15 09:03:04
         compiled from tools/massurlspeedtest/tpl_massurlspeedtest_t_r_add_row.tpl */ ?>
	 
<tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
 <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E3E4E8">
  <label style="margin-left: 4px">
  <div style="margin: 4px">
   <div><a href="<?php echo $this->_tpl_vars['tool_object']->GetResultValue('link'); ?>
" target="_blank"><?php if ($this->_tpl_vars['tool_object']->strlen($this->_tpl_vars['tool_object']->GetResultValue('link')) > 50): ?><?php echo $this->_tpl_vars['tool_object']->substr($this->_tpl_vars['tool_object']->GetResultValue('link'),0,47); ?>
...<?php else: ?><?php echo $this->_tpl_vars['tool_object']->GetResultValue('link'); ?>
<?php endif; ?></a></div>  
  <?php if ($this->_tpl_vars['tool_object']->GetResultValue('result')): ?>
  <div style="margin-top: 4px">
  Код ответа: <?php echo $this->_tpl_vars['tool_object']->GetResultValue('httpcode'); ?>
, Размер: <?php echo $this->_tpl_vars['tool_object']->GetResultValue('size'); ?>
,  Время: <?php echo $this->_tpl_vars['tool_object']->GetResultValue('time'); ?>
 сек.  
  </div>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['tool_object']->GetResultValue('error')): ?>
  <div style="color: #FF0000; margin-top: 4px"><?php echo $this->_tpl_vars['tool_object']->GetResultValue('error'); ?>
</div>
  <?php endif; ?>
  </div>   
  </label>	    
 </td>
 <td class="sth1" valign="center" align="right" width="140px" style="border-right: 1px solid #E3E4E8;">
  <label style="margin-right: 4px">
   <?php if (! $this->_tpl_vars['tool_object']->GetResultValue('result')): ?>
    <b>?</b>
   <?php else: ?>
    <b><?php echo $this->_tpl_vars['tool_object']->GetResultValue('speed'); ?>
</b>
   <?php endif; ?>   	  
  </label>
 </td>
</tr>
<?php echo '
<script type="text/javascript">
 $(function() {	$("#tableresultsourceid").tablesorter(); });	
</script>
'; ?>