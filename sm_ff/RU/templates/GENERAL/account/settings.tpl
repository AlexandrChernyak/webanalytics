{literal}
 <script type="text/javascript">
  function DoDeleteAvatar(n) {
   var f = document.getElementById('avatarload');	
   f.avtaction.value = (n) ? 'delete' : 'load';
   if (n) { f.avedit.value = ''; }   	
  }//DoDeleteAvatar
  
  function RestInp(th,n) {
  if (n == 1 && !emailCheck(th.value)) {
   th.className = 'inpt_r';
   return ;   	
  }
  if (n == 2 && (th.value != $('#setpass').val())) {
   th.className = 'inpt_r';
   return ;   	
  }
  if (n == 3 && (th.value != $('#setpass2').val())) {
   th.className = 'inpt_r';
   return ;   	
  }
  if (!n && (th.value == '')) {
   th.className = 'inpt_r';
   return ;	
  }
  th.className = 'inpt';	
 }//RestInp
 
 function DoSendGeneralSettingsInfo(th) {
  RestInp(th.setmail,1);
  if (!emailCheck(th.setmail.value)) {
   th.setmail.focus();
   alert('Укажите корректный e-mail!');
   return false;	
  }
  if (th.setpass.value != '' || th.setpass2.value != '') {
   RestInp(th.setpass, 3);
   RestInp(th.setpass2,2);
   if (th.setpass.value == '' || th.setpass2.value == '' || th.setpass.value != th.setpass2.value) {
    if (th.setpass.value == '') {
	 th.setpass.focus();
	 alert('Укажите пароль!');
    } 
    else if (th.setpass2.value == '') {
	 th.setpass2.focus();
	 alert('Повторите пароль!');
    } else {
	 th.setpass2.focus();
	 alert('Пароли не совпадают!!');	
    }
    return false;	
   }
  }
  RestInp(th.lastpass);
  if (th.lastpass.value == '') {
   th.lastpass.focus();
   alert('Укажите старый пароль!');
   return false;	
  }    
  return true;	
 }//DoSendGeneralSettingsInfo  	
 function CheckAdditionalOptions(th) {
  if (th.payindexsite && th.payindexsite.checked) {
   if (!confirm("Вы выбрали активацию индексации сайта на странице информации Вашего аккаунта! Данная опция платная.\r\nВы действительно хотите продолжить?")) { return false; }  
  }
  return true;	
 }//CheckAdditionalOptions	  	
 </script>
{/literal}

<!-- avatar info begin -->
<div class="title_sub_rzd"><b>Аватар</b></div>
<div>
<span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
 <tr>
	<td valign="top" align="left" style="width: 110px">
	 <img width="99" height="99" 
	 src="{$smarty.const.W_SITEPATH}{$smarty.const.W_FILESWEBPATH}/images/{$global_user_info.avatar}"> 
	</td>
	<td valign="top" align="left">
	 <div>Выберите файл для загрузки</div>
	 <div style="margin-top: 6px">
	  <form method="post" name="avatarload" id="avatarload" enctype="multipart/form-data">
       <div><input type="file" size="20" style="width: 320px; height: 22px" class="inpt" name="avedit" id="avedit"></div>
       <div class="typelabel">
	    <input type="submit" value="&nbsp;Сохранить&nbsp;" class="button" name="rb" id="rb" onclick="DoDeleteAvatar(0)">
		&nbsp;
	    <input type="submit" value="&nbsp;Удалить&nbsp;" class="button" name="rb" id="rb" onclick="DoDeleteAvatar(1)">
	   </div>
	   <input type="hidden" value="load" name="avtaction">
      </form>	  
	 </div>
	 <div style="margin-top: 3px; color: #008000">{$account_options_result.avatar}</div>
	</td>
 </tr>
 </table>
</span>
</div>
<!-- avatar info end -->

<!-- general info begin -->
<div class="title_sub_rzd" style="margin-top: 15px"><b>Личные настройки</b></div>
<div>
 <form method="post" name="generalsettings" id="generalsettings" onsubmit="return DoSendGeneralSettingsInfo(this)">
  <div class="typelabel"><label id="red">*</label> E-mail</div>
  <div><input type="text" class="inpt" style="width: 320px" name="setmail" id="setmail" 
 value="{$CONTROL_OBJ->userdata.useremail}" onclick="RestInp(this,1)" onblur="RestInp(this,1)" maxlength="149"></div>
  <div class="typelabel">Сайт</div>
  <div><input type="text" class="inpt" style="width: 320px" name="seturl" id="seturl" 
 value="{$CONTROL_OBJ->userdata.usersite}" onclick="RestInp(this)" onblur="RestInp(this)" maxlength="199"></div> 
  <div class="typelabel">Новый пароль</div>
  <div><input type="password" class="inpt" style="width: 320px" name="setpass" id="setpass" 
  onclick="RestInp(this)" onblur="RestInp(this,3)"></div>
  <div class="typelabel">Новый пароль еще раз</div>
  <div><input type="password" class="inpt" style="width: 320px" name="setpass2" id="setpass2" 
  onclick="RestInp(this)" onblur="RestInp(this,2)"></div>
  <div class="typelabel"><label id="red">*</label> Старый пароль</div>
  <div><input type="password" class="inpt" style="width: 320px" name="lastpass" id="lastpass" 
  onclick="RestInp(this)" onblur="RestInp(this)"></div>
  <div class="typelabel">
   <input type="submit" value="&nbsp;Сохранить&nbsp;" class="button" name="rb" id="rb">
  </div>
  <input type="hidden" value="do" name="generalsettingsdata">
  <div style="margin-top: 10px; {if $account_options_result.gensettings && $CONTROL_OBJ->substr($account_options_result.gensettings, 0, 1) == '2'}color: #008000{else}color: #FF0000{/if}">
  {if $account_options_result.gensettings}
   {if $CONTROL_OBJ->substr($account_options_result.gensettings, 0, 1) == '2'}
    {$CONTROL_OBJ->substr($account_options_result.gensettings, 1)}
   {else}  
    {$account_options_result.gensettings}
   {/if}
  {/if}
  </div>  
 </form> 
</div>
<!-- general info end -->

<!-- general info begin -->
<div class="title_sub_rzd" style="margin-top: 15px"><b>Активация инвайт кода</b></div>
<div>
 <form method="post" name="generalsettings" id="generalsettings">
  <div class="typelabel"><label id="red">*</label> Укажите инвайт код</div>
  <div><input type="text" class="inpt" style="width: 320px" name="invcode" id="invcode"></div>
  <div class="typelabel">
   <input type="submit" value="&nbsp;Применить&nbsp;" class="button" name="rb" id="rb">
  </div> 
  <input type="hidden" value="do" name="invoper" />
  {if $smarty.post.invoper == 'do' && $smarty.post.invcode}
  
   {if $CONTROL_OBJ->ActivateInviteCode($CONTROL_OBJ->userdata.username, $CONTROL_OBJ->CorrectSymplyString($smarty.post.invcode), 1)}
    <div style="margin-top: 5px; color: #008000">Инвайт код успешно активирован!</div>
   {else}
    <div style="margin-top: 5px; color: #FF0000">Инвайт код указан некорректно!</div>   
   {/if}
  
  {/if} 
 </form> 
</div>
<!-- general info end -->

<!-- additional info begin -->
<div class="title_sub_rzd" style="margin-top: 15px"><b>Дополнительные настройки</b></div>
<div>
 <form method="post" name="moreuseroptions" id="moreuseroptions" onsubmit="return CheckAdditionalOptions(this)">
  <div class="typelabel">
   <input type="checkbox"{if $CONTROL_OBJ->ReadOption('SHOWUSMENU')} checked="checked"{/if} 
   style="cursor: pointer" name="shusermenuall" id="shusermenuall">
   <label for="shusermenuall" style="cursor: pointer"> Отображать меню пользователя на всех страницах сайта</label>
  </div>
  <div class="typelabel">
   <input type="checkbox"{if $CONTROL_OBJ->ReadOption('SHOWEMAIL')} checked="checked"{/if} 
   style="cursor: pointer" name="shuseremaili" id="shuseremaili">
   <label for="shuseremaili" style="cursor: pointer"> Отображать мой e-mail в <a href="{$smarty.const.W_SITEPATH}userinfo/{$CONTROL_OBJ->userdata.username}/" target="_blank">информации</a> о пользователе</label>
  </div>
  <div class="typelabel">
   <input type="checkbox"{if $CONTROL_OBJ->ReadOption('SHOWSITE')} checked="checked"{/if} 
   style="cursor: pointer" name="shusersitei" id="shusersitei">
   <label for="shusersitei" style="cursor: pointer"> Отображать мой сайт в <a href="{$smarty.const.W_SITEPATH}userinfo/{$CONTROL_OBJ->userdata.username}/" target="_blank">информации</a> о пользователе{if $CONTROL_OBJ->ReadOption('INDEXSITE')} [ <b>index</b>, <b>follow</b> ]{/if}</label>
  </div>
  {if $smarty.const.W_USERSCANPAYFOREVERINDEXLINK && !$CONTROL_OBJ->ReadOption('INDEXSITE') && $smarty.const.W_USERSCANPAYFOREVERINDEXLINKPRICE > 0}
  <div class="typelabel">
   <input type="checkbox" style="cursor: pointer" name="payindexsite" id="payindexsite">
   <label for="payindexsite" style="cursor: pointer"> Убрать тэг <b>&lt;noindex&gt;</b> и параметр <b>nofollow</b> с сайта навсегда (<b>{$smarty.const.W_USERSCANPAYFOREVERINDEXLINKPRICE} USD</b>)</label>
  </div>  
  {/if}  
  
   
  <div class="typelabel"><input type="submit" value="&nbsp;Сохранить&nbsp;" class="button" name="rb" id="rb"></div>
  <input type="hidden" value="do" name="additionaloptionsact">
  <div style="margin-top: 3px; color: #008000">
  {if $account_options_result.additionalopt}
   {$account_options_result.additionalopt}
  {else}
   {if $smarty.post.additionaloptionsact == 'do'}
    Настройки успешно изменены!
   {/if} 
  {/if}
  </div>
 </form>
</div>
<!-- additional info end -->