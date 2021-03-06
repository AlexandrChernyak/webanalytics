{* доступность сайта ping\tracerout *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool will help you validate uptime site (Ping / Tracerout).
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
   $('#'+ident).val(str); 
   $('#'+ident).focus();  	
  }//DoSetDefUrl
  function PrepereToSend(th) {
   if (trim(th.url.value) == '') {
	alert('Укажите хост сайта!');
	th.url.focus();
	return false;
   }
   th.rb.disabled = true;
   return true;	
  }//PrepereToSend  	
 </script>
 {/literal}
 <form method="post" name="tollform" id="toolform" onsubmit="return PrepereToSend(this)">

  <span style="width: 100%">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
	<td align="left" valign="top" width="356px">
	 <div class="typelabel"><label id="red">*</label> Host site or ip <label class="prep_label_analisys">(example: <a href="javascript:" onclick="DoSetDefUrl('url')">{$smarty.const.W_HOSTMYSITE}</a>)</label></div>
	 </td>
	<td align="left" valign="top">	
	 <div class="typelabel"><label style="margin-left: 5px">Jumps</label></div>	
	</td>
  </tr> 
  <tr>
	<td align="left" valign="top" width="356px">
     <div class="typelabel">
      <input type="text" value="{$CONTROL_OBJ->GetPostElement('url', 'doactiontool')}" style="width: 350px" class="inpt" name="url" id="url">
     </div>	
	</td>	
	<td align="left" valign="top">
	 <div class="typelabel" style="margin-left: 5px">
	 <select size="1" class="inpt" style="width: 150px; height: auto" name="count">
      {if !$tool_object->GetStepsCountList()}
       <option value="4">4</option>
      {else}
	   {foreach from=$tool_object->GetStepsCountList() item=val name=val}
	    <option value="{$val.value}"{if $val.selected} selected="selected"{/if}>{$val.value}</option>
	   {/foreach}
	  {/if} 
     </select>
	 </div>	
	</td>
  </tr>
  </table>
  </span>
  
  <div class="typelabel">
   <input type="submit" value="&nbsp;Send&nbsp;" class="button" name="rb" id="rb">      
  </div>  

  <input type="hidden" value="do" name="doactiontool">  
 </form>
 {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  <div style="margin-top: 15px">
  {if $tool_object->error}
  <div style="color: #FF0000">{$tool_object->error}</div>
  {else}
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
   function DoHigl(th, n) {	
    if (n) { $(th).css('background','#F8F5F1'); } else {   	
     $(th).css('background', 'none');		
    }	
   }//DoHigl	
   </script>
   {/literal}
   <span style="width: 100%"> 
   <table width="96%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <td class="h_th1" valign="center" align="center" width="35px">№</td>	
	<td class="h_td2" valign="center" align="left"><label style="margin-left: 8px">Result</label></td>
   </tr>   	
   {if $tool_object->GetResult()}
	{foreach from=$tool_object->GetResult() item=val name=val}	 
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	 
     <td class="sth1" valign="center" align="center" width="35px" style="border-left: 1px solid #E4D9CB">
	  {$val.tl}	    
	 </td>	 

	 <td class="sth1" valign="center" align="left" style="border-right: 1px solid #E4D9CB;">
	  <label style="margin-left: 8px">
	  time {$val.time}, to {$val.to}	  
	  </label>
	 </td>
    </tr>	 
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="2">
     No Data!
    </td>
   </tr> 
   {/if} 
   </table>   
   </span>
  {/if}
  </div>
 {/if}
 
 {/if} 
</div>