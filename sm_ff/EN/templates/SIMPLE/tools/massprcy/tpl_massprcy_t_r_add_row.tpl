{* добавление строки в таблицу *}	 
<tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
 
 <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E3E4E8; width: 200px">
  <label style="margin-left: 4px">  
   {$tool_object->CorrectURLLink($tool_object->GetResultValue('link'), 50)}&nbsp;<a title="Go to website (opens in new window)" href="{$tool_object->CorrectLinkToProtocol($tool_object->GetResultValue('link'))}" target="_blank"><img src="{$smarty.const.W_SITEPATH}img/items/target_link.png"></a>  
  </label>	    
 </td>
 
 <td class="sth1" valign="center" align="left" width="130px">
  <label style="margin-left: 4px">
   {if $tool_object->GetResultValue('cy_www')}
    <img src="{$tool_object->GetResultValue('cy_www')}">
   {else}
    ?
   {/if}	 	  
  </label>
 </td>
 
 <td class="sth1" valign="center" align="left" width="90px">
  <label style="margin-left: 4px">
   {if $tool_object->GetResultValue('cy_no_www')}
    <img src="{$tool_object->GetResultValue('cy_no_www')}">
   {else}
    ?
   {/if}		 	  
  </label>
 </td>
 
 <td class="sth1" valign="center" align="right" style="border-right: 1px solid #E3E4E8">
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