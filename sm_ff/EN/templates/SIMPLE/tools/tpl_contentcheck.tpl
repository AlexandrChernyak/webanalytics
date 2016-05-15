{* анализ контента сайта *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool will help you to perform analysis of the content of this site (pages).<br /><br />
 To successfully promote your site, you must have relevant content and an optimal keyword density. With this service you will be able to perform the most comprehensive analysis of the content of your site.<br />
When performing the analysis will be analyzed by the content of your site to: page weight, relevancy, the density of the header (title), keywords (keywords) to text pages; speed, page load time and analyze the text pages are processed stopwords, the percentage of occurrences of words with text pages; calculated frequency (TF) of the terms page content.
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
 <script type="text/javascript">
  function DoSetDefUrl(ident) {
   var str = {/literal}'{$smarty.const.W_HOSTMYSITE}';{literal}
   var obj = $('#'+ident);
   obj.val(str); 
   obj.focus();  	
  }//DoSetDefUrl
  function PrepereToSend(th) {
   if (trim(th.url.value) == '') {
	alert('Укажите URL!');
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
  <div class="typelabel"><label id="red">*</label> URL<label class="prep_label_analisys">(example: <a href="javascript:" onclick="DoSetDefUrl('url')">{$smarty.const.W_HOSTMYSITE}</a>)</label></div>
  <div class="typelabel">  
   <input type="text" value="{$CONTROL_OBJ->GetPostElement('url', 'doactiontool')}" style="width: 98%" class="inpt" name="url" id="url">
   
   <div class="typelabel">Delimiter keywords (Keywords)</div>
   <div class="typelabel">
	 <select size="1" name="separatorkeywords" id="separatorkeywords" style="width: 200px">
	  <option>Comma</option>
	  <option value="1"{if $smarty.post.separatorkeywords == '1'} selected="selected"{/if}>Space</option>
     </select>   
   </div>
   
   <div class="typelabel">
    <input type="submit" value="&nbsp;Send&nbsp;" class="button" name="rb" id="rb">
   </div> 
  </div>
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
     <div><b>General information about page</b></div>
	 <div style="margin-top: 12px">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
	  
	  {if $tool_object->GetResult('cachlastupdatedate')}
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px" style="color: #333399">
	    Last update:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px; color: #333399"> 
	    {$CONTROL_OBJ->GetLastIntervalInDays($tool_object->GetResult('cachlastupdatedate'))} &nbsp;
	    ({$tool_object->GetResult('cachlastupdatedate')})
        
         {if $tool_object->NextUpdateDate()}
         <label style="margin-left: 5px; font-size: 95%; color: #000000">
         (for updates - sign up, next update after: {$tool_object->NextUpdateDate()})
         </label>
         {/if}
                 
	   </td>
      </tr>
      {/if}
	  	  
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    URL:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    <noindex><a rel="nofollow" href="{$tool_object->GetResult('pageinfo.linkcheck')}" target="_blank">{$tool_object->CorrectURLLink($tool_object->GetResult('pageinfo.linknorot'), 50)}</a></noindex>
		<label style="margin-left: 8px">(<a style="font-size: 95%; color: #808080" href="{$smarty.const.W_SITEPATH}tools/whoisurlip/{$tool_object->GetResult('pageinfo.linknorot')}" target="_blank">WHOIS IP</a>, <a style="font-size: 95%; color: #808080" href="{$smarty.const.W_SITEPATH}tools/whoisdomain/{$tool_object->GetResult('pageinfo.linknorot')}" target="_blank">WHOIS DOMAIN</a>)</label>	    
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Page Size:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    {$tool_object->GetResult('pageinfo.size')}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Encoding:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    {if $tool_object->GetResult('pageinfo.encode')}
		 {$tool_object->GetResult('pageinfo.encode')}
		{else}
		 ?
		{/if}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    IP site:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    {if $tool_object->GetResult('pageinfo.ip')}
		 {$tool_object->GetResult('pageinfo.ip')}
		{else}
		 ?
		{/if}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Download speed:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    {if $tool_object->GetResult('pageinfo.speed')}
		 {$tool_object->GetResult('pageinfo.speed')}
		{else}
		 ?
		{/if}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Download Time:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    {if $tool_object->GetResult('pageinfo.time')}
		 {$tool_object->GetResult('pageinfo.time')} sec
		{else}
		 ?
		{/if}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Total characters (with html tags):	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		{$tool_object->GetResult('pageinfo.charscount')}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Total characters (text):	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		{$tool_object->GetResult('pageinfo.textcount')}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Total characters (text with no spaces):	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		{$tool_object->GetResult('pageinfo.nospcount')}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    The share of content to entire code page:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		{$tool_object->GetResult('pageinfo.compereto')} %
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Redirecting:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		{if $tool_object->GetResult('pageinfo.redirectto')}
		 <noindex><a rel="nofollow" href="{$tool_object->GetResult('pageinfo.redirectto')}" target="_blank">{$tool_object->CorrectURLLink($tool_object->GetResult('pageinfo.redirectto'), 100)}</a></noindex>		 
		{else}
		 <i>(no)</i>
		{/if} 
	   </td>
      </tr>
	  
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Internal / external links:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<noindex><a rel="nofollow" href="{$smarty.const.W_SITEPATH}tools/checkurllinks/{$tool_object->GetResult('pageinfo.linknorot')}" target="_blank">Analysis</a></noindex>
	   </td>
      </tr>      
	
	  </table>	
	 </span>	 
	 </div> 
    
	 <div class="analisislabelid"><b>Permanent link to this Page</b></div>
	 <div style="margin-top: 12px; width: 96%">
	  <textarea style="border: none; background: #FFFFFF; width: 96%" readonly="readonly" onclick="this.select()">http://{$smarty.const.W_HOSTMYSITE}/tools/contentcheck/{$tool_object->GetResult('pageinfo.host')}</textarea>
	 </div>   
     
     <div class="analisislabelid"><b>General site info</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'genblocksource4')">Hide</a> ]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="genblocksource4">    
      {include file="tools/contentcheck/tpl_block-general-sys-items-list.tpl" url_p=$tool_object->GetResult('pageinfo.host')}	 	  	  
	 </div>
	 
	 <div class="analisislabelid"><b>Page Title (title)</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'titleblocksource')">Hide</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="titleblocksource">
	  {if !$tool_object->GetResult('titleinfo')}
	   <div style="margin-left: 4px; color: #FF0000">Tag &lt;title&gt; can not be found on page!</div>
	  {else}
	   {include file="tools/contentcheck/tpl_taganalisysresultblock.tpl" block_ident="titleinfo"}	   
	  {/if}
	 </div>
	 
	 <noindex>
	 <div class="analisislabelid"><b>Page Keywords (keywords)</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'keywordsblocksource')">Hide</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="keywordsblocksource">
	  {if !$tool_object->GetResult('keywordsinfo')}
	   <div style="margin-left: 4px; color: #FF0000">Keywords not found on page!</div>
	  {else}
	   {include file="tools/contentcheck/tpl_taganalisysresultblock.tpl" block_ident="keywordsinfo"}	   
	  {/if}
	 </div>
	 
	 <div class="analisislabelid"><b>Page Description (description)</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'descriptionblocksource')">Hide</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="descriptionblocksource">
	  {if !$tool_object->GetResult('descriptioninfo')}
	   <div style="margin-left: 4px; color: #FF0000">Description not found on page!</div>
	  {else}
	   {include file="tools/contentcheck/tpl_taganalisysresultblock.tpl" block_ident="descriptioninfo"}	   
	  {/if}
	 </div>
	 
	 <div class="analisislabelid"><b>Tags h1 - h6</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'h1h6blocksource')">Hide</a>]</label>
	 </div>	  
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="h1h6blocksource">
	  {if !$tool_object->CheckForExists('h1info,h2info,h3info,h4info,h5info,h6info')}
	   <div style="margin-left: 4px; color: #FF0000">Tags from <b>h1</b> to <b>h6</b> not found!</div>
	  {else}	  
	   {if $tool_object->GetResult('h1info')}
	    <div style="margin-top: 10px"><b style="color: #969696">Tag <b>h1</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         {$tool_object->GetResult('h1info.data')}
        </div>
	   {/if}
	  
	   {if $tool_object->GetResult('h2info')}
	    <div style="margin-top: 10px"><b style="color: #969696">Tag <b>h2</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         {$tool_object->GetResult('h2info.data')}
        </div>
	   {/if}
	  
	   {if $tool_object->GetResult('h3info')}
	    <div style="margin-top: 10px"><b style="color: #969696">Tag <b>h3</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         {$tool_object->GetResult('h3info.data')}
        </div>
	   {/if}
	  
	   {if $tool_object->GetResult('h4info')}
	    <div style="margin-top: 10px"><b style="color: #969696">Tag <b>h4</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         {$tool_object->GetResult('h4info.data')}
        </div>
	   {/if}
	  
	   {if $tool_object->GetResult('h5info')}
	    <div style="margin-top: 10px"><b style="color: #969696">Tag <b>h5</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         {$tool_object->GetResult('h5info.data')}
        </div>
	   {/if}
	  
	   {if $tool_object->GetResult('h6info')}
	    <div style="margin-top: 10px"><b style="color: #969696">Tag <b>h6</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         {$tool_object->GetResult('h6info.data')}
        </div>
	   {/if}
	   
	  {/if}
	 </div>
	 
	 <div class="analisislabelid"><b>Content page</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'contentblocksource')">Hide</a>]</label>
	 </div>	  
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="contentblocksource">
	  {if !$tool_object->GetResult('contentinfo')}
	   <div style="margin-left: 4px; color: #FF0000">Unable to retrieve page content!</div>
	  {else}
	   {include file="tools/contentcheck/tpl_taganalisysresultblock.tpl" block_ident="contentinfo" iscontent_info="1"}	   
	  {/if}	 
	 </div>
	 </noindex>
     
	</div>
   {else}
    <div style="color: #FF0000">No Data</div>
   {/if}   
  {/if}
  </div>
 {else}
  {* блок информации при не выполненом запросе *}
  <div style="margin-top: 26px">
   {include file="tools/tpl_toolhistorylist.tpl" noindexlinks="1"}
  </div> 
 {/if} 
 
 {/if}
</div>