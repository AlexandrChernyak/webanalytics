{* управление отдельными страницами проекта *}

{if $smarty.get.group}
 {* управление пользователями *}

 <div style="margin: 7px 1px 12px 1px">
 <a href="{$smarty.const.W_SITEPATH}account/admusersgroups/?new=1&group={$smarty.get.group}{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}{if $smarty.get.grouppage}&grouppage={$smarty.get.grouppage}{/if}"{if $smarty.get.new && !$adm_object->GetResult('modifyinfo')} style="color: #000000"{/if}>Добавить пользователя(ей)</a> | <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admusersgroups/?group={$smarty.get.group}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}{if $smarty.get.grouppage}&grouppage={$smarty.get.grouppage}{/if}">Все пользователи группы (<label style="color: #000000">{$adm_object->GetResult('pcount')}</label>)</a> 
 
 <label style="padding-left: 10px"><a href="{$smarty.const.W_SITEPATH}account/admusersgroups/{if $smarty.get.grouppage}?page={$smarty.get.grouppage}{/if}"> << Вернуться к группам (<label style="color: #000000">{$adm_object->GetResult('gcount')}</label>)</a></label>  
 </div>
  
 {if !$smarty.get.new}
  {* список пользователей *}
  
{literal}
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = {/literal}{if !$adm_object->GetResult('pcount')}0{else}1{/if};{literal}  
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
   alert('Выделите хотя бы одного пользователя!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == 'delete') {
   if (!confirm('Вы действительно хотите удалить ['+count+'] пользователей из группы?')) { return false; }
  } else 
  if (th.actionlistmakes.value == 'dall') {
   if (!allsaveenabled) { alert('Нет данных для удаления!'); return false; }	
   if (!confirm('Вы действительно хотите удалить всех пользователей группы?')) { return false; }	
  }
  else { alert('Неизвестный идентификатор операции!'); return false; }
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
  var f = document.getElementById('vnewsform');
  if (!f) { return ; }
  f.actionlistmakes.value = a;   	
 }//SetActionP   	
 function SetCheckByLine(ident) {
  var ch = $('#chid'+ident);
  ch.attr('checked', (ch.attr('checked')) ? false : true);
  CheckItem(ident);   	
 }//SetCheckByLine
</script>
<style type="text/css">
  .h_th1, .h_td, .h_td2 { 
   border: 1px solid #E4D9CB; background: #EEE7DF; height: 25px; border-bottom: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E4D9CB; border-left: none; }
  .btn_n { border: 1px solid #E4D9CB; border-top: none; height: 25px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E4D9CB; height: 25px; border-top: none; }	
 </style>
{/literal}  
  
<form method="post" name="vnewsform" id="vnewsform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Удалить всех пользователей&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 200px;">
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Пользователь</span></td>
	<td class="h_td2" valign="center" align="center" width="130px">Дата</td>
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
	 	 
	 
	 <td class="sth1" valign="center" align="left" onclick="SetCheckByLine('{$smarty.foreach.val.index}')" style="padding: 3px">
	  {assign var="userinfodata" value=$CONTROL_OBJ->GetUserInfo($val.userid, true)}
      <div>
      {if $userinfodata}
      <a href="{$smarty.const.W_SITEPATH}account/admuserslisten/&filter1=9&lcstr={$userinfodata.username}" target="_blank">{$userinfodata.username}</a></div>
      {else}
      Unknow User
      {/if}	  	 
	 </td> 
	 
	 <td class="sth1" valign="center" align="center" width="130px" style="border-right: 1px solid #E3E4E8;" 
	 onclick="SetCheckByLine('{$smarty.foreach.val.index}')">
	 {$val.datecreate}
	 </td>
	 
    </tr>  
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.iditem}" name="idm{$smarty.foreach.val.index}">
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="3">
     Нет пользователей в группе!
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
  {* добавление пользователей *}
  
 {literal}
 <script type="text/javascript">         
    function PrepereSend(th) {		 	 	 	 
	 $('#globalbodydata').css('cursor', 'wait');
     th.rb.disabled = true;
     th.rbp.disabled = true;
	 return true; 	
	}//PrepereSent
    
	function SetActionIdent(n) {	
     document.getElementById('addnewnews').actionnewprvmail.value = (n) ? 'act' : 'prev';	
    }//SetActionIdent
    
 </script>
 {/literal}    
  
  <form method="post" name="addnewnews" id="addnewnews" onsubmit="return PrepereSend(this)">
      
      <div class="typelabel">
       <label id="red">*</label> Укажите логины пользователей, которые хотите добавить (по одному на строку)      
      </div>          
      <div class="typelabel">     
       <textarea class="int_text" style="height: 100px; width: 95%" name="usnames" id="usnames">{$CONTROL_OBJ->GetPostElement('usnames','actionthissectionpost')}</textarea>
      </div>   

          
       
 <div class="typelabel" style="margin-top: 15px">
  <input type="submit" value="&nbsp;Добавить пользователей&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">
 </div>
 <input type="hidden" value="prev" name="actionnewprvmail">  
 <input type="hidden" value="do" name="actionthissectionpost">
 </form>
 
 {if $smarty.post.actionthissectionpost == 'do' && !$smarty.post.actionthissectionpost_q && $smarty.post.actionnewprvmail != 'prev'}
 <div style="margin-top: 10px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">Пользователи успешно добавлены в группу (добавлено: <strong>{$adm_object->adedusers}</strong>)!</label>
  {/if}
 </div>
 {/if}  
  
 
 {/if}
 
{else}
 {* управление группами *}
 <div style="margin: 7px 1px 12px 1px">
 <a href="{$smarty.const.W_SITEPATH}account/admusersgroups/?new=1{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}"{if $smarty.get.new && !$adm_object->GetResult('modifyinfo')} style="color: #000000"{/if}>Добавить группу</a> | <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admusersgroups/{if $smarty.get.oldpage}?page={$smarty.get.oldpage}{/if}">Все группы (<label style="color: #000000">{$adm_object->GetResult('gcount')}</label>)</a>   
 </div>
 
 {if !$smarty.get.new}
  {* управление списком разделов, просмотр, выбор *}
  
  {if !$adm_object->GetResult('data.source')}
   <div style="text-align: center; padding: 6px; margin-top: 25px"><b>Нет активных групп!</b></div>
  {else}
   {literal}
    <script type="text/javascript">
	 function DeleteSelectedElementSection(ident) {
	  if (!confirm("Вы действительно хотите удалить выбранную группу?\r\nПродолжить?")) {
	   return false;	
	  }	
	  var ppf = {/literal}'{$smarty.const.W_SITEPATH}account/admusersgroups/{if $smarty.get.page}?page={$smarty.get.page}{/if}'{literal};  
	  document.location = ppf + '&qdelete=' + ident;  
	 }
    </script>
   {/literal}
   {foreach from=$adm_object->GetResult('data.source') item=val name=val}
    <div style="margin: 4px; margin-top: 15px; padding: 4px; border: 1px solid #D2D2D2">
	 <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
       <tr>
       
        <td valign="top" align="left" width="50px" style="padding-right: 4px">
		 <img src="{$smarty.const.W_SITEPATH}img/ico/general/group_deleteblocked_128.png" border="0">
		</td>	
		
	    <td valign="top" align="left">
		 <div><a title="Просмотр пользователей группы" href="{$smarty.const.W_SITEPATH}account/admusersgroups/?group={$val.iditem}{if $smarty.get.page}&grouppage={$smarty.get.page}{/if}"><strong>{$val.groupname}</strong></a><label style="margin-left: 6px; font-size: 95%; color: #333399"><i>(пользователей: {$adm_object->GetUsersCount($val.iditem)})</i></label></div>
		 <div style="margin-top: 4px; font-size: 95%; color: #808080">
		  {assign var="itemdescrit" value=$CONTROL_OBJ->strings->CorrectTextFromDB($val.groupdescr)}
		  {if !$itemdescrit}Нет описания{else}{$itemdescrit}{/if}
		 </div>
		</td>
		
	    <td valign="top" align="right">
		 <div style="white-space: nowrap;">		 
		 
		 <a href="{$smarty.const.W_SITEPATH}account/admusersgroups/?modify={$val.iditem}&new=1{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}" title="Изменить"><img src="{$smarty.const.W_SITEPATH}img/items/document_edit.png" width="16" height="16"></a>
		 
		 <a style="margin-left: 6px" href="javascript:" onclick="DeleteSelectedElementSection('{$val.iditem}')" title="Удалить"><img src="{$smarty.const.W_SITEPATH}img/items/erase.png" width="16" height="16"></a>
		 
		 </div>
		</td>
       </tr>
      </table>
	 </span>
	</div>
   {/foreach} 
  {if $adm_object->GetResult('data.source')}
   <div style="text-align: right; margin-top: 10px">{$adm_object->GetResult('data.pagestext')}</div>
  {/if}    
  {/if} 
 
 {else}
  {* добавление/изменение раздела *}
  
{literal}
 <script type="text/javascript">         
    function PrepereSend(th) {
	 
	 if (!th.groupname.value) {
	  alert('Укажите название группы!');
	  th.groupname.focus();
	  return false;	
	 }
	 			 	 	 
	 $('#globalbodydata').css('cursor', 'wait');
     $('input[id="rb"]').attr('disabled', 'disabled');
     $('input[id="rbp"]').attr('disabled', 'disabled');
	 return true; 	
	}//PrepereSent
	
	function PrepereSend4(th) {
	 $('#globalbodydata').css('cursor', 'wait');
     $('input[id="rb"]').attr('disabled', 'disabled');
     $('input[id="rbp"]').attr('disabled', 'disabled');
	 return true;	
	}//PrepereSend4
	
	function SetActionIdent(n) {	
     document.getElementById('addgroupitem').actionnewprvmail.value = (n) ? 'act' : 'prev';	
    }//SetActionIdent	
 </script>
 {/literal}
 
 
 <form method="post" name="addgroupitem" id="addgroupitem" onsubmit="return PrepereSend(this)">
   
   {if $adm_object->GetResult('modifyinfo')}
   <div style="margin-top: 15px; margin-bottom: 15px; background: #F0F0F0; padding: 3px"><b>Настройка группы</b></div>   
   {/if}   
    
   <div class="typelabel"><label id="red">*</label> Название группы (до 120 символов)</div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 94%" name="groupname" id="groupname" maxlength="120" value="{$adm_object->GetAsElementP('groupname')}">
   </div>
   
   <div class="typelabel" style="margin-top: 12px; margin-bottom: 12px">
    <b>Параметры группы</b>
   </div>
     
   {if $smarty.post.actionnewprvmail == 'prev'}
   <div style="padding: 4px; border: 1px solid #666699; margin-bottom: 20px; margin-top: 10px; width: 94%;">
   {$CONTROL_OBJ->strings->CorrectTextFromDB($CONTROL_OBJ->strings->CorrectTextToDB($smarty.post.groupdescr))}  
   </div>
   {/if} 
   
   <div class="typelabel">Описание группы</div>
   <div class="typelabel">
    {include file='new_message.tpl' ident='groupdescr' source=$smarty.post.groupdescr height='90px' width='95%'}
   </div>
   
   <div class="typelabel" style="margin-top: 15px">
    <input type="hidden" value="do" name="actionthissectnnews">
   </div> 
   
   <input type="submit" value="&nbsp;{if !$adm_object->GetResult('modifyinfo')}Добавить группу{else}Изменить параметры группы{/if}&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp;
   <input type="submit" value="&nbsp;Предварительный просмотр описания&nbsp;" class="button" name="rbp" id="rbp" onclick="SetActionIdent(0)">
   <input type="hidden" value="prev" name="actionnewprvmail">
   <input type="hidden" value="ok" name="actionnewsectionnews">
  </form>  
  
  {if $smarty.post.actionthissectnnews == 'do' && !$smarty.post.actionthissectionpost_q && $smarty.post.actionnewprvmail != 'prev'}
 <div style="margin-top: 10px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">{if !$adm_object->GetResult('modifyinfo')}Группа успешно добавлена!{else}Параметры группы успешно изменены!{/if}</label>
  {/if}
 </div>
 {/if}  

 {/if} 
{/if}