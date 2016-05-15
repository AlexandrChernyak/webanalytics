{* результат получения информера скорости интернета *}

<div style="margin-top: 25px">
     <div class="typelabel">HTML code Informer</div>
     
     <div class="typelabel">
	  {if !$tool_object->GetResult('newinf.iditem')}
	   <div style="color: #FF0000; margin-left: 4px">Registration Error Informer!</div>	   
	  {else}
	  <textarea class="int_text" style="height: 100px; width: 95%"><!-- internet speed informer by {$smarty.const.W_HOSTMYSITE} begin -->
<a href="http://{$smarty.const.W_HOSTMYSITE}" target="_blank" title="Visit {$smarty.const.W_HOSTMYSITE}"><img border="0" src="http://{$smarty.const.W_HOSTMYSITE}/informer-images/1/image-{$tool_object->GetResult('newinf.iditem')}.tif" alt="internet speed informer"></a>
<!-- internet speed informer by {$smarty.const.W_HOSTMYSITE} end --></textarea>
        
       <div class="typelabel" style="margin-top: 6px">BB code to your blog, or forum</div>
	   <div class="typelabel">
	   <textarea class="int_text" style="height: 100px; width: 95%">[url=http://{$smarty.const.W_HOSTMYSITE}][img]http://{$smarty.const.W_HOSTMYSITE}/informer-images/1/image-{$tool_object->GetResult('newinf.iditem')}.tif[/img][/url]</textarea>
	   </div> 
	  
	   <div class="typelabel">Preview Informer</div>
	   <div class="typelabel">
	   <!-- internet speed informer by {$smarty.const.W_HOSTMYSITE} begin -->
	   <a href="http://{$smarty.const.W_HOSTMYSITE}" target="_blank" title="Visit {$smarty.const.W_HOSTMYSITE}"><img border="0" src="http://{$smarty.const.W_HOSTMYSITE}/informer-images/1/image-{$tool_object->GetResult('newinf.iditem')}.tif" alt="internet speed informer"></a>
	   <!-- internet speed informer by {$smarty.const.W_HOSTMYSITE} end -->
	   </div>
	  
	  {/if}  
	 
	 </div>    
</div>