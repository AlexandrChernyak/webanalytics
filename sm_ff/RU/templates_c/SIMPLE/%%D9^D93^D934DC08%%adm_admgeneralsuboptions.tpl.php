<?php /* Smarty version 2.6.26, created on 2016-05-15 09:14:34
         compiled from adm_account/adm_admgeneralsuboptions.tpl */ ?>
<div style="margin-top: 4px">
 <?php if (! $this->_tpl_vars['adm_object']->GetResult('data')): ?>
  <div style="margin-left: 4px; color: #FF0000">Не определены идентификаторы надстроек сайта!</div>
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

 
  <form method="post" name="subopt" id="subopt" onsubmit="return PrepereSent(this)">
    <?php $_from = $this->_tpl_vars['adm_object']->GetResult('data'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?> 
	 <div style="margin-top: 12px">
	  
	  <?php if ($this->_tpl_vars['val']['type'] == 'boolean'): ?>
      <div class="typelabel">
       <input type="checkbox"<?php if ($this->_tpl_vars['val']['value']): ?> checked="checked"<?php endif; ?> style="cursor: pointer" name="<?php echo $this->_tpl_vars['val']['name']; ?>
" id="<?php echo $this->_tpl_vars['val']['name']; ?>
"><label for="<?php echo $this->_tpl_vars['val']['name']; ?>
" style="cursor: pointer">&nbsp;<?php echo $this->_tpl_vars['val']['descr']; ?>
</label>
      </div>     
      <?php else: ?>
     
       <div class="typelabel"><?php echo $this->_tpl_vars['val']['descr']; ?>
</div>
       <div class="typelabel">
        <?php if ($this->_tpl_vars['val']['type'] == 'string'): ?>        
         <label> 
         <select class="combobox" name="<?php echo $this->_tpl_vars['val']['name']; ?>
" id="<?php echo $this->_tpl_vars['val']['name']; ?>
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
         <input type="text" class="inpt" style="width: 370px" name="<?php echo $this->_tpl_vars['val']['name']; ?>
" id="<?php echo $this->_tpl_vars['val']['name']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
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
	  <span style="color: #008000">Надстройки успешно изменены!</span>
	 <?php endif; ?>
	</div>
   <?php endif; ?>
    
   <?php echo '
   <script type="text/javascript">
    $(function() { $(\'select.combobox\').combobox(); });	
   </script>
   '; ?>
 
 
 
 <?php endif; ?> 
</div>