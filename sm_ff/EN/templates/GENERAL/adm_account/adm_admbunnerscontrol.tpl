{* управление баннерами сайта *}

 {literal}
 <style type="text/css">
  .line_item { border-bottom: 1px solid #EBEBEB; height: 22px; }
 </style>
 <script type="text/javascript">
  function DoHigl3(th, n) {	
   if (n) { $(th).css('background','#F9FAFB'); } else {   	
    $(th).css('background', 'none');		
   }	
  }//DoHigl	
  function DoHigl4(th, n) {	
   if (n) { $(th).css('background','#DDE0E7'); } else {   	
    $(th).css('background', 'none');		
   }	
  }//DoHigl
 </script>
 {/literal}

{if $smarty.get.group}
 {* управление баннерами *}

 <div style="margin: 7px 1px 12px 1px">
 <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?group={$smarty.get.group}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}{if $smarty.get.grouppage}&grouppage={$smarty.get.grouppage}{/if}&shorttype={$smarty.get.shorttype}">All place banners (<label style="color: #000000">{$adm_object->GetResult('bcount')}</label>)</a> 
 
 <label style="padding-left: 10px"><a href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/{if $smarty.get.grouppage}?page={$smarty.get.grouppage}{/if}"> << Return to places (<label style="color: #000000">{$adm_object->GetResult('gcount')}</label>)</a></label>
 
 <label style="padding-left: 10px">
  Statuses: <a title="All statuses" href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?group={$smarty.get.group}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}{if $smarty.get.grouppage}&grouppage={$smarty.get.grouppage}{/if}{if $smarty.get.onlyuser}&onlyuser={$smarty.get.onlyuser}{/if}">Все</a>, 
  <a title="Active banners" href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?group={$smarty.get.group}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}{if $smarty.get.grouppage}&grouppage={$smarty.get.grouppage}{/if}&shorttype=1{if $smarty.get.onlyuser}&onlyuser={$smarty.get.onlyuser}{/if}" style="background: #D5F0DF;">OK</a>,
  <a title="Awaiting test administrator" href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?group={$smarty.get.group}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}{if $smarty.get.grouppage}&grouppage={$smarty.get.grouppage}{/if}&shorttype=2{if $smarty.get.onlyuser}&onlyuser={$smarty.get.onlyuser}{/if}" style="background: #F7DCDC;">CHECK</a>, 
  <a title="Awaiting payment" href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?group={$smarty.get.group}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}{if $smarty.get.grouppage}&grouppage={$smarty.get.grouppage}{/if}&shorttype=3{if $smarty.get.onlyuser}&onlyuser={$smarty.get.onlyuser}{/if}" style="background: #E8E5C2;">WAIT</a>,  
 </label>
   
 </div>
  
{* список баннеров *}
  
{literal}
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = {/literal}{if !$adm_object->GetResult('bcount')}0{else}1{/if};{literal}  
 function DoHigl(th, n, p) {	
  if (n) {	$(th).css('background','#F8F5F1'); } else {
   var ch = document.getElementById('chid'+p);
   var color = (ch && ch.checked) ? '#E7DDD1' : 'none';   	
   $(th).css('background', color);		
  }	
 }//DoHigl
 function CheckItem(itemid, th) {
  th = (th) ? th : document.getElementById('chid'+itemid);   
  if (th && th.checked) { $('#t_r_'+itemid).css('background','#E7DDD1'); } else {
  $('#t_r_'+itemid).css('background','none');
  }
  SetEnabled();   	
 }//CheckItem
 function CheckAll(th) {	
  for (var i=0; i < list_items.length; i++) {
   var ch = $('#chid'+list_items[i]);
   ch.attr('checked', (th.checked) ? 'checked' : '');
   if (th.checked) { $('#t_r_'+list_items[i]).css('background','#E7DDD1'); } else {
   $('#t_r_'+list_items[i]).css('background','none');	
  }	  	    	
  }
  SetEnabled();	
 }//CheckAll
 function GetSelCount() {
  var inccount = 0;
  for (var i=0; i < list_items.length; i++) {
   var ch = document.getElementById('chid'+list_items[i]);
   if (ch && ch.checked) { inccount++; }		
  }	
  return inccount;	
 }//GetSelCount 
 function PrepereSend(th) {
  var count = GetSelCount();
  if (count <= 0 && th.actionlistmakes.value != 'all' && th.actionlistmakes.value != 'dall') { 
   alert('Select at least one banner!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == 'delete') {
   if (!confirm('Are you sure you want to delete ['+count+'] banners?')) { return false; }
  } else 
  if (th.actionlistmakes.value == 'enabled') {
   if (!confirm('Do you really want to confirm ['+count+'] banners?')) { return false; }
  } else
  if (th.actionlistmakes.value == 'disabled') {
   if (!confirm('Are you sure you want to cancel confirmation ['+count+'] banners?')) { return false; }
  } else  
  if (th.actionlistmakes.value == 'dall') {
   if (!allsaveenabled) { alert('No data to remove!'); return false; }	
   if (!confirm('Are you sure you want to remove all banners?')) { return false; }	
  }
  else { alert('Unknown ID operation!'); return false; }
  return true;   	
 }//PrepereSend
 function SetEnabled() {  	
  var count = GetSelCount();
  setElementOpacity(document.getElementById('adid'), (allsaveenabled) ? 1 : 0.3);
  if (count <= 0) {
   setElementOpacity(document.getElementById('did'), 0.3);
   setElementOpacity(document.getElementById('ena'), 0.3);
   setElementOpacity(document.getElementById('dna'), 0.3);
   return ;	 
  }
  setElementOpacity(document.getElementById('did'), 1);
  setElementOpacity(document.getElementById('ena'), 1);
  setElementOpacity(document.getElementById('dna'), 1);
 }//SetEnabled
 function SetActionP(a) {
  var f = document.getElementById('vnewsform');
  if (!f) { return ; }
  f.actionlistmakes.value = a;   	
 }//SetActionP   	
 function SetCheckByLine(ident) {
  var ch = $('#chid'+ident);
  ch.attr('checked', (ch.attr('checked')) ? false : true);
  CheckItem(ident);   	
 }//SetCheckByLine
</script>
 <style type="text/css">
  .h_th1, .h_td, .h_td2 { 
   border: 1px solid #E4D9CB; background: #EEE7DF; height: 25px; border-bottom: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E4D9CB; border-left: none; }
  .btn_n { border: 1px solid #E4D9CB; border-top: none; height: 25px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E4D9CB; height: 25px; border-top: none; }	
 </style>
{/literal}  
  
<form method="post" name="vnewsform" id="vnewsform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Delete&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Delete all banners&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 200px;">
 </span>
 
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Confirm&nbsp;" class="activatelistit" name="ena" id="ena" onclick="SetActionP('enabled')" style="//width: 80px;">
 </span>

 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Cancel confirm&nbsp;" class="deactivatelistit" name="dna" id="dna" onclick="SetActionP('disabled')" style="//width: 100px;">
 </span>
  
 </div>
 <div style="margin-top: 6px">
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <td class="h_th1" valign="center" align="left" width="20px">
	 <span style="margin-left: 4px">
	  <input type="checkbox" name="checkallitems" id="checkallitems" style="cursor: pointer" onclick="CheckAll(this)">
	 </span>
	</td>
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Banner</span></td>
	<td class="h_td2" valign="center" align="center" width="130px">Date</td>
   </tr>	
   {literal}
   <style type="text/css">
	.llw { display: inline-block; margin-left: 8px; vertical-align: baseline; padding-left: 20px; }
   </style>
   {/literal}
   {if $adm_object->GetResult('data.source') && $adm_object->GetResult('group')}
	{foreach from=$adm_object->GetResult('data.source') item=val name=val}
	 <tr onmouseover="DoHigl(this, 1, {$smarty.foreach.val.index})" onmouseout="DoHigl(this, 0, {$smarty.foreach.val.index})" id="t_r_{$smarty.foreach.val.index}">
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8; background: {if !$val.activeobj}#F7DCDC{elseif !$val.ispayed}#E8E5C2{else}#D5F0DF{/if}">
	  <span style="margin-left: 4px">
	   <input type="checkbox" name="chid{$smarty.foreach.val.index}" id="chid{$smarty.foreach.val.index}" 
	   style="cursor: pointer" onclick="CheckItem('{$smarty.foreach.val.index}', this)">
	  </span>
	 </td>
	 	 
	 
	 <td class="sth1" valign="center" align="left" onclick="SetCheckByLine('{$smarty.foreach.val.index}')" style="padding: 3px">
	  
     <div style="padding-right: 3px">
       {* banner image *}
       {if $val.isflashobj}      
       <div id="flsource{$val.iditem}">    
        <object  classid="clsid27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="{$val.widthobj}{if $val.groupinfo.widthpersent}%{/if}" height="{$val.heightobj}{if $val.groupinfo.heightpersent}%{/if}" id="refbunner{$val.iditem}" align="middle">
         <param name="allowScriptAccess" value="always" />
         <param name="allowFullScreen" value="false" />
         <param name="movie" value="{$val.webimagefile}" />
         <param name="quality" value="high" />
         <embed src="{$val.webimagefile}" quality="high" bgcolor="#ffffff" width="100%" height="{$val.heightobj}{if $val.groupinfo.heightpersent}%{/if}" name="refbunner{$val.iditem}" id="refbunner{$val.iditem}" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer"/>
        </object>
       </div>
       {else}     
       <img src="{$val.webimagefile}" border="0" alt="Banner" width="{$val.widthobj}{if $val.groupinfo.widthpersent}%{/if}" height="{$val.heightobj}{if $val.groupinfo.heightpersent}%{/if}" />       	  
       {/if}       
      </div>
      
      <div style="margin-top: 4px">
      <span style="width: 100%">            
       <table width="100%" cellpadding="0" cellspacing="0" border="0">	        

         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Link	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       <a href="{$val.hrefdata}" target="_blank">{$val.hrefdata}</a>
	      </td>
	     </tr>
         
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Author	           
          </td>
	      <td valign="center" align="left" class="line_item">
	      <a target="_blank" href="{$smarty.const.W_SITEPATH}account/admuserslisten/&filter1=9&lcstr={$val.username}">{$val.username}</a>{if $smarty.get.onlyuser != $val.userid}, <a href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?group={$val.groupid}&onlyuser={$val.userid}&shorttype={$smarty.get.shorttype}" style="font-size: 95%; margin-left: 4px">all user banners</a>{/if}
	      </td>
	     </tr>
                     
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Hits	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       total: {$val.lookcount}, today: {$val.looktoday}
	      </td>
	     </tr>
         {* 
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Clicks by banner	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       total: {$val.visitcount}, today: {$val.visittoday}
	      </td>
	     </tr>
         
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           CTR	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       {$adm_object->GetCTR($val)}
	      </td>
	     </tr>
         *}
         {if $val.setbytype == 1}
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Shows days	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       {$val.lookdcount}
	      </td>
	     </tr>  
         
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Days remaining	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       <label id="totalcount{$val.iditem}">{math equation="x - y" x=$val.fordays y=$val.lookdcount}</label>       
	      </td>
	     </tr>   
                      
         {elseif $val.setbytype == 0}
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Remaining impressions	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       <label id="totalcount{$val.iditem}">{math equation="x - y" x=$val.forlooks y=$val.lookcount}</label>            
	      </td>
	     </tr>                
         {/if}
         
         {if $val.sizeobj}
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Banner file size	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       {$CONTROL_OBJ->GetStrSizeFromBytes($val.sizeobj)}
	      </td>
	     </tr>         
         {/if}         
         
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" {if !$val.groupinfo.clearonoffbun || !$val.forpayislast}height="22px"{else}class="line_item"{/if}>
           Status	           
          </td>
	      <td valign="center" align="left" {if !$val.groupinfo.clearonoffbun || !$val.forpayislast}height="22px"{else}class="line_item"{/if}>
	       {if !$val.activeobj}
           <em style="color: #993300">Awaiting review by the administrator</em>
           {elseif !$val.ispayed}
           <em style="color: #333399">Awaiting payment</em>
           {else}
           <em style="color: #0000FF">Paid for banner showing active</em>
           {/if}
	      </td>
	     </tr>
         
         {if $val.groupinfo.clearonoffbun && $val.forpayislast}
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" height="22px">
           Period for payment	           
          </td>
	      <td valign="center" align="left" height="22px">
	       {$val.forpayislast}
	      </td>
	     </tr>        
         {/if}

	   </table>                  
      </span>
      </div>  
      	  	 
	 </td> 
	 
	 <td class="sth1" valign="center" align="center" width="130px" style="border-right: 1px solid #E3E4E8;" 
	 onclick="SetCheckByLine('{$smarty.foreach.val.index}')">
	 {$val.datecreate}
	 </td>
	 
    </tr>  
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.iditem}" name="idm{$smarty.foreach.val.index}">
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="3">
     At this place no banners!
     <script type="text/javascript">
	  document.getElementById('checkallitems').disabled = true;
     </script>
    </td>
   </tr> 
   {/if} 
 </table>
 {if $adm_object->GetResult('data.source')}
 <div style="text-align: right; margin-top: 10px">{$adm_object->GetResult('data.pagestext')}</div>
 {/if} 
 </span>
 </div> 
 <input type="hidden" value="0" name="actioncountmess">
 <input type="hidden" value="none" name="actionlistmakes"> 
</form>
<script type="text/javascript">SetEnabled();</script>   
 
{else}
 {* управление группами (местами) баннеров *}
 <div style="margin: 7px 1px 12px 1px">
 <a href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?new=1{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}"{if $smarty.get.new && !$adm_object->GetResult('modifyinfo')} style="color: #000000"{/if}>Add Place</a> | <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/{if $smarty.get.oldpage}?page={$smarty.get.oldpage}{/if}">All banner places (<label style="color: #000000">{$adm_object->GetResult('gcount')}</label>)</a>   
 </div>
 
 {if !$smarty.get.new}
  {* управление списком разделов, просмотр, выбор *}
  
  {if !$adm_object->GetResult('data.source')}
   <div style="text-align: center; padding: 6px; margin-top: 25px"><b>No Active Places!</b></div>
  {else}
   {literal}
    <script type="text/javascript">
	 function DeleteSelectedElementSection(ident) {
	  if (!confirm("Are you sure you want to delete the selected place? All banners are placed at this place will be removed!\r\nContinue?")) {
	   return false;	
	  }	
	  var ppf = {/literal}'{$smarty.const.W_SITEPATH}account/admbunnerscontrol/{if $smarty.get.page}?page={$smarty.get.page}{/if}'{literal};  
	  document.location = ppf + '&qdelete=' + ident;  
	 }
   </script>
   {/literal}
   {foreach from=$adm_object->GetResult('data.source') item=val name=val}
    <div style="margin: 4px; margin-top: 15px; padding: 4px; border: 1px solid #D2D2D2">
	 <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
       <tr>
       
        <td valign="top" align="left" width="50px" style="padding-right: 4px">
		 <img src="{$smarty.const.W_SITEPATH}img/ico/general/places_visited.png" border="0">
		</td>	
		
	    <td valign="top" align="left">
		 <div><a title="View banners of block" href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?group={$val.iditem}{if $smarty.get.page}&grouppage={$smarty.get.page}{/if}"><strong>{$val.groupname}</strong></a><label style="margin-left: 6px; font-size: 95%; color: #333399"><i>(banners: {$adm_object->GetBunnersCount($val.iditem)})</i></label></div>
		 <div style="margin-top: 4px;">
		  
          <div>
          <span style="width: 100%">
           <table width="100%" cellpadding="0" cellspacing="0" border="0">
	        <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              Status	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          {if $val.groupactive}
               <label style="color: #0000FF">Работает</label>
              {else}
               <em>(not work)</em>
              {/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              Banner files	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          {if $val.filesuse}
               <label style="color: #008000">Yes</label>
              {else}
               <em>(no)</em>
              {/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              Banner links	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          {if $val.linksuse}
               <label style="color: #008000">Yes</label>
              {else}
               <em>(no)</em>
              {/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              Flash banners	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          {if $val.useflash}
               <label style="color: #008000">Yes</label>
              {else}
               <em>(no)</em>
              {/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              Moderation banners	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          {if $val.usemoder}
               <label style="color: #008000">Yes</label>
              {else}
               <em>(no)</em>
              {/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              Dimensions	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          Width: {$val.groupwidth}{if $val.widthpersent}%{else}px{/if}, Height: {$val.groupheight}{if $val.heightpersent}%{else}px{/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              For 1000 shows	           
             </td>
	         <td valign="center" align="left" class="line_item">
	           {if $val.pricetolook > 0}
                <label style="color: #008000">{$val.pricetolook} USD</label>
               {else}
                <em>(not use)</em>
               {/if} 
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              For 1 day shows	           
             </td>
	         <td valign="center" align="left" class="line_item">
	           {if $val.pricetodays > 0}
                <label style="color: #008000">{$val.pricetodays} USD</label>
               {else}
                <em>(not use)</em>
               {/if} 
	         </td>
	        </tr>

	       </table>       
          </span>         
          </div>
          <div style="margin-top: 10px">
          <div style="color: #646464">To display banners, use code:</div>
          <textarea style="width: 95%; height: 100px; background: transparent; border: 1px solid transparent" readonly="readonly">If you want to bring in the right place at the template site banners, use design:

{literal}{$CONTROL_OBJ->GetBannerPlaceByID({/literal}{$val.iditem}{literal})}{/literal}

----------------------
In order to check - is there a banner appear or no, use the type design:

{literal}{assign var="bannerplacetemplate" value=$CONTROL_OBJ->GetBannerPlaceByID({/literal}{$val.iditem}{literal})}
{if $bannerplacetemplate}
 {* показываем место баннеров *}
 {$bannerplacetemplate}
{else}
 {* в данной группе no баннеров, или группы не существует - место не будет отображаться..
    вместо места баннеров можно вывести например предложение добавить баннер и т.д
 *}
{/if}{/literal}</textarea>
          
          
          </div>
                   
		 </div>
		</td>
		
	    <td valign="top" align="right">
		 <div style="white-space: nowrap;">		 
		 
		 <a href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?modify={$val.iditem}&new=1{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}" title="Modify"><img src="{$smarty.const.W_SITEPATH}img/items/document_edit.png" width="16" height="16"></a>
		 
		 <a style="margin-left: 6px" href="javascript:" onclick="DeleteSelectedElementSection('{$val.iditem}')" title="Delete"><img src="{$smarty.const.W_SITEPATH}img/items/erase.png" width="16" height="16"></a>
		 
		 </div>
		</td>
       </tr>
      </table>
	 </span>
	</div>
   {/foreach} 
  {if $adm_object->GetResult('data.source')}
   <div style="text-align: right; margin-top: 10px">{$adm_object->GetResult('data.pagestext')}</div>
  {/if}    
  {/if} 
 
 {else}
  {* добавление/изменение раздела *}
  
{literal}
 <script type="text/javascript">         
    function PrepereSend(th) {
	 
	 if (!th.groupname.value) {
	  alert('Specify name of place!');
	  th.groupname.focus();
	  return false;	
	 }
	 			 	 	 
	 $('#globalbodydata').css('cursor', 'wait');
     $('input[id="rb"]').attr('disabled', 'disabled');
     $('input[id="rbp"]').attr('disabled', 'disabled');
	 return true; 	
	}//PrepereSent
	
	function PrepereSend4(th) {
	 $('#globalbodydata').css('cursor', 'wait');
     $('input[id="rb"]').attr('disabled', 'disabled');
     $('input[id="rbp"]').attr('disabled', 'disabled');
	 return true;	
	}//PrepereSend4
	
	function SetActionIdent(n) {	
     document.getElementById('addgroupitem').actionnewprvmail.value = (n) ? 'act' : 'prev';	
    }//SetActionIdent	
 </script>
 {/literal}
 
 
 <form method="post" name="addgroupitem" id="addgroupitem" onsubmit="return PrepereSend(this)">
   
   {if $adm_object->GetResult('modifyinfo')}
   <div style="margin-top: 15px; margin-bottom: 15px; background: #F0F0F0; padding: 3px"><b>Setting up the place banners</b></div>   
   {else}
   <div class="typelabel" style="margin-top: 12px; margin-bottom: 12px; background: #F0F0F0; padding: 3px">
    <b>General parameters space</b>
   </div>   
   {/if}   
    
   <div class="typelabel"><label id="red">*</label> Place name (up to 150 characters)<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (displays for visitors, identifies name of place where the banners will be displayed, for example: `In the site header`)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 94%" name="groupname" id="groupname" maxlength="120" value="{$adm_object->GetAsElementP('groupname')}">
   </div>
     
   {if $smarty.post.actionnewprvmail == 'prev'}
   <div style="padding: 4px; border: 1px solid #666699; margin-bottom: 20px; margin-top: 10px; width: 94%;">
   {$CONTROL_OBJ->strings->CorrectTextFromDB($CONTROL_OBJ->strings->CorrectTextToDB($smarty.post.groupdescr))}  
   </div>
   {/if} 
   
   <div class="typelabel">Description of space<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (displayed to the public, determines a description of the place where the banners will be displayed. It is also desirable to provide screenshots of how the banner will look like, where is located this place.)
   </div>
   </div>
   <div class="typelabel">
    {include file='new_message.tpl' ident='groupdescr' source=$smarty.post.groupdescr height='90px' width='95%'}
   </div>
   
   <div class="typelabel" style="margin-top: 15px">
    <input type="submit" value="&nbsp;Preview description&nbsp;" class="button" name="rbp" id="rbp" onclick="SetActionIdent(0)">
   </div>
   
   <div class="typelabel" style="margin-top: 12px; margin-bottom: 12px; background: #F0F0F0; padding: 3px">
    <b>Place Settings</b>
   </div>
   
   
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('filesuse') || $smarty.post.actionthissectnnews != 'do'} checked="checked" {/if}style="cursor: pointer" name="filesuse" id="filesuse"><label for="filesuse" style="cursor: pointer">&nbsp;Allow downloading of banners on the site server</label>  
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('linksuse') || $smarty.post.actionthissectnnews != 'do'} checked="checked" {/if}style="cursor: pointer" name="linksuse" id="linksuse"><label for="linksuse" style="cursor: pointer">&nbsp;Allow a link to a banner placed on an external site</label>  
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('useflash') || $smarty.post.actionthissectnnews != 'do'} checked="checked" {/if}style="cursor: pointer" name="useflash" id="useflash"><label for="useflash" style="cursor: pointer">&nbsp;Allow the use flash banners</label>  
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('usemoder') || $smarty.post.actionthissectnnews != 'do'} checked="checked" {/if}style="cursor: pointer" name="usemoder" id="usemoder"><label for="usemoder" style="cursor: pointer">&nbsp;Send banners to check the administrator before they are published</label><br />
    <div style="font-size: 95%; color: #7E7E7E">
    (if administrator confirms permission for the banner - you can pay for banner display, banner and then become active in the specified place)
    </div>  
   </div>
   
   <div class="typelabel">Maximum file size banner to upload (in Kb)<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (specifies maximum file size banner, if enabled download banners on the site)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="maxfilesize" id="maxfilesize" maxlength="6" value="{$adm_object->GetAsElementP('maxfilesize', 'actionthissectnnews', 'do', '170')}">
   </div>
   
   <div class="typelabel">Place width<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (determines width of block where banners will be displayed. All banners will be no bigger than the size of place)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="groupwidth" id="groupwidth" maxlength="3" value="{$adm_object->GetAsElementP('groupwidth', 'actionthissectnnews', 'do', '250')}">
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('widthpersent')} checked="checked" {/if}style="cursor: pointer" name="widthpersent" id="widthpersent"><label for="widthpersent" style="cursor: pointer">&nbsp;The width is specified as a percentage (off - in px)</label>  
   </div>
   
   <div class="typelabel">Place height<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (determines height of block where banners will be displayed. All banners will be no bigger than size of place)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="groupheight" id="groupheight" maxlength="3" value="{$adm_object->GetAsElementP('groupheight', 'actionthissectnnews', 'do', '250')}">
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('heightpersent')} checked="checked" {/if}style="cursor: pointer" name="heightpersent" id="heightpersent"><label for="heightpersent" style="cursor: pointer">&nbsp;The height is specified as a percentage (off - in px)</label>  
   </div>
   
   <div class="typelabel">Maximum number of banners in place<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (specifies the maximum number of banners that can be put into place. If the count exceeds the specified value of banners - add a new banner will be impossible as long as the number of banners of the site is reduced. If you specify 0 - no limit.)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="maxbunners" id="maxbunners" maxlength="5" value="{$adm_object->GetAsElementP('maxbunners', 'actionthissectnnews', 'do', '0')}">
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('clearonoffbun') || $smarty.post.actionthissectnnews != 'do'} checked="checked" {/if}style="cursor: pointer" name="clearonoffbun" id="clearonoffbun"><label for="clearonoffbun" style="cursor: pointer">&nbsp;Remove the banner, if conditions of his show ended</label><br />
    <div style="font-size: 95%; color: #7E7E7E">
   (If this option is turned off - no banners will be removed and the user can at any time extend the display of the banner in his office, if included - as a condition of the show will be completed the next day - the banner will be removed and the user is sent an appropriate message. Banners, whose conditions show completed - are participating in the show is not no matter - this option is specified or no.)
   </div>  
   </div>
   
   <div class="typelabel">Price for 1000 banner impressions (in USD, size: 0.00)<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (determines price for every 1000 impressions, if user chooses type of show - `For a specified number of hits`. If the price point of 0.00 - the possibility of placing a banner for the number of hits is unavailable)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="pricetolook" id="pricetolook" maxlength="12" value="{$adm_object->GetAsElementP('pricetolook', 'actionthissectnnews', 'do', '0.00')}">
   </div>
   
   <div class="typelabel">Price for 1 day banner impressions (in USD, size: 0.00)<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (determines the price for one day banner impressions if the user chooses the type of show - `During this period of time`. If the price point of 0.00 - the possibility of placing a banner at the specified time will not be available)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="pricetodays" id="pricetodays" maxlength="12" value="{$adm_object->GetAsElementP('pricetodays', 'actionthissectnnews', 'do', '0.00')}">
   </div>   
   
   
   <div class="typelabel" style="margin-top: 12px; margin-bottom: 12px; background: #F0F0F0; padding: 3px">
    <b>Run</b>
   </div>
   <div style="font-size: 95%; color: #7E7E7E; position: relative; top: -7px">
   (<strong style="color: #0000FF">before turning on the active site, make sure you put the output code in the template project!!</strong>)
   </div>
   
   <div class="typelabel">
    <input type="checkbox"{if !$adm_object->GetResult('modifyinfo')} disabled="disabled"{/if} {if $CONTROL_OBJ->CheckPostValue('groupactive')} checked="checked" {/if}style="cursor: pointer; position: relative; top: -7px" name="groupactive" id="groupactive"><label for="groupactive" style="cursor: pointer; position: relative; top: -7px">&nbsp;Activate place</label> 
   </div>
   
   <div class="typelabel" style="margin-top: 15px">
    <input type="hidden" value="do" name="actionthissectnnews">
   </div> 
   <input type="submit" value="&nbsp;{if !$adm_object->GetResult('modifyinfo')}Add place{else}Change space parameters{/if}&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp; 
   <input type="hidden" value="prev" name="actionnewprvmail">
   <input type="hidden" value="ok" name="actionnewsectionnews">
  </form>  
  
  {if $smarty.post.actionthissectnnews == 'do' && !$smarty.post.actionthissectionpost_q && $smarty.post.actionnewprvmail != 'prev'}
 <div style="margin-top: 10px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">{if !$adm_object->GetResult('modifyinfo')}Place added successfully!{else}The parameters were changed places!{/if}</label>
  {/if}
 </div>
 {/if}  

 {/if} 
{/if}
