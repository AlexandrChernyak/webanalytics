<?php /* Smarty version 2.6.26, created on 2016-05-15 09:09:02
         compiled from account/new_mail.tpl */ ?>
<?php echo '
 <script type="text/javascript"> 
  function SetActionIdent(n) {	
   document.getElementById(\'newprivatemail\').actionnewprvmail.value = (n) ? \'act\' : \'prev\';	
  }//SetActionIdent
  function SendMessageAction(th) {
   if (th.userstitle.value == \'\') {
	if (!confirm(\'Тема не указана! Вы хотите отправить сообщение без темы?\')) {
	 th.userstitle.focus();	
	 return false;
	}
	th.userstitle.value = \'Без темы\';	
   }
   if (th.userstext.value == \'\') {
	alert(\'Укажите текст сообщения!\');
	th.userstext.focus();
	return false;
   }
   return true;   	
  }//SendMessageAction  	
 </script>
'; ?>

<div>
 <div>
  <?php if ($_POST['actionnewprvmail'] == 'prev'): ?>
  <div style="padding: 4px; border: 1px solid #775D41; margin-bottom: 20px; width: 95%;">
   <?php echo $this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextFromDB($this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextToDB($_POST['userstext'])); ?>
  
  </div>
  <?php endif; ?> 
 </div>
 <form method="post" name="newprivatemail" id="newprivatemail" onsubmit="return SendMessageAction(this)">
  <div class="typelabel"><label id="red">*</label> Кому (разделитель "<u>точка с запятой</u>")</div>
  <div><textarea style="width: 95%; height: 35px" class="int_text" name="userslist" 
  id="userslist"><?php if (! $_POST['actionnewprvmail'] && $_GET['tousers']): ?><?php echo $_GET['tousers']; ?>
<?php else: ?><?php if ($_POST['actionnewprvmail']): ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('userslist','actionnewprvmail',$_POST['actionnewprvmail']); ?>
<?php else: ?>admin; <?php endif; ?><?php endif; ?></textarea></div>
  <div class="typelabel">Тема</div>
  <div><input type="text" style="width: 95%" class="inpt" name="userstitle" id="userstitle" 
  value="<?php if ($_POST['actionnewprvmail']): ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('userstitle','actionnewprvmail',$_POST['actionnewprvmail']); ?>
<?php endif; ?>"></div>
  <div class="typelabel"><label id="red">*</label> Текст сообщения</div>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'new_message.tpl', 'smarty_include_vars' => array('ident' => 'userstext','source' => $_POST['userstext'],'height' => '220px','width' => '95%')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <div class="typelabel">
   <input type="submit" value="&nbsp;Отправить&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp;
   <input type="submit" value="&nbsp;Предварительный просмотр&nbsp;" class="button" name="rb" id="rb" 
   onclick="SetActionIdent(0)">
  </div>  
  <input type="hidden" value="prev" name="actionnewprvmail">
 </form>
 <?php if (isset ( $this->_tpl_vars['errornewmessage'] ) && $this->_tpl_vars['errornewmessage']): ?><div id="red" style="margin-top: 12px"><?php echo $this->_tpl_vars['errornewmessage']; ?>
</div><?php endif; ?>
</div>