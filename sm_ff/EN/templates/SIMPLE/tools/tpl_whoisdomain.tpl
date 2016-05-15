{* whois ip сайта *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool will help you get the Whois information contact the owner of this site.
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
	alert('Enter site Host!');
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
  <div class="typelabel"><label id="red">*</label> SiteHost <label class="prep_label_analisys">(example: <a href="javascript:" onclick="DoSetDefUrl('url')">{$smarty.const.W_HOSTMYSITE}</a>)</label></div>
  <div class="typelabel">  
   <input type="text" value="{$CONTROL_OBJ->GetPostElement('url', 'doactiontool')}" style="width: 98%" class="inpt" name="url" id="url">
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
	{if $tool_object->GetResult('createddate') || $tool_object->GetResult('expdate') || $tool_object->GetResult('registrar') || $tool_object->GetResult('cachlastupdatedate') || $tool_object->GetResult('nofound')}
	{literal}
	<style type="text/css">
     .h_th1 { 
      border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; border-right: none; 
      border-right: none; font-weight: bold; 
     }
     .btn_n { border: 1px solid #E3E4E8; border-top: none; height: 25px; margin-top: 4px; }
     .sth1 { border-bottom: 1px solid #E3E4E8; height: 25px; border-top: none; }	
    </style> 
    <script type="text/javascript">
    function DoHigl(th, n) {	
     if (n) { $(th).css('background','#F9FAFB'); } else {   	
      $(th).css('background', 'none');		
     }	
    }//DoHigl	
    </script>
	{/literal}
	<div style="margin-bottom: 7px"><b>Information about domain:</b></div>
	<span style="width: 100%">
	<table width="96%" cellpadding="0" cellspacing="0" border="0">
	 
	  {if $tool_object->GetResult('cachlastupdatedate')}
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="200px" style="color: #333399">
	    Last update:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px; color: #333399"> 
	    {$CONTROL_OBJ->GetLastIntervalInDays($tool_object->GetResult('cachlastupdatedate'))} &nbsp;
	    ({$tool_object->GetResult('cachlastupdatedate')})
	   </td>
      </tr>
      {/if}
	 
	 
	 {if $tool_object->GetResult('registrar')}
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
      <td class="sth1" valign="center" align="left" width="200px">
	   Registrar:	    
	  </td>	 
	  <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	   {$tool_object->GetResult('registrar')}
	  </td>
     </tr>
	 {/if}
	 
	 {if $tool_object->GetResult('nofound')}
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
      <td class="sth1" valign="center" align="left" width="200px">
	   <span style="color: #008000; font-weight: bold">Available</span>, buy at:	    
	  </td>	 
	  <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	   <noindex>
	    <a rel="nofollow" class="gotoregurl" href="http://seo-tools.forwebm.net/goto/5/{$tool_object->GetResult('nofound')}" target="_blank">reg.ru</a> <a class="gotoregurl" style="margin-left: 6px;" rel="nofollow" href="http://seo-tools.forwebm.net/goto/6" target="_blank">reggi.ru</a>
	   </noindex>	  
	  </td>
     </tr>
	 {/if}	 
	 
	 {if $tool_object->GetResult('createddate')}
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
      <td class="sth1" valign="center" align="left" width="200px">
	   Date of domain registration:	    
	  </td>	 
	  <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	   {$tool_object->GetResult('createddate')}
	  </td>
     </tr>
	 {/if}
	 
	 {if $tool_object->GetResult('domainold')}
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
      <td class="sth1" valign="center" align="left" width="200px">
	   Domain Age:	    
	  </td>	 
	  <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	   {$tool_object->GetResult('domainold')}
	  </td>
     </tr>
	 {/if}
	 
	 {if $tool_object->GetResult('old_days')}
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
      <td class="sth1" valign="center" align="left" width="200px">
	   Domain Age (days):	    
	  </td>	 
	  <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	   {$tool_object->GetResult('old_days')}	  
	  </td>
     </tr>
	 {/if}
	 
	 {if $tool_object->GetResult('expdate')}
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
      <td class="sth1" valign="center" align="left" width="200px">
	   Domain registration expires:	    
	  </td>	 
	  <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	   {$tool_object->GetResult('expdate')}	  
	  </td>
     </tr>
	 {/if}
	 	 
	 {if $tool_object->GetResult('pass')}
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
      <td class="sth1" valign="center" align="left" width="200px">
	   Remained until end (days):	    
	  </td>	 
	  <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	   {$tool_object->GetResult('pass')}
	  </td>
     </tr>
	 {/if}
	
	</table>	
	</span>	
	{/if}
	</div> 
    <div style="width: 530px; overflow: auto; margin-top: 18px">
     <pre>{$tool_object->GetResult('source')}</pre>    
	</div>
   {else}
    <div style="color: #FF0000">No Data</div>
   {/if}   
  {/if}
  </div>
 {else}
  {* блок информации при не выполненом запросе *}
  <div style="margin-top: 26px">
   {include file="tools/tpl_toolhistorylist.tpl"}
  </div> 
 {/if}
 
 {/if} 
</div>