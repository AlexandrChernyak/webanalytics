<?php /* Smarty version 2.6.26, created on 2013-11-14 13:16:55
         compiled from adm_account/adminformersfiles/adm_adminformersfiles_sect_list.tpl */ ?>
<div style="margin-top: 4px">
<div>
<a href="<?php echo @W_SITEPATH; ?>
account/adminformersfiles/&sectionslist=1&new=1&inftype=<?php if ($_GET['inftype']): ?><?php echo $_GET['inftype']; ?>
<?php else: ?>1<?php endif; ?><?php if ($_GET['oldpage']): ?>&oldpage=<?php echo $_GET['oldpage']; ?>
<?php endif; ?>&sections=<?php if ($_GET['sections']): ?><?php echo $_GET['sections']; ?>
<?php else: ?>0<?php endif; ?>"<?php if ($_GET['new']): ?> style="color: #000000"<?php endif; ?>>Добавить раздел</a> | 
<a href="<?php echo @W_SITEPATH; ?>
account/adminformersfiles/&sectionslist=1&inftype=<?php if ($_GET['inftype']): ?><?php echo $_GET['inftype']; ?>
<?php else: ?>1<?php endif; ?><?php if ($_GET['oldpage']): ?>&oldpage=<?php echo $_GET['oldpage']; ?>
<?php endif; ?>&sections=<?php if ($_GET['sections']): ?><?php echo $_GET['sections']; ?>
<?php else: ?>0<?php endif; ?>"<?php if (! $_GET['new']): ?> style="color: #000000"<?php endif; ?>>Список разделов (<label style="color: #000000"><?php echo $this->_tpl_vars['adm_object']->GetResult('count'); ?>
</label>)</a><label style="margin-left: 18px"><a href="<?php echo @W_SITEPATH; ?>
account/adminformersfiles/&inftype=<?php if ($_GET['inftype']): ?><?php echo $_GET['inftype']; ?>
<?php else: ?>1<?php endif; ?>&sections=<?php if ($_GET['sections']): ?><?php echo $_GET['sections']; ?>
<?php else: ?>0<?php endif; ?><?php if ($_GET['oldpage']): ?>&page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?>">&lt;&lt; Вернуться к списку информеров</a></label>
</div>
<div style="margin-top: 12px">
<?php if (! $_GET['new']): ?>
<?php echo '
<script type="text/javascript">
 function PrepereSend(th) {
  var count = GetSelCount();
  if (count <= 0 && th.actionlistinvitecode.value != \'dall\') { 
   alert(\'Выделите хотя бы один раздел!\'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistinvitecode.value == \'delete\') {
   if (!confirm(\'Вы действительно хотите удалить [\'+count+\'] разделов? Все информеры внутри выбранных разделов будут удалены.. Продолжить?\')) { return false; }
  } else if (th.actionlistinvitecode.value == \'dall\') {
   if (!allsaveenabled) { alert(\'Нет данных для удаления!\'); return false; }	
   if (!confirm(\'Вы действительно хотите удалить все разделы? Все информеры внутри разделов будут удалены. Продолжить?\')){
   	return false; 
   }	
  } else { alert(\'Неизвестный идентификатор операции!\'); return false; }
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
  var f = document.getElementById(\'sectform\');
  if (!f) { return ; }
  f.actionlistinvitecode.value = a;   	
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
 
<form method="post" name="sectform" id="sectform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Удалить все разделы&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 150px;">
 </span>
 </div>
 <div style="margin-top: 6px">
 <span style="width: 100%">
 <table width="100%" cellpadding="0" cellspacing="0" border="0">
   <tr>
    <td class="h_th1" valign="center" align="left" width="20px">
	 <span style="margin-left: 4px">
	  <input type="checkbox" name="checkallinvites" id="checkallinvites" style="cursor: pointer" onclick="CheckAll(this)">
	 </span>
	</td>
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Название</span></td>
	<td class="h_td" valign="center" align="center" width="150px">Кол-во информеров</td>
	<td class="h_td" valign="center" align="center" width="80px">Столбцов</td>		
	<td class="h_td" valign="center" align="center" width="60px">Действие</td>
	<td class="h_td2" valign="center" align="center" width="130px">Дата</td>
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
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8">
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
	  <span style="margin-left: 3px"><?php echo $this->_tpl_vars['val']['secname']; ?>
</span>	 
	 </td>
	 <td class="sth1" valign="center" align="center" style="padding-left: 4px" width="150px" 
	 onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()"> 
	  <?php echo $this->_tpl_vars['adm_object']->GetInformersCountInSection($this->_tpl_vars['val']['iditem']); ?>

	 </td>
	 <td class="sth1" valign="center" align="center" width="80px" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()">
	  <?php echo $this->_tpl_vars['val']['colcount']; ?>
	 	 	 
	 </td>
	 <td class="sth1" valign="center" align="center" width="60px" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()">
	  <label style="padding: 3px">
	   <a href="<?php echo @W_SITEPATH; ?>
account/adminformersfiles/&sectionslist=1&inftype=<?php if ($_GET['inftype']): ?><?php echo $_GET['inftype']; ?>
<?php else: ?>1<?php endif; ?>&modifysect=<?php echo $this->_tpl_vars['val']['iditem']; ?>
&new=1<?php if ($_GET['oldpage']): ?>&oldpage=<?php echo $_GET['oldpage']; ?>
<?php endif; ?>&sections=<?php if ($_GET['sections']): ?><?php echo $_GET['sections']; ?>
<?php else: ?>0<?php endif; ?>" title="Изменить"><img src="<?php echo @W_SITEPATH; ?>
img/items/document_edit.png" width="16" height="16"></a>
	  </label>	 	 	 
	 </td>
	 <td class="sth1" valign="center" align="center" width="130px" style="border-right: 1px solid #E3E4E8;" 
	 onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()">
	 <?php echo $this->_tpl_vars['val']['datecreat']; ?>

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
    <td valign="center" align="center" class="btn_n" colspan="6">
     Нет активных разделов!
     <script type="text/javascript">
	  document.getElementById('checkallinvites').disabled = true;
     </script>
    </td>
   </tr> 
   <?php endif; ?> 
 </table>
 <?php if ($this->_tpl_vars['adm_object']->GetResult('data.pagestext')): ?>
 <div style="text-align: right; margin-top: 10px"><?php echo $this->_tpl_vars['adm_object']->GetResult('data.pagestext'); ?>
</div>
 <?php endif; ?> 
 </span>
 </div> 
 <input type="hidden" value="0" name="actioncountmess">
 <input type="hidden" value="none" name="actionlistinvitecode"> 
</form>
<script type="text/javascript">SetEnabled();</script>
<?php else: ?>
  <?php echo '
 <script type="text/javascript">
  function PrepereSend(th) {	
   if (!trim(th.sname.value)) {
	alert(\'Укажите название нового раздела!\');
	th.sname.focus();
	return false;
   }
   if (!IisInteger(th.scols.value) || th.scols.value <= 0 || th.scols.value > 99) {
   	alert(\'Укажите количество столбцов, на которые будут делится информеры в разделе! Значение от 1 до 99!\');
   	th.scols.focus();
   	return false;
   }   
   return true;   	
  }//PrepereSend	
 </script>
 '; ?>

 <form method="post" name="sectformadd" id="sectformadd" onsubmit="return PrepereSend(this)">
  
  <?php if ($_GET['modifysect'] && $this->_tpl_vars['adm_object']->GetResult('data')): ?>
  <div style="margin-top: 16px">Изменение раздела ::  <b><?php echo $this->_tpl_vars['adm_object']->GetResult('data.secname'); ?>
</b></div>
  <div style="margin-top: 6px">&nbsp;</div>
  <?php endif; ?>
  
  <div class="typelabel"><label id="red">*</label> Название раздела</div>
  <div class="typelabel">
   <input type="text" class="inpt" style="width: 320px" name="sname" id="sname" value="<?php if (! $_GET['modifysect'] || ! $this->_tpl_vars['adm_object']->GetResult('data')): ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('sname','addinformsection'); ?>
<?php else: ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('sname','addinformsection','do',$this->_tpl_vars['adm_object']->GetResult('data.secname')); ?>
<?php endif; ?>" maxlength="99"<?php if ($_GET['modifysect'] && ! $this->_tpl_vars['adm_object']->GetResult('data') && ! $_POST['addinformsection']): ?> disabled="disabled"<?php endif; ?>>
  </div>
  
  <div class="typelabel"><label id="red">*</label> Делить информеры раздела на количество колонок:</div>
  <div class="typelabel">
   <input type="text" class="inpt" style="width: 320px" name="scols" id="scols" value="<?php if (! $_GET['modifysect'] && ! $this->_tpl_vars['adm_object']->GetResult('data')): ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('scols','addinformsection','do','2'); ?>
<?php else: ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('scols','addinformsection','do',$this->_tpl_vars['adm_object']->GetResult('data.colcount')); ?>
<?php endif; ?>" maxlength="2"<?php if ($_GET['modifysect'] && ! $this->_tpl_vars['adm_object']->GetResult('data') && ! $_POST['addinformsection']): ?> disabled="disabled"<?php endif; ?>>
  </div>
    
 <input type="hidden" value="do" name="addinformsection">
 <div class="typelabel"><input type="submit" value="&nbsp;<?php if (! $_GET['modifysect']): ?>Создать раздел<?php else: ?>Изменить раздел<?php endif; ?>&nbsp;" class="button" name="rb" id="rb"<?php if ($_GET['modifysect'] && ! $this->_tpl_vars['adm_object']->GetResult('data') && ! $_POST['addinformsection']): ?> disabled="disabled"<?php endif; ?>></div>
 </form>
 
 <?php if ($_POST['addinformsection'] == 'do'): ?>
 <div style="margin-top: 10px">
  <?php if ($this->_tpl_vars['adm_object']->error): ?>
   <label style="color: #FF0000"><?php echo $this->_tpl_vars['adm_object']->error; ?>
</label>
  <?php else: ?>
   <label style="color: #008000"><?php if (! $_GET['modifyimage'] && ! $this->_tpl_vars['adm_object']->GetResult('data')): ?>Раздел успешно создан!<?php else: ?>Раздел успешно изменен!<?php endif; ?></label>
  <?php endif; ?>
 </div>
 <?php endif; ?>
 
<?php endif; ?>
</div>
</div>