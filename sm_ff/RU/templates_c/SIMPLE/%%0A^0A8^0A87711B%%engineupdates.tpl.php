<?php /* Smarty version 2.6.26, created on 2013-11-14 13:45:48
         compiled from engineupdates.tpl */ ?>
<div style="margin-top: 4px">
 <?php echo '
 <style type="text/css">
  .h_th1, .h_td, .h_td2 { 
   border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; border-right: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E3E4E8; border-left: none; }
  .btn_n { border: 1px solid #E3E4E8; border-top: none; height: 25px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E3E4E8; height: 25px; border-top: none; }	
 </style> 
 <script type="text/javascript">
 function DoHigl(th, n) {	
  if (n) { $(th).css(\'background\',\'#F9FAFB\'); } else {   	
   $(th).css(\'background\', \'none\');		
  }	
 }//DoHigl	
 </script>
 '; ?>

 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <td class="h_th1" valign="center" align="center"><label id="red">Я</label>ндекс ТиЦ</td>
	<td class="h_td" valign="center" align="center"><label id="red">Я</label>ндекс.Поиск</td>	
	<td class="h_td" valign="center" align="center"><label id="red">Я</label>ндекс.Каталог</td>	
	<td class="h_td2" valign="center" align="center"><label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #BFBF00">o</label><label style="color: #3886AF">gl</label><label id="red">e</label> PageRang</td>
   </tr>	
   <?php if ($this->_tpl_vars['global_data_list_info']['maxcount']): ?>     
    <?php unset($this->_sections['curindex']);
$this->_sections['curindex']['name'] = 'curindex';
$this->_sections['curindex']['loop'] = is_array($_loop=$this->_tpl_vars['global_data_list_info']['data']['1']['data']['source']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['curindex']['show'] = true;
$this->_sections['curindex']['max'] = $this->_sections['curindex']['loop'];
$this->_sections['curindex']['step'] = 1;
$this->_sections['curindex']['start'] = $this->_sections['curindex']['step'] > 0 ? 0 : $this->_sections['curindex']['loop']-1;
if ($this->_sections['curindex']['show']) {
    $this->_sections['curindex']['total'] = $this->_sections['curindex']['loop'];
    if ($this->_sections['curindex']['total'] == 0)
        $this->_sections['curindex']['show'] = false;
} else
    $this->_sections['curindex']['total'] = 0;
if ($this->_sections['curindex']['show']):

            for ($this->_sections['curindex']['index'] = $this->_sections['curindex']['start'], $this->_sections['curindex']['iteration'] = 1;
                 $this->_sections['curindex']['iteration'] <= $this->_sections['curindex']['total'];
                 $this->_sections['curindex']['index'] += $this->_sections['curindex']['step'], $this->_sections['curindex']['iteration']++):
$this->_sections['curindex']['rownum'] = $this->_sections['curindex']['iteration'];
$this->_sections['curindex']['index_prev'] = $this->_sections['curindex']['index'] - $this->_sections['curindex']['step'];
$this->_sections['curindex']['index_next'] = $this->_sections['curindex']['index'] + $this->_sections['curindex']['step'];
$this->_sections['curindex']['first']      = ($this->_sections['curindex']['iteration'] == 1);
$this->_sections['curindex']['last']       = ($this->_sections['curindex']['iteration'] == $this->_sections['curindex']['total']);
?> 
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	 
     <td class="sth1" valign="center" align="center" style="border-left: 1px solid #E3E4E8">
	  <?php if (! $this->_tpl_vars['global_data_list_info']['data']['1']['data']['source'][$this->_sections['curindex']['index']]['dateupd']): ?>-<?php else: ?>	  
	   <?php echo $this->_tpl_vars['CONTROL_OBJ']->DateToSpecialFormat($this->_tpl_vars['global_data_list_info']['data']['1']['data']['source'][$this->_sections['curindex']['index']]['dateupd'],@W_ADMENGINEUPDATESFORMATVIEW); ?>

	  <?php endif; ?>	    
	 </td>
	 
	 <td class="sth1" valign="center" align="center">
	  <?php if (! $this->_tpl_vars['global_data_list_info']['data']['2']['data']['source'][$this->_sections['curindex']['index']]['dateupd']): ?>-<?php else: ?>	  
	   <?php echo $this->_tpl_vars['CONTROL_OBJ']->DateToSpecialFormat($this->_tpl_vars['global_data_list_info']['data']['2']['data']['source'][$this->_sections['curindex']['index']]['dateupd'],@W_ADMENGINEUPDATESFORMATVIEW); ?>

	  <?php endif; ?>	  
	 </td>
	 
	 <td class="sth1" valign="center" align="center">
	  <?php if (! $this->_tpl_vars['global_data_list_info']['data']['3']['data']['source'][$this->_sections['curindex']['index']]['dateupd']): ?>-<?php else: ?>	  
	   <?php echo $this->_tpl_vars['CONTROL_OBJ']->DateToSpecialFormat($this->_tpl_vars['global_data_list_info']['data']['3']['data']['source'][$this->_sections['curindex']['index']]['dateupd'],@W_ADMENGINEUPDATESFORMATVIEW); ?>

	  <?php endif; ?>	  
	 </td>

	 <td class="sth1" valign="center" align="center" style="border-right: 1px solid #E3E4E8;">
	  <?php if (! $this->_tpl_vars['global_data_list_info']['data']['4']['data']['source'][$this->_sections['curindex']['index']]['dateupd']): ?>-<?php else: ?>	  
	   <?php echo $this->_tpl_vars['CONTROL_OBJ']->DateToSpecialFormat($this->_tpl_vars['global_data_list_info']['data']['4']['data']['source'][$this->_sections['curindex']['index']]['dateupd'],@W_ADMENGINEUPDATESFORMATVIEW); ?>

	  <?php endif; ?>
	 </td>
    </tr>	
	<?php endfor; endif; ?>	
   <?php else: ?>
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="4">
     Нет активных апдейтов!
    </td>
   </tr> 
   <?php endif; ?> 
 </table>
 <?php if ($this->_tpl_vars['global_data_list_info']['maxcount'] && $this->_tpl_vars['global_data_list_info']['pages']): ?>
 <div style="text-align: right; margin-top: 10px"><?php echo $this->_tpl_vars['global_data_list_info']['pages']; ?>
</div>
 <?php endif; ?>
 </span>
</div>