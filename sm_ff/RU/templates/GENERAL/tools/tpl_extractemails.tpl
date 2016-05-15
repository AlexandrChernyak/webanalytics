{* извлечение e-mail адресов *}
<div style="margin-top: 5px">
 <div style="margin-bottom: 12px">
  <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
  
  {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
  Данный инструмент поможет Вам извлечь все e-mail адреса с указанных web страниц.
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
  var PathHost = '{/literal}{$smarty.const.W_SITEPATH}{literal}';
  var PathRequstAction = PathHost + 'tools/{/literal}{$tool_object->section_id}{literal}/';
  var ErrorsList = new Array();
  ErrorsList['nocorrectpage']      = '{/literal}{$CONTROL_OBJ->GetText("nocorrectpage")}{literal}';
  ErrorsList['nourlsforanalize']   = '{/literal}{$CONTROL_OBJ->GetText("nourlsforanalize")}{literal}';
  ErrorsList['gotonextitemlist']   = '{/literal}{$CONTROL_OBJ->GetText("gotonextitemlist")}{literal}';
  ErrorsList['ispausedactionbe']   = '{/literal}{$CONTROL_OBJ->GetText("ispausedactionbe", $tool_object->GetLimitCount())}{literal}';
  ErrorsList['ispausedonactionl']  = '{/literal}{$CONTROL_OBJ->GetText("ispausedonactionl")}{literal}';
  ErrorsList['isprocessactionit']  = '{/literal}{$CONTROL_OBJ->GetText("isprocessactionit")}{literal}';
  ErrorsList['preperetostartajax'] = '{/literal}{$CONTROL_OBJ->GetText("preperetostartajax")}{literal}';
  ErrorsList['preptopausedajms']   = '{/literal}{$CONTROL_OBJ->GetText("preptopausedajms")}{literal}';
  ErrorsList['actionisstoppedb']   = '{/literal}{$CONTROL_OBJ->GetText("actionisstoppedb")}{literal}';
  ErrorsList['actionisfinishedb']  = '{/literal}{$CONTROL_OBJ->GetText("actionisfinishedb")}{literal}';
  ErrorsList['actiontopaynolimit'] = '{/literal}{$CONTROL_OBJ->GetText("actiontopaynolimit", $tool_object->GetToolLimitInfoEx("price"))}{literal}';
  ErrorsList['actiontopayststusq'] = '{/literal}{$CONTROL_OBJ->GetText("actiontopayststusq")}{literal}';
  
  var id_count_value = 0;
  	
  function DoSetDefUrl(ident) {
   var str = {/literal}'{$smarty.const.W_HOSTMYSITE}';{literal}
   var obj = $('#'+ident);
   var sou = trim(obj.val());
   obj.val(((sou == '') ? '' : sou + "\r\n") + str); 
   obj.focus();  	
  }//DoSetDefUrl
  function ClearVal(ident) { $('#'+ident).val(''); $('#'+ident).focus(); }
  
  function UpdateAdditionalObjects(disabled) { 
   //$('#asoriginal').attr('disabled', disabled); 
  }
  function ActionProcessStart(th) { 
   id_count_value = 0;
   ShowCountValue();
   $('#source').val('');
   $('#block1').html('');
   VisibleBlocks(false);   
   //next	  	   	
   var query = '';//&asoriginal='+((document.getElementById('asoriginal').checked) ? '1' : '0');
   StartChecking('urls', false, true, query, 'UpdateAdditionalObjects');   	
  }//ActionProcessStart	
  
  function VisibleBlocks(vis) {
   $('#allblocks').css('visibility', (vis) ? 'visible' : 'hidden');
   $('#allblocks').css('display', (vis) ? 'block' : 'none');	
  }//VisibleBlocks
  
  //добавление элемента результата
  function AddNewItemData(str) {
   if (id_count_value == 0) { VisibleBlocks(true); }
   //add
   $('#source').val($('#source').val() + str + "\r\n");
   $('#block1').append(
    '<div style="margin-top: 6px"><b>#' + (id_count_value+1) + '</b>' +
	'<label style="margin-left: 5px">' + str + '</label></div>'
   );  	
   ShowCountValue(1);	
  }//AddNewItemData
  
  function ShowCountValue(incer) {
   if (incer) { id_count_value++; }	
   $('#idcount').html((!id_count_value) ? '0' : id_count_value);	
  }//ShowCountValue
 </script>
 <script type="text/javascript" src="{/literal}{$smarty.const.W_SITEPATH}{literal}js/ajax_mass_tools.js"></script>
 {/literal}
<div class="typelabel"><label id="red">*</label> Список сайтов <label class="prep_label_analisys">(пример: <a href="javascript:" onclick="DoSetDefUrl('urls')">{$smarty.const.W_HOSTMYSITE}</a>, или <a href="javascript:" onclick="ClearVal('urls')">очистить</a> список)</label>{if isset($tool_object) && !$tool_object->IsNoLimitTool()}<span id="paysourcefornolimit">
, &nbsp;Не более: {$tool_object->GetLimitCount()}{if $CONTROL_OBJ->IsOnline()}, <label class="prep_label_analisys"><a href="javascript:" onclick="ProcessPayLimitOff('paysourcefornolimit')">Снять за (<label style="color: #000000">{$tool_object->GetToolLimitInfoEx('price')} USD</label>)</a></label>
{/if}{/if}</span></div>
<div class="typelabel">  
   <textarea class="int_text" style="height: 100px; width: 95%" name="urls" id="urls">{$CONTROL_OBJ->GetPostElement('urls', 'doactiontool')}</textarea>
  </div>
<div class="typelabel">
   <input id="startb" type="submit" name="button" class="button" value="&nbsp;Начать проверку&nbsp;" 
   onclick="ActionProcessStart()">&nbsp;
   <input id="pauseb" disabled="disabled" type="button" name="Submit" class="button" value="&nbsp;Приостановить&nbsp;" onclick="PausedChecking()">&nbsp;
   <input id="stopb" disabled="disabled" type="button" name="Submit" class="button" value="&nbsp;Остановить&nbsp;" onclick="StopChecking()">
   
   
   <!--
<span style="margin-left: 12px"><input type="checkbox" checked="checked" style="cursor: pointer" name="asoriginal" id="asoriginal"><label for="asoriginal" style="cursor: pointer">&nbsp;В оригинальном варианте</label></span>
-->
   
</div>
<div style="margin-top: 12px"></div>
  
<div id="getprocessedid"></div>

<div style="margin-top: 12px"></div>
<div id="processedsource"></div>

{literal}
<script type="text/javascript">
 function ShHdBlElement(th, ident) {	   
  var hd = ($('#'+ident).css('visibility') == 'hidden') ? true : false; 
  $(th).html((hd) ? 'Скрыть' : 'Показать');
  $('#'+ident).css('visibility', (hd) ? 'visible' : 'hidden');
  $('#'+ident).css('display', (hd) ? 'block' : 'none');
 }//ShHdBlElement
 
 function DoRemoveRepeatItems(th) {
  var stb = document.getElementById('startb');
  if (stb && stb.disabled) {
   alert('В данный момент идет выполнение инструмента! Дождитесь окончания операции..');
   return false;
  }	
  try {	  	
   th.disabled = true;
   $('#globalbodydata').css('cursor', 'wait');
   $(th).css('cursor', 'wait');
   //action
   var arr = new Array();
   var spsource  = $('#source').val().replace(/\r\n|\r|\n/g,':bbbrr:');
   arr = GetCorretArray(spsource.split(':bbbrr:'));
   $('#source').val('');
   id_count_value = 0;
   for (var i=0; i < arr.length; i++) {  	
   	$('#source').val($('#source').val() + arr[i] + "\r\n");
	id_count_value++;     	
   }	
  } finally {
   	$('#globalbodydata').css('cursor', 'auto');
   	$(th).css('cursor', 'auto');
   	ShowCountValue();
	th.disabled = false;
  }	
 }//DoRemoveRepeatItems	
</script>
{/literal}
     
     <div style="margin-top: 24px">
	 Всего получено элементов: <label id="idcount" style="font-weight: bold;">0</label>
	 </div>
	 
     <div style="display: none; visibility: hidden" id="allblocks">

     <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Результат обработки всех элементов</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'block1')">Показать</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px; display: none; visibility: hidden" id="block1">
	  	  
	 </div>
	 
	 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Результат обработки всех элементов (списком)</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'block2')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px;" id="block2">
	   <textarea class="int_text" style="height: 120px; width: 98%" name="source" id="source"></textarea>
	   <div class="typelabel">
        <input id="norepeat" type="submit" name="norepeat" class="button" value="&nbsp;Удалить повторы&nbsp;" onclick="DoRemoveRepeatItems(this)">
       </div>	   	  
	 </div>
     </div>
 
 {/if}
</div>