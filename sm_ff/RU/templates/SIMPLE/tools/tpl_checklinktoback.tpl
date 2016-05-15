{* проверка установленной ссылки *}
<div style="margin-top: 5px">
 <div style="margin-bottom: 12px">
  <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
  
  {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
  Данный инструмент поможет Вам проверить установленную на Ваш ресурс ссылку на указанных в списке сайтах (страницах) по выбранным критериям.
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
   $('#url').attr('disabled', disabled);  
   $('#nonoindex').attr('disabled', disabled);
   $('#nonofollow').attr('disabled', disabled);
   $('#norobots').attr('disabled', disabled);
   $('#norobotsf').attr('disabled', disabled);
   $('#txt').attr('disabled', disabled);    
  }//UpdateAdditionalObjects
  
  function ActionProcessStart(th) { 
   //check
   if (!$('#url').val()) {
    alert('Укажите ссылку, расположение которой необходимо проверить!');
    $('#url').focus();
	return false;		
   }  
   //next	  	   	
   var query = '&url='+ encodeURIComponent($('#url').val()) +             
               '&txt='+ encodeURIComponent($('#txt').val()) +
			   '&nonoindex='+((document.getElementById('nonoindex').checked) ? '1' : '0') + 
			   '&nonofollow='+((document.getElementById('nonofollow').checked) ? '1' : '0') + 
			   '&norobots='+((document.getElementById('norobots').checked) ? '1' : '0') + 
			   '&norobotsf='+((document.getElementById('norobotsf').checked) ? '1' : '0');    
   StartChecking('urls', false, true, query, 'UpdateAdditionalObjects');   	
  }//ActionProcessStart
  
 </script>
 <script type="text/javascript" src="{/literal}{$smarty.const.W_SITEPATH}{literal}athemes/SIMPLE/ajax_mass_tools.js"></script>
 {/literal}
<div class="typelabel"><label id="red">*</label> Список сайтов для проверки <label class="prep_label_analisys">(пример: <a href="javascript:" onclick="DoSetDefUrl('urls')">{$smarty.const.W_HOSTMYSITE}</a>, или <a href="javascript:" onclick="ClearVal('urls')">очистить</a> список)</label>{if isset($tool_object) && !$tool_object->IsNoLimitTool()}<span id="paysourcefornolimit">
, &nbsp;Не более: {$tool_object->GetLimitCount()}{if $CONTROL_OBJ->IsOnline()}, <label class="prep_label_analisys"><a href="javascript:" onclick="ProcessPayLimitOff('paysourcefornolimit')">Снять за (<label style="color: #000000">{$tool_object->GetToolLimitInfoEx('price')} USD</label>)</a></label>
{/if}{/if}</span></div>
  <div class="typelabel">  
   <textarea class="int_text" style="height: 100px; width: 95%" name="urls" id="urls">{$CONTROL_OBJ->GetPostElement('urls', 'doactiontool')}</textarea>
  </div>
  
  <div class="typelabel"><label id="red">*</label> Проверить расположение ссылки (пример: http://mysite.com)</div>
  <div class="typelabel"><input type="text" style="width: 95%" class="inpt" name="url" id="url"></div>
  
  <div class="typelabel"> Ссылка должна иметь указанный текст (пусто - не учитывается, регистр неважен)</div>
  <div class="typelabel"><input type="text" style="width: 95%" class="inpt" name="txt" id="txt"></div>
  
  <div class="typelabel">
   <input type="checkbox" checked="checked" style="cursor: pointer" name="nonoindex" id="nonoindex"><label for="nonoindex" style="cursor: pointer">&nbsp;Не должна находится в тэге &lt;noindex&gt;</label>
  </div>
  
  <div class="typelabel">
   <input type="checkbox" checked="checked" style="cursor: pointer" name="nonofollow" id="nonofollow"><label for="nonofollow" style="cursor: pointer">&nbsp;Не должна запрещать обход в параметре <b>rel</b> (nofollow)</label>
  </div>
  
  <div class="typelabel">
   <input type="checkbox" checked="checked" style="cursor: pointer" name="norobots" id="norobots"><label for="norobots" style="cursor: pointer">&nbsp;Мета тэг robots не должен запрещать индексацию страницы (noindex)</label>
  </div>
  
  <div class="typelabel">
   <input type="checkbox" checked="checked" style="cursor: pointer" name="norobotsf" id="norobotsf"><label for="norobotsf" style="cursor: pointer">&nbsp;Мета тэг robots не должен запрещать хождение по ссылкам страницы (nofollow)</label>
  </div>
  
<div class="typelabel">
   <input id="startb" type="submit" name="button" class="button" value="&nbsp;Начать проверку&nbsp;" 
   onclick="ActionProcessStart(this)">&nbsp;
   <input id="pauseb" disabled="disabled" type="button" name="Submit" class="button" value="&nbsp;Приостановить&nbsp;" onclick="PausedChecking()">&nbsp;
   <input id="stopb" disabled="disabled" type="button" name="Submit" class="button" value="&nbsp;Остановить&nbsp;" onclick="StopChecking()">
</div>
<div style="margin-top: 12px"></div>
  
<div id="getprocessedid"></div>

<div style="margin-top: 12px"></div>
<div id="processedsource"></div>
  
 {/if} 
</div>