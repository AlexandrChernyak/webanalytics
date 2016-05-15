/* меню выподающих списков */
(function($) {
    $.fn.domenuitems = function(options, action) { 			
	return this.each(function() {
		var element = $(this);	
		        
          var settings = $.extend({           
		   labelidclass   : '.menuclickitem', 
		   bodyitemsblock : '.blockitemsbody',
		   selectedclass  : 'selected',
		   oncreate       : function (elemid) { return false; }				
          }, options||{}); 
		  
		  
		  if (action == 'hide') {	  	
		   $(element).find(settings.labelidclass).removeClass(settings.selectedclass)
		   .parent().removeClass(settings.selectedclass);
		   
		   $(element).find(settings.bodyitemsblock).stop(false, true).hide();	   
		   return element;	
		  }  		 
		  
		  element.find(settings.labelidclass).click(function(){   	 		
		
		  var functorestoreitem = function (doadd) {		 
		   var elementid = $(element).find(settings.labelidclass);
		 
		   if (doadd) { 
		   	  elementid.addClass(settings.selectedclass); 
		   } else { 
		  
		    elementid.removeClass(settings.selectedclass);
		    elementid.parent().removeClass(settings.selectedclass);
		 
		   }	
		   return elementid;
		  };
		
		  functorestoreitem();
		
		  $(element).find(settings.bodyitemsblock).stop(false, true).hide();
		  
		  settings.oncreate(element);		
				
		  $(element).find(settings.bodyitemsblock).mouseleave(function(){
		    functorestoreitem();
		    $(this).fadeOut(300);		  			
		  })		  
		  .stop().fadeIn();
		
		  functorestoreitem(true);  
		  	 
		  return false;
         });  	

        return element;
    });}  
})(jQuery);