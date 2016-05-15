{* упаковка javascript *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool will guide you through the packaging code javascript (compression code).
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
  <div class="typelabel"><label id="red">*</label> JavaScript Code</div>
  <div class="typelabel"> 
  
  <textarea class="int_text" style="height: 250px; width: 96%" name="source" id="source">{$CONTROL_OBJ->GetPostElement('source', 'doactiontool')}</textarea>
   
   <div class="typelabel"> Coding:</div>
   <div class="typelabel">
    <select name="ascii_encoding" id="ascii_encoding" class="windowtxt">
     <option{if $smarty.post.ascii_encoding == '0'} selected="selected"{/if} value="0">None</option>
     <option{if $smarty.post.ascii_encoding == '10'} selected="selected"{/if} value="10">Numeric</option>
     <option{if $smarty.post.doactiontool != 'do' || $smarty.post.ascii_encoding == '62'} selected="selected"{/if} value="62">Normal</option>
     <option{if $smarty.post.ascii_encoding == '95'} selected="selected"{/if} value="95">High ASCII</option>
    </select>
    
	<span style="margin-left: 6px">
	<input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('fast_decode')}checked="checked" {/if}style="cursor: pointer" name="fast_decode" id="fast_decode"><label for="fast_decode" style="cursor: pointer">&nbsp;Quick decompression</label>
	</span>
	
	<span style="margin-left: 6px">
	<input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('special_char')}checked="checked" {/if}style="cursor: pointer" name="special_char" id="special_char"><label for="special_char" style="cursor: pointer">&nbsp;Spec. Symbols</label>
	</span>

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
   function ShHdBlElement(th, ident) {	   
    var hd = ($('#'+ident).css('visibility') == 'hidden') ? true : false; 
    $(th).html((hd) ? 'Hide' : 'Show');
    $('#'+ident).css('visibility', (hd) ? 'visible' : 'hidden');
    $('#'+ident).css('display', (hd) ? 'block' : 'none');
   }//ShHdBlElement	
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
    <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'block1')">Hide</a>]</label>
    </div>
    <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="block1">
    
     <div style="margin-top: 14px"><b style="color: #969696">Information</b></div>
     <div style="margin-top: 10px">
      <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
	  
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Compression:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    {$tool_object->GetResult('originalLength')} из {$tool_object->GetResult('packedLength')} =  
	    {$tool_object->GetResult('ratio')}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Executed due:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    {$tool_object->GetResult('time')} sec
	   </td>
      </tr>
      
	  </table>	  
	  </span>
     </div>
    
     <div style="margin-top: 14px"><b style="color: #969696">Result</b></div>
     <div style="margin-top: 10px">
      <textarea class="int_text" id="packed" style="height: 120px; width: 100%">{$tool_object->GetResult('packed')}</textarea>    
     </div> 
     
     <div class="typelabel">
      <input type="button" value="&nbsp;Unpack&nbsp;" onclick="decode()" class="butt" name="rb" id="rb">
     </div>
   
    </div>
	
	
	    
   {/if}  	    
          
  </div>  
 {/if}
 
 {/if} 
</div>