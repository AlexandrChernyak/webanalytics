{* блок витрины ссылок
 $linkfontsize = false 
 $linkleftmargin = false
*}
<!-- vitrina links begin -->
<div><a class="black" href="{$smarty.const.W_SITEPATH}vitrinalinks/" style="font-weight: bold; text-decoration: none;">Витрина ссылок</a><span style="margin-left: 10px">[<a href="{$smarty.const.W_SITEPATH}vitrinalinks/new=1" class="black" style="margin: 0px 2px 0 2px; font-size: 95%">Добавить</a>]</span></div> 
<div class="vitrinaclass">
 {if $CONTROL_OBJ->GetVitrinaLinksList()}
  {foreach from=$CONTROL_OBJ->GetVitrinaLinksList() item=val name=val}
   {if !$val.isindexed}<noindex>{/if}{if $val.isbolded}<b>{/if}<a href="{$CONTROL_OBJ->CorrectURLByShemeItem($val.lurl)}"{if !$val.isindexed} rel="nofollow"{/if} target="_blank" style="background: transparent url(http://favicon.yandex.net/favicon/{$val.lhost}) no-repeat left top{if $linkfontsize}; font-size: {$linkfontsize}{/if}{if $linkleftmargin}; margin-left: {$linkleftmargin}{/if}">{$val.ltext}</a>{if $val.isbolded}</b>{/if}{if !$val.isindexed}</noindex>{/if}  
  {/foreach}
 {/if} 	
</div>  
<!-- vitrina links begin -->