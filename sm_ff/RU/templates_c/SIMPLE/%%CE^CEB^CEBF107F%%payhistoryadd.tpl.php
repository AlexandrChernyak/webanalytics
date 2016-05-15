<?php /* Smarty version 2.6.26, created on 2016-05-15 09:08:12
         compiled from account/payhistoryadd.tpl */ ?>

<?php if (@W_USEROBOXCHANGEPAYPROCESS || $this->_tpl_vars['CONTROL_OBJ']->isadminstatus): ?>
<div style="border-bottom: 1px solid #EBE3DA; padding-bottom: 4px">
 <b style="color: #0000FF">ROBO</b><b style="color: #FF0000">KASSA</b> <b>Пополнение баланса при помощи</b> <a href="http://roboxchange.com" target="_blank">roboxchange.com</a>
</div>
<div style="margin-top: 10px; margin-bottom: 15px;"> 
<?php if (! isset ( $this->_tpl_vars['robokassa_info'] ) || ! $this->_tpl_vars['robokassa_info'] || $_POST['actpayrobox'] != 'do'): ?>
<form method="post" name="brobox" id="brobox">
 <div class="typelabel"><label id="red">*</label> Сумма пополнения (USD) [разделитель "<b>.</b>" (точка)]</div>
 <div><input type="text" class="inpt" style="width: 320px" name="rxsumm" id="rxsumm" value="<?php if (isset ( $this->_tpl_vars['_ROBOXCHANGEPAYLISTDATA'] )): ?><?php echo $this->_tpl_vars['_ROBOXCHANGEPAYLISTDATA']['sumdef']; ?>
<?php else: ?>5.00<?php endif; ?>" maxlength="20"></div>
 <div class="typelabel"><input type="submit" value="&nbsp;Далее >>&nbsp;" class="button" name="rb" id="rb"></div>
 <input type="hidden" value="do" name="actpayrobox">
</form>
<?php else: ?>
 <div>Вы собираетесь пополнить баланс аккаунта <b><?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['username']; ?>
</b> на сумму: <b><?php echo $this->_tpl_vars['robokassa_info']['summ']; ?>
 USD</b></div>
 <div style="margin-top: 5px">
 <form action="<?php if ($this->_tpl_vars['robokassa_info']['test']): ?>http://test.robokassa.ru/Index.aspx<?php else: ?>https://merchant.roboxchange.com/Index.aspx<?php endif; ?>" method="post">
  <input type="hidden" name="MrchLogin" value='<?php echo $this->_tpl_vars['robokassa_info']['login']; ?>
'>
  <input type="hidden" name="OutSum" value='<?php echo $this->_tpl_vars['robokassa_info']['summ']; ?>
'>
  <input type="hidden" name="InvId" value='<?php echo $this->_tpl_vars['robokassa_info']['InvId']; ?>
'>
  <input type="hidden" name="Desc" value='<?php echo $this->_tpl_vars['robokassa_info']['descr']; ?>
'>
  <input type="hidden" name="SignatureValue" value='<?php echo $this->_tpl_vars['robokassa_info']['crc']; ?>
'>
  <input type="hidden" name="Shp_item" value='<?php echo $this->_tpl_vars['robokassa_info']['shit']; ?>
'>
  <input type="hidden" name="IncCurrLabel" value='<?php echo $this->_tpl_vars['robokassa_info']['stype']; ?>
'>
  <input type="hidden" name="Culture" value='<?php echo $this->_tpl_vars['robokassa_info']['lang']; ?>
'>
  <input type="hidden" name="sEncoding" value="UTF-8">
  <input type="hidden" name="SHP_ppt" value="<?php echo $this->_tpl_vars['robokassa_info']['SHPppt']; ?>
">
  <div class="typelabel"><input type="submit" value="&nbsp;Перейти к оплате&nbsp;" class="button"></div> 
 </form>
 </div>
<?php endif; ?>
</div>
<?php endif; ?>


<?php if (@W_USEWEBMONEYMERCHANT && $_POST['actpayrobox'] != 'do'): ?>
  <?php if ($this->_tpl_vars['_WEBMONEYMERCHANTLISTDATA']['enabled'] && ( ! $this->_tpl_vars['_WEBMONEYMERCHANTLISTDATA']['demo'] || $this->_tpl_vars['CONTROL_OBJ']->isadminstatus )): ?>
<div class="item-line-block-merch" onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">  
<div style="border-bottom: 1px solid #EBE3DA; padding-bottom: 4px">
 <b style="color: #0000FF">WebMoney Merchant</b> <b>Пополнение баланса при помощи Merchant</b> <a href="http://www.webmoney.ru/" target="_blank">webmoney.ru</a>
</div>  
  
 <?php echo ' 
 <script type="text/javascript">
  function CheckByeFormPrice(th) {
   if (th.LMI_PAYMENT_AMOUNT.value == \'\') { alert(\'Укажите сумму пополнения баланса!\'); th.LMI_PAYMENT_AMOUNT.focus(); return false; }
   if ((!IsFloat(th.LMI_PAYMENT_AMOUNT.value)) || (th.LMI_PAYMENT_AMOUNT.value <= 0)) { 
    alert(\'Укажите корректное число суммы, которую вы хотите положить на баланс!\\nСумма должна указываться положительным числом. (для разделения числа - используйте . "точку")\'); th.LMI_PAYMENT_AMOUNT.focus(); return false;
   } return true;	
  }//CheckByeFormPrice	
  function BlurCheckData(th) {
   var data = $(th);
   GetConvert($(\'#LMI_PAYEE_PURSE\'));
   if ((th.value == \'\') || (!IsFloat(th.value)) || (th.value <= 0)) {
    data.css(\'border\',\'1px solid #FF0000\');
    $(\'#errlinedata\').html(\'Сумма указана неверно!\');
    return false;
   }
   data.css(\'border\',\'1px solid #C3CCCE\');
   $(\'#errlinedata\').html(\'\');	
  }//BlurCheckData
  function GetConvert(th) {
   th = $(th);	
   var data = $(\'#LMI_PAYMENT_AMOUNT\').val();	
   if ((data == \'\') || (!IsFloat(data)) || (data <= 0)) { $(\'#getconvertdata\').html(\'\'); return false; }	
   var crs = '; ?>
<?php echo $this->_tpl_vars['_WEBMONEYMERCHANTLISTDATA']['RF_CURS']; ?>
<?php echo ';
   var wmr = \''; ?>
<?php echo $this->_tpl_vars['_WEBMONEYMERCHANTLISTDATA']['RURDATA']; ?>
<?php echo '\';
   if (th.val() == wmr) {
	var dt = 0;
	dt = Math.round(data/crs*100)/100;	
	$(\'#getconvertdata\').html(\'Будет зачисленно: \'+dt+\' WMZ<br />\');
   } else { $(\'#getconvertdata\').html(\'Будет зачисленно: \'+data+\' WMZ<br />\'); }  	
  }
 </script>  
 '; ?>
 
  
  
 <div style="margin-top: 5px"></div>
 <form method="post" name="pricedataUSD" id="pricedataUSD" action="https://merchant.webmoney.ru/lmi/payment.asp" onsubmit="return CheckByeFormPrice(this)">   
 <div class="typelabel"><label id="red">*</label> Укажите сумму, на которую желаете пополнить баланс (разделитель <b>.</b> "точка")</div> 
 <div class="typelabel">
 <input class="inpt" style="width: 320px" type="text" maxlength="10" name="LMI_PAYMENT_AMOUNT" id="LMI_PAYMENT_AMOUNT" value="1.00" onblur="BlurCheckData(this)">
 <select size="1" name="LMI_PAYEE_PURSE" id="LMI_PAYEE_PURSE" onchange="GetConvert(this)">
	<option value="<?php echo $this->_tpl_vars['_WEBMONEYMERCHANTLISTDATA']['USDDATA']; ?>
">WMZ (доллары)</option>
	<option value="<?php echo $this->_tpl_vars['_WEBMONEYMERCHANTLISTDATA']['RURDATA']; ?>
">WMR (рубли)</option>
 </select>&nbsp;<label style="color: #FF0000" id="errlinedata"></label>
 </div> 
 <div id="getconvertdata"></div>
 <div>&nbsp;</div>
 <input type="hidden" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['iduser']; ?>
" name="u_id">
 <input type="hidden" value="<?php echo $this->_tpl_vars['webmoney_merchant_infp']['user_unigue_id']; ?>
" name="idhash">
 <input type="hidden" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['username']; ?>
" name="nameuseronline"> 
 <input type="hidden" value="<?php echo $this->_tpl_vars['webmoney_merchant_infp']['descr']; ?>
" name="LMI_PAYMENT_DESC_BASE64">
 <input type="submit" value="&nbsp;Перейти к оплате&nbsp;&nbsp;" id="bsub" name="bsub" class="actbutton"> 
 </form> 
 <div style="margin-top: 13px">
 Оплата происходит при помощи системы <a href="http://www.webmoney.ru/" target="_blank">webmoney</a>. Сумма указывается в WMZ (доллары) или WMR (рубли). При указании суммы в рублях, на счет будет зачисленна сумма в WMZ по курсу <u>1 WMZ = <?php echo $this->_tpl_vars['_WEBMONEYMERCHANTLISTDATA']['RF_CURS']; ?>
 WMR</u>.
 </div>   
 </div> 
  <?php endif; ?>
<?php endif; ?>