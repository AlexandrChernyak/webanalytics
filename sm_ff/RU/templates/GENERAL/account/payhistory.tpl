{* финансовые операции *}
<div>
 <a style="color: #008000" href="{$smarty.const.W_SITEPATH}account/payhistory/&new=1">Пополнить баланс</a>&nbsp;|&nbsp;
 <a href="{$smarty.const.W_SITEPATH}account/payhistory/"{if !$smarty.get.fromref && !$smarty.get.new && !$smarty.get.status} style="color: #000000"{/if}>Все операции (<label style="color: #000000">{$transactions_count.all}</label>)</a>&nbsp;|&nbsp;
 <a href="{$smarty.const.W_SITEPATH}account/payhistory/&fromref=1"{if $smarty.get.fromref} style="color: #000000"{/if}>Реферальные зачисления (<label style="color: #000000">{$transactions_count.ref}</label>)</a>
</div>
<div style="margin-top: 18px">
{if $smarty.get.new}
 {* пополнение баланса *}
 {include file="account/payhistoryadd.tpl"} 
{else}
 {if $smarty.get.status && $smarty.get.t && isset($status_list_text)}
  {* статус платежа *}
  <div>
  <div>Описание: <b>{$status_list_text.descr}</b></div>
  <div style="margin-top: 12px;{if $status_list_text.isok} color: #008000{else}color: #FF0000{/if}">
   <b>{$status_list_text.status}</b>
  </div>  
  </div>
 {else}
  {* список финансовых операций начало *}   
  {literal}  
  <style type="text/css">
   .h_th1, .h_td, .h_td2 { 
    border: 1px solid #E4D9CB; background: #EEE7DF; height: 25px; border-bottom: none; 
    border-right: none; font-weight: bold; 
   }
   .h_td { border-left: none; }
   .h_td2 { border-right: 1px solid #E4D9CB; border-left: none; }
   .btn_n { border: 1px solid #E4D9CB; border-top: none; height: 25px; margin-top: 4px; }
   .sth1 { border-bottom: 1px solid #E4D9CB; height: 25px; border-top: none;}	
  </style>  
  <script type="text/javascript">
   function DoHigl(th, n) {	
    if (n) { $(th).css('background','#F8F5F1'); } else {   	
     $(th).css('background', 'none');		
    }	
   }//DoHigl	
  </script> 
  {/literal}   
  <div style="margin-top: 12px">
  <span style="width: 100%">
   <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <td class="h_th1" valign="center" align="center" width="80px">Счет №</td>
    <td class="h_td" valign="center" align="center">Направление</td>
    <td class="h_td" valign="center" align="center">Сумма</td>
    <td class="h_td" valign="center" align="left">Описание</td>
    <td class="h_td2" valign="center" align="center">Дата</td>
   </tr>
   {if $transactions_list && $transactions_list.source}
   {foreach from=$transactions_list.source item=val name=val}
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
     <td class="sth1" valign="center" align="center" width="80px" style="border-left: 1px solid #E4D9CB;">
	 {$val.specidtran}
	 </td>
     <td class="sth1" valign="center" align="center" width="80px">
	 {if $val.opertype == 'add'}
	 <img src="{$smarty.const.W_SITEPATH}img/items/line_double_arrow_end.png" width="19" height="19">
	 {else}
	  {if $val.opertype == 'sub'}
	   <img src="{$smarty.const.W_SITEPATH}img/items/line_double_arrow_begin.png" width="19" height="19">
	  {else}
	   SET
	  {/if}
	 {/if} 
	 </td>
     <td class="sth1" valign="center" align="center" width="80px">
     {if $val.opertype == 'add'}
      <label style="background: #DCE6DB">{$val.sumdata} USD</label>
	 {else}
	  {$val.sumdata} USD
	 {/if}
	 </td>
     <td class="sth1" valign="center" align="left">
	 {$val.descript}
	 </td>
     <td class="sth1" valign="center" align="center" style="border-right: 1px solid #E4D9CB;" width="130px">
	 {$val.datedata}
	 </td>
    </tr>
    {/foreach}
    {else}
    <tr>
     <td valign="center" align="center" class="btn_n" colspan="5">
      Нет операций!
     </td>
    </tr>
    {/if}   
   </table>   
  {if $transactions_list && $transactions_list.source}
  <div style="text-align: right; margin-top: 10px">{$transactions_list.pagestext}</div>
  {/if}
  </span>
  </div>    
 {* список операций конец *}
 {/if}
{/if}
</div>