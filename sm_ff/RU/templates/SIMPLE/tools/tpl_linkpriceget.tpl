{* оценка стоимости ссылки с сайта *}
<div style="margin-top: 5px">
 <div style="margin-bottom: 12px">
  <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
  
  {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
  Данный инструмент поможет Вам определить предварительную стоимость размещения ссылки на Вашем сайте по параметрам ТиЦ и PR с учетом УВ 1,2,3 на срок - 1 месяц.
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
  	
  function DoSetDefUrl(ident) {
   var str = {/literal}'{$smarty.const.W_HOSTMYSITE}';{literal}
   var obj = $('#'+ident);
   var sou = trim(obj.val());
   obj.val(((sou == '') ? '' : sou + "\r\n") + str); 
   obj.focus();  	
  }//DoSetDefUrl
  function ClearVal(ident) { $('#'+ident).val(''); $('#'+ident).focus(); }
  
  function UpdateAdditionalObjects(disabled) { 
   $('#uv2').attr('disabled', disabled); 
   $('#uv3').attr('disabled', disabled);
  }
  function ActionProcessStart(th) {   	   	
   var query = '&uv2='+((document.getElementById('uv2').checked) ? '1' : '0')+
               '&uv3='+((document.getElementById('uv3').checked) ? '1' : '0');
   StartChecking('urls', false, true, query, 'UpdateAdditionalObjects');   	
  }//ActionProcessStart	
 </script>
 <script type="text/javascript" src="{/literal}{$smarty.const.W_SITEPATH}{literal}athemes/SIMPLE/ajax_mass_tools.js"></script>
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
   
   
   <span style="margin-left: 12px"><input disabled="disabled" type="checkbox" checked="checked" style="cursor: pointer" name="uv1" id="uv1"><label style="cursor: pointer">&nbsp;УВ 1</label></span>
   <span style="margin-left: 12px"><input type="checkbox" checked="checked" style="cursor: pointer" name="uv2" id="uv2"><label for="uv2" style="cursor: pointer">&nbsp;УВ 2</label></span>
   <span style="margin-left: 12px"><input type="checkbox" checked="checked" style="cursor: pointer" name="uv3" id="uv3"><label for="uv3" style="cursor: pointer">&nbsp;УВ 3</label></span>
   
</div>
<div style="margin-top: 12px"></div>
  
<div id="getprocessedid"></div>

<div style="margin-top: 12px"></div>
<div id="processedsource"></div>
 
 {/if} 
</div>