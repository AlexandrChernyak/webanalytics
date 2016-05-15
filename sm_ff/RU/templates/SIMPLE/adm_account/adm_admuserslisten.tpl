{* раздел пользователей *}
<div style="margin-top: 4px">

<div>
<span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0">
<tr>
  <td valign="top" align="left">
   <div class="typelabel">Фильтр показа</div>
   <div class="typelabel">
    <select size="1" name="filter1w" id="filter1w" style="width: 250px" onchange="NavigateActionEx(this)">
	 <option value="0"{if !$smarty.get.filter1} selected="selected"{/if}>Все пользователи</option>
	 <option value="1"{if $smarty.get.filter1 == '1'} selected="selected"{/if}>Только активные</option>
	 <option value="2"{if $smarty.get.filter1 == '2'} selected="selected"{/if}>Только заблокированные</option>
	 <option value="3"{if $smarty.get.filter1 == '3'} selected="selected"{/if}>Только ожидающие подтверждение e-mail</option>
	 <option value="4"{if $smarty.get.filter1 == '4'} selected="selected"{/if}>Заблокированные и ожидающие подтв. e-mail</option>
	 <option value="5"{if $smarty.get.filter1 == '5'} selected="selected"{/if}>С отрицательным балансом</option>
	 <option value="6"{if $smarty.get.filter1 == '6'} selected="selected"{/if}>С положительным балансом</option>
     
     <option value="7"{if $smarty.get.filter1 == '7'} selected="selected"{/if} style="color: #333399">Логин содержит строку</option>
     <option value="8"{if $smarty.get.filter1 == '8'} selected="selected"{/if} style="color: #333399">E-mail содержит строку</option>
     <option value="9"{if $smarty.get.filter1 == '9'} selected="selected"{/if} style="color: #333399">Точное вхождение логина</option>
     
    </select>
   </div> 
   
   <div id="locatefield"{if $smarty.get.filter1 != 7 && $smarty.get.filter1 != 8 && $smarty.get.filter1 != 9} style="visibility: hidden; display: none"{/if}>
    <div class="typelabel">Содержит строку (`Enter` - принять)</div>
    <input type="text" class="inpt" style="width: 250px" name="lcstr" id="lcstr" value="{$smarty.get.lcstr}" maxlength="250"> 
   </div>
   
   {literal}
    <script type="text/javascript">
	 $('#lcstr').keydown(function(e) {
      if (e.keyCode == 13 && $('#lcstr').val() != '') {     
        NavigateActionEx(document.getElementById('filter1w'));        
      }
     });
    </script>
   {/literal}
     
  </td>
  <td valign="top" align="right">
   <div class="typelabel">Фильтр сортировки</div>
   <div class="typelabel">
    <select size="1" name="filter2" id="filter2" style="width: 200px" onchange="NavigateActionEx(this)">
	 <option value="0"{if !$smarty.get.filter2} selected="selected"{/if}>По логину (по возрастанию)</option>
	 <option value="1"{if $smarty.get.filter2 == '1'} selected="selected"{/if}>По логину (по убыванию)</option>
	 <option value="" disabled="disabled">--------</option>
	 <option value="2"{if $smarty.get.filter2 == '2'} selected="selected"{/if}>По e-mail (по возрастанию)</option>
	 <option value="3"{if $smarty.get.filter2 == '3'} selected="selected"{/if}>По e-mail (по убыванию)</option>
	 <option value="" disabled="disabled">--------</option>
	 <option value="4"{if $smarty.get.filter2 == '4'} selected="selected"{/if}>По дате регистрации (по возрастанию)</option>
	 <option value="5"{if $smarty.get.filter2 == '5'} selected="selected"{/if}>По дате регистрации (по убыванию)</option>
	 <option value="" disabled="disabled">--------</option>
	 <option value="6"{if $smarty.get.filter2 == '6'} selected="selected"{/if}>По дате активности (по возрастанию)</option>
	 <option value="7"{if $smarty.get.filter2 == '7'} selected="selected"{/if}>По дате активности (по убыванию)</option>
	 <option value="" disabled="disabled">--------</option>
	 <option value="8"{if $smarty.get.filter2 == '8'} selected="selected"{/if}>По балансу (по возрастанию)</option>
	 <option value="9"{if $smarty.get.filter2 == '9'} selected="selected"{/if}>По балансу (по убыванию)</option>
    </select>
   </div>   
  </td>
</tr>
</table>
</span>
</div>



<div style="margin-top: 4px; border-bottom: 1px solid #969696">&nbsp;</div>

{literal}
<script type="text/javascript">
 var globalsectionpath = {/literal}'{$smarty.const.W_SITEPATH}';{literal}
 var globalpage = {/literal}'{$smarty.get.page}';{literal}
 var globaloldpage = {/literal}'{$smarty.get.oldpage}';{literal}
 var globaladmpath = globalsectionpath + 'account/admuserslisten/';
 
 function NavigateActionEx(th) {	
  if (th.value == '') { return ; }	
  var path = globaladmpath;
  path = path + (($('#filter1w').val()) ? '&filter1='+$('#filter1w').val() : '');
  path = path + (($('#filter2').val()) ? '&filter2='+$('#filter2').val() : '');  
  path = path + (($('#lcstr').val()) ? '&lcstr='+ encodeURIComponent($('#lcstr').val()) : ''); 
  path = path + (($('#perpage').val()) ? '&perpage='+ encodeURIComponent($('#perpage').val()) : '');   
  document.location = path;	
 }//NavigateAction
  
</script>
{/literal}

<div style="margin-top: 5px">
 <span style="width: 100%">
  <table width="100%" cellpadding="0" cellspacing="0">
   <tr>
	<td valign="top" align="left">
    
      <a href="{$smarty.const.W_SITEPATH}account/admuserslisten&new=1{if $smarty.get.page}&oldpage={$smarty.get.page}{/if}{if $smarty.get.filter1}&filter1={$smarty.get.filter1}{/if}{if $smarty.get.filter2}&filter2={$smarty.get.filter2}{/if}{if $smarty.get.perpage}&perpage={$smarty.get.perpage}{/if}"{if $smarty.get.new} style="color: #000000"{/if}>Добавить пользователя</a> | <a{if !$smarty.get.new} style="color: #000000"{/if} href="{$smarty.const.W_SITEPATH}account/admuserslisten/{if $smarty.get.oldpage}&page={$smarty.get.oldpage}{/if}{if $smarty.get.filter1}&filter1={$smarty.get.filter1}{/if}{if $smarty.get.filter2}&filter2={$smarty.get.filter2}{/if}{if $smarty.get.perpage}&perpage={$smarty.get.perpage}{/if}">Список пользователей (<label style="color: #000000">{$adm_object->GetResult('count')}{if $adm_object->GetResult('count_all') != ''} \ <label style="color: #333399">{$adm_object->GetResult('count_all')}</label>{/if}</label>)</a>
    
    </td>
	<td valign="top" align="right" style="padding-right: 2px; white-space: nowrap;">
     
      <script type="text/javascript" src="{$smarty.const.W_SITEPATH}css/panel/menuelements.js"></script>
      
      {literal}
      <script type="text/javascript">
	    jQuery(document).ready(function() {	      
          $('#moreunitblock').domenuitems(); 
          var wtitle = $('#titleoptname').width();
          var wbodyq = $('#bodyoptname');
   
          wtitle = 0 - (wbodyq.width() - wtitle - 20);   
          wbodyq.css('left', wtitle);
          
          $('#perpage').keydown(function(e) {
           if (e.keyCode == 13 && $('#perpage').val() != '' && IisInteger($('#perpage').val(), false)) {     
            NavigateActionEx(document.getElementById('filter1w'));        
           }
          });
          
          //activate          
          $('#emailverifyyes').click(function () { ActivateDeactivateEmailUser(1); });
          $('#emailverifyno').click(function () { ActivateDeactivateEmailUser(0); });
                            
        }); 
          
        function ActivateDeactivateEmailUser(active) {  
         if (GetSelCount() <= 0) { return false; }
          
         $('#moreunitblock').domenuitems({}, 'hide');          
         SetActionP('emailactive'+active);
         $('#commentsform').submit();
         return true;          
             
        }//ActivateDeactivateEmailUser
        
        function AddToGroup(gid) {
          if (GetSelCount() <= 0) { return false; }
          SetActionP('settogroup');
          $('#groupaddparam').val(gid);                    
          $('#commentsform').submit();            
        }//AddToGroup        
      </script>
      <style type="text/css">
        .blockmenuitemshead .blockitemsbody a.addusertogroup{ 
          background: url({/literal}{$smarty.const.W_SITEPATH}{literal}img/items/emblem_symbolic_link.png) transparent no-repeat top left; padding-left: 15px; 
        }
      </style>
      {/literal}
      
	  <span class="blockmenuitemshead" id="moreunitblock" style="text-align: left">
       <ul>
      <li class="menuclickitem" id="titleoptname">Дополнительно</li>   
        <li class="blockitemsbody" id="bodyoptname" style="//min-width: 185px">	
        
		 <div class="divseparator"><span>Подтверждение e-mail..</span></div>
	     <div class="divblocked"><a id="emailverifyyes" href="javascript:">Подтвердить e-mail</a></div>
         <div class="divblocked"><a id="emailverifyno" href="javascript:">Установить `ожидает подтверждения`</a></div> 
          
	     <div class="divseparator"><span>Специальные..</span></div>
	     <div class="divblocked">         
          <div>Кол-во пользователей на</div>
          <div>1 страницу. (Enter - принять)</div>
          <div class="typelabel">
            <input type="text" class="inpt" style="width: 200px" name="perpage" id="perpage" maxlength="3" value="{$smarty.get.perpage}">                    
          </div>          
         </div>
         
         <div class="divseparator"><span>Добавить в группу..</span></div>
         {assign var="usersgroups" value=$CONTROL_OBJ->GetAvaileableUserGroups()}
         
         {if !$usersgroups}
          <div class="divblocked">Нет групп!</div>
         {else}
           {foreach from=$usersgroups item=val name=val}
            <div class="divblocked">
             
            <a id="groupadditem" href="javascript:" class="addusertogroup" onclick="AddToGroup('{$val.iditem}')">{$val.groupname}</a>      
            
            </div>
           {/foreach} 
         {/if} 
         
		  
        </li>   
       </ul>
      </span>     
    
    </td>
   </tr>
  </table>
 </span>
</div>

<div style="margin-top: 12px">
{if !$smarty.get.new}
{* список пользователей *}
{literal}
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = {/literal}{if !$adm_object->GetResult('count')}0{else}1{/if};{literal}  
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
   alert('Выделите хотя бы одного пользователя!'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == 'delete') {
   if (!confirm('Вы действительно хотите удалить ['+count+'] пользователей?')) { return false; }
  } else 
  if (th.actionlistmakes.value == 'enabled') {
   if (!confirm('Вы действительно хотите разблокировать ['+count+'] пользователей?')) { return false; }
  } else
  
  if (th.actionlistmakes.value == 'emailactive1') {
   if (!confirm('Вы действительно хотите подтвердить e-mail ['+count+'] пользователей?')) { return false; }
  } else
  if (th.actionlistmakes.value == 'emailactive0') {
   if (!confirm('Вы действительно хотите снять подтверждение e-mail ['+count+'] пользователей?')) { return false; }
  } else
  
  
  if (th.actionlistmakes.value == 'settogroup') {
   if (!confirm('Вы действительно хотите поместить ['+count+'] пользователей в выбранную группу?')) { return false; }
  } else
    
  if (th.actionlistmakes.value == 'disabled') {
   if (!confirm('Вы действительно хотите заблокировать ['+count+'] пользователей?')) { return false; }
  } else { alert('Неизвестный идентификатор операции!'); return false; }
  return true;   	
 }//PrepereSend
         
 function SetEnabled() {  	
  var count = GetSelCount();
  setElementOpacity(document.getElementById('asid'), (allsaveenabled) ? 1 : 0.3);
  if (count <= 0) {
   setElementOpacity(document.getElementById('did'), 0.3);
   setElementOpacity(document.getElementById('ena'), 0.3);
   setElementOpacity(document.getElementById('dna'), 0.3);
   
   setElementOpacity(document.getElementById('emailverifyyes'), 0.3);
   setElementOpacity(document.getElementById('emailverifyno'), 0.3);
   
   $('body a[id="groupadditem"]').each(function (i) { setElementOpacity(this, 0.3); return true; });
   
   return ;	 
  }
  setElementOpacity(document.getElementById('did'), 1);
  setElementOpacity(document.getElementById('ena'), 1);
  setElementOpacity(document.getElementById('dna'), 1);
  
  setElementOpacity(document.getElementById('emailverifyyes'), 1);
  setElementOpacity(document.getElementById('emailverifyno'), 1);
  
  $('body a[id="groupadditem"]').each(function (i) { setElementOpacity(this, 1); return true; });
  
 }//SetEnabled
 function SetActionP(a) {
  var f = document.getElementById('commentsform');
  if (!f) { return ; }
  f.actionlistmakes.value = a;   	
 }//SetActionP 
 
 function PrepereRequestData(data) { return eval(data); } 
 function ModifyItemData(usid, datavalue, dataid, queryadd) {
  SendDefaultRequest(globaladmpath, 
   'is_ajax_mode=1&usid='+usid+'&type='+dataid+'&value='+encodeURIComponent(datavalue) + queryadd, 'PrepereRequestData'
  );  	
 }//ModifyItemData
 
 function ModifyEmail(usid, value) {
  var res = prompt("Укажите новый E-mail!", value);
  if (!res) { return false; }
  if (value == res || !emailCheck(res)) {
   if (!confirm("Указан некорректный E-mail! Вы хотите повторить ввод?")) { return false; }
   return ModifyEmail(usid, value);   	
  }
  $('#email_link'+usid).html('');
  $('#email_'+usid).html('Сохранение..');
  return ModifyItemData(usid, res, 1, '');  		
 }//ModifyEmail
 
 function ModifyURL(usid, value) {
  var res = prompt("Укажите новый адрес сайта!", value);  
  if (res == null) { return false; }
  if (value == res) {
   if (!confirm("Указан некорректный URL! Вы хотите повторить ввод?")) { return false; }
   return ModifyURL(usid, value);   	
  }
  $('#url_link'+usid).html('');
  $('#url_'+usid).html('Сохранение..');
  return ModifyItemData(usid, res, 2, '');  
 }//ModifyURL
 
 function ShowDlg(usname, usid) {
  $('#usernameblc').html($('#balance_source'+usid).html());
  ShDescrBlock('checkwithmessages', 'withdescriptandsend');  	
 	
  $("#dialog_balance").dialog({
   title: "Баланс пользователя "+usname, 
   width:  450,            
   height: 'auto',         
   modal: true,            
   buttons: {
    "Применить": function() { 
	 //сумма
	 var pricevalue = $('#pricevalue').val();
	 if (!IsFloat(pricevalue) || pricevalue < 0) {
	  alert('Укажите числовое значение суммы (от 0 и выше)! (формат: 0.00)');
	  $('#pricevalue').focus();
	  return ;	
	 }	 	 	 
	 //уведомлять пользователя
	 var checkwithmessages = document.getElementById('checkwithmessages');
	 checkwithmessages = (checkwithmessages && checkwithmessages.checked) ? '1' : '0';
	 //описание
	 var pricedescr = (checkwithmessages) ? encodeURIComponent($('#pricedescr').val()) : '';
	 if (checkwithmessages && !pricedescr) {
	  alert('Укажите описание платежа для истории финансовых операций пользователя!');
	  $('#pricedescr').focus();
	  return ;	
	 }	 
	 //тип операции
	 var balanceaction = $('#balanceaction').text();
	 //confirm action
	 var str = '';
	 if (balanceaction == 'add') {
	  str = "Вы действительно хотите `пополнить` баланс пользователя "+usname+" на сумму "+pricevalue+" USD?";	
	 } else 
	 if (balanceaction == 'sub') {
	  str = "Вы действительно хотите `вычесть` с баланса пользователя "+usname+" сумму "+pricevalue+" USD?";	
	 } else 
	 if (balanceaction == 'set') {
	  str = "Вы действительно хотите `установить` баланс пользователя "+usname+" в сумму "+pricevalue+" USD?";	
	 } else {
	  alert('Неизвестная операция!');
	  return ;	
	 }
	 //check summ
	 if (pricevalue == 0 && balanceaction != 'set') {
	  alert('Для добавления/снятия с баланса пользователя необходимо указать положительную сумму!');
	  $('#pricevalue').focus();
	  return ;		
	 }
	 //check abort	 
	 if (!confirm(str)) { return ; }
	 //action	
	 $('#balance_link'+usid).html('');
     $('#balance_'+usid).html('Сохранение..');
	 $(this).dialog("close");	 
	 return ModifyItemData(usid, pricevalue, 3, 
	  '&checkwithmessages='+checkwithmessages+'&balanceaction='+balanceaction+'&pricedescr='+pricedescr
	 );	 	
	},
    "Отмена": function() { $(this).dialog("close"); }
   },
   resizable: false
  });	
 }//ShowDlg
 
 
 var usernamedefelem = '';
 var bhistoryactive = 0;
 var usiddefelemfsbh = 0;
 
 function PrepereRequestDataHistory(data) { 
  if (!data) {
    $('#b_history_data_source').html('<div align="center">Нет операций</div>');
  } else {
   $('#b_history_data_source').html(data);    
  }
  bhistoryactive = 0;
  $('#balance_history'+usiddefelemfsbh).html('');
  $('#balance_hostory_link'+usiddefelemfsbh).html('Обзор');
  $("#dialog_b_history").dialog({
   title: "История финансовых операций " + usernamedefelem, 
   width:  '80%',            
   height: 'auto',         
   modal: true,            
   buttons: {
    "Закрыть": function() { $(this).dialog("close"); }
   },
   resizable: false
  });   
    
 }//PrepereRequestDataHistory
 
 function ShowDlgBHistory(usname, usid) {
  if (bhistoryactive) {
   return alert('Операция выполняется, пожалуйста, подождите завершение предыдущей операции..'); 
  }  
  bhistoryactive = 1;
  usernamedefelem = usname; 
  usiddefelemfsbh = usid;
  $('#balance_hostory_link'+usid).html(''); 
  $('#balance_history'+usid).html('Загрузка...');  
  SendDefaultRequest(globaladmpath, 'is_ajax_mode=1&usid='+usid+'&type=4&value=' + encodeURIComponent(usname)
  , 'PrepereRequestDataHistory');    
 } //ShowDlgBHistory
 
 function ShowBlockItemsDialog() {
  var selcount = GetSelCount();
  if (selcount <= 0) { return alert('Выделите хотябы одного пользователя!'); }	 
  $("#dialog_locked").dialog({
   title: "Подтверждение блокировки пользователя(ей) ", 
   width:  450,            
   height: 'auto',         
   modal: true,            
   buttons: {
    "Применить": function() { 
	 if (!$('#blockfor').val()) {
	  alert('Укажите причину блокировки!');
	  $('#blockfor').focus();
	  return ;	
	 }
	 if (!confirm('Вы действительно хотите заблокировать '+selcount+' пользователей?')) { return ; } 
	 SetActionP('disabled');
	 $('#disabledstr').val($('#blockfor').val());
	 $('#commentsform').submit();	 	 	
	},
    "Отмена": function() { $(this).dialog("close"); }
   },
   resizable: false
  });  	
 }//ShowBlockItemsDialog
 
 function ShowDialogSaveData() {
  if (!allsaveenabled) { return alert('Нет данных для экспорта!'); }	 	
  $("#dialog_save").dialog({
   title: "Экспорт данных пользователей", 
   width:  450,            
   height: 'auto',         
   modal: true,            
   buttons: {
    "Применить": function() { 	 
	 if (!$('#saveformat').val()) {
	  alert('Укажите формат строки файла экспорта!');
	  $('#saveformat').focus();
	  return ;	
	 }
	 if (!confirm('Вы действительно хотите выполнить экспорт данных?')) { return ; }
	 $('#saveform').submit();	 	 	 	
	},
    "Отмена": function() { $(this).dialog("close"); }
   },
   resizable: false
  });	
 }//ShowDialogSaveData
 
 function ShDescrBlock(ide, ide2) {
  var c = document.getElementById(ide);
  if (c && c.checked) {
   $('#'+ide2).css('display', 'block');
   $('#'+ide2).css('visibility', 'visible');
   return ;	
  }
  $('#'+ide2).css('display', 'none');
  $('#'+ide2).css('visibility', 'hidden');  	
 }//ShDescrBlock
 
 
 
 function PrepereRequestDataSeoPanel(data) {
  bhistoryactive = 0;
  $('#seopanel_link'+usiddefelemfsbh).html('Обзор');
  $('#seopanel_n'+usiddefelemfsbh).html('');
    
  $('#b_seopanel_data_source').html(data); 
  
  $("#dialog_b_seopanel").dialog({
   title: "Сайты панели оптимизатора пользователя ["+usernamedefelem+']' , 
   width:  450,            
   height: 500,         
   modal: true,            
   buttons: {
    "Удалить выбранные": function() { 	 
	 
     if (!WaitActionAjax()) { return false; }
         
     var countul = 0; var query = '';
     
      $('#b_seopanel_data_source div').each(function (i) {               
       var iddiv = $(this).attr('idu');   
       if (iddiv && iddiv != 'undefined') {  
        
        var chid = $('#chur'+iddiv).attr('checked');
        if (chid) {
         query = query + ((query) ? (','+iddiv) : iddiv);
         countul++;
        }
       }                            
      });
     
     if (countul == 0 || !confirm('Вы действительно хотите удалить '+countul+' сайтов пользователя '+usernamedefelem+'?')) {
       return false; 
     }
     
     bhistoryactive = 1;
     SendDefaultRequest(globaladmpath, 'is_ajax_mode=1&usid='+usiddefelemfsbh+'&type=6&value=' + encodeURIComponent(query)
     , 'PrepereRequestDataSeoPanelDel'); 
     	 	 	 	
	},
    "Закрыть": function() { $(this).dialog("close"); }
   },
   resizable: false
  });     
 }//PrepereRequestDataSeoPanel
 
 function PrepereRequestDataSeoPanelDel(data) {
    
  bhistoryactive = 0;
  if (!data) { return false; }
  
  arr = data.split(',');
  
  for (var i=0; i < arr.length; i++) {  
   $('#b_seopanel_data_source div[idu="'+arr[i]+'"]').remove();    
  }  
  
  var countid = $('#seopanel_count'+usiddefelemfsbh).text();
  if (!countid || countid == '') { countid = 0; }
  
  countid-=arr.length;
  if (countid < 0) { countid = 0; }
  
  $('#seopanel_count'+usiddefelemfsbh).html(countid);
  
  if (countid == 0) {
    $('#siteslistitems'+usiddefelemfsbh).html('<div align="center">Нет сайтов!</div>');    
  }    
    
 }//PrepereRequestDataSeoPanelDel
 
 function WaitActionAjax() {
  if (bhistoryactive) {
   alert('Операция выполняется, пожалуйста, подождите завершение предыдущей операции..');
   return false; 
  }  
  return true;
 }//WaitActionAjax
 
 function ShowDlgSeoPanel(usname, usid) {
  if (!WaitActionAjax()) { return false; }    
  
  bhistoryactive = 1;
  usernamedefelem = usname; 
  usiddefelemfsbh = usid;
  $('#seopanel_link'+usid).html(''); 
  $('#seopanel_n'+usid).html('Загрузка...');  
  SendDefaultRequest(globaladmpath, 'is_ajax_mode=1&usid='+usid+'&type=5&value=' + encodeURIComponent(usname)
  , 'PrepereRequestDataSeoPanel');     
    
 }//ShowDlgSeoPanel
 
 function DeleteGroup(groupiditem, iduser, iditem, username) {  
  
  var str = $('#labeldel' + iditem).text();
  if (!confirm('Вы действительно хотите удалить пользователя `'+username+'` из группы `'+str+'`?')) {
    return false;
  }  
  
  $('#deletefromitem' + iditem).html('<label style="color: #0000FF">Удаление..</label>');
  
  SendDefaultRequest(globaladmpath, 'is_ajax_mode=1&groupiditem='+groupiditem+'&iduser='+iduser+'&iditem='+iditem+
  '&type=7', 'PrepereRequestDataDeleteGroup');
    
 }//DeleteGroup
 
 //ok, as {groupiditem:'0-9', iduser:'0-9', iditem:'0-9'}
 function PrepereRequestDataDeleteGroup(data) {
  if (!data) { return false; }
  
  eval('var p = '+data+';');
   
  $('#deletefromitem' + p.iditem).remove();
  $('#groupstr' + p.iditem).remove();
   
  var countff = 0; 
  $('#listlbs' + p.iduser).find('a').each(function (i) {
    countff++;
    return false;    
  });
  
  if (countff <= 0) {
   $('#listlbs' + p.iduser).html('<div class="divblocked">Нет групп!</div>'); 
   $('#descrgroup'+p.iduser).html('<em>(не входит в группы)</em>');   
  }    
    
 }//PrepereRequestDataDeleteGroup
 
   	
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

 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
       <span id="ui-dialog-title-dialog" class="ui-dialog-title">Экспорт данных</span>
       <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
    </div>
    <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_save">
       {literal}
       <style type="text/css">
	    .bbcodein { color: #333399; cursor: pointer }
		.bbcodein:hover { color: #0000FF; cursor: pointer }
       </style>
       {/literal}
       <div class="typelabel">
        <div>Экспорт данных всех пользователей по текущему активному фильтру.</div>
        <div>Используйте формат данных одной строки файла:</div>
        <div><b class="bbcodein" onclick="InsertObhvatData('[name]', '', 'saveformat')">[name]</b> - логин</div>
        <div><b class="bbcodein" onclick="InsertObhvatData('[email]', '', 'saveformat')">[email]</b> - e-mail</div>
        <div><b class="bbcodein" onclick="InsertObhvatData('[url]', '', 'saveformat')">[url]</b> - сайт пользователя</div>
        <div><b class="bbcodein" onclick="InsertObhvatData('[balance]', '', 'saveformat')">[balance]</b> - баланс пользователя</div>
        <div><b class="bbcodein" onclick="InsertObhvatData('[n]', '', 'saveformat')">[n]</b> - перенос строки</div>
        <div><b class="bbcodein" onclick="InsertObhvatData('[lock]', '', 'saveformat')">[lock]</b> - причина блокировки</div>
        <div><b class="bbcodein" onclick="InsertObhvatData('[date]', '', 'saveformat')">[date]</b> - дата регистрации</div>
        <div><b class="bbcodein" onclick="InsertObhvatData('[datex]', '', 'saveformat')">[datex]</b> - дата последней активности</div>
       </div>
       
       <form method="post" name="saveform" id="saveform">      
        <div class="typelabel" style="margin-top: 10px"><span id="red">*</span> Укажите формат экспорта</div>
        <div class="typelabel">
         <input type="text" class="inpt" style="width: 98%" name="saveformat" id="saveformat" value="[email]">        
        </div>
        <input type="hidden" value="do" name="saveitemsaction">
		    
       </form>   
	      
    </div>
 </div>

<form method="post" name="commentsform" id="commentsform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Разблокировать&nbsp;" class="activatelistit" name="ena" id="ena" onclick="SetActionP('enabled')" style="//width: 80px;">
 </span>

 <span style="margin-left: 8px">
  <input type="button" value="&nbsp;Заблокировать&nbsp;" class="deactivatelistit" name="dna" id="dna" onclick="ShowBlockItemsDialog()" style="//width: 80px;">
 </span>
 
 <span style="margin-left: 8px">
  <input type="button" value="&nbsp;Сохранить в .txt&nbsp;" class="saveselectlist" name="asid" id="asid" onclick="ShowDialogSaveData()">
 </span>
 
 </div>
 <div style="margin-top: 6px"> 
  
 
 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
       <span id="ui-dialog-title-dialog" class="ui-dialog-title">Баланс</span>
       <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
    </div>
    <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_balance">   
       <div class="typelabel">Баланс пользователя: <b id="usernameblc">0.00</b> USD</div>
       
	   <div class="typelabel">
        <input type="radio" checked="checked" name="typetobalance" id="typetobalanceadd" style="cursor: pointer" onclick="$('#balanceaction').text('add')"><label style="cursor: pointer" for="typetobalanceadd">&nbsp; Добавить сумму</label>
       </div>
       
       <div class="typelabel">
        <input type="radio" name="typetobalance" id="typetobalancesub" style="cursor: pointer" onclick="$('#balanceaction').text('sub')"><label for="typetobalancesub" style="cursor: pointer">&nbsp; Вычесть сумму</label>
       </div>
       
       <div class="typelabel">
        <input type="radio" name="typetobalance" id="typetobalanceset" style="cursor: pointer" onclick="$('#balanceaction').text('set')"><label for="typetobalanceset" style="cursor: pointer">&nbsp; Установить сумму</label>
       </div>
       
       <div class="typelabel" style="margin-top: 10px"><span id="red">*</span> Сумма (формат: 0.00)</div>
       <div class="typelabel">
        <input type="text" class="inpt" style="width: 98%" name="pricevalue" id="pricevalue" value="0.00">        
       </div>
       
       <div class="typelabel">    
        <input type="checkbox" checked="checked" style="cursor: pointer" name="checkwithmessages" id="checkwithmessages" onclick="ShDescrBlock('checkwithmessages', 'withdescriptandsend')"><label for="checkwithmessages" style="cursor: pointer">&nbsp; С E-mail уведомлением и записью в историю финансовых операций пользователя</label>
       </div>
       
       <div class="typelabel" id="withdescriptandsend">
        <div><span id="red">*</span> Описание для истории финансовых операций пользователя</div>
        <div class="typelabel">
         <input type="text" class="inpt" style="width: 98%" name="pricedescr" id="pricedescr" value="Пополнение баланса администратором" maxlength="240">        
        </div>
       </div>   
       
       <div id="balanceaction" style="display: none; visibility: hidden">add</div>  
	   <div class="typelabel" id="balancestatus"></div>	      
    </div>
 </div>
 
 
 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
       <span id="ui-dialog-title-dialog" class="ui-dialog-title">Причина блокировки</span>
       <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
    </div>
    <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_locked">
       
       <div class="typelabel" style="margin-top: 10px"><span id="red">*</span> Укажите причину блокировки</div>
       <div class="typelabel">
        <input type="text" class="inpt" style="width: 98%" name="blockfor" id="blockfor" value="...">        
       </div>   
	      
    </div>
 </div>
 
 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
       <span id="ui-dialog-title-dialog" class="ui-dialog-title">История финансовых операций</span>
       <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
    </div>
    <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_b_history">
            
       <div class="typelabel" id="b_history_data_source">
                
       </div>   
	      
    </div>
 </div> 
 
 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
       <span id="ui-dialog-title-dialog" class="ui-dialog-title">seo panel</span>
       <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
    </div>
    <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_b_seopanel">
            
       <div class="typelabel" id="b_seopanel_data_source">
                
       </div>   
	      
    </div>
 </div> 
 
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <td class="h_th1" valign="center" align="left" width="20px">
	 <span style="margin-left: 4px">
	  <input type="checkbox" name="checkallitems" id="checkallitems" style="cursor: pointer" onclick="CheckAll(this)">
	 </span>
	</td>	
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Пользователь</span></td>		
	<td class="h_td2" valign="center" align="left" width="1px"></td>
   </tr>	
   {if $adm_object->GetResult('data.source')}
	{foreach from=$adm_object->GetResult('data.source') item=val name=val}
	 <tr onmouseover="DoHigl(this, 1, {$smarty.foreach.val.index})" onmouseout="DoHigl(this, 0, {$smarty.foreach.val.index})" id="t_r_{$smarty.foreach.val.index}">
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8; {if $val.userlocked}background: #FFCCCC{/if}">
	  <span style="margin-left: 4px">
	   {if $val.username != $CONTROL_OBJ->userdata.username}
	   <input type="checkbox" name="chid{$smarty.foreach.val.index}" id="chid{$smarty.foreach.val.index}" 
	   style="cursor: pointer" onclick="CheckItem('{$smarty.foreach.val.index}', this)">
	   {/if}
	  </span>
	 </td>	 
	 <td class="sth1" valign="center" align="left" onclick="$('#chid{$smarty.foreach.val.index}').click()">
	  
	  <div style="margin: 5px 5px 5px 5px">
	   {assign var="avatarinfo" value=$CONTROL_OBJ->GetUserAvatarInfo(false, $val)}
	   <span style="width: 100%">
	   <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
	     <td valign="top" align="left" width="106px">
	     <img width="99" height="99" src="{$avatarinfo.webpath}">	  
	     </td>
	     <td valign="top" align="left">
	      <div style="margin-bottom: 4px; color: #969696">
	       <a href="{$smarty.const.W_SITEPATH}userinfo/{$val.username}/" target="_blank">{$val.username}</a>{if $CONTROL_OBJ->UserIsAdmin($val.username)}<span style="margin-left: 8px"><b style="color: #0000FF">(Администратор)</b></span>{/if}	      
		  </div>
		  <div>
		   <span style="width: 100%">
		   <table width="100%" cellpadding="0" cellspacing="0">
           
		   <tr>
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 E-mail:
			</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 <a href="{$smarty.const.W_SITEPATH}account/mail/new/tousers={$val.username}" target="_blank" style="text-decoration: none;" id="email_source{$val.iduser}">{$val.useremail}</a>
			</td>
			
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			<a href="javascript:" id="email_link{$val.iduser}" style="color: #666699" onclick="ModifyEmail('{$val.iduser}', $('#email_source{$val.iduser}').text())">Изменить</a><label style="color: #0000FF" id="email_{$val.iduser}"></label>
			</td>
			
           </tr>
           
           <tr>
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 Сайт:
			</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 <i id="url_source{$val.iduser}">{if $val.usersite}{$val.usersite}{else}(нет){/if}</i>
			</td>
			
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 <a href="javascript:" id="url_link{$val.iduser}" style="color: #666699" onclick="ModifyURL('{$val.iduser}', $('#url_source{$val.iduser}').text())">Изменить</a><label style="color: #0000FF" id="url_{$val.iduser}"></label>
			</td>
			
           </tr>
           
           <tr>
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 IP:
			</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 {if $val.userip}{$val.userip}</a>{else}<i>(?)</i>{/if}
			</td>
			
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			
			</td>
			
           </tr>
           
           <tr>
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 Хэш пароля:
			</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 {$val.userhash}
			</td>
			
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			
			</td>
			
           </tr>
           
           <tr>
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 Баланс:
			</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 <label id="balance_source{$val.iduser}" {if $val.purcedata}style="color: #008000"{/if}>{$val.purcedata}</label> USD
			</td>
			
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 <a href="javascript:" id="balance_link{$val.iduser}" style="color: #666699" onclick="$('#dialog_balance').dialog('destroy'); ShowDlg('{$val.username}', '{$val.iduser}')">Изменить</a><label style="color: #0000FF" id="balance_{$val.iduser}"></label>			 
			</td>
			
           </tr>
           
           
           <tr>
            {assign var="translistcount" value=$CONTROL_OBJ->GetFinanceTransactionsCount($val.username, false)} 
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">&nbsp;</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 <label id="balance_history_ssk{$val.iduser}">{if $translistcount}<label style="color: #008000"><strong>{$translistcount}</strong> операций</label>{else}<em>(нет операций)</em>{/if}</label>
			</td>		
            
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">{if $translistcount}
			 <a href="javascript:" id="balance_hostory_link{$val.iduser}" style="color: #666699" onclick="ShowDlgBHistory('{$val.username}', '{$val.iduser}')">Обзор</a><label style="color: #0000FF" id="balance_history{$val.iduser}"></label>{/if}			 
			</td>
			
           </tr>  
           
           
           <tr> 
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">SEO Панель</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 сайтов: <label id="seopanel_count{$val.iduser}">{$adm_object->GetSeoPanelSitesCount($val.iduser)}</label>, <a href="{$smarty.const.W_SITEPATH}panel/{$val.iduser}" target="_blank">управление</a>
			</td>		
            
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 <a href="javascript:" id="seopanel_link{$val.iduser}" style="color: #666699" onclick="ShowDlgSeoPanel('{$val.username}', '{$val.iduser}')">Обзор</a><label style="color: #0000FF" id="seopanel_n{$val.iduser}"></label>			 
			</td>
			
           </tr>     
           
           
           <tr> 
            {assign var="groupslist" value=$CONTROL_OBJ->GetUserGroups($val.iduser, 'text-decoration: underline; color: #016C6C')}
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">Группы</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF; font-size: 95%" id="descrgroup{$val.iduser}">
			 {if $groupslist.str}
              {$groupslist.str}
             {else}
             <em>(не входит в группы)</em>
             {/if} 
			</td>		
            
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF; white-space: nowrap;">
			 
             
	        <span class="blockmenuitemshead" id="deletemenublock{$val.iduser}" style="text-align: left">
             <ul>
            <li class="menuclickitem" id="titleoptname">удалить</li>   
              <li class="blockitemsbody" id="bodyoptname" style="//min-width: 185px">	
                        
               {if !$groupslist.str}
                <div class="divblocked">Нет групп!</div>
               {else}
                <div id="listlbs{$val.iduser}">
                <div class="divseparator"><span>Удалить из группы..</span></div>
                 {foreach from=$groupslist.data item=val2 name=val2}
                  <div class="divblocked" id="deletefromitem{$val2.iditem}">
             
                  <a href="javascript:" id="labeldel{$val2.iditem}" onclick="DeleteGroup('{$val2.groupiditem}', '{$val.iduser}', '{$val2.iditem}', '{$val.username}')">{$val2.groupname}</a>      
            
                  </div>
                 {/foreach} 
               {/if}
               </div> 
		  
              </li>   
             </ul>
            </span>
            
            {literal}
              <script type="text/javascript">
	             jQuery(document).ready(function() {	      
                   $('#deletemenublock{/literal}{$val.iduser}{literal}').domenuitems();
                 });
              </script>            
            {/literal}             
             			 
			</td>
			
           </tr>
           
           
           
           
           <tr>
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 Статус:
			</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 {if $val.userlocked}
			  <b style="color: #FF0000">Заблокирован</b><label style="color: #000000; font-size: 95%">, причина: {if $val.userlocked}{$val.userlocked}{else}?{/if}</label>
			 {else}
			  {if !$val.confreg}
			   <span style="color: #FF8080"><i>Ожидает подтверждения E-mail адреса</i></span>
			  {else}
			   <span style="color: #008000"><i>Активен</i><label style="color: #000000; font-size: 95%"> , активность: {$CONTROL_OBJ->GetLastIntervalInDays($val.datelastin)}</label></span>
			  {/if}			 
			 {/if}
			</td>
			
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			
			</td>
			
           </tr>
           
           <tr>
	        <td valign="center" align="left" width="100px" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 Комментариев:
			</td>
	        <td valign="center" align="left" style="padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			 {$adm_object->GetCommentsCountByUser($val.username)}
			</td>
			
			<td valign="center" align="right" width="100px" style="font-size: 95%; padding-top: 3px; padding-bottom: 3px; border-bottom: 1px solid #EFEFEF">
			
			</td>
			
           </tr>
           
           
           
           </table>
		   </span>
		  </div>
		  
		  
		  
		  
		  
		  	  
	     </td>
        </tr>
        <tr>
	     <td valign="top" align="right" colspan="2" style="margin-right: 4px; padding-top: 3px">
	      <div style="margin-bottom: 3px">	      
	       {$CONTROL_OBJ->DateTimeToSpecialFormat($val.datereg)}	   	  
	      </div>  
	     </td>
        </tr>     
       </table>
	   </span>	   
	  </div>
	  
	 </td>	 
	 <td class="sth1" valign="top" align="left" style="border-right: 1px solid #E3E4E8; width: 1px" onclick="$('#chid{$smarty.foreach.val.index}').click()">	 
	 </td>
    </tr>  
	<script type="text/javascript">list_items[{$smarty.foreach.val.index}] = '{$smarty.foreach.val.index}';</script>
	<input type="hidden" value="{$val.iduser}" name="idm{$smarty.foreach.val.index}">
	{/foreach}
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="3">
     Нет пользователей!
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
 <input type="hidden" value="" name="disabledstr" id="disabledstr"> 
 <input type="hidden" value="0" name="groupaddparam" id="groupaddparam">
</form>
<script type="text/javascript">SetEnabled();</script>
{else}
 {* добавление *}
 
 {literal}
 <script type="text/javascript">
  function PrepereSend(th) {
   if (!trim(th.newlogin.value)) {
	alert('Укажите логин пользователя!');
	th.newlogin.focus();
	return false;
   }
   if (!emailCheck(th.newemail.value)) {
	alert('Укажите корректный e-mail!');
	th.newemail.focus();
	return false;
   }
   if (!th.newpass.value) {
	alert('Укажите пароль пользователя!');
	th.newpass.focus();
	return false;
   }
   if (th.newpass.value != th.newpass2.value) {
	alert('Пароли не совпадают!');
	th.newpass2.focus();
	return false;
   }
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;
   return true;   	
  }//PrepereSend	
 </script>
 {/literal}
 <form method="post" name="newuseraddform" id="newuseraddform" onsubmit="return PrepereSend(this)">
  
  <div class="typelabel"><label id="red">*</label> Логин</div>
  <div><input type="text" class="inpt" style="width: 320px" name="newlogin" id="newlogin" value="{$CONTROL_OBJ->GetPostElement('newlogin', 'newuseraction')}" maxlength="100">
  </div>
  
  <div class="typelabel"><label id="red">*</label> E-mail</div>
  <div><input type="text" class="inpt" style="width: 320px" name="newemail" id="newemail" value="{$CONTROL_OBJ->GetPostElement('newemail', 'newuseraction')}">
  </div>
  
  <div class="typelabel"> Сайт</div>
  <div><input type="text" class="inpt" style="width: 320px" name="newsite" id="newsite" value="{$CONTROL_OBJ->GetPostElement('newsite', 'newuseraction')}">
  </div>
  
  <div class="typelabel"><label id="red">*</label> Пароль</div>
  <div><input type="password" class="inpt" style="width: 320px" name="newpass" id="newpass" value="">
  </div>
  
  <div class="typelabel"><label id="red">*</label> Повторите пароль</div>
  <div><input type="password" class="inpt" style="width: 320px" name="newpass2" id="newpass2" value="">
  </div>
 
  
 <input type="hidden" value="do" name="newuseraction">
 <div class="typelabel"><input type="submit" value="&nbsp;Отправить&nbsp;" class="button" name="rb" id="rb"></div>
 </form>
 
 {if $smarty.post.newuseraction == 'do'}
 <div style="margin-top: 8px">
  {if $adm_object->error}
   <label style="color: #FF0000">{$adm_object->error}</label>
  {else}
   <label style="color: #008000">Пользователь успешно добавлен!</label>
  {/if}
 </div>
 {/if} 
  
{/if}
</div>
</div>