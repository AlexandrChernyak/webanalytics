{literal}
 <script type="text/javascript"> 
  function SetActionIdent(n) {	
   document.getElementById('newprivatemail').actionnewprvmail.value = (n) ? 'act' : 'prev';	
  }//SetActionIdent
  function SendMessageAction(th) {
   if (th.userstitle.value == '') {
	if (!confirm('Subject is not listed! You want to send a message without a subject?')) {
	 th.userstitle.focus();	
	 return false;
	}
	th.userstitle.value = 'No Subject';	
   }
   if (th.userstext.value == '') {
	alert('Enter your message!');
	th.userstext.focus();
	return false;
   }
   return true;   	
  }//SendMessageAction  	
 </script>
{/literal}
<div>
 <div>
  {if $smarty.post.actionnewprvmail == 'prev'}
  <div style="padding: 4px; border: 1px solid #775D41; margin-bottom: 20px; width: 95%;">
   {$CONTROL_OBJ->strings->CorrectTextFromDB($CONTROL_OBJ->strings->CorrectTextToDB($smarty.post.userstext))}  
  </div>
  {/if} 
 </div>
 <form method="post" name="newprivatemail" id="newprivatemail" onsubmit="return SendMessageAction(this)">
  <div class="typelabel"><label id="red">*</label> To (separator "<u>semicolon</u>")</div>
  <div><textarea style="width: 95%; height: 35px" class="int_text" name="userslist" 
  id="userslist">{if !$smarty.post.actionnewprvmail && $smarty.get.tousers}{$smarty.get.tousers}{else}{if $smarty.post.actionnewprvmail}{$CONTROL_OBJ->GetPostElement('userslist', 'actionnewprvmail', $smarty.post.actionnewprvmail)}{else}admin; {/if}{/if}</textarea></div>
  <div class="typelabel">Subject</div>
  <div><input type="text" style="width: 95%" class="inpt" name="userstitle" id="userstitle" 
  value="{if $smarty.post.actionnewprvmail}{$CONTROL_OBJ->GetPostElement('userstitle', 'actionnewprvmail', $smarty.post.actionnewprvmail)}{/if}"></div>
  <div class="typelabel"><label id="red">*</label> Message Text</div>
  {include file='new_message.tpl' ident='userstext' source=$smarty.post.userstext height='220px' width='95%'}
  <div class="typelabel">
   <input type="submit" value="&nbsp;Send&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp;
   <input type="submit" value="&nbsp;Preview Message&nbsp;" class="button" name="rb" id="rb" 
   onclick="SetActionIdent(0)">
  </div>  
  <input type="hidden" value="prev" name="actionnewprvmail">
 </form>
 {if isset($errornewmessage) && $errornewmessage}<div id="red" style="margin-top: 12px">{$errornewmessage}</div>{/if}
</div>