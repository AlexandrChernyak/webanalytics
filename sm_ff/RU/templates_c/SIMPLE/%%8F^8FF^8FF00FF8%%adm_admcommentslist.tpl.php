<?php /* Smarty version 2.6.26, created on 2013-11-14 14:05:27
         compiled from adm_account/adm_admcommentslist.tpl */ ?>
<div style="margin-top: 4px">
<div>
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0">
 
 <tr>
  <td colspan="2" style="padding: 0 2px 10px 0">
   
   <a<?php if (! $_GET['oid']): ?> style="color: #000000"<?php endif; ?> href="<?php echo @W_SITEPATH; ?>
account/admcommentslist/&ntype=1&active=<?php echo $_GET['active']; ?>
<?php if ($_GET['oldpage']): ?>&page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?>&oid=0">Новости/статьи/записи</a>
   
   <label style="margin: 0 2px 0 2px">|</label>
   
   <a<?php if ($_GET['oid'] == '1'): ?> style="color: #000000"<?php endif; ?> href="<?php echo @W_SITEPATH; ?>
account/admcommentslist/&ntype=&active=<?php echo $_GET['active']; ?>
<?php if ($_GET['oldpage']): ?>&page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?>&oid=1">Отдельные страницы</a>
  
  </td>
 </tr>
 
 <tr>
 <td valign="top" align="left">
 <div>Раздел комментариев</div>
  <div style="margin-top: 4px">
   <?php $this->assign('listnewssections', $this->_tpl_vars['adm_object']->GetCommentsSectionsListByNews()); ?>    
   <select size="1" name="informtype" id="informtype" onchange="NavigateComm()">
    <?php if (! $this->_tpl_vars['listnewssections'] && ! $_GET['oid']): ?>
     <option<?php if (! $_GET['ntype'] || $_GET['ntype'] == '1'): ?> selected="selected"<?php endif; ?> value="1">Новости сайта</option>
     <option<?php if ($_GET['ntype'] == '2'): ?> selected="selected"<?php endif; ?> value="2">Новости интернета</option>
    <?php else: ?>
	 <?php $_from = $this->_tpl_vars['listnewssections']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>	  
	  <option<?php if ($_GET['ntype'] == $this->_tpl_vars['val']['iditem']): ?> selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['val']['iditem']; ?>
"><?php echo $this->_tpl_vars['val']['lang']; ?>
: <?php echo $this->_tpl_vars['val']['sname']; ?>
 (<?php echo $this->_tpl_vars['val']['countinfo']['inactive']; ?>
 / <?php echo $this->_tpl_vars['val']['countinfo']['active']; ?>
)</option>
	 <?php endforeach; endif; unset($_from); ?>	
	<?php endif; ?> 
   </select>  
  </div>	
 </td>
 <td valign="top" align="right">
  <div>Фильтр</div>
  <div style="margin-top: 4px">
   <select size="1" name="activetype" id="activetype" onchange="NavigateComm()">
    <option<?php if ($_GET['active'] == ''): ?> selected="selected"<?php endif; ?> value="">Все комментарии раздела (<?php echo $this->_tpl_vars['adm_object']->GetResult('allcount'); ?>
)</option>
	<option<?php if ($_GET['active'] == '0'): ?> selected="selected"<?php endif; ?> value="0">Только на модерации (<?php echo $this->_tpl_vars['adm_object']->GetResult('countmoder'); ?>
)</option>
    <option<?php if ($_GET['active'] == '1'): ?> selected="selected"<?php endif; ?> value="1">Только опубликованные (<?php echo $this->_tpl_vars['adm_object']->GetResult('countpublic'); ?>
)</option>
   </select>  
  </div>	
 </td>
 </tr>
 </table>
 </span>
</div>
<div style="margin-top: 4px; border-bottom: 1px solid #969696">&nbsp;</div>

<?php echo '
<script type="text/javascript">
 var globalsectionpath = '; ?>
'<?php echo @W_SITEPATH; ?>
';<?php echo '
 var globalpage = '; ?>
'<?php echo $_GET['page']; ?>
';<?php echo '
 var globaloldpage = '; ?>
'<?php echo $_GET['oldpage']; ?>
';<?php echo '
 var globaloid = '; ?>
'<?php echo $_GET['oid']; ?>
';<?php echo '

 
 function NavigateComm() {
  var path = globalsectionpath + \'account/admcommentslist/\';
  var ntype = $(\'#informtype\').val();
  ntype = (!ntype) ? 1 : ntype;
  path = path + \'&ntype=\' + ntype + \'&active=\' + $(\'#activetype\').val();
  var page = (globaloldpage) ? globaloldpage : ((globalpage) ? globalpage : \'\');
  if (page) {
   path = path + \'&page=\' + page;	
  }
  path = path + \'&oid=\' + globaloid;
  document.location = path;  	
 }//NavigateComm	
</script>
'; ?>


<div style="margin-top: 5px">
<a<?php if (! $_GET['modify']): ?> style="color: #000000"<?php endif; ?> href="<?php echo @W_SITEPATH; ?>
account/admcommentslist/&ntype=<?php if ($_GET['ntype']): ?><?php echo $_GET['ntype']; ?>
<?php else: ?>1<?php endif; ?>&active=<?php echo $_GET['active']; ?>
<?php if ($_GET['oldpage']): ?>&page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?>&oid=<?php echo $_GET['oid']; ?>
">Список комментариев (<label style="color: #000000"><?php echo $this->_tpl_vars['adm_object']->GetResult('count'); ?>
</label>)</a>
</div>
<div style="margin-top: 12px">
<?php if (! $_GET['modify'] || ! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>
<?php echo '
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = '; ?>
<?php if (! $this->_tpl_vars['adm_object']->GetResult('count')): ?>0<?php else: ?>1<?php endif; ?>;<?php echo '  
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
 function GetSelCount() {
  var inccount = 0;
  for (var i=0; i < list_items.length; i++) {
   var ch = document.getElementById(\'chid\'+list_items[i]);
   if (ch && ch.checked) { inccount++; }		
  }	
  return inccount;	
 }//GetSelCount 
 function PrepereSend(th) {
  var count = GetSelCount();
  if (count <= 0 && th.actionlistmakes.value != \'all\' && th.actionlistmakes.value != \'dall\') { 
   alert(\'Выделите хотя бы один комментарий!\'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == \'delete\') {
   if (!confirm(\'Вы действительно хотите удалить [\'+count+\'] комментариев?\')) { return false; }
  } else 
  if (th.actionlistmakes.value == \'enabled\') {
   if (!confirm(\'Вы действительно хотите опубликовать [\'+count+\'] комментариев?\')) { return false; }
  } else
  if (th.actionlistmakes.value == \'disabled\') {
   if (!confirm(\'Вы действительно хотите снять с публикации [\'+count+\'] комментариев?\')) { return false; }
  } else
  if (th.actionlistmakes.value == \'dall\') {
   if (!allsaveenabled) { alert(\'Нет данных для удаления!\'); return false; }	
   if (!confirm(\'Вы действительно хотите удалить все комментарии выбранного раздела?\')) { return false; }	
  } else { alert(\'Неизвестный идентификатор операции!\'); return false; }
  return true;   	
 }//PrepereSend
 function SetEnabled() {  	
  var count = GetSelCount();
  setElementOpacity(document.getElementById(\'adid\'), (allsaveenabled) ? 1 : 0.3);
  if (count <= 0) {
   setElementOpacity(document.getElementById(\'did\'), 0.3);
   setElementOpacity(document.getElementById(\'ena\'), 0.3);
   setElementOpacity(document.getElementById(\'dna\'), 0.3);
   return ;	 
  }
  setElementOpacity(document.getElementById(\'did\'), 1);
  setElementOpacity(document.getElementById(\'ena\'), 1);
  setElementOpacity(document.getElementById(\'dna\'), 1);
 }//SetEnabled
 function SetActionP(a) {
  var f = document.getElementById(\'commentsform\');
  if (!f) { return ; }
  f.actionlistmakes.value = a;   	
 }//SetActionP   	
</script>
<style type="text/css">
  .h_th1, .h_td, .h_td2 { 
   border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; 
   border-right: none; font-weight: bold; 
  }
  .h_td { border-left: none; }
  .h_td2 { border-right: 1px solid #E3E4E8; border-left: none; }
  .btn_n { border: 1px solid #E3E4E8; border-top: none; height: 25px; margin-top: 4px; }
  .sth1 { border-bottom: 1px solid #E3E4E8; height: 25px; border-top: none; }	
 </style>
'; ?>
 
<form method="post" name="commentsform" id="commentsform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Удалить все&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 160px;">
 </span>
 
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Активировать&nbsp;" class="activatelistit" name="ena" id="ena" onclick="SetActionP('enabled')" style="//width: 80px;">
 </span>

 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Деактивировать&nbsp;" class="deactivatelistit" name="dna" id="dna" onclick="SetActionP('disabled')" style="//width: 80px;">
 </span>
 
 </div>
 <div style="margin-top: 6px"> 
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <td class="h_th1" valign="center" align="left" width="20px">
	 <span style="margin-left: 4px">
	  <input type="checkbox" name="checkallitems" id="checkallitems" style="cursor: pointer" onclick="CheckAll(this)">
	 </span>
	</td>	
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Комментарий</span></td>		
	<td class="h_td2" valign="center" align="left" width="1px"></td>
   </tr>	
   <?php if ($this->_tpl_vars['adm_object']->GetResult('data.source')): ?>
	<?php $_from = $this->_tpl_vars['adm_object']->GetResult('data.source'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
	 <tr onmouseover="DoHigl(this, 1, <?php echo ($this->_foreach['val']['iteration']-1); ?>
)" onmouseout="DoHigl(this, 0, <?php echo ($this->_foreach['val']['iteration']-1); ?>
)" id="t_r_<?php echo ($this->_foreach['val']['iteration']-1); ?>
">
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8; <?php if (! $this->_tpl_vars['val']['commisactive']): ?>background: #FFCCCC<?php endif; ?>">
	  <span style="margin-left: 4px">
	   <input type="checkbox" name="chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
" id="chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
" 
	   style="cursor: pointer" onclick="CheckItem('<?php echo ($this->_foreach['val']['iteration']-1); ?>
', this)">
	  </span>
	 </td>	 
	 <td class="sth1" valign="center" align="left" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()">
	  
	  <div style="margin: 5px 5px 5px 5px">
	   <?php $this->assign('avatarinfo', $this->_tpl_vars['CONTROL_OBJ']->GetUserAvatarInfo($this->_tpl_vars['val']['username'])); ?>
	   <span style="width: 100%">
	   <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
	     <td valign="top" align="left" width="106px">
	     <img width="99" height="99" src="<?php echo $this->_tpl_vars['avatarinfo']['webpath']; ?>
">	  
	     </td>
	     <td valign="top" align="left">
	      <div style="margin-bottom: 4px; color: #969696">
	      <i>Re: <a style="color: #969696" href="<?php echo $this->_tpl_vars['adm_object']->GetObjectLink($this->_tpl_vars['val']); ?>
" target="_blank"><?php echo $this->_tpl_vars['adm_object']->GetObjectName($this->_tpl_vars['val']); ?>
</a></i>
	      </div>
	      <div><?php echo $this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextFromDB($this->_tpl_vars['val']['commsource']); ?>
</div>	  
	     </td>
        </tr>
        <tr>
	     <td valign="top" align="right" colspan="2" style="margin-right: 4px">
	      <div style="margin-bottom: 3px">
	       <a href="<?php echo @W_SITEPATH; ?>
account/admcommentslist/&modify=<?php echo $this->_tpl_vars['val']['iditem']; ?>
&ntype=<?php if ($_GET['ntype']): ?><?php echo $_GET['ntype']; ?>
<?php else: ?>1<?php endif; ?>&active=<?php echo $_GET['active']; ?>
<?php if ($_GET['page']): ?>&oldpage=<?php echo $_GET['page']; ?>
<?php endif; ?>&oid=<?php echo $_GET['oid']; ?>
" style="font-size: 95%; color: #333399">Изменить</a>&nbsp;|&nbsp;
	      
	       <a href="<?php echo @W_SITEPATH; ?>
userinfo/<?php echo $this->_tpl_vars['val']['username']; ?>
/" target="_blank"><?php echo $this->_tpl_vars['val']['username']; ?>
</a>&nbsp;|&nbsp;
	       <?php echo $this->_tpl_vars['CONTROL_OBJ']->DateTimeToSpecialFormat($this->_tpl_vars['val']['datecreate']); ?>
	   	  
	      </div>  
	     </td>
        </tr>     
       </table>
	   </span>	   
	  </div>
	  
	 </td>	 
	 <td class="sth1" valign="top" align="left" style="border-right: 1px solid #E3E4E8; width: 1px" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()">	 
	 </td>
    </tr>  
	<script type="text/javascript">list_items[<?php echo ($this->_foreach['val']['iteration']-1); ?>
] = '<?php echo ($this->_foreach['val']['iteration']-1); ?>
';</script>
	<input type="hidden" value="<?php echo $this->_tpl_vars['val']['iditem']; ?>
" name="idm<?php echo ($this->_foreach['val']['iteration']-1); ?>
">
	<?php endforeach; endif; unset($_from); ?>
   <?php else: ?>
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="3">
     Нет комментариев!
     <script type="text/javascript">
	  document.getElementById('checkallitems').disabled = true;
     </script>
    </td>
   </tr> 
   <?php endif; ?> 
 </table>
 <?php if ($this->_tpl_vars['adm_object']->GetResult('data.source')): ?>
 <div style="text-align: right; margin-top: 10px"><?php echo $this->_tpl_vars['adm_object']->GetResult('data.pagestext'); ?>
</div>
 <?php endif; ?> 
 </span>
 </div> 
 <input type="hidden" value="0" name="actioncountmess">
 <input type="hidden" value="none" name="actionlistmakes"> 
</form>
<script type="text/javascript">SetEnabled();</script>
<?php else: ?>
  <?php echo '
 <script type="text/javascript"> 
  function PrepereSend(th) {	
   if (!trim(th.commentsource.value)) {
	alert(\'Укажите текст комментария!\');
	th.commentsource.focus();
	return false;
   }
   $(\'#globalbodydata\').css(\'cursor\', \'wait\');
   th.rb.disabled = true;
   th.rbp.disabled = true;
   return true;   	
  }//PrepereSend
  
  function SetActionIdent(n) {	
   document.getElementById(\'modifycommentform\').actionnewprvmail.value = (n) ? \'act\' : \'prev\';	
  }//SetActionIdent	
 </script>
 '; ?>

 
 <div style="margin-top: 12px">
  <?php if ($_POST['actionnewprvmail'] == 'prev'): ?>
  <div style="padding: 4px; border: 1px solid #775D41; margin-top: 20px; margin-bottom: 20px; width: 94%;">
   <?php echo $this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextFromDB($this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextToDB($_POST['commentsource'])); ?>
  
  </div>
  <?php endif; ?> 
 </div>
 
 <div style="margin-top: 6px"><b>Комментарий к</b>: <a href="<?php echo $this->_tpl_vars['adm_object']->GetObjectLink($this->_tpl_vars['adm_object']->GetResult('modifyinfo')); ?>
" target="_blank"><?php echo $this->_tpl_vars['adm_object']->GetObjectName($this->_tpl_vars['adm_object']->GetResult('modifyinfo')); ?>
</a></div>
 
 <form method="post" name="modifycommentform" id="modifycommentform" onsubmit="return PrepereSend(this)">

 <div class="typelabel" style="margin-top: 12px"><label id="red">*</label> Текст комментария</div>
 <div class="typelabel">
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'new_message.tpl', 'smarty_include_vars' => array('ident' => 'commentsource','source' => $_POST['commentsource'],'height' => '220px','width' => '95%')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 </div>
 
 <div class="typelabel" style="margin-top: 15px">
  <input type="submit" value="&nbsp;Сохранить изменения&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp;
  <input type="submit" value="&nbsp;Предварительный просмотр&nbsp;" class="button" name="rbp" id="rbp" onclick="SetActionIdent(0)">
 </div>
 
 <input type="hidden" value="prev" name="actionnewprvmail">
 <input type="hidden" value="do" name="actionthissectionpost">
 
 </form>
 
 <?php if ($_POST['actionthissectionpost'] == 'do' && $_POST['actionnewprvmail'] == 'act'): ?> 
  <div style="margin-top: 8px">
  <?php if ($this->_tpl_vars['adm_object']->error): ?>  
   <label style="color: #FF0000"><?php echo $this->_tpl_vars['adm_object']->error; ?>
</label>
  <?php else: ?>
   <label style="color: #008000">Комментарий успешно изменен!</label>
  <?php endif; ?>
  </div>
 <?php endif; ?>
  
<?php endif; ?>
</div>
</div>