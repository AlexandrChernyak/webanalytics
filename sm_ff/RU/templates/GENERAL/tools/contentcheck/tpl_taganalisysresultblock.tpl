{* 
 вывод блока анализа тэга
 входные параметры:
 
 $block_ident = идентификатор информации о тэге
 $iscontent_info = true если вывод слов контента
*}
 {if !$iscontent_info}
 <div><b style="color: #969696">Оригинальный текст</b></div>
 <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
  {$tool_object->GetResult($block_ident, 'text')}
 </div>
 
 <div style="margin-top: 10px"><b style="color: #969696">Обработанный текст (без стоп-слов)</b></div>
 <div style="margin-top: 6px; padding: 4px; border: 1px solid #F1EAE4">
  {$tool_object->GetResult($block_ident, 'textnostopwords')}
 </div>
 {/if}
 
 <!-- info about tag -->
 <div style="margin-top: 14px"><b style="color: #969696">Общая информация</b></div>
 <div style="margin-top: 10px">
  <span style="width: 100%">
   <table width="100%" cellpadding="0" cellspacing="0" border="0">
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Всего слов в тексте:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult($block_ident, 'allwordscount')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Слов в тексте (без стоп-слов):	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult($block_ident, 'wordscount')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Слов без повторов и стоп-слов:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult($block_ident, 'wordsnorepeatnostopwords')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Стоп-слов в тексте:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult($block_ident, 'stopwordscount')}
	 </td>
    </tr>
    
    {if $tool_object->GetResult($block_ident, 'stopwordscount')}
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Список стоп-слов:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	  <div>
	   <label style="color: #000000">[
	    <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, '{$block_ident}stwords')">Показать</a>]
	   </label>
	  </div>
	  <div style="display: none; visibility: hidden; padding-top: 6px" id="{$block_ident}stwords">
	   {$tool_object->GetWordListByArray($tool_object->GetResult($block_ident, 'stopwordslist'))}
	  </div>	  
	 </td>
    </tr>
    {/if}
    
    {if !$iscontent_info}
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Плотность всех слов к контенту:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult($block_ident, 'fullplotnost')}
	 </td>
    </tr>
        
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Релевантность текста к контенту:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult($block_ident, 'relevanttocontent')} %
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Вхождений слов тэга в контенте:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult($block_ident, 'fullrepeatincontent')} из {$tool_object->GetResult($block_ident, 'wordscount')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Слов с повтором в тэге &gt; 1 раза:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult($block_ident, 'wordscountinrepeatin')}
	 </td>
    </tr>
    {/if}
    
   </table>
  </span>
 </div>
 
 <!-- words info as list -->
 <div style="margin-top: 14px">
  <b style="color: #969696">Результат анализа слов {if !$iscontent_info}тэга{else}контента{/if}</b>
 </div>
 <div style="margin-top: 10px">
  <span style="width: 100%">
   {if !$tool_object->GetResult($block_ident, 'wordslist')}
   <div style="margin: 4px 2px 0px 5px; color: #FF0000">В {if !$iscontent_info}тэге{else}контенте{/if} слова не обнаружены!</div>
   {else}
   
   {if !$iscontent_info}
    <div style="margin-top: 4px; margin-bottom: 4px; border: 1px dashed #808080; padding: 4px; font-size: 95%">
     <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
       <tr>
	    <td valign="top" align="left" width="24px">
	     <img src="{$smarty.const.W_SITEPATH}img/items/information2.png">
	    </td>
	    <td valign="top" align="left">
	     <div><b>Слово</b> - анализируемое слово</div>
         <div><b>Кол-во в тэге</b> - кол-во повторов текущего слова в анализируемом тэге</div>
         <div><b>Плотность</b> - плотность текущего слова относительно контента страницы</div>
         <div><b>Вхождений</b> - кол-во вхождений текущего слова в контенте страницы</div>
         <div><b>Частота (TF)</b> - Частота TF(Term Frequency) относительно контента страницы</div>
	    </td>
       </tr>
      </table>
	 </span>
    </div>
   {/if}
   
   <table width="100%" cellpadding="0" cellspacing="0" border="0" id="{$block_ident}tableq">
    <thead>	
     <tr>
 
      <th class="h_th1" valign="center" align="left">
       <label style="margin-left: 4px;">Слово</label><label class="bgshortq">&nbsp;</label>
      </th>
      
      <th class="h_td" valign="center" align="left" width="125px">
       <label style="margin-left: 4px;">
	   {if !$iscontent_info}Кол-во в тэге{else}Вхождений{/if}
	   </label><label class="bgshortq">&nbsp;</label>
      </th>
      
      <th class="h_td" valign="center" align="left" width="100px">
       <label style="margin-left: 4px;">
	   {if !$iscontent_info}Плотность{else}В title{/if}
	   </label><label class="bgshortq">&nbsp;</label>
      </th>
      
      <th class="h_td" valign="center" align="left" width="110px">
       <label style="margin-left: 4px;">
	   {if !$iscontent_info}Вхождений{else}В Keywords{/if}
	   </label><label class="bgshortq">&nbsp;</label>
      </th>
  	  
      <th class="h_td2" valign="center" align="left" width="120px">
       <label style="margin-left: 4px;">Частота (TF)</label><label class="bgshortq">&nbsp;</label>
      </th>
      
     </tr>   	
    </thead>
    
    {foreach from=$tool_object->GetResult($block_ident, 'wordslist') item=val name=val}
     <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
      
      <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E4D9CB; padding-left: 4px">
  	   {$val.word}  
      </td>
      
      <td class="sth1" valign="center" align="left" width="125px" style="padding-left: 4px">
       {$val.inputs}
      </td>
      
      <td class="sth1" valign="center" align="left" width="100px" style="padding-left: 4px">
       {if !$iscontent_info}{$val.plotnost}{else}{if $val.intitle}<label style="color: #0000FF">Да</label>{else}Нет{/if}{/if}
      </td>
      
      <td class="sth1" valign="center" align="left" width="110px" style="padding-left: 4px">
       {if !$iscontent_info}{$val.inputs_in_content}{else}{if $val.inkeywords}<label style="color: #0000FF">Да</label>{else}Нет{/if}{/if}
      </td>
         
      <td class="sth1" valign="center" align="left" width="120px" style="border-right: 1px solid #E4D9CB; padding-left: 4px">
       {$val.tfherz}
      </td>
     
     </tr>     
    {/foreach}   
   </table>
   
   <div id="{$block_ident}pager" class="pager" style="height: auto">
	<form>
	 <div style="height: 25px; margin-top: 6px">
		<img src="{$smarty.const.W_SITEPATH}img/items/tables_pages/first.png" class="first">
		<img src="{$smarty.const.W_SITEPATH}img/items/tables_pages/prev.png" class="prev">
		<input type="text" class="pagedisplay" readonly="readonly" style="position: relative; top: -3px">
		<img src="{$smarty.const.W_SITEPATH}img/items/tables_pages/next.png" class="next">
		<img src="{$smarty.const.W_SITEPATH}img/items/tables_pages/last.png" class="last">
		<select class="pagesize" style="position: relative; top: -2px">
			<option selected="selected" value="20">20</option>			
			<option value="40">40</option>
			<option value="50">50</option>
			<option value="80">80</option>
			<option value="100">100</option>
			<option value="150">150</option>
		</select>
	 </div>	
	</form>   
   </div>
   
   {literal}
   <script type="text/javascript">
    $(document).ready(function() { 
     $("#{/literal}{$block_ident}{literal}tableq") 
      .tablesorter() 
      .tablesorterPager({container: $("#{/literal}{$block_ident}{literal}pager"), size: 20, positionFixed: false}); 
    });	
   </script>
   {/literal}
   
   {if $iscontent_info}
   <!-- content data -->
   <div style="margin-top: 14px">
    <b style="color: #969696">Исходный контент страницы</b>, слов (<b>{$tool_object->GetResult($block_ident, 'allwordscount')}</b>)
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('pageinfo.text')}</textarea>    
   </div>
   
   <div style="margin-top: 14px">
    <b style="color: #969696">Контент страницы без стоп-слов</b>, слов (<b>{$tool_object->GetResult($block_ident, 'wordscount')}</b>), без повторов (<b>{$tool_object->GetResult($block_ident, 'wordsnorepeatnostopwords')}</b>)
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('pageinfo.textnostopwords')}</textarea>    
   </div>
   
   <div style="margin-top: 14px">
    <b style="color: #969696">HTML код страницы</b>, символов всего (<b>{$tool_object->GetResult('pageinfo.charscount')}</b>)
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('pageinfo.htmldata')}</textarea>    
   </div>
   
   <div style="margin-top: 14px">
    <b style="color: #969696">Ответ сервера</b>
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 100%">{$tool_object->GetResult('pageinfo.headresponse')}</textarea>
   </div>
   {/if}
   
   {/if}   
  </span>
 </div>
 