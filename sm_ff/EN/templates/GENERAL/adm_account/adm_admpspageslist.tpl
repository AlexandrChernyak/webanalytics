{* управление отдельными страницами проекта *}

{if $smarty.get.group}
 {* управление страницами *}

 <div style="margin: 7px 1px 12px 1px">
 <a href="{$smarty.const.W_SITEPATH}account/admpspageslist/?new=1&group={$smarty.get.group}{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}{if $smarty.get.grouppage}&grouppage={$smarty.get.grouppage}{/if}"{if $smarty.get.new && !$adm_object->GetResult('modifyinfo')} style="color: #000000"{/if}>Add Page</a> | <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admpspageslist/?group={$smarty.get.group}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}{if $smarty.get.grouppage}&grouppage={$smarty.get.grouppage}{/if}">All Pages (<label style="color: #000000">{$adm_object->GetResult('pcount')}</label>)</a> 
 
 <label style="padding-left: 10px"><a href="{$smarty.const.W_SITEPATH}account/admpspageslist/{if $smarty.get.grouppage}?page={$smarty.get.grouppage}{/if}"> << Return to Groups (<label style="color: #000000">{$adm_object->GetResult('gcount')}</label>)</a></label>  
 </div>
  
 {if !$smarty.get.new}
  {* список страниц *}
  
{literal}
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = {/literal}{if !$adm_object->GetResult('pcount')}0{else}1{/if};{literal}  
 function DoHigl(th, n, p) {	
  if (n) {	$(th).css('background','#F8F5F1'); } else {
   var ch = document.getElementById('chid'+p);
   var color = (ch && ch.checked) ? '#E7DDD1' : 'none';   	
   $(th).css('background', color);		
  }	
 }//DoHigl
 function CheckItem(itemid, th) {
  th = (th) ? th : document.getElementById('chid'+itemid);   
  if (th && th.checked) { $('#t_r_'+itemid).css('background','#E7DDD1'); } else {
  $('#t_r_'+itemid).css('background','none');
  }
  SetEnabled();   	
 }//CheckItem
 function CheckAll(th) {	
  for (var i=0; i < list_items.length; i++) {
   var ch = $('#chid'+list_items[i]);
   ch.attr('checked', (th.checked) ? 'checked' : '');
   if (th.checked) { $('#t_r_'+list_items[i]).css('background','#E7DDD1'); } else {
   $('#t_r_'+list_items[i]).css('background','none');	
  }	  	    	
  }
  SetEnabled();	
 }//CheckAll
 function GetSelCount() {
  var inccount = 0;
  for (var i=0; i < list_items.length; i++) {
   var ch = document.getElementById('chid'+list_items[i]);
   if (ch && ch.checked) { inccount++; }		
  }	
  return inccount;	
 }//GetSelCount 
 function PrepereSend(th) {
  var count = GetSelCount();
  if (count <= 0 && th.actionlistmakes.value != 'all' && th.actionlistmakes.value != 'dall') { 
   alert('Select at least one page!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == 'delete') {
   if (!confirm('Are you sure you want to delete ['+count+'] pages?')) { return false; }
  } else 
  if (th.actionlistmakes.value == 'dall') {
   if (!allsaveenabled) { alert('No data to remove!'); return false; }	
   if (!confirm('Are you sure you want to delete all pages?')) { return false; }	
  }
  else { alert('Unknown ID operation!'); return false; }
  return true;   	
 }//PrepereSend
 function SetEnabled() {  	
  var count = GetSelCount();
  setElementOpacity(document.getElementById('adid'), (allsaveenabled) ? 1 : 0.3);
  if (count <= 0) {
   setElementOpacity(document.getElementById('did'), 0.3);
   return ;	 
  }
  setElementOpacity(document.getElementById('did'), 1);
 }//SetEnabled
 function SetActionP(a) {
  var f = document.getElementById('vnewsform');
  if (!f) { return ; }
  f.actionlistmakes.value = a;   	
 }//SetActionP   	
 function SetCheckByLine(ident) {
  var ch = $('#chid'+ident);
  ch.attr('checked', (ch.attr('checked')) ? false : true);
  CheckItem(ident);   	
 }//SetCheckByLine
</script>
<style type="text/css">
  .h_th1, .h_td, .h_td2 { 
   border: 1px solid #E4D9CB; background: #EEE7DF; height: 25px; border-bottom: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E4D9CB; border-left: none; }
  .btn_n { border: 1px solid #E4D9CB; border-top: none; height: 25px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E4D9CB; height: 25px; border-top: none; }	
 </style>
{/literal}  
  
<form method="post" name="vnewsform" id="vnewsform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Delete&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Delete all Pages&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 160px;">
 </span>
  
 </div>
 <div style="margin-top: 6px">
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <td class="h_th1" valign="center" align="left" width="20px">
	 <span style="margin-left: 4px">
	  <input type="checkbox" name="checkallitems" id="checkallitems" style="cursor: pointer" onclick="CheckAll(this)">
	 </span>
	</td>
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Page</span></td>
	<td class="h_td" valign="center" align="center" width="100px">Size</td>
    <td class="h_td" valign="center" align="center" width="30px">A-n</td>
    <td class="h_td" valign="center" align="center" width="40px"><img title="Attachments (Binding file)" src="{$smarty.const.W_SITEPATH}img/ico/general/pages.png" alt="file" /></td>
	<td class="h_td" valign="center" align="center" width="110px">Views</td>
	<td class="h_td" valign="center" align="center" width="50px" title="Comments">Com-s</td>
	<td class="h_td2" valign="center" align="center" width="130px">Date</td>
   </tr>	
   {literal}
   <style type="text/css">
	.llw { display: inline-block; margin-left: 8px; vertical-align: baseline; padding-left: 20px; }
   </style>
   {/literal}
   {if $adm_object->GetResult('data.source')}
	{foreach from=$adm_object->GetResult('data.source') item=val name=val}
	 <tr onmouseover="DoHigl(this, 1, {$smarty.foreach.val.index})" onmouseout="DoHigl(this, 0, {$smarty.foreach.val.index})" id="t_r_{$smarty.foreach.val.index}">
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8">
	  <span style="margin-left: 4px">
	   <input type="checkbox" name="chid{$smarty.foreach.val.index}" id="chid{$smarty.foreach.val.index}" 
	   style="cursor: pointer" onclick="CheckItem('{$smarty.foreach.val.index}', this)">
	  </span>
	 </td>
	 	 
	 
	 <td class="sth1" valign="center" align="left" onclick="SetCheckByLine('{$smarty.foreach.val.index}')" style="padding: 3px">
	  
      <div><a href="{$smarty.const.W_SITEPATH}{$val.sid}{if $val.slashaddte}/{/if}" target="_blank">/{$val.sid}{if $val.slashaddte}/{/if}</a></div>
      
      <div style="margin-top: 3px">
      ID FileName: <em>{$adm_object->GetFileName($val.iditem)}</em>
      </div>
      	  	 
	 </td> 
     
     <td class="sth1" valign="center" align="center" onclick="SetCheckByLine('{$smarty.foreach.val.index}')" width="100px">
	  <label style="padding: 3px">
	   {$adm_object->GetPageSize($val.iditem)}
	  </label>	  	  	 
	 </td>
	 
	 <td class="sth1" valign="center" align="center" onclick="SetCheckByLine('{$smarty.foreach.val.index}')" width="30px">
	  <label style="padding: 3px">
	   <a href="{$smarty.const.W_SITEPATH}account/admpspageslist/?new=1&group={$smarty.get.group}{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}{if $smarty.get.grouppage}&grouppage={$smarty.get.grouppage}{/if}&modify={$val.iditem}" title="Modify"><img src="{$smarty.const.W_SITEPATH}img/items/document_edit.png" width="16" height="16"></a>
	  </label>	  	  	 
	 </td>
	 
     <td class="sth1" valign="center" align="center" onclick="SetCheckByLine('{$smarty.foreach.val.index}')" width="40px">
	 <a href="{$smarty.const.W_SITEPATH}account/admfilescontrol/?fid=2&pid={$val.iditem}" target="_blank" title="Investment management (Binding file)">{$CONTROL_OBJ->GetObjectFilesCount(2, $val.iditem)}</a>	  	  	 
	 </td>
     
	 <td class="sth1" valign="center" align="center" onclick="SetCheckByLine('{$smarty.foreach.val.index}')" width="110px">
	  {$val.lookcount}	  	  	 
	 </td>
	 
	 <td class="sth1" valign="center" align="center" onclick="SetCheckByLine('{$smarty.foreach.val.index}')" width="50px">
	  {$adm_object->GetCommentsCountForNews($val.iditem)}	  	  	 
	 </td>
	 
	 <td class="sth1" valign="center" align="center" width="130px" style="border-right: 1px solid #E3E4E8;" 
	 onclick="SetCheckByLine('{$smarty.foreach.val.index}')">
	 {$val.datecreate}
	 </td>
	 
    </tr>  
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.iditem}" name="idm{$smarty.foreach.val.index}">
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="8">
     No Pages!
     <script type="text/javascript">
	  document.getElementById('checkallitems').disabled = true;
     </script>
    </td>
   </tr> 
   {/if} 
 </table>
 {if $adm_object->GetResult('data.source')}
 <div style="text-align: right; margin-top: 10px">{$adm_object->GetResult('data.pagestext')}</div>
 {/if} 
 </span>
 </div> 
 <input type="hidden" value="0" name="actioncountmess">
 <input type="hidden" value="none" name="actionlistmakes"> 
</form>
<script type="text/javascript">SetEnabled();</script>   
  
 {else}
  {* добавление\изменение страницы *}
  
 {literal}
 <script type="text/javascript">         
    function PrepereSend(th) {		 	 	 	 
	 $('#globalbodydata').css('cursor', 'wait');
     th.rb.disabled = true;
     th.rbp.disabled = true;
	 return true; 	
	}//PrepereSent
    
	function SetActionIdent(n) {	
     document.getElementById('addnewnews').actionnewprvmail.value = (n) ? 'act' : 'prev';	
    }//SetActionIdent
    
    function ShowDlgInfo() {
     $("#dlg_info").dialog({
       title: "Information", 
       width:  750,            
       height: 700,         
       modal: true,            
       buttons: {
        "Close": function() { $(this).dialog("close"); }
       },
      resizable: true
     }); 
    }//ShowDlgInfo
 </script>
 {/literal}  
  
 {if $adm_object->GetResult('modifyinfo')}
  <div style="border: 1px dashed #969696; padding: 4px; width: 94%">
  
  <div><b>Changing the page: </b></div> 
  <div style="margin-top: 4px">
   <a href="{$smarty.const.W_SITEPATH}{$adm_object->GetResult('modifyinfo.sid')}" target="_blank">{$adm_object->GetResult('modifyinfo.ttitle')}</a>
  </div>
  
  </div>
  <div style="margin-top: 8px">&nbsp;</div>
  {/if}  

 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
       <span id="ui-dialog-title-dialog" class="ui-dialog-title">Information about the content of pages</span>
       <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
    </div>
    <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dlg_info"> 
       <div class="typelabel">
        
        Content is a full-page template that allows you to use html and all available smarty template engine conditions.<br />
        <br />
        <strong>The page can use the following objects:</strong><br />
        <ins>$CONTROL_OBJ</ins> - subject of project management seo-tools<br />
        <ins><strong style="color: #0000FF">$page_object</strong></ins> - object which gives access to the currently active page. Allows you to manage page, use ext. opportunities in the template code.<br />
        <strong><ins>$page_object</ins> object sends the following methods and properties:</strong><br />
        
        {$adm_object->HiglPHP('
         
  /** получение заголовка страницы 
  *   @return string or === false
  */
  function GetTitle() 
  
  /** получение ключевых слов страницы
  *   @return string or === false
  */
  function GetKeywords() 
  
  /** получение описания страницы
  *   @return string or === false
  */
  function GetDescription() 
  
  /** получение названия для пути навигации проекта
  *   Если пусто - передается заголовок страницы (title)
  *   @return string or === false 
  */
  function GetProjectWayName() 
  
  /** получение идентификатора пути страницы
  *   @return string or === false 
  */
  function GetPagePath() 
  
  /** язык страницы
  *   @return string or === false
  */
  function GetLang()
  
  /** тема страницы
  *   @return string or === false 
  */
  function GetSkin()
  
  /** кол-во просмотров страницы
  *   @return int or === false
  */
  function GetLookCount()
  
  /** увеличивать просмотры автоматически/вручную из текста
  *   @return bool (true, if look count is auto increment) 
  */
  function GetIncerAutoMode()
  
  /** добавлять слэш `/` в конце пути страницы или нет.
  *   Пример: http://site.com/mypage + /
  *   @return bool
  */
  function GetSlashEndIf()
  
  /** получение корректного пути страницы, включая слэши как начальные, так и конечные
  *   Пример /mypage/
  *   @beginSH - bool (если true - добавляет начальный слэш, /mypage ) - default true
  *   @endSH - bool (если true - добавляет конечный слэш, mypage/ ) - default true
  *   
  *   @return string
  */
  function GetNormalPagePath(beginSH=true, endSH=true) 
  
  /** получение полного html пути до сраницы от корня проекта, пример:
  *   /mypage/ или /project/mypage/ или /project/page.htm оптимально для 
  *   указания путей в контенте страницы, например в ссылках или изображениях.
  *   @return string
  */
  function GetFullPath() 
  
  /** получение имени файла шаблона 
  *   @return string
  */  
  function GetTemplateFileName(fullname=false)
  
  /** погрузка контента шаблона страницы
  *   @return string
  */
  function GetTemplatePageSource()
  
  /** получение даты создания страницы 
  *   @return string
  */
  function GetPageCreatedDateTime()
  
  /** увеличение кол-ва просмотров на указанное значение
  *   @tocount int, на какое кол-во увеличить просмотры страницы (default 1)
  *   
  *   @return bool
  */
  function IncLookCount(tocount=1)
  
  /** получение блока `Вложения` файлов `по умолчанию`, возвращает текст стандартного
  *   блока файлов, прикрепленных к странице.
  *  @return string
  */
  function GetDefaultAttachmentsBlock()
  
  /** получение списка файлов, присоедененных к странице в виде массива,
  *   для возможности выстроить блок файлов самостоятельно по нужному
  *   критерию
  * @return array(
  *  
  *  [имя_группы] => array(
  *   
  *   [] => array(
  *    все поля таблицы файлов в бд.
  *   ) 
  * 
  *  ) 
  * 
  * )
  * [имя_группы] - содержит название группы, в которой размещаются файлы.
  * если файл определен как `без группы` - имя группы будет равно [-]
  * и данный элемент массива будет первым.
  */
  function GetAttachmentsList()
  
  /** получение блока комментариев `по умолчанию`.
  *  Позволяет подключить к странице комментарии. Возвращает в виде строки
  *  для последующего вывода в необходимом месте.
  *  @return string
  */
  function GetCommentsBlock()
  
  /** получение ссылки на rss канал комментариев страницы 
  * @return string      
  */  
  function GetRssURL()      
        
        ', $CONTROL_OBJ)}        
                
       </div>   	      
    </div>
 </div>
  
  <form method="post" name="addnewnews" id="addnewnews" onsubmit="return PrepereSend(this)">
      
      <div class="typelabel">
      <label id="red">*</label> The path to the page (up to 150 characters). Specifies the directory in which the page will be available. From the root directory of the project is taken into account. May consist of characters a-z,0-9, and from the Cyrillic characters. All spaces in the path are replaced with the character `-`(dash).<br />
      Example:<br />
      If you specify an identifier in the directory <strong>mypage.php</strong> page will be available at <ins>http://project-url/<strong>mypage.php</strong></ins><br />
      The identifier can be specified in any form, for example:<br />
      <strong>mypage.html</strong> or <strong>mypage</strong> or <strong>моя-страница</strong> or <strong>моя-страница.ext</strong> etc.      
      </div>
      <div class="typelabel">
      <input type="text" class="inpt" style="width: 94%" name="sid" id="sid" maxlength="120" value="{$CONTROL_OBJ->GetPostElement('sid','actionthissectionpost')}">
      </div>
      
      <div class="typelabel">
       <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('slashaddte')} checked="checked" {/if}style="cursor: pointer" name="slashaddte" id="slashaddte"><label for="slashaddte" style="cursor: pointer">&nbsp;Add a slash at the end of the identifier path example: http://project-url/<ins>my-page</ins> + <strong>/</strong></label>  
      </div>
      
      <div class="typelabel">
       <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('iautolook') || $smarty.post.actionthissectionpost != 'do'} checked="checked" {/if}style="cursor: pointer" name="iautolook" id="iautolook"><label for="iautolook" style="cursor: pointer">&nbsp;Automatically increase the number of hits in the opening pages</label>  
      </div>     
      
      <div class="typelabel">
       <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('commcheck')} checked="checked" {/if}style="cursor: pointer" name="commcheck" id="commcheck"><label for="commcheck" style="cursor: pointer">&nbsp;When you add a comment to send it to the test administrator</label>  
      </div>
      
      <div class="typelabel">
       <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('commcaptcha') || $smarty.post.actionthissectionpost != 'do'} checked="checked" {/if}style="cursor: pointer" name="commcaptcha" id="commcaptcha"><label for="commcaptcha" style="cursor: pointer">&nbsp;Use security captcha to add comments</label>  
      </div>
      
      <div class="typelabel"><label id="red">*</label> Comments per page</div>
      <div class="typelabel">
      <input type="text" class="inpt" style="width: 250px" name="commperpa" id="commperpa" maxlength="3" value="{$CONTROL_OBJ->GetPostElement('commperpa','actionthissectionpost', 'do', '15')}">
      </div>       
      
      <div class="typelabel"><label id="red">*</label> Page header (the tag title) (up to 250 characters)</div>
      <div class="typelabel">     
       <textarea class="int_text" style="height: 50px; width: 95%" name="ttitle" id="ttitle">{$CONTROL_OBJ->GetPostElement('ttitle','actionthissectionpost')}</textarea>
      </div>   
      
      <div class="typelabel">The name of the branch in the navigation path of the project (up to 250 characters), it is empty - uses the page title (title). Used in the way of location, sample: <ins>Home</ins> -> <ins>Page Name</ins></div>
      <div class="typelabel">     
       <textarea class="int_text" style="height: 50px; width: 95%" name="tpathname" id="tpathname">{$CONTROL_OBJ->GetPostElement('tpathname','actionthissectionpost')}</textarea>
      </div>         
      
      <div class="typelabel">Keywords (tag keywords) (up to 250 characters), it is empty - uses the default keyword</div>
      <div class="typelabel">     
       <textarea class="int_text" style="height: 50px; width: 95%" name="tkeywords" id="tkeywords">{$CONTROL_OBJ->GetPostElement('tkeywords','actionthissectionpost')}</textarea>
      </div>
      
      <div class="typelabel">Tag description (up to 250 characters), it is empty - uses the default description</div>
      <div class="typelabel">     
       <textarea class="int_text" style="height: 50px; width: 95%" name="tdescript" id="tdescript">{$CONTROL_OBJ->GetPostElement('tdescript','actionthissectionpost')}</textarea>
      </div>
      
      <div class="typelabel">Content of the page (html format, smarty supported - <a href="javascript:" onclick="ShowDlgInfo()">information</a>)</div>
      <div class="typelabel">     
       <textarea class="int_text" style="height: 250px; width: 95%" name="tsource" id="tsource">{$CONTROL_OBJ->GetPostElement('tsource', 'actionthissectionpost')}</textarea>
      </div>
          
       
 <div class="typelabel" style="margin-top: 15px">
  <input type="submit" value="&nbsp;{if !$adm_object->GetResult('modifyinfo')}Create page{else}Save changes{/if}&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">
 </div>
 <input type="hidden" value="prev" name="actionnewprvmail">  
 <input type="hidden" value="do" name="actionthissectionpost">
 </form>
 
 {if $smarty.post.actionthissectionpost == 'do' && !$smarty.post.actionthissectionpost_q && $smarty.post.actionnewprvmail != 'prev'}
 <div style="margin-top: 10px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">Page successfully {if !$adm_object->GetResult('modifyinfo')}added{else}changed{/if}!</label>
  {/if}
 </div>
 {/if}  
  
 
 {/if}
 
{else}
 {* управление группами *}
 <div style="margin: 7px 1px 12px 1px">
 <a href="{$smarty.const.W_SITEPATH}account/admpspageslist/?new=1{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}"{if $smarty.get.new && !$adm_object->GetResult('modifyinfo')} style="color: #000000"{/if}>Add Group</a> | <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admpspageslist/{if $smarty.get.oldpage}?page={$smarty.get.oldpage}{/if}">All Groups (<label style="color: #000000">{$adm_object->GetResult('gcount')}</label>)</a>   
 </div>
 
 {if !$smarty.get.new}
  {* управление списком разделов, просмотр, выбор *}
  
  {if !$adm_object->GetResult('data.source')}
   <div style="text-align: center; padding: 6px; margin-top: 25px"><b>No Active Groups!</b></div>
  {else}
   {literal}
    <script type="text/javascript">
	 function DeleteSelectedElementSection(ident) {
	  if (!confirm("Are you sure you want to delete the selected group?\r\nAll pages that are in that group will be deleted permanently!\r\nContinue?")) {
	   return false;	
	  }	
	  var ppf = {/literal}'{$smarty.const.W_SITEPATH}account/admpspageslist/{if $smarty.get.page}?page={$smarty.get.page}{/if}'{literal};  
	  document.location = ppf + '&qdelete=' + ident;  
	 }
    </script>
   {/literal}
   {foreach from=$adm_object->GetResult('data.source') item=val name=val}
    <div style="margin: 4px; margin-top: 15px; padding: 4px; border: 1px solid #D2D2D2">
	 <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
       <tr>
       
        <td valign="top" align="left" width="50px" style="padding-right: 4px">
		 <img src="{$smarty.const.W_SITEPATH}img/ico/general/group_deleteblocked_128.png" border="0">
		</td>	
		
	    <td valign="top" align="left">
		 <div><a href="{$smarty.const.W_SITEPATH}account/admpspageslist/?group={$val.iditem}{if $smarty.get.page}&grouppage={$smarty.get.page}{/if}"><strong>{$val.groupname}</strong></a><label style="margin-left: 6px; font-size: 95%; color: #333399"><i>(contains: {$adm_object->GetPagesCount($val.iditem)})</i></label></div>
		 <div style="margin-top: 4px; font-size: 95%; color: #808080">
		  {assign var="itemdescrit" value=$CONTROL_OBJ->strings->CorrectTextFromDB($val.groupdescr)}
		  {if !$itemdescrit}no description{else}{$itemdescrit}{/if}
		 </div>
		</td>
		
	    <td valign="top" align="right">
		 <div style="white-space: nowrap;">		 
		 
		 <a href="{$smarty.const.W_SITEPATH}account/admpspageslist/?modify={$val.iditem}&new=1{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}" title="Modify"><img src="{$smarty.const.W_SITEPATH}img/items/document_edit.png" width="16" height="16"></a>
		 
		 <a style="margin-left: 6px" href="javascript:" onclick="DeleteSelectedElementSection('{$val.iditem}')" title="Delete"><img src="{$smarty.const.W_SITEPATH}img/items/erase.png" width="16" height="16"></a>
		 
		 </div>
		</td>
       </tr>
      </table>
	 </span>
	</div>
   {/foreach} 
  {if $adm_object->GetResult('data.source')}
   <div style="text-align: right; margin-top: 10px">{$adm_object->GetResult('data.pagestext')}</div>
  {/if}    
  {/if} 
 
 {else}
  {* добавление/изменение раздела *}
  
{literal}
 <script type="text/javascript">         
    function PrepereSend(th) {
	 
	 if (!th.groupname.value) {
	  alert('Specify Group Name!');
	  th.groupname.focus();
	  return false;	
	 }
	 			 	 	 
	 $('#globalbodydata').css('cursor', 'wait');
     $('input[id="rb"]').attr('disabled', 'disabled');
     $('input[id="rbp"]').attr('disabled', 'disabled');
	 return true; 	
	}//PrepereSent
	
	function PrepereSend4(th) {
	 $('#globalbodydata').css('cursor', 'wait');
     $('input[id="rb"]').attr('disabled', 'disabled');
     $('input[id="rbp"]').attr('disabled', 'disabled');
	 return true;	
	}//PrepereSend4
	
	function SetActionIdent(n) {	
     document.getElementById('addgroupitem').actionnewprvmail.value = (n) ? 'act' : 'prev';	
    }//SetActionIdent	
 </script>
 {/literal}
 
 
 <form method="post" name="addgroupitem" id="addgroupitem" onsubmit="return PrepereSend(this)">
   
   {if $adm_object->GetResult('modifyinfo')}
   <div style="margin-top: 15px; margin-bottom: 15px; background: #F0F0F0; padding: 3px"><b>Setting up a group</b></div>   
   {/if}   
    
   <div class="typelabel"><label id="red">*</label> Group name (up to 120 characters)</div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 94%" name="groupname" id="groupname" maxlength="120" value="{$adm_object->GetAsElementP('groupname')}">
   </div>
   
   <div class="typelabel" style="margin-top: 12px; margin-bottom: 12px">
    <b>Group Settings</b>
   </div>
     
   {if $smarty.post.actionnewprvmail == 'prev'}
   <div style="padding: 4px; border: 1px solid #666699; margin-bottom: 20px; margin-top: 10px; width: 94%;">
   {$CONTROL_OBJ->strings->CorrectTextFromDB($CONTROL_OBJ->strings->CorrectTextToDB($smarty.post.groupdescr))}  
   </div>
   {/if} 
   
   <div class="typelabel">Group Description</div>
   <div class="typelabel">
    {include file='new_message.tpl' ident='groupdescr' source=$smarty.post.groupdescr height='90px' width='95%'}
   </div>
   
   <div class="typelabel" style="margin-top: 15px">
    <input type="hidden" value="do" name="actionthissectnnews">
   </div> 
   
   <input type="submit" value="&nbsp;{if !$adm_object->GetResult('modifyinfo')}Add Group{else}Change group settings{/if}&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp;
   <input type="submit" value="&nbsp;Preview description&nbsp;" class="button" name="rbp" id="rbp" onclick="SetActionIdent(0)">
   <input type="hidden" value="prev" name="actionnewprvmail">
   <input type="hidden" value="ok" name="actionnewsectionnews">
  </form>  
  
  {if $smarty.post.actionthissectnnews == 'do' && !$smarty.post.actionthissectionpost_q && $smarty.post.actionnewprvmail != 'prev'}
 <div style="margin-top: 10px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">{if !$adm_object->GetResult('modifyinfo')}The group has successfully added!{else}Group settings successfully changed!{/if}</label>
  {/if}
 </div>
 {/if}  

 {/if} 
{/if}