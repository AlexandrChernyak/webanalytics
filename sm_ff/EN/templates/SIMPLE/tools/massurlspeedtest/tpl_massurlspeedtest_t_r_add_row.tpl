{* добавление строки в таблицу *}	 
<tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
 <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E3E4E8">
  <label style="margin-left: 4px">
  <div style="margin: 4px">
   <div><a href="{$tool_object->GetResultValue('link')}" target="_blank">{if $tool_object->strlen($tool_object->GetResultValue('link')) > 50}{$tool_object->substr($tool_object->GetResultValue('link'), 0, 47)}...{else}{$tool_object->GetResultValue('link')}{/if}</a></div>  
  {if $tool_object->GetResultValue('result')}
  <div style="margin-top: 4px">
  Response code: {$tool_object->GetResultValue('httpcode')}, Size: {$tool_object->GetResultValue('size')},  Time: {$tool_object->GetResultValue('time')} sec.  
  </div>
  {/if}
  {if $tool_object->GetResultValue('error')}
  <div style="color: #FF0000; margin-top: 4px">{$tool_object->GetResultValue('error')}</div>
  {/if}
  </div>   
  </label>	    
 </td>
 <td class="sth1" valign="center" align="right" width="140px" style="border-right: 1px solid #E3E4E8;">
  <label style="margin-right: 4px">
   {if !$tool_object->GetResultValue('result')}
    <b>?</b>
   {else}
    <b>{$tool_object->GetResultValue('speed')}</b>
   {/if}   	  
  </label>
 </td>
</tr>
{literal}
<script type="text/javascript">
 $(function() {	$("#tableresultsourceid").tablesorter(); });	
</script>
{/literal}