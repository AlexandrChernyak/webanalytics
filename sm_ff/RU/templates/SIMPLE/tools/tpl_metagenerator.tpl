{* генератор мета тэгов *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам сгенерировать мета тэги для Вашего сайта.
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
 var datas = new Array();
 datas['titled'] = '<title>';
 datas['titled_1'] = '</title>'; 
 datas['keyd'] = '<meta name="keywords" content="';
 datas['keyd_1'] = '"/>'; 
 datas['descrd'] = '<meta name="description" content="';
 datas['descrd_1'] = '"/>'; 
 datas['maild'] = '<meta name="owner" content="';
 datas['maild_1'] = '"/>'; 
 datas['named'] = '<meta name="author" lang="ru" content="';
 datas['named_1'] = '"/>';
 datas['charsetd'] = '<meta http-equiv="content-type" content="text/html; charset=';
 datas['charsetd_1'] = '"/>'; 
 datas['docedtyped'] = '<meta name="resource-type" content="';
 datas['docedtyped_1'] = '"/>'; 
 datas['languaged'] = '<meta http-equiv="content-language" content="'
 datas['languaged_1'] = '"/>';
 datas['robotsd'] = '<meta name="robots" content="';
 datas['robotsd_1'] = '"/>'; 
 datas['copyright'] = '<meta name="copyright" content="';
 datas['copyright_1'] = '"/>';
 datas['expiresd'] = '<meta http-equiv="expires" content="';
 datas['expiresd_1'] = '"/>';
 datas['pragmad'] = '<meta http-equiv="pragma" content="';
 datas['pragmad_1'] = '"/>'; 
 datas['revisitd'] = '<meta name="revisit" content="';
 datas['revisitd_1'] = '"/>'; 
 datas['URLd'] = '<meta name="url" content="';
 datas['URLd_1'] = '"/>';
 datas['wintarge'] = '<meta http-equiv="window-target" content="';
 datas['wintarge_1'] = '"/>';
 datas['shortcutd'] = '<link rel="shortcut icon" href="';
 datas['shortcutd_1'] = '" type="image/x-icon">';
  
 var p_list = ['titled','keyd','descrd','maild','named','charsetd','docedtyped','robotsd','languaged','copyright','expiresd','pragmad','revisitd',
 'URLd','wintarge','shortcutd']; 
 
 function Processgenerate() { 	
  var str = '';
  var seted = 0;
  var start = '';
  var end = '';  
  var obj;   
  for (var i=0; i < p_list.length; i++) {  	
   start = datas[p_list[i]];  
   end   = datas[p_list[i]+'_1'];	
   if ((!start) || (!end)) { continue; }
   obj = document.getElementById(p_list[i]);
   if (!obj) { continue; }
   if (obj.value == '') { continue; }
   seted = 1;
   str = str + start + obj.value + end + '\n';  
  }//i	
  obj = document.getElementById('withhead');
  if (obj.checked) {
   str = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">\n<head>\n' + str;
   str = str + '</head>\n';	
  }
  if ((!seted) || (str == '')) { str = ''; }
  $('#datares').val(str);    	
 }
 function ShowMoreT(th) {
  if (th.checked) { $('#moretagsdata').css('display','block'); } else { $('#moretagsdata').css('display','none'); }
  Processgenerate();	
 }   	
 </script>
 {/literal}  
  
<div class="typelabel">Заголовок страницы (Title)</div>
<div class="typelabel"><input type="text" class="inpt" value="" id="titled" style="width: 380px" onblur="Processgenerate()"></div>
<div class="typelabel">Ключевые слова (Keywords) [через запятую]</div>
<div class="typelabel"><input type="text" class="inpt" value="" id="keyd" style="width: 380px" onblur="Processgenerate()"></div>
<div class="typelabel">Описание страницы (description)</div>
<div class="typelabel"><input type="text" class="inpt" value="" id="descrd" style="width: 380px" onblur="Processgenerate()"></div>
<div class="typelabel">Email владельца (Owner)</div>
<div class="typelabel"><input type="text" class="inpt" value="" id="maild" style="width: 380px" onblur="Processgenerate()"></div>
<div class="typelabel">Имя автора (Author)</div>
<div class="typelabel"><input type="text" class="inpt" value="" id="named" style="width: 380px" onblur="Processgenerate()"></div>
<div class="typelabel">Кодировка (Charset)</div>
<div class="typelabel">
<select size="1" style="width: 384px" id="charsetd" onchange="Processgenerate()">
 <option>windows-1251</option>
 <option selected="selected">UTF-8</option>
 <option>UTF-16</option>
 <option>KOI8-R</option>
 <option>ISO-8859-1</option>
 <option>ISO-8859-2</option>
 <option>ISO-8859-3</option>
 <option>ISO-8859-4</option>
 <option>ISO-8859-5</option>
 <option>ISO-8859-6</option>
 <option>ISO-8859-7</option>
 <option>ISO-8859-8</option>
 <option>ISO-8859-9</option>
 <option>ISO-2022-JP</option>
 <option>ISO-2022-JP-2</option>
 <option>ISO-2022-KR</option>
 <option>SHIFT_JIS</option>
 <option>EUC-KR</option>
 <option>BIG5</option>
 <option>KSC_5601</option>
 <option>HZ-GB-2312</option>
 <option>JIS_X0208</option>
 <option>GB2312</option>
 <option>US-ASCII</option>
</select>
</div>
<div class="typelabel">Тип документа (Object Type)</div>
<div class="typelabel">
<select size="1" style="width: 384px" id="docedtyped" onchange="Processgenerate()">
 <option value="" selected>Не указывать</option>
 <option>Document</option>
 <option>Homepage</option>
 <option>World</option>
 <option>RealWorld</option>
 <option>FAQ</option>
 <option>RFC</option>
 <option>Magazine</option>
 <option>Mall</option>
 <option>Dictionary</option>
 <option>Archive</option>
 <option>SearchEngine</option>
 <option>Hypercatalog</option>
 <option>Keybank</option>
 <option>Manual</option>
 <option>Index</option>
 <option>Book</option>
 <option>Database</option>
 <option>Journal</option>
 <option>Catalog</option>
 <option>Linecard</option>
 <option>Howto</option>
</select>
</div> 
<div class="typelabel">Язык сайта (Language)</div>
<div class="typelabel">
<select size="1" style="width: 384px" id="languaged" onchange="Processgenerate()">
 <option value="" selected>Не указывать</option>
 <option value="ru">Russian</option>
 <option value="en">English</option>
 <option value="en-US">English - US</option>
 <option value="en-GB">English - GB</option>
 <option value="fr">French</option>
 <option value="de">German</option> 
 <option value="zh">Chinese</option> 
 <option value="es">Spanish</option> 
 <option value="it">Italian</option>  
 <option value="jp">Japanese</option> 
</select>
</div>
<div class="typelabel">Доступность для роботов (robots)</div>
<div class="typelabel">
<select size="1" style="width: 384px" id="robotsd" onchange="Processgenerate()">
 <option value="" selected>Не указывать</option>
 <option value="nofollow">Не проходить по ссылкам при индексации (nofollow)</option>
 <option value="noindex">Не индексировать (noindex)</option>
 <option value="noindex,nofollow">Не проходить по ссылкам и Не индексировать (noindex,nofollow)</option>
 <option value="index">Индексировать страницу (index)</option>
 <option value="follow">Следовать по ссылкам (follow)</option>
 <option value="index,follow">Индексировать и Следовать по ссылкам (index,follow)</option>
</select>
</div>
<div class="typelabel" style="margin: 4px 0 4px 0"><input type="checkbox" checked="checked" id="withhead" style="cursor: pointer" 
onclick="Processgenerate()">&nbsp;<label for="withhead" style="cursor: pointer">Создавать все тэги в секции &lt;head&gt;</label></div>

<div class="typelabel" style="margin: 4px 0 4px 0"><input type="checkbox" id="moretag" style="cursor: pointer" 
onclick="ShowMoreT(this)">&nbsp;<label for="moretag" style="cursor: pointer">Еще больше тэгов</label></div>
<div id="moretagsdata" style="display: none; padding-left: 6px">
 <div class="typelabel">Мета-тэг авторской записи (Copyright)</div>
 <div class="typelabel"><input type="text" class="inpt" value="" id="copyright" style="width: 380px" onblur="Processgenerate()"></div>
 <div class="typelabel">Дата последнего изменения документа (Expires) [пример: Wed, 26 Feb 1999 08:21:57 GMT]</div>
 <div class="typelabel"><input type="text" class="inpt" value="" id="expiresd" style="width: 380px" onblur="Processgenerate()"></div>
 <div class="typelabel">Контроль кэширования документа (Pragma) [пример: no-cache]</div>
 <div class="typelabel"><input type="text" class="inpt" value="" id="pragmad" style="width: 380px" onblur="Processgenerate()"></div>
 <div class="typelabel">Периодичность индексирования документа роботом (Revisit) (в днях) [пример: 7 = 1 раз в неделю]</div>
 <div class="typelabel"><input type="text" class="inpt" value="" id="revisitd" style="width: 380px" onblur="Processgenerate()"></div>
 <div class="typelabel">Основное зеркало документа (URL) [пример: "http://www.site.ru/]</div>
 <div class="typelabel"><input type="text" class="inpt" value="" id="URLd" style="width: 380px" onblur="Processgenerate()"></div>
 <div class="typelabel">Окно текущей страницы по умолчанию (Window-target) [пример: main]</div>
 <div class="typelabel"><input type="text" class="inpt" value="" id="wintarge" style="width: 380px" onblur="Processgenerate()"></div>
 <div class="typelabel">Иконка сайта (shortcut icon) [пример: /favicon.ico]</div>
 <div class="typelabel"><input type="text" class="inpt" value="" id="shortcutd" style="width: 380px" onblur="Processgenerate()"></div>
</div>

<div class="typelabel" style="margin-top: 15px"><b>Результат генерации тэгов</b><label style="margin-left: 6px; font-size: 90%">[<a href="javascript:" onclick="$('#datares').select();">выделить</a>]</label></div>
<div class="typelabel">
<textarea class="int_text" style="width: 96%; height: 160px" id="datares" readonly></textarea>
</div>  
 
 {/if}
</div>