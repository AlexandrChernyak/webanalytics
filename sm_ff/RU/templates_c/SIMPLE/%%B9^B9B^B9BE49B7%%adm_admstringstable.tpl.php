<?php /* Smarty version 2.6.26, created on 2016-05-15 09:19:33
         compiled from adm_account/adm_admstringstable.tpl */ ?>
<div style="margin-top: 4px">
<div>
<a href="<?php echo @W_SITEPATH; ?>
account/admstringstable&new=1<?php if ($_GET['page']): ?>&oldpage=<?php echo $_GET['page']; ?>
<?php endif; ?>"<?php if ($_GET['new']): ?> style="color: #000000"<?php endif; ?>>Добавить строку</a> | <a<?php if (! $_GET['new']): ?> style="color: #000000"<?php endif; ?> href="<?php echo @W_SITEPATH; ?>
account/admstringstable/<?php if ($_GET['oldpage']): ?>&page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?>">Все строки (<label style="color: #000000"><?php echo $this->_tpl_vars['adm_object']->GetResult('count'); ?>
</label>)</a>
</div>
<div style="margin-top: 12px">
<?php if (! $_GET['new']): ?>
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
   alert(\'Выделите хотя бы одну строку!\'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == \'delete\') {
   if (!confirm(\'Вы действительно хотите удалить [\'+count+\'] строк?\')) { return false; }
  } else 
  if (th.actionlistmakes.value == \'dall\') {
   if (!allsaveenabled) { alert(\'Нет данных для удаления!\'); return false; }	
   if (!confirm(\'Вы действительно хотите удалить все строки?\')) { return false; }	
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
  var f = document.getElementById(\'vstringsform\');
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
 
<form method="post" name="vstringsform" id="vstringsform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Удалить все строки&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 160px;">
 </span> 
 
 <?php echo '
 <script type="text/javascript"> 
  function NavigateLabel(th) {
   var page=\''; ?>
<?php if ($_GET['page']): ?><?php echo $_GET['page']; ?>
<?php else: ?>1<?php endif; ?><?php echo '\'; 
   document.location = \''; ?>
<?php echo @W_SITEPATH; ?>
<?php echo 'account/admstringstable/\'+
   ((page && page != \'1\') ? \'&page=\'+page : \'\') + \'&ilabel=\' + encodeURIComponent(th.value);   
  }//NavigateLabel	
 </script>
 '; ?>

 <span style="margin-left: 6px">
 метка: <select size="1" style="border: none; background: #E8E8E8; width: 350px" name="ilabels" id="ilabels" onchange="NavigateLabel(this)">
  <option value="">Все метки</option>
  <?php $_from = $this->_tpl_vars['adm_object']->GetLabelsList(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
   <?php if ($this->_tpl_vars['val']): ?>
    <option value="<?php echo $this->_tpl_vars['val']; ?>
"<?php if ($_GET['ilabel'] == $this->_tpl_vars['val']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['val']; ?>
</option>
   <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
 </select>
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
	<td class="h_td" valign="center" align="left" width="200px"><span style="margin-left: 3px">Идентификатор</span></td>
    <td class="h_td" valign="center" align="left" width="200px"><span style="margin-left: 3px"></span>Описание</td>
	<td class="h_td2" valign="center" align="center"><span style="margin-left: 3px">Метка</span></td>
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
	 
	 <td class="sth1" valign="center" align="left" width="200px" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()">
	  <span style="margin-left: 3px">	  
	  <a href="<?php echo @W_SITEPATH; ?>
account/admstringstable&new=1&modify=<?php echo $this->_tpl_vars['val']['strident']; ?>
<?php if ($_GET['page']): ?>&oldpage=<?php echo $_GET['page']; ?>
<?php endif; ?>" title="Изменить текст константы"><?php echo $this->_tpl_vars['val']['strident']; ?>
</a>	  
	  </span>	 
	 </td> 
	 
     <td class="sth1" valign="center" align="left" width="200px" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()">
	 <span style="margin-left: 3px">	  
	  <?php echo $this->_tpl_vars['val']['strdescr']; ?>
	  
	  </span>
	 </td>
	 
	 <td class="sth1" valign="center" align="center" style="border-right: 1px solid #E3E4E8;" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()">
	 <span style="margin-left: 3px">	  
	  <?php if ($this->_tpl_vars['val']['labelid']): ?><?php echo $this->_tpl_vars['val']['labelid']; ?>
<?php else: ?><em>(нет метки)</em><?php endif; ?>	  
	  </span>
	 </td>
	 
    </tr>  
	<script type="text/javascript">list_items[<?php echo ($this->_foreach['val']['iteration']-1); ?>
] = '<?php echo ($this->_foreach['val']['iteration']-1); ?>
';</script>
	<input type="hidden" value="<?php echo $this->_tpl_vars['val']['strident']; ?>
" name="idm<?php echo ($this->_foreach['val']['iteration']-1); ?>
">
	<?php endforeach; endif; unset($_from); ?>
   <?php else: ?>
   <tr>
    <td valign="center" align="center" class="btn_n" colspan="4">
     Нет активных строк!
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
  function CheckItems(arr) {
   var obj = false;
   for (var i=0; i < arr.length; i++) {
    obj = $(\'#\'+arr[i]);
    if (!trim(obj.val())) {
	 alert(\'Значение не должно быть пустым!\');
	 obj.focus();
	 return false;	
	}    
   }
   return true;	
  }//CheckItems
           
  function PrepereSent(th) {
   if (th.ident && !trim(th.ident.value)) { 
    alert(\'Укажите идентификатор строки!\');
    th.ident.focus();
    return false;
   }	
   if (!CheckItems(['; ?>
<?php echo $this->_tpl_vars['adm_object']->GetResult('blockcheck'); ?>
<?php echo '])) { return false; }			 	 
   $(\'#globalbodydata\').css(\'cursor\', \'wait\');
   th.rb.disabled = true;
   return true; 	
  }//PrepereSent	
 </script>
 '; ?>

 
 <form method="post" name="addnewstring" id="addnewstring" onsubmit="return PrepereSent(this)">
  
  <?php if ($this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>
  <div style="margin-top: 4px">&nbsp;</div>
  <?php endif; ?>
  <div class="typelabel"><label id="red">*</label> Идентификатор строки<?php if (! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?> (до 120 символов)<?php endif; ?></div>
  <div class="typelabel">
   <?php if (! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>
   <input type="text" class="inpt" style="width: 370px" name="ident" id="ident" maxlength="120" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('ident','actionthissectionpost'); ?>
">
   <?php else: ?>
   <b style="margin-left: 8px"><?php echo $this->_tpl_vars['adm_object']->GetResult('modifyinfo'); ?>
</b>
   <?php endif; ?>
  </div>  
  
  <div class="typelabel" style="margin-top: 6px"> Метка (до 80 символов)</div>
  <div class="typelabel">
   <input type="text" class="inpt" style="width: 370px" name="labelid" id="labelid" maxlength="80" value="<?php if ($_POST['actionthissectionpost'] == 'do'): ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('labelid','actionthissectionpost'); ?>
<?php else: ?><?php echo $this->_tpl_vars['adm_object']->GetResult('modifyinfolabel'); ?>
<?php endif; ?>">
  </div>
  <?php if ($this->_tpl_vars['adm_object']->GetLabelsList()): ?>
  <div class="typelabel" style="margin-top: 6px"> или выбирите существующую метку</div>
  <div class="typelabel">   
   <select size="1" style="width: 373px" name="labelid2" id="labelid2">
   <option value=""></option>
   <?php $_from = $this->_tpl_vars['adm_object']->GetResult('labelslist'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
    <option value="<?php echo $this->_tpl_vars['val']; ?>
"><?php echo $this->_tpl_vars['val']; ?>
</option>
   <?php endforeach; endif; unset($_from); ?>
   </select> 
  </div>
  <?php endif; ?>  
  
  <?php $_from = $this->_tpl_vars['adm_object']->GetResult('blocklist'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
   <?php if (($this->_foreach['val']['iteration']-1) > 0): ?>
    <div style="margin-top: 4px">&nbsp;</div>
   <?php endif; ?>
   <div style="margin-top: 18px">
    <div style="padding-bottom: 3px; border-bottom: 1px solid #C0C0C0; background: #F0F0F0; width: 96%">
	 <b><?php echo $this->_tpl_vars['val']['descr']; ?>
</b>
	</div>    
    <div class="typelabel"><label id="red">*</label> Описание строки (до 150 символов)</div>
    <div class="typelabel">
     <input type="text" class="inpt" style="width: 95%" name="<?php echo $this->_tpl_vars['val']['fid1']; ?>
" id="<?php echo $this->_tpl_vars['val']['fid1']; ?>
" maxlength="150" value="<?php echo $this->_tpl_vars['val']['name']; ?>
">
    </div>
    <div class="typelabel"><label id="red">*</label> Текст строки (<b>HTML тэги поддерживаются!!</b>)</div>
    <div class="typelabel">
     <textarea class="int_text" style="height: 150px; width: 95%" name="<?php echo $this->_tpl_vars['val']['fid2']; ?>
" id="<?php echo $this->_tpl_vars['val']['fid2']; ?>
"><?php echo $this->_tpl_vars['val']['data']; ?>
</textarea>
	</div>   
   </div>
  <?php endforeach; endif; unset($_from); ?>    
   
 <div class="typelabel" style="margin-top: 15px">
  <input type="submit" value="&nbsp;<?php if (! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>Добавить строку<?php else: ?>Сохранить изменения<?php endif; ?>&nbsp;" class="button" name="rb" id="rb">
 </div>
   
 <input type="hidden" value="do" name="actionthissectionpost">
 </form>
 
 
 <?php if ($_POST['actionthissectionpost'] == 'do' && ! $_POST['actionthissectionpost_q']): ?>
 <div style="margin-top: 10px">
  <?php if ($this->_tpl_vars['adm_object']->error): ?>
   <label style="color: #FF0000"><?php echo $this->_tpl_vars['adm_object']->error; ?>
</label>
  <?php else: ?>
   <label style="color: #008000">Строка успешно <?php if (! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>добавлена<?php else: ?>изменена<?php endif; ?>!</label>
  <?php endif; ?>
 </div>
 <?php endif; ?>
<?php endif; ?>
</div>
</div>