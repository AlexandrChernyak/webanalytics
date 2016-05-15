{* информер pr cy *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент предоставляет Вам возможность создать информер параметров <b>Google PR</b> и <b>Яндекс ТиЦ</b> Вашего сайта. Выбрать подходящий Вам информер, сменить цвет информера, получать достоверную и свежую информацию о `основных` показателях Вашего сайта в любой момент времени.
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
 
 {if $smarty.post.doactiontool == 'do' && $smarty.post.actinp != 'select'}
 {literal}
 <script type="text/javascript">
  function GetInformCodeCheck(th) {	
   if (!th.selectedinformer.value) {
	alert('Выберите информер, который хотите использовать!');
	return false;
   }
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;
   return true;   	
  }//GetInformCodeCheck 	
 </script>
 {/literal}
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
 {/if}
 <form method="post" name="tollform" id="toolform" onsubmit="return {if $smarty.post.doactiontool == 'do' && $smarty.post.actinp != 'select'}GetInformCodeCheck{else}PrepereToSend{/if}(this)">
  
  <div class="typelabel"><label id="red">*</label> URL{if $smarty.post.doactiontool != 'do' || $smarty.post.actinp == 'select'}<label class="prep_label_analisys">(пример: <a href="javascript:" onclick="DoSetDefUrl('url')">{$smarty.const.W_HOSTMYSITE}</a>)</label>{/if}</div>
  <div class="typelabel">
   <input type="text" value="{$CONTROL_OBJ->GetPostElement('url', 'doactiontool')}" style="width: 98%" class="inpt" name="url" id="url" maxlength="198" {if $smarty.post.doactiontool == 'do' && $smarty.post.actinp != 'select'} readonly="readonly"{/if}>
  </div>  
  
  {if $smarty.post.doactiontool != 'do' || $smarty.post.actinp == 'select'}
  <div class="typelabel" style="margin-top: 12px">
   <input type="submit" value="&nbsp;Выбрать информер&nbsp;" class="button" name="rb" id="rb">
  </div>
  <input type="hidden" value="select" name="actinp"> 
  {/if}
  
  <input type="hidden" value="do" name="doactiontool">
    
  {if $smarty.post.doactiontool == 'do' && isset($tool_object)}
  
   {if $smarty.post.actinp == 'select' && $tool_object->error} 
    <div style="margin-top: 14px; margin-left: 4px; color: #FF0000">{$tool_object->error}</div>  
   {else}  
   
   {if $smarty.post.selectedinformer}
    {* код информера *}
    <div style="margin-top: 25px">
     <div class="typelabel">HTML код информера</div>
     
     <div class="typelabel">
	  {if !$tool_object->GetResult('newinf.iditem')}
	   <div style="color: #FF0000; margin-left: 4px">Ошибка регистрации информера!</div>	   
	  {else}
	  <textarea class="int_text" style="height: 100px; width: 95%"><!-- PR CY informer by {$smarty.const.W_HOSTMYSITE} begin -->
<a href="http://{$smarty.const.W_HOSTMYSITE}" target="_blank" title="Посетить {$smarty.const.W_HOSTMYSITE}"><img border="0" src="http://{$smarty.const.W_HOSTMYSITE}/informer-images/3/image-{$tool_object->GetResult('newinf.iditem')}.tif" alt="informer pr cy"></a>
<!-- PR CY informer by {$smarty.const.W_HOSTMYSITE} end --></textarea>
        
       
<div class="typelabel" style="margin-top: 6px">BB код для блога или форума</div>
	   <div class="typelabel">
	   <textarea class="int_text" style="height: 100px; width: 95%">[url=http://{$smarty.const.W_HOSTMYSITE}][img]http://{$smarty.const.W_HOSTMYSITE}/informer-images/3/image-{$tool_object->GetResult('newinf.iditem')}.tif[/img][/url]</textarea>
	   </div> 
	  
	   <div class="typelabel">Предварительный просмотр</div>
	   <div class="typelabel">
	   <!-- PR CY informer by {$smarty.const.W_HOSTMYSITE} begin -->
	   <a href="http://{$smarty.const.W_HOSTMYSITE}" target="_blank" title="Посетить {$smarty.const.W_HOSTMYSITE}"><img border="0" src="http://{$smarty.const.W_HOSTMYSITE}/informer-images/3/image-{$tool_object->GetResult('newinf.iditem')}.tif" alt="informer pr cy"></a>
	   <!-- PR CY informer by {$smarty.const.W_HOSTMYSITE} end -->
	   </div>
	  
	  {/if}
	  
	  <div class="typelabel" style="margin-top: 14px"><a href="{$smarty.const.W_SITEPATH}tools/{$tool_object->section_id}/">&lt;&lt; К началу</a></div>  
	 
	 </div>    
    </div>    
   {else}
    <div style="margin-top: 25px"> 
     {include file="tools/informers/tpl_informers_list.tpl"}
    </div>
    
    {if $tool_object->GetResult('infdata')}
    <div class="typelabel" style="margin-top: 17px">
     <input type="submit" value="&nbsp;Получить код информера&nbsp;" class="button" name="rb" id="rb">
    </div>
    {else}
     <div style="margin-top: 17px">Нет активных информеров!</div>
    {/if}
    
   {/if}
   
   {/if}	   
  {/if}
      
 </form>
 
 {/if} 
</div>