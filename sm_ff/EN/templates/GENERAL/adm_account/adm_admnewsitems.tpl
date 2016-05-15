{* новости *}
<div style="margin-top: 4px">



<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
 <td valign="top" align="left">
 <div>
 <div>Language version of website</div>
 <div style="margin-top: 4px">
  <select size="1" name="sitelanguage" id="sitelanguage" onchange="NavigateLangType(this)">
   {foreach from=$adm_object->GetResult('language') item=val name=val}
   <option{if $adm_object->GetLang() == $val.id} selected="selected"{/if} value="{$val.id}">{$val.name} ({$val.count})</option>
   {/foreach}
  </select>  
 </div>
 </div>
 </td>
 <td valign="top" align="right">
 <div>
 <div>Section News\articles</div>
 <div style="margin-top: 4px">
  {assign var="listnewssections" value=$CONTROL_OBJ->GetNewsSectionListElements($adm_object->GetLang())}
  <select size="1" name="ntype" id="ntype" onchange="NavigateSectionType(this)"{if !$listnewssections} style="color: #808080; font-style: italic;"{/if}>
   {if !$listnewssections}
    <option value="">No active partitions</option>
   {else}
   <option value="0" style="color: #333399">All partitions ({$adm_object->GetSpecialNewsCount(0)})</option>  
   {foreach from=$listnewssections item=val name=val}
   <option{if $smarty.get.ntype == $val.data.iditem} selected="selected"{/if} value="{$val.data.iditem}">{$val.data.sname} ({$adm_object->GetSpecialNewsCount($val.data.iditem)})</option>
   {/foreach}
   {/if}
  </select>  
 </div>
 <div style="margin-top: 4px">
 <a href="{$smarty.const.W_SITEPATH}account/admnewsitems/&ntype={$smarty.get.ntype}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}&lang={$adm_object->GetLang()}&assection=1">Partition Management{if !$smarty.get.assection} (<label style="color: #000000">{$adm_object->GetResult('rcount')}</label>){/if}</a>
 </div>
 </div>
 </td>
</tr>
</table>

<div style="margin-top: 4px; border-bottom: 1px solid #969696">&nbsp;</div>
{literal}
<script type="text/javascript">
 function NavigateLangType(th) {
  var path = {/literal}'{$smarty.const.W_SITEPATH}account/admnewsitems/&ntype=0{if $smarty.get.oldpage}&oldpage={$smarty.get.oldpage}{/if}{if $smarty.get.page}&page={$smarty.get.page}{/if}{if $smarty.get.new}&new=1{/if}';{literal}
  document.location = path + '&lang=' + th.value;  	
 }//NavigateLangType
 
 function NavigateSectionType(th) {
  if (th.value == '') { return false; }	
  var path = {/literal}'{$smarty.const.W_SITEPATH}account/admnewsitems/{if $smarty.get.oldpage}&oldpage={$smarty.get.oldpage}{/if}{if $smarty.get.page}&page={$smarty.get.page}{/if}{if $smarty.get.new}&new=1{/if}{if $smarty.get.lang}&lang={$smarty.get.lang}{/if}';{literal}
  document.location = path + '&ntype=' + th.value;	
 }//NavigateSectionType	
 
 
</script>
{/literal}

<div style="margin-top: 7px">
{if $smarty.get.ntype || $smarty.get.assection}<a href="{$smarty.const.W_SITEPATH}account/admnewsitems/&ntype={$smarty.get.ntype}&new=1{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}&lang={$adm_object->GetLang()}{if $smarty.get.assection}&assection=1{/if}"{if $smarty.get.new && !$adm_object->GetResult('modifyinfo')} style="color: #000000"{/if}>Add {if $smarty.get.assection}partition{else}news\article{/if}</a> | {/if}<a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admnewsitems/&ntype={$smarty.get.ntype}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}&lang={$adm_object->GetLang()}{if $smarty.get.assection}&assection=1{/if}">{if $smarty.get.assection}All partitions (<label style="color: #000000">{$adm_object->GetResult('rcount')}</label>){else}All News (<label style="color: #000000">{$adm_object->GetResult('count')}</label>){/if}</a>{if $smarty.get.assection}   | <a href="{$smarty.const.W_SITEPATH}account/admnewsitems/&ntype={$smarty.get.ntype}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}&lang={$adm_object->GetLang()}"> << Back to News list (<label style="color: #000000">{$adm_object->GetResult('count')}</label>)</a>{/if}
</div>

<div style="margin-top: 12px">
{* разделы *}
{if $smarty.get.assection}
 
 {* новый раздел \ изменение *}
 {if $smarty.get.new}
 
 {literal}
 <script type="text/javascript">         
    function PrepereSend(th) {
	 
	 if (!th.sname.value) {
	  alert('Enter the name of the section!');
	  th.sname.focus();
	  return false;	
	 }
	 
	 if (!$('#w-perpagecount').val()) {
	  alert('Specify the number of comments on one page in the section!');
	  $('#w-perpagecount').focus();
	  return false;	
	 }
	 
	 if (!$('#w-pathobjects').val()) {
	  alert('Specify the global path section!');
	  $('#w-pathobjects').focus();
	  return false;	
	 }
	 
	 if (!$('#w-newstitletospec').val()) {
	  alert('Specify the global name of the section!');
	  $('#w-newstitletospec').focus();
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
     document.getElementById('addnewssectionitem').actionnewprvmail.value = (n) ? 'act' : 'prev';	
    }//SetActionIdent	
 </script>
 {/literal} 
  
  <form method="post" name="addnewssectionitem" id="addnewssectionitem" onsubmit="return PrepereSend(this)">
   
   {if $adm_object->GetResult('modifyinfo')}
   <div style="margin-top: 15px; margin-bottom: 15px; background: #F0F0F0; padding: 3px"><b>Setting section</b></div>   
   {/if}   
    
   <div class="typelabel"><label id="red">*</label> Section Name (up to 120 characters)</div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 94%" name="sname" id="sname" maxlength="120" value="{$adm_object->GetAsElementP('sname')}">
   </div>
   
   <div class="typelabel" style="margin-top: 12px; margin-bottom: 12px">
    <b>Options section</b>
   </div>
    
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('w-enabled') || $smarty.post.actionthissectnnews != 'do'} checked="checked" {/if}style="cursor: pointer" name="w-enabled" id="w-enabled"><label for="w-enabled" style="cursor: pointer">&nbsp;Allow comment news/articles</label>  
   </div>
  
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('w-withmodercomment') || $smarty.post.actionthissectnnews != 'do'} checked="checked" {/if}style="cursor: pointer" name="w-withmodercomment" id="w-withmodercomment"><label for="w-withmodercomment" style="cursor: pointer">&nbsp;When you add a comment send it to the test administrator</label>  
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('w-withcaptcha') || $smarty.post.actionthissectnnews != 'do'} checked="checked" {/if}style="cursor: pointer" name="w-withcaptcha" id="w-withcaptcha"><label for="w-withcaptcha" style="cursor: pointer">&nbsp;Use security captcha to add comments</label>  
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('w-showimages')} checked="checked" {/if}style="cursor: pointer" name="w-showimages" id="w-showimages"><label for="w-showimages" style="cursor: pointer">&nbsp;Display image preview section</label>  
   </div>
   
   <div class="typelabel"><label id="red">*</label> Comments on 1 page</div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 250px" name="w-perpagecount" id="w-perpagecount" maxlength="3" value="{$adm_object->GetAsElementP('w-perpagecount','actionthissectnnews', 'do', '15')}">
   </div>
   
   <div class="typelabel"><label id="red">*</label> Global road section (used as an alias for the section /news/)<br />Used to specify the path of individual sections, an example:<br />
   http://project/<b>news</b>/2 - marked `bold` id (maximum 120 characters)</div>
   <div class="typelabel">
    <input type="text" class="inpt" maxlength="120" style="width: 250px" name="w-pathobjects" id="w-pathobjects" value="{$adm_object->GetAsElementP('w-pathobjects','actionthissectnnews', 'do', 'news')}">
   </div>
   
   <div class="typelabel"><label id="red">*</label> Use the specified section name (the name indicates 'global' section and displayed by:<br />
   Home -> <b>name</b> -> way forward). For example, `news` or `articles` (maximum 120 characters)</div>
   <div class="typelabel">
    <input type="text" class="inpt" maxlength="120" style="width: 250px" name="w-newstitletospec" id="w-newstitletospec" value="{$adm_object->GetAsElementP('w-newstitletospec','actionthissectnnews')}">
   </div>
   
   <div class="typelabel">Use the specified text in the absence of a list of news/articles section. For example: `No news!` Or `There is no added articles!` Etc (max 120 characters)</div>
   <div class="typelabel">
    <input type="text" class="inpt" maxlength="120" style="width: 250px" name="w-noelementstext" id="w-noelementstext" value="{$adm_object->GetAsElementP('w-noelementstext','actionthissectnnews')}">
   </div>
   
   {if $smarty.post.actionnewprvmail == 'prev'}
   <div style="padding: 4px; border: 1px solid #666699; margin-bottom: 20px; margin-top: 10px; width: 94%;">
   {$CONTROL_OBJ->strings->CorrectTextFromDB($CONTROL_OBJ->strings->CorrectTextToDB($smarty.post.wsource))}  
   </div>
   {/if} 
   
   <div class="typelabel">Section Description</div>
   <div class="typelabel">
    {include file='new_message.tpl' ident='wsource' source=$smarty.post.wsource height='90px' width='95%'}
   </div>
   
   <div class="typelabel" style="margin-top: 15px">
    <input type="hidden" value="do" name="actionthissectnnews">
   </div> 
   
   <input type="submit" value="&nbsp;{if !$adm_object->GetResult('modifyinfo')}Add section{else}Change section parameters{/if}&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp;
   <input type="submit" value="&nbsp;Preview description&nbsp;" class="button" name="rbp" id="rbp" onclick="SetActionIdent(0)">
   <input type="hidden" value="prev" name="actionnewprvmail">
   <input type="hidden" value="ok" name="actionnewsectionnews">
  </form>  
  
  {if $smarty.post.actionthissectnnews == 'do' && !$smarty.post.actionthissectionpost_q && $smarty.post.actionnewprvmail != 'prev'}
 <div style="margin-top: 10px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">{if !$adm_object->GetResult('modifyinfo')}Section successfully added!{else}Options section were changed!{/if}</label>
  {/if}
 </div>
 {/if}
 
 {* установка изображения *}
 {if $adm_object->GetResult('modifyinfo')}
  <div style="margin-top: 15px; margin-bottom: 15px; background: #F0F0F0; padding: 3px">
  <b>Image section (small)</b>
  </div> 
  {if $adm_object->GetResult('modifyinfo.data.avatar')}
   <div style="padding: 4px">
    <img src="{$adm_object->GetResult('modifyinfo.data.avatar')}" border="0" alt="Image">
   </div>
  {/if}  
  <form method="post" name="addnewnews4" id="addnewnews4" enctype="multipart/form-data" onsubmit="return PrepereSend4(this)"> 
   <div class="typelabel"> Image Preview (optional) (Formats: {$adm_object->GetListTypes()}{if $adm_object->GetResult('maxsize')}, max size: <b>{$adm_object->GetResult('maxsize')}</b>){/if}</div>
   <div style="font-size: 95%">To delete an image - leave blank.</div>
   <div class="typelabel">
    <input type="file" size="20" style="width: 95%; height: 22px" class="inpt" name="image" id="image">
   </div>
   <div class="typelabel" style="margin-top: 6px">
    <input type="submit" value="&nbsp;Save Image&nbsp;" class="button" name="rb" id="rb">
   </div> 
   <input type="hidden" value="do" name="actionthissectnnews4">
  </form> 
  
  {if $smarty.post.actionthissectnnews4 == 'do'}
   <div style="margin-top: 10px">
   {if $adm_object->error}
    <label style="color: #FF0000">{$adm_object->error}</label>
   {else}
    <label style="color: #008000">Image successfully changed!</label>
   {/if}
   </div>
  {/if}
  
 {/if} 
 
 {else}
  {* список разделов *}
  {if !$adm_object->GetResult('data.source')}
   <div style="text-align: center; padding: 6px; margin-top: 25px"><b>No active sections!</b></div>
  {else}
   {literal}
    <script type="text/javascript">
	 function DeleteSelectedElementSection(ident) {
	  if (!confirm("Are you sure you want to delete the selected partition?\r\nNews/Articles, in this section will not be deleted - go into `general` section and will no longer appear in the public section!\r\nContinue?")) {
	   return false;	
	  }	
	  var ppf = {/literal}'{$smarty.const.W_SITEPATH}account/admnewsitems/&ntype={$smarty.get.ntype}{if $smarty.get.page}&page={$smarty.get.page}{/if}&lang={$adm_object->GetLang()}&assection=1'{literal};  
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
		 <img src="{$val.avatar}" border="0">
		</td>	
		
	    <td valign="top" align="left">
		 <div>{$val.sname}<label style="margin-left: 6px; font-size: 95%; color: #333399"><i>(contains: {$adm_object->GetSpecialNewsCount($val.iditem)})</i></label></div>
		 <div style="margin-top: 4px; font-size: 95%; color: #808080">
		  {assign var="itemdescrit" value=$CONTROL_OBJ->strings->CorrectTextFromDB($val.sdescr)}
		  {if !$itemdescrit}No description{else}{$itemdescrit}{/if}
		 </div>
		</td>
		
	    <td valign="top" align="right">
		 <div style="white-space: nowrap;">		 
		 
		 <a href="{$smarty.const.W_SITEPATH}account/admnewsitems/&modify={$val.iditem}&new=1&ntype={$smarty.get.ntype}{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}&lang={$adm_object->GetLang()}&assection=1" title="Modify"><img src="{$smarty.const.W_SITEPATH}img/items/document_edit.png" width="16" height="16"></a>
		 
		 <a style="margin-left: 6px" href="javascript:" onclick="DeleteSelectedElementSection('{$val.iditem}')" title="Delete"><img src="{$smarty.const.W_SITEPATH}img/items/erase.png" width="16" height="16"></a>
		 
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
 {/if} 

{else}

{if !$smarty.get.new || !$smarty.get.ntype}
{* список новостей *}
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
   alert('Select at least one record!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == 'delete') {
   if (!confirm('Are you sure you want to delete ['+count+'] records?')) { return false; }
  } else 
  if (th.actionlistmakes.value == 'dall') {
   if (!allsaveenabled) { alert('No Data for Delete!'); return false; }	
   if (!confirm('Are you sure you want to delete all records?')) { return false; }	
  } else
  if (th.actionlistmakes.value == 'moveto') {
   if (!confirm('Are you sure you want to move ['+count+'] records in section ['+$('#ntypeMove option:selected').text()+']?')) { return false; }
   	
  } else { alert('Unknow identifier!'); return false; }
  return true;   	
 }//PrepereSend
 function SetEnabled() {  	
  var count = GetSelCount();
  setElementOpacity(document.getElementById('adid'), (allsaveenabled) ? 1 : 0.3);
  if (count <= 0) {
   setElementOpacity(document.getElementById('did'), 0.3);
   $('#ntypeMove').attr('disabled', 'disabled');
   $('#ntypeMoveLabel').css('color', '#C0C0C0');
   return ;	 
  }
  setElementOpacity(document.getElementById('did'), 1);
  $('#ntypeMove').attr('disabled', '');
  $('#ntypeMoveLabel').css('color', '#000000');
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
 <input type="submit" value="&nbsp;Delete&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Delete All&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 160px;">
 </span>
 
 <span style="margin-left: 8px">
  {literal}
  <script type="text/javascript">
   function ActionToMoveToItems(th) {
	if (th.value == '') { return false; }
	SetActionP('moveto');
	$('#identtomoveelement').val(th.value);
	$('#vnewsform').submit();	
   }//ActionToMoveToItems	
  </script>
  {/literal}
  <i id="ntypeMoveLabel">Move to:</i> 
  <select size="1" name="ntypeMove" id="ntypeMove" style="border: none; margin-left: 6px" onchange="ActionToMoveToItems(this)">
  <option value="" selected="selected" style="color: #333399">Select section</option>
  {foreach from=$listnewssections item=val name=val} 
   <option value="{$val.data.iditem}">{$val.data.sname}</option> 
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Record</span></td>
	{if $smarty.get.ntype}<td class="h_td" valign="center" align="center" width="30px">A-N</td>{/if}
    <td class="h_td" valign="center" align="center" width="40px"><img title="Attachments (Binding file)" src="{$smarty.const.W_SITEPATH}img/ico/general/pages.png" alt="file" /></td>
	<td class="h_td" valign="center" align="center" width="110px">Views</td>
	<td class="h_td" valign="center" align="center" width="110px">Comments</td>
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
	  {if $val.dwnameimg}
	   <a href="{$smarty.const.W_SITEPATH}pfiles/images/{$val.dwnameimg}" target="_blank"><img src="{$smarty.const.W_SITEPATH}pfiles/images/{$val.dwnameimg}" border="0" width="24" height="24" style="float: left; margin-right: 3px"></a>
	  {/if}	  
	  <div><a style="text-decoration: none;" href="{$smarty.const.W_SITEPATH}news/{$val.newtype}/{$val.iditem}/" target="_blank">{$val.newtitle}</a></div>
	  {if !$smarty.get.ntype && $adm_object->GetSectionInfoData($val.newtype, 'sname')}
	  <div style="margin-top: 4px; color: #808080; font-style: italic; font-size: 95%">
	  ({$adm_object->GetSectionInfoData($val.newtype, 'sname')})
	  </div>
	  {/if}	  	 
	 </td> 
	 
	 {if $smarty.get.ntype}
	 <td class="sth1" valign="center" align="center" onclick="SetCheckByLine('{$smarty.foreach.val.index}')" width="30px">
	  <label style="padding: 3px">
	   <a href="{$smarty.const.W_SITEPATH}account/admnewsitems/&modify={$val.iditem}&new=1&ntype={$smarty.get.ntype}{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}&lang={$adm_object->GetLang()}" title="Modify"><img src="{$smarty.const.W_SITEPATH}img/items/document_edit.png" width="16" height="16"></a>
	  </label>	  	  	 
	 </td>
	 {/if}
	 
     <td class="sth1" valign="center" align="center" onclick="SetCheckByLine('{$smarty.foreach.val.index}')" width="40px">
	 <a href="{$smarty.const.W_SITEPATH}account/admfilescontrol/?fid=1&pid={$val.iditem}" target="_blank" title="Investment management (Binding file)">{$CONTROL_OBJ->GetObjectFilesCount(1, $val.iditem)}</a>	  	  	 
	 </td>
     
	 <td class="sth1" valign="center" align="center" onclick="SetCheckByLine('{$smarty.foreach.val.index}')" width="110px">
	  {$val.newlooks}	  	  	 
	 </td>
	 
	 <td class="sth1" valign="center" align="center" onclick="SetCheckByLine('{$smarty.foreach.val.index}')" width="110px">
	  {$adm_object->GetCommentsCountForNews($val)}	  	  	 
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
     No Records!
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
 <input type="hidden" value="" name="identtomoveelement" id="identtomoveelement">
 <input type="hidden" value="none" name="actionlistmakes"> 
</form>
<script type="text/javascript">SetEnabled();</script>
{else}
 {* добавление новости *}
 {literal}
 <script type="text/javascript">         
    function PrepereSent(th) {		 	
	 if (trim(th.title.value) == '') {
	  alert('Enter the name of news!');
	  th.title.focus();
	  return false;	
	 }	
	 if (trim(th.source.value) == '') {
	  alert('Enter the text of the news!');
	  th.source.focus();
	  return false;	
	 } 	 	 
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
 
 {if $adm_object->GetResult('modifyinfo')}
  <div style="border: 1px dashed #969696; padding: 4px; width: 94%">
  
  <div><b>Changing News: </b></div> 
  {if $adm_object->GetResult('modifyinfo.dwnameimg')}
  <div>
   <img src="{$smarty.const.W_SITEPATH}pfiles/images/{$adm_object->GetResult('modifyinfo.dwnameimg')}" border="0">
  </div>
  {/if}
  <div style="margin-top: 4px">
   <a href="{$smarty.const.W_SITEPATH}news/{$smarty.get.ntype}/{$adm_object->GetResult('modifyinfo.iditem')}/" target="_blank">{$adm_object->GetResult('modifyinfo.newtitle')}</a>
  </div>
  
  </div>
  <div style="margin-top: 8px">&nbsp;</div>
  {/if}
 
 <div>
  {if $smarty.post.actionnewprvmail == 'prev'}
  <div style="padding: 4px; border: 1px solid #775D41; margin-bottom: 20px; width: 94%;">
   {$adm_object->GetPrevSourceData('source')}  
  </div>
  {/if} 
 </div>
 
 <script type="text/javascript" src="http://{$smarty.const.W_HOSTMYSITE}/js/tiny_mce/tiny_mce.js"></script>
 {literal}
 <script type="text/javascript">
   var lastformattedform = '';
   
   function SwithToHtmlEditorOrFormatterBlock(html_checker_id, ident) {
    //sourcearticledata
    var ch = ($('#'+html_checker_id).attr('checked')) ? true : false;
    
    if (!ch && lastformattedform == '') { return false; }
    
    if (ch) {
        
     //save current formatted data   
     if (lastformattedform == '') {
      lastformattedform = $('#sourcearticledata').html();       
     }  
     
     //init data object
      
      var style = $('#'+ident).attr('style');
      var source = $('#'+ident).val();  
          
      $('#sourcearticledata').html('<textarea class="inp_new_text" style="'+style+'" name="'+ident+'" id="'+ident+'">'+source+'</textarea>');
      
      tinyMCE.init({
	 	language : "{/literal}{$CONTROL_OBJ->strtolower($CONTROL_OBJ->GetActiveLanguage())}{literal}",
	 	mode : "exact",
	 	elements : ident,
	 	theme : "advanced",
	 	plugins : "safari,spellchecker,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,pagebreak",
	 	theme_advanced_buttons1_add_before : "save,newdocument,separator",
	 	theme_advanced_buttons1_add : "fontselect,fontsizeselect",
	 	theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,separator,forecolor,backcolor",
	 	theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
	 	theme_advanced_buttons3_add_before : "tablecontrols,separator",
	 	theme_advanced_buttons3_add : "emotions,iespell,media,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
	 	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,spellchecker,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
	 	theme_advanced_toolbar_location : "top",
	 	theme_advanced_toolbar_align : "left",
	 	theme_advanced_statusbar_location : "bottom",
	 	plugin_insertdate_dateFormat : "%Y-%m-%d",
	 	plugin_insertdate_timeFormat : "%H:%M:%S",
	 	theme_advanced_resize_horizontal : true,
	 	theme_advanced_resizing : true,
	 	apply_source_formatting : false,
	 	valid_elements : "*[*]", 
	 	remove_linebreaks : false,
	 	forced_root_block : '',
	 	spellchecker_languages : "+English=en,Danish=da,Dutch=nl,Finnish=fi,French=fr,German=de,Italian=it,Polish=pl,Portuguese=pt,Spanish=es,Swedish=sv"
	  });       
     
     return true;        
    }
    
    if (lastformattedform == '') {
     
     lastformattedform = '<textarea class="inp_new_text" style="'+style+'" name="'+ident+'" id="'+ident+'">'+source+'</textarea>';
     $('#sourcearticledata').html(lastformattedform);   
        
    } else {
            
     $('#sourcearticledata').html(lastformattedform);
     
    }    
    
   }//SwithToHtmlEditorOrFormatterBlock	
   
   $(document).ready(function() {  
    var htmluse = {/literal}{if $CONTROL_OBJ->CheckPostValue('contenttype')}true{else}false{/if}{literal};
    if (htmluse) {
     
     SwithToHtmlEditorOrFormatterBlock('contenttype', 'source');   
        
    }     
   }); 
 </script>
 {/literal} 
 
 <form method="post" name="addnewnews" id="addnewnews" enctype="multipart/form-data" onsubmit="return PrepereSent(this)">

  <div class="typelabel"><label id="red">*</label> Title News\Articles\Records (up to 200 characters)</div>
      <div class="typelabel">
       <input type="text" class="inpt" style="width: 94%" name="title" id="title" maxlength="120" value="{$CONTROL_OBJ->GetPostElement('title','actionthissectionpost')}">
      </div>
      
      <div class="typelabel">Keywords (tag keywords) (up to 250 characters), it is empty - uses the default keyword</div>
      <div class="typelabel">     
       <textarea class="int_text" style="height: 50px; width: 95%" name="keywordsnews" id="keywordsnews">{$CONTROL_OBJ->GetPostElement('keywordsnews','actionthissectionpost')}</textarea>
      </div>
      
      <div class="typelabel">Tag description (up to 250 characters), it is empty - uses the default description</div>
      <div class="typelabel">     
       <textarea class="int_text" style="height: 50px; width: 95%" name="tdescription" id="tdescription">{$CONTROL_OBJ->GetPostElement('tdescription','actionthissectionpost')}</textarea>
      </div>      
      
      <div class="typelabel"><label id="red">*</label> News\Articles\Records source text</div>
      <div class="typelabel" id="sourcearticledata">
       {include file='new_message.tpl' ident='source' source=$adm_object->GetNormalDescriptionSource('source') height='220px' width='95%'}
      </div>
      
      <div class="typelabel">
       <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('contenttype')} checked="checked" {/if}style="cursor: pointer" name="contenttype" id="contenttype" onclick="SwithToHtmlEditorOrFormatterBlock('contenttype', 'source')"><label for="contenttype" style="cursor: pointer">&nbsp;The contents of articles in pure HTML</label>
      </div>
      <div style="color: #808080; font-size: 95%; margin-bottom: 14px">
      (if checked - formatting tags will not be counted - all content will be given a clean html code!!)
      </div>
      
      <div class="typelabel"> Image Preview (optional) (Formats: {$adm_object->GetListTypes()}{if $adm_object->GetResult('maxsize')}, max size: <b>{$adm_object->GetResult('maxsize')}</b>){/if}</div>
      <div style="font-size: 95%">To delete an image, or to create news without pictures - leave blank.</div>
      <div class="typelabel">
       <input type="file" size="20" style="width: 95%; height: 22px" class="inpt" name="image" id="image">
      </div>    
      
 
 <div class="typelabel" style="margin-top: 15px">
  <input type="submit" value="&nbsp;{if !$adm_object->GetResult('modifyinfo')}Add News{else}Save Changes{/if}&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp;
  <input type="submit" value="&nbsp;Preview Description&nbsp;" class="button" name="rbp" id="rbp" onclick="SetActionIdent(0)">
 </div>
 <input type="hidden" value="prev" name="actionnewprvmail"> 
 <input type="hidden" value="{$CONTROL_OBJ->GetPostElement('ptype','actionthissectionpost')}" name="ptype" id="ptype"> 
 <input type="hidden" value="do" name="actionthissectionpost">
 </form>
 
 {if $smarty.post.actionthissectionpost == 'do' && !$smarty.post.actionthissectionpost_q && $smarty.post.actionnewprvmail != 'prev'}
 <div style="margin-top: 10px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">News successfully {if !$adm_object->GetResult('modifyinfo')}added{else}changed{/if}!</label>
  {/if}
 </div>
 {/if}
{/if}
{/if} {* разделы *}
</div>
</div>