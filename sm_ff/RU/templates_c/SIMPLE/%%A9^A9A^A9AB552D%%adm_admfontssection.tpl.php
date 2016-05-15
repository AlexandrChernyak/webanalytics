<?php /* Smarty version 2.6.26, created on 2016-05-15 09:19:36
         compiled from adm_account/adm_admfontssection.tpl */ ?>
<div style="margin-top: 4px">
<div>
<a href="<?php echo @W_SITEPATH; ?>
account/admfontssection&new=1"<?php if ($_GET['new']): ?> style="color: #000000"<?php endif; ?>>Добавить шрифт</a> | <a href="<?php echo @W_SITEPATH; ?>
account/admfontssection/"<?php if (! $_GET['new']): ?> style="color: #000000"<?php endif; ?>>Все шрифты (<label style="color: #000000"><?php echo $this->_tpl_vars['adm_object']->GetResult('count'); ?>
</label>)</a>
</div>
<div style="margin-top: 12px">
<?php if (! $_GET['new']): ?>
<?php echo '
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = '; ?>
<?php echo $this->_tpl_vars['adm_object']->GetResult('count'); ?>
;<?php echo '  
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
   alert(\'Выделите хотя бы один файл шрифта!\'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == \'delete\') {
   if (!confirm(\'Вы действительно хотите удалить [\'+count+\'] файлов?\')) { return false; }
  } else 
  if (th.actionlistmakes.value == \'enabled\') {
   if (!confirm(\'Вы действительно хотите активировать [\'+count+\'] шрифтов?\')) { return false; }
  } else
  if (th.actionlistmakes.value == \'disabled\') {
   if (!confirm(\'Вы действительно хотите деактивировать [\'+count+\'] шрифтов?\')) { return false; }
  } else
   if (th.actionlistmakes.value == \'dall\') {
    if (!allsaveenabled) { alert(\'Нет данных для удаления!\'); return false; }	
    if (!confirm(\'Вы действительно хотите удалить все шрифты?\')) { return false; }	
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
  var f = document.getElementById(\'fontsform\');
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
 
<form method="post" name="fontsform" id="fontsform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Удалить все файлы&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 160px;">
 </span>
 
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Включить&nbsp;" class="activatelistit" name="ena" id="ena" onclick="SetActionP('enabled')" style="//width: 80px;">
 </span>

 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Отключить&nbsp;" class="deactivatelistit" name="dna" id="dna" onclick="SetActionP('disabled')" style="//width: 80px;">
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Шрифт</span></td>	
	<td class="h_td" valign="center" align="center" width="80px">Размер</td>
	<td class="h_td" valign="center" align="center" width="80px">Активен</td>	
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
	  <span style="margin-left: 3px; white-space: nowrap">	  
	  <img src="<?php echo @W_SITEPATH; ?>
img/items/font_tt_2.png" style="width: 16px; height: 16px; margin-right: 6px; position: relative;"> 
	  <span style="position: relative; top: -2px"><a href="<?php echo @W_SITEPATH; ?>
account/admfontssection&downloadfile=<?php echo $this->_tpl_vars['val']['iditem']; ?>
" title="Скачать файл"><?php echo $this->_tpl_vars['val']['fontname']; ?>
</a></span>
	  </span>	 
	 </td> 
	 <td class="sth1" valign="center" align="center" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()" width="80px">
	  <?php echo $this->_tpl_vars['adm_object']->GetSizeItem($this->_tpl_vars['val']['fontsize']); ?>
	  	 
	 </td>
	 <td class="sth1" valign="center" align="center" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()" width="80px">
	  <?php if (! $this->_tpl_vars['val']['fontuse']): ?><i>(нет)</i><?php else: ?><i style="color: #333399">(активен)</i><?php endif; ?>	  	 
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
    <td valign="center" align="center" class="btn_n" colspan="5">
     Нет загруженных шрифтов!
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
  function PrepereToSend(th) {
   $(\'#globalbodydata\').css(\'cursor\', \'wait\');
   th.rb.disabled = true;   
   return true;	
  }//PrepereToSend  	
 </script>
 '; ?>

 <form method="post" name="ffadd" id="ffadd" enctype="multipart/form-data" onsubmit="return PrepereToSend(this)"> 
  
  <div class="typelabel"><label id="red">*</label> Файл шрифта (форматы: <?php echo $this->_tpl_vars['adm_object']->GetListTypes(); ?>
<?php if ($this->_tpl_vars['adm_object']->GetResult('maxsize')): ?>, максимальный размер: <b><?php echo $this->_tpl_vars['adm_object']->GetResult('maxsize'); ?>
</b>)<?php endif; ?></div>  
  <div class="typelabel"> 
   <input type="file" size="20" style="width: 430px; height: 22px" class="inpt" name="font" id="font">  
  </div>
  
 <input type="hidden" value="do" name="updatesactionnew">
 <div class="typelabel"><input type="submit" value="&nbsp;Добавить файл&nbsp;" class="button" name="rb" id="rb"></div>
 </form>
 <?php if ($_POST['updatesactionnew'] == 'do'): ?>
 <div style="margin-top: 10px">
  <?php if ($this->_tpl_vars['adm_object']->error): ?>
   <label style="color: #FF0000"><?php echo $this->_tpl_vars['adm_object']->error; ?>
</label>
  <?php else: ?>
   <label style="color: #008000">Файл успешно добавлен!</label>
  <?php endif; ?>
 </div>
 <?php endif; ?>
<?php endif; ?>
</div>
</div>