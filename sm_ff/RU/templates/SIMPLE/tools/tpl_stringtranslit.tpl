{* транслит переводчик текста *}
<div style="margin-top: 5px">
 {literal}
 <style type="text/css">
  .td_x { width: 17px; text-align: center }	
 </style>
 {/literal}
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам перевести текст в транслит и обратно.
 <br /><br /><br /><br /><br />
 Преобразование в транслит происходит по схеме:<br />
 <div style="margin-top: 6px">
 <span style="width: 100%">
 <table width="98%" cellpadding="0" cellspacing="0">
 <tr>
	<td class="td_x">А</td>
	<td class="td_x">Б</td>
	<td class="td_x">В</td>
	<td class="td_x">Г</td>
	<td class="td_x">Д</td>
	<td class="td_x">Е</td>
	<td class="td_x">Ё</td>
	<td class="td_x">Ж</td>
	<td class="td_x">З</td>
	<td class="td_x">И</td>
	<td class="td_x">Й</td>
	<td class="td_x">К</td>
	<td class="td_x">Л</td>
	<td class="td_x">М</td>
	<td class="td_x">Н</td>
	<td class="td_x">О</td>
	<td class="td_x">П</td>
	<td class="td_x">Р</td>
	<td class="td_x">С</td>
	<td class="td_x">Т</td>
	<td class="td_x">У</td>
	<td class="td_x">Ф</td>
	<td class="td_x">Х</td>
	<td class="td_x">Ц</td>
	<td class="td_x">Ч</td>
	<td class="td_x">Ш</td>
	<td class="td_x">Щ</td>
	<td class="td_x">Ъ</td>
	<td class="td_x">Ы</td>
	<td class="td_x">Ь</td>
	<td class="td_x">Э</td>
	<td class="td_x">Ю</td>
	<td class="td_x">Я</td>
</tr>
<tr>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
	<td class="td_x"><img src="{$smarty.const.W_SITEPATH}img/items/arrow_2.png" width="16" height="16"></td>
</tr>
<tr>
	<td class="td_x">A</td>
	<td class="td_x">B</td>
	<td class="td_x">V</td>
	<td class="td_x">G</td>
	<td class="td_x">D</td>
	<td class="td_x">E</td>
	<td class="td_x">YO</td>
	<td class="td_x">ZH</td>
	<td class="td_x">Z</td>
	<td class="td_x">I</td>
	<td class="td_x">I'</td>
	<td class="td_x">K</td>
	<td class="td_x">L</td>
	<td class="td_x">M</td>
	<td class="td_x">N</td>
	<td class="td_x">O</td>
	<td class="td_x">P</td>
	<td class="td_x">R</td>
	<td class="td_x">S</td>
	<td class="td_x">T</td>
	<td class="td_x">U</td>
	<td class="td_x">F</td>
	<td class="td_x">H</td>
	<td class="td_x">C</td>
	<td class="td_x">CH</td>
	<td class="td_x">SH</td>
	<td class="td_x">SCH</td>
	<td class="td_x">`</td>
	<td class="td_x">Y</td>
	<td class="td_x">'</td>
	<td class="td_x">JE</td>
	<td class="td_x">YU</td>
	<td class="td_x">YA</td>
</tr>
</table>
 </span>
 </div>
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
  
  <textarea class="int_text" style="height: 100px; width: 96%" name="source" id="source">{$CONTROL_OBJ->GetPostElement('source', 'doactiontool')}</textarea>
  
  <div class="typelabel">
   <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('back')}checked="checked" {/if}style="cursor: pointer" name="back" id="back"><label for="back" style="cursor: pointer">&nbsp;Перевести из транслита</label>
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