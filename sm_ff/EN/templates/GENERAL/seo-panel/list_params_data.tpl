{* 
  блок списка параметров панели 

*}
   <tr id="urllisthead">
    
    <th align="center" valign="center" width="10px" id="thimagetableall" style="border: none">	
	 <img src="{$smarty.const.W_SITEPATH}css/panel/img/urlmoveobj.png" width="8" height="16" align='absmiddle' title="Move Site">	
	</th>
   
    <th align="center" valign="center" width="20px" style="border-left: none" id="thcheckboxall">
	 <input type="checkbox" class="checkboxitem" id="challitemslist" onclick="SetAllChecked(this)">
	</th>    
    <th align="center" valign="center" width="22px" id="thimagetableall">	
	 <img src="{$smarty.const.W_SITEPATH}css/panel/img/pictures_2.png" width="16" height="16" align='absmiddle' title="Favorit Icon">	
	</th>
		
		
	{if $PANEL_CONTROL->GetResult('params')}	
	 {foreach from=$PANEL_CONTROL->GetResult('params') item=val name=val}
	  <th align="{$val.data.align}" valign="center" style="{if $val.sid == 'url'}min-{/if}width: {$val.data.width}" id="paramitem{$val.id}" paramrealid="{$val.id}" itemsbgcolor="{$val.data.bgcolor}" itemsparamtype="{$val.data.type}" itemslistcolor="{if $val.data.color}{$val.data.color}{/if}" isdinamicparam="1" relparamtype="{$val.sid}">
	   {$val.data.name}	  
	  </th>	  
	 {/foreach}
	{/if}	
   </tr>