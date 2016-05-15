{* основной раздел *}
<div style="margin-top: 4px">
 {literal}
 <script type="text/javascript">
  function PrepereToSendItem(th) {
   if (!confirm('Are you sure you want to perform the selected operation?')) { return false; }	
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;
   return true;	
  }//PrepereToSendItem	
 </script>
 {/literal}

 <div style="border-bottom: 1px solid #C0C0C0; padding-bottom: 4px; margin-top: 18px"><b>Project information</b></div>
 <div style="margin-top: 4px">
  <span style="width: 100%">
   <table width="100%" cellpadding="0" cellspacing="0" border="0">
    
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Project version	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 <strong>{$adm_object->GetResult('eV')}</strong>     
	</td>
   </tr>
   
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Build Date	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 <strong>{$adm_object->GetResult('eD')}</strong>     
	</td>
   </tr>
   
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Total Tools	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 <strong>{$adm_object->GetResult('eiC')}</strong>     
	</td>
   </tr> 
        
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Original project, information	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 <a href="http://seo-tools.forwebm.net" target="_blank">seo-tools.forwebm.net</a>     
	</td>
   </tr>       
    
   </table>
  </span> 
 </div>
 
  
 <div style="border-bottom: 1px solid #C0C0C0; padding-bottom: 4px; margin-top: 18px"><b>Cache</b>  ({$adm_object->GetResult('allcachsize')})</div>
 <div style="margin-top: 4px">
  <form method="post" name="c1" id="c1" onsubmit="return PrepereToSendItem(this)">
   <div>
    Cache average data (numerical values​​, etc. ..) - <b>{$adm_object->GetResult('sizesortcach')}</b>
    <span style="margin-left: 6px">
	 <input type="submit" value="&nbsp;Clean&nbsp;" name="rb" id="rb" class="button">
	</span>
   </div>
   <input type="hidden" value="do" name="c1tableclear">
  </form>  
 </div>
 
 <div style="margin-top: 6px">
  <form method="post" name="c2" id="c2" onsubmit="return PrepereToSendItem(this)">
   <div>
    Large cache of data (lines, blocks, etc.) - <b>{$adm_object->GetResult('sizelongcach')}</b>
    <span style="margin-left: 6px">
	 <input type="submit" value="&nbsp;Clean&nbsp;" name="rb" id="rb" class="button">
	</span>
   </div>
   <input type="hidden" value="do" name="c2tableclear">
  </form>  
 </div>
 
 <div style="margin-top: 6px">
  <form method="post" name="c2" id="c2" onsubmit="return PrepereToSendItem(this)">
   <div>
    The whole history of performance sites - <b>{$adm_object->GetResult('sizehistory')}</b>
    <span style="margin-left: 6px">
	 <input type="submit" value="&nbsp;Clean&nbsp;" name="rb" id="rb" class="button">
	</span>
   </div>
   <input type="hidden" value="do" name="c3tableclear">
  </form>  
 </div> 
 
 <div style="margin-top: 6px">
  <form method="post" name="c2" id="c2" onsubmit="return PrepereToSendItem(this)">
   <div>
    <div>Clear the specified cache:</div>
    <div style="margin-top: 2px">    
     <select size="1" name="getcach">
	  {foreach from=$adm_object->GetCachSpecialFormatList() key=plname item=val name=val}
       <option value="{$val}"{if $smarty.post.getcach == $val} selected="selected"{/if}>{$val}</option>      
      {/foreach}
     </select>    
     <span style="margin-left: 6px">
	  <input type="submit" value="&nbsp;Clean&nbsp;" name="rb" id="rb" class="button">
	 </span>
    </div> 
   </div>
   <input type="hidden" value="do" name="c4tableclearSpec">
  </form>  
 </div> 
 
 <div style="border-bottom: 1px solid #C0C0C0; padding-bottom: 4px; margin-top: 18px"><b>xml api</b></div>
 <div style="margin-top: 4px">
 {foreach from=$adm_object->GetResult('xmlsettings.apitypes') key=ident item=val name=val}
  <div style="margin-top: 6px">
   <div><strong>{$val.name}</strong></div>
   <div style="margin-top: 10px; margin-left: 7px">
   <span style="width: 100%">
   <table width="100%" cellpadding="0" cellspacing="0" border="0">
   
   {assign var="apiinformationdataall" value=$adm_object->GetApiInformationAll($val.id)}
   
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Status:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 {if $val.enabled && $adm_object->GetResult('xmlsettings.enabled')}
     <label style="color: #008000">active</label>
     {else}
     <label style="color: #FF0000">unavailable</label>
     {/if}     
	</td>
   </tr>
   
   {if $val.descriptionid}
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Description:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 {$CONTROL_OBJ->GetText($val.descriptionid)}     
	</td>
   </tr>
   {/if}
   
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Api type:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 {$ident}     
	</td>
   </tr>   
   
   {if $val.price.count && !$CONTROL_OBJ->CheckPrivateApiUser($val.private)}
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Price for {$val.price.count} requests:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 {if $val.price.value}
      {$val.price.value} USD
     {else}
     <em>(not used)</em>
     {/if}     
	</td>
   </tr>  

   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Requests for free (one night):	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 {if $val.price.freecount}
      {$val.price.freecount}
     {elseif $val.price.value}
      <em>(no)</em>
     {else}
      <em>(unlimited)</em>
     {/if}     
	</td>
   </tr>
   {/if}
   
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Total Requests:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 {$apiinformationdataall.reqcount}     
	</td>
   </tr>
  
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Requests today:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 {$apiinformationdataall.nowcount}     
	</td>
   </tr>      
  
   </table>
   </span>
   </div>
  </div>
 {/foreach}
 </div>
 
</div>