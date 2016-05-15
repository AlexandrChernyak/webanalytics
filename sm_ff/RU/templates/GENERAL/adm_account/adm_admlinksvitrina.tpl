{* витрина ссылок *}
<div style="margin-top: 4px">
<div>
<a href="{$smarty.const.W_SITEPATH}account/admlinksvitrina&new=1"{if $smarty.get.new} style="color: #000000"{/if}>Добавить ссылку</a> | <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admlinksvitrina/">Все ссылки (<label style="color: #000000">{$adm_object->GetResult('count')}</label>)</a>
</div>
<div style="margin-top: 12px">
{if !$smarty.get.new}
{* список ссылок *}
{literal}
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = {/literal}{if !$adm_object->GetResult('count')}0{else}1{/if};{literal}  
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
   border: 1px solid #E4D9CB; background: #EEE7DF; height: 25px; border-bottom: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E4D9CB; border-left: none; }
  .btn_n { border: 1px solid #E4D9CB; border-top: none; height: 25px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E4D9CB; height: 25px; border-top: none; }	
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Ссылка</span></td>
	<td class="h_td" valign="center" align="center" width="30px">ДЯ</td>
	<td class="h_td" valign="center" align="center" width="30px">СА</td>	
	<td class="h_td" valign="center" align="center" width="80px">Bold</td>
	<td class="h_td" valign="center" align="center" width="80px">Indexed</td>
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
	 style="border-left: 1px solid #E4D9CB; border-right: 1px solid #E4D9CB">
	  <span style="margin-left: 4px">
	   <input type="checkbox" name="chid{$smarty.foreach.val.index}" id="chid{$smarty.foreach.val.index}" 
	   style="cursor: pointer" onclick="CheckItem('{$smarty.foreach.val.index}', this)">
	  </span>
	 </td>
	 
	 <td class="sth1" valign="center" align="left" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	  <span style="margin-left: 3px">	  
	  <a class="llw" href="http://{$val.lurl}" target="_blank" style="background: transparent url(http://favicon.yandex.net/favicon/{$val.lhost}) no-repeat left top">{$val.ltext}</a>	  
	  </span>	 
	 </td> 
	 
	 <td class="sth1" valign="center" align="center" onclick="$('#chid{$smarty.foreach.val.index}').click()" width="30px">
	  <label style="padding: 3px">
	   <a href="{$smarty.const.W_SITEPATH}account/admlinksvitrina/&modify={$val.iditem}&new=1" title="Изменить"><img src="{$smarty.const.W_SITEPATH}img/items/document_edit.png" width="16" height="16"></a>
	  </label>	  	  	 
	 </td>
	 
	 <td class="sth1" valign="center" align="center" onclick="$('#chid{$smarty.foreach.val.index}').click()" width="30px">
	  {if $val.lfromcountr}<img src="{$adm_object->GetFlagName($val.lfromcountr)}" alt="{$val.lfromcountr}" border="0" width="16" height="16"> {else}?{/if}	  	  	 
	 </td>
	 
	 <td class="sth1" valign="center" align="center" onclick="$('#chid{$smarty.foreach.val.index}').click()" width="80px">
	  {if $val.isbolded}<i style="color: #008000">(да)</i>{else}<i>(нет)</i>{/if}	  	  	 
	 </td>
	 
	 <td class="sth1" valign="center" align="center" onclick="$('#chid{$smarty.foreach.val.index}').click()" width="80px">
	  {if $val.isindexed}<i style="color: #008000">(да)</i>{else}<i>(нет)</i>{/if}	  	  	 
	 </td>
	 
	 <td class="sth1" valign="center" align="center" width="130px" style="border-right: 1px solid #E4D9CB;" 
	 onclick="$('#chid{$smarty.foreach.val.index}').click()">
	 {$val.ldate}
	 </td>
	 
    </tr>  
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.iditem}" name="idm{$smarty.foreach.val.index}">
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="7">
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
   function RestInp(th) {
    if (!th.value) {
      th.className = 'inpt_r';
      return ;   	
     } 
     th.className = 'inpt';	
    }//RestInp
        
    function PrepereSent(th) {
     RestInp(th.url);
	 RestInp(th.urltext);		 	
	 if (trim(th.url.value) == '') {
	  alert('Укажите URL ссылки!');
	  th.url.focus();
	  return false;	
	 }
	 if (trim(th.urltext.value) == '') {
	  alert('Укажите текст ссылки!');
	  th.urltext.focus();
	  return false;	
	 }
	 if (th.ptype.value < 1 || th.ptype.value > 4) {
	  alert('Укажите тип ссылки!');
	  return false;	
	 }		 	 
	 $('#globalbodydata').css('cursor', 'wait');
     th.rb.disabled = true;
	 return true; 	
	}//PrepereSent
		
	function SetTyped(n) { $('#ptype').val(n); }	
 </script>
 {/literal}
 <form method="post" name="addnewlinkd" id="addnewlinkd" onsubmit="return PrepereSent(this)">
 
  {if $adm_object->GetResult('modifyinfo')}
  {literal}
   <style type="text/css">
	.llw { display: inline-block; margin-left: 8px; vertical-align: baseline; padding-left: 20px; }
   </style>
   {/literal}
  <div style="border: 1px dashed #969696; padding: 4px">
  <b>Изменение ссылки: </b> <a class="llw" href="http://{$adm_object->GetResult('modifyinfo.lurl')}" target="_blank" style="background: transparent url(http://favicon.yandex.net/favicon/{$adm_object->GetResult('modifyinfo.lhost')}) no-repeat left top">{$adm_object->GetResult('modifyinfo.ltext')}</a> 
  </div>
  <div style="margin-top: 8px">&nbsp;</div>
  {/if}

  <div class="typelabel"><label id="red">*</label> URL ссыли (до 120 символов)</div>
      <div class="typelabel">
       <input type="text" class="inpt" style="width: 300px" name="url" id="url" maxlength="120" value="{$CONTROL_OBJ->GetPostElement('url','actionthissectionpost')}" onclick="RestInp(this)" onblur="RestInp(this)">
      </div>
      
      <div class="typelabel"><label id="red">*</label> Текст ссыли (до 80 символов)</div>
      <div class="typelabel">
       <input type="text" class="inpt" style="width: 300px" name="urltext" id="urltext" maxlength="80" value="{$CONTROL_OBJ->GetPostElement('urltext','actionthissectionpost')}" onclick="RestInp(this)" onblur="RestInp(this)">
      </div>
      
      <div class="typelabel">
       <input type="radio"{if $smarty.post.actionthissectionpost != 'do' || $smarty.post.ptype == '1'} checked="checked"{/if} style="cursor: pointer" name="selecttype" id="setdeflink" onclick="SetTyped(1)"><label for="setdeflink" style="cursor: pointer">&nbsp;Стандартная ссылка</label>
      </div>
      
       <div class="typelabel">
       <input type="radio"{if $smarty.post.actionthissectionpost == 'do' && $smarty.post.ptype == '2'} checked="checked"{/if} style="cursor: pointer" name="selecttype" id="setboldlink" onclick="SetTyped(2)"><label for="setboldlink" style="cursor: pointer">&nbsp;Жирная ссылка (<b>bold</b>)</label>
      </div>
      
       <div class="typelabel">
       <input type="radio"{if $smarty.post.actionthissectionpost == 'do' && $smarty.post.ptype == '3'} checked="checked"{/if} style="cursor: pointer" name="selecttype" id="setdefindex" onclick="SetTyped(3)"><label for="setdefindex" style="cursor: pointer">&nbsp;Стандартная ссылка (индексируемая) (без тэга &lt;noindex&gt;)</label>
      </div>
      
       <div class="typelabel">
       <input type="radio"{if $smarty.post.actionthissectionpost == 'do' && $smarty.post.ptype == '4'} checked="checked"{/if} style="cursor: pointer" name="selecttype" id="setboldindex" onclick="SetTyped(4)"><label for="setboldindex" style="cursor: pointer">&nbsp;Жирная ссылка (индексируемая) (<b>bold</b> + без тэга &lt;noindex&gt;)</label>
      </div>
   
 <div class="typelabel" style="margin-top: 15px">
  <input type="submit" value="&nbsp;{if !$adm_object->GetResult('modifyinfo')}Добавить ссылку{else}Сохранить изменения{/if}&nbsp;" class="button" name="rb" id="rb">
 </div>
  
 <input type="hidden" value="{$CONTROL_OBJ->GetPostElement('ptype','actionthissectionpost')}" name="ptype" id="ptype"> 
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