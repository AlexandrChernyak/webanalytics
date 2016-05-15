{* генератор favorit иконки *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool will help you generate Favorit icon for your website from image of any size (from affordable to use format).
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
 
 {literal}
 <script type="text/javascript">
  function PrepereToSend(th) {
   //$('#globalbodydata').css('cursor', 'wait');
   //th.rb.disabled = true;   
   return true;	
  }//PrepereToSend  	
 </script>
 {/literal}
 <form method="post" name="tollform" id="toolform" enctype="multipart/form-data" onsubmit="return PrepereToSend(this)">
  <div class="typelabel"><label id="red">*</label> Image file (formats: {$tool_object->GetListTypes()}){if $tool_object->GetResult('maxsize')},<label style="margin-left: 6px">[Maximum size: <b>{$tool_object->GetResult('maxsize')}</b>]</label>{/if}</div>
  
  <div class="typelabel"> 
   <input type="file" size="20" style="width: 430px; height: 22px" class="inpt" name="image" id="image">  
  </div>
  <div class="typelabel"> Create an icon in format</div>
  <div class="typelabel">
   <select size="1" name="formatfav" id="formatfav">
	<option value="0" selected="selected">.png</option>
	<option value="1">.ico (** transparency is not preserved)</option>
   </select>
  </div>  
  
  <div class="typelabel">
   <input type="submit" value="&nbsp;Send&nbsp;" class="button" name="rb" id="rb">
  </div> 
  <input type="hidden" value="do" name="doactiontool">
  
  <div style="margin-top: 20px">Example to create icon in "Opera" browser Favorit:</div>
  <div class="typelabel">
   <img src="{$smarty.const.W_SITEPATH}img/items/favicontemplate.jpg" style="width: 308px; height: 63px;">
  </div>
    
 </form> 
 
 {if $smarty.post.doactiontool == 'do' && isset($tool_object) && $tool_object->error}
  <div style="margin-top: 37px">
   <b style="color: #FF0000">{$tool_object->error}</b>     
  </div>  
 {/if}
 
 {/if} 
</div>