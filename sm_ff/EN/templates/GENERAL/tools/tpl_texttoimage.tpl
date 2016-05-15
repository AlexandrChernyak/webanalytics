{* нанесение текста на изображение *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool will help you apply the specified text to any image with the specified parameters while preserving the transparency of the main image.
 {/if}
  
 <div style="clear: both;"></div>
 </div>

 {if !$tool_object->canrun}
  <div style="margin-top: 25px">
  {if $tool_object->onlyforadmin}
  The tool is temporarily disabled by administrator! We apologize for any inconvenience .. Please try again later.
  {else}  
  To use this tool requires authorization on the site. Please login or <a href="{$smarty.const.W_SITEPATH}register/" target="_blank">register</a> to gain access to the tool.
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
   var textdata = prompt("Specify the new size number! (Example: 14)", "12");
   if (!textdata || !IisInteger(textdata, 300)) { 
   	alert('Specify a numeric value from 1 to 300!');
   	return ;
   }
   var ob = $(th);
   ob.append('<option selected="selected" value="'+ textdata + '">' + textdata + 'px</option>');   	
  }//AddNewValueTo 
  
  function AddNewValuePositionTo(th, val) {
   if (th.value) { return ; }	
   var textdata = prompt("Specify coordinate of "+ val +"! (Example: 10)", "10");
   if (!textdata || !IisInteger(textdata, 300)) { 
   	alert('Specify numeric value!');
   	return ;
   }
   var ob = $(th);
   ob.append('<option selected="selected" value="'+ textdata + '">' + val + ': ' + textdata + 'px</option>');	
  }//AddNewValuePositionTo
   	
 </script>
 {/literal}
 <form method="post" name="tollform" id="toolform" enctype="multipart/form-data" onsubmit="return PrepereToSend(this)">
  <div class="typelabel"><label id="red">*</label> Image file (formats: {$tool_object->GetListTypes()}){if $tool_object->GetResult('maxsize')},<label style="margin-left: 6px">[Maximum size: <b>{$tool_object->GetResult('maxsize')}</b>]</label>{/if}</div>
  
  <div class="typelabel"> 
   <input type="file" size="20" style="width: 430px; height: 22px" class="inpt" name="image" id="image">  
  </div>
  <div class="typelabel"><label id="red">*</label> Overlay text on an image</div>
  <div class="typelabel">
   <input type="text" value="{$smarty.const.W_HOSTMYSITE}" style="width: 430px" class="inpt" name="txt" id="txt">
  </div>  
  
  <div class="typelabel"> Text size</div>
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
    <option value="" style="color: #0000FF">Specify your size</option>    
   </select>
  </div>
  
  <div class="typelabel"><label id="red">*</label> Text color</div>
  <div class="typelabel">
   <input type="text" value="#C0C0C0" style="width: 280px" class="inpt" name="color" id="color">
   <label style="margin-left: 6px; color: #FFFFFF; background: #C0C0C0" id="colorlabel" for="color">&nbsp;color&nbsp;</label>
  </div> 
  
  <div class="typelabel"><label id="red">*</label> Opacity of text (percentage "<b>%</b>", <br />
  &nbsp; from 0 to 100, 100 - no transparency)</div>
  <div class="typelabel">
   <input type="text" value="70" style="width: 280px" class="inpt" name="transperent" id="transperent">
  </div>
  
  <div class="typelabel"><label id="red">*</label> Angle of text "degrees" (0 - horizontal)</div>
  <div class="typelabel">
   <input type="text" value="0" style="width: 280px" class="inpt" name="angle" id="angle">
  </div>
  
  <div class="typelabel"> Text font</div>
  <div class="typelabel">
   <select id="textfont" name="textfont" style="width: 284px">
    <option selected="selected" value="0">Arial</option>
    {foreach from=$tool_object->GetResult('fonts') item=val name=val}
	 <option value="{$val.iditem}">{$tool_object->substr($val.fontname, 0, -4)}</option>	 
	{/foreach}    
   </select>
  </div> 
  
  <div class="typelabel"> Position of text (horizontally)</div>
  <div class="typelabel">
   <select id="textpositionX" name="textpositionX" onchange="AddNewValuePositionTo(this,'X')" style="width: 284px">
    <option value="left">Left</option>
    <option value="center">Center</option>
    <option selected="selected" value="right">Right</option>    
    <option value="" style="color: #0000FF">Set your position</option>    
   </select>
  </div>
  
  <div class="typelabel"> Position of text (vertically)</div>
  <div class="typelabel">
   <select id="textpositionY" name="textpositionY" onchange="AddNewValuePositionTo(this,'Y')" style="width: 284px">
    <option value="top">Top</option>
    <option value="center">Center</option>
    <option selected="selected" value="down">Down</option>    
    <option value="" style="color: #0000FF">Set your position</option>    
   </select>
  </div>
  
  <div class="typelabel"><label id="red">*</label> Away from edge of image (px, example: 10)</div>
  <div class="typelabel">
   <input type="text" value="10" style="width: 280px" class="inpt" name="border" id="border">
  </div> 
  
  
  
  
  <div class="typelabel">
   <input type="submit" value="&nbsp;Send&nbsp;" class="button" name="rb" id="rb">
  </div> 
  <input type="hidden" value="do" name="doactiontool">
  
  <div style="margin-top: 20px">Example text overlay on image:</div>
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