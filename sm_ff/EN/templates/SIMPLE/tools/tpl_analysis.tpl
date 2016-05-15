{* анализ сайта *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
  This tool will help you to perform site analysis on the most significant indicators of site.<br /><br />
 {/if}
  
 <div style="clear: both;"></div>
 </div>

 {if !$tool_object->canrun}
  <div style="margin-top: 25px">
  {if $tool_object->onlyforadmin}
  The tool is temporarily disabled by the administrator! We apologize for any inconvenience .. Please try again later.
  {else}  
  To use this tool requires authorization on the site. Please login or <a href="{$smarty.const.W_SITEPATH}register/" target="_blank">register</a> to gain access to the tool.
  {/if} 
  </div>
 {else}
  
 {literal}
 <script type="text/javascript">
  function DoSetDefUrl(ident) {
   var str = {/literal}'{$smarty.const.W_HOSTMYSITE}';{literal}
   var obj = $('#'+ident);
   obj.val(str); 
   obj.focus();  	
  }//DoSetDefUrl
  function PrepereToSend(th) {
   if (trim(th.url.value) == '') {
	alert('Enter URL!');
	th.url.focus();
	return false;
   }
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;   
   return true;	
  }//PrepereToSend  	
 </script>
 {/literal}
 <form method="post" name="tollform" id="toolform" onsubmit="return PrepereToSend(this)">
  <div><span style="width: 100%">
  <table width="100%" cellpadding="0" cellspacing="0">
   <tr>
	<td valign="top" align="left">
	<div class="typelabel"><label id="red">*</label> URL<label class="prep_label_analisys">(example: <a href="javascript:" onclick="DoSetDefUrl('url')">{$smarty.const.W_HOSTMYSITE}</a>)</label></div>
    <div class="typelabel">  
     <input type="text" value="{$CONTROL_OBJ->GetPostElement('url', 'doactiontool')}" style="width: 98%" class="inpt" name="url" id="url"> 
    </div>
	</td>
	<td valign="top" align="left" width="150px">
	 <div class="typelabel">&nbsp;</div>
	 <div class="typelabel">
      <input type="submit" value="&nbsp;Send&nbsp;" class="button" name="rb" id="rb">
     </div>
	</td>
   </tr>
  </table>
  </span></div>
  
  <input type="hidden" value="do" name="doactiontool">  
 </form>
 {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  <div style="margin-top: 15px">
  {if $tool_object->error}
  <div style="color: #FF0000">{$tool_object->error}</div>
  {else}
   {if $tool_object->GetResult()} 
    <div>
     {literal}
     <script type="text/javascript">
	  function ShHdBlElement(th, ident) {	   
	   var hd = ($('#'+ident).css('visibility') == 'hidden') ? true : false; 
	   $(th).html((hd) ? 'Hide' : 'Show');
	   $('#'+ident).css('visibility', (hd) ? 'visible' : 'hidden');
	   $('#'+ident).css('display', (hd) ? 'block' : 'none');
	  }//ShHdBlElement 
	  
	  function DoHigl(th, n) {	
       if (n) { $(th).css('background','#F9FAFB'); } else {   	
        $(th).css('background', 'none');		
       }	
      }//DoHigl 
     </script>
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
     {/literal}
     
     <div style="margin-top: 20px"><span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0" class="generaltb-info">
      <tr>
	   <td valign="top" align="left" width="145px">
	    <img src="http://open.thumbshots.org/image.aspx?url={$tool_object->GetResult('pageinfo.realhost')}"	width="120" height="90">      
	   </td>
	   <td valign="top" align="left">
	    <div><span style="width: 100%">
		<table width="100%" cellpadding="0" cellspacing="0" class="generaltb-info">
         
		 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>URL</span></td>
	      <td valign="top" align="left" class="param-descr">
		   <div><noindex><a rel="nofollow" href="http://{$tool_object->GetResult('pageinfo.host')}" target="_blank">{$tool_object->CorrectURLLink($tool_object->GetResult('pageinfo.host'), 50)}</a></noindex>
		<span style="margin-left: 2px"><img src="http://favicon.yandex.net/favicon/{$tool_object->GetResult('pageinfo.host')}" width="16" height="16" align='absmiddle'></span>
		<label style="margin-left: 3px">(<a style="font-size: 95%; color: #808080" href="{$smarty.const.W_SITEPATH}tools/whoisurlip/{$tool_object->GetResult('pageinfo.host')}" target="_blank">WHOIS IP</a>, <a style="font-size: 95%; color: #808080" href="{$smarty.const.W_SITEPATH}tools/whoisdomain/{$tool_object->GetResult('pageinfo.host')}" target="_blank">WHOIS DOMAIN</a>)</label></div>
		  </td>
         </tr>
         
         {if $tool_object->GetResult('cachlastupdatedate')}
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Last update</span></td>
	      <td valign="top" align="left" class="param-descr" style="color: #0000FF">
		   {$CONTROL_OBJ->GetLastIntervalInDays($tool_object->GetResult('cachlastupdatedate'))} &nbsp; ({$tool_object->GetResult('cachlastupdatedate')})
           
          {if $tool_object->NextUpdateDate()}
          <label style="margin-left: 5px; font-size: 95%; color: #000000">
          (for updates - sign up, next update after: {$tool_object->NextUpdateDate()})
          </label>
          {/if}
                     
		  </td>
         </tr>
         {/if}
         
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Title</span></td>
	      <td valign="top" align="left" class="param-descr">
		   {if !$tool_object->GetResult('pageinfo.title')}
		    <i>(no)</i>
		   {else}
		    {$tool_object->GetResult('pageinfo.title')}
		   {/if}
		  </td>
         </tr>
         
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Keywords</span></td>
	      <td valign="top" align="left" class="param-descr">
		   {if !$tool_object->GetResult('pageinfo.keywords')}
		    <i>(no)</i>
		   {else}
		    {$tool_object->GetResult('pageinfo.keywords')}
		   {/if}
		  </td>
         </tr>
         
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Description</span></td>
	      <td valign="top" align="left" class="param-descr">
		   {if !$tool_object->GetResult('pageinfo.description')}
		    <i>(no)</i>
		   {else}
		    {$tool_object->GetResult('pageinfo.description')}
		   {/if}
		  </td>
         </tr>
         
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Tag h1</span></td>
	      <td valign="top" align="left" class="param-descr">
		   {if !$tool_object->GetResult('pageinfo.h1tag')}
		    <i>(no)</i>
		   {else}
		    {$tool_object->GetResult('pageinfo.h1tag')}
		   {/if}
		  </td>
         </tr>
         
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Page Size</span></td>
	      <td valign="top" align="left" class="param-descr">
		   {$tool_object->GetResult('pageinfo.size')}
		  </td>
         </tr>
         
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Encoding</span></td>
	      <td valign="top" align="left" class="param-descr">
		   {if $tool_object->GetResult('pageinfo.encode')}{$tool_object->GetResult('pageinfo.encode')}{else}?{/if}
		  </td>
         </tr>
         
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Site IP</span></td>
	      <td valign="top" align="left" class="param-descr">
	      {if $tool_object->GetResult('pageinfo.ip')}
		   {$tool_object->GetResult('pageinfo.ip')}
		   <span style="margin-left: 12px">
		    <noindex><a href="{$tool_object->GetResult('ipinfolink')}" target="_blank">All site on IP</a></noindex>
		   </span>
		  {else}
		   ?
		  {/if}
		  </td>
         </tr>  
		 
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Download speed</span></td>
	      <td valign="top" align="left" class="param-descr">
	      {if $tool_object->GetResult('pageinfo.speed')}{$tool_object->GetResult('pageinfo.speed')}{else}?{/if}
		  </td>
         </tr>
		 
		 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Download Time</span></td>
	      <td valign="top" align="left" class="param-descr">
	      {if $tool_object->GetResult('pageinfo.time')}{$tool_object->GetResult('pageinfo.time')} sec{else}?{/if}
		  </td>
         </tr>		 
		        
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Redirecting</span></td>
	      <td valign="top" align="left" class="param-descr">
	      {if $tool_object->GetResult('pageinfo.redirectto')}
		   <noindex><a rel="nofollow" href="{$tool_object->GetResult('pageinfo.redirectto')}" target="_blank">{$tool_object->CorrectURLLink($tool_object->GetResult('pageinfo.redirectto'), 100)}</a></noindex>		 
		  {else}
		   <i>(no)</i>
		  {/if}
		  </td>
         </tr>
         
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Internal / external Links</span></td>
	      <td valign="top" align="left" class="param-descr">
	       <noindex><a rel="nofollow" href="{$smarty.const.W_SITEPATH}tools/checkurllinks/{$tool_object->GetResult('pageinfo.host')}" target="_blank">Analysis</a></noindex>
		  </td>
         </tr>
         
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>An analysis of page content</span></td>
	      <td valign="top" align="left" class="param-descr">
	       <noindex><a rel="nofollow" href="{$smarty.const.W_SITEPATH}tools/contentcheck/{$tool_object->GetResult('pageinfo.host')}" target="_blank">Analysis</a></noindex>
		  </td>
         </tr>
         
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Visitors per day by 
		  <label style="border-bottom: 1px dashed #333399; cursor: help" title="Live Internet">LI</label></span></td>
	      <td valign="top" align="left" class="param-descr">
	       {if $tool_object->GetResult('LIvalue.LiDayStatistic')}{$tool_object->GetResult('LIvalue.LiDayStatistic')}{else}?{/if}
		  </td>
         </tr>
         
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Visitors per month by 
		  <label style="border-bottom: 1px dashed #333399; cursor: help" title="Live Internet">LI</label></span></td>
	      <td valign="top" align="left" class="param-descr">
	       {if $tool_object->GetResult('LIvalue.LiMonthStatistic')}{$tool_object->GetResult('LIvalue.LiMonthStatistic')}{else}?{/if}
		  </td>
         </tr>         
         
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Site Server</span></td>
	      <td valign="top" align="left" class="param-descr">
	       {if $tool_object->GetResult('pageinfo.server')}{$tool_object->GetResult('pageinfo.server')}{else}?{/if}
		  </td>
         </tr>
         
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Location data center</span></td>
	      <td valign="top" align="left" class="param-descr">
	       {if $tool_object->GetResult('pageinfo.servergeo')}
		    {if $tool_object->FlagExists()}
		     <span style="margin-right: 3px"><img src="{$tool_object->GetFlagName()}" width="22" height="16" align='absmiddle'></span>
		    {/if}		 
		    {$tool_object->GetResult('pageinfo.servergeo')}
		   {else}
		    ?
		   {/if}
		  </td>
         </tr>
         
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Server</span></td>
	      <td valign="top" align="left" class="param-descr">
	       {if $tool_object->GetResult('pageinfo.res_server')}{$tool_object->GetResult('pageinfo.res_server')}{else}?{/if}
		  </td>
         </tr>
         
         <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	      <td valign="top" align="left" class="param-name"><span>Earnings</span></td>
	      <td valign="top" align="left" class="param-descr">
	       <noindex><a href="http://seo-tools.forwebm.net/goto/2" target="_blank" class="gotoregurl">You can make on site more <label style="color: #FF0000">{if $tool_object->GetResult('pageinfo.getmoneyfromb') === false}50{else}{$tool_object->GetResult('pageinfo.getmoneyfromb')}{/if}$</label></a></noindex>
		  </td>
         </tr>		 
		          
         
        </table>
		</span></div>
	   </td>
      </tr>
     </table>
	 </span></div>   
    
	 <div class="analisislabelid"><b>Permanent link to this Page</b></div>
	 <div style="margin-top: 12px; width: 96%">
	  <textarea style="border: none; background: #FFFFFF; width: 96%" readonly="readonly" onclick="this.select()">http://{$smarty.const.W_HOSTMYSITE}/tools/{$tool_object->section_id}/{$tool_object->GetResult('pageinfo.host')}</textarea>
	 </div>
	 
	 <div class="analisislabelid"><b>Key indicators site</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'genblocksource')">Hide</a> ]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="genblocksource">
	 
	 <div><span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	    <td class="sth1" valign="top" align="left" style="padding-bottom: 3px">
		 <div class="typelabel"><label id="red">Y</label>andex CY: <b>{if $tool_object->GetResult('cyvalue.value') !== false}{$tool_object->GetResult('cyvalue.value')}{else}?{/if}</b></div>
		 <div class="typelabel">
		  Gluing domain: {if $tool_object->GetResult('cyvalue.comperewww')}<b style="color: #008000">Yes</b>{else}<b>No</b>{/if}
		 </div> 
		</td>
	    <td class="sth1" valign="top" align="left">
	     <div class="typelabel">
		 With WWW {if $tool_object->GetResult('cyvalue.image_with_www')}<img src="{$tool_object->GetResult('cyvalue.image_with_www')}" width="88" height="31" align='absmiddle'>{else}?{/if}
		 </div>
		</td>
	    <td class="sth1" valign="top" align="left">
	     <div class="typelabel">
		 Without WWW {if $tool_object->GetResult('cyvalue.image_without_www')}<img src="{$tool_object->GetResult('cyvalue.image_without_www')}" width="88" height="31" align='absmiddle'>{else}?{/if}
		 </div>	
		</td>
       </tr>
      </table>
	 </span></div>
	 
	 <div><span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	    <td class="sth1" valign="top" align="left" style="padding-bottom: 3px">
		 <div class="typelabel">
		  <label id="red">Y</label>andex Rang: {if $tool_object->GetResult('cyvalue.rang') !== false}<b>{$tool_object->GetResult('cyvalue.rang')}</b> of <b>6</b><label style="margin-left: 6px"><img src="{$smarty.const.W_SITEPATH}img/items/yrang/y_bar{$tool_object->GetResult('cyvalue.rang')}.png" align='absmiddle'></label>
		 {else}
		  ?
		 {/if}	 
		 </div>		  
		</td>
	    <td class="sth1" valign="top" align="left">
         <div class="typelabel">
		  <label id="red">Y</label>andex.Catalog: {if $tool_object->GetResult('cyvalue.yacacatalog')}
		  {$tool_object->GetResult('cyvalue.yacacatalog')}
		  {else}
		   <i>(not described in catalog)</i>
		  {/if}
		 </div>
		</td>
       </tr>
      </table>
	 </span></div>
	 
	 <div class="typelabel" style="text-align: center; margin: 14px 2px; background: #F9F9F9">
	  <noindex><a href="http://seo-tools.forwebm.net/goto/3" target="_blank" class="gotoregurl">Raise CY recording site in the directories</a></noindex>
	 </div>
	 
	 <div><span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	    <td valign="top" align="left" style="padding-bottom: 3px">
		 <div class="typelabel">
		  <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label> PageRank: {if $tool_object->GetResult('prvalue.value') !== false}
		  <b>{$tool_object->GetResult('prvalue.value')}</b> of <b>10</b>
		  <label style="margin-left: 6px">
		  <img src="{$smarty.const.W_SITEPATH}img/items/pr/pr{$tool_object->GetResult('prvalue.value')}.gif" align='absmiddle'>
		  </label>
		 {else}
		  ?
		 {/if}
		 </div>
		 <div class="typelabel">
		  Alexa Traffic Rank: {if $tool_object->GetResult('alexavalue.value') !== false}
		  <b>{$tool_object->GetResult('alexavalue.value')}</b>		  
		 {else}
		  ?
		 {/if}		 
		 </div>		 		 		  
		</td>
	    <td valign="top" align="left">
	     <div class="typelabel">Alexa Traffic Rank (schedule):</div>
	     <div class="typelabel">
		 {if $tool_object->GetResult('alexavalue.value') !== false}
		  <img src="{$tool_object->GetResult('alexavalue.graph')}">
		 {else}
		  ?
		 {/if}		 
		 </div>
		</td>
	    <td valign="top" align="left">
	     <div class="typelabel">Counter Live Internet:</div>
		 <div class="typelabel">
		 {if $tool_object->GetResult('listatgraph') !== false}
		  <img src="{$tool_object->GetResult('listatgraph')}">
		 {else}
		  ?
		 {/if}
		 </div>	
		</td>
       </tr>
      </table>
	 </span></div>
	  	  
	 </div>
	 
     {* общие данные сайта *}
     <div class="analisislabelid"><b>General site info</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'genblocksource4')">Hide</a> ]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="genblocksource4">      
      {include file="tools/contentcheck/tpl_block-general-sys-items-list.tpl" url_p=$tool_object->GetResult('pageinfo.realhost')}	 	  	  
	 </div>     
     
	 {* история изменения показателей *}
	 {if $tool_object->GetToolLimitInfoEx('enabledphistory')} 
	  {include file="tools/contentcheck/tpl_paramshistory_check_block.tpl" block_ident="histanalisys" chart_width="98%" chart_height="400px"}
	 {/if}
	 
	 {* в топе по ключевым словам *} 
	 {include file="tools/contentcheck/tpl_inenginetopresultblock.tpl" block_ident="inenginetopq"}
     
     {* трафик google *}
     <div class="analisislabelid"><b>Search engine traffic from Google</b><label style="color: #000000; margin-left: 6px">[ <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'traffromgoole')">Скрыть</a> ]</label>
    </div>  
     <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="traffromgoole">    
      <object id="googlerfaphitem" width="700px" height="278px">
      <param name="wmode" value="transparent" />
      <param name="quality" value="high" />
      <param name="bgcolor" value="#ffffff" />
      <param name="allowScriptAccess" value="always" />
      <param name="movie" value="http://www.semrush.com/m/scripts/graph/graph_out.swf" />
      <param name="FlashVars" value="domain={$tool_object->GetResult('pageinfo.realhost')}&type=1&db=ru&w=700&h=278" />
      <embed src="http://www.semrush.com/m/scripts/graph/graph_out.swf" FlashVars="domain={$tool_object->GetResult('pageinfo.realhost')}&type=1&db=ru&w=700&h=278" quality="high" bgcolor="#ffffff" width="700px" height="278px" name="googlerfaphitem" align="middle" play="true" loop="false" quality="high" allowScriptAccess="always"type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer"></embed>
      </object>     
      </div>  
     
     <div class="analisislabelid"><b>Backlink History (Majestic SEO)</b><label style="color: #000000; margin-left: 6px">[ <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'blinksviever')">Скрыть</a> ]</label>
    </div>  
     <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="blinksviever">   
     <img src="http://www.majesticseo.com/charts/backlinks-discovery/{$tool_object->GetResult('pageinfo.realhost')}?w=700&h=270&IndexDataSource=F" border="0" /> 
     </div>   
	 
	 {literal}
	 <style type="text/css">
	  .fv{background:transparent url(http://favicon.yandex.ru/favicon/yandex.ru/www.dmoz.org/www.google.com/mail.ru/aport.ru/rambler.ru/www.bing.com/siteexplorer.search.yahoo.com/yaca.yandex.ru/blogs.yandex.ru/www.yahoo.com/images.yandex.ru/web.archive.org/otvet.mail.ru/www.copyscape.com/validator.w3.org/jigsaw.w3.org/network-tools.com/webo.in) no-repeat 0 0;width:16px;height:16px;display:block;float:left;margin-right:5px;}
	  .labfv { position: relative; top: 1px }
     </style>
	 {/literal}
	 <div class="analisislabelid"><b>The presence of site in directories</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'indirsblocksource')">Hide</a> ]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="indirsblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 0"></label>
		 <label class="labfv"><label id="red">Y</label>andex Catalog:</label>
		 <label style="margin-left: 6px">
		  ({if $tool_object->GetResult('cyvalue.yacacatalog')}<b style="color: #008000">Yes</b>{else}<b>No</b>{/if})
		  </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_InDirYandex')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_InDirYandex')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
	    
	    <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -16px"></label>
		 <label class="labfv"><label style="color: #008000">D</label>MOZ:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_InDirDMOZ')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_InDirDMOZ')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr> 
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -32px"></label>
		 <label class="labfv">
		 <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label> Catalog:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOLE_DIR')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOLE_DIR')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
	    
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -48px"></label>
		 <label class="labfv">Mail.ru:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_InDirMail')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_InDirMail')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>	    
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px" style="border-bottom: none">
	     <label class="fv" style="background-position:0 -62px"></label>
		 <label class="labfv">Aport:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; border-bottom: none"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_InDirAport')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_InDirAport')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
	    
	    <td class="sth1" valign="center" align="left" width="250px" style="border-bottom: none">
	     <label class="fv" style="background-position:0 -80px"></label>
		 <label class="labfv">Rambler Top 100:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; border-bottom: none"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_InDirRamblerTop100')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_InDirRamblerTop100')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>  
	
	  </table>	
	 </span>	  	  
	 </div>
	 
	 <div class="analisislabelid"><b>Indexed Pages</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'indexblocksource')">Hide</a> ]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="indexblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 0"></label>
		 <label class="labfv"><label id="red">Y</label>andex:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_IndexYandex')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_IndexYandex')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
	    
	    <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -32px"></label>
		 <label class="labfv"><label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label>:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_IndexGoogle')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_IndexGoogle')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -96px"></label>
		 <label class="labfv">
		 Bing:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_IndexBing')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_IndexBing')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
	    
	    <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -112px"></label>
		 <label class="labfv">
		 Yahoo:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_IndexYahoo')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_IndexYahoo')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px" style="border-bottom: none">
	     <label class="fv" style="background-position:0 -80px"></label>
		 <label class="labfv">
		 Rambler:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; border-bottom: none"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_IndexRambler')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_IndexRambler')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
	    
	    <td class="sth1" valign="center" align="left" width="250px" style="border-bottom: none">
	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; border-bottom: none"> 
 
	    </td>
       </tr>
       
	  </table>	
	 </span>	  	  
	 </div>
	 
	 
	 <div class="analisislabelid"><b>Links to site from</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'backurlblocksource')">Hide</a> ]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="backurlblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 0"></label>
		 <label class="labfv"><label id="red">Y</label>andex:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_BackYandex')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_BackYandex')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
	    
	    <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -128px"></label>
		 <label class="labfv">
		 Links from <label id="red">Y</label>-Catalog:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'YANDEX_DIR_LINKS')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'YANDEX_DIR_LINKS')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -144px"></label>
		 <label class="labfv">
		 <label id="red">Y</label>andex blogs:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_BackYandexBlogs')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_BackYandexBlogs')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
	    
	    <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -32px"></label>
		 <label class="labfv">
		 <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label>:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_BackGoogle')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_BackGoogle')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -32px"></label>
		 <label class="labfv">
		 <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label> blogs:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOGLE_BLOGS')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOGLE_BLOGS')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
	    
	    <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -160px"></label>
		 <label class="labfv">
		 Yahoo:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_BackYahoo')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_BackYahoo')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -96px"></label>
		 <label class="labfv">
		 Bing:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_BackBing')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_BackBing')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
	    
	    <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -80px"></label>
		 <label class="labfv">
		 Rambler:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_BackRambler')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_BackRambler')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>

       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px" style="border-bottom: none">
	     <label class="fv" style="background-position:0 -176px"></label>
		 <label class="labfv">
		 <label id="red">Y</label>andex Images:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; border-bottom: none"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'YANDEX_IMAGES')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'YANDEX_IMAGES')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
	    
        <td class="sth1" valign="center" align="left" width="250px" style="border-bottom: none">
	     <label class="fv" style="background-position:0 -32px"></label>
		 <label class="labfv">
		  <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label> Images:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; border-bottom: none"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOGLE_IMAGES')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOGLE_IMAGES')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>       
       
	  </table>	
	 </span>	  	  
	 </div>
	 
	 
	 <div class="analisislabelid"><b>More information</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'more1blocksource')">Hide</a> ]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="more1blocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -32px"></label>
		 <label class="labfv">
		 In Google's cache:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOGLE_CACH')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOGLE_CACH')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
	    
	    <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 0"></label>
		 <label class="labfv">
		 In <label id="red">Y</label>andex's cache:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'YANDEX_CACH')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'YANDEX_CACH')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
	   
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -32px"></label>
		 <label class="labfv">
		 Similar sites in Google:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOGLE_RELAETED')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOGLE_RELAETED')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
	    
	    <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -192px"></label>
		 <label class="labfv">
		 History Site:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'SITE_HISTORY')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'SITE_HISTORY')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
	   
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px" style="border-bottom: none">
	     <label class="fv" style="background-position:0 -208px"></label>
		 <label class="labfv">
		 Mention in Answers@Mail.ru:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; border-bottom: none"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'MAIL_ANSWERS')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'MAIL_ANSWERS')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
	    
	    <td class="sth1" valign="center" align="left" width="250px" style="border-bottom: none">
	     <label class="fv" style="background-position:0 -224px"></label>
		 <label class="labfv">
		 Search for plagiarism:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; border-bottom: none"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'PLAGIAT_SEARCH')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'PLAGIAT_SEARCH')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>

	  </table>	
	 </span>	  	  
	 </div>
	 
	 
	 <div class="analisislabelid"><b>Additional Tools</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'more2blocksource')">Hide</a> ]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="more2blocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -240px"></label>
		 <label class="labfv">
		 Checking validity of HTML:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'HTML_VALIDATE')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'HTML_VALIDATE')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
	    
	    <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -256px"></label>
		 <label class="labfv">
		 Checking validity of CSS:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'CSS_VALIDATE')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'CSS_VALIDATE')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px" style="border-bottom: none">
	     <label class="fv" style="background-position:0 -272px"></label>
		 <label class="labfv">
		 Ping\Traceroute\DNS:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; border-bottom: none"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'PING_TRACEROUT')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'PING_TRACEROUT')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
	    
	    <td class="sth1" valign="center" align="left" width="250px" style="border-bottom: none">
	     <label class="fv" style="background-position:0 -288px"></label>
		 <label class="labfv">
		 Page loading speed:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; border-bottom: none"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'PAGE_SPEED_LOAD')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'PAGE_SPEED_LOAD')}" target="_blank">View</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>  

	  </table>	
	 </span>	  	  
	 </div>
	 
	 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Page Data Info</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'more3blocksource')">Hide</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="more3blocksource">
	  
	  <!-- html data -->
	  <div style="margin-top: 14px"><b style="color: #969696">Original content of page</b></div>
      <div style="margin-top: 10px">
       <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('pageinfo.htmldata')}</textarea>
      </div>
      
      <!-- header -->
      <div style="margin-top: 14px"><b style="color: #969696">Response from server</b></div>
      <div style="margin-top: 10px">
       <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('pageinfo.headresponse')}</textarea>
      </div>
      
      <!-- robots.txt -->
      <div style="margin-top: 14px"><b style="color: #969696">File robots.txt</b>, size: <u>
	  {$tool_object->GetResult('headersize')}
	  </u>, check on <noindex><a rel="nofollow" href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'CHECK_ROBOTSTXT_WEBYAND')}" target="_blank">Yandex.Webmaster</a></noindex> </div>
      <div style="margin-top: 10px">
       {if $tool_object->GetResult('pageinfo.robots') === false}
        <div style="margin-left: 5px; color: #FF0000">File <b>robots.txt</b> not found!</div>
       {else}
        <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('pageinfo.robots')}</textarea>
       {/if}
      </div>
	  	  
	 </div>
	 
     
	</div>
   {else}
    <div style="color: #FF0000">No Data</div>
   {/if}   
  {/if}
  </div>
 {else}
  {* блок информации при не выполненом запросе *}
  <div style="margin-top: 26px">
   {include file="tools/tpl_toolhistorylist.tpl"}
  </div> 
 {/if} 
 
 {/if} 
</div>