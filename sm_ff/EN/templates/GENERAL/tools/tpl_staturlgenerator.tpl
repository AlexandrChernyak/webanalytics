{* генератор статических url *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool will help you generate a static URL instead of the standard representations of links.<br />
 <br /><br /><br />
 When referring links, use the following options:<br /><br />
 1) Specifying a specific variable names and their meanings:<br />
 Example: index.php?var1=<b>value1</b>&var2=<b>value2</b>&var3=<b>value3</b><br />
 In this case, the link will be unchanged.
 <br /><br />
 2) Dynamic reference values of the variables (for this, just leave the variables blank):<br />
 Example: <u>index.php?var1=&var2=&var3=</u>   or  <u>index.php?var1=&var2=value2&var3=</u><br />
 n this case, the link will be constructed by a variant: path/<b>value1</b>/<b>value2</b>/<b>valueN</b>/
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
   if (trim(th.source.value) == '') {
	alert('Enter list URL to convert!');
	th.source.focus();
	return false;
   }
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;   
   return true;	
  }//PrepereToSend  	
 </script>
 {/literal}
 <form method="post" name="tollform" id="toolform" onsubmit="return PrepereToSend(this)">
  <div class="typelabel"><label id="red">*</label> A list of URL to convert (one per line){if $tool_object->GetToolLimitInfoEx('maxurlcount')}<label style="font-size: 95%; margin-left: 6px">[max. <u>{$tool_object->GetToolLimitInfoEx('maxurlcount')}</u>]</label>{/if}</div>
  <div class="typelabel"> 
  
  <textarea class="int_text" style="height: 100px; width: 96%" name="source" id="source">{$CONTROL_OBJ->GetPostElement('source', 'doactiontool')}</textarea>
  
  <div class="typelabel">
   <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('wR')}checked="checked" {/if}style="cursor: pointer" name="wR" id="wR"><label for="wR" style="cursor: pointer">&nbsp;Returned as redirect with code (flag R)</label>
  </div>
  
  <div class="typelabel">
   <input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('wL')}checked="checked" {/if}style="cursor: pointer" name="wL" id="wL"><label for="wL" style="cursor: pointer">&nbsp;Assume that current reference final (flag L)</label>
  </div>
  
   <div class="typelabel">
    <input type="submit" value="&nbsp;Send&nbsp;" class="button" name="rb" id="rb">
   </div> 
  </div>
  <input type="hidden" value="do" name="doactiontool">  
 </form>
 {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  <div style="margin-top: 25px">
   
   <div style="margin-top: 14px">
    <b style="color: #969696">Result</b>
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 96%">{$tool_object->GetResult('result')}</textarea>    
   </div>  
          
  </div>  
 {/if}
 
 {/if} 
</div>