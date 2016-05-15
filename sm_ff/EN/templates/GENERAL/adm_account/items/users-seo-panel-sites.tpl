{* сайты панели оптимизатора указанного пользователя
   
   
   $username
   $userid
*}
 
 {assign var="stlist" value=$adm_object->GetSeoPanelSites(0, $userid)}
 
 <div id="siteslistitems{$userid}">
  
  {if !$stlist}
   <div align="center">No Sites!</div>
  {else}
    
    {foreach from=$stlist item=val name=val}
 
     <div style="padding: 3px 2px;{if $val.bgcolorsetbe} background: #E0E6E6{/if}" idu="{$val.iditem}">
       <span style="width: 100%">
        
        <table width="100%" cellpadding="0" cellspacing="0">
         <tr>
	      <td valign="center" align="left" width="22px">
           <input type="checkbox" style="cursor: pointer" name="chur{$val.iditem}" id="chur{$val.iditem}" />
          </td>
	      <td valign="top" align="left">
           <a href="http://{$val.urlid}" target="_blank" style="background: transparent url(http://favicon.yandex.net/favicon/{$val.urlid}) no-repeat left top; padding-left: 21px">{$val.urlid}</a>
          </td>
         </tr>
        </table>
       
       </span> 
     </div>     
 
 
    {/foreach}
 
  {/if}
 </div>