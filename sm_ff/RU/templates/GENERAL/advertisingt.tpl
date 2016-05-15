{* шаблон страницы реклама на сайте *}

<div><strong>Мы предлагаем Вам разместить Вашу рекламу у нас на сайте!</strong></div>
<div>Вы можете воспользоваться следующими вариантами размещения рекламы у нас:</div>
<div style="margin-top: 14px">
 
 <div style="margin-bottom: 15px; background: #F0F0F0; padding: 3px">
 <strong>1. Размещение ссылки на `Витрину ссылок`</strong>
 </div>
 <div style="padding-left: 3px">
 <div>Разместить ссылку Вы можете <a href="{$smarty.const.W_SITEPATH}vitrinalinks/new=1">здесь</a> (для размещения ссылки необходима регистрация)</div>
 <div>На Ваше усмотрение - ссылка может быть индексируемой или нет, `жирной` (&lsaquo;b&rsaquo;) или `обычной`. Витрина ссылок отображается на ВСЕХ страницах сайта.</div>
 </div>
 
 {if $adv_object->GetPlaceList()}
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
 </script>
 {/literal}
  
 <div style="margin-bottom: 15px; margin-top: 30px; background: #F0F0F0; padding: 3px">
 <strong>2. Размещение Вашего баннера на нашем сайте</strong>
 </div> 
 <div style="padding-left: 3px"> 
  <div>
   <div>Вы можете выбрать наиболее подходящее место (или несколько мест) для размещения баннера(ов) из указанных ниже.</div>
   <div>Для добавления баннера Вам необходимо зарегистрироваться. Добавить баннер Вы можете в личном кабинете, в разделе `<a href="{$smarty.const.W_SITEPATH}account/my-banners-list/" target="_blank">Мои баннеры</a>`</div>
  </div>
  <div style="margin-top: 10px">
  
  {foreach from=$adv_object->GetPlaceList() item=val name=val}
    <div style="margin: 4px; margin-left: 0; margin-top: 15px; padding: 4px; border: 1px solid #D2D2D2">
	 <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
       <tr>
       
        <td valign="top" align="left" width="50px" style="padding-right: 4px">
		 <img src="{$smarty.const.W_SITEPATH}img/ico/general/places_visited.png" border="0">
		</td>	
		
	    <td valign="top" align="left">
		 <div><strong>{$val.groupname}</strong></div>
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
            
            {if $val.filesuse}
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Максимальный размер	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          {$adv_object->GetMaxSize($val)}
	         </td>
	        </tr>           
            {/if}
            
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
  
  </div>
 </div>
 {/if}
</div>
