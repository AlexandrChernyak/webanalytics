{* упаковка css *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool will guide you through the packaging code css (compression code).
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
  function ShHdBlElement(th, ident) {	   
    var hd = ($('#'+ident).css('visibility') == 'hidden') ? true : false; 
    $(th).html((hd) ? 'Hide' : 'Show');
    $('#'+ident).css('visibility', (hd) ? 'visible' : 'hidden');
    $('#'+ident).css('display', (hd) ? 'block' : 'none');
   }//ShHdBlElement	  	
 </script>
 {/literal}
 <form method="post" name="tollform" id="toolform" onsubmit="return PrepereToSend(this)">
  <div class="typelabel"><label id="red">*</label> CSS code</div>
  <div class="typelabel"> 
  
  <textarea class="int_text" style="height: 250px; width: 96%" name="source" id="source">{$CONTROL_OBJ->GetPostElement('source', 'doactiontool')}</textarea>
   
   <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
    <b>Options</b>
    <label style="color: #000000; margin-left: 6px">[
    <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'block1')">Hide</a>]</label>
    </div>
    <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="block1">
   
   
    <div class="typelabel">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('color-long2hex')}checked="checked" {/if}style="cursor: pointer" name="color-long2hex" id="color-long2hex"><label for="color-long2hex" style="cursor: pointer">&nbsp;Convert long names of colors in short HEX value</label>
	</div>
	
	<div class="typelabel">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('color-rgb2hex')}checked="checked" {/if}style="cursor: pointer" name="color-rgb2hex" id="color-rgb2hex"><label for="color-rgb2hex" style="cursor: pointer">&nbsp;Convert color values from RGB to HEX option (rgb(159,80,98) -&gt; #9F5062)</label>
	</div>
	
	<div class="typelabel">
	<input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('color-hex2shortcolor')}checked="checked" {/if}style="cursor: pointer" name="color-hex2shortcolor" id="color-hex2shortcolor"><label for="color-hex2shortcolor" style="cursor: pointer">&nbsp;Convert long HEX color values in their short names</label>
	</div>
	
	<div class="typelabel">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('color-hex2shorthex')}checked="checked" {/if}style="cursor: pointer" name="color-hex2shorthex" id="color-hex2shorthex"><label for="color-hex2shorthex" style="cursor: pointer">&nbsp;Convert long HEX color values in the short (#44ff11 -&gt; #4f1)</label>
	</div>
	
	<div class="typelabel">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('fontweight2num')}checked="checked" {/if}style="cursor: pointer" name="fontweight2num" id="fontweight2num"><label for="fontweight2num" style="cursor: pointer">&nbsp;Convert font-weight value to a numeric (bold -&gt; 700)</label>
	</div>
	
	<div class="typelabel">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('format-units')}checked="checked" {/if}style="cursor: pointer" name="format-units" id="format-units"><label for="format-units" style="cursor: pointer">&nbsp;Adjust the zero value of properties (15.0px -&gt; 15px, 0px -&gt; 0)</label>
	</div>
	
	<div class="typelabel">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('lowercase-selectors')}checked="checked" {/if}style="cursor: pointer" name="lowercase-selectors" id="lowercase-selectors"><label for="lowercase-selectors" style="cursor: pointer">&nbsp;Translate into lower case html tags (BODY -&gt; body)</label>
	</div>
	
	<div class="typelabel">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('directional-compress')}checked="checked" {/if}style="cursor: pointer" name="directional-compress" id="directional-compress"><label for="directional-compress" style="cursor: pointer">&nbsp;Corrected multi-valued properties (margin:15px 25px 15px 25px -&gt; margin:15px 25px)</label>
	</div>
	
	<div class="typelabel">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('multiple-selectors')}checked="checked" {/if}style="cursor: pointer" name="multiple-selectors" id="multiple-selectors"><label for="multiple-selectors" style="cursor: pointer">&nbsp;Combine selectors (p{literal}{color:blue;}{/literal} p{literal}{font-size:12pt}{/literal} -&gt; p{literal}{color:blue;font-size:12pt;}{/literal})</label>
	</div>
	
	<div class="typelabel">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('multiple-details')}checked="checked" {/if}style="cursor: pointer" name="multiple-details" id="multiple-details"><label for="multiple-details" style="cursor: pointer">&nbsp;Combine selectors with identical properties</label>
	</div>
	
	<div class="typelabel">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('csw-combine')}checked="checked" {/if}style="cursor: pointer" name="csw-combine" id="csw-combine"><label for="csw-combine" style="cursor: pointer">&nbsp;Merged color / style / width properties</label>
	</div>
	
	<div class="typelabel">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('mp-combine')}checked="checked" {/if}style="cursor: pointer" name="mp-combine" id="mp-combine"><label for="mp-combine" style="cursor: pointer">&nbsp;Merged margin \ padding property values</label>
	</div>
	
	<div class="typelabel">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('border-combine')}checked="checked" {/if}style="cursor: pointer" name="border-combine" id="border-combine"><label for="border-combine" style="cursor: pointer">&nbsp;Combine elements of border property values</label>
	</div>
	
	<div class="typelabel">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('font-combine')}checked="checked" {/if}style="cursor: pointer" name="font-combine" id="font-combine"><label for="font-combine" style="cursor: pointer">&nbsp;Combine values of font property</label>
	</div>
	
	<div class="typelabel">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('background-combine')}checked="checked" {/if}style="cursor: pointer" name="background-combine" id="background-combine"><label for="background-combine" style="cursor: pointer">&nbsp;Combine values of properties of background</label>
	</div>
	
	<div class="typelabel">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('list-combine')}checked="checked" {/if}style="cursor: pointer" name="list-combine" id="list-combine"><label for="list-combine" style="cursor: pointer">&nbsp;Combine values of property list-style</label>
	</div>
	
	<div class="typelabel">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('rm-multi-define')}checked="checked" {/if}style="cursor: pointer" name="rm-multi-define" id="rm-multi-define"><label for="rm-multi-define" style="cursor: pointer">&nbsp;Remove duplicate parameters</label>
	</div>
	
	<div class="typelabel"> Readability of code after packaging</div>
	<div class="typelabel">
	<select size="1" class="windowtxt" id="readability" name="readability">
	<option{if $smarty.post.readability == '0'} selected="selected"{/if} value="0">In one line</option>
	<option{if $smarty.post.readability == '1'} selected="selected"{/if} value="1">Minimum</option>
	<option{if $smarty.post.doactiontool != 'do' || $smarty.post.readability == '2'} selected="selected"{/if} value="2">Average</option>
	<option{if $smarty.post.readability == '3'} selected="selected"{/if} value="3">Maximum</option>
    </select>
	</div>
	
	
	<div style="margin-top: 8px">&nbsp;</div>
	</div>
	

   <div class="typelabel">
    <input type="submit" value="&nbsp;Send&nbsp;" class="button" name="rb" id="rb">
   </div> 
  </div>
  <input type="hidden" value="do" name="doactiontool">  
 </form>
 {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  {literal}
  <script type="text/javascript">
   function DoHigl(th, n) {	
    if (n) { $(th).css('background','#F8F5F1'); } else {   	
     $(th).css('background', 'none');		
    }	
   }//DoHigl
  </script>
  {/literal}
  <div style="margin-top: 25px; padding: 2px 0 10px 0; ">
  
   {if !$tool_object->GetResult()}
    <div style="margin-left: 4px; color: #FF0000">No Data!</div>
   {else}
    {literal}
    <script type="text/javascript">
    function decode() {
     var packed = document.getElementById('packed');
      eval("packed.value=String" + packed.value.slice(4));
    }
    </script>
    <style type="text/css">
      .h_th1, .h_td, .h_td2 { 
       border: 1px solid #E4D9CB; background: #EEE7DF; height: 25px; border-bottom: none; border-right: none; 
       border-right: none; font-weight: bold; 
      }
      .h_td { border-left: none; }
      .h_td2 { border-right: 1px solid #E4D9CB; border-left: none; }
      .btn_n { border: 1px solid #E4D9CB; border-top: none; height: 25px; margin-top: 4px; }
      .sth1 { border-bottom: 1px solid #E4D9CB; height: 25px; border-top: none; }	
     </style>
    {/literal}
	
	<div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
    <b>Result packing code</b>
    <label style="color: #000000; margin-left: 6px">[
    <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'block2')">Hide</a>]</label>
    </div>
    <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="block2">
    
     <div style="margin-top: 14px"><b style="color: #969696">Information before packing</b></div>
     <div style="margin-top: 10px">
      <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
	  
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Selectors:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    {$tool_object->GetResult('before.selectors')}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Properties:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    {$tool_object->GetResult('before.props')}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Size:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    {$tool_object->GetResult('before.size')}
	   </td>
      </tr>
        
	  </table>	  
	  </span>
     </div>
     
     <div style="margin-top: 14px"><b style="color: #969696">Information after package</b></div>
     <div style="margin-top: 10px">
      <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
	  
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Selectors:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    {$tool_object->GetResult('after.selectors')}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Properties:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    {$tool_object->GetResult('after.props')}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Size:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    {$tool_object->GetResult('after.size')}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Compression:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    {$tool_object->GetResult('after.compress')}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Processing time:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    {$tool_object->GetResult('after.timeexec')} sec
	   </td>
      </tr>
        
	  </table>	  
	  </span>
     </div>
     
    
     <div style="margin-top: 14px"><b style="color: #969696">Result</b></div>
     <div style="margin-top: 10px">
      <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('css')}</textarea>    
     </div> 
   
    </div>	
	    
   {/if}  	    
          
  </div>  
 {/if}
 
 {/if} 
</div>