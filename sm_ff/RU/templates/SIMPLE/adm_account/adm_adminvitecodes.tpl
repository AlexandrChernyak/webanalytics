{* инвайт коды *}
<div style="margin-top: 4px">

<div style="margin: 4px 2px 8px 0px">
 <select size="1" name="selinvtt" id="selinvtt" onchange="ActionToPath(this)">
	<option value=""{if !$smarty.get.selinvtt} selected="selected"{/if}>Все коды</option>
	<option value="0"{if $smarty.get.selinvtt == '0'} selected="selected"{/if}>Только при регистрации</option>
	<option value="1"{if $smarty.get.selinvtt == '1'} selected="selected"{/if}>Только из кабинета</option>
	<option value="2"{if $smarty.get.selinvtt == '2'} selected="selected"{/if}>При регистрации и в кабинете</option>
</select>
</div>

{literal}
<script type="text/javascript">
  function ActionToPath(th) {
    var ppw = '{/literal}{$smarty.const.W_SITEPATH}{literal}account/adminvitecodes/';
    {/literal}
    
    {if $smarty.get.new} 
      ppw = ppw + '&new=1';  
    {/if}    
    {literal} 
    
    if (th.value != '') {
     ppw = ppw + '&selinvtt=' + th.value;
    }     
    
    document.location = ppw;    
  }//ActionToPath	
</script>
{/literal}

<div>
<a href="{$smarty.const.W_SITEPATH}account/adminvitecodes&new=1{if $smarty.get.selinvtt != ''}&selinvtt={$smarty.get.selinvtt}{/if}"{if $smarty.get.new} style="color: #000000"{/if}>Создать инвайт коды</a> | 
<a href="{$smarty.const.W_SITEPATH}account/adminvitecodes/{if $smarty.get.selinvtt != ''}?selinvtt={$smarty.get.selinvtt}{/if}"{if !$smarty.get.new} style="color: #000000"{/if}>Список инвайт кодов (<label style="color: #000000">{$global_invite_code_count}</label>)</a>
</div>
<div style="margin-top: 12px">
{if !$smarty.get.new}
{* список инвайт кодов *}
{literal}
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = {/literal}{if !$global_invite_code_count}0{else}1{/if};{literal}  
 function DoHigl(th, n, p) {	
  if (n) {	$(th).css('background','#F9FAFB'); } else {
   var ch = document.getElementById('chid'+p);
   var color = (ch && ch.checked) ? '#E1E2E0' : 'none';   	
   $(th).css('background', color);		
  }	
 }//DoHigl
 function CheckItem(itemid, th) {
  th = (th) ? th : document.getElementById('chid'+itemid);   
  if (th && th.checked) { $('#t_r_'+itemid).css('background','#E1E2E0'); } else {
  $('#t_r_'+itemid).css('background','none');
  }
  SetEnabled();   	
 }//CheckItem
 function CheckAll(th) {	
  for (var i=0; i < list_items.length; i++) {
   var ch = $('#chid'+list_items[i]);
   ch.attr('checked', (th.checked) ? 'checked' : '');
   if (th.checked) { $('#t_r_'+list_items[i]).css('background','#E1E2E0'); } else {
   $('#t_r_'+list_items[i]).css('background','none');	
  }	  	    	
  }
  SetEnabled();	
 }//CheckAll
 function GetSelCount() {
  var inccount = 0;
  for (var i=0; i < list_items.length; i++) {
   var ch = document.getElementById('chid'+list_items[i]);
   if (ch && ch.checked) { inccount++; }		
  }	
  return inccount;	
 }//GetSelCount 
 function PrepereSend(th) {
  var count = GetSelCount();
  if (count <= 0 && th.actionlistinvitecode.value != 'all' && th.actionlistinvitecode.value != 'dall') { 
   alert('Выделите хотя бы один инвайт код!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistinvitecode.value == 'delete') {
   if (!confirm('Вы действительно хотите удалить ['+count+'] инвайт кодов?')) { return false; }
  } else if (th.actionlistinvitecode.value == 'save') {
   if (!confirm('Вы действительно хотите сохранить в файл ['+count+'] инвайт кодов?')) { return false; }	
  } else if (th.actionlistinvitecode.value == 'all') {
   if (!allsaveenabled) { alert('Нет данных для экспорта!'); return false; }	
   if (!confirm('Вы действительно хотите сохранить в файл все инвайт коды?')) { return false; }
  } else if (th.actionlistinvitecode.value == 'dall') {
   if (!allsaveenabled) { alert('Нет данных для удаления!'); return false; }	
   if (!confirm('Вы действительно хотите удалить все инвайт коды?')) { return false; }	
  } else { alert('Неизвестный идентификатор операции!'); return false; }
  return true;   	
 }//PrepereSend
 function SetEnabled() {  	
  var count = GetSelCount();
  setElementOpacity(document.getElementById('asid'), (allsaveenabled) ? 1 : 0.3);
  setElementOpacity(document.getElementById('adid'), (allsaveenabled) ? 1 : 0.3);
  if (count <= 0) {
   setElementOpacity(document.getElementById('did'), 0.3);
   setElementOpacity(document.getElementById('sid'), 0.3);
   return ;	 
  }
  setElementOpacity(document.getElementById('did'), 1);
  setElementOpacity(document.getElementById('sid'), 1);
 }//SetEnabled
 function SetActionP(a) {
  var f = document.getElementById('inviteform');
  if (!f) { return ; }
  f.actionlistinvitecode.value = a;   	
 }//SetActionP    	
</script>
<style type="text/css">
  .h_th1, .h_td, .h_td2 { 
   border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E3E4E8; border-left: none; }
  .btn_n { border: 1px solid #E3E4E8; border-top: none; height: 25px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E3E4E8; height: 25px; border-top: none; }	
 </style>
{/literal} 
<form method="post" name="inviteform" id="inviteform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Удалить все коды&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 140px;">
 </span>
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Экспорт выбранных в .txt&nbsp;" class="saveselectlist" name="sid" id="sid" onclick="SetActionP('save')" style="//width: 180px;">
 </span>
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Экспорт всех кодов в .txt&nbsp;" class="saveselectlist" name="asid" id="asid" onclick="SetActionP('all')">
 </span>
 </div>
 <div style="margin-top: 6px">
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <td class="h_th1" valign="center" align="left" width="20px">
	 <span style="margin-left: 4px">
	  <input type="checkbox" name="checkallinvites" id="checkallinvites" style="cursor: pointer" onclick="CheckAll(this)">
	 </span>
	</td>
	<td class="h_td" valign="center" align="left" width="120px"><span style="margin-left: 3px">Инвайт код</span></td>
	<td class="h_td" valign="center" align="center" width="100px">Сумма</td>		
	<td class="h_td" valign="center" align="left">Надстройки</td>
	<td class="h_td2" valign="center" align="center" width="130px">Дата</td>
   </tr>	
   {if $global_invite_list_info && $global_invite_list_info.source}
	{foreach from=$global_invite_list_info.source item=val name=val}
	 <tr onmouseover="DoHigl(this, 1, {$smarty.foreach.val.index})" onmouseout="DoHigl(this, 0, {$smarty.foreach.val.index})" id="t_r_{$smarty.foreach.val.index}">
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8">
	  <span style="margin-left: 4px">
	   <input type="checkbox" name="chid{$smarty.foreach.val.index}" id="chid{$smarty.foreach.val.index}" 
	   style="cursor: pointer" onclick="CheckItem('{$smarty.foreach.val.index}', this)">
	  </span>
	 </td>
	 <td class="sth1" valign="center" align="left" width="120px" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	  <span style="margin-left: 3px">{$val.invcode}</span>	 
	 </td>
	 <td class="sth1" valign="center" align="center" style="padding-left: 4px" width="100px" 
	 onclick="$('#chid{$smarty.foreach.val.index}').click()">
	 {if $val.sumdata <= 0.00}
	  <label style="background: #FEE1E0">{$val.sumdata} USD</label>
	 {else}	 
	  {$val.sumdata} USD
	 {/if}
	 </td>
	 <td class="sth1" valign="center" align="left" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	 {if $CONTROL_OBJ->ReadOption('INDEXSITE', $val.invopt)}
	  INDEXSITE	  
	 {else}
	  <i>(нет)</i>
	 {/if}	 	 	 
	 </td>
	 <td class="sth1" valign="center" align="center" width="130px" style="border-right: 1px solid #E3E4E8;" 
	 onclick="$('#chid{$smarty.foreach.val.index}').click()">
	 {$val.dateadd}
	 </td>
    </tr>  
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.iditem}" name="idm{$smarty.foreach.val.index}">
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="5">
     Нет активных инвайт кодов!
     <script type="text/javascript">
	  document.getElementById('checkallinvites').disabled = true;
     </script>
    </td>
   </tr> 
   {/if} 
 </table>
 {if $global_invite_list_info && $global_invite_list_info.source}
 <div style="text-align: right; margin-top: 10px">{$global_invite_list_info.pagestext}</div>
 {/if} 
 </span>
 </div> 
 <input type="hidden" value="0" name="actioncountmess">
 <input type="hidden" value="none" name="actionlistinvitecode"> 
</form>
<script type="text/javascript">SetEnabled();</script>
{else}
 {* добавление кодов *}
 {literal}
 <script type="text/javascript">
  function RestInp(th,n) {
   if (n == 1) {
    if (!IisInteger(th.value) || th.value <= 0 || th.value > 50) {
	 th.className = 'inpt_r';
	 return ;	
	}    	
   } else {
    if (!IsFloat(th.value)) {
	 th.className = 'inpt_r';
	 return ;	
	}	
   }
   th.className = 'inpt';	
  }//RestInp
  function PrepereSend(th) {
   RestInp(th.invcount, 1);
   RestInp(th.invprice, 0);	
   if (!IisInteger(th.invcount.value) || th.invcount.value <= 0 || th.invcount.value > 50) {
	alert('Укажите количество создаваемых кодов целым числовым значением, не более 50 и не менее 1!');
	th.invcount.focus();
	return false;	
   }
   if (!IsFloat(th.invprice.value)) {
	alert('Укажите сумму для зачисления при регистрации в формате: 0.00! Если зачислений нет - установите в 0.00!');
	th.invprice.focus();
	return false;	
   }
   return true;   	
  }//PrepereSend	
 </script>
 {/literal}
 <form method="post" name="inviteformadd" id="inviteformadd" onsubmit="return PrepereSend(this)">
  <div class="typelabel"><label id="red">*</label> Создать количество кодов (максимально за раз - 50)</div>
  <div><input type="text" class="inpt" style="width: 320px" name="invcount" id="invcount" value="{$CONTROL_OBJ->GetPostElement('invcount', 'inviteactionnew', 'do', 5)}" onclick="RestInp(this,1)" onblur="RestInp(this,1)" maxlength="10"></div>
  
  <div class="typelabel"><label id="red">*</label> Сумма, зачисляемая на счет при регистрации</div>
  <div><input type="text" class="inpt" style="width: 320px" name="invprice" id="invprice" value="{$CONTROL_OBJ->GetPostElement('invprice', 'inviteactionnew', 'do', '0.00')}" onclick="RestInp(this,0)" onblur="RestInp(this,0)" maxlength="10"></div>
  
 <div class="typelabel">
 <input type="checkbox" style="cursor: pointer" name="invindexsite" id="invindexsite"{if $CONTROL_OBJ->CheckPostValue('invindexsite')} checked="checked"{/if}>
 <label for="invindexsite" style="cursor: pointer"> Включить индексацию сайта поисковиками на странице аккаунта (опция INDEXSITE)</label>
 </div>
  
 <input type="hidden" value="do" name="inviteactionnew">
 <div class="typelabel"><input type="submit" value="&nbsp;Создать код(ы)&nbsp;" class="button" name="rb" id="rb"></div>
 </form>
 {if $err_str_inv}
 <div style="margin-top: 8px">
  {if $err_str_inv != 1}
   <label style="color: #FF0000">{$err_str_inv}</label>
  {else}
   <label style="color: #008000">Инвайт код(ы) успешно созданы!</label>
  {/if}
 </div>
 {/if}
{/if}
</div>
</div>