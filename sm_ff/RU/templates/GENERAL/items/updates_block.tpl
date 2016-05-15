{* блок апдейтов поисковиков 
 
 $widthdiv = 150px

*}
<!-- updates block begin -->
 {literal}
 <style type="text/css">
   .days_deff { display: inline-block; font-size: 85%; position: relative; top: -4px; color: #71553A; }
 </style>
 {/literal}
 <div{if $widthdiv} style="width: {$widthdiv}"{/if}><span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
	<td class="upd_td" style="width: 80px">
	<span class="yandex_logo_upd">
	 <span class="text"><label id="red">Я</label>ндекс</span>
	</span>
	</td>
	<td class="upd_td_v"><label id="fone_l" style="padding-right: 2px">
	{if isset($engine_updates_list) && $engine_updates_list.1 && $engine_updates_list.1.bold}
	 <b>ТиЦ</b>
	{else}
	 ТиЦ
	{/if}	
	</label></td>
	<td class="upd_td_r"><label id="fone_l" style="padding-left: 2px">
	{if !isset($engine_updates_list) || !$engine_updates_list.1 || !$engine_updates_list.1.value}
	 ?
	{else} 
	 {if $engine_updates_list.1.bold}
	  <b>{$engine_updates_list.1.value}</b>
	 {else}
	  {$engine_updates_list.1.value}
	 {/if}	 
	{/if}
	</label>
    </td>
   </tr>
   {if $smarty.const.W_UPDATESSHOWDEFISIONONBLOCK}  
   <tr>  
	<td style="height: 1px" align="right" valign="top" colspan="3">
	<label class="days_deff">({$CONTROL_OBJ->GetLastIntervalInDays($engine_updates_list.1.value_original)})</label>
	</td>
   </tr>
   {/if}
   <tr>
	<td class="upd_td"></td>
	<td class="upd_td_v"><label id="fone_l" style="padding-right: 2px">
	{if isset($engine_updates_list) && $engine_updates_list.2 && $engine_updates_list.2.bold}
	 <b>поиск</b>
	{else}
	 поиск
	{/if}
	</label></td>
	<td class="upd_td_r"><label id="fone_l" style="padding-left: 2px">	
	{if !isset($engine_updates_list) || !$engine_updates_list.2 || !$engine_updates_list.2.value}
	 ?
	{else} 
	 {if $engine_updates_list.2.bold}
	  <b>{$engine_updates_list.2.value}</b>
	 {else}
	  {$engine_updates_list.2.value}
	 {/if} 
	{/if}	
	</label></td>
   </tr>
   {if $smarty.const.W_UPDATESSHOWDEFISIONONBLOCK}  
   <tr>
	<td style="height: 1px" align="right" valign="top" colspan="3">
	<label class="days_deff">({$CONTROL_OBJ->GetLastIntervalInDays($engine_updates_list.2.value_original)})</label>
	</td>
   </tr>
   {/if}
   <tr>
	<td class="upd_td" style="height: 17px"></td>
	<td class="upd_td_v" style="height: 17px"><label id="fone_l" style="padding-right: 2px">
	{if isset($engine_updates_list) && $engine_updates_list.3 && $engine_updates_list.3.bold}
	 <b>каталог</b>
	{else}
	 каталог
	{/if}		
	</label></td>
	<td class="upd_td_r" style="height: 17px"><label id="fone_l" style="padding-left: 2px">
	{if !isset($engine_updates_list) || !$engine_updates_list.3 || !$engine_updates_list.3.value}
	 ?
	{else} 
	 {if $engine_updates_list.3.bold}
	  <b>{$engine_updates_list.3.value}</b>
	 {else}
	  {$engine_updates_list.3.value}
	 {/if}	 
	{/if}	
	</label></td>
   </tr>
   {if $smarty.const.W_UPDATESSHOWDEFISIONONBLOCK}  
   <tr>
	<td style="height: 1px" align="right" valign="top" colspan="3">
	<label class="days_deff">({$CONTROL_OBJ->GetLastIntervalInDays($engine_updates_list.3.value_original)})</label>
	</td>
   </tr>
   {/if}   
   <tr>
	<td style="height: 10px"></td>
	<td style="height: 10px"></td>
	<td style="height: 10px"></td>
   </tr>
   <tr>
	<td class="upd_td" style="width: 80px">
	<span class="google_logo_upd">
	 <span class="text">
	  <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label>
	 </span>
	</span>
	</td>
	<td class="upd_td_v"><label id="fone_l" style="padding-right: 2px">
	{if isset($engine_updates_list) && $engine_updates_list.4 && $engine_updates_list.4.bold}
	 <b>PR</b>
	{else}
	 PR
	{/if}		
	</label></td>
	<td class="upd_td_r"><label id="fone_l" style="padding-left: 2px">
	{if !isset($engine_updates_list) || !$engine_updates_list.4 || !$engine_updates_list.4.value}
	 ?
	{else} 
	 {if $engine_updates_list.4.bold}
	  <b>{$engine_updates_list.4.value}</b>
	 {else}
	  {$engine_updates_list.4.value}
	 {/if}	 
	{/if}	
    </label></td>
   </tr>
   {if $smarty.const.W_UPDATESSHOWDEFISIONONBLOCK}  
   <tr>
	<td style="height: 1px" align="right" valign="top" colspan="3">
	<label class="days_deff">({$CONTROL_OBJ->GetLastIntervalInDays($engine_updates_list.4.value_original)})</label>
	</td>
   </tr>
   {/if}
   </table> 
 </span></div>  
<!-- updates block end -->