{* генератор заголовков *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам сгенерировать лист уникальных заголовков для сайта.
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
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;   
   return true;	
  }//PrepereToSend  	
 </script>
 {/literal}
 <form method="post" name="tollform" id="toolform" onsubmit="return PrepereToSend(this)">
  
  
  <div class="typelabel">
  <span style="width: 100%">
   <table width="100%" cellpadding="0" cellspacing="0">
   <tr>
	<td valign="top" align="left" style="padding-right: 4px">
	 <div class="typelabel">Список начал заголовков (по 1 на строку)</div>
	 <div class="typelabel">
	  <textarea class="int_text" style="height: 100px; width: 96%" name="leftlinks" id="leftlinks">{$CONTROL_OBJ->GetPostElement('leftlinks', 'doactiontool')}</textarea>
	 </div>
	</td>
	<td valign="top" align="left" style="padding-right: 4px">
	 <div class="typelabel">Список середин заголовков</div>
	 <div class="typelabel">
	  <textarea class="int_text" style="height: 100px; width: 96%" name="centerlinks" id="centerlinks">{$CONTROL_OBJ->GetPostElement('centerlinks', 'doactiontool')}</textarea>
	 </div>	
	</td>
	<td valign="top" align="left" style="padding-right: 4px">
	 <div class="typelabel">Список концовок заголовков</div>
	 <div class="typelabel">
	  <textarea class="int_text" style="height: 100px; width: 96%" name="rightlinks" id="rightlinks">{$CONTROL_OBJ->GetPostElement('rightlinks', 'doactiontool')}</textarea>
	 </div>	
	</td>
   </tr>
   </table>
  </span>
  </div>
  

  <div class="typelabel">
   <input type="submit" value="&nbsp;Отправить&nbsp;" class="button" name="rb" id="rb">
  </div> 
  <input type="hidden" value="do" name="doactiontool">  
 </form>
 {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  <div style="margin-top: 25px">
   {literal}
   <script type="text/javascript">
	function ShHdBlElement(th, ident) {	   
	 var hd = ($('#'+ident).css('visibility') == 'hidden') ? true : false; 
	 $(th).html((hd) ? 'Скрыть' : 'Показать');
	 $('#'+ident).css('visibility', (hd) ? 'visible' : 'hidden');
	 $('#'+ident).css('display', (hd) ? 'block' : 'none');
	}//ShHdBlElement
   </script>
   {/literal}
   
    <div style="padding-bottom: 6px; border-bottom: 1px solid #003366"><b>Результат генерации</b>
     <label style="color: #000000; margin-left: 6px">(Всего: {$tool_object->GetResult('count')})</label>
	 <label style="color: #000000; margin-left: 6px">[
	 <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'block1')">Показать</a>]</label>
	</div>
	<div id="block1" style="overflow: auto; margin-top: 12px; display: none; visibility: hidden">
	 {foreach from=$tool_object->GetResult('list') item=val name=val}
	  {if $smarty.foreach.val.index > 0}<div style="margin-top: 12px; margin-bottom: 12px"></div>{/if}	  
	  <div>#<b>{$tool_object->GetIndex($smarty.foreach.val.index)}.</b></div>
	  <div style="margin-top: 4px">	   
	   {$val}
	  </div>
	 {/foreach}
	</div>
   
    <div style="padding-bottom: 6px; border-bottom: 1px solid #003366; margin-top: 34px"><b>Результат списком</b>
     <label style="color: #000000; margin-left: 6px">(Всего: {$tool_object->GetResult('count')})</label>
	 <label style="color: #000000; margin-left: 6px">[
	 <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'block2')">Скрыть</a>]</label>
	</div>
	<div id="block2" style="overflow: auto; margin-top: 12px">
	 <textarea class="int_text" style="height: 120px; width: 98%">{$tool_object->GetResult('liststring')}</textarea>
	</div>  
          
  </div>  
 {/if}
 
 {/if} 
</div>