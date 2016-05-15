{* анализ сайта *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
  Данный инструмент поможет Вам Выполнить анализ сайта по наиболее значимым показателям сайта.<br /><br />
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
       if (n) { $(th).css('background','#F8F5F1'); } else {   	
        $(th).css('background', 'none');		
       }	
      }//DoHigl 
     </script>
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
	    <div style="margin-top: 4px; margin-bottom: 4px">
		<img src="http://mini.site-shot.com/1024x768/120/jpeg/?http://{$tool_object->GetResult('pageinfo.realhost')}" 
		width="120" height="90"></div>			    
	   </td>	 
	   <td class="sth1" valign="top" align="left" style="padding-left: 8px"> 		
		<div style="margin-top: 4px"><a href="http://{$tool_object->GetResult('pageinfo.host')}" target="_blank">{$tool_object->CorrectURLLink($tool_object->GetResult('pageinfo.host'), 50)}</a>
		<span style="margin-left: 2px">
		<img src="http://favicon.yandex.net/favicon/{$tool_object->GetResult('pageinfo.host')}" width="16" height="16">
		</span>
		<label style="margin-left: 3px">(<a style="font-size: 95%; color: #808080" href="{$smarty.const.W_SITEPATH}tools/whoisurlip/{$tool_object->GetResult('pageinfo.host')}" target="_blank">WHOIS IP</a>, <a style="font-size: 95%; color: #808080" href="{$smarty.const.W_SITEPATH}tools/whoisdomain/{$tool_object->GetResult('pageinfo.host')}" target="_blank">WHOIS DOMAIN</a>)</label></div>	    
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
		 <span style="margin-left: 12px">
		  <noindex><a href="{$tool_object->GetResult('ipinfolink')}" target="_blank">Все сайты на IP</a></noindex>
		 </span>
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
		<noindex><a rel="nofollow" href="{$smarty.const.W_SITEPATH}tools/checkurllinks/{$tool_object->GetResult('pageinfo.host')}" target="_blank">Анализ</a></noindex>
	   </td>
      </tr>
	  
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Анализ контента страницы:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<noindex><a rel="nofollow" href="{$smarty.const.W_SITEPATH}tools/contentcheck/{$tool_object->GetResult('pageinfo.host')}" target="_blank">Выполнить</a></noindex>
	   </td>
      </tr> 
	  
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Посетителей за сутки по 
		<label style="border-bottom: 1px dashed #333399; cursor: help" title="Live Internet">LI</label>:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		{if $tool_object->GetResult('LIvalue.LiDayStatistic')}
		 {$tool_object->GetResult('LIvalue.LiDayStatistic')}
		{else}
		 ?
		{/if} 
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Посетителей за месяц по 
		<label style="border-bottom: 1px dashed #333399; cursor: help" title="Live Internet">LI</label>:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		{if $tool_object->GetResult('LIvalue.LiMonthStatistic')}
		 {$tool_object->GetResult('LIvalue.LiMonthStatistic')}
		{else}
		 ?
		{/if} 
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Сервер сайта:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		{if $tool_object->GetResult('pageinfo.server')}
		 {$tool_object->GetResult('pageinfo.server')}
		{else}
		 ?
		{/if} 
	   </td>
      </tr>
      
      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Расположение датацентра:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		{if $tool_object->GetResult('pageinfo.servergeo')}
		 {if $tool_object->FlagExists()}
		  <span style="margin-right: 3px"><img src="{$tool_object->GetFlagName()}" width="22" height="16"></span>
		 {/if}		 
		 {$tool_object->GetResult('pageinfo.servergeo')}
		{else}
		 ?
		{/if} 
	   </td>
      </tr>     

      <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Сервер:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		{if $tool_object->GetResult('pageinfo.res_server')}		 
		 {$tool_object->GetResult('pageinfo.res_server')}
		{else}
		 ?
		{/if} 
	   </td>
      </tr>
	  
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="250px">
	    Заработок:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		<noindex><a href="http://u.to/6L7-BA" target="_blank" class="gotoregurl">Вы можете зарабатывать на сайте более <label style="color: #FF0000">{if $tool_object->GetResult('pageinfo.getmoneyfromb') === false}50{else}{$tool_object->GetResult('pageinfo.getmoneyfromb')}{/if}$</label></a></noindex> 
	   </td>
      </tr>  
	  	
	  </table>	
	 </span>	 
	 </div> 
    
	 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Постоянная ссылка на страницу</b>
	 </div>
	 <div style="margin-top: 12px; width: 96%">
	  <textarea style="border: none; background: #FFFFFF; width: 96%" readonly="readonly" onclick="this.select()">http://{$smarty.const.W_HOSTMYSITE}/tools/{$tool_object->section_id}/{$tool_object->GetResult('pageinfo.host')}</textarea>
	 </div>
	 
	 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Информационные тэги сайта</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'title1blocksource')">Скрыть</a>]</label>
	 </div>	  
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="title1blocksource">
	    
	   <div style="margin-top: 10px"><b style="color: #969696">Заголовок (title)</b></div>
       <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
        {if !$tool_object->GetResult('pageinfo.title')}
         <div style="margin-left: 5px; color: #FF0000">Заголовок не найден!</div>
        {else}
         {$tool_object->GetResult('pageinfo.title')}
        {/if} 
       </div>
       
       <div style="margin-top: 10px"><b style="color: #969696">Ключевые слова (keywords)</b></div>
       <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
        {if !$tool_object->GetResult('pageinfo.keywords')}
         <div style="margin-left: 5px; color: #FF0000">Ключевые слова не найдены!</div>
        {else}
         {$tool_object->GetResult('pageinfo.keywords')}
        {/if} 
       </div>
       
       <div style="margin-top: 10px"><b style="color: #969696">Описание (description)</b></div>
       <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
        {if !$tool_object->GetResult('pageinfo.description')}
         <div style="margin-left: 5px; color: #FF0000">Описание не найдено!</div>
        {else}        
         {$tool_object->GetResult('pageinfo.description')}
        {/if} 
       </div>
       
       <div style="margin-top: 10px"><b style="color: #969696">Тэг <b>h1</b></b></div>
       <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
        {if !$tool_object->GetResult('pageinfo.h1tag')}
         <div style="margin-left: 5px; color: #FF0000">Тэг <b>h1</b> не найден!</div>
        {else}         
         {$tool_object->GetResult('pageinfo.h1tag')} 
        {/if} 
       </div>
	  
	 </div>
	 
	 
	 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Основные показатели сайта</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'genblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="genblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label id="red">Я</label>ндекс ТиЦ:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetResult('cyvalue.value') !== false}
		  <b>{$tool_object->GetResult('cyvalue.value')}</b>
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
	   
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label id="red">Я</label>ндекс ТиЦ с WWW:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {if $tool_object->GetResult('cyvalue.image_with_www')}
		  <img src="{$tool_object->GetResult('cyvalue.image_with_www')}" width="88" height="31">
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
	   
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label id="red">Я</label>ндекс ТиЦ без WWW:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {if $tool_object->GetResult('cyvalue.image_without_www')}
		  <img src="{$tool_object->GetResult('cyvalue.image_without_www')}" width="88" height="31">
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Поднять ТиЦ:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 <noindex><a href="http://wm-click.ru" target="_blank" class="gotoregurl">Поднять ТиЦ регистрируя сайт в каталогах</a></noindex> 
	    </td>
       </tr>  
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Склей домена:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {if $tool_object->GetResult('cyvalue.comperewww')}
		  <b style="color: #008000">Да</b>
		 {else}
		  <b>Нет</b>
		 {/if} 
	    </td>
       </tr>
	   
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label id="red">Я</label>ндекс Ранг:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {if $tool_object->GetResult('cyvalue.rang') !== false}
		  <b>{$tool_object->GetResult('cyvalue.rang')}</b> из <b>6</b>
		  <label style="margin-left: 6px">
		  <img src="{$smarty.const.W_SITEPATH}img/items/yrang/y_bar{$tool_object->GetResult('cyvalue.rang')}.png">
		  </label>
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
	   
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Тема <label id="red">Я</label>ндекс.Каталога:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {if $tool_object->GetResult('cyvalue.yacacatalog')}
		  {$tool_object->GetResult('cyvalue.yacacatalog')}
		 {else}
		  <i>(не описан в каталоге)</i>
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label> PageRank:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {if $tool_object->GetResult('prvalue.value') !== false}
		  <b>{$tool_object->GetResult('prvalue.value')}</b> из <b>10</b>
		  <label style="margin-left: 6px">
		  <img src="{$smarty.const.W_SITEPATH}img/items/pr/pr{$tool_object->GetResult('prvalue.value')}.gif">
		  </label>
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Alexa Traffic Rank:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {if $tool_object->GetResult('alexavalue.value') !== false}
		  <b>{$tool_object->GetResult('alexavalue.value')}</b>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Alexa Traffic Rank (график):	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {if $tool_object->GetResult('alexavalue.value') !== false}
		  <img src="{$tool_object->GetResult('alexavalue.graph')}">
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     Статистика по Live Internet:	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px; padding-top: 2px; padding-bottom: 2px"> 
		 {if $tool_object->GetResult('listatgraph') !== false}
		  <img src="{$tool_object->GetResult('listatgraph')}">
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>     
	
	  </table>	
	 </span>	  	  
	 </div>
	 
	 {* история изменения показателей *}
	 {if $tool_object->GetToolLimitInfoEx('enabledphistory')} 
	  {include file="tools/contentcheck/tpl_paramshistory_check_block.tpl" block_ident="histanalisys" chart_width="98%" chart_height="400px"}
	 {/if}
	 
	 {* в топе по ключевым словам *} 
	 {include file="tools/contentcheck/tpl_inenginetopresultblock.tpl" block_ident="inenginetopq"}
     
     {* трафик google *}
     <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%"><b>Поисковый трафик с Google</b><label style="color: #000000; margin-left: 6px">[ <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'traffromgoole')">Скрыть</a> ]</label>
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
     
     <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%"><b>Backlink History (Majestic SEO)</b><label style="color: #000000; margin-left: 6px">[ <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'blinksviever')">Скрыть</a> ]</label>
    </div>  
     <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="blinksviever">   
     <img src="http://www.majesticseo.com/charts/backlinks-discovery/{$tool_object->GetResult('pageinfo.realhost')}?w=600&h=270&IndexDataSource=F" border="0" /> 
     </div>   
	 
	 {literal}
	 <style type="text/css">
	  .fv{background:transparent url(http://favicon.yandex.ru/favicon/yandex.ru/www.dmoz.org/www.google.com/mail.ru/aport.ru/rambler.ru/www.bing.com/siteexplorer.search.yahoo.com/yaca.yandex.ru/blogs.yandex.ru/www.yahoo.com/images.yandex.ru/web.archive.org/otvet.mail.ru/www.copyscape.com/validator.w3.org/jigsaw.w3.org/network-tools.com/webo.in) no-repeat 0 0;width:16px;height:16px;display:block;float:left;margin-right:5px;}
	  .labfv { position: relative; top: 1px }
     </style>
	 {/literal}
	 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
	 <b>Наличие сайта в каталогах</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'indirsblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="indirsblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 0"></label>
		 <label class="labfv"><label id="red">Я</label>ндекс Каталог:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_InDirYandex')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_InDirYandex')}" target="_blank">Посмотреть</a>
		  </noindex>
		  <label style="margin-left: 6px">
		  ({if $tool_object->GetResult('cyvalue.yacacatalog')}<b style="color: #008000">Да</b>{else}<b>Нет</b>{/if})
		  </label>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -16px"></label>
		 <label class="labfv"><label style="color: #008000">D</label>MOZ:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_InDirDMOZ')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_InDirDMOZ')}" target="_blank">Посмотреть</a>
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
		 <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label> каталог:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOLE_DIR')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOLE_DIR')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -48px"></label>
		 <label class="labfv">Mail.ru:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_InDirMail')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_InDirMail')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -62px"></label>
		 <label class="labfv">Aport:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_InDirAport')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_InDirAport')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -80px"></label>
		 <label class="labfv">Rambler Top 100:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_InDirRamblerTop100')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_InDirRamblerTop100')}" target="_blank">Посмотреть</a>
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
	 <b>Проиндексировано страниц</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'indexblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="indexblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 0"></label>
		 <label class="labfv"><label id="red">Я</label>ндекс:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_IndexYandex')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_IndexYandex')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -32px"></label>
		 <label class="labfv"><label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label>:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_IndexGoogle')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_IndexGoogle')}" target="_blank">Посмотреть</a>
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
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_IndexBing')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -112px"></label>
		 <label class="labfv">
		 Yahoo:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_IndexYahoo')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_IndexYahoo')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -80px"></label>
		 <label class="labfv">
		 Rambler:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_IndexRambler')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_IndexRambler')}" target="_blank">Посмотреть</a>
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
	 <b>Ссылаются на сайт из</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'backurlblocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="backurlblocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 0"></label>
		 <label class="labfv"><label id="red">Я</label>ндекс:</label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_BackYandex')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_BackYandex')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -128px"></label>
		 <label class="labfv">
		 Сайты из <label id="red">Я</label>-Каталога:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'YANDEX_DIR_LINKS')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'YANDEX_DIR_LINKS')}" target="_blank">Посмотреть</a>
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
		 <label id="red">Я</label>ндекс блоги:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_BackYandexBlogs')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_BackYandexBlogs')}" target="_blank">Посмотреть</a>
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
		 <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label>:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_BackGoogle')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_BackGoogle')}" target="_blank">Посмотреть</a>
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
		 <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label> блоги:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOGLE_BLOGS')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOGLE_BLOGS')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -160px"></label>
		 <label class="labfv">
		 Yahoo:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_BackYahoo')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_BackYahoo')}" target="_blank">Посмотреть</a>
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
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_BackBing')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -80px"></label>
		 <label class="labfv">
		 Rambler:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_Plugin_BackRambler')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_Plugin_BackRambler')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -176px"></label>
		 <label class="labfv">
		 <label id="red">Я</label>ндекс картинки:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'YANDEX_IMAGES')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'YANDEX_IMAGES')}" target="_blank">Посмотреть</a>
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
		  <label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #D9E309">o</label><label style="color: #3886AF">gl</label><label id="red">e</label> картинки:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOGLE_IMAGES')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOGLE_IMAGES')}" target="_blank">Посмотреть</a>
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
	 <b>Дополнительная информация</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'more1blocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="more1blocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -32px"></label>
		 <label class="labfv">
		 В кэше Google:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOGLE_CACH')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOGLE_CACH')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 0"></label>
		 <label class="labfv">
		 В кэше <label id="red">Y</label>andex:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'YANDEX_CACH')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'YANDEX_CACH')}" target="_blank">Посмотреть</a>
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
		 Похожие сайты в Google:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOGLE_RELAETED')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'GOOGLE_RELAETED')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
	   
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -192px"></label>
		 <label class="labfv">
		 История сайта:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'SITE_HISTORY')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'SITE_HISTORY')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
	   
	   <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -208px"></label>
		 <label class="labfv">
		 Упоминания в Ответы@Mail.ru:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'MAIL_ANSWERS')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'MAIL_ANSWERS')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -224px"></label>
		 <label class="labfv">
		 Поиск плагиата:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'PLAGIAT_SEARCH')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'PLAGIAT_SEARCH')}" target="_blank">Посмотреть</a>
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
	 <b>Дополнительные инструменты</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'more2blocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="more2blocksource">
	 <span style="width: 100%">
	  <table width="96%" cellpadding="0" cellspacing="0" border="0">
      
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -240px"></label>
		 <label class="labfv">
		 Проверка валидности HTML:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'HTML_VALIDATE')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'HTML_VALIDATE')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -256px"></label>
		 <label class="labfv">
		 Проверка валидности CSS:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'CSS_VALIDATE')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'CSS_VALIDATE')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -272px"></label>
		 <label class="labfv">
		 Ping\Traceroute\DNS:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'PING_TRACEROUT')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'PING_TRACEROUT')}" target="_blank">Посмотреть</a>
		  </noindex>		  
		 {else}
		  ?
		 {/if} 
	    </td>
       </tr>
       
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
        <td class="sth1" valign="center" align="left" width="250px">
	     <label class="fv" style="background-position:0 -288px"></label>
		 <label class="labfv">
		 Скорость загрузки страницы:
		 </label>	    
	    </td>	 
	    <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
		 {if $tool_object->GetConstantElementValue('ss_BlockConstantValue', 'PAGE_SPEED_LOAD')}
		  <noindex> 
		   <a href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'PAGE_SPEED_LOAD')}" target="_blank">Посмотреть</a>
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
	 <b>Данные страницы</b>
	 <label style="color: #000000; margin-left: 6px">[
	   <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'more3blocksource')">Скрыть</a>]</label>
	 </div>
	 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="more3blocksource">
	  
	  <!-- html data -->
	  <div style="margin-top: 14px"><b style="color: #969696">Исходный контент страницы</b></div>
      <div style="margin-top: 10px">
       <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('pageinfo.htmldata')}</textarea>
      </div>
      
      <!-- header -->
      <div style="margin-top: 14px"><b style="color: #969696">Ответ сервера</b></div>
      <div style="margin-top: 10px">
       <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('pageinfo.headresponse')}</textarea>
      </div>
      
      <!-- robots.txt -->
      <div style="margin-top: 14px"><b style="color: #969696">Файл robots.txt</b>, размер: <u>
	  {$tool_object->GetResult('headersize')}
	  </u>, проверить на <noindex><a rel="nofollow" href="{$tool_object->GetConstantElementValue('ss_BlockConstantValue', 'CHECK_ROBOTSTXT_WEBYAND')}" target="_blank">Яндекс.Вебмастер</a></noindex> </div>
      <div style="margin-top: 10px">
       {if $tool_object->GetResult('pageinfo.robots') === false}
        <div style="margin-left: 5px; color: #FF0000">Файл <b>robots.txt</b> не найден!</div>
       {else}
        <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('pageinfo.robots')}</textarea>
       {/if}
      </div>
	  	  
	 </div>
	 
     
	</div>
   {else}
    <div style="color: #FF0000">Нет данных</div>
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