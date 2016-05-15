//------------------------------------------------------------------------
var onlineaction = 0;
//------------------------------------------------------------------------
function createXMLHttpRequest() {
	var xmlReq = false;
	
	if(window.XMLHttpRequest) {
		try {
			xmlReq = new XMLHttpRequest();
		} catch(e) {
			xmlReq = false;
		}
	} else if(window.ActiveXObject) {
		try {
			xmlReq = new  ActiveXObject("Msxml2.XMLHTTP");
		} catch(e) {
			try {
				xmlReq = new  ActiveXObject("Microsoft.XMLHTTP");
			} catch(e) {
				xmlReq = false;
			}
		}
	}
	if (!xmlReq) {alert("Error in create reguest object!"); return ;}
	return xmlReq;
}
//------------------------------------------------------------------------
function SendDefaultRequest(tofile, query, funconfifnish, method) {
 var xmlReq = createXMLHttpRequest();
 if(xmlReq) {
    url = tofile + (method && method == "GET") ? ('?' + query) : '';	
 	if (!method) { method = 'POST'; } 
 	xmlReq.onreadystatechange = function() {
 		if (xmlReq.readyState == 4) {
 			if (xmlReq.status == 200 || xmlReq.status == 201) {
 				//if (xmlReq.responseText != '') {	 				 
 				 eval(funconfifnish+'(xmlReq.responseText);');			 	 					 	
				//}
			}
		}
	};
	if (method == "GET") {
	 xmlReq.open(method, url, true);
	 xmlReq.send(null);		 	
	}
	else
	{	
        xmlReq.open(method, url, true);         
        xmlReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=utf-8"); 
        xmlReq.setRequestHeader("Content-length", query.length); 
        xmlReq.setRequestHeader("Connection", "close"); 
        xmlReq.send(query);
	}
	return false;
 }
 return true; 	
}
//------------------------------------------------------------------------
function SendRequest(method,query,wid,wait,back,fileofajax,errorfile,execafter) {
	if (wid != "") {
	 document.getElementById(wid).innerHTML = wait;
	}
	if (!fileofajax) {	
	 var url = '/ajax/action.php';
	 if (method == "GET") { url = url + '?' + query; }	
	 var errorfile1 = "action.php";
	}
	else {		
	 var url = fileofajax;
	 if (method == "GET") { url = url + '?' + query; }
	 var errorfile1 = errorfile;	
	 //alert(url);
	}	
	var xmlReq = createXMLHttpRequest();
	if(xmlReq) {
		xmlReq.onreadystatechange = function() {
			if (xmlReq.readyState == 4) {
				if (xmlReq.status == 200 || xmlReq.status == 201) {
					if (xmlReq.responseText != '') {
						if (xmlReq.responseText.indexOf(errorfile) > 0) {
						  alert("Во время выполнение произошла ошибка! - возможно было превышено время выполнение...");	
						  alert(xmlReq.responseText);
						}
						else
						{
						 //alert(xmlReq.responseText);	
						 eval(xmlReq.responseText);	
						 if (execafter) {
						  if (execafter != "") {
						   eval(execafter);	
						  }	
						 }						 
						}
						if (back != "") {
						 if (document.getElementById(wid)) {
						  document.getElementById(wid).innerHTML = back;
						 }
						}
					   onlineaction = 0; 	
					}
				}
			}
		};
		if (method == "GET") {
		 xmlReq.open(method, url, true);
		 xmlReq.send(null);		 	
		}
		else
		{	
         xmlReq.open(method, url, true); 
         xmlReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
         xmlReq.setRequestHeader("Content-length", query.length); 
         xmlReq.setRequestHeader("Connection", "close"); 
         xmlReq.send(query);
		}
		return false;
	}
	return true;
}

//------------------------------------------------------------------------
function CheckOnlineAction() {
 if (onlineaction > 0) {
  alert('Пожалуйста, подождите....\r\nИдет выполнение операции... \r\n \r\nЕсли вы считаете, что прошло уже слишком много времени - обновите страницу, при повторной ошибке - обратитесь в службу технической поддержки! ');
  return false;	
 }	
 onlineaction = 1;
 return true;
}

//------------------------------------------------------------------------
// JavaScript Document
function gotpage(npage){ window.location = npage; }
//------------------------------------------------------------------------
<!-- проверка e-mail фдреса -->
function emailCheck(emailStr) {
var checkTLD=1;
var knownDomsPat=/^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum)$/;
var emailPat=/^(.+)@(.+)$/;
var specialChars="\\(\\)><@,;:\\\\\\\"\\.\\[\\]";
var validChars="\[^\\s" + specialChars + "\]";
var quotedUser="(\"[^\"]*\")";
var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
var atom=validChars + '+';
var word="(" + atom + "|" + quotedUser + ")";
var userPat=new RegExp("^" + word + "(\\." + word + ")*$");
var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");
var matchArray=emailStr.match(emailPat);
if (matchArray==null) {
return false;
}
var user=matchArray[1];
var domain=matchArray[2];
for (I=0; I<user.length; I++) {
if (user.charCodeAt(I)>127) {
return false;
   }
}
for (I=0; I<domain.length; I++) {
if (domain.charCodeAt(I)>127) {
return false;
   }
}
if (user.match(userPat)==null) {
return false;
}
var IPArray=domain.match(ipDomainPat);
if (IPArray!=null) {
for (var I=1;I<=4;I++) {
if (IPArray[I]>255) {
return false;
   }
}
return true;
}
var atomPat=new RegExp("^" + atom + "$");
var domArr=domain.split(".");
var len=domArr.length;
for (I=0;I<len;I++) {
if (domArr[I].search(atomPat)==-1) {
return false;
   }
}
if (checkTLD && domArr[domArr.length-1].length!=2 &&
domArr[domArr.length-1].search(knownDomsPat)==-1) {
return false;
}
if (len<2) {
return false;
}
return true;
}
//------------------------------------------------------------------------
function IisInteger(num,maxi) {
 if (!maxi) {	
 if (isNaN(num) || (num == "") || (num.indexOf(',') > 0) || (num.indexOf('.') > 0) || (num < 0) || (num > 1500)) {	
  return false;	} else {	return true; } } else {
  if (isNaN(num) || (num == "") || (num.indexOf(',') > 0) || (num.indexOf('.') > 0) || (num < 0)) {	
  return false; } else { return true; } }  	
}
//------------------------------------------------------------------------
function IsFloat(num) {
  if (isNaN(num) || (num == "") || (num.indexOf(',') > 0) || (num < 0)) {	
   return false; } else { return true; } 	
}
//------------------------------------------------------------------------
//позиция курсора в textarea
function getCaretPos(obj) {
  obj.focus(); 
  if(obj.selectionStart) return obj.selectionStart;//Gecko
  else if (document.selection)//IE
  {
    var sel = document.selection.createRange();
    var clone = sel.duplicate();
    sel.collapse(true);
    clone.moveToElementText(obj);
    clone.setEndPoint('EndToEnd', sel);
    return clone.text.length;
  }
  return 0;
}
//------------------------------------------------------------------------
function ReplTextBlock(startdata,enddata,iddata) {
 var obj = document.getElementById(iddata);
 if (!obj) {return false;}
 //var pos = getCaretPos(obj);
 obj.focus();
 if (document.selection) {
 var s = document.selection.createRange(); 
 
 if (s.text != "") {
 
  var len = s.text.length;
  var newText= startdata + s.text + enddata;
  s.text = newText;
  obj.focus();
  s.select(); //выделяем
 }
 else
 {
  var newText= startdata + s.text + enddata;
  s.text = newText;
  s.moveEnd("character",-enddata.length);	
  obj.focus();
  s.select(); //выделяем  	
 } 
  return true;
 }
 else if (typeof(obj.selectionStart)=="number") {
  var start = obj.selectionStart;
  var end   = obj.selectionEnd;
  var selt  = obj.value.substr(start,end-start);
  var rs    = startdata + selt + enddata;
  obj.value = obj.value.substr(0,start)+rs+obj.value.substr(end);
  
  if (selt == "") {
  	if (enddata != "") {
	 start = start + startdata.length;	
	 end   = start;
	}
   	else
   	{	 	
   	 end   = start + startdata.length;
   	} 
  }
  else
  {
   	start = start + startdata.length;
   	end   = start + rs.length - enddata.length - startdata.length;
  }
  obj.setSelectionRange(start,end);
  return true;
 }
 return false; 	
}
//------------------------------------------------------------------------
 function InsertObhvatData(startdata,enddata,iddata) {	  
  return ReplTextBlock(startdata,enddata,iddata);	
 }  
//------------------------------------------------------------------------	 
 function InsertLink(iddata) {	  
  var hrefdata =  prompt ("Введите адрес ссылки!", "http://" );
  if ((!hrefdata) || (hrefdata == "") || (hrefdata.toLowerCase() == "http://")) { return ; }
  var textdata =  prompt ("Введите текст ссылки!", "ссылка" );
  if (!textdata) {return ;}
  if (textdata == "") {textdata = hrefdata;}  
  hrefdata = '[LINK="'+hrefdata+'"]'+textdata+'[/LINK]';
  InsertObhvatData(hrefdata,"",iddata);	   	
 }
//------------------------------------------------------------------------	 
	 function QuestForNum(message) {
	  var e = '';	
	  while (true) {
		e =  prompt (message, "0" );
		if (!e) { return ''; }	  	
	  	if (IisInteger(e)) { break; }
		alert('Необходимо указать числовое значение!\r\nЗначение должно быть не больше 1500 и не меньше 0 и должно быть целого типа!');	
	  }	
	  return e;
	 }
//------------------------------------------------------------------------	 
	 function InsertPic(iddata) {
	  var hrefdata =  prompt ("Введите адрес рисунка!", "http://" );	
	  if ((!hrefdata) || (hrefdata == "") || (hrefdata.toLowerCase() == "http://")) { return ; }
	  if (confirm("Хотите указать размеры рисунка?")) {
		var h =  QuestForNum("Укажите высоту рисунка (чтобы не указавыть высоту - поставьте 0)!");
		if (!h) { h = ''; }
		if (h != '') { h = 'h'+h; }
		var w =  QuestForNum("Укажите ширину рисунка (чтобы не указавыть ширину - поставьте 0)!");
		if (!w) { w = ''; }
		if (w != '') { w = 'w'+w; }		
		if ((h != '') || (w != '')) {
		 hrefdata = '[IMG="'+h+':'+w+'"]'+hrefdata+'[/IMG]';	
		}
		else { hrefdata = '[IMG]'+hrefdata+'[/IMG]'; }		
	  }
	  else { hrefdata = '[IMG]'+hrefdata+'[/IMG]'; }	
	  InsertObhvatData(hrefdata,"",iddata);
	 }
//------------------------------------------------------------------------	 
     function InsertLK_VIE(iddata,lk) {
	  var str = 'Укажите идентификатор точки ссылки на позиции страницы!';
	  if (!lk) { str = 'Укажите идентификатор точки, на которую сделать ссылку!'; }
	  str = prompt(str,"0");
	  if (!str) { return ; }
	  if (!IisInteger(str)) { 
	   alert('Необходимо указать числовое значение!\r\nЗначение должно быть не больше 1500 и не меньше 0 и должно быть целого типа!');
	   return ;	
	  }
	  var st1 = '';
	  var st2 = '';  
	  if (lk) { st1 = '[LK="'+str+'"]';	st2 = '[/LK]'; }  else { st1 = '[VIE="'+str+'"]'; st2 = '[/VIE]'; }
	  InsertObhvatData(st1,st2,iddata);	
	 }
//------------------------------------------------------------------------
     function InsertSizeData(iddata) {
	  var str = prompt('Укажите размер шрифта (пример: 95% или 14px)',"100%");
	  if (!str) { return ; }
	  InsertObhvatData('[SIZE="'+str+'"]','[/SIZE]',iddata);
	 }
//------------------------------------------------------------------------
	 function InsertHide(iddata) {
	  var textdata =  prompt ("Укажите название скрытого блока:", "скрытый блок" );	
	  if (!textdata) { return ; }
	  textdata = '[HIDE="'+textdata+'"]';
	  InsertObhvatData(textdata,"[/HIDE]",iddata);
	 }
//------------------------------------------------------------------------
	 function InsertColor(color,iddata) {	
	  var textdata = '[COLOR="'+color+'"]';
	  InsertObhvatData(textdata,"[/COLOR]",iddata);
	 }
//------------------------------------------------------------------------
  function RollHide(th,idrol) {	
   var roll = document.getElementById("hidetext"+idrol);
   if (!roll) {return ;}
   if (!th) {return ;}
   if (th.id == 'roll_down') {
     th.id = "roll_up";
     //roll.style.visibility = 'visible';
	 roll.style.display = 'block';	
   }
   else
   {
     th.id = "roll_down";
     //roll.style.visibility = 'hidden';
	 roll.style.display = 'none';	
   }   	
  }

//------------------------------------------------------------------------ 
 //очистка от пробелов
 function trim(str, chars) {
	return ltrim(rtrim(str, chars), chars);
 } 
 function ltrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
 } 
 function rtrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
 }
 function trimW( str, charlist ) {   
  return trim(str);
 }
 //------------------------------------------------------
 //првоерка присутствия в массиве
 function InArray(arr,val) {
  for (var i=0; i < arr.length; i++) {
  	if (arr[i] == val) {
  	 return true;	
  	}  	
  }
  return false;	
 }
 //массив без повторов и пустых строк из массива sarray
 function GetCorretArray(sarray) {
  newresarr = new Array();
  for (var i=0; i < sarray.length; i++) {
   str = trimW(sarray[i]);
   if (str != "") {
  	if (InArray(newresarr,str) == false) {
  	 newresarr.push(str);	
  	}
   }	
  }
  return newresarr;	
 }
 //------------------------------------------------------ 
 function str_replace(search, replace, subject, count) {
  //return subject.split(search).join(replace);
  var result = new String(subject);
  if (result != null && result.length > 0) {
   var a = 0;
   var b = 0;
   var i = 1;
   while ((count != null && count > 0) ? (i <= count) : true) {
    a = result.indexOf(search, b);
    if (a != -1) {
     result = result.substring(0, a) + replace + result.substring(a + search.length);
     b = a + replace.length;
     i++;
    } else break;
   }
  }
  return result; 
 }//str_replace 
 //------------------------------------------------------ 
 var HTML=function(){
   var x,mnem=
   {34:"quot",38:"amp",39:"apos",60:"lt",62:"gt",402:"fnof",
   338:"OElig",339:"oelig",352:"Scaron",353:"scaron",
   376:"Yuml",710:"circ",732:"tilde",8226:"bull",8230:"hellip",
   8242:"prime",8243:"Prime",8254:"oline",8260:"frasl",8472:"weierp",
   8465:"image",8476:"real",8482:"trade",8501:"alefsym",8592:"larr",
   8593:"uarr",8594:"rarr",8595:"darr",8596:"harr",8629:"crarr",
   8656:"lArr",8657:"uArr",8658:"rArr",8659:"dArr",8660:"hArr",
   8704:"forall",8706:"part",8707:"exist",8709:"empty",8711:"nabla",
   8712:"isin",8713:"notin",8715:"ni",8719:"prod",8721:"sum",
   8722:"minus",8727:"lowast",8730:"radic",8733:"prop",8734:"infin",
   8736:"ang",8743:"and",8744:"or",8745:"cap",8746:"cup",8747:"int",
   8756:"there4",8764:"sim",8773:"cong",8776:"asymp",8800:"ne",
   8801:"equiv",8804:"le",8805:"ge",8834:"sub",8835:"sup",8836:"nsub",
   8838:"sube",8839:"supe",8853:"oplus",8855:"otimes",8869:"perp",
   8901:"sdot",8968:"lceil",8969:"rceil",8970:"lfloor",8971:"rfloor",
   9001:"lang",9002:"rang",9674:"loz",9824:"spades",9827:"clubs",
   9829:"hearts",9830:"diams",8194:"ensp",8195:"emsp",8201:"thinsp",
   8204:"zwnj",8205:"zwj",8206:"lrm",8207:"rlm",8211:"ndash",
   8212:"mdash",8216:"lsquo",8217:"rsquo",8218:"sbquo",8220:"ldquo",
   8221:"rdquo",8222:"bdquo",8224:"dagger",8225:"Dagger",8240:"permil",
   8249:"lsaquo",8250:"rsaquo",8364:"euro",977:"thetasym",978:"upsih",982:"piv"},
   tab=("nbsp|iexcl|cent|pound|curren|yen|brvbar|sect|uml|"+
   "copy|ordf|laquo|not|shy|reg|macr|deg|plusmn|sup2|sup3|"+
   "acute|micro|para|middot|cedil|sup1|ordm|raquo|frac14|"+
   "frac12|frac34|iquest|Agrave|Aacute|Acirc|Atilde|Auml|"+
   "Aring|AElig|Ccedil|Egrave|Eacute|Ecirc|Euml|Igrave|"+
   "Iacute|Icirc|Iuml|ETH|Ntilde|Ograve|Oacute|Ocirc|Otilde|"+
   "Ouml|times|Oslash|Ugrave|Uacute|Ucirc|Uuml|Yacute|THORN|"+
   "szlig|agrave|aacute|acirc|atilde|auml|aring|aelig|ccedil|"+
   "egrave|eacute|ecirc|euml|igrave|iacute|icirc|iuml|eth|ntilde|"+
   "ograve|oacute|ocirc|otilde|ouml|divide|oslash|ugrave|uacute|"+
   "ucirc|uuml|yacute|thorn|yuml").split("|");
   for(x=0;x<96;x++)mnem[160+x]=tab[x];
   tab=("Alpha|Beta|Gamma|Delta|Epsilon|Zeta|Eta|Theta|Iota|Kappa|"+
   "Lambda|Mu|Nu|Xi|Omicron|Pi|Rho").split("|");
   for(x=0;x<17;x++)mnem[913+x]=tab[x];
   tab=("Sigma|Tau|Upsilon|Phi|Chi|Psi|Omega").split("|");
   for(x=0;x<7;x++)mnem[931+x]=tab[x];
   tab=("alpha|beta|gamma|delta|epsilon|zeta|eta|theta|iota|kappa|"+
   "lambda|mu|nu|xi|omicron|pi|rho|sigmaf|sigma|tau|upsilon|phi|chi|"+
   "psi|omega").split("|");
   for(x=0;x<25;x++)mnem[945+x]=tab[x];
   return {
     encode:function(text){
       return text.replace(/[\u00A0-\u2666<>\&]/g,function(a){
         return "&"+(mnem[a=a.charCodeAt(0)]||"#"+a)+";"
       })
     },
     decode:function(text){
       return text.replace(/\&#?(\w+);/g,function(a,b){
         if(Number(b))return String.fromCharCode(Number(b));
         for(x in mnem){
           if(mnem[x]===b)return String.fromCharCode(x);
         }
       })
     }
   }
 }()
//------------------------------------------------------ 
 //progress
 function ProgressPosition(element,position,max,width,height,bgcolor,bordercolor,percentcolor,percentsize) {
  var f = document.getElementById(element);
  if (!f) { return ; }
  if (!max) { max = 100; }  
  if (!position) { position = 0; }
  if (position > max) { position = max; }
  if (!width) { width = 250; }
  if (!height) { height = 15; }
  if (!bgcolor) { bgcolor = '#3CA3DF'; }
  if (!bordercolor) { bordercolor = '#969696'; }
  if (!percentcolor) { percentcolor = '#000000'; }
  if (!percentsize) { percentsize = 11; }
  var percent = Math.round((position * 100 / max)*100)/100;
  f.innerHTML = 
  '<div style="width: '+width+'px; height: '+height+'px; line-height: '+height+
  'px; text-align: left; font-size: '+percentsize+'px; color: '+percentcolor+'; border: 1px solid '+bordercolor+';">'+
  '<span style="display: inline-block; width: '+percent+'%; height: 100%; margin: 1px; background: '+bgcolor+
  '; text-align: center;">&nbsp;'+percent+'%&nbsp;</span></div>'; 	
 }//ProgressPosition
 //--------------------------------------------------------
 //очистка элемента (быстрая)
 function ClearElementQuick(idens) {
  var ff = document.getElementById(idens);	
  if (ff) { ff.innerHTML = ''; }
 }//ClearElementQuick 
 //-------------------------------------------------------- 
 //установка прозрачности
 function setElementOpacity(sElemId, nOpacity) {
  var opacityProp = getOpacityProperty();
  var elem = sElemId;
  if (!elem || !opacityProp) return; 
  if (opacityProp=="filter") {
    nOpacity *= 100;
    var oAlpha = elem.filters['DXImageTransform.Microsoft.alpha'] || elem.filters.alpha;
    if (oAlpha) oAlpha.opacity = nOpacity;
    else elem.style.filter += "progid:DXImageTransform.Microsoft.Alpha(opacity="+nOpacity+")";
  } else elem.style[opacityProp] = nOpacity;
 }

 function getOpacityProperty(){
  if (typeof document.body.style.opacity == 'string') // CSS3 compliant (Moz 1.7+, Safari 1.2+, Opera 9)
    return 'opacity';
  else if (typeof document.body.style.MozOpacity == 'string') // Mozilla 1.6 и младше, Firefox 0.8 
    return 'MozOpacity';
  else if (typeof document.body.style.KhtmlOpacity == 'string') // Konqueror 3.1, Safari 1.1
    return 'KhtmlOpacity';
  else if (document.body.filters && navigator.appVersion.match(/MSIE ([\d.]+);/)[1]>=5.5) // Internet Exploder 5.5+
    return 'filter';
  return false; //нет прозрачности
 }  
//--------------------------------------------------------------

function getExpDate(days, hours, minutes) {
    var expDate = new Date();
    if (typeof days == "number" && typeof hours == "number" && typeof hours == "number") {
        expDate.setDate(expDate.getDate() + parseInt(days));
        expDate.setHours(expDate.getHours() + parseInt(hours));
        expDate.setMinutes(expDate.getMinutes() + parseInt(minutes));
        return expDate.toGMTString();
    }
}


function getCookieVal(offset) {
    var endstr = document.cookie.indexOf (";", offset);
    if (endstr == -1) {
        endstr = document.cookie.length;
    }
    return unescape(document.cookie.substring(offset, endstr));
}

function getCookie(name) {
    var arg = name + "=";
    var alen = arg.length;
    var clen = document.cookie.length;
    var i = 0;
    while (i < clen) {
        var j = i + alen;
        if (document.cookie.substring(i, j) == arg) {
            return getCookieVal(j);
        }
        i = document.cookie.indexOf(" ", i) + 1;
        if (i == 0) break;
    }
    return null;
}

function setCookie(name, value, expires, path, domain, secure) {
	if (!CheckForCookies()) { return ; }
    document.cookie = name + "=" + escape(value) +
        ((expires) ? "; expires=" + expires : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}

// remove the cookie by setting ancient expiration date
function deleteCookie(name,path,domain) {
    if (getCookie(name)) {
        document.cookie = name + "=" +
            ((path) ? "; path=" + path : "") +
            ((domain) ? "; domain=" + domain : "") +
            "; expires=Thu, 01-Jan-70 00:00:01 GMT";
    }
}

function CheckForCookies() {
 return navigator.cookieEnabled; 	
}
//--------------------------------------------------------------