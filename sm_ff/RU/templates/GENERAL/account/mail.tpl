{literal}
 <script type="text/javascript">
  var list_items = new Array();   
  function DoHigl(th, n, p) {	
   if (n) {	$(th).css('background','#F8F5F1'); } else {
   	var ch = document.getElementById('chid'+p);
   	var color = (ch && ch.checked) ? '#E7DDD1' : 'none';   	
    $(th).css('background', color);		
   }	
  }//DoHigl
  function CheckItem(itemid, th) {
   th = (th) ? th : document.getElementById('chid'+itemid);   
   if (th && th.checked) { $('#t_r_'+itemid).css('background','#E7DDD1'); } else {
	$('#t_r_'+itemid).css('background','none');
   }
   SetEnabled();   	
  }//CheckItem
  function CheckAll(th) {	
   for (var i=0; i < list_items.length; i++) {
  	var ch = $('#chid'+list_items[i]);
	ch.attr('checked', (th.checked) ? 'checked' : '');
	if (th.checked) { $('#t_r_'+list_items[i]).css('background','#E7DDD1'); } else {
	 $('#t_r_'+list_items[i]).css('background','none');	
	}	  	    	
   }
   SetEnabled();	
  }//CheckAll
  {/literal}
  {if !$smarty.get.send}
  {literal}
  function GetSelCount() {
   var inccount = 0;
   for (var i=0; i < list_items.length; i++) {
    var ch = document.getElementById('chid'+list_items[i]);
    if (ch && ch.checked) { inccount++; }		
   }	
   return inccount;	
  }//GetSelCount 
  function SetActionP(a) {
   var f = document.getElementById('messageslistform');
   if (!f) { return ; }
   f.actionmailslist.value = a;   	
  }//SetActionP
  function PrepereSend(th) {
   var count = GetSelCount();
   if (count <= 0) { alert('Выделите хотя бы одно сообщение!'); return false; }
   th.actioncountmess.value = count;
   if (th.actionmailslist.value == 'delete') {
	if (!confirm('Вы действительно хотите удалить ['+count+'] сообщений?')) { return false; }
   } else if (th.actionmailslist.value == 'read') {
	if (!confirm('Вы действительно хотите пометить прочтенным ['+count+'] сообщений?')) { return false; }
   } else { alert('Операция не определена! Возможно в Вашем браузере отключен JavaScript!'); return false; }
   return true;   	
  }//PrepereSend
  function SetEnabled() {
	var count = GetSelCount();
	if (count <= 0) {
	 setElementOpacity(document.getElementById('did'), 0.3);
	 setElementOpacity(document.getElementById('rid'), 0.3);
	 return ;	
	}
	setElementOpacity(document.getElementById('did'), 1);
	setElementOpacity(document.getElementById('rid'), 1);	
   }//SetEnabled    
  {/literal}
  {/if}
  {literal}    	
 </script>
 <style type="text/css">
  .h_th1, .h_td, .h_td2 { 
   border: 1px solid #E4D9CB; background: #EEE7DF; height: 25px; border-bottom: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E4D9CB; border-left: none; }
  .btn_n { border: 1px solid #E4D9CB; border-top: none; height: 25px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E4D9CB; height: 25px; border-top: none;}	
 </style>
{/literal}
{if !$smarty.get.send}
<form method="post" name="messageslistform" id="messageslistform" onsubmit="return PrepereSend(this)">
{/if}
<div>
<a href="{$smarty.const.W_SITEPATH}account/mail/new/">Создать новое сообщение</a> | 
<a {if !$smarty.get.send}style="color: #000000"{/if}href="{$smarty.const.W_SITEPATH}account/mail/">Входящие потоки({if $global_user_info.privatenew}<label id="red">{$global_user_info.privatenew}</label>/{/if}<label style="color: #000000">{$global_user_info.privateall}</label>)</a> | 
<a {if $smarty.get.send}style="color: #000000"{/if}href="{$smarty.const.W_SITEPATH}account/mail/&send=1">Исходящие потоки (<label style="color: #000000">{$global_user_info.privatesend}</label>)</a> 
</div>
{if !$smarty.get.send}
<div style="margin-top: 8px">
<input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')">
<span style="margin-left: 12px">
<input type="submit" value="&nbsp;Пометить прочтенным&nbsp;" class="readmessbut" name="rid" id="rid" onclick="SetActionP('read')">
</span>
</div>
{/if}
<div style="margin-top: 12px">
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    {if !$smarty.get.send}
    <td class="h_th1" valign="center" align="left" width="20px">
	 <span style="margin-left: 4px">
	  <input type="checkbox" name="checkallmessages" id="checkallmessages" style="cursor: pointer" onclick="CheckAll(this)">
	 </span>
	</td>
	{/if}
	{if !$smarty.get.send}
	<td class="h_td" valign="center" align="center" width="80px">От</td>
	{else}
	<td class="h_td" valign="center" align="center" width="80px">Кому</td>
	{/if}
	<td class="h_td" valign="center" align="left" style="padding-left: 4px">Тема</td>
	<td class="h_td" valign="center" align="center" width="80px">Сообщений</td>
	<td class="h_td2" valign="center" align="center" width="130px">Дата</td>
   </tr>	
   {if $global_user_mail_info && $global_user_mail_info.source}
	{foreach from=$global_user_mail_info.source item=val name=val}
	 <tr onmouseover="DoHigl(this, 1, {$smarty.foreach.val.index})" onmouseout="DoHigl(this, 0, {$smarty.foreach.val.index})" id="t_r_{$smarty.foreach.val.index}">
	 {if !$smarty.get.send}
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E4D9CB; border-right: 1px solid #E4D9CB">
	  <span style="margin-left: 4px">
	   <input type="checkbox" name="chid{$smarty.foreach.val.index}" id="chid{$smarty.foreach.val.index}" 
	   style="cursor: pointer" onclick="CheckItem('{$smarty.foreach.val.index}', this)">
	  </span>
	 </td>
	 {/if}
	 {if !$smarty.get.send}
	 <td class="sth1" valign="center" align="center" width="80px" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	 <a target="_blank" href="{$smarty.const.W_SITEPATH}userinfo/{$val.fromuser}/"{if !$val.readable} style="font-weight: bold"{/if}>{if $CONTROL_OBJ->strlen($val.fromuser) > 16}
	  {$CONTROL_OBJ->substr($val.fromuser, 0, 14)}...
	 {else}
	  {$val.fromuser}
	 {/if}</a>	 
	 </td>
	 {else}
	 <td class="sth1" valign="center" align="center" width="80px" style="border-left: 1px solid #E4D9CB">
	 <a target="_blank" href="{$smarty.const.W_SITEPATH}userinfo/{$val.touser}/" {if !$val.readable} style="font-weight: bold"{/if}>{if $CONTROL_OBJ->strlen($val.touser) > 16}
	  {$CONTROL_OBJ->substr($val.touser, 0, 14)}...
	 {else}
	  {$val.touser}
	 {/if}</a>
	 </td>
	 {/if}
	 <td class="sth1" valign="center" align="left" style="padding-left: 4px" {if !$smarty.get.send}onclick="$('#chid{$smarty.foreach.val.index}').click()"{/if}>
	 <a class="subjlinkedmail" {if !$val.readable} style="font-weight: bold; color: #000000"{/if}href="{$smarty.const.W_SITEPATH}account/mail/{$val.idmess}{if $smarty.get.send}&send=1{else}/{/if}">{if $CONTROL_OBJ->strlen($val.subject)>40}{$CONTROL_OBJ->substr($val.subject, 0, 37)}...{else}{$val.subject}{/if}</a>
	 </td>
	 <td class="sth1" valign="center" align="center" width="80px" {if !$smarty.get.send}onclick="$('#chid{$smarty.foreach.val.index}').click()"{/if}>
	 {$CONTROL_OBJ->GetAnsversCountByMessage($val.idmess)}	 	 
	 </td>
	 <td class="sth1" valign="center" align="center" width="130px" style="border-right: 1px solid #E4D9CB;" {if !$smarty.get.send}onclick="$('#chid{$smarty.foreach.val.index}').click()"{/if}>
	 {$val.dateadd}
	 </td>
    </tr>  
    {if !$smarty.get.send}
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.idmess}" name="idm{$smarty.foreach.val.index}">
	{/if}
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="6">
     Нет сообщений!
     <script type="text/javascript">
	  document.getElementById('checkallmessages').disabled = true;
     </script>
    </td>
   </tr> 
   {/if} 
 </table>
 {if $global_user_mail_info && $global_user_mail_info.source}
 <div style="text-align: right; margin-top: 10px">{$global_user_mail_info.pagestext}</div>
 {/if}
 </span>
 {if !$smarty.get.send}
 <input type="hidden" value="none" name="actionmailslist">
 <input type="hidden" value="0" name="actioncountmess">
 </form>
 <script type="text/javascript">SetEnabled();</script>
 {/if}
</div>