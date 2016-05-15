{* генератор ключевых слов с сайта *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам Выполнить генерацию `потенциальных` ключевых слов для Вашего сайта, взяв за основу текст с указанного Вами сайта. Будут выбраны наиболее весомые слова текста.
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
  function DoSetDefUrl(ident) {
   var str = {/literal}'{$smarty.const.W_HOSTMYSITE}';{literal}
   var obj = $('#'+ident);
   obj.val(str); 
   obj.focus();  	
  }//DoSetDefUrl
  function PrepereToSend(th) {
   if (trim(th.url.value) == '') {
	alert('Укажите хост сайта!');
	th.url.focus();
	return false;
   }
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;   
   return true;	
  }//PrepereToSend  	
 </script>
 {/literal}
 <form method="post" name="tollform" id="toolform" onsubmit="return PrepereToSend(this)">
  <div class="typelabel"><label id="red">*</label> URL сайта <label class="prep_label_analisys">(пример: <a href="javascript:" onclick="DoSetDefUrl('url')">{$smarty.const.W_HOSTMYSITE}</a>)</label>
  <label style="margin-left: 6px; font-size: 95%">[обрабатываются {if !$tool_object->GetToolLimitInfoEx('allwordsforuse') || $tool_object->GetToolLimitInfoEx('allwordsforuse') < 0}<u>все слова</u>{else}<u>{$tool_object->GetToolLimitInfoEx('allwordsforuse')} слов</u>{/if}]</label></div>
  <div class="typelabel">  
   <input type="text" value="{$CONTROL_OBJ->GetPostElement('url', 'doactiontool')}" style="width: 98%" class="inpt" name="url" id="url">
   
   <div class="typelabel">
    <input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('getfrombody')}checked="checked" {/if}style="cursor: pointer" name="getfrombody" id="getfrombody"><label for="getfrombody" style="cursor: pointer">&nbsp;Взять текст из тэга &lt;body&gt; (если тэг существует)</label>
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('ignorestopwords')}checked="checked" {/if}style="cursor: pointer" name="ignorestopwords" id="ignorestopwords"><label for="ignorestopwords" style="cursor: pointer">&nbsp;Игнорировать стоп-слова</label>
   </div>
   
   <div class="typelabel" style="margin-top: 10px">Разделять ключевые слова блоком (пробелы учитываются)</div>
   <div class="typelabel">
    <input type="text" value="{$CONTROL_OBJ->GetPostElement('separator', 'doactiontool', 'do', ', ')}" style="width: 250px" class="inpt" name="separator" id="separator">
   </div> 
   
   <div class="typelabel">Генерировать ключевые слова в количестве</div>
   <div class="typelabel">
    <input type="text" value="{$CONTROL_OBJ->GetPostElement('usecount', 'doactiontool', 'do', '18')}" style="width: 250px" class="inpt" name="usecount" id="usecount">
   </div>
   
   <div class="typelabel">Минимальное количество символов в анализируемом слове</div>
   <div class="typelabel">
    <input type="text" value="{$CONTROL_OBJ->GetPostElement('minlenght', 'doactiontool', 'do', '3')}" style="width: 250px" class="inpt" name="minlenght" id="minlenght">
   </div>
   
   <div class="typelabel">
    <input type="submit" value="&nbsp;Отправить&nbsp;" class="button" name="rb" id="rb">
   </div> 
  </div>
  <input type="hidden" value="do" name="doactiontool">  
 </form>
 {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  {include file="tools/keygeneratorurl/tpl_result_keygen.tpl"}
 {/if}
 
 {/if} 
</div>