{* таблица строк *}
<div style="margin-top: 4px">
<div>
<a href="{$smarty.const.W_SITEPATH}account/admstringstable&new=1{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}"{if $smarty.get.new} style="color: #000000"{/if}>Add String</a> | <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admstringstable/{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}">All Strings (<label style="color: #000000">{$adm_object->GetResult('count')}</label>)</a>
</div>
<div style="margin-top: 12px">
{if !$smarty.get.new}
{* список строк *}
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
   alert('Mark at least one line!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == 'delete') {
   if (!confirm('Do you really want to delete ['+count+'] strings?')) { return false; }
  } else 
  if (th.actionlistmakes.value == 'dall') {
   if (!allsaveenabled) { alert('No data for delete!'); return false; }	
   if (!confirm('Do you really want to delete all strings?')) { return false; }	
  } else { alert('Unknow action ID!'); return false; }
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
  var f = document.getElementById('vstringsform');
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
<form method="post" name="vstringsform" id="vstringsform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Delete&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Delete all strings&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 160px;">
 </span>
 
 {literal}
 <script type="text/javascript"> 
  function NavigateLabel(th) {
   var page='{/literal}{if $smarty.get.page}{$smarty.get.page}{else}1{/if}{literal}'; 
   document.location = '{/literal}{$smarty.const.W_SITEPATH}{literal}account/admstringstable/'+
   ((page && page != '1') ? '&page='+page : '') + '&ilabel=' + encodeURIComponent(th.value);   
  }//NavigateLabel	
 </script>
 {/literal}
 <span style="margin-left: 6px">
 label: <select size="1" style="border: none; background: #E8E8E8; width: 350px" name="ilabels" id="ilabels" onchange="NavigateLabel(this)">
  <option value="">all labels</option>
  {foreach from=$adm_object->GetLabelsList() item=val name=val}
   {if $val}
    <option value="{$val}"{if $smarty.get.ilabel == $val} selected="selected"{/if}>{$val}</option>
   {/if}
  {/foreach}
 </select>
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
	<td class="h_td" valign="center" align="left" width="200px"><span style="margin-left: 3px">ID</span></td>
    <td class="h_td" valign="center" align="left" width="200px"><span style="margin-left: 3px"></span>Description</td>
	<td class="h_td2" valign="center" align="center"><span style="margin-left: 3px">Label</span></td>
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
	 
	 <td class="sth1" valign="center" align="left" width="200px" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	  <span style="margin-left: 3px">	  
	  <a href="{$smarty.const.W_SITEPATH}account/admstringstable&new=1&modify={$val.strident}{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}" title="Change the text constants">{$val.strident}</a>	  
	  </span>	 
	 </td> 
	 
	 
     <td class="sth1" valign="center" align="left" width="200px" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	 <span style="margin-left: 3px">	  
	  {$val.strdescr}	  
	  </span>
	 </td>
	 
	 <td class="sth1" valign="center" align="center" style="border-right: 1px solid #E3E4E8;" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	 <span style="margin-left: 3px">	  
	  {if $val.labelid}{$val.labelid}{else}<em>(no label)</em>{/if}	  
	  </span>
	 </td>
	 
    </tr>  
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.strident}" name="idm{$smarty.foreach.val.index}">
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="4">
     No Active strings!
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
 {* добавление строки *}
 {literal}
 <script type="text/javascript">
  function CheckItems(arr) {
   var obj = false;
   for (var i=0; i < arr.length; i++) {
    obj = $('#'+arr[i]);
    if (!trim(obj.val())) {
	 alert('Value should not be empty!');
	 obj.focus();
	 return false;	
	}    
   }
   return true;	
  }//CheckItems
           
  function PrepereSent(th) {
   if (th.ident && !trim(th.ident.value)) { 
    alert('Enter string ID!');
    th.ident.focus();
    return false;
   }	
   if (!CheckItems([{/literal}{$adm_object->GetResult('blockcheck')}{literal}])) { return false; }			 	 
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;
   return true; 	
  }//PrepereSent	
 </script>
 {/literal}
 
 <form method="post" name="addnewstring" id="addnewstring" onsubmit="return PrepereSent(this)">
  
  {if $adm_object->GetResult('modifyinfo')}
  <div style="margin-top: 4px">&nbsp;</div>
  {/if}
  <div class="typelabel"><label id="red">*</label> String ID{if !$adm_object->GetResult('modifyinfo')} (up to 120 characters){/if}</div>
  <div class="typelabel">
   {if !$adm_object->GetResult('modifyinfo')}
   <input type="text" class="inpt" style="width: 370px" name="ident" id="ident" maxlength="120" value="{$CONTROL_OBJ->GetPostElement('ident','actionthissectionpost')}">
   {else}
   <b style="margin-left: 8px">{$adm_object->GetResult('modifyinfo')}</b>
   {/if}
  </div>  
  
  <div class="typelabel" style="margin-top: 6px"> Label (up to 80 characters)</div>
  <div class="typelabel">
   <input type="text" class="inpt" style="width: 370px" name="labelid" id="labelid" maxlength="80" value="{if $smarty.post.actionthissectionpost == 'do'}{$CONTROL_OBJ->GetPostElement('labelid','actionthissectionpost')}{else}{$adm_object->GetResult('modifyinfolabel')}{/if}">
  </div>
  {if $adm_object->GetLabelsList()}
  <div class="typelabel" style="margin-top: 6px"> or select exists label</div>
  <div class="typelabel">   
   <select size="1" style="width: 373px" name="labelid2" id="labelid2">
   <option value=""></option>
   {foreach from=$adm_object->GetResult('labelslist') item=val name=val}
    <option value="{$val}">{$val}</option>
   {/foreach}
   </select> 
  </div>
  {/if}  
  
  {foreach from=$adm_object->GetResult('blocklist') item=val name=val}
   {if $smarty.foreach.val.index > 0}
    <div style="margin-top: 4px">&nbsp;</div>
   {/if}
   <div style="margin-top: 18px">
    <div style="padding-bottom: 3px; border-bottom: 1px solid #C0C0C0; background: #F0F0F0; width: 96%">
	 <b>{$val.descr}</b>
	</div>    
    <div class="typelabel"><label id="red">*</label> String Description (up to 150 characters)</div>
    <div class="typelabel">
     <input type="text" class="inpt" style="width: 95%" name="{$val.fid1}" id="{$val.fid1}" maxlength="150" value="{$val.name}">
    </div>
    <div class="typelabel"><label id="red">*</label> String Source Text (<b>HTML tags are supported!!</b>)</div>
    <div class="typelabel">
     <textarea class="int_text" style="height: 150px; width: 95%" name="{$val.fid2}" id="{$val.fid2}">{$val.data}</textarea>
	</div>   
   </div>
  {/foreach}    
   
 <div class="typelabel" style="margin-top: 15px">
  <input type="submit" value="&nbsp;{if !$adm_object->GetResult('modifyinfo')}Add String{else}Save Changes{/if}&nbsp;" class="button" name="rb" id="rb">
 </div>
   
 <input type="hidden" value="do" name="actionthissectionpost">
 </form>
 
 
 {if $smarty.post.actionthissectionpost == 'do' && !$smarty.post.actionthissectionpost_q}
 <div style="margin-top: 10px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">The string is successfully {if !$adm_object->GetResult('modifyinfo')}added{else}changed{/if}!</label>
  {/if}
 </div>
 {/if}
{/if}
</div>
</div>