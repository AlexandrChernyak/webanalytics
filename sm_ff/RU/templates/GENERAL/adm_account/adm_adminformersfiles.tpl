{* стандартные информеры общего назначения *}
<div style="margin-top: 4px">
<div>
 <div>Тип изображений информеров</div>
 <div style="margin-top: 4px">
  <select size="1" name="informtype" id="informtype" onchange="NavigateInformType(this)">
   <option{if $smarty.get.inftype == '1'} selected="selected"{/if} value="1">Информеры скорости интернета</option>
   <option{if $smarty.get.inftype == '2'} selected="selected"{/if} value="2">Информеры IP адреса</option>
   <option{if $smarty.get.inftype == '3'} selected="selected"{/if} value="3">Информеры ТиЦ PR</option>
   <option{if $smarty.get.inftype == '4'} selected="selected"{/if} value="4">Информеры Апдейтов</option>
  </select>  
 </div>
</div>
<div style="margin-top: 4px; border-bottom: 1px solid #969696">&nbsp;</div>

{literal}
<script type="text/javascript">
var list_items = new Array(); 
 var allsaveenabled = {/literal}{$adm_object->GetResult('count')};{literal}
 var globalsectionpath = {/literal}'{$smarty.const.W_SITEPATH}';{literal}
 var globaladdident = {/literal}'{$smarty.get.new}';{literal}
 
 function NavigateInformType(th) {
  var path = globalsectionpath + 'account/adminformersfiles/';
  if (globaladdident) { path = path + '&new=' + globaladdident; }
  path = path + '&inftype=' + th.value + 
  '&sections={/literal}{if $smarty.get.sections}{$smarty.get.sections}{else}0{/if}{literal}' + 
  '{/literal}{if $smarty.get.sectionslist}&sectionslist=1{/if}{literal}';
  document.location = path;  	
 }//NavigateInformType 
 
 function NavigateSectionType(th) {
  var path = globalsectionpath + 'account/adminformersfiles/';
  if (globaladdident) { path = path + '&new=' + globaladdident; }
  path = path + '&inftype={/literal}{if $smarty.get.inftype}{$smarty.get.inftype}{else}1{/if}{literal}' + 
  '&sections=' + th.value;
  document.location = path;  	
 }//NavigateInformType 
  
 function DoHigl(th, n, p) {	
  if (n) {	$(th).css('background','#F8F5F1'); } else {
   var ch = document.getElementById('chid'+p);
   var color = (ch && ch.checked) ? '#E7DDD1' : 'none';   	
   $(th).css('background', color);		
  }	
 }//DoHigl
 
 function CheckItem(itemid, th) {
  th = (th) ? th : document.getElementById('chid'+itemid);   
  if (th && th.checked) { $('#t_r_'+itemid).css('background','#E7DDD1'); } else {
  $('#t_r_'+itemid).css('background','none');
  }
  SetEnabled();   	
 }//CheckItem
 
 function CheckAll(th) {	
  for (var i=0; i < list_items.length; i++) {
   var ch = $('#chid'+list_items[i]);
   ch.attr('checked', (th.checked) ? 'checked' : '');
   if (th.checked) { $('#t_r_'+list_items[i]).css('background','#E7DDD1'); } else {
   $('#t_r_'+list_items[i]).css('background','none');	
  }	  	    	
  }
  SetEnabled();	
 }//CheckAll
 
 function GetSelCount() {
  var inccount = 0;
  for (var i=0; i < list_items.length; i++) {
   var ch = document.getElementById('chid'+list_items[i]);
   if (ch && ch.checked) { inccount++; }		
  }	
  return inccount;	
 }//GetSelCount 	
</script>
{/literal}

{if !$smarty.get.sectionslist && !$smarty.get.statisticinfo}
{* управление информерами *}

<div style="margin-top: 6px">
 <div>Раздел информеров</div>
 <div style="margin-top: 4px">
  <select size="1" name="sectionp" id="sectionp" onchange="NavigateSectionType(this)">
   <option{if !$smarty.get.sections} selected="selected"{/if} value="0">Все разделы</option>
   {if $adm_object->GetResult('sections')}
    {foreach from=$adm_object->GetResult('sections') item=val name=val}
    <option{if $smarty.get.sections == $val.iditem} selected="selected"{/if} value="{$val.iditem}">{$val.secname}  ({$adm_object->GetInformersCountInSection($val.iditem)})</option>
    {/foreach}
   {/if} 
  </select>
  <label style="margin-left: 6px">
   <a href="{$smarty.const.W_SITEPATH}account/adminformersfiles/&sectionslist=1&inftype={if $smarty.get.inftype}{$smarty.get.inftype}{else}1{/if}{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}&sections={if $smarty.get.sections}{$smarty.get.sections}{else}0{/if}">Управление списком разделов</a>
  </label> 
 </div>
</div>


<div style="margin-top: 22px">
<a href="{$smarty.const.W_SITEPATH}account/adminformersfiles&new=1{if $smarty.get.inftype}&inftype={$smarty.get.inftype}{/if}&sections={if $smarty.get.sections}{$smarty.get.sections}{else}0{/if}"{if $smarty.get.new} style="color: #000000"{/if}>Добавить изображение (информер)</a> | <a href="{$smarty.const.W_SITEPATH}account/adminformersfiles/{if $smarty.get.inftype}&inftype={$smarty.get.inftype}{/if}&sections={if $smarty.get.sections}{$smarty.get.sections}{else}0{/if}"{if !$smarty.get.new} style="color: #000000"{/if}>Список изображений (<label style="color: #000000">{$adm_object->GetResult('count')}</label>)</a>
</div>
<div style="margin-top: 12px">
{* список изображений *}
{literal}
<script type="text/javascript"> 
 function PrepereSend(th) {
  var count = GetSelCount();
  if (count <= 0 && th.actionlistmakes.value != 'all' && th.actionlistmakes.value != 'dall') { 
   alert('Выделите хотя бы один файл изображения!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == 'delete') {
   if (!confirm('Вы действительно хотите удалить ['+count+'] изображений?')) { return false; }
  } else 
  if (th.actionlistmakes.value == 'enabled') {
   if (!confirm('Вы действительно хотите активировать ['+count+'] изображений?')) { return false; }
  } else
  if (th.actionlistmakes.value == 'disabled') {
   if (!confirm('Вы действительно хотите деактивировать ['+count+'] изображений?')) { return false; }
  } else
   if (th.actionlistmakes.value == 'dall') {
    if (!allsaveenabled) { alert('Нет данных для удаления!'); return false; }	
    if (!confirm('Вы действительно хотите удалить все изображения?')) { return false; }	
  } else { alert('Неизвестный идентификатор операции!'); return false; }
  return true;   	
 }//PrepereSend
 function SetEnabled() {  	
  var count = GetSelCount();
  setElementOpacity(document.getElementById('adid'), (allsaveenabled) ? 1 : 0.3);
  if (count <= 0) {
   setElementOpacity(document.getElementById('did'), 0.3);
   setElementOpacity(document.getElementById('ena'), 0.3);
   setElementOpacity(document.getElementById('dna'), 0.3);
   return ;	 
  }
  setElementOpacity(document.getElementById('did'), 1);
  setElementOpacity(document.getElementById('ena'), 1);
  setElementOpacity(document.getElementById('dna'), 1); 	
 }//SetEnabled
 function SetActionP(a) {
  var f = document.getElementById('listform');
  if (!f) { return ; }
  f.actionlistmakes.value = a;   	
 }//SetActionP   	
</script>
<style type="text/css">
  .h_th1, .h_td, .h_td2 { 
   border: 1px solid #E4D9CB; background: #EEE7DF; height: 25px; border-bottom: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E4D9CB; border-left: none; }
  .btn_n { border: 1px solid #E4D9CB; border-top: none; height: 25px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E4D9CB; height: 25px; border-top: none; }	
 </style>
{/literal} 
{if !$smarty.get.new && !$smarty.get.modifyimage}
<form method="post" name="listform" id="listform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Удалить все файлы&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 160px;">
 </span>
 
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Включить&nbsp;" class="activatelistit" name="ena" id="ena" onclick="SetActionP('enabled')" style="//width: 80px;">
 </span>

 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Отключить&nbsp;" class="deactivatelistit" name="dna" id="dna" onclick="SetActionP('disabled')" style="//width: 80px;">
 </span>

 </div>
 <div style="margin-top: 6px">
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <td class="h_th1" valign="center" align="left" width="20px">
	 <span style="margin-left: 4px">
	  <input type="checkbox" name="checkallitems" id="checkallitems" style="cursor: pointer" onclick="CheckAll(this)">
	 </span>
	</td>
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Изображение</span></td>	
	<td class="h_td" valign="center" align="center" width="80px">Размер</td>
	<td class="h_td" valign="center" align="center" width="80px">Активен</td>	
	<td class="h_td2" valign="center" align="center" width="130px">Дата</td>
   </tr>	
   {if $adm_object->GetResult('data.source')}
	{foreach from=$adm_object->GetResult('data.source') item=val name=val}
	 <tr onmouseover="DoHigl(this, 1, {$smarty.foreach.val.index})" onmouseout="DoHigl(this, 0, {$smarty.foreach.val.index})" id="t_r_{$smarty.foreach.val.index}">
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E4D9CB; border-right: 1px solid #E4D9CB">
	  <span style="margin-left: 4px">
	   <input type="checkbox" name="chid{$smarty.foreach.val.index}" id="chid{$smarty.foreach.val.index}" 
	   style="cursor: pointer" onclick="CheckItem('{$smarty.foreach.val.index}', this)">
	  </span>
	 </td>
	 
	 <td class="sth1" valign="top" align="left" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	  <div style="margin-top: 5px; margin-left: 3px; margin-right: 3px">
	   <div>	   
	   <a href="{$smarty.const.W_SITEPATH}pfiles/generalinformers/{$val.dwname}" target="_blank"><img src="{$smarty.const.W_SITEPATH}account/adminformersfiles/&getimage={$val.iditem}" style="margin-right: 6px; position: relative;"></a>
	   </div>
	   <div style="margin-top: 4px"><i>{$val.imagename}</i></div>
	   <!-- info -->
	   <div style="margin-top: 12px">Статистика информера:<label style="margin-left: 7px; font-size: 95%"><a href="{$smarty.const.W_SITEPATH}account/adminformersfiles/{if $smarty.get.inftype}&inftype={$smarty.get.inftype}{/if}&statisticinfo={$val.iditem}&sections={if $smarty.get.sections}{$smarty.get.sections}{else}0{/if}{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}">Обзор</a></label></div>
	   <div style="margin-top: 4px">
	    Использует человек всего:  <b>{if $adm_object->GetInformerInfo($val, 'peoplesuse')}{$adm_object->GetInformerInfo($val, 'peoplesuse')}{else}0{/if}</b> 
	   </div>
	   {if $adm_object->GetInformerInfo($val, 'peoplesuse')}
	    <div style="margin-top: 4px">
	     Всего запросов к информеру:  <b>{if $adm_object->GetInformerInfo($val, 'allrequist')}{$adm_object->GetInformerInfo($val, 'allrequist')}{else}0{/if}</b> 
	    </div>
	    <div style="margin-top: 4px">
	     Дата последнего запроса:  <b>{if $adm_object->GetInformerInfo($val, 'lastquery')}{$adm_object->GetInformerInfo($val, 'lastquery')}{else}?{/if}</b>{if $adm_object->GetInformerInfo($val, 'lastquerystr')}<label style="margin-left: 6px; font-size: 95%">[ {$adm_object->GetInformerInfo($val, 'lastquerystr')} ]</label>{/if} 
	    </div>
	   {/if}

	   <!-- options -->	   
	   <div style="margin-top: 14px">Надстройки информера:<label style="margin-left: 7px; font-size: 95%"><a href="{$smarty.const.W_SITEPATH}account/adminformersfiles/{if $smarty.get.inftype}&inftype={$smarty.get.inftype}{/if}&modifyimage={$val.iditem}&sections={if $smarty.get.sections}{$smarty.get.sections}{else}0{/if}">Изменить</a></label></div>
	   <div style="margin-top: 4px">
	    <textarea readonly="readonly" style="background: transparent;{if !$val.options}color:#FF0000;{/if} border: none; width: 98%; height: 55px; padding-left: 6px">{if !$val.options}(нет надстроек){else}{$val.options}{/if}</textarea>
	   </div>  

	   <div style="margin-top: 4px"></div>
	  </div>	 
	 </td> 
	 
	 <td class="sth1" valign="top" align="center" onclick="$('#chid{$smarty.foreach.val.index}').click()" width="80px">
	  <div style="margin-top: 5px">{$adm_object->GetSizeItem($val.imagesize)}</div>	  	 
	 </td>
	 <td class="sth1" valign="top" align="center" onclick="$('#chid{$smarty.foreach.val.index}').click()" width="80px">
	  <div style="margin-top: 5px">{if !$val.imageuse}<i>(нет)</i>{else}<i style="color: #333399">(активен)</i>{/if}</div>
	 </td>
	 <td class="sth1" valign="top" align="center" width="130px" style="border-right: 1px solid #E4D9CB;" 
	 onclick="$('#chid{$smarty.foreach.val.index}').click()">
	 <div style="margin-top: 5px">{$val.datecreat}</div>
	 </td>
    </tr>  
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.iditem}" name="idm{$smarty.foreach.val.index}">
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="5">
     Нет загруженных изображений!
     <script type="text/javascript">
	  document.getElementById('checkallitems').disabled = true;
     </script>
    </td>
   </tr> 
   {/if} 
 </table>
 {if $adm_object->GetResult('data.source')}
 <div style="text-align: right; margin-top: 10px">{$adm_object->GetResult('data.pagestext')}</div>
 {/if} 
 </span>
 </div> 
 <input type="hidden" value="0" name="actioncountmess">
 <input type="hidden" value="none" name="actionlistmakes"> 
</form>
<script type="text/javascript">SetEnabled();</script>
{else}
 {* добавление\изминение изображения *}
 {literal}
 <script type="text/javascript">
  function PrepereToSend(th) {
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;   
   return true;	
  }//PrepereToSend  	
 </script>
 {/literal}
 <form method="post" name="ffadd" id="ffadd"{if !$smarty.get.modifyimage} enctype="multipart/form-data"{/if} onsubmit="return PrepereToSend(this)"> 
  
  {if !$smarty.get.modifyimage}
  <div class="typelabel"><label id="red">*</label> Файл изображения (форматы: {$adm_object->GetListTypes()}{if $adm_object->GetResult('maxsize')}, максимальный размер: <b>{$adm_object->GetResult('maxsize')}</b>){/if}</div>  
  <div class="typelabel"> 
   <input type="file" size="20" style="width: 430px; height: 22px" class="inpt" name="image" id="image">  
  </div>
  {else}
  <div style="margin-top: 18px; font-size: 16px; border-bottom: 1px dashed #808080"><b>Изменение надстроек изображения.</b></div>
  <div style="margin-top: 15px"></div>
  {/if}
  
  
  <div class="typelabel"><label id="red">*</label> Раздел информера</div>
  <div class="typelabel">  
   <select size="1" name="idsection" id="idsection">
    <option{if !$adm_object->GetResult('imageinfo.sectionid')} selected="selected"{/if} value="0">Все разделы</option>
    {if $adm_object->GetResult('sections')}
     {foreach from=$adm_object->GetResult('sections') item=val name=val}
     <option{if $val.iditem == $adm_object->GetResult('imageinfo.sectionid')} selected="selected"{/if} value="{$val.iditem}">{$val.secname}</option>
     {/foreach}
    {/if} 
   </select>
  </div>
  
  <div class="typelabel">Предварительные надстройки{if !$smarty.get.modifyimage} (опционально, устанавливаются после загрузки){/if}<br />
  <u>Разделитель</u>: запятая или перенос строки<br />
  <ul>
  <li style="margin-left: 12px; margin-top: 6px">
   Координаты положения значений на изображении:<br />
   x1:24<br />
   y1:30<br />
   x2:55<br />
   y2:120<br />
   и т.д<br /><br />
   <u>Обозначение координат</u>:<br />
   x[номер_значения]:[позиция_в_пикслях_от_левого_края_от_нуля]<br />
   y[номер_значения]:[позиция_в_пикслях_от_верхнего_края_от_нуля]<br /><br />
   <u>Пример</u>: позиция верхнего левого угла для первого значения <br /><b>x1:0, y1:0</b> 
   <br /><br />
   <b>Обозначение параметров для информеров:</b><br />
   {if !$smarty.get.inftype || $smarty.get.inftype == '1'}
    <b>x1, y1 </b>- Значение скорости Download интернета в килобитах\s<br />
    <b>x2, y2 </b>- Значение скорости Upload интернета в килобитах\s<br />
    <b>x3, y3 </b>- Значение скорости Download интернета в килобайтах\s (скорость скачивания)<br />
    <b>x4, y4 </b>- Значение скорости Upload интернета в килобайтах\s<br />
    <br />   
   {/if}
   {if $smarty.get.inftype == '2'}
    <b>x1, y1 </b>- Значение IP адреса<br />
    <br />    
   {/if}
   {if $smarty.get.inftype == '3'}
    <b>x1, y1 </b>- Значение Яндекс ТиЦ<br />
    <b>x2, y2 </b>- Значение Google PR<br />
    <br />    
   {/if}  
   {if $smarty.get.inftype == '4'}
    <b>x1, y1 </b>- Дата апдейта `Яндекс ТиЦ`<br />
    <b>x2, y2 </b>- Дата апдейта `Яндекс поиск`<br />
    <b>x3, y3 </b>- Дата апдейта `Яндекс каталог`<br />
    <b>x4, y4 </b>- Дата апдейта `Google PR`<br />
    <br />    
   {/if}      
   <u>*** Если параметр отсутствует - значение не будет отображаться на информере!!</u><br /><br />
  </li>
  </ul>
	
  <ul>
  <li style="margin-left: 12px">
   Для установки цвета значения используйте формат параметров:<br /><br />
   [<b>x</b> | <b>y</b>][<b>номер_параметра</b>]color:[<b>цвет_в_hex_формате</b>]<br /><br />
   Пример установки красного цвета для параметра <b>x1</b> - <u>x1color:#FF0000</u><br />
   По умолчанию цвет "черный" (#000000)<br /><br />
   <u>** Параметр <b>y</b> не используется.</u>   
   <br /><br />
  </li>
  </ul>
  
  <ul>
  <li style="margin-left: 12px">
   Для установки процента непрозрачности текста параметров используйте формат:<br /><br />
   [<b>x</b> | <b>y</b>][<b>номер_параметра</b>]transperent:[<b>число_от_0_до_100</b>]<br /><br />
   Параметр определяет степень непрозрачности текста на изображении по шкале от 0 до 100, где 0 - полная прозрачность, 100 - полная непрозрачность. Уровень прозрачности определяется в процентном соотношении.<br />
   Пример установки уровня непрозрачности 70% для параметра <b>x1</b>: <u>x1transperent:70</u><br />
   По умолчанию: 100<br /><br />
   <u>** Параметр <b>y</b> не используется.</u>
   <br /><br />   
  </li>
  </ul>
  
  <ul>
  <li style="margin-left: 12px">
   Для установки градуса наклона текста параметра используйте формат:<br /><br />
   [<b>x</b> | <b>y</b>][<b>номер_параметра</b>]angle:[<b>число_градус_наклона</b>]<br /><br />
   Параметр определяет угол наклона текста.<br />
   Пример установки вертикального положения для параметра <b>x1</b>: <u>x1angle:90</u><br />
   По умолчанию: 0 - "горизонтально"<br /><br />
   <u>** Параметр <b>y</b> не используется.</u>
   <br /><br />   
  </li>
  </ul>
  
  <ul>
  <li style="margin-left: 12px">
   Для установки размера текста используйте формат:<br /><br />
   [<b>x</b> | <b>y</b>][<b>номер_параметра</b>]size:[<b>число_размер_шрифта_в_пикслях</b>]<br /><br />
   Параметр определяет размер шрифта текста.<br />
   Пример установки размера шрифта 16px для параметра <b>x1</b>: <u>x1size:16</u><br />
   По умолчанию: 12<br /><br />
   <u>** Параметр <b>y</b> не используется.</u>
   <br /><br />   
  </li>
  </ul>
  
  <ul>
  <li style="margin-left: 12px">
   Для установки шрифта текста используйте формат:<br /><br />
   [<b>x</b> | <b>y</b>][<b>номер_параметра</b>]font:[<b>идентификатор_шрифта_загруженного_на_сайт</b>]<br /><br />
   Параметр определяет шрифт текста отображаемого параметра. Для указания шрифта используется указание идентификатора шрифта, загруженного на сайта в разделе <a href="{$smarty.const.W_SITEPATH}account/admfontssection/" target="_blank">шрифтов</a>. Для вставки идентификатора шрифта используйте выбор шрифта ниже. При отсутствии указанного шрифта или указании 0 - используется шрифт Arial<br />
   Пример установки шрифта Arial для параметра <b>x1</b>: <u>x1font:0</u><br />
   По умолчанию: 0 (Arial)<br /><br />
   <u>** Параметр <b>y</b> не используется.</u>
   <br /><br />   
  </li>
  </ul>
  
  <ul>
  <li style="margin-left: 12px">
   Дополнительные параметры для всех видов информеров:<br /><br />
   <b>xURL</b>:[позиция_по_x] и yURL:[позиция_по_y]<br /><br />
   Если параметр(ы) установлены - в указанные координаты выводит текст "хоста сайта".<br />
   На параметр "хоста сайта" действуют все вышеописанные параметры форматирования текста.<br />
   Пример отображения хоста сайта в координатах x=10, y=10 - <u>xURL:10,yURL:10</u><br />
   По умолчанию: <b>не выводится</b>
   <br /><br />
   
   <b>xREPcolor</b>:цвет_в_hex_формате<br /><br />
   Использование данного параметра включает информеру возможность смены цвета при выборе информера.<br />
   Если параметр установлен - посетитель сможет выбрать цвет информера. Указанный в данном параметре цвет будет 
   заменен на цвет, который выбирет посетитель.<br />
   Пример: установив параметр как <b>xREPcolor:#FF0000</b> - если посетитель выбирит например синий (#0000FF) при выборе информера - установленный в данном параметре цвет (красный #FF0000) будет заменен на синий. "Заменены будут все вхождения красного цвета на синий."<br />
   По умолчанию: <b>не используется</b>
   <br /><br />   
  </li>
  </ul>
   
  </div>
  
  <div class="typelabel">
  <input type="button" value="&nbsp;Вставить цвет&nbsp;" class="butt" name="addcolor" id="addcolor"><label style="margin-left: 6px; color: #FFFFFF; background: #FFFFFF" id="addcolorlabel" for="addcolor">&nbsp;color&nbsp;</label>
  <label style="margin-left: 12px">
  Шрифт: 
  <select id="textfont" name="textfont" style="width: 284px">
    <option selected="selected" value="0">Arial</option>
    {foreach from=$adm_object->GetResult('fonts') item=val name=val}
	 <option value="{$val.iditem}">{$adm_object->substr($val.fontname, 0, -4)}</option>	 
	{/foreach}    
   </select>
   <input type="button" value="&nbsp;Вставить&nbsp;" onclick="AddFontNamed()" class="butt">
  </label>
  </div>  
  
  <div class="typelabel">
   <textarea class="int_text" style="height: 100px; width: 95%" name="list" id="list">{if $smarty.get.modifyimage}{$CONTROL_OBJ->GetPostElement('list', 'updatesactionnew', 'do', $adm_object->GetResult('imageinfo.options'))}{else}{$CONTROL_OBJ->GetPostElement('list', 'updatesactionnew')}{/if}</textarea>
  </div>  
  
  {if !$smarty.get.modifyimage}
  <div class="typelabel">
   <input type="checkbox"{if $adm_object->CheckPostValue('imageuse')} checked="checked"{/if} style="cursor: pointer" name="imageuse" id="imageuse"><label for="imageuse" style="cursor: pointer">&nbsp;Добавить активным информером</label>
  </div>
  {/if}  

{literal}
<script type="text/javascript">
 function AddFontNamed() {
  InsertObhvatData($('#textfont').val(), '', 'list');	
 }//AddFontNamed
 
 $('#addcolor').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		InsertObhvatData('#'+hex, '', 'list');		
		$('#addcolorlabel').css('background', '#'+hex);
		$(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor($('#addcolorlabel').css('background'));
	}
 })
 .bind('keyup', function(){
	$(this).ColorPickerSetColor($('#addcolorlabel').css('background'));
 });	
</script>
{/literal}
  
 <input type="hidden" value="do" name="updatesactionnew">
 <div class="typelabel"><input type="submit" value="&nbsp;{if !$smarty.get.modifyimage}Добавить файл{else}Изменить надстройки информера{/if}&nbsp;" class="button" name="rb" id="rb">{if $smarty.get.modifyimage}<label style="margin-left: 6px"><input type="button" value="&nbsp;Предварительный просмотр&nbsp;" class="butt" name="prew" id="prew" onclick="ActionPrewiev('')"></label>{/if}
 </div>
 </form>
 
 {if $smarty.get.modifyimage}
 <div style="margin-top: 18px"><b>Предварительный просмотр</b></div>
 <div style="margin-top: 4px">
  <label id="coordinateslabel"></label><label id="fixcoordinateslabel" style="margin-left: 16px"></label>
  <label id="getxucolor" style="margin-left: 14px"><label id="datacolorxycolor" style="font-weight: bold"></label> 
  &nbsp;<a href="javascript:" onclick="CheckForColorXY('{$smarty.get.modifyimage}')">Цвет под X Y</a></label>
 </div>
 
 <div style="margin-top: 6px">
  <div id="imageprev"><img id="imageobj" src="{$smarty.const.W_SITEPATH}account/adminformersfiles/&getimage={$smarty.get.modifyimage}"></div>
 </div>
 <div id="selcolorlabeldiv" style="margin-top: 4px; display: none; visibility: hidden">
  <a href="javascript:" id="selcolorlabel" title="#000000">Тест смены цвета</a>
 </div>
 
 <div style="margin-top: 14px"></div> 
 {literal}
 <script type="text/javascript">   
  //---------
  var ImageX = 0;
  var ImageY = 0;
  var ImageFixX = 0;
  var ImageFixY = 0;
  var imageMap = false;
  
  function PrepResdata(data) {
   $('#datacolorxycolor').html(data);	
  }//PrepResdata
  
  function CheckForColorXY(ident) {
   $('#datacolorxycolor').html('<u>Получение цвета..</u>'); 	
   var toolpath = globalsectionpath + 'account/adminformersfiles/';	
   SendDefaultRequest(toolpath, 'is_ajax_mode=1&image='+ident + '&x=' + ImageFixX + '&y=' + ImageFixY, 'PrepResdata');	
  }//CheckForColorXY
  
  function FixXY() {	
   $('#fixcoordinateslabel').html(
    '<b>X:</b> <b style="color:#FF0000">'+ImageFixX+'</b>'+
    '<b style="margin-left: 4px">Y:</b> <b style="color:#FF0000">'+ImageFixY+'</b>'
   );
  }//FixXY
  
  function ShowXY(x,y) {
   ImageFixX = x;
   ImageFixY = y;		
   $('#coordinateslabel').html(
    '<b>X:</b> '+x+'<label style="margin-left: 4px">Y:</label> '+y
   );	
  }//ShowXY
  
  function findPosX(obj) {
   var currleft = 0;
   if (obj.offsetParent)
    while (obj.offsetParent) {
      currleft += obj.offsetLeft
      obj = obj.offsetParent;
    }
   else if (obj.x) currleft += obj.x;
   return currleft;
  }//findPosX

  function findPosY(obj) {
   var currtop = 0;
   if (obj.offsetParent)
    while (obj.offsetParent) {
      currtop += obj.offsetTop
      obj = obj.offsetParent;
    }
   else if (obj.y) currtop += obj.y;
   return currtop;
  }//findPosY
  
  function getObj(name) { return document.getElementById(name); }
  
  function initmove() {	
   ImageX = 0;
   ImageY = 0;
   ImageFixX = 0;
   ImageFixY = 0;
   imageMap = getObj("imageobj");
   imageMap.onmouseover = getCoords;
   FixXY();
   ShowXY(ImageX, ImageY);  
  }//initmove
  
  function moveDot(cursor) {
   if(!cursor) { var cursor = window.event; }
   var x = 0;
   var y = 0;
   if (cursor.pageX || cursor.pageY) {
    x = cursor.pageX;
    y = cursor.pageY;
   }
   else if (cursor.clientX || cursor.clientY) {
    x = cursor.clientX + document.body.scrollLeft;
    y = cursor.clientY + document.body.scrollTop;
   }
   x -= ImageX;
   y -= ImageY;
   ShowXY(x, y);  
  }//moveDot
  
  function getCoords() {
   ImageX = findPosX(imageMap);
   ImageY = findPosY(imageMap);
   imageMap.onmousemove = moveDot;
   imageMap.onmouseover = moveDot;
   imageMap.onclick     = FixXY;
  }//getCoords
  
  function ActionForVisibleRepColor() {
   var opt = $('#list').val();
   var selcolorvisible = str_replace('xREPcolor', '', opt) != opt;
   $('#selcolorlabeldiv').css('display', (selcolorvisible) ? 'block' : 'none');
   $('#selcolorlabeldiv').css('visibility', (selcolorvisible) ? 'visible' : 'hidden');    	
  }//ActionForVisibleRepColor
  
  function ActionPrewiev(col) {
   var options = str_replace('#', '_r_', trim($('#list').val()));   	
   options = encodeURIComponent(options);
   var path = globalsectionpath + 'account/adminformersfiles/&getimage={/literal}{$smarty.get.modifyimage}{literal}';
   path = path + '&optimg=' + options;
   if (col) { path = path + '&repcol='+str_replace('#', '_r_', col); } 
   path = path + '&r=' + Math.random();   
   $('#imageprev').html('<img id="imageobj" src="'+path+'">');
   initmove();
   //check for show select color
   ActionForVisibleRepColor();      	
  }//ActionPrewiev
  
  $('#selcolorlabel').ColorPicker({
	 onSubmit: function(hsb, hex, rgb, el) {
	  $('#selcolorlabel').attr('title', '#'+hex);
	  ActionPrewiev('#'+hex);
	  $(el).ColorPickerHide();		
	 },
	 onBeforeShow: function () { $(this).ColorPickerSetColor($('#selcolorlabel').attr('title')); }
    })
    .bind('keyup', function(){ $(this).ColorPickerSetColor($('#selcolorlabel').attr('title')); });
  
  $(document).ready(function(){ initmove(); ActionForVisibleRepColor(); });	
 </script>
 {/literal} 
 {/if}
 
 {if $smarty.post.updatesactionnew == 'do'}
 <div style="margin-top: 10px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">{if !$smarty.get.modifyimage}Файл успешно добавлен!{else}Надстройки информера успешно изменены!{/if}</label>
  {/if}
 </div>
 {/if}
{/if}
</div>
{else} 
 {if $smarty.get.statisticinfo}
  
   {* просмотр статистики использования информера *}
   {include file="adm_account/adminformersfiles/adm_adminformersfiles_stat_list.tpl"}
   
 {else}
 
  {* управление секциями информеров *}
  {include file="adm_account/adminformersfiles/adm_adminformersfiles_sect_list.tpl"}
  
 {/if} 
{/if}
</div>