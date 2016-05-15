{* анализ ссылок сайта *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам провести анализ внутренних и внешних ссылок указанного сайта. Предоставить информацию о ссылках, доступных для индексации поисковиками и ссылках, запрещенных для индексации поисковиками.
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
   obj.val(str); 
   obj.focus();  	
  }//DoSetDefUrl
  function PrepereToSend(th) {
   if (trim(th.url.value) == '') {
	alert('Укажите url!');
	th.url.focus();
	return false;
   }
   th.rb.disabled = true;
   $('#globalbodydata').css('cursor', 'wait');   
   return true;	
  }//PrepereToSend  	
 </script>
 {/literal}
 <form method="post" name="tollform" id="toolform" onsubmit="return PrepereToSend(this)">
  <div class="typelabel"><label id="red">*</label> URL <label class="prep_label_analisys">(пример: <a href="javascript:" onclick="DoSetDefUrl('url')">{$smarty.const.W_HOSTMYSITE}</a>)</label></div>
  <div class="typelabel">  
   <input type="text" value="{$CONTROL_OBJ->GetPostElement('url', 'doactiontool')}" style="width: 450px" class="inpt" name="url" id="url">
   
   <div class="typelabel">
    <input type="checkbox" {if $smarty.post.doactiontool == 'do' && $CONTROL_OBJ->CheckPostValue('ignoredoubled')}checked="checked" {/if}style="cursor: pointer" name="ignoredoubled" id="ignoredoubled"><label for="ignoredoubled" style="cursor: pointer">&nbsp;Не учитывать повторы ссылок</label>
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('ignoreresh')}checked="checked" {/if}style="cursor: pointer" name="ignoreresh" id="ignoreresh"><label for="ignoreresh" style="cursor: pointer">&nbsp;Учитывать ссылки с #(параметр)</label>
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $smarty.post.doactiontool != 'do' || $CONTROL_OBJ->CheckPostValue('getonlyhost')}checked="checked" {/if}style="cursor: pointer" name="getonlyhost" id="getonlyhost"><label for="getonlyhost" style="cursor: pointer">&nbsp;Учитывать ссылки без протокола, но с текущим хостом</label>
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $smarty.post.doactiontool == 'do' && $CONTROL_OBJ->CheckPostValue('noinside')}checked="checked" {/if}style="cursor: pointer" name="noinside" id="noinside"><label for="noinside" style="cursor: pointer">&nbsp;Опустить внутренние ссылки</label>
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $smarty.post.doactiontool == 'do' && $CONTROL_OBJ->CheckPostValue('nooutside')}checked="checked" {/if}style="cursor: pointer" name="nooutside" id="nooutside"><label for="nooutside" style="cursor: pointer">&nbsp;Опустить внешние ссылки</label>
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $smarty.post.doactiontool == 'do' && $CONTROL_OBJ->CheckPostValue('nosubdom')}checked="checked" {/if}style="cursor: pointer" name="nosubdom" id="nosubdom"><label for="nosubdom" style="cursor: pointer">&nbsp;Опустить ссылки на поддомены</label>
   </div>
   
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
   {if $tool_object->GetResult()} 
    <div style="width: 530px; overflow: auto;">
     {literal}
	 <style type="text/css">
	  .numb_td { width: 50px; white-space: nowrap; }
     </style>
     <script type="text/javascript">
	  function ShHdBlElement(th, ident) {	   
	   var hd = ($('#'+ident).css('visibility') == 'hidden') ? true : false; 
	   $(th).html((hd) ? 'Скрыть' : 'Показать');
	   $('#'+ident).css('visibility', (hd) ? 'visible' : 'hidden');
	   $('#'+ident).css('display', (hd) ? 'block' : 'none');
	  }//ShHdBlElement
	  var linksdata = new Array();
	  linksdata['ins_href'] = new Array(); 
      linksdata['ins_href_full'] = new Array();
      
      linksdata['out_href'] = new Array();
      
      linksdata['sdm_href'] = new Array();
      
      function LoadLinksList(ident, arrname, th) {
	   try {	   	
	   	th.disabled = true;
		$('#globalbodydata').css('cursor', 'wait');
		var norepeat = document.getElementById(ident+'norepeat');
		norepeat = (norepeat && norepeat.checked) ? true : false;
		var id = $('#'+ident);
		id.val('');
		var arr2 = new Array();
		for (var i=0; i < linksdata[arrname].length; i++) {
		 linksdata[arrname][i] = trim(linksdata[arrname][i]);
		 if (linksdata[arrname][i] == '') { continue; }	
		 if (!norepeat || !InArray(arr2, linksdata[arrname][i])) {
		  if (id.val() == '') { id.val(linksdata[arrname][i]); } else { id.val(id.val() + "\n" + linksdata[arrname][i]); }
		  if (norepeat) { arr2.push(linksdata[arrname][i]); }		  	
		 }		 	
		}		
	   } finally {
	   	$('#globalbodydata').css('cursor', 'auto');
		th.disabled = false;		
	   }	   	
	  }//LoadLinksList
     </script>
     {/literal}
     
	 {if $tool_object->GetResult('inside')}
      <div style="padding-bottom: 6px; border-bottom: 1px solid #003366"><b>Внутренние ссылки</b>
	   <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'insidel')">Скрыть</a>]</label>
	   <label style="margin-left: 4px; font-size: 95%; color: #000000">Индексируются: <b>{$tool_object->GetResult('inside_info.index')}</b>, не индексируются: <b>{$tool_object->GetResult('inside_info.noindex')}</b></label>
	  </div>
	  <div id="insidel">
	  {foreach from=$tool_object->GetResult('inside') item=val name=val}
	   <div style="margin-top: 15px">
	    <span style="width: 100%">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
         <tr>
	      <td class="numb_td" valign="top" align="right">
		   <label style="margin-right: 4px">№ {$tool_object->GetIndex($smarty.foreach.val.index)}.</label>
		  </td>
	      <td valign="top" align="left">
		   <div>
		   {if $val.href}
		   <noindex><a href="{$val.href_full}" rel="nofollow" target="_blank">{if $tool_object->CorrectSymplyString($val.text)}{$tool_object->CorrectSymplyString($val.text)}{else}{$val.href}{/if}</a></noindex>
		   <label style="margin-left: 8px; font-size: 95%">
		   {if $val.noindex}
		    <b style="color: #FF0000">noindex</b>
		   {/if}
		   {if $val.nofollow}
		    {if $val.noindex}, {/if}
		    <b style="color: #FF0000">nofollow</b>
		   {/if}
		   </label>
		   {else}
		    Нет ссылки
		   {/if} 
		   </div>
		   <div style="margin-top: 4px">
		    {if $val.href_full}{$val.href_full}
			&nbsp;&nbsp; <label style="font-size: 95%; color: #808080">[ {$val.href} ]</label>{else}?{/if}
		   </div>		  
		   {literal}
		    <script type="text/javascript">
	         linksdata['ins_href'].push('{/literal}{$tool_object->CorrectSymplyString($val.href)}{literal}');
	         linksdata['ins_href_full'].push('{/literal}{$tool_object->CorrectSymplyString($val.href_full)}{literal}');
            </script>
		   {/literal}
		  </td>
         </tr>
        </table>
		</span>	   
	   </div>
	  {/foreach}
	  <div style="margin-top: 15px"><b style="color: #808080">Ссылки списком:</b>
	   <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'blockinsidetext')">Показать</a>]</label>
	  </div>
	  <div id="blockinsidetext" style="visibility: hidden; display: none">
	   <div style="margin-top: 4px">
	    <textarea class="int_text" style="height: 120px; width: 95%" name="insidelist" id="insidelist"></textarea>
	   </div>
	   <div style="margin-top: 4px">
	    <input type="button" value="&nbsp;Исходный формат ссылок&nbsp;" class="button" onclick="LoadLinksList('insidelist', 'ins_href', this)"> &nbsp;
	    <input type="button" value="&nbsp;Полный формат ссылок&nbsp;" class="button" onclick="LoadLinksList('insidelist', 'ins_href_full', this)"> &nbsp;
	    <input type="checkbox" checked="checked" style="cursor: pointer" name="insidelistnorepeat" id="insidelistnorepeat"><label for="insidelistnorepeat" style="cursor: pointer">&nbsp;Без повторов</label>
	   </div>
	  </div>
	 </div>
     {/if}
 
     {if $tool_object->GetResult('outside')}
      <div style="padding-bottom: 6px; border-bottom: 1px solid #003366; {if $tool_object->GetResult('inside')}margin-top: 34px{/if}"><b>Внешние ссылки</b>
	   <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'outsidel')">{if $tool_object->GetResult('inside')}Показать{else}Скрыть{/if}</a>]</label>
	   <label style="margin-left: 4px; font-size: 95%; color: #000000">Индексируются: <b>{$tool_object->GetResult('outside_info.index')}</b>, не индексируются: <b>{$tool_object->GetResult('outside_info.noindex')}</b></label>
	  </div>
	  <div id="outsidel"{if $tool_object->GetResult('inside')} style="visibility: hidden; display: none"{/if}>
	  {foreach from=$tool_object->GetResult('outside') item=val name=val}
	   <div style="margin-top: 15px">
	    <span style="width: 100%">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
         <tr>
	      <td class="numb_td" valign="top" align="right">
		   <label style="margin-right: 4px">№ {$tool_object->GetIndex($smarty.foreach.val.index)}.</label>
		  </td>
	      <td valign="top" align="left">
		   <div>
		   {if $val.href}
		   <noindex><a href="{$val.href_full}" rel="nofollow" target="_blank">{if $tool_object->CorrectSymplyString($val.text)}{$tool_object->CorrectSymplyString($val.text)}{else}{$val.href}{/if}</a></noindex>
		   <label style="margin-left: 8px; font-size: 95%">
		   {if $val.noindex}
		    <b style="color: #FF0000">noindex</b>
		   {/if}
		   {if $val.nofollow}
		    {if $val.noindex}, {/if}
		    <b style="color: #FF0000">nofollow</b>
		   {/if}
		   </label>
		   {else}
		    Нет ссылки
		   {/if} 
		   </div>
		   <div style="margin-top: 4px">
		    {if $val.href_full}{$val.href_full}
			&nbsp;&nbsp; <label style="font-size: 95%; color: #808080">[ {$val.href} ]</label>{else}?{/if}
		   </div>		  
		   {literal}
		    <script type="text/javascript">
	         linksdata['out_href'].push('{/literal}{$tool_object->CorrectSymplyString($val.href)}{literal}');
            </script>
		   {/literal}
		  </td>
         </tr>
        </table>
		</span>	   
	   </div>
	  {/foreach}
	  <div style="margin-top: 15px"><b style="color: #808080">Ссылки списком:</b>
	   <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'blockoutsidetext')">Показать</a>]</label>
	  </div>
	  <div id="blockoutsidetext" style="visibility: hidden; display: none">
	   <div style="margin-top: 4px">
	    <textarea class="int_text" style="height: 120px; width: 95%" name="outsidelist" id="outsidelist"></textarea>
	   </div>
	   <div style="margin-top: 4px">
	    <input type="button" value="&nbsp;Получить список ссылок&nbsp;" class="button" onclick="LoadLinksList('outsidelist', 'out_href', this)"> &nbsp;
		<input type="checkbox" checked="checked" style="cursor: pointer" name="outsidelistnorepeat" id="outsidelistnorepeat"><label for="outsidelistnorepeat" style="cursor: pointer">&nbsp;Без повторов</label>
	   </div>
	  </div>
	 </div>
     {/if}
     
     {if $tool_object->GetResult('subdom')}
      <div style="padding-bottom: 6px; border-bottom: 1px solid #003366; {if $tool_object->GetResult('inside') || $tool_object->GetResult('outside')}margin-top: 34px{/if}"><b>Ссылки на поддомены</b>
	   <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'subdoml')">{if $tool_object->GetResult('inside') || $tool_object->GetResult('outside')}Показать{else}Скрыть{/if}</a>]</label>
	   <label style="margin-left: 4px; font-size: 95%; color: #000000">Индексируются: <b>{$tool_object->GetResult('subdom_info.index')}</b>, не индексируются: <b>{$tool_object->GetResult('subdom_info.noindex')}</b></label>
	  </div>
	  <div id="subdoml"{if $tool_object->GetResult('inside') || $tool_object->GetResult('outside')} style="visibility: hidden; display: none"{/if}>
	  {foreach from=$tool_object->GetResult('subdom') item=val name=val}
	   <div style="margin-top: 15px">
	    <span style="width: 100%">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
         <tr>
	      <td class="numb_td" valign="top" align="right">
		   <label style="margin-right: 4px">№ {$tool_object->GetIndex($smarty.foreach.val.index)}.</label>
		  </td>
	      <td valign="top" align="left">
		   <div>
		   {if $val.href}
		   <noindex><a href="{$val.href_full}" rel="nofollow" target="_blank">{if $tool_object->CorrectSymplyString($val.text)}{$tool_object->CorrectSymplyString($val.text)}{else}{$val.href}{/if}</a></noindex>
		   <label style="margin-left: 8px; font-size: 95%">
		   {if $val.noindex}
		    <b style="color: #FF0000">noindex</b>
		   {/if}
		   {if $val.nofollow}
		    {if $val.noindex}, {/if}
		    <b style="color: #FF0000">nofollow</b>
		   {/if}
		   </label>
		   {else}
		    Нет ссылки
		   {/if} 
		   </div>
		   <div style="margin-top: 4px">
		    {if $val.href_full}{$val.href_full}
			&nbsp;&nbsp; <label style="font-size: 95%; color: #808080">[ {$val.href} ]</label>{else}?{/if}
		   </div>		  
		   {literal}
		    <script type="text/javascript">
	         linksdata['sdm_href'].push('{/literal}{$tool_object->CorrectSymplyString($val.href)}{literal}');
            </script>
		   {/literal}
		  </td>
         </tr>
        </table>
		</span>	   
	   </div>
	  {/foreach}
	  <div style="margin-top: 15px"><b style="color: #808080">Ссылки списком:</b>
	   <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'blocksubdomtext')">Показать</a>]</label>
	  </div>
	  <div>&nbsp;</div>
	  <div id="blocksubdomtext" style="visibility: hidden; display: none">
	   <div style="margin-top: 4px">
	    <textarea class="int_text" style="height: 120px; width: 95%" name="subdomlist" id="subdomlist"></textarea>
	   </div>
	   <div style="margin-top: 4px">
	    <input type="button" value="&nbsp;Получить список ссылок&nbsp;" class="button" onclick="LoadLinksList('subdomlist', 'sdm_href', this)"> &nbsp;
		<input type="checkbox" checked="checked" style="cursor: pointer" name="subdomlistnorepeat" id="subdomlistnorepeat"><label for="subdomlistnorepeat" style="cursor: pointer">&nbsp;Без повторов</label>
		<div>&nbsp;</div>
	   </div>
	  </div>
	 </div>
     {/if}
     
	</div>
   {else}
    <div style="color: #FF0000">Нет данных</div>
   {/if}   
  {/if}
  </div>
 {/if} 
 
 {/if}
</div>