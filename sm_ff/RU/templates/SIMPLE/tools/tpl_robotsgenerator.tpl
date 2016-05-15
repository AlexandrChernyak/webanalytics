{* генератор файлов robots.txt *}
<div style="margin-top: 5px">
 {literal}
 <style type="text/css">
  .td_x { width: 17px; text-align: center }	
 </style>
 {/literal}
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам сгенерировать файл <b>robots.txt</b> для Вашего сайта.
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
 function AddData(str) { var st1 = $('#datares'); st1.val(st1.val()+str+'\n'); st1.focus(); }
 function InsertDisalow(th) {
  if (th.value == '-') {
   var textdata =  prompt("Введите каталог на сайте!", "/" );
   if (!textdata) { return ; }
   if (textdata == '') { return ; }
   AddData('Disallow: '+textdata);
   return ;	
  }
  AddData('Disallow: '+th.value);	
 }
 function AddHost(th) {
  if (th.value == '') { return ; }
  AddData('Host: '+th.value);	
 }
 var dataurladress = '';
 function InitUrl(th) {
  dataurladress = '';
  var data = th.value;
  if (data == '') { th.focus(); return alert('Укажите адрес сайта!'); }
  if (data.slice(0,7) == 'http://') { data = data.substr(7); }
  dataurladress = data;
  th.value = data;
 }
 function AddSiteMap(th) {
  if (dataurladress == '') { return ; }
  if (th.value == '') { return ; }
  AddData('Sitemap: http://'+dataurladress+'/'+th.value);	
 }   	
 </script>
 {/literal}
  
  <div class="typelabel">Адрес сайта (без http://, только домен)</div>
  <div class="typelabel">
  <input type="text" style="width: 378px" class="inpt" name="urldata" id="urldata" onblur="InitUrl(this)">
  </div>
  
  <div class="typelabel">User-agent:<label style="font-size: 90%; color: #969696">
  <br />Строка User-agent определяет робота поисковой машины. (значение * - дает определение всех роботов)
  </label></div>
  <div class="typelabel">
  <select size="1" style="width: 380px" onchange="AddData('User-agent: '+this.value)">
  <option value=''></option>
  <option value='*'>Любой поисковик</option>
  <option value='Yandex'>Yandex</option>
  <option value='Googlebot'>Google</option>
  <option value='Slurp'>MSN</option>
  <option value='StackRambler'>Rambler</option>
  <option value='Scooter'>AltaVista</option>
 </select></div>
 
 <div class="typelabel">Disallow:<label style="font-size: 90%; color: #969696">
 <br />Определяет каталог\страницу, закрытую от индексации поисковым роботом. (при указании каталога - запрещается для индексации все содержимое каталога - пример Disallow: /images - запрещает для индексации полностью каталог /images). В каждой группе строки User-agent должна быть хоть одна конструкция Disallow. Директиву Allow: понимает только Яндекс - пример: Allow: /data. Все пути к каталогам или файлам пишутся от корня сайта.
 </label></div>
 <div class="typelabel">
 <select size="1" style="width: 380px" onchange="InsertDisalow(this)">
  <option value=''>Индексировать всё</option>
  <option value='/'>Запретить всё</option>
  <option value='/cgi-bin'>/cgi-bin</option>
  <option value='/css'>/css</option>
  <option value='/js'>/js</option>
  <option value='/images'>/images</option>
  <option value='/img'>/img</option>
  <option value='-' style="color: #0000FF">Вставить свой каталог</option>
  <option value='/'>Записать свой каталог</option>
 </select></div>

 <div class="typelabel">Host:<label style="font-size: 90%; color: #969696">
 <br />Директива Host: указывает на зеркало вашего сайта. Адрес сайта должен быть указан без протокола - пример: www.site.ru - верно, http://www.site.ru - не верно.
 </label></div>
 <div class="typelabel"><input type="text" class="inpt" id="hostdata" style="width: 378px" onblur="AddHost(this)"></div>
 
 <div class="typelabel">SiteMap:<label style="font-size: 90%; color: #969696">
 <br />Директива Sitemap: указывает на расположение файла карты вашего сайта. Директива указывает на отдельный XML или gz файл или на индексный SiteMap файл. Файл SiteMap может быть в форматах как в .XML, так и в .GZ (архивная копия файла SiteMap).</label></div>
 <div class="typelabel"><input type="text" class="inpt" value="sitemap.xml" id="sm" style="width: 378px" onblur="AddSiteMap(this)"></div>

 <div class="typelabel" style="font-size: 90%; margin-top: 5px">
 <a href="javascript:" onclick="AddData('# ')">Вставить комментарий</a>&nbsp;|&nbsp;
 <a href="javascript:" onclick="AddData(' ')">Вставить пустую строку</a>
 </div>
 
 <div class="typelabel" style="margin-top: 25px"> Результат, содержимое файла robots.txt &nbsp;
 <label style="font-size: 90%">[<a href="javascript:" onclick="$('#datares').select();">выделить</a>]</label></div>
 <div class="typelabel">
 <textarea class="int_text" style="height: 200px; width: 96%" name="datares" id="datares"></textarea>
 </div>
 
 {/if}
</div>