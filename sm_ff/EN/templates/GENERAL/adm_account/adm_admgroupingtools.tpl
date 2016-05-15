{* группировка инструментов *}
<div style="margin-top: 4px">
<div>
<a href="{$smarty.const.W_SITEPATH}account/admgroupingtools&new=1"{if $smarty.get.new} style="color: #000000"{/if}>Add Group</a> | <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admgroupingtools/">All groups (<label style="color: #000000">{$adm_object->GetResult('count')}</label>)</a>
</div>
<div style="margin-top: 12px">
{if !$smarty.get.new}
{* список групп *}
  {literal}
  <script type="text/javascript">
   var global_path_element = {/literal}'{$smarty.const.W_SITEPATH}account/admgroupingtools'{literal};
   var global_status_id = 0;
   var global_status_id_assecc = 0;
   
   function DoSelectToolsForGroup(groupid) {
    if (global_status_id) { return alert('Please wait until!'); }
    global_status_id = groupid;
    $('#selecttoolslistgroup'+groupid).html('<label style="color: #0000FF; font-size: 95%">Loading, please wait..</label>');
    SendDefaultRequest(global_path_element, 'is_ajax_mode=1&typed=get&groupid='+groupid, 'PrepereToGetListTools');
   }//DoSelectToolsForGroup 
   
   function PrepereToGetListTools(data) {    
    $('#toolslistglogaldata').html((data) ? data : 'No active tools');
    $('#selecttoolslistgroup'+global_status_id).html(
     '<a href="javascript:" onclick="DoSelectToolsForGroup(\''+global_status_id+'\')"'+
     ' style="font-size: 95%">Select tools</a>'
    );    
    //ok, show dialog item   
    $("#dialog_toolslist").dialog({
     title: "The choice of tools group", 
     width:  700,            
     height: 'auto',         
     modal: true, 
     //position: ["center","top"],           
     buttons: {
      "Apply": function() { 	 
	   //ok, process collection all items
       var listtools = '';
       $('#toolslistglogaldata').find('input[type="checkbox"]').each(function (i) {
        var id = ($(this).attr('checked')) ? $(this).attr('id') : false;
        if (id) {
         id = $('#'+id+'data').val();
         if (id) {
          listtools += ((listtools) ? ('|'+id) : id);            
         }            
        }        
       });
       //ok, send regust to set elements
       global_status_id_assecc = 1;
       $('#selecttoolslistgroup'+global_status_id).html(
        '<label style="color: #0000FF; font-size: 95%">Applying the list, wait..</label>'
       );
       SendDefaultRequest(
        global_path_element, 'is_ajax_mode=1&typed=set&groupid='+global_status_id+'&data='+listtools,
        'PrepereToGetResultList'
       );         
	   $(this).dialog("close");  	 	 	 	
	  },
      "Cancel": function() { $(this).dialog("close"); }
     },
     resizable: true,
     beforeClose: function(event, ui) { if (!global_status_id_assecc) { global_status_id = 0; } }
    }); 
   }//PrepereToGetListTools
   
   function PrepereToGetResultList(data) {
    //restore link set
    $('#selecttoolslistgroup'+global_status_id).html(
     '<a href="javascript:" onclick="DoSelectToolsForGroup(\''+global_status_id+'\')"'+
     ' style="font-size: 95%">Select tools</a>'
    );
    //set data
    $('#toolsgrouplist'+global_status_id).html((!data) ? 'No tools' : data);
    //ok, reset access    
    global_status_id_assecc = 0;
    global_status_id = 0;
   }//PrepereToGetResultList
   
   function ActionToRemoveItem(ident) {
    if (!confirm('Are you sure you want to delete the selected group?\r\nContinue?')) { return ; }
    document.location = global_path_element + '&delete=' + ident;    
   }//ActionToRemoveItem	
  </script>
  {/literal}
  
  <div>
  {if !$adm_object->GetResult('data.source')}
   <div style="text-align: center; padding: 6px; margin-top: 25px"><b>No active groups!</b></div>
  {else}
   
  
   <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
       <span id="ui-dialog-title-dialog" class="ui-dialog-title">Tools</span>
       <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
    </div>
    <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_toolslist">
       
       <div class="typelabel" style="margin-top: 10px"><span id="red">*</span> Select the Tools group</div>
       <div class="typelabel" id="toolslistglogaldata">
                        
       </div>   
	      
    </div>
   </div>  
   
   
   {foreach from=$adm_object->GetResult('data.source') item=val name=val}
    <div style="margin-top: 5px; padding: 4px; margin-bottom: 10px; border: 1px solid #969696">
	<span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
	   <td align="left" valign="top" style="padding-left: 2px">
        <div><b>{$val.nameident}</b> [<i style="color: #808080">{$adm_object->GetText($val.nameident)}</i>]<label style="color: #0000FF; margin-left: 6px; font-size: 95%">[Position: <strong>{$val.posident}</strong>]</label></div>
	    <div style="margin-top: 12px; background: #F4F4F4; width: 350px">
        <strong>Tools</strong> 
         <label style="margin-left: 6px" id="selecttoolslistgroup{$val.iditem}"> 
           <a href="javascript:" onclick="DoSelectToolsForGroup('{$val.iditem}')" style="font-size: 95%">Select tools</a>
         </label>
        </div> 
	   
	   </td>
	   <td align="right" valign="top" style="padding-right: 4px">
        <a href="{$smarty.const.W_SITEPATH}account/admgroupingtools&new=1&modify={$val.iditem}" title="Change group settings"><img src="{$smarty.const.W_SITEPATH}img/items/document_edit.png" width="16" height="16" /></a>
        
        <a style="margin-left: 4px" href="javascript:" title="Remove Group" onclick="ActionToRemoveItem('{$val.iditem}')"><img src="{$smarty.const.W_SITEPATH}img/items/erase.png" width="16" height="16" /></a>        	   
	   </td>
      </tr>
     </table>
	</span>
    
    {* инструменты группы *}      
    <div style="margin-top: 4px; padding-left: 4px" id="toolsgrouplist{$val.iditem}">    
     {include file="adm_account/grouping/grouping-tools-list-result.tpl" groupiddata=$val.iditem}
    </div>
        
	</div>
   {/foreach}
   {if $adm_object->GetResult('data.source')}
    <div style="text-align: right; margin-top: 10px">{$adm_object->GetResult('data.pagestext')}</div>
   {/if}    
  {/if}
  </div>

{else}
 {* добавление/изменение группы группы *}
 {literal}
 <script type="text/javascript">         
    function PrepereSent(th) {		 	
	 if (!trim(th.identifiername.value)) {
	  alert('Specify the ID name of the group!');
	  th.identifiername.focus();
	  return false;	
	 }	
	 if (trim(th.nm.value) == '') {
	  alert('Enter the serial number of the group (number)!');
	  th.nm.focus();
	  return false;	
	 } 	 	 
	 $('#globalbodydata').css('cursor', 'wait');
     th.rb.disabled = true;
	 return true; 	
	}//PrepereSent	
 </script>
 {/literal} 
 
 <form method="post" name="addgroupf" id="addgroupf" onsubmit="return PrepereSent(this)">
  
  <div class="typelabel"><label id="red">*</label> The ID of the group's name (ID string resources)</div>
  <div class="typelabel">
   <label> 
    <select class="combobox" name="identifiername" id="identifiername" style="width: 450px">  
	{if !$adm_object->GetResult('modifyinfo')}
     {assign var="strlistids" value=$adm_object->GetStrings($smarty.post.identifiername)}
    {else}
     {assign var="strlistids" value=$adm_object->GetStrings($adm_object->GetResult('modifyinfo.nameident'))}
    {/if}        
    {foreach from=$strlistids item=str name=str}
     <option value="{$str.ident}"{if $str.isselect} selected="selected" style="color: #0000FF"{/if}>{if $str.ident}{$str.ident} ({$str.strdescr}){else}{$str.strdescr}{/if}</option>
    {/foreach}             
    </select>
   </label>
  </div>
  
  <div class="typelabel"><label id="red">*</label> Serial number of sorting groups. (in ascending order of atomic number, ie the group number 0 is the first, with the number 1 second, with the number 24 - 24th, or third, if there are only 2 groups)</div>
  <div class="typelabel">
   <input type="text" class="inpt" style="width: 200px" name="nm" id="nm" maxlength="4" value="{$CONTROL_OBJ->GetPostElement('nm','actionthissectionpost4', 'do', '0')}">
  </div>
  
  <div class="typelabel" style="margin-top: 15px">
  <input type="submit" value="&nbsp;{if !$adm_object->GetResult('modifyinfo')}Add Group{else}Save Changes{/if}&nbsp;" class="button" name="rb" id="rb">&nbsp;
 </div> 
  <input type="hidden" value="do" name="actionthissectionpost4">
 </form> 
 
 {literal}
 <script type="text/javascript">
  $(function() { $('#identifiername').combobox(); });	
 </script>
 {/literal}
 

 {if $smarty.post.actionthissectionpost4 == 'do' && !$smarty.post.actionthissectionpost_q}
 <div style="margin-top: 10px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">The group successfully {if !$adm_object->GetResult('modifyinfo')}added{else}changed{/if}!</label>
  {/if}
 </div>
 {/if}
{/if}
</div>
</div>