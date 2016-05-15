{* раздел комментариев *}
<div style="margin-top: 4px">
<div>
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0">
 <tr>
  <td colspan="2" style="padding: 0 2px 10px 0">
   
   <a{if !$smarty.get.oid} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admcommentslist/&ntype=1&active={$smarty.get.active}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}&oid=0">News/articles/records</a>
   
   <label style="margin: 0 2px 0 2px">|</label>
   
   <a{if $smarty.get.oid == '1'} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admcommentslist/&ntype=&active={$smarty.get.active}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}&oid=1">Special pages</a>
  
  </td>
 </tr> 
 <tr>
 <td valign="top" align="left">
 <div>Comments Section</div>
  <div style="margin-top: 4px">
   {assign var="listnewssections" value=$adm_object->GetCommentsSectionsListByNews()}    
   <select size="1" name="informtype" id="informtype" onchange="NavigateComm()">
    {if !$listnewssections && !$smarty.get.oid}
     <option{if !$smarty.get.ntype || $smarty.get.ntype == '1'} selected="selected"{/if} value="1">Site News</option>
     <option{if $smarty.get.ntype == '2'} selected="selected"{/if} value="2">Internet News</option>
    {else}
	 {foreach from=$listnewssections item=val name=val}	  
	  <option{if $smarty.get.ntype == $val.iditem} selected="selected"{/if} value="{$val.iditem}">{$val.lang}: {$val.sname} ({$val.countinfo.inactive} / {$val.countinfo.active})</option>
	 {/foreach}	
	{/if} 
   </select> 
  </div>	
 </td>
 <td valign="top" align="right">
  <div>Filter</div>
  <div style="margin-top: 4px">
   <select size="1" name="activetype" id="activetype" onchange="NavigateComm()">
    <option{if $smarty.get.active == ''} selected="selected"{/if} value="">All Comments from section ({$adm_object->GetResult('allcount')})</option>
	<option{if $smarty.get.active == '0'} selected="selected"{/if} value="0">Only in Moderation ({$adm_object->GetResult('countmoder')})</option>
    <option{if $smarty.get.active == '1'} selected="selected"{/if} value="1">Only published ({$adm_object->GetResult('countpublic')})</option>
   </select>  
  </div>	
 </td>
 </tr>
 </table>
 </span>
</div>
<div style="margin-top: 4px; border-bottom: 1px solid #969696">&nbsp;</div>

{literal}
<script type="text/javascript">
 var globalsectionpath = {/literal}'{$smarty.const.W_SITEPATH}';{literal}
 var globalpage = {/literal}'{$smarty.get.page}';{literal}
 var globaloldpage = {/literal}'{$smarty.get.oldpage}';{literal}
 var globaloid = {/literal}'{$smarty.get.oid}';{literal}
 
 function NavigateComm() {
  var path = globalsectionpath + 'account/admcommentslist/';
  var ntype = $('#informtype').val();
  ntype = (!ntype) ? 1 : ntype;
  path = path + '&ntype=' + ntype + '&active=' + $('#activetype').val();
  var page = (globaloldpage) ? globaloldpage : ((globalpage) ? globalpage : '');
  if (page) {
   path = path + '&page=' + page;	
  }
  path = path + '&oid=' + globaloid;
  document.location = path;  	
 }//NavigateComm	
</script>
{/literal}

<div style="margin-top: 5px">
<a{if !$smarty.get.modify} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admcommentslist/&ntype={if $smarty.get.ntype}{$smarty.get.ntype}{else}1{/if}&active={$smarty.get.active}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}&oid={$smarty.get.oid}">Comments List (<label style="color: #000000">{$adm_object->GetResult('count')}</label>)</a>
</div>
<div style="margin-top: 12px">
{if !$smarty.get.modify || !$adm_object->GetResult('modifyinfo')}
{* список комментариев *}
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
   alert('Mark at least one comment!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == 'delete') {
   if (!confirm('Do you really want to delete ['+count+'] comments?')) { return false; }
  } else 
  if (th.actionlistmakes.value == 'enabled') {
   if (!confirm('Do you really want to publish ['+count+'] comments?')) { return false; }
  } else
  if (th.actionlistmakes.value == 'disabled') {
   if (!confirm('Do you really want to remove from publication ['+count+'] comments?')) { return false; }
  } else
  if (th.actionlistmakes.value == 'dall') {
   if (!allsaveenabled) { alert('No data for delete!'); return false; }	
   if (!confirm('Do you really want to delete all comments selected section?')) { return false; }	
  } else { alert('Unknow action ID!'); return false; }
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
  var f = document.getElementById('commentsform');
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
<form method="post" name="commentsform" id="commentsform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Delete&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Delete all&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 160px;">
 </span>
 
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Enabled&nbsp;" class="activatelistit" name="ena" id="ena" onclick="SetActionP('enabled')" style="//width: 80px;">
 </span>

 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Disabled&nbsp;" class="deactivatelistit" name="dna" id="dna" onclick="SetActionP('disabled')" style="//width: 80px;">
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Comment</span></td>		
	<td class="h_td2" valign="center" align="left" width="1px"></td>
   </tr>	
   {if $adm_object->GetResult('data.source')}
	{foreach from=$adm_object->GetResult('data.source') item=val name=val}
	 <tr onmouseover="DoHigl(this, 1, {$smarty.foreach.val.index})" onmouseout="DoHigl(this, 0, {$smarty.foreach.val.index})" id="t_r_{$smarty.foreach.val.index}">
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8; {if !$val.commisactive}background: #FFCCCC{/if}">
	  <span style="margin-left: 4px">
	   <input type="checkbox" name="chid{$smarty.foreach.val.index}" id="chid{$smarty.foreach.val.index}" 
	   style="cursor: pointer" onclick="CheckItem('{$smarty.foreach.val.index}', this)">
	  </span>
	 </td>	 
	 <td class="sth1" valign="center" align="left" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	  
	  <div style="margin: 5px 5px 5px 5px">
	   {assign var="avatarinfo" value=$CONTROL_OBJ->GetUserAvatarInfo($val.username)}
	   <span style="width: 100%">
	   <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
	     <td valign="top" align="left" width="106px">
	     <img width="99" height="99" src="{$avatarinfo.webpath}">	  
	     </td>
	     <td valign="top" align="left">
	      <div style="margin-bottom: 4px; color: #969696">
	      <i>Re: <a style="color: #969696" href="{$adm_object->GetObjectLink($val)}" target="_blank">{$adm_object->GetObjectName($val)}</a></i>
	      </div>
	      <div>{$CONTROL_OBJ->strings->CorrectTextFromDB($val.commsource)}</div>	  
	     </td>
        </tr>
        <tr>
	     <td valign="top" align="right" colspan="2" style="margin-right: 4px">
	      <div style="margin-bottom: 3px">
	       <a href="{$smarty.const.W_SITEPATH}account/admcommentslist/&modify={$val.iditem}&ntype={if $smarty.get.ntype}{$smarty.get.ntype}{else}1{/if}&active={$smarty.get.active}{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}&oid={$smarty.get.oid}" style="font-size: 95%; color: #333399">Modify</a>&nbsp;|&nbsp;
	      
	       <a href="{$smarty.const.W_SITEPATH}userinfo/{$val.username}/" target="_blank">{$val.username}</a>&nbsp;|&nbsp;
	       {$CONTROL_OBJ->DateTimeToSpecialFormat($val.datecreate)}	   	  
	      </div>  
	     </td>
        </tr>     
       </table>
	   </span>	   
	  </div>
	  
	 </td>	 
	 <td class="sth1" valign="top" align="left" style="border-right: 1px solid #E3E4E8; width: 1px" onclick="$('#chid{$smarty.foreach.val.index}').click()">	 
	 </td>
    </tr>  
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.iditem}" name="idm{$smarty.foreach.val.index}">
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="3">
     No Comments!
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
 {* изменение *}
 {literal}
 <script type="text/javascript"> 
  function PrepereSend(th) {	
   if (!trim(th.commentsource.value)) {
	alert('Enter Comment Text!');
	th.commentsource.focus();
	return false;
   }
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;
   th.rbp.disabled = true;
   return true;   	
  }//PrepereSend
  
  function SetActionIdent(n) {	
   document.getElementById('modifycommentform').actionnewprvmail.value = (n) ? 'act' : 'prev';	
  }//SetActionIdent	
 </script>
 {/literal}
 
 <div style="margin-top: 12px">
  {if $smarty.post.actionnewprvmail == 'prev'}
  <div style="padding: 4px; border: 1px solid #775D41; margin-top: 20px; margin-bottom: 20px; width: 94%;">
   {$CONTROL_OBJ->strings->CorrectTextFromDB($CONTROL_OBJ->strings->CorrectTextToDB($smarty.post.commentsource))}  
  </div>
  {/if} 
 </div>
 
 <div style="margin-top: 6px"><b>Comment for</b>: <a href="{$adm_object->GetObjectLink($adm_object->GetResult('modifyinfo'))}" target="_blank">{$adm_object->GetObjectName($adm_object->GetResult('modifyinfo'))}</a></div>
 
 <form method="post" name="modifycommentform" id="modifycommentform" onsubmit="return PrepereSend(this)">

 <div class="typelabel" style="margin-top: 12px"><label id="red">*</label> Comment Text</div>
 <div class="typelabel">
  {include file='new_message.tpl' ident='commentsource' source=$smarty.post.commentsource height='220px' width='95%'}
 </div>
 
 <div class="typelabel" style="margin-top: 15px">
  <input type="submit" value="&nbsp;Save Changes&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp;
  <input type="submit" value="&nbsp;Preview&nbsp;" class="button" name="rbp" id="rbp" onclick="SetActionIdent(0)">
 </div>
 
 <input type="hidden" value="prev" name="actionnewprvmail">
 <input type="hidden" value="do" name="actionthissectionpost">
 
 </form>
 
 {if $smarty.post.actionthissectionpost == 'do' && $smarty.post.actionnewprvmail == 'act'} 
  <div style="margin-top: 8px">
  {if $adm_object->error}  
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">Comment has been successfully changed!</label>
  {/if}
  </div>
 {/if}
  
{/if}
</div>
</div>