{* информация о ip брайзере *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Here you can view information about your IP, browser.<br /><br />
 {/if}
  
 <div style="clear: both;"></div>
 </div>

 {if !$tool_object->canrun}
  <div style="margin-top: 25px">
  {if $tool_object->onlyforadmin}
  The tool is temporarily disabled by administrator! We apologize for any inconvenience .. Please try again later.
  {else}  
  To use this tool requires authorization on the site. Please login or <a href="{$smarty.const.W_SITEPATH}register/" target="_blank">register</a> to gain access to the tool.
  {/if} 
  </div>
 {else}
  
 {literal}
 <style type="text/css">
    .h_th1, .h_td, .h_td2 { 
     border: 1px solid #E4D9CB; background: #EEE7DF; height: 25px; border-bottom: none; border-right: none; 
     border-right: none; font-weight: bold; 
    }
    .h_td { border-left: none; }
    .h_td2 { border-right: 1px solid #E4D9CB; border-left: none; }
    .btn_n { border: 1px solid #E4D9CB; border-top: none; height: 25px; margin-top: 4px; }
    .sth1 { border-bottom: 1px solid #E4D9CB; height: 25px; border-top: none; } 	
  </style>
  
  <script type="text/javascript">
   function ShHdBlElement(th, ident) {	   
    var hd = ($('#'+ident).css('visibility') == 'hidden') ? true : false; 
    $(th).html((hd) ? 'Hide' : 'Show');
    $('#'+ident).css('visibility', (hd) ? 'visible' : 'hidden');
    $('#'+ident).css('display', (hd) ? 'block' : 'none');
   }//ShHdBlElement 	
     
   function DoHigl(th, n) {	
    if (n) { $(th).css('background','#F8F5F1'); } else {   	
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
    "January", "February", "March", "April", "May", "Jun", "July", "August", "September", "October", "November", "December"
   );
   name_day = new Array ("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");   	
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
   $("#cookies_support").html((document.cookie ? "Yes" : "No"));
   //js sup
   $("#javas_support").html('Yes');   
   //java sup
   $("#java_support").html((navigator.javaEnabled() ? "Yes" : "No"));
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
	 <b>IP, Internet</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'ipinetblocksource')">Hide</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="ipinetblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
             
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Your IP:	    
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
	     Host:	    
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
	     Location:	    
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
	     Latitude:	    
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
	     Longitude:	    
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
	     Speed internet connection:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <a href="{$smarty.const.W_SITEPATH}tools/internetspeed/" target="_blank">Check</a> 
	    </td>
       </tr>       
       
	  </table>	
	 </span>	  	  
	 </div>
 
     <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Browser, system</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'brsystemblocksource')">Hide</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="brsystemblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
             
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Browser:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {$CONTROL_OBJ->GetUserAgent()} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Browser (original transmission):	    
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
	     Screen Resolution:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="resolut">?</span>   
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Current browser size:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="curbrsize">?</span>   
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     System:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="systeml">?</span>   
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Support Cookies:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="cookies_support">?</span>   
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Support Java:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="java_support">?</span>   
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Support JavaScript:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="javas_support"><b style="color: #FF0000">No</b></span>   
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Support Mime types:	    
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
	     Language:	    
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
	     Encoding:	    
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
	 <b>Date, zone</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'datezoneblocksource')">Hide</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="datezoneblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
             
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Time zone:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="tzcur">?</span> 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Current Date:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <span id="curdate">?</span> 
	    </td>
       </tr>
        
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Current Time:	    
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