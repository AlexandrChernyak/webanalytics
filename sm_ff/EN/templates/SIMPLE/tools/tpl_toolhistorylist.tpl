{* история проверок текущего инструмента 

   $descriptrecords = описание чего проверено общее количество раз,
                      по умолчанию:
                      "Всего проверено сайтов:"
   $tablewidth      = ширина таблици 
                      по умолчанию:
                      "100%"
   $noindexlinks    = false                      
*}
{if $tool_object->GetHistoryData()}
<div style="margin-top: 8px">
 {literal}
 <style type="text/css">
  .h_th1x, .h_tdx, .h_td2x { 
   border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; border-right: none; 
   border-right: none; font-weight: bold; 
  }
  .h_tdx { border-left: none; }
  .h_td2x { border-right: 1px solid #E3E4E8; border-left: none; }
  .btn_nx { border: 1px solid #E3E4E8; border-top: none; height: 25px; margin-top: 4px; }
  .sth1x { border-bottom: 1px solid #E3E4E8; height: 25px; border-top: none; }	
 </style>
 <script type="text/javascript">
  function DoHiglx(th, n) {	
   if (n) { $(th).css('background','#F9FAFB'); } else {   	
    $(th).css('background', 'none');		
   }	
  }//DoHigl	
 </script>
 {/literal} 
 <div>{if !$descriptrecords}Total sites inspected:{else}{$descriptrecords}{/if} <b>{$tool_object->GetHistoryData('', 'recordscount')}</b></div>
 <div style="margin-top: 12px">
 <span style="width: 100%">
  <table width="{if !$tablewidth}100%{else}{$tablewidth}{/if}" cellpadding="0" cellspacing="0" border="0">  
    <thead>	
     <tr>
 
      <th class="h_th1x" valign="center" align="left">
       <label style="margin-left: 4px;">URL</label>
      </th>
  	  
      <th class="h_td2x" valign="center" align="right" width="130px">
       <label style="margin-right: 4px;">Date</label>
      </th>
      
     </tr>   	
    </thead>   
    
    {foreach from=$tool_object->GetHistoryData('', 'source') item=val name=val}
     <tr onmouseover="DoHiglx(this, 1)" onmouseout="DoHiglx(this, 0)">      
      <td class="sth1x" valign="center" align="left" style="border-left: 1px solid #E3E4E8; padding-left: 4px">
  	   {if $noindexlinks}<noindex>{/if}<a {if $noindexlinks}rel="nofollow" {/if}href="{$smarty.const.W_SITEPATH}tools/{$tool_object->section_id}/{$val.linkcheck}" target="_blank">{$tool_object->CorrectURLLink($val.linkcheck, 50)}</a>{if $noindexlinks}</noindex>{/if}  
      </td>
         
      <td class="sth1x" valign="center" align="right" width="130px" style="border-right: 1px solid #E3E4E8; padding-right: 4px">
       {$val.datecreat}
      </td>    
     </tr>  
    {/foreach}

  </table>
  <div style="text-align: right; margin-top: 10px">{$tool_object->GetHistoryData('', 'pagestext')}</div>
 </span>
 </div>  
</div>
{/if}