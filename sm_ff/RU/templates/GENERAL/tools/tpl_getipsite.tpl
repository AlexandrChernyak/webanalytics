{* получение ip сайта *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам определить ip указанного списка сайтов.
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
 <script type="text/javascript">
  function DoSetDefUrl(ident) {
   var str = {/literal}'{$smarty.const.W_HOSTMYSITE}';{literal}
   var obj = $('#'+ident);
   var sou = trim(obj.val());
   obj.val(((sou == '') ? '' : sou + "\r\n") + str); 
   obj.focus();  	
  }//DoSetDefUrl
  function ClearVal(ident) { $('#'+ident).val(''); $('#'+ident).focus(); }
  function PrepereToSend(th) {
   if (trim(th.urls.value) == '') {
	alert('Укажите список сайтов! (по одному на строку)');
	th.urls.focus();
	return false;
   }
   
   return true;	
  }//PrepereToSend  	
 </script>
 {/literal}
 <form method="post" name="tollform" id="toolform" onsubmit="return PrepereToSend(this)">
  <div class="typelabel"><label id="red">*</label> Список сайтов <label class="prep_label_analisys">(пример: <a href="javascript:" onclick="DoSetDefUrl('urls')">{$smarty.const.W_HOSTMYSITE}</a>, или <a href="javascript:" onclick="ClearVal('urls')">очистить</a> список)</label>{if isset($tool_object)}, &nbsp;Не более: {$tool_object->GetLimitCount()}{/if}</div>
  <div class="typelabel">  
   <textarea class="int_text" style="height: 100px; width: 95%" name="urls" id="urls">{$CONTROL_OBJ->GetPostElement('urls', 'doactiontool')}</textarea>
   <div class="typelabel">
    <input type="submit" value="&nbsp;Отправить&nbsp;" class="button" name="rb" id="rb">
   </div> 
  </div>
  <input type="hidden" value="do" name="doactiontool">  
 </form>
 {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  <div style="margin-top: 15px">
  {if $tool_object->error}
  <div style="color: #FF0000">{$tool_object->error}</div>
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
   function DoHigl(th, n) {	
    if (n) { $(th).css('background','#F8F5F1'); } else {   	
     $(th).css('background', 'none');		
    }	
   }//DoHigl	
   </script>
   {/literal}
   <span style="width: 100%"> 
   <table width="96%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <td class="h_th1" valign="center" align="left"><label style="margin-left: 4px">Хост сайта</label></td>	
	<td class="h_td2" valign="center" align="right" width="120px"><label style="margin-right: 4px">IP сайта</label></td>
   </tr>   	
   {if $tool_object->GetResult()}
	{foreach from=$tool_object->GetResult() item=val name=val}	 
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	 
     <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E4D9CB">
	  <label style="margin-left: 4px"><a href="http://{$val.host}" target="_blank">{$val.host}</a></label>	    
	 </td>	 

	 <td class="sth1" valign="center" align="right" width="120px" style="border-right: 1px solid #E4D9CB;">
	  <label style="margin-right: 4px">
	  {if !$val.ip}?{else}{$val.ip}{/if}{if $val.ipview}&nbsp;<noindex><a title="Посмотреть все сайты на данном IP" rel="nofollow" href="javascript:" target="_blank" onclick="window.open('{$val.ipview}', '')"><img src="{$smarty.const.W_SITEPATH}img/items/target_link.png"></a></noindex>{/if}
	  </label>
	 </td>
    </tr>	 
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="3">
     Нет данных!
    </td>
   </tr> 
   {/if} 
   </table>   
   </span>
  {/if}
  </div>
 {/if}
 
 {/if} 
</div>