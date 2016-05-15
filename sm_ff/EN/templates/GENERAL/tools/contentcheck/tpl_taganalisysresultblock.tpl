{* 
 вывод блока анализа тэга
 входные параметры:
 
 $block_ident = идентификатор информации о тэге
 $iscontent_info = true если вывод слов контента
*}
 {if !$iscontent_info}
 <div><b style="color: #969696">Original text</b></div>
 <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
  {$tool_object->GetResult($block_ident, 'text')}
 </div>
 
 <div style="margin-top: 10px"><b style="color: #969696">Processed text (without stop-words)</b></div>
 <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
  {$tool_object->GetResult($block_ident, 'textnostopwords')}
 </div>
 {/if}
 
 <!-- info about tag -->
 <div style="margin-top: 14px"><b style="color: #969696">General Information</b></div>
 <div style="margin-top: 10px">
  <span style="width: 100%">
   <table width="100%" cellpadding="0" cellspacing="0" border="0">
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Total words in text:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult($block_ident, 'allwordscount')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Words in the text (without stop-words):	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult($block_ident, 'wordscount')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Words without repetition and stop-words:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult($block_ident, 'wordsnorepeatnostopwords')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Stop-words in text:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult($block_ident, 'stopwordscount')}
	 </td>
    </tr>
    
    {if $tool_object->GetResult($block_ident, 'stopwordscount')}
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Stop-words List:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	  <div>
	   <label style="color: #000000">[
	    <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, '{$block_ident}stwords')">Show</a>]
	   </label>
	  </div>
	  <div style="display: none; visibility: hidden; padding-top: 6px" id="{$block_ident}stwords">
	   {$tool_object->GetWordListByArray($tool_object->GetResult($block_ident, 'stopwordslist'))}
	  </div>	  
	 </td>
    </tr>
    {/if}
    
    {if !$iscontent_info}
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  The density of all words to content:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult($block_ident, 'fullplotnost')}
	 </td>
    </tr>
        
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Text relevance to content:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult($block_ident, 'relevanttocontent')} %
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Occurrences of words in tag content:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult($block_ident, 'fullrepeatincontent')} of {$tool_object->GetResult($block_ident, 'wordscount')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Word is repeated in tag &gt; 1 times:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult($block_ident, 'wordscountinrepeatin')}
	 </td>
    </tr>
    {/if}
    
   </table>
  </span>
 </div>
 
 <!-- words info as list -->
 <div style="margin-top: 14px">
  <b style="color: #969696">Result analysis of words {if !$iscontent_info}tag{else}content{/if}</b>
 </div>
 <div style="margin-top: 10px">
  <span style="width: 100%">
   {if !$tool_object->GetResult($block_ident, 'wordslist')}
   <div style="margin: 4px 2px 0px 5px; color: #FF0000">In {if !$iscontent_info}tag{else}content{/if} words not found!</div>
   {else}
   
   {if !$iscontent_info}
    <div style="margin-top: 4px; margin-bottom: 4px; border: 1px dashed #808080; padding: 4px; font-size: 95%">
     <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
       <tr>
	    <td valign="top" align="left" width="24px">
	     <img src="{$smarty.const.W_SITEPATH}img/items/information2.png">
	    </td>
	    <td valign="top" align="left">
	     <div><b>Word</b> - analyzed word</div>
         <div><b>Count in tag</b> - number of repetitions of that word in parsed tag</div>
         <div><b>Density</b> - density of current word about content of page</div>
         <div><b>Occurrences</b> - number of occurrences of that word in a content page</div>
         <div><b>Frequency (TF)</b> - Frequency TF(Term Frequency) about content of page</div>
	    </td>
       </tr>
      </table>
	 </span>
    </div>
   {/if}
   
   <table width="100%" cellpadding="0" cellspacing="0" border="0" id="{$block_ident}tableq">
    <thead>	
     <tr>
 
      <th class="h_th1" valign="center" align="left">
       <label style="margin-left: 4px;">Word</label><label class="bgshortq">&nbsp;</label>
      </th>
      
      <th class="h_td" valign="center" align="left" width="125px">
       <label style="margin-left: 4px;">
	   {if !$iscontent_info}Count in tag{else}Occurrences{/if}
	   </label><label class="bgshortq">&nbsp;</label>
      </th>
      
      <th class="h_td" valign="center" align="left" width="100px">
       <label style="margin-left: 4px;">
	   {if !$iscontent_info}Density{else}In title{/if}
	   </label><label class="bgshortq">&nbsp;</label>
      </th>
      
      <th class="h_td" valign="center" align="left" width="110px">
       <label style="margin-left: 4px;">
	   {if !$iscontent_info}Occurrences{else}In Keywords{/if}
	   </label><label class="bgshortq">&nbsp;</label>
      </th>
  	  
      <th class="h_td2" valign="center" align="left" width="120px">
       <label style="margin-left: 4px;">Frequency (TF)</label><label class="bgshortq">&nbsp;</label>
      </th>
      
     </tr>   	
    </thead>
    
    {foreach from=$tool_object->GetResult($block_ident, 'wordslist') item=val name=val}
     <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
      
      <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E4D9CB; padding-left: 4px">
  	   {$val.word}  
      </td>
      
      <td class="sth1" valign="center" align="left" width="125px" style="padding-left: 4px">
       {$val.inputs}
      </td>
      
      <td class="sth1" valign="center" align="left" width="100px" style="padding-left: 4px">
       {if !$iscontent_info}{$val.plotnost}{else}{if $val.intitle}<label style="color: #0000FF">Yes</label>{else}No{/if}{/if}
      </td>
      
      <td class="sth1" valign="center" align="left" width="110px" style="padding-left: 4px">
       {if !$iscontent_info}{$val.inputs_in_content}{else}{if $val.inkeywords}<label style="color: #0000FF">Yes</label>{else}No{/if}{/if}
      </td>
         
      <td class="sth1" valign="center" align="left" width="120px" style="border-right: 1px solid #E4D9CB; padding-left: 4px">
       {$val.tfherz}
      </td>
     
     </tr>     
    {/foreach}   
   </table>
   
   <div id="{$block_ident}pager" class="pager" style="height: auto">
	<form>
	 <div style="height: 25px; margin-top: 6px">
		<img src="{$smarty.const.W_SITEPATH}img/items/tables_pages/first.png" class="first">
		<img src="{$smarty.const.W_SITEPATH}img/items/tables_pages/prev.png" class="prev">
		<input type="text" class="pagedisplay" readonly="readonly" style="position: relative; top: -3px">
		<img src="{$smarty.const.W_SITEPATH}img/items/tables_pages/next.png" class="next">
		<img src="{$smarty.const.W_SITEPATH}img/items/tables_pages/last.png" class="last">
		<select class="pagesize" style="position: relative; top: -2px">
			<option selected="selected" value="20">20</option>			
			<option value="40">40</option>
			<option value="50">50</option>
			<option value="80">80</option>
			<option value="100">100</option>
			<option value="150">150</option>
		</select>
	 </div>	
	</form>   
   </div>
   
   {literal}
   <script type="text/javascript">
    $(document).ready(function() { 
     $("#{/literal}{$block_ident}{literal}tableq") 
      .tablesorter() 
      .tablesorterPager({container: $("#{/literal}{$block_ident}{literal}pager"), size: 20, positionFixed: false}); 
    });	
   </script>
   {/literal}
   
   {if $iscontent_info}
   <!-- content data -->
   <div style="margin-top: 14px">
    <b style="color: #969696">Original content of page</b>, words (<b>{$tool_object->GetResult($block_ident, 'allwordscount')}</b>)
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('pageinfo.text')}</textarea>    
   </div>
   
   <div style="margin-top: 14px">
    <b style="color: #969696">Content page without stop-words</b>, words (<b>{$tool_object->GetResult($block_ident, 'wordscount')}</b>), without repetition (<b>{$tool_object->GetResult($block_ident, 'wordsnorepeatnostopwords')}</b>)
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('pageinfo.textnostopwords')}</textarea>    
   </div>
   
   <div style="margin-top: 14px">
    <b style="color: #969696">HTML page code</b>, total characters (<b>{$tool_object->GetResult('pageinfo.charscount')}</b>)
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('pageinfo.htmldata')}</textarea>    
   </div>
   
   <div style="margin-top: 14px">
    <b style="color: #969696">Response from server</b>
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('pageinfo.headresponse')}</textarea>
   </div>
   {/if}
   
   {/if}   
  </span>
 </div>
 