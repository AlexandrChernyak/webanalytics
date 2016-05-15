{* CSS Sprites *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам объединить несколько изображений в одно для последующего использования их с помощью CSS. Изображения объеденяются в одно, css код генерируется с <ins>background-position:</ins> так, чтобы можно было взять любую из объединяемых изображений. Используется для предотвращения загрузки нескольких изображений, тем самым увеличивая скорость отображения страницы (загружается всего одна картинка, вместо, например 5)
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
  <div style="margin-top: 25px">

  {literal}
  <script type="text/javascript">
   function PrepereToSend(th) {
    //$('#globalbodydata').css('cursor', 'wait');
    //th.rb.disabled = true;   
    return true;	
   }//PrepereToSend 
   
   var incerallimagesfiles = 3;
   
   function DeleteImageFile(idm) {
    var countallff = $('#countimageslst').val();
    countallff--;
    $('#'+idm).remove(); 
    $('#countimageslst').val(countallff);   
   }//DeleteImageFile
   
   function AddNewImageFile() {    
    var countallff = $('#countimageslst').val();
        
    if (countallff >= {/literal}{$tool_object->msximagescount}{literal}) {
      return alert('Вы можете использовать только до {/literal}{$tool_object->msximagescount}{literal} изображений!');   
    }
        
    countallff++;
    
    $('#moreimageslist').append(
     '<div class="typelabel" id="img'+incerallimagesfiles+'">' +
     
     '<input type="file" size="20" style="width: 430px; height: 22px" class="inpt" name="image'+
     countallff+'" id="image'+countallff+'">' +
     
     '<label style="padding-left: 5px">' +
     '<a href="javascript:" onclick="DeleteImageFile(\'img'+incerallimagesfiles+'\')">Удалить</a>' +
     '</label>' +
     
     '</div>'
    );
    
    incerallimagesfiles++;
    $('#countimageslst').val(countallff);    
   } //AddNewImageFile 	
  </script>
  {/literal}  
  <form method="post" name="tollform" id="toolform" enctype="multipart/form-data" onsubmit="return PrepereToSend(this)">

   <div class="typelabel"> Файлы изображений (форматы: {$tool_object->GetListTypes()}){if $tool_object->GetResult('maxsize')},<label style="margin-left: 6px">[ Максимальный размер одного изображения: <b>{$tool_object->GetResult('maxsize')}</b> ]</label>{/if}</div>
   
   <div class="typelabel">
    <input type="file" size="20" style="width: 430px; height: 22px" class="inpt" name="image1" id="image1">   
   </div>
  
   <div class="typelabel">
    <input type="file" size="20" style="width: 430px; height: 22px" class="inpt" name="image2" id="image2">   
   </div>
   
   <div id="moreimageslist"></div>
   
   <div class="typelabel"><a href="javascript:" onclick="AddNewImageFile()">Добавить изображение</a></div>
   
   <div class="typelabel" style="margin-top: 22px; background: #F0F0F0; padding: 2px"><strong>Параметры</strong></div>
   
   <div class="typelabel" style="padding-left: 2px;">Отступ между изображениями (в px)</div>
   <div class="typelabel" style="padding-left: 2px;">
    <input type="text" value="2" style="width: 200px" class="inpt" name="padimage" id="padimage">
   </div>
   
   <div class="typelabel" style="padding-left: 2px;">Цвет фона финального изображения (пусто - прозрачный фон, или цвет в hex формате)</div>
   <div class="typelabel" style="padding-left: 2px;">
    <input type="text" value="" style="width: 200px" class="inpt" name="bgcol" id="bgcol">
    <label style="margin-left: 6px; color: #FFFFFF" id="colorlabel" for="color">&nbsp;color&nbsp;</label>
   </div>
   
   <div class="typelabel" style="padding-left: 2px;">Формат финального изображения</div>
   <div class="typelabel" style="padding-left: 2px;">
    <select size="1" style="width: 205px" name="imagettp">
	 <option value=".png">PNG</option>
     <option value=".gif">GIF</option>
     <option value=".jpg">JPG (без прозрачности)</option>     
    </select>
   </div>
   
   <div class="typelabel" style="padding-left: 2px;">Направление объединения (порядок на финальном изображении)</div>
   <div class="typelabel" style="padding-left: 2px;">
    <select size="1" style="width: 205px" name="imagealign">
	 <option value="vertical">Вертикально (сверху вниз)</option>
     <option value="gorizontal">Горизонтально (с лева на право)</option>     
    </select>
   </div>
   
   <div class="typelabel" style="padding-left: 2px; margin-top: 12px">
    <input type="checkbox" style="cursor: pointer" name="setwh" id="setwh" /><label for="setwh" style="cursor: pointer;">&nbsp;Добавить параметры Width и Height в позиционирование (в параметр style)</label>
   </div>
   
   <div class="typelabel" style="margin-top: 22px; background: #F0F0F0; padding: 2px"><strong>Выполнить</strong></div>
   <div style="font-size: 95%; padding-left: 2px">Изображения, чей размер превышает максимум - пропускаются.</div>
   
   <div class="typelabel" style="margin-top: 20px;">
    <input type="submit" value="&nbsp;Отправить&nbsp;" class="button" name="rb" id="rb">
   </div>
   
  
   <input type="hidden" value="do" name="doactiontool">
   <input type="hidden" value="2" name="countimageslst" id="countimageslst">
  </form>

 {if $smarty.post.doactiontool == 'do' && isset($tool_object) && $tool_object->error}
  <div style="margin-top: 37px">
   <b style="color: #FF0000">{$tool_object->error}</b>     
  </div>  
 {/if}

 {literal}
 <script type="text/javascript">
 $('#bgcol').ColorPicker({
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
  
  </div>  
 {/if} 
</div>