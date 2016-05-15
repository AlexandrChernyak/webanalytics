{* добавление строки в таблицу *}	 
<tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
 
 <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E4D9CB">
  <label style="margin-left: 4px">
   {if !$tool_object->GetResultValue('host')}
   ?
   {else}  
    {$tool_object->CorrectURLLink($tool_object->GetResultValue('host'), 50)}&nbsp;<a title="Go to site (opens in new window)" href="{$tool_object->CorrectLinkToProtocol($tool_object->GetResultValue('host'))}" target="_blank"><img src="{$smarty.const.W_SITEPATH}img/items/target_link.png"></a>
   {/if}  
  </label>	    
 </td>
 
 <td class="sth1" valign="center" align="left" width="120px">
  <label style="margin-left: 4px">
   {if $tool_object->GetResultValue('host')}
    {$tool_object->GetResultValue('uv1')} $
   {else}
    ?
   {/if}	 	  
  </label>
 </td>
 
 {if $smarty.post.uv2}
 <td class="sth1" valign="center" align="left" width="120px">
  <label style="margin-left: 4px">
   {if $tool_object->GetResultValue('host')}
    {$tool_object->GetResultValue('uv2')} $
   {else}
    ?
   {/if}		 	  
  </label>
 </td>
 {/if}
 
 {if $smarty.post.uv3}
 <td class="sth1" valign="center" align="left" style="border-right: 1px solid #E4D9CB; width: 120px">
  <label style="margin-left: 4px">
   {if $tool_object->GetResultValue('host')}
    {$tool_object->GetResultValue('uv3')} $
   {else}
    ?
   {/if} 	  
  </label>
 </td>
 {/if}
 
</tr>
{literal}
<script type="text/javascript">
 $(function() {	$("#tableresultsourceid").tablesorter(); });	
</script>
{/literal}