{* массовая проверка посещаемости *}
<div style="margin-top: 5px">
 <div style="margin-bottom: 12px">
  <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
  
  {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
  This tool will help you validate the value of the resource according to attendance <noindex><a rel="nofollow" target="_blank" href="http://liveinternet.ru">LiveInternet</a></noindex> per night.
  {/if}
  
  <div style="clear: both;"></div>
 </div>

 {if !$tool_object->canrun}
  <div style="margin-top: 25px">
  {if $tool_object->onlyforadmin}
  The tool is temporarily disabled by the administrator! We apologize for any inconvenience .. Please try again later.
  {else}  
  To use this tool requires authorization on the site. Please login or <a href="{$smarty.const.W_SITEPATH}register/" target="_blank">register</a> to gain access to the tool.
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
   $('#withimage').attr('disabled', disabled);	
  }	  	
  
  function ActionProcessStart(th) {	  	   	
   var query = '&withimage='+((document.getElementById('withimage').checked) ? '1' : '0');    
   StartChecking('urls', false, true, query, 'UpdateAdditionalObjects');	
  }	
 </script>
 <script type="text/javascript" src="{/literal}{$smarty.const.W_SITEPATH}{literal}js/ajax_mass_tools.js"></script>
 {/literal}
<div class="typelabel"><label id="red">*</label> Sites List <label class="prep_label_analisys">(example: <a href="javascript:" onclick="DoSetDefUrl('urls')">{$smarty.const.W_HOSTMYSITE}</a>, or <a href="javascript:" onclick="ClearVal('urls')">clean</a> list)</label>{if isset($tool_object) && !$tool_object->IsNoLimitTool()}<span id="paysourcefornolimit">
, &nbsp;No more: {$tool_object->GetLimitCount()}{if $CONTROL_OBJ->IsOnline()}, <label class="prep_label_analisys"><a href="javascript:" onclick="ProcessPayLimitOff('paysourcefornolimit')">Removed for (<label style="color: #000000">{$tool_object->GetToolLimitInfoEx('price')} USD</label>)</a></label>
{/if}{/if}</span></div>
<div class="typelabel">  
   <textarea class="int_text" style="height: 100px; width: 95%" name="urls" id="urls">{$CONTROL_OBJ->GetPostElement('urls', 'doactiontool')}</textarea>
  </div>
<div class="typelabel">
   <input id="startb" type="submit" name="button" class="button" value="&nbsp;Start Verification&nbsp;" 
   onclick="ActionProcessStart(this)">&nbsp;
   <input id="pauseb" disabled="disabled" type="button" name="Submit" class="button" value="&nbsp;Pause&nbsp;" onclick="PausedChecking()">&nbsp;
   <input id="stopb" disabled="disabled" type="button" name="Submit" class="button" value="&nbsp;Stop&nbsp;" onclick="StopChecking()">
   <span style="margin-left: 6px">
   <input type="checkbox" style="cursor: pointer" checked="checked" name="withimage" id="withimage"><label for="withimage" style="cursor: pointer">&nbsp;Display as image</label>
   </span>
</div>
<div style="margin-top: 12px"></div>
  
<div id="getprocessedid"></div>

<div style="margin-top: 12px"></div>
<div id="processedsource"></div>
 
 {/if} 
</div>