{* реферальные баннеры *}

<div>
 <a href="{$smarty.const.W_SITEPATH}account/ref-banner/"{if !$smarty.get.flash} style="color: #000000"{/if}>Normal banners</a><label style="margin: 0 5px 0 5px">|</label><a href="{$smarty.const.W_SITEPATH}account/ref-banner/&flash=1"{if $smarty.get.flash} style="color: #000000"{/if}>Flash banners</a>
</div>
<div style="margin-top: 20px">
 {assign var="blist" value=$CONTROL_OBJ->GetReferBannersList($smarty.get.flash)}
 {literal}
 <script type="text/javascript">
  function ShHideElementFlash(th, ident) {   
   $('#rp'+ident).css('visibility', (th.checked) ? 'visible' : 'hidden');
   $('#rp'+ident).css('display', (th.checked) ? 'block' : 'none');
  }//ShHideElementFlash	
  
  function ShHdBlElementA(th, ident) {	   
   var hd = ($('#'+ident).css('visibility') == 'hidden') ? true : false; 
   $(th).html((hd) ? 'Hide' : 'Show');
   $('#'+ident).css('visibility', (hd) ? 'visible' : 'hidden');
   $('#'+ident).css('display', (hd) ? 'block' : 'none');
  }//ShHdBlElementA
  
  function GetCodeElement(ident, typelink, isfl) {
   var myhostpath = {/literal}'{$smarty.const.W_HOSTMYSITE}';{literal}
   var myhostpathmini = {/literal}'{$smarty.const.W_SITEPATH}';{literal}  
   isfl = (isfl == '0') ? false : true;   
   if (!isfl) {
    var link = $('#'+typelink+ident).text();
   }
   var source = '';
   if (isfl) {
    source =  trim($('#flsource'+ident).html());    
   } else {
    source = $('#imsource'+ident).html();
   }  
   source = str_replace(myhostpathmini+'pfiles/images/', 'http://'+myhostpath+'/pfiles/images/', source);
   if (!isfl) {
    source = '<a href="'+link+'" target="_blank">'+source+'</a>';   
   } 
   $('#code'+ident).val(source);
  }
 </script>
 {/literal}
 {if !$blist}<div style="margin-left: 4px">No active banners!</div>{else}
  {foreach from=$blist key=rname item=val name=val}
 
   <div class="analisislabelid" style="margin-top: 15px;"><strong>{$rname}</strong><label style="color: #000000; margin-left: 6px">[ <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElementA(this, 'block_{$ref.iditem}')">Hide</a> ]</label></div>
   <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="block_{$ref.iditem}">    
    {foreach from=$val item=ref name=ref}
   
    <div style="margin: 10px 2px 2px 2px">
    {if !$ref.isflash}
     <div id="imsource{$ref.iditem}"><img src="{$smarty.const.W_SITEPATH}pfiles/images/{$ref.bfilename}" border="0"></div>
    {else}       
     
     <div id="flsource{$ref.iditem}">    
     <object  classid="clsid27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0"{if $ref.bwidth} width="{$ref.bwidth}"{/if}{if $ref.bheight} height="{$ref.bheight}"{/if} id="refbunner{$ref.iditem}" align="middle">
     <param name="allowScriptAccess" value="always" />
     <param name="allowFullScreen" value="false" />
     <param name="movie" value="{$smarty.const.W_SITEPATH}pfiles/images/{$ref.bfilename}" />
     <param name="quality" value="high" />
     <embed src="{$smarty.const.W_SITEPATH}pfiles/images/{$ref.bfilename}" quality="high" bgcolor="#ffffff"{if $ref.bwidth} width="{$ref.bwidth}"{/if}{if $ref.bheight} height="{$ref.bheight}"{/if} name="refbunner{$ref.iditem}" id="refbunner{$ref.iditem}" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer"/>
     </object>
     </div>
      
    {/if}
    </div>
    
    <div style="padding-left: 2px">
    
     <div style="margin-top: 6px">
      <input type="checkbox" style="cursor: pointer" name="ch{$ref.iditem}" id="ch{$ref.iditem}" onclick="ShHideElementFlash(this, '{$ref.iditem}')" /><label for="ch{$ref.iditem}" style="cursor: pointer"> Show banner code</label>
     </div>
     
     <div id="rp{$ref.iditem}" style="visibility: hidden; display: none">
      <div style="margin-top: 15px; padding-left: 4px">
       
       <div>
        
        {if $ref.isflash}
        <div>
        <input type="radio" style="cursor: pointer" name="sel{$ref.iditem}" id="sel1{$ref.iditem}" onclick="GetCodeElement('{$ref.iditem}', 'lp1', '{$ref.isflash}')" /><label for="sel1{$ref.iditem}" id="lp1{$ref.iditem}" style="cursor: pointer; padding-left: 4px">As noted in the movie</label>
        </div>
        {else}      
       
        <div>
        <input type="radio" style="cursor: pointer" name="sel{$ref.iditem}" id="sel1{$ref.iditem}" onclick="GetCodeElement('{$ref.iditem}', 'lp1', '{$ref.isflash}')" /><label for="sel1{$ref.iditem}" id="lp1{$ref.iditem}" style="cursor: pointer; padding-left: 4px">http://{$smarty.const.W_HOSTMYSITE}/?p={$CONTROL_OBJ->userdata.iduser}</label>
        </div>
        <div style="margin-top: 4px">
         <input type="radio" style="cursor: pointer" name="sel{$ref.iditem}" id="sel2{$ref.iditem}" onclick="GetCodeElement('{$ref.iditem}', 'lp2', '{$ref.isflash}')" /><label for="sel2{$ref.iditem}" id="lp2{$ref.iditem}" style="cursor: pointer; padding-left: 4px">http://{$smarty.const.W_HOSTMYSITE}/register/{$CONTROL_OBJ->userdata.iduser}</label>
        </div>
        {/if}
            
       </div>
       
       <div style="margin-top: 6px"><textarea class="int_text" style="height: {if $ref.isflash}150px{else}50px{/if}; width: 95%" readonly="readonly" onclick="this.select()" name="code{$ref.iditem}" id="code{$ref.iditem}"></textarea></div>
      </div>
     </div>
     
     <div style="margin-top: 6px">&nbsp;</div> 
    
    </div> 
    {/foreach}
   </div>
  {/foreach}
 {/if}
</div>