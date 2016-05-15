{* информация о пользователе *}
<div style="margin-top: 5px">
 {if !isset($user_regional_info) || !$user_regional_info}
  <b>Такого пользователя не существует!</b>  
 {else}
  {* Вывод информации о пользователе *}
  {literal}
  <style type="text/css">
	.line_item { border-bottom: 1px solid #EBEBEB; height: 22px; }
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
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
	<td valign="top" align="left" width="110px">
	<img src="{$smarty.const.W_SITEPATH}{$smarty.const.W_FILESWEBPATH}/images/{$user_regional_info.avatar}" alt="{$user_regional_info.username} avatar" width="99" height="99">
	</td>
	<td valign="top" align="left">
	 <table width="100%" cellpadding="0" cellspacing="0" border="0">
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <td valign="center" align="left" width="100px" class="line_item">
	  Логин
	  </td>
	  <td valign="center" align="left" class="line_item">
	  <b>{$user_regional_info.username}</b>
	  </td>
	 </tr>
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <td valign="center" align="left" width="100px" class="line_item">
	  E-mail
	  </td>
	  <td valign="center" align="left" class="line_item">
	  {if $CONTROL_OBJ->ReadOption('SHOWEMAIL', $user_regional_info.genoptions)}
	   <a href="mailto:{$user_regional_info.useremail}">{$user_regional_info.useremail}</a>	   
	  {else}
	  <i>(Закрыто)</i>
	  {/if}	  
	  </td>
	 </tr>
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <td valign="center" align="left" width="100px" class="line_item">
	  Сайт
	  </td>
	  <td valign="center" align="left" class="line_item">
	  {if $CONTROL_OBJ->ReadOption('SHOWSITE', $user_regional_info.genoptions)}
	   {if !$CONTROL_OBJ->GetCorrectUserSite($user_regional_info)}
	    Нет	    
	   {else}
	    {if !$user_regional_info.indexsiteonpage}<noindex>{/if}<a{if !$user_regional_info.indexsiteonpage} rel="nofollow"{/if} href="{$CONTROL_OBJ->GetCorrectUserSite($user_regional_info)}" target="_blank">{$user_regional_info.usersite}</a>{if !$user_regional_info.indexsiteonpage}</noindex>{/if}	    
	   {/if}   	   
	  {else}
	  <i>(Закрыто)</i>
	  {/if}	  
	  </td>
	 </tr>
	 <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <td valign="center" align="left" width="100px" class="line_item">
	  Активность
	  </td>
	  <td valign="center" align="left" class="line_item">
	  {$CONTROL_OBJ->GetLastIntervalInDays($user_regional_info.datelastin)}	  
	  </td>
	 </tr>
     {assign var="groupslist" value=$CONTROL_OBJ->GetUserGroups($user_regional_info.iduser, 'text-decoration: underline; color: #016C6C')}
     <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <td valign="center" align="left" width="100px" class="line_item">
	  Группы
	  </td>
	  <td valign="center" align="left" class="line_item" style="font-size: 95%">
	  {if $groupslist.str}{$groupslist.str}{else}<em>(не входит в группы)</em>{/if}	  
	  </td>
	 </tr>    
     
     		
	
	</table>
	</td>
  </tr>
  </table>
  </span>
 {/if}
</div>