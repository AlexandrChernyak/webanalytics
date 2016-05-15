<?php /* Smarty version 2.6.26, created on 2016-05-15 08:54:26
         compiled from seo-panel/url_param_data.tpl */ ?>
   <?php if (! $this->_tpl_vars['PANEL_CONTROL']->line_obj): ?>?<?php else: ?>
	
	<?php if ($this->_tpl_vars['val']['sid'] == 'url'): ?>
	 		 
	 <a href="http://<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('urllineinfo.urlid'); ?>
" target="_blank"><?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('urllineinfo.urlid'); ?>
</a>
	 
	<?php elseif ($this->_tpl_vars['PANEL_CONTROL']->line_obj->GetCurrentValue($this->_tpl_vars['val']['sid'],$this->_tpl_vars['val']['data'],'value') !== false): ?>
	  
	  	  <?php $this->assign('valueitemvf', $this->_tpl_vars['PANEL_CONTROL']->line_obj->GetCurrentValue($this->_tpl_vars['val']['sid'],$this->_tpl_vars['val']['data'],'value')); ?>
	  <?php $this->assign('linkitemvf', $this->_tpl_vars['PANEL_CONTROL']->line_obj->GetCurrentValue($this->_tpl_vars['val']['sid'],$this->_tpl_vars['val']['data'],'link')); ?>
	  <?php if (! $this->_tpl_vars['val']['data']['nodisplaydiff']): ?>	  
	   <?php $this->assign('diffvalueitemvf', $this->_tpl_vars['PANEL_CONTROL']->line_obj->GetCurrentValue($this->_tpl_vars['val']['sid'],$this->_tpl_vars['val']['data'],'diff')); ?>
      <?php endif; ?>
	  
	  <label id="fromparam<?php echo $this->_tpl_vars['val']['id']; ?>
" style="padding-left: 1px<?php if ($this->_tpl_vars['val']['data']['color']): ?>; color: <?php echo $this->_tpl_vars['val']['data']['color']; ?>
<?php endif; ?>">
	  	  <?php if ($this->_tpl_vars['val']['data']['type'] == '1'): ?>
	   <?php if ($this->_tpl_vars['val']['data']['dateformat']): ?>
	     
	     	     <?php if ($this->_tpl_vars['val']['sid'] == 'dateupdated' && $this->_tpl_vars['valueitemvf'] == $this->_tpl_vars['PANEL_CONTROL']->GetThisDate()): ?>
		 <label style="background: #E7EEE6">
		 <?php endif; ?>
	     
	     <?php if ($this->_tpl_vars['linkitemvf']): ?><a href="<?php echo $this->_tpl_vars['linkitemvf']; ?>
" class="blackc" target="_blank"<?php if ($this->_tpl_vars['val']['data']['color']): ?> style="color: <?php echo $this->_tpl_vars['val']['data']['color']; ?>
"<?php endif; ?>><?php endif; ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->DateToSpecialFormat($this->_tpl_vars['valueitemvf'],$this->_tpl_vars['val']['data']['dateformat'],1); ?>
<?php if ($this->_tpl_vars['linkitemvf']): ?></a><?php endif; ?>
	     
	     <?php if ($this->_tpl_vars['val']['sid'] == 'dateupdated' && $this->_tpl_vars['valueitemvf'] == $this->_tpl_vars['PANEL_CONTROL']->GetThisDate()): ?></label><?php endif; ?>
		    	    	    
	   <?php else: ?>
	   	   
	    <?php if ($this->_tpl_vars['linkitemvf']): ?><a href="<?php echo $this->_tpl_vars['linkitemvf']; ?>
" class="blackc" target="_blank"<?php if ($this->_tpl_vars['val']['data']['color']): ?> style="color: <?php echo $this->_tpl_vars['val']['data']['color']; ?>
"<?php endif; ?>><?php endif; ?><?php echo $this->_tpl_vars['valueitemvf']; ?>
<?php if ($this->_tpl_vars['linkitemvf']): ?></a><?php endif; ?>
	    
	   <?php endif; ?>
	   	   	    
	  <?php elseif ($this->_tpl_vars['val']['data']['type'] == '2'): ?>
	   	   	   
	   <?php if ($this->_tpl_vars['linkitemvf']): ?><a href="<?php echo $this->_tpl_vars['linkitemvf']; ?>
" target="_blank"><?php endif; ?><img src="<?php echo $this->_tpl_vars['valueitemvf']; ?>
" border="0" alt="<?php echo $this->_tpl_vars['val']['data']['name']; ?>
"<?php if ($this->_tpl_vars['val']['data']['imageheight']): ?> height="<?php echo $this->_tpl_vars['val']['data']['imageheight']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['val']['data']['imagewidth']): ?> width="<?php echo $this->_tpl_vars['val']['data']['imagewidth']; ?>
"<?php endif; ?>><?php if ($this->_tpl_vars['linkitemvf']): ?></a><?php endif; ?>
	   	  
	  <?php elseif ($this->_tpl_vars['val']['data']['type'] == '3'): ?>
	   	   
	   
	   <a title="История изменения показателей" href="javascript:" onclick="ProcessViewHistoryElement('<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('urllineinfo.iditem'); ?>
')"><img alt="h" src="<?php echo @W_SITEPATH; ?>
css/panel/img/history.png" width="16" height="16" align='absmiddle'></a>
	   
	   <span style="margin-left: 3px"><a title="Выполнить анализ сайта" target="_blank" href="<?php echo @W_SITEPATH; ?>
tools/analysis/<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('urllineinfo.urlid'); ?>
"><img alt="a" src="<?php echo @W_SITEPATH; ?>
css/panel/img/info.png" width="16" height="16" align='absmiddle'></a></span>
	   
	  
	  <?php else: ?>
	    
	   
	   <?php if ($this->_tpl_vars['val']['data']['returnasstring']): ?>
	    		<?php if ($this->_tpl_vars['valueitemvf'] && $this->_tpl_vars['val']['data']['coloryes']): ?>
	     <?php $this->assign('coloryesno', $this->_tpl_vars['val']['data']['coloryes']); ?>
	    <?php elseif (! $this->_tpl_vars['valueitemvf'] && $this->_tpl_vars['val']['data']['colorno']): ?> 
	     <?php $this->assign('coloryesno', $this->_tpl_vars['val']['data']['colorno']); ?>
	    <?php else: ?>
	     <?php $this->assign('coloryesno', ""); ?>
	    <?php endif; ?>	   
	    <label<?php if ($this->_tpl_vars['coloryesno']): ?> style="color: <?php echo $this->_tpl_vars['coloryesno']; ?>
"<?php endif; ?>>
	   <?php endif; ?>	   
	   
	   <?php if ($this->_tpl_vars['linkitemvf']): ?><a href="<?php echo $this->_tpl_vars['linkitemvf']; ?>
" class="blackc"<?php if ($this->_tpl_vars['coloryesno'] || $this->_tpl_vars['val']['data']['color']): ?> style="color: <?php if ($this->_tpl_vars['coloryesno']): ?><?php echo $this->_tpl_vars['coloryesno']; ?>
<?php else: ?><?php echo $this->_tpl_vars['val']['data']['color']; ?>
<?php endif; ?>"<?php endif; ?> target="_blank"><?php endif; ?><?php if ($this->_tpl_vars['val']['data']['returnasstring']): ?><?php if ($this->_tpl_vars['valueitemvf']): ?><?php echo $this->_tpl_vars['PANEL_CONTROL']->GetText('yesstringidentsimply'); ?>
<?php else: ?><?php echo $this->_tpl_vars['PANEL_CONTROL']->GetText('nostringidentsimply'); ?>
<?php endif; ?><?php else: ?><?php echo $this->_tpl_vars['valueitemvf']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['linkitemvf']): ?></a><?php endif; ?>
	   
	   <?php if ($this->_tpl_vars['val']['data']['returnasstring']): ?></label><?php endif; ?>	  
	  <?php endif; ?>
	  </label>
	  
	  	  <?php if ($this->_tpl_vars['diffvalueitemvf']): ?>
	   <sup style="padding-left: 2px<?php if (( $this->_tpl_vars['val']['data']['swithifdayslost'] && $this->_tpl_vars['diffvalueitemvf'] && $this->_tpl_vars['diffvalueitemvf'] > $this->_tpl_vars['val']['data']['swithifdayslost'] ) || ( ! isset ( $this->_tpl_vars['val']['data']['swithifdayslost'] ) && $this->_tpl_vars['diffvalueitemvf'] > 0 )): ?><?php if ($this->_tpl_vars['val']['data']['colorplus']): ?>; color: <?php echo $this->_tpl_vars['val']['data']['colorplus']; ?>
<?php endif; ?><?php else: ?><?php if ($this->_tpl_vars['val']['data']['colorminus']): ?>; color: <?php echo $this->_tpl_vars['val']['data']['colorminus']; ?>
<?php endif; ?><?php endif; ?>" id="difffromparam<?php echo $this->_tpl_vars['val']['id']; ?>
">
	    <?php if ($this->_tpl_vars['diffvalueitemvf'] > 0): ?>+<?php endif; ?><?php echo $this->_tpl_vars['PANEL_CONTROL']->line_obj->GetCurrentValue($this->_tpl_vars['val']['sid'],$this->_tpl_vars['val']['data'],'diffreal'); ?>

	   </sup>
	  <?php endif; ?>
 
	 <?php else: ?>
	 -
	 <?php endif; ?>	 	
	
   <?php endif; ?>