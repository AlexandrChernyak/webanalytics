{* блок витрины ссылок *}
<!-- vitrina links begin -->
<div class="apdates_title"><a href="{$smarty.const.W_SITEPATH}vitrinalinks/" class="upd_title">Showcase Links</a>
<span style="margin-left: 10px">[<a href="{$smarty.const.W_SITEPATH}vitrinalinks/new=1" class="restpsw" style="margin: 0px 2px 0 2px">Add Link</a>]</span></div> 
<div class="vitrinaclass">
 {if $CONTROL_OBJ->GetVitrinaLinksList()}
  {foreach from=$CONTROL_OBJ->GetVitrinaLinksList() item=val name=val}
   {if !$val.isindexed}<noindex>{/if}{if $val.isbolded}<b>{/if}<a href="{$CONTROL_OBJ->CorrectURLByShemeItem($val.lurl)}"{if !$val.isindexed} rel="nofollow"{/if} target="_blank" style="background: transparent url(http://favicon.yandex.net/favicon/{$val.lhost}) no-repeat left top">{$val.ltext}</a>{if $val.isbolded}</b>{/if}{if !$val.isindexed}</noindex>{/if}  
  {/foreach}
 {/if} 	
</div>  
<!-- vitrina links begin -->