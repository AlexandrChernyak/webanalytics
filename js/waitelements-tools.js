 //------------------------------------------------------
 
 var wait_progress_element = {
  waitid: 'loadingitembyprogress',
  imagefiledata: '',
  imageslistdata: new Array(),
  
  initImage: function (imagefile, onlyinit) {
   if (!onlyinit) {
    this.imagefiledata = imagefile; 
   }           
   var index = this.imageslistdata.length + 1;   
   this.imageslistdata['n'+index] = new Image();
   this.imageslistdata['n'+index].src = imagefile;
  },//initImage
  
  Wait: function (text) {
   if (this.WaitExists() || !this.imagefiledata) { return true; }
   
   var imageident = '<div><img src="'+this.imagefiledata+'" border="0" /></div>';
   var text2 = '<div style="margin-top: 3px; color: #0000FF">'+text+'</div>';
   
   $('body').append(    
    '<div style="position: fixed; z-index:1000; background: #EFEFEF; width: auto; height: auto; display: none;'+
    'top: 40%; left: 40%; text-align: center; vertical-align: baseline; padding: 8px 3px"'+
    ' id="'+this.waitid+'">'+imageident+text2+  
    '</div>'
   ); 
   
   var itemwaitobject = $('#'+this.waitid);
   var centerY = $(window).scrollTop() + ($(window).height() + itemwaitobject.height())/2;
   var centerX = $(window).scrollLeft() + ($(window).width() + itemwaitobject.width())/2;
   itemwaitobject.corner("all 5px");
   itemwaitobject.show(); 
   return true;  
  },//Wait 
  
  WaitExists: function () {
   var result = false;
   $('body').find('#'+this.waitid).each(function (i) {
    result = true;
    return false;    
   });
   return result;    
  },//WaitExists 
    
  StopWait: function () {   
   $('body').find('#'+this.waitid).each(function (i) {
    $(this).remove();
    return false;    
   });   
  },//StopWait 
  
  Pause: function (n) {
   today=new Date()
   today2=today
   while((today2-today)<=n){ today2=new Date() }
  }//Pause 
    
 }
 
//------------------------------------------------------
/* Copyright (с) 2011 forwebm.net */