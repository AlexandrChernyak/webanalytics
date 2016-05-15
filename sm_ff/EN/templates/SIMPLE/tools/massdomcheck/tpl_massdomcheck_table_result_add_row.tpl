{* добавление строки в таблицу *}	 
<tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
 <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E3E4E8">
  <label style="margin-left: 4px">
   <a href="http://{$tool_object->GetResultValue('host')}" target="_blank">{$tool_object->GetResultValue('host')}</a>  
  </label>	    
 </td>
 <td class="sth1" valign="center" align="right" width="140px" style="border-right: 1px solid #E3E4E8;">
  <label style="margin-right: 4px">
   {if $tool_object->GetResultValue('result')}
   <b style="color: #FF0000">Busy!</b>&nbsp;<a title="View Whois Domain Owner" href="{$smarty.const.W_SITEPATH}tools/whoisdomain/{$tool_object->GetResultValue('host')}" target="_blank"><img src="{$smarty.const.W_SITEPATH}img/items/target_link.png"></a>
   {else}
   <b style="color: #008000">Is free!</b>
   {/if}	  
  </label>
 </td>
</tr>
{literal}
<script type="text/javascript">
 $(function() {	$("#tableresultsourceid").tablesorter(); });	
</script>
{/literal}