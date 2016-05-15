{* информер апдейтов *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент предоставляет Вам возможность создать информер дат последних апдейтов поисковых машин для Вашего сайта, или подписи на форуме (блоге).
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
 
 {if $smarty.post.doactiontool == 'do'}
 {literal}
 <script type="text/javascript">
  function GetInformCodeCheck(th) {	
   if (!th.selectedinformer.value) {
	alert('Выберите информер, который хотите использовать!');
	return false;
   }
   return true;   	
  }//GetInformCodeCheck 	
 </script>
 {/literal}
 {/if}
 <form method="post" name="tollform" id="toolform"{if $smarty.post.doactiontool == 'do'} onsubmit="return GetInformCodeCheck(this)"{/if}>
  
  <div class="typelabel" style="margin-top: 13px"> 
   <div><strong>Текущие даты апдейтов поисковых машин:</strong></div>
   
   <div style="padding: 10px 1px 6px 2px">
   {include file="items/updates_block.tpl" widthdiv="300px"}
   </div> 
   
  </div> 
  
  {if $smarty.post.doactiontool != 'do'}
  <div class="typelabel" style="margin-top: 12px">
   <input type="submit" value="&nbsp;Выбрать информер&nbsp;" class="button" name="rb" id="rb">
  </div> 
  {/if}
  
  <input type="hidden" value="do" name="doactiontool">
    
  {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
   {if $smarty.post.selectedinformer}
    {* код информера *}
    <div style="margin-top: 25px">
     <div class="typelabel">HTML код информера</div>
     
     <div class="typelabel">
	  {if !$tool_object->GetResult('newinf.iditem')}
	   <div style="color: #FF0000; margin-left: 4px">Ошибка регистрации информера!</div>	   
	  {else}
	  <textarea class="int_text" style="height: 100px; width: 95%"><!-- Updates informer by {$smarty.const.W_HOSTMYSITE} begin -->
<a href="http://{$smarty.const.W_HOSTMYSITE}" target="_blank" title="Посетить {$smarty.const.W_HOSTMYSITE}"><img border="0" src="http://{$smarty.const.W_HOSTMYSITE}/informer-images/4/image-{$tool_object->GetResult('newinf.iditem')}.tif" alt="Updates informer"></a>
<!-- Updates informer by {$smarty.const.W_HOSTMYSITE} end --></textarea>
        
       <div class="typelabel" style="margin-top: 6px">BB код для блога или форума</div>
	   <div class="typelabel">
	   <textarea class="int_text" style="height: 100px; width: 95%">[url=http://{$smarty.const.W_HOSTMYSITE}][img]http://{$smarty.const.W_HOSTMYSITE}/informer-images/4/image-{$tool_object->GetResult('newinf.iditem')}.tif[/img][/url]</textarea>
	   </div> 
	  
	   <div class="typelabel">Предварительный просмотр</div>
	   <div class="typelabel">
	   <!-- Updates informer by {$smarty.const.W_HOSTMYSITE} begin -->
	   <a href="http://{$smarty.const.W_HOSTMYSITE}" target="_blank" title="Посетить {$smarty.const.W_HOSTMYSITE}"><img border="0" src="http://{$smarty.const.W_HOSTMYSITE}/informer-images/4/image-{$tool_object->GetResult('newinf.iditem')}.tif" alt="Updates informer"></a>
	   <!-- Updates informer by {$smarty.const.W_HOSTMYSITE} end -->
	   </div>
	  
	  {/if}
	  
	  <div class="typelabel" style="margin-top: 14px"><a href="{$smarty.const.W_SITEPATH}tools/{$tool_object->section_id}/">&lt;&lt; К началу</a></div>  
	 
	 </div>    
    </div>    
   {else}
    <div style="margin-top: 25px"> 
     {include file="tools/informers/tpl_informers_list.tpl"}
    </div>
  
    <div class="typelabel" style="margin-top: 17px">
     <input type="submit" value="&nbsp;Получить код информера&nbsp;" class="button" name="rb" id="rb">
    </div>
   {/if}	   
  {/if}
      
 </form> 
 
 {/if}
</div>