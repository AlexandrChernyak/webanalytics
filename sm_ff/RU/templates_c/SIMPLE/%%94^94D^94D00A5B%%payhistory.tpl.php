<?php /* Smarty version 2.6.26, created on 2016-05-15 09:08:07
         compiled from account/payhistory.tpl */ ?>
<div>
 <a style="color: #008000" href="<?php echo @W_SITEPATH; ?>
account/payhistory/&new=1">Пополнить баланс</a>&nbsp;|&nbsp;
 <a href="<?php echo @W_SITEPATH; ?>
account/payhistory/"<?php if (! $_GET['fromref'] && ! $_GET['new'] && ! $_GET['status']): ?> style="color: #000000"<?php endif; ?>>Все операции (<label style="color: #000000"><?php echo $this->_tpl_vars['transactions_count']['all']; ?>
</label>)</a>&nbsp;|&nbsp;
 <a href="<?php echo @W_SITEPATH; ?>
account/payhistory/&fromref=1"<?php if ($_GET['fromref']): ?> style="color: #000000"<?php endif; ?>>Реферальные зачисления (<label style="color: #000000"><?php echo $this->_tpl_vars['transactions_count']['ref']; ?>
</label>)</a>
</div>
<div style="margin-top: 18px">
<?php if ($_GET['new']): ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "account/payhistoryadd.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
<?php else: ?>
 <?php if ($_GET['status'] && $_GET['t'] && isset ( $this->_tpl_vars['status_list_text'] )): ?>
    <div>
  <div>Описание: <b><?php echo $this->_tpl_vars['status_list_text']['descr']; ?>
</b></div>
  <div style="margin-top: 12px;<?php if ($this->_tpl_vars['status_list_text']['isok']): ?> color: #008000<?php else: ?>color: #FF0000<?php endif; ?>">
   <b><?php echo $this->_tpl_vars['status_list_text']['status']; ?>
</b>
  </div>  
  </div>
 <?php else: ?>
     
  <?php echo '  
  <style type="text/css">
   .h_th1, .h_td, .h_td2 { 
    border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; 
    border-right: none; font-weight: bold; 
   }
   .h_td { border-left: none; }
   .h_td2 { border-right: 1px solid #E3E4E8; border-left: none; }
   .btn_n { border: 1px solid #E3E4E8; border-top: none; height: 25px; margin-top: 4px; }
   .sth1 { border-bottom: 1px solid #E3E4E8; height: 25px; border-top: none;}	
  </style>  
  <script type="text/javascript">
   function DoHigl(th, n) {	
    if (n) { $(th).css(\'background\',\'#F9FAFB\'); } else {   	
     $(th).css(\'background\', \'none\');		
    }	
   }//DoHigl	
  </script> 
  '; ?>
   
  <div style="margin-top: 12px">
  <span style="width: 100%">
   <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <td class="h_th1" valign="center" align="center" width="80px">Счет №</td>
    <td class="h_td" valign="center" align="center">Направление</td>
    <td class="h_td" valign="center" align="center">Сумма</td>
    <td class="h_td" valign="center" align="left">Описание</td>
    <td class="h_td2" valign="center" align="center">Дата</td>
   </tr>
   <?php if ($this->_tpl_vars['transactions_list'] && $this->_tpl_vars['transactions_list']['source']): ?>
   <?php $_from = $this->_tpl_vars['transactions_list']['source']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
     <td class="sth1" valign="center" align="center" width="80px" style="border-left: 1px solid #E3E4E8;">
	 <?php echo $this->_tpl_vars['val']['specidtran']; ?>

	 </td>
     <td class="sth1" valign="center" align="center" width="80px">
	 <?php if ($this->_tpl_vars['val']['opertype'] == 'add'): ?>
	 <img src="<?php echo @W_SITEPATH; ?>
img/items/line_double_arrow_end.png" width="19" height="19">
	 <?php else: ?>
	  <?php if ($this->_tpl_vars['val']['opertype'] == 'sub'): ?>
	   <img src="<?php echo @W_SITEPATH; ?>
img/items/line_double_arrow_begin.png" width="19" height="19">
	  <?php else: ?>
	   SET
	  <?php endif; ?>
	 <?php endif; ?> 
	 </td>
     <td class="sth1" valign="center" align="center" width="80px">
     <?php if ($this->_tpl_vars['val']['opertype'] == 'add'): ?>
      <label style="background: #DCE6DB"><?php echo $this->_tpl_vars['val']['sumdata']; ?>
 USD</label>
	 <?php else: ?>
	  <?php echo $this->_tpl_vars['val']['sumdata']; ?>
 USD
	 <?php endif; ?>
	 </td>
     <td class="sth1" valign="center" align="left">
	 <?php echo $this->_tpl_vars['val']['descript']; ?>

	 </td>
     <td class="sth1" valign="center" align="center" style="border-right: 1px solid #E3E4E8;" width="130px">
	 <?php echo $this->_tpl_vars['val']['datedata']; ?>

	 </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
    <?php else: ?>
    <tr>
     <td valign="center" align="center" class="btn_n" colspan="5">
      Нет операций!
     </td>
    </tr>
    <?php endif; ?>   
   </table>   
  <?php if ($this->_tpl_vars['transactions_list'] && $this->_tpl_vars['transactions_list']['source']): ?>
  <div style="text-align: right; margin-top: 10px"><?php echo $this->_tpl_vars['transactions_list']['pagestext']; ?>
</div>
  <?php endif; ?>
  </span>
  </div>    
  <?php endif; ?>
<?php endif; ?>
</div>