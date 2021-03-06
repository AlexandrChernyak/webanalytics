<script type="text/javascript">var identifier_link = '{$ident}';</script>
 
 <link rel="stylesheet" href="{$smarty.const.W_SITEPATH}css/colordlg/colorpicker.php" media="screen" type="text/css">
 
 <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/colordlg/colorpicker.js"></script>	       
 <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/colordlg/eye.js"></script>	       
 <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/colordlg/utils.js"></script>	       
 <script type="text/javascript" src="{$smarty.const.W_SITEPATH}js/colordlg/layout.js?ver=1.0.2"></script> 
 
{literal}
 <script type="text/javascript"> 
  function GetID(s) { return '#q'+s+'_'+identifier_link; }
  var list_ids_ids = new Array();
  list_ids_ids['66'] = 'bo';
  list_ids_ids['73'] = 'ital';
  list_ids_ids['85'] = 'under';
  list_ids_ids['76'] = 'link';
  list_ids_ids['77'] = 'image';
  list_ids_ids['81'] = 'quote';
  list_ids_ids['38'] = 'resup';
  list_ids_ids['40'] = 'resdw'; 
   
  var list_ids = new Array();
  list_ids['bo']    = GetID(list_ids_ids['66']);
  list_ids['ital']  = GetID(list_ids_ids['73']);
  list_ids['under'] = GetID(list_ids_ids['85']);
  list_ids['link']  = GetID(list_ids_ids['76']);
  list_ids['image'] = GetID(list_ids_ids['77']);
  list_ids['quote'] = GetID(list_ids_ids['81']);
  list_ids['resup'] = GetID(list_ids_ids['38']);
  list_ids['resdw'] = GetID(list_ids_ids['40']);
  
  var isseted = 0;
  var inceritems = 0;

  document.body.onkeydown = function() {  	
   if (event.ctrlKey && event.keyCode != 17 && list_ids_ids[event.keyCode]) {
   if (isseted == 0) {	 		
    var dom = typeof(window.addEventListener) == "function";
    var ie = typeof(window.attachEvent) == "object";   
    function handle_q(evt) {
     //if (evt.ctrlKey) {  alert(evt.keyCode); }		
     if (evt.ctrlKey && evt.keyCode != 17 && list_ids_ids[evt.keyCode]) {
      if (dom) {
       evt.preventDefault();
       //alert('dom');
      } else if (ie) {
   	   //alert('ie');
       evt.returnValue = false;
      }
      $(list_ids[list_ids_ids[evt.keyCode]]).click();  		
     }		
    } 
    if (dom) {		
	 window.addEventListener("keypress", handle_q, false); 
	 isseted = 1; 
	} 
	else if (ie) {	 
	 document.attachEvent("onkeydown", handle_q); 
	 isseted = 1; 
	}	 
	inceritems++;	   
   }
   }	
  };
    
  function InitializeList() {    	
   //ids events
   $(list_ids['bo']).click(function(){
    InsertObhvatData('[B]', '[/B]', identifier_link);   
   });
   $(list_ids['ital']).click(function(){
    InsertObhvatData('[I]', '[/I]', identifier_link);   
   });
   $(list_ids['under']).click(function(){
    InsertObhvatData('[U]', '[/U]', identifier_link);   
   });   
   
   $(list_ids['link']).click(function(){	
	var hrefdata =  prompt ("Введите адрес ссылки!", "http://" );
    if (!hrefdata || hrefdata == null || hrefdata.toLowerCase() == "http://") { return ; }
    InsertObhvatData('[URL="'+hrefdata+'"]',"[/URL]", identifier_link);	   
   }); 
   
   $(list_ids['image']).click(function(){
    InsertPic(identifier_link);
	//InsertObhvatData('[IMG]', '[/IMG]', identifier_link);   
   });
   
   $(GetID('hide')).click(function(){ 
	InsertHide(identifier_link);	   
   });
   
   $(GetID('size')).click(function(){ 
	InsertSizeData(identifier_link);	   
   });
   
   $(GetID('php')).click(function(){ 
	InsertObhvatData('[PHP]', '[/PHP]', identifier_link);	   
   });
   
   $(GetID('xml')).click(function(){ 
	InsertObhvatData('[XML]', '[/XML]', identifier_link);	   
   });
   
   $(GetID('ml')).click(function(){ 
	var pdata =  prompt("Укажите отступ слева (без px)!", "5" );
    if (!pdata || pdata == null || pdata == '0' || !IisInteger(pdata, 2000)) { return ; }
    InsertObhvatData('[PADDING="'+pdata+'"]',"[/PADDING]", identifier_link);	   
   });
   
   $(GetID('pre')).click(function(){ 
	InsertObhvatData('[PRE]', '[/PRE]', identifier_link);	   
   });
   
   
   $(GetID('color2')).ColorPicker({
    onSubmit: function(hsb, hex, rgb, el) {		            
      InsertColor('#'+hex, identifier_link);	  
      $(el).ColorPickerHide();
     }
    } 
   );   
   //$(GetID('color2')).click(function(){ 
	   
   //});
   
   $(list_ids['quote']).click(function(){
    InsertObhvatData('[QUOTE]', '[/QUOTE]', identifier_link);   
   });
   $(list_ids['resdw']).click(function(){
    var h = $('#'+identifier_link).css("height");
    h = h.replace(/px/g, '');
    h = Number(h) + 20;    
	$('#'+identifier_link).css("height",h+'px');		   
   });
   $(list_ids['resup']).click(function(){
    var h = $('#'+identifier_link).css("height");
    h = h.replace(/px/g, '');
    h = Number(h) - 20;    
    $('#'+identifier_link).css("height",h+'px');	   
   });
  }
  $(document).ready(function(){ InitializeList(); });   	
 </script>
{/literal}
<div class="text_borders" style="{if isset($width)}width: {$width}{else}width: 100%{/if}">
 <span style="width: 100%">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
   <td colspan="1" valign="top" align="left">
    <div class="heat_titles_b">
	<span style="width: 100%">
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
	 <td align="left" valign="top" class="buttons_head">
	  <span id="qbo_{$ident}" style="margin-left: 0px" title="Жирный (Ctrl+B)">
	  <img src="{$smarty.const.W_SITEPATH}img/ico/formats/bold.gif"></span>
	  <span id="qital_{$ident}" title="Наклонный (Ctrl+I)">
	  <img src="{$smarty.const.W_SITEPATH}img/ico/formats/italic.gif"></span>
	  <span id="qunder_{$ident}" title="Подчеркнутый (Ctrl+U)">
	  <img src="{$smarty.const.W_SITEPATH}img/ico/formats/underline.gif"></span>
	  <label><img src="{$smarty.const.W_SITEPATH}img/ico/formats/separator.gif"></label>
	  <span id="qlink_{$ident}" title="Ссылка (Ctrl+L)">
	  <img src="{$smarty.const.W_SITEPATH}img/ico/formats/createlink.gif"></span>
	  <span id="qimage_{$ident}" title="Изображение (Ctrl+M)">
	  <img src="{$smarty.const.W_SITEPATH}img/ico/formats/insertimage.gif"></span>
	  <label><img src="{$smarty.const.W_SITEPATH}img/ico/formats/separator.gif"></label>
	  <span id="qquote_{$ident}" title="Цитата (Ctrl+Q)">
	  <img src="{$smarty.const.W_SITEPATH}img/ico/formats/quote.gif"></span>
	  
	  <label><img src="{$smarty.const.W_SITEPATH}img/ico/formats/separator.gif"></label>
	  
	  <span id="qhide_{$ident}" title="Скрытый блок">
	  <img src="{$smarty.const.W_SITEPATH}img/ico/formats/hide.gif"></span>
	  
	  <span id="qsize_{$ident}" title="Размер текста">
	  <img src="{$smarty.const.W_SITEPATH}img/ico/formats/size.gif"></span>
	  
	  <span id="qcolor2_{$ident}" title="Цвет текста">
	  <img id="qcolor2im_{$ident}" src="{$smarty.const.W_SITEPATH}img/ico/formats/color2.gif"></span>
	  
	  <label><img src="{$smarty.const.W_SITEPATH}img/ico/formats/separator.gif"></label>
	  
	  <span id="qphp_{$ident}" title="PHP код">
	  <img src="{$smarty.const.W_SITEPATH}img/ico/formats/php.gif"></span>
      
      <span id="qxml_{$ident}" title="xml код">
	  <img src="{$smarty.const.W_SITEPATH}img/ico/formats/application_xml.png"></span>
      
      <label><img src="{$smarty.const.W_SITEPATH}img/ico/formats/separator.gif"></label>
      
      <span id="qml_{$ident}" title="margin left">
	  <img src="{$smarty.const.W_SITEPATH}img/ico/formats/ML.gif"></span>
      
      <span id="qpre_{$ident}" title="Тэг <pre>">
	  <img src="{$smarty.const.W_SITEPATH}img/ico/formats/pre.gif"></span>
      
      
	  
	 </td>
	 <td width="20px" align="right" valign="top" class="buttons_head">
	  <table cellpadding="0" cellspacing="0" border="0">
	  <tr>
	   <td>
	    <span style="margin-left: 0px; height: 9px" id="qresup_{$ident}" title="Уменьшить редактор (Ctrl+Up)">
		 <img src="{$smarty.const.W_SITEPATH}img/ico/formats/res_up.gif">
		</span>
	   </td>
	  </tr>
	  <tr>
	   <td>
	    <span style="margin: 2px 0px 0px 0px; height: 9px" id="qresdw_{$ident}" title="Увеличить редактор (Ctrl+Down)">
		 <img src="{$smarty.const.W_SITEPATH}img/ico/formats/res_dw.gif">
		</span>
	   </td>
	  </tr>
	  </table>
	 </td>
    </tr>
    </table>
	</span> 
	</div>
   </td>
  </tr>
  <tr>
	<td align="left" valign="top">
	<div style="margin-bottom: 10px; margin-left: 10px">
	 <textarea class="inp_new_text" style="{if isset($height)}height: {$height}{else}height: 55px{/if}" name="{$ident}" id="{$ident}">{$source}</textarea>
	 </div>
	</td>
	<td width="15px"><span style="display: block; width: 15px"></span></td>
  </tr>
  </table>
 </span>
</div>