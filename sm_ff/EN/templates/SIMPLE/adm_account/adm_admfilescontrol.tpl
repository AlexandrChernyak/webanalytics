{* управление вложением *}
<div style="margin-top: 4px">
 {if $adm_object->error && $adm_object->errorglobal}
  <div style="color: #FF0000">{$adm_object->error}</div>
 {else}
  
  {* отображение информации о объекте, для которого используются вложения *}
  <div>
   Attachments for: 
   {if $adm_object->obj->GetFullPath()}
   
    {foreach from=$adm_object->obj->GetFullPath() item=val name=val}
     
      <a href="{$val.path}" target="_blank">{$val.name}</strong></a>
      {if !$val.isend}
       <label style="margin: 0 2px 0 2px"> -> </label>
      {/if}
    
    {/foreach}
   
   {else}    
    {if $adm_object->obj->GetSectionPath()}
    <a href="{$adm_object->obj->GetSectionPath()}" target="_blank"><strong>{$adm_object->obj->GetSectionName()}</strong></a>
    {else}
    <label><strong>{$adm_object->obj->GetSectionName()}</strong></label>
    {/if}
    
    <label style="margin-left: 2px"> -> </label>
    <label style="margin-left: 2px">
     <a href="{$adm_object->obj->GetPath()}" target="_blank">{$adm_object->obj->GetName()}</a>
    </label>
   {/if}    
  </div>
  
  <div style="margin: 22px 1px 12px 1px">
   {* управление списком вложений  *}
   
   <div style="margin-bottom: 22px; background: #F0F0F0; padding: 3px">
   <a href="{$smarty.const.W_SITEPATH}account/admfilescontrol/?new=1&fid={$smarty.get.fid}&pid={$smarty.get.pid}{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}"{if $smarty.get.new && !$adm_object->GetResult('modifyinfo')} style="color: #000000"{/if}>Add File</a> | <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admfilescontrol/?fid={$smarty.get.fid}&pid={$smarty.get.pid}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}">All Files (<label style="color: #000000">{$adm_object->GetResult('count')}</label>)</a></div>
   
   
 {if $smarty.get.new}
  {* добавление файла *}  
   
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
    
    function ShHideElementFlash(th, block) {   
     $('#'+block).css('visibility', (th.checked) ? 'visible' : 'hidden');
     $('#'+block).css('display', (th.checked) ? 'block' : 'none');
    }//ShHideElementFlash
 </script>
 {/literal}
 
    
  <form method="post" name="addnewnews" id="addnewnews"{if !$smarty.get.modify || $smarty.get.modifytype} enctype="multipart/form-data"{/if} onsubmit="return PrepereSend(this)">
  
  {if $adm_object->GetResult('modifyinfo')}
   <div style="margin-top: 15px; margin-bottom: 15px; background: #F0F0F0; padding: 3px"><b>change the file</b> - <a title="Download file" href="{$smarty.const.W_SITEPATH}account/admfilescontrol/?fid={$smarty.get.fid}&pid={$smarty.get.pid}&dwfile={$adm_object->GetResult('modifyinfo.iditem')}">{$adm_object->GetResult('modifyinfo.fname')}</a>  ({$adm_object->GetFileSize($adm_object->GetResult('modifyinfo.fsize'))}, downloads: {$adm_object->GetResult('modifyinfo.dwcount')})</div>   
  {/if}
  
  {if !$smarty.get.modify || $smarty.get.modifytype}     
  <div class="typelabel">
   <label id="red">*</label> File (formats: {$adm_object->GetListTypes()}{if $adm_object->GetResult('maxsize')}, max size: <b>{$adm_object->GetResult('maxsize')}</b>){/if}      
  </div>           
  <div class="typelabel">
   <input type="file" size="20" style="width: 95%; height: 22px" class="inpt" name="sfile" id="sfile">
  </div>
  {/if}
  
  {if !$smarty.get.modify || !$smarty.get.modifytype}
  <div class="typelabel">
   The group file (file that was located in the `General` group - leave blank){if !$adm_object->obj->GetFilesGroups()}. <br /><label style="font-size: 95%">After first file will be downloaded - as a group of files you can select a group of already existing groups of previously added files!</label>{/if}
  </div>
  <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="groupname" id="groupname" maxlength="80" value="{$adm_object->GetAsElementP('groupname')}">
  </div>
  
  {if $adm_object->obj->GetFilesGroups()}
  <div class="typelabel">
   Or specify an existing group<br />
   <label style="font-size: 95%">(so that the file was located in the `General` group - leave both fields blank to use an existing group - leave blank the box above)</label>
  </div>
  <div class="typelabel">
    <select size="1" style="width: 353px" name="groupname2" id="groupname2">
	 <option value=""></option>
     {foreach from=$adm_object->obj->GetFilesGroups() item=val name=val}
       <option value="{$val}">{$val}</option>     
     {/foreach}
    </select>
  </div>
  {/if}
  
  <div class="typelabel" style="margin-top: 12px">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('onlyonline')} checked="checked" {/if}style="cursor: pointer" name="onlyonline" id="onlyonline"><label for="onlyonline" style="cursor: pointer">&nbsp;Can be downloaded only by authorized users</label>  
   </div>
   
  <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('onlyadmins')} checked="checked" {/if}style="cursor: pointer" name="onlyadmins" id="onlyadmins"><label for="onlyadmins" style="cursor: pointer">&nbsp;Can download only the administrators of the project</label>  
   </div>
  
  <div class="typelabel" style="margin-top: 12px">
   Users can download only, consisting of groups <br />
   <label style="font-size: 95%">(to select / remove multiple - select a list item by holding down Ctrl)</label>
  </div>
  <div class="typelabel">
   <select size="10" style="width: 353px" name="fromgroupso[]" id="fromgroupso[]" multiple="multiple">
    {assign var="usersgroups" value=$adm_object->GetUsersGroups()}
    {foreach from=$usersgroups item=val name=val}
      <option{if $adm_object->OptionIsSelected($smarty.post.fromgroupso, $val.iditem)} selected="selected"{/if} value="{$val.iditem}">{$val.groupname}</option>       
    {/foreach}    
   </select>
  </div>
  
  <div class="typelabel" style="margin-top: 12px">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('useprice')} checked="checked" {/if}style="cursor: pointer" name="useprice" id="useprice" onclick="ShHideElementFlash(this, 'priveparams')"><label for="useprice" style="cursor: pointer">&nbsp;Make it a paid file download</label>  
  </div>
   
  <div id="priveparams"{if !$CONTROL_OBJ->CheckPostValue('useprice')} style="visible: hidden; display: none"{/if}>    
        
  <div class="typelabel" style="margin-top: 12px; background: #F0F0F0; padding: 3px">
   <strong>Options paid download file</strong>
  </div> 
  <div style="font-size: 95%; padding: 0 0 8px 3px">
  (if file is provided free of charge - these parameters can be omitted, if file is given not fee - must download - User Authentication)
  </div>
  
  <div class="typelabel">
   The price for downloading file (in USD, size: 0.00)<br />
   <label style="font-size: 95%">(with downloads, copy of file is sent to user e-mail listed in your account)</label>
  </div>
  <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="pricevalue" id="pricevalue" maxlength="80" value="{$adm_object->GetAsElementP('pricevalue', 'actionthissectnnews', 'do', '0.00')}">
  </div>
  <div class="typelabel">
   Description of payment to history of financial transactions<br />
   <label style="font-size: 95%">
    (insert description of payment in name of downloaded file, use <strong>@s</strong>)
   </label>
  </div>
  <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="paydescr" id="paydescr" maxlength="240" value="{$adm_object->GetAsElementP('paydescr', 'actionthissectnnews', 'do', $CONTROL_OBJ->GetText('payfilesdescriptionhistory'))}">
  </div>
  
  <div class="typelabel">
   Allow free download file for users who are in groups <br />
   <label style="font-size: 95%">(to select/remove multiple - select a list item by holding down Ctrl)</label>
  </div>
  <div class="typelabel">
   <select size="10" style="width: 353px" name="pricefreefr[]" id="pricefreefr[]" multiple="multiple">
    {assign var="usersgroups" value=$adm_object->GetUsersGroups()}
    {foreach from=$usersgroups item=val name=val}
      <option{if $adm_object->OptionIsSelected($smarty.post.pricefreefr, $val.iditem)} selected="selected"{/if} value="{$val.iditem}">{$val.groupname}</option>       
    {/foreach}    
   </select>
  </div>   
  
  </div>
  
  <div class="typelabel" style="margin-top: 12px; background: #F0F0F0; padding: 3px">
   <strong>Complete ban download</strong>
  </div>
  
  <div class="typelabel" style="padding-top: 6px">
   Completely disable to download file for users who are in groups <br />
   <label style="font-size: 95%">(to select/remove multiple - select a list item by holding down Ctrl)</label>
  </div>
  <div class="typelabel">
   <select size="10" style="width: 353px" name="lockgroups[]" id="lockgroups[]" multiple="multiple">
    {assign var="usersgroups" value=$adm_object->GetUsersGroups()}
    {foreach from=$usersgroups item=val name=val}
      <option{if $adm_object->OptionIsSelected($smarty.post.lockgroups, $val.iditem)} selected="selected"{/if} value="{$val.iditem}">{$val.groupname}</option>       
    {/foreach}    
   </select>
  </div>  
   
   <div class="typelabel" style="margin: 12px 0 12px 0; background: #F0F0F0; padding: 3px">
    <strong>Note</strong>
   </div>
  
   {if $smarty.post.actionnewprvmail == 'prev'}
    <div style="padding: 4px; border: 1px solid #666699; margin-bottom: 20px; margin-top: 10px; width: 94%;">
    {$CONTROL_OBJ->strings->CorrectTextFromDB($CONTROL_OBJ->strings->CorrectTextToDB($smarty.post.filetip))}  
    </div>
   {/if}
   
   <div class="typelabel">Notes to file (optional)</div>
   <div class="typelabel">
    {include file='new_message.tpl' ident='filetip' source=$smarty.post.filetip height='90px' width='95%'}
   </div>
   
   
  {/if}            
       
  <div class="typelabel" style="margin-top: 15px">
   <input type="submit" value="&nbsp;{if $adm_object->GetResult('modifyinfo')}Save{else}Add File{/if}&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">
  </div>
  <input type="hidden" value="prev" name="actionnewprvmail">  
  <input type="hidden" value="do" name="actionthissectnnews">  
 </form>
 
 {if $smarty.post.actionthissectnnews == 'do' && !$smarty.post.actionthissectionpost_q && $smarty.post.actionnewprvmail != 'prev'}
 <div style="margin-top: 10px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">{if $adm_object->GetResult('modifyinfo')}Changes saved successfully!{else}File added successfully!{/if}</label>
  {/if}
 </div>
 {/if}    
   
 {else}  
   {* управление списком *}
   
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
   alert('Select at least one file!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == 'delete') {
   if (!confirm('Are you sure you want to delete ['+count+'] files?')) { return false; }
  } else 
  if (th.actionlistmakes.value == 'dall') {
   if (!allsaveenabled) { alert('No data to remove!'); return false; }	
   if (!confirm('Are you sure you want to delete all files?')) { return false; }	
  }
  else { alert('Unknown ID operation!'); return false; }
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
   border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E3E4E8; border-left: none; }
  .btn_n { border: 1px solid #E3E4E8; border-top: none; height: 25px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E3E4E8; height: 25px; border-top: none; }	
 </style>
{/literal}   
   
   
 <form method="post" name="vnewsform" id="vnewsform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Delete&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Delete all files&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 200px;">
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">File</span></td>
    <td class="h_td" valign="center" align="center" width="60px">Sett-gs</td>
    <td class="h_td" valign="center" align="center" width="40px">file</td>
    <td class="h_td" valign="center" align="center" width="80px">Down-ds</td>
    <td class="h_td" valign="center" align="center" width="100px">Price</td>   
	<td class="h_td2" valign="center" align="center" width="130px">Date</td>
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
      <div><a title="Download file" href="{$smarty.const.W_SITEPATH}account/admfilescontrol/?fid={$smarty.get.fid}&pid={$smarty.get.pid}&dwfile={$val.iditem}">{$val.fname}</a></div>
      
      <div class="typelabel" style="font-size: 95%">
       Group: <ins>{if !$val.groupname}General{else}{$val.groupname}{/if}</ins>
      </div>
      <div class="typelabel" style="font-size: 95%; margin-top: 2px">
       Size: <ins>{$adm_object->GetFileSize($val.fsize)}</ins>
      </div>
      <div class="typelabel" style="font-size: 95%; margin-top: 2px">
       Link to general download - <a target="_blank" style="font-size: 95%" href="{$smarty.const.W_SITEPATH}download/{$smarty.get.fid}/{$smarty.get.pid}/{$val.iditem}">go to page</a>
      </div>
      	  	 
	 </td> 
     
     <td class="sth1" valign="center" align="center" style="padding-left: 4px" width="60px" 
	 onclick="SetCheckByLine('{$smarty.foreach.val.index}')">
	  <label style="padding: 3px">
	   <a href="{$smarty.const.W_SITEPATH}account/admfilescontrol/?fid={$smarty.get.fid}&pid={$smarty.get.pid}&modify={$val.iditem}&new=1&modifytype=0" title="Change file parameters (conditions download)"><img src="{$smarty.const.W_SITEPATH}img/items/document_edit.png" width="16" height="16"></a>
	  </label>
	 </td>
     
     <td class="sth1" valign="center" align="center" style="padding-left: 4px" width="40px" 
	 onclick="SetCheckByLine('{$smarty.foreach.val.index}')">
	  <label style="padding: 3px">
	   <a href="{$smarty.const.W_SITEPATH}account/admfilescontrol/?fid={$smarty.get.fid}&pid={$smarty.get.pid}&modify={$val.iditem}&new=1&modifytype=1" title="Edit file (to load another file)"><img src="{$smarty.const.W_SITEPATH}img/items/document_edit.png" width="16" height="16"></a>
	  </label>
	 </td>
     
     <td class="sth1" valign="center" align="center" style="padding-left: 4px" width="80px" 
	 onclick="SetCheckByLine('{$smarty.foreach.val.index}')">
	 {$val.dwcount}
	 </td>
     
     <td class="sth1" valign="center" align="center" style="padding-left: 4px" width="100px" 
	 onclick="SetCheckByLine('{$smarty.foreach.val.index}')">
	 {if !$val.useprice || !$val.pricevalue || $val.pricevalue <= 0}
      <em>(no)</em>
     {else}
      {$val.pricevalue} USD
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
    <td valign="center" align="center" class="btn_n" colspan="7">
     No downloaded files!
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
  
  {/if}
  </div>
  
 {/if}
</div>