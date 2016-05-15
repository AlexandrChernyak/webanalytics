{if $activate_result === false || $activate_result}
{literal}
 <script type="text/javascript">
  function DoActivateForm(th) {
   RestInp(th.scode);	
   if (th.scode.value == '') {
    th.scode.focus();
    alert('Укажите код активации!');
    return false;	
   }
   RestInp(th.actcode);	
   if (th.actcode.value == '') {
    th.actcode.focus();
    alert('Укажите текст с изображения!');
    return false;	
   }
   return true;	
  }
  function RestInp(th) {
   if (th.value == '') {
    th.className = 'inpt_r';
    return ;	
   }
   th.className = 'inpt';	
  }	
 </script>
{/literal}
{/if}
<div style="margin-top: 5px">
{if $activate_result === false || $activate_result}
<form method="post" name="regform" id="regform" onsubmit="return DoActivateForm(this)">
 <div class="typelabel"><label id="red">*</label> Ваш код активации</div>
 <div><input type="text" class="inpt" style="width: 300px" name="scode" id="scode" 
 onclick="RestInp(this)" onblur="RestInp(this)" value="{$CONTROL_OBJ->GetPostElement('scode', 'activeact')}" 
 maxlength="32"></div>
 <div>
 <table cellpadding="0" cellspacing="0" border="0">
 <tr>
  <td align="left" valign="top" style="width: 300px">
  <div class="typelabel"><label id="red">*</label> Код с изображения</div>
  <div><input type="text" class="inpt" style="width: 300px" name="actcode" id="actcode" 
  onclick="RestInp(this)" onblur="RestInp(this)"></div>
  </td>
  <td align="left" valign="bottom" style="width: 66px">
   <img class="captcha_img" src="{$smarty.const.W_SITEPATH}img/cptch.php?tim=w&ln=DDDDDD&br=FFFFFF&bg=FFFFFF&h=23">
  </td>
 </tr>
 </table>
 </div>
 <div class="typelabel">
 <input type="submit" value="&nbsp;Активировать&nbsp;" class="button" name="rb" id="rb">
 </div>
 <input type="hidden" value="do" name="activeact">
</form>
{/if}
<div style="margin-top: 12px">
 {if $activate_result !== false}
  {if $activate_result}
   <div id="red" style="font-weight: bold">{$activate_result}</div>
  {else}
   <div style="color: #008000">
   Регистрация успешно подтверждена! Используйте Ваши логин и пароль для входа в личный кабинет.
   </div>
  {/if}  
 {/if}
</div>
</div>