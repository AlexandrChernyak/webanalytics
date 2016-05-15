{* добавление строки в таблицу *}	 
<tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
 <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E4D9CB; width: 50%">
  <label style="margin-left: 4px">  
   {$tool_object->GetResultValue('decode')}&nbsp;<a title="Go to website (opens in new window)" href="{$tool_object->CorrectLinkToProtocol($tool_object->GetResultValue('decode'))}" target="_blank"><img src="{$smarty.const.W_SITEPATH}img/items/target_link.png"></a>  
  </label>	    
 </td>
 <td class="sth1" valign="center" align="left" style="border-right: 1px solid #E4D9CB; width: 50%">
  <label style="margin-left: 4px">
   {$tool_object->GetResultValue('encode')} 	  
  </label>
 </td>
</tr>
{literal}
<script type="text/javascript">
 $(function() {	$("#tableresultsourceid").tablesorter(); });	
</script>
{/literal}