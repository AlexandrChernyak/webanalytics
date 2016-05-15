{* финансовые операции - пополнение баланса *}

{* при помощи roboxchange.com *}
{if $smarty.const.W_USEROBOXCHANGEPAYPROCESS}
<div style="border-bottom: 1px solid #EBE3DA; padding-bottom: 4px">
 <b style="color: #0000FF">ROBO</b><b style="color: #FF0000">KASSA</b> <b>Completion of balance by</b> <a href="http://roboxchange.com" target="_blank">roboxchange.com</a>
</div>
<div style="margin-top: 10px; margin-bottom: 15px;"> 
{if !isset($robokassa_info) || !$robokassa_info || $smarty.post.actpayrobox != 'do'}
<form method="post" name="brobox" id="brobox">
 <div class="typelabel"><label id="red">*</label> Amount of replenishment (USD) [separator "<b>.</b>" (point)]</div>
 <div><input type="text" class="inpt" style="width: 320px" name="rxsumm" id="rxsumm" value="5.00" maxlength="20"></div>
 <div class="typelabel"><input type="submit" value="&nbsp;Next >>&nbsp;" class="button" name="rb" id="rb"></div>
 <input type="hidden" value="do" name="actpayrobox">
</form>
{else}
 <div>You are going to replenish your account balance <b>{$CONTROL_OBJ->userdata.username}</b> to the amount of: <b>{$robokassa_info.summ} USD</b></div>
 <div style="margin-top: 5px">
 <form action="{if $robokassa_info.test}http://test.robokassa.ru/Index.aspx{else}https://merchant.roboxchange.com/Index.aspx{/if}" method="post">
  <input type="hidden" name="MrchLogin" value='{$robokassa_info.login}'>
  <input type="hidden" name="OutSum" value='{$robokassa_info.summ}'>
  <input type="hidden" name="InvId" value='{$robokassa_info.InvId}'>
  <input type="hidden" name="Desc" value='{$robokassa_info.descr}'>
  <input type="hidden" name="SignatureValue" value='{$robokassa_info.crc}'>
  <input type="hidden" name="Shp_item" value='{$robokassa_info.shit}'>
  <input type="hidden" name="IncCurrLabel" value='{$robokassa_info.stype}'>
  <input type="hidden" name="Culture" value='{$robokassa_info.lang}'>
  <input type="hidden" name="sEncoding" value="UTF-8">
  <input type="hidden" name="SHP_ppt" value="{$robokassa_info.SHPppt}">
  <div class="typelabel"><input type="submit" value="&nbsp;Skip to pay&nbsp;" class="button"></div> 
 </form>
 </div>
{/if}
</div>
{/if}



