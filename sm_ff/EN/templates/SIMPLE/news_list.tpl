{* новости *}
<div style="margin-top: 4px">
 {if $global_data_list_info.error}
  <div style="margin-left: 4px; color: #FF0000">{$global_data_list_info.error}</div>
 {else}
  {* информация о новости *}
  {if $global_data_list_info.info}
  
   <div style="text-align: right; margin-bottom: 6px; padding-right: 3px;">
    <a title="RSS comments feed" href="{$smarty.const.W_SITEPATH}rss/1/{$global_data_list_info.info.iditem}" target="_blank"><img src="{$smarty.const.W_SITEPATH}img/ico/general/feed.png" alt="rss" border="0" /></a>
   </div>
     
   <div>
   {if $global_data_list_info.info.dwnameimg}
    <img src="{$smarty.const.W_SITEPATH}pfiles/images/{$global_data_list_info.info.dwnameimg}" border="0" style="float: left; margin-right: 10px; margin-bottom: 5px">
   {/if} 
   
   <div>{$CONTROL_OBJ->strings->CorrectTextFromDB($global_data_list_info.info.newdata, false, false, $global_data_list_info.info.contenttype)}</div>
   
   {* вложения *}
   {include file="items/attachments-default-block.tpl" filesid=1 objectid=$global_data_list_info.info.iditem}
   
   <div style="margin-top: 3px; border-bottom: 1px solid #969696; width: 20%">
    &nbsp;
   </div>
   <div style="margin-top: 6px; font-size: 95%">
   Date Added: {$global_data_list_info.info.datecreate}, views: {$global_data_list_info.info.newlooks}
   </div>
   <div style="margin-top: 8px">{include file="items/add_bookmarcks_block.tpl"}</div>
   
   {if $global_data_list_info.commentsdata}
   <div style="margin-top: 16px">
    <div id="comments" style="">Comments: <b>{$global_data_list_info.commentscount}</b></div>
    {include file="items/comments_data_block.tpl" commfor=$global_data_list_info.iditem commdescr=$global_data_list_info.info.newtitle}
   </div>
   {/if} 
   
   </div>
  {else}
    {literal}
    <script type="text/javascript">
    function DoHigl(th, n) {	
     if (n) { $(th).css('background','#F9FAFB'); } else {   	
      $(th).css('background', 'none');		
     }	
    }//DoHigl	
    </script>
    {/literal}
   {if $global_data_list_info.selectsection}
    {* выбор типа новостей *}
    
    {assign var="listnewssections" value=$CONTROL_OBJ->GetNewsSectionListElements(false, $smarty.get.identway)}
    
    {if !$listnewssections}	
    <div style="margin-top: 10px; padding: 4px" onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
     <span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
     <tr>
	  <td valign="top" align="left" width="54px">
	   <img src="{$smarty.const.W_SITEPATH}img/ico/general/news_site.png" border="0">
	  </td>
	  <td valign="top" align="left">
	   <div><b><a href="{$smarty.const.W_SITEPATH}news/1/">Site News</a></b></div>
	   <div style="margin-top: 4px; font-size: 95%; color: #808080">
	    News of recent changes in the site. Update tools, partitioning, stocks, etc. ...
	   </div>
	  </td>
     </tr>
     </table>
	 </span>
	</div>
    
    <div style="margin-top: 10px; padding: 4px" onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
     <span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
     <tr>
	  <td valign="top" align="left" width="54px">
	   <img src="{$smarty.const.W_SITEPATH}img/ico/general/news_internet.png" border="0">
	  </td>
	  <td valign="top" align="left">
	   <div><b><a href="{$smarty.const.W_SITEPATH}news/2/">Internet News</a></b></div>
	   <div style="margin-top: 4px; font-size: 95%; color: #808080">
	    News of recent events on the World Wide Web.
	   </div>
	  </td>
     </tr>
     </table>
	 </span>
	</div>	
	
	<div style="padding: 4px; margin-top: 16px"><b><i>No active partitions!</i></b></div>
	
	{else}
    
     <div style="text-align: right; margin-bottom: 6px; padding-right: 3px;">
      <a title="RSS feed" href="{$smarty.const.W_SITEPATH}rss/1/{$CONTROL_OBJ->CorrectSymplyString($smarty.get.identway)}" target="_blank"><img src="{$smarty.const.W_SITEPATH}img/ico/general/feed.png" alt="rss" border="0" /></a>
     </div>
         
     {foreach from=$listnewssections item=val name=val}
     {assign var="itemdescrit" value=$CONTROL_OBJ->strings->CorrectTextFromDB($val.data.sdescr)}   
     <div style="margin-top: 10px; padding: 4px" onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
      <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0">
      <tr>
	   <td valign="top" align="left" width="54px">
	    <img src="{$val.avatar}" border="0">
	   </td>
	   <td valign="top" align="left">
	    <div><b><a href="{$smarty.const.W_SITEPATH}{$val.opt.pathobjects}/{$val.data.iditem}/">{$val.data.sname}</a></b><label style="padding-left: 6px; font-size: 95%; color: #969696"><em>(Contains: {$CONTROL_OBJ->GetPublicNewsCount($val.data.iditem)})</em></label></div>
	    <div style="margin-top: 4px; font-size: 95%; color: #808080">
	     {if !$itemdescrit}No description{else}{$itemdescrit}{/if}
	    </div>
	   </td>
      </tr>
      </table>
	  </span>
	 </div>     
     {/foreach}
    {/if}
        
   {else}
    {* список новостей *}
    <span style="width: 100%">
     {if !$global_data_list_info.data.source}
      <div style="margin-left: 4px">
	  {if $section_info.sectiondataopt && $section_info.sectiondataopt.noelementstext}
	   {$section_info.sectiondataopt.noelementstext}
	  {else}	  
	   No News!
	  {/if}
	  </div>
     {else}     
     
     <div style="text-align: right; margin-bottom: 6px; padding-right: 3px;">
      <a title="RSS feed" href="{$smarty.const.W_SITEPATH}rss/1/{$CONTROL_OBJ->CorrectSymplyString($smarty.get.identway)}/{$CONTROL_OBJ->CorrectSymplyString($smarty.get.ntype)}" target="_blank"><img src="{$smarty.const.W_SITEPATH}img/ico/general/feed.png" alt="rss" border="0" /></a>
     </div>
          
	  {foreach from=$global_data_list_info.data.source item=val name=val}
	  <div style="margin-top: {if $smarty.foreach.val.index == 0}6px{else}28px{/if}; padding: 3px;" onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
	  <tr>
	   <td valign="top" align="left" style="{if !$val.dwnameimg || !$global_data_list_info.showimages}width: 0px{else}width: 68px{/if}">
	    {if $val.dwnameimg && $global_data_list_info.showimages}
	     <img src="{$smarty.const.W_SITEPATH}pfiles/images/{$val.dwnameimg}" border="0" width="64" height="64">
	    {/if}
	   </td>
	   
	   <td valign="top" align="left">
	    <div><b><a href="{$smarty.const.W_SITEPATH}{if $section_info.sectiondataopt.pathobjects}{$section_info.sectiondataopt.pathobjects}{else}news{/if}/{$smarty.get.ntype}/{$val.iditem}/{if $smarty.get.page}oldpage={$smarty.get.page}{/if}">{$val.newtitle}</a></b></div>
	    <div style="margin-top: 4px; font-size: 95%; color: #808080">
		 
         {$CONTROL_OBJ->strings->CorrectTextFromDB($val.newdata, false, true, $val.contenttype, 180, true)}
         
		</div>
		<div style="margin-top: 4px; font-size: 95%">
		{$CONTROL_OBJ->DateTimeToSpecialFormat($val.datecreate)}  Views: {$val.newlooks}, comments: {$CONTROL_OBJ->GetCommentCountForElement($smarty.get.ntype, $val.iditem)} 
		</div>
			    
	   </td>	   
	  </tr>
	  </table>
	  </span>
	  </div>
      {/foreach}
     <div style="text-align: right; margin-top: 10px">{$global_data_list_info.data.pagestext}</div>
     {/if}
    </span>   
   {/if}  
  {/if} 
 {/if} 
</div>