{* обзор статистики информера *}
<div style="margin-top: 4px">
<div>

<div><a href="{$smarty.const.W_SITEPATH}account/adminformersfiles/&inftype={if $smarty.get.inftype}{$smarty.get.inftype}{else}1{/if}&sections={if $smarty.get.sections}{$smarty.get.sections}{else}0{/if}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}">Informers List</a> :: <b>history of use informer</b></div>

<div style="margin-top: 7px"><img src="{$smarty.const.W_SITEPATH}account/adminformersfiles/&getimage={$smarty.get.statisticinfo}" style="margin-right: 6px; position: relative;"></div>

<div style="margin-top: 5px">Person uses: <b>{$adm_object->GetResult('count')}</b></div>
<div style="margin-top: 4px">Total Hits: <b>{if $adm_object->GetResult('info.allrequist')}{$adm_object->GetResult('info.allrequist')}{else}0{/if}</b></div>
<div style="margin-top: 4px">Date of last request:  <b>{if $adm_object->GetResult('info.lastquery')}{$adm_object->GetResult('info.lastquery')}{else}?{/if}</b>{if $adm_object->GetResult('info.lastquerystr')}<label style="margin-left: 6px; font-size: 95%">[ {$adm_object->GetResult('info.lastquerystr')} ]</label>{/if}</div>

</div>
<div style="margin-top: 12px">
{literal}
<script type="text/javascript">
 function PrepereSend(th) {
  var count = GetSelCount();
  if (count <= 0 && th.actionlistinvitecode.value != 'dall') { 
   alert('Mark at least one record!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistinvitecode.value == 'delete') {
   if (!confirm('Do you really want to delete ['+count+'] records? Everyone who uses the data record of the informer would lose informer on your site! .. Continue?')) { return false; }
  } else if (th.actionlistinvitecode.value == 'dall') {
   if (!allsaveenabled) { alert('No data for delete!'); return false; }	
   if (!confirm('Do you really want to delete all records? Everyone who uses the data record of the informer would lose informer on your site! Continue?')){
   	return false; 
   }	
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
 <input type="submit" value="&nbsp;Delete&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Delete all records&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 150px;">
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Parameter</span></td>	
	<td class="h_td" valign="center" align="center" width="130px">Reg. date</td>
	<td class="h_td" valign="center" align="center" width="130px">Last Updated</td>
	<td class="h_td" valign="center" align="center" width="130px">Last request</td>
	<td class="h_td" valign="center" align="center" width="50px">File</td>	
	<td class="h_td2" valign="center" align="center" width="80px">Queries</td>
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
	  <span style="padding: 3px">
	  {if $val.informtype == 3}<a href="http://{$val.identuse}" target="_blank">{$val.identuse}</a>{else}{$val.identuse}{/if} 
	  
	  {if $adm_object->GetColorInformer($val)}
	  <span style="display: inline-block; width: 12px; background: {$adm_object->GetColorInformer($val)}" title="The color of informer, selected by user">
	  &nbsp;
	  </span>
	  {/if}
	  
	  {if $val.informlink}
	  <div style="margin-top: 8px; margin-left: 3px; margin-bottom: 4px; font-size: 95%">Fixed on: 
	  <a href="{$val.informlink}" target="_blank">{$val.informlink}</a></div>
	  {/if}	  
	  </span>	 
	 </td>
	 
	 <td class="sth1" valign="center" align="center" width="130px" style="padding-left: 4px" 
	 onclick="$('#chid{$smarty.foreach.val.index}').click()"> 
	  <div style="margin-top: 4px">{$val.datestart}</div>
	  <div style="margin-top: 2px; margin-bottom: 4px; font-size: 95%">[ {$CONTROL_OBJ->GetLastIntervalInDays($val.datestart, $CONTROL_OBJ->GetThisDateTime())} ]</div>
	  <div style="margin-top: 2px; margin-bottom: 4px; font-size: 95%">&nbsp;</div>	  
	 </td>
	 
	 <td class="sth1" valign="center" align="center" width="130px" style="padding-left: 4px" 
	 onclick="$('#chid{$smarty.foreach.val.index}').click()"> 
	  <div style="margin-top: 4px">{$val.dataupdate}</div>
	  <div style="margin-top: 2px; margin-bottom: 4px; font-size: 95%">[ {$CONTROL_OBJ->GetLastIntervalInDays($val.dataupdate, $CONTROL_OBJ->GetThisDateTime())} ]</div>
	  {$adm_object->GetLastMinuteInfo($val.dataupdate, $smarty.get.inftype, 'updateeveryminute', '<div style="margin-top: 2px; margin-bottom: 4px; font-size: 95%; color: #0000FF">- ', ' min</div>')}
	 </td>
	 
	 <td class="sth1" valign="center" align="center" width="130px" style="padding-left: 4px" 
	 onclick="$('#chid{$smarty.foreach.val.index}').click()"> 
	  <div style="margin-top: 4px">{$val.datelast}</div>
	  <div style="margin-top: 2px; margin-bottom: 4px; font-size: 95%">[ {$CONTROL_OBJ->GetLastIntervalInDays($val.datelast, $CONTROL_OBJ->GetThisDateTime())} ]</div>
	  {$adm_object->GetLastMinuteInfo($val.datelast, $smarty.get.inftype, 'deleteoldaccminf', '<div style="margin-top: 2px; margin-bottom: 4px; font-size: 95%; color: #0000FF">- ', ' min</div>')}
	 </td>
	 
	 <td class="sth1" valign="center" align="center" width="50px" style="padding-left: 4px" 
	 onclick="$('#chid{$smarty.foreach.val.index}').click()"> 	  
	  <a title="View a temporary image (opens in new window)" href="{$smarty.const.W_SITEPATH}pfiles/generalinformers/temp/{$val.imagefile}" target="_blank"><img src="{$smarty.const.W_SITEPATH}img/items/target_link.png"></a>  
	 </td>

	 <td class="sth1" valign="center" align="center" width="80px" style="border-right: 1px solid #E3E4E8;" 
	 onclick="$('#chid{$smarty.foreach.val.index}').click()">
	  {$val.regcount}	 	 	 
	 </td>
    </tr>  
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.iditem}" name="idm{$smarty.foreach.val.index}">
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="7">
     There are no active users of informer!
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

</div>
</div>