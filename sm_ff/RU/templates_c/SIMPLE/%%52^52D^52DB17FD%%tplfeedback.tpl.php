<?php /* Smarty version 2.6.26, created on 2013-11-14 13:10:48
         compiled from tplfeedback.tpl */ ?>
<?php echo '
<script type="text/javascript">
 function DoSendFeedBackForm(th) {	
  RestInp(th.yname);	
  if (th.yname.value == \'\') {
   th.yname.focus();
   alert(\'Укажите Ваше имя!\');
   return false;	
  }
  RestInp(th.ymail,1);
  if (!emailCheck(th.ymail.value)) {
   th.ymail.focus();
   alert(\'Укажите корректный e-mail!\');
   return false;	
  }
  RestInp(th.ytitle);	
  if (th.ytitle.value == \'\') {
   th.ytitle.focus();
   alert(\'Укажите тему сообщения!\');
   return false;	
  }  
  if (th.ymessage.value == \'\') {
   th.ymessage.focus();
   alert(\'Укажите текст сообщения!\');
   return false;	
  }
  RestInp(th.yegcode);
  if (th.yegcode.value == \'\') {
   th.yegcode.focus();
   alert(\'Укажите текст с изображения!\');
   return false;	
  }
  $(\'#globalbodydata\').css(\'cursor\', \'wait\');
  th.rb.disabled = true;
  return true;  	
 }//DoSendFeedBackForm
 
 function RestInp(th,n) {
  if (n == 1 && !emailCheck(th.value)) {
   th.className = \'inpt_r\';
   return ;   	
  }
  if (!n && (th.value == \'\')) {
   th.className = \'inpt_r\';
   return ;	
  }
  th.className = \'inpt\';	
 }//RestInp 	
</script>
'; ?>

<div style="margin-top: 5px">
<form method="post" name="regform" id="regform" onsubmit="return DoSendFeedBackForm(this)">

 <div class="typelabel"><label id="red">*</label> Ваше имя</div>
 <div><input type="text" class="inpt" style="width: 95%" name="yname" id="yname" maxlength="99" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('yname','actfeedback'); ?>
" onclick="RestInp(this)" onblur="RestInp(this)"></div>
 
 <div class="typelabel"><label id="red">*</label> Ваш E-mail</div>
 <div><input type="text" class="inpt" style="width: 95%" name="ymail" id="ymail" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('ymail','actfeedback'); ?>
" onclick="RestInp(this)" onblur="RestInp(this,1)"></div>
 
 <div class="typelabel"><label id="red">*</label> Тема</div>
 <div><input type="text" class="inpt" style="width: 95%" name="ytitle" id="ytitle" maxlength="99" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('ytitle','actfeedback'); ?>
" onclick="RestInp(this)" onblur="RestInp(this)"></div>
 
 <div class="typelabel"><label id="red">*</label> Текст сообщения</div>
  <div>
   <textarea class="int_text" style="height: 200px; width: 95%" name="ymessage" id="ymessage"><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('ymessage','actfeedback'); ?>
</textarea>
  </div>
 
 <div>
 <table cellpadding="0" cellspacing="0" border="0">
 <tr>
  <td align="left" valign="top" style="width: 300px">
  <div class="typelabel"><label id="red">*</label> Код с изображения</div>
  <div><input type="text" class="inpt" style="width: 300px" name="yegcode" id="yegcode" onclick="RestInp(this)" onblur="RestInp(this)"></div>
  </td>
  <td align="left" valign="bottom" style="width: 66px">
   <img class="captcha_img" src="<?php echo @W_SITEPATH; ?>
img/cptch.php?tim=y&ln=DDDDDD&br=FFFFFF&bg=FFFFFF&h=23">
  </td>
 </tr>
 </table>
 </div>
 <div class="typelabel">
 <input type="submit" value="&nbsp;Отправить&nbsp;" class="button" name="rb" id="rb">
 </div>
 <input type="hidden" value="do" name="actfeedback">
</form>
<div style="margin-top: 12px">
 <?php if ($this->_tpl_vars['feedback_result'] !== false): ?>
  <?php if ($this->_tpl_vars['feedback_result']): ?>
   <div id="red"><?php echo $this->_tpl_vars['feedback_result']; ?>
</div>
  <?php else: ?>
   <div style="color: #008000">Спасибо! Ваше сообщение успешно отправлено!</div>
  <?php endif; ?>  
 <?php endif; ?>
</div>
</div>