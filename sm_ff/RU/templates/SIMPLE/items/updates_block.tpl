{* блок апдейтов поисковиков 
 
 $widthdiv = 150px

*}
<!-- updates block begin -->
 {if $smarty.post.doactiontool == 'do' && !$ismain_page}
 {literal}
 <style type="text/css">
  #fone_l { background: #F9F9F9; }	
 </style>
 {/literal}
 {/if}
 
 <div style="width: {if !$widthdiv}150px{else}{$widthdiv}{/if}"><span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 95%">
 
 <tr>
  <td valign="top" align="left" class="upd_td_v" style="padding-right: 3px">
   <label id="fone_l"><b><label style="color: #333399">G</label><label id="red">o</label><label style="color: #FFFF00">o</label><label style="color: #333399">gl</label><label id="red">e</label></b> pr</label>   
  </td>
  <td align="right" valign="top" width="30px">
   <label id="fone_l" style="border-bottom: 1px dashed #000000" title="{$CONTROL_OBJ->GetLastIntervalInDays($engine_updates_list.4.value_original)}">{if !isset($engine_updates_list) || !$engine_updates_list.4 || !$engine_updates_list.4.value}?{else}{if $engine_updates_list.4.bold}<b>{$engine_updates_list.4.value}</b>{else}{$engine_updates_list.4.value}{/if}{/if}</label>  
  </td>
 </tr>
 
 <tr>
  <td valign="top" align="left">
   &nbsp;   
  </td>
  <td align="right" valign="top" width="30px">
   &nbsp;  
  </td>
 </tr>
  
 <tr>
  <td valign="top" align="left" class="upd_td_v" style="padding-right: 3px">
   <label id="fone_l"><b><label id="red">Я</label>ндекс</b> ТиЦ</label>   
  </td>
  <td align="right" valign="top" width="30px">
   <label id="fone_l" style="border-bottom: 1px dashed #000000" title="{$CONTROL_OBJ->GetLastIntervalInDays($engine_updates_list.1.value_original)}">{if !isset($engine_updates_list) || !$engine_updates_list.1 || !$engine_updates_list.1.value}?{else}{if $engine_updates_list.1.bold}<b>{$engine_updates_list.1.value}</b>{else}{$engine_updates_list.1.value}{/if}{/if}</label>  
  </td>
 </tr>
 
 <tr>
  <td valign="top" align="left" class="upd_td_v" style="padding-right: 3px; padding-top: 4px">
   <label id="fone_l" style="padding-left: 10px">поиск</label>   
  </td>
  <td align="right" valign="top" width="30px" style="padding-top: 4px">
   <label id="fone_l" style="border-bottom: 1px dashed #000000" title="{$CONTROL_OBJ->GetLastIntervalInDays($engine_updates_list.2.value_original)}">{if !isset($engine_updates_list) || !$engine_updates_list.2 || !$engine_updates_list.2.value}?{else}{if $engine_updates_list.2.bold}<b>{$engine_updates_list.2.value}</b>{else}{$engine_updates_list.2.value}{/if}{/if}</label>  
  </td>
 </tr>
 
 <tr>
  <td valign="top" align="left" class="upd_td_v" style="padding-right: 3px; padding-top: 4px">
   <span id="fone_l" style="padding-left: 10px">каталог</span>   
  </td>
  <td align="right" valign="top" width="30px" style="padding-top: 4px">
   <label id="fone_l" style="border-bottom: 1px dashed #000000" title="{$CONTROL_OBJ->GetLastIntervalInDays($engine_updates_list.3.value_original)}">{if !isset($engine_updates_list) || !$engine_updates_list.3 || !$engine_updates_list.3.value}?{else}{if $engine_updates_list.3.bold}<b>{$engine_updates_list.3.value}</b>{else}{$engine_updates_list.3.value}{/if}{/if}</label>  
  </td>
 </tr> 
 
 </table>
 
 </span></div>  
<!-- updates block end -->