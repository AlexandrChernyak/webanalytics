{* финансовые операции - пополнение баланса *}

{* при помощи roboxchange.com *}
{if $smarty.const.W_USEROBOXCHANGEPAYPROCESS || $CONTROL_OBJ->isadminstatus}
<div style="border-bottom: 1px solid #EBE3DA; padding-bottom: 4px">
 <b style="color: #0000FF">ROBO</b><b style="color: #FF0000">KASSA</b> <b>Пополнение баланса при помощи</b> <a href="http://roboxchange.com" target="_blank">roboxchange.com</a>
</div>
<div style="margin-top: 10px; margin-bottom: 15px;"> 
{if !isset($robokassa_info) || !$robokassa_info || $smarty.post.actpayrobox != 'do'}
<form method="post" name="brobox" id="brobox">
 <div class="typelabel"><label id="red">*</label> Сумма пополнения (USD) [разделитель "<b>.</b>" (точка)]</div>
 <div><input type="text" class="inpt" style="width: 320px" name="rxsumm" id="rxsumm" value="{if isset($_ROBOXCHANGEPAYLISTDATA)}{$_ROBOXCHANGEPAYLISTDATA.sumdef}{else}5.00{/if}" maxlength="20"></div>
 <div class="typelabel"><input type="submit" value="&nbsp;Далее >>&nbsp;" class="button" name="rb" id="rb"></div>
 <input type="hidden" value="do" name="actpayrobox">
</form>
{else}
 <div>Вы собираетесь пополнить баланс аккаунта <b>{$CONTROL_OBJ->userdata.username}</b> на сумму: <b>{$robokassa_info.summ} USD</b></div>
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
  <div class="typelabel"><input type="submit" value="&nbsp;Перейти к оплате&nbsp;" class="button"></div> 
 </form>
 </div>
{/if}
</div>
{/if}


{* пополнение при помощи webmoney merchant *}
{if $smarty.const.W_USEWEBMONEYMERCHANT && $smarty.post.actpayrobox != 'do'}
  {if $_WEBMONEYMERCHANTLISTDATA.enabled && (!$_WEBMONEYMERCHANTLISTDATA.demo || $CONTROL_OBJ->isadminstatus)}
<div class="item-line-block-merch" onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">  
<div style="border-bottom: 1px solid #EBE3DA; padding-bottom: 4px">
 <b style="color: #0000FF">WebMoney Merchant</b> <b>Пополнение баланса при помощи Merchant</b> <a href="http://www.webmoney.ru/" target="_blank">webmoney.ru</a>
</div>  
  
 {literal} 
 <script type="text/javascript">
  function CheckByeFormPrice(th) {
   if (th.LMI_PAYMENT_AMOUNT.value == '') { alert('Укажите сумму пополнения баланса!'); th.LMI_PAYMENT_AMOUNT.focus(); return false; }
   if ((!IsFloat(th.LMI_PAYMENT_AMOUNT.value)) || (th.LMI_PAYMENT_AMOUNT.value <= 0)) { 
    alert('Укажите корректное число суммы, которую вы хотите положить на баланс!\nСумма должна указываться положительным числом. (для разделения числа - используйте . "точку")'); th.LMI_PAYMENT_AMOUNT.focus(); return false;
   } return true;	
  }//CheckByeFormPrice	
  function BlurCheckData(th) {
   var data = $(th);
   GetConvert($('#LMI_PAYEE_PURSE'));
   if ((th.value == '') || (!IsFloat(th.value)) || (th.value <= 0)) {
    data.css('border','1px solid #FF0000');
    $('#errlinedata').html('Сумма указана неверно!');
    return false;
   }
   data.css('border','1px solid #C3CCCE');
   $('#errlinedata').html('');	
  }//BlurCheckData
  function GetConvert(th) {
   th = $(th);	
   var data = $('#LMI_PAYMENT_AMOUNT').val();	
   if ((data == '') || (!IsFloat(data)) || (data <= 0)) { $('#getconvertdata').html(''); return false; }	
   var crs = {/literal}{$_WEBMONEYMERCHANTLISTDATA.RF_CURS}{literal};
   var wmr = '{/literal}{$_WEBMONEYMERCHANTLISTDATA.RURDATA}{literal}';
   if (th.val() == wmr) {
	var dt = 0;
	dt = Math.round(data/crs*100)/100;	
	$('#getconvertdata').html('Будет зачисленно: '+dt+' WMZ<br />');
   } else { $('#getconvertdata').html('Будет зачисленно: '+data+' WMZ<br />'); }  	
  }
 </script>  
 {/literal} 
  
  
 <div style="margin-top: 5px"></div>
 <form method="post" name="pricedataUSD" id="pricedataUSD" action="https://merchant.webmoney.ru/lmi/payment.asp" onsubmit="return CheckByeFormPrice(this)">   
 <div class="typelabel"><label id="red">*</label> Укажите сумму, на которую желаете пополнить баланс (разделитель <b>.</b> "точка")</div> 
 <div class="typelabel">
 <input class="inpt" style="width: 320px" type="text" maxlength="10" name="LMI_PAYMENT_AMOUNT" id="LMI_PAYMENT_AMOUNT" value="1.00" onblur="BlurCheckData(this)">
 <select size="1" name="LMI_PAYEE_PURSE" id="LMI_PAYEE_PURSE" onchange="GetConvert(this)">
	<option value="{$_WEBMONEYMERCHANTLISTDATA.USDDATA}">WMZ (доллары)</option>
	<option value="{$_WEBMONEYMERCHANTLISTDATA.RURDATA}">WMR (рубли)</option>
 </select>&nbsp;<label style="color: #FF0000" id="errlinedata"></label>
 </div> 
 <div id="getconvertdata"></div>
 <div>&nbsp;</div>
 <input type="hidden" value="{$CONTROL_OBJ->userdata.iduser}" name="u_id">
 <input type="hidden" value="{$webmoney_merchant_infp.user_unigue_id}" name="idhash">
 <input type="hidden" value="{$CONTROL_OBJ->userdata.username}" name="nameuseronline"> 
 <input type="hidden" value="{$webmoney_merchant_infp.descr}" name="LMI_PAYMENT_DESC_BASE64">
 <input type="submit" value="&nbsp;Перейти к оплате&nbsp;&nbsp;" id="bsub" name="bsub" class="actbutton"> 
 </form> 
 <div style="margin-top: 13px">
 Оплата происходит при помощи системы <a href="http://www.webmoney.ru/" target="_blank">webmoney</a>. Сумма указывается в WMZ (доллары) или WMR (рубли). При указании суммы в рублях, на счет будет зачисленна сумма в WMZ по курсу <u>1 WMZ = {$_WEBMONEYMERCHANTLISTDATA.RF_CURS} WMR</u>.
 </div>   
 </div> 
  {/if}
{/if}
