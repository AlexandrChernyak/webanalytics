{* реферальные баннеры *}
<div style="margin-top: 4px">
<div>
<a href="{$smarty.const.W_SITEPATH}account/admrefbunners&new=1{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}"{if $smarty.get.new} style="color: #000000"{/if}>Добавить баннер</a> | <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admrefbunners/{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}">Все баннеры (<label style="color: #000000">{$adm_object->GetResult('count')}</label>)</a>
</div>
<div style="margin-top: 12px">
{if !$smarty.get.new}
{* список баннеров *}
{literal}
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = {/literal}{if !$adm_object->GetResult('count')}0{else}1{/if};{literal}  
 function DoHigl(th, n, p) {	
  if (n) {	$(th).css('background','#F9FAFB'); } else {
   var ch = document.getElementById('chid'+p);
   var color = (ch && ch.checked) ? '#E1E2E0' : 'none';   	
   $(th).css('background', color);		
  }	
 }//DoHigl
 function CheckItem(itemid, th) {
  th = (th) ? th : document.getElementById('chid'+itemid);   
  if (th && th.checked) { $('#t_r_'+itemid).css('background','#E1E2E0'); } else {
  $('#t_r_'+itemid).css('background','none');
  }
  SetEnabled();   	
 }//CheckItem
 function CheckAll(th) {	
  for (var i=0; i < list_items.length; i++) {
   var ch = $('#chid'+list_items[i]);
   ch.attr('checked', (th.checked) ? 'checked' : '');
   if (th.checked) { $('#t_r_'+list_items[i]).css('background','#E1E2E0'); } else {
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
   alert('Выделите хотя бы один баннер!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == 'delete') {
   if (!confirm('Вы действительно хотите удалить ['+count+'] баннеров?')) { return false; }
  } else 
  if (th.actionlistmakes.value == 'dall') {
   if (!allsaveenabled) { alert('Нет данных для удаления!'); return false; }	
   if (!confirm('Вы действительно хотите удалить все баннеры?')) { return false; }	
  } else { alert('Неизвестный идентификатор операции!'); return false; }
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
  var f = document.getElementById('vlinksform');
  if (!f) { return ; }
  f.actionlistmakes.value = a;   	
 }//SetActionP   	
</script>
<style type="text/css">
  .h_th1, .h_td, .h_td2 { 
   border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E3E4E8; border-left: none; }
  .btn_n { border: 1px solid #E3E4E8; border-top: none; height: 25px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E3E4E8; height: 25px; border-top: none; }	
 </style>
{/literal} 
<form method="post" name="vlinksform" id="vlinksform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Удалить все баннеры&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 160px;">
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
	<td class="h_td2" valign="center" align="left"><span style="margin-left: 3px">Баннер</span></td>
   </tr>	
   {literal}
   <style type="text/css">
	.llw { display: inline-block; margin-left: 8px; vertical-align: baseline; padding-left: 20px; }
   </style>
   <script type="text/javascript">
    var globalajaxpath = {/literal}'{$smarty.const.W_SITEPATH}account/admrefbunners/';{literal}
    var gID   = false;
    var gName = false;
    var inprocess = false;
    
    function ModifyElementItem(pID, pName) {
     if (inprocess) {
      return alert('Дождитесь окончание операции...');  
     }   
     var res = prompt("Укажите новое значение!", $('#'+pName+pID).text());
     if (res == null) { return ; }
     if (!res) { res = 0; } else {
      if (!IisInteger(res, true)) { return alert('Значение должно быть числом!'); }  
     }
     $('#change'+pName+pID).html(
     '<label style="font-size: 95%; color: #0000FF">Приминение, пожалуйста, подождите..</label>'
     );
     inprocess = true;
     gID   = pID;
     gName = pName;
     SendDefaultRequest(globalajaxpath, 
     'is_ajax_mode=1&type='+pName+'&id='+pID+'&value='+res, 'PrepereRequestData'
     );     
    }//ModifyElementItem 
    
    function ContinueItem(data) {
     inprocess = false;
     if (gID && gName) {        
      $('#change'+gName+gID).html(    
       '<a href="javascript:" onclick="ModifyElementItem(\''+gID+'\', \''+gName+'\')" style="font-size: 95%">Изменить</a>'
      );
      if (data || data == '0') {         
       $('#'+gName+gID).html(data);       
       $('#refbunnerblock'+gID).css(((gName == 'h') ? 'height' : 'width'), (data == '0') ? '100%' : (data+'px'));
       $('#refbunnerblock'+gID).css('display',(data == '0') ? 'block' : 'inline-block');         
      }         
     }     
     gID = false;
     gName = false;
     return true;   
    }//ContinueItem
    
    function PrepereRequestData(data) { return ContinueItem(data); }
       	
   </script>
   {/literal}
   {if $adm_object->GetResult('data.source')}
	{foreach from=$adm_object->GetResult('data.source') item=val name=val}
	 <tr onmouseover="DoHigl(this, 1, {$smarty.foreach.val.index})" onmouseout="DoHigl(this, 0, {$smarty.foreach.val.index})" id="t_r_{$smarty.foreach.val.index}">
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8{if $val.isflash}; background: #FFCC99{/if}">
	  <span style="margin-left: 4px">
	   <input type="checkbox" name="chid{$smarty.foreach.val.index}" id="chid{$smarty.foreach.val.index}" 
	   style="cursor: pointer" onclick="CheckItem('{$smarty.foreach.val.index}', this)">
	  </span>
	 </td>  
	 	 
	 <td class="sth1" valign="top" align="left" style="padding: 3px; border-right: 1px solid #E3E4E8;" onclick="$('#chid{$smarty.foreach.val.index}').click()">
           
           
      <div>
      {if !$val.isflash}<img src="{$smarty.const.W_SITEPATH}pfiles/images/{$val.bfilename}" border="0">{else}
       
       <span id="refbunnerblock{$val.iditem}" style="display: inline-block; {if $val.bwidth} width:{$val.bwidth}px; {/if}{if $val.bheight} height:{$val.bheight}px{/if}">         
       <object  classid="clsid27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="100%" height="100%" id="refbunner{$val.iditem}" align="middle">
       <param name="allowScriptAccess" value="always" />
       <param name="allowFullScreen" value="false" />
       <param name="movie" value="{$smarty.const.W_SITEPATH}pfiles/images/{$val.bfilename}" />
       <param name="quality" value="high" />
       <embed src="{$smarty.const.W_SITEPATH}pfiles/images/{$val.bfilename}" quality="high" bgcolor="#ffffff" width="100%" height="100%" name="refbunner{$val.iditem}" id="refbunner{$val.iditem}" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer"/>
       </object>
       </span>
      
      {/if}
      </div>    
      
      <div style="margin-top: 4px">
       <div>Имя файла: <em style="color: #797979">{$val.bofilename}</em></div>
       <div>Размер файла: <em style="color: #797979">{$adm_object->GetImageFileSizeEX($val.bsize)}</em></div>
       <div>
        Высота: <em style="color: #797979"><label id="h{$val.iditem}">{$val.bheight}</label>px</em>
        {if $val.isflash}
        <label id="changeh{$val.iditem}" style="margin-left: 6px">
        <a href="javascript:" onclick="ModifyElementItem('{$val.iditem}', 'h')" style="font-size: 95%">Изменить</a>
        </label>        
        {/if}        
       </div>
       <div>
        Ширина: <em style="color: #797979"><label id="w{$val.iditem}">{$val.bwidth}</label>px</em>
        {if $val.isflash}
        <label id="changew{$val.iditem}" style="margin-left: 6px">
        <a href="javascript:" onclick="ModifyElementItem('{$val.iditem}', 'w')" style="font-size: 95%">Изменить</a>
        </label>        
        {/if}        
       </div>
      </div>
         	  
	 </td>
	 
    </tr>  
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.iditem}" name="idm{$smarty.foreach.val.index}">
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="4">
     Нет активных баннеров!
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
 {* добавление баннера *}
 {literal}
 <script type="text/javascript">           
  function PrepereSent(th) {			 	 
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;
   return true; 	
  }//PrepereSent
  function ShHideElementFlash(th) {   
   $('#flashparams').css('visibility', (th.checked) ? 'visible' : 'hidden');
   $('#flashparams').css('display', (th.checked) ? 'block' : 'none');
  }//ShHideElementFlash	  
 </script>
 {/literal}
 
 <form method="post" name="addnewlink" id="addnewlink" enctype="multipart/form-data" onsubmit="return PrepereSent(this)">
  
  <div class="typelabel"> Изображение баннера (форматы: {$adm_object->GetListTypes()}{if $adm_object->GetResult('maxsize')}, максимальный размер: <b>{$adm_object->GetResult('maxsize')}</b>){/if}</div>
  <div class="typelabel">
   <input type="file" size="20" style="width: 95%; height: 22px" class="inpt" name="image" id="image">
  </div> 
  
  <div class="typelabel">
   <input type="checkbox" style="cursor: pointer" name="isflashobject" id="isflashobject" onclick="ShHideElementFlash(this)" /><label for="isflashobject" style="cursor: pointer"> Данный объект является flash роликом, указать ширину и высоту</label>
  </div>
  
  <div id="flashparams" style="visibility: hidden; display: none">
  <div class="typelabel">Ширина и высота баннера. Если значение равно `0` - значение не будет использоваться, соответственно ролик будет растянут автоматически. Указывается только число (без px)</div>
  <div class="typelabel">
   <label>Высота: </label><input type="text" class="inpt" style="width: 50px" name="hflash" id="hflash" value="90" maxlength="5"> <label style="margin-left: 6px">Ширина: </label><input type="text" class="inpt" style="width: 50px" name="wflash" id="wflash" value="400" maxlength="5">
  </div>
  </div>
  
       
 <div class="typelabel" style="margin-top: 15px">
  <input type="submit" value="&nbsp;Добавить баннер&nbsp;" class="button" name="rb" id="rb">
 </div>
   
 <input type="hidden" value="do" name="actionthissectionpost">
 </form>
 
 
 {if $smarty.post.actionthissectionpost == 'do' && !$smarty.post.actionthissectionpost_q}
 <div style="margin-top: 10px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">Баннер успешно добавлен!</label>
  {/if}
 </div>
 {/if}
{/if}
</div>
</div>