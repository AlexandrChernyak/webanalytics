{if $restore_result === false || ($restore_result && $CONTROL_OBJ->substr($restore_result,0,1) != 2)}
{literal}
 <script type="text/javascript">
  function DoRestoreForm(th) {	
  RestInp(th.restmail);	
  if (th.restmail.value == '') {
   th.restmail.focus();
   alert('Укажите логин или e-mail!');
   return false;	
  }
  RestInp(th.restpass, 3);
  RestInp(th.restpass2,2);
  if (th.restpass.value == '' || th.restpass2.value == '' || th.restpass.value != th.restpass2.value) {
   if (th.restpass.value == '') {
	th.restpass.focus();
	alert('Укажите пароль!');
   } 
   else if (th.restpass2.value == '') {
	th.restpass2.focus();
	alert('Повторите пароль!');
   } else {
	th.restpass2.focus();
	alert('Пароли не совпадают!!');	
   }
   return false;	
  }
  RestInp(th.restcode);
  if (th.restcode.value == '') {
   th.restcode.focus();
   alert('Укажите текст с изображения!');
   return false;	
  }
  return true;  	
 }
 function RestInp(th,n) {
  if (n == 2 && (th.value != $('#restpass').val())) {
   th.className = 'inpt_r';
   return ;   	
  }
  if (n == 3 && (th.value != $('#restpass2').val())) {
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
{if $restore_result === false || ($restore_result && $CONTROL_OBJ->substr($restore_result,0,1) != 2)}
<form method="post" name="regform" id="regform" onsubmit="return DoRestoreForm(this)">
 <div class="typelabel"><label id="red">*</label> Укажите логин или e-mail</div>
 <div>
 <input type="text" class="inpt" style="width: 300px" name="restmail" id="restmail" 
 onclick="RestInp(this)" onblur="RestInp(this)" value="{$CONTROL_OBJ->GetPostElement('restmail', 'restaction')}">
 </div>
 <div class="typelabel"><label id="red">*</label> Новый пароль</div>
 <div><input type="password" class="inpt" style="width: 300px" name="restpass" id="restpass" onclick="RestInp(this)" 
 onblur="RestInp(this,3)"></div>
 <div class="typelabel"><label id="red">*</label> Повторите пароль</div>
 <div><input type="password" class="inpt" style="width: 300px" name="restpass2" id="restpass2" 
 onclick="RestInp(this)" onblur="RestInp(this,2)"></div> 
 <div>
 <table cellpadding="0" cellspacing="0" border="0">
 <tr>
  <td align="left" valign="top" style="width: 300px">
  <div class="typelabel"><label id="red">*</label> Код с изображения</div>
  <div><input type="text" class="inpt" style="width: 300px" name="restcode" id="restcode" 
  onclick="RestInp(this)" onblur="RestInp(this)"></div>
  </td>
  <td align="left" valign="bottom" style="width: 66px">
   <img class="captcha_img" src="{$smarty.const.W_SITEPATH}img/cptch.php?tim=e&ln=DDDDDD&br=FFFFFF&bg=FFFFFF&h=23">
  </td>
 </tr>
 </table>
 </div>
 <div class="typelabel">
 <input type="submit" value="&nbsp;Отправить&nbsp;" class="button" name="rb" id="rb">
 </div>
 <input type="hidden" value="do" name="restaction">
</form>
{/if}
<div style="margin-top: 12px">
 {if $restore_result !== false}
  {if $restore_result}
   {if $CONTROL_OBJ->substr($restore_result,0,1) == 2}
    <div style="color: #008000">{$CONTROL_OBJ->substr($restore_result,1)}</div>
   {else}
    <div id="red" style="font-weight: bold">{$restore_result}</div>
   {/if} 
  {else}
   <div style="color: #008000">
   На указанный при регистрации e-mail высланы инструкции по активации нового пароля! Пожалуйста, проверьте почту!
   </div>
  {/if}  
 {/if}
</div>
</div>