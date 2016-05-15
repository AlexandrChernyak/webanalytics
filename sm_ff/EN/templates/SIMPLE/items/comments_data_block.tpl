{* блок комментариев 
  $commfor - int для какого объекта комментарии
  $commdescr - string название элемента, к которому комменты
  
*}
<!-- comments begin -->
{* статус добавления комментария *}
{if isset($global_data_list_info.addstatus)}
 <div style="margin-top: 10px; margin-bottom: 10px; padding: 3px; border: 1px dashed #000000">
 {if $global_data_list_info.addstatus == '0'}
   Thank you! Your comment has been successfully adopted. After validation, your comment will be published..
 {else}
  {if $global_data_list_info.addstatus == '1'}
   Thank you! Your comment has been successfully added!   
  {else}
   {if $global_data_list_info.addstatus}
    <div style="color: #FF0000">{$global_data_list_info.addstatus}</div>   
   {/if}   
  {/if} 
 {/if}
 </div>
{/if}

<div style="margin-top: 10px">
 {if $global_data_list_info.commentsdata.source}
  {foreach from=$global_data_list_info.commentsdata.source item=val name=val}
   <div style="margin-top: 30px">
    {assign var="avatarinfo" value=$CONTROL_OBJ->GetUserAvatarInfo($val.username)}
    <span style="width: 100%">
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
     <tr>
	  <td valign="top" align="left" width="106px">
	  <img width="99" height="99" src="{$avatarinfo.webpath}">	  
	  </td>
	  <td valign="top" align="left">
	   <div style="margin-bottom: 4px; color: #969696">
	   <i>Re: {$commdescr}</i>
	   </div>
	   <div>{$CONTROL_OBJ->strings->CorrectTextFromDB($val.commsource)}</div>	  
	  </td>
     </tr>
     <tr>
	  <td valign="top" align="right" colspan="2" style="border-bottom: 1px solid #EBEBEB; margin-right: 4px">
	   <div style="margin-bottom: 3px">
	    <a href="{$smarty.const.W_SITEPATH}userinfo/{$val.username}/" target="_blank">{$val.username}</a>&nbsp;|&nbsp;
	    {$CONTROL_OBJ->DateTimeToSpecialFormat($val.datecreate)}	   	  
	   </div>  
	  </td>
     </tr>     
    </table>
	</span>
	</div>  
  {/foreach}
  <div style="text-align: right; margin-top: 18px">{$global_data_list_info.commentsdata.pagestext}</div>
 {/if}
 <div style="matgin-top: 18px">
 {if $CONTROL_OBJ->IsOnline()}
 {literal}
 <script type="text/javascript">
  function SetActionIdent(n) {	
   document.getElementById('addcommentform').actionnewprvmail.value = (n) ? 'act' : 'prev';	
  }//SetActionIdent
  
  function PrepereSent(th) {
   if (!trim(th.commentsource.value)) {
	alert('Enter the text of your comment!');
	th.commentsource.focus();
	return false;
   }
   var restcode = document.getElementById('restcode');
   if (restcode && !trim(restcode.value)) {
	alert('Enter verification code from image!');
	restcode.focus();
	return false;
   }    
   th.action = (th.actionnewprvmail.value == 'prev') ? '#commentview' : '#comments';     
   $('#globalbodydata').css('cursor', 'wait');
   th.rb.disabled = true;
   th.rbp.disabled = true;
   return true;	
  }//PrepereSent	
 </script>
 {/literal}
 <div id="commentview" style="margin-top: 12px">
  {if $smarty.post.actionnewprvmail == 'prev'}
  <div style="padding: 4px; border: 1px solid #775D41; margin-top: 20px; margin-bottom: 20px; width: 94%;">
   {$CONTROL_OBJ->strings->CorrectTextFromDB($CONTROL_OBJ->strings->CorrectTextToDB($smarty.post.commentsource))}  
  </div>
  {/if} 
 </div>
 
 <form method="post" name="addcommentform" id="addcommentform" onsubmit="return PrepereSent(this)">
 
 <div class="typelabel"><label id="red">*</label> Comment text</div>
 <div class="typelabel">
  {include file='new_message.tpl' ident='commentsource' source=$smarty.post.commentsource height='220px' width='95%'}
 </div>
 <div class="typelabel">
  <input type="checkbox" checked="checked" style="cursor: pointer" name="useinform" id="useinform"><label for="useinform" style="cursor: pointer">&nbsp;Notify me of replies</label>
 </div>
 {if $global_data_list_info.commentusecaptcha}
 <div class="typelabel">
 <table cellpadding="0" cellspacing="0" border="0">
 <tr>
  <td align="left" valign="top" style="width: 300px">
  <div class="typelabel"><label id="red">*</label> Image code</div>
  <div><input type="text" class="inpt" style="width: 300px" name="restcode" id="restcode"></div>
  </td>
  <td align="left" valign="bottom" style="width: 66px">
   <img class="captcha_img" src="{$smarty.const.W_SITEPATH}img/cptch.php?tim=t&ln=DDDDDD&br=FFFFFF&bg=FFFFFF&h=23">
  </td>
 </tr>
 </table>
 </div>
 {/if}
 
 <div class="typelabel" style="margin-top: 15px">
  <input type="submit" value="&nbsp;Add comment&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp;
  <input type="submit" value="&nbsp;Preview comment&nbsp;" class="button" name="rbp" id="rbp" onclick="SetActionIdent(0)">
 </div>
 
 <input type="hidden" value="prev" name="actionnewprvmail">
 <input type="hidden" value="do" name="actionthissectionpost">
 
 </form>
 {else}
 <div style="font-size: 95%">Please log in to be able to add a comment..</div>
 {/if} 
 </div> 	
</div>  
<!-- comments end -->