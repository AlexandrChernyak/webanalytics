{* удаление дубликатов строк *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам удалить дубликаты строк из текста.
 {/if}
 
 <div style="clear: both;"></div>
 </div>

 {if !$tool_object->canrun}
  <div style="margin-top: 25px">
  {if $tool_object->onlyforadmin}
  Инструмент временно отключен администратором! Приносим извинения за неудобства.. Пожалуйста, повторите попытку позже.
  {else}  
  Для использования данного инструмента требуется авторизация на сайте. Пожалуйста, авторизируйтесь или <a href="{$smarty.const.W_SITEPATH}register/" target="_blank">зарегистрируйтесь</a> для получения доступа к инструменту.
  {/if} 
  </div>
 {else}
 
 {literal}
 <script type="text/javascript">
  function PrepereToSend(th) {
   if (trim(th.source.value) == '') {
	alert('Укажите текст для обработки!');
	th.source.focus();
	return false;
   }
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;   
   return true;	
  }//PrepereToSend  	
 </script> 
 {/literal}
 <form method="post" name="tollform" id="toolform" onsubmit="return PrepereToSend(this)">
  <div class="typelabel"><label id="red">*</label> Текст для обработки</div>
  <div class="typelabel">   
  <div><textarea class="int_text" style="height: 100px; width: 96%" name="source" id="source">{$CONTROL_OBJ->GetPostElement('source', 'doactiontool')}</textarea></div>
  </div> 
  
  <div class="typelabel">
   <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('tolower')}checked="checked" {/if}style="cursor: pointer" name="tolower" id="tolower"><label for="tolower" style="cursor: pointer">&nbsp;Перевести в нижний регистр</label>
  </div>
  
  <div class="typelabel">
   <input type="submit" value="&nbsp;Отправить&nbsp;" class="button" name="rb" id="rb">
  </div> 
  <input type="hidden" value="do" name="doactiontool">  
 </form>
 
 {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  <div style="margin-top: 25px; padding: 2px 0 10px 0">
   {literal}
   <style type="text/css">
      .h_th1, .h_td, .h_td2 { 
       border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; border-right: none; 
       border-right: none; font-weight: bold; 
      }
      .h_td { border-left: none; }
      .h_td2 { border-right: 1px solid #E3E4E8; border-left: none; }
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
   
   {if !$tool_object->GetResult()}
    <div style="margin-left: 4px; color: #FF0000">Нет данных!</div>
   {else}  
    <div style="margin-top: 14px"><b style="color: #969696">Информация</b></div>
     <div style="margin-top: 10px">
      <span style="width: 100%">
       <table width="96%" cellpadding="0" cellspacing="0" border="0">
        
        <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
         <td class="sth1" valign="center" align="left" width="250px">
	      Строк в оригинале:	    
	     </td>	 
	     <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	      {$tool_object->GetResult('linesoriginal')}
	     </td>
        </tr>
        
        <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
         <td class="sth1" valign="center" align="left" width="250px">
	      Строк после обработки:	    
	     </td>	 
	     <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	      {$tool_object->GetResult('linesresult')}
	     </td>
        </tr>
        
        <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
         <td class="sth1" valign="center" align="left" width="250px">
	      Удалено строк:	    
	     </td>	 
	     <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	      <b>{$tool_object->GetResult('div')}</b>
	     </td>
        </tr>
         
       </table>
	  </span>    
     </div>     	    	    
   {/if}  	    
          
  </div>  
 {/if}
 
 {/if} 
</div>