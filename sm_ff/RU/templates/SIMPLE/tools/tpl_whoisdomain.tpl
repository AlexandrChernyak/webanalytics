{* whois ip сайта *}
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="{$CONTROL_OBJ->GetToolImageStyle($tool_object->section_id, 128, '', '')}" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 {if $tool_object->GetToolLimitInfoEx('tdescr')}{$CONTROL_OBJ->GetText($tool_object->GetToolLimitInfoEx('tdescr'))}{else}
 Данный инструмент поможет Вам получить Whois контактных данных владельца указанного сайта.
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
	alert('Укажите хост сайта!');
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
  <div class="typelabel"><label id="red">*</label> Хост сайта <label class="prep_label_analisys">(пример: <a href="javascript:" onclick="DoSetDefUrl('url')">{$smarty.const.W_HOSTMYSITE}</a>)</label></div>
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
	{if $tool_object->GetResult('createddate') || $tool_object->GetResult('expdate') || $tool_object->GetResult('registrar') || $tool_object->GetResult('cachlastupdatedate') || $tool_object->GetResult('nofound')}
	{literal}
	<style type="text/css">
     .h_th1 { 
      border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; border-right: none; 
      border-right: none; font-weight: bold; 
     }
     .btn_n { border: 1px solid #E3E4E8; border-top: none; height: 25px; margin-top: 4px; }
     .sth1 { border-bottom: 1px solid #E3E4E8; height: 25px; border-top: none; }	
    </style> 
    <script type="text/javascript">
    function DoHigl(th, n) {	
     if (n) { $(th).css('background','#F9FAFB'); } else {   	
      $(th).css('background', 'none');		
     }	
    }//DoHigl	
    </script>
	{/literal}
	<div style="margin-bottom: 7px"><b>Информация о домене:</b></div>
	<span style="width: 100%">
	<table width="96%" cellpadding="0" cellspacing="0" border="0">
	 
	  {if $tool_object->GetResult('cachlastupdatedate')}
	  <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
       <td class="sth1" valign="center" align="left" width="200px" style="color: #333399">
	    Последнее обновление данных:	    
	   </td>	 
	   <td class="sth1" valign="center" align="left" style="padding-left: 8px; color: #333399"> 
	    {$CONTROL_OBJ->GetLastIntervalInDays($tool_object->GetResult('cachlastupdatedate'))} &nbsp;
	    ({$tool_object->GetResult('cachlastupdatedate')})
	   </td>
      </tr>
      {/if}
	 
	 
	 {if $tool_object->GetResult('registrar')}
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
      <td class="sth1" valign="center" align="left" width="200px">
	   Регистратор:	    
	  </td>	 
	  <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	   {$tool_object->GetResult('registrar')}
	  </td>
     </tr>
	 {/if}
	 
	 {if $tool_object->GetResult('nofound')}
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
      <td class="sth1" valign="center" align="left" width="200px">
	   <span style="color: #008000; font-weight: bold">Свободен</span>, купить в:	    
	  </td>	 
	  <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	   <noindex>
	    <a rel="nofollow" class="gotoregurl" href="http://seo-tools.forwebm.net/goto/5/{$tool_object->GetResult('nofound')}" target="_blank">reg.ru</a> <a class="gotoregurl" style="margin-left: 6px;" rel="nofollow" href="http://seo-tools.forwebm.net/goto/6" target="_blank">reggi.ru</a>
	   </noindex>	  
	  </td>
     </tr>
	 {/if}
	 
	 {if $tool_object->GetResult('createddate')}
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
      <td class="sth1" valign="center" align="left" width="200px">
	   Дата регистрации домена:	    
	  </td>	 
	  <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	   {$tool_object->GetResult('createddate')}
	  </td>
     </tr>
	 {/if}
	 
	 {if $tool_object->GetResult('domainold')}
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
      <td class="sth1" valign="center" align="left" width="200px">
	   Возраст домена:	    
	  </td>	 
	  <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	   {$tool_object->GetResult('domainold')}
	  </td>
     </tr>
	 {/if}
	 
	 {if $tool_object->GetResult('old_days')}
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
      <td class="sth1" valign="center" align="left" width="200px">
	   Возраст домена (дней):	    
	  </td>	 
	  <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	   {$tool_object->GetResult('old_days')}	  
	  </td>
     </tr>
	 {/if}
	 
	 {if $tool_object->GetResult('expdate')}
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
      <td class="sth1" valign="center" align="left" width="200px">
	   Регистрация домена истекает:	    
	  </td>	 
	  <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	   {$tool_object->GetResult('expdate')}	  
	  </td>
     </tr>
	 {/if}
	 	 
	 {if $tool_object->GetResult('pass')}
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">	 
      <td class="sth1" valign="center" align="left" width="200px">
	   Осталось до окончания (дней):	    
	  </td>	 
	  <td class="sth1" valign="center" align="left" style="padding-left: 8px">
	   {$tool_object->GetResult('pass')}
	  </td>
     </tr>
	 {/if}
	
	</table>	
	</span>	
	{/if}
	</div> 
    <div style="width: 630px; overflow: auto; margin-top: 18px">
     <pre>{$tool_object->GetResult('source')}</pre>    
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