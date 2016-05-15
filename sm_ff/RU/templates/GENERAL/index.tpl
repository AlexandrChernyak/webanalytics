<!-- analisys begin -->
  <div>
  {literal}
  <script type="text/javascript">
   function PrepereActionQuickAnalisys(th) {
	if (!th.url.value || th.url.value == 'http://') {
	 alert('Укажите сайт для анализа!');
	 th.url.focus();
	 return false;	
	}	
	return true;
   }	
  </script>
  {/literal}
  <form method="post" name="qanalisys" id="qanalisys" action="{$smarty.const.W_SITEPATH}tools/analysis/" onsubmit="return PrepereActionQuickAnalisys(this)">
  <div>
  <span style="width: 100%">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
	<td class="qanalisys_label" align="left" valign="center">
	 Анализ сайта
	</td>
	<td align="left" valign="center">
	 <input type="text" class="inpt" style="width: 100%" name="url" id="url" value="http://">
	</td>
	<td align="right" valign="center" width="90px">
	 <input type="submit" class="butt" value="Отправить" style="width: 80px"> 
	</td>
  </tr>
  </table>
  </span>
  </div>
  
  <div>
  <span style="width: 100%">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
	<td width="110px" height="20px"></td>
	<td valign="top" height="20px">
	<span class="prep_label_analisys">
	 Например: <a href="javascript:" onclick="$('#url').val('{$smarty.const.W_HOSTMYSITE}');">{$smarty.const.W_HOSTMYSITE}</a>
	</span>
	</td>
	<td width="90px" height="20px"></td>
  </tr>
  </table>
  </span>
  </div>
  <input type="hidden" value="do" name="doactiontool">
  </form>
  </div>
  <!-- analisys end -->
  
  <!-- vitrina begin, first block begin -->
  <div style="margin-top: 30px">
   <span style="width: 100%"> 
   <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
	<td valign="top" align="left">
	 
	 <!-- featured tools list BEGIN --> 
   <div class="apdates_title">
    <a href="{$smarty.const.W_SITEPATH}tools/" class="upd_title">Наиболее популярные инструменты</a>
   </div>
   {if !$CONTROL_OBJ->GetFeaturedToolsList()}
    <div style="margin-left: 5px; margin-top: 5px">Нет активных инструментов</div>
   {else}
    <div style="margin-left: 5px">
     <span style="width: 100%">
     <table width="100%" cellpadding="0" cellspacing="0" border="0">
     {foreach from=$CONTROL_OBJ->GetFeaturedToolsList() item=val name=val}
      <tr>
      
      <td valign="top" align="center" width="22px">
	   <div style="margin-top: 5px">
	    <img src="{$CONTROL_OBJ->GetToolImageStyle($val.tident, 16, '', '')}" width="16" height="16">    
	   </div>
	  </td>
    
      <td valign="top" align="left" style="padding-left: 2px">
       <div style="margin-top: 5px">   
	    <a href="{$smarty.const.W_SITEPATH}tools/{$val.tident}/">{$CONTROL_OBJ->GetText($val.tdescript)}</a>	    
	   </div>	  
	  </td>
	  
	  </tr>    
     {/foreach}   
     </table>
     </span>
	</div>   
   {/if}
   <!-- featured tools list END -->
   
	</td>
	<td valign="top" align="left" width="280px">
     {include file="items/links_vitrina_block.tpl"}	
	</td>
   </tr>
   </table>    
   </span>
  </div>  
  <!-- vitrina end, first block end -->
  
  <!-- last added datas begin -->
  <div style="margin-top: 26px">
   
   <!-- last news block begin -->
   <div class="apdates_title"><a href="{$smarty.const.W_SITEPATH}news/1/" class="upd_title">Новости сайта</a></div>
   <div style="margin-top: 4px">
   {include file="items/last_news_block.tpl" newstype='1' limit='10' fontsize='100%' fontsizeallnews='95%' fulldate='1'}
   </div>   
   <!-- last news block end -->
   
   
   
   
  </div>
  <!-- last added datas end -->