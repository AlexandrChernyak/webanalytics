{literal}
<script type="text/javascript">
 function DoSendFeedBackForm(th) {	
  RestInp(th.yname);	
  if (th.yname.value == '') {
   th.yname.focus();
   alert('Enter Your Name!');
   return false;	
  }
  RestInp(th.ymail,1);
  if (!emailCheck(th.ymail.value)) {
   th.ymail.focus();
   alert('Enter a valid e-mail!');
   return false;	
  }
  RestInp(th.ytitle);	
  if (th.ytitle.value == '') {
   th.ytitle.focus();
   alert('Enter the subject of the message!');
   return false;	
  }  
  if (th.ymessage.value == '') {
   th.ymessage.focus();
   alert('Enter your message!');
   return false;	
  }
  RestInp(th.yegcode);
  if (th.yegcode.value == '') {
   th.yegcode.focus();
   alert('Enter text from image!');
   return false;	
  }
  $('#globalbodydata').css('cursor', 'wait');
  th.rb.disabled = true;
  return true;  	
 }//DoSendFeedBackForm
 
 function RestInp(th,n) {
  if (n == 1 && !emailCheck(th.value)) {
   th.className = 'inpt_r';
   return ;   	
  }
  if (!n && (th.value == '')) {
   th.className = 'inpt_r';
   return ;	
  }
  th.className = 'inpt';	
 }//RestInp 	
</script>
{/literal}
<div style="margin-top: 5px">
<form method="post" name="regform" id="regform" onsubmit="return DoSendFeedBackForm(this)">

 <div class="typelabel"><label id="red">*</label> Your name</div>
 <div><input type="text" class="inpt" style="width: 95%" name="yname" id="yname" maxlength="99" value="{$CONTROL_OBJ->GetPostElement('yname', 'actfeedback')}" onclick="RestInp(this)" onblur="RestInp(this)"></div>
 
 <div class="typelabel"><label id="red">*</label> Your E-mail</div>
 <div><input type="text" class="inpt" style="width: 95%" name="ymail" id="ymail" value="{$CONTROL_OBJ->GetPostElement('ymail', 'actfeedback')}" onclick="RestInp(this)" onblur="RestInp(this,1)"></div>
 
 <div class="typelabel"><label id="red">*</label> Subject</div>
 <div><input type="text" class="inpt" style="width: 95%" name="ytitle" id="ytitle" maxlength="99" value="{$CONTROL_OBJ->GetPostElement('ytitle', 'actfeedback')}" onclick="RestInp(this)" onblur="RestInp(this)"></div>
 
 <div class="typelabel"><label id="red">*</label> Message Text</div>
  <div>
   <textarea class="int_text" style="height: 200px; width: 95%" name="ymessage" id="ymessage">{$CONTROL_OBJ->GetPostElement('ymessage', 'actfeedback')}</textarea>
  </div>
 
 <div>
 <table cellpadding="0" cellspacing="0" border="0">
 <tr>
  <td align="left" valign="top" style="width: 300px">
  <div class="typelabel"><label id="red">*</label> Check code from Image</div>
  <div><input type="text" class="inpt" style="width: 300px" name="yegcode" id="yegcode" onclick="RestInp(this)" onblur="RestInp(this)"></div>
  </td>
  <td align="left" valign="bottom" style="width: 66px">
   <img class="captcha_img" src="{$smarty.const.W_SITEPATH}img/cptch.php?tim=y&ln=DDDDDD&br=FFFFFF&bg=FFFFFF&h=23">
  </td>
 </tr>
 </table>
 </div>
 <div class="typelabel">
 <input type="submit" value="&nbsp;Send&nbsp;" class="button" name="rb" id="rb">
 </div>
 <input type="hidden" value="do" name="actfeedback">
</form>
<div style="margin-top: 12px">
 {if $feedback_result !== false}
  {if $feedback_result}
   <div id="red">{$feedback_result}</div>
  {else}
   <div style="color: #008000">Thank you! Your message has been sent!</div>
  {/if}  
 {/if}
</div>
</div>