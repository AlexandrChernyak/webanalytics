{* генератор файлов robots.txt *}
<div style="margin-top: 5px">
 {literal}
 <style type="text/css">
  .td_x { width: 17px; text-align: center }	
 </style>
 {/literal}
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This instrument will help you generate a file <b>robots.txt</b> for your site.
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
 function AddData(str) { var st1 = $('#datares'); st1.val(st1.val()+str+'\n'); st1.focus(); }
 function InsertDisalow(th) {
  if (th.value == '-') {
   var textdata =  prompt("Enter directory on web site!", "/" );
   if (!textdata) { return ; }
   if (textdata == '') { return ; }
   AddData('Disallow: '+textdata);
   return ;	
  }
  AddData('Disallow: '+th.value);	
 }
 function AddHost(th) {
  if (th.value == '') { return ; }
  AddData('Host: '+th.value);	
 }
 var dataurladress = '';
 function InitUrl(th) {
  dataurladress = '';
  var data = th.value;
  if (data == '') { th.focus(); return alert('Enter address of site!'); }
  if (data.slice(0,7) == 'http://') { data = data.substr(7); }
  dataurladress = data;
  th.value = data;
 }
 function AddSiteMap(th) {
  if (dataurladress == '') { return ; }
  if (th.value == '') { return ; }
  AddData('Sitemap: http://'+dataurladress+'/'+th.value);	
 }   	
 </script>
 {/literal}
  
  <div class="typelabel">URL (without http://, only domain)</div>
  <div class="typelabel">
  <input type="text" style="width: 378px" class="inpt" name="urldata" id="urldata" onblur="InitUrl(this)">
  </div>
  
  <div class="typelabel">User-agent:<label style="font-size: 90%; color: #969696">
  <br />Line User-agent determines the robot's search engine. (* value - defines all robots)
  </label></div>
  <div class="typelabel">
  <select size="1" style="width: 380px" onchange="AddData('User-agent: '+this.value)">
  <option value=''></option>
  <option value='*'>Any search engine</option>
  <option value='Yandex'>Yandex</option>
  <option value='Googlebot'>Google</option>
  <option value='Slurp'>MSN</option>
  <option value='StackRambler'>Rambler</option>
  <option value='Scooter'>AltaVista</option>
 </select></div>
 
 <div class="typelabel">Disallow:<label style="font-size: 90%; color: #969696">
 <br />Determines page be indexed search engines. (when specifying the directory - do not for indexing all contents of the directory - example Disallow: /images - prevents indexer fully catalog /images). In each group, string User-agent must be at least one design Disallow. Directive Allow: only understands Yandex - example: Allow: /data. All paths to directories or files are written to the site root.
 </label></div>
 <div class="typelabel">
 <select size="1" style="width: 380px" onchange="InsertDisalow(this)">
  <option value=''>Use All</option>
  <option value='/'>Deny All</option>
  <option value='/cgi-bin'>/cgi-bin</option>
  <option value='/css'>/css</option>
  <option value='/js'>/js</option>
  <option value='/images'>/images</option>
  <option value='/img'>/img</option>
  <option value='-' style="color: #0000FF">Insert your listing</option>
  <option value='/'>Write your directory</option>
 </select></div>

 <div class="typelabel">Host:<label style="font-size: 90%; color: #969696">
 <br />Directive Host: indicates the mirror of your site. Site address should be specified without protocol - example: www.site.ru - true, http://www.site.ru - not true.
 </label></div>
 <div class="typelabel"><input type="text" class="inpt" id="hostdata" style="width: 378px" onblur="AddHost(this)"></div>
 
 <div class="typelabel">SiteMap:<label style="font-size: 90%; color: #969696">
 <br />Directive Sitemap: indicates the location of the file cards on your site. The directive specifies a separate XML or gz file or to the index SiteMap file. SiteMap file can be formatted as .XML, and in .GZ (archival copy of the file SiteMap).</label></div>
 <div class="typelabel"><input type="text" class="inpt" value="sitemap.xml" id="sm" style="width: 378px" onblur="AddSiteMap(this)"></div>

 <div class="typelabel" style="font-size: 90%; margin-top: 5px">
 <a href="javascript:" onclick="AddData('# ')">Insert Comment</a>&nbsp;|&nbsp;
 <a href="javascript:" onclick="AddData(' ')">Insert empty line</a>
 </div>
 
 <div class="typelabel" style="margin-top: 25px"> Result, contents of robots.txt file &nbsp;
 <label style="font-size: 90%">[<a href="javascript:" onclick="$('#datares').select();">select</a>]</label></div>
 <div class="typelabel">
 <textarea class="int_text" style="height: 200px; width: 96%" name="datares" id="datares"></textarea>
 </div>
 
 {/if}
</div>