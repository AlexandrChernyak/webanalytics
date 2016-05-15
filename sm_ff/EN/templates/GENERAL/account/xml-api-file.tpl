{* xml api проекта *}
 {if !$CONTROL_OBJ->IsOnline()}error{else}
 <div class="head_title" style="margin-top: 15px; background: #F8F8F8; padding: 2px"><strong>General information</strong></div>
 <div style="margin-top: 10px; margin-left: 7px">
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
 <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Your api code:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 <input type="text" value="{$CONTROL_OBJ->GetHashCodeByActiveUser()}" maxlength="50" readonly="readonly" style="border: none; color: #0000FF" name="codeh" onclick="this.select()" />
     
	</td>
 </tr> 
 </table>
 </span>
 </div>
 
 <div>
 <form method="post" name="saveenabledapi">
  <div style="margin-top: 10px; margin-left: 8px">
   <div><input type="checkbox"{if $CONTROL_OBJ->ReadOption('USEXMLAPI')} checked="checked"{/if} style="cursor: pointer" name="apienabled" id="apienabled" /><label style="cursor: pointer" for="apienabled"> Allow to use api for an account</label></div> 
  <div style="margin-top: 8px">
   <input type="submit" value="&nbsp;Save&nbsp;" class="button" name="rb" id="rb" onclick="DoDeleteAvatar(0)">
  </div>
  <input type="hidden" value="do" name="actionsaveapien" />
  </div>
 </form>
 </div>
 
 <div style="margin-top: 16px">
 {foreach from=$_API_CONFIGURATION_PACK.apitypes key=apitype item=val name=val} 
 {if $val.visible} 
  <div class="head_title" style="margin-top: 15px; background: #F8F8F8; padding: 2px"><strong>{$val.name}</strong></div>
  <div style="margin-top: 10px; margin-left: 7px">
  <span style="width: 100%">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
  
  {assign var="apiinformationdata" value=$CONTROL_OBJ->GetApiInformationBlock($val.id, $CONTROL_OBJ->userdata.iduser, false, $val)}
  
  <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Status:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 {if $val.enabled && $_API_CONFIGURATION_PACK.enabled}
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
	 {$apitype}     
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
  
  <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Left requests:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">   
     {if !$apiinformationdata}
      {if $val.price.freecount}
       {$val.price.freecount}
      {elseif $val.price.value}
       0
      {else}
       <em>(unlimited)</em>
      {/if}      
     {else}
      {if !$val.price.value && !$val.price.freecount}
       <em>(unlimited)</em>
      {else}
       {$apiinformationdata.usecount}
      {/if} 
     {/if}   
	</td>
  </tr>
  {/if}
  
  <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Total requests:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 {if !$apiinformationdata}0{else}{$apiinformationdata.reqcount}{/if}     
	</td>
  </tr>
  
  <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Requests today:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 {if !$apiinformationdata}0{else}{$apiinformationdata.nowcount}{/if}     
	</td>
  </tr>  
  
  <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Last request:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 {if !$apiinformationdata}<em>(неизвестно)</em>{else}{$apiinformationdata.nowdater}{/if}     
	</td>
  </tr>
  
  </table>
  </span>
  </div>
 {/if}   
 {/foreach}
 </div>

{/if}