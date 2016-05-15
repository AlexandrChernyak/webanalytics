{* анализ текста *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам Выполнить анализ текста (кол-во слов, символов, стоп-слов, частота, плотность и т.д).
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
  function PrepereToSend(th) {
   if (trim(th.source.value) == '') {
	alert('Укажите текст для анализа!');
	th.source.focus();
	return false;
   }
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;   
   return true;	
  }//PrepereToSend  	
 </script>
 {/literal}
 <form method="post" name="tollform" id="toolform" onsubmit="return PrepereToSend(this)">
  <div class="typelabel"><label id="red">*</label> Текст для анализа</div>
  <div class="typelabel"> 
  
  <textarea class="int_text" style="height: 100px; width: 96%" name="source" id="source">{$CONTROL_OBJ->GetPostElement('source', 'doactiontool')}</textarea>

   <div class="typelabel">
    <input type="submit" value="&nbsp;Отправить&nbsp;" class="button" name="rb" id="rb">
   </div> 
  </div>
  <input type="hidden" value="do" name="doactiontool">  
 </form>
 {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  {literal}
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
  {/literal}
  <div style="margin-top: 25px">
   <span style="width: 100%">
   <table width="96%" cellpadding="0" cellspacing="0" border="0">
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="295px">
	  Всего символов в тексте:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult('allcharscount')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="295px">
	  Всего символов без пробелов:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult('allcharscount_nospaces')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="295px">
	  Всего символов без пробелов и переносов строк:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult('allcharsnospacesandbreaks')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="295px">
	  Всего слов:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult('wordscount')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="295px">
	  Всего слов без повторов и стоп-слов:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult('wordsnorepeat')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="295px">
	  Символов без стоп-слов и лишних символов:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult('resultlenght')}
	 </td>
    </tr>
    
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="295px">
	  Всего стоп-слов:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px"> 
	  {$tool_object->GetResult('stopwordscount')}
	 </td>
    </tr>
    
    {if $tool_object->GetResult('stopwordscount')}
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
     <td class="sth1" valign="center" align="left" width="250px">
	  Список стоп-слов:	    
	 </td>	 
	 <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	  <div>
	   <label style="color: #000000">[
	    <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElement(this, 'qstwords')">Показать</a>]
	   </label>
	  </div>
	  <div style="display: none; visibility: hidden; padding-top: 6px" id="qstwords">
	   {$tool_object->GetWordListByArray($tool_object->GetResult('stopwordslist'))}
	  </div>	  
	 </td>
    </tr>
    {/if}    
   
   </table>
   </span> 
   
   <div></div>   
   <div style="margin-top: 14px">
    <b style="color: #969696">Текст без тэгов и лишних символов</b>
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 96%">{$tool_object->GetResult('correctedsource')}</textarea>    
   </div>
   
   <div style="margin-top: 14px">
    <b style="color: #969696">Текст без повторов, стоп-слов, тэгов и лишних символов</b>
   </div>
   <div style="margin-top: 10px">
    <textarea class="int_text" style="height: 120px; width: 96%">{$tool_object->GetResult('textnostopwords')}</textarea>    
   </div>
          
  </div>  
  
 {/if}
 
 {/if} 
</div>