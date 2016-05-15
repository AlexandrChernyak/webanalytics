{* экранирование url *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool will guide you through the screening / de screening line standard Encode / Decode URL addresses of web pages.
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
	alert('Enter text for processing!');
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
  <div class="typelabel"><label id="red">*</label> Link text for processing</div>
  <div class="typelabel"> 
  
  <textarea class="int_text" style="height: 100px; width: 96%" name="source" id="source">{$CONTROL_OBJ->GetPostElement('source', 'doactiontool')}</textarea>

   <div class="typelabel">
    <input type="submit" value="&nbsp;Send&nbsp;" class="button" name="rb" id="rb">
   </div> 
  </div>
  <input type="hidden" value="do" name="doactiontool">  
 </form>
 {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  {literal}
  <script type="text/javascript">
   function ShHdBlElement(th, ident) {	   
    var hd = ($('#'+ident).css('visibility') == 'hidden') ? true : false; 
    $(th).html((hd) ? 'Hide' : 'Show');
    $('#'+ident).css('visibility', (hd) ? 'visible' : 'hidden');
    $('#'+ident).css('display', (hd) ? 'block' : 'none');
   }//ShHdBlElement	
  </script>
  {/literal}
  <div style="margin-top: 25px">
   
   <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
   <b>Encode / Decode URL</b>
   <label style="color: #000000; margin-left: 6px">[
   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'blencodedecode')">Hide</a>]</label>
   </div>
   <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="blencodedecode">
   
    <div style="margin-top: 14px"><b style="color: #969696">Encode</b></div>
    <div style="margin-top: 10px">
     <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('encode')}</textarea>    
    </div>
   
    <div style="margin-top: 14px"><b style="color: #969696">Decode</b></div>
    <div style="margin-top: 10px">
     <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('decode')}</textarea>    
    </div>
   
   </div>
   
   <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
   <b>Encode / Decode URL in accordance with RFC1738</b>
   <label style="color: #000000; margin-left: 6px">[
   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'rawblencodedecode')">Hide</a>]</label>
   </div>
   <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="rawblencodedecode">
    <div style="margin-top: 14px"><b style="color: #969696">Encode</b></div>
    <div style="margin-top: 10px">
     <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('rawencode')}</textarea>    
    </div>
   
    <div style="margin-top: 14px"><b style="color: #969696">Decode</b></div>
    <div style="margin-top: 10px">
     <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('rawdecode')}</textarea>    
    </div>
   </div>	    
          
  </div>  
 {/if} 
 
 {/if}
</div>