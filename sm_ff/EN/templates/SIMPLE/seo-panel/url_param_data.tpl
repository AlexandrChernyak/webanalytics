{* 
  блок одного значения сайта 

*}
   {if !$PANEL_CONTROL->line_obj}?{else}
	
	{if $val.sid == 'url'}
	 {* URL сайта *}
		 
	 <a href="http://{$PANEL_CONTROL->GetResult('urllineinfo.urlid')}" target="_blank">{$PANEL_CONTROL->GetResult('urllineinfo.urlid')}</a>
	 
	{elseif $PANEL_CONTROL->line_obj->GetCurrentValue($val.sid, $val.data, 'value') !== false}
	  
	  {* ссылка, значения, отклонение *}
	  {assign var="valueitemvf" value=$PANEL_CONTROL->line_obj->GetCurrentValue($val.sid, $val.data, 'value')}
	  {assign var="linkitemvf" value=$PANEL_CONTROL->line_obj->GetCurrentValue($val.sid, $val.data, 'link')}
	  {if !$val.data.nodisplaydiff}	  
	   {assign var="diffvalueitemvf" value=$PANEL_CONTROL->line_obj->GetCurrentValue($val.sid, $val.data, 'diff')}
      {/if}
	  
	  <label id="fromparam{$val.id}" style="padding-left: 1px{if $val.data.color}; color: {$val.data.color}{/if}">
	  {* строковые данные *}
	  {if $val.data.type == '1'}
	   {if $val.data.dateformat}
	     
	     {* если дата обновления - выделить если дата совпадает с текущей *}
	     {if $val.sid == 'dateupdated' && $valueitemvf == $PANEL_CONTROL->GetThisDate()}
		 <label style="background: #E7EEE6">
		 {/if}
	     
	     {if $linkitemvf}<a href="{$linkitemvf}" class="blackc" target="_blank"{if $val.data.color} style="color: {$val.data.color}"{/if}>{/if}{$CONTROL_OBJ->DateToSpecialFormat($valueitemvf, $val.data.dateformat, 1)}{if $linkitemvf}</a>{/if}
	     
	     {if $val.sid == 'dateupdated' && $valueitemvf == $PANEL_CONTROL->GetThisDate()}</label>{/if}
		    	    	    
	   {else}
	   	   
	    {if $linkitemvf}<a href="{$linkitemvf}" class="blackc" target="_blank"{if $val.data.color} style="color: {$val.data.color}"{/if}>{/if}{$valueitemvf}{if $linkitemvf}</a>{/if}
	    
	   {/if}
	   	   	    
	  {elseif $val.data.type == '2'}
	   {* изображение *}
	   	   
	   {if $linkitemvf}<a href="{$linkitemvf}" target="_blank">{/if}<img src="{$valueitemvf}" border="0" alt="{$val.data.name}"{if $val.data.imageheight} height="{$val.data.imageheight}"{/if}{if $val.data.imagewidth} width="{$val.data.imagewidth}"{/if}>{if $linkitemvf}</a>{/if}
	   	  
	  {elseif $val.data.type == '3'}
	   {* кнопки управления *}
	   
	   
	   <a title="History indicators" href="javascript:" onclick="ProcessViewHistoryElement('{$PANEL_CONTROL->GetResult('urllineinfo.iditem')}')"><img alt="h" src="{$smarty.const.W_SITEPATH}css/panel/img/history.png" width="16" height="16" align='absmiddle'></a>
	   
	   <span style="margin-left: 3px"><a title="Perform site analysis" target="_blank" href="{$smarty.const.W_SITEPATH}tools/analysis/{$PANEL_CONTROL->GetResult('urllineinfo.urlid')}"><img alt="a" src="{$smarty.const.W_SITEPATH}css/panel/img/info.png" width="16" height="16" align='absmiddle'></a></span>
	   
	  
	  {else}
	   {* остальные значения *} 
	   
	   {if $val.data.returnasstring}
	    {* цвет значения *}
		{if $valueitemvf && $val.data.coloryes}
	     {assign var="coloryesno" value=$val.data.coloryes}
	    {elseif !$valueitemvf && $val.data.colorno} 
	     {assign var="coloryesno" value=$val.data.colorno}
	    {else}
	     {assign var="coloryesno" value=""}
	    {/if}	   
	    <label{if $coloryesno} style="color: {$coloryesno}"{/if}>
	   {/if}	   
	   
	   {if $linkitemvf}<a href="{$linkitemvf}" class="blackc"{if $coloryesno || $val.data.color} style="color: {if $coloryesno}{$coloryesno}{else}{$val.data.color}{/if}"{/if} target="_blank">{/if}{if $val.data.returnasstring}{if $valueitemvf}{$PANEL_CONTROL->GetText('yesstringidentsimply')}{else}{$PANEL_CONTROL->GetText('nostringidentsimply')}{/if}{else}{$valueitemvf}{/if}{if $linkitemvf}</a>{/if}
	   
	   {if $val.data.returnasstring}</label>{/if}	  
	  {/if}
	  </label>
	  
	  {* отклонение *}
	  {if $diffvalueitemvf}
	   <sup style="padding-left: 2px{if ($val.data.swithifdayslost && $diffvalueitemvf && $diffvalueitemvf > $val.data.swithifdayslost) || (!isset($val.data.swithifdayslost) && $diffvalueitemvf > 0)}{if $val.data.colorplus}; color: {$val.data.colorplus}{/if}{else}{if $val.data.colorminus}; color: {$val.data.colorminus}{/if}{/if}" id="difffromparam{$val.id}">
	    {if $diffvalueitemvf > 0}+{/if}{$PANEL_CONTROL->line_obj->GetCurrentValue($val.sid, $val.data, 'diffreal')}
	   </sup>
	  {/if}
 
	 {else}
	 -
	 {/if}	 	
	
   {/if}