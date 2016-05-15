{* шаблон страницы реклама на сайте *}

<div><strong>We invite you to place your advertising on our site!</strong></div>
<div>You can use the following options for advertising with us:</div>
<div style="margin-top: 14px">
 
 <div style="margin-bottom: 15px; background: #F0F0F0; padding: 3px">
 <strong>1. Placing references to `Showcase links`</strong>
 </div>
 <div style="padding-left: 3px">
 <div>You can post a link <a href="{$smarty.const.W_SITEPATH}vitrinalinks/new=1">here</a> (for a link requires registration)</div>
 <div>At your discretion - the link can be indexed or not, `bold` (&lsaquo;b&rsaquo;) or `normal`. Showcase links displays to all pages.</div>
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
 <strong>2. Placing your banner on our site</strong>
 </div> 
 <div style="padding-left: 3px"> 
  <div>
   <div>You can choose the most appropriate place (or multiple locations) for placing banner (s) of the following.</div>
   <div>To add a banner you must register. You can add a banner to your account, see `<a href="{$smarty.const.W_SITEPATH}account/my-banners-list/" target="_blank">My banners</a>` section</div>
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
              Upload banners	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          {if $val.filesuse}
               <label style="color: #008000">Yes</label>
              {else}
               <em>(no)</em>
              {/if}
	         </td>
	        </tr>
            
            {if $val.filesuse}
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Max size	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          {$adv_object->GetMaxSize($val)}
	         </td>
	        </tr>           
            {/if}
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Links to banners
             </td>
	         <td valign="center" align="left" class="line_item">
	          {if $val.linksuse}
               <label style="color: #008000">Yes</label>
              {else}
               <em>(no)</em>
              {/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Flash banners	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          {if $val.useflash}
               <label style="color: #008000">Yes</label>
              {else}
               <em>(no)</em>
              {/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Place size	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          Width: {$val.groupwidth}{if $val.widthpersent}%{else}px{/if}, Height: {$val.groupheight}{if $val.heightpersent}%{else}px{/if}
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Price for 1000 show	           
             </td>
	         <td valign="center" align="left" class="line_item">
	           {if $val.pricetolook > 0}
                <label style="color: #008000">{$val.pricetolook} USD</label>
               {else}
                <em>(not use)</em>
               {/if} 
	         </td>
	        </tr>
            
            {assign var="itemdescrit" value=$CONTROL_OBJ->strings->CorrectTextFromDB($val.groupdescr)}
          
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" {if $itemdescrit}class="line_item"{else} height="22px"{/if}>
              Price for 1 day show	           
             </td>
	         <td valign="center" align="left" {if $itemdescrit}class="line_item"{else} height="22px"{/if}>
	           {if $val.pricetodays > 0}
                <label style="color: #008000">{$val.pricetodays} USD</label>
               {else}
                <em>(not use)</em>
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
