{* анализ текста *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool will help you to perform analysis of text (number of words, symbols, stop words, frequency, density, etc.).
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
	alert('Enter text for analysis!');
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
  <div class="typelabel"><label id="red">*</label> Text for analysis</div>
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
  <div style="margin-top: 25px">
   <span style="width: 100%">
   <table width="96%" cellpadding="0" cellspacing="0" border="0">
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="295px">
	  Total characters in text:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult('allcharscount')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="295px">
	  Total characters with no spaces:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult('allcharscount_nospaces')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="295px">
	  Total characters with no spaces and line breaks:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult('allcharsnospacesandbreaks')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="295px">
	  Total words:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult('wordscount')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="295px">
	  Total words without repetition and stop-words:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult('wordsnorepeat')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="295px">
	  Characters with no stop words and unnecessary symbols:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult('resultlenght')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="295px">
	  Total stop-words:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult('stopwordscount')}
	 </td>
    </tr>
    
    {if $tool_object->GetResult('stopwordscount')}
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Stop-words list:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	  <div>
	   <label style="color: #000000">[
	    <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'qstwords')">Show</a>]
	   </label>
	  </div>
	  <div style="display: none; visibility: hidden; padding-top: 6px" id="qstwords">
	   {$tool_object->GetWordListByArray($tool_object->GetResult('stopwordslist'))}
	  </div>	  
	 </td>
    </tr>
    {/if}    
   
   </table>
   </span> 
   
   <div></div>   
   <div style="margin-top: 14px">
    <b style="color: #969696">Text without tags and extra characters</b>
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 96%">{$tool_object->GetResult('correctedsource')}</textarea>    
   </div>
   
   <div style="margin-top: 14px">
    <b style="color: #969696">ext without repetition, stop-words, tag, and extra characters</b>
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 96%">{$tool_object->GetResult('textnostopwords')}</textarea>    
   </div>
          
  </div>  
  
 {/if}
 
 {/if} 
</div>