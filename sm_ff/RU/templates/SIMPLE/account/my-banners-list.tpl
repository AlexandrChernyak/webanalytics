{* мои баннеры, размещенные в проекте *}
 {if !$CONTROL_OBJ->IsOnline()}error{else}

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
   
 <div style="margin-bottom: 15px; background: #F0F0F0; padding: 3px">
 <a href="{$smarty.const.W_SITEPATH}account/my-banners-list/?new=1" style="text-decoration: none;{if $smarty.get.new} color: #000000{/if}">Добавить баннер</a>  <label style="padding: 0 2px 0 2px">|</label>  <a style="text-decoration: none;{if !$smarty.get.new && !$smarty.get.moderl} color: #000000{/if}" href="{$smarty.const.W_SITEPATH}account/my-banners-list/?moderl=0">Все активные баннеры (<label style="color: #000000">{$mybanner_obj->GetResult('acount')}</label>)</a>  <label style="padding: 0 2px 0 2px">|</label>  <a style="text-decoration: none;{if !$smarty.get.new && $smarty.get.moderl} color: #000000{/if}" href="{$smarty.const.W_SITEPATH}account/my-banners-list/?moderl=1">Все НЕ активные баннеры (<label style="color: #000000">{$mybanner_obj->GetResult('icount')}</label>)</a>
 </div> 

 {if $smarty.get.new}
 {* добавление баннера *}
 <div style="margin-top: 4px">
 
 {* список мест для баннеров *}
 {if !$smarty.get.placeb}
 
 {if !$mybanner_obj->GetPlaceList()}
  <div style="color: #FF0000">В данный момент мест для показа баннеров нет.</div>
 {else}
 
   <div><strong>Выберите место, в котором желаете разместить баннер!</strong></div>
   
   {foreach from=$mybanner_obj->GetResult('placelist') item=val name=val}
    <div style="margin: 4px; margin-top: 15px; padding: 4px; border: 1px solid #D2D2D2">
	 <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
       <tr>
       
        <td valign="top" align="left" width="50px" style="padding-right: 4px">
		 <img src="{$smarty.const.W_SITEPATH}img/ico/general/places_visited.png" border="0">
		</td>	
		
	    <td valign="top" align="left">
		 <div><a href="{$smarty.const.W_SITEPATH}account/my-banners-list/?new=1&placeb={$val.iditem}"><strong>{$val.groupname}</strong></a></div>
		 <div style="margin-top: 4px;">
		  
          <div>
          <span style="width: 100%">
           <table width="100%" cellpadding="0" cellspacing="0" border="0">	        
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Загружать баннеры	           
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
	         <td valign="center" align="left" width="150px" class="line_item">
              Ссылки на баннеры
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
	         <td valign="center" align="left" width="150px" class="line_item">
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
	         <td valign="center" align="left" width="150px" class="line_item">
              Размеры места	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          Ширина: {$val.groupwidth}{if $val.widthpersent}%{else}px{/if}, Высота: {$val.groupheight}{if $val.heightpersent}%{else}px{/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Цена за 1000 показов	           
             </td>
	         <td valign="center" align="left" class="line_item">
	           {if $val.pricetolook > 0}
                <label style="color: #008000">{$val.pricetolook} USD</label>
               {else}
                <em>(не используется)</em>
               {/if} 
	         </td>
	        </tr>
            
            {assign var="itemdescrit" value=$CONTROL_OBJ->strings->CorrectTextFromDB($val.groupdescr)}
          
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" {if $itemdescrit}class="line_item"{else} height="22px"{/if}>
              Цена за 1 день показов	           
             </td>
	         <td valign="center" align="left" {if $itemdescrit}class="line_item"{else} height="22px"{/if}>
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
          
          {if $itemdescrit}
          <div style="margin-top: 14px">
           {$itemdescrit}          
          </div>
          {/if}
                   
		 </div>
		</td>
		
       </tr>
      </table>
	 </span>
	</div>    
   {/foreach}
 
 {/if}
 {else}
  {* выбрано место - параметры *}
  
  {if !$mybanner_obj->GetResult('groupinfo')}
   <div style="color: #FF0000">Место не найдено!</div>
  {else} 
     
    <div style="margin: 4px; margin-top: 15px; padding: 4px; border: 1px solid #D2D2D2">
	 <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
       <tr>
       
        <td valign="top" align="left" width="50px" style="padding-right: 4px">
		 <img src="{$smarty.const.W_SITEPATH}img/ico/general/places_visited.png" border="0">
		</td>	
		
	    <td valign="top" align="left">
		 <div>Место: <strong>{$mybanner_obj->GetResult('groupinfo.groupname')}</strong></div>
		 <div style="margin-top: 4px;">
		  
          <div>
          <span style="width: 100%">
           <table width="100%" cellpadding="0" cellspacing="0" border="0">	        
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Загружать баннеры	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          {if $mybanner_obj->GetResult('groupinfo.filesuse')}
               <label style="color: #008000">Да</label>
              {else}
               <em>(нет)</em>
              {/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Ссылки на баннеры
             </td>
	         <td valign="center" align="left" class="line_item">
	          {if $mybanner_obj->GetResult('groupinfo.linksuse')}
               <label style="color: #008000">Да</label>
              {else}
               <em>(нет)</em>
              {/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Flash баннеры	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          {if $mybanner_obj->GetResult('groupinfo.useflash')}
               <label style="color: #008000">Да</label>
              {else}
               <em>(нет)</em>
              {/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Размеры места	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          Ширина: {$mybanner_obj->GetResult('groupinfo.groupwidth')}{if $mybanner_obj->GetResult('groupinfo.widthpersent')}%{else}px{/if}, Высота: {$mybanner_obj->GetResult('groupinfo.groupheight')}{if $mybanner_obj->GetResult('groupinfo.heightpersent')}%{else}px{/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Цена за 1000 показов	           
             </td>
	         <td valign="center" align="left" class="line_item">
	           {if $mybanner_obj->GetResult('groupinfo.pricetolook') > 0}
                <label style="color: #008000">{$mybanner_obj->GetResult('groupinfo.pricetolook')} USD</label>
               {else}
                <em>(не используется)</em>
               {/if} 
	         </td>
	        </tr>
            
            {assign var="itemdescrit" value=$CONTROL_OBJ->strings->CorrectTextFromDB($mybanner_obj->GetResult('groupinfo.groupdescr'))}
          
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" {if $itemdescrit}class="line_item"{else} height="22px"{/if}>
              Цена за 1 день показов	           
             </td>
	         <td valign="center" align="left" {if $itemdescrit}class="line_item"{else} height="22px"{/if}>
	           {if $mybanner_obj->GetResult('groupinfo.pricetodays') > 0}
                <label style="color: #008000">{$mybanner_obj->GetResult('groupinfo.pricetodays')} USD</label>
               {else}
                <em>(не используется)</em>
               {/if} 
	         </td>
	        </tr>

	       </table>       
          </span>         
          </div>
          
          {if $itemdescrit}
          <div style="margin-top: 14px">
           {$itemdescrit}          
          </div>
          {/if}
                   
		 </div>
		</td>
		
       </tr>
      </table>
	 </span>
	</div>  
  
   {* ok, check for get this add *}
   <div style="margin-top: 16px; padding-left: 3px">
    
    {if $mybanner_obj->GetResult('accesstoadd') == 1}
     <div style="color: #FF0000">
      В данный момент все доступные виды использования баннеров данного места отключены!
     </div>
    {elseif $mybanner_obj->GetResult('accesstoadd') == 2}
     <div style="color: #FF0000">
      В данный момент место не может быть активно! Нет активных цен на размещение баннеров!
     </div>
    {elseif $mybanner_obj->GetResult('accesstoadd') == 3}
     <div style="color: #FF0000">
      В данный момент место не может быть активно! Не указаны размеры места!
     </div>
    {elseif $mybanner_obj->GetResult('accesstoadd') == 4}
     <div style="color: #FF0000">
      В данный момент место не может быть активно! Место отключено!
     </div>
    {elseif $mybanner_obj->GetResult('accesstoadd') == 5}
     <div style="color: #FF0000">
      В данный момент место не может быть активно! Превышено максимальное кол-во баннеров на место!
     </div>
    {else}
     
     {literal}
     <script type="text/javascript">
      var priceforgetmp = 0;
     
	  function DoSend(th) {   
	   
	   if (priceforgetmp <= 0) { 
	     alert('Укажите корректно все параметры!');
         return false;  
	   }       
       
       var usem = '{/literal}{$mybanner_obj->GetResult('groupinfo.usemoder')}{literal}';
       var s = 'Вы действительно хотите добавить баннер по указанным Вами параметрам. Если добавление баннера пройдет успешно, ';
       
       if (usem == '0') {
        if (!confirm(s+'с Вашего баланса будет снята сумма, в размере `'+priceforgetmp+' USD`! Продолжить?')) {
         return false;   
        }        
       } else {
        if (!confirm(s+'у Вас будет 24 часа для оплаты с момента подтверждения администратором. По итечении 24 часов, если оплата не будет произведена - баннер будет удален! (в случае успешной проверки администратором - Вам на e-mail будет отправлено соответствующее уведомление)')) { return false; }        
       }       
       
       th.rb.disabled = true;
       $('#globalbodydata').css('cursor', 'wait'); 
       return true;
	  }//DoSend
      
      function SelBannerType(eraiseitem, selid, blid) {
       
       var bunnttl = document.getElementById(selid);
       if (!bunnttl) { return false; }
       
       $('#' + blid + bunnttl.value).css({visibility: 'visible', display: 'block'});
       
       var idath = (bunnttl.value == '0') ? '1' : '0';
       idath = document.getElementById(blid + idath);
       
       if (idath) {
        if (eraiseitem) {
         
         $(this).remove();   
            
        } else {  $(idath).css({visibility: 'hidden', display: 'none'}); } 
       }              
        
      }//SelBanType
   
      
      var priced = new Array();
      priced[0] = false;
      priced[1] = false;      
      
      {/literal}
      {if $mybanner_obj->GetResult('groupinfo.pricetodays')}
       priced[1] = {$mybanner_obj->GetResult('groupinfo.pricetodays')};      
      {/if}
      {if $mybanner_obj->GetResult('groupinfo.pricetolook')}
       priced[0] = {$mybanner_obj->GetResult('groupinfo.pricetolook')};      
      {/if}
      {literal}
      
      function GenerateTotalSum() {
       
       var s = '(неизвестно)';
       priceforgetmp = 0;
       
       var ptype = document.getElementById('paytype');
       if (!ptype) { return SetTotalSt(s); }
       
       switch (ptype.value) {
        
        case '0':
         var fl = document.getElementById('forlooks');
         if (!fl || !IisInteger(fl.value, true) || fl.value < 100) { return SetTotalSt(s); }                
         fl = priceforgetmp = (fl.value * priced[0] / 1000);      
         return SetTotalSt(fl + ' USD');
        break;
        
        case '1':
         var fl = document.getElementById('fordays');
         if (!fl || !IisInteger(fl.value, true) || fl.value < 1) { return SetTotalSt(s); }                 
         fl = priceforgetmp = (fl.value * priced[1]);
         return SetTotalSt(fl + ' USD');        
        break;
        
        default: return SetTotalSt(s);        
       }        
      }//GenerateTotalSum
      
      function SetTotalSt(s) { $('#priceban').html(s); return false; }
      
     </script>    
     {/literal}
     
     <form method="post" name="nbanneradd" id="nbanneradd"{if $mybanner_obj->GetResult('filesizedwload') !== false} enctype="multipart/form-data"{/if} onsubmit="return DoSend(this)">
      
     
     <div class="typelabel">Выберите тип баннера, который Вы хотите разместить</div>
     <div class="typelabel">
     <select size="1" style="width: 350px" name="banntype" id="banntype" onchange="SelBannerType(false, 'banntype', 'typedbyid')">
      {if $mybanner_obj->GetResult('groupinfo.filesuse')}
	  <option value="0"{if $smarty.post.banntype == '0'} selected="selected"{/if}>Загрузить баннер на сайт</option>
      {/if}
      {if $mybanner_obj->GetResult('groupinfo.linksuse')}
      <option value="1"{if $smarty.post.banntype == '1'} selected="selected"{/if}>Использовать ссылку на файл баннера</option>
      {/if}
     </select>
     </div>
     
     {if $mybanner_obj->GetResult('groupinfo.filesuse')}
     <div id="typedbyid0"{if $smarty.post.banntype != '0'} style="visibility: hidden; display: none"{/if}>
      <div class="typelabel"><label id="red">*</label> Укажите файл баннера (форматы: {$CONTROL_OBJ->GenerateArrayString($mybanner_obj->GetResult('filetypeslist'),', ', '"<b>', '"</b>')}{if $mybanner_obj->GetResult('groupinfo.maxfilesize')}, максимальный размер: <b>{$CONTROL_OBJ->GetStrSizeFromBytes($mybanner_obj->GetResult('filesizedwload'))}</b>){/if}</div>    
      <div class="typelabel">
       <input type="file" size="20" style="width: 95%; height: 22px" class="inpt" name="bfile" id="bfile">       
      </div>           
     </div>
     {/if}
     
     
     {if $mybanner_obj->GetResult('groupinfo.linksuse')}
     <div id="typedbyid1"{if $smarty.post.banntype != '1'} style="visibility: hidden; display: none"{/if}>
      <div class="typelabel"><label id="red">*</label> Укажите ссылку на файл баннера в интернете (форматы: {$CONTROL_OBJ->GenerateArrayString($mybanner_obj->GetResult('filetypeslist'),', ', '"<b>', '"</b>')})<br />
      <div style="font-size: 95%; color: #808080">(необходимо указать ПРЯМУЮ ссылку на файл указанного типа (изображения{if $mybanner_obj->GetResult('groupinfo.useflash')} или flash ролика{/if})!)</div>
      </div>    
      <div class="typelabel">
       <input type="text" class="inpt" style="width: 94%" name="blink" id="blink" maxlength="210" value="{$CONTROL_OBJ->GetPostElement('blink', 'doactionaddbannerex', 'do', 'http://')}">       
      </div>
      
      {if $mybanner_obj->GetResult('groupinfo.useflash')}
      <div class="typelabel">
       <input type="checkbox" {if $CONTROL_OBJ->CheckPostValue('isflashobj')} checked="checked" {/if}style="cursor: pointer" name="isflashobj" id="isflashobj"><label for="isflashobj" style="cursor: pointer">&nbsp;Файл по указанной ссылке является flash роликом</label>  
      </div>
      {/if}
                
     </div>
     {/if}
     
     
     <div class="typelabel">
      <label id="red">*</label> Укажите адрес ссылки, на который посетитель будет переходить при нажатии на баннер<br />
      <div style="font-size: 95%; color: #808080">(указывайте полный адрес ссылки, вместе с <strong>http://</strong>)</div>
     </div>
     <div class="typelabel">
      <input type="text" class="inpt" style="width: 94%" name="hreflink" id="hreflink" maxlength="170" value="{$CONTROL_OBJ->GetPostElement('hreflink', 'doactionaddbannerex', 'do', 'http://')}">       
     </div>
     
     
     <div class="typelabel">
      <label id="red">*</label> Как Вы хотите показывать рекламу?<br />
      <div style="font-size: 95%; color: #808080">(указывается тип размещения баннера, на указанный срок или на указанное кол-во показов баннера. **после добавления, тип размещения изменить будет невозможно**. Цены на размещение баннера указаны в описании данного места (см. выше в описании).)</div>
     </div>
     <div class="typelabel">
      <select size="1" style="width: 350px" name="paytype" id="paytype" onchange="SelBannerType(false, 'paytype', 'paytypeidblock'); GenerateTotalSum();">
       {if $mybanner_obj->GetResult('groupinfo.pricetolook') > 0}
       <option value="0"{if $smarty.post.paytype == '0'} selected="selected"{/if}>На указанное кол-во показов баннера</option>
       {/if}
       {if $mybanner_obj->GetResult('groupinfo.pricetodays') > 0}
       <option value="1"{if $smarty.post.paytype == '1'} selected="selected"{/if}>На указанное кол-во дней показов баннера</option>
       {/if}       
      </select>
     </div> 
     
     {if $mybanner_obj->GetResult('groupinfo.pricetolook') > 0}
     <div id="paytypeidblock0"{if $smarty.post.paytype != '0'} style="visibility: hidden; display: none"{/if}>     
      <div class="typelabel"><label id="red">*</label> Укажите кол-во показов, на которое Вы хотите разместить баннер<br />
      <div style="font-size: 95%; color: #808080">
       (указывайте целое числовое значение, минимальное кол-во показов - 100)
      </div>      
      </div>    
      <div class="typelabel">
       <input type="text" class="inpt" style="width: 346px" name="forlooks" id="forlooks" maxlength="210" value="{$CONTROL_OBJ->GetPostElement('forlooks', 'doactionaddbannerex', 'do', '1000')}" onchange="GenerateTotalSum()" onblur="GenerateTotalSum()">       
      </div>                   
     </div>
     {/if}
     
     {if $mybanner_obj->GetResult('groupinfo.pricetodays') > 0}
     <div id="paytypeidblock1"{if $smarty.post.paytype != '1'} style="visibility: hidden; display: none"{/if}>     
      <div class="typelabel"><label id="red">*</label> Укажите кол-во дней показов, на которое Вы хотите разместить баннер<br />
      <div style="font-size: 95%; color: #808080">
       (указывайте целое числовое значение, минимальное кол-во дней показов - 1. День оплаты и начало показа баннера считается первым днем показов `Если оплата и старт показов выполняется в 23:00 - в первый день баннер будет показан только час, во второй день счетчик показов будет увеличен!`. т.е первый день считается не полным, а с момента начала показа баннера и до завершения текущего дня `до 24:00` `сейчас: {$mybanner_obj->GetThisTime()}`)
      </div>      
      </div>    
      <div class="typelabel">
       <input type="text" class="inpt" style="width: 346px" name="fordays" id="fordays" maxlength="210" value="{$CONTROL_OBJ->GetPostElement('fordays', 'doactionaddbannerex', 'do', '30')}" onchange="GenerateTotalSum()" onblur="GenerateTotalSum()">       
      </div>                   
     </div>
     {/if}
     
     <div style="margin-top: 12px; background: #F0F0F0; padding: 3px">
      Сумма размещения баннера: <strong id="priceban">(неизвестно)</strong>
     </div>
     
     <input type="hidden" value="do" name="doactionaddbannerex" />     
     <div class="typelabel" style="margin-top: 12px">
      <input type="submit" value="&nbsp;Добавить баннер&nbsp;" class="button" name="rb" id="rb">
     </div>   
    
    </form>
    
    {if $smarty.post.doactionaddbannerex == 'do'}
     <div style="margin-top: 6px">
      {if $mybanner_obj->GetResult('error')}
        <div style="color: #FF0000">{$mybanner_obj->GetResult('error')}</div>
      {else}
        <div style="color: #008000">Баннер успешно добавлен!{if $mybanner_obj->GetResult('groupinfo.usemoder')} После проверки администратором, Вы сможете оплатить размещение Вашего баннера! В случае успешной проверки, Вам на почту прийдет сообщение, информирующее Вас о активации баннера для оплаты и размещения на сайте!{/if}</div>
      {/if}
     </div>
    {/if}
    
    {literal}
    <script type="text/javascript"> 
     
     SelBannerType(false, 'banntype', 'typedbyid'); 
     SelBannerType(false, 'paytype', 'paytypeidblock');
          
     jQuery(document).ready(function() {  
      GenerateTotalSum();
     });
     
    </script>
    {/literal}
        
    
    {/if}
   </div>   
  
  {/if}
 {/if} 
 </div>
 {else}
 {* список баннеров *}
 
  
{literal}
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = {/literal}{if $smarty.get.moderl}{$mybanner_obj->GetResult('icount')}{else}{$mybanner_obj->GetResult('acount')}{/if};{literal}  
 function DoHigl(th, n, p) {	
  if (n) {	$(th).css('background','#F9FAFB'); } else {
   var ch = document.getElementById('chid'+p);
   var color = (ch && ch.checked) ? '#E1E2E0' : 'none';   	
   $(th).css('background', color);		
  }	
 }//DoHigl
 function CheckItem(itemid, th) {
  th = (th) ? th : document.getElementById('chid'+itemid);   
  if (th && th.checked) { $('#t_r_'+itemid).css('background','#E1E2E0'); } else {
  $('#t_r_'+itemid).css('background','none');
  }
  SetEnabled();   	
 }//CheckItem
 function CheckAll(th) {	
  for (var i=0; i < list_items.length; i++) {
   var ch = $('#chid'+list_items[i]);
   ch.attr('checked', (th.checked) ? 'checked' : '');
   if (th.checked) { $('#t_r_'+list_items[i]).css('background','#E1E2E0'); } else {
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
   return ;	 
  }
  setElementOpacity(document.getElementById('did'), 1);
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
 
 var globalaccountpath = '{/literal}{$smarty.const.W_SITEPATH}account/my-banners-list/{literal}';
 
 function PayOneBannerItem(price, id) {
  var path = globalaccountpath + '?moderl={/literal}{$smarty.get.moderl}{literal}';
   
  if (!confirm("Вы действительно хотите оплатить стоимость размещения баннера?\r\nС Вашего баланса будет снята сумма в размере "+price+" USD (активация показов выбранного баннера)\r\nПродолжить?")) { return false; } 
    
  path = path + '&payitem=' + id;
  document.location = path;    
 }//PayOneBannerItem
 
 var onlineisworking = false;
 var globdatalink = ''; 
 var globalbannerid = 0;
 
 function AddToMyDisplays(price, id, typed) {
    
  if (onlineisworking) {
   return alert('В данный момент операция выполнятся! Пожалуйста, дождитесь окончания выполнения операции..'); 
  }
    
  var s = '';
  var v = 0;
  
  if (typed == '0') {
   var r = prompt('Укажите кол-во показов, которое Вы хотите добавить баннеру! (каждые 1000 показов - '+price+' USD, минимальная ставка - 100 показов!)', "1000");
   
   if (r == null || !r || !IisInteger(r, true) || r < 100) {
    if (r === null) { return false; }
    return alert('Необходимо указать числовое значение кол-ва показов не меньше 100!');
   }  
   
   v = (price * r / 1000);
   s = r + ' показов';
   
  } else {
    
   var r = prompt('Укажите кол-во дней показов, которое Вы хотите добавить баннеру! (каждый 1 день показов - '+price+' USD, минимальная ставка - 1 день показов!)', "30");
   
   if (r == null || !r || !IisInteger(r, true) || r < 1) {
    if (r === null) { return false; }
    return alert('Необходимо указать числовое значение кол-ва дней показов не меньше 1!');
   }
   
   v = (price * r);
   s = r + ' дней показов';    
    
  }
  
  //ok send info
  if (!confirm('Вы действительно хотите продлить показ баннера на ['+s+']? С Вашего баланса будет снята сумма, в размере ['+v+' USD]'+"\r\nПродолжить?")) { return false; }
    
    
  onlineisworking = true;
  globalbannerid = id;
  globdatalink = $('#addtodisplaybanner'+id).html();
  
  $('#addtodisplaybanner'+id).html(
   '<label style="color: #0000FF; font-size: 95%">Выполняется, пожалуйста, подождите..</label>'
  );
  
  SendDefaultRequest(
   globalaccountpath, 'is_ajax_mode=1&type='+typed+'&pt=1&id='+id+'&value='+r, 'PrepereRequestAddData'
  );
  
  //addtodisplaybanner  link
  //totalcount  total 
    
 }
 
 function PrepereRequestAddData(data) {
  $('#addtodisplaybanner'+globalbannerid).html(globdatalink);  
  
  onlineisworking = false;
  if (data == '') { return false; }
  
  if (!IisInteger(data, true)) { return alert(data); }
  
  $('#totalcount'+globalbannerid).html(data);
  
  return alert('Срок размещения успешно продлен!');    
    
 }//PrepereRequestData
 
 </script>
 <style type="text/css">
  .h_th1, .h_td, .h_td2 { 
   border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E3E4E8; border-left: none; }
  .btn_n { border: 1px solid #E3E4E8; border-top: none; height: 25px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E3E4E8; height: 25px; border-top: none; }	
 </style>
 {/literal} 
 
 <form method="post" name="vnewsform" id="vnewsform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Удалить все баннеры&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 200px;">
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
	<td class="h_td2" valign="center" align="center" width="130px">Создан</td>
   </tr>	
   {literal}
   <style type="text/css">
	.llw { display: inline-block; margin-left: 8px; vertical-align: baseline; padding-left: 20px; }
   </style>
   {/literal}
   {if $mybanner_obj->GetResult('datalist')}
	{foreach from=$mybanner_obj->GetResult('datalist') item=val name=val}
	 <tr onmouseover="DoHigl(this, 1, {$smarty.foreach.val.index})" onmouseout="DoHigl(this, 0, {$smarty.foreach.val.index})" id="t_r_{$smarty.foreach.val.index}">
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8{if !$val.activeobj}; background: #F7DCDC{/if}">
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
           Показов	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       всего: {$val.lookcount}{if $val.setbytype == 0} из {$val.forlooks}{/if}, сегодня: {$val.looktoday}
	      </td>
	     </tr>
         {*
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Кликов по баннеру	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       всего: {$val.visitcount}, сегодня: {$val.visittoday}
	      </td>
	     </tr>
         
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           CTR	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       {$mybanner_obj->GetCTR($val)}
	      </td>
	     </tr>
         *}
         {if $val.setbytype == 1}
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Показан дней	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       {$val.lookdcount} из {$val.fordays}
	      </td>
	     </tr>  
         
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Осталось дней	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       <label id="totalcount{$val.iditem}">{math equation="x - y" x=$val.fordays y=$val.lookdcount}</label>
           
           {if $val.activeobj && $val.ispayed}
            <label id="addtodisplaybanner{$val.iditem}" style="margin-left: 4px">
             <a href="javascript:" style="font-size: 95%" onclick="AddToMyDisplays('{$val.groupinfo.pricetodays}', '{$val.iditem}', '1')">продлить</a>           
            </label>        
           {/if}           
	      </td>
	     </tr>   
                      
         {elseif $val.setbytype == 0}
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Осталось показов	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       <label id="totalcount{$val.iditem}">{math equation="x - y" x=$val.forlooks y=$val.lookcount}</label>
           
           {if $val.activeobj && $val.ispayed}
            <label id="addtodisplaybanner{$val.iditem}" style="margin-left: 4px">
             <a href="javascript:" style="font-size: 95%" onclick="AddToMyDisplays('{$val.groupinfo.pricetolook}', '{$val.iditem}', '0')">продлить</a>           
            </label>        
           {/if}            
	      </td>
	     </tr>                
         {/if}
         
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Место размещения	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       {$val.groupinfo.groupname}
	      </td>
	     </tr>
         
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
           <label style="margin-left: 4px; font-size: 95%"><a style="margin-right: 3px" href="javascript:" onclick="PayOneBannerItem('{$val.pricetopay}', '{$val.iditem}')"><strong>оплатить{if $val.pricetopay} {$val.pricetopay} USD на {if $val.setbytype == 0}{$val.forlooks} показов{else}{$val.fordays} дней{/if}
           {/if}</strong></a>{* {if $val.groupinfo.clearonoffbun} до {$val.hoursleft}{/if} *}</label>
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
      
      <!-- <div style="height: 6px; display: block"></div> -->	  	 
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
     Нет баннеров!
     <script type="text/javascript">
	  document.getElementById('checkallitems').disabled = true;
     </script>
    </td>
   </tr> 
   {/if} 
 </table> 
 </span>
 </div> 
 <input type="hidden" value="0" name="actioncountmess">
 <input type="hidden" value="none" name="actionlistmakes"> 
</form>
 <script type="text/javascript">
 SetEnabled();
 {if $mybanner_obj->GetResult('payerror')}
  alert('{$mybanner_obj->GetResult('payerror')}');
 {/if}   
 </script>
 
 {/if}
{/if}