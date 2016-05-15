{* переписка приватным сообщением *}
{literal}
 <script type="text/javascript"> 
  function SetActionIdent(n) {	
   document.getElementById('newprivatemail').actionnewprvmail.value = (n) ? 'act' : 'prev';	
  }//SetActionIdent
  function SendMessageAction(th) {
   if (th.userstext.value == '') {
	alert('Enter your message!');
	th.userstext.focus();
	return false;
   }
   return true;   	
  }//SendMessageAction  	
 </script>
{/literal}
{if $message_info}
<div>
 <div style="margin-bottom: 25px; border-bottom: 1px solid #E6DCCF; padding-bottom: 4px">
 {$CONTROL_OBJ->strings->CorrectTextFromDB($message_info.datasource)}
 </div>
 <div style="margin-top: 4px">
 {if $messages_list && $messages_list.source}
  <div style="text-align: right">{$messages_list.pagestext}</div>
  <div style="margin-bottom: 4px">
   {foreach from=$messages_list.source item=val name=val}
    <div style="margin-top: 30px">
    <span style="width: 100%">
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
     <tr>
	  <td valign="top" align="left" width="106px">
	  <img width="99" height="99" src="{$smarty.const.W_SITEPATH}{$smarty.const.W_FILESWEBPATH}/images/{$val.userinfo.avatar}">	  
	  </td>
	  <td valign="top" align="left">
	   <div style="margin-bottom: 4px; color: #969696">
	   <i>{$val.subject}</i>
	   </div>
	   <div>{$CONTROL_OBJ->strings->CorrectTextFromDB($val.datasource)}</div>	  
	  </td>
     </tr>
     <tr>
	  <td valign="top" align="right" colspan="2" style="border-bottom: 1px solid #EBEBEB; margin-right: 4px">
	   <div style="margin-bottom: 3px">
	    <a href="{$smarty.const.W_SITEPATH}userinfo/{$val.fromuser}/" target="_blank">{$val.fromuser}</a>&nbsp;|&nbsp;
	    {$val.dateadd}	   	  
	   </div>  
	  </td>
     </tr>     
    </table>
	</span>
	</div>   
   {/foreach}  
  </div>
  <div style="text-align: right; margin-top: 18px">{$messages_list.pagestext}</div>   
 {/if} 
 </div>
 <div style="margin-top: 5px; padding-top: 4px">
  <div>
  {if $smarty.post.actionnewprvmail == 'prev'}
  <div style="padding: 4px; border: 1px solid #775D41; margin-bottom: 20px; width: 99%;">
   {$CONTROL_OBJ->strings->CorrectTextFromDB($CONTROL_OBJ->strings->CorrectTextToDB($smarty.post.userstext))}  
  </div>
  {/if} 
  </div>
  <form method="post" name="newprivatemail" id="newprivatemail" onsubmit="return SendMessageAction(this)">
  <div class="typelabel"><label id="red">*</label> Message Text</div>
  {include file='new_message.tpl' ident='userstext' source=$smarty.post.userstext height='220px' width='100%'}
  <div class="typelabel">
   <input type="submit" value="&nbsp;Send&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp;
   <input type="submit" value="&nbsp;Preview Message&nbsp;" class="button" name="rb" id="rb" 
   onclick="SetActionIdent(0)">
  </div>  
  <input type="hidden" value="prev" name="actionnewprvmail">
 </form>
 {if isset($errornewmessage) && $errornewmessage}<div id="red" style="margin-top: 12px">{$errornewmessage}</div>{/if} 
 </div>
</div>
{else}
<div><b>Message not found!</b></div>
{/if}