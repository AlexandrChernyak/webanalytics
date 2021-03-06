{* Управление списком разделов информеров *}
<div style="margin-top: 4px">
<div>
<a href="{$smarty.const.W_SITEPATH}account/adminformersfiles/&sectionslist=1&new=1&inftype={if $smarty.get.inftype}{$smarty.get.inftype}{else}1{/if}{if $smarty.get.oldpage}&oldpage={$smarty.get.oldpage}{/if}&sections={if $smarty.get.sections}{$smarty.get.sections}{else}0{/if}"{if $smarty.get.new} style="color: #000000"{/if}>Добавить раздел</a> | 
<a href="{$smarty.const.W_SITEPATH}account/adminformersfiles/&sectionslist=1&inftype={if $smarty.get.inftype}{$smarty.get.inftype}{else}1{/if}{if $smarty.get.oldpage}&oldpage={$smarty.get.oldpage}{/if}&sections={if $smarty.get.sections}{$smarty.get.sections}{else}0{/if}"{if !$smarty.get.new} style="color: #000000"{/if}>Список разделов (<label style="color: #000000">{$adm_object->GetResult('count')}</label>)</a><label style="margin-left: 18px"><a href="{$smarty.const.W_SITEPATH}account/adminformersfiles/&inftype={if $smarty.get.inftype}{$smarty.get.inftype}{else}1{/if}&sections={if $smarty.get.sections}{$smarty.get.sections}{else}0{/if}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}">&lt;&lt; Вернуться к списку информеров</a></label>
</div>
<div style="margin-top: 12px">
{if !$smarty.get.new}
{* список разделов *}
{literal}
<script type="text/javascript">
 function PrepereSend(th) {
  var count = GetSelCount();
  if (count <= 0 && th.actionlistinvitecode.value != 'dall') { 
   alert('Выделите хотя бы один раздел!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistinvitecode.value == 'delete') {
   if (!confirm('Вы действительно хотите удалить ['+count+'] разделов? Все информеры внутри выбранных разделов будут удалены.. Продолжить?')) { return false; }
  } else if (th.actionlistinvitecode.value == 'dall') {
   if (!allsaveenabled) { alert('Нет данных для удаления!'); return false; }	
   if (!confirm('Вы действительно хотите удалить все разделы? Все информеры внутри разделов будут удалены. Продолжить?')){
   	return false; 
   }	
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
  var f = document.getElementById('sectform');
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
<form method="post" name="sectform" id="sectform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Удалить все разделы&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 150px;">
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Название</span></td>
	<td class="h_td" valign="center" align="center" width="150px">Кол-во информеров</td>
	<td class="h_td" valign="center" align="center" width="80px">Столбцов</td>		
	<td class="h_td" valign="center" align="center" width="60px">Действие</td>
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
	  <span style="margin-left: 3px">{$val.secname}</span>	 
	 </td>
	 <td class="sth1" valign="center" align="center" style="padding-left: 4px" width="150px" 
	 onclick="$('#chid{$smarty.foreach.val.index}').click()"> 
	  {$adm_object->GetInformersCountInSection($val.iditem)}
	 </td>
	 <td class="sth1" valign="center" align="center" width="80px" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	  {$val.colcount}	 	 	 
	 </td>
	 <td class="sth1" valign="center" align="center" width="60px" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	  <label style="padding: 3px">
	   <a href="{$smarty.const.W_SITEPATH}account/adminformersfiles/&sectionslist=1&inftype={if $smarty.get.inftype}{$smarty.get.inftype}{else}1{/if}&modifysect={$val.iditem}&new=1{if $smarty.get.oldpage}&oldpage={$smarty.get.oldpage}{/if}&sections={if $smarty.get.sections}{$smarty.get.sections}{else}0{/if}" title="Изменить"><img src="{$smarty.const.W_SITEPATH}img/items/document_edit.png" width="16" height="16"></a>
	  </label>	 	 	 
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
    <td valign="center" align="center" class="btn_n" colspan="6">
     Нет активных разделов!
     <script type="text/javascript">
	  document.getElementById('checkallinvites').disabled = true;
     </script>
    </td>
   </tr> 
   {/if} 
 </table>
 {if $adm_object->GetResult('data.pagestext')}
 <div style="text-align: right; margin-top: 10px">{$adm_object->GetResult('data.pagestext')}</div>
 {/if} 
 </span>
 </div> 
 <input type="hidden" value="0" name="actioncountmess">
 <input type="hidden" value="none" name="actionlistinvitecode"> 
</form>
<script type="text/javascript">SetEnabled();</script>
{else}
 {* добавление \ изменение раздела *}
 {literal}
 <script type="text/javascript">
  function PrepereSend(th) {	
   if (!trim(th.sname.value)) {
	alert('Укажите название нового раздела!');
	th.sname.focus();
	return false;
   }
   if (!IisInteger(th.scols.value) || th.scols.value <= 0 || th.scols.value > 99) {
   	alert('Укажите количество столбцов, на которые будут делится информеры в разделе! Значение от 1 до 99!');
   	th.scols.focus();
   	return false;
   }   
   return true;   	
  }//PrepereSend	
 </script>
 {/literal}
 <form method="post" name="sectformadd" id="sectformadd" onsubmit="return PrepereSend(this)">
  
  {if $smarty.get.modifysect && $adm_object->GetResult('data')}
  <div style="margin-top: 16px">Изменение раздела ::  <b>{$adm_object->GetResult('data.secname')}</b></div>
  <div style="margin-top: 6px">&nbsp;</div>
  {/if}
  
  <div class="typelabel"><label id="red">*</label> Название раздела</div>
  <div class="typelabel">
   <input type="text" class="inpt" style="width: 320px" name="sname" id="sname" value="{if !$smarty.get.modifysect || !$adm_object->GetResult('data')}{$CONTROL_OBJ->GetPostElement('sname', 'addinformsection')}{else}{$CONTROL_OBJ->GetPostElement('sname', 'addinformsection', 'do', $adm_object->GetResult('data.secname'))}{/if}" maxlength="99"{if $smarty.get.modifysect && !$adm_object->GetResult('data') && !$smarty.post.addinformsection} disabled="disabled"{/if}>
  </div>
  
  <div class="typelabel"><label id="red">*</label> Делить информеры раздела на количество колонок:</div>
  <div class="typelabel">
   <input type="text" class="inpt" style="width: 320px" name="scols" id="scols" value="{if !$smarty.get.modifysect && !$adm_object->GetResult('data')}{$CONTROL_OBJ->GetPostElement('scols', 'addinformsection', 'do', '2')}{else}{$CONTROL_OBJ->GetPostElement('scols', 'addinformsection', 'do', $adm_object->GetResult('data.colcount'))}{/if}" maxlength="2"{if $smarty.get.modifysect && !$adm_object->GetResult('data') && !$smarty.post.addinformsection} disabled="disabled"{/if}>
  </div>
    
 <input type="hidden" value="do" name="addinformsection">
 <div class="typelabel"><input type="submit" value="&nbsp;{if !$smarty.get.modifysect}Создать раздел{else}Изменить раздел{/if}&nbsp;" class="button" name="rb" id="rb"{if $smarty.get.modifysect && !$adm_object->GetResult('data') && !$smarty.post.addinformsection} disabled="disabled"{/if}></div>
 </form>
 
 {if $smarty.post.addinformsection == 'do'}
 <div style="margin-top: 10px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">{if !$smarty.get.modifyimage && !$adm_object->GetResult('data')}Раздел успешно создан!{else}Раздел успешно изменен!{/if}</label>
  {/if}
 </div>
 {/if}
 
{/if}
</div>
</div>