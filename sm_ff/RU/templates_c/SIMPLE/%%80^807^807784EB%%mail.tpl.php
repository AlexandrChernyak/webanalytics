<?php /* Smarty version 2.6.26, created on 2016-05-15 09:08:58
         compiled from account/mail.tpl */ ?>
<?php echo '
 <script type="text/javascript">
  var list_items = new Array();   
  function DoHigl(th, n, p) {	
   if (n) {	$(th).css(\'background\',\'#F9FAFB\'); } else {
   	var ch = document.getElementById(\'chid\'+p);
   	var color = (ch && ch.checked) ? \'#E1E2E0\' : \'none\';   	
    $(th).css(\'background\', color);		
   }	
  }//DoHigl
  function CheckItem(itemid, th) {
   th = (th) ? th : document.getElementById(\'chid\'+itemid);   
   if (th && th.checked) { $(\'#t_r_\'+itemid).css(\'background\',\'#E1E2E0\'); } else {
	$(\'#t_r_\'+itemid).css(\'background\',\'none\');
   }
   SetEnabled();   	
  }//CheckItem
  function CheckAll(th) {	
   for (var i=0; i < list_items.length; i++) {
  	var ch = $(\'#chid\'+list_items[i]);
	ch.attr(\'checked\', (th.checked) ? \'checked\' : \'\');
	if (th.checked) { $(\'#t_r_\'+list_items[i]).css(\'background\',\'#E1E2E0\'); } else {
	 $(\'#t_r_\'+list_items[i]).css(\'background\',\'none\');	
	}	  	    	
   }
   SetEnabled();	
  }//CheckAll
  '; ?>

  <?php if (! $_GET['send']): ?>
  <?php echo '
  function GetSelCount() {
   var inccount = 0;
   for (var i=0; i < list_items.length; i++) {
    var ch = document.getElementById(\'chid\'+list_items[i]);
    if (ch && ch.checked) { inccount++; }		
   }	
   return inccount;	
  }//GetSelCount 
  function SetActionP(a) {
   var f = document.getElementById(\'messageslistform\');
   if (!f) { return ; }
   f.actionmailslist.value = a;   	
  }//SetActionP
  function PrepereSend(th) {
   var count = GetSelCount();
   if (count <= 0) { alert(\'Выделите хотя бы одно сообщение!\'); return false; }
   th.actioncountmess.value = count;
   if (th.actionmailslist.value == \'delete\') {
	if (!confirm(\'Вы действительно хотите удалить [\'+count+\'] сообщений?\')) { return false; }
   } else if (th.actionmailslist.value == \'read\') {
	if (!confirm(\'Вы действительно хотите пометить прочтенным [\'+count+\'] сообщений?\')) { return false; }
   } else { alert(\'Операция не определена! Возможно в Вашем браузере отключен JavaScript!\'); return false; }
   return true;   	
  }//PrepereSend
  function SetEnabled() {
	var count = GetSelCount();
	if (count <= 0) {
	 setElementOpacity(document.getElementById(\'did\'), 0.3);
	 setElementOpacity(document.getElementById(\'rid\'), 0.3);
	 return ;	
	}
	setElementOpacity(document.getElementById(\'did\'), 1);
	setElementOpacity(document.getElementById(\'rid\'), 1);	
   }//SetEnabled    
  '; ?>

  <?php endif; ?>
  <?php echo '    	
 </script>
 <style type="text/css">
  .h_th1, .h_td, .h_td2 { 
   border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E3E4E8; border-left: none; }
  .btn_n { border: 1px solid #E3E4E8; border-top: none; height: 25px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E3E4E8; height: 25px; border-top: none;}	
 </style>
'; ?>

<?php if (! $_GET['send']): ?>
<form method="post" name="messageslistform" id="messageslistform" onsubmit="return PrepereSend(this)">
<?php endif; ?>
<div>
<a href="<?php echo @W_SITEPATH; ?>
account/mail/new/">Создать новое сообщение</a> | 
<a <?php if (! $_GET['send']): ?>style="color: #000000"<?php endif; ?>href="<?php echo @W_SITEPATH; ?>
account/mail/">Входящие потоки(<?php if ($this->_tpl_vars['global_user_info']['privatenew']): ?><label id="red"><?php echo $this->_tpl_vars['global_user_info']['privatenew']; ?>
</label>/<?php endif; ?><label style="color: #000000"><?php echo $this->_tpl_vars['global_user_info']['privateall']; ?>
</label>)</a> | 
<a <?php if ($_GET['send']): ?>style="color: #000000"<?php endif; ?>href="<?php echo @W_SITEPATH; ?>
account/mail/&send=1">Исходящие потоки (<label style="color: #000000"><?php echo $this->_tpl_vars['global_user_info']['privatesend']; ?>
</label>)</a> 
</div>
<?php if (! $_GET['send']): ?>
<div style="margin-top: 8px">
<input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')">
<span style="margin-left: 12px">
<input type="submit" value="&nbsp;Пометить прочтенным&nbsp;" class="readmessbut" name="rid" id="rid" onclick="SetActionP('read')">
</span>
</div>
<?php endif; ?>
<div style="margin-top: 12px">
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <?php if (! $_GET['send']): ?>
    <td class="h_th1" valign="center" align="left" width="20px">
	 <span style="margin-left: 4px">
	  <input type="checkbox" name="checkallmessages" id="checkallmessages" style="cursor: pointer" onclick="CheckAll(this)">
	 </span>
	</td>
	<?php endif; ?>
	<?php if (! $_GET['send']): ?>
	<td class="h_td" valign="center" align="center" width="80px">От</td>
	<?php else: ?>
	<td class="h_td" valign="center" align="center" width="80px">Кому</td>
	<?php endif; ?>
	<td class="h_td" valign="center" align="left" style="padding-left: 4px">Тема</td>
	<td class="h_td" valign="center" align="center" width="80px">Сообщений</td>
	<td class="h_td2" valign="center" align="center" width="130px">Дата</td>
   </tr>	
   <?php if ($this->_tpl_vars['global_user_mail_info'] && $this->_tpl_vars['global_user_mail_info']['source']): ?>
	<?php $_from = $this->_tpl_vars['global_user_mail_info']['source']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
	 <tr onmouseover="DoHigl(this, 1, <?php echo ($this->_foreach['val']['iteration']-1); ?>
)" onmouseout="DoHigl(this, 0, <?php echo ($this->_foreach['val']['iteration']-1); ?>
)" id="t_r_<?php echo ($this->_foreach['val']['iteration']-1); ?>
">
	 <?php if (! $_GET['send']): ?>
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8">
	  <span style="margin-left: 4px">
	   <input type="checkbox" name="chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
" id="chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
" 
	   style="cursor: pointer" onclick="CheckItem('<?php echo ($this->_foreach['val']['iteration']-1); ?>
', this)">
	  </span>
	 </td>
	 <?php endif; ?>
	 <?php if (! $_GET['send']): ?>
	 <td class="sth1" valign="center" align="center" width="80px" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()">
	 <a target="_blank" href="<?php echo @W_SITEPATH; ?>
userinfo/<?php echo $this->_tpl_vars['val']['fromuser']; ?>
/"<?php if (! $this->_tpl_vars['val']['readable']): ?> style="font-weight: bold"<?php endif; ?>><?php if ($this->_tpl_vars['CONTROL_OBJ']->strlen($this->_tpl_vars['val']['fromuser']) > 16): ?>
	  <?php echo $this->_tpl_vars['CONTROL_OBJ']->substr($this->_tpl_vars['val']['fromuser'],0,14); ?>
...
	 <?php else: ?>
	  <?php echo $this->_tpl_vars['val']['fromuser']; ?>

	 <?php endif; ?></a>	 
	 </td>
	 <?php else: ?>
	 <td class="sth1" valign="center" align="center" width="80px" style="border-left: 1px solid #E3E4E8">
	 <a target="_blank" href="<?php echo @W_SITEPATH; ?>
userinfo/<?php echo $this->_tpl_vars['val']['touser']; ?>
/" <?php if (! $this->_tpl_vars['val']['readable']): ?> style="font-weight: bold"<?php endif; ?>><?php if ($this->_tpl_vars['CONTROL_OBJ']->strlen($this->_tpl_vars['val']['touser']) > 16): ?>
	  <?php echo $this->_tpl_vars['CONTROL_OBJ']->substr($this->_tpl_vars['val']['touser'],0,14); ?>
...
	 <?php else: ?>
	  <?php echo $this->_tpl_vars['val']['touser']; ?>

	 <?php endif; ?></a>
	 </td>
	 <?php endif; ?>
	 <td class="sth1" valign="center" align="left" style="padding-left: 4px" <?php if (! $_GET['send']): ?>onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()"<?php endif; ?>>
	 <a class="subjlinkedmail" <?php if (! $this->_tpl_vars['val']['readable']): ?> style="font-weight: bold; color: #000000"<?php endif; ?>href="<?php echo @W_SITEPATH; ?>
account/mail/<?php echo $this->_tpl_vars['val']['idmess']; ?>
<?php if ($_GET['send']): ?>&send=1<?php else: ?>/<?php endif; ?>"><?php if ($this->_tpl_vars['CONTROL_OBJ']->strlen($this->_tpl_vars['val']['subject']) > 40): ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->substr($this->_tpl_vars['val']['subject'],0,37); ?>
...<?php else: ?><?php echo $this->_tpl_vars['val']['subject']; ?>
<?php endif; ?></a>
	 </td>
	 <td class="sth1" valign="center" align="center" width="80px" <?php if (! $_GET['send']): ?>onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()"<?php endif; ?>>
	 <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetAnsversCountByMessage($this->_tpl_vars['val']['idmess']); ?>
	 	 
	 </td>
	 <td class="sth1" valign="center" align="center" width="130px" style="border-right: 1px solid #E3E4E8;" <?php if (! $_GET['send']): ?>onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()"<?php endif; ?>>
	 <?php echo $this->_tpl_vars['val']['dateadd']; ?>

	 </td>
    </tr>  
    <?php if (! $_GET['send']): ?>
	<script type="text/javascript">list_items[<?php echo ($this->_foreach['val']['iteration']-1); ?>
] = '<?php echo ($this->_foreach['val']['iteration']-1); ?>
';</script>
	<input type="hidden" value="<?php echo $this->_tpl_vars['val']['idmess']; ?>
" name="idm<?php echo ($this->_foreach['val']['iteration']-1); ?>
">
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
   <?php else: ?>
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="6">
     Нет сообщений!
     <script type="text/javascript">
	  document.getElementById('checkallmessages').disabled = true;
     </script>
    </td>
   </tr> 
   <?php endif; ?> 
 </table>
 <?php if ($this->_tpl_vars['global_user_mail_info'] && $this->_tpl_vars['global_user_mail_info']['source']): ?>
 <div style="text-align: right; margin-top: 10px"><?php echo $this->_tpl_vars['global_user_mail_info']['pagestext']; ?>
</div>
 <?php endif; ?>
 </span>
 <?php if (! $_GET['send']): ?>
 <input type="hidden" value="none" name="actionmailslist">
 <input type="hidden" value="0" name="actioncountmess">
 </form>
 <script type="text/javascript">SetEnabled();</script>
 <?php endif; ?>
</div>