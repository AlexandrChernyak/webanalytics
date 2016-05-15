{* скачивание файлов *}
<div style="margin-top: 4px">
 {if $curfile_object->error && $curfile_object->globalerror}
  <div style="color: #FF0000">{$curfile_object->error}</div>
 {else}
  
  {* отображение информации о объекте, для которого используются вложения *}
  <div>
   Объект: 
   {if $curfile_object->fileObject->GetFullPath()}
   
    {foreach from=$curfile_object->fileObject->GetFullPath() item=val name=val}
     
      <a href="{$val.path}" target="_blank">{$val.name}</strong></a>
      {if !$val.isend}
       <label style="margin: 0 2px 0 2px"> -> </label>
      {/if}
    
    {/foreach}
   
   {else}    
    {if $curfile_object->fileObject->GetSectionPath()}
    <a href="{$curfile_object->fileObject->GetSectionPath()}" target="_blank"><strong>{$curfile_object->fileObject->GetSectionName()}</strong></a>
    {else}
    <label><strong>{$curfile_object->fileObject->GetSectionName()}</strong></label>
    {/if}
    
    <label style="margin-left: 2px"> -> </label>
    <label style="margin-left: 2px">
     <a href="{$curfile_object->fileObject->GetPath()}" target="_blank">{$curfile_object->fileObject->GetName()}</a>
    </label>
   {/if}    
  </div>
  
  
 <div style="margin: 22px 1px 12px 1px"> 
 
  <div class="typelabel" style="margin-top: 12px; background: #F0F0F0; padding: 3px">
   <strong>Информация о файле</strong>
  </div>
  
  {literal}
  <style type="text/css">
	.line_item { border-bottom: 1px solid #EBEBEB; height: 22px; }
  </style>
  <script type="text/javascript">
   function DoHigl(th, n) {	
    if (n) { $(th).css('background','#F9FAFB'); } else {   	
     $(th).css('background', 'none');		
    }	
   }//DoHigl	
  </script>
  {/literal}
    
  <div style="padding: 6px 2px 1px 4px">
  
   <div>
   <span style="width: 100%">
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <td valign="center" align="left" width="120px" class="line_item">
	  Файл
	  </td>
	  <td valign="center" align="left" class="line_item">
	  <div>
      <span style="width: 100%">
      <table width="100%" cellpadding="0" cellspacing="0">
       <tr>
	    <td valign="center" align="left" width="20px">
         <img src="{$smarty.const.W_SITEPATH}img/ico/general/attach.png" border="0" alt="attach" width="16" height="16" />
        </td>
	    <td valign="center" align="left">
         <b>{$curfile_object->fileInfo.fname}</b>
        </td>
       </tr>
      </table>
      </span>
      </div>
	  </td>
	 </tr>
     
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <td valign="center" align="left" width="120px" class="line_item">
	  Размер
	  </td>
	  <td valign="center" align="left" class="line_item">
	   {$CONTROL_OBJ->GetStrSizeFromBytes($curfile_object->fileInfo.fsize)}      	  
	  </td>
	 </tr>  
     
     {if $curfile_object->fileInfo.shcountw}
     <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <td valign="center" align="left" width="120px" class="line_item">
	  Загрузок
	  </td>
	  <td valign="center" align="left" class="line_item">
	   {$curfile_object->fileInfo.dwcount}      	  
	  </td>
	 </tr>
     {/if}
     
     <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <td valign="center" align="left" width="120px" class="line_item">
	  Дата создания
	  </td>
	  <td valign="center" align="left" class="line_item">
	   {$curfile_object->fileInfo.datecreate}      	  
	  </td>
	 </tr>
     
     {if $curfile_object->fileInfo.filetip}
     <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <td valign="center" align="left" width="120px" class="line_item">
	  Примечание
	  </td>
	  <td valign="center" align="left" class="line_item">
	   {$CONTROL_OBJ->strings->CorrectTextFromDB($curfile_object->fileInfo.filetip)}      	  
	  </td>
	 </tr>     
     {/if}
	
	</table>   
   </span>
   </div>
  
   <div style="margin-top: 14px">
    
    {* информация о получении файла *}
    {if $curfile_object->accesstype == 5}
     <div style="color: #FF0000">
      Файл не найден!
     </div>
    {elseif $curfile_object->accesstype == 1}
     <div style="color: #FF0000">
      Для получения доступа к файлу необходимо авторизироваться на сайте!
     </div>
    {elseif $curfile_object->accesstype == 2} 
     <div style="color: #FF0000">
      Для получения доступа к файлу необходимо иметь права администратора!
     </div>
    {elseif $curfile_object->accesstype == 3}
     
     {if !$curfile_object->noshowgroupsinfo}
     <div>Данный файл могут скачивать только пользователи, состоящие в группах:</div>
     <div style="font-size: 95%">{$CONTROL_OBJ->GetGroupsListAsStr($curfile_object->fileInfo.fromgroupso, 'text-decoration: underline; color: #016C6C')}</div>
     
     <div style="margin-top: 4px">На данный момент Вы состоите в группах:</div>
     <div style="font-size: 95%">{if $curfile_object->usergroups.str}{$curfile_object->usergroups.str}{else}(вы не состоите в группах){/if}</div>
     <div style="font-size: 95%; color: #808080; margin-top: 2px"><em>(если Вы считаете, что должны состоять в указанных группах - попросите администратора добавить Вас в нужную группу используя <a href="{$smarty.const.W_SITEPATH}feedback/" target="_blank" style="font-size: 95%">обратную связь</a> `не забываете указывать логин`)</em></div>
     {/if}
    
    {if $curfile_object->priced}
     <div style="margin-top: 20px">** Вы можете скачать файл на платной основе не учавствуя в указанных группах!</div>
     <div class="typelabel">
      Цена скачивание файла: <strong style="color: #008000">{$curfile_object->fileInfo.pricevalue} USD</strong>
     </div>
     <div style="font-size: 95%; color: #808080"><em>(копия файла отправляется на e-mail аккаунта)</em></div>    
    {/if}
   
   {elseif $curfile_object->accesstype == 4}
    <div style="color: #FF0000">
     Вы не можете скачивать данный файл!
    </div>
    
   {else}
    
    {if $curfile_object->priced}
     <div>Файл предоставляется на платной основе</div>
     <div class="typelabel">
      Цена скачивание файла: <strong style="color: #008000">{$curfile_object->fileInfo.pricevalue} USD</strong>
     </div>
     <div style="font-size: 95%"><em>(копия файла отправляется на e-mail аккаунта)</em></div> 
     
     {if $curfile_object->fileInfo.pricefreefr}
     <div style="margin-top: 12px">Данный файл могут скачивать БЕСПЛАТНО только пользователи, состоящие в группах:</div>
     <div style="font-size: 95%">{$CONTROL_OBJ->GetGroupsListAsStr($curfile_object->fileInfo.pricefreefr, 'text-decoration: underline; color: #016C6C')}</div>
     <div style="margin-top: 4px">На данный момент Вы состоите в группах:</div>
     <div style="font-size: 95%">{if $curfile_object->usergroups.str}{$curfile_object->usergroups.str}{else}(вы не состоите в группах){/if}</div>
     <div style="font-size: 95%; color: #808080; margin-top: 2px"><em>(если Вы считаете, что должны состоять в указанных группах - попросите администратора добавить Вас в нужную группу используя <a href="{$smarty.const.W_SITEPATH}feedback/" target="_blank" style="font-size: 95%">обратную связь</a> `не забываете указывать логин`)</em></div> 
     {/if}  
    {/if}
   
   
   {/if}
    
    
    {if $curfile_object->showform}
    {literal}
    <script type="text/javascript">
	 
     function PrepereSend(th) {     
      {/literal}
      {if $curfile_object->priced}      
      if (!confirm('Вы действительно хотите скачать файл на платной основе?\r\nС Вашего баланса будет снята сумма в размере {$curfile_object->fileInfo.pricevalue} USD\r\nПродолжить?')) return false;     
      {/if}      
      {literal}        
      return true;  
     }
     
    </script>
    {/literal}
    <div style="margin-top: 14px">
    <form method="post" name="getfile" id="getfile" onsubmit="return PrepereSend(this)">  
     <input type="hidden" value="do" name="actiontogetfile" />
     <input type="submit" value="&nbsp;Скачать файл&nbsp;" class="button" name="rb" id="rb">
    </form>
    
    {if $smarty.post.actiontogetfile == 'do' && $curfile_object->error}
     <div style="margin-top: 12px; color: #FF0000">{$curfile_object->error}</div>
    {/if}
    
    </div>
    {/if}    
    
   
   </div>   
  </div>
  
 </div>  
 {/if} 