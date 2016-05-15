{* анализ контента сайта *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам Выполнить анализ контента указанного сайта (страницы).<br /><br />
 Для успешного продвижения сайта, необходимо иметь релевантный контент и оптимальную плотность слов. При помощи данного сервиса вы сможите выполнить максимально полный анализ контента вашего сайта.<br />
При выполнении анализа будет проанализирован контент вашего сайта на: вес страницы; релевантность, плотность заголовка (title), ключевых слов (keywords) к тексту страницы; скорость, время загрузки страницы; анализирован текст страницы; обработаны стоп-слова; процентное соотношение вхождений слов с текстом страницы; рассчитана частота (TF) терминов содержимого страницы.
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
  <div class="typelabel"><label id="red">*</label> URL<label class="prep_label_analisys">(пример: <a href="javascript:" onclick="DoSetDefUrl('url')">{$smarty.const.W_HOSTMYSITE}</a>)</label></div>
  <div class="typelabel">  
   <input type="text" value="{$CONTROL_OBJ->GetPostElement('url', 'doactiontool')}" style="width: 98%" class="inpt" name="url" id="url">
   
   <div class="typelabel">Разделитель ключевых слов (Keywords)</div>
   <div class="typelabel">
	 <select size="1" name="separatorkeywords" id="separatorkeywords" style="width: 200px">
	  <option>Запятая</option>
	  <option value="1"{if $smarty.post.separatorkeywords == '1'} selected="selected"{/if}>Пробел</option>
     </select>   
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
    <div>
     {literal}
     <script type="text/javascript">
	  function ShHdBlElement(th, ident) {	   
	   var hd = ($('#'+ident).css('visibility') == 'hidden') ? true : false; 
	   $(th).html((hd) ? 'Скрыть' : 'Показать');
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
     <div><b>Общие данные о странице</b></div>
	 <div style="margin-top: 12px">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
	  
	  {if $tool_object->GetResult('cachlastupdatedate')}
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px" style="color: #333399">
	    Последнее обновление данных:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px; color: #333399"> 
	    {$CONTROL_OBJ->GetLastIntervalInDays($tool_object->GetResult('cachlastupdatedate'))} &nbsp;
	    ({$tool_object->GetResult('cachlastupdatedate')})
        
        {if $tool_object->NextUpdateDate()}
        <label style="margin-left: 5px; font-size: 95%; color: #000000">
        (для обновления - зарегистрируйтесь, следующее обновление через: {$tool_object->NextUpdateDate()})
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
	    Размер страницы:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	    {$tool_object->GetResult('pageinfo.size')}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Кодировка:	    
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
	    IP сайта:	    
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
	    Скорость загрузки:	    
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
	    Время загрузки:	    
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
	    Всего символов (с html тэгами):	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		{$tool_object->GetResult('pageinfo.charscount')}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Всего символов (текст):	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		{$tool_object->GetResult('pageinfo.textcount')}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Всего символов (текст без пробелов):	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		{$tool_object->GetResult('pageinfo.nospcount')}
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Доля контента ко всему коду страницы:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		{$tool_object->GetResult('pageinfo.compereto')} %
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Перенаправление:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		{if $tool_object->GetResult('pageinfo.redirectto')}
		 <noindex><a rel="nofollow" href="{$tool_object->GetResult('pageinfo.redirectto')}" target="_blank">{$tool_object->CorrectURLLink($tool_object->GetResult('pageinfo.redirectto'), 100)}</a></noindex>		 
		{else}
		 <i>(нет)</i>
		{/if} 
	   </td>
      </tr>
	  
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Внутренние / внешние ссылки:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<noindex><a rel="nofollow" href="{$smarty.const.W_SITEPATH}tools/checkurllinks/{$tool_object->GetResult('pageinfo.linknorot')}" target="_blank">Анализ</a></noindex>
	   </td>
      </tr>      
	
	  </table>	
	 </span>	 
	 </div> 
    
	 <div class="analisislabelid"><b>Постоянная ссылка на страницу</b></div>
	 <div style="margin-top: 12px; width: 96%">
	  <textarea style="border: none; background: #FFFFFF; width: 96%" readonly="readonly" onclick="this.select()">http://{$smarty.const.W_HOSTMYSITE}/tools/contentcheck/{$tool_object->GetResult('pageinfo.host')}</textarea>
	 </div>
     
     <div class="analisislabelid"><b>Общие данные сайта</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'genblocksource4')">Скрыть</a> ]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="genblocksource4">    
      {include file="tools/contentcheck/tpl_block-general-sys-items-list.tpl" url_p=$tool_object->GetResult('pageinfo.host')}	 	  	  
	 </div>
	 
	 <div class="analisislabelid"><b>Заголовок (title)</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'titleblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="titleblocksource">
	  {if !$tool_object->GetResult('titleinfo')}
	   <div style="margin-left: 4px; color: #FF0000">Тэг &lt;title&gt; не найден на странице!</div>
	  {else}
	   {include file="tools/contentcheck/tpl_taganalisysresultblock.tpl" block_ident="titleinfo"}	   
	  {/if}
	 </div>
	 
	 <noindex>
	 <div class="analisislabelid"><b>Ключевые слова (keywords)</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'keywordsblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="keywordsblocksource">
	  {if !$tool_object->GetResult('keywordsinfo')}
	   <div style="margin-left: 4px; color: #FF0000">Ключевые слова не найдены на странице!</div>
	  {else}
	   {include file="tools/contentcheck/tpl_taganalisysresultblock.tpl" block_ident="keywordsinfo"}	   
	  {/if}
	 </div>
	 
	 <div class="analisislabelid"><b>Описание страници (description)</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'descriptionblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="descriptionblocksource">
	  {if !$tool_object->GetResult('descriptioninfo')}
	   <div style="margin-left: 4px; color: #FF0000">Описание не найдено на странице!</div>
	  {else}
	   {include file="tools/contentcheck/tpl_taganalisysresultblock.tpl" block_ident="descriptioninfo"}	   
	  {/if}
	 </div>
	 	 
	 <div class="analisislabelid"><b>Тэги h1 - h6</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'h1h6blocksource')">Скрыть</a>]</label>
	 </div>	  
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="h1h6blocksource">
	  {if !$tool_object->CheckForExists('h1info,h2info,h3info,h4info,h5info,h6info')}
	   <div style="margin-left: 4px; color: #FF0000">Тэги с <b>h1</b> по <b>h6</b> не найдены!</div>
	  {else}	  
	   {if $tool_object->GetResult('h1info')}
	    <div style="margin-top: 10px"><b style="color: #969696">Тэг <b>h1</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         {$tool_object->GetResult('h1info.data')}
        </div>
	   {/if}
	  
	   {if $tool_object->GetResult('h2info')}
	    <div style="margin-top: 10px"><b style="color: #969696">Тэг <b>h2</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         {$tool_object->GetResult('h2info.data')}
        </div>
	   {/if}
	  
	   {if $tool_object->GetResult('h3info')}
	    <div style="margin-top: 10px"><b style="color: #969696">Тэг <b>h3</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         {$tool_object->GetResult('h3info.data')}
        </div>
	   {/if}
	  
	   {if $tool_object->GetResult('h4info')}
	    <div style="margin-top: 10px"><b style="color: #969696">Тэг <b>h4</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         {$tool_object->GetResult('h4info.data')}
        </div>
	   {/if}
	  
	   {if $tool_object->GetResult('h5info')}
	    <div style="margin-top: 10px"><b style="color: #969696">Тэг <b>h5</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         {$tool_object->GetResult('h5info.data')}
        </div>
	   {/if}
	  
	   {if $tool_object->GetResult('h6info')}
	    <div style="margin-top: 10px"><b style="color: #969696">Тэг <b>h6</b></b></div>
        <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
         {$tool_object->GetResult('h6info.data')}
        </div>
	   {/if}
	   
	  {/if}
	 </div>
	 
	 <div class="analisislabelid"><b>Контент страницы</b><label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'contentblocksource')">Скрыть</a>]</label>
	 </div>	  
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="contentblocksource">
	  {if !$tool_object->GetResult('contentinfo')}
	   <div style="margin-left: 4px; color: #FF0000">Не удалось получить контент страницы!</div>
	  {else}
	   {include file="tools/contentcheck/tpl_taganalisysresultblock.tpl" block_ident="contentinfo" iscontent_info="1"}	   
	  {/if}	 
	 </div>
	 </noindex>
     
	</div>
   {else}
    <div style="color: #FF0000">Нет данных</div>
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