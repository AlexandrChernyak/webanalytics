{* перенаправления ссылок *}
<div style="margin-top: 4px">
<div>
<a href="{$smarty.const.W_SITEPATH}account/admredirectlktable&new=1{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}"{if $smarty.get.new} style="color: #000000"{/if}>Добавить ссылку</a> | <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admredirectlktable/{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}">Все ссылки (<label style="color: #000000">{$adm_object->GetResult('count')}</label>)</a>
</div>
<div style="margin-top: 12px">
{if !$smarty.get.new}
{* список ссылок *}
{literal}
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = {/literal}{if !$adm_object->GetResult('count')}0{else}1{/if};{literal}  
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
  if (count <= 0 && th.actionlistmakes.value != 'all' && th.actionlistmakes.value != 'dall') { 
   alert('Выделите хотя бы одну ссылку!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == 'delete') {
   if (!confirm('Вы действительно хотите удалить ['+count+'] ссылок?')) { return false; }
  } else 
  if (th.actionlistmakes.value == 'dall') {
   if (!allsaveenabled) { alert('Нет данных для удаления!'); return false; }	
   if (!confirm('Вы действительно хотите удалить все ссылки?')) { return false; }	
  } else { alert('Неизвестный идентификатор операции!'); return false; }
  return true;   	
 }//PrepereSend
 function SetEnabled() {  	
  var count = GetSelCount();
  setElementOpacity(document.getElementById('adid'), (allsaveenabled) ? 1 : 0.3);
  if (count <= 0) {
   setElementOpacity(document.getElementById('did'), 0.3);
   return ;	 
  }
  setElementOpacity(document.getElementById('did'), 1);
 }//SetEnabled
 function SetActionP(a) {
  var f = document.getElementById('vlinksform');
  if (!f) { return ; }
  f.actionlistmakes.value = a;   	
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
<form method="post" name="vlinksform" id="vlinksform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Удалить все ссылки&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 160px;">
 </span>
  
 </div>
 <div style="margin-top: 6px">
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <td class="h_th1" valign="center" align="left" width="20px">
	 <span style="margin-left: 4px">
	  <input type="checkbox" name="checkallitems" id="checkallitems" style="cursor: pointer" onclick="CheckAll(this)">
	 </span>
	</td>
	<td class="h_td" valign="center" align="center" width="80px">ID</td>
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Описание</span></td>
	
	<td class="h_td2" valign="center" align="center" width="130px"><span style="margin-left: 3px">Дата</span></td>
   </tr>	
   {literal}
   <style type="text/css">
	.llw { display: inline-block; margin-left: 8px; vertical-align: baseline; padding-left: 20px; }
   </style>
   {/literal}
   {if $adm_object->GetResult('data.source')}
	{foreach from=$adm_object->GetResult('data.source') item=val name=val}
	 <tr onmouseover="DoHigl(this, 1, {$smarty.foreach.val.index})" onmouseout="DoHigl(this, 0, {$smarty.foreach.val.index})" id="t_r_{$smarty.foreach.val.index}">
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8">
	  <span style="margin-left: 4px">
	   <input type="checkbox" name="chid{$smarty.foreach.val.index}" id="chid{$smarty.foreach.val.index}" 
	   style="cursor: pointer" onclick="CheckItem('{$smarty.foreach.val.index}', this)">
	  </span>
	 </td>
	 
	 <td class="sth1" valign="top" style="padding-top: 4px" align="center" width="80" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	  <b>{$val.iditem}</b>	 
	 </td> 
	 
	 <td class="sth1" valign="top" style="padding-top: 4px; padding-left: 3px" align="left" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	  <div><i>{$val.rdescr}</i></div>
	  <div style="margin-top: 4px">Перенаправить на: <u>{$val.rhref}</u></div>
	  
	  <div style="margin-top: 14px">Ссылка для использования: <label style="font-size: 95%; margin-left: 6px; color: #000080"><i>(Переходов: {$val.reqcount})</i></label></div>
	  <div style="margin-top: 4px">
	  <textarea style="border: none; width: 92%; height: 30px" onclick="this.select()">http://{$smarty.const.W_HOSTMYSITE}/goto/{$val.iditem}</textarea>
	  </div>
	  <div style="margin-top: 4px"><a href="{$smarty.const.W_SITEPATH}account/admredirectlktable&new=1&modify={$val.iditem}{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}" style="color: #333399; font-size: 95%">Изменить</a></div>
	  <div style="margin-top: 4px"></div>		   
	 </td> 
	 	 
	 <td class="sth1" valign="top" align="center" style="padding-top: 4px; border-right: 1px solid #E3E4E8;" width="130px" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	  {$val.datecreate}	  
	 </td>
	 
    </tr>  
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.iditem}" name="idm{$smarty.foreach.val.index}">
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="4">
     Нет активных ссылок!
     <script type="text/javascript">
	  document.getElementById('checkallitems').disabled = true;
     </script>
    </td>
   </tr> 
   {/if} 
 </table>
 {if $adm_object->GetResult('data.source')}
 <div style="text-align: right; margin-top: 10px">{$adm_object->GetResult('data.pagestext')}</div>
 {/if} 
 </span>
 </div> 
 <input type="hidden" value="0" name="actioncountmess">
 <input type="hidden" value="none" name="actionlistmakes"> 
</form>
<script type="text/javascript">SetEnabled();</script>
{else}
 {* добавление ссылки *}
 {literal}
 <script type="text/javascript">           
  function PrepereSent(th) {
   if (!trim(th.href.value)) { 
    alert('Укажите URL ссылки!');
    th.href.focus();
    return false;
   }
   if (!trim(th.descr.value)) { 
    alert('Укажите описание ссылки!');
    th.descr.focus();
    return false;
   }			 	 
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;
   return true; 	
  }//PrepereSent	
 </script>
 {/literal}
 
 <form method="post" name="addnewlink" id="addnewlink" onsubmit="return PrepereSent(this)">
  
  {if $adm_object->GetResult('modifyinfo')}
  <div style="margin-top: 4px">&nbsp;</div>
  <div>Изменение ссылки: <b>{$adm_object->GetResult('modifyinfo.rhref')}</b></div> 
  <div style="margin-top: 4px">&nbsp;</div> 
  {/if}
  
  <div class="typelabel"><label id="red">*</label> URL ссылки, на которую выполнять перенаправление (до 240 символов, с http://)
  <br />
  Для передачи параметра ссылки используйте параметр <b>%s</b><br />
  Каждый из параметров <b>%s</b> 
  (исчисляется в порядке их расположения) заменяется на указанный по порядку параметр ссылки,<br />
  пример:<br />
  Ссылка вида:<br />
  <u>http://проект.зона/goto/ид_ссылки<b>/параметр1/параметр2/../параметрN</b></u><br />
  Первый <b>%s</b> будет равным <b>параметр1</b>, второй <b>%s</b> будет равным <b>параметр2</b> и т.д <br />
  Пример ссылки:<br />
  <u>http://site.com/?username=%s&sessionid=%s</u> и т.д 
  </div>
  <div class="typelabel">
   <input type="text" class="inpt" style="width: 370px" name="href" id="href" maxlength="240" value="{$CONTROL_OBJ->GetPostElement('href','actionthissectionpost')}">
  </div>  
  
  <div class="typelabel"><label id="red">*</label> Описание ссылки `для списка` (до 100 символов)</div>
  <div class="typelabel">
   <input type="text" class="inpt" style="width: 370px" name="descr" id="descr" maxlength="100" value="{$CONTROL_OBJ->GetPostElement('descr','actionthissectionpost')}">
  </div> 
       
 <div class="typelabel" style="margin-top: 15px">
  <input type="submit" value="&nbsp;{if !$adm_object->GetResult('modifyinfo')}Добавить ссылку{else}Сохранить изменения{/if}&nbsp;" class="button" name="rb" id="rb">
 </div>
   
 <input type="hidden" value="do" name="actionthissectionpost">
 </form>
 
 
 {if $smarty.post.actionthissectionpost == 'do' && !$smarty.post.actionthissectionpost_q}
 <div style="margin-top: 10px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">Ссылка успешно {if !$adm_object->GetResult('modifyinfo')}добавлена{else}изменена{/if}!</label>
  {/if}
 </div>
 {/if}
{/if}
</div>
</div>