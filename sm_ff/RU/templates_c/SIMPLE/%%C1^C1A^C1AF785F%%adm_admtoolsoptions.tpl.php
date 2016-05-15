<?php /* Smarty version 2.6.26, created on 2016-05-15 09:19:28
         compiled from adm_account/adm_admtoolsoptions.tpl */ ?>
<div style="margin-top: 4px">
 <?php if (! $_GET['toolid'] || ! $this->_tpl_vars['adm_object']->ToolOptionExists($_GET['toolid'])): ?>
  
 
 <?php $this->assign('listtoolsX', $this->_tpl_vars['CONTROL_OBJ']->GetToolsListByGroupDevision()); ?>
 <?php echo '
 <script type="text/javascript">
  function DoHigl(th, n) {	
    if (n) { $(th).css(\'background\',\'#F9FAFB\'); } else {   	
     $(th).css(\'background\', \'none\');		
    }	
   }//DoHigl
      
  function ShHdBlElementA(th, ident) {	   
   var hd = ($(\'#\'+ident).css(\'visibility\') == \'hidden\') ? true : false; 
   $(th).html((hd) ? \'Скрыть\' : \'Показать\');
   $(\'#\'+ident).css(\'visibility\', (hd) ? \'visible\' : \'hidden\');
   $(\'#\'+ident).css(\'display\', (hd) ? \'block\' : \'none\');
  }//ShHdBlElementA	
 </script>
 <style type="text/css">
  .tdblock { padding: 2px; }	
 </style>
 '; ?>

 
 <?php $_from = $this->_tpl_vars['listtoolsX']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?> 
  <div class="analisislabelid"><b><?php echo $this->_tpl_vars['val']['group']['name']; ?>
</b><label style="color: #000000; margin-left: 6px">[ <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElementA(this, 'block_<?php echo $this->_tpl_vars['val']['group']['iditem']; ?>
')">Скрыть</a> ]</label>
  </div>
 
  <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="block_<?php echo $this->_tpl_vars['val']['group']['iditem']; ?>
">
   <?php if (! $this->_tpl_vars['val']['data']['count']): ?>
    В группе нет инструментов!
   <?php else: ?>
   <span style="width: 100%">
    <table width="100%" cellpadding="0" cellspacing="0">
     <?php unset($this->_sections['trindex']);
$this->_sections['trindex']['name'] = 'trindex';
$this->_sections['trindex']['start'] = (int)0;
$this->_sections['trindex']['loop'] = is_array($_loop=$this->_tpl_vars['val']['data']['count']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['trindex']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['trindex']['show'] = true;
$this->_sections['trindex']['max'] = $this->_sections['trindex']['loop'];
if ($this->_sections['trindex']['start'] < 0)
    $this->_sections['trindex']['start'] = max($this->_sections['trindex']['step'] > 0 ? 0 : -1, $this->_sections['trindex']['loop'] + $this->_sections['trindex']['start']);
else
    $this->_sections['trindex']['start'] = min($this->_sections['trindex']['start'], $this->_sections['trindex']['step'] > 0 ? $this->_sections['trindex']['loop'] : $this->_sections['trindex']['loop']-1);
if ($this->_sections['trindex']['show']) {
    $this->_sections['trindex']['total'] = min(ceil(($this->_sections['trindex']['step'] > 0 ? $this->_sections['trindex']['loop'] - $this->_sections['trindex']['start'] : $this->_sections['trindex']['start']+1)/abs($this->_sections['trindex']['step'])), $this->_sections['trindex']['max']);
    if ($this->_sections['trindex']['total'] == 0)
        $this->_sections['trindex']['show'] = false;
} else
    $this->_sections['trindex']['total'] = 0;
if ($this->_sections['trindex']['show']):

            for ($this->_sections['trindex']['index'] = $this->_sections['trindex']['start'], $this->_sections['trindex']['iteration'] = 1;
                 $this->_sections['trindex']['iteration'] <= $this->_sections['trindex']['total'];
                 $this->_sections['trindex']['index'] += $this->_sections['trindex']['step'], $this->_sections['trindex']['iteration']++):
$this->_sections['trindex']['rownum'] = $this->_sections['trindex']['iteration'];
$this->_sections['trindex']['index_prev'] = $this->_sections['trindex']['index'] - $this->_sections['trindex']['step'];
$this->_sections['trindex']['index_next'] = $this->_sections['trindex']['index'] + $this->_sections['trindex']['step'];
$this->_sections['trindex']['first']      = ($this->_sections['trindex']['iteration'] == 1);
$this->_sections['trindex']['last']       = ($this->_sections['trindex']['iteration'] == $this->_sections['trindex']['total']);
?>
      <tr>      
       
       <td valign="top" align="left" width="50%" class="tdblock"<?php if ($this->_tpl_vars['val']['data']['data1'][$this->_sections['trindex']['index']]['name']): ?> onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)"<?php endif; ?>>
        <?php if ($this->_tpl_vars['val']['data']['data1'][$this->_sections['trindex']['index']]['name']): ?>       
         <div><span style="width: 100%">
          <table width="100%" cellpadding="0" cellspacing="0">
           <tr>
            
            <td valign="top" align="left" width="18px" style="padding-left: 2px; padding-top: 2px">
             <img src="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetToolImageStyle($this->_tpl_vars['val']['data']['data1'][$this->_sections['trindex']['index']]['name'],16,'',''); ?>
" style="width: 16px; height: 16px; margin-right: 2px">            
            </td>
            
            <td valign="top" align="left" style="padding-top: 2px">
             <div><a href="<?php echo @W_SITEPATH; ?>
account/admtoolsoptions/?toolid=<?php echo $this->_tpl_vars['val']['data']['data1'][$this->_sections['trindex']['index']]['name']; ?>
"><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText($this->_tpl_vars['val']['data']['data1'][$this->_sections['trindex']['index']]['value']['descr']); ?>
</a></div>            
             <div style="font-size: 95%; color: #969696; margin-top: 2px">
             Просмотров: <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetToolVisitorsCount($this->_tpl_vars['val']['data']['data1'][$this->_sections['trindex']['index']]['name']); ?>

             </div>            
             <div style="color: #808080; font-size: 95%; margin-top: 2px">
	         <?php if (! $this->_tpl_vars['val']['data']['data1'][$this->_sections['trindex']['index']]['value']['Ldescr']): ?>
	          <i>(нет описания)</i>
	         <?php else: ?>
	          <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText($this->_tpl_vars['val']['data']['data1'][$this->_sections['trindex']['index']]['value']['Ldescr']); ?>

	         <?php endif; ?>
	         </div>
             
             <?php if ($this->_tpl_vars['val']['data']['data1'][$this->_sections['trindex']['index']]['value']['onlineonly'] || $this->_tpl_vars['val']['data']['data1'][$this->_sections['trindex']['index']]['value']['onlyforadmin']): ?>
             <div style="font-size: 95%; margin-top: 2px; color: #0000FF">             
              <?php if ($this->_tpl_vars['val']['data']['data1'][$this->_sections['trindex']['index']]['value']['onlineonly']): ?>
               <label title="Требуется регистрация на сайте" style="cursor: help">регистрация</label>
              <?php endif; ?>            
              <?php if ($this->_tpl_vars['val']['data']['data1'][$this->_sections['trindex']['index']]['value']['onlyforadmin']): ?>
               <label style="<?php if ($this->_tpl_vars['val']['data']['data1'][$this->_sections['trindex']['index']]['value']['onlineonly']): ?>margin-left: 6px; <?php endif; ?>color: #FF0000">временно недоступен</label>               
              <?php endif; ?>                        
             </div>
             <?php endif; ?>
                        
            </td>
          
           </tr>
          </table>
         </span></div>          
        <?php endif; ?>
       </td>
       
       
       <td valign="top" align="left" width="50%" class="tdblock"<?php if ($this->_tpl_vars['val']['data']['data2'][$this->_sections['trindex']['index']]['name']): ?> onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)"<?php endif; ?>>
        <?php if ($this->_tpl_vars['val']['data']['data2'][$this->_sections['trindex']['index']]['name']): ?>       
         <div><span style="width: 100%">
          <table width="100%" cellpadding="0" cellspacing="0">
           <tr>
            
            <td valign="top" align="left" width="18px" style="padding-left: 2px; padding-top: 2px">
             <img src="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetToolImageStyle($this->_tpl_vars['val']['data']['data2'][$this->_sections['trindex']['index']]['name'],16,'',''); ?>
" style="width: 16px; height: 16px; margin-right: 2px">            
            </td>
            
            <td valign="top" align="left" style="padding-top: 2px">
             <div><a href="<?php echo @W_SITEPATH; ?>
account/admtoolsoptions/?toolid=<?php echo $this->_tpl_vars['val']['data']['data2'][$this->_sections['trindex']['index']]['name']; ?>
"><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText($this->_tpl_vars['val']['data']['data2'][$this->_sections['trindex']['index']]['value']['descr']); ?>
</a></div>            
             <div style="font-size: 95%; color: #969696; margin-top: 2px">
             Просмотров: <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetToolVisitorsCount($this->_tpl_vars['val']['data']['data2'][$this->_sections['trindex']['index']]['name']); ?>

             </div>            
             <div style="color: #808080; font-size: 95%; margin-top: 2px">
	         <?php if (! $this->_tpl_vars['val']['data']['data2'][$this->_sections['trindex']['index']]['value']['Ldescr']): ?>
	          <i>(нет описания)</i>
	         <?php else: ?>
	          <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText($this->_tpl_vars['val']['data']['data2'][$this->_sections['trindex']['index']]['value']['Ldescr']); ?>

	         <?php endif; ?>
	         </div>
             
             <?php if ($this->_tpl_vars['val']['data']['data2'][$this->_sections['trindex']['index']]['value']['onlineonly'] || $this->_tpl_vars['val']['data']['data2'][$this->_sections['trindex']['index']]['value']['onlyforadmin']): ?>
             <div style="font-size: 95%; margin-top: 2px; color: #0000FF">             
              <?php if ($this->_tpl_vars['val']['data']['data2'][$this->_sections['trindex']['index']]['value']['onlineonly']): ?>
               <label title="Требуется регистрация на сайте" style="cursor: help">регистрация</label>
              <?php endif; ?>            
              <?php if ($this->_tpl_vars['val']['data']['data2'][$this->_sections['trindex']['index']]['value']['onlyforadmin']): ?>
               <label style="<?php if ($this->_tpl_vars['val']['data']['data2'][$this->_sections['trindex']['index']]['value']['onlineonly']): ?>margin-left: 6px; <?php endif; ?>color: #FF0000">временно недоступен</label>               
              <?php endif; ?>                        
             </div>
             <?php endif; ?>
                        
            </td>
          
           </tr>
          </table>
         </span></div>          
        <?php endif; ?>
       </td>                
       
      </tr>
     <?php endfor; endif; ?>
    </table>
   </span>
   <?php endif; ?>
  </div> 
 <?php endforeach; endif; unset($_from); ?> 
 
 <?php else: ?>
   <?php if (! $this->_tpl_vars['adm_object']->GetResult('fieldslist')): ?>
   <div style="margin-left: 4px; color: #FF0000">Для данного инструмента не определены надстройки!</div>  
  <?php else: ?>
   <?php echo '
   <script type="text/javascript">         
    function PrepereSent(th) {		 		 	 
	 $(\'#globalbodydata\').css(\'cursor\', \'wait\');
     th.rb.disabled = true;
	 return true; 	
	}//PrepereSent
	
	function PrepereToReset(th) {
	 if (!confirm(
	  "Вы действительно хотите сбросить все установленные надстройки на `системные`, использующиеся по умолчанию?"
	 )) { return false; }
	 return PrepereSent(th);	
	}//PrepereToReset
   </script>
   '; ?>
  
   
   <form method="post" name="toolopt" id="toolopt" onsubmit="return PrepereSent(this)">
    <?php $_from = $this->_tpl_vars['adm_object']->GetResult('fieldslist'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?> 
	 <div style="margin-top: 12px">
	   
     <?php if ($this->_tpl_vars['val']['type'] == 'boolean'): ?>
      <div class="typelabel">
      <input type="checkbox"<?php if ($this->_tpl_vars['val']['value']): ?> checked="checked"<?php endif; ?> style="cursor: pointer" name="<?php echo $this->_tpl_vars['val']['fname']; ?>
" id="<?php echo $this->_tpl_vars['val']['fname']; ?>
"><label for="<?php echo $this->_tpl_vars['val']['fname']; ?>
" style="cursor: pointer">&nbsp;<?php echo $this->_tpl_vars['val']['descr']; ?>
</label>
      </div>     
     <?php else: ?>
	   
      <div class="typelabel"><?php echo $this->_tpl_vars['val']['descr']; ?>
</div>
      <div class="typelabel">
       <?php if ($this->_tpl_vars['val']['type'] == 'array'): ?>
        <textarea class="int_text" style="height: 100px; width: 95%" name="<?php echo $this->_tpl_vars['val']['fname']; ?>
" id="<?php echo $this->_tpl_vars['val']['fname']; ?>
"><?php echo $this->_tpl_vars['adm_object']->GetArrayAsString($this->_tpl_vars['val']['value']); ?>
</textarea>             
       <?php else: ?>
        <?php if ($this->_tpl_vars['val']['select']): ?>
         
         <label> 
          <select class="combobox" name="<?php echo $this->_tpl_vars['val']['fname']; ?>
" id="<?php echo $this->_tpl_vars['val']['fname']; ?>
" style="width: 370px">
           <?php $_from = $this->_tpl_vars['adm_object']->GetStrings($this->_tpl_vars['val']['value']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['str'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['str']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['str']):
        $this->_foreach['str']['iteration']++;
?>
            <option value="<?php echo $this->_tpl_vars['str']['ident']; ?>
"<?php if ($this->_tpl_vars['str']['isselect']): ?> selected="selected" style="color: #0000FF"<?php endif; ?>><?php if ($this->_tpl_vars['str']['ident']): ?><?php echo $this->_tpl_vars['str']['ident']; ?>
 (<?php echo $this->_tpl_vars['str']['strdescr']; ?>
)<?php else: ?><?php echo $this->_tpl_vars['str']['strdescr']; ?>
<?php endif; ?></option>
           <?php endforeach; endif; unset($_from); ?>             
          </select>
		 </label>
         
        <?php else: ?>       
         <input type="text" class="inpt" style="width: 370px" name="<?php echo $this->_tpl_vars['val']['fname']; ?>
" id="<?php echo $this->_tpl_vars['val']['fname']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
		<?php endif; ?>     
       <?php endif; ?>      
	  </div>
	  	  	 
	 <?php endif; ?>
	 </div>	 
   <?php endforeach; endif; unset($_from); ?>
   
   <div class="typelabel" style="margin-top: 15px">
    <input type="submit" value="&nbsp;Сохранить изменения&nbsp;" class="button" name="rb" id="rb">
   </div>
   
   <input type="hidden" value="do" name="actiontosavetoolopt">
   </form>   
   
   <div style="margin-top: 20px; border-top: 1px solid #C0C0C0; padding-top: 8px">
   <form method="post" name="restsubopt" id="restsubopt" onsubmit="return PrepereToReset(this)">
    <input type="submit" value="&nbsp;Вернуть все надстройки на стандартные&nbsp;" class="button" name="rb" id="rb">
    <input type="hidden" value="do" name="dorestoresuboptions">
   </form>
   </div>
   
   <?php if ($_POST['dorestoresuboptions'] == 'do'): ?>
    <div style="margin-top: 15px; color: #0000FF"><?php echo $this->_tpl_vars['adm_object']->resetstr; ?>
</div>
   <?php endif; ?>
   
   <?php if ($_POST['actiontosavetoolopt'] == 'do'): ?>
    <div style="margin-top: 8px">
	<?php if ($this->_tpl_vars['adm_object']->error): ?>
	 <span style="color: #FF0000"><?php echo $this->_tpl_vars['adm_object']->error; ?>
</span>
	<?php else: ?>
	 <span style="color: #008000">Настройки успешно изменены!</span>
	<?php endif; ?>
	</div>
   <?php endif; ?>
    
   <?php echo '
   <script type="text/javascript">
    $(function() { $(\'select.combobox\').combobox(); });	
   </script>
   '; ?>
 
    
  <?php endif; ?>
 <?php endif; ?> 
 
</div>