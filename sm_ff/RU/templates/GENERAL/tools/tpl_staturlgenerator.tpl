{* генератор статических url *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам сгенерировать статические URL взамен стандартных представлений ссылок.<br />
 <br /><br /><br />
 При указании ссылки используйте следующие варианты:<br /><br />
 1) Указание конкретных имен переменных и их значений:<br />
 Пример: index.php?var1=<b>value1</b>&var2=<b>value2</b>&var3=<b>value3</b><br />
 В таком случае ссылка будет неизменной.
 <br /><br />
 2) Динамическое указание значений переменных (для этого просто оставьте значения переменных пустыми):<br />
 Пример: <u>index.php?var1=&var2=&var3=</u>   или  <u>index.php?var1=&var2=value2&var3=</u><br />
 В таком случае ссылка будет строится по варианту: путь/<b>значение1</b>/<b>значение2</b>/<b>значениеN</b>/
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
	alert('Укажите список URL для преобразования!');
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
  <div class="typelabel"><label id="red">*</label> Список URL для преобразования (по одному на строку){if $tool_object->GetToolLimitInfoEx('maxurlcount')}<label style="font-size: 95%; margin-left: 6px">[макс. <u>{$tool_object->GetToolLimitInfoEx('maxurlcount')}</u>]</label>{/if}</div>
  <div class="typelabel"> 
  
  <textarea class="int_text" style="height: 100px; width: 96%" name="source" id="source">{$CONTROL_OBJ->GetPostElement('source', 'doactiontool')}</textarea>
  
  <div class="typelabel">
   <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('wR')}checked="checked" {/if}style="cursor: pointer" name="wR" id="wR"><label for="wR" style="cursor: pointer">&nbsp;Возвращать как редирект с кодом (флаг R)</label>
  </div>
  
  <div class="typelabel">
   <input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('wL')}checked="checked" {/if}style="cursor: pointer" name="wL" id="wL"><label for="wL" style="cursor: pointer">&nbsp;Считать текущую ссылку окончательной (флаг L)</label>
  </div>
  
   <div class="typelabel">
    <input type="submit" value="&nbsp;Отправить&nbsp;" class="button" name="rb" id="rb">
   </div> 
  </div>
  <input type="hidden" value="do" name="doactiontool">  
 </form>
 {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  <div style="margin-top: 25px">
   
   <div style="margin-top: 14px">
    <b style="color: #969696">Результат</b>
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 96%">{$tool_object->GetResult('result')}</textarea>    
   </div>  
          
  </div>  
 {/if}
 
 {/if} 
</div>