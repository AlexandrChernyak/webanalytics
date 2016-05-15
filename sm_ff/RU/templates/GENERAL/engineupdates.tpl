{* публичный раздел апдейтов поисковиков *}
<div style="margin-top: 4px">
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
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <td class="h_th1" valign="center" align="center"><label id="red">Я</label>ндекс ТиЦ</td>
	<td class="h_td" valign="center" align="center"><label id="red">Я</label>ндекс.Поиск</td>	
	<td class="h_td" valign="center" align="center"><label id="red">Я</label>ндекс.Каталог</td>	
	<td class="h_td2" valign="center" align="center"><label style="color: #3886AF">G</label><label id="red">o</label><label style="color: #BFBF00">o</label><label style="color: #3886AF">gl</label><label id="red">e</label> PageRang</td>
   </tr>	
   {if $global_data_list_info.maxcount}     
    {section name=curindex loop=$global_data_list_info.data.1.data.source} 
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	 
     <td class="sth1" valign="center" align="center" style="border-left: 1px solid #E4D9CB">
	  {if !$global_data_list_info.data.1.data.source[curindex].dateupd}-{else}	  
	   {$CONTROL_OBJ->DateToSpecialFormat($global_data_list_info.data.1.data.source[curindex].dateupd, $smarty.const.W_ADMENGINEUPDATESFORMATVIEW)}
	  {/if}	    
	 </td>
	 
	 <td class="sth1" valign="center" align="center">
	  {if !$global_data_list_info.data.2.data.source[curindex].dateupd}-{else}	  
	   {$CONTROL_OBJ->DateToSpecialFormat($global_data_list_info.data.2.data.source[curindex].dateupd, $smarty.const.W_ADMENGINEUPDATESFORMATVIEW)}
	  {/if}	  
	 </td>
	 
	 <td class="sth1" valign="center" align="center">
	  {if !$global_data_list_info.data.3.data.source[curindex].dateupd}-{else}	  
	   {$CONTROL_OBJ->DateToSpecialFormat($global_data_list_info.data.3.data.source[curindex].dateupd, $smarty.const.W_ADMENGINEUPDATESFORMATVIEW)}
	  {/if}	  
	 </td>

	 <td class="sth1" valign="center" align="center" style="border-right: 1px solid #E4D9CB;">
	  {if !$global_data_list_info.data.4.data.source[curindex].dateupd}-{else}	  
	   {$CONTROL_OBJ->DateToSpecialFormat($global_data_list_info.data.4.data.source[curindex].dateupd, $smarty.const.W_ADMENGINEUPDATESFORMATVIEW)}
	  {/if}
	 </td>
    </tr>	
	{/section}	
   {else}
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="4">
     Нет активных апдейтов!
    </td>
   </tr> 
   {/if} 
 </table>
 {if $global_data_list_info.maxcount && $global_data_list_info.pages}
 <div style="text-align: right; margin-top: 10px">{$global_data_list_info.pages}</div>
 {/if}
 </span>
</div>