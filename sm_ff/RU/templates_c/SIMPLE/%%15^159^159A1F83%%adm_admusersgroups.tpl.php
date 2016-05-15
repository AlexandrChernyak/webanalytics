<?php /* Smarty version 2.6.26, created on 2016-05-15 09:27:59
         compiled from adm_account/adm_admusersgroups.tpl */ ?>

<?php if ($_GET['group']): ?>
 
 <div style="margin: 7px 1px 12px 1px">
 <a href="<?php echo @W_SITEPATH; ?>
account/admusersgroups/?new=1&group=<?php echo $_GET['group']; ?>
<?php if ($_GET['page']): ?>&oldpage=<?php echo $_GET['page']; ?>
<?php endif; ?><?php if ($_GET['grouppage']): ?>&grouppage=<?php echo $_GET['grouppage']; ?>
<?php endif; ?>"<?php if ($_GET['new'] && ! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?> style="color: #000000"<?php endif; ?>>Добавить пользователя(ей)</a> | <a<?php if (! $_GET['new']): ?> style="color: #000000"<?php endif; ?> href="<?php echo @W_SITEPATH; ?>
account/admusersgroups/?group=<?php echo $_GET['group']; ?>
<?php if ($_GET['oldpage']): ?>&page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?><?php if ($_GET['grouppage']): ?>&grouppage=<?php echo $_GET['grouppage']; ?>
<?php endif; ?>">Все пользователи группы (<label style="color: #000000"><?php echo $this->_tpl_vars['adm_object']->GetResult('pcount'); ?>
</label>)</a> 
 
 <label style="padding-left: 10px"><a href="<?php echo @W_SITEPATH; ?>
account/admusersgroups/<?php if ($_GET['grouppage']): ?>?page=<?php echo $_GET['grouppage']; ?>
<?php endif; ?>"> << Вернуться к группам (<label style="color: #000000"><?php echo $this->_tpl_vars['adm_object']->GetResult('gcount'); ?>
</label>)</a></label>  
 </div>
  
 <?php if (! $_GET['new']): ?>
    
<?php echo '
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = '; ?>
<?php if (! $this->_tpl_vars['adm_object']->GetResult('pcount')): ?>0<?php else: ?>1<?php endif; ?>;<?php echo '  
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
   alert(\'Выделите хотя бы одного пользователя!\'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == \'delete\') {
   if (!confirm(\'Вы действительно хотите удалить [\'+count+\'] пользователей из группы?\')) { return false; }
  } else 
  if (th.actionlistmakes.value == \'dall\') {
   if (!allsaveenabled) { alert(\'Нет данных для удаления!\'); return false; }	
   if (!confirm(\'Вы действительно хотите удалить всех пользователей группы?\')) { return false; }	
  }
  else { alert(\'Неизвестный идентификатор операции!\'); return false; }
  return true;   	
 }//PrepereSend
 function SetEnabled() {  	
  var count = GetSelCount();
  setElementOpacity(document.getElementById(\'adid\'), (allsaveenabled) ? 1 : 0.3);
  if (count <= 0) {
   setElementOpacity(document.getElementById(\'did\'), 0.3);
   return ;	 
  }
  setElementOpacity(document.getElementById(\'did\'), 1);
 }//SetEnabled
 function SetActionP(a) {
  var f = document.getElementById(\'vnewsform\');
  if (!f) { return ; }
  f.actionlistmakes.value = a;   	
 }//SetActionP   	
 function SetCheckByLine(ident) {
  var ch = $(\'#chid\'+ident);
  ch.attr(\'checked\', (ch.attr(\'checked\')) ? false : true);
  CheckItem(ident);   	
 }//SetCheckByLine
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
  
  
<form method="post" name="vnewsform" id="vnewsform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Удалить всех пользователей&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 200px;">
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Пользователь</span></td>
	<td class="h_td2" valign="center" align="center" width="130px">Дата</td>
   </tr>	
   <?php echo '
   <style type="text/css">
	.llw { display: inline-block; margin-left: 8px; vertical-align: baseline; padding-left: 20px; }
   </style>
   '; ?>

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
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8">
	  <span style="margin-left: 4px">
	   <input type="checkbox" name="chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
" id="chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
" 
	   style="cursor: pointer" onclick="CheckItem('<?php echo ($this->_foreach['val']['iteration']-1); ?>
', this)">
	  </span>
	 </td>
	 	 
	 
	 <td class="sth1" valign="center" align="left" onclick="SetCheckByLine('<?php echo ($this->_foreach['val']['iteration']-1); ?>
')" style="padding: 3px">
	  <?php $this->assign('userinfodata', $this->_tpl_vars['CONTROL_OBJ']->GetUserInfo($this->_tpl_vars['val']['userid'],true)); ?>
      <div>
      <?php if ($this->_tpl_vars['userinfodata']): ?>
      <a href="<?php echo @W_SITEPATH; ?>
account/admuserslisten/&filter1=9&lcstr=<?php echo $this->_tpl_vars['userinfodata']['username']; ?>
" target="_blank"><?php echo $this->_tpl_vars['userinfodata']['username']; ?>
</a></div>
      <?php else: ?>
      Unknow User
      <?php endif; ?>	  	 
	 </td> 
	 
	 <td class="sth1" valign="center" align="center" width="130px" style="border-right: 1px solid #E3E4E8;" 
	 onclick="SetCheckByLine('<?php echo ($this->_foreach['val']['iteration']-1); ?>
')">
	 <?php echo $this->_tpl_vars['val']['datecreate']; ?>

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
     Нет пользователей в группе!
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
	 $(\'#globalbodydata\').css(\'cursor\', \'wait\');
     th.rb.disabled = true;
     th.rbp.disabled = true;
	 return true; 	
	}//PrepereSent
    
	function SetActionIdent(n) {	
     document.getElementById(\'addnewnews\').actionnewprvmail.value = (n) ? \'act\' : \'prev\';	
    }//SetActionIdent
    
 </script>
 '; ?>
    
  
  <form method="post" name="addnewnews" id="addnewnews" onsubmit="return PrepereSend(this)">
      
      <div class="typelabel">
       <label id="red">*</label> Укажите логины пользователей, которые хотите добавить (по одному на строку)      
      </div>          
      <div class="typelabel">     
       <textarea class="int_text" style="height: 100px; width: 95%" name="usnames" id="usnames"><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('usnames','actionthissectionpost'); ?>
</textarea>
      </div>   

          
       
 <div class="typelabel" style="margin-top: 15px">
  <input type="submit" value="&nbsp;Добавить пользователей&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">
 </div>
 <input type="hidden" value="prev" name="actionnewprvmail">  
 <input type="hidden" value="do" name="actionthissectionpost">
 </form>
 
 <?php if ($_POST['actionthissectionpost'] == 'do' && ! $_POST['actionthissectionpost_q'] && $_POST['actionnewprvmail'] != 'prev'): ?>
 <div style="margin-top: 10px">
  <?php if ($this->_tpl_vars['adm_object']->error): ?>
   <label style="color: #FF0000"><?php echo $this->_tpl_vars['adm_object']->error; ?>
</label>
  <?php else: ?>
   <label style="color: #008000">Пользователи успешно добавлены в группу (добавлено: <strong><?php echo $this->_tpl_vars['adm_object']->adedusers; ?>
</strong>)!</label>
  <?php endif; ?>
 </div>
 <?php endif; ?>  
  
 
 <?php endif; ?>
 
<?php else: ?>
  <div style="margin: 7px 1px 12px 1px">
 <a href="<?php echo @W_SITEPATH; ?>
account/admusersgroups/?new=1<?php if ($_GET['page']): ?>&oldpage=<?php echo $_GET['page']; ?>
<?php endif; ?>"<?php if ($_GET['new'] && ! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?> style="color: #000000"<?php endif; ?>>Добавить группу</a> | <a<?php if (! $_GET['new']): ?> style="color: #000000"<?php endif; ?> href="<?php echo @W_SITEPATH; ?>
account/admusersgroups/<?php if ($_GET['oldpage']): ?>?page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?>">Все группы (<label style="color: #000000"><?php echo $this->_tpl_vars['adm_object']->GetResult('gcount'); ?>
</label>)</a>   
 </div>
 
 <?php if (! $_GET['new']): ?>
    
  <?php if (! $this->_tpl_vars['adm_object']->GetResult('data.source')): ?>
   <div style="text-align: center; padding: 6px; margin-top: 25px"><b>Нет активных групп!</b></div>
  <?php else: ?>
   <?php echo '
    <script type="text/javascript">
	 function DeleteSelectedElementSection(ident) {
	  if (!confirm("Вы действительно хотите удалить выбранную группу?\\r\\nПродолжить?")) {
	   return false;	
	  }	
	  var ppf = '; ?>
'<?php echo @W_SITEPATH; ?>
account/admusersgroups/<?php if ($_GET['page']): ?>?page=<?php echo $_GET['page']; ?>
<?php endif; ?>'<?php echo ';  
	  document.location = ppf + \'&qdelete=\' + ident;  
	 }
    </script>
   '; ?>

   <?php $_from = $this->_tpl_vars['adm_object']->GetResult('data.source'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
    <div style="margin: 4px; margin-top: 15px; padding: 4px; border: 1px solid #D2D2D2">
	 <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
       <tr>
       
        <td valign="top" align="left" width="50px" style="padding-right: 4px">
		 <img src="<?php echo @W_SITEPATH; ?>
img/ico/general/group_deleteblocked_128.png" border="0">
		</td>	
		
	    <td valign="top" align="left">
		 <div><a title="Просмотр пользователей группы" href="<?php echo @W_SITEPATH; ?>
account/admusersgroups/?group=<?php echo $this->_tpl_vars['val']['iditem']; ?>
<?php if ($_GET['page']): ?>&grouppage=<?php echo $_GET['page']; ?>
<?php endif; ?>"><strong><?php echo $this->_tpl_vars['val']['groupname']; ?>
</strong></a><label style="margin-left: 6px; font-size: 95%; color: #333399"><i>(пользователей: <?php echo $this->_tpl_vars['adm_object']->GetUsersCount($this->_tpl_vars['val']['iditem']); ?>
)</i></label></div>
		 <div style="margin-top: 4px; font-size: 95%; color: #808080">
		  <?php $this->assign('itemdescrit', $this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextFromDB($this->_tpl_vars['val']['groupdescr'])); ?>
		  <?php if (! $this->_tpl_vars['itemdescrit']): ?>Нет описания<?php else: ?><?php echo $this->_tpl_vars['itemdescrit']; ?>
<?php endif; ?>
		 </div>
		</td>
		
	    <td valign="top" align="right">
		 <div style="white-space: nowrap;">		 
		 
		 <a href="<?php echo @W_SITEPATH; ?>
account/admusersgroups/?modify=<?php echo $this->_tpl_vars['val']['iditem']; ?>
&new=1<?php if ($_GET['page']): ?>&oldpage=<?php echo $_GET['page']; ?>
<?php endif; ?>" title="Изменить"><img src="<?php echo @W_SITEPATH; ?>
img/items/document_edit.png" width="16" height="16"></a>
		 
		 <a style="margin-left: 6px" href="javascript:" onclick="DeleteSelectedElementSection('<?php echo $this->_tpl_vars['val']['iditem']; ?>
')" title="Удалить"><img src="<?php echo @W_SITEPATH; ?>
img/items/erase.png" width="16" height="16"></a>
		 
		 </div>
		</td>
       </tr>
      </table>
	 </span>
	</div>
   <?php endforeach; endif; unset($_from); ?> 
  <?php if ($this->_tpl_vars['adm_object']->GetResult('data.source')): ?>
   <div style="text-align: right; margin-top: 10px"><?php echo $this->_tpl_vars['adm_object']->GetResult('data.pagestext'); ?>
</div>
  <?php endif; ?>    
  <?php endif; ?> 
 
 <?php else: ?>
    
<?php echo '
 <script type="text/javascript">         
    function PrepereSend(th) {
	 
	 if (!th.groupname.value) {
	  alert(\'Укажите название группы!\');
	  th.groupname.focus();
	  return false;	
	 }
	 			 	 	 
	 $(\'#globalbodydata\').css(\'cursor\', \'wait\');
     $(\'input[id="rb"]\').attr(\'disabled\', \'disabled\');
     $(\'input[id="rbp"]\').attr(\'disabled\', \'disabled\');
	 return true; 	
	}//PrepereSent
	
	function PrepereSend4(th) {
	 $(\'#globalbodydata\').css(\'cursor\', \'wait\');
     $(\'input[id="rb"]\').attr(\'disabled\', \'disabled\');
     $(\'input[id="rbp"]\').attr(\'disabled\', \'disabled\');
	 return true;	
	}//PrepereSend4
	
	function SetActionIdent(n) {	
     document.getElementById(\'addgroupitem\').actionnewprvmail.value = (n) ? \'act\' : \'prev\';	
    }//SetActionIdent	
 </script>
 '; ?>

 
 
 <form method="post" name="addgroupitem" id="addgroupitem" onsubmit="return PrepereSend(this)">
   
   <?php if ($this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>
   <div style="margin-top: 15px; margin-bottom: 15px; background: #F0F0F0; padding: 3px"><b>Настройка группы</b></div>   
   <?php endif; ?>   
    
   <div class="typelabel"><label id="red">*</label> Название группы (до 120 символов)</div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 94%" name="groupname" id="groupname" maxlength="120" value="<?php echo $this->_tpl_vars['adm_object']->GetAsElementP('groupname'); ?>
">
   </div>
   
   <div class="typelabel" style="margin-top: 12px; margin-bottom: 12px">
    <b>Параметры группы</b>
   </div>
     
   <?php if ($_POST['actionnewprvmail'] == 'prev'): ?>
   <div style="padding: 4px; border: 1px solid #666699; margin-bottom: 20px; margin-top: 10px; width: 94%;">
   <?php echo $this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextFromDB($this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextToDB($_POST['groupdescr'])); ?>
  
   </div>
   <?php endif; ?> 
   
   <div class="typelabel">Описание группы</div>
   <div class="typelabel">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'new_message.tpl', 'smarty_include_vars' => array('ident' => 'groupdescr','source' => $_POST['groupdescr'],'height' => '90px','width' => '95%')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   </div>
   
   <div class="typelabel" style="margin-top: 15px">
    <input type="hidden" value="do" name="actionthissectnnews">
   </div> 
   
   <input type="submit" value="&nbsp;<?php if (! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>Добавить группу<?php else: ?>Изменить параметры группы<?php endif; ?>&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp;
   <input type="submit" value="&nbsp;Предварительный просмотр описания&nbsp;" class="button" name="rbp" id="rbp" onclick="SetActionIdent(0)">
   <input type="hidden" value="prev" name="actionnewprvmail">
   <input type="hidden" value="ok" name="actionnewsectionnews">
  </form>  
  
  <?php if ($_POST['actionthissectnnews'] == 'do' && ! $_POST['actionthissectionpost_q'] && $_POST['actionnewprvmail'] != 'prev'): ?>
 <div style="margin-top: 10px">
  <?php if ($this->_tpl_vars['adm_object']->error): ?>
   <label style="color: #FF0000"><?php echo $this->_tpl_vars['adm_object']->error; ?>
</label>
  <?php else: ?>
   <label style="color: #008000"><?php if (! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>Группа успешно добавлена!<?php else: ?>Параметры группы успешно изменены!<?php endif; ?></label>
  <?php endif; ?>
 </div>
 <?php endif; ?>  

 <?php endif; ?> 
<?php endif; ?>