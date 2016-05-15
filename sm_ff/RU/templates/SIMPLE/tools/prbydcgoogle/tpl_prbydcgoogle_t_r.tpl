{* таблица результата обработки *}
<div>
{literal}
 <style type="text/css">
  .h_th1, .h_td, .h_td2 { 
   border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; border-right: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E3E4E8; border-left: none; }
  .btn_n { border: 1px solid #E3E4E8; border-top: none; height: 37px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E3E4E8; height: 37px; border-top: none; }	
</style> 
<script type="text/javascript">
  function DoHigl(th, n) {	
   if (n) { $(th).css('background','#F9FAFB'); } else {   	
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
  <label style="margin-left: 4px;">Датацентр</label><label class="bgshort">&nbsp;</label>
  </th>
    
  <th class="h_td" valign="center" align="left" width="140px">
  <label style="margin-left: 4px;">Время</label><label class="bgshort">&nbsp;</label>
  </th>
  	
  <th class="h_td2" valign="center" align="right" width="90px">
  <label style="margin-right: 4px;">Google PR</label><label class="bgshort">&nbsp;</label>
  </th>
 </tr>   	
 </thead>
 
 <tbody>{include file="tools/prbydcgoogle/tpl_prbydcgoogle_t_r_add_row.tpl"}</tbody>
  
</table>   
</span>
</div>