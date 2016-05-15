{* добавление строки в таблицу *}	 
<tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
 <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E3E4E8{if $tool_object->GetCurrentIndex() > 1}; border-top: 1px solid #C9D5FC{/if}">
  <label style="margin-left: 4px">
  <div style="margin: 4px">
   <div><a href="{$tool_object->GetResultValue('link')}" target="_blank">{$tool_object->CorrectURLLink($tool_object->GetResultValue('link'), 50)}</a></div>  
  {if $tool_object->GetResultValue('result')}
  <div style="margin-top: 4px">
  Код ответа: {$tool_object->GetResultValue('httpcode')}, Время: {$tool_object->GetResultValue('time')} сек.  
  </div>
  <div style="margin-top: 4px; border-top: 1px dashed #C0C0C0; padding-top: 4px">
  {if $tool_object->redirectlist}
  <div>Перенаправление на <a href="{$tool_object->GetResultValue('redil')}" target="_blank">{$tool_object->CorrectURLLink($tool_object->GetResultValue('redil'), 50)}</a></div>
  {/if}
  <div {if $tool_object->redirectlist}style="margin-top: 3px"{/if}>
   {if $tool_object->redirectlist}
   <div>
   Всего перенаправлений: <b>{$tool_object->GetRedirectCount()}</b>
   </div>
   {/if}
   <div style="{if $tool_object->redirectlist}margin-top: 4px; border-top: 1px dashed #C0C0C0; {/if}padding-top: 4px">   
    <div style="margin-top: 10px"><b>Заголовок ответа:</b></div>
    <div style="margin-top: 8px; height: auto; width: 85%; overflow: auto; padding-left: 10%">
     {$tool_object->ReplaceStrBreaks($tool_object->GetResultValue('head'))}
    </div>	 
   </div>
    
  </div>
  </div>  
  {/if}
  {if $tool_object->GetResultValue('error')}
  <div style="color: #FF0000; margin-top: 4px">{$tool_object->GetResultValue('error')}</div>
  {/if}
  </div>   
  </label>	    
 </td>
 <td class="sth1" valign="center" align="center" width="140px" style="border-right: 1px solid #E3E4E8{if $tool_object->GetCurrentIndex() > 1}; border-top: 1px solid #C9D5FC{/if}">
  <label style="margin-right: 4px">
   {if $tool_object->GetResultValue('error')}
   <b style="color: #FF0000">Error</b>
   {else}
   <b style="color: #008000">OK</b>
   {/if}   	  
  </label>
 </td>
</tr>
{literal}
<script type="text/javascript">
 $(function() {	$("#tableresultsourceid").tablesorter(); });	
</script>
{/literal}