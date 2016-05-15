{* CSS Sprites *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool helps you combine multiple images into one for later use them with CSS. Unites in a single image, css code generated <ins>background-position:</ins> so that you can take any of the merged images. It is used to prevent loading of multiple images, thus increasing the speed of the page (download only one picture, instead of, for example 5)
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
      return alert('You can only use up to {/literal}{$tool_object->msximagescount}{literal} images!');   
    }
        
    countallff++;
    
    $('#moreimageslist').append(
     '<div class="typelabel" id="img'+incerallimagesfiles+'">' +
     
     '<input type="file" size="20" style="width: 430px; height: 22px" class="inpt" name="image'+
     countallff+'" id="image'+countallff+'">' +
     
     '<label style="padding-left: 5px">' +
     '<a href="javascript:" onclick="DeleteImageFile(\'img'+incerallimagesfiles+'\')">Delete</a>' +
     '</label>' +
     
     '</div>'
    );
    
    incerallimagesfiles++;
    $('#countimageslst').val(countallff);    
   } //AddNewImageFile 	
  </script>
  {/literal}  
  <form method="post" name="tollform" id="toolform" enctype="multipart/form-data" onsubmit="return PrepereToSend(this)">

   <div class="typelabel"> The image files (formats: {$tool_object->GetListTypes()}){if $tool_object->GetResult('maxsize')},<label style="margin-left: 6px">[ The maximum size of one image: <b>{$tool_object->GetResult('maxsize')}</b> ]</label>{/if}</div>
   
   <div class="typelabel">
    <input type="file" size="20" style="width: 430px; height: 22px" class="inpt" name="image1" id="image1">   
   </div>
  
   <div class="typelabel">
    <input type="file" size="20" style="width: 430px; height: 22px" class="inpt" name="image2" id="image2">   
   </div>
   
   <div id="moreimageslist"></div>
   
   <div class="typelabel"><a href="javascript:" onclick="AddNewImageFile()">Add Image</a></div>
   
   <div class="typelabel" style="margin-top: 22px; background: #F0F0F0; padding: 2px"><strong>Settings</strong></div>
   
   <div class="typelabel" style="padding-left: 2px;">Image Padding (at px)</div>
   <div class="typelabel" style="padding-left: 2px;">
    <input type="text" value="2" style="width: 200px" class="inpt" name="padimage" id="padimage">
   </div>
   
   <div class="typelabel" style="padding-left: 2px;">The background color of final image (empty - transparent background, or color in hex format)</div>
   <div class="typelabel" style="padding-left: 2px;">
    <input type="text" value="" style="width: 200px" class="inpt" name="bgcol" id="bgcol">
    <label style="margin-left: 6px; color: #FFFFFF" id="colorlabel" for="color">&nbsp;color&nbsp;</label>
   </div>
   
   <div class="typelabel" style="padding-left: 2px;">Final Image format</div>
   <div class="typelabel" style="padding-left: 2px;">
    <select size="1" style="width: 205px" name="imagettp">
	 <option value=".png">PNG</option>
     <option value=".gif">GIF</option>
     <option value=".jpg">JPG (not transparent)</option>     
    </select>
   </div>
   
   <div class="typelabel" style="padding-left: 2px;">The direction of association (on order of final image)</div>
   <div class="typelabel" style="padding-left: 2px;">
    <select size="1" style="width: 205px" name="imagealign">
	 <option value="vertical">Vertically (top to bottom)</option>
     <option value="gorizontal">Horizontally (left to right)</option>     
    </select>
   </div>
   
   <div class="typelabel" style="padding-left: 2px; margin-top: 12px">
    <input type="checkbox" style="cursor: pointer" name="setwh" id="setwh" /><label for="setwh" style="cursor: pointer;">&nbsp;Add parameters Width and Height in the positioning (in parameter style)</label>
   </div>
   
   <div class="typelabel" style="margin-top: 22px; background: #F0F0F0; padding: 2px"><strong>Run</strong></div>
   <div style="font-size: 95%; padding-left: 2px">Images whose size exceeds the maximum - skipped.</div>
   
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