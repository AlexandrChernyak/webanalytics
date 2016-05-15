{* генератор мета тэгов *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 This tool will help you to generate meta tags for your site.
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
 var datas = new Array();
 datas['titled'] = '<title>';
 datas['titled_1'] = '</title>'; 
 datas['keyd'] = '<meta name="keywords" content="';
 datas['keyd_1'] = '"/>'; 
 datas['descrd'] = '<meta name="description" content="';
 datas['descrd_1'] = '"/>'; 
 datas['maild'] = '<meta name="owner" content="';
 datas['maild_1'] = '"/>'; 
 datas['named'] = '<meta name="author" lang="ru" content="';
 datas['named_1'] = '"/>';
 datas['charsetd'] = '<meta http-equiv="content-type" content="text/html; charset=';
 datas['charsetd_1'] = '"/>'; 
 datas['docedtyped'] = '<meta name="resource-type" content="';
 datas['docedtyped_1'] = '"/>'; 
 datas['languaged'] = '<meta http-equiv="content-language" content="'
 datas['languaged_1'] = '"/>';
 datas['robotsd'] = '<meta name="robots" content="';
 datas['robotsd_1'] = '"/>'; 
 datas['copyright'] = '<meta name="copyright" content="';
 datas['copyright_1'] = '"/>';
 datas['expiresd'] = '<meta http-equiv="expires" content="';
 datas['expiresd_1'] = '"/>';
 datas['pragmad'] = '<meta http-equiv="pragma" content="';
 datas['pragmad_1'] = '"/>'; 
 datas['revisitd'] = '<meta name="revisit" content="';
 datas['revisitd_1'] = '"/>'; 
 datas['URLd'] = '<meta name="url" content="';
 datas['URLd_1'] = '"/>';
 datas['wintarge'] = '<meta http-equiv="window-target" content="';
 datas['wintarge_1'] = '"/>';
 datas['shortcutd'] = '<link rel="shortcut icon" href="';
 datas['shortcutd_1'] = '" type="image/x-icon">';
  
 var p_list = ['titled','keyd','descrd','maild','named','charsetd','docedtyped','robotsd','languaged','copyright','expiresd','pragmad','revisitd',
 'URLd','wintarge','shortcutd']; 
 
 function Processgenerate() { 	
  var str = '';
  var seted = 0;
  var start = '';
  var end = '';  
  var obj;   
  for (var i=0; i < p_list.length; i++) {  	
   start = datas[p_list[i]];  
   end   = datas[p_list[i]+'_1'];	
   if ((!start) || (!end)) { continue; }
   obj = document.getElementById(p_list[i]);
   if (!obj) { continue; }
   if (obj.value == '') { continue; }
   seted = 1;
   str = str + start + obj.value + end + '\n';  
  }//i	
  obj = document.getElementById('withhead');
  if (obj.checked) {
   str = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">\n<head>\n' + str;
   str = str + '</head>\n';	
  }
  if ((!seted) || (str == '')) { str = ''; }
  $('#datares').val(str);    	
 }
 function ShowMoreT(th) {
  if (th.checked) { $('#moretagsdata').css('display','block'); } else { $('#moretagsdata').css('display','none'); }
  Processgenerate();	
 }   	
 </script>
 {/literal}  
  
<div class="typelabel">Title page (Title)</div>
<div class="typelabel"><input type="text" class="inpt" value="" id="titled" style="width: 380px" onblur="Processgenerate()"></div>
<div class="typelabel">Keywords (Keywords) [by comma]</div>
<div class="typelabel"><input type="text" class="inpt" value="" id="keyd" style="width: 380px" onblur="Processgenerate()"></div>
<div class="typelabel">Page Description (description)</div>
<div class="typelabel"><input type="text" class="inpt" value="" id="descrd" style="width: 380px" onblur="Processgenerate()"></div>
<div class="typelabel">Email the owner (Owner)</div>
<div class="typelabel"><input type="text" class="inpt" value="" id="maild" style="width: 380px" onblur="Processgenerate()"></div>
<div class="typelabel">Author name (Author)</div>
<div class="typelabel"><input type="text" class="inpt" value="" id="named" style="width: 380px" onblur="Processgenerate()"></div>
<div class="typelabel">Encoding (Charset)</div>
<div class="typelabel">
<select size="1" style="width: 384px" id="charsetd" onchange="Processgenerate()">
 <option>windows-1251</option>
 <option selected="selected">UTF-8</option>
 <option>UTF-16</option>
 <option>KOI8-R</option>
 <option>ISO-8859-1</option>
 <option>ISO-8859-2</option>
 <option>ISO-8859-3</option>
 <option>ISO-8859-4</option>
 <option>ISO-8859-5</option>
 <option>ISO-8859-6</option>
 <option>ISO-8859-7</option>
 <option>ISO-8859-8</option>
 <option>ISO-8859-9</option>
 <option>ISO-2022-JP</option>
 <option>ISO-2022-JP-2</option>
 <option>ISO-2022-KR</option>
 <option>SHIFT_JIS</option>
 <option>EUC-KR</option>
 <option>BIG5</option>
 <option>KSC_5601</option>
 <option>HZ-GB-2312</option>
 <option>JIS_X0208</option>
 <option>GB2312</option>
 <option>US-ASCII</option>
</select>
</div>
<div class="typelabel">Document type (Object Type)</div>
<div class="typelabel">
<select size="1" style="width: 384px" id="docedtyped" onchange="Processgenerate()">
 <option value="" selected>Omit</option>
 <option>Document</option>
 <option>Homepage</option>
 <option>World</option>
 <option>RealWorld</option>
 <option>FAQ</option>
 <option>RFC</option>
 <option>Magazine</option>
 <option>Mall</option>
 <option>Dictionary</option>
 <option>Archive</option>
 <option>SearchEngine</option>
 <option>Hypercatalog</option>
 <option>Keybank</option>
 <option>Manual</option>
 <option>Index</option>
 <option>Book</option>
 <option>Database</option>
 <option>Journal</option>
 <option>Catalog</option>
 <option>Linecard</option>
 <option>Howto</option>
</select>
</div> 
<div class="typelabel">Site Language (Language)</div>
<div class="typelabel">
<select size="1" style="width: 384px" id="languaged" onchange="Processgenerate()">
 <option value="" selected>Omit</option>
 <option value="ru">Russian</option>
 <option value="en">English</option>
 <option value="en-US">English - US</option>
 <option value="en-GB">English - GB</option>
 <option value="fr">French</option>
 <option value="de">German</option> 
 <option value="zh">Chinese</option> 
 <option value="es">Spanish</option> 
 <option value="it">Italian</option>  
 <option value="jp">Japanese</option> 
</select>
</div>
<div class="typelabel">Accessibility for robots (robots)</div>
<div class="typelabel">
<select size="1" style="width: 384px" id="robotsd" onchange="Processgenerate()">
 <option value="" selected>Omit</option>
 <option value="nofollow">Do not pass on the links for indexing (nofollow)</option>
 <option value="noindex">Not indexed (noindex)</option>
 <option value="noindex,nofollow">Do not pass on the links and do not index (noindex,nofollow)</option>
 <option value="index">Index Page (index)</option>
 <option value="follow">Follow the links (follow)</option>
 <option value="index,follow">Index and follow links (index,follow)</option>
</select>
</div>
<div class="typelabel" style="margin: 4px 0 4px 0"><input type="checkbox" checked="checked" id="withhead" style="cursor: pointer" 
onclick="Processgenerate()">&nbsp;<label for="withhead" style="cursor: pointer">Create all tags in section &lt;head&gt;</label></div>

<div class="typelabel" style="margin: 4px 0 4px 0"><input type="checkbox" id="moretag" style="cursor: pointer" 
onclick="ShowMoreT(this)">&nbsp;<label for="moretag" style="cursor: pointer">More tags</label></div>
<div id="moretagsdata" style="display: none; padding-left: 6px">
 <div class="typelabel">Meta tag author entry (Copyright)</div>
 <div class="typelabel"><input type="text" class="inpt" value="" id="copyright" style="width: 380px" onblur="Processgenerate()"></div>
 <div class="typelabel">Date of last revision of the document (Expires) [example: Wed, 26 Feb 1999 08:21:57 GMT]</div>
 <div class="typelabel"><input type="text" class="inpt" value="" id="expiresd" style="width: 380px" onblur="Processgenerate()"></div>
 <div class="typelabel">Control caching document (Pragma) [example: no-cache]</div>
 <div class="typelabel"><input type="text" class="inpt" value="" id="pragmad" style="width: 380px" onblur="Processgenerate()"></div>
 <div class="typelabel">Frequency of document indexing robot (Revisit) (in days) [example: 7 = 1 once a week]</div>
 <div class="typelabel"><input type="text" class="inpt" value="" id="revisitd" style="width: 380px" onblur="Processgenerate()"></div>
 <div class="typelabel">Primary mirror of document (URL) [example: "http://www.site.ru/]</div>
 <div class="typelabel"><input type="text" class="inpt" value="" id="URLd" style="width: 380px" onblur="Processgenerate()"></div>
 <div class="typelabel">Window of the current page by default (Window-target) [example: main]</div>
 <div class="typelabel"><input type="text" class="inpt" value="" id="wintarge" style="width: 380px" onblur="Processgenerate()"></div>
 <div class="typelabel">Icon Site (shortcut icon) [example: /favicon.ico]</div>
 <div class="typelabel"><input type="text" class="inpt" value="" id="shortcutd" style="width: 380px" onblur="Processgenerate()"></div>
</div>

<div class="typelabel" style="margin-top: 15px"><b>The result of generation tags</b><label style="margin-left: 6px; font-size: 90%">[<a href="javascript:" onclick="$('#datares').select();">select</a>]</label></div>
<div class="typelabel">
<textarea class="int_text" style="width: 96%; height: 160px" id="datares" readonly></textarea>
</div>  
 
 {/if}
</div>