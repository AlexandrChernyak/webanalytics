<?php /* Smarty version 2.6.26, created on 2016-05-15 09:05:24
         compiled from items/attachments-default-block.tpl */ ?>
 <?php $this->assign('attfileslist2', $this->_tpl_vars['CONTROL_OBJ']->GetAttachmentsObjectList($this->_tpl_vars['filesid'],$this->_tpl_vars['objectid'])); ?>
 
 <?php if ($this->_tpl_vars['attfileslist2']): ?>
 <div style="margin-top: 25px; border: 1px solid #B1B1B1; padding: 3px; padding-bottom: 6px;">
  
  <div>
   <label style="position: relative; top: -12px; background: white; padding-left: 3px; padding-right: 3px">Вложения</label>
  </div>
  
  <div style="padding-left: 5px;">
  
  <?php $_from = $this->_tpl_vars['attfileslist2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['nm'] => $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
   
   <?php if ($this->_tpl_vars['nm'] && $this->_tpl_vars['nm'] != '-'): ?>
   <div style="border-top: 1px solid #D7DBDB; padding: 3px; position: relative; margin-top: 8px">
    <label style="position: relative; top: -12px; background: white; padding-left: 3px; padding-right: 3px"><?php echo $this->_tpl_vars['nm']; ?>
</label>
   </div>
   <?php endif; ?>
   
   <?php $_from = $this->_tpl_vars['val']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val2']):
        $this->_foreach['val2']['iteration']++;
?>
   <div style="position: relative; top: -6px; padding: 2px; padding-left: 4px;">
   
   <span style="width: 100%;">
   <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
     <td valign="top" align="left" width="20px">
      <img src="<?php echo @W_SITEPATH; ?>
img/ico/general/attach.png" border="0" alt="attach" width="16" height="16" />
     </td>
	 <td valign="top" align="left">
     
     <label style="padding-left: 2px">
   <a title="Перейти на страницу скачивания файла" href="<?php echo @W_SITEPATH; ?>
download/<?php echo $this->_tpl_vars['filesid']; ?>
/<?php echo $this->_tpl_vars['objectid']; ?>
/<?php echo $this->_tpl_vars['val2']['iditem']; ?>
"><?php echo $this->_tpl_vars['val2']['fname']; ?>
</a><label style="margin-left: 3px; font-size: 95%">(<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetStrSizeFromBytes($this->_tpl_vars['val2']['fsize']); ?>
<?php if ($this->_tpl_vars['val2']['shcountw']): ?>, загрузок: <?php echo $this->_tpl_vars['val2']['dwcount']; ?>
<?php endif; ?>)</label>
   </label>
   <?php if ($this->_tpl_vars['val2']['filetip']): ?>
   <label style="padding-left: 2px"><?php echo $this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextFromDB($this->_tpl_vars['val2']['filetip']); ?>
</label>
   <?php endif; ?>
     
     </td>
    </tr>
   </table>
   </span>
   
   </div>
   <?php endforeach; endif; unset($_from); ?>

  
  <?php endforeach; endif; unset($_from); ?>
  
  </div>
   
 </div>
 <?php endif; ?>