{* раздел истории финансовых операций
   указанного пользователя
   
   
   $username
*}
 {assign var="translistitems" value=$CONTROL_OBJ->GetUserTransactions($username)}
 
 {* список финансовых операций начало *}      
  <div style="margin-top: 12px">
  <span style="width: 100%">
   <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="white">
   <tr>
    <td class="h_th1" valign="center" align="center" width="80px">Счет №</td>
    <td class="h_td" valign="center" align="center">Направление</td>
    <td class="h_td" valign="center" align="center">Сумма</td>
    <td class="h_td" valign="center" align="left">Описание</td>
    <td class="h_td2" valign="center" align="center">Дата</td>
   </tr>
   {if $translistitems}
   {foreach from=$translistitems item=val name=val}
    <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
     <td class="sth1" valign="center" align="center" width="80px" style="border-left: 1px solid #E3E4E8;">
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
     <td class="sth1" valign="center" align="center" style="border-right: 1px solid #E3E4E8;" width="130px">
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
  </span>
  </div>