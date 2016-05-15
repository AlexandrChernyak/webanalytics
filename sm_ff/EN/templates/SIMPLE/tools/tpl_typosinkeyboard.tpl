{* генератор опечаток слепой печати *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool will help you to generate text using typographical errors `touch-typing`. These errors are produced by pressing the `wrong key` in the process of printing the text (adjacent).
 {/if}
 
 <div style="clear: both;"></div>
 </div>

 {if !$tool_object->canrun}
  <div style="margin-top: 25px">
  {if $tool_object->onlyforadmin}
  The tool is temporarily disabled by the administrator! We apologize for any inconvenience .. Please try again later.
  {else}  
  To use this tool requires authorization on the site. Please login or <a href="{$smarty.const.W_SITEPATH}register/" target="_blank">register</a> to gain access to the tool.
  {/if} 
  </div>
 {else}
 
 {literal}
 <script type="text/javascript">
  function PrepereToSend(th) {
   if (trim(th.lines.value) == '') {
	alert('Enter text for processing');
	th.lines.focus();
	return false;
   }
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;
   return true;	
  }//PrepereToSend  	
 </script> 
 {/literal}
 <form method="post" name="tollform" id="toolform" onsubmit="return PrepereToSend(this)">
  <div class="typelabel"><label id="red">*</label> Text processing{if isset($tool_object) && $tool_object->GetLimitCount()}, &nbsp;No more: {$tool_object->GetLimitCount()} characters{/if}</div>
  <div class="typelabel">  
   <div><textarea class="int_text" style="height: 100px; width: 95%" name="lines" id="lines" onblur="OnBlurCorrect(this)" onclick="OnBlurCorrect(this)">{$CONTROL_OBJ->GetPostElement('lines', 'doactiontool')}</textarea></div>
   {if $tool_object->GetLimitCount()}
    <div id="maxlenlines" style="font-size: 90%">JavaScript not supported</div>
   {/if}
   
   <div class="typelabel">
    <input type="checkbox" {if $smarty.post.doactiontool == 'do' && $CONTROL_OBJ->CheckPostValue('tolowercase')}checked="checked" {/if}style="cursor: pointer" name="tolowercase" id="tolowercase"><label for="tolowercase" style="cursor: pointer">&nbsp;Translate text to lowercase characters</label>
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $smarty.post.doactiontool == 'do' && $CONTROL_OBJ->CheckPostValue('deletemorespaces')}checked="checked" {/if}style="cursor: pointer" name="deletemorespaces" id="deletemorespaces"><label for="deletemorespaces" style="cursor: pointer">&nbsp;Remove any extra spaces</label>
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('withenglish')}checked="checked" {/if}style="cursor: pointer" name="withenglish" id="withenglish"><label for="withenglish" style="cursor: pointer">&nbsp;Typos for English characters</label>
   </div>
   
   <div class="typelabel">
    To the Russian character: If the previous word written in English - to continue typing Russian words in the English keyboard layout. Print number of words, and then again to return the Russian keyboard layout: (0 - do not continue on the English keyboard layout)
   </div>
   <div class="typelabel">  
    <input type="text" value="{if $smarty.post.doactiontool != 'do'}2{else}{$CONTROL_OBJ->GetPostElement('wordscounttransp', 'doactiontool')}{/if}" style="width: 200px" class="inpt" name="wordscounttransp" id="wordscounttransp" maxlength="5"> 
    </div>
    
    <div class="typelabel">
    The amount of text to replace in the typos (in %). 100% - full text, 0% - no typos.
   </div>
   <div class="typelabel">  
    <input type="text" value="{if $smarty.post.doactiontool != 'do'}10{else}{$CONTROL_OBJ->GetPostElement('percentrepl', 'doactiontool')}{/if}" style="width: 200px" class="inpt" name="percentrepl" id="percentrepl" maxlength="5"> 
    </div>
   
   
   <div class="typelabel">
    <input type="submit" value="&nbsp;Send&nbsp;" class="button" name="rb" id="rb">
   </div> 
  </div>
  <input type="hidden" value="do" name="doactiontool">  
 </form>
 
 {if $tool_object->GetLimitCount()}
 {literal}
 <script type="text/javascript">
  var globalobj_count = {/literal}{$tool_object->GetLimitCount()}{literal};
   jQuery.fn.maxlength = function(options) {
   var settings = jQuery.extend({
    maxChars: globalobj_count, 
    leftChars: "left" 
   }, options);
   return this.each(function() {
     var me = $(this);
     var l = settings.maxChars;
     me.bind('keydown keypress keyup',function(e) {
      if(me.val().length>settings.maxChars) me.val(me.val().substr(0,settings.maxChars));
      l = settings.maxChars - me.val().length;
      $("#maxlen"+this.name).html(l + ' ' + settings.leftChars);
     });
     OnBlurCorrect(this);
    });
   }; 
   function OnBlurCorrect(th) {
    var me = $(th);
    var l = globalobj_count;
    var leftChars = "left";
    if(me.val().length>l) me.val(me.val().substr(0,l));
    l = l - me.val().length;
    $("#maxlen"+th.name).html(l + ' ' + leftChars);	
   }	
   $(document).ready(function(){ $("#lines").maxlength(); });	
 </script>
 {/literal}
 {/if}
 
 {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  <div style="margin-top: 15px">
  {if $tool_object->error}
  <div style="color: #FF0000">{$tool_object->error}</div>
  {else}
   <div style="margin-top: 4px"> 
    <div><b>Result:</b></div>
    <div style="margin-top: 6px"><textarea class="int_text" style="height: 200px; width: 95%" name="res" id="res">{$tool_object->GetResult('result')}</textarea></div>
    <div style="margin-top: 6px">
	 <b>Statistics:</b> Total return for typos: <b>{$tool_object->GetResult('statinfo.replfor')}</b>, spacing changes: <b>{$tool_object->GetResult('statinfo.interval')}</b> characters, russian words in the English keyboard layout: <b>{$tool_object->GetResult('statinfo.allwordsinenglish')}</b>
	</div>
   </div>
  {/if}
  </div>
 {/if}
 
 {/if} 
</div>