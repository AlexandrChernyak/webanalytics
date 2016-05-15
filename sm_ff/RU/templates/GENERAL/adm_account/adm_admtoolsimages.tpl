{* иконки инструментов *}
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
            
            <td valign="top" align="left" width="67px" style="padding-left: 2px; padding-top: 2px">
             <img src="{$CONTROL_OBJ->GetToolImageStyle($val.data.data1[trindex].name, 128, '', '')}" style="width: 64px; height: 64px">            
            </td>
            
            <td valign="top" align="left" style="padding-top: 2px">
             <div>
             <img src="{$CONTROL_OBJ->GetToolImageStyle($val.data.data1[trindex].name, 16, '', '')}" style="width: 16px; height: 16px; margin-right: 2px">
             
             <a href="{$smarty.const.W_SITEPATH}account/admtoolsimages/?toolid={$val.data.data1[trindex].name}">{$CONTROL_OBJ->GetText($val.data.data1[trindex].value.descr)}</a></div>            
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
            
            <td valign="top" align="left" width="67px" style="padding-left: 2px; padding-top: 2px">
             <img src="{$CONTROL_OBJ->GetToolImageStyle($val.data.data2[trindex].name, 128, '', '')}" style="width: 64px; height: 64px">            
            </td>
            
            <td valign="top" align="left" style="padding-top: 2px">
             <div>
             <img src="{$CONTROL_OBJ->GetToolImageStyle($val.data.data2[trindex].name, 16, '', '')}" style="width: 16px; height: 16px; margin-right: 2px">
             
             <a href="{$smarty.const.W_SITEPATH}account/admtoolsimages/?toolid={$val.data.data2[trindex].name}">{$CONTROL_OBJ->GetText($val.data.data2[trindex].value.descr)}</a></div>            
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
 {* настройка иконок инструмента *}
  
 {literal}
 <script type="text/javascript">
  function DoSendForm(th) {
   th.rb.disabled = true;
   $('#globalbodydata').css('cursor', 'wait');
   return true;
  }//DoSendForm	
 </script> 
 {/literal} 
  
 <div style="margin: 0 0 20px 0">
 Инструмент: <a href="{$smarty.const.W_SITEPATH}tools/{$smarty.get.toolid}/" target="_blank">{$CONTROL_OBJ->GetText($adm_object->GetToolParam($smarty.get.toolid, 'descr'))}</a>
 </div>   
  
 <div> 
  <div class="typelabel" style="background: #F3F5F5; padding: 3px"><strong>Иконка до 16x16</strong></div>
  <div style="margin: 6px 0 6px 0">
   <img src="{$CONTROL_OBJ->GetToolImageStyle($smarty.get.toolid, 16, '', '')}" style="width: 16px; height: 16px">
  </div>
  
  <form method="post" name="icon16" id="icon16" enctype="multipart/form-data" onsubmit="return DoSendForm(this)">
   
   <div class="typelabel"> Иконка инструмента (форматы: {$adm_object->GetListTypes()}{if $adm_object->GetResult('maxsize16')}, максимальный размер: <b>{$adm_object->GetResult('maxsize16')}</b>){/if}</div>
   <div style="font-size: 95%">Для удаления изображения - оставьте поле пустым.</div>
   <div class="typelabel">
    <input type="file" size="20" style="width: 95%; height: 22px" class="inpt" name="image16" id="image16">
   </div>
   
   <div class="typelabel">
    <input type="checkbox" style="cursor: pointer" name="resizeimage16" id="resizeimage16"{if $adm_object->CheckPostValue('resizeimage16')} checked="checked"{/if} /><label for="resizeimage16" style="cursor: pointer">&nbsp;Уменьшить изображение до 16x16 если высота или ширина больше 16px</label>
   </div>
   
   <input type="hidden" value="do" name="doloadimage16" />
   <div class="typelabel" style="margin-top: 10px">
     <input type="submit" value="&nbsp;Сохранить&nbsp;" class="button" name="rb" id="rb">
   </div>
  
  </form> 
  {if $smarty.post.doloadimage16 == 'do'}
   <div style="margin-top: 6px">
    {if $adm_object->error}
      <div style="color: #FF0000">{$adm_object->error}</div>
    {else}
      <div style="color: #008000">Иконка успешно установлена!</div>
    {/if}
   </div>
  {/if}
 </div> 
  
  
 <div style="margin-top: 25px"> 
  <div class="typelabel" style="background: #F3F5F5; padding: 3px"><strong>Иконка до 64x64</strong></div>
  <div style="margin: 6px 0 6px 0">
   <img src="{$CONTROL_OBJ->GetToolImageStyle($smarty.get.toolid, 128, '', '')}" style="width: 64px; height: 64px">
  </div>
  
  <form method="post" name="icon64" id="icon64" enctype="multipart/form-data" onsubmit="return DoSendForm(this)">
   
   <div class="typelabel"> Иконка инструмента (форматы: {$adm_object->GetListTypes()}{if $adm_object->GetResult('maxsize64')}, максимальный размер: <b>{$adm_object->GetResult('maxsize64')}</b>){/if}</div>
   <div style="font-size: 95%">Для удаления изображения - оставьте поле пустым.</div>
   <div class="typelabel">
    <input type="file" size="20" style="width: 95%; height: 22px" class="inpt" name="image64" id="image64">
   </div>
   
   <div class="typelabel">
    <input type="checkbox" style="cursor: pointer" name="resizeimage64" id="resizeimage64"{if $adm_object->CheckPostValue('resizeimage64')} checked="checked"{/if} /><label for="resizeimage64" style="cursor: pointer">&nbsp;Уменьшить изображение до 64x64 если высота или ширина больше 64px</label>
   </div>
   
   <input type="hidden" value="do" name="doloadimage64" />
   <div class="typelabel" style="margin-top: 10px">
     <input type="submit" value="&nbsp;Сохранить&nbsp;" class="button" name="rb" id="rb">
   </div>
  
  </form> 
  {if $smarty.post.doloadimage64 == 'do'}
   <div style="margin-top: 6px">
    {if $adm_object->error}
      <div style="color: #FF0000">{$adm_object->error}</div>
    {else}
      <div style="color: #008000">Иконка успешно установлена!</div>
    {/if}
   </div>
  {/if}  
 </div>    
  
  
 {/if} 
</div>