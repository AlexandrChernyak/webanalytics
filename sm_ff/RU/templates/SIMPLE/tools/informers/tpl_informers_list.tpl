{* список информеров 
   $onselectiten - string (имя javascript - выбор идентификатора информера)
                   например: function DoSelectInformer(infid)
                   указать как: 'DoSelectInformer'
                   
                   По умолчанию - DoSelectInformerX
                   ставит идентификатор в <input type="hidden" name="selectedinformer" value="">
   
*}
<div style="margin-top: 5px">
 {literal}
 <script type="text/javascript">
 var globalimagepath = '{/literal}{$smarty.const.W_SITEPATH}tools/{$tool_object->section_id}/&getimage={literal}';
 var rppr = '{/literal}{if $tool_object->GetResult('rightstrparam')}{$tool_object->GetResult('rightstrparam')}{/if}{literal}';
 
 function ShHdBlElementL(th, ident) {	   
  var hd = ($('#'+ident).css('visibility') == 'hidden') ? true : false; 
  $(th).html((hd) ? 'Скрыть' : 'Показать');
  $('#'+ident).css('visibility', (hd) ? 'visible' : 'hidden');
  $('#'+ident).css('display', (hd) ? 'block' : 'none');
 }//ShHdBlElement
 function DoSelectInformerX(infid) {
  $('#selectedinformer').val(infid);	
 }//DoSelectInformerX 
 </script> 
 {/literal}
 
 {* обход по секциям *}
 {foreach from=$tool_object->GetResult('infdata') item=val name=val}
 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
 <b>{$val.section.secname}</b>
 <label style="color: #000000; margin-left: 6px">[
 <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElementL(this, 'blockL{$val.section.iditem}')">Скрыть</a>
 ]</label>
 </div>	  
 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="blockL{$val.section.iditem}">
  {if !$val.informers}
   <div style="margin-left: 4px">Информеры не обнаружены!</div>
  {else}
   {* обход всех информеров *}
   <span style="width: 100%">
    <table width="100%" cellpadding="0" cellspacing="0">
     {section name=trindex start=0 loop=$val.trcount step=1} 
      <tr>
	   {section name=tdindex start=0 loop=$val.tdcount step=1}
	    <td valign="center" align="left" style="padding: 3px">
		 {if !isset($val.informers[tdindex][trindex])}
		  &nbsp;
		 {else}
		  <div>
		   <span style="width: 100%">
		    <table width="100%" cellpadding="0" cellspacing="0">
		     <tr>
			  <td valign="center" align="center" style="padding: 3px; width: 24px"> 
			   <input type="radio" style="cursor: pointer" name="checkimage" id="imgid{$val.informers[tdindex][trindex].iditem}" onclick="{if $onselectiten}{$onselectiten}{else}DoSelectInformerX{/if}('{$val.informers[tdindex][trindex].iditem}')">
			  </td>
			  <td valign="center" align="left" style="padding: 3px">
			   <label for="imgid{$val.informers[tdindex][trindex].iditem}" style="cursor: pointer">
			    
				<div><img id="image_{$val.informers[tdindex][trindex].iditem}" src="{$smarty.const.W_SITEPATH}tools/{$tool_object->section_id}/&getimage={$val.informers[tdindex][trindex].iditem}{if $tool_object->GetResult('rightstrparam')}&rightstrparam={$tool_object->GetResult('rightstrparam')}{/if}"></div>
				
				{* имеется возможность смены цвета *}
				{if $val.informers[tdindex][trindex].usecolorselecter}
				<div style="margin-top: 4px" id="seldiv{$val.informers[tdindex][trindex].iditem}" title="#000000">
				 <a href="javascript:" id="selcolor{$val.informers[tdindex][trindex].iditem}" title="{$val.informers[tdindex][trindex].iditem}">Выбрать цвет</a>
				</div>
				<input type="hidden" value="" name="colorInput{$val.informers[tdindex][trindex].iditem}" id="colorInput{$val.informers[tdindex][trindex].iditem}">				
				{/if}			
				
							    
			   </label>
			  </td>
			 </tr>
		    </table>
		   </span>
		  </div>
		 {/if}		 
		</td>
	   {/section}
	  </tr>
     {/section}
    </table>
   </span>
   {* init all selectors *}
   
   {if $val.usecolorchangeids}
    {literal}
	<script type="text/javascript">      
     $('{/literal}{$CONTROL_OBJ->GenerateArrayString($val.usecolorchangeids, ', ', '#selcolor')}{literal}').ColorPicker({
	 onSubmit: function(hsb, hex, rgb, el) {	  
	  var id = $(el).attr('title');	
	  $('#seldiv'+id).attr('title', '#'+hex);
	  $('#colorInput'+id).val('#'+hex);  
	  $('#image_'+id).attr('src', globalimagepath + id + '&replc=_r_' + hex + ((rppr) ? '&rightstrparam=' + rppr : ''));	  
	  $(el).ColorPickerHide();
	 },
	 onBeforeShow: function () {	
	  $(this).ColorPickerSetColor($('#seldiv'+$(this).attr('title')).attr('title')); 
	 } })
    .bind('keyup', function(){ 
	  $(this).ColorPickerSetColor($('#seldiv'+$(this).attr('title')).attr('title')); 
	 });
    </script>
	{/literal}
   {/if}
   
  {/if}   
 </div>
 {/foreach} 
 <input type="hidden" value="" name="selectedinformer" id="selectedinformer">  
</div>