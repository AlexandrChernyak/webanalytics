{* блок комментариев 
   
   вывод независимых комментариев для указанного содержимого  
*}
 
 {if $global_data_list_info.commentsdata}
  <div style="margin-top: 16px">
   <div id="comments" style="">Comments: <b>{$global_data_list_info.commentscount}</b></div>
   {include file="items/comments_data_block.tpl" commfor=$global_data_list_info.iditem commdescr=$global_data_list_info.ttitle}
  </div>
 {/if} 