{* 
  блок одной линии сайта в таблице 

*}
{if $PANEL_CONTROL->GetResult('params')}
 <tr id="urllistitem{$PANEL_CONTROL->GetResult('urllineinfo.iditem')}" class="urlpitemtr" urlrealid="{$PANEL_CONTROL->GetResult('urllineinfo.iditem')}" urlsectionid="{$PANEL_CONTROL->GetResult('urllineinfo.sectionid')}" onmouseover="DoEventMOver(this)" onmouseout="DoEventMOut(this)">
 
 <td align="center" valign="center" class="urlblockidentmove"> </td>
 	
 <td align="center" valign="center" width="20px" style="border-left: none">	 
  <input type="checkbox" class="checkboxitem" id="checkpitem{$PANEL_CONTROL->GetResult('urllineinfo.iditem')}" onclick="SetCheckedItem('{$PANEL_CONTROL->GetResult('urllineinfo.iditem')}', this)" urlrealid="{$PANEL_CONTROL->GetResult('urllineinfo.iditem')}">	 
 </td>
 
 <td align="center" valign="center" width="22px">
  <a href="javascript:" title="View screenshot" onclick="previewImageURL('{$PANEL_CONTROL->GetResult('urllineinfo.iditem')}')"><img src="http://favicon.yandex.net/favicon/{$PANEL_CONTROL->line_obj->GetURL()}" width="16" height="16" align='absmiddle' alt="?"></a>
 </td> 
 	
 {foreach from=$PANEL_CONTROL->GetResult('params') item=val name=val}
  <td align="{$val.data.align}" valign="center" style="{if $val.sid == 'url'}min-{/if}width: {$val.data.width}{if $val.data.bgcolor}; background: {$val.data.bgcolor}{/if}{if $val.data.color}; color: {$val.data.color}{/if}{if $val.data.canwrap}; white-space: normal{/if}" id="tdurlitem{$PANEL_CONTROL->GetResult('urllineinfo.iditem')}" urlrealid="{$PANEL_CONTROL->GetResult('urllineinfo.iditem')}" paramrealid="{$val.id}" isurlident="{if $val.sid == 'url'}1{else}0{/if}" bgcolorsave="{$val.data.bgcolor}"{if $val.data.bgcolor} isbgexists="1"{/if} {if $val.data.type != 3} onclick="SetCheckedItem('{$PANEL_CONTROL->GetResult('urllineinfo.iditem')}', false)"{/if}>
   {include file="seo-panel/url_param_data.tpl"}		  
  </td>	  
 {/foreach}
 
 </tr> 
{/if}