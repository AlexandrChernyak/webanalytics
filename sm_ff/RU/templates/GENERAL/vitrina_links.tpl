{* публичный раздел витрины ссылок *}
<div style="margin-top: 4px">
 <div><a{if $smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}vitrinalinks/new=1">Добавить ссылку</a>{if $smarty.get.new}<span style="display: inline-block; margin-left: 12px"><a href="{$smarty.const.W_SITEPATH}vitrinalinks/">Список ссылок</a></span>{/if}</div>
 
 <div style="margin-top: 16px">
  {if !$smarty.get.new}
  
   {if !$global_data_list_info.data}
   <div style="margin-left: 5px">Нет активных ссылок!</div>
   {else}
   
     <div style="margin-top: 10px; border: 1px dashed #C0C0C0; padding: 3px">
	  Всего ссылок: <b>{$global_data_list_info.count}</b>
	 </div>
	 <div style="margin-top: 14px"></div>
   
    {literal}
    <script type="text/javascript">
    function DoHigl(th, n) {	
     if (n) { $(th).css('background','#F8F5F1'); } else {   	
      $(th).css('background', 'none');		
     }	
    }//DoHigl	
    </script>
    {/literal}
    {foreach from=$global_data_list_info.data item=val name=val}
    <div style="margin-top: 12px" onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)" style="padding: 2px">
	 <span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
      <tr>
      
	   <td valign="top" align="left" width="140px">
	    <img src="http://mini.site-shot.com/1024x768/120/jpeg/?http://{$val.lhost}" width="120" height="90">
	   </td>
	   
	   <td valign="top" align="left">
	    <div>{if !$val.isindexed}<noindex>{/if}{if $val.isbolded}<b>{/if}<a href="http://{$val.lurl}"{if !$val.isindexed} rel="nofollow"{/if} target="_blank">{$val.ltext}</a>{if $val.isbolded}</b>{/if}{if !$val.isindexed}</noindex>{/if}</div>
	    <div style="color: #969696; font-size: 95%; margin-top: 4px"><noindex>{$val.lurl}</noindex></div>
	    <div style="color: #969696; font-size: 95%; margin-top: 4px">{$val.ldate}</div>
	   </td>
	   
      </tr>
     </table>
	 </span>
	</div>
    {/foreach}
   {/if} 
  
  {else}
  {* добавление ссылки *}
   {if !$CONTROL_OBJ->IsOnline()}
    <div style="color: #FF0000">Пожалуйста, авторизируйтесь или зарегистрируйтесь..</div>   
   {else}
    {if !$_VITRINALINKSOPTIONS.enabled || !$_VITRINALINKSOPTIONS.defprice || $_VITRINALINKSOPTIONS.defprice < 0}
     <div style="color: #FF0000">Добавление ссылок на витрину временно закрыто администратором..</div>
    {else}
     
     {literal}
      <script type="text/javascript">
	    function RestInp(th) {
         if (!th.value) {
          th.className = 'inpt_r';
          return ;   	
         } 
         th.className = 'inpt';	
        }//RestInp
        
        function PrepereSent(th) {
         RestInp(th.url);
		 RestInp(th.urltext);		 	
		 if (trim(th.url.value) == '') {
		  alert('Укажите URL ссылки!');
		  th.url.focus();
		  return false;	
		 }
		 if (trim(th.urltext.value) == '') {
		  alert('Укажите текст ссылки!');
		  th.urltext.focus();
		  return false;	
		 }
		 if (th.ptype.value < 1 || th.ptype.value > 4) {
		  alert('Укажите тип ссылки!');
		  return false;	
		 }		 
		 var price = GetPriced();
		 if (!price) { alert('Не определена сумма добавления ссылки!'); return false; }
		 //confirm
		 if (!confirm("Вы действительно хотите добавить ссылку на витрину ссылок?\r\nПо выбранному Вами типу ссылки с Вашего баланса будет снята сумма в размере ["+ price + " USD]\r\n\r\nВы действительно хотите продолжить?")) {
		  return false;	
		 }		 
		 $('#globalbodydata').css('cursor', 'wait');
         th.rb.disabled = true;
		 return true; 	
		}//PrepereSent
		
		function SetTyped(n) { $('#ptype').val(n); $('#summprice').html(GetPriced() + ' USD'); }
		
		function GetPriced() {
		 var price = $('#ptype').val();
		 if (!price) { $('#ptype').val(1); price = 1; }
		 if (price == '1') { return '{/literal}{$_VITRINALINKSOPTIONS.defprice}{literal}'; } else 
		 if (price == '2') { return '{/literal}{$_VITRINALINKSOPTIONS.boldprice}{literal}'; } else
		 if (price == '3') { return '{/literal}{$_VITRINALINKSOPTIONS.indexprice}{literal}'; } else
		 if (price == '4') { return '{/literal}{$_VITRINALINKSOPTIONS.indexboldprice}{literal}'; } else
		 return '0';		 	
		}//GetPriced
      </script>
     {/literal}
     
     <div style="margin-top: 10px; border: 1px dashed #C0C0C0; padding: 3px">
	  При добавлении ссылки, добавленный вами URL встает на первое место витрины.<br />
	  Добаленный после вашего URL, сдвигает Ваш на 1 позицию вниз. 
	  После <b>{$_VITRINALINKSOPTIONS.countinblock}</b> добавленных ссылок Ваш URL перестает отображаться на
	  витринах сайта (за исключением 
	  <a href="{$smarty.const.W_SITEPATH}vitrinalinks/" target="_blank">страницы</a> списка витрины). 
	  На странице списка витрины отображаются все <b>{$_VITRINALINKSOPTIONS.countinpage}</b> ссылок.
	  Ссылка удаляется навсегда после <b>{$_VITRINALINKSOPTIONS.countinpage}</b> сдвигов.
	 </div>
	 <div style="margin-top: 14px"></div>
	 
	 
     <form method="post" name="addlink" id="addlink" onsubmit="return PrepereSent(this)">
      <div class="typelabel"><label id="red">*</label> URL ссылки (до 120 символов)</div>
      <div class="typelabel">
       <input type="text" class="inpt" style="width: 300px" name="url" id="url" maxlength="120" value="{$CONTROL_OBJ->GetPostElement('url','addaction')}" onclick="RestInp(this)" onblur="RestInp(this)">
      </div>
      
      <div class="typelabel"><label id="red">*</label> Текст ссылки (до 80 символов)</div>
      <div class="typelabel">
       <input type="text" class="inpt" style="width: 300px" name="urltext" id="urltext" maxlength="80" value="{$CONTROL_OBJ->GetPostElement('urltext','addaction')}" onclick="RestInp(this)" onblur="RestInp(this)">
      </div>
      
      <div class="typelabel">
       <input type="radio"{if $smarty.post.addaction != 'do' || $smarty.post.ptype == '1'} checked="checked"{/if} style="cursor: pointer" name="selecttype" id="setdeflink" onclick="SetTyped(1)"><label for="setdeflink" style="cursor: pointer">&nbsp;Стандартная ссылка</label>
      </div>
      
      {if $_VITRINALINKSOPTIONS.boldprice}
       <div class="typelabel">
       <input type="radio"{if $smarty.post.addaction == 'do' && $smarty.post.ptype == '2'} checked="checked"{/if} style="cursor: pointer" name="selecttype" id="setboldlink" onclick="SetTyped(2)"><label for="setboldlink" style="cursor: pointer">&nbsp;Жирная ссылка (<b>bold</b>)</label>
      </div>
      {/if}
      
      {if $_VITRINALINKSOPTIONS.indexprice}
       <div class="typelabel">
       <input type="radio"{if $smarty.post.addaction == 'do' && $smarty.post.ptype == '3'} checked="checked"{/if} style="cursor: pointer" name="selecttype" id="setdefindex" onclick="SetTyped(3)"><label for="setdefindex" style="cursor: pointer">&nbsp;Стандартная ссылка (индексируемая) (без тэга &lt;noindex&gt;)</label>
      </div>
      {/if}
      
      {if $_VITRINALINKSOPTIONS.indexboldprice}
       <div class="typelabel">
       <input type="radio"{if $smarty.post.addaction == 'do' && $smarty.post.ptype == '4'} checked="checked"{/if} style="cursor: pointer" name="selecttype" id="setboldindex" onclick="SetTyped(4)"><label for="setboldindex" style="cursor: pointer">&nbsp;Жирная ссылка (индексируемая) (<b>bold</b> + без тэга &lt;noindex&gt;)</label>
      </div>
      {/if}  
	  
	  <div class="typelabel" style="margin-top: 15px">
	   Сумма размещения ссылки: <b id="summprice">0 USD</b>
	  </div>    
      
      <div class="typelabel" style="margin-top: 15px">
       <input type="submit" value="&nbsp;Отправить&nbsp;" class="button" name="rb" id="rb">
      </div>
      
      <input type="hidden" value="do" name="addaction">
      <input type="hidden" value="{$CONTROL_OBJ->GetPostElement('ptype','addaction')}" name="ptype" id="ptype">
     </form>   
     
     {literal}
     <script type="text/javascript">
	  $('#summprice').html(GetPriced() + ' USD');
     </script>
     {/literal}
     
     <div style="margin-top: 18px">
     {if $smarty.post.addaction == 'do'}
      {if $global_data_list_info.error}
       <div style="color: #FF0000">{$global_data_list_info.error}</div>
	  {else}
	   <div style="color: #008000">Ссылка успешно добавлена!</div>
	  {/if}      
     {/if}
	 </div>  
     
    {/if} 
   {/if}
  {/if}
 </div> 
</div>