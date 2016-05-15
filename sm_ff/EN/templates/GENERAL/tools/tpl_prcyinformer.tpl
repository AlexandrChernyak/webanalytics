{* информер pr cy *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool allows you to create a ticker parameters <b>Google PR</b> and <b>Yandex CY</b> on your site. You choose the appropriate informer, change the color of the informer, to receive accurate and current information about the `core` indicators of your site at any time.
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
 
 {if $smarty.post.doactiontool == 'do' && $smarty.post.actinp != 'select'}
 {literal}
 <script type="text/javascript">
  function GetInformCodeCheck(th) {	
   if (!th.selectedinformer.value) {
	alert('Select informer you want to use!');
	return false;
   }
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;
   return true;   	
  }//GetInformCodeCheck 	
 </script>
 {/literal}
 {else}
 {literal}
 <script type="text/javascript">
  function DoSetDefUrl(ident) {
   var str = {/literal}'{$smarty.const.W_HOSTMYSITE}';{literal}
   var obj = $('#'+ident);
   obj.val(str); 
   obj.focus();  	
  }//DoSetDefUrl
  function PrepereToSend(th) {
   if (trim(th.url.value) == '') {
	alert('Enter URL!');
	th.url.focus();
	return false;
   }
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;   
   return true;	
  }//PrepereToSend  	
 </script>
 {/literal}
 {/if}
 <form method="post" name="tollform" id="toolform" onsubmit="return {if $smarty.post.doactiontool == 'do' && $smarty.post.actinp != 'select'}GetInformCodeCheck{else}PrepereToSend{/if}(this)">
  
  <div class="typelabel"><label id="red">*</label> URL{if $smarty.post.doactiontool != 'do' || $smarty.post.actinp == 'select'}<label class="prep_label_analisys">(example: <a href="javascript:" onclick="DoSetDefUrl('url')">{$smarty.const.W_HOSTMYSITE}</a>)</label>{/if}</div>
  <div class="typelabel">
   <input type="text" value="{$CONTROL_OBJ->GetPostElement('url', 'doactiontool')}" style="width: 98%" class="inpt" name="url" id="url" maxlength="198" {if $smarty.post.doactiontool == 'do' && $smarty.post.actinp != 'select'} readonly="readonly"{/if}>
  </div>  
  
  {if $smarty.post.doactiontool != 'do' || $smarty.post.actinp == 'select'}
  <div class="typelabel" style="margin-top: 12px">
   <input type="submit" value="&nbsp;Choose informer&nbsp;" class="button" name="rb" id="rb">
  </div>
  <input type="hidden" value="select" name="actinp"> 
  {/if}
  
  <input type="hidden" value="do" name="doactiontool">
    
  {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  
   {if $smarty.post.actinp == 'select' && $tool_object->error} 
    <div style="margin-top: 14px; margin-left: 4px; color: #FF0000">{$tool_object->error}</div>  
   {else}  
   
   {if $smarty.post.selectedinformer}
    {* код информера *}
    <div style="margin-top: 25px">
     <div class="typelabel">HTML code Informer</div>
     
     <div class="typelabel">
	  {if !$tool_object->GetResult('newinf.iditem')}
	   <div style="color: #FF0000; margin-left: 4px">Registration Error Informer!</div>	   
	  {else}
	  <textarea class="int_text" style="height: 100px; width: 95%"><!-- PR CY informer by {$smarty.const.W_HOSTMYSITE} begin -->
<a href="http://{$smarty.const.W_HOSTMYSITE}" target="_blank" title="Visit {$smarty.const.W_HOSTMYSITE}"><img border="0" src="http://{$smarty.const.W_HOSTMYSITE}/informer-images/3/image-{$tool_object->GetResult('newinf.iditem')}.tif" alt="informer pr cy"></a>
<!-- PR CY informer by {$smarty.const.W_HOSTMYSITE} end --></textarea>
        
<div class="typelabel" style="margin-top: 6px">BB code to your blog or forum</div>
	   <div class="typelabel">
	   <textarea class="int_text" style="height: 100px; width: 95%">[url=http://{$smarty.const.W_HOSTMYSITE}][img]http://{$smarty.const.W_HOSTMYSITE}/informer-images/3/image-{$tool_object->GetResult('newinf.iditem')}.tif[/img][/url]</textarea>
	   </div>
	  
	   <div class="typelabel">Preview</div>
	   <div class="typelabel">
	   <!-- PR CY informer by {$smarty.const.W_HOSTMYSITE} begin -->
	   <a href="http://{$smarty.const.W_HOSTMYSITE}" target="_blank" title="Visit {$smarty.const.W_HOSTMYSITE}"><img border="0" src="http://{$smarty.const.W_HOSTMYSITE}/informer-images/3/image-{$tool_object->GetResult('newinf.iditem')}.tif" alt="informer pr cy"></a>
	   <!-- PR CY informer by {$smarty.const.W_HOSTMYSITE} end -->
	   </div>
	  
	  {/if}
	  
	  <div class="typelabel" style="margin-top: 14px"><a href="{$smarty.const.W_SITEPATH}tools/{$tool_object->section_id}/">&lt;&lt; Back to Top</a></div>  
	 
	 </div>    
    </div>    
   {else}
    <div style="margin-top: 25px"> 
     {include file="tools/informers/tpl_informers_list.tpl"}
    </div>
    
    {if $tool_object->GetResult('infdata')}
    <div class="typelabel" style="margin-top: 17px">
     <input type="submit" value="&nbsp;Get code Informer&nbsp;" class="button" name="rb" id="rb">
    </div>
    {else}
     <div style="margin-top: 17px">No active informers!</div>
    {/if}
    
   {/if}
   
   {/if}	   
  {/if}
      
 </form>
 
 {/if} 
</div>