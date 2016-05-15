{* раздел пользователей *}
<div style="margin-top: 4px">

<div>
<span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0">
<tr>
  <td valign="top" align="left">
   <div class="typelabel">Display Filter</div>
   <div class="typelabel">
    <select size="1" name="filter1w" id="filter1w" style="width: 250px" onchange="NavigateActionEx(this)">
	 <option value="0"{if !$smarty.get.filter1} selected="selected"{/if}>All Users</option>
	 <option value="1"{if $smarty.get.filter1 == '1'} selected="selected"{/if}>Only active</option>
	 <option value="2"{if $smarty.get.filter1 == '2'} selected="selected"{/if}>Only blocked</option>
	 <option value="3"{if $smarty.get.filter1 == '3'} selected="selected"{/if}>Just waiting for a confirmation e-mail</option>
	 <option value="4"{if $smarty.get.filter1 == '4'} selected="selected"{/if}>Blocked and pending Accept e-mail</option>
	 <option value="5"{if $smarty.get.filter1 == '5'} selected="selected"{/if}>With negative balance</option>
	 <option value="6"{if $smarty.get.filter1 == '6'} selected="selected"{/if}>With positive balance</option>
     
     <option value="7"{if $smarty.get.filter1 == '7'} selected="selected"{/if} style="color: #333399">Username contains string</option>
     <option value="8"{if $smarty.get.filter1 == '8'} selected="selected"{/if} style="color: #333399">E-mail contains string</option>
     <option value="9"{if $smarty.get.filter1 == '9'} selected="selected"{/if} style="color: #333399">The exact occurrence login</option>
     
    </select>
   </div> 
   
   <div id="locatefield"{if $smarty.get.filter1 != 7 && $smarty.get.filter1 != 8 && $smarty.get.filter1 != 9} style="visibility: hidden; display: none"{/if}>
    <div class="typelabel">Contains string (`Enter` - apply)</div>
    <input type="text" class="inpt" style="width: 250px" name="lcstr" id="lcstr" value="{$smarty.get.lcstr}" maxlength="250"> 
   </div>
   
   {literal}
    <script type="text/javascript">
	 $('#lcstr').keydown(function(e) {
      if (e.keyCode == 13 && $('#lcstr').val() != '') {     
        NavigateActionEx(document.getElementById('filter1w'));        
      }
     });
    </script>
   {/literal}
        
  </td>
  <td valign="top" align="right">
   <div class="typelabel">Sort Filter</div>
   <div class="typelabel">
    <select size="1" name="filter2" id="filter2" style="width: 200px" onchange="NavigateActionEx(this)">
	 <option value="0"{if !$smarty.get.filter2} selected="selected"{/if}>By username (ascending)</option>
	 <option value="1"{if $smarty.get.filter2 == '1'} selected="selected"{/if}>By username (descending)</option>
	 <option value="" disabled="disabled">--------</option>
	 <option value="2"{if $smarty.get.filter2 == '2'} selected="selected"{/if}>By e-mail (ascending)</option>
	 <option value="3"{if $smarty.get.filter2 == '3'} selected="selected"{/if}>By e-mail (descending)</option>
	 <option value="" disabled="disabled">--------</option>
	 <option value="4"{if $smarty.get.filter2 == '4'} selected="selected"{/if}>By Join Date (ascending)</option>
	 <option value="5"{if $smarty.get.filter2 == '5'} selected="selected"{/if}>By Join Date (descending)</option>
	 <option value="" disabled="disabled">--------</option>
	 <option value="6"{if $smarty.get.filter2 == '6'} selected="selected"{/if}>By Date of activity (ascending)</option>
	 <option value="7"{if $smarty.get.filter2 == '7'} selected="selected"{/if}>By Date of activity (descending)</option>
	 <option value="" disabled="disabled">--------</option>
	 <option value="8"{if $smarty.get.filter2 == '8'} selected="selected"{/if}>By balance (ascending)</option>
	 <option value="9"{if $smarty.get.filter2 == '9'} selected="selected"{/if}>By balance (descending)</option>
    </select>
   </div>   
  </td>
</tr>
</table>
</span>
</div>



<div style="margin-top: 4px; border-bottom: 1px solid #969696">&nbsp;</div>

{literal}
<script type="text/javascript">
 var globalsectionpath = {/literal}'{$smarty.const.W_SITEPATH}';{literal}
 var globalpage = {/literal}'{$smarty.get.page}';{literal}
 var globaloldpage = {/literal}'{$smarty.get.oldpage}';{literal}
 var globaladmpath = globalsectionpath + 'account/admuserslisten/';
 
 function NavigateActionEx(th) {	
  if (th.value == '') { return ; }	
  var path = globaladmpath;
  path = path + (($('#filter1w').val()) ? '&filter1='+$('#filter1w').val() : '');
  path = path + (($('#filter2').val()) ? '&filter2='+$('#filter2').val() : '');
  path = path + (($('#lcstr').val()) ? '&lcstr='+ encodeURIComponent($('#lcstr').val()) : '');
  path = path + (($('#perpage').val()) ? '&perpage='+ encodeURIComponent($('#perpage').val()) : '');
  document.location = path;	
 }//NavigateAction
  
</script>
{/literal}

<div style="margin-top: 5px">
 <span style="width: 100%">
  <table width="100%" cellpadding="0" cellspacing="0">
   <tr>
	<td valign="top" align="left">
    
      <a href="{$smarty.const.W_SITEPATH}account/admuserslisten&new=1{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}{if $smarty.get.filter1}&filter1={$smarty.get.filter1}{/if}{if $smarty.get.filter2}&filter2={$smarty.get.filter2}{/if}{if $smarty.get.perpage}&perpage={$smarty.get.perpage}{/if}"{if $smarty.get.new} style="color: #000000"{/if}>Add New User</a> | <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admuserslisten/{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}{if $smarty.get.filter1}&filter1={$smarty.get.filter1}{/if}{if $smarty.get.filter2}&filter2={$smarty.get.filter2}{/if}{if $smarty.get.perpage}&perpage={$smarty.get.perpage}{/if}">Users List (<label style="color: #000000">{$adm_object->GetResult('count')}{if $adm_object->GetResult('count_all') != ''} \ <label style="color: #333399">{$adm_object->GetResult('count_all')}</label>{/if}</label>)</a>
    
    </td>
	<td valign="top" align="right" style="padding-right: 2px; white-space: nowrap;">
     
      <script type="text/javascript" src="{$smarty.const.W_SITEPATH}css/panel/menuelements.js"></script>
      
      {literal}
      <script type="text/javascript">
	    jQuery(document).ready(function() {	      
          $('#moreunitblock').domenuitems(); 
          var wtitle = $('#titleoptname').width();
          var wbodyq = $('#bodyoptname');
   
          wtitle = 0 - (wbodyq.width() - wtitle - 20);   
          wbodyq.css('left', wtitle);
          
          $('#perpage').keydown(function(e) {
           if (e.keyCode == 13 && $('#perpage').val() != '' && IisInteger($('#perpage').val(), false)) {     
            NavigateActionEx(document.getElementById('filter1w'));        
           }
          });
          
          //activate          
          $('#emailverifyyes').click(function () { ActivateDeactivateEmailUser(1); });
          $('#emailverifyno').click(function () { ActivateDeactivateEmailUser(0); });
                            
        }); 
          
        function ActivateDeactivateEmailUser(active) {  
         if (GetSelCount() <= 0) { return false; }
          
         $('#moreunitblock').domenuitems({}, 'hide');          
         SetActionP('emailactive'+active);
         $('#commentsform').submit();
         return true;          
             
        }//ActivateDeactivateEmailUser  
        
        function AddToGroup(gid) {
          if (GetSelCount() <= 0) { return false; }
          SetActionP('settogroup');
          $('#groupaddparam').val(gid);
          $('#commentsform').submit();            
        }//AddToGroup      
      </script>
      <style type="text/css">
        .blockmenuitemshead .blockitemsbody a.addusertogroup{ 
          background: url({/literal}{$smarty.const.W_SITEPATH}{literal}img/items/emblem_symbolic_link.png) transparent no-repeat top left; padding-left: 15px; 
        }
      </style>      
      {/literal}
      
	  <span class="blockmenuitemshead" id="moreunitblock" style="text-align: left">
       <ul>
      <li class="menuclickitem" id="titleoptname">Additionally</li>   
        <li class="blockitemsbody" id="bodyoptname" style="//min-width: 185px">	
        
		 <div class="divseparator"><span>Confirming e-mail..</span></div>
	     <div class="divblocked"><a id="emailverifyyes" href="javascript:">Confirm e-mail</a></div>
         <div class="divblocked"><a id="emailverifyno" href="javascript:">Set 'to be confirmed'</a></div> 
          
	     <div class="divseparator"><span>Special..</span></div>
	     <div class="divblocked">         
          <div>Users per page (Enter - apply)</div>
          <div class="typelabel">
            <input type="text" class="inpt" style="width: 200px" name="perpage" id="perpage" maxlength="3" value="{$smarty.get.perpage}">                    
          </div>          
         </div>
         
         
         <div class="divseparator"><span>Add to Group..</span></div>
         {assign var="usersgroups" value=$CONTROL_OBJ->GetAvaileableUserGroups()}
         
         {if !$usersgroups}
          <div class="divblocked">No Groups!</div>
         {else}
           {foreach from=$usersgroups item=val name=val}
            <div class="divblocked">
             
            <a id="groupadditem" href="javascript:" class="addusertogroup" onclick="AddToGroup('{$val.iditem}')">{$val.groupname}</a>      
            
            </div>
           {/foreach} 
         {/if}
                  
		  
        </li>   
       </ul>
      </span>     
    
    </td>
   </tr>
  </table>
 </span>
</div>

<div style="margin-top: 12px">
{if !$smarty.get.new}
{* список пользователей *}
{literal}
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = {/literal}{if !$adm_object->GetResult('count')}0{else}1{/if};{literal}  
 function DoHigl(th, n, p) {	
  if (n) {	$(th).css('background','#F9FAFB'); } else {
   var ch = document.getElementById('chid'+p);
   var color = (ch && ch.checked) ? '#E1E2E0' : 'none';   	
   $(th).css('background', color);		
  }	
 }//DoHigl
 function CheckItem(itemid, th) {
  th = (th) ? th : document.getElementById('chid'+itemid);   
  if (th && th.checked) { $('#t_r_'+itemid).css('background','#E1E2E0'); } else {
  $('#t_r_'+itemid).css('background','none');
  }
  SetEnabled();   	
 }//CheckItem
 function CheckAll(th) {	
  for (var i=0; i < list_items.length; i++) {
   var ch = $('#chid'+list_items[i]);
   ch.attr('checked', (th.checked) ? 'checked' : '');
   if (th.checked) { $('#t_r_'+list_items[i]).css('background','#E1E2E0'); } else {
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
   alert('Mark at least one user!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == 'delete') {
   if (!confirm('Do you really want to delete ['+count+'] users?')) { return false; }
  } else 
  if (th.actionlistmakes.value == 'enabled') {
   if (!confirm('Do you really want to unlock ['+count+'] users?')) { return false; }
  } else
  if (th.actionlistmakes.value == 'emailactive1') {
   if (!confirm('Do you really want to confirm e-mail ['+count+'] users?')) { return false; }
  } else
  if (th.actionlistmakes.value == 'emailactive0') {
   if (!confirm('Do you really want to reset confirm e-mail ['+count+'] users?')) { return false; }
  } else  
  if (th.actionlistmakes.value == 'settogroup') {
   if (!confirm('Do you really want to add ['+count+'] users in selected Group?')) { return false; }
  } else
  if (th.actionlistmakes.value == 'disabled') {
   if (!confirm('Do you really want to lock ['+count+'] users?')) { return false; }
  } else { alert('Unknow action ID!'); return false; }
  return true;   	
 }//PrepereSend
 function SetEnabled() {  	
  var count = GetSelCount();
  setElementOpacity(document.getElementById('asid'), (allsaveenabled) ? 1 : 0.3);
  if (count <= 0) {
   setElementOpacity(document.getElementById('did'), 0.3);
   setElementOpacity(document.getElementById('ena'), 0.3);
   setElementOpacity(document.getElementById('dna'), 0.3);
   setElementOpacity(document.getElementById('emailverifyyes'), 0.3);
   setElementOpacity(document.getElementById('emailverifyno'), 0.3);
   $('body a[id="groupadditem"]').each(function (i) { setElementOpacity(this, 0.3); return true; });
   return ;	 
  }
  setElementOpacity(document.getElementById('did'), 1);
  setElementOpacity(document.getElementById('ena'), 1);
  setElementOpacity(document.getElementById('dna'), 1);
  setElementOpacity(document.getElementById('emailverifyyes'), 1);
  setElementOpacity(document.getElementById('emailverifyno'), 1);
  $('body a[id="groupadditem"]').each(function (i) { setElementOpacity(this, 1); return true; });
 }//SetEnabled
 function SetActionP(a) {
  var f = document.getElementById('commentsform');
  if (!f) { return ; }
  f.actionlistmakes.value = a;   	
 }//SetActionP 
 
 function PrepereRequestData(data) { return eval(data); } 
 function ModifyItemData(usid, datavalue, dataid, queryadd) {
  SendDefaultRequest(globaladmpath, 
   'is_ajax_mode=1&usid='+usid+'&type='+dataid+'&value='+encodeURIComponent(datavalue) + queryadd, 'PrepereRequestData'
  );  	
 }//ModifyItemData
 
 function ModifyEmail(usid, value) {
  var res = prompt("Enter New E-mail!", value);
  if (!res) { return false; }
  if (value == res || !emailCheck(res)) {
   if (!confirm("Invalid E-mail! Do you want to re-enter?")) { return false; }
   return ModifyEmail(usid, value);   	
  }
  $('#email_link'+usid).html('');
  $('#email_'+usid).html('Saving..');
  return ModifyItemData(usid, res, 1, '');  		
 }//ModifyEmail
 
 function ModifyURL(usid, value) {
  var res = prompt("Enter new website address!", value);  
  if (res == null) { return false; }
  if (value == res) {
   if (!confirm("Invalid URL! Do you want to re-enter?")) { return false; }
   return ModifyURL(usid, value);   	
  }
  $('#url_link'+usid).html('');
  $('#url_'+usid).html('Saving..');
  return ModifyItemData(usid, res, 2, '');  
 }//ModifyURL
 
 function ShowDlg(usname, usid) {
  $('#usernameblc').html($('#balance_source'+usid).html());
  ShDescrBlock('checkwithmessages', 'withdescriptandsend');  	
 	
  $("#dialog_balance").dialog({
   title: "User Balance "+usname, 
   width:  450,            
   height: 'auto',         
   modal: true,            
   buttons: {
    "Apply": function() { 
	 //сумма
	 var pricevalue = $('#pricevalue').val();
	 if (!IsFloat(pricevalue) || pricevalue < 0) {
	  alert('Enter the numeric value of the sum (from 0)! (format: 0.00)');
	  $('#pricevalue').focus();
	  return ;	
	 }	 	 	 
	 //уведомлять пользователя
	 var checkwithmessages = document.getElementById('checkwithmessages');
	 checkwithmessages = (checkwithmessages && checkwithmessages.checked) ? '1' : '0';
	 //описание
	 var pricedescr = (checkwithmessages) ? encodeURIComponent($('#pricedescr').val()) : '';
	 if (checkwithmessages && !pricedescr) {
	  alert('Enter a description of the payment for the history of financial transactions, user!');
	  $('#pricedescr').focus();
	  return ;	
	 }	 
	 //тип операции
	 var balanceaction = $('#balanceaction').text();
	 //confirm action
	 var str = '';
	 if (balanceaction == 'add') {
	  str = "Do you really want to `fill up` the balance of user "+usname+" to amount of "+pricevalue+" USD?";	
	 } else 
	 if (balanceaction == 'sub') {
	  str = "Do you really want to `subtract` from the balance User "+usname+" amount of "+pricevalue+" USD?";	
	 } else 
	 if (balanceaction == 'set') {
	  str = "Do you really want to `set` balance of the user "+usname+" to amount of "+pricevalue+" USD?";	
	 } else {
	  alert('Unknow operation!');
	  return ;	
	 }
	 //check summ
	 if (pricevalue == 0 && balanceaction != 'set') {
	  alert('To add/remove from the balance of user, you must specify a positive amount!');
	  $('#pricevalue').focus();
	  return ;		
	 }
	 //check abort	 
	 if (!confirm(str)) { return ; }
	 //action	
	 $('#balance_link'+usid).html('');
     $('#balance_'+usid).html('Saving..');
	 $(this).dialog("close");	 
	 return ModifyItemData(usid, pricevalue, 3, 
	  '&checkwithmessages='+checkwithmessages+'&balanceaction='+balanceaction+'&pricedescr='+pricedescr
	 );	 	
	},
    "Cancel": function() { $(this).dialog("close"); }
   },
   resizable: false
  });	
 }//ShowDlg
 
 var usernamedefelem = '';
 var bhistoryactive = 0;
 var usiddefelemfsbh = 0;
 
 function PrepereRequestDataHistory(data) { 
  if (!data) {
    $('#b_history_data_source').html('<div align="center">No transactions</div>');
  } else {
   $('#b_history_data_source').html(data);    
  }
  bhistoryactive = 0;
  $('#balance_history'+usiddefelemfsbh).html('');
  $('#balance_hostory_link'+usiddefelemfsbh).html('View');
  $("#dialog_b_history").dialog({
   title: "The history of financial transactions " + usernamedefelem, 
   width:  '80%',            
   height: 'auto',         
   modal: true,            
   buttons: {
    "Close": function() { $(this).dialog("close"); }
   },
   resizable: false
  });   
    
 }//PrepereRequestDataHistory
 
 function ShowDlgBHistory(usname, usid) {
  if (bhistoryactive) {
   return alert('The operation is performed, please wait the completion of the previous operation..'); 
  }  
  bhistoryactive = 1;
  usernamedefelem = usname; 
  usiddefelemfsbh = usid;
  $('#balance_hostory_link'+usid).html(''); 
  $('#balance_history'+usid).html('Loading...');  
  SendDefaultRequest(globaladmpath, 'is_ajax_mode=1&usid='+usid+'&type=4&value=' + encodeURIComponent(usname)
  , 'PrepereRequestDataHistory');    
 } //ShowDlgBHistory 
 
 function ShowBlockItemsDialog() {
  var selcount = GetSelCount();
  if (selcount <= 0) { return alert('Highlight At least one user!'); }	 
  $("#dialog_locked").dialog({
   title: "Invalidate user(s) ", 
   width:  450,            
   height: 'auto',         
   modal: true,            
   buttons: {
    "Apply": function() { 
	 if (!$('#blockfor').val()) {
	  alert('Indicate the reason for blocking!');
	  $('#blockfor').focus();
	  return ;	
	 }
	 if (!confirm('Do you really want to block '+selcount+' users?')) { return ; } 
	 SetActionP('disabled');
	 $('#disabledstr').val($('#blockfor').val());
	 $('#commentsform').submit();	 	 	
	},
    "Cancel": function() { $(this).dialog("close"); }
   },
   resizable: false
  });  	
 }//ShowBlockItemsDialog
 
 function ShowDialogSaveData() {
  if (!allsaveenabled) { return alert('No Data for Export!'); }	 	
  $("#dialog_save").dialog({
   title: "Export Users info data", 
   width:  450,            
   height: 'auto',         
   modal: true,            
   buttons: {
    "Apply": function() { 	 
	 if (!$('#saveformat').val()) {
	  alert('Enter string format of export file line!');
	  $('#saveformat').focus();
	  return ;	
	 }
	 if (!confirm('Do you really want to export data?')) { return ; }
	 $('#saveform').submit();	 	 	 	
	},
    "Cancel": function() { $(this).dialog("close"); }
   },
   resizable: false
  });	
 }//ShowDialogSaveData
 
 function ShDescrBlock(ide, ide2) {
  var c = document.getElementById(ide);
  if (c && c.checked) {
   $('#'+ide2).css('display', 'block');
   $('#'+ide2).css('visibility', 'visible');
   return ;	
  }
  $('#'+ide2).css('display', 'none');
  $('#'+ide2).css('visibility', 'hidden');  	
 }//ShDescrBlock
 
 function PrepereRequestDataSeoPanel(data) {
  bhistoryactive = 0;
  $('#seopanel_link'+usiddefelemfsbh).html('View');
  $('#seopanel_n'+usiddefelemfsbh).html('');
    
  $('#b_seopanel_data_source').html(data); 
  
  $("#dialog_b_seopanel").dialog({
   title: "Sites panel optimizer user ["+usernamedefelem+']' , 
   width:  450,            
   height: 500,         
   modal: true,            
   buttons: {
    "Remove selected": function() { 	 
	 
     if (!WaitActionAjax()) { return false; }
         
     var countul = 0; var query = '';
     
      $('#b_seopanel_data_source div').each(function (i) {               
       var iddiv = $(this).attr('idu');   
       if (iddiv && iddiv != 'undefined') {  
        
        var chid = $('#chur'+iddiv).attr('checked');
        if (chid) {
         query = query + ((query) ? (','+iddiv) : iddiv);
         countul++;
        }
       }                            
      });
     
     if (countul == 0 || !confirm('Are you sure you want to delete '+countul+' sites of user '+usernamedefelem+'?')) {
       return false; 
     }
     
     bhistoryactive = 1;
     SendDefaultRequest(globaladmpath, 'is_ajax_mode=1&usid='+usiddefelemfsbh+'&type=6&value=' + encodeURIComponent(query)
     , 'PrepereRequestDataSeoPanelDel'); 
     	 	 	 	
	},
    "Close": function() { $(this).dialog("close"); }
   },
   resizable: false
  });     
 }//PrepereRequestDataSeoPanel
 
 function PrepereRequestDataSeoPanelDel(data) {
    
  bhistoryactive = 0;
  if (!data) { return false; }
  
  arr = data.split(',');
  
  for (var i=0; i < arr.length; i++) {  
   $('#b_seopanel_data_source div[idu="'+arr[i]+'"]').remove();    
  }  
  
  var countid = $('#seopanel_count'+usiddefelemfsbh).text();
  if (!countid || countid == '') { countid = 0; }
  
  countid-=arr.length;
  if (countid < 0) { countid = 0; }
  
  $('#seopanel_count'+usiddefelemfsbh).html(countid);
  
  if (countid == 0) {
    $('#siteslistitems'+usiddefelemfsbh).html('<div align="center">No Sites!</div>');    
  }    
    
 }//PrepereRequestDataSeoPanelDel
 
 function WaitActionAjax() {
  if (bhistoryactive) {
   alert('The operation is performed, please wait the completion of the previous operation..');
   return false; 
  }  
  return true;
 }//WaitActionAjax
 
 function ShowDlgSeoPanel(usname, usid) {
  if (!WaitActionAjax()) { return false; }    
  
  bhistoryactive = 1;
  usernamedefelem = usname; 
  usiddefelemfsbh = usid;
  $('#seopanel_link'+usid).html(''); 
  $('#seopanel_n'+usid).html('Loading...');  
  SendDefaultRequest(globaladmpath, 'is_ajax_mode=1&usid='+usid+'&type=5&value=' + encodeURIComponent(usname)
  , 'PrepereRequestDataSeoPanel');     
    
 }//ShowDlgSeoPanel

 function DeleteGroup(groupiditem, iduser, iditem, username) {  
  
  var str = $('#labeldel' + iditem).text();
  if (!confirm('Are you sure you want to delete a user `'+username+'` from group `'+str+'`?')) {
    return false;
  }  
  
  $('#deletefromitem' + iditem).html('<label style="color: #0000FF">Deleting..</label>');
  
  SendDefaultRequest(globaladmpath, 'is_ajax_mode=1&groupiditem='+groupiditem+'&iduser='+iduser+'&iditem='+iditem+
  '&type=7', 'PrepereRequestDataDeleteGroup');
    
 }//DeleteGroup
 
 //ok, as {groupiditem:'0-9', iduser:'0-9', iditem:'0-9'}
 function PrepereRequestDataDeleteGroup(data) {
  if (!data) { return false; }
  
  eval('var p = '+data+';');
   
  $('#deletefromitem' + p.iditem).remove();
  $('#groupstr' + p.iditem).remove();
   
  var countff = 0; 
  $('#listlbs' + p.iduser).find('a').each(function (i) {
    countff++;
    return false;    
  });
  
  if (countff <= 0) {
   $('#listlbs' + p.iduser).html('<div class="divblocked">No Groups!</div>'); 
   $('#descrgroup'+p.iduser).html('<em>(not in groups)</em>');   
  }    
    
 }//PrepereRequestDataDeleteGroup   	
</script>
<style type="text/css">
  .h_th1, .h_td, .h_td2 { 
   border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E3E4E8; border-left: none; }
  .btn_n { border: 1px solid #E3E4E8; border-top: none; height: 25px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E3E4E8; height: 25px; border-top: none; }	
 </style>
{/literal} 

 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
       <span id="ui-dialog-title-dialog" class="ui-dialog-title">Export Data</span>
       <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
    </div>
    <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_save">
       {literal}
       <style type="text/css">
	    .bbcodein { color: #333399; cursor: pointer }
		.bbcodein:hover { color: #0000FF; cursor: pointer }
       </style>
       {/literal}
       <div class="typelabel">
        <div>Export data for all users on the current active filter.</div>
        <div>Use the format of the data of one line in file:</div>
        <div><b class="bbcodein" onclick="InsertObhvatData('[name]', '', 'saveformat')">[name]</b> - username</div>
        <div><b class="bbcodein" onclick="InsertObhvatData('[email]', '', 'saveformat')">[email]</b> - e-mail</div>
        <div><b class="bbcodein" onclick="InsertObhvatData('[url]', '', 'saveformat')">[url]</b> - user site</div>
        <div><b class="bbcodein" onclick="InsertObhvatData('[balance]', '', 'saveformat')">[balance]</b> - user balance</div>
        <div><b class="bbcodein" onclick="InsertObhvatData('[n]', '', 'saveformat')">[n]</b> - line break</div>
        <div><b class="bbcodein" onclick="InsertObhvatData('[lock]', '', 'saveformat')">[lock]</b> - the reason for blocking</div>
        <div><b class="bbcodein" onclick="InsertObhvatData('[date]', '', 'saveformat')">[date]</b> - Registration Date</div>
        <div><b class="bbcodein" onclick="InsertObhvatData('[datex]', '', 'saveformat')">[datex]</b> - date of last activity</div>
       </div>
       
       <form method="post" name="saveform" id="saveform">      
        <div class="typelabel" style="margin-top: 10px"><span id="red">*</span> Enter Export format</div>
        <div class="typelabel">
         <input type="text" class="inpt" style="width: 98%" name="saveformat" id="saveformat" value="[email]">        
        </div>
        <input type="hidden" value="do" name="saveitemsaction">
		    
       </form>   
	      
    </div>
 </div>

<form method="post" name="commentsform" id="commentsform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Delete&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Unlock&nbsp;" class="activatelistit" name="ena" id="ena" onclick="SetActionP('enabled')" style="//width: 80px;">
 </span>

 <span style="margin-left: 8px">
  <input type="button" value="&nbsp;Lock&nbsp;" class="deactivatelistit" name="dna" id="dna" onclick="ShowBlockItemsDialog()" style="//width: 80px;">
 </span>
 
 <span style="margin-left: 8px">
  <input type="button" value="&nbsp;Save in .txt&nbsp;" class="saveselectlist" name="asid" id="asid" onclick="ShowDialogSaveData()">
 </span>
 
 </div>
 <div style="margin-top: 6px"> 
  
 
 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
       <span id="ui-dialog-title-dialog" class="ui-dialog-title">Balance</span>
       <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
    </div>
    <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_balance">   
       <div class="typelabel">User Balance: <b id="usernameblc">0.00</b> USD</div>
       
	   <div class="typelabel">
        <input type="radio" checked="checked" name="typetobalance" id="typetobalanceadd" style="cursor: pointer" onclick="$('#balanceaction').text('add')"><label style="cursor: pointer" for="typetobalanceadd">&nbsp; Add amount</label>
       </div>
       
       <div class="typelabel">
        <input type="radio" name="typetobalance" id="typetobalancesub" style="cursor: pointer" onclick="$('#balanceaction').text('sub')"><label for="typetobalancesub" style="cursor: pointer">&nbsp; Subtract amount</label>
       </div>
       
       <div class="typelabel">
        <input type="radio" name="typetobalance" id="typetobalanceset" style="cursor: pointer" onclick="$('#balanceaction').text('set')"><label for="typetobalanceset" style="cursor: pointer">&nbsp; Set amount</label>
       </div>
       
       <div class="typelabel" style="margin-top: 10px"><span id="red">*</span> Amount (format: 0.00)</div>
       <div class="typelabel">
        <input type="text" class="inpt" style="width: 98%" name="pricevalue" id="pricevalue" value="0.00">        
       </div>
       
       <div class="typelabel">    
        <input type="checkbox" checked="checked" style="cursor: pointer" name="checkwithmessages" id="checkwithmessages" onclick="ShDescrBlock('checkwithmessages', 'withdescriptandsend')"><label for="checkwithmessages" style="cursor: pointer">&nbsp; With E-mail notification and recording of financial transactions in the history of user</label>
       </div>
       
       <div class="typelabel" id="withdescriptandsend">
        <div><span id="red">*</span> Description of history of financial transactions, user</div>
        <div class="typelabel">
         <input type="text" class="inpt" style="width: 98%" name="pricedescr" id="pricedescr" value="Completion of balance of administrator" maxlength="240">        
        </div>
       </div>   
       
       <div id="balanceaction" style="display: none; visibility: hidden">add</div>  
	   <div class="typelabel" id="balancestatus"></div>	      
    </div>
 </div>
 
 
 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
       <span id="ui-dialog-title-dialog" class="ui-dialog-title">The reason for blocking</span>
       <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
    </div>
    <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_locked">
       
       <div class="typelabel" style="margin-top: 10px"><span id="red">*</span> Specify reason for blocking</div>
       <div class="typelabel">
        <input type="text" class="inpt" style="width: 98%" name="blockfor" id="blockfor" value="...">        
       </div>   
	      
    </div>
 </div>
 
 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
       <span id="ui-dialog-title-dialog" class="ui-dialog-title">The history of financial transactions</span>
       <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
    </div>
    <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_b_history">
            
       <div class="typelabel" id="b_history_data_source">
                
       </div>   
	      
    </div>
 </div>
 
 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
       <span id="ui-dialog-title-dialog" class="ui-dialog-title">seo panel</span>
       <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
    </div>
    <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_b_seopanel">
            
       <div class="typelabel" id="b_seopanel_data_source">
                
       </div>   
	      
    </div>
 </div> 
  
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <td class="h_th1" valign="center" align="left" width="20px">
	 <span style="margin-left: 4px">
	  <input type="checkbox" name="checkallitems" id="checkallitems" style="cursor: pointer" onclick="CheckAll(this)">
	 </span>
	</td>	
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">User</span></td>		
	<td class="h_td2" valign="center" align="left" width="1px"></td>
   </tr>	
   {if $adm_object->GetResult('data.source')}
	{foreach from=$adm_object->GetResult('data.source') item=val name=val}
	 <tr onmouseover="DoHigl(this, 1, {$smarty.foreach.val.index})" onmouseout="DoHigl(this, 0, {$smarty.foreach.val.index})" id="t_r_{$smarty.foreach.val.index}">
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8; {if $val.userlocked}background: #FFCCCC{/if}">
	  <span style="margin-left: 4px">
	   {if $val.username != $CONTROL_OBJ->userdata.username}
	   <input type="checkbox" name="chid{$smarty.foreach.val.index}" id="chid{$smarty.foreach.val.index}" 
	   style="cursor: pointer" onclick="CheckItem('{$smarty.foreach.val.index}', this)">
	   {/if}
	  </span>
	 </td>	 
	 <td class="sth1" valign="center" align="left" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	  
	  <div style="margin: 5px 5px 5px 5px">
	   {assign var="avatarinfo" value=$CONTROL_OBJ->GetUserAvatarInfo(false, $val)}
	   <span style="width: 100%">
	   <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
	     <td valign="top" align="left" width="106px">
	     <img width="99" height="99" src="{$avatarinfo.webpath}">	  
	     </td>
	     <td valign="top" align="left">
	      <div style="margin-bottom: 4px; color: #969696">
	       <a href="{$smarty.const.W_SITEPATH}userinfo/{$val.username}/" target="_blank">{$val.username}</a>{if $CONTROL_OBJ->UserIsAdmin($val.username)}<span style="margin-left: 8px"><b style="color: #0000FF">(Administator)</b></span>{/if}	      
		  </div>
		  <div>
		   <span style="width: 100%">
		   <table width="100%" cellpadding="0" cellspacing="0">
           
		   <tr>
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 E-mail:
			</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 <a href="{$smarty.const.W_SITEPATH}account/mail/new/tousers={$val.username}" target="_blank" style="text-decoration: none;" id="email_source{$val.iduser}">{$val.useremail}</a>
			</td>
			
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			<a href="javascript:" id="email_link{$val.iduser}" style="color: #666699" onclick="ModifyEmail('{$val.iduser}', $('#email_source{$val.iduser}').text())">Modify</a><label style="color: #0000FF" id="email_{$val.iduser}"></label>
			</td>
			
           </tr>
           
           <tr>
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 Site:
			</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 <i id="url_source{$val.iduser}">{if $val.usersite}{$val.usersite}{else}(no){/if}</i>
			</td>
			
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 <a href="javascript:" id="url_link{$val.iduser}" style="color: #666699" onclick="ModifyURL('{$val.iduser}', $('#url_source{$val.iduser}').text())">Modify</a><label style="color: #0000FF" id="url_{$val.iduser}"></label>
			</td>
			
           </tr>
           
           <tr>
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 IP:
			</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 {if $val.userip}{$val.userip}</a>{else}<i>(?)</i>{/if}
			</td>
			
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			
			</td>
			
           </tr>
           
           <tr>
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 Password Hash:
			</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 {$val.userhash}
			</td>
			
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			
			</td>
			
           </tr>
           
           <tr>
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 Balance:
			</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 <label id="balance_source{$val.iduser}" {if $val.purcedata}style="color: #008000"{/if}>{$val.purcedata}</label> USD
			</td>
			
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 <a href="javascript:" id="balance_link{$val.iduser}" style="color: #666699" onclick="$('#dialog_balance').dialog('destroy'); ShowDlg('{$val.username}', '{$val.iduser}')">Modify</a><label style="color: #0000FF" id="balance_{$val.iduser}"></label>			 
			</td>
			
           </tr>
           
           
           <tr>
            {assign var="translistcount" value=$CONTROL_OBJ->GetFinanceTransactionsCount($val.username, false)} 
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">&nbsp;</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 <label id="balance_history_ssk{$val.iduser}">{if $translistcount}<label style="color: #008000"><strong>{$translistcount}</strong> transactions</label>{else}<em>(not transactions)</em>{/if}</label>
			</td>		
            
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">{if $translistcount}
			 <a href="javascript:" id="balance_hostory_link{$val.iduser}" style="color: #666699" onclick="ShowDlgBHistory('{$val.username}', '{$val.iduser}')">View</a><label style="color: #0000FF" id="balance_history{$val.iduser}"></label>{/if}			 
			</td>
			
           </tr> 
           
           
           <tr> 
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">SEO Panel</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 total sites: <label id="seopanel_count{$val.iduser}">{$adm_object->GetSeoPanelSitesCount($val.iduser)}</label>, <a href="{$smarty.const.W_SITEPATH}panel/{$val.iduser}" target="_blank">management</a>
			</td>		
            
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 <a href="javascript:" id="seopanel_link{$val.iduser}" style="color: #666699" onclick="ShowDlgSeoPanel('{$val.username}', '{$val.iduser}')">View</a><label style="color: #0000FF" id="seopanel_n{$val.iduser}"></label>			 
			</td>
			
           </tr>
           
           
           <tr> 
            {assign var="groupslist" value=$CONTROL_OBJ->GetUserGroups($val.iduser, 'text-decoration: underline; color: #016C6C')}
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">Groups</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF; font-size: 95%" id="descrgroup{$val.iduser}">
			 {if $groupslist.str}
              {$groupslist.str}
             {else}
             <em>(not in groups)</em>
             {/if} 
			</td>		
            
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF; white-space: nowrap;">
			 
             
	        <span class="blockmenuitemshead" id="deletemenublock{$val.iduser}" style="text-align: left">
             <ul>
            <li class="menuclickitem" id="titleoptname">delete</li>   
              <li class="blockitemsbody" id="bodyoptname" style="//min-width: 185px">	
                        
               {if !$groupslist.str}
                <div class="divblocked">No Groups!</div>
               {else}
                <div id="listlbs{$val.iduser}">
                <div class="divseparator"><span>Delete from Group..</span></div>
                 {foreach from=$groupslist.data item=val2 name=val2}
                  <div class="divblocked" id="deletefromitem{$val2.iditem}">
             
                  <a href="javascript:" id="labeldel{$val2.iditem}" onclick="DeleteGroup('{$val2.groupiditem}', '{$val.iduser}', '{$val2.iditem}', '{$val.username}')">{$val2.groupname}</a>      
            
                  </div>
                 {/foreach} 
               {/if}
               </div> 
		  
              </li>   
             </ul>
            </span>
            
            {literal}
              <script type="text/javascript">
	             jQuery(document).ready(function() {	      
                   $('#deletemenublock{/literal}{$val.iduser}{literal}').domenuitems();
                 });
              </script>            
            {/literal}             
             			 
			</td>
			
           </tr>
                                
           
           
           <tr>
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 Status:
			</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 {if $val.userlocked}
			  <b style="color: #FF0000">Blocked</b><label style="color: #000000; font-size: 95%">, reason: {if $val.userlocked}{$val.userlocked}{else}?{/if}</label>
			 {else}
			  {if !$val.confreg}
			   <span style="color: #FF8080"><i>Awaiting confirmation E-mail Address</i></span>
			  {else}
			   <span style="color: #008000"><i>Active</i><label style="color: #000000; font-size: 95%"> , activity: {$CONTROL_OBJ->GetLastIntervalInDays($val.datelastin)}</label></span>
			  {/if}			 
			 {/if}
			</td>
			
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			
			</td>
			
           </tr>
           
           <tr>
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 Comments:
			</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 {$adm_object->GetCommentsCountByUser($val.username)}
			</td>
			
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			
			</td>
			
           </tr>
           
           
           
           </table>
		   </span>
		  </div>
		  
		  
		  
		  
		  
		  	  
	     </td>
        </tr>
        <tr>
	     <td valign="top" align="right" colspan="2" style="margin-right: 4px; padding-top: 3px">
	      <div style="margin-bottom: 3px">	      
	       {$CONTROL_OBJ->DateTimeToSpecialFormat($val.datereg)}	   	  
	      </div>  
	     </td>
        </tr>     
       </table>
	   </span>	   
	  </div>
	  
	 </td>	 
	 <td class="sth1" valign="top" align="left" style="border-right: 1px solid #E3E4E8; width: 1px" onclick="$('#chid{$smarty.foreach.val.index}').click()">	 
	 </td>
    </tr>  
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.iduser}" name="idm{$smarty.foreach.val.index}">
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="3">
     No Users!
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
 <input type="hidden" value="" name="disabledstr" id="disabledstr">
 <input type="hidden" value="0" name="groupaddparam" id="groupaddparam"> 
</form>
<script type="text/javascript">SetEnabled();</script>
{else}
 {* добавление *}
 
 {literal}
 <script type="text/javascript">
  function PrepereSend(th) {
   if (!trim(th.newlogin.value)) {
	alert('Enter Username!');
	th.newlogin.focus();
	return false;
   }
   if (!emailCheck(th.newemail.value)) {
	alert('Enter valid e-mail!');
	th.newemail.focus();
	return false;
   }
   if (!th.newpass.value) {
	alert('Enter password!');
	th.newpass.focus();
	return false;
   }
   if (th.newpass.value != th.newpass2.value) {
	alert('Passwords do not match!');
	th.newpass2.focus();
	return false;
   }
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;
   return true;   	
  }//PrepereSend	
 </script>
 {/literal}
 <form method="post" name="newuseraddform" id="newuseraddform" onsubmit="return PrepereSend(this)">
  
  <div class="typelabel"><label id="red">*</label> Username</div>
  <div><input type="text" class="inpt" style="width: 320px" name="newlogin" id="newlogin" value="{$CONTROL_OBJ->GetPostElement('newlogin', 'newuseraction')}" maxlength="100">
  </div>
  
  <div class="typelabel"><label id="red">*</label> E-mail</div>
  <div><input type="text" class="inpt" style="width: 320px" name="newemail" id="newemail" value="{$CONTROL_OBJ->GetPostElement('newemail', 'newuseraction')}">
  </div>
  
  <div class="typelabel"> Site</div>
  <div><input type="text" class="inpt" style="width: 320px" name="newsite" id="newsite" value="{$CONTROL_OBJ->GetPostElement('newsite', 'newuseraction')}">
  </div>
  
  <div class="typelabel"><label id="red">*</label> Password</div>
  <div><input type="password" class="inpt" style="width: 320px" name="newpass" id="newpass" value="">
  </div>
  
  <div class="typelabel"><label id="red">*</label> Re-enter password</div>
  <div><input type="password" class="inpt" style="width: 320px" name="newpass2" id="newpass2" value="">
  </div>
 
  
 <input type="hidden" value="do" name="newuseraction">
 <div class="typelabel"><input type="submit" value="&nbsp;Send&nbsp;" class="button" name="rb" id="rb"></div>
 </form>
 
 {if $smarty.post.newuseraction == 'do'}
 <div style="margin-top: 8px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">User added successfully!</label>
  {/if}
 </div>
 {/if} 
  
{/if}
</div>
</div>