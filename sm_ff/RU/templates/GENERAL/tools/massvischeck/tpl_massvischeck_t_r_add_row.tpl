{* добавление строки в таблицу *}	 
<tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
 
 <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E3E4E8; width: 200px">
  <label style="margin-left: 4px">     
   {$tool_object->CorrectURLLink($tool_object->GetResultValue('host'), 50)}&nbsp;<noindex><a rel="nofollow" title="Перейти на сайт (откроется в новом окне)" href="{$tool_object->CorrectLinkToProtocol($tool_object->GetResultValue('host'))}" target="_blank"><img src="{$smarty.const.W_SITEPATH}img/items/target_link.png"></a></noindex>
   {if $tool_object->GetResultValue('error')}<label style="margin-left: 6px; color: #FF0000">{$tool_object->GetResultValue('error')}</label>{/if}
  </label>	    
 </td>
  
 <td class="sth1" valign="center" align="right" style="border-right: 1px solid #E3E4E8; padding-right: 3px">
  <label style="margin-right: 4px">
   {if $tool_object->GetResultValue('image')}
    <a rel="nofollow"{if !$tool_object->GetResultValue('data')} style="color: #FF0000"{/if} href="{$tool_object->GetResultValue('link')}" target="_blank" title="Просмотр статистики подробно"><img src="{$tool_object->GetResultValue('image')}" alt="statistic"></a></noindex>
   {else}
   <noindex><a rel="nofollow"{if !$tool_object->GetResultValue('data')} style="color: #FF0000"{/if} href="{$tool_object->GetResultValue('link')}" target="_blank" title="Просмотр статистики подробно">{if $tool_object->GetResultValue('data')}{$tool_object->GetResultValue('data.LiDayStatistic')}{else}<b>?</b>{/if}</a></noindex>
   {/if} 	  
  </label>
 </td>
 
</tr>
{literal}
<script type="text/javascript">
 $(function() {	$("#tableresultsourceid").tablesorter(); });	
</script>
{/literal}