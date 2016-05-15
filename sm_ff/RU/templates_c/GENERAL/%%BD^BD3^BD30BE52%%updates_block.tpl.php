<?php /* Smarty version 2.6.26, created on 2016-05-15 08:55:01
         compiled from items/updates_block.tpl */ ?>
<!-- updates block begin -->
 <?php echo '
 <style type="text/css">
   .days_deff { display: inline-block; font-size: 85%; position: relative; top: -4px; color: #71553A; }
 </style>
 '; ?>

 <div<?php if ($this->_tpl_vars['widthdiv']): ?> style="width: <?php echo $this->_tpl_vars['widthdiv']; ?>
"<?php endif; ?>><span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
	<td class="upd_td" style="width: 80px">
	<span class="yandex_logo_upd">
	 <span class="text"><label id="red">Я</label>ндекс</span>
	</span>
	</td>
	<td class="upd_td_v"><label id="fone_l" style="padding-right: 2px">
	<?php if (isset ( $this->_tpl_vars['engine_updates_list'] ) && $this->_tpl_vars['engine_updates_list']['1'] && $this->_tpl_vars['engine_updates_list']['1']['bold']): ?>
	 <b>ТиЦ</b>
	<?php else: ?>
	 ТиЦ
	<?php endif; ?>	
	</label></td>
	<td class="upd_td_r"><label id="fone_l" style="padding-left: 2px">
	<?php if (! isset ( $this->_tpl_vars['engine_updates_list'] ) || ! $this->_tpl_vars['engine_updates_list']['1'] || ! $this->_tpl_vars['engine_updates_list']['1']['value']): ?>
	 ?
	<?php else: ?> 
	 <?php if ($this->_tpl_vars['engine_updates_list']['1']['bold']): ?>
	  <b><?php echo $this->_tpl_vars['engine_updates_list']['1']['value']; ?>
</b>
	 <?php else: ?>
	  <?php echo $this->_tpl_vars['engine_updates_list']['1']['value']; ?>

	 <?php endif; ?>	 
	<?php endif; ?>
	</label>
    </td>
   </tr>
   <?php if (@W_UPDATESSHOWDEFISIONONBLOCK): ?>  
   <tr>  
	<td style="height: 1px" align="right" valign="top" colspan="3">
	<label class="days_deff">(<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['engine_updates_list']['1']['value_original']); ?>
)</label>
	</td>
   </tr>
   <?php endif; ?>
   <tr>
	<td class="upd_td"></td>
	<td class="upd_td_v"><label id="fone_l" style="padding-right: 2px">
	<?php if (isset ( $this->_tpl_vars['engine_updates_list'] ) && $this->_tpl_vars['engine_updates_list']['2'] && $this->_tpl_vars['engine_updates_list']['2']['bold']): ?>
	 <b>поиск</b>
	<?php else: ?>
	 поиск
	<?php endif; ?>
	</label></td>
	<td class="upd_td_r"><label id="fone_l" style="padding-left: 2px">	
	<?php if (! isset ( $this->_tpl_vars['engine_updates_list'] ) || ! $this->_tpl_vars['engine_updates_list']['2'] || ! $this->_tpl_vars['engine_updates_list']['2']['value']): ?>
	 ?
	<?php else: ?> 
	 <?php if ($this->_tpl_vars['engine_updates_list']['2']['bold']): ?>
	  <b><?php echo $this->_tpl_vars['engine_updates_list']['2']['value']; ?>
</b>
	 <?php else: ?>
	  <?php echo $this->_tpl_vars['engine_updates_list']['2']['value']; ?>

	 <?php endif; ?> 
	<?php endif; ?>	
	</label></td>
   </tr>
   <?php if (@W_UPDATESSHOWDEFISIONONBLOCK): ?>  
   <tr>
	<td style="height: 1px" align="right" valign="top" colspan="3">
	<label class="days_deff">(<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['engine_updates_list']['2']['value_original']); ?>
)</label>
	</td>
   </tr>
   <?php endif; ?>
   <tr>
	<td class="upd_td" style="height: 17px"></td>
	<td class="upd_td_v" style="height: 17px"><label id="fone_l" style="padding-right: 2px">
	<?php if (isset ( $this->_tpl_vars['engine_updates_list'] ) && $this->_tpl_vars['engine_updates_list']['3'] && $this->_tpl_vars['engine_updates_list']['3']['bold']): ?>
	 <b>каталог</b>
	<?php else: ?>
	 каталог
	<?php endif; ?>		
	</label></td>
	<td class="upd_td_r" style="height: 17px"><label id="fone_l" style="padding-left: 2px">
	<?php if (! isset ( $this->_tpl_vars['engine_updates_list'] ) || ! $this->_tpl_vars['engine_updates_list']['3'] || ! $this->_tpl_vars['engine_updates_list']['3']['value']): ?>
	 ?
	<?php else: ?> 
	 <?php if ($this->_tpl_vars['engine_updates_list']['3']['bold']): ?>
	  <b><?php echo $this->_tpl_vars['engine_updates_list']['3']['value']; ?>
</b>
	 <?php else: ?>
	  <?php echo $this->_tpl_vars['engine_updates_list']['3']['value']; ?>

	 <?php endif; ?>	 
	<?php endif; ?>	
	</label></td>
   </tr>
   <?php if (@W_UPDATESSHOWDEFISIONONBLOCK): ?>  
   <tr>
	<td style="height: 1px" align="right" valign="top" colspan="3">
	<label class="days_deff">(<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['engine_updates_list']['3']['value_original']); ?>
)</label>
	</td>
   </tr>
   <?php endif; ?>   
   <tr>
	<td style="height: 10px"></td>
	<td style="height: 10px"></td>
	<td style="height: 10px"></td>
   </tr>
   <tr>
	<td class="upd_td" style="width: 80px">
	<span class="google_logo_upd">
	 <span class="text">
	  <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label>
	 </span>
	</span>
	</td>
	<td class="upd_td_v"><label id="fone_l" style="padding-right: 2px">
	<?php if (isset ( $this->_tpl_vars['engine_updates_list'] ) && $this->_tpl_vars['engine_updates_list']['4'] && $this->_tpl_vars['engine_updates_list']['4']['bold']): ?>
	 <b>PR</b>
	<?php else: ?>
	 PR
	<?php endif; ?>		
	</label></td>
	<td class="upd_td_r"><label id="fone_l" style="padding-left: 2px">
	<?php if (! isset ( $this->_tpl_vars['engine_updates_list'] ) || ! $this->_tpl_vars['engine_updates_list']['4'] || ! $this->_tpl_vars['engine_updates_list']['4']['value']): ?>
	 ?
	<?php else: ?> 
	 <?php if ($this->_tpl_vars['engine_updates_list']['4']['bold']): ?>
	  <b><?php echo $this->_tpl_vars['engine_updates_list']['4']['value']; ?>
</b>
	 <?php else: ?>
	  <?php echo $this->_tpl_vars['engine_updates_list']['4']['value']; ?>

	 <?php endif; ?>	 
	<?php endif; ?>	
    </label></td>
   </tr>
   <?php if (@W_UPDATESSHOWDEFISIONONBLOCK): ?>  
   <tr>
	<td style="height: 1px" align="right" valign="top" colspan="3">
	<label class="days_deff">(<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['engine_updates_list']['4']['value_original']); ?>
)</label>
	</td>
   </tr>
   <?php endif; ?>
   </table> 
 </span></div>  
<!-- updates block end -->