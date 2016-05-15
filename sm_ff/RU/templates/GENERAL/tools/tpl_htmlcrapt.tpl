{* зашифровка html *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам зашифровать html код в JavaScript код.
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
  <div class="typelabel"><label id="red">*</label> HTML текст для обработки</div>
  <div class="typelabel"> 
  
  <div><textarea class="int_text" style="height: 100px; width: 96%" name="source" id="source" onblur="OnBlurCorrect(this)" onclick="OnBlurCorrect(this)">{$CONTROL_OBJ->GetPostElement('source', 'doactiontool')}</textarea></div>
  {if $tool_object->GetToolLimitInfoEx('maxcharscount')}
   <div id="maxlensource" style="font-size: 90%">JavaScript не поддерживается</div>
  {/if}
   <div class="typelabel">
    <input type="submit" value="&nbsp;Отправить&nbsp;" class="button" name="rb" id="rb">
   </div> 
  </div>
  <input type="hidden" value="do" name="doactiontool">  
 </form>
 
 {if $tool_object->GetToolLimitInfoEx('maxcharscount')}
 {literal}
 <script type="text/javascript">
  var globalobj_count = {/literal}{$tool_object->GetToolLimitInfoEx('maxcharscount')}{literal};
   jQuery.fn.maxlength = function(options) {
   var settings = jQuery.extend({
    maxChars: globalobj_count, 
    leftChars: "осталось" 
   }, options);
   return this.each(function() {
     var me = $(this);
     var l = settings.maxChars;
     me.bind('keydown keypress keyup',function(e) {
      if(me.val().length>settings.maxChars) me.val(me.val().substr(0,settings.maxChars));
      l = settings.maxChars - me.val().length;
      $("#maxlen"+this.name).html(l + ' ' + settings.leftChars);
     });
     OnBlurCorrect(this);
    });
   }; 
   function OnBlurCorrect(th) {
    var me = $(th);
    var l = globalobj_count;
    var leftChars = "осталось";
    if(me.val().length>l) me.val(me.val().substr(0,l));
    l = l - me.val().length;
    $("#maxlen"+th.name).html(l + ' ' + leftChars);	
   }	
   $(document).ready(function(){ $("#source").maxlength();  });	
 </script>
 {/literal}
 {/if}
 
 {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  <div style="margin-top: 25px; padding: 2px 0 10px 0">
  
   {if !$tool_object->GetResult()}
    <div style="margin-left: 4px; color: #FF0000">Нет данных!</div>
   {else}  
    <div style="margin-top: 14px"><b style="color: #969696">Результат</b></div>
     <div style="margin-top: 10px">
      <textarea class="int_text" id="result" style="height: 120px; width: 96%">{$tool_object->GetResult('result')}</textarea>    
     </div>     	    	    
   {/if}  	    
          
  </div>  
 {/if}
 
 {/if} 
</div>