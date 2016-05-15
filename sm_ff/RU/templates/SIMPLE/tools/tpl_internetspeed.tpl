{* скорость соединения с интернет *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам проверить скорость Вашего интернет соединения. Проверка выполняется на скорость `загрузки` файлов с интернета на компьютер и скорость `выгрузки` файлов в интернет. Проверенную скорость Вы можете сохранить у себя на сайте или в подписи форума в виде информера.
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
 //---------------
 var time_damp = 0; 
 function StartTimeData() { ttm = new Date(); time_damp = ttm.getTime(); }//StartTimeData 
 function GetTimeData() {
  var time2 = 0;
  ttm2 = new Date();
  time2 = ttm2.getTime();
  if (time2 == time_damp || time2 <= 0) { return 0; } 
  return (time2 - time_damp) / 1000;	
 }//GetTimeData
 //---------------
 var q_sitepath = '{/literal}{$smarty.const.W_SITEPATH}{literal}';
 var toolpath  = q_sitepath + '{/literal}tools/{$tool_object->section_id}/{literal}';
 var querydata = '';
 var speeddownload = 0;
 var speeddownloadKbyte = 0;
 var speedupload = 0;
 var speeduploadKbyte = 0;
 var bobj = false;
 //---------------
 function CreateIFrame() {  	
    var FrameId = 'f' + Math.floor(Math.random() * 99999);
    {/literal}
    {if $CONTROL_OBJ->stripos($CONTROL_OBJ->GetUserAgent(), 'opera') !== false}
     {literal}
     var IFrameElement = document.createElement('iframe'); 
     IFrameElement.id = FrameId;
     IFrameElement.name = FrameId;
     IFrameElement.setAttribute("name", FrameId);
     IFrameElement.setAttribute("id", FrameId);
     IFrameElement.style.visibility = 'hidden';
     IFrameElement.style.display = 'none';
     IFrameElement.src = 'about:blank';
     document.body.appendChild(IFrameElement);
     return IFrameElement;
     {/literal}
    {else}
     {literal}
     var tmp = document.createElement("div");
     tmp.innerHTML = '<iframe name="'+FrameId+'" id="'+FrameId+'" style="display: none; visibility: hidden"></iframe>';
	 var ff = tmp.firstChild;
	 document.body.appendChild(ff);
     return ff;
     {/literal}
    {/if} 
    {literal}
 }
 function SendForm(FormId) {
    var Form = document.getElementById(FormId);
    var IFrame = CreateIFrame();
    Form.target = IFrame.id;
    Form.setAttribute('target', IFrame.id); 
	StartTimeData();   
    Form.submit();
 } 
 //--------------- 
 function PrepereRequestData(data, end) {
  if (!end) { 
  	querydata = data; 
    $('#datasource').html(
	 '\r\n' + data + "\r\n\r\n" + 
	 "<script type=\"text/javascript\">PrepereRequestData(1, 1);<\/script>"	+
	 '<form style="display: none; visibility: hidden" method="post" enctype="multipart/form-data" '+
	 'name="uploadform" id="uploadform">' + 
	  '<textarea name="data">' + querydata + '</textarea>' +
	  '<input type="hidden" value="1" name="is_ajax_mode">' +
	 '</form>' +
	 "<script type=\"text/javascript\">" + 
	  "SetStatusProcess('Замер скорости Upload...');" + 
	  "SendForm('uploadform');" +	 
	 "<\/script>" 
	);
	return false; 
  }
  var speeddownloadtime = GetTimeData();
  speeddownloadtime = (speeddownloadtime <= 0) ? 1 : speeddownloadtime;
  speeddownload = Math.round((1024 * 8 / speeddownloadtime) * 100) / 100;
  speeddownloadKbyte = Math.round((1024 / speeddownloadtime) * 100) / 100;	  
  StartUploadSpeedTest();  	
 }//PrepereRequestData
 //---------------
 function SetStatusProcess(str) {
  $('#statusid').html(
   '<div style="position: relative; left: -5px"><img src="' + q_sitepath + 'athemes/SIMPLE/img/ajax-loader.gif"></div>' + 
   '<div>' + str + '</div>'
  );	
 }//SetStatusProcess
 //--------------- 
 //download speed 
 function StartDownLoadSpeedTest(th) {
  bobj = th;
  RestoreInformerDatas();
  th.disabled = true;	
  SetStatusProcess('Замер скорости Download...');	
  StartTimeData();
  SendDefaultRequest(toolpath, 'is_ajax_mode=1&getdata=1&type=1024', 'PrepereRequestData');  	
 }//StartDownLoadSpeedTest 
 //---------------
 function GenerateTable(data) {
  return '<span style="width: 100%">' + 
   '<table width="96%" cellpadding="0" cellspacing="0" border="0">' +
   data +
   '</table>' +
   '</span>';  	
 }//GenerateTable
 //---------------
 function GenerateTr(info1, info2) {
  return '<tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">' +
   '<td class="sth1" valign="center" align="left" width="250px">' +
   info1 +
   '</td>' +	 
   '<td class="sth1" valign="center" align="left" style="padding-left: 8px;">' +
   info2 +
   '</td>' +
   '</tr>';  	
 }//GenerateTr
 //---------------
 function PrepereRequestDataUpload(data) {	
  var speeduploadtime = GetTimeData();  
  speeduploadtime = (speeduploadtime <= 0) ? 1 : speeduploadtime;
  speedupload = Math.round((1024 * 8 / speeduploadtime) * 100) / 100;
  speeduploadKbyte = Math.round((1024 / speeduploadtime) * 100) / 100;  
  //alert(data);
  $('#statusid').html(
   GenerateTable(
    GenerateTr(
     '<span style="position: relative; top: 2px"><img src="' + 
	 q_sitepath + 'img/items/download.png" width="16" height="16"></span>' +
	 'Скорость загрузки (Download)', 
	 '<b>' + speeddownload + ' Kbit/s</b>' + 
	 '<label style="margin-left: 6px; font-size: 95%">(' + speeddownloadKbyte + ' Kbyte/s)</label>'
	) +
    GenerateTr(
     '<span><img src="' + q_sitepath + 'img/items/upload.png" width="16" height="16"></span>' +
	 'Скорость отдачи (Upload)', 
	 '<b>' + speedupload + ' Kbit/s</b>' + 
	 '<label style="margin-left: 6px; font-size: 95%">(' + speeduploadKbyte + ' Kbyte/s)</label>'
	)
   )
  );
  bobj.disabled = false;
  ShowSelectInformerButton();  	
 }//PrepereRequestDataUpload
 //---------------
 //upload test
 function StartUploadSpeedTest() {  	
  return false;	
 }//StartUploadSpeedTest 1048596
 
 function DoHigl(th, n) {	
  if (n) { $(th).css('background','#F9FAFB'); } else {   	
   $(th).css('background', 'none');		
  }	
 }//DoHigl 
 
 //---------------
 //restore informers id`s
 function RestoreInformerDatas() {
  //select inf
  $('#informerbutton').css('display', 'none');
  $('#informerbutton').css('visibility', 'hidden');
  //data
  $('#informerdata').html('');
  $('#informerslist').css('display', 'none');	
 }//RestoreInformerDatas
 	   
 //show select button
 function ShowSelectInformerButton() {
  RestoreInformerDatas();
  $('#informerbutton').css('display', 'block');
  $('#informerbutton').css('visibility', 'visible');
  $('#informerslist').css('display', 'block');  	
 }//ShowSelectInformerButton
 
 //action do select inf list
 function GetInformersList() {
  //select button do hide
  $('#informerbutton').css('display', 'none');
  $('#informerbutton').css('visibility', 'hidden');
  //status
  $('#informerdata').html(
   '<div style="position: relative; left: -5px"><img src="' + q_sitepath + 'athemes/SIMPLE/img/ajax-loader.gif"></div>' + 
   '<div>Получение списка информеров..</div>'
  );
  //disabled start button
  var bb = document.getElementById('startbutton');
  if (bb) { bb.disabled = true; }
  //action query  
  SendDefaultRequest(toolpath, 'is_ajax_mode=1&getinflist=1&dw=' + 
  str_replace('.', '-', speeddownload) + '&up=' + str_replace('.', '-', speedupload), 'PrepereRequestDataInfList');	
 }//GetInformersList
 
 function PrepereRequestDataInfList(data) {
  //get all data
  $('#informerdata').html(
   '<div style="margin-top: 12px">&nbsp;</div>' +
   '<form method="post" name="wwwinf" id="wwwinf">' + data + 
   '<div style="margin-top: 14px">' +  
   '<input type="button" value="&nbsp;Подтвердить выбор&nbsp;" class="button" onclick="SelectInformer(this)">' +
   '</div>' +    
   '</form>'  
  );
  //enabled items
  var bb = document.getElementById('startbutton');
  if (bb) { bb.disabled = false; }   	
 }//PrepereRequestDataInfList	  
 
 //select informer data
 function SelectInformer(th) {
  var ff = document.getElementById('wwwinf');
  if (!ff) { alert('Невозможно обнаружить информеры! Повторите попытку теста скорости..'); return false; }
  if (!ff.selectedinformer || !ff.selectedinformer.value) {
   alert('Выберите информер, который Вы хотите использовать!');
   return false;	
  }
  var query = 'is_ajax_mode=1&selectinf=1&infid=' + ff.selectedinformer.value;
  var cc = document.getElementById('colorInput'+ff.selectedinformer.value);
  if (cc && cc.value) { 
   query = query + '&rcolor=' + str_replace('#', '_r_', cc.value);  
  }
  query = query + '&dw=' + str_replace('.', '-', speeddownload) + '&up=' + str_replace('.', '-', speedupload);
  //status
  $('#informerdata').html(
   '<div style="position: relative; left: -5px"><img src="' + q_sitepath + 'athemes/SIMPLE/img/ajax-loader.gif"></div>' + 
   '<div>Создание информера, пожалуйста, подождите..</div>'
  );
  var bb = document.getElementById('startbutton');
  if (bb) { bb.disabled = true; }
  SendDefaultRequest(toolpath, query, 'PrepereRequestDataInfListSelect');  	
 }//SelectInformer	    
 
 function PrepereRequestDataInfListSelect(data) {
  var bb = document.getElementById('startbutton');
  if (bb) { bb.disabled = false; }
  //result
  $('#informerdata').html(
   data
  );  	
 }//PrepereRequestDataInfListSelect
	    
 </script> 
 <style type="text/css">
      .h_th1, .h_td, .h_td2 { 
       border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; border-right: none; 
       border-right: none; font-weight: bold; 
      }
      .h_td { border-left: none; }
      .h_td2 { border-right: 1px solid #E3E4E8; border-left: none; }
      .btn_n { border: 1px solid #E3E4E8; border-top: none; height: 25px; margin-top: 4px; }
      .sth1 { border-bottom: 1px solid #E3E4E8; height: 25px; border-top: none; } 	
 </style>
 {/literal}
   
 <div>&nbsp;</div>
 <input type="button" value="&nbsp;Запустить тест скорости&nbsp;" class="button" id="startbutton" onclick="StartDownLoadSpeedTest(this)">

 
 <div id="statusid" style="margin-top: 20px"><div>&nbsp;</div><div>&nbsp;</div></div>
 
 <div style="display: none">
  <div id="datasource" style="overflow: auto; width: 2px; height: 2px"></div>
 </div>
 
 <div style="display: none; margin-top: 14px" id="informerslist">
  <div id="informerdata"></div>
  <div id="informerbutton" style="display: none; visibility: hidden; margin-top: 10px">
   <input type="button" value="&nbsp;Выбрать информер&nbsp;" class="button" onclick="GetInformersList()">
  </div>
 </div> 
 
 {/if}
</div>