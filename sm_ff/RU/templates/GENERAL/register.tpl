{if $register_result === false || $register_result}
{literal}
<script type="text/javascript">
 function DoSendRegForm(th) {	
  RestInp(th.reglogin);	
  if (th.reglogin.value == '') {
   th.reglogin.focus();
   alert('Укажите логин!');
   return false;	
  }
  RestInp(th.regemail,1);
  if (!emailCheck(th.regemail.value)) {
   th.regemail.focus();
   alert('Укажите корректный e-mail!');
   return false;	
  }
  RestInp(th.regpass, 3);
  RestInp(th.regpass2,2);
  if (th.regpass.value == '' || th.regpass2.value == '' || th.regpass.value != th.regpass2.value) {
   if (th.regpass.value == '') {
	th.regpass.focus();
	alert('Укажите пароль!');
   } 
   else if (th.regpass2.value == '') {
	th.regpass2.focus();
	alert('Повторите пароль!');
   } else {
	th.regpass2.focus();
	alert('Пароли не совпадают!!');	
   }
   return false;	
  }
  RestInp(th.regcode);
  if (th.regcode.value == '') {
   th.regcode.focus();
   alert('Укажите текст с изображения!');
   return false;	
  }
  return true;  	
 }
 function RestInp(th,n) {
  if (n == 1 && !emailCheck(th.value)) {
   th.className = 'inpt_r';
   return ;   	
  }
  if (n == 2 && (th.value != $('#regpass').val())) {
   th.className = 'inpt_r';
   return ;   	
  }
  if (n == 3 && (th.value != $('#regpass2').val())) {
   th.className = 'inpt_r';
   return ;   	
  }
  if (!n && (th.value == '')) {
   th.className = 'inpt_r';
   return ;	
  }
  th.className = 'inpt';	
 } 	
</script>
{/literal}
{/if}
<div style="margin-top: 5px">
{if $register_result === false || $register_result}
<form method="post" name="regform" id="regform" onsubmit="return DoSendRegForm(this)">
 <div class="typelabel"><label id="red">*</label> Логин</div>
 <div><input type="text" class="inpt" style="width: 300px" name="reglogin" id="reglogin" maxlength="99"  
 value="{$CONTROL_OBJ->GetPostElement('reglogin')}" onclick="RestInp(this)" onblur="RestInp(this)"></div>
 <div class="typelabel"><label id="red">*</label> E-mail</div>
 <div><input type="text" class="inpt" style="width: 300px" name="regemail" id="regemail" 
 value="{$CONTROL_OBJ->GetPostElement('regemail')}" onclick="RestInp(this)" onblur="RestInp(this,1)"></div>
 <div class="typelabel"><label id="red">*</label> Пароль</div>
 <div><input type="password" class="inpt" style="width: 300px" name="regpass" id="regpass" onclick="RestInp(this)" 
 onblur="RestInp(this,3)"></div>
 <div class="typelabel"><label id="red">*</label> Повторите пароль</div>
 <div><input type="password" class="inpt" style="width: 300px" name="regpass2" id="regpass2" 
 onclick="RestInp(this)" onblur="RestInp(this,2)"></div>
 <div class="typelabel">Сайт (если есть)</div>
 <div><input type="text" class="inpt" style="width: 300px" name="regurl" id="regurl" 
 value="{$CONTROL_OBJ->GetPostElement('regurl')}"></div>
 <div class="typelabel">Пригласительный код (если есть)</div>
 <div><input type="text" class="inpt" style="width: 300px" name="reginvite" id="reginvite" 
 value="{$CONTROL_OBJ->GetPostElement('reginvite')}"></div>
 <div>
 <table cellpadding="0" cellspacing="0" border="0">
 <tr>
  <td align="left" valign="top" style="width: 300px">
  <div class="typelabel"><label id="red">*</label> Код с изображения</div>
  <div><input type="text" class="inpt" style="width: 300px" name="regcode" id="regcode" 
  onclick="RestInp(this)" onblur="RestInp(this)"></div>
  </td>
  <td align="left" valign="bottom" style="width: 66px">
   <img class="captcha_img" src="{$smarty.const.W_SITEPATH}img/cptch.php?tim=q&ln=DCCDBB&br=775D41&h=23">
  </td>
 </tr>
 </table>
 </div>
 <div class="typelabel">
 <input type="submit" value="&nbsp;Зарегистрироваться&nbsp;" class="button" name="rb" id="rb">
 </div>
 <input type="hidden" value="do" name="regaction">
</form>
{/if}
<div style="margin-top: 12px">
 {if $register_result !== false}
  {if $register_result}
   <div id="red" style="font-weight: bold">{$register_result}</div>
  {else}
   <div style="color: #008000">Регистрация успешно завершена!</div>
  {/if}  
 {/if}
</div>
</div>