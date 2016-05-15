{* группировка инструментов, отображение списка инструментов по идентификатору *}
<div style="padding-left: 8px; font-size: 95%">
 {assign var="listtools" value=$CONTROL_OBJ->GetToolsListStandart()}
 <span style="width: 100%">
 {if !$listtools}No Active Tools!{else}
 <table width="100%" cellpadding="0" cellspacing="0">
  {section name=trindex start=0 loop=$listtools.count step=1}
  <tr>
    
  <td valign="top" align="left">
   {if $listtools.data1[trindex].name}   
    <img src="{$CONTROL_OBJ->GetToolImageStyle($listtools.data1[trindex].name, 16, '', '')}" style="width: 16px; height: 16px; float: left; margin-right: 6px">
    <input type="checkbox"{if $adm_object->IsCheckedItem($listtools.data1[trindex].name)} checked="checked"{/if} style="cursor: pointer" name="checktool{$listtools.data1[trindex].name}" id="checktool{$listtools.data1[trindex].name}" /> <label style="margin-left: 3px" for="checktool{$listtools.data1[trindex].name}" style="cursor: pointer"><a target="_blank" href="{$smarty.const.W_SITEPATH}tools/{$listtools.data1[trindex].name}/"{if $adm_object->IsCheckedItem($listtools.data1[trindex].name)} style="color: #969696"{/if}>{$CONTROL_OBJ->GetText($listtools.data1[trindex].value.descr)}</a>
    </label>
    <input type="hidden" value="{$listtools.data1[trindex].name}" id="checktool{$listtools.data1[trindex].name}data" />
   {/if}
  </td>
  
  <td valign="top" align="left">
   {if $listtools.data2[trindex].name}
    <img src="{$CONTROL_OBJ->GetToolImageStyle($listtools.data2[trindex].name, 16, '', '')}" style="width: 16px; height: 16px; float: left; margin-right: 6px">  
    <input type="checkbox"{if $adm_object->IsCheckedItem($listtools.data2[trindex].name)} checked="checked"{/if} style="cursor: pointer" name="checktool{$listtools.data2[trindex].name}" id="checktool{$listtools.data2[trindex].name}" /> <label style="margin-left: 3px" for="checktool{$listtools.data2[trindex].name}" style="cursor: pointer"><a target="_blank" href="{$smarty.const.W_SITEPATH}tools/{$listtools.data2[trindex].name}/"{if $adm_object->IsCheckedItem($listtools.data2[trindex].name)} style="color: #969696"{/if}>{$CONTROL_OBJ->GetText($listtools.data2[trindex].value.descr)}</a>
    </label>
    <input type="hidden" value="{$listtools.data2[trindex].name}" id="checktool{$listtools.data2[trindex].name}data" />
   {/if}  
  </td>  
  
  </tr>
  {/section}
 </table>
 {/if}
 </span>
</div>