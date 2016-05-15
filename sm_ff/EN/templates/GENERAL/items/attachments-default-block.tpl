{* блок вложений файлов объекта 
 
 $filesid - идентификатор типа файлов
 $objectid - идентификатор объекта, к которому указываютсявложения

*}
 {assign var="attfileslist2" value=$CONTROL_OBJ->GetAttachmentsObjectList($filesid, $objectid)}
 
 {if $attfileslist2}
 <div style="margin-top: 25px; border: 1px solid #B1B1B1; padding: 3px; padding-bottom: 6px;">
  
  <div>
   <label style="position: relative; top: -12px; background: white; padding-left: 3px; padding-right: 3px">Attachments</label>
  </div>
  
  <div style="padding-left: 5px;">
  
  {foreach from=$attfileslist2 key=nm item=val name=val}
   
   {if $nm && $nm != '-'}
   <div style="border-top: 1px solid #D7DBDB; padding: 3px; position: relative; margin-top: 8px">
    <label style="position: relative; top: -12px; background: white; padding-left: 3px; padding-right: 3px">{$nm}</label>
   </div>
   {/if}
   
   {foreach from=$val item=val2 name=val2}
   <div style="position: relative; top: -6px; padding: 2px; padding-left: 4px;">
   
   <span style="width: 100%;">
   <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
     <td valign="top" align="left" width="20px">
      <img src="{$smarty.const.W_SITEPATH}img/ico/general/attach.png" border="0" alt="attach" width="16" height="16" />
     </td>
	 <td valign="top" align="left">
     
     <label style="padding-left: 2px">
   <a title="Go to page download" href="{$smarty.const.W_SITEPATH}download/{$filesid}/{$objectid}/{$val2.iditem}">{$val2.fname}</a><label style="margin-left: 3px; font-size: 95%">({$CONTROL_OBJ->GetStrSizeFromBytes($val2.fsize)}, downloads: {$val2.dwcount})</label>
   </label>
   {if $val2.filetip}
   <label style="padding-left: 2px">{$CONTROL_OBJ->strings->CorrectTextFromDB($val2.filetip)}</label>
   {/if}
     
     </td>
    </tr>
   </table>
   </span>
   
   </div>
   {/foreach}

  
  {/foreach}
  
  </div>
   
 </div>
 {/if}