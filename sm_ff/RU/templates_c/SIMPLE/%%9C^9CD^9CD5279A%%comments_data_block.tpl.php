<?php /* Smarty version 2.6.26, created on 2016-05-15 09:05:24
         compiled from items/comments_data_block.tpl */ ?>
<!-- comments begin -->
<?php if (isset ( $this->_tpl_vars['global_data_list_info']['addstatus'] )): ?>
 <div style="margin-top: 10px; margin-bottom: 10px; padding: 3px; border: 1px dashed #000000">
 <?php if ($this->_tpl_vars['global_data_list_info']['addstatus'] == '0'): ?>
   Спасибо! Ваш комментарий успешно принят. После проверки администратором, Ваш комментарий будет опубликован..
 <?php else: ?>
  <?php if ($this->_tpl_vars['global_data_list_info']['addstatus'] == '1'): ?>
   Спасибо! Ваш комментарий успешно добавлен!   
  <?php else: ?>
   <?php if ($this->_tpl_vars['global_data_list_info']['addstatus']): ?>
    <div style="color: #FF0000"><?php echo $this->_tpl_vars['global_data_list_info']['addstatus']; ?>
</div>   
   <?php endif; ?>   
  <?php endif; ?> 
 <?php endif; ?>
 </div>
<?php endif; ?>

<div style="margin-top: 10px">
 <?php if ($this->_tpl_vars['global_data_list_info']['commentsdata']['source']): ?>
  <?php $_from = $this->_tpl_vars['global_data_list_info']['commentsdata']['source']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
   <div style="margin-top: 30px">
    <?php $this->assign('avatarinfo', $this->_tpl_vars['CONTROL_OBJ']->GetUserAvatarInfo($this->_tpl_vars['val']['username'])); ?>
    <span style="width: 100%">
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
     <tr>
	  <td valign="top" align="left" width="106px">
	  <img width="99" height="99" src="<?php echo $this->_tpl_vars['avatarinfo']['webpath']; ?>
">	  
	  </td>
	  <td valign="top" align="left">
	   <div style="margin-bottom: 4px; color: #969696">
	   <i>Re: <?php echo $this->_tpl_vars['commdescr']; ?>
</i>
	   </div>
	   <div><?php echo $this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextFromDB($this->_tpl_vars['val']['commsource']); ?>
</div>	  
	  </td>
     </tr>
     <tr>
	  <td valign="top" align="right" colspan="2" style="border-bottom: 1px solid #EBEBEB; margin-right: 4px">
	   <div style="margin-bottom: 3px">
	    <a href="<?php echo @W_SITEPATH; ?>
userinfo/<?php echo $this->_tpl_vars['val']['username']; ?>
/" target="_blank"><?php echo $this->_tpl_vars['val']['username']; ?>
</a>&nbsp;|&nbsp;
	    <?php echo $this->_tpl_vars['CONTROL_OBJ']->DateTimeToSpecialFormat($this->_tpl_vars['val']['datecreate']); ?>
	   	  
	   </div>  
	  </td>
     </tr>     
    </table>
	</span>
	</div>  
  <?php endforeach; endif; unset($_from); ?>
  <div style="text-align: right; margin-top: 18px"><?php echo $this->_tpl_vars['global_data_list_info']['commentsdata']['pagestext']; ?>
</div>
 <?php endif; ?>
 <div style="matgin-top: 18px">
 <?php if ($this->_tpl_vars['CONTROL_OBJ']->IsOnline()): ?>
 <?php echo '
 <script type="text/javascript">
  function SetActionIdent(n) {	
   document.getElementById(\'addcommentform\').actionnewprvmail.value = (n) ? \'act\' : \'prev\';	
  }//SetActionIdent
  
  function PrepereSent(th) {
   if (!trim(th.commentsource.value)) {
	alert(\'Укажите текст комментария!\');
	th.commentsource.focus();
	return false;
   }
   var restcode = document.getElementById(\'restcode\');
   if (restcode && !trim(restcode.value)) {
	alert(\'Укажите проверочный код с изображения!\');
	restcode.focus();
	return false;
   }    
   th.action = (th.actionnewprvmail.value == \'prev\') ? \'#commentview\' : \'#comments\';     
   $(\'#globalbodydata\').css(\'cursor\', \'wait\');
   th.rb.disabled = true;
   th.rbp.disabled = true;
   return true;	
  }//PrepereSent	
 </script>
 '; ?>

 <div id="commentview" style="margin-top: 12px">
  <?php if ($_POST['actionnewprvmail'] == 'prev'): ?>
  <div style="padding: 4px; border: 1px solid #969696; margin-top: 20px; margin-bottom: 20px; width: 94%;">
   <?php echo $this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextFromDB($this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextToDB($_POST['commentsource'])); ?>
  
  </div>
  <?php endif; ?> 
 </div>
 
 <form method="post" name="addcommentform" id="addcommentform" onsubmit="return PrepereSent(this)">
 
 <div class="typelabel"><label id="red">*</label> Текст комментария</div>
 <div class="typelabel">
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'new_message.tpl', 'smarty_include_vars' => array('ident' => 'commentsource','source' => $_POST['commentsource'],'height' => '220px','width' => '95%')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 </div>
 <div class="typelabel">
  <input type="checkbox" checked="checked" style="cursor: pointer" name="useinform" id="useinform"><label for="useinform" style="cursor: pointer">&nbsp;Уведомлять о новых ответах</label>
 </div>
 <?php if ($this->_tpl_vars['global_data_list_info']['commentusecaptcha']): ?>
 <div class="typelabel">
 <table cellpadding="0" cellspacing="0" border="0">
 <tr>
  <td align="left" valign="top" style="width: 300px">
  <div class="typelabel"><label id="red">*</label> Код с изображения</div>
  <div><input type="text" class="inpt" style="width: 300px" name="restcode" id="restcode"></div>
  </td>
  <td align="left" valign="bottom" style="width: 66px">
   <img class="captcha_img" src="<?php echo @W_SITEPATH; ?>
img/cptch.php?tim=t&ln=DDDDDD&br=FFFFFF&bg=FFFFFF&h=23">
  </td>
 </tr>
 </table>
 </div>
 <?php endif; ?>
 
 <div class="typelabel" style="margin-top: 15px">
  <input type="submit" value="&nbsp;Добавить комментарий&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp;
  <input type="submit" value="&nbsp;Предварительный просмотр&nbsp;" class="button" name="rbp" id="rbp" onclick="SetActionIdent(0)">
 </div>
 
 <input type="hidden" value="prev" name="actionnewprvmail">
 <input type="hidden" value="do" name="actionthissectionpost">
 
 </form>
 <?php else: ?>
 <div style="font-size: 95%">Пожалуйста, авторизируйтесь, для возможности добавить комментарий..</div>
 <?php endif; ?> 
 </div> 	
</div>  
<!-- comments end -->