/* объект анализа */

var AnalysisObj = {
   //vars as dinamic	
   allprocesscount: 0,
   allprocesscountpos: 0,
   curparampos: 0,
   cururlpos: 0,
   paramsnoupdate : '',
   paramslistitems: new Array(),
   urlslistitems: new Array(),
   timerid: false,
   isfirststart: true,
   statusexists: false,
   waiteveryiter: 0,
   waiteveryiterindex: 0,
   weitfortime: 0,
   weitfortimeindex: 0,
   requistinprocess: false,
   stoped: false,
   paused: false,
   
   /* запуск анализа */
   start: function (fromurl, fromparam) {
	if (fromurl) { this.cururlpos = fromurl; }
	if (fromparam) { this.curparampos = fromparam; }
	this.allprocesscount = this.urlslistitems.length + (this.paramslistitems.length * this.urlslistitems.length);
	this.allprocesscountpos = 0;
	this.isfirststart = true;
	this.statusexists = false;
	this.waiteveryiterindex = 1;
	this.waiteveryiter = 4;
	this.weitfortime = 5;
	this.weitfortimeindex = 1;
	this.requistinprocess = false;
	this.stoped = false;
	this.paused = false;	
	this.cleartimer();
	this.next();
   },
   
   /* продолжить с текущей позиции */
   next: function () {
	
	//check for stoped
	if (this.stoped || this.paused) { return false; }
	
	//finished
	if (this.Eof()) { return ShowStatus('hide'); }
	
	//wait for time
	if (this.waiteveryiter && this.waiteveryiterindex >= this.waiteveryiter) { return this.waitfor(); }
	
	//action
	this.showstatus('<label style="color: #008000">Execution..</label>');
	
	if (this.GetParamID()) {
	 
	 this.requistinprocess = true;
	 SendDefaultRequest(
      panelpath, 
      'is_ajax_mode=1&action=12&url='+encodeURIComponent(this.GetUrlID())+'&opt='+encodeURIComponent(this.GetParamID()),
      'AnalysisObj.redirect'
     );
    
    } else { this.redirect(-1); }
	
   },
   
   /* перенаправление */
   redirect: function (data) {
   	this.requistinprocess = false;
   	
   	if (data != -1) { this.setresult(data); }
   	
	this.waiteveryiterindex++;
	this.allprocesscountpos++;
	
	if (this.ParamsEof()) {
	 
	 this.curparampos = 0;
	 this.cururlpos++;
	 //this.allprocesscountpos++;	 
	 	
	} else {
	 
	 this.curparampos++;
	 	
	}	
	this.next();	
   },
   
   /* установка результата */
   setresult: function (data) {
   	
	if (!data) { return false; }
	
	if (data == '1') {		
	 if (panelstatuslk.displaynoupdateneed) { 		  
	  AddToLogElement('<u>'+this.GetParamName()+'</u> does not need to update the site <u>'+this.GetURLName()+'</u>');	  	
	 }	
	 
	 this.waiteveryiterindex--;
	 if (this.waiteveryiterindex < 0) { this.waiteveryiterindex = 0; } 
	 
	 return false;
	}
	
	var error = GetErrorData(data);
	if (error) { 
	 return AddToLogElement(
	  '<u>'+this.GetParamName()+'</u> for <u>'+this.GetURLName()+'</u>: <label style="color: #FF0000">'+error+'</label>'
	 ); 
	}
	
	//action to set new value
	$('#urlslisttabledata tbody').find('tr[urlrealid="'+this.GetUrlID()+'"] td[paramrealid="'+this.GetParamID()+'"]').each(
	 function (i) {	
      $(this).html(data);
      return false;	
     }
	);
	
	return true;
   },
   
   /* продолжить выполнение */
   gofrompause: function () { this.paused = false; this.next(); },
   
   /* текст остановки, паузы и прочих операций */
   GetActionText: function () {
	if (this.stoped || this.requistinprocess) { return ''; }
	
	var str = '';
	
	if (!this.paused && !this.timerid) {
	 str += '<a href="javascript:" onclick="AnalysisObj.pause()">Pause</a>';	
	}
	
	if (this.paused) {	 
	 str += '<a href="javascript:" onclick="AnalysisObj.gofrompause()">Continue</a>'; 	 	
	}
	
	str += (str) ? ', ' : '';
	
	str += '<a href="javascript:" onclick="AnalysisObj.stop()">Abort</a>';
	
	return ' '+str;
   },
   
   /* приостановка */
   pause: function () {
	this.paused = true;
	this.cleartimer();
	
	//wait for last action
	if (this.requistinprocess) { return this.waitforlastaction(); }
	
	this.showstatus('<b style="color: #808000">Execution is suspended...</b>', true);
	
	return true;
   },
   
   /* ожидание завершения последней операции */
   waitforlastaction: function () {
   	
   	var str = (this.stoped) ? 'stop' : 'pause';
   	
	this.showstatus('<b style="color: #333399">Waiting for last operation before '+str+'...</b>', true);
	 
	var handler_stop = function () {
	 AnalysisObj.showstatus('<b style="color: #333399">Waiting for last operation before '+str+'...</b>', true);
	 return (!AnalysisObj.requistinprocess) ? ((AnalysisObj.stoped) ? AnalysisObj.stop() : AnalysisObj.pause()) : false;	  	
    };
     
	this.timerid = window.setInterval(handler_stop, 1000);
	 
	return true;
   },
   
   /* остановка */
   stop: function () {
	
	this.stoped = true;	
	this.paused = false;
	this.cleartimer();
	
	//wait for last action
	if (this.requistinprocess) { return this.waitforlastaction(); }
	
	//display log
	if (!this.Eof()) { 
	 
	 AddToLogElement(
	  'The operation is stopped at <b>'+this.GetPersent(this.GetAllPosition(), this.GetAllMax())+'%</b>', '#993300'
	 );
	  
	}
	
	this.allprocesscount = 0;
	return ShowStatus('hide');		
   },
   
   /* очистка таймера */
   cleartimer: function () { if (this.timerid) { window.clearInterval(this.timerid); this.timerid = false; } },

   /* задержка выполнения */
   waitfor: function (asnext) {
	
	if (this.stoped) { return false; }
	
	if (!asnext) { 
	 this.waiteveryiterindex = 1;			
	 this.weitfortimeindex = 1;
	 
	 this.showstatus('<b>Waiting...</b>', true);
	 
	 var handler = function () { return AnalysisObj.waitfor(true); };	 
	 this.timerid = window.setInterval(handler, 1000);
	  
	 return true;  
	}
	
	if (this.weitfortime - this.weitfortimeindex <= 0) {			
	 this.cleartimer();
	 return this.next();		
	}
	
	this.showstatus('<b>Waiting... (<b>'+(this.weitfortime - this.weitfortimeindex)+'</b> sec)</b>', true);
	
	this.weitfortimeindex++;
	return true;
   },
   
   /* статус числовой всего */
   tGetAll: function () {
	return 'Total progress operation: <b>'+this.GetPersent(this.GetAllPosition() + 1, this.GetAllMax())+'%</b>, ('+
	(this.GetAllPosition() + 1) + ' of ' + this.GetAllMax() + ') completed';	  
   },
   
   /* статус числовой url */
   tGetURL: function () {
    return 'Site Analysis: <u style="color: #0000FF">'+this.GetURLName()+'</u>, (<b>'+
    this.GetPersent(this.GetUrlsPos() + 1, this.GetUrlsMax()) + '%</b>, '	+ 
    (this.GetUrlsPos() + 1) + ' of ' + this.GetUrlsMax() + ')';	  
   },
	 
   /* статус числовой params */
   tGetParam: function () {
    return 'Current Parameter: <label style="color: #0000FF">'+this.GetParamName()+'</label>, (<b>'+
    this.GetPersent(this.GetParamsPos() + 1, this.GetParamsMax()) + '%</b>, '	+ 
    (this.GetParamsPos() + 1) + ' of ' + this.GetParamsMax() + ')';	  
   },
   
   /* отображение статуса */
   showstatus: function (data, onlytext) {
    
    if (!this.StatusExists()) {	
	 ShowStatus(
	  '<div id="processupdatedividentblock" style="padding: 4px; text-align: left; display: inline">'+
	   
	   //общий статус
	   '<div id="strglobalprogressstatus">'+data+this.GetActionText()+'</div>'+
	   
	   //числовые данные (общий прогресс)
	   '<div id="progressnumericvaluesstAll" style="padding-top: 10px">'+this.tGetAll()+'</div>'+
	   
	   //числовые данные (прогресс сайта)
	   '<div id="progressnumericvaluesstURL" style="padding-top: 5px">'+this.tGetURL()+'</div>'+
	   
	   //числовые данные (прогресс показателя)
	   '<div id="progressnumericvaluesstParam" style="padding-top: 5px">'+this.tGetParam()+'</div>'+	   
	   	  
	  '</div>'
	 );	  
	} else {
	 
	 var elem = this;
	 
	 $('#processupdatedividentblock div').each(function (i) {
	  var ident = $(this).attr('id');
	  
	  switch (ident) {
	   case 'strglobalprogressstatus'     : $(this).html(data + elem.GetActionText()); break;	
	   case 'progressnumericvaluesstAll'  : if (!onlytext) { $(this).html(elem.tGetAll()); } break; 
	   case 'progressnumericvaluesstURL'  : if (!onlytext) { $(this).html(elem.tGetURL()); } break; 
	   case 'progressnumericvaluesstParam': if (!onlytext) { $(this).html(elem.tGetParam()); } break;	
	  }
	  
	  return true;	
	 }); 
	 
	}
	
	if (!this.statusexists) { this.statusexists = true; }
   },
   
   /* процент выполнения */
   GetPersent: function (cur, max) { return Math.round((cur * 100 / max) * 100) / 100; },
   
   /* существование статуса */
   StatusExists: function () {
	if (!this.isfirststart) { return this.statusexists; }	
	this.statusexists = false;	
	$('div[id="processupdatedividentblock"]').each(function (i) { this.statusexists = true; return false; });
	this.isfirststart = false;	 
	return this.statusexists; 
   },    
   
   /* конец */
   Eof: function () { return (this.GetAllMax() <= this.GetAllPosition()); },
   
   /* конец параметров */
   ParamsEof: function () { return (this.GetParamsMax() <= this.GetParamsPos()); },
   
   /* конец сайтов */
   UrlsEof: function () { return (this.GetUrlsMax() <= this.GetUrlsPos()); },
   
   /* текущая позиция по общему процессу */
   GetAllPosition: function () { return this.allprocesscountpos; },
   
   /* всего длина операции  */
   GetAllMax: function () { return this.allprocesscount; },
   
   /* длина по параметрам */
   GetParamsMax: function () { return this.paramslistitems.length; },
   
   /* позиция по параметрам */
   GetParamsPos: function () { return this.curparampos; },
   
   /* текущий элемент параметра */
   GetParamID: function () { return (this.ParamsEof()) ? false : this.paramslistitems[this.curparampos]; },
   
   /* имя текущего параметра */
   GetParamName: function (ident) { return GetParamNameById((ident) ? ident : this.GetParamID()); },
   
   /* длина по сайтам */
   GetUrlsMax: function () { return this.urlslistitems.length; },
   
   /* позиция по параметрам */
   GetUrlsPos: function () { return this.cururlpos; },
   	
   /* теущий элемент сайта */
   GetUrlID: function () { return (this.UrlsEof()) ? false : this.urlslistitems[this.cururlpos]; },
   
   /* имя текущего сайта */
   GetURLName: function (ident) { return GetURLnameById((ident) ? ident : this.GetUrlID()); }	
		
  };