{* шаблон баннеров проекта *}
<div style="display: inline-block; text-align: center; width: {$banner_item.groupwidth}{if $banner_item.widthpersent}%{else}px{/if}; height: {$banner_item.groupheight}{if $banner_item.heightpersent}%{else}px{/if}; {$banner_item.additionalstyle}">
 
 {* simple image *}
 {if !$banner_item.isflashobj}
  
  <noindex><a rel="nofollow" href="{$banner_item.hrefdata}" target="_blank"><img src="{$banner_item.webimagefile}" border="0"{if !$banner_item.widthpersent} width="{$banner_item.widthobj}"{/if} height="{$banner_item.heightobj}" /></a></noindex> 
  
 {else}
 {* flash movie *}
 
  <div id="flsourcew{$banner_item.iditem}">    
  <object  classid="clsid27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="{$banner_item.widthobj}{if $banner_item.widthpersent}%{/if}" height="{$banner_item.heightobj}{if $banner_item.heightpersent}%{/if}" id="refbunnerw{$banner_item.iditem}" align="middle">
  <param name="allowScriptAccess" value="always" />
  <param name="allowFullScreen" value="false" />
  <param name="movie" value="{$banner_item.webimagefile}" />
  <param name="quality" value="high" />
  <embed src="{$banner_item.webimagefile}" quality="high" bgcolor="#ffffff" width="{$banner_item.widthobj}{if $banner_item.widthpersent}%{/if}" height="{$banner_item.heightobj}{if $banner_item.heightpersent}%{/if}" name="refbunnerw{$banner_item.iditem}" id="refbunnerw{$banner_item.iditem}" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer"/>
  </object>
  </div>
 
 {/if}
</div>