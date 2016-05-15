{* шрифты для работы инструмнетов сайта *}
<div style="margin-top: 4px">
<div>
<a href="{$smarty.const.W_SITEPATH}account/admfontssection&new=1"{if $smarty.get.new} style="color: #000000"{/if}>Добавить шрифт</a> | <a href="{$smarty.const.W_SITEPATH}account/admfontssection/"{if !$smarty.get.new} style="color: #000000"{/if}>Все шрифты (<label style="color: #000000">{$adm_object->GetResult('count')}</label>)</a>
</div>
<div style="margin-top: 12px">
{if !$smarty.get.new}
{* список шрифтов *}
{literal}
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = {/literal}{$adm_object->GetResult('count')};{literal}  
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
   alert('Выделите хотя бы один файл шрифта!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == 'delete') {
   if (!confirm('Вы действительно хотите удалить ['+count+'] файлов?')) { return false; }
  } else 
  if (th.actionlistmakes.value == 'enabled') {
   if (!confirm('Вы действительно хотите активировать ['+count+'] шрифтов?')) { return false; }
  } else
  if (th.actionlistmakes.value == 'disabled') {
   if (!confirm('Вы действительно хотите деактивировать ['+count+'] шрифтов?')) { return false; }
  } else
   if (th.actionlistmakes.value == 'dall') {
    if (!allsaveenabled) { alert('Нет данных для удаления!'); return false; }	
    if (!confirm('Вы действительно хотите удалить все шрифты?')) { return false; }	
  } else { alert('Неизвестный идентификатор операции!'); return false; }
  return true;   	
 }//PrepereSend
 function SetEnabled() {  	
  var count = GetSelCount();
  setElementOpacity(document.getElementById('adid'), (allsaveenabled) ? 1 : 0.3);
  if (count <= 0) {
   setElementOpacity(document.getElementById('did'), 0.3);
   setElementOpacity(document.getElementById('ena'), 0.3);
   setElementOpacity(document.getElementById('dna'), 0.3);
   return ;	 
  }
  setElementOpacity(document.getElementById('did'), 1);
  setElementOpacity(document.getElementById('ena'), 1);
  setElementOpacity(document.getElementById('dna'), 1); 	
 }//SetEnabled
 function SetActionP(a) {
  var f = document.getElementById('fontsform');
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
<form method="post" name="fontsform" id="fontsform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Удалить все файлы&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 160px;">
 </span>
 
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Включить&nbsp;" class="activatelistit" name="ena" id="ena" onclick="SetActionP('enabled')" style="//width: 80px;">
 </span>

 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Отключить&nbsp;" class="deactivatelistit" name="dna" id="dna" onclick="SetActionP('disabled')" style="//width: 80px;">
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Шрифт</span></td>	
	<td class="h_td" valign="center" align="center" width="80px">Размер</td>
	<td class="h_td" valign="center" align="center" width="80px">Активен</td>	
	<td class="h_td2" valign="center" align="center" width="130px">Дата</td>
   </tr>	
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
	 <td class="sth1" valign="center" align="left" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	  <span style="margin-left: 3px; white-space: nowrap">	  
	  <img src="{$smarty.const.W_SITEPATH}img/items/font_tt_2.png" style="width: 16px; height: 16px; margin-right: 6px; position: relative;"> 
	  <span style="position: relative; top: -2px"><a href="{$smarty.const.W_SITEPATH}account/admfontssection&downloadfile={$val.iditem}" title="Скачать файл">{$val.fontname}</a></span>
	  </span>	 
	 </td> 
	 <td class="sth1" valign="center" align="center" onclick="$('#chid{$smarty.foreach.val.index}').click()" width="80px">
	  {$adm_object->GetSizeItem($val.fontsize)}	  	 
	 </td>
	 <td class="sth1" valign="center" align="center" onclick="$('#chid{$smarty.foreach.val.index}').click()" width="80px">
	  {if !$val.fontuse}<i>(нет)</i>{else}<i style="color: #333399">(активен)</i>{/if}	  	 
	 </td>
	 <td class="sth1" valign="center" align="center" width="130px" style="border-right: 1px solid #E3E4E8;" 
	 onclick="$('#chid{$smarty.foreach.val.index}').click()">
	 {$val.datecreat}
	 </td>
    </tr>  
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.iditem}" name="idm{$smarty.foreach.val.index}">
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="5">
     Нет загруженных шрифтов!
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
 {* добавление шрифта *}
 {literal}
 <script type="text/javascript">
  function PrepereToSend(th) {
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;   
   return true;	
  }//PrepereToSend  	
 </script>
 {/literal}
 <form method="post" name="ffadd" id="ffadd" enctype="multipart/form-data" onsubmit="return PrepereToSend(this)"> 
  
  <div class="typelabel"><label id="red">*</label> Файл шрифта (форматы: {$adm_object->GetListTypes()}{if $adm_object->GetResult('maxsize')}, максимальный размер: <b>{$adm_object->GetResult('maxsize')}</b>){/if}</div>  
  <div class="typelabel"> 
   <input type="file" size="20" style="width: 430px; height: 22px" class="inpt" name="font" id="font">  
  </div>
  
 <input type="hidden" value="do" name="updatesactionnew">
 <div class="typelabel"><input type="submit" value="&nbsp;Добавить файл&nbsp;" class="button" name="rb" id="rb"></div>
 </form>
 {if $smarty.post.updatesactionnew == 'do'}
 <div style="margin-top: 10px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">Файл успешно добавлен!</label>
  {/if}
 </div>
 {/if}
{/if}
</div>
</div>