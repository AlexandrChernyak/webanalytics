{* 
 вывод блока анализа сайта по `История изменения показателей сайта`
 входные параметры:
 
 $block_ident = идентификатор блока для вывода
 $chart_width = ширина графика (по умолчанию 600)
 $chart_height= высота графика (по умолчанию 400)
 
*}
 {if $tool_object->GetToolLimitInfoEx('enabledphistory') && $tool_object->GetResult('pageinfo.realhost')}  
 <div class="analisislabelid"><b>History of site parameters</b><label style="color: #000000; margin-left: 6px">[
 <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'blockidqw{$block_ident}')">Hide</a> ]</label>
 </div>
 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="blockidqw{$block_ident}">
  <div style="margin-top: 10px">
   <script type="text/javascript" src="{$smarty.const.W_SITEPATH}swf/amcharts/flash/swfobject.js"></script>
   {literal}
   <script type="text/javascript">
    var sourceident = '{/literal}sourceitemdata{$block_ident}{literal}';
    var statusidq   = sourceident + 'status';
    var typeidq     = sourceident + 'type';
    var globalpatht = '{/literal}{$smarty.const.W_SITEPATH}{literal}';
    var toolpathitr = globalpatht + 'tools/{/literal}{$tool_object->section_id}{literal}/';	 
    var paramsXML   = '';
	var dataCSV     = '';
	var identdataU  = encodeURIComponent('{/literal}{$tool_object->GetResult('pageinfo.realhost')}{literal}');	
	var charwidth   = '{/literal}{if !$chart_width}600{else}{$chart_width}{/if}{literal}';
	var charheight  = '{/literal}{if !$chart_height}400{else}{$chart_height}{/if}{literal}';
	var ignoreitems = '';
	{/literal}
	{if $tool_object->GetResult('LIvalue.LiDayStatistic') === false}ignoreitems = ignoreitems + '&LiDayStatistic=1';{/if}
	{if $tool_object->GetResult('LIvalue.LiMonthStatistic') === false}ignoreitems = ignoreitems + '&LiMonthStatistic=1';{/if} 	 
	{literal}
    
    function PrepereParamsXML(data) {
	 paramsXML = data;
	 $('#'+statusidq).html('Prepere data..');	 	 
	 SendDefaultRequest(toolpathitr, 'is_ajax_mode=1&getdata=1&host='+identdataU+ignoreitems, 'PrepereDataSCV');	
	}//PrepereParamsXML
	
	function PrepereDataSCV(data) {
	 dataCSV = data;
	 //$('#'+sourceident).css('width', charwidth);
	 $('#'+sourceident).css('height', charheight);
	 //init char
	 var params = { bgcolor: "#FFFFFF" };
	 var flashVars = { 
	  path: globalpatht + "swf/amcharts/flash/", 
	  chart_data: dataCSV, 
	  chart_settings: paramsXML 
	 }
	 swfobject.embedSWF(
	  globalpatht + "swf/amcharts/flash/amline.swf", sourceident, 
	  charwidth, charheight, "8.0.0", globalpatht + "swf/amcharts/flash/expressInstall.swf", 
	  flashVars, params
	 );	 	
	}//PrepereDataSCV	
    
    $(document).ready(function() {
	 $('#'+sourceident).html(
	  '<div class="typelabel" id="'+statusidq+'">Initializing history..</div>' +
      '<div class="typelabel" id="'+typeidq+'">' +
	  '<img src="'+globalpatht+'athemes/SIMPLE/img/ajax-loader.gif" border="0">' +
	  '</div>'
	 );	 
     SendDefaultRequest(toolpathitr, 'is_ajax_mode=1&getparams=1&host='+identdataU+ignoreitems, 'PrepereParamsXML');	  
    });	
   </script>
   {/literal}
   <div id="sourceitemdata{$block_ident}" style="background-color:#FFFFFF">
    (?.. wait) 
   </div> 
  </div>
 </div>
 {/if}