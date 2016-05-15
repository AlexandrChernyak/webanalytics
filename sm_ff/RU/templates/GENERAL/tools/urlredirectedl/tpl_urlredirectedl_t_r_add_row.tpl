{* добавление строки в таблицу *}	 
<tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
 <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E4D9CB{if $tool_object->GetCurrentIndex() > 1}; border-top: 1px solid #C9D5FC{/if}">
  <label style="margin-left: 4px">
  <div style="margin: 4px">
   <div><a href="{$tool_object->GetResultValue('link')}" target="_blank">{$tool_object->CorrectURLLink($tool_object->GetResultValue('link'), 50)}</a></div>  
  {if $tool_object->GetResultValue('result')}
  <div style="margin-top: 4px">
  Код ответа: {$tool_object->GetResultValue('httpcode')}, Время: {$tool_object->GetResultValue('time')} сек.  
  </div>
  {if $tool_object->redirectlist}
  <div style="margin-top: 4px; border-top: 1px dashed #C0C0C0; padding-top: 4px">
  <div>Перенаправление на <a href="{$tool_object->GetResultValue('redil')}" target="_blank">{$tool_object->CorrectURLLink($tool_object->GetResultValue('redil'), 50)}</a></div>
  <div style="margin-top: 3px">
   <div>
   Всего перенаправлений: <b>{$tool_object->GetRedirectCount()}</b>, <label class="prep_label_analisys"><a id="shblockid" style="cursor: pointer" onclick="ShowHideBlockItem('shblockid_data{$tool_object->GetCurrentIndex()}', this)">Показать список</a></label>
   </div>
   <div id="shblockid_data{$tool_object->GetCurrentIndex()}" style="display: none; visibility: hidden; margin-top: 4px">
    <div style="margin-top: 4px; border-top: 1px dashed #C0C0C0; padding-top: 4px">
	 {foreach from=$tool_object->redirectlist item=val name=val}
	  <div style="margin-top: {if $smarty.foreach.val.index > 0}15px{else}3px{/if}">
	  <b>№ {$tool_object->GetIndexNumber($smarty.foreach.val.index)}</b>, Код ответа: <b>{$val.code}</b>
	  </div>
	  <div>
	  Перевод на: <a href="{$val.link}" target="_blank">{$tool_object->CorrectURLLink($val.link, 50)}</a>
	  </div>
	  <div style="margin-top: 10px"><b>Заголовок ответа:</b></div>
	  <div style="margin-top: 8px; height: auto; width: 88%; overflow: auto; padding-left: 10%">
	   {$tool_object->ReplaceStrBreaks($val.data)}
	  </div>	 
	 {/foreach}
	</div>
   </div>
    
  </div>
  </div> 
  {/if} 
  {/if}
  {if $tool_object->GetResultValue('error')}
  <div style="color: #FF0000; margin-top: 4px">{$tool_object->GetResultValue('error')}</div>
  {/if}
  </div>   
  </label>	    
 </td>
 <td class="sth1" valign="center" align="center" width="140px" style="border-right: 1px solid #E4D9CB{if $tool_object->GetCurrentIndex() > 1}; border-top: 1px solid #C9D5FC{/if}">
  <label style="margin-right: 4px">
   {if !$tool_object->redirectlist}
    {if $tool_object->GetResultValue('error')}
    <b>?</b>
    {else}
    <b>Нет</b>
    {/if}
   {else}
    <b style="color: #008000">Есть</b>
   {/if}   	  
  </label>
 </td>
</tr>
{literal}
<script type="text/javascript">
 $(function() {	$("#tableresultsourceid").tablesorter(); });	
</script>
{/literal}