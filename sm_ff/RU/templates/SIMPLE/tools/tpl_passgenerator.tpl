{* генератор паролей *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам выполнить генерацию пароля указанного размера и указанной сложности.
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
   if (trim(th.width.value) == '') {
	alert('Укажите длину пароля (не более 300)!');
	th.width.focus();
	return false;
   }
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;   
   return true;	
  }//PrepereToSend  	
 </script>
 {/literal}
 <form method="post" name="tollform" id="toolform" onsubmit="return PrepereToSend(this)">
  <div class="typelabel"><label id="red">*</label> Длина пароля (макс: 300)</div>
  <div class="typelabel">
  <input type="text" value="{$CONTROL_OBJ->GetPostElement('width', 'doactiontool', 'do', '10')}" style="width: 370px" maxlength="300" class="inpt" name="width" id="width"> 
  </div>
   
  <div class="typelabel"> При генерации пароля использовать язык</div>
  <div class="typelabel">
  <select size="1" style="width: 380px" id="lang" name="lang">
   <option{if $smarty.post.lang == '0'} selected="selected"{/if} value="0">Английский и русский</option>
   <option{if $smarty.post.doactiontool != 'do' || $smarty.post.lang == '1'} selected="selected"{/if} value="1">Английский</option>
   <option{if $smarty.post.lang == '2'} selected="selected"{/if} value="2">Русский</option>   
  </select>
  </div>
  
  <div class="typelabel"> При генерации пароля использовать регистр символов</div>
  <div class="typelabel">
  <select size="1" style="width: 380px" id="casedata" name="casedata">
   <option{if $smarty.post.doactiontool != 'do' || $smarty.post.casedata == '0'} selected="selected"{/if} value="0">Верхний и нижний регистры</option>
   <option{if $smarty.post.casedata == '1'} selected="selected"{/if} value="1">Только верхний регистр</option>
   <option{if $smarty.post.casedata == '2'} selected="selected"{/if} value="2">Только нижний регистр</option>   
  </select>
  </div>
  
  <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('controlsym')}checked="checked" {/if}style="cursor: pointer" name="controlsym" id="controlsym"><label for="controlsym" style="cursor: pointer">&nbsp;Использовать управляющие символы</label>
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('numb')}checked="checked" {/if}style="cursor: pointer" name="numb" id="numb"><label for="numb" style="cursor: pointer">&nbsp;Использовать цифры</label>
   </div>
   
  <div class="typelabel"> Генерация хэша из результата генерации пароля</div>
  <div class="typelabel">
  <select size="1" style="width: 380px" id="hashcreate" name="hashcreate">
   <option{if $smarty.post.doactiontool != 'do' || !$smarty.post.hashcreate} selected="selected"{/if} value="">Не хэшировать результат</option>
   {foreach from=$tool_object->GetHashList() item=val name=val} 
    <option{if $smarty.post.hashcreate == $val} selected="selected"{/if} value="{$val}">{$val}</option>   
   {/foreach}    
  </select>
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
   
   <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
   <b>Сгенерированный пароль</b>
   <label style="color: #000000; margin-left: 6px">[
   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'block1')">Скрыть</a>]</label>
   </div>
   <div style="margin-top: 12px; width: 95%; padding-left: 6px; overflow: auto; height: auto; width: 500px" id="block1">
    <div style="margin-top: 10px; color: #0000FF; font-size: 120%; padding: 5px">
     {$tool_object->GetResult('data')}    
    </div>
   </div>
  
   <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
   <b>Сгенерированный пароль (текстом)</b>
   <label style="color: #000000; margin-left: 6px">[
   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'block2')">Показать</a>]</label>
   </div>
   <div style="margin-top: 12px; width: 95%; padding-left: 6px; display: none; visibility: hidden" id="block2">
    <div style="margin-top: 10px">
     <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('data')}</textarea>    
    </div>
   </div>
        
  </div>  
 {/if}
 
 {/if} 
</div>