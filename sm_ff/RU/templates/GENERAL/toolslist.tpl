{* общий раздел списка инструментов *}
<div style="margin-top: 5px">
 
 {assign var="listtoolsX" value=$CONTROL_OBJ->GetToolsListByGroupDevision()}
 {literal}
 <script type="text/javascript">
  function DoHigl(th, n) {	
    if (n) { $(th).css('background','#F8F5F1'); } else {   	
     $(th).css('background', 'none');		
    }	
   }//DoHigl
      
  function ShHdBlElementA(th, ident) {	   
   var hd = ($('#'+ident).css('visibility') == 'hidden') ? true : false; 
   $(th).html((hd) ? 'Скрыть' : 'Показать');
   $('#'+ident).css('visibility', (hd) ? 'visible' : 'hidden');
   $('#'+ident).css('display', (hd) ? 'block' : 'none');
  }//ShHdBlElementA	
 </script>
 <style type="text/css">
  .tdblock { padding: 2px; }	
 </style>
 {/literal}
 
 {foreach from=$listtoolsX item=val name=val} 
  <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px;"><b>{$val.group.name}</b><label style="color: #000000; margin-left: 6px">[ <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElementA(this, 'block_{$val.group.iditem}')">Скрыть</a> ]</label>
  </div>
 
  <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="block_{$val.group.iditem}">
   {if !$val.data.count}
    В группе нет инструментов!
   {else}
   <span style="width: 100%">
    <table width="100%" cellpadding="0" cellspacing="0">
     {section name=trindex start=0 loop=$val.data.count step=1}
      <tr>      
       
       <td valign="top" align="left" width="50%" class="tdblock"{if $val.data.data1[trindex].name} onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)"{/if}>
        {if $val.data.data1[trindex].name}       
         <div><span style="width: 100%">
          <table width="100%" cellpadding="0" cellspacing="0">
           <tr>
            
            <td valign="top" align="left" width="22px" style="padding-left: 2px; padding-top: 2px">
             <img src="{$CONTROL_OBJ->GetToolImageStyle($val.data.data1[trindex].name, 16, '', '')}" style="width: 16px; height: 16px">            
            </td>
            
            <td valign="top" align="left" style="padding-top: 2px">
             <div><a href="{$smarty.const.W_SITEPATH}tools/{$val.data.data1[trindex].name}/">{$CONTROL_OBJ->GetText($val.data.data1[trindex].value.descr)}</a></div>            
             <div style="font-size: 95%; color: #969696; margin-top: 2px">
             Просмотров: {$CONTROL_OBJ->GetToolVisitorsCount($val.data.data1[trindex].name)}
             </div>            
             <div style="color: #808080; font-size: 95%; margin-top: 2px">
	         {if !$val.data.data1[trindex].value.Ldescr}
	          <i>(нет описания)</i>
	         {else}
	          {$CONTROL_OBJ->GetText($val.data.data1[trindex].value.Ldescr)}
	         {/if}
	         </div>
             
             {if $val.data.data1[trindex].value.onlineonly || $val.data.data1[trindex].value.onlyforadmin}
             <div style="font-size: 95%; margin-top: 2px; color: #0000FF">             
              {if $val.data.data1[trindex].value.onlineonly}
               <label title="Требуется регистрация на сайте" style="cursor: help">регистрация</label>
              {/if}            
              {if $val.data.data1[trindex].value.onlyforadmin}
               <label style="{if $val.data.data1[trindex].value.onlineonly}margin-left: 6px; {/if}color: #FF0000">временно недоступен</label>               
              {/if}                        
             </div>
             {/if}
                        
            </td>
          
           </tr>
          </table>
         </span></div>          
        {/if}
       </td>
       
       
       <td valign="top" align="left" width="50%" class="tdblock"{if $val.data.data2[trindex].name} onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)"{/if}>
        {if $val.data.data2[trindex].name}       
         <div><span style="width: 100%">
          <table width="100%" cellpadding="0" cellspacing="0">
           <tr>
            
            <td valign="top" align="left" width="22px" style="padding-left: 2px; padding-top: 2px">
             <img src="{$CONTROL_OBJ->GetToolImageStyle($val.data.data2[trindex].name, 16, '', '')}" style="width: 16px; height: 16px">            
            </td>
            
            <td valign="top" align="left" style="padding-top: 2px">
             <div><a href="{$smarty.const.W_SITEPATH}tools/{$val.data.data2[trindex].name}/">{$CONTROL_OBJ->GetText($val.data.data2[trindex].value.descr)}</a></div>            
             <div style="font-size: 95%; color: #969696; margin-top: 2px">
             Просмотров: {$CONTROL_OBJ->GetToolVisitorsCount($val.data.data2[trindex].name)}
             </div>            
             <div style="color: #808080; font-size: 95%; margin-top: 2px">
	         {if !$val.data.data2[trindex].value.Ldescr}
	          <i>(нет описания)</i>
	         {else}
	          {$CONTROL_OBJ->GetText($val.data.data2[trindex].value.Ldescr)}
	         {/if}
	         </div>
             
             {if $val.data.data2[trindex].value.onlineonly || $val.data.data2[trindex].value.onlyforadmin}
             <div style="font-size: 95%; margin-top: 2px; color: #0000FF">             
              {if $val.data.data2[trindex].value.onlineonly}
               <label title="Требуется регистрация на сайте" style="cursor: help">регистрация</label>
              {/if}            
              {if $val.data.data2[trindex].value.onlyforadmin}
               <label style="{if $val.data.data2[trindex].value.onlineonly}margin-left: 6px; {/if}color: #FF0000">временно недоступен</label>               
              {/if}                        
             </div>
             {/if}
                        
            </td>
          
           </tr>
          </table>
         </span></div>          
        {/if}
       </td>                
       
      </tr>
     {/section}
    </table>
   </span>
   {/if}
  </div> 
 {/foreach}

</div>