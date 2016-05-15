<?php /* Smarty version 2.6.26, created on 2013-11-14 13:46:20
         compiled from adm_account/adm_admnewsitems.tpl */ ?>
<div style="margin-top: 4px">



<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
 <td valign="top" align="left">
 <div>
 <div>Версия языка сайта</div>
 <div style="margin-top: 4px">
  <select size="1" name="sitelanguage" id="sitelanguage" onchange="NavigateLangType(this)">
   <?php $_from = $this->_tpl_vars['adm_object']->GetResult('language'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
   <option<?php if ($this->_tpl_vars['adm_object']->GetLang() == $this->_tpl_vars['val']['id']): ?> selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['val']['id']; ?>
"><?php echo $this->_tpl_vars['val']['name']; ?>
 (<?php echo $this->_tpl_vars['val']['count']; ?>
)</option>
   <?php endforeach; endif; unset($_from); ?>
  </select>  
 </div>
 </div>
 </td>
 <td valign="top" align="right">
 <div>
 <div>Раздел новостей\статей</div>
 <div style="margin-top: 4px">
  <?php $this->assign('listnewssections', $this->_tpl_vars['CONTROL_OBJ']->GetNewsSectionListElements($this->_tpl_vars['adm_object']->GetLang())); ?>
  <select size="1" name="ntype" id="ntype" onchange="NavigateSectionType(this)"<?php if (! $this->_tpl_vars['listnewssections']): ?> style="color: #808080; font-style: italic;"<?php endif; ?>>
   <?php if (! $this->_tpl_vars['listnewssections']): ?>
    <option value="">Нет активных разделов</option>
   <?php else: ?>
   <option value="0" style="color: #333399">Все разделы (<?php echo $this->_tpl_vars['adm_object']->GetSpecialNewsCount(0); ?>
)</option>  
   <?php $_from = $this->_tpl_vars['listnewssections']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
   <option<?php if ($_GET['ntype'] == $this->_tpl_vars['val']['data']['iditem']): ?> selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['val']['data']['iditem']; ?>
"><?php echo $this->_tpl_vars['val']['data']['sname']; ?>
 (<?php echo $this->_tpl_vars['adm_object']->GetSpecialNewsCount($this->_tpl_vars['val']['data']['iditem']); ?>
)</option>
   <?php endforeach; endif; unset($_from); ?>
   <?php endif; ?>
  </select>  
 </div>
 <div style="margin-top: 4px">
 <a href="<?php echo @W_SITEPATH; ?>
account/admnewsitems/&ntype=<?php echo $_GET['ntype']; ?>
<?php if ($_GET['oldpage']): ?>&page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?>&lang=<?php echo $this->_tpl_vars['adm_object']->GetLang(); ?>
&assection=1">Управление разделами<?php if (! $_GET['assection']): ?> (<label style="color: #000000"><?php echo $this->_tpl_vars['adm_object']->GetResult('rcount'); ?>
</label>)<?php endif; ?></a>
 </div>
 </div>
 </td>
</tr>
</table>

<div style="margin-top: 4px; border-bottom: 1px solid #969696">&nbsp;</div>
<?php echo '
<script type="text/javascript">
 function NavigateLangType(th) {
  var path = '; ?>
'<?php echo @W_SITEPATH; ?>
account/admnewsitems/&ntype=0<?php if ($_GET['oldpage']): ?>&oldpage=<?php echo $_GET['oldpage']; ?>
<?php endif; ?><?php if ($_GET['page']): ?>&page=<?php echo $_GET['page']; ?>
<?php endif; ?><?php if ($_GET['new']): ?>&new=1<?php endif; ?>';<?php echo '
  document.location = path + \'&lang=\' + th.value;  	
 }//NavigateLangType
 
 function NavigateSectionType(th) {
  if (th.value == \'\') { return false; }	
  var path = '; ?>
'<?php echo @W_SITEPATH; ?>
account/admnewsitems/<?php if ($_GET['oldpage']): ?>&oldpage=<?php echo $_GET['oldpage']; ?>
<?php endif; ?><?php if ($_GET['page']): ?>&page=<?php echo $_GET['page']; ?>
<?php endif; ?><?php if ($_GET['new']): ?>&new=1<?php endif; ?><?php if ($_GET['lang']): ?>&lang=<?php echo $_GET['lang']; ?>
<?php endif; ?>';<?php echo '
  document.location = path + \'&ntype=\' + th.value;	
 }//NavigateSectionType	
 
 
</script>
'; ?>


<div style="margin-top: 7px">
<?php if ($_GET['ntype'] || $_GET['assection']): ?><a href="<?php echo @W_SITEPATH; ?>
account/admnewsitems/&ntype=<?php echo $_GET['ntype']; ?>
&new=1<?php if ($_GET['page']): ?>&oldpage=<?php echo $_GET['page']; ?>
<?php endif; ?>&lang=<?php echo $this->_tpl_vars['adm_object']->GetLang(); ?>
<?php if ($_GET['assection']): ?>&assection=1<?php endif; ?>"<?php if ($_GET['new'] && ! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?> style="color: #000000"<?php endif; ?>>Добавить <?php if ($_GET['assection']): ?>раздел<?php else: ?>новость\статью<?php endif; ?></a> | <?php endif; ?><a<?php if (! $_GET['new']): ?> style="color: #000000"<?php endif; ?> href="<?php echo @W_SITEPATH; ?>
account/admnewsitems/&ntype=<?php echo $_GET['ntype']; ?>
<?php if ($_GET['oldpage']): ?>&page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?>&lang=<?php echo $this->_tpl_vars['adm_object']->GetLang(); ?>
<?php if ($_GET['assection']): ?>&assection=1<?php endif; ?>"><?php if ($_GET['assection']): ?>Все разделы (<label style="color: #000000"><?php echo $this->_tpl_vars['adm_object']->GetResult('rcount'); ?>
</label>)<?php else: ?>Все новости (<label style="color: #000000"><?php echo $this->_tpl_vars['adm_object']->GetResult('count'); ?>
</label>)<?php endif; ?></a><?php if ($_GET['assection']): ?>   | <a href="<?php echo @W_SITEPATH; ?>
account/admnewsitems/&ntype=<?php echo $_GET['ntype']; ?>
<?php if ($_GET['oldpage']): ?>&page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?>&lang=<?php echo $this->_tpl_vars['adm_object']->GetLang(); ?>
"> << Вернуться к списку новостей (<label style="color: #000000"><?php echo $this->_tpl_vars['adm_object']->GetResult('count'); ?>
</label>)</a><?php endif; ?>
</div>

<div style="margin-top: 12px">
<?php if ($_GET['assection']): ?>
 
  <?php if ($_GET['new']): ?>
 
 <?php echo '
 <script type="text/javascript">         
    function PrepereSend(th) {
	 
	 if (!th.sname.value) {
	  alert(\'Укажите название раздела!\');
	  th.sname.focus();
	  return false;	
	 }
	 
	 if (!$(\'#w-perpagecount\').val()) {
	  alert(\'Укажите кол-во комментариев на 1 страницу в разделе!\');
	  $(\'#w-perpagecount\').focus();
	  return false;	
	 }
	 
	 if (!$(\'#w-pathobjects\').val()) {
	  alert(\'Укажите глобальный путь раздела!\');
	  $(\'#w-pathobjects\').focus();
	  return false;	
	 }
	 
	 if (!$(\'#w-newstitletospec\').val()) {
	  alert(\'Укажите глобальное название раздела!\');
	  $(\'#w-newstitletospec\').focus();
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
     document.getElementById(\'addnewssectionitem\').actionnewprvmail.value = (n) ? \'act\' : \'prev\';	
    }//SetActionIdent	
 </script>
 '; ?>
 
  
  <form method="post" name="addnewssectionitem" id="addnewssectionitem" onsubmit="return PrepereSend(this)">
   
   <?php if ($this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>
   <div style="margin-top: 15px; margin-bottom: 15px; background: #F0F0F0; padding: 3px"><b>Настройка раздела</b></div>   
   <?php endif; ?>   
    
   <div class="typelabel"><label id="red">*</label> Название раздела (до 120 символов)</div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 94%" name="sname" id="sname" maxlength="120" value="<?php echo $this->_tpl_vars['adm_object']->GetAsElementP('sname'); ?>
">
   </div>
   
   <div class="typelabel" style="margin-top: 12px; margin-bottom: 12px">
    <b>Параметры раздела</b>
   </div>
    
   <div class="typelabel">
    <input type="checkbox" <?php if ($this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('w-enabled') || $_POST['actionthissectnnews'] != 'do'): ?> checked="checked" <?php endif; ?>style="cursor: pointer" name="w-enabled" id="w-enabled"><label for="w-enabled" style="cursor: pointer">&nbsp;Разрешить комментирование новостей/статей</label>  
   </div>
  
   <div class="typelabel">
    <input type="checkbox" <?php if ($this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('w-withmodercomment') || $_POST['actionthissectnnews'] != 'do'): ?> checked="checked" <?php endif; ?>style="cursor: pointer" name="w-withmodercomment" id="w-withmodercomment"><label for="w-withmodercomment" style="cursor: pointer">&nbsp;При добавлении комментария отправлять его на проверку администратору</label>  
   </div>
   
   <div class="typelabel">
    <input type="checkbox" <?php if ($this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('w-withcaptcha') || $_POST['actionthissectnnews'] != 'do'): ?> checked="checked" <?php endif; ?>style="cursor: pointer" name="w-withcaptcha" id="w-withcaptcha"><label for="w-withcaptcha" style="cursor: pointer">&nbsp;Использовать защиту каптчей для добавления комментариев</label>  
   </div>
   
   <div class="typelabel">
    <input type="checkbox" <?php if ($this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('w-showimages')): ?> checked="checked" <?php endif; ?>style="cursor: pointer" name="w-showimages" id="w-showimages"><label for="w-showimages" style="cursor: pointer">&nbsp;Отображать изображения предпросмотра в разделе</label>  
   </div>
   
   <div class="typelabel"><label id="red">*</label> Кол-во комментариев на 1 страницу</div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 250px" name="w-perpagecount" id="w-perpagecount" maxlength="3" value="<?php echo $this->_tpl_vars['adm_object']->GetAsElementP('w-perpagecount','actionthissectnnews','do','15'); ?>
">
   </div>
   
   <div class="typelabel"><label id="red">*</label> Глобальный путь раздела (используется как алиас для раздела /news/)<br />Используется для указания индивидуального пути раздела, пример:<br />
   http://project/<b>news</b>/2 - отмечен `жирным` идентификатор (максимально 120 символов)</div>
   <div class="typelabel">
    <input type="text" class="inpt" maxlength="120" style="width: 250px" name="w-pathobjects" id="w-pathobjects" value="<?php echo $this->_tpl_vars['adm_object']->GetAsElementP('w-pathobjects','actionthissectnnews','do','news'); ?>
">
   </div>
   
   <div class="typelabel"><label id="red">*</label> Использовать указанное название раздела (название указывает `глобальный` раздел и отображается по критерию:<br />
   Главная -> <b>название</b> -> дальнейший путь). Например: `Новости` или `Статьи`, (максимально 120 символов)</div>
   <div class="typelabel">
    <input type="text" class="inpt" maxlength="120" style="width: 250px" name="w-newstitletospec" id="w-newstitletospec" value="<?php echo $this->_tpl_vars['adm_object']->GetAsElementP('w-newstitletospec','actionthissectnnews'); ?>
">
   </div>
   
   <div class="typelabel">Использовать указанный текст в случае отсутствия списка новостей/статей в разделе. Например: `Нет новостей!` или `Нет ни одной добавленной статьи!` и т.д, (максимально 120 символов)</div>
   <div class="typelabel">
    <input type="text" class="inpt" maxlength="120" style="width: 250px" name="w-noelementstext" id="w-noelementstext" value="<?php echo $this->_tpl_vars['adm_object']->GetAsElementP('w-noelementstext','actionthissectnnews'); ?>
">
   </div>
   
   <?php if ($_POST['actionnewprvmail'] == 'prev'): ?>
   <div style="padding: 4px; border: 1px solid #666699; margin-bottom: 20px; margin-top: 10px; width: 94%;">
   <?php echo $this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextFromDB($this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextToDB($_POST['wsource'])); ?>
  
   </div>
   <?php endif; ?> 
   
   <div class="typelabel">Описание раздела</div>
   <div class="typelabel">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'new_message.tpl', 'smarty_include_vars' => array('ident' => 'wsource','source' => $_POST['wsource'],'height' => '90px','width' => '95%')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   </div>  
   
   <div class="typelabel" style="margin-top: 15px">
    <input type="hidden" value="do" name="actionthissectnnews">
   </div> 
   
   <input type="submit" value="&nbsp;<?php if (! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>Добавить раздел<?php else: ?>Изменить параметры раздела<?php endif; ?>&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp;
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
   <label style="color: #008000"><?php if (! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>Раздел успешно добавлен!<?php else: ?>Параметры раздела успешно изменены!<?php endif; ?></label>
  <?php endif; ?>
 </div>
 <?php endif; ?>
 
  <?php if ($this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>
  <div style="margin-top: 15px; margin-bottom: 15px; background: #F0F0F0; padding: 3px">
  <b>Изображение раздела (мини)</b>
  </div> 
  <?php if ($this->_tpl_vars['adm_object']->GetResult('modifyinfo.data.avatar')): ?>
   <div style="padding: 4px">
    <img src="<?php echo $this->_tpl_vars['adm_object']->GetResult('modifyinfo.data.avatar'); ?>
" border="0" alt="Image">
   </div>
  <?php endif; ?>  
  <form method="post" name="addnewnews4" id="addnewnews4" enctype="multipart/form-data" onsubmit="return PrepereSend4(this)"> 
   <div class="typelabel"> Изображение пред.просмотра (опционально) (форматы: <?php echo $this->_tpl_vars['adm_object']->GetListTypes(); ?>
<?php if ($this->_tpl_vars['adm_object']->GetResult('maxsize')): ?>, максимальный размер: <b><?php echo $this->_tpl_vars['adm_object']->GetResult('maxsize'); ?>
</b>)<?php endif; ?></div>
   <div style="font-size: 95%">Для удаления изображения - оставьте поле пустым.</div>
   <div class="typelabel">
    <input type="file" size="20" style="width: 95%; height: 22px" class="inpt" name="image" id="image">
   </div>
   <div class="typelabel" style="margin-top: 6px">
    <input type="submit" value="&nbsp;Сохранить изображение&nbsp;" class="button" name="rb" id="rb">
   </div> 
   <input type="hidden" value="do" name="actionthissectnnews4">
  </form> 
  
  <?php if ($_POST['actionthissectnnews4'] == 'do'): ?>
   <div style="margin-top: 10px">
   <?php if ($this->_tpl_vars['adm_object']->error): ?>
    <label style="color: #FF0000"><?php echo $this->_tpl_vars['adm_object']->error; ?>
</label>
   <?php else: ?>
    <label style="color: #008000">Изображение успешно изменено!</label>
   <?php endif; ?>
   </div>
  <?php endif; ?>
  
 <?php endif; ?> 
 
 <?php else: ?>
    <?php if (! $this->_tpl_vars['adm_object']->GetResult('data.source')): ?>
   <div style="text-align: center; padding: 6px; margin-top: 25px"><b>Нет активных разделов!</b></div>
  <?php else: ?>
   <?php echo '
    <script type="text/javascript">
	 function DeleteSelectedElementSection(ident) {
	  if (!confirm("Вы действительно хотите удалить выбранный раздел?\\r\\nНовости/статьи, расположенные в данном разделе не будут удалены - перейдут в `общий` раздел и перестанут отображаться в публичном разделе сайта!\\r\\nПродолжить?")) {
	   return false;	
	  }	
	  var ppf = '; ?>
'<?php echo @W_SITEPATH; ?>
account/admnewsitems/&ntype=<?php echo $_GET['ntype']; ?>
<?php if ($_GET['page']): ?>&page=<?php echo $_GET['page']; ?>
<?php endif; ?>&lang=<?php echo $this->_tpl_vars['adm_object']->GetLang(); ?>
&assection=1'<?php echo ';  
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
		 <img src="<?php echo $this->_tpl_vars['val']['avatar']; ?>
" border="0">
		</td>	
		
	    <td valign="top" align="left">
		 <div><?php echo $this->_tpl_vars['val']['sname']; ?>
<label style="margin-left: 6px; font-size: 95%; color: #333399"><i>(содержит: <?php echo $this->_tpl_vars['adm_object']->GetSpecialNewsCount($this->_tpl_vars['val']['iditem']); ?>
)</i></label></div>
		 <div style="margin-top: 4px; font-size: 95%; color: #808080">
		  <?php $this->assign('itemdescrit', $this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextFromDB($this->_tpl_vars['val']['sdescr'])); ?>
		  <?php if (! $this->_tpl_vars['itemdescrit']): ?>Нет описания<?php else: ?><?php echo $this->_tpl_vars['itemdescrit']; ?>
<?php endif; ?>
		 </div>
		</td>
		
	    <td valign="top" align="right">
		 <div style="white-space: nowrap;">		 
		 
		 <a href="<?php echo @W_SITEPATH; ?>
account/admnewsitems/&modify=<?php echo $this->_tpl_vars['val']['iditem']; ?>
&new=1&ntype=<?php echo $_GET['ntype']; ?>
<?php if ($_GET['page']): ?>&oldpage=<?php echo $_GET['page']; ?>
<?php endif; ?>&lang=<?php echo $this->_tpl_vars['adm_object']->GetLang(); ?>
&assection=1" title="Изменить"><img src="<?php echo @W_SITEPATH; ?>
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
 <?php endif; ?> 

<?php else: ?>

<?php if (! $_GET['new'] || ! $_GET['ntype']): ?>
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
   alert(\'Выделите хотя бы одну запись!\'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == \'delete\') {
   if (!confirm(\'Вы действительно хотите удалить [\'+count+\'] записей?\')) { return false; }
  } else 
  if (th.actionlistmakes.value == \'dall\') {
   if (!allsaveenabled) { alert(\'Нет данных для удаления!\'); return false; }	
   if (!confirm(\'Вы действительно хотите удалить все записи?\')) { return false; }	
  } else
  if (th.actionlistmakes.value == \'moveto\') {
   if (!confirm(\'Вы действительно хотите переместить [\'+count+\'] записей в раздел [\'+$(\'#ntypeMove option:selected\').text()+\']?\')) { return false; }
   	
  } else { alert(\'Неизвестный идентификатор операции!\'); return false; }
  return true;   	
 }//PrepereSend
 function SetEnabled() {  	
  var count = GetSelCount();
  setElementOpacity(document.getElementById(\'adid\'), (allsaveenabled) ? 1 : 0.3);
  if (count <= 0) {
   setElementOpacity(document.getElementById(\'did\'), 0.3);
   $(\'#ntypeMove\').attr(\'disabled\', \'disabled\');
   $(\'#ntypeMoveLabel\').css(\'color\', \'#C0C0C0\');
   return ;	 
  }
  setElementOpacity(document.getElementById(\'did\'), 1);
  $(\'#ntypeMove\').attr(\'disabled\', \'\');
  $(\'#ntypeMoveLabel\').css(\'color\', \'#000000\');
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
  <input type="submit" value="&nbsp;Удалить все новости&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 160px;">
 </span>
 
 <span style="margin-left: 8px">
  <?php echo '
  <script type="text/javascript">
   function ActionToMoveToItems(th) {
	if (th.value == \'\') { return false; }
	SetActionP(\'moveto\');
	$(\'#identtomoveelement\').val(th.value);
	$(\'#vnewsform\').submit();	
   }//ActionToMoveToItems	
  </script>
  '; ?>

  <i id="ntypeMoveLabel">Переместить в:</i> 
  <select size="1" name="ntypeMove" id="ntypeMove" style="border: none; margin-left: 6px" onchange="ActionToMoveToItems(this)">
  <option value="" selected="selected" style="color: #333399">Выбирите раздел</option>
  <?php $_from = $this->_tpl_vars['listnewssections']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?> 
   <option value="<?php echo $this->_tpl_vars['val']['data']['iditem']; ?>
"><?php echo $this->_tpl_vars['val']['data']['sname']; ?>
</option> 
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Новость</span></td>
	<?php if ($_GET['ntype']): ?><td class="h_td" valign="center" align="center" width="30px">Д-Я</td><?php endif; ?>
    <td class="h_td" valign="center" align="center" width="40px"><img title="Вложения (привязка файлов)" src="<?php echo @W_SITEPATH; ?>
img/ico/general/pages.png" alt="file" /></td>
	<td class="h_td" valign="center" align="center" width="110px">Просмотров</td>
	<td class="h_td" valign="center" align="center" width="110px">Комментариев</td>
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
	  <?php if ($this->_tpl_vars['val']['dwnameimg']): ?>
	   <a href="<?php echo @W_SITEPATH; ?>
pfiles/images/<?php echo $this->_tpl_vars['val']['dwnameimg']; ?>
" target="_blank"><img src="<?php echo @W_SITEPATH; ?>
pfiles/images/<?php echo $this->_tpl_vars['val']['dwnameimg']; ?>
" border="0" width="24" height="24" style="float: left; margin-right: 3px"></a>
	  <?php endif; ?>	  
	  <div><a style="text-decoration: none;" href="<?php echo @W_SITEPATH; ?>
news/<?php echo $this->_tpl_vars['val']['newtype']; ?>
/<?php echo $this->_tpl_vars['val']['iditem']; ?>
/" target="_blank"><?php echo $this->_tpl_vars['val']['newtitle']; ?>
</a></div>
	  <?php if (! $_GET['ntype'] && $this->_tpl_vars['adm_object']->GetSectionInfoData($this->_tpl_vars['val']['newtype'],'sname')): ?>
	  <div style="margin-top: 4px; color: #808080; font-style: italic; font-size: 95%">
	  (<?php echo $this->_tpl_vars['adm_object']->GetSectionInfoData($this->_tpl_vars['val']['newtype'],'sname'); ?>
)
	  </div>
	  <?php endif; ?>	  	 
	 </td> 
	 
	 <?php if ($_GET['ntype']): ?>
	 <td class="sth1" valign="center" align="center" onclick="SetCheckByLine('<?php echo ($this->_foreach['val']['iteration']-1); ?>
')" width="30px">
	  <label style="padding: 3px">
	   <a href="<?php echo @W_SITEPATH; ?>
account/admnewsitems/&modify=<?php echo $this->_tpl_vars['val']['iditem']; ?>
&new=1&ntype=<?php echo $_GET['ntype']; ?>
<?php if ($_GET['page']): ?>&oldpage=<?php echo $_GET['page']; ?>
<?php endif; ?>&lang=<?php echo $this->_tpl_vars['adm_object']->GetLang(); ?>
" title="Изменить"><img src="<?php echo @W_SITEPATH; ?>
img/items/document_edit.png" width="16" height="16"></a>
	  </label>	  	  	 
	 </td>
	 <?php endif; ?>
	 
     <td class="sth1" valign="center" align="center" onclick="SetCheckByLine('<?php echo ($this->_foreach['val']['iteration']-1); ?>
')" width="40px">
	 <a href="<?php echo @W_SITEPATH; ?>
account/admfilescontrol/?fid=1&pid=<?php echo $this->_tpl_vars['val']['iditem']; ?>
" target="_blank" title="Управление вложениями (привязка файлов)"><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetObjectFilesCount(1,$this->_tpl_vars['val']['iditem']); ?>
</a>	  	  	 
	 </td>
     
	 <td class="sth1" valign="center" align="center" onclick="SetCheckByLine('<?php echo ($this->_foreach['val']['iteration']-1); ?>
')" width="110px">
	  <?php echo $this->_tpl_vars['val']['newlooks']; ?>
	  	  	 
	 </td>
	 
	 <td class="sth1" valign="center" align="center" onclick="SetCheckByLine('<?php echo ($this->_foreach['val']['iteration']-1); ?>
')" width="110px">
	  <?php echo $this->_tpl_vars['adm_object']->GetCommentsCountForNews($this->_tpl_vars['val']); ?>
	  	  	 
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
    <td valign="center" align="center" class="btn_n" colspan="7">
     Нет новостей!
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
 <input type="hidden" value="" name="identtomoveelement" id="identtomoveelement">
 <input type="hidden" value="none" name="actionlistmakes"> 
</form>
<script type="text/javascript">SetEnabled();</script>
<?php else: ?>
  <?php echo '
 <script type="text/javascript">         
    function PrepereSent(th) {		 	
	 if (trim(th.title.value) == \'\') {
	  alert(\'Укажите название новости!\');
	  th.title.focus();
	  return false;	
	 }	
	 if (trim(th.source.value) == \'\') {
	  alert(\'Укажите текст новости!\');
	  th.source.focus();
	  return false;	
	 } 	 	 
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

 
 <?php if ($this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>
  <div style="border: 1px dashed #969696; padding: 4px; width: 94%">
  
  <div><b>Изменение новости: </b></div> 
  <?php if ($this->_tpl_vars['adm_object']->GetResult('modifyinfo.dwnameimg')): ?>
  <div>
   <img src="<?php echo @W_SITEPATH; ?>
pfiles/images/<?php echo $this->_tpl_vars['adm_object']->GetResult('modifyinfo.dwnameimg'); ?>
" border="0">
  </div>
  <?php endif; ?>
  <div style="margin-top: 4px">
   <a href="<?php echo @W_SITEPATH; ?>
news/<?php echo $_GET['ntype']; ?>
/<?php echo $this->_tpl_vars['adm_object']->GetResult('modifyinfo.iditem'); ?>
/" target="_blank"><?php echo $this->_tpl_vars['adm_object']->GetResult('modifyinfo.newtitle'); ?>
</a>
  </div>
  
  </div>
  <div style="margin-top: 8px">&nbsp;</div>
  <?php endif; ?>
 
 <div>
  <?php if ($_POST['actionnewprvmail'] == 'prev'): ?>
  <div style="padding: 4px; border: 1px solid #775D41; margin-bottom: 20px; width: 94%;">
   <?php echo $this->_tpl_vars['adm_object']->GetPrevSourceData('source'); ?>
  
  </div>
  <?php endif; ?> 
 </div>
 
 <script type="text/javascript" src="http://<?php echo @W_HOSTMYSITE; ?>
/js/tiny_mce/tiny_mce.js"></script>
 <?php echo '
 <script type="text/javascript">
   var lastformattedform = \'\';
   
   function SwithToHtmlEditorOrFormatterBlock(html_checker_id, ident) {
    //sourcearticledata
    var ch = ($(\'#\'+html_checker_id).attr(\'checked\')) ? true : false;
    
    if (!ch && lastformattedform == \'\') { return false; }
    
    if (ch) {
        
     //save current formatted data   
     if (lastformattedform == \'\') {
      lastformattedform = $(\'#sourcearticledata\').html();       
     }  
     
     //init data object
      
      var style = $(\'#\'+ident).attr(\'style\');
      var source = $(\'#\'+ident).val();  
          
      $(\'#sourcearticledata\').html(\'<textarea class="inp_new_text" style="\'+style+\'" name="\'+ident+\'" id="\'+ident+\'">\'+source+\'</textarea>\');
      
      tinyMCE.init({
	 	language : "'; ?>
<?php echo $this->_tpl_vars['CONTROL_OBJ']->strtolower($this->_tpl_vars['CONTROL_OBJ']->GetActiveLanguage()); ?>
<?php echo '",
	 	mode : "exact",
	 	elements : ident,
	 	theme : "advanced",
	 	plugins : "safari,spellchecker,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,pagebreak",
	 	theme_advanced_buttons1_add_before : "save,newdocument,separator",
	 	theme_advanced_buttons1_add : "fontselect,fontsizeselect",
	 	theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,separator,forecolor,backcolor",
	 	theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
	 	theme_advanced_buttons3_add_before : "tablecontrols,separator",
	 	theme_advanced_buttons3_add : "emotions,iespell,media,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
	 	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,spellchecker,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
	 	theme_advanced_toolbar_location : "top",
	 	theme_advanced_toolbar_align : "left",
	 	theme_advanced_statusbar_location : "bottom",
	 	plugin_insertdate_dateFormat : "%Y-%m-%d",
	 	plugin_insertdate_timeFormat : "%H:%M:%S",
	 	theme_advanced_resize_horizontal : true,
	 	theme_advanced_resizing : true,
	 	apply_source_formatting : false,
	 	valid_elements : "*[*]", 
	 	remove_linebreaks : false,
	 	forced_root_block : \'\',
	 	spellchecker_languages : "+English=en,Danish=da,Dutch=nl,Finnish=fi,French=fr,German=de,Italian=it,Polish=pl,Portuguese=pt,Spanish=es,Swedish=sv"
	  });       
     
     return true;        
    }
    
    if (lastformattedform == \'\') {
     
     lastformattedform = \'<textarea class="inp_new_text" style="\'+style+\'" name="\'+ident+\'" id="\'+ident+\'">\'+source+\'</textarea>\';
     $(\'#sourcearticledata\').html(lastformattedform);   
        
    } else {
            
     $(\'#sourcearticledata\').html(lastformattedform);
     
    }    
    
   }//SwithToHtmlEditorOrFormatterBlock	
   
   $(document).ready(function() {  
    var htmluse = '; ?>
<?php if ($this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('contenttype')): ?>true<?php else: ?>false<?php endif; ?><?php echo ';
    if (htmluse) {
     
     SwithToHtmlEditorOrFormatterBlock(\'contenttype\', \'source\');   
        
    }     
   }); 
 </script>
 '; ?>

 
 
 <form method="post" name="addnewnews" id="addnewnews" enctype="multipart/form-data" onsubmit="return PrepereSent(this)">

      <div class="typelabel"><label id="red">*</label> Название новости\статьи\записи (до 200 символов)</div>
      <div class="typelabel">
       <input type="text" class="inpt" style="width: 94%" name="title" id="title" maxlength="120" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('title','actionthissectionpost'); ?>
">
      </div>
      
      <div class="typelabel">Ключевые слова (тэг keywords) (до 250 символов), пусто - используются ключевые слова по умолчанию</div>
      <div class="typelabel">     
       <textarea class="int_text" style="height: 50px; width: 95%" name="keywordsnews" id="keywordsnews"><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('keywordsnews','actionthissectionpost'); ?>
</textarea>
      </div>
      
      <div class="typelabel">Тэг description (до 250 символов), пусто - используется описание по умолчанию</div>
      <div class="typelabel">     
       <textarea class="int_text" style="height: 50px; width: 95%" name="tdescription" id="tdescription"><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('tdescription','actionthissectionpost'); ?>
</textarea>
      </div>
      
      <div class="typelabel"><label id="red">*</label> Текст новости\статьи\записи</div>
      <div class="typelabel" id="sourcearticledata">
       <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'new_message.tpl', 'smarty_include_vars' => array('ident' => 'source','source' => $this->_tpl_vars['adm_object']->GetNormalDescriptionSource('source'),'height' => '220px','width' => '95%')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      </div>     
      
      <div class="typelabel">
       <input type="checkbox" <?php if ($this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('contenttype')): ?> checked="checked" <?php endif; ?>style="cursor: pointer" name="contenttype" id="contenttype" onclick="SwithToHtmlEditorOrFormatterBlock('contenttype', 'source')"><label for="contenttype" style="cursor: pointer">&nbsp;Содержимое статьи на чистом HTML</label>
      </div>
      <div style="color: #808080; font-size: 95%; margin-bottom: 14px">
      (если флажок установлен - тэги форматирования не будут учитываться - весь указанный контент будет считаться чистым html кодом!!)
      </div>  
      
      <div class="typelabel"> Изображение пред.просмотра (опционально) (форматы: <?php echo $this->_tpl_vars['adm_object']->GetListTypes(); ?>
<?php if ($this->_tpl_vars['adm_object']->GetResult('maxsize')): ?>, максимальный размер: <b><?php echo $this->_tpl_vars['adm_object']->GetResult('maxsize'); ?>
</b>)<?php endif; ?></div>
      <div style="font-size: 95%">Для удаления изображения, или создания новости без изображения - оставьте поле пустым.</div>
      <div class="typelabel">
       <input type="file" size="20" style="width: 95%; height: 22px" class="inpt" name="image" id="image">
      </div>    
      
 
 <div class="typelabel" style="margin-top: 15px">
  <input type="submit" value="&nbsp;<?php if (! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>Добавить новость<?php else: ?>Сохранить изменения<?php endif; ?>&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp;
  <input type="submit" value="&nbsp;Предварительный просмотр&nbsp;" class="button" name="rbp" id="rbp" onclick="SetActionIdent(0)">
 </div>
 <input type="hidden" value="prev" name="actionnewprvmail"> 
 <input type="hidden" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('ptype','actionthissectionpost'); ?>
" name="ptype" id="ptype"> 
 <input type="hidden" value="do" name="actionthissectionpost">
 </form>
 
 <?php if ($_POST['actionthissectionpost'] == 'do' && ! $_POST['actionthissectionpost_q'] && $_POST['actionnewprvmail'] != 'prev'): ?>
 <div style="margin-top: 10px">
  <?php if ($this->_tpl_vars['adm_object']->error): ?>
   <label style="color: #FF0000"><?php echo $this->_tpl_vars['adm_object']->error; ?>
</label>
  <?php else: ?>
   <label style="color: #008000">Новость успешно <?php if (! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>добавлена<?php else: ?>изменена<?php endif; ?>!</label>
  <?php endif; ?>
 </div>
 <?php endif; ?>
<?php endif; ?>
<?php endif; ?> </div>
</div>