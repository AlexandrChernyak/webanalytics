{* надстройки сайта *}
<div style="margin-top: 4px">
 {if !$adm_object->GetResult('data')}
  <div style="margin-left: 4px; color: #FF0000">Not defined identifiers Site Settings!</div>
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
	  "Do you really want to lose all installed add-on `system`, which are used by default?"
	 )) { return false; }
	 return PrepereSent(th);	
	}//PrepereToReset
  </script>
  {/literal}
 
  <form method="post" name="subopt" id="subopt" onsubmit="return PrepereSent(this)">
    {foreach from=$adm_object->GetResult('data') item=val name=val} 
	 <div style="margin-top: 12px">
	  
	  {if $val.type == 'boolean'}
      <div class="typelabel">
       <input type="checkbox"{if $val.value} checked="checked"{/if} style="cursor: pointer" name="{$val.name}" id="{$val.name}"><label for="{$val.name}" style="cursor: pointer">&nbsp;{$val.descr}</label>
      </div>     
      {else}
     
       <div class="typelabel">{$val.descr}</div>
       <div class="typelabel">
        {if $val.type == 'string'}        
         <label> 
         <select class="combobox" name="{$val.name}" id="{$val.name}" style="width: 370px">
          {foreach from=$adm_object->GetStrings($val.value) item=str name=str}
           <option value="{$str.ident}"{if $str.isselect} selected="selected" style="color: #0000FF"{/if}>{if $str.ident}{$str.ident} ({$str.strdescr}){else}{$str.strdescr}{/if}</option>
          {/foreach}             
         </select>
	     </label>      
        {else}       
         <input type="text" class="inpt" style="width: 370px" name="{$val.name}" id="{$val.name}" value="{$val.value}">
		{/if}          
	   </div>
	  
	 {/if} 
	  	  	 
	 </div>	 
   {/foreach}
   
   <div class="typelabel" style="margin-top: 15px">
    <input type="submit" value="&nbsp;Save Changes&nbsp;" class="button" name="rb" id="rb">
   </div>
   
   <input type="hidden" value="do" name="actiontosavetoolopt">
   </form>
   
   <div style="margin-top: 20px; border-top: 1px solid #C0C0C0; padding-top: 8px">
   <form method="post" name="restsubopt" id="restsubopt" onsubmit="return PrepereToReset(this)">
    <input type="submit" value="&nbsp;Return all add-on standard&nbsp;" class="button" name="rb" id="rb">
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
	  <span style="color: #008000">Add-in successfully changed!</span>
	 {/if}
	</div>
   {/if}
    
   {literal}
   <script type="text/javascript">
    $(function() { $('select.combobox').combobox(); });	
   </script>
   {/literal} 
 
 
 {/if} 
</div>