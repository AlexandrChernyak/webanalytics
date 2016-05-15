{* добавление строки в таблицу *}	 
<tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
 <td class="sth1" valign="center" align="left" style="border-left: 1px solid #E3E4E8{if $tool_object->GetCurrentIndex() > 1}; border-top: 1px solid #C9D5FC{/if}">
  <label style="margin-left: 4px">
  <div style="margin: 4px">
   <div><a href="http://{$tool_object->GetResultValue('link')}" target="_blank">{$tool_object->CorrectURLLink($tool_object->GetResultValue('link'), 50)}</a></div>  
  {if $tool_object->GetResultValue('result')}
  <div style="margin-top: 4px">
  Код ответа: {$tool_object->GetResultValue('httpcode')}, Время: {$tool_object->GetResultValue('time')} сек.  
  </div>
  <div style="margin-top: 4px">
   {if $tool_object->GetResultValue('pnoindex')}
    <div class="typelabel" style="color: #FF0000">
	Страница запрещена к индексации в мета-тэге <b>robots</b> (noindex)
	</div>
    {if $tool_object->GetResultValue('pnofollow')}
     <div class="typelabel" style="color: #FF0000">
	 Страница запрещена к обходу по ссылкам в мета-тэге <b>robots</b> (nofollow)
	 </div>
    {/if}    
   {else}
   
    {if $tool_object->CheckPostValue('norobotsf') && $tool_object->GetResultValue('pnofollow')}
     <div class="typelabel" style="color: #FF0000">
	 Страница запрещена к обходу по ссылкам в мета-тэге <b>robots</b> (nofollow)
	 </div>
    {/if}
    
    {if $tool_object->CheckPostValue('nonoindex') && $tool_object->GetResultValue('noindex')}
     <div class="typelabel" style="color: #FF0000">
	 Ссылка располагается в тэге <b>&lt;noindex&gt;</b>
	 </div>
    {/if}
	 
	{if $tool_object->CheckPostValue('nonofollow') && $tool_object->GetResultValue('nofollow')}
     <div class="typelabel" style="color: #FF0000">
	 Следование по ссылке запрещено в параметре <b>rel</b> (nofollow)
	 </div>
    {/if} 
    
    {if $smarty.post.txt && $tool_object->GetResultValue('textnomatch')}
     <div class="typelabel" style="color: #FF0000">
	 Текст ссылки, на странице не соответствует указанному шаблону.
	 </div>
    {/if}
    
    {if $tool_object->GetResultValue('set')}
     <div class="typelabel" style="color: #008000">Ссылка найдена на странице</div>
    {else}
     <div class="typelabel" style="color: #FF0000">Ссылка не найдена</div>
    {/if}
   
   {/if}  
  </div> 
  {/if}
  {if $tool_object->GetResultValue('error')}
  <div style="color: #FF0000; margin-top: 4px">{$tool_object->GetResultValue('error')}</div>
  {/if}
  </div>   
  </label>	    
 </td>
 <td class="sth1" valign="center" align="left" width="100px" style="border-right: 1px solid #E3E4E8{if $tool_object->GetCurrentIndex() > 1}; border-top: 1px solid #C9D5FC{/if}">
  <label style="margin-left: 4px">
   {if !$tool_object->GetResultValue('set')}
    <b>{if $tool_object->GetResultValue('pnoindex')}?{else}Нет{/if}</b>
   {else}
    <b style="color: #008000">Есть</b>
   {/if}   	  
  </label>
 </td>
</tr>
{literal}
<script type="text/javascript">
 $(function() {	$("#tableresultsourceid").tablesorter(); });	
</script>
{/literal}