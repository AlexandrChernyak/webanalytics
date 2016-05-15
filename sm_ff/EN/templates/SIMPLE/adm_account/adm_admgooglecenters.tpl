{* датацентры google *}
<div style="margin-top: 4px">
<div>
<a href="{$smarty.const.W_SITEPATH}account/admgooglecenters&new=1"{if $smarty.get.new} style="color: #000000"{/if}>Add datacenter(s)</a> | <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admgooglecenters/">All datacenters (<label style="color: #000000">{$global_googlecenters_count_info.all}</label>)</a>
</div>
<div style="margin-top: 12px">
{if !$smarty.get.new}
{* список датацентров *}
{literal}
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = {/literal}{if !$global_googlecenters_count_info.all}0{else}1{/if};{literal}  
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
   alert('Highlight at least one datacenter!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == 'delete') {
   if (!confirm('Do you really want to delete ['+count+'] datacenters?')) { return false; }
  } else 
  if (th.actionlistmakes.value == 'enabled') {
   if (!confirm('Do you really want to activate ['+count+'] datacenters?')) { return false; }
  } else
  if (th.actionlistmakes.value == 'disabled') {
   if (!confirm('Do you really want to deactivate ['+count+'] datacenters?')) { return false; }
  } else
  if (th.actionlistmakes.value == 'dall') {
   if (!allsaveenabled) { alert('No Data for delete!'); return false; }	
   if (!confirm('Do you really want to delete all datacenters?')) { return false; }	
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
  var f = document.getElementById('centersform');
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
<form method="post" name="centersform" id="centersform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Delete&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Delete all&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 160px;">
 </span>
 
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Enable&nbsp;" class="activatelistit" name="ena" id="ena" onclick="SetActionP('enabled')" style="//width: 80px;">
 </span>

 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Disable&nbsp;" class="deactivatelistit" name="dna" id="dna" onclick="SetActionP('disabled')" style="//width: 80px;">
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Datacenter</span></td>	
	<td class="h_td" valign="center" align="center" width="100px">Status</td>		
	<td class="h_td2" valign="center" align="center" width="130px">Date</td>
   </tr>	
   {if $global_data_list_info && $global_data_list_info.source}
	{foreach from=$global_data_list_info.source item=val name=val}
	 <tr onmouseover="DoHigl(this, 1, {$smarty.foreach.val.index})" onmouseout="DoHigl(this, 0, {$smarty.foreach.val.index})" id="t_r_{$smarty.foreach.val.index}">
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8">
	  <span style="margin-left: 4px">
	   <input type="checkbox" name="chid{$smarty.foreach.val.index}" id="chid{$smarty.foreach.val.index}" 
	   style="cursor: pointer" onclick="CheckItem('{$smarty.foreach.val.index}', this)">
	  </span>
	 </td>
	 <td class="sth1" valign="center" align="left" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	  <span style="margin-left: 3px">{$val.data}</span>	 
	 </td> 
	 <td class="sth1" valign="center" align="center" onclick="$('#chid{$smarty.foreach.val.index}').click()" width="100px">
	  {if $val.enabledit}
	   <i style="color: #333399">(active)</i>
	  {else}
	   <i>(disabled)</i>
	  {/if}	  	  	 
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
     No datacenters!
     <script type="text/javascript">
	  document.getElementById('checkallitems').disabled = true;
     </script>
    </td>
   </tr> 
   {/if} 
 </table>
 {if $global_data_list_info && $global_data_list_info.source}
 <div style="text-align: right; margin-top: 10px">{$global_data_list_info.pagestext}</div>
 {/if} 
 </span>
 </div> 
 <input type="hidden" value="0" name="actioncountmess">
 <input type="hidden" value="none" name="actionlistmakes"> 
</form>
<script type="text/javascript">SetEnabled();</script>
{else}
 {* добавление датацентров *}
 {literal}
 <script type="text/javascript"> 
  function PrepereSend(th) {	
   if (trim(th.list.value) == '') {
	alert('Specify a list of data centers (one per line)');
	th.list.focus();
	return false;
   }   
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;
   return true;   	
  }//PrepereSend	
 </script>
 {/literal}
 <form method="post" name="googledcformadd" id="googledcformadd" onsubmit="return PrepereSend(this)">

  <div class="typelabel"><label id="red">*</label> Data centers (one per line, example: www.google.com)</div>
  <div>
   <textarea class="int_text" style="height: 100px; width: 95%" name="list" id="list">{$CONTROL_OBJ->GetPostElement('list', 'googlecentersnew')}</textarea>
  </div>
  
  <div class="typelabel">
   <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('enabled') || $smarty.post.googlecentersnew != 'do'} checked="checked" {/if}style="cursor: pointer" name="enabled" id="enabled"><label for="enabled" style="cursor: pointer">&nbsp;Add active</label>  
  </div>
  
 <input type="hidden" value="do" name="googlecentersnew">
 <div class="typelabel"><input type="submit" value="&nbsp;Add new datacenter(s)&nbsp;" class="button" name="rb" id="rb"></div>
 </form>
 {if $err_str_inv}
 <div style="margin-top: 8px">
   <label style="color: #008000">{$err_str_inv}</label>
 </div>
 {/if}
{/if}
</div>
</div>