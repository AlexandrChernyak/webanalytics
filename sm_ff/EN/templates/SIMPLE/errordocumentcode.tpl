<div>
 {if $smarty.get.errcode == '404'}
  The requested URL <u>{$smarty.server.REQUEST_URI}</u> was not found on this server. 
 {/if}
 
 {if $smarty.get.errcode == '403'}
  You don't have permission to access <u>{$smarty.server.REQUEST_URI}</u> on this server. 
 {/if}
 
 {if $smarty.get.errcode == '401'}
  This server could not verify that you are authorized to access the document requested. Either you supplied the wrong credentials (e.g., bad password), or your browser doesn't understand how to supply the credentials required. 
 {/if}
 
 {if $smarty.get.errcode == '400'}
  There was an error in your request. 
 {/if}
</div>