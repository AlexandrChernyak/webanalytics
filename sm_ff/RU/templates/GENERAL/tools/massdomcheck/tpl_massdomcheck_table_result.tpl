{* таблица результата обработки доменов *}
<div>
{literal}
 <style type="text/css">
  .h_th1, .h_td, .h_td2 { 
   border: 1px solid #E4D9CB; background: #EEE7DF; height: 25px; border-bottom: none; border-right: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E4D9CB; border-left: none; }
  .btn_n { border: 1px solid #E4D9CB; border-top: none; height: 25px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E4D9CB; height: 25px; border-top: none; }	
</style> 
<script type="text/javascript">
  function DoHigl(th, n) {	
   if (n) { $(th).css('background','#F8F5F1'); } else {   	
    $(th).css('background', 'none');		
   }	
  }//DoHigl	
</script>
{/literal}

<span style="width: 100%"> 
<table width="96%" cellpadding="0" cellspacing="0" border="0" id="tableresultsourceid">
	
 <thead>	
 <tr>
  <th class="h_th1" valign="center" align="left">
  <label style="margin-left: 4px;">Хост сайта</label><label class="bgshort">&nbsp;</label>
  </th>	
  <th class="h_td2" valign="center" align="right" width="140px">
  <label style="margin-right: 4px;">Статус</label><label class="bgshort">&nbsp;</label>
  </th>
 </tr>   	
 </thead>
 
 <tbody>{include file="tools/massdomcheck/tpl_massdomcheck_table_result_add_row.tpl"}</tbody>
  
</table>   
</span>
</div>