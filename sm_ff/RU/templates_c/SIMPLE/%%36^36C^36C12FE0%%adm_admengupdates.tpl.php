<?php /* Smarty version 2.6.26, created on 2016-05-15 09:15:08
         compiled from adm_account/adm_admengupdates.tpl */ ?>
<div style="margin-top: 4px">
<div>
<a href="<?php echo @W_SITEPATH; ?>
account/admengupdates&new=1"<?php if ($_GET['new']): ?> style="color: #000000"<?php endif; ?>>Добавить апдейты</a> | <?php if ($_GET['new']): ?><a href="<?php echo @W_SITEPATH; ?>
account/admengupdates/">Все апдейты (<label style="color: #000000"><?php echo $this->_tpl_vars['global_updates_count_info']['0']; ?>
</label>)</a><?php else: ?>
<select size="1" style="width: 170px" name="ischlist" id="ischlist" onchange="DoGoToTypeLocation(this)">
 <option value="0" style="color: #0000FF">Все апдейты (<?php echo $this->_tpl_vars['global_updates_count_info']['0']; ?>
)</option>
 <option value="1"<?php if ($_GET['etype'] == '1'): ?> selected="selected"<?php endif; ?>>Яндекс ТиЦ (<?php echo $this->_tpl_vars['global_updates_count_info']['1']; ?>
)</option>
 <option value="2"<?php if ($_GET['etype'] == '2'): ?> selected="selected"<?php endif; ?>>Яндекс поиск (<?php echo $this->_tpl_vars['global_updates_count_info']['2']; ?>
)</option>
 <option value="3"<?php if ($_GET['etype'] == '3'): ?> selected="selected"<?php endif; ?>>Яндекс каталог (<?php echo $this->_tpl_vars['global_updates_count_info']['3']; ?>
)</option>
 <option value="4"<?php if ($_GET['etype'] == '4'): ?> selected="selected"<?php endif; ?>>Google PR (<?php echo $this->_tpl_vars['global_updates_count_info']['4']; ?>
)</option>
</select>
<?php endif; ?>
</div>
<div style="margin-top: 12px">
<?php if (! $_GET['new']): ?>
<?php echo '
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = '; ?>
<?php if (! $this->_tpl_vars['global_updates_count_info']['0']): ?>0<?php else: ?>1<?php endif; ?>;<?php echo '  
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
   alert(\'Выделите хотя бы один апдейт!\'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == \'delete\') {
   if (!confirm(\'Вы действительно хотите удалить [\'+count+\'] апдейтов?\')) { return false; }
  } else if (th.actionlistmakes.value == \'dall\') {
   if (!allsaveenabled) { alert(\'Нет данных для удаления!\'); return false; }	
   if (!confirm(\'Вы действительно хотите удалить все апдейты?\')) { return false; }	
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
  var f = document.getElementById(\'updatesform\');
  if (!f) { return ; }
  f.actionlistmakes.value = a;   	
 }//SetActionP
 function DoGoToTypeLocation(th) {
  var pathtolocale = \''; ?>
<?php echo @W_SITEPATH; ?>
'<?php echo ';
  var page = \''; ?>
<?php if ($_POST['page'] > 1): ?><?php echo $_POST['page']; ?>
<?php else: ?>0<?php endif; ?>'<?php echo ';
  var stype = (th.value == \'0\') ? \'\' : \'etype=\'+th.value;  
  if (page > 1) { stype = (!stype) ? \'page=\'+page : stype + \'&page=\' + page; }
  stype = (stype) ? \'&\'+stype : \'/\';  
  document.location = pathtolocale + \'account/admengupdates\' + stype;   	
 }//DoGoToTypeLocation    	
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
 
<form method="post" name="updatesform" id="updatesform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Удалить все апдейты&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 160px;">
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Тип</span></td>	
	<td class="h_td" valign="center" align="center" width="80px">Метод</td>	
	<td class="h_td2" valign="center" align="center" width="130px">Дата</td>
   </tr>	
   <?php if ($this->_tpl_vars['global_data_list_info'] && $this->_tpl_vars['global_data_list_info']['source']): ?>
	<?php $_from = $this->_tpl_vars['global_data_list_info']['source']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
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
	  <span style="margin-left: 3px"><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetEngineUpdateDescription($this->_tpl_vars['val']['engtype']); ?>
</span>	 
	 </td> 
	 <td class="sth1" valign="center" align="center" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()" width="80px">
	  <?php if (! @W_ADMENGINEUPDATESAUTOADD || ( $this->_tpl_vars['val']['engtype'] == 4 && ! @W_AUTOCREATEPRUPDATESLIST )): ?>
	   <i>(нет)</i>
	  <?php else: ?>
	   	<i style="color: #333399">(auto)</i>  
	  <?php endif; ?>	  	 
	 </td>
	 <td class="sth1" valign="center" align="center" width="130px" style="border-right: 1px solid #E3E4E8;" 
	 onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()">
	 <?php echo $this->_tpl_vars['val']['dateupd']; ?>

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
    <td valign="center" align="center" class="btn_n" colspan="5">
     Нет активных апдейтов!
     <script type="text/javascript">
	  document.getElementById('checkallitems').disabled = true;
     </script>
    </td>
   </tr> 
   <?php endif; ?> 
 </table>
 <?php if ($this->_tpl_vars['global_data_list_info'] && $this->_tpl_vars['global_data_list_info']['source']): ?>
 <div style="text-align: right; margin-top: 10px"><?php echo $this->_tpl_vars['global_data_list_info']['pagestext']; ?>
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
  var curDate = new Date(); 
  function CheckDateS(s) {	
   var Pat=/^(\\d{4})\\-(\\d{2})\\-(\\d{2})$/;
   var DArray = s.match(Pat);
   if (DArray != null) { 	    	
   	if (DArray[2] <= 0 || DArray[2] > 12) { return false; }
   	if (DArray[3] <= 0 || DArray[3] > 31) { return false; }
   	if (DArray[1] <= 0 || DArray[1] > curDate.getFullYear()) { return false; }
   	return true;
   }
   return false;
  }//CheckDateS 
  function RestInp(th) {
   if (th.value == \'\' || !CheckDateS(th.value)) {
	 th.className = \'inpt_r\';
	 return ;	
	}	
   th.className = \'inpt\';	
  }//RestInp
  function PrepereSend(th) {
   RestInp(th.upddate);	
   if (th.upddate.value == \'\' || !CheckDateS(th.upddate.value)) {
	alert(\'Укажите дату для добавления в формате: YYYY-mm-dd\');
	th.upddate.focus();
	return false;
   }   
   return true;   	
  }//PrepereSend	
 </script>
 '; ?>

 <form method="post" name="updatesformadd" id="updatesformadd" onsubmit="return PrepereSend(this)">
  <div class="typelabel"><label id="red">*</label> Добавить в</div>
  <div>
  <select size="1" style="width: 320px" name="updtype" id="updtype">
   <option value="1"<?php if ($_POST['updtype'] == '1'): ?> selected="selected"<?php endif; ?>>Яндекс ТиЦ</option>
   <option value="2"<?php if ($_POST['updtype'] == '2'): ?> selected="selected"<?php endif; ?>>Яндекс поиск</option>
   <option value="3"<?php if ($_POST['updtype'] == '3'): ?> selected="selected"<?php endif; ?>>Яндекс каталог</option>
   <option value="4"<?php if ($_POST['updtype'] == '4'): ?> selected="selected"<?php endif; ?>>Google PR</option>
  </select>
  </div>
  
  <div class="typelabel"><label id="red">*</label> Дата (формат: YYYY-mm-dd)</div>
  <div><input type="text" class="inpt" style="width: 320px" name="upddate" id="upddate" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('upddate','updatesactionnew','do',$this->_tpl_vars['CONTROL_OBJ']->GetThisDate()); ?>
" onclick="RestInp(this)" onblur="RestInp(this)" maxlength="10"></div>
  
 <input type="hidden" value="do" name="updatesactionnew">
 <div class="typelabel"><input type="submit" value="&nbsp;Добавить дату&nbsp;" class="button" name="rb" id="rb"></div>
 </form>
 <?php if ($this->_tpl_vars['err_str_inv']): ?>
 <div style="margin-top: 8px">
  <?php if ($this->_tpl_vars['err_str_inv'] != 1): ?>
   <label style="color: #FF0000"><?php echo $this->_tpl_vars['err_str_inv']; ?>
</label>
  <?php else: ?>
   <label style="color: #008000">Дата успешно добавлена!</label>
  <?php endif; ?>
 </div>
 <?php endif; ?>
<?php endif; ?>
</div>
</div>