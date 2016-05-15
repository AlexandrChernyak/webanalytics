{* генератор ключевых слов с сайта *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool will help you generate a `potential` keywords for your site, based on the text you specified site. Will be chosen by the most weighty words of the text.
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
  function DoSetDefUrl(ident) {
   var str = {/literal}'{$smarty.const.W_HOSTMYSITE}';{literal}
   var obj = $('#'+ident);
   obj.val(str); 
   obj.focus();  	
  }//DoSetDefUrl
  function PrepereToSend(th) {
   if (trim(th.url.value) == '') {
	alert('Specify the host site!');
	th.url.focus();
	return false;
   }
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;   
   return true;	
  }//PrepereToSend  	
 </script>
 {/literal}
 <form method="post" name="tollform" id="toolform" onsubmit="return PrepereToSend(this)">
  <div class="typelabel"><label id="red">*</label> Site URL <label class="prep_label_analisys">(example: <a href="javascript:" onclick="DoSetDefUrl('url')">{$smarty.const.W_HOSTMYSITE}</a>)</label>
  <label style="margin-left: 6px; font-size: 95%">[processed {if !$tool_object->GetToolLimitInfoEx('allwordsforuse') || $tool_object->GetToolLimitInfoEx('allwordsforuse') < 0}<u>all words</u>{else}<u>{$tool_object->GetToolLimitInfoEx('allwordsforuse')} words</u>{/if}]</label></div>
  <div class="typelabel">  
   <input type="text" value="{$CONTROL_OBJ->GetPostElement('url', 'doactiontool')}" style="width: 98%" class="inpt" name="url" id="url">
   
   <div class="typelabel">
    <input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('getfrombody')}checked="checked" {/if}style="cursor: pointer" name="getfrombody" id="getfrombody"><label for="getfrombody" style="cursor: pointer">&nbsp;Get text from tag &lt;body&gt; (if tag exists)</label>
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('ignorestopwords')}checked="checked" {/if}style="cursor: pointer" name="ignorestopwords" id="ignorestopwords"><label for="ignorestopwords" style="cursor: pointer">&nbsp;Ignore stop-words</label>
   </div>
   
   <div class="typelabel" style="margin-top: 10px">Share keywords block (spaces included)</div>
   <div class="typelabel">
    <input type="text" value="{$CONTROL_OBJ->GetPostElement('separator', 'doactiontool', 'do', ', ')}" style="width: 250px" class="inpt" name="separator" id="separator">
   </div> 
   
   <div class="typelabel">Generate keywords in number of</div>
   <div class="typelabel">
    <input type="text" value="{$CONTROL_OBJ->GetPostElement('usecount', 'doactiontool', 'do', '18')}" style="width: 250px" class="inpt" name="usecount" id="usecount">
   </div>
   
   <div class="typelabel">Minimum number of characters in parsed word</div>
   <div class="typelabel">
    <input type="text" value="{$CONTROL_OBJ->GetPostElement('minlenght', 'doactiontool', 'do', '3')}" style="width: 250px" class="inpt" name="minlenght" id="minlenght">
   </div>
   
   <div class="typelabel">
    <input type="submit" value="&nbsp;Send&nbsp;" class="button" name="rb" id="rb">
   </div> 
  </div>
  <input type="hidden" value="do" name="doactiontool">  
 </form>
 {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  {include file="tools/keygeneratorurl/tpl_result_keygen.tpl"}
 {/if}
 
 {/if} 
</div>