{* информация о ip брайзере *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Здесь Вы можете посмотреть информацию о Вашем IP, браузере.<br /><br />
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
  
  <script type="text/javascript">
   function ShHdBlElement(th, ident) {	   
    var hd = ($('#'+ident).css('visibility') == 'hidden') ? true : false; 
    $(th).html((hd) ? 'Скрыть' : 'Показать');
    $('#'+ident).css('visibility', (hd) ? 'visible' : 'hidden');
    $('#'+ident).css('display', (hd) ? 'block' : 'none');
   }//ShHdBlElement 	
     
   function DoHigl(th, n) {	
    if (n) { $(th).css('background','#F9FAFB'); } else {   	
     $(th).css('background', 'none');		
    }	
   }//DoHigl
   
   //t
  function GetT() {
	var currentTime = new Date();
	var hours = currentTime.getHours();
	var minutes = currentTime.getMinutes();
	var seconds = currentTime.getSeconds();	
	if (minutes < 10) { minutes = "0" + minutes; }	
	if (seconds < 10) { seconds = "0" + seconds; }		
	return hours + ":" + minutes + ":" + seconds;
  }//GetT
  
  //w t
  function WriteTime_ () {
   $("#curtime").html(GetT());   
   setTimeout('WriteTime_()', 1000);	
  }//WriteTime_ 
    
  //time z
  function GetTZ() {
   var d = new Date();
   var minutes = d.getTimezoneOffset();
   return minutes / 60;	
  }//GetTZ
  
  //get d
  function GetDFull() {
   name_month = new Array (
    "Января","Февраля","Марта","Апреля","Мая","Июня","Июля","Августа","Сентября","Октября","Ноября","Декабря"
   );
   name_day = new Array ("Воскресенье","Понедельник","Вторник","Среда","Четверг", "Пятница","Суббота");   	
   time = new Date();	
   return time_wr = "" + name_day[time.getDay()] + ", " + time.getDate() + " " + 
   name_month[time.getMonth()] + " " + time.getFullYear() + " г.";
  }//GetDFull    
  
  //screen res
  function DogetScreenRes() {
   var height=0; var width=0;
   if (screen) {
    width = screen.width;
    height = screen.height;
   } else if (java) {
    var jkit = java.awt.Toolkit.getDefaultToolkit();
    var scrsize = jkit.getScreenSize();
    width = scrsize.width;
    height = scrsize.height;
   }
   //screen
   if (width > 0 && height > 0) {
   	$("#resolut").html(width + ' x ' + height);
   } 
   //browser se
   width = $(window).width();
   height = $(window).height();
   if (width > 0 && height > 0) {
   	$("#curbrsize").html(width + ' x ' + height);
   }    
   //sustem
   $("#systeml").html(navigator.platform);
   //cookies sup
   $("#cookies_support").html((document.cookie ? "Да" : "Нет"));
   //js sup
   $("#javas_support").html('Да');   
   //java sup
   $("#java_support").html((navigator.javaEnabled() ? "Да" : "Нет"));
   //tz
   $("#tzcur").html(GetTZ() + ' UTC');
   //de
   $("#curdate").html(GetDFull());   	
   //te
   WriteTime_();   	
      	
  }//DogetScreenRes
  
  $(document).ready(function(){ DogetScreenRes(); });    
  </script> 
 {/literal}
 
     <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>IP, Интернет</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'ipinetblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="ipinetblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
             
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Ваш IP:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {if $tool_object->GetResult('ipinfo.ip')}
		  {$tool_object->GetResult('ipinfo.ip')}
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Хост:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {if $tool_object->GetResult('ipinfo.hostip')}
		  {$tool_object->GetResult('ipinfo.hostip')}
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Расположение:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {if $tool_object->GetResult('geoinfo.geoplugin_countryName')}
		 {if $tool_object->FlagExists()}
		  <span style="margin-right: 3px"><img src="{$tool_object->GetFlagName()}" width="22" height="16"></span>
		 {/if}		 
		 {$tool_object->GetResult('geoinfo.geoplugin_countryName')}
		{else}
		 ?
		{/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Широта:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {if $tool_object->GetResult('geoinfo.geoplugin_latitude')}
		  {$tool_object->GetResult('geoinfo.geoplugin_latitude')}
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Долгота:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {if $tool_object->GetResult('geoinfo.geoplugin_longitude')}
		  {$tool_object->GetResult('geoinfo.geoplugin_longitude')}
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Скорость интернет соединения:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <a href="{$smarty.const.W_SITEPATH}tools/internetspeed/" target="_blank">Проверить</a> 
	    </td>
       </tr>       
       
	  </table>	
	 </span>	  	  
	 </div>
 
     <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Браузер, система</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'brsystemblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="brsystemblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
             
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Браузер:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {$CONTROL_OBJ->GetUserAgent()} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Браузер (оригинал передачи):	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {if $smarty.server.HTTP_USER_AGENT}
		  {$smarty.server.HTTP_USER_AGENT}
		 {else}
		  ?
		 {/if}   
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Разрешение экрана:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="resolut">?</span>   
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Текущий размер браузера:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="curbrsize">?</span>   
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Система:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="systeml">?</span>   
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Поддержка Cookies:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="cookies_support">?</span>   
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Поддержка Java:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="java_support">?</span>   
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Поддержка JavaScript:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="javas_support"><b style="color: #FF0000">Нет</b></span>   
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Поддержка Mime типов:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px">
		 {if $smarty.server.HTTP_ACCEPT} 
		  {$tool_object->cList_($smarty.server.HTTP_ACCEPT)}
		 {else}
		  ?
		 {/if}  		    
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Язык:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px">
		 {if $smarty.server.HTTP_ACCEPT_LANGUAGE} 
		  {$tool_object->cList_($smarty.server.HTTP_ACCEPT_LANGUAGE)}
		 {else}
		  ?
		 {/if} 		    
	    </td>
       </tr>
       
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Кодировка:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px">
		 {if $smarty.server.HTTP_ACCEPT_CHARSET} 
		  {$tool_object->cList_($smarty.server.HTTP_ACCEPT_CHARSET)}
		 {else}
		  ?
		 {/if} 		    
	    </td>
       </tr>
	     
	  </table>	
	 </span>	  	  
	 </div>
 
     
     <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Дата, зона</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'datezoneblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="datezoneblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
             
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Временная зона:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="tzcur">?</span> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Текущая дата:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="curdate">?</span> 
	    </td>
       </tr>
        
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Текущее время:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="curtime">?</span> 
	    </td>
       </tr>   
	     
	  </table>	
	 </span>	  	  
	 </div>
 
 {/if}	 	 
</div>