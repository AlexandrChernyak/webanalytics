<?php /* Smarty version 2.6.26, created on 2016-05-15 08:41:12
         compiled from seo-panel/index.tpl */ ?>
<?php if (! isset ( $this->_tpl_vars['PANEL_CONTROL'] )): ?>
 <div style="color: #FF0000">Ошибка идентификации панели оптимизатора!</div>
<?php elseif ($this->_tpl_vars['PANEL_CONTROL']->error): ?>
 <div style="color: #FF0000"><?php echo $this->_tpl_vars['PANEL_CONTROL']->error; ?>
</div>
<?php else: ?>
  <script type="text/javascript" src="<?php echo @W_SITEPATH; ?>
css/panel/statuselements.js"></script>
 <script type="text/javascript" src="<?php echo @W_SITEPATH; ?>
css/panel/menuelements.js"></script>
 <script type="text/javascript" src="<?php echo @W_SITEPATH; ?>
css/panel/jquery.corner.js"></script>
 <script type="text/javascript" src="<?php echo @W_SITEPATH; ?>
css/panel/jquery.tablednd_0_5.js"></script>
 <script type="text/javascript" src="<?php echo @W_SITEPATH; ?>
swf/amcharts/flash/swfobject.js"></script>
 <script type="text/javascript" src="<?php echo @W_SITEPATH; ?>
css/panel/process.lib.js"></script>
 
 <?php echo ' 
 <script type="text/javascript">
  var globalsitepath = \''; ?>
<?php echo @W_SITEPATH; ?>
<?php echo '\';
  var panelpath      = globalsitepath + \'panel/'; ?>
<?php if ($this->_tpl_vars['PANEL_CONTROL']->manageIDinfo): ?><?php echo $this->_tpl_vars['PANEL_CONTROL']->manageRealID; ?>
/<?php endif; ?><?php echo '\';      
  var imagemodifyit  = globalsitepath + \'img/items/document_edit.png\';
  var path_img_css   = globalsitepath + \'css/panel/img/\';
  
  var status_pockej  = {
   statusimage: globalsitepath + \'athemes/SIMPLE/img/ajax-loader.gif\',
   bgimagefile: globalsitepath + \'css/panel/img/bg.png\'   		
  };
  
  var status_pockej_fst  = {
   statusimage: globalsitepath + \'athemes/SIMPLE/img/ajax-loader.gif\',
   bgimagefile: globalsitepath + \'css/panel/img/bg3.png\',
   bgcolorrd  : \'#D2DEE8\'   		
  };
  
  var panelstatuslk  = {
   //разрешить\\запретить получение сайтов раздела	
   canselecttab: true,	
   //кол-во символов в коротком описании раздела
   shortnmcount: '; ?>
<?php echo $this->_tpl_vars['PANEL_CONTROL']->shortnamecount; ?>
<?php echo ',
   //цвет выделения (при наведении)
   colorhover  : \'#EDF0F1\',
   //цвет выделения на выбранном элементе
   colorhoverselected: \'#AAD1F9\',
   //цвет выделенного элемента
   colorselected : \'#CFE6FC\',
   //выбор параметров для обновления
   displayselectparamtoupdate : '; ?>
<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('displayselectparam'); ?>
<?php echo ', 
   //параметры без обновления
   paramsnoupdated : \''; ?>
<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('paramsnoupdated'); ?>
<?php echo '\',
   paramsnoupdatedever : \''; ?>
<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('paramsnoupdatedever'); ?>
<?php echo '\',
   //отображать лог ненуждающихся в обновлении
   displaynoupdateneed: '; ?>
<?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('displaynoupdateneed'); ?>
<?php echo ',
   
   //данные идентификаторов
   paramsXML : \'\',
   dataCSV: \'\',
   urlidentactive: \'\',
   charwidth: \'80%\',
   charheight: \'450\',
   //run after load
   runprogtoload: function () { }  
  }; 
  
   
  var p_Images = new Array();
  function p_PreloadImagesList(list) {
   for (var i=0; i < list.length; i++) {
   	if (!list[i]) { continue; }
    p_Images[i] = new Image();
    p_Images[i].src = list[i];	
   }	 	
  }//p_PreloadImagesList
 
  function SelectTabActive(th, ident, ext) {
   if (!panelstatuslk.canselecttab || ext || $(th).attr(\'class\') == \'sectionbutton_selected\') { return ; }	
   var idsection = (ident == \'-1\') ? th.value : ident;
   idsection = (!idsection) ? 0 : idsection;
   //select items
   if (typeof(th) == \'object\' && th.id != "p_selectsection") {  	
   	$(\'#p_selectsection option\').removeAttr(\'selected\');
   	$(\'#p_selectsection option[id="_section_\'+idsection+\'"]\').attr(\'selected\', \'selected\');		    
   }
   //select buttons
   $(\'.sectionbutton_selected\').attr(\'class\', \'sectionbutton\');
   $(\'#section_\'+idsection).attr(\'class\', \'sectionbutton_selected\');
   //idsection   
   ProcessLoadSectionData(idsection);   	
  }//SelectTabActive
  
  function GetActiveSection() { return $(\'#p_selectsection option:selected\').val(); }
  function GetActiveSectionName() { return $(\'#p_selectsection option:selected\').text(); }
   
  function ShowStatus(data, onlysettext, asfirst) { 
   $(\'#allofpanelid\').stLine(data, (asfirst) ? status_pockej_fst : status_pockej, onlysettext);
   return false;
  }//ShowStatus
  
  function AddToLogElement(str, color) {   
   var exists = false;
   var correctdd = function (i) { if (i<10) { i = "0" + i; } return i; };
   
   var str2 = (color) ? (\'<label style="color: \'+color+\'">\'+str+\'</label>\') : str;
   
   var d = new Date();
   var datestr = 
   \'<label style="color: #0000FF">\' +  
   correctdd(d.getHours()) + \':\' + correctdd(d.getMinutes()) + \':\' + correctdd(d.getSeconds()) + 
   \'</label>: \';  
   
   var bgelem = 
   \' onmouseover="$(this).css(\\\'background\\\', \\\'#FFFFE8\\\')" onmouseout="$(this).css(\\\'background\\\', \\\'transparent\\\')"\';
   
   $(\'body div[class="logerrorslist"]\').each(function (i) {
    $(this).show();
    $(this).find(\'div[id="blocklogerrors"]\').find(\'div[id="logsourceelementsdata"]\').after(
	 \'<div\'+bgelem+\'>\'+datestr+str2+\'</div>\'
	);    	
	exists = true;
	return false;
   });
   
   if (exists) { return true; }
   
   $(\'body\').append(
    \'<div class="logerrorslist">\'+
     \'<div id="blocklogerrors">\'+
      \'<div id="logsourceelementsdata">Лог текущей сессии выполнения..</div>\'+
      \'<div\'+bgelem+\'>\'+datestr+str2+\'</div>\'+      
     \'</div>\'+
     \'<div style="padding-top: 4px; height: auto; text-align: right; padding-bottom: 2px">\'+
      \'<a href="javascript:" id="clickcloseerrorlog">Закрыть</a>\'+      
     \'</div>\'+     
    \'</div>\'    
   );
   $(\'body div[class="logerrorslist"] a[id="clickcloseerrorlog"]\').click(function () {
	$(\'body div[class="logerrorslist"]\').hide();	
   });
   return true;  
  }//AddToLogElement
  
  function RemoveLogErrors() {
   $(\'body div[class="logerrorslist"]\').each(function (i) { $(this).remove(); return false; });	
  }//RemoveLogErrors
  
  function StatusShowed() { return $(\'#allofpanelid\').stLine(\'isshow\', status_pockej, true); }
  
  function ShowGlobalStatus(str, onlyset, noimage) {
   $(\'body\').stLine(str, {
    statusimage: (noimage) ? \'\' : status_pockej.statusimage,
    bgimagefile: status_pockej.bgimagefile,
    shontopitem: 50	
   }, onlyset); 
   return false; 	
  }//ShowGlobalStatus
  
  function GetErrorData(data) { return (data.substr(0, 6) == \'error:\') ? data.substr(6) : \'\'; }
  
  function GetButtonTextSource(id, name, countu) {
   return name+\' (<label id="sitecount_\'+id+\'">\'+countu+\'</label>)<label class="closesectionbutton" onclick="ActionToDeleteSection(\\\'\'+id+\'\\\')">x</label>\';	
  }//GetButtonTextSource
  
  function AddSectionItem(id, shortname, name, insertfirst, countinsection) {
   var countin = (countinsection) ? countinsection : 0;	
   var stradd = {
	selectstr: \'<option value="\'+id+\'" id="_section_\'+id+\'">\'+shortname+\'</option>\',
	buttomstr: \'<span class="sectionbutton" id="section_\'+id+\'" sectionidattr="\'+id+\'" onclick="SelectTabActive(this, \\\'\'+id+\'\\\', false)">\'+GetButtonTextSource(id, name, countin)+\'</span>\'	
   };
   if (insertfirst) {
    $(\'#section_0\').after(stradd.buttomstr);
    $(\'#_section_0\').after(stradd.selectstr);	
   } 
    else 
   { 	
    $(\'#p_selectsection\').append(stradd.selectstr);
    $(\'#panelbuttomlineid\').append(stradd.buttomstr);
   }
   ReinitButtomsList(false);		
  }//AddSectionItem
  
  function PrepereNewSectionData(data) {
   if (!data) { return alert(\'Неизвестный идентификатор операции!\'); }
   var error = GetErrorData(data);
   if (error) {
	if (!confirm(error+"\\r\\nВы хотите повторить ввод?")) {
	 ShowStatus(\'hide\');
	 return false;	 	
	}	
	ShowStatus(\'hide\');
	ShowDialogAddSection();
	return false;	
   }
   //ok, create sections as {id:\'new identifier\', name:\'new sect name\', shortname:\'short name with 30 chars\'}   
   eval(\'var flist = \'+data+\';\');   
   AddSectionItem(flist.id, flist.shortname, flist.name, true, 0);  
   ShowStatus(\'hide\');	
  }//PrepereNewSectionData
  
  function ShowDialogAddSection() {	 	
  $("#dialog_addsection").dialog({
   title: "Добавление раздела", 
   width:  450,            
   height: \'auto\',
   position: \'center\',         
   modal: true,            
   buttons: {
    "Создать": function() { 	 
	 
	 var item = $(\'#p_new_section_name\');
	 if (!item.val()) { 
	  alert(\'Укажите название новой секции!\');
	  item.focus();
	  return false;	
	 }
	 
	 $(this).dialog("close");
	 ShowStatus(\'Создание нового раздела, пожалуйста, подождите..\');
	 
	 SendDefaultRequest(
	  panelpath, \'is_ajax_mode=1&action=1&data=\'+encodeURIComponent(item.val()), \'PrepereNewSectionData\'
	 );	 
 	 	 	 	
	},
    "Отмена": function() { $(this).dialog("close"); }
   },
   resizable: false
  });	
 }//ShowDialogAddSection
 
 function PrepereDelSectionData(data) {
  panelstatuslk.canselecttab = true;	
  if (!data) { return alert(\'Неизвестный идентификатор операции!\'); }
  var error = GetErrorData(data);
  if (error) { alert(error); ShowStatus(\'hide\'); return false; }
  
  var activesection = GetActiveSection(); 
  
  var settosect = 0;
  if (activesection == data) {
   	var previ = $(\'#p_selectsection option:selected\').prev();
   	settosect = (previ.val() && previ.val() != \'undefined\') ? previ.val() : 0;   	
  }	
  
  $(\'#section_\'+data).remove();  
  $(\'#p_selectsection option[id="_section_\'+data+\'"]\').remove();
  
  ShowStatus(\'hide\');
  if (activesection == data) {
   $(\'#p_selectsection option[id="_section_\'+data+\'"]\').remove();
   $(\'#p_selectsection option[id="_section_\'+settosect+\'"]\').attr("selected", "selected");
   $(\'#p_selectsection\').change();   	
  }  	
 }//PrepereDelSectionData
 
 function ActionToDeleteSection(ident) {
  var nameident = $(\'#p_selectsection option[id="_section_\'+ident+\'"]\').text();
  if (!confirm("Вы действительно хотите удалить раздел ["+nameident+"]?\\r\\nПродолжить?")) { return false; }  	 
  panelstatuslk.canselecttab = false;
  ShowStatus(
   \'<label style="color: #FF0000; font-size: 95%">Удаление раздела [<b>\'+nameident+\'</b>], пожалуйста, подождите..</label>\'
  );  
  SendDefaultRequest(
   panelpath, \'is_ajax_mode=1&action=2&data=\'+encodeURIComponent(ident), \'PrepereDelSectionData\'
  ); 
 }//ActionToDeleteSection
 
 function PrepereShortSectionData(data) {
  if (!data) { return alert(\'Неизвестный идентификатор операции!\'); }
  var error = GetErrorData(data);
  if (error) { alert(error); ShowStatus(\'hide\'); return false; }
  
  var activesection = GetActiveSection();
  ShowStatus(\'<b style="font-size: 95%">Применение положения разделов, пожалуйста, подождите..</b>\', true);
  
  $(\'#panelbuttomlineid span\').each(function (i) {
   var itemtomoveid = $(this).attr(\'sectionidattr\');
   if (itemtomoveid && $(this).attr(\'id\') != \'section_0\') {
	$(this).remove();
   }    	
  });
  
  $(\'#p_selectsection\').find(\'option\').each(function (i) {
   var itemtomoveid = $(this).val();
   if (itemtomoveid && itemtomoveid != \'undefined\' && $(this).attr(\'id\') != \'_section_0\') {
	$(this).remove();
   }    	
  });
  
  //create
  $(\'#p_sortsectionslist div\').each(function (i) {
   var itemtomoveid = $(this).attr(\'iditemelem\');
   if (itemtomoveid) {
    var p_name = $(this).text();
    
    var p_count_in = $(this).attr(\'counturlsin\');
    p_count_in = (!p_count_in || p_count_in==\'undefined\') ? 0 : p_count_in;
	    
    var p_short_name = (p_name.length > panelstatuslk.shortnmcount) ? 
	(p_name.substr(0, panelstatuslk.shortnmcount-3) + \'...\') : p_name;
    AddSectionItem(itemtomoveid, p_short_name, p_name, false, p_count_in); 	
	 
   } 	
  });
  
  //activate
  panelstatuslk.canselecttab = false; 
  $(\'#p_selectsection option[id="_section_\'+activesection+\'"]\').attr("selected", "selected");
  $(\'#panelbuttomlineid span[id="section_\'+activesection+\'"]\').attr("class", "sectionbutton_selected");  
  $(\'#p_selectsection\').change();
  ShowStatus(\'hide\'); 
  panelstatuslk.canselecttab = true;	
 }//PrepereShortSectionData
 
 function PrepereRenameSectionData(data) {
  if (!data) { alert(\'Неизвестный идентификатор операции!\'); return ShowGlobalStatus(\'hide\'); }
  var error = GetErrorData(data);
  if (error) { alert(error); ShowGlobalStatus(\'hide\'); return false; }
  
  //ok, set sections as 
  //{id:\'new identifier\', name:\'new sect name\', shortname:\'short name with 30 chars\', flist.countu=count url}     
  eval("var flist = "+data+";");
  
  $(\'#p_sortsectionslist div[iditemelem="\'+flist.id+\'"]\').html(GenerateMoveItemSource(flist.name, flist.id));
  $(\'#p_selectsection option[id="_section_\'+flist.id+\'"]\').text(flist.shortname);
  $(\'#panelbuttomlineid span[id="section_\'+flist.id+\'"]\').html(GetButtonTextSource(flist.id, flist.name, flist.countu));
  
  ShowGlobalStatus(\'hide\');
  	
 }//PrepereRenameSectionData
 
 function ModifySelectedSectionName(ident) {
  var name = $(\'#p_sortsectionslist div[iditemelem="\'+ident+\'"]\').text();
  var data = prompt("Укажите новое имя раздела!", trim(name));
  if (data == null) { return false; }
  if (!data) { alert(\'Укажите новое название раздела!\'); return false; } 
  
  ShowGlobalStatus(\'<div>Применение [<b>\'+name+\'</b>] на [<b>\'+data+\'</b>]</div><div><b style="color: #0000FF">Сохранение, пожалуйста, подождите..</b></div>\');
  
  SendDefaultRequest(
   panelpath, \'is_ajax_mode=1&action=4&idsect=\'+ident+\'&data=\'+encodeURIComponent(data), \'PrepereRenameSectionData\'
  );
  	
 }//ModifySelectedSectionName
 
 function PrepereShortSectionDataParam(data) {
  ShowStatus(\'Применение нового порядка параметров, пожалуйста, подождите..\'); 
  ReloadElements(\'\', true);	
 }//PrepereShortSectionDataParam
 
 function GenerateMoveItemSourceParam(text, ident) { 	
  return \'<span style="width: 100%"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td valign="center" align="left">\'+text+\'</td><td valign="top" align="right" width="20px"><input type="checkbox" style="cursor: pointer" name="selfordeleteparam_\'+ident+\'" id="selfordeleteparam_\'+ident+\'"></td></tr></table></span>\';	
 }//GenerateMoveItemSource
 
 function PrepereDeleteParam(data) {
  ShowStatus(\'Применение нового списка параметров, пожалуйста, подождите..\'); 
  ReloadElements(\'\', true);		
 }//PrepereDeleteParam
 
 function ShowShortSectionsListParam() {
  $("#dialog_sortsectionparam").dialog({
   title: "Управление параметрами", 
   width:  450,            
   height: 500,
   position: ["center","top"],         
   modal: true,            
   buttons: {
   	"Удалить выбранные": function () {
	 
	 var querys2 = \'\'; 
	 var delindexcount = 0; 
	 var countall = 0;
	 $(\'#p_sortsectionslistparam div\').each(function (i) {
	  var itemtomoveid2 = $(this).attr(\'iditemelem\');
	  if (itemtomoveid2 && itemtomoveid2 != \'undefined\') {	   	   
	   var chid = $(\'#selfordeleteparam_\'+itemtomoveid2).attr(\'checked\');
	   if (chid && chid != \'undefined\') {
		delindexcount++;
		querys2 = querys2 + ((querys2) ? (\',\'+itemtomoveid2) : itemtomoveid2);
	   }
	   countall++;	   
	  } 	
	 });
	 
	 if (!delindexcount) { return alert(\'Выберите параметры для удаления!\'); }
	 
	 var tx = \'Вы действительно хотите удалить [\'+delindexcount+\'] параметров?\';
	 if (delindexcount == countall) {
	  tx = tx + "\\r\\nВы собираетесь удалить все параметры панели! Вы действительно хотите продолжить?";	
	 }
	 if (!confirm(tx)) { return false; }
	 
	 $(this).dialog("close");
	 ShowStatus(\'Удаление выбранных параметров [всего: \'+delindexcount+\'], пожалуйста, подождите..\');
	 $(\'#p_paramsselectlistcheckboxies\').attr(\'isdefined\', \'0\');
	 
	 SendDefaultRequest(panelpath, \'is_ajax_mode=1&action=18&data=\'+encodeURIComponent(querys2), \'PrepereDeleteParam\');
	 	
	},
    "Сохранить позицию": function() { 	 
	 
	 $(this).dialog("close");
	 ShowStatus(\'Сохранение позиции параметров, пожалуйста, подождите..\');
	
	 var querys3 = \'\';
	 $(\'#p_sortsectionslistparam div\').each(function (i) {
	  var itemtomoveid3 = $(this).attr(\'iditemelem\');
	  if (itemtomoveid3 && itemtomoveid3 != \'undefined\') {
	   querys3 = querys3 + ((querys3) ? (\',\'+itemtomoveid3) : itemtomoveid3); 	
	  } 	
	 });	
	 if (!querys3) { alert(\'Нет данных для обработки!\'); ShowStatus(\'hide\'); return false; }
	 
	 $(\'#p_paramsselectlistcheckboxies\').attr(\'isdefined\', \'0\');
	 SendDefaultRequest(
      panelpath, \'is_ajax_mode=1&action=17&data=\'+encodeURIComponent(querys3), \'PrepereShortSectionDataParam\'
     );	 
 	 	 	 	
	},
    "Отмена": function() { $(this).dialog("close"); }
   },
   resizable: true,
   open: function(event, ui) {    	
   	var inceridentifier = 0;
   	ShowStatus(\'Построение списка параметров, пожалуйста, подождите..\');
   	$(\'#p_sortsectionslistparam\').html(\'\');  	
   	$(\'#urlslisttabledata thead tr[id="urllisthead"]\').find(\'th[isdinamicparam="1"]\').each(function (i) {
     var ident = $(this).attr(\'paramrealid\');
     if (ident && ident != \'undefined\') {	  
	  $(\'#p_sortsectionslistparam\').append(\'<div class="sectionmoveitem" iditemelem="\'+ident+\'">\'+
	  GenerateMoveItemSourceParam($(this).text(), ident)+\'</div>\');
	  inceridentifier = inceridentifier + 1; 	
     }
     return true;  	
    });	 	
	ShowStatus(\'hide\');
	if (!inceridentifier) { $(\'#p_sortsectionslistparam\').html(\'<b>Нет разделов!</b>\'); }  else {	 
	 $("#p_sortsectionslistparam").sortable({ opacity: 0.6, cursor: \'move\'});	 	
	} 	
   }
  });	
 }//ShowShortSectionsList
 
 
 function GenerateMoveItemSource(text, ident) { 	
  return \'<span style="width: 100%"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td valign="center" align="left">\'+text+\'</td><td valign="top" align="right" width="20px"><a href="javascript:" onclick="ModifySelectedSectionName(\\\'\'+ident+\'\\\')"><img src="\'+imagemodifyit+\'" alt="E" width="16" height="16" title="Изменить название"></a></td></tr></table></span>\';	
 }//GenerateMoveItemSource
 
 function ShowShortSectionsList() {
  $("#dialog_sortsection").dialog({
   title: "Сортировка разделов", 
   width:  450,            
   height: \'auto\',
   position: \'center\',         
   modal: true,            
   buttons: {
    "Применить": function() { 	 
	 
	 $(this).dialog("close");
	 ShowStatus(\'Сохранение позиции разделов, пожалуйста, подождите..\');
	
	 var querys = \'\';
	 $(\'#p_sortsectionslist div\').each(function (i) {
	  var itemtomoveid = $(this).attr(\'iditemelem\');
	  if (itemtomoveid) {
	   querys = querys + ((querys) ? (\',\'+itemtomoveid) : itemtomoveid); 	
	  } 	
	 });	
	 if (!querys) { alert(\'Нет данных для обработки!\'); ShowStatus(\'hide\'); return false; }
	
	 SendDefaultRequest(
      panelpath, \'is_ajax_mode=1&action=3&data=\'+encodeURIComponent(querys), \'PrepereShortSectionData\'
     );	 
 	 	 	 	
	},
    "Отмена": function() { $(this).dialog("close"); }
   },
   resizable: true,
   open: function(event, ui) { 
   	 	
   	var ToTextNormal = function (str) {   	 	
   	 var s = \'\'; var okd = false;	
	 for (var i=str.length; i>=0; i--) {	 	
	  if (!okd) { 	  	
	   if (str.substr(i, 1) == \'(\') { okd = true; }
	   continue;	
	  }
	  s = str.substr(i, 1) + s;	  	  	
	 }
	 return s;		
	};
   	
   	var inceridentifier = 0;
   	ShowStatus(\'Построение списка разделов, пожалуйста, подождите..\');
   	$(\'#p_sortsectionslist\').html(\'\');
   	//initialize list
   	$(\'#panelbuttomlineid span\').each(function (i) {
	 var item = $(this);
	 var iditem = item.attr(\'sectionidattr\');
	 if (iditem && item.attr(\'id\') != \'section_0\') {
	  
	  var countin = $(\'#sitecount_\'+iditem).text();
      countin = (!countin || countin == \'undefuned\') ? \'0\' : countin;
	  		 		  	  
	  $(\'#p_sortsectionslist\').append(\'<div class="sectionmoveitem" iditemelem="\'+iditem+\'" counturlsin="\'+countin+\'">\'+GenerateMoveItemSource(ToTextNormal(item.text()), iditem)+\'</div>\');
	  inceridentifier = inceridentifier + 1;	
	 }	
	});
	ShowStatus(\'hide\');
	if (!inceridentifier) { $(\'#p_sortsectionslist\').html(\'<b>Нет разделов!</b>\'); }  else {	 
	 $("#p_sortsectionslist").sortable({ opacity: 0.6, cursor: \'move\'});	 	
	} 	
   }
  });	
 }//ShowShortSectionsList
 
 function PrepereAddNewURLData(data) {
  if (!data) { alert(\'Неизвестный идентификатор операции!\'); return ShowStatus(\'hide\'); }
  var error = GetErrorData(data);
  if (error) { alert(error); ShowStatus(\'hide\'); return false; } 
  HideElementEmpty(); 
  //add simply
  $(\'#urlslisttabledata tbody\').append(data); 
  IncDecSectionCount(GetActiveSection()); 
  ReinitTableShorter();  
  ShowStatus(\'hide\');	
 }//PrepereAddNewURLData
 
 function ProcessAddNewURL() {
  var url = $(\'#p_addnewurl\');	
  if (!url.val() || url.val() == \'http://\') { alert(\'Укажите URL для добавления!\'); url.focus(); return false; }
  ShowStatus(
   \'<b style="font-size: 11px">Добавление сайта <u style="color: #0000FF">\'+url.val()+\'</u>, пожалуйста, подождите..</b>\'
  ); 
  SendDefaultRequest(
    panelpath, \'is_ajax_mode=1&action=5&sk=\'+GetActiveSection()+\'&data=\'+encodeURIComponent(url.val()),
	\'PrepereAddNewURLData\'
  );  	
 }//ProcessAddNewURL
 
 function RestoreRunProg() { 
  panelstatuslk.runprogtoload();
  panelstatuslk.runprogtoload = function () { }; 
  return false; 
 }//RestoreRunProg
 
 function PrepereLoadSectionData(data) {
  if (!data) {
   $(\'#urlslisttabledata tbody\').html(\'\');
   ShowElementEmpty();
   ShowStatus(\'hide\');
   ShowSelectedStatus();
   return RestoreRunProg();	
  } 	
  var error = GetErrorData(data);
  if (error) { alert(error); ShowStatus(\'hide\'); return RestoreRunProg(); }
  HideElementEmpty(); 	
  $(\'#urlslisttabledata tbody\').html(data);
  ReinitTableShorter();
  ShowStatus(\'hide\');
  var chchc = ShowSelectedStatus();	 
  if (!chchc.selected && $(\'#challitemslist\').attr(\'checked\')) {
   $(\'#challitemslist\').attr(\'checked\', \'\');
   SetTranspAllCh(1);
  }  
  $(\'#sitecount_\'+GetActiveSection()).text(chchc.count);
  return RestoreRunProg();  	
 }//PrepereLoadSectionData
 
 function ProcessLoadSectionData(sectid, asnew) {
  ShowStatus(\'Загрузка, пожалуйста, подождите..\', false, true); 
  SendDefaultRequest(
    panelpath, \'is_ajax_mode=1&action=6&data=\'+GetActiveSection()+\'&nosave=\'+((asnew) ? \'1\' : \'0\'), \'PrepereLoadSectionData\'
  );    	
 }//ProcessLoadSectionData
 
 function IncDecSectionCount(sectid, issub, noforall) {
  var value = $(\'#sitecount_\'+sectid).text();
  if (value == \'\' || value == \'undefined\') { return false; }
  if (issub) { value--; } else { value++; }
  if (value < 0) { value = 0; }  
  $(\'#sitecount_\'+sectid).text(value);
  if (!sectid || sectid == \'0\') { return true; }
  return (noforall) ? true : IncDecSectionCount(0, issub, true);  	
 }//IncDecSectionCount
 
 function SetCheckedItem(ident, th, fromall) {
  var ch = (!th) ? $(\'#checkpitem\'+ident) : $(th);
  if (!th) {
   if (ch.attr(\'checked\')) { ch.attr(\'checked\', \'\'); } else {
	ch.attr(\'checked\', \'checked\');
   }
  }
  $(\'#urllistitem\'+ident).css(\'background\', (ch.attr(\'checked\')) ? panelstatuslk.colorselected : \'transparent\');
  if (!fromall) {
   var chchc = ShowSelectedStatus();	  
   if (!chchc.selected && $(\'#challitemslist\').attr(\'checked\')) {
	$(\'#challitemslist\').attr(\'checked\', \'\');
	SetTranspAllCh(1);
   } 
   if (chchc.selected && chchc.selected == chchc.count) {
   	if (!$(\'#challitemslist\').attr(\'checked\')) { $(\'#challitemslist\').attr(\'checked\', \'checked\'); }
	SetTranspAllCh(1);
   }  
   if (chchc.selected && chchc.selected != chchc.count) {
	if (!$(\'#challitemslist\').attr(\'checked\')) { $(\'#challitemslist\').attr(\'checked\', \'checked\'); }
	SetTranspAllCh(0.4);
   }         
  }	
 }//SetCheckedItem
 
 function SetAllChecked(th) {
  $(\'#urlslisttabledata\').find(\'input[type="checkbox"]\').each(function (i) {
   if ($(this).attr(\'id\') != \'challitemslist\') {  	
    $(this).attr(\'checked\', (th.checked) ? \'checked\' : \'\');   
    SetCheckedItem($(this).attr(\'urlrealid\'), this, true);
   } 
   return true;	
  });
  ShowSelectedStatus();
  SetTranspAllCh(1);	  	
 }//SetAllChecked
 
 function GetSelectedCount() { 
  var result = {selected: 0, count : 0};		
  $(\'#urlslisttabledata\').find(\'input[type="checkbox"]\').each(function (i) {
   if ($(this).attr(\'id\') != \'challitemslist\') {  	
    if ($(this).attr(\'checked\')) { result.selected++; }
	result.count++;   
   } 
   return true;	
  });  
  return result;  	
 }//GetSelectedCount
 
 function ShowSelectedStatus() {
  var countis = GetSelectedCount();	
  if (!countis.selected) {
   $(\'#statuscountelementitem\').hide();
   EnabledDisabledControlButtoms(false);
   return countis;
  }
  $(\'#statuscountelementitem label\').text(countis.selected);
  $(\'#statuscountelementitem\').show();
  EnabledDisabledControlButtoms(true);
  return countis;  	
 }//ShowSelectedStatus
 
 function EnabledDisabledControlButtoms(enabled) {
  setElementOpacity(document.getElementById(\'p_deletelink\'), (enabled) ? 1 : 0.3);	
  setElementOpacity(document.getElementById(\'p_updatelink\'), (enabled) ? 1 : 0.3);	
 }//EnabledDisabledControlButtoms
 
 function DoEventMOver(th, rest) {
  var ident = $(th).attr(\'urlrealid\');
  if (!ident || ident == \'undefined\') { return false; }
  var ch = $(\'#checkpitem\'+ident).attr(\'checked\');
  ch = (ch == \'undefined\') ? false : ch; 
  if (rest) {  		 	
   var sttrbg = $(th).attr(\'bgcolorsave\');   
   sttrbg = (sttrbg && sttrbg != \'undefined\') ? sttrbg : \'transparent\'; 		
   $(th).css(\'background\', (ch) ? panelstatuslk.colorselected : sttrbg);
  } else {
   $(th).css(\'background\', (ch) ? panelstatuslk.colorhoverselected : panelstatuslk.colorhover);
  }
  $(th).find(\'td[isbgexists="1"]\').each(function (i) {
   DoEventMOver(this, rest);
  });	
 }//DoEventMOver
 
 function DoEventMOut(th) { return DoEventMOver(th, true); }
 
 function SetTranspAllCh(val) {
  setElementOpacity(document.getElementById(\'challitemslist\'), val);	
 }//SetTranspAllCh
 
 function GetSelectedURLlist() { 
  var result = \'\';		
  $(\'#urlslisttabledata\').find(\'input[type="checkbox"]\').each(function (i) {	
   var ident = ($(this).attr(\'checked\')) ? $(this).attr(\'urlrealid\') : false;
   if (ident && ident != \'undefined\') {
	result = result + ((result) ? (\',\'+ident) : ident);
   }    
   return true;	
  });  
  return result;  	
 }//GetSelectedURLlist
 
 function GetURLnameById(ident) {
  if (!ident) { return \'\'; }
  var str = \'\'; 
  $(\'#urlslisttabledata tbody\').find(\'tr[urlrealid="\'+ident+\'"] td[isurlident="1"]\').each(function (i) {	
   str = $(this).find(\'a\').text();       
   return false;	
  });	
  return trim(str);	
 }//GetURLnameById
 
 function GetParamNameById(ident) {
  if (!ident) { return \'\'; }	
  var str = \'\';  
  $(\'#urlslisttabledata thead tr[id="urllisthead"]\').find(\'th[isdinamicparam="1"]\').each(function (i) {
   var ident2 = $(this).attr(\'paramrealid\');
   if (ident2 && ident2 != \'undefined\' && ident == ident2) {
	str = $(this).text();
	return false; 
   }	
   return true;  	
  });
  return trim(str);
 }//GetParamNameById
 
 function PrepereDeleteURLData(data) {
  if (!data) { return ShowStatus(\'hide\'); }
  var error = GetErrorData(data);
  if (error) { alert(error); ShowStatus(\'hide\'); return false; }   
  var list = data.split(\',\'); 
  for (var i=0; i<list.length; i++) {
   if (list[i]) { DeleteURLListData(list[i]); }   	
  }  
  var st = ShowSelectedStatus();
  if (!st.selected && $(\'#challitemslist\').attr(\'checked\')) {
   $(\'#challitemslist\').attr(\'checked\', \'\');
   SetTranspAllCh(1);
  }  
  if (!st.count) { ShowElementEmpty(); }	
  ShowStatus(\'hide\');	
 }//PrepereDeleteURLData
 
 function DeleteURLListData(ident) {	
  $(\'#urlslisttabledata tbody\').find(\'tr[urlrealid="\'+ident+\'"]\').each(function (i) {
   var sectid = $(this).attr(\'urlsectionid\');
   if (sectid != \'undefined\') {	    	
    $(this).remove();   
    IncDecSectionCount(sectid, true);
   }
   return false;	
  });	 	
 }//DeleteURLListData
 
 function DeleteSelectedURLs() {
  var count = GetSelectedCount();
  if (!count.selected) { return alert(\'Выберите сайты для удаления!\'); }
  var query = GetSelectedURLlist();
  var url = (count.selected == 1) ? GetURLnameById(query) : false; 
  var queststr = (url) ? (\'Вы действительно хотите удалить сайт [\'+url+\']?\\r\\nПродолжить?\') : 
  (\'Вы действительно хотите удалить [\'+count.selected+\'] сайтов?\\r\\nПродолжить?\');
  if (!confirm(queststr)) { return false; }
  queststr = (url) ? (\'Удаление сайта [ <u style="color: #0000FF"><b>\'+url+\'</b></u> ], пожалуйста, подождите..\') :
  (\'Удаление выбранных сайтов [ <b>всего: \'+count.selected+\'</b> ]. Пожалуйста, подождите..\')  
  ShowStatus(queststr);  
  SendDefaultRequest(panelpath, \'is_ajax_mode=1&action=7&data=\'+encodeURIComponent(query), \'PrepereDeleteURLData\');	
 }//DeleteSelectedURLs
 
 function HideElementEmpty() {
  $(\'#allurlisemptylist\').hide();
  $(\'#challitemslist\').attr(\'disabled\', \'\');  	
 }//HideElementEmpty
 
 function ShowElementEmpty() {
  $(\'#allurlisemptylist\').show();
  $(\'#challitemslist\').attr(\'disabled\', \'disabled\');  	
 }//HideElementEmpty
 
 
 function PrepereMoveURLData(data) {
  if (!data) { return ShowStatus(\'hide\'); }
  var error = GetErrorData(data);
  if (error) { alert(error); ShowStatus(\'hide\'); return false; }
  
  var list  = data.split(\';\'); 
  var itemb = false;  
  
  for (var i=0; i<list.length; i++) {
   if (!list[i]) { continue; }
   eval(\'itemb = \'+list[i]);  
     
   if (!itemb) { continue; }

   DoMoveURLElementLine(itemb); 	
  } 
  
  var st = ShowSelectedStatus();
  if (!st.selected && $(\'#challitemslist\').attr(\'checked\')) {
   $(\'#challitemslist\').attr(\'checked\', \'\');
   SetTranspAllCh(1);
  }  
  if (!st.count) { ShowElementEmpty(); }	
  ShowStatus(\'hide\'); 	
 }//PrepereMoveURLData
 
 
 //{urlid: "int", fromsection: "int", tosection: "int", fromactive: "int"}
 function DoMoveURLElementLine(info) {	   
  $(\'#urlslisttabledata tbody\').find(\'tr[urlrealid="\'+info.urlid+\'"]\').each(function (i) {

	if (info.fromactive != \'0\') { $(this).remove(); }
	
	if (info.fromsection  != \'0\') { IncDecSectionCount(info.fromsection, true, true); }
    
    if (info.tosection  != \'0\') { IncDecSectionCount(info.tosection, false, true); }

   return false;	
  }); 	
 }//DoMoveURLElementLine 
 
 function ProcessMoveItems(th) {
  var sid = $(th).attr(\'sid\');
  if (sid == \'\' || sid == \'undefined\') { return false; }
  var query = GetSelectedURLlist();
  if (query == \'\') { return false; }  
  
  ShowStatus(\'Перемещение сайтов, пожалуйста, подождите..\');  
  SendDefaultRequest(
   panelpath, 
   \'is_ajax_mode=1&action=8&data=\'+encodeURIComponent(query)+\'&to=\'+encodeURIComponent(sid)+\'&from=\'+GetActiveSection(), 
   \'PrepereMoveURLData\'
  );  
  	
 }//ProcessMoveItems
 
 function PrepereSaveMoveURLData(data) {
  var error = GetErrorData(data);
  if (error) { alert(error); }
  ShowStatus(\'hide\');
 }//PrepereSaveMoveURLData
 
 function ReinitTableShorter() {
  $("#urlslisttabledata").tableDnD({
      dragHandle: "urlblockidentmove",
      onDrop: function(table, row) {
       
       var curid  = $(row).attr(\'urlrealid\');
       if (!curid || curid == \'undefined\') { return false; }
       
       var query  = \'\';
       
       $(table).find(\'tr\').each(function (i) {
		var ident = $(this).attr(\'urlrealid\');
		if (ident && ident != \'undefined\') {
		 
		 query += ((query) ? (\',\'+ident) : ident);
	 	
		}
		return true;		
	   });
       
       if (!query) { return false; }
       
	   ShowStatus(\'Сохранение позиции, пожалуйста, подождите..\');  
       SendDefaultRequest(
        panelpath, 
        \'is_ajax_mode=1&action=9&data=\'+encodeURIComponent(query)+\'&id=\'+encodeURIComponent(curid)+\'&sk=\'+GetActiveSection(), 
        \'PrepereSaveMoveURLData\'
       ); 	   
	   	
      }
  });	
 }//ReinitTableShorter
 
 
 function PreperePreviewImageURLData(data) {
  if (!data) { return ShowStatus(\'hide\'); }
  
  var error = GetErrorData(data);
  if (error) { alert(error); return ShowStatus(\'hide\'); }
  
  var t_Image = new Image();
  t_Image.src = data;
  
  $(t_Image).ready(function () {
   ShowStatus(\'hide\');  
   ShowGlobalStatus(
   \'<span style="padding: 4px; background: #EAEBEC; display: inline-block; width: 610px; height: 460px; border: 2px solid #808080; text-align: center"><span style="display: inline-block; width: 600px; height: 450px; background: url(\'+t_Image.src+\') no-repeat top left; cursor: pointer" onclick="ShowGlobalStatus(\\\'hide\\\')"></span></span>\', 
   false, true
   );		
  }); 
  	
 }//PreperePreviewImageURLData
 
 function previewImageURL(ident) {
  if (!ident) { return false; }
  ShowStatus(\'Загрузка изображения, пожалуйста, подождите..\');
  SendDefaultRequest(panelpath, \'is_ajax_mode=1&action=10&data=\'+encodeURIComponent(ident), \'PreperePreviewImageURLData\');  	
 }//previewImageURL
 
 
 function PrepereLoadHistoryData2(data) { 
  if (!data) { return ShowStatus(\'hide\'); }
  var error = GetErrorData(data);
  if (error) { alert(error); return ShowStatus(\'hide\'); }
  
  panelstatuslk.dataCSV = data;
  ShowStatus(\'hide\');
  
  //init char
  var params = { bgcolor: "#FFFFFF" };
  var flashVars = { 
   path: globalsitepath + "swf/amcharts/flash/", 
   chart_data: panelstatuslk.dataCSV, 
   chart_settings: panelstatuslk.paramsXML 
  }
  
  //show block   
  ShowGlobalStatus(
   \'<div style="padding: 4px; background: #EAEBEC; display: block; width: \'+panelstatuslk.charwidth+
   \'; height: \'+panelstatuslk.charheight+\'; border: 2px solid #808080; text-align: center">\'+  
   \'<div id="grathdataelement"></div>\'+ 
   \'<div style="margin-top: 10px; text-align: right;"><a title="Зыкрыть" style="font-size: 110%" href="javascript:" onclick="ShowGlobalStatus(\\\'hide\\\')"><b>Закрыть</b></a></div>\'+    
   \'</div>\', 
   false, true
  ); 
  
  //init and show
  swfobject.embedSWF(
   globalsitepath + "swf/amcharts/flash/amline.swf", \'grathdataelement\', 
   \'100%\', panelstatuslk.charheight, "8.0.0", globalsitepath + "swf/amcharts/flash/expressInstall.swf", 
   flashVars, params
  ); 
  	
 }//PrepereLoadHistoryData2
 
 function PrepereLoadHistoryData1(data) { 	
  if (!data) { return ShowStatus(\'hide\'); }
  var error = GetErrorData(data);
  if (error) { alert(error); return ShowStatus(\'hide\'); }
  
  var urlname = GetURLnameById(panelstatuslk.urlidentactive);
  if (!urlname) { return ShowStatus(\'hide\'); }
  
  panelstatuslk.paramsXML = data;
  
  ShowStatus(\'Подготовка данных сайта <b>\'+urlname+\'</b>, пожалуйста, подождите..\', true);
  SendDefaultRequest(
   panelpath, 
   \'is_ajax_mode=1&action=11&data=\'+encodeURIComponent(panelstatuslk.urlidentactive)+\'&getdata=1\',
   \'PrepereLoadHistoryData2\'
  ); 	
 }//PrepereLoadHostoryData1
 
 function ProcessViewHistoryElement(ident) {
  var urlname = GetURLnameById(ident);
  if (!urlname) { return false; }
  
  panelstatuslk.urlidentactive = ident;
  
  ShowStatus(\'Инициализация истории сайта <b>\'+urlname+\'</b>, пожалуйста, подождите..\'); 
  SendDefaultRequest(
   panelpath, 
   \'is_ajax_mode=1&action=11&data=\'+encodeURIComponent(ident)+\'&getparams=1\',
   \'PrepereLoadHistoryData1\'
  );	
 }//ProcessViewHistoryElement
 
 function ProcessActionToApdateURLElements(count) {
  if (!count.selected) { return false; }
  
  ShowStatus(\'Подготовка к обновлению показателей, пожалуйста, подождите..\')
  //remove errors log at first time
  RemoveLogErrors();
  
  var ignoreitems = (AnalysisObj.paramsnoupdate) ? (\',\'+AnalysisObj.paramsnoupdate+\',\') : false;
  
  AnalysisObj.paramslistitems = new Array();
  AnalysisObj.urlslistitems = new Array();
  AnalysisObj.allprocesscount = 0;
  AnalysisObj.curparampos = 0;
  AnalysisObj.cururlpos = 0;
  
  $(\'#urlslisttabledata thead tr[id="urllisthead"]\').find(\'th[isdinamicparam="1"]\').each(function (i) {
   var ident = $(this).attr(\'paramrealid\');
   if (ident && ident != \'undefined\') {
	if (!ignoreitems || ignoreitems.indexOf(\',\'+ident+\',\', 0) == -1) {
	 if (isMachParamType($(this).attr(\'relparamtype\'), panelstatuslk.paramsnoupdatedever)) {		
	  AnalysisObj.paramslistitems.push(ident);	 	
	 }
	}	
   }
   return true;  	
  });	
  
  var queryurl = GetSelectedURLlist();
  
  if (AnalysisObj.paramslistitems.length <= 0) {
   AddToLogElement(\'Не определен список параметров для обновления!\', \'#FF0000\');
   return ShowStatus(\'hide\');   	
  }
  
  if (!queryurl) {
   AddToLogElement(\'Не определен список сайтов для обновления!\', \'#FF0000\');
   return ShowStatus(\'hide\');	
  }
  
  AnalysisObj.urlslistitems = queryurl.split(\',\');  
  
  AnalysisObj.start();
  	
 }//ProcessActionToApdateURLElements
 
 function ActionToExportURLElements() { 
  var count = GetSelectedCount();
  if (!count.selected) { return alert(\'Выберите сайты для экспорта!\'); } 
  var queryurl = GetSelectedURLlist();
  if (!queryurl) { return alert(\'Не определен список сайтов для экспорта!\'); }
  if (!confirm(\'Вы действительно хотите выполнить экспорт выбранных сайтов?\')) { return false; } 
  window.open(panelpath+\'?export=1&data=\'+queryurl, \'\');    	
 }//ActionToExportURLElements
 
 function ActionToApdateURLElements() {
  AnalysisObj.paramsnoupdate = \'\';
  	
  var count = GetSelectedCount();
  if (!count.selected) { return alert(\'Выберите сайты для обновления!\'); }
  
  if (!panelstatuslk.displayselectparamtoupdate) { return ProcessActionToApdateURLElements(count); }
  
  //selectparams  
  $("#dialog_selparamsforupdate").dialog({
   title: "Обновление сайтов", 
   width:  450,            
   height: \'auto\',
   position: \'center\',         
   modal: true,            
   buttons: {
    "Начать обновление": function() { 	 
	 var isempty = true;
	 var scountp = 0;
	 AnalysisObj.paramsnoupdate = \'\';
	 
	 $(\'#p_paramsselectlistcheckboxies input[type="checkbox"]\').each(function (i) {
	  var ident = (!$(this).attr(\'checked\')) ? $(this).attr(\'p_id\') : false;	  
	  if (ident && ident != \'undefined\') {
	   AnalysisObj.paramsnoupdate += ((AnalysisObj.paramsnoupdate) ? (\',\'+ident) : ident);	
	  } else { 
	   if (ident == false) { scountp++; } 
	  }  	  
	  if (isempty) { isempty = false; }
	  return true;	
	 });
	 
	 if (isempty) { return alert(\'Нет активных параметров обновления! Создайте хотя бы один параметр проверки..\'); } 
	 if (!scountp) { return alert(\'Выберите хотя бы один параметр для обновления!\'); }
	 
	 $(this).dialog("close");
	 ProcessActionToApdateURLElements(count);	 	 	 	 	 	
	},
    "Отмена": function() { $(this).dialog("close"); }
   },
   resizable: false,
   open: function(event, ui) {
   	
   	var blockit = $(\'#p_paramsselectlistcheckboxies\');
	
	if (blockit.attr(\'isdefined\') == \'1\') { return true; }	
	blockit.attr(\'isdefined\', \'1\');
	      	
   	var isempty = true;
   	
   	blockit.html(\'\')
   	
   	$(\'#urlslisttabledata thead tr[id="urllisthead"]\').find(\'th[isdinamicparam="1"]\').each(function (i) {
	 var ident = $(this).attr(\'paramrealid\');
	 if (ident && ident != \'undefined\' && isMachParamType($(this).attr(\'relparamtype\'))) {
	  
	  if (isempty) {
	   blockit.append(
	    \'<div class="typelabel">\'+
	     \'<input type="checkbox" checked="checked" style="cursor: pointer" id="_allselforparams" \'+
		 \'onclick="SetAllCheckedOnSelectParam(this)">\'+
	     \'<label for="_allselforparams" style="cursor: pointer; border-bottom: 1px dashed #0000FF">\'+
		 \'&nbsp;<b>Выбрать/Снять все параметры</b></label>\'+
	    \'</div>\'
	   ); 	
	  }
	  	  
	  blockit.append(
	   \'<div class="typelabel">\'+
	    \'<input type="checkbox" checked="checked" style="cursor: pointer" id="_forselparamtoid\'+ident+\'" p_id="\'+ident+\'">\'+
	    \'<label for="_forselparamtoid\'+ident+\'" style="cursor: pointer">&nbsp;\'+$(this).text()+\'</label>\'+
	   \'</div>\'
	  );
	  
	  if (isempty) { isempty = false; }	
	 }
	 return true;		
	});
	
	if (isempty) { blockit.html(\'<b>Нет активных параметров!</b>\'); }  	
   }	
  });  	
 }//ActionToApdateURLElements
 
 function PrepereSetPanelOptionsData(data) {
  var error = GetErrorData(data);
  if (error) { alert(error); }
  return ShowStatus(\'hide\')	
 }//PrepereSetPanelOptionsData
 
 function PrepereLoadPanelOptionsData(data) {
 	  
  var error = GetErrorData(data);
  if (error) { alert(error); return ShowStatus(\'hide\'); }
  
  $(\'#dialog_globalpaneloptions\').html((!data) ? \'Невозможно загрузить параметры..\' : data);
  
  $("#dialog_globalpaneloptions").dialog({
   title: "Настройки панели", 
   width:  450,            
   height: \'auto\',
   position: \'center\',         
   modal: true,            
   buttons: {
    "Сохранить": function() {
	 if (!confirm(\'Вы действительно хотите применить выбранные настройки?\')) { return false; }
	 
	 var element = $("#dialog_globalpaneloptions");
	 if (!element.find(\'#COUNTONGRAPH\').val()) {
	  alert(\'Укажите числовое значение кол-ва дат истории!\');
	  element.find(\'#COUNTONGRAPH\').focus();	  
	  return false;	
	 }
	 
	 var query = \'\';
	 
	 query += \'&NOEXISTSURL=\'+((element.find(\'#NOEXISTSURL\').attr(\'checked\')) ? \'1\' : \'0\');
	 
	 panelstatuslk.displayselectparamtoupdate = (element.find(\'#NODISPLAYSELECTPARAM\').attr(\'checked\')) ? 0 : 1; 
	 
	 query += \'&NODISPLAYSELECTPARAM=\'+((panelstatuslk.displayselectparamtoupdate) ? \'0\' : \'1\');
	 	 
	 panelstatuslk.displaynoupdateneed = (element.find(\'#NODISPLAYNOTNEEDUPDATEDLOG\').attr(\'checked\')) ? 0 : 1;	  
	 
	 query += \'&NODISPLAYNOTNEEDUPDATEDLOG=\'+((panelstatuslk.displaynoupdateneed) ? \'0\' : \'1\'); 
	 
	 query += \'&COUNTONGRAPH=\'+encodeURIComponent(element.find(\'#COUNTONGRAPH\').val());
	 
	 query += \'&YXMLLOGIN=\'+encodeURIComponent(element.find(\'#YXMLLOGIN\').val());  
	 
	 query += \'&YXMLKEY=\'+encodeURIComponent(element.find(\'#YXMLKEY\').val());
	 
	 query += \'&CANADDEXISTSPARAM=\'+((element.find(\'#CANADDEXISTSPARAM\').attr(\'checked\')) ? \'1\' : \'0\');
	 
	 $(this).dialog("close");	
	 
	 ShowStatus(\'Сохранение параметров, пожалуйста, подождите..\');
	 
	 SendDefaultRequest(panelpath, \'is_ajax_mode=1&action=14\'+query, \'PrepereSetPanelOptionsData\');  	 
	  	 	 	 	 	
	},
    "Отмена": function() { $(this).dialog("close"); }
   },
   resizable: false,
   open: function(event, ui) { ShowStatus(\'hide\'); }	   	
  });
  	
 }//PrepereLoadPanelOptionsData
 
 function PrepereToGetPanelOptions() { 
  ShowStatus(\'Загрузка параметров панели, пожалуйста, подождите..\'); 
  SendDefaultRequest(panelpath, \'is_ajax_mode=1&action=13\', \'PrepereLoadPanelOptionsData\');   	
 }//PrepereToGetPanelOptions
 
 function SetAllCheckedOnSelectParam(th) {
  $(\'#p_paramsselectlistcheckboxies input[type="checkbox"]\').each(function (i) {
   var ident = $(this).attr(\'p_id\');	  
   if (ident && ident != \'undefined\') {
    $(this).attr(\'checked\', (th.checked) ? true : false);
   }  	  
   return true;	
  });	
 }//SetAllCheckedOnSelectParam
 
 function isMachParamType(realtype, listen) {
  var list = (listen) ? listen : panelstatuslk.paramsnoupdated;	
  return (realtype && realtype != \'undefined\' && list && list.indexOf(\'[\'+realtype+\']\', 0) == -1);
 }//isMachParamType
 
 
 function ReloadElements(data, ishead) {
  if (ishead) {
   $(\'#urlslisttabledata thead\').html(\'\');
   $(\'#urlslisttabledata tbody\').html(\'\');
   SendDefaultRequest(panelpath, \'is_ajax_mode=1&action=16\', \'ReloadElements\');
  } else { 
   var error = GetErrorData(data);
   if (error) { alert(error); window.location = panelpath; }		
   $(\'#urlslisttabledata thead\').html(data); 
   ShowStatus(\'hide\');
   ProcessLoadSectionData(GetActiveSection(), true);    	
  }  	
 }//ReloadElements
 
 function PrepereAppNewPanelParam(data) { 
  var error = GetErrorData(data);
  if (error) { alert(error); return ShowStatus(\'hide\'); }  
  if (data != \'2\') { return ShowStatus(\'hide\'); } 
  //reload all
  ShowStatus(\'Применение нового списка параметров, пожалуйста, подождите..\'); 
  ReloadElements(\'\', true);  	
 }//PrepereAppNewPanelParam
 
 function PrepereToAddNewParam() {
  $("#dialog_addnewparam").dialog({
   title: "Добавление параметра", 
   width:  \'auto\',            
   height: \'auto\',
   position: \'center\',         
   modal: true,            
   buttons: {
    "Добавить": function() {
	 
	 var ident = $(\'#addparamselectident option:selected\').val();
	 if (!ident || ident == \'undefined\') { return alert(\'Выберите параметр для добавления!\'); }
	 
	 $(this).dialog("close");	
	 
	 ShowStatus(\'Добавление параметра проверки <b>\'+
	 $(\'#addparamselectident option:selected\').text()+\'</b>, пожалуйста, подождите..\');
	 
	 $(\'#p_paramsselectlistcheckboxies\').attr(\'isdefined\', \'0\');
	 SendDefaultRequest(panelpath, \'is_ajax_mode=1&action=15&data=\'+encodeURIComponent(ident), \'PrepereAppNewPanelParam\');  	 
	  	 	 	 	 	
	},
    "Отмена": function() { $(this).dialog("close"); }
   },
   resizable: false,
   open: function(event, ui) { ShowStatus(\'hide\'); }	   	
  });	
 }//PrepereToAddNewParam
 
 
 function PrepereSavePanelParamOpt(data) {
  if (!data) { PrepereToConfigureParam(true); return false; }
  
  var error = GetErrorData(data);
  if (error) { alert(error); PrepereToConfigureParam(true); return ShowStatus(\'hide\'); }
  
  ShowStatus(\'Применение настроек параметра, пожалуйста, подождите..\');
  
  panelstatuslk.runprogtoload = function () { PrepereToConfigureParam(true); }; 
  ReloadElements(\'\', true);
  	
 }//PrepereSavePanelParamOpt
 
 function PrepereToConfigureParam(noclear) {
    	
  if (!noclear) {    
   var htm = $(\'#confparamselectident\');
   htm.html(\'<option value=""></option>\');  
   $(\'#urlslisttabledata thead tr[id="urllisthead"]\').find(\'th[isdinamicparam="1"]\').each(function (i) {
	 var ident = $(this).attr(\'paramrealid\');
	 if (ident && ident != \'undefined\') {
	  htm.append(\'<option value="\'+ident+\'">\'+trim($(this).text())+\'</option>\');
	 }
	 return true;		
   });	
  }
  	
  $("#dialog_paramoptions").dialog({
   title: "Настройка параметра", 
   width:  450,            
   height: 500,
   position: \'center\',         
   modal: true,            
   buttons: {
    "Сохранить": function() {
	 
	 var ppr = $(\'#confparamselectident :selected\').val();
	 if (!ppr || ppr == \'undefined\') { return alert(\'Необходимо выбрать параметр настройки!\'); }
	 
	 var str = ProcessSaveAllElements();
	 if (!str || str == \'undefined\') { return alert(\'Необходимо выбрать параметр настройки!\'); }
	 
	 $(this).dialog("close");
	 ShowStatus(\'Применение настроек параметра...\');
	 
	 SendDefaultRequest(panelpath, \'is_ajax_mode=1&action=20&\'+str, \'PrepereSavePanelParamOpt\');   	 
	  	 	 	 	 	
	},
    "Отмена": function() { $(this).dialog("close"); }
   },
   resizable: true,
   open: function(event, ui) { 
   	ShowStatus(\'hide\'); 
   	if (!noclear) {
	 $(\'#confparamselectident :first\').attr(\'selected\', true);
	 $(\'#sourceofelementsconf\').html(\'\');
	} 
   }	   	
  });	
 }//PrepereToConfigureParam
 
 function PrepereConfPanelParam(data) {
  if (!data) { return false; }
  
  var error = GetErrorData(data);
  if (error) { alert(error); $(\'#processloadimgconf\').hide(); return false; }
  
  $(\'#sourceofelementsconf\').html(data);
  $(\'#processloadimgconf\').hide();	
 }//PrepereConfPanelParam
 
 function SelectItemLineToGet(th) {
  if (!th.value) { return false; } 
  $(\'#sourceofelementsconf\').html(\'\'); 
  $(\'#processloadimgconf\').show();
  
  SendDefaultRequest(panelpath, \'is_ajax_mode=1&action=19&data=\'+encodeURIComponent(th.value), \'PrepereConfPanelParam\');  
  	
 }//SelectItemLineToGet
 
  
  p_PreloadImagesList(
  [
   status_pockej.statusimage, status_pockej.bgimagefile, status_pockej_fst.bgimagefile,
   path_img_css + \'history.png\', path_img_css + \'info.png\', path_img_css + \'urlmoveobj.png\',
   path_img_css + \'arrow_select.png\'
  ]
 );
 </script>


 '; ?>

 
  
 <!-- добавление нового раздела  -->
 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
  <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
     <span id="ui-dialog-title-dialog" class="ui-dialog-title">Добавление раздела</span>
     <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
  </div>
  <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_addsection">
   
   <div class="typelabel" style="margin-top: 10px"><span id="red">*</span> Укажите название раздела (до 120 символов)</div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 98%" name="p_new_section_name" id="p_new_section_name" value="" maxlength="120">        
   </div>
 	      
  </div>
 </div>
 
 <!-- настройки разделов  -->
 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
  <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
     <span id="ui-dialog-title-dialog" class="ui-dialog-title">Сортировка разделов</span>
     <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
  </div>
  <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_sortsection">
   <div class="typelabel" style="font-size: 11px; padding-bottom: 3px; border-bottom: 1px dashed #C0C0C0">Используйте перемещение блоков вверх\вниз для настройки положения раздела</div>
   <div class="typelabel" id="p_sortsectionslist" style="margin-top: 8px">
    <b>Нет разделов!</b>	     
   </div>
 	      
  </div>
 </div>
 
 <!-- выбор параметров для обновления  -->
 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
  <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
     <span id="ui-dialog-title-dialog" class="ui-dialog-title">Сортировка разделов</span>
     <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
  </div>
  <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_selparamsforupdate">
   <div class="typelabel" style="font-size: 11px; padding-bottom: 3px; border-bottom: 1px dashed #C0C0C0">Выберите параметры, которые следует обновить у выбранных сайтов</div>
   <div class="typelabel" id="p_paramsselectlistcheckboxies" style="margin-top: 8px">
    <b>Нет активных параметров!</b>	     
   </div>
 	      
  </div>
 </div>
 
 <!-- настройки панели оптимизатора  -->
 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
  <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
     <span id="ui-dialog-title-dialog" class="ui-dialog-title">Параметры панели</span>
     <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
  </div>
  <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_globalpaneloptions">
 	      
  </div>
 </div>
 
 <!-- добавление нового параметра  -->
 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
  <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
     <span id="ui-dialog-title-dialog" class="ui-dialog-title">Добавление параметра проверки</span>
     <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
  </div>
  <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_addnewparam">   
   <div class="typelabel" style="margin-top: 10px"><span id="red">*</span> Выберите желаемый параметр для добавления</div>
   <div class="typelabel">
    <select size="1" name="addparamselectident" id="addparamselectident">   
     <?php $_from = $this->_tpl_vars['PANEL_CONTROL']->GetResult('deflistpr'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['ident'] => $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
      <?php if (! $this->_tpl_vars['val']['disabled']): ?>      
	   <option value="<?php echo $this->_tpl_vars['ident']; ?>
"><?php echo $this->_tpl_vars['PANEL_CONTROL']->GetText($this->_tpl_vars['val']['name']); ?>
</option>
	  <?php endif; ?>
	 <?php endforeach; endif; unset($_from); ?>	 
    </select> 
   </div>	      
  </div>
 </div>
 
 <!-- настройки параметров (управление)  -->
 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
  <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
     <span id="ui-dialog-title-dialog" class="ui-dialog-title">Сортировка параметров</span>
     <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
  </div>
  <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_sortsectionparam">
   <div class="typelabel" style="font-size: 11px; padding-bottom: 3px; border-bottom: 1px dashed #C0C0C0">Используйте перемещение блоков вверх\вниз для настройки положения параметра</div>
   <div class="typelabel" id="p_sortsectionslistparam" style="margin-top: 8px">
    <b>Нет параметров!</b>	     
   </div>
 	      
  </div>
 </div>
 
 <!-- настройка параметра  -->
 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
  <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
     <span id="ui-dialog-title-dialog" class="ui-dialog-title">Настройки параметра</span>
     <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
  </div>
  <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_paramoptions">   
   <div class="typelabel" style="margin-top: 10px"><span id="red">*</span> Выберите желаемый параметр для настройки</div>
   <div class="typelabel">
    <span style="width: 100%">
	<table width="100%" cellpadding="0" cellspacing="0">
     <tr>
	  <td valign="top" align="left">
	  <select size="1" name="confparamselectident" id="confparamselectident" onchange="SelectItemLineToGet(this)">   
       <option value=""></option>	 
      </select> 
	  </td>
	  <td valign="top" align="left">
	   <div style="margin-left: 6px; display: none; text-align: right" id="processloadimgconf">	
	    <img id="statuselementgetconf" src=""><br />
		Загрузка параметров...	
	   </div>
	  </td>
     </tr>
    </table>
	</span>
   </div>
   <div class="typelabel" id="sourceofelementsconf"></div>	      
  </div>
 </div>
 
 
 
  
 
 <?php if ($this->_tpl_vars['PANEL_CONTROL']->manageID): ?>
  <div style="margin: 0 2px 20px 20px">
    
    ID #<?php echo $this->_tpl_vars['PANEL_CONTROL']->manageID; ?>
, (пользователь: 
    <?php if ($this->_tpl_vars['PANEL_CONTROL']->manageIDinfo): ?>
     <a href="<?php echo @W_SITEPATH; ?>
userinfo/<?php echo $this->_tpl_vars['PANEL_CONTROL']->manageIDinfo['username']; ?>
/" target="_blank"><?php echo $this->_tpl_vars['PANEL_CONTROL']->manageIDinfo['username']; ?>
</a>
    <?php else: ?>
    <label style="color: #FF0000">некорректный ID</label>, открыта <strong>Ваша</strong> панель!
    <?php endif; ?>    
    )    
    <label style="margin-left: 6px"><a href="<?php echo @W_SITEPATH; ?>
panel/" style="font-size: 95%">Войти в <strong>мою</strong> панель!</a></label>
   
  </div>
 <?php endif; ?> 
 
 
 <div id="allofpanelid">
 
  <div id="p-rounded-box-5">
 <b class="p-r5"></b><b class="p-r3"></b><b class="p-r2"></b><b class="p-r1"></b><b class="p-r1"></b>
 <div class="p-inner-box">
 
   
 <div class="panelcontrolline" align='absmiddle'> 
  <span style="width: 100%;">
   <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
	 <td valign="center" align="left" style="white-space: nowrap;">
	  <?php echo '<span><input type="text" class="inpt" style="width: 160px; border: 1px solid #EAEAEA; color: #333399" name="p_addnewurl" id="p_addnewurl" maxlength="150" value="http://" onblur="if(this.value==\'\'){this.value=\'http://\';}" onfocus="if(this.value==\'http://\'){this.value=\'\';}"></span>'; ?>

  
      <span style="margin-left: 4px"><a href="javascript:" class="addnewurlbutton" name="p_addnewlink" id="p_addnewlink" title="Добавить URL (Enter)" onclick="ProcessAddNewURL()">Добавить</a></span>     
      
      
 <span id="statuscountelementitem" style="display: none">          
      
 <span class="blockmenuitemshead" id="statusitemblock">
  <ul>
   <li class="menuclickitem">Выбрано: <label>0</label></li>   
   <li class="blockitemsbody" style="left: -6px">	  
	<div class="divseparator"><span>Выполнить..</span></div>
	<div class="divblocked"><a id="quicklabeltodelete" href="javascript:" class="delete">Удалить выбранные сайты</a></div>
    <div class="divblocked"><a id="quicklabeltoupdate" href="javascript:" class="update">Обновить выбранные сайты</a></div>
    <div class="divblocked"><a id="quicklabelexport" href="javascript:" class="export">Экспортировать в .CSV</a></div>
    
    <div class="divseparator"><span>Переместить в..</span></div>
    <div class="divblocked" id="sectioninfo"><a href="javascript:">Все сайты</a></div>
	      
   </li>   
  </ul>
 </span> 

</span>
  
      
	 </td>
	 
	 <td valign="center" align="right" width="150px" style="padding-right: 6px; white-space: nowrap;//width: 250px"> 
	  
	  <span><input type="button" class="p_add_sect" name="p_add_sectlink" id="p_add_sectlink" title="Добавить раздел" onclick="ShowDialogAddSection()"></span>
	  
	  <span style="margin-left: 4px"><input type="button" class="p_options_sect" name="p_options_sectlink" id="p_options_sectlink" title="Настройки разделов" onclick="ShowShortSectionsList()"></span>
	  
	  <span style="margin-left: 4px">
	    <select size="1" name="p_selectsection" id="p_selectsection" style="border: 1px solid #EAEAEA" onchange="SelectTabActive(this, '-1', false)">
	    
	    <option value="0"<?php if (! $this->_tpl_vars['PANEL_CONTROL']->GetResult('sections.selected')): ?> selected="selected"<?php endif; ?> id="_section_0">Все сайты</option>
	    <?php $_from = $this->_tpl_vars['PANEL_CONTROL']->GetResult('sections.data'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
	     <option value="<?php echo $this->_tpl_vars['val']['iditem']; ?>
"<?php if ($this->_tpl_vars['PANEL_CONTROL']->GetResult('sections.selected') == $this->_tpl_vars['val']['iditem']): ?> selected="selected"<?php endif; ?> id="_section_<?php echo $this->_tpl_vars['val']['iditem']; ?>
"><?php if ($this->_tpl_vars['PANEL_CONTROL']->strlen($this->_tpl_vars['val']['sectname']) > $this->_tpl_vars['PANEL_CONTROL']->shortnamecount): ?><?php echo $this->_tpl_vars['PANEL_CONTROL']->substr($this->_tpl_vars['val']['sectname'],0,$this->_tpl_vars['PANEL_CONTROL']->GetDifferenceNameShort()); ?>
...<?php else: ?><?php echo $this->_tpl_vars['val']['sectname']; ?>
<?php endif; ?></option>
	    <?php endforeach; endif; unset($_from); ?>
       </select>
	  </span>	  	  
	 </td>
	 
	 <td valign="center" align="right" width="160px" style="white-space: nowrap;">
	   
	  <span class="blockmenuitemshead" id="optionsitemblock" style="text-align: left">
       <ul>
      <li class="menuclickitem" id="titleoptname">Настройки</li>   
        <li class="blockitemsbody" id="bodyoptname" style="//min-width: 185px">	
		 <div class="divseparator"><span>Общие..</span></div>
	     <div class="divblocked"><a id="globalpaneloptionsact" href="javascript:">Настройки панели</a></div>  
	     <div class="divseparator"><span>Разделы сайтов..</span></div>
	     <div class="divblocked"><a id="addnewsectionbuttom" href="javascript:">Добавить новый раздел</a></div>
         <div class="divblocked"><a id="modifysectionbuttom" href="javascript:">Изменить название/переместить</a></div>
         
         <div class="divseparator"><span>Параметры проверки..</span></div>
         <div class="divblocked" id="sectioninfo"><a id="addparamnewqw" href="javascript:">Добавить новый параметр</a></div>
	     <div class="divblocked" id="sectioninfo"><a id="confparamsource" href="javascript:">Изменить настройки параметра</a></div>
	     <div class="divblocked" id="sectioninfo"><a id="moveparamitems" href="javascript:">Сортировать/Удалить параметры</a></div>
		  
        </li>   
       </ul>
      </span>  
	 
	  
	  <span style="margin-left: 6px"><input type="button" class="p_update" name="p_updatelink" id="p_updatelink" title="Обновить выбранные" onclick="ActionToApdateURLElements()"></span>
	  
	  <span style="margin-left: 6px"><input type="button" class="p_delete" name="p_deletelink" id="p_deletelink" title="Удалить выбранные" onclick="DeleteSelectedURLs()"></span>
	  
	 </td>
    </tr>
   </table>
  </span>
 </div>
 
 
 
 <div class="panelblockline">
    <span style="width: 100%">
  <table width="100%" cellpadding="0" cellspacing="0" border="0" id="urlslisttabledata"> 
   <thead><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "seo-panel/list_params_data.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></thead>
   
   <tbody>

   </tbody> 
   
  </table>
  
  <div style="padding-top: 40px; text-align: center" id="allurlisemptylist">Нет ни одного сайта!</div>
   
  </span>
    
 </div>
 
 
 
 <div class="panelbuttomline" id="panelbuttomlineid">
  
  <span class="addnewsection_buttom"><input type="button" class="p_add_sect" name="p_add_sectlink_b" id="p_add_sectlink_b" title="Добавить раздел" onclick="ShowDialogAddSection()"></span>
  
  <span sectionidattr="0" class="<?php if (! $this->_tpl_vars['PANEL_CONTROL']->GetResult('sections.selected')): ?>sectionbutton_selected<?php else: ?>sectionbutton<?php endif; ?>" id="section_0" onclick="SelectTabActive(this, '0', false)">Все сайты (<label id="sitecount_0"><?php echo $this->_tpl_vars['PANEL_CONTROL']->GetResult('sections.allcount'); ?>
</label>)</span>
  <?php $_from = $this->_tpl_vars['PANEL_CONTROL']->GetResult('sections.data'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
   <span sectionidattr="<?php echo $this->_tpl_vars['val']['iditem']; ?>
" class="<?php if ($this->_tpl_vars['PANEL_CONTROL']->GetResult('sections.selected') == $this->_tpl_vars['val']['iditem']): ?>sectionbutton_selected<?php else: ?>sectionbutton<?php endif; ?>" id="section_<?php echo $this->_tpl_vars['val']['iditem']; ?>
" onclick="SelectTabActive(this, '<?php echo $this->_tpl_vars['val']['iditem']; ?>
', false)"><?php echo $this->_tpl_vars['val']['sectname']; ?>
 (<label id="sitecount_<?php echo $this->_tpl_vars['val']['iditem']; ?>
"><?php echo $this->_tpl_vars['val']['urlcount']; ?>
</label>)<label class="closesectionbutton" onclick="ActionToDeleteSection('<?php echo $this->_tpl_vars['val']['iditem']; ?>
')">x</label></span>
  <?php endforeach; endif; unset($_from); ?>
 </div>
 
  </div>
 <b class="p-r1"></b><b class="p-r1"></b><b class="p-r2"></b><b class="p-r3"></b><b class="p-r5"></b>
 </div> 
 
 </div>
 
 <?php echo '        
 <script type="text/javascript">
  function ReinitButtomsList(allbuttoms) {
   if (allbuttoms) {	
    $(\'.sectionbutton_selected\').corner("bottom 4px");
   }
   $(\'.sectionbutton\').corner("bottom 4px");	
  }//ReinitButtomsList
  
  jQuery(document).ready(function() { 
   $(\'.panelcontrolline\').corner("top 4px");
   $(\'.panelblockline\').corner("bottom 4px");  
   ReinitButtomsList(true);
   
   $(\'#p_addnewurl\').keydown(function(e) {
    if (e.keyCode == 13 && !StatusShowed()) { ProcessAddNewURL(); }
   });
   
   ProcessLoadSectionData(GetActiveSection(), true);

   
   $(\'#statusitemblock\').domenuitems({
	oncreate: function (elemid) {
	 
	 $(\'#globalbodydata\').css(\'cursor\', \'wait\');
	 $(\'#allofpanelid\').css(\'cursor\', \'wait\');
	 
	 elemid.find(\'div[id="sectioninfo"]\').each(function (i) {	  	
	  $(this).remove();
	  return true;	  	
	 });
	 
	 $(\'#p_selectsection\').find(\'option\').each(function (i) {
	  var item = $(this);
	  var iditem = item.val();
	  
	  if (item.attr(\'id\') == \'_section_\' + iditem) { 		   		   	   
	   elemid.find(\'.blockitemsbody\').append(
	    \'<div class="divblocked" id="sectioninfo"><a href="javascript:" sid="\'+iditem+\'">\'+item.text()+\'</a></div>\'
	   );	   	   	
	  }
	  return true;	
	 }); 
	 
	 elemid.find(\'div[id="sectioninfo"] a\').each(function (i) {
	  $(this).click(function () {
	   $(\'#statusitemblock\').domenuitems({}, \'hide\');
	   ProcessMoveItems(this);	  	
	  });	 
	 });
	 
	 $(\'#globalbodydata\').css(\'cursor\', \'auto\');
	 $(\'#allofpanelid\').css(\'cursor\', \'auto\');
	 
	 return true; 	
	}
   });     
   
   
   $(\'#statusitemblock\').find(\'.blockitemsbody a\').each(function (i) {   
    var aident = $(this).attr(\'id\');    
	   
    $(this).click(function () { $(\'#statusitemblock\').domenuitems({}, \'hide\'); });
    
    if (aident == \'quicklabeltodelete\') {
	 $(this).click(function () { DeleteSelectedURLs(); });	
	}
	
	if (aident == \'quicklabeltoupdate\') {
	 $(this).click(function () { ActionToApdateURLElements(); });	
	}	
	
	if (aident == \'quicklabelexport\') {
	 $(this).click(function () { ActionToExportURLElements(); });	
	}
		 	 
   });
   
   
   $(\'#optionsitemblock\').domenuitems();
   
   var wtitle = $(\'#titleoptname\').width();
   var wbodyq = $(\'#bodyoptname\');
   
   wtitle = 0 - (wbodyq.width() - wtitle - 20);   
   wbodyq.css(\'left\', wtitle);


   $(\'#optionsitemblock\').find(\'.blockitemsbody a\').each(function (i) {   
    var aident = $(this).attr(\'id\');  
	     
    $(this).click(function () { $(\'#optionsitemblock\').domenuitems({}, \'hide\'); });
    
    if (aident == \'globalpaneloptionsact\') {
	 $(this).click(function () { PrepereToGetPanelOptions(); });	
	}
	
	if (aident == \'addnewsectionbuttom\') {
	 $(this).click(function () { ShowDialogAddSection(); });	
	}
	
	if (aident == \'modifysectionbuttom\') {
	 $(this).click(function () { ShowShortSectionsList(); });	
	}	
	
	if (aident == \'addparamnewqw\') {
	 $(this).click(function () { PrepereToAddNewParam(); });	
	}
	
	if (aident == \'moveparamitems\') {
	 $(this).click(function () { ShowShortSectionsListParam(); });	
	}
	
	if (aident == \'confparamsource\') {
	 $(this).click(function () { PrepereToConfigureParam(); });	
	}	
	
	$(\'#statuselementgetconf\').attr(\'src\', status_pockej.statusimage);		 
		 	 
   });    
   	
  }); 
 </script>     
 '; ?>

  
<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['PANEL_CONTROL'] ) && ! $this->_tpl_vars['PANEL_CONTROL']->paneldisplayed): ?>
<div class="bgnoregplqw"><img src="<?php echo @W_SITEPATH; ?>
css/panel/img/bgnoregimage.png" width="900px"></div>
<?php endif; ?>