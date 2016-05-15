{* блок новостей 
  $newstype = тип новостей
  $limit = кол-во для вывода
  $fontsize = размер шрифта
  $fontsizeallnews = размер шрифта всех новостей
  $fulldate = 1 or empty for full format date
*}
<!-- news begin -->
<div>
 {if $CONTROL_OBJ->GetNewsListByBlockData($newstype, $limit)}
  {foreach from=$CONTROL_OBJ->GetNewsListByBlockData($newstype, $limit) item=val name=val}
   <div style="margin-left: 4px; margin-top: 4px">
    <span style="font-size: {$fontsize}">{if !$fulldate}{$CONTROL_OBJ->DateToSpecialFormat($val.datecreate)}{else}{$CONTROL_OBJ->DateTimeToSpecialFormat($val.datecreate, $smarty.const.W_SITENEWSDATETIMEFORMATONHOST)}{/if}</span> 
	<a style="text-decoration: none; font-size: {$fontsize}" href="{$smarty.const.W_SITEPATH}news/{$newstype}/{$val.iditem}/">{$val.newtitle}</a>
   </div>     
  {/foreach}
  <div class="contentway" style="font-size: {if $fontsizeallnews}{$fontsizeallnews}{else}{$fontsize}{/if}; margin-top: 5px; margin-left: 4px">
   <a style="color: #000000" href="{$smarty.const.W_SITEPATH}news/{$newstype}/">All news</a><label>&nbsp;</label>
  </div>  
 {else}
  <div style="margin-left: 4px">No news!</div> 
 {/if} 	
</div>  
<!-- news end -->