{* 
 $url_p - url
 
 вывод блока общих данных о странице\сайте
*}{if !$tool_object->IsAjax()}
{literal}
 <script type="text/javascript">
  var globalpatht = '{/literal}{$smarty.const.W_SITEPATH}{literal}';
  var toolpathitr = globalpatht + 'tools/{/literal}{$tool_object->section_id}{literal}/';
  var url_p = '{/literal}{$url_p}{literal}'; 
  var d_updates = '{/literal}{if $tool_object->IsUpdateResults()}1{else}0{/if}{literal}';
 
  function PrepereResultXML(data) { $('#gen-sys-info-block-data').html(data); }   
    
  $(document).ready(function() {
	 $('#gen-sys-info-block-data').html(
	  '<div class="typelabel">Data preparation..</div>' +
      '<div class="typelabel"><img src="'+globalpatht+'athemes/SIMPLE/img/ajax-loader.gif" border="0"></div>'
	 );	 
     SendDefaultRequest(toolpathitr, 'is_ajax_mode=1&spparams3=1&url='+url_p+'&dp='+d_updates, 'PrepereResultXML');	  
  });
      
 </script>
{/literal}

<div id="gen-sys-info-block-data">
  JavaScript is disabled!
</div>

{else}

 {* all data result of ajax action here  *}
 {if !$tool_object->GetResult('gensys1') && !$tool_object->GetResult('gensys2') && !$tool_object->GetResult('gensys3')}
 <div style="color: #FF0000">No data to display! Check availability of a block or source!</div>
 {else}
 
  {if $tool_object->GetResult('gensys1')}   
    <div><strong>General information site performance ( <ins style="font-weight: normal">{$tool_object->GetResult('gensys1.host')}</ins> )</strong> (from solomono){if $tool_object->GetResult('gensys1.cacheddate')}<label style="margin-left: 6px; font-size: 85%">[last update: {$CONTROL_OBJ->GetLastIntervalInDays($tool_object->GetResult('gensys1.cacheddate'))} &nbsp; ({$tool_object->GetResult('gensys1.cacheddate')})]</label>{/if}</div>
    <div style="margin-top: 6px">
    
    <div><span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	    
        <td class="sth1" valign="top" align="left" style="padding-bottom: 3px">
		 <div class="typelabel">
         
		  <div class="typelabel">Total mirrors domain: <strong>{$tool_object->GetResult('gensys1.mr')}</strong></div>	
          <div class="typelabel">Number of domains on the same IP: <strong>{$tool_object->GetResult('gensys1.ip')}</strong></div>
          <div class="typelabel">Number of domains, which referenced the site: <strong>{$tool_object->GetResult('gensys1.dout')}</strong></div>
          <div class="typelabel">Number of anchor: <strong>{$tool_object->GetResult('gensys1.anchors')}</strong></div>
          <div class="typelabel">Number of outgoing anchor: <strong>{$tool_object->GetResult('gensys1.anchors_out')}</strong></div>  
          
          <div class="typelabel">Number of donors iGood: <strong>{$tool_object->GetResult('gensys1.igood')}</strong></div>
          
		 </div>		  
		</td>
        
	    <td class="sth1" valign="top" align="left">
         <div class="typelabel">
		  
          <div class="typelabel">Number of references on domain: <strong>{$tool_object->GetResult('gensys1.hin')}</strong></div>
          {if $tool_object->GetResult('gensys1.hin-list2w')}
           <div style="padding-left: 4px; font-size: 95%">&rsaquo;&rsaquo; The level of nesting:  
           {foreach from=$tool_object->GetResult('gensys1.hin-list2w') key=uvname item=val name=val}
            <label>
            {if $smarty.foreach.val.index > 0}, {/if}Lv{$uvname}: <strong>{$val}</strong>
            </label>           
           {/foreach}           
           </div>
          {/if}                  
          
          <div class="typelabel">Number of donors: <strong>{$tool_object->GetResult('gensys1.din')}</strong></div>
          {if $tool_object->GetResult('gensys1.din-list2w')}
           <div style="padding-left: 4px; font-size: 95%">&rsaquo;&rsaquo; The level of nesting:  
           {foreach from=$tool_object->GetResult('gensys1.din-list2w') key=uvname item=val name=val}
            <label>
            {if $smarty.foreach.val.index > 0}, {/if}Lv{$uvname}: <strong>{$val}</strong>
            </label>           
           {/foreach}           
           </div>
          {/if}
                    
          <div class="typelabel">Outbound (external) reference domain: <strong>{$tool_object->GetResult('gensys1.hout')}</strong></div>
          {if $tool_object->GetResult('gensys1.hout-list2w')}
           <div style="padding-left: 4px; font-size: 95%">&rsaquo;&rsaquo; The level of nesting:  
           {foreach from=$tool_object->GetResult('gensys1.hout-list2w') key=uvname item=val name=val}
            <label>
            {if $smarty.foreach.val.index > 0}, {/if}Lv{$uvname}: <strong>{$val}</strong>
            </label>           
           {/foreach}           
           </div>
          {/if}          
          
          
		 </div>
		</td>
        
       </tr>
      </table>
	 </span></div>
    
    </div>   
  {/if}
  
  {if $tool_object->GetResult('gensys3')}
    <div{if $tool_object->GetResult('gensys1')} style="margin-top: 15px"{/if}><strong>General information site performance ( <ins style="font-weight: normal">{$tool_object->GetResult('gensys3.Item')}</ins> )</strong> (from majesticseo){if $tool_object->GetResult('gensys3.cacheddate')}<label style="margin-left: 6px; font-size: 85%">[last update: {$CONTROL_OBJ->GetLastIntervalInDays($tool_object->GetResult('gensys3.cacheddate'))} &nbsp; ({$tool_object->GetResult('gensys3.cacheddate')})]</label>{/if}</div>
    <div style="margin-top: 6px">
    
    <div><span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	    
        <td class="sth1" valign="top" align="left" style="padding-bottom: 3px">
		 <div class="typelabel">
         
		  <div class="typelabel">Number of backlinks: <strong>{$tool_object->GetResult('gensys3.ExtBackLinks')}</strong></div>
          
          <div class="typelabel">The number of referring domains: <strong>{$tool_object->GetResult('gensys3.RefDomains')}</strong></div>  
          
          <div class="typelabel">Refers to IP addresses: <strong>{$tool_object->GetResult('gensys3.RefIPs')}</strong></div>
          
		 </div>		  
		</td>
        
	    <td class="sth1" valign="top" align="left">
         <div class="typelabel">
		  
          <div class="typelabel">Indexed majesticseo: <strong>{$tool_object->GetResult('gensys3.IndexedURLs')}</strong></div>
              
          <div class="typelabel">Subnets: <strong>{$tool_object->GetResult('gensys3.RefSubNets')}</strong></div>         
                       
		 </div>
		</td>
        
       </tr>
      </table>
	 </span></div>
    
    </div>     
  {/if}
  
  {if $tool_object->GetResult('gensys2')}
    <div{if $tool_object->GetResult('gensys1') || $tool_object->GetResult('gensys3')} style="margin-top: 15px"{/if}><strong>General statistics of page</strong>{if $tool_object->GetResult('gensys2.cacheddate')}<label style="margin-left: 6px; font-size: 85%">[last update: {$CONTROL_OBJ->GetLastIntervalInDays($tool_object->GetResult('gensys2.cacheddate'))} &nbsp; ({$tool_object->GetResult('gensys2.cacheddate')})]</label>{/if}</div>
    <div style="margin-top: 6px">
    
    <div><span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	    
        <td class="sth1" valign="top" align="left" style="padding-bottom: 3px">
		 <div class="typelabel">
         
		  <div class="typelabel">Total percentage of page loading speed: <strong style="color: #008000">{$tool_object->GetResult('gensys2.score')}%</strong></div>
          
          <div class="typelabel">Page connects resources: <strong>{$tool_object->GetResult('gensys2.numberResources')}</strong>, hosts: <strong>{$tool_object->GetResult('gensys2.numberHosts')}</strong></div>
          
          <div class="typelabel">The total size of query: <strong>{$CONTROL_OBJ->GetStrSizeFromBytes($tool_object->GetResult('gensys2.totalRequestBytes'))}</strong></div>
          	
          <div class="typelabel">The size of page html code: <strong>{$CONTROL_OBJ->GetStrSizeFromBytes($tool_object->GetResult('gensys2.htmlResponseBytes'))}</strong></div>
          
          <div class="typelabel">The total size of images on page: <strong>{$CONTROL_OBJ->GetStrSizeFromBytes($tool_object->GetResult('gensys2.imageResponseBytes'))}</strong></div>         
          
          
		 </div>		  
		</td>
        
	    <td class="sth1" valign="top" align="left">
         <div class="typelabel">
		  
          <div class="typelabel">Total CSS files attached: <strong>{$tool_object->GetResult('gensys2.numberCssResources')}</strong>, overall size of: <strong>{$CONTROL_OBJ->GetStrSizeFromBytes($tool_object->GetResult('gensys2.cssResponseBytes'))}</strong></div>
          
          <div class="typelabel">Total JavaScript files attached: <strong>{$tool_object->GetResult('gensys2.numberJsResources')}</strong>, overall size of: <strong>{$CONTROL_OBJ->GetStrSizeFromBytes($tool_object->GetResult('gensys2.javascriptResponseBytes'))}</strong></div>
          
          <div class="typelabel">The size of other resources: <strong>{$CONTROL_OBJ->GetStrSizeFromBytes($tool_object->GetResult('gensys2.otherResponseBytes'))}</strong></div>          
                      
		 </div>
		</td>
        
       </tr>
      </table>
	 </span></div>
    
    </div>     
  {/if}
 
 {/if}

{/if}