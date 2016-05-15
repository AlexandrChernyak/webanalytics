{* нанесение текста на изображение *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам наложить указанный текст на любое изображение с указанными параметрами с сохранением прозрачности  основного изображения.
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
   //$('#globalbodydata').css('cursor', 'wait');
   //th.rb.disabled = true;   
   return true;	
  }//PrepereToSend
  
  function AddNewValueSizeTo(th) {
   if (th.value) { return ; }	
   var textdata = prompt("Укажите новый размер числом! (Пример: 14)", "12");
   if (!textdata || !IisInteger(textdata, 300)) { 
   	alert('Укажите числовое значение от 1 до 300!');
   	return ;
   }
   var ob = $(th);
   ob.append('<option selected="selected" value="'+ textdata + '">' + textdata + 'px</option>');   	
  }//AddNewValueTo 
  
  function AddNewValuePositionTo(th, val) {
   if (th.value) { return ; }	
   var textdata = prompt("Укажите координату по "+ val +"! (Пример: 10)", "10");
   if (!textdata || !IisInteger(textdata, 300)) { 
   	alert('Укажите числовое значение!');
   	return ;
   }
   var ob = $(th);
   ob.append('<option selected="selected" value="'+ textdata + '">' + val + ': ' + textdata + 'px</option>');	
  }//AddNewValuePositionTo
   	
 </script>
 {/literal}
 <form method="post" name="tollform" id="toolform" enctype="multipart/form-data" onsubmit="return PrepereToSend(this)">
  <div class="typelabel"><label id="red">*</label> Файл изображения (форматы: {$tool_object->GetListTypes()}){if $tool_object->GetResult('maxsize')},<label style="margin-left: 6px">[Максимальный размер: <b>{$tool_object->GetResult('maxsize')}</b>]</label>{/if}</div>
  
  <div class="typelabel"> 
   <input type="file" size="20" style="width: 430px; height: 22px" class="inpt" name="image" id="image">  
  </div>
  <div class="typelabel"><label id="red">*</label> Наложить текст на изображение</div>
  <div class="typelabel">
   <input type="text" value="{$smarty.const.W_HOSTMYSITE}" style="width: 430px" class="inpt" name="txt" id="txt">
  </div>  
  
  <div class="typelabel"> Размер текста</div>
  <div class="typelabel">
   <select id="fontsize" name="fontsize" onchange="AddNewValueSizeTo(this)" style="width: 284px">
    <option value="10">10px</option>
    <option value="12">12px</option>
    <option value="16">16px</option>
    <option value="18">18px</option>
    <option value="28">28px</option>
    <option value="30">30px</option>
    <option selected="selected" value="32">32px</option>
    <option value="48">48px</option>
    <option value="72">72px</option>
    <option value="" style="color: #0000FF">Указать свой размер</option>    
   </select>
  </div>
  
  <div class="typelabel"><label id="red">*</label> Цвет текста</div>
  <div class="typelabel">
   <input type="text" value="#C0C0C0" style="width: 280px" class="inpt" name="color" id="color">
   <label style="margin-left: 6px; color: #FFFFFF; background: #C0C0C0" id="colorlabel" for="color">&nbsp;color&nbsp;</label>
  </div> 
  
  <div class="typelabel"><label id="red">*</label> Непрозрачность текста (в процентах "<b>%</b>", <br />
  &nbsp; от 0 до 100, 100 - без прозрачности)</div>
  <div class="typelabel">
   <input type="text" value="70" style="width: 280px" class="inpt" name="transperent" id="transperent">
  </div>
  
  <div class="typelabel"><label id="red">*</label> Угол наклона текста "градусов" (0 - горизонтально)</div>
  <div class="typelabel">
   <input type="text" value="0" style="width: 280px" class="inpt" name="angle" id="angle">
  </div>
  
  <div class="typelabel"> Шрифт текста</div>
  <div class="typelabel">
   <select id="textfont" name="textfont" style="width: 284px">
    <option selected="selected" value="0">Arial</option>
    {foreach from=$tool_object->GetResult('fonts') item=val name=val}
	 <option value="{$val.iditem}">{$tool_object->substr($val.fontname, 0, -4)}</option>	 
	{/foreach}    
   </select>
  </div> 
  
  <div class="typelabel"> Положение текста (горизонтально)</div>
  <div class="typelabel">
   <select id="textpositionX" name="textpositionX" onchange="AddNewValuePositionTo(this,'X')" style="width: 284px">
    <option value="left">Слева</option>
    <option value="center">По центру</option>
    <option selected="selected" value="right">Справа</option>    
    <option value="" style="color: #0000FF">Указать свои координаты</option>    
   </select>
  </div>
  
  <div class="typelabel"> Положение текста (вертикально)</div>
  <div class="typelabel">
   <select id="textpositionY" name="textpositionY" onchange="AddNewValuePositionTo(this,'Y')" style="width: 284px">
    <option value="top">Вверху</option>
    <option value="center">По центру</option>
    <option selected="selected" value="down">Внизу</option>    
    <option value="" style="color: #0000FF">Указать свои координаты</option>    
   </select>
  </div>
  
  <div class="typelabel"><label id="red">*</label> Отступ от края изображения (px, пример: 10)</div>
  <div class="typelabel">
   <input type="text" value="10" style="width: 280px" class="inpt" name="border" id="border">
  </div> 
  
  
  
  
  <div class="typelabel">
   <input type="submit" value="&nbsp;Отправить&nbsp;" class="button" name="rb" id="rb">
  </div> 
  <input type="hidden" value="do" name="doactiontool">
  
  <div style="margin-top: 20px">Пример наложения текста на изображение:</div>
  <div class="typelabel">
   <img src="{$smarty.const.W_SITEPATH}img/items/texttoimagepreview.jpg">
  </div>
    
 </form> 
 {literal}
 <script type="text/javascript">
 $('#color').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		$(el).val('#'+hex);
		$('#colorlabel').css('background', '#'+hex);
		$(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor(this.value);
	}
 })
 .bind('keyup', function(){
	$(this).ColorPickerSetColor(this.value);
 });	
</script>
 {/literal}
 
 {if $smarty.post.doactiontool == 'do' && isset($tool_object) && $tool_object->error}
  <div style="margin-top: 37px">
   <b style="color: #FF0000">{$tool_object->error}</b>     
  </div>  
 {/if}
 
 {/if} 
</div>