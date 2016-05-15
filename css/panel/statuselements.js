/* поддержка статуса выполнения */
(function($) {
    $.fn.stLine = function(data, options, onlysettext) { 
		
	if (data == 'isshow') {
	 var resis = false;		 
	 $(this).find("span[id='textsourceidstat']").each(function (i) {
	   resis = true;		   		   		   	
	   return false;	
	 });
	 return resis;		 	
	}
			
	return this.each(function() {
		var element = $(this);	
		
		if (data == 'resize') {
		 element.find("div[id='statuslabelidwnd']").each(function (i) {
		   $(this).css({height: element.height(),width:element.width()});		   		   		   		   	
		   return false;	
		 });		 
		 return element;	 	
		}
		
		if (onlysettext) {
		 element.find("span[id='textsourceidstat']").each(function (i) {
		   $(this).html(data);		   		   		   	
		   return true;	
		 });			
		}
		
		var MethodHide = function () {		 	
		 element.find("div[id='statuslabelidwnd']").each(function (i) {
		   var p_item = $(this);		   		   
		   var tid = p_item.attr('timerid');		    
		   p_item.remove();		   
		   if (tid) { window.clearInterval(tid); }		   	
		   return true;	
		 });		 	
		};
				
		//закрыть, если нужно
		if (data == 'hide') { MethodHide(); return element; }
		
		//показать		        
        var settings = $.extend({           
			speedupdate: 1000, //обновлять каждую секунду
			statusimage: '',   //изображение прогресса
			bgimagefile: '',   //фон
			bgcssoption: {},   //дополнительные параметры для фона
			shontopitem: '',   //положение текста вверху (в px)
			roundwhite : true,
			bgcolorrd  : '#FFFFFF'					
        }, options||{});   
		 
        //очистить
        MethodHide(element); //element.find("span[id='statuslabelidwnd']").remove();		
		
		//добавить блок    		
		var bg = (settings.bgimagefile) ? 'url('+settings.bgimagefile+') top left repeat' : 'transparent';
		var img = (!settings.statusimage) ? '' : '<img border="0" src="'+settings.statusimage+'" alt="progress">';
		
		var pdata = '<span id="textsourceidstat" style="'+((settings.bgcolorrd) ? ('background: '+settings.bgcolorrd+'; ') : '')+ 'padding: 4px; margin-bottom: 4px; display: inline-block; width: auto;">'+data+'</span>';
		
		var lineSource = (settings.shontopitem) ? ('<tr><td valign="top" align="center" id="textsourceidspace" style="padding-top: '+settings.shontopitem+'px">'+data+'<br /><br />'+img+'</td></tr>') : ('<tr><td valign="bottom" align="center" id="textsourceidspace">'+pdata+'</td></tr><tr><td valign="top" align="center" style="padding-top: 4px" height="50%">'+img+'</td></tr>');
			
		element.prepend('<div id="statuslabelidwnd" style="z-index: 3000; position: absolute; background: '+bg+'"><table width="100%" height="100%" cellpadding="0" cellspacing="0">'+lineSource+'</table></div>');
		
		if (settings.roundwhite) {
		 element.find("span[id='textsourceidstat']").corner("all 4px");	
		}
		
		element.find("div[id='statuslabelidwnd']").each(function (i) {
		  var item = $(this);
		  item.css({height: element.height(), width: element.width()});
		  
		  if (settings.bgimagefile) {
		   item.css(settings.bgcssoption);	
		  } 	  

		  var handler = function () {
		   $('#'+element.attr('id')).stLine('resize');		 	
		  };
        
          var att = window.setInterval(handler, settings.speedupdate);
          if (att) { item.attr('timerid', att); }
		    	
		  return true;	
		});

        return element;
    });}  
})(jQuery);