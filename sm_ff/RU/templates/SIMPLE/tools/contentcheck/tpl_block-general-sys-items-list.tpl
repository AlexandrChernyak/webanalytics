{* 
 $url_p - url
 
 вывод блока общих данных о странице\сайте
*}{if !$tool_object->IsAjax()}
{literal}
 <script type="text/javascript">
  var globalpatht = '{/literal}{$smarty.const.W_SITEPATH}{literal}';
  var toolpathitr = globalpatht + 'tools/{/literal}{$tool_object->section_id}{literal}/';
  var url_p = '{/literal}{$url_p}{literal}'; 
  var d_updates = '{/literal}{if $tool_object->IsUpdateResults()}1{else}0{/if}{literal}';
 
  function PrepereResultXML(data) { $('#gen-sys-info-block-data').html(data); }   
    
  $(document).ready(function() {
	 $('#gen-sys-info-block-data').html(
	  '<div class="typelabel">Подготовка данных..</div>' +
      '<div class="typelabel"><img src="'+globalpatht+'athemes/SIMPLE/img/ajax-loader.gif" border="0"></div>'
	 );	 
     SendDefaultRequest(toolpathitr, 'is_ajax_mode=1&spparams3=1&url='+url_p+'&dp='+d_updates, 'PrepereResultXML');	  
  });
      
 </script>
{/literal}

<div id="gen-sys-info-block-data">
  Поддержка JavaScript отключена!
</div>

{else}

 {* all data result of ajax action here  *}
 {if !$tool_object->GetResult('gensys1') && !$tool_object->GetResult('gensys2') && !$tool_object->GetResult('gensys3')}
 <div style="color: #FF0000">Нет данных для отображения! Проверьте доступность блока или источников!</div>
 {else}
 
  {if $tool_object->GetResult('gensys1')}   
    <div><strong>Общие данные показателей сайта ( <ins style="font-weight: normal">{$tool_object->GetResult('gensys1.host')}</ins> )</strong> (от solomono){if $tool_object->GetResult('gensys1.cacheddate')}<label style="margin-left: 6px; font-size: 85%">[последнее обновление: {$CONTROL_OBJ->GetLastIntervalInDays($tool_object->GetResult('gensys1.cacheddate'))} &nbsp; ({$tool_object->GetResult('gensys1.cacheddate')})]</label>{/if}</div>
    <div style="margin-top: 6px">
    
    <div><span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	    
        <td class="sth1" valign="top" align="left" style="padding-bottom: 3px">
		 <div class="typelabel">
         
		  <div class="typelabel">Всего зеркал домена: <strong>{$tool_object->GetResult('gensys1.mr')}</strong></div>	
          <div class="typelabel">Кол-во доменов на том же IP: <strong>{$tool_object->GetResult('gensys1.ip')}</strong></div>
          <div class="typelabel">Кол-во доменов, на которые ссылается сайт: <strong>{$tool_object->GetResult('gensys1.dout')}</strong></div>
          <div class="typelabel">Кол-во анкоров: <strong>{$tool_object->GetResult('gensys1.anchors')}</strong></div>
          <div class="typelabel">Кол-во исходящих анкоров: <strong>{$tool_object->GetResult('gensys1.anchors_out')}</strong></div>  
          
          <div class="typelabel">Кол-во iGood доноров: <strong>{$tool_object->GetResult('gensys1.igood')}</strong></div>
          
		 </div>		  
		</td>
        
	    <td class="sth1" valign="top" align="left">
         <div class="typelabel">
		  
          <div class="typelabel">Кол-во ссылок на домен: <strong>{$tool_object->GetResult('gensys1.hin')}</strong></div>
          {if $tool_object->GetResult('gensys1.hin-list2w')}
           <div style="padding-left: 4px; font-size: 95%">&rsaquo;&rsaquo; По уровню вложенности:  
           {foreach from=$tool_object->GetResult('gensys1.hin-list2w') key=uvname item=val name=val}
            <label>
            {if $smarty.foreach.val.index > 0}, {/if}Ув{$uvname}: <strong>{$val}</strong>
            </label>           
           {/foreach}           
           </div>
          {/if}                  
          
          <div class="typelabel">Кол-во доноров: <strong>{$tool_object->GetResult('gensys1.din')}</strong></div>
          {if $tool_object->GetResult('gensys1.din-list2w')}
           <div style="padding-left: 4px; font-size: 95%">&rsaquo;&rsaquo; По уровню вложенности:  
           {foreach from=$tool_object->GetResult('gensys1.din-list2w') key=uvname item=val name=val}
            <label>
            {if $smarty.foreach.val.index > 0}, {/if}Ув{$uvname}: <strong>{$val}</strong>
            </label>           
           {/foreach}           
           </div>
          {/if}
                    
          <div class="typelabel">Исходящие (внешние) ссылки домена: <strong>{$tool_object->GetResult('gensys1.hout')}</strong></div>
          {if $tool_object->GetResult('gensys1.hout-list2w')}
           <div style="padding-left: 4px; font-size: 95%">&rsaquo;&rsaquo; По уровню вложенности:  
           {foreach from=$tool_object->GetResult('gensys1.hout-list2w') key=uvname item=val name=val}
            <label>
            {if $smarty.foreach.val.index > 0}, {/if}Ув{$uvname}: <strong>{$val}</strong>
            </label>           
           {/foreach}           
           </div>
          {/if}          
          
          
		 </div>
		</td>
        
       </tr>
      </table>
	 </span></div>
    
    </div>   
  {/if}  
  
  
  {if $tool_object->GetResult('gensys3')}
    <div{if $tool_object->GetResult('gensys1')} style="margin-top: 15px"{/if}><strong>Общие данные показателей сайта ( <ins style="font-weight: normal">{$tool_object->GetResult('gensys3.Item')}</ins> )</strong> (от majesticseo){if $tool_object->GetResult('gensys3.cacheddate')}<label style="margin-left: 6px; font-size: 85%">[последнее обновление: {$CONTROL_OBJ->GetLastIntervalInDays($tool_object->GetResult('gensys3.cacheddate'))} &nbsp; ({$tool_object->GetResult('gensys3.cacheddate')})]</label>{/if}</div>
    <div style="margin-top: 6px">
    
    <div><span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	    
        <td class="sth1" valign="top" align="left" style="padding-bottom: 3px">
		 <div class="typelabel">
         
		  <div class="typelabel">Количество обратных ссылок: <strong>{$tool_object->GetResult('gensys3.ExtBackLinks')}</strong></div>
          
          <div class="typelabel">Количество ссылающихся доменов: <strong>{$tool_object->GetResult('gensys3.RefDomains')}</strong></div>  
          
          <div class="typelabel">Ссылается IP адресов: <strong>{$tool_object->GetResult('gensys3.RefIPs')}</strong></div>
          
		 </div>		  
		</td>
        
	    <td class="sth1" valign="top" align="left">
         <div class="typelabel">
		  
          <div class="typelabel">Проиндексировано majesticseo: <strong>{$tool_object->GetResult('gensys3.IndexedURLs')}</strong></div>
              
          <div class="typelabel">Подсети: <strong>{$tool_object->GetResult('gensys3.RefSubNets')}</strong></div>         
                       
		 </div>
		</td>
        
       </tr>
      </table>
	 </span></div>
    
    </div>     
  {/if}
  
 
  {if $tool_object->GetResult('gensys2')}
    <div{if $tool_object->GetResult('gensys1') || $tool_object->GetResult('gensys3')} style="margin-top: 15px"{/if}><strong>Общие данные статистики анализа страницы</strong>{if $tool_object->GetResult('gensys2.cacheddate')}<label style="margin-left: 6px; font-size: 85%">[последнее обновление: {$CONTROL_OBJ->GetLastIntervalInDays($tool_object->GetResult('gensys2.cacheddate'))} &nbsp; ({$tool_object->GetResult('gensys2.cacheddate')})]</label>{/if}</div>
    <div style="margin-top: 6px">
    
    <div><span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	    
        <td class="sth1" valign="top" align="left" style="padding-bottom: 3px">
		 <div class="typelabel">
         
		  <div class="typelabel">Общий процент скорости загрузки страницы: <strong style="color: #008000">{$tool_object->GetResult('gensys2.score')}%</strong></div>
          
          <div class="typelabel">Страница подключает ресурсов: <strong>{$tool_object->GetResult('gensys2.numberResources')}</strong>, хостов: <strong>{$tool_object->GetResult('gensys2.numberHosts')}</strong></div>
          
          <div class="typelabel">Общий размер запроса: <strong>{$CONTROL_OBJ->GetStrSizeFromBytes($tool_object->GetResult('gensys2.totalRequestBytes'))}</strong></div>
          	
          <div class="typelabel">Размер html кода страницы: <strong>{$CONTROL_OBJ->GetStrSizeFromBytes($tool_object->GetResult('gensys2.htmlResponseBytes'))}</strong></div>
          
          <div class="typelabel">Общий размер изображений на странице: <strong>{$CONTROL_OBJ->GetStrSizeFromBytes($tool_object->GetResult('gensys2.imageResponseBytes'))}</strong></div>         
          
          
		 </div>		  
		</td>
        
	    <td class="sth1" valign="top" align="left">
         <div class="typelabel">
		  
          <div class="typelabel">Всего CSS файлов подключено: <strong>{$tool_object->GetResult('gensys2.numberCssResources')}</strong>, общим размером: <strong>{$CONTROL_OBJ->GetStrSizeFromBytes($tool_object->GetResult('gensys2.cssResponseBytes'))}</strong></div>
          
          <div class="typelabel">Всего JavaScript файлов подключено: <strong>{$tool_object->GetResult('gensys2.numberJsResources')}</strong>, общим размером: <strong>{$CONTROL_OBJ->GetStrSizeFromBytes($tool_object->GetResult('gensys2.javascriptResponseBytes'))}</strong></div>
          
          <div class="typelabel">Размер остальных ресурсов: <strong>{$CONTROL_OBJ->GetStrSizeFromBytes($tool_object->GetResult('gensys2.otherResponseBytes'))}</strong></div>          
                      
		 </div>
		</td>
        
       </tr>
      </table>
	 </span></div>
    
    </div>     
  {/if}
 
 {/if}

{/if}