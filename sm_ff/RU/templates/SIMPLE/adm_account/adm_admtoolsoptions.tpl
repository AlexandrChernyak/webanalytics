{* настройки инструментов *}
<div style="margin-top: 4px">
 {if !$smarty.get.toolid || !$adm_object->ToolOptionExists($smarty.get.toolid)}
 {* список инструментов *}
 
 
 {assign var="listtoolsX" value=$CONTROL_OBJ->GetToolsListByGroupDevision()}
 {literal}
 <script type="text/javascript">
  function DoHigl(th, n) {	
    if (n) { $(th).css('background','#F9FAFB'); } else {   	
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
  <div class="analisislabelid"><b>{$val.group.name}</b><label style="color: #000000; margin-left: 6px">[ <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElementA(this, 'block_{$val.group.iditem}')">Скрыть</a> ]</label>
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
            
            <td valign="top" align="left" width="18px" style="padding-left: 2px; padding-top: 2px">
             <img src="{$CONTROL_OBJ->GetToolImageStyle($val.data.data1[trindex].name, 16, '', '')}" style="width: 16px; height: 16px; margin-right: 2px">            
            </td>
            
            <td valign="top" align="left" style="padding-top: 2px">
             <div><a href="{$smarty.const.W_SITEPATH}account/admtoolsoptions/?toolid={$val.data.data1[trindex].name}">{$CONTROL_OBJ->GetText($val.data.data1[trindex].value.descr)}</a></div>            
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
            
            <td valign="top" align="left" width="18px" style="padding-left: 2px; padding-top: 2px">
             <img src="{$CONTROL_OBJ->GetToolImageStyle($val.data.data2[trindex].name, 16, '', '')}" style="width: 16px; height: 16px; margin-right: 2px">            
            </td>
            
            <td valign="top" align="left" style="padding-top: 2px">
             <div><a href="{$smarty.const.W_SITEPATH}account/admtoolsoptions/?toolid={$val.data.data2[trindex].name}">{$CONTROL_OBJ->GetText($val.data.data2[trindex].value.descr)}</a></div>            
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
 
 {else}
 {* настройки инструмента *}
  {if !$adm_object->GetResult('fieldslist')}
   <div style="margin-left: 4px; color: #FF0000">Для данного инструмента не определены надстройки!</div>  
  {else}
   {literal}
   <script type="text/javascript">         
    function PrepereSent(th) {		 		 	 
	 $('#globalbodydata').css('cursor', 'wait');
     th.rb.disabled = true;
	 return true; 	
	}//PrepereSent
	
	function PrepereToReset(th) {
	 if (!confirm(
	  "Вы действительно хотите сбросить все установленные надстройки на `системные`, использующиеся по умолчанию?"
	 )) { return false; }
	 return PrepereSent(th);	
	}//PrepereToReset
   </script>
   {/literal}  
   
   <form method="post" name="toolopt" id="toolopt" onsubmit="return PrepereSent(this)">
    {foreach from=$adm_object->GetResult('fieldslist') item=val name=val} 
	 <div style="margin-top: 12px">
	   
     {if $val.type == 'boolean'}
      <div class="typelabel">
      <input type="checkbox"{if $val.value} checked="checked"{/if} style="cursor: pointer" name="{$val.fname}" id="{$val.fname}"><label for="{$val.fname}" style="cursor: pointer">&nbsp;{$val.descr}</label>
      </div>     
     {else}
	   
      <div class="typelabel">{$val.descr}</div>
      <div class="typelabel">
       {if $val.type == 'array'}
        <textarea class="int_text" style="height: 100px; width: 95%" name="{$val.fname}" id="{$val.fname}">{$adm_object->GetArrayAsString($val.value)}</textarea>             
       {else}
        {if $val.select}
         
         <label> 
          <select class="combobox" name="{$val.fname}" id="{$val.fname}" style="width: 370px">
           {foreach from=$adm_object->GetStrings($val.value) item=str name=str}
            <option value="{$str.ident}"{if $str.isselect} selected="selected" style="color: #0000FF"{/if}>{if $str.ident}{$str.ident} ({$str.strdescr}){else}{$str.strdescr}{/if}</option>
           {/foreach}             
          </select>
		 </label>
         
        {else}       
         <input type="text" class="inpt" style="width: 370px" name="{$val.fname}" id="{$val.fname}" value="{$val.value}">
		{/if}     
       {/if}      
	  </div>
	  	  	 
	 {/if}
	 </div>	 
   {/foreach}
   
   <div class="typelabel" style="margin-top: 15px">
    <input type="submit" value="&nbsp;Сохранить изменения&nbsp;" class="button" name="rb" id="rb">
   </div>
   
   <input type="hidden" value="do" name="actiontosavetoolopt">
   </form>   
   
   <div style="margin-top: 20px; border-top: 1px solid #C0C0C0; padding-top: 8px">
   <form method="post" name="restsubopt" id="restsubopt" onsubmit="return PrepereToReset(this)">
    <input type="submit" value="&nbsp;Вернуть все надстройки на стандартные&nbsp;" class="button" name="rb" id="rb">
    <input type="hidden" value="do" name="dorestoresuboptions">
   </form>
   </div>
   
   {if $smarty.post.dorestoresuboptions == 'do'}
    <div style="margin-top: 15px; color: #0000FF">{$adm_object->resetstr}</div>
   {/if}
   
   {if $smarty.post.actiontosavetoolopt == 'do'}
    <div style="margin-top: 8px">
	{if $adm_object->error}
	 <span style="color: #FF0000">{$adm_object->error}</span>
	{else}
	 <span style="color: #008000">Настройки успешно изменены!</span>
	{/if}
	</div>
   {/if}
    
   {literal}
   <script type="text/javascript">
    $(function() { $('select.combobox').combobox(); });	
   </script>
   {/literal} 
    
  {/if}
 {/if} 
 
</div>