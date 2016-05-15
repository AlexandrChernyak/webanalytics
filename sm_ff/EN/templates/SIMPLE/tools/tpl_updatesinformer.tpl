{* информер апдейтов *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool provides you an opportunity to create a ticker updates the last date of search engines for your site, or the signature on the forum (blog).
 {/if} 
 
 <div style="clear: both;"></div>
 </div>

 {if !$tool_object->canrun}
  <div style="margin-top: 25px">
  {if $tool_object->onlyforadmin}
  The tool is temporarily disabled by administrator! We apologize for any inconvenience .. Please try again later.
  {else}  
  To use this tool requires authorization on the site. Please login or <a href="{$smarty.const.W_SITEPATH}register/" target="_blank">register</a> to gain access to the tool.
  {/if} 
  </div>
 {else}
 
 {if $smarty.post.doactiontool == 'do'}
 {literal}
 <script type="text/javascript">
  function GetInformCodeCheck(th) {	
   if (!th.selectedinformer.value) {
	alert('Select the informer you want to use!');
	return false;
   }
   return true;   	
  }//GetInformCodeCheck 	
 </script>
 {/literal}
 {/if}
 <form method="post" name="tollform" id="toolform"{if $smarty.post.doactiontool == 'do'} onsubmit="return GetInformCodeCheck(this)"{/if}>
  
  <div class="typelabel" style="margin-top: 13px"> 
   <div><strong>Current date updates search engines:</strong></div>
   
   <div style="padding: 10px 1px 6px 2px">
   {include file="items/updates_block.tpl" widthdiv="250px"}
   </div> 
   
  </div> 
  
  {if $smarty.post.doactiontool != 'do'}
  <div class="typelabel" style="margin-top: 12px">
   <input type="submit" value="&nbsp;Choose informer&nbsp;" class="button" name="rb" id="rb">
  </div> 
  {/if}
  
  <input type="hidden" value="do" name="doactiontool">
    
  {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
   {if $smarty.post.selectedinformer}
    {* код информера *}
    <div style="margin-top: 25px">
     <div class="typelabel">HTML code Informer</div>
     
     <div class="typelabel">
	  {if !$tool_object->GetResult('newinf.iditem')}
	   <div style="color: #FF0000; margin-left: 4px">Failed to register the informer!</div>	   
	  {else}
	  <textarea class="int_text" style="height: 100px; width: 95%"><!-- Updates informer by {$smarty.const.W_HOSTMYSITE} begin -->
<a href="http://{$smarty.const.W_HOSTMYSITE}" target="_blank" title="Visit {$smarty.const.W_HOSTMYSITE}"><img border="0" src="http://{$smarty.const.W_HOSTMYSITE}/informer-images/4/image-{$tool_object->GetResult('newinf.iditem')}.tif" alt="Updates informer"></a>
<!-- Updates informer by {$smarty.const.W_HOSTMYSITE} end --></textarea>
        
       <div class="typelabel" style="margin-top: 6px">BB code for your blog, or forum</div>
	   <div class="typelabel">
	   <textarea class="int_text" style="height: 100px; width: 95%">[url=http://{$smarty.const.W_HOSTMYSITE}][img]http://{$smarty.const.W_HOSTMYSITE}/informer-images/4/image-{$tool_object->GetResult('newinf.iditem')}.tif[/img][/url]</textarea>
	   </div> 
	  
	   <div class="typelabel">Preview</div>
	   <div class="typelabel">
	   <!-- Updates informer by {$smarty.const.W_HOSTMYSITE} begin -->
	   <a href="http://{$smarty.const.W_HOSTMYSITE}" target="_blank" title="Visit {$smarty.const.W_HOSTMYSITE}"><img border="0" src="http://{$smarty.const.W_HOSTMYSITE}/informer-images/4/image-{$tool_object->GetResult('newinf.iditem')}.tif" alt="Updates informer"></a>
	   <!-- Updates informer by {$smarty.const.W_HOSTMYSITE} end -->
	   </div>
	  
	  {/if}
	  
	  <div class="typelabel" style="margin-top: 14px"><a href="{$smarty.const.W_SITEPATH}tools/{$tool_object->section_id}/">&lt;&lt; Back to Top</a></div>  
	 
	 </div>    
    </div>    
   {else}
    <div style="margin-top: 25px"> 
     {include file="tools/informers/tpl_informers_list.tpl"}
    </div>
  
    <div class="typelabel" style="margin-top: 17px">
     <input type="submit" value="&nbsp;Get code of informer&nbsp;" class="button" name="rb" id="rb">
    </div>
   {/if}	   
  {/if}
      
 </form> 
 
 {/if}
</div>