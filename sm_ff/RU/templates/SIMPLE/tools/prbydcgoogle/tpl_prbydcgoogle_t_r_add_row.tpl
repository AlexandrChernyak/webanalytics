{* добавление строки в таблицу *}	 
<tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
 
 <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E3E4E8">
  <label style="margin-left: 4px">  
   {if $tool_object->GetResultValue('host') !== false}
    {$tool_object->GetResultValue('host')}
   {else}
    ?
   {/if}  
  </label>	    
 </td>
 
 <td class="sth1" valign="center" align="left" width="140px">
  <label style="margin-left: 4px">
   {if $tool_object->GetResultValue('time') !== false}
    {$tool_object->GetResultValue('time')} s
   {else}
    ?
   {/if}		 	  
  </label>
 </td>
 
 <td class="sth1" valign="center" align="right" style="border-right: 1px solid #E3E4E8; width: 90px">
  <label style="margin-right: 4px">
   {if $tool_object->GetResultValue('pr') !== false}
    <img src="{$smarty.const.W_SITEPATH}img/items/pr/pr{$tool_object->GetResultValue('pr')}.gif">
   {else} 
    ?  
   {/if} 	  
  </label>
 </td>
 
</tr>
{literal}
<script type="text/javascript">
 $(function() {	$("#tableresultsourceid").tablesorter(); });	
</script>
{/literal}