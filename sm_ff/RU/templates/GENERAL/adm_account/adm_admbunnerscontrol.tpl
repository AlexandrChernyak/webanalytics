{* управление баннерами сайта *}

 {literal}
 <style type="text/css">
  .line_item { border-bottom: 1px solid #EBEBEB; height: 22px; }
 </style>
 <script type="text/javascript">
  function DoHigl3(th, n) {	
   if (n) { $(th).css('background','#F9FAFB'); } else {   	
    $(th).css('background', 'none');		
   }	
  }//DoHigl	
  function DoHigl4(th, n) {	
   if (n) { $(th).css('background','#DDE0E7'); } else {   	
    $(th).css('background', 'none');		
   }	
  }//DoHigl
 </script>
 {/literal}

{if $smarty.get.group}
 {* управление баннерами *}

 <div style="margin: 7px 1px 12px 1px">
 <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?group={$smarty.get.group}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}{if $smarty.get.grouppage}&grouppage={$smarty.get.grouppage}{/if}&shorttype={$smarty.get.shorttype}">Все баннеры блока (<label style="color: #000000">{$adm_object->GetResult('bcount')}</label>)</a> 
 
 <label style="padding-left: 10px"><a href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/{if $smarty.get.grouppage}?page={$smarty.get.grouppage}{/if}"> << Вернуться к местам (блокам) (<label style="color: #000000">{$adm_object->GetResult('gcount')}</label>)</a></label>
 
 <label style="padding-left: 10px">
  Статусы: <a title="Все статусы баннеров" href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?group={$smarty.get.group}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}{if $smarty.get.grouppage}&grouppage={$smarty.get.grouppage}{/if}{if $smarty.get.onlyuser}&onlyuser={$smarty.get.onlyuser}{/if}">Все</a>, 
  <a title="Активные баннеры" href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?group={$smarty.get.group}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}{if $smarty.get.grouppage}&grouppage={$smarty.get.grouppage}{/if}&shorttype=1{if $smarty.get.onlyuser}&onlyuser={$smarty.get.onlyuser}{/if}" style="background: #D5F0DF;">OK</a>,
  <a title="Ожидающие проверки администратором" href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?group={$smarty.get.group}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}{if $smarty.get.grouppage}&grouppage={$smarty.get.grouppage}{/if}&shorttype=2{if $smarty.get.onlyuser}&onlyuser={$smarty.get.onlyuser}{/if}" style="background: #F7DCDC;">CHECK</a>, 
  <a title="Ожидающие оплаты" href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?group={$smarty.get.group}{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}{if $smarty.get.grouppage}&grouppage={$smarty.get.grouppage}{/if}&shorttype=3{if $smarty.get.onlyuser}&onlyuser={$smarty.get.onlyuser}{/if}" style="background: #E8E5C2;">WAIT</a>,  
 </label>
   
 </div>
  
{* список баннеров *}
  
{literal}
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = {/literal}{if !$adm_object->GetResult('bcount')}0{else}1{/if};{literal}  
 function DoHigl(th, n, p) {	
  if (n) {	$(th).css('background','#F8F5F1'); } else {
   var ch = document.getElementById('chid'+p);
   var color = (ch && ch.checked) ? '#E7DDD1' : 'none';   	
   $(th).css('background', color);		
  }	
 }//DoHigl
 function CheckItem(itemid, th) {
  th = (th) ? th : document.getElementById('chid'+itemid);   
  if (th && th.checked) { $('#t_r_'+itemid).css('background','#E7DDD1'); } else {
  $('#t_r_'+itemid).css('background','none');
  }
  SetEnabled();   	
 }//CheckItem
 function CheckAll(th) {	
  for (var i=0; i < list_items.length; i++) {
   var ch = $('#chid'+list_items[i]);
   ch.attr('checked', (th.checked) ? 'checked' : '');
   if (th.checked) { $('#t_r_'+list_items[i]).css('background','#E7DDD1'); } else {
   $('#t_r_'+list_items[i]).css('background','none');	
  }	  	    	
  }
  SetEnabled();	
 }//CheckAll
 function GetSelCount() {
  var inccount = 0;
  for (var i=0; i < list_items.length; i++) {
   var ch = document.getElementById('chid'+list_items[i]);
   if (ch && ch.checked) { inccount++; }		
  }	
  return inccount;	
 }//GetSelCount 
 function PrepereSend(th) {
  var count = GetSelCount();
  if (count <= 0 && th.actionlistmakes.value != 'all' && th.actionlistmakes.value != 'dall') { 
   alert('Выделите хотя бы один баннер!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == 'delete') {
   if (!confirm('Вы действительно хотите удалить ['+count+'] баннеров?')) { return false; }
  } else 
  if (th.actionlistmakes.value == 'enabled') {
   if (!confirm('Вы действительно хотите подтвердить ['+count+'] баннеров?')) { return false; }
  } else
  if (th.actionlistmakes.value == 'disabled') {
   if (!confirm('Вы действительно хотите отменить подтверждение ['+count+'] баннеров?')) { return false; }
  } else  
  if (th.actionlistmakes.value == 'dall') {
   if (!allsaveenabled) { alert('Нет данных для удаления!'); return false; }	
   if (!confirm('Вы действительно хотите удалить все баннеры?')) { return false; }	
  }
  else { alert('Неизвестный идентификатор операции!'); return false; }
  return true;   	
 }//PrepereSend
 function SetEnabled() {  	
  var count = GetSelCount();
  setElementOpacity(document.getElementById('adid'), (allsaveenabled) ? 1 : 0.3);
  if (count <= 0) {
   setElementOpacity(document.getElementById('did'), 0.3);
   setElementOpacity(document.getElementById('ena'), 0.3);
   setElementOpacity(document.getElementById('dna'), 0.3);
   return ;	 
  }
  setElementOpacity(document.getElementById('did'), 1);
  setElementOpacity(document.getElementById('ena'), 1);
  setElementOpacity(document.getElementById('dna'), 1);
 }//SetEnabled
 function SetActionP(a) {
  var f = document.getElementById('vnewsform');
  if (!f) { return ; }
  f.actionlistmakes.value = a;   	
 }//SetActionP   	
 function SetCheckByLine(ident) {
  var ch = $('#chid'+ident);
  ch.attr('checked', (ch.attr('checked')) ? false : true);
  CheckItem(ident);   	
 }//SetCheckByLine
</script>
 <style type="text/css">
  .h_th1, .h_td, .h_td2 { 
   border: 1px solid #E4D9CB; background: #EEE7DF; height: 25px; border-bottom: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E4D9CB; border-left: none; }
  .btn_n { border: 1px solid #E4D9CB; border-top: none; height: 25px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E4D9CB; height: 25px; border-top: none; }	
 </style>
{/literal}  
  
<form method="post" name="vnewsform" id="vnewsform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Удалить все баннеры&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 200px;">
 </span>
 
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Подтвердить&nbsp;" class="activatelistit" name="ena" id="ena" onclick="SetActionP('enabled')" style="//width: 80px;">
 </span>

 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Отмена подтверждения&nbsp;" class="deactivatelistit" name="dna" id="dna" onclick="SetActionP('disabled')" style="//width: 100px;">
 </span>
  
 </div>
 <div style="margin-top: 6px">
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <td class="h_th1" valign="center" align="left" width="20px">
	 <span style="margin-left: 4px">
	  <input type="checkbox" name="checkallitems" id="checkallitems" style="cursor: pointer" onclick="CheckAll(this)">
	 </span>
	</td>
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Баннер</span></td>
	<td class="h_td2" valign="center" align="center" width="130px">Дата</td>
   </tr>	
   {literal}
   <style type="text/css">
	.llw { display: inline-block; margin-left: 8px; vertical-align: baseline; padding-left: 20px; }
   </style>
   {/literal}
   {if $adm_object->GetResult('data.source') && $adm_object->GetResult('group')}
	{foreach from=$adm_object->GetResult('data.source') item=val name=val}
	 <tr onmouseover="DoHigl(this, 1, {$smarty.foreach.val.index})" onmouseout="DoHigl(this, 0, {$smarty.foreach.val.index})" id="t_r_{$smarty.foreach.val.index}">
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8; background: {if !$val.activeobj}#F7DCDC{elseif !$val.ispayed}#E8E5C2{else}#D5F0DF{/if}">
	  <span style="margin-left: 4px">
	   <input type="checkbox" name="chid{$smarty.foreach.val.index}" id="chid{$smarty.foreach.val.index}" 
	   style="cursor: pointer" onclick="CheckItem('{$smarty.foreach.val.index}', this)">
	  </span>
	 </td>
	 	 
	 
	 <td class="sth1" valign="center" align="left" onclick="SetCheckByLine('{$smarty.foreach.val.index}')" style="padding: 3px">
	  
     <div style="padding-right: 3px">
       {* banner image *}
       {if $val.isflashobj}      
       <div id="flsource{$val.iditem}">    
        <object  classid="clsid27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="{$val.widthobj}{if $val.groupinfo.widthpersent}%{/if}" height="{$val.heightobj}{if $val.groupinfo.heightpersent}%{/if}" id="refbunner{$val.iditem}" align="middle">
         <param name="allowScriptAccess" value="always" />
         <param name="allowFullScreen" value="false" />
         <param name="movie" value="{$val.webimagefile}" />
         <param name="quality" value="high" />
         <embed src="{$val.webimagefile}" quality="high" bgcolor="#ffffff" width="100%" height="{$val.heightobj}{if $val.groupinfo.heightpersent}%{/if}" name="refbunner{$val.iditem}" id="refbunner{$val.iditem}" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer"/>
        </object>
       </div>
       {else}     
       <img src="{$val.webimagefile}" border="0" alt="Banner" width="{$val.widthobj}{if $val.groupinfo.widthpersent}%{/if}" height="{$val.heightobj}{if $val.groupinfo.heightpersent}%{/if}" />       	  
       {/if}       
      </div>
      
      <div style="margin-top: 4px">
      <span style="width: 100%">            
       <table width="100%" cellpadding="0" cellspacing="0" border="0">	        

         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Ссылка	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       <a href="{$val.hrefdata}" target="_blank">{$val.hrefdata}</a>
	      </td>
	     </tr>
         
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Разместил	           
          </td>
	      <td valign="center" align="left" class="line_item">
	      <a target="_blank" href="{$smarty.const.W_SITEPATH}account/admuserslisten/&filter1=9&lcstr={$val.username}">{$val.username}</a>{if $smarty.get.onlyuser != $val.userid}, <a href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?group={$val.groupid}&onlyuser={$val.userid}&shorttype={$smarty.get.shorttype}" style="font-size: 95%; margin-left: 4px">все баннеры пользователя</a>{/if}
	      </td>
	     </tr>
                     
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Показов	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       всего: {$val.lookcount}, сегодня: {$val.looktoday}
	      </td>
	     </tr>
         
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Кликов по баннеру	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       всего: {$val.visitcount}, сегодня: {$val.visittoday}
	      </td>
	     </tr>
         {*
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           CTR	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       {$adm_object->GetCTR($val)}
	      </td>
	     </tr>
         *}
         {if $val.setbytype == 1}
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Показан дней	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       {$val.lookdcount}
	      </td>
	     </tr>  
         
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Осталось дней	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       <label id="totalcount{$val.iditem}">{math equation="x - y" x=$val.fordays y=$val.lookdcount}</label>       
	      </td>
	     </tr>   
                      
         {elseif $val.setbytype == 0}
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Осталось показов	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       <label id="totalcount{$val.iditem}">{math equation="x - y" x=$val.forlooks y=$val.lookcount}</label>            
	      </td>
	     </tr>                
         {/if}
         
         {if $val.sizeobj}
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Размер файла баннера	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       {$CONTROL_OBJ->GetStrSizeFromBytes($val.sizeobj)}
	      </td>
	     </tr>         
         {/if}         
         
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" {if !$val.groupinfo.clearonoffbun || !$val.forpayislast}height="22px"{else}class="line_item"{/if}>
           Статус	           
          </td>
	      <td valign="center" align="left" {if !$val.groupinfo.clearonoffbun || !$val.forpayislast}height="22px"{else}class="line_item"{/if}>
	       {if !$val.activeobj}
           <em style="color: #993300">Ожидает проверки администратором</em>
           {elseif !$val.ispayed}
           <em style="color: #333399">Ожидает оплаты</em>
           {else}
           <em style="color: #0000FF">Оплачен, показ баннера активен</em>
           {/if}
	      </td>
	     </tr>
         
         {if $val.groupinfo.clearonoffbun && $val.forpayislast}
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" height="22px">
           Срок на оплату	           
          </td>
	      <td valign="center" align="left" height="22px">
	       {$val.forpayislast}
	      </td>
	     </tr>        
         {/if}

	   </table>                  
      </span>
      </div>  
      	  	 
	 </td> 
	 
	 <td class="sth1" valign="center" align="center" width="130px" style="border-right: 1px solid #E3E4E8;" 
	 onclick="SetCheckByLine('{$smarty.foreach.val.index}')">
	 {$val.datecreate}
	 </td>
	 
    </tr>  
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.iditem}" name="idm{$smarty.foreach.val.index}">
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="3">
     На этом месте нет баннеров!
     <script type="text/javascript">
	  document.getElementById('checkallitems').disabled = true;
     </script>
    </td>
   </tr> 
   {/if} 
 </table>
 {if $adm_object->GetResult('data.source')}
 <div style="text-align: right; margin-top: 10px">{$adm_object->GetResult('data.pagestext')}</div>
 {/if} 
 </span>
 </div> 
 <input type="hidden" value="0" name="actioncountmess">
 <input type="hidden" value="none" name="actionlistmakes"> 
</form>
<script type="text/javascript">SetEnabled();</script>   
 
{else}
 {* управление группами (местами) баннеров *}
 <div style="margin: 7px 1px 12px 1px">
 <a href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?new=1{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}"{if $smarty.get.new && !$adm_object->GetResult('modifyinfo')} style="color: #000000"{/if}>Добавить место</a> | <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/{if $smarty.get.oldpage}?page={$smarty.get.oldpage}{/if}">Все места баннеров (<label style="color: #000000">{$adm_object->GetResult('gcount')}</label>)</a>   
 </div>
 
 {if !$smarty.get.new}
  {* управление списком разделов, просмотр, выбор *}
  
  {if !$adm_object->GetResult('data.source')}
   <div style="text-align: center; padding: 6px; margin-top: 25px"><b>Нет активных мест!</b></div>
  {else}
   {literal}
    <script type="text/javascript">
	 function DeleteSelectedElementSection(ident) {
	  if (!confirm("Вы действительно хотите удалить выбранное место? Все баннеры, размещенные в данном месте будет удалены!\r\nПродолжить?")) {
	   return false;	
	  }	
	  var ppf = {/literal}'{$smarty.const.W_SITEPATH}account/admbunnerscontrol/{if $smarty.get.page}?page={$smarty.get.page}{/if}'{literal};  
	  document.location = ppf + '&qdelete=' + ident;  
	 }
   </script>
   {/literal}
   {foreach from=$adm_object->GetResult('data.source') item=val name=val}
    <div style="margin: 4px; margin-top: 15px; padding: 4px; border: 1px solid #D2D2D2">
	 <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
       <tr>
       
        <td valign="top" align="left" width="50px" style="padding-right: 4px">
		 <img src="{$smarty.const.W_SITEPATH}img/ico/general/places_visited.png" border="0">
		</td>	
		
	    <td valign="top" align="left">
		 <div><a title="Просмотр баннеров блока" href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?group={$val.iditem}{if $smarty.get.page}&grouppage={$smarty.get.page}{/if}"><strong>{$val.groupname}</strong></a><label style="margin-left: 6px; font-size: 95%; color: #333399"><i>(баннеров: {$adm_object->GetBunnersCount($val.iditem)})</i></label></div>
		 <div style="margin-top: 4px;">
		  
          <div>
          <span style="width: 100%">
           <table width="100%" cellpadding="0" cellspacing="0" border="0">
	        <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              Статус	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          {if $val.groupactive}
               <label style="color: #0000FF">Работает</label>
              {else}
               <em>(не работает)</em>
              {/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              Файлы баннеров	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          {if $val.filesuse}
               <label style="color: #008000">Да</label>
              {else}
               <em>(нет)</em>
              {/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              Ссылки баннеров	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          {if $val.linksuse}
               <label style="color: #008000">Да</label>
              {else}
               <em>(нет)</em>
              {/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              Flash баннеры	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          {if $val.useflash}
               <label style="color: #008000">Да</label>
              {else}
               <em>(нет)</em>
              {/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              Модерация баннеров	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          {if $val.usemoder}
               <label style="color: #008000">Да</label>
              {else}
               <em>(нет)</em>
              {/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              Размеры	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          Ширина: {$val.groupwidth}{if $val.widthpersent}%{else}px{/if}, Высота: {$val.groupheight}{if $val.heightpersent}%{else}px{/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              За 1000 показов	           
             </td>
	         <td valign="center" align="left" class="line_item">
	           {if $val.pricetolook > 0}
                <label style="color: #008000">{$val.pricetolook} USD</label>
               {else}
                <em>(не используется)</em>
               {/if} 
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              За 1 день показов	           
             </td>
	         <td valign="center" align="left" class="line_item">
	           {if $val.pricetodays > 0}
                <label style="color: #008000">{$val.pricetodays} USD</label>
               {else}
                <em>(не используется)</em>
               {/if} 
	         </td>
	        </tr>

	       </table>       
          </span>         
          </div>
          <div style="margin-top: 10px">
          <div style="color: #646464">Для вывода баннеров используйте код:</div>
          <textarea style="width: 95%; height: 100px; background: transparent; border: 1px solid transparent" readonly="readonly">Если необходимо вывести в нужном месте шаблона место баннеров, используйте конструкцию:

{literal}{$CONTROL_OBJ->GetBannerPlaceByID({/literal}{$val.iditem}{literal})}{/literal}

----------------------
Для того, чтобы проверить - будет ли место баннеров отображаться или нет, используйте конструкцию типа:

{literal}{assign var="bannerplacetemplate" value=$CONTROL_OBJ->GetBannerPlaceByID({/literal}{$val.iditem}{literal})}
{if $bannerplacetemplate}
 {* показываем место баннеров *}
 {$bannerplacetemplate}
{else}
 {* в данной группе нет баннеров, или группы не существует - место не будет отображаться..
    вместо места баннеров можно вывести например предложение добавить баннер и т.д
 *}
{/if}{/literal}</textarea>
          
          
          </div>
                   
		 </div>
		</td>
		
	    <td valign="top" align="right">
		 <div style="white-space: nowrap;">		 
		 
		 <a href="{$smarty.const.W_SITEPATH}account/admbunnerscontrol/?modify={$val.iditem}&new=1{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}" title="Изменить"><img src="{$smarty.const.W_SITEPATH}img/items/document_edit.png" width="16" height="16"></a>
		 
		 <a style="margin-left: 6px" href="javascript:" onclick="DeleteSelectedElementSection('{$val.iditem}')" title="Удалить"><img src="{$smarty.const.W_SITEPATH}img/items/erase.png" width="16" height="16"></a>
		 
		 </div>
		</td>
       </tr>
      </table>
	 </span>
	</div>
   {/foreach} 
  {if $adm_object->GetResult('data.source')}
   <div style="text-align: right; margin-top: 10px">{$adm_object->GetResult('data.pagestext')}</div>
  {/if}    
  {/if} 
 
 {else}
  {* добавление/изменение раздела *}
  
{literal}
 <script type="text/javascript">         
    function PrepereSend(th) {
	 
	 if (!th.groupname.value) {
	  alert('Укажите название места!');
	  th.groupname.focus();
	  return false;	
	 }
	 			 	 	 
	 $('#globalbodydata').css('cursor', 'wait');
     $('input[id="rb"]').attr('disabled', 'disabled');
     $('input[id="rbp"]').attr('disabled', 'disabled');
	 return true; 	
	}//PrepereSent
	
	function PrepereSend4(th) {
	 $('#globalbodydata').css('cursor', 'wait');
     $('input[id="rb"]').attr('disabled', 'disabled');
     $('input[id="rbp"]').attr('disabled', 'disabled');
	 return true;	
	}//PrepereSend4
	
	function SetActionIdent(n) {	
     document.getElementById('addgroupitem').actionnewprvmail.value = (n) ? 'act' : 'prev';	
    }//SetActionIdent	
 </script>
 {/literal}
 
 
 <form method="post" name="addgroupitem" id="addgroupitem" onsubmit="return PrepereSend(this)">
   
   {if $adm_object->GetResult('modifyinfo')}
   <div style="margin-top: 15px; margin-bottom: 15px; background: #F0F0F0; padding: 3px"><b>Настройка места баннеров</b></div>   
   {else}
   <div class="typelabel" style="margin-top: 12px; margin-bottom: 12px; background: #F0F0F0; padding: 3px">
    <b>Общие параметры места</b>
   </div>   
   {/if}   
    
   <div class="typelabel"><label id="red">*</label> Название места (до 150 символов)<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (отображается для посетителей, определяет наименование места, где будут отображаться баннеры, например: `В шапке сайта`)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 94%" name="groupname" id="groupname" maxlength="120" value="{$adm_object->GetAsElementP('groupname')}">
   </div>
     
   {if $smarty.post.actionnewprvmail == 'prev'}
   <div style="padding: 4px; border: 1px solid #666699; margin-bottom: 20px; margin-top: 10px; width: 94%;">
   {$CONTROL_OBJ->strings->CorrectTextFromDB($CONTROL_OBJ->strings->CorrectTextToDB($smarty.post.groupdescr))}  
   </div>
   {/if} 
   
   <div class="typelabel">Описание места<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (отображается для посетителей, определяет описание места, где будут отображаться баннеры. Желательно также предоставлять скриншоты того, как будет выглядеть баннер там, где размещается данное место.)
   </div>
   </div>
   <div class="typelabel">
    {include file='new_message.tpl' ident='groupdescr' source=$smarty.post.groupdescr height='90px' width='95%'}
   </div>
   
   <div class="typelabel" style="margin-top: 15px">
    <input type="submit" value="&nbsp;Предварительный просмотр описания&nbsp;" class="button" name="rbp" id="rbp" onclick="SetActionIdent(0)">
   </div>
   
   <div class="typelabel" style="margin-top: 12px; margin-bottom: 12px; background: #F0F0F0; padding: 3px">
    <b>Параметры места</b>
   </div>
   
   
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('filesuse') || $smarty.post.actionthissectnnews != 'do'} checked="checked" {/if}style="cursor: pointer" name="filesuse" id="filesuse"><label for="filesuse" style="cursor: pointer">&nbsp;Разрешить загрузку баннеров на сервер сайта</label>  
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('linksuse') || $smarty.post.actionthissectnnews != 'do'} checked="checked" {/if}style="cursor: pointer" name="linksuse" id="linksuse"><label for="linksuse" style="cursor: pointer">&nbsp;Разрешить указывать ссылку на баннер, размещенный на стороннем сайте</label>  
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('useflash') || $smarty.post.actionthissectnnews != 'do'} checked="checked" {/if}style="cursor: pointer" name="useflash" id="useflash"><label for="useflash" style="cursor: pointer">&nbsp;Разрешить использование flash баннеров</label>  
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('usemoder') || $smarty.post.actionthissectnnews != 'do'} checked="checked" {/if}style="cursor: pointer" name="usemoder" id="usemoder"><label for="usemoder" style="cursor: pointer">&nbsp;Отправлять баннеры на проверку администратору перед их публикацией</label><br />
    <div style="font-size: 95%; color: #7E7E7E">
    (если администратор подтверждает разрешение на размещение баннера - пользователь может оплатить показ баннера, после чего баннер станет активным в указанном месте)
    </div>  
   </div>
   
   <div class="typelabel">Максимальный размер файла баннера для загрузки (в Kb)<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (определяет максимальный размер файла баннера, если включена поддержка загрузки баннеров на сайт)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="maxfilesize" id="maxfilesize" maxlength="6" value="{$adm_object->GetAsElementP('maxfilesize', 'actionthissectnnews', 'do', '170')}">
   </div>
   
   <div class="typelabel">Ширина места<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (определяет ширину блока места, где будут выводиться баннеры. Все баннеры будут размером не больше размера места)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="groupwidth" id="groupwidth" maxlength="3" value="{$adm_object->GetAsElementP('groupwidth', 'actionthissectnnews', 'do', '250')}">
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('widthpersent')} checked="checked" {/if}style="cursor: pointer" name="widthpersent" id="widthpersent"><label for="widthpersent" style="cursor: pointer">&nbsp;Ширина указана в процентах (выключено - в px)</label>  
   </div>
   
   <div class="typelabel">Высота места<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (определяет высоту блока места, где будут выводиться баннеры. Все баннеры будут размером не больше размера места)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="groupheight" id="groupheight" maxlength="3" value="{$adm_object->GetAsElementP('groupheight', 'actionthissectnnews', 'do', '250')}">
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('heightpersent')} checked="checked" {/if}style="cursor: pointer" name="heightpersent" id="heightpersent"><label for="heightpersent" style="cursor: pointer">&nbsp;Высота указана в процентах (выключено - в px)</label>  
   </div>
   
   <div class="typelabel">Максимальное кол-во баннеров в блоке<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (определяет максимальное кол-во баннеров, которое может быть помещено в место. Если кол-во баннеров превысит указанное значение - добавить новый баннер будет невозможно до тех пор, пока кол-во баннеров данного места не уменьшится. Если указано 0 - ограничения нет.)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="maxbunners" id="maxbunners" maxlength="5" value="{$adm_object->GetAsElementP('maxbunners', 'actionthissectnnews', 'do', '0')}">
   </div>
   
   <div class="typelabel">
    <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('clearonoffbun') || $smarty.post.actionthissectnnews != 'do'} checked="checked" {/if}style="cursor: pointer" name="clearonoffbun" id="clearonoffbun"><label for="clearonoffbun" style="cursor: pointer">&nbsp;Удалять баннер, если условия его показа закончились</label><br />
    <div style="font-size: 95%; color: #7E7E7E">
   (если данный параметр отключен - баннеры не будут удаляться и пользователь сможет в любой момент продлить показ данного баннера в своем кабинете, если включен - как условия показа будут завершены - на следующий день баннер будет удален а пользователю будет отправлено соответствующее сообщение. Баннеры, чьи условия показа завершены - не учавствуют в показе в независимости от того - указан данный параметр или нет.)
   </div>  
   </div>
   
   <div class="typelabel">Цена за 1000 показов баннера (в USD, формат: 0.00)<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (определяет цену за каждые 1000 показов, если пользователь выбрал тип показа - `За указанное кол-во показов`. Если цену указать в 0.00 - возможность размещения баннера за кол-во показов будет недоступна)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="pricetolook" id="pricetolook" maxlength="12" value="{$adm_object->GetAsElementP('pricetolook', 'actionthissectnnews', 'do', '0.00')}">
   </div>
   
   <div class="typelabel">Цена за 1 день показов баннера (в USD, формат: 0.00)<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (определяет цену за 1 день показов баннера, если пользователь выбрал тип показа - `За указанный период времени`. Если цену указать в 0.00 - возможность размещения баннера на указанное время будет недоступна)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="pricetodays" id="pricetodays" maxlength="12" value="{$adm_object->GetAsElementP('pricetodays', 'actionthissectnnews', 'do', '0.00')}">
   </div>   
   
   
   <div class="typelabel" style="margin-top: 12px; margin-bottom: 12px; background: #F0F0F0; padding: 3px">
    <b>Выполнить</b>
   </div>
   <div style="font-size: 95%; color: #7E7E7E; position: relative; top: -7px">
   (<strong style="color: #0000FF">прежде чем включать активность места, убедитесь, что код вывода Вы разместили в шаблоне проекта!!</strong>)
   </div>
   
   <div class="typelabel">
    <input type="checkbox"{if !$adm_object->GetResult('modifyinfo')} disabled="disabled"{/if} {if $CONTROL_OBJ->CheckPostValue('groupactive')} checked="checked" {/if}style="cursor: pointer; position: relative; top: -7px" name="groupactive" id="groupactive"><label for="groupactive" style="cursor: pointer; position: relative; top: -7px">&nbsp;Активировать место</label> 
   </div>
   
   <div class="typelabel" style="margin-top: 15px">
    <input type="hidden" value="do" name="actionthissectnnews">
   </div> 
   <input type="submit" value="&nbsp;{if !$adm_object->GetResult('modifyinfo')}Добавить место{else}Изменить параметры места{/if}&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp; 
   <input type="hidden" value="prev" name="actionnewprvmail">
   <input type="hidden" value="ok" name="actionnewsectionnews">
  </form>  
  
  {if $smarty.post.actionthissectnnews == 'do' && !$smarty.post.actionthissectionpost_q && $smarty.post.actionnewprvmail != 'prev'}
 <div style="margin-top: 10px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">{if !$adm_object->GetResult('modifyinfo')}Место успешно добавлено!{else}Параметры места успешно изменены!{/if}</label>
  {/if}
 </div>
 {/if}  

 {/if} 
{/if}
