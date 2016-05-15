<?php /* Smarty version 2.6.26, created on 2016-05-15 09:18:57
         compiled from adm_account/adm_admlinksvitrina.tpl */ ?>
<div style="margin-top: 4px">
<div>
<a href="<?php echo @W_SITEPATH; ?>
account/admlinksvitrina&new=1"<?php if ($_GET['new']): ?> style="color: #000000"<?php endif; ?>>Добавить ссылку</a> | <a<?php if (! $_GET['new']): ?> style="color: #000000"<?php endif; ?> href="<?php echo @W_SITEPATH; ?>
account/admlinksvitrina/">Все ссылки (<label style="color: #000000"><?php echo $this->_tpl_vars['adm_object']->GetResult('count'); ?>
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
   alert(\'Выделите хотя бы одну ссылку!\'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == \'delete\') {
   if (!confirm(\'Вы действительно хотите удалить [\'+count+\'] ссылок?\')) { return false; }
  } else 
  if (th.actionlistmakes.value == \'dall\') {
   if (!allsaveenabled) { alert(\'Нет данных для удаления!\'); return false; }	
   if (!confirm(\'Вы действительно хотите удалить все ссылки?\')) { return false; }	
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
  var f = document.getElementById(\'vlinksform\');
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
 
<form method="post" name="vlinksform" id="vlinksform" onsubmit="return PrepereSend(this)">
 <div style="margin-top: 8px; white-space: nowrap;">
 <input type="submit" value="&nbsp;Удалить&nbsp;" class="deletemessbut" name="did" id="did" onclick="SetActionP('delete')" style="//width: 80px;">
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Удалить все ссылки&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 160px;">
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Ссылка</span></td>
	<td class="h_td" valign="center" align="center" width="30px">ДЯ</td>
	<td class="h_td" valign="center" align="center" width="30px">СА</td>	
	<td class="h_td" valign="center" align="center" width="80px">Bold</td>
	<td class="h_td" valign="center" align="center" width="80px">Indexed</td>
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
	 
	 <td class="sth1" valign="center" align="left" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()">
	  <span style="margin-left: 3px">	  
	  <a class="llw" href="http://<?php echo $this->_tpl_vars['val']['lurl']; ?>
" target="_blank" style="background: transparent url(http://favicon.yandex.net/favicon/<?php echo $this->_tpl_vars['val']['lhost']; ?>
) no-repeat left top"><?php echo $this->_tpl_vars['val']['ltext']; ?>
</a>	  
	  </span>	 
	 </td> 
	 
	 <td class="sth1" valign="center" align="center" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()" width="30px">
	  <label style="padding: 3px">
	   <a href="<?php echo @W_SITEPATH; ?>
account/admlinksvitrina/&modify=<?php echo $this->_tpl_vars['val']['iditem']; ?>
&new=1" title="Изменить"><img src="<?php echo @W_SITEPATH; ?>
img/items/document_edit.png" width="16" height="16"></a>
	  </label>	  	  	 
	 </td>
	 
	 <td class="sth1" valign="center" align="center" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()" width="30px">
	  <?php if ($this->_tpl_vars['val']['lfromcountr']): ?><img src="<?php echo $this->_tpl_vars['adm_object']->GetFlagName($this->_tpl_vars['val']['lfromcountr']); ?>
" alt="<?php echo $this->_tpl_vars['val']['lfromcountr']; ?>
" border="0" width="16" height="16"> <?php else: ?>?<?php endif; ?>	  	  	 
	 </td>
	 
	 <td class="sth1" valign="center" align="center" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()" width="80px">
	  <?php if ($this->_tpl_vars['val']['isbolded']): ?><i style="color: #008000">(да)</i><?php else: ?><i>(нет)</i><?php endif; ?>	  	  	 
	 </td>
	 
	 <td class="sth1" valign="center" align="center" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()" width="80px">
	  <?php if ($this->_tpl_vars['val']['isindexed']): ?><i style="color: #008000">(да)</i><?php else: ?><i>(нет)</i><?php endif; ?>	  	  	 
	 </td>
	 
	 <td class="sth1" valign="center" align="center" width="130px" style="border-right: 1px solid #E3E4E8;" 
	 onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()">
	 <?php echo $this->_tpl_vars['val']['ldate']; ?>

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
    <td valign="center" align="center" class="btn_n" colspan="7">
     Нет активных ссылок!
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
   function RestInp(th) {
    if (!th.value) {
      th.className = \'inpt_r\';
      return ;   	
     } 
     th.className = \'inpt\';	
    }//RestInp
        
    function PrepereSent(th) {
     RestInp(th.url);
	 RestInp(th.urltext);		 	
	 if (trim(th.url.value) == \'\') {
	  alert(\'Укажите URL ссылки!\');
	  th.url.focus();
	  return false;	
	 }
	 if (trim(th.urltext.value) == \'\') {
	  alert(\'Укажите текст ссылки!\');
	  th.urltext.focus();
	  return false;	
	 }
	 if (th.ptype.value < 1 || th.ptype.value > 4) {
	  alert(\'Укажите тип ссылки!\');
	  return false;	
	 }		 	 
	 $(\'#globalbodydata\').css(\'cursor\', \'wait\');
     th.rb.disabled = true;
	 return true; 	
	}//PrepereSent
		
	function SetTyped(n) { $(\'#ptype\').val(n); }	
 </script>
 '; ?>

 <form method="post" name="addnewlinkd" id="addnewlinkd" onsubmit="return PrepereSent(this)">
 
  <?php if ($this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>
  <?php echo '
   <style type="text/css">
	.llw { display: inline-block; margin-left: 8px; vertical-align: baseline; padding-left: 20px; }
   </style>
   '; ?>

  <div style="border: 1px dashed #969696; padding: 4px">
  <b>Изменение ссылки: </b> <a class="llw" href="http://<?php echo $this->_tpl_vars['adm_object']->GetResult('modifyinfo.lurl'); ?>
" target="_blank" style="background: transparent url(http://favicon.yandex.net/favicon/<?php echo $this->_tpl_vars['adm_object']->GetResult('modifyinfo.lhost'); ?>
) no-repeat left top"><?php echo $this->_tpl_vars['adm_object']->GetResult('modifyinfo.ltext'); ?>
</a> 
  </div>
  <div style="margin-top: 8px">&nbsp;</div>
  <?php endif; ?>

  <div class="typelabel"><label id="red">*</label> URL ссыли (до 120 символов)</div>
      <div class="typelabel">
       <input type="text" class="inpt" style="width: 300px" name="url" id="url" maxlength="120" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('url','actionthissectionpost'); ?>
" onclick="RestInp(this)" onblur="RestInp(this)">
      </div>
      
      <div class="typelabel"><label id="red">*</label> Текст ссыли (до 80 символов)</div>
      <div class="typelabel">
       <input type="text" class="inpt" style="width: 300px" name="urltext" id="urltext" maxlength="80" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('urltext','actionthissectionpost'); ?>
" onclick="RestInp(this)" onblur="RestInp(this)">
      </div>
      
      <div class="typelabel">
       <input type="radio"<?php if ($_POST['actionthissectionpost'] != 'do' || $_POST['ptype'] == '1'): ?> checked="checked"<?php endif; ?> style="cursor: pointer" name="selecttype" id="setdeflink" onclick="SetTyped(1)"><label for="setdeflink" style="cursor: pointer">&nbsp;Стандартная ссылка</label>
      </div>
      
       <div class="typelabel">
       <input type="radio"<?php if ($_POST['actionthissectionpost'] == 'do' && $_POST['ptype'] == '2'): ?> checked="checked"<?php endif; ?> style="cursor: pointer" name="selecttype" id="setboldlink" onclick="SetTyped(2)"><label for="setboldlink" style="cursor: pointer">&nbsp;Жирная ссылка (<b>bold</b>)</label>
      </div>
      
       <div class="typelabel">
       <input type="radio"<?php if ($_POST['actionthissectionpost'] == 'do' && $_POST['ptype'] == '3'): ?> checked="checked"<?php endif; ?> style="cursor: pointer" name="selecttype" id="setdefindex" onclick="SetTyped(3)"><label for="setdefindex" style="cursor: pointer">&nbsp;Стандартная ссылка (индексируемая) (без тэга &lt;noindex&gt;)</label>
      </div>
      
       <div class="typelabel">
       <input type="radio"<?php if ($_POST['actionthissectionpost'] == 'do' && $_POST['ptype'] == '4'): ?> checked="checked"<?php endif; ?> style="cursor: pointer" name="selecttype" id="setboldindex" onclick="SetTyped(4)"><label for="setboldindex" style="cursor: pointer">&nbsp;Жирная ссылка (индексируемая) (<b>bold</b> + без тэга &lt;noindex&gt;)</label>
      </div>
   
 <div class="typelabel" style="margin-top: 15px">
  <input type="submit" value="&nbsp;<?php if (! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>Добавить ссылку<?php else: ?>Сохранить изменения<?php endif; ?>&nbsp;" class="button" name="rb" id="rb">
 </div>
  
 <input type="hidden" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('ptype','actionthissectionpost'); ?>
" name="ptype" id="ptype"> 
 <input type="hidden" value="do" name="actionthissectionpost">
 </form>
 <?php if ($_POST['actionthissectionpost'] == 'do' && ! $_POST['actionthissectionpost_q']): ?>
 <div style="margin-top: 10px">
  <?php if ($this->_tpl_vars['adm_object']->error): ?>
   <label style="color: #FF0000"><?php echo $this->_tpl_vars['adm_object']->error; ?>
</label>
  <?php else: ?>
   <label style="color: #008000">Ссылка успешно <?php if (! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>добавлена<?php else: ?>изменена<?php endif; ?>!</label>
  <?php endif; ?>
 </div>
 <?php endif; ?>
<?php endif; ?>
</div>
</div>