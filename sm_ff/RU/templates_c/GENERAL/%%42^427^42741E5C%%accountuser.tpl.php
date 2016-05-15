<?php /* Smarty version 2.6.26, created on 2016-05-15 08:55:01
         compiled from accountuser.tpl */ ?>
<div>
 <?php echo '
 <style type="text/css">
  .head_title { text-transform: uppercase; color: #969696; font-weight: bold; }	
  .named_space { width: 200px; }
 </style>
 '; ?>

 <div class="head_title" style="background: #F8F8F8; padding: 2px">Общая информация</div>
 <div style="margin-top: 10px; margin-left: 7px">
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 Логин:	 
	</td>
	<td valign="center" align="left" height="22px">
	<u><?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['username']; ?>
</u>
	</td>
 </tr>
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 E-mail:	 
	</td>
	<td valign="center" align="left" height="22px">
	<a href="mailto:<?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['useremail']; ?>
"><?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['useremail']; ?>
</a>
	</td>
 </tr>
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 Сайт:	 
	</td>
	<td valign="center" align="left" height="22px">
	<?php if ($this->_tpl_vars['CONTROL_OBJ']->userdata['usersite']): ?><a href="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetCorrectUserSite(); ?>
" target="_blank"><?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['usersite']; ?>
</a><?php else: ?>НЕТ<?php endif; ?>
	</td>
 </tr>
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 IP:	 
	</td>
	<td valign="center" align="left" height="22px">
	<?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['userip']; ?>

	</td>
 </tr>
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 Текущий IP:	 
	</td>
	<td valign="center" align="left" height="22px">
	<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetCurrentIP(); ?>

	</td>
 </tr>
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 Хэш пароля:	 
	</td>
	<td valign="center" align="left" height="22px">
	<?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['userhash']; ?>

	</td>
 </tr>
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 Дата регистрации:	 
	</td>
	<td valign="center" align="left" height="22px">
	<?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['datereg']; ?>

	</td>
 </tr>
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 Группы:	 
	</td>
	<td valign="center" align="left" height="22px" style="font-size: 95%">
	 <?php $this->assign('groupslist', $this->_tpl_vars['CONTROL_OBJ']->GetUserGroups($this->_tpl_vars['CONTROL_OBJ']->userdata['iduser'],'text-decoration: underline; color: #016C6C')); ?>
     <?php if ($this->_tpl_vars['groupslist']['str']): ?><?php echo $this->_tpl_vars['groupslist']['str']; ?>
<?php else: ?><em>(не входит в группы)</em><?php endif; ?>
	</td>
 </tr> 
 </table>
 </span>
 </div>
 
 <div class="head_title" style="margin-top: 15px; background: #F8F8F8; padding: 2px">Финансовая информация</div>
 <div style="margin-top: 10px; margin-left: 7px">
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 Текущий баланс:	 
	</td>
	<td valign="center" align="left" height="22px">
	<?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['purcedata']; ?>
 USD 
	[ <a style="font-size: 95%" href="<?php echo @W_SITEPATH; ?>
account/payhistory/">История операций</a>, 
	<a style="font-size: 95%; color: #008000" href="<?php echo @W_SITEPATH; ?>
account/payhistory/&new=1">Пополнить</a> ]
	</td>
 </tr>
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 Всего операций:	 
	</td>
	<td valign="center" align="left" height="22px">
	 <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetFinanceTransactionsCount(false,false); ?>

	</td>
 </tr>
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 Зачислений от рефералов:	 
	</td>
	<td valign="center" align="left" height="22px">
	 <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetFinanceTransactionsCount(false,true); ?>
 
	 [ <a style="font-size: 95%" href="<?php echo @W_SITEPATH; ?>
account/payhistory/&fromref=1">Обзор</a> ]
	</td>
 </tr>
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 Зачислено от рефералов:	 
	</td>
	<td valign="center" align="left" height="22px">
	 <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetReferalSum(); ?>
 USD
	</td>
 </tr>
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 Реферальная ставка:	 
	</td>
	<td valign="center" align="left" height="22px">
	 <?php if (@W_REFERPERSENTOFTRANSACTION <= 0): ?>
	  НЕДОСТУПНО
	 <?php else: ?>
	  <?php echo @W_REFERPERSENTOFTRANSACTION; ?>
 %
	 <?php endif; ?> 
	</td>
 </tr> 
 </table>
 </span>
 </div>
 
 <div class="head_title" style="margin-top: 15px; background: #F8F8F8; padding: 2px">Реферальная система</div>
 <div style="margin-top: 10px; margin-left: 7px">
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 Количество рефералов:	 
	</td>
	<td valign="center" align="left" height="22px">
	 <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetUserRefersCount(); ?>

	</td>
 </tr>
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 Реферальная ссылка:	 
	</td>
	<td valign="center" align="left" height="22px">
	 <input type="text" value="http://<?php echo @W_HOSTMYSITE; ?>
/?p=<?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['iduser']; ?>
" style="width: 220px; border: 1px solid #C0C0C0" name="rn" onclick="this.select()" readonly="readonly">
	</td>
 </tr>
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 	 
	</td>
	<td valign="center" align="left" height="22px">
	 <input type="text" value="http://<?php echo @W_HOSTMYSITE; ?>
/register/<?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['iduser']; ?>
" style="width: 220px; border: 1px solid #C0C0C0" name="rn" onclick="this.select()" readonly="readonly">
	</td>
 </tr>
 
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 	 
	</td>
	<td valign="center" align="left" height="22px">
	 <a href="<?php echo @W_SITEPATH; ?>
account/ref-banner/">Выбрать баннер</a>
	</td>
 </tr>
 
 </table>
 </span>
 </div>
 
 <div class="head_title" style="margin-top: 15px; background: #F8F8F8; padding: 2px">Почта</div>
 <div style="margin-top: 10px; margin-left: 7px">
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 Новых сообщений:	 
	</td>
	<td valign="center" align="left" height="22px">
	 <a href="<?php echo @W_SITEPATH; ?>
account/mail/"><?php if ($this->_tpl_vars['global_user_info']['privatenew']): ?><b style="color: #FF0000"><?php endif; ?><?php echo $this->_tpl_vars['global_user_info']['privatenew']; ?>
<?php if ($this->_tpl_vars['global_user_info']['privatenew']): ?></b><?php endif; ?></a>
	</td>
 </tr>
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 Входящих потоков:	 
	</td>
	<td valign="center" align="left" height="22px">
	 <a href="<?php echo @W_SITEPATH; ?>
account/mail/"><?php echo $this->_tpl_vars['global_user_info']['privateall']; ?>
</a>
	</td>
 </tr>
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 Исходящих потоков:	 
	</td>
	<td valign="center" align="left" height="22px">
	 <a href="<?php echo @W_SITEPATH; ?>
account/mail/&send=1"><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetMySendMessagesCount(); ?>
</a>
	</td>
 </tr>
 </table>
 </span>
 </div>
 
 <div class="head_title" style="margin-top: 15px; background: #F8F8F8; padding: 2px">xml api</div>
 <div style="margin-top: 10px; margin-left: 7px">
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
 <tr>
	<td valign="center" align="left" height="22px" class="named_space">
	 api:	 
	</td>
	<td valign="center" align="left" height="22px">
	 <a href="<?php echo @W_SITEPATH; ?>
account/xml-api/">Управление</a>
	</td>
 </tr>
 </table>
 </span>
 </div>
 
</div>