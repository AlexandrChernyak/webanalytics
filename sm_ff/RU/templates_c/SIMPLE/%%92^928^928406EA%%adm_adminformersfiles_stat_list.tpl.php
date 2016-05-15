<?php /* Smarty version 2.6.26, created on 2013-11-14 13:13:50
         compiled from adm_account/adminformersfiles/adm_adminformersfiles_stat_list.tpl */ ?>
<div style="margin-top: 4px">
<div>

<div><a href="<?php echo @W_SITEPATH; ?>
account/adminformersfiles/&inftype=<?php if ($_GET['inftype']): ?><?php echo $_GET['inftype']; ?>
<?php else: ?>1<?php endif; ?>&sections=<?php if ($_GET['sections']): ?><?php echo $_GET['sections']; ?>
<?php else: ?>0<?php endif; ?><?php if ($_GET['oldpage']): ?>&page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?>">Список информеров</a> :: <b>история использования информера</b></div>

<div style="margin-top: 7px"><img src="<?php echo @W_SITEPATH; ?>
account/adminformersfiles/&getimage=<?php echo $_GET['statisticinfo']; ?>
" style="margin-right: 6px; position: relative;"></div>

<div style="margin-top: 5px">Использует человек: <b><?php echo $this->_tpl_vars['adm_object']->GetResult('count'); ?>
</b></div>
<div style="margin-top: 4px">Всего запросов: <b><?php if ($this->_tpl_vars['adm_object']->GetResult('info.allrequist')): ?><?php echo $this->_tpl_vars['adm_object']->GetResult('info.allrequist'); ?>
<?php else: ?>0<?php endif; ?></b></div>
<div style="margin-top: 4px">Дата последнего запроса:  <b><?php if ($this->_tpl_vars['adm_object']->GetResult('info.lastquery')): ?><?php echo $this->_tpl_vars['adm_object']->GetResult('info.lastquery'); ?>
<?php else: ?>?<?php endif; ?></b><?php if ($this->_tpl_vars['adm_object']->GetResult('info.lastquerystr')): ?><label style="margin-left: 6px; font-size: 95%">[ <?php echo $this->_tpl_vars['adm_object']->GetResult('info.lastquerystr'); ?>
 ]</label><?php endif; ?></div>

</div>
<div style="margin-top: 12px">
<?php echo '
<script type="text/javascript">
 function PrepereSend(th) {
  var count = GetSelCount();
  if (count <= 0 && th.actionlistinvitecode.value != \'dall\') { 
   alert(\'Выделите хотя бы одну запись!\'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistinvitecode.value == \'delete\') {
   if (!confirm(\'Вы действительно хотите удалить [\'+count+\'] записей? Все, кто использует данные записи информера потеряют информер у себя на сайте!.. Продолжить?\')) { return false; }
  } else if (th.actionlistinvitecode.value == \'dall\') {
   if (!allsaveenabled) { alert(\'Нет данных для удаления!\'); return false; }	
   if (!confirm(\'Вы действительно хотите удалить все записи? Все, кто использует данные записи информера потеряют информер у себя на сайте! Продолжить?\')){
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
  <input type="submit" value="&nbsp;Удалить все записи&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 150px;">
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Параметр</span></td>	
	<td class="h_td" valign="center" align="center" width="130px">Дата регистр</td>
	<td class="h_td" valign="center" align="center" width="130px">Послед.обновл.</td>
	<td class="h_td" valign="center" align="center" width="130px">Послед.запрос.</td>
	<td class="h_td" valign="center" align="center" width="50px">Файл</td>	
	<td class="h_td2" valign="center" align="center" width="80px">Запросов</td>
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
	  <span style="padding: 3px">
	  <?php if ($this->_tpl_vars['val']['informtype'] == 3): ?><a href="http://<?php echo $this->_tpl_vars['val']['identuse']; ?>
" target="_blank"><?php echo $this->_tpl_vars['val']['identuse']; ?>
</a><?php else: ?><?php echo $this->_tpl_vars['val']['identuse']; ?>
<?php endif; ?> 
	  
	  <?php if ($this->_tpl_vars['adm_object']->GetColorInformer($this->_tpl_vars['val'])): ?>
	  <span style="display: inline-block; width: 12px; background: <?php echo $this->_tpl_vars['adm_object']->GetColorInformer($this->_tpl_vars['val']); ?>
" title="Цвет информера, выбранный посетителем">
	  &nbsp;
	  </span>
	  <?php endif; ?>
	  
	  <?php if ($this->_tpl_vars['val']['informlink']): ?>
	  <div style="margin-top: 8px; margin-left: 3px; margin-bottom: 4px; font-size: 95%">Зафиксирован на: 
	  <a href="<?php echo $this->_tpl_vars['val']['informlink']; ?>
" target="_blank"><?php echo $this->_tpl_vars['val']['informlink']; ?>
</a></div>
	  <?php endif; ?>	  
	  </span>	 
	 </td>
	 
	 <td class="sth1" valign="center" align="center" width="130px" style="padding-left: 4px" 
	 onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()"> 
	  <div style="margin-top: 4px"><?php echo $this->_tpl_vars['val']['datestart']; ?>
</div>
	  <div style="margin-top: 2px; margin-bottom: 4px; font-size: 95%">[ <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['val']['datestart'],$this->_tpl_vars['CONTROL_OBJ']->GetThisDateTime()); ?>
 ]</div>
	  <div style="margin-top: 2px; margin-bottom: 4px; font-size: 95%">&nbsp;</div>	  
	 </td>
	 
	 <td class="sth1" valign="center" align="center" width="130px" style="padding-left: 4px" 
	 onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()"> 
	  <div style="margin-top: 4px"><?php echo $this->_tpl_vars['val']['dataupdate']; ?>
</div>
	  <div style="margin-top: 2px; margin-bottom: 4px; font-size: 95%">[ <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['val']['dataupdate'],$this->_tpl_vars['CONTROL_OBJ']->GetThisDateTime()); ?>
 ]</div>
	  <?php echo $this->_tpl_vars['adm_object']->GetLastMinuteInfo($this->_tpl_vars['val']['dataupdate'],$_GET['inftype'],'updateeveryminute','<div style="margin-top: 2px; margin-bottom: 4px; font-size: 95%; color: #0000FF">- ',' min</div>'); ?>

	 </td>
	 
	 <td class="sth1" valign="center" align="center" width="130px" style="padding-left: 4px" 
	 onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()"> 
	  <div style="margin-top: 4px"><?php echo $this->_tpl_vars['val']['datelast']; ?>
</div>
	  <div style="margin-top: 2px; margin-bottom: 4px; font-size: 95%">[ <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['val']['datelast'],$this->_tpl_vars['CONTROL_OBJ']->GetThisDateTime()); ?>
 ]</div>
	  <?php echo $this->_tpl_vars['adm_object']->GetLastMinuteInfo($this->_tpl_vars['val']['datelast'],$_GET['inftype'],'deleteoldaccminf','<div style="margin-top: 2px; margin-bottom: 4px; font-size: 95%; color: #0000FF">- ',' min</div>'); ?>

	 </td>
	 
	 <td class="sth1" valign="center" align="center" width="50px" style="padding-left: 4px" 
	 onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()"> 	  
	  <a title="Просмотр временного изображения (откроется в новом окне)" href="<?php echo @W_SITEPATH; ?>
pfiles/generalinformers/temp/<?php echo $this->_tpl_vars['val']['imagefile']; ?>
" target="_blank"><img src="<?php echo @W_SITEPATH; ?>
img/items/target_link.png"></a>  
	 </td>

	 <td class="sth1" valign="center" align="center" width="80px" style="border-right: 1px solid #E3E4E8;" 
	 onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()">
	  <?php echo $this->_tpl_vars['val']['regcount']; ?>
	 	 	 
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
     Нет активных пользователей информера!
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

</div>
</div>