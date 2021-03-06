{* сайт глазами поискового робота *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool will help you look at `preliminary` version of how they see your site search engine spiders.
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
 <form method="post" name="tollform" id="toolform" onsubmit="return PrepereToSend(this)">
  <div class="typelabel"><label id="red">*</label> URL<label class="prep_label_analisys">(example: <a href="javascript:" onclick="DoSetDefUrl('url')">{$smarty.const.W_HOSTMYSITE}</a>)</label></div>
  <div class="typelabel">  
   <input type="text" value="{$CONTROL_OBJ->GetPostElement('url', 'doactiontool')}" style="width: 450px" class="inpt" name="url" id="url">
   <div class="typelabel">
    <input type="submit" value="&nbsp;Send&nbsp;" class="button" name="rb" id="rb">
   </div> 
  </div>
  <input type="hidden" value="do" name="doactiontool">  
 </form>
 {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  <div style="margin-top: 15px">
  {if $tool_object->error}
  <div style="color: #FF0000">{$tool_object->error}</div>
  {else}
   {if $tool_object->GetResult()} 
    <div>
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
     
     <div style="padding-bottom: 6px; border-bottom: 1px solid #003366"><b>Response from server</b>
	   <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'headeranswer')">Hide</a>]</label>
	 </div>
	 <div id="headeranswer" style="width: 80%; overflow: auto; margin-top: 12px">
	  {foreach from=$tool_object->GetResult('header') item=val name=val}
	   {if $smarty.foreach.val.index > 0}
	   <div style="margin-top: 12px; margin-bottom: 12px">
	   <b>&gt;&gt;&gt;</b>
	   </div>
	   {/if}	  
	   <div><b>{$tool_object->GetIndex($smarty.foreach.val.index)}.</b></div>
	   <div style="margin-top: 4px">	   
	    <pre>{$val.data}</pre>
	   </div>
	  {/foreach}
	 </div>	  
	 
     <div style="padding-bottom: 6px; border-bottom: 1px solid #003366; margin-top: 34px">
	  <b>HTML code of page</b>
	  <label style="color: #000000; margin-left: 6px">[
	  <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'htmlsource')">Show</a>]</label>
	  {if $tool_object->GetResult('encoded')}
	  <label style="margin-left: 7px; font-size: 95%">[Encoding: <label style="color: #808080">{$tool_object->GetResult('encoded')}</label>]</label>
	  {/if}
	 </div>
	 <div id="htmlsource" style="width: 95%; overflow: auto; margin-top: 12px; visibility: hidden; display: none">
	  {$tool_object->GetResult('source')}
	 </div>
     
     <div style="padding-bottom: 6px; border-bottom: 1px solid #003366; margin-top: 34px">
	  <b>Text of page without tags and extra items</b>
	  <label style="color: #000000; margin-left: 6px">[
	  <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'textpage')">Show</a>]</label>
	 </div>
	 <div id="textpage" style="width: 95%; overflow: auto; margin-top: 12px; visibility: hidden; display: none">
	  {if $tool_object->GetResult('textpage')}
	   {$tool_object->GetResult('textpage')}
	  {else}
	   <div style="color: #FF0000">No Data!</div>
	  {/if} 
	 </div>
	 
	 {if $tool_object->GetResult('robotstxt')}
	 <div style="padding-bottom: 6px; border-bottom: 1px solid #003366; margin-top: 34px">
	  <b>File robots.txt</b>
	  <label style="color: #000000; margin-left: 6px">[
	  <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'robotstxt')">Show</a>]</label>
	 </div>
	 <div id="robotstxt" style="width: 95%; overflow: auto; margin-top: 12px; visibility: hidden; display: none">
	  <pre>{$tool_object->GetResult('robotstxt')}</pre>
	 </div>
	 {/if}
	 
	 <div style="padding-bottom: 6px; border-bottom: 1px solid #003366; margin-top: 34px">
	  <b>Internal and external links page</b>
	  <label style="margin-left: 6px">[ 
	  <a href="{$smarty.const.W_SITEPATH}tools/checkurllinks/{$tool_object->GetResult('link')}" target="_blank" title="View links page (opens in new window)">View links</a>
	   ]</label>
	 </div>
     
	</div>
   {else}
    <div style="color: #FF0000">No Data</div>
   {/if}   
  {/if}
  </div>
 {/if}
 
 {/if} 
</div>