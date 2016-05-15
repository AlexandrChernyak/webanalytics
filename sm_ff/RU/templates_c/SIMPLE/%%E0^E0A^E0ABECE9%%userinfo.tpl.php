<?php /* Smarty version 2.6.26, created on 2016-05-15 09:27:26
         compiled from userinfo.tpl */ ?>
<div style="margin-top: 5px">
 <?php if (! isset ( $this->_tpl_vars['user_regional_info'] ) || ! $this->_tpl_vars['user_regional_info']): ?>
  <b>Такого пользователя не существует!</b>  
 <?php else: ?>
    <?php echo '
  <style type="text/css">
	.line_item { border-bottom: 1px solid #EBEBEB; height: 22px; }
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
	<td valign="top" align="left" width="110px">
	<img src="<?php echo @W_SITEPATH; ?>
<?php echo @W_FILESWEBPATH; ?>
/images/<?php echo $this->_tpl_vars['user_regional_info']['avatar']; ?>
" alt="<?php echo $this->_tpl_vars['user_regional_info']['username']; ?>
 avatar" width="99" height="99">
	</td>
	<td valign="top" align="left">
	 <table width="100%" cellpadding="0" cellspacing="0" border="0">
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <td valign="center" align="left" width="100px" class="line_item">
	  Логин
	  </td>
	  <td valign="center" align="left" class="line_item">
	  <b><?php echo $this->_tpl_vars['user_regional_info']['username']; ?>
</b>
	  </td>
	 </tr>
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <td valign="center" align="left" width="100px" class="line_item">
	  E-mail
	  </td>
	  <td valign="center" align="left" class="line_item">
	  <?php if ($this->_tpl_vars['CONTROL_OBJ']->ReadOption('SHOWEMAIL',$this->_tpl_vars['user_regional_info']['genoptions'])): ?>
	   <a href="mailto:<?php echo $this->_tpl_vars['user_regional_info']['useremail']; ?>
"><?php echo $this->_tpl_vars['user_regional_info']['useremail']; ?>
</a>	   
	  <?php else: ?>
	  <i>(Закрыто)</i>
	  <?php endif; ?>	  
	  </td>
	 </tr>
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <td valign="center" align="left" width="100px" class="line_item">
	  Сайт
	  </td>
	  <td valign="center" align="left" class="line_item">
	  <?php if ($this->_tpl_vars['CONTROL_OBJ']->ReadOption('SHOWSITE',$this->_tpl_vars['user_regional_info']['genoptions'])): ?>
	   <?php if (! $this->_tpl_vars['CONTROL_OBJ']->GetCorrectUserSite($this->_tpl_vars['user_regional_info'])): ?>
	    Нет	    
	   <?php else: ?>
	    <?php if (! $this->_tpl_vars['user_regional_info']['indexsiteonpage']): ?><noindex><?php endif; ?><a<?php if (! $this->_tpl_vars['user_regional_info']['indexsiteonpage']): ?> rel="nofollow"<?php endif; ?> href="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetCorrectUserSite($this->_tpl_vars['user_regional_info']); ?>
" target="_blank"><?php echo $this->_tpl_vars['user_regional_info']['usersite']; ?>
</a><?php if (! $this->_tpl_vars['user_regional_info']['indexsiteonpage']): ?></noindex><?php endif; ?>	    
	   <?php endif; ?>   	   
	  <?php else: ?>
	  <i>(Закрыто)</i>
	  <?php endif; ?>	  
	  </td>
	 </tr>
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <td valign="center" align="left" width="100px" class="line_item">
	  Активность
	  </td>
	  <td valign="center" align="left" class="line_item">
	  <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['user_regional_info']['datelastin']); ?>
	  
	  </td>
	 </tr>
     <?php $this->assign('groupslist', $this->_tpl_vars['CONTROL_OBJ']->GetUserGroups($this->_tpl_vars['user_regional_info']['iduser'],'text-decoration: underline; color: #016C6C')); ?>
     <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <td valign="center" align="left" width="100px" class="line_item">
	  Группы
	  </td>
	  <td valign="center" align="left" class="line_item" style="font-size: 95%">
	  <?php if ($this->_tpl_vars['groupslist']['str']): ?><?php echo $this->_tpl_vars['groupslist']['str']; ?>
<?php else: ?><em>(не входит в группы)</em><?php endif; ?>	  
	  </td>
	 </tr>    
     
     		
	
	</table>
	</td>
  </tr>
  </table>
  </span>
 <?php endif; ?>
</div>