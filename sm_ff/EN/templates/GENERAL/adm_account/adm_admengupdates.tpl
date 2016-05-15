{* апдейты поисковиков *}
<div style="margin-top: 4px">
<div>
<a href="{$smarty.const.W_SITEPATH}account/admengupdates&new=1"{if $smarty.get.new} style="color: #000000"{/if}>Add Updates</a> | {if $smarty.get.new}<a href="{$smarty.const.W_SITEPATH}account/admengupdates/">Updates List (<label style="color: #000000">{$global_updates_count_info.0}</label>)</a>{else}
<select size="1" style="width: 170px" name="ischlist" id="ischlist" onchange="DoGoToTypeLocation(this)">
 <option value="0" style="color: #0000FF">All Updates ({$global_updates_count_info.0})</option>
 <option value="1"{if $smarty.get.etype == '1'} selected="selected"{/if}>Yandex CY ({$global_updates_count_info.1})</option>
 <option value="2"{if $smarty.get.etype == '2'} selected="selected"{/if}>Yandex search ({$global_updates_count_info.2})</option>
 <option value="3"{if $smarty.get.etype == '3'} selected="selected"{/if}>Yandex directory ({$global_updates_count_info.3})</option>
 <option value="4"{if $smarty.get.etype == '4'} selected="selected"{/if}>Google PR ({$global_updates_count_info.4})</option>
</select>
{/if}
</div>
<div style="margin-top: 12px">
{if !$smarty.get.new}
{* список апдейтов *}
{literal}
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = {/literal}{if !$global_updates_count_info.0}0{else}1{/if};{literal}  
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
   alert('Highlight at least one update!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == 'delete') {
   if (!confirm('Do you really want to delete ['+count+'] updates?')) { return false; }
  } else if (th.actionlistmakes.value == 'dall') {
   if (!allsaveenabled) { alert('No data for delete!'); return false; }	
   if (!confirm('Do you really want to delete all the updates?')) { return false; }	
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
  var f = document.getElementById('updatesform');
  if (!f) { return ; }
  f.actionlistmakes.value = a;   	
 }//SetActionP
 function DoGoToTypeLocation(th) {
  var pathtolocale = '{/literal}{$smarty.const.W_SITEPATH}'{literal};
  var page = '{/literal}{if $smarty.post.page > 1}{$smarty.post.page}{else}0{/if}'{literal};
  var stype = (th.value == '0') ? '' : 'etype='+th.value;  
  if (page > 1) { stype = (!stype) ? 'page='+page : stype + '&page=' + page; }
  stype = (stype) ? '&'+stype : '/';  
  document.location = pathtolocale + 'account/admengupdates' + stype;   	
 }//DoGoToTypeLocation    	
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
<form method="post" name="updatesform" id="updatesform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Delete&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Delete all Updates&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 160px;">
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Type</span></td>	
	<td class="h_td" valign="center" align="center" width="80px">Method</td>	
	<td class="h_td2" valign="center" align="center" width="130px">Date</td>
   </tr>	
   {if $global_data_list_info && $global_data_list_info.source}
	{foreach from=$global_data_list_info.source item=val name=val}
	 <tr onmouseover="DoHigl(this, 1, {$smarty.foreach.val.index})" onmouseout="DoHigl(this, 0, {$smarty.foreach.val.index})" id="t_r_{$smarty.foreach.val.index}">
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E4D9CB; border-right: 1px solid #E4D9CB">
	  <span style="margin-left: 4px">
	   <input type="checkbox" name="chid{$smarty.foreach.val.index}" id="chid{$smarty.foreach.val.index}" 
	   style="cursor: pointer" onclick="CheckItem('{$smarty.foreach.val.index}', this)">
	  </span>
	 </td>
	 <td class="sth1" valign="center" align="left" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	  <span style="margin-left: 3px">{$CONTROL_OBJ->GetEngineUpdateDescription($val.engtype)}</span>	 
	 </td> 
	 <td class="sth1" valign="center" align="center" onclick="$('#chid{$smarty.foreach.val.index}').click()" width="80px">
	  {if !$smarty.const.W_ADMENGINEUPDATESAUTOADD || ($val.engtype == 4 && !$smarty.const.W_AUTOCREATEPRUPDATESLIST)}
	   <i>(нет)</i>
	  {else}
	   	<i style="color: #333399">(auto)</i>  
	  {/if}	  	 
	 </td>
	 <td class="sth1" valign="center" align="center" width="130px" style="border-right: 1px solid #E4D9CB;" 
	 onclick="$('#chid{$smarty.foreach.val.index}').click()">
	 {$val.dateupd}
	 </td>
    </tr>  
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.iditem}" name="idm{$smarty.foreach.val.index}">
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="5">
     No Active updates!
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
 {* добавление апдейтов *}
 {literal}
 <script type="text/javascript">
  var curDate = new Date(); 
  function CheckDateS(s) {	
   var Pat=/^(\d{4})\-(\d{2})\-(\d{2})$/;
   var DArray = s.match(Pat);
   if (DArray != null) { 	    	
   	if (DArray[2] <= 0 || DArray[2] > 12) { return false; }
   	if (DArray[3] <= 0 || DArray[3] > 31) { return false; }
   	if (DArray[1] <= 0 || DArray[1] > curDate.getFullYear()) { return false; }
   	return true;
   }
   return false;
  }//CheckDateS 
  function RestInp(th) {
   if (th.value == '' || !CheckDateS(th.value)) {
	 th.className = 'inpt_r';
	 return ;	
	}	
   th.className = 'inpt';	
  }//RestInp
  function PrepereSend(th) {
   RestInp(th.upddate);	
   if (th.upddate.value == '' || !CheckDateS(th.upddate.value)) {
	alert('Specify date to add, format: YYYY-mm-dd');
	th.upddate.focus();
	return false;
   }   
   return true;   	
  }//PrepereSend	
 </script>
 {/literal}
 <form method="post" name="updatesformadd" id="updatesformadd" onsubmit="return PrepereSend(this)">
  <div class="typelabel"><label id="red">*</label> Add in</div>
  <div>
  <select size="1" style="width: 320px" name="updtype" id="updtype">
   <option value="1"{if $smarty.post.updtype == '1'} selected="selected"{/if}>Yandex CY</option>
   <option value="2"{if $smarty.post.updtype == '2'} selected="selected"{/if}>Yandex search</option>
   <option value="3"{if $smarty.post.updtype == '3'} selected="selected"{/if}>Yandex directory</option>
   <option value="4"{if $smarty.post.updtype == '4'} selected="selected"{/if}>Google PR</option>
  </select>
  </div>
  
  <div class="typelabel"><label id="red">*</label> Date (format: YYYY-mm-dd)</div>
  <div><input type="text" class="inpt" style="width: 320px" name="upddate" id="upddate" value="{$CONTROL_OBJ->GetPostElement('upddate', 'updatesactionnew', 'do', $CONTROL_OBJ->GetThisDate())}" onclick="RestInp(this)" onblur="RestInp(this)" maxlength="10"></div>
  
 <input type="hidden" value="do" name="updatesactionnew">
 <div class="typelabel"><input type="submit" value="&nbsp;Add Date&nbsp;" class="button" name="rb" id="rb"></div>
 </form>
 {if $err_str_inv}
 <div style="margin-top: 8px">
  {if $err_str_inv != 1}
   <label style="color: #FF0000">{$err_str_inv}</label>
  {else}
   <label style="color: #008000">Date added successfully!</label>
  {/if}
 </div>
 {/if}
{/if}
</div>
</div>