 //------------------------------------------------------
 /** глобальный идентификатор пути запроса */
 var dPathRequstAction = (PathRequstAction) ? PathRequstAction : '/ajax/';
 /** глобальный каталог сайта */
 var dPathHost = (PathHost) ? PathHost : '/';
 //------------------------------------------------------
 var stat_image_progress = '<span style="display: inline-block; margin-left: 5px; position: relative; top: 5px"><img src="'+
						   dPathHost+'img/items/ajax-loader.gif"></span></div>';
 
 if (!ErrorsList) { 
  var ErrorsList = new Array();
  ErrorsList['nocorrectpage']      = 'Ошибка целостности страницы';
  ErrorsList['nourlsforanalize']   = 'Нет данных для анализа';
  ErrorsList['gotonextitemlist']   = 'Ожидание следующего сайта...<br />(<b>[%s]</b> из <b>[%s]</b>)';
  ErrorsList['ispausedactionbe']   = 'Превышено максимальное количество проверяемых сайтов!';
  ErrorsList['ispausedonactionl']  = 'Проверка приостановлена на (страница <b>Arrayindexed</b> из <b>Arraylenght</b>)...';
  ErrorsList['isprocessactionit']  = 'Анализ : <b>Linkfcheck</b>..<br />(<b>Arrayindexed</b> из <b>Arraylenght</b>)';
  ErrorsList['preperetostartajax'] = 'Подготовка к остановке проверок...<br />(<b>[%s]</b> из <b>[%s]</b>)';
  ErrorsList['preptopausedajms']   = 'Подготовка к приостановке проверок на позиции <b>Arrayindexed</b> из <b>Arraylenght</b>...'+
                                     '<br />(<b>[%s]</b> из <b>[%s]</b>)';
  ErrorsList['actionisstoppedb']   = 'Проверка остановлена...';
  ErrorsList['actionisfinishedb']  = 'Проверка завершена...'; 
  ErrorsList['actiontopaynolimit'] = 'Вы действительно хотите отменить лимит проверки?\r\nС вашего счета будет снята сумма в размере [%s] USD\r\nПродолжить?';
  ErrorsList['actiontopayststusq'] = 'Обработка запроса, подождите..';   
 }
 ErrorsList['isprocessactionit']   = '<div>' + ErrorsList['isprocessactionit']   + stat_image_progress;
 ErrorsList['gotonextitemlist']    = '<div>' + ErrorsList['gotonextitemlist']    + stat_image_progress;
 ErrorsList['preptopausedajms']    = '<div>' + ErrorsList['preptopausedajms']    + stat_image_progress;
 ErrorsList['preperetostartajax']  = '<div>' + ErrorsList['preperetostartajax']  + stat_image_progress;
 
 ErrorsList['actiontopayststusq']  = '<label style="margin-left: 6px; font-size: 95%">'+ErrorsList['actiontopayststusq']+'</label>';
 
 if (!WColorsList) {
  var WColorsList = new Array();
  WColorsList['nocorrectpage']      = '#FF0000'; //'Ошибка целостности страницы';
  WColorsList['nourlsforanalize']   = '#FF0000'; //'Нет данных для анализа';
  WColorsList['gotonextitemlist']   = '#775C40'; //'Переход к следующему сайту...';
  WColorsList['ispausedactionbe']   = '#FF0000'; //'Превышено максимальное количество проверяемых сайтов!';
  WColorsList['ispausedonactionl']  = '#775C40'; //'Проверка приостановлена на ';
  WColorsList['isprocessactionit']  = '#775C40'; //'Анализ : <b>Linkfcheck</b>..<br />';
  WColorsList['preperetostartajax'] = '#775C40'; //'Подготовка к остановке проверок...';
  WColorsList['preptopausedajms']   = '#775C40'; //'Подготовка к приостановке проверок ..';
  WColorsList['actionisstoppedb']   = '#800000'; //'Проверка остановлена...';
  WColorsList['actionisfinishedb']  = '#000000'; //'Проверка завершена...';
 }
 //------------------------------------------------------								   
 var ArrayChecked;
 var Arrayindexed = 0;
 var Arraylenght  = 0;
 var isStopedChecki = true;
 var isprocessed = false;
 var incerdata_count = 0; 
 var globcountdata = 0;
 var ident_area = 'urls';
 var Linkfcheck = '';
 var AdditionsQuery = '';
 var func_more_objects_access = '';
 
 function EnabledButtons(asall) {	
  $('#startb').attr('disabled', (asall) ? 1 : isprocessed);
  $('#stopb').attr('disabled', (asall) ? 1 : !isprocessed);
  $('#pauseb').attr('disabled', (asall) ? 1 : !isprocessed);
  EnabledAllDatas(asall);	
 }//EnabledButtons
 
 function WriteStatus(str, color) {
  var data = $('#getprocessedid');
  data.css('color', color);
  data.html(str);
  return false;  	
 }//WriteStatus
 
 function GetParametersChecking() {
  var data  = $('#'+ident_area);
  if (!data) { return WriteStatus(ErrorsList['nocorrectpage'], WColorsList['nocorrectpage']); } 
  if (!isStopedChecki) {
   Linkfcheck = ArrayChecked[Arrayindexed];
   Arrayindexed++;
   return true;	
  }
  Arraylenght = 0;	
  Arrayindexed= 0;
  var source  = $('#processedsource'); 
  source.html('');  
  var spsource  = data.val(); 
  spsource  = spsource.replace(/\r\n|\r|\n/g,':bbbrr:');  
  if (spsource == "") { 
   data.focus();
   return WriteStatus(ErrorsList['nourlsforanalize'], WColorsList['nourlsforanalize']);	
  } 
  var separator = ':bbbrr:';
  ArrayChecked = GetCorretArray(spsource.split(separator));
  Arraylenght  = ArrayChecked.length;
  if (Arraylenght > 0) {
	Linkfcheck = ArrayChecked[0];
	Arrayindexed = 0;
  } else {
   data.focus();
   return WriteStatus(ErrorsList['nourlsforanalize'], WColorsList['nourlsforanalize']);	
  }
  data.val('');
  for (var i=0; i < ArrayChecked.length; i++) {
   data.val(((i == 0) ? '' : data.val() + "\r\n") + ArrayChecked[i]);   	
  }
  Arrayindexed++;
  return true; 	
 }//GetParametersChecking
 
 function GetCorrectReplStringPosition(stid) {
  var index_w = Arrayindexed;
  var count_w = Arraylenght;
  if (index_w > count_w) { index_w = count_w; }
  return str_replace('[%s]', count_w, str_replace('[%s]', index_w, ErrorsList[stid], 1), 1);	
 }//GetCorrectReplStringPosition 
  
 function WaitForProcess(asnext, waied) {  	
  WriteStatus(GetCorrectReplStringPosition('gotonextitemlist') ,WColorsList['gotonextitemlist']);  	
  setTimeout('StartChecking(false, \''+asnext+'\',1)', 1000);	
 }//WaitForPrecess 
 
 function StartChecking(identact, asnext, waied, additq, func_a_obj) {
  if (identact) { 
   ident_area = identact;
   AdditionsQuery = (additq) ? additq : '';
   func_more_objects_access = (func_a_obj) ? func_a_obj : ''; 
  } 	
  if (incerdata_count > 0 && (Arrayindexed >= incerdata_count)) {
   StopChecking();  	
   CompleateDatas();
   WriteStatus(ErrorsList['ispausedactionbe'], WColorsList['ispausedactionbe']);
   //EnabledButtons();	
   //isprocessed = true;
   return false;	
  } 			
  if (asnext) {   		
   if (!waied) { return (Arrayindexed >= Arraylenght) ? StartChecking(false, 1, 1) : WaitForProcess(asnext); }	
   if (!isprocessed && !isStopedChecki) {  	 	
    WriteStatus(
	 str_replace('Arrayindexed', Arrayindexed, str_replace('Arraylenght', Arraylenght, ErrorsList['ispausedonactionl']))
	 , WColorsList['ispausedonactionl']
	);
    EnabledButtons();	
    isprocessed = true;
	return false;	
   }
   if (!isprocessed && isStopedChecki) {
    CompleateDatas();
	return false;	
   }  	
  }
  var secform = $('#'+ident_area);	
  if (!secform) { return WriteStatus(ErrorsList['nocorrectpage'], WColorsList['nocorrectpage']); }
  if (secform.val() == '') { 
   secform.focus();  
   return WriteStatus(ErrorsList['nourlsforanalize'], WColorsList['nourlsforanalize']); 
  }
  if (!GetParametersChecking()) { return false; }
  if (Arrayindexed > Arraylenght) {
   CompleateDatas();
   return false;	
  }  
  isprocessed = true;
  isStopedChecki = false;
  EnabledButtons();	
  WriteStatus('', WColorsList['isprocessactionit']);
  var querydata = encodeURIComponent(Linkfcheck);		  
  SendRequest('POST','&is_ajax_mode=1&item='+querydata+'&index='+Arrayindexed+'&count='+Arraylenght+AdditionsQuery,'getprocessedid',
  str_replace('Linkfcheck', HTML.encode(Linkfcheck), str_replace('Arrayindexed', Arrayindexed, str_replace('Arraylenght', Arraylenght,
   ErrorsList['isprocessactionit']
  ))), '', dPathRequstAction, dPathRequstAction, "StartChecking(false, '1')");  	
 }//start 
 
 function StopChecking() {
  EnabledButtons(true);	
  isprocessed = false;
  isStopedChecki = true;
  WriteStatus(GetCorrectReplStringPosition('preperetostartajax'), WColorsList['preperetostartajax']);	
 }//StopChecking
  
 function PausedChecking() {
  EnabledButtons(true);	
  isprocessed = false;
  isStopedChecki = false;
  WriteStatus(
   str_replace('Arrayindexed', Arrayindexed, str_replace('Arraylenght', Arraylenght, 
   GetCorrectReplStringPosition('preptopausedajms'))), WColorsList['preptopausedajms']
  );  	
 }//PausedChecking
 
 function EnabledAllDatas(asall) {	  	
  $('#'+ident_area).attr('disabled', (asall) ? 1 : isprocessed);
  //дополнительные элементы блокировки
  if (func_more_objects_access) {
   eval(func_more_objects_access + '(' + ((asall) ? 1 : isprocessed) + ');');   	
  }  
 }//EnabledAllDatas
 
 function CompleateDatas() {
  if (isprocessed) {	
   WriteStatus(ErrorsList['actionisfinishedb'], WColorsList['actionisfinishedb']);	
  } else { WriteStatus(ErrorsList['actionisstoppedb'], WColorsList['actionisstoppedb']); }	
  isprocessed = false;
  isStopedChecki = true;
  Arrayindexed = 0;
  Arraylenght = 0;
  Linkfcheck = '';
  EnabledButtons();	
 }//CompleateDatas
//------------------------------------------------------
 var isnolimitednow = false;
 var resultpaymessage = '';
 var valdataissubject = '';
 
 function FinishedPayData(ident) {		
  if (isnolimitednow) { $('#'+ident).html(''); return false; }
  $('#'+ident).html(valdataissubject);
  if (resultpaymessage != '') { alert(resultpaymessage); } else { $('#'+ident).html(''); }  	
 }//FinishedPayData
 
 function ProcessPayLimitOff(ident) {
  if (!confirm(ErrorsList['actiontopaynolimit'])) { return false; }
  valdataissubject = $('#'+ident).html();
  SendRequest('POST','&is_ajax_mode=1&item=&index=1&count=1&tolimitoff=1',ident, ErrorsList['actiontopayststusq'], '', 
  dPathRequstAction, dPathRequstAction, "FinishedPayData('"+ident+"')");  	
 }//ProcessPayLimitOff
//------------------------------------------------------
/* Copyright (с) 2011 forwebm.net */