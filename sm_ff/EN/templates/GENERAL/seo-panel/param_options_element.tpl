{* 
  блок настроек параметра 

*}
{literal}<script type="text/javascript">var listidents_db = new Array();</script>{/literal}
{$PANEL_CONTROL->RestoreTempIdents()}
{$PANEL_CONTROL->RestoreTempIdents(1)}
<div style="margin-bottom: 4px; border-bottom: 1px solid #C0C0C0"></div>
<div id="eleentdatafromfilegeneratedl" paramdataid="{$val.id}">
 <div>To configure the test: <b style="color: #000080">{$val.data.name}</b></div>
 <div style="margin-top: 6px">
  {foreach from=$val.data key=ident item=value name=value}
   {if $PANEL_CONTROL->CanConfThisOpt($ident)}
   
    {if $ident == 'colorminus'}   
     <div class="typelabel">Color negative deviation</div>    
     <div class="typelabel">
      <input type="text" class="inpt" style="width: 350px" name="{$ident}_elemcc" id="{$ident}_elemcc" value="{$value}" maxlength="7"><label for="{$ident}_elemcc" id="{$ident}_elemcc_label" style="margin-left: 6px; cursor: pointer; color: {if !$value}#000000{else}{$value}{/if}">color</label>
     </div>   
     {$PANEL_CONTROL->AddTempIdents($ident, 'elemcc')}
	 {literal}<script type="text/javascript">listidents_db.push({iden: '{/literal}{$ident}{literal}_elemcc', type: 'text'});</script>{/literal} 
	    
    {elseif $ident == 'colorplus'}   
	 <div class="typelabel">Color positive deviation</div>    
     <div class="typelabel">
      <input type="text" class="inpt" style="width: 350px" name="{$ident}_elemcc" id="{$ident}_elemcc" value="{$value}" maxlength="7"><label for="{$ident}_elemcc" id="{$ident}_elemcc_label" style="margin-left: 6px; cursor: pointer; color: {if !$value}#000000{else}{$value}{/if}">color</label>
     </div>   
     {$PANEL_CONTROL->AddTempIdents($ident, 'elemcc')}
     {literal}<script type="text/javascript">listidents_db.push({iden: '{/literal}{$ident}{literal}_elemcc', type: 'text'});</script>{/literal}
     
    {elseif $ident == 'color'}
	 <div class="typelabel">Color core values</div>    
     <div class="typelabel">
      <input type="text" class="inpt" style="width: 350px" name="{$ident}_elemcc" id="{$ident}_elemcc" value="{$value}" maxlength="7"><label for="{$ident}_elemcc" id="{$ident}_elemcc_label" style="margin-left: 6px; cursor: pointer; color: {if !$value}#000000{else}{$value}{/if}">color</label>
     </div>   
     {$PANEL_CONTROL->AddTempIdents($ident, 'elemcc')}
     {literal}<script type="text/javascript">listidents_db.push({iden: '{/literal}{$ident}{literal}_elemcc', type: 'text'});</script>{/literal}
     
	{elseif $ident == 'bgcolor'}
	 <div class="typelabel">The background color of the column</div>    
     <div class="typelabel">
      <input type="text" class="inpt" style="width: 350px" name="{$ident}_elemcc" id="{$ident}_elemcc" value="{$value}" maxlength="7"><label for="{$ident}_elemcc" id="{$ident}_elemcc_label" style="margin-left: 6px; cursor: pointer; color: {if !$value}#000000{else}{$value}{/if}">color</label>
     </div>
     {$PANEL_CONTROL->AddTempIdents($ident, 'elemcc')}
     {literal}<script type="text/javascript">listidents_db.push({iden: '{/literal}{$ident}{literal}_elemcc', type: 'text'});</script>{/literal}
     
    {elseif $ident == 'colorno'} 
	 <div class="typelabel">Color `<b>No</b>`</div>    
     <div class="typelabel">
      <input type="text" class="inpt" style="width: 350px" name="{$ident}_elemcc" id="{$ident}_elemcc" value="{$value}" maxlength="7"><label for="{$ident}_elemcc" id="{$ident}_elemcc_label" style="margin-left: 6px; cursor: pointer; color: {if !$value}#000000{else}{$value}{/if}">color</label>
     </div>
     {$PANEL_CONTROL->AddTempIdents($ident, 'elemcc')}
     {literal}<script type="text/javascript">listidents_db.push({iden: '{/literal}{$ident}{literal}_elemcc', type: 'text'});</script>{/literal}
     
    {elseif $ident == 'coloryes'} 
	 <div class="typelabel">Color `<b>Yes</b>`</div>    
     <div class="typelabel">
      <input type="text" class="inpt" style="width: 350px" name="{$ident}_elemcc" id="{$ident}_elemcc" value="{$value}" maxlength="7"><label for="{$ident}_elemcc" id="{$ident}_elemcc_label" style="margin-left: 6px; cursor: pointer; color: {if !$value}#000000{else}{$value}{/if}">color</label>
     </div>
     {$PANEL_CONTROL->AddTempIdents($ident, 'elemcc')}
     {literal}<script type="text/javascript">listidents_db.push({iden: '{/literal}{$ident}{literal}_elemcc', type: 'text'});</script>{/literal}
	 
	{elseif $ident == 'showdiffdays'}
	 <div class="typelabel">	  
	  <input type="checkbox" style="cursor: pointer" name="{$ident}_ch_sel_param" id="{$ident}_ch_sel_param"{if $value} checked="checked"{/if}><label for="{$ident}_ch_sel_param" style="cursor: pointer">&nbsp;Show departure days</label>
	 </div>
	 {$PANEL_CONTROL->AddTempIdents($ident, 'elem', 1)}
	 {literal}<script type="text/javascript">listidents_db.push({iden: '{/literal}{$ident}{literal}_ch_sel_param', type: 'checkbox'});</script>{/literal}
	
	{elseif $ident == 'width'}	 
	 <div class="typelabel">Column Width (for URL is <u>min-width</u>)</div>    
     <div class="typelabel">
      <input type="text" class="inpt" style="width: 98%" name="{$ident}_elemwidth" id="{$ident}_elemwidth" value="{$value}" maxlength="10">
     </div>
     {$PANEL_CONTROL->AddTempIdents($ident, 'elem', 1)}
     {literal}<script type="text/javascript">listidents_db.push({iden: '{/literal}{$ident}{literal}_elemwidth', type: 'text'});</script>{/literal}
	
	{elseif $ident == 'nodisplaydiff'}
	 <div class="typelabel">	  
	  <input type="checkbox" style="cursor: pointer" name="{$ident}_ch_sel_param" id="{$ident}_ch_sel_param"{if $value} checked="checked"{/if}><label for="{$ident}_ch_sel_param" style="cursor: pointer">&nbsp;Do not show deviation values</label>
	 </div>
	 {$PANEL_CONTROL->AddTempIdents($ident, 'elem', 1)}
	 {literal}<script type="text/javascript">listidents_db.push({iden: '{/literal}{$ident}{literal}_ch_sel_param', type: 'checkbox'});</script>{/literal}
	 
	{elseif $ident == 'returnasstring'}
	 <div class="typelabel">	  
	  <input type="checkbox" style="cursor: pointer" name="{$ident}_ch_sel_param" id="{$ident}_ch_sel_param"{if $value} checked="checked"{/if}><label for="{$ident}_ch_sel_param" style="cursor: pointer">&nbsp;Return a numeric value as `<b>Yes</b>` / `<b>No</b>`</label>
	 </div>
	 {$PANEL_CONTROL->AddTempIdents($ident, 'elem', 1)}
	 {literal}<script type="text/javascript">listidents_db.push({iden: '{/literal}{$ident}{literal}_ch_sel_param', type: 'checkbox'});</script>{/literal}
	 
	{elseif $ident == 'canwrap'}
	 <div class="typelabel">	  
	  <input type="checkbox" style="cursor: pointer" name="{$ident}_ch_sel_param" id="{$ident}_ch_sel_param"{if $value} checked="checked"{/if}><label for="{$ident}_ch_sel_param" style="cursor: pointer">&nbsp;Allow the word wrap in cell</label>
	 </div>
	 {$PANEL_CONTROL->AddTempIdents($ident, 'elem', 1)}
	 {literal}<script type="text/javascript">listidents_db.push({iden: '{/literal}{$ident}{literal}_ch_sel_param', type: 'checkbox'});</script>{/literal}
	 
	{elseif $ident == 'swithifdayslost'}
	 <div class="typelabel">Change the color of minus to plus when days left:</div>    
     <div class="typelabel">
      <input type="text" class="inpt" style="width: 98%" name="{$ident}_elemwidth" id="{$ident}_elemwidth" value="{$value}" maxlength="10">
     </div>
     {$PANEL_CONTROL->AddTempIdents($ident, 'elem', 1)}
     {literal}<script type="text/javascript">listidents_db.push({iden: '{/literal}{$ident}{literal}_elemwidth', type: 'text'});</script>{/literal}
	  
	{elseif $ident == 'yxmllogin'}
	 <div class="typelabel">Login to Y.XML to be used for the parameter. (overrides the global settings panel Y.xml if empty - or use the global setting, or not used at all)</div>    
     <div class="typelabel">
      <input type="text" class="inpt" style="width: 98%" name="{$ident}_elemwidth" id="{$ident}_elemwidth" value="{$value}" maxlength="100">
     </div>
     {$PANEL_CONTROL->AddTempIdents($ident, 'elem', 1)}
     {literal}<script type="text/javascript">listidents_db.push({iden: '{/literal}{$ident}{literal}_elemwidth', type: 'text'});</script>{/literal}
     
    {elseif $ident == 'yxmlkey'}
	 <div class="typelabel">Api key Y.XML to be used for parameter</div>    
     <div class="typelabel">
      <input type="text" class="inpt" style="width: 98%" name="{$ident}_elemwidth" id="{$ident}_elemwidth" value="{$value}" maxlength="100">
     </div>
     {$PANEL_CONTROL->AddTempIdents($ident, 'elem', 1)}
     {literal}<script type="text/javascript">listidents_db.push({iden: '{/literal}{$ident}{literal}_elemwidth', type: 'text'});</script>{/literal}
	  
	{elseif $ident == 'nouseyandexxml'}
	 <div class="typelabel">	  
	  <input type="checkbox" style="cursor: pointer" name="{$ident}_ch_sel_param" id="{$ident}_ch_sel_param"{if $value} checked="checked"{/if}><label for="{$ident}_ch_sel_param" style="cursor: pointer">&nbsp;Prohibit the use of all possible settings for this option Yandex.XML</label>
	 </div>
	 {$PANEL_CONTROL->AddTempIdents($ident, 'elem', 1)}
	 {literal}<script type="text/javascript">listidents_db.push({iden: '{/literal}{$ident}{literal}_ch_sel_param', type: 'checkbox'});</script>{/literal}
	 
	{elseif $ident == 'align'}
	 <div class="typelabel">Align in cell</div>    
     <div class="typelabel">
      <input type="text" class="inpt" style="width: 98%" name="{$ident}_elemwidth" id="{$ident}_elemwidth" value="{$value}" maxlength="10">
     </div>	 
     {$PANEL_CONTROL->AddTempIdents($ident, '_elem', 1)}
     {literal}<script type="text/javascript">listidents_db.push({iden: '{/literal}{$ident}{literal}_elemwidth', type: 'text'});</script>{/literal}
    
    {/if}   
   {/if}
  {/foreach}
 </div>
</div>
{if $PANEL_CONTROL->tempcolorlisten}

 <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/colordlg/colorpicker.js"></script>	       
 <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/colordlg/eye.js"></script>	       
 <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/colordlg/utils.js"></script>	       
 <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/colordlg/layout.js?ver=1.0.2"></script>   
 
 {literal}
 <script type="text/javascript">      
  $('{/literal}{$CONTROL_OBJ->GenerateArrayString($PANEL_CONTROL->tempcolorlisten, ', ', '#')}{literal}').ColorPicker({
  onSubmit: function(hsb, hex, rgb, el) {		       
   $(el).val('#'+hex); 
   var lb = $(el).attr('id')+'_label';    
   $('#'+lb).css('color', '#'+hex);	  
   $(el).ColorPickerHide();
  },
  onBeforeShow: function () {   		
   $(this).ColorPickerSetColor($(this).val()); 
  } })
  .bind('keyup', function(){ 
   $(this).ColorPickerSetColor($(this).val()); 
  });
  
  function ProcessSaveAllElements() {
   var query = '{/literal}dataid={$val.id}{literal}';    
   for (var i=0; i<listidents_db.length; i++) {   	
    if (!listidents_db[i]) { continue; }
    
    query += ((query) ? '&' : '');
    query += (listidents_db[i].iden+'=');
    
    switch (listidents_db[i].type) {
	 case 'checkbox': query += (($('#'+listidents_db[i].iden).attr('checked')) ? 1 : 0); break;
	 default: query += encodeURIComponent($('#'+listidents_db[i].iden).val()); break;	 	
	}	
   }
   return query;  
  }//ProcessSaveAllElements
 </script>
 {/literal}
{/if} 