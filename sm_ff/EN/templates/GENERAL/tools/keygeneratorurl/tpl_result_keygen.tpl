{* результат обработки генератора ключевых слов *}

  <div style="margin-top: 22px">
  {if $tool_object->error}
  <div style="color: #FF0000">{$tool_object->error}</div>
  {else}
   {if $tool_object->GetResult()}
    <div>
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
     .sth1 { border-bottom: 1px solid #E4D9CB; height: 25px; border-top: none; }	
    </style> 
    <script type="text/javascript">
    function DoHigl(th, n) {	
     if (n) { $(th).css('background','#F8F5F1'); } else {   	
      $(th).css('background', 'none');		
     }	
    }//DoHigl
	function ShHdBlElement(th, ident) {	   
	 var hd = ($('#'+ident).css('visibility') == 'hidden') ? true : false; 
	 $(th).html((hd) ? 'Hide' : 'Show');
	 $('#'+ident).css('visibility', (hd) ? 'visible' : 'hidden');
	 $('#'+ident).css('display', (hd) ? 'block' : 'none');
	}//ShHdBlElement	
    </script>
	{/literal}
	<div style="margin-bottom: 7px"><b>Information about text:</b></div>
	<span style="width: 100%">
	<table width="96%" cellpadding="0" cellspacing="0" border="0">
	 
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="200px">
	    Total words in text:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px;"> 
	    {$tool_object->GetResult('wordscount')}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="200px">
	    Processed words (no repeats):	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px;"> 
	    {$tool_object->GetResult('wordsnorepeat')}
	   </td>
      </tr>
	 	
	</table>	
	</span>	
	</div> 
    <div style="margin-top: 18px; width: 96%">
     <div style="margin-top: 10px"><b style="color: #969696">Result</b></div>
     <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
      {$tool_object->GetResult('result')}
     </div>     
	</div>
		
	<div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	<b>Word list details</b>
	<label style="color: #000000; margin-left: 6px">[
	  <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'wordsblocksource')">Hide</a>]</label>
	</div>
	<div style="margin-top: 12px; width: 95%; padding-left: 6px" id="wordsblocksource">
	 {if !$tool_object->GetResult('wordslist')}
	  <div style="margin-left: 4px; color: #FF0000">Could not find text for processing!</div>
	 {else}	  
	  <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0" id="tableq">
      <thead>	
       <tr>
 
        <th class="h_th1" valign="center" align="left">
         <label style="margin-left: 4px;">Word</label><label class="bgshortq">&nbsp;</label>
        </th>
      
        <th class="h_td" valign="center" align="left" width="125px">
         <label style="margin-left: 4px;">
	     Occurrences
	     </label><label class="bgshortq">&nbsp;</label>
        </th>
  	  
        <th class="h_td2" valign="center" align="left" width="120px">
         <label style="margin-left: 4px;">Frequency (TF)</label><label class="bgshortq">&nbsp;</label>
        </th>
      
       </tr>   	
      </thead>
	  {foreach from=$tool_object->GetResult('wordslist') item=val name=val}
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
      
       <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E4D9CB; padding-left: 4px">
  	    {$val.word}  
       </td>
      
       <td class="sth1" valign="center" align="left" width="125px" style="padding-left: 4px">
        {$val.inputs}
       </td>
         
       <td class="sth1" valign="center" align="left" width="120px" style="border-right: 1px solid #E4D9CB; padding-left: 4px">
        {$val.freg}
       </td>
     
      </tr>
	  {/foreach}
	  </table>
	  
	  <div id="pager2" class="pager" style="height: auto">
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
     $("#tableq") 
      .tablesorter() 
      .tablesorterPager({container: $("#pager2"), size: 20, positionFixed: false}); 
    });	
   </script>
   {/literal}
	  	  	  	   
	  </span>
	 {/if}
	</div>
	
	
   {else}
    <div style="color: #FF0000">No data</div>
   {/if}   
  {/if}
  </div>