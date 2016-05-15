<?php /* Smarty version 2.6.26, created on 2013-11-12 22:25:46
         compiled from adm_account/adm_adminformersfiles.tpl */ ?>
<div style="margin-top: 4px">
<div>
 <div>Тип изображений информеров</div>
 <div style="margin-top: 4px">
  <select size="1" name="informtype" id="informtype" onchange="NavigateInformType(this)">
   <option<?php if ($_GET['inftype'] == '1'): ?> selected="selected"<?php endif; ?> value="1">Информеры скорости интернета</option>
   <option<?php if ($_GET['inftype'] == '2'): ?> selected="selected"<?php endif; ?> value="2">Информеры IP адреса</option>
   <option<?php if ($_GET['inftype'] == '3'): ?> selected="selected"<?php endif; ?> value="3">Информеры ТиЦ PR</option>
   <option<?php if ($_GET['inftype'] == '4'): ?> selected="selected"<?php endif; ?> value="4">Информеры Апдейтов</option>
  </select>  
 </div>
</div>
<div style="margin-top: 4px; border-bottom: 1px solid #969696">&nbsp;</div>

<?php echo '
<script type="text/javascript">
var list_items = new Array(); 
 var allsaveenabled = '; ?>
<?php echo $this->_tpl_vars['adm_object']->GetResult('count'); ?>
;<?php echo '
 var globalsectionpath = '; ?>
'<?php echo @W_SITEPATH; ?>
';<?php echo '
 var globaladdident = '; ?>
'<?php echo $_GET['new']; ?>
';<?php echo '
 
 function NavigateInformType(th) {
  var path = globalsectionpath + \'account/adminformersfiles/\';
  if (globaladdident) { path = path + \'&new=\' + globaladdident; }
  path = path + \'&inftype=\' + th.value + 
  \'&sections='; ?>
<?php if ($_GET['sections']): ?><?php echo $_GET['sections']; ?>
<?php else: ?>0<?php endif; ?><?php echo '\' + 
  \''; ?>
<?php if ($_GET['sectionslist']): ?>&sectionslist=1<?php endif; ?><?php echo '\';
  document.location = path;  	
 }//NavigateInformType 
 
 function NavigateSectionType(th) {
  var path = globalsectionpath + \'account/adminformersfiles/\';
  if (globaladdident) { path = path + \'&new=\' + globaladdident; }
  path = path + \'&inftype='; ?>
<?php if ($_GET['inftype']): ?><?php echo $_GET['inftype']; ?>
<?php else: ?>1<?php endif; ?><?php echo '\' + 
  \'&sections=\' + th.value;
  document.location = path;  	
 }//NavigateInformType 
  
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
</script>
'; ?>


<?php if (! $_GET['sectionslist'] && ! $_GET['statisticinfo']): ?>

<div style="margin-top: 6px">
 <div>Раздел информеров</div>
 <div style="margin-top: 4px">
  <select size="1" name="sectionp" id="sectionp" onchange="NavigateSectionType(this)">
   <option<?php if (! $_GET['sections']): ?> selected="selected"<?php endif; ?> value="0">Все разделы</option>
   <?php if ($this->_tpl_vars['adm_object']->GetResult('sections')): ?>
    <?php $_from = $this->_tpl_vars['adm_object']->GetResult('sections'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
    <option<?php if ($_GET['sections'] == $this->_tpl_vars['val']['iditem']): ?> selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['val']['iditem']; ?>
"><?php echo $this->_tpl_vars['val']['secname']; ?>
  (<?php echo $this->_tpl_vars['adm_object']->GetInformersCountInSection($this->_tpl_vars['val']['iditem']); ?>
)</option>
    <?php endforeach; endif; unset($_from); ?>
   <?php endif; ?> 
  </select>
  <label style="margin-left: 6px">
   <a href="<?php echo @W_SITEPATH; ?>
account/adminformersfiles/&sectionslist=1&inftype=<?php if ($_GET['inftype']): ?><?php echo $_GET['inftype']; ?>
<?php else: ?>1<?php endif; ?><?php if ($_GET['page']): ?>&oldpage=<?php echo $_GET['page']; ?>
<?php endif; ?>&sections=<?php if ($_GET['sections']): ?><?php echo $_GET['sections']; ?>
<?php else: ?>0<?php endif; ?>">Управление списком разделов</a>
  </label> 
 </div>
</div>


<div style="margin-top: 22px">
<a href="<?php echo @W_SITEPATH; ?>
account/adminformersfiles&new=1<?php if ($_GET['inftype']): ?>&inftype=<?php echo $_GET['inftype']; ?>
<?php endif; ?>&sections=<?php if ($_GET['sections']): ?><?php echo $_GET['sections']; ?>
<?php else: ?>0<?php endif; ?>"<?php if ($_GET['new']): ?> style="color: #000000"<?php endif; ?>>Добавить изображение (информер)</a> | <a href="<?php echo @W_SITEPATH; ?>
account/adminformersfiles/<?php if ($_GET['inftype']): ?>&inftype=<?php echo $_GET['inftype']; ?>
<?php endif; ?>&sections=<?php if ($_GET['sections']): ?><?php echo $_GET['sections']; ?>
<?php else: ?>0<?php endif; ?>"<?php if (! $_GET['new']): ?> style="color: #000000"<?php endif; ?>>Список изображений (<label style="color: #000000"><?php echo $this->_tpl_vars['adm_object']->GetResult('count'); ?>
</label>)</a>
</div>
<div style="margin-top: 12px">
<?php echo '
<script type="text/javascript"> 
 function PrepereSend(th) {
  var count = GetSelCount();
  if (count <= 0 && th.actionlistmakes.value != \'all\' && th.actionlistmakes.value != \'dall\') { 
   alert(\'Выделите хотя бы один файл изображения!\'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == \'delete\') {
   if (!confirm(\'Вы действительно хотите удалить [\'+count+\'] изображений?\')) { return false; }
  } else 
  if (th.actionlistmakes.value == \'enabled\') {
   if (!confirm(\'Вы действительно хотите активировать [\'+count+\'] изображений?\')) { return false; }
  } else
  if (th.actionlistmakes.value == \'disabled\') {
   if (!confirm(\'Вы действительно хотите деактивировать [\'+count+\'] изображений?\')) { return false; }
  } else
   if (th.actionlistmakes.value == \'dall\') {
    if (!allsaveenabled) { alert(\'Нет данных для удаления!\'); return false; }	
    if (!confirm(\'Вы действительно хотите удалить все изображения?\')) { return false; }	
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
  var f = document.getElementById(\'listform\');
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
 
<?php if (! $_GET['new'] && ! $_GET['modifyimage']): ?>
<form method="post" name="listform" id="listform" onsubmit="return PrepereSend(this)">
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Изображение</span></td>	
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
	 
	 <td class="sth1" valign="top" align="left" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()">
	  <div style="margin-top: 5px; margin-left: 3px; margin-right: 3px">
	   <div>	   
	   <a href="<?php echo @W_SITEPATH; ?>
pfiles/generalinformers/<?php echo $this->_tpl_vars['val']['dwname']; ?>
" target="_blank"><img src="<?php echo @W_SITEPATH; ?>
account/adminformersfiles/&getimage=<?php echo $this->_tpl_vars['val']['iditem']; ?>
" style="margin-right: 6px; position: relative;"></a>
	   </div>
	   <div style="margin-top: 4px"><i><?php echo $this->_tpl_vars['val']['imagename']; ?>
</i></div>
	   <!-- info -->
	   <div style="margin-top: 12px">Статистика информера:<label style="margin-left: 7px; font-size: 95%"><a href="<?php echo @W_SITEPATH; ?>
account/adminformersfiles/<?php if ($_GET['inftype']): ?>&inftype=<?php echo $_GET['inftype']; ?>
<?php endif; ?>&statisticinfo=<?php echo $this->_tpl_vars['val']['iditem']; ?>
&sections=<?php if ($_GET['sections']): ?><?php echo $_GET['sections']; ?>
<?php else: ?>0<?php endif; ?><?php if ($_GET['page']): ?>&oldpage=<?php echo $_GET['page']; ?>
<?php endif; ?>">Обзор</a></label></div>
	   <div style="margin-top: 4px">
	    Использует человек всего:  <b><?php if ($this->_tpl_vars['adm_object']->GetInformerInfo($this->_tpl_vars['val'],'peoplesuse')): ?><?php echo $this->_tpl_vars['adm_object']->GetInformerInfo($this->_tpl_vars['val'],'peoplesuse'); ?>
<?php else: ?>0<?php endif; ?></b> 
	   </div>
	   <?php if ($this->_tpl_vars['adm_object']->GetInformerInfo($this->_tpl_vars['val'],'peoplesuse')): ?>
	    <div style="margin-top: 4px">
	     Всего запросов к информеру:  <b><?php if ($this->_tpl_vars['adm_object']->GetInformerInfo($this->_tpl_vars['val'],'allrequist')): ?><?php echo $this->_tpl_vars['adm_object']->GetInformerInfo($this->_tpl_vars['val'],'allrequist'); ?>
<?php else: ?>0<?php endif; ?></b> 
	    </div>
	    <div style="margin-top: 4px">
	     Дата последнего запроса:  <b><?php if ($this->_tpl_vars['adm_object']->GetInformerInfo($this->_tpl_vars['val'],'lastquery')): ?><?php echo $this->_tpl_vars['adm_object']->GetInformerInfo($this->_tpl_vars['val'],'lastquery'); ?>
<?php else: ?>?<?php endif; ?></b><?php if ($this->_tpl_vars['adm_object']->GetInformerInfo($this->_tpl_vars['val'],'lastquerystr')): ?><label style="margin-left: 6px; font-size: 95%">[ <?php echo $this->_tpl_vars['adm_object']->GetInformerInfo($this->_tpl_vars['val'],'lastquerystr'); ?>
 ]</label><?php endif; ?> 
	    </div>
	   <?php endif; ?>

	   <!-- options -->	   
	   <div style="margin-top: 14px">Надстройки информера:<label style="margin-left: 7px; font-size: 95%"><a href="<?php echo @W_SITEPATH; ?>
account/adminformersfiles/<?php if ($_GET['inftype']): ?>&inftype=<?php echo $_GET['inftype']; ?>
<?php endif; ?>&modifyimage=<?php echo $this->_tpl_vars['val']['iditem']; ?>
&sections=<?php if ($_GET['sections']): ?><?php echo $_GET['sections']; ?>
<?php else: ?>0<?php endif; ?>">Изменить</a></label></div>
	   <div style="margin-top: 4px">
	    <textarea readonly="readonly" style="background: transparent;<?php if (! $this->_tpl_vars['val']['options']): ?>color:#FF0000;<?php endif; ?> border: none; width: 98%; height: 55px; padding-left: 6px"><?php if (! $this->_tpl_vars['val']['options']): ?>(нет надстроек)<?php else: ?><?php echo $this->_tpl_vars['val']['options']; ?>
<?php endif; ?></textarea>
	   </div>  

	   <div style="margin-top: 4px"></div>
	  </div>	 
	 </td> 
	 
	 <td class="sth1" valign="top" align="center" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()" width="80px">
	  <div style="margin-top: 5px"><?php echo $this->_tpl_vars['adm_object']->GetSizeItem($this->_tpl_vars['val']['imagesize']); ?>
</div>	  	 
	 </td>
	 <td class="sth1" valign="top" align="center" onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()" width="80px">
	  <div style="margin-top: 5px"><?php if (! $this->_tpl_vars['val']['imageuse']): ?><i>(нет)</i><?php else: ?><i style="color: #333399">(активен)</i><?php endif; ?></div>
	 </td>
	 <td class="sth1" valign="top" align="center" width="130px" style="border-right: 1px solid #E3E4E8;" 
	 onclick="$('#chid<?php echo ($this->_foreach['val']['iteration']-1); ?>
').click()">
	 <div style="margin-top: 5px"><?php echo $this->_tpl_vars['val']['datecreat']; ?>
</div>
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
     Нет загруженных изображений!
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

 <form method="post" name="ffadd" id="ffadd"<?php if (! $_GET['modifyimage']): ?> enctype="multipart/form-data"<?php endif; ?> onsubmit="return PrepereToSend(this)"> 
  
  <?php if (! $_GET['modifyimage']): ?>
  <div class="typelabel"><label id="red">*</label> Файл изображения (форматы: <?php echo $this->_tpl_vars['adm_object']->GetListTypes(); ?>
<?php if ($this->_tpl_vars['adm_object']->GetResult('maxsize')): ?>, максимальный размер: <b><?php echo $this->_tpl_vars['adm_object']->GetResult('maxsize'); ?>
</b>)<?php endif; ?></div>  
  <div class="typelabel"> 
   <input type="file" size="20" style="width: 430px; height: 22px" class="inpt" name="image" id="image">  
  </div>
  <?php else: ?>
  <div style="margin-top: 18px; font-size: 16px; border-bottom: 1px dashed #808080"><b>Изменение надстроек изображения.</b></div>
  <div style="margin-top: 15px"></div>
  <?php endif; ?>
  
  
  <div class="typelabel"><label id="red">*</label> Раздел информера</div>
  <div class="typelabel">  
   <select size="1" name="idsection" id="idsection">
    <option<?php if (! $this->_tpl_vars['adm_object']->GetResult('imageinfo.sectionid')): ?> selected="selected"<?php endif; ?> value="0">Все разделы</option>
    <?php if ($this->_tpl_vars['adm_object']->GetResult('sections')): ?>
     <?php $_from = $this->_tpl_vars['adm_object']->GetResult('sections'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
     <option<?php if ($this->_tpl_vars['val']['iditem'] == $this->_tpl_vars['adm_object']->GetResult('imageinfo.sectionid')): ?> selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['val']['iditem']; ?>
"><?php echo $this->_tpl_vars['val']['secname']; ?>
</option>
     <?php endforeach; endif; unset($_from); ?>
    <?php endif; ?> 
   </select>
  </div>
  
  <div class="typelabel">Предварительные надстройки<?php if (! $_GET['modifyimage']): ?> (опционально, устанавливаются после загрузки)<?php endif; ?><br />
  <u>Разделитель</u>: запятая или перенос строки<br />
  <ul>
  <li style="margin-left: 12px; margin-top: 6px">
   Координаты положения значений на изображении:<br />
   x1:24<br />
   y1:30<br />
   x2:55<br />
   y2:120<br />
   и т.д<br /><br />
   <u>Обозначение координат</u>:<br />
   x[номер_значения]:[позиция_в_пикслях_от_левого_края_от_нуля]<br />
   y[номер_значения]:[позиция_в_пикслях_от_верхнего_края_от_нуля]<br /><br />
   <u>Пример</u>: позиция верхнего левого угла для первого значения <br /><b>x1:0, y1:0</b> 
   <br /><br />
   <b>Обозначение параметров для информеров:</b><br />
   <?php if (! $_GET['inftype'] || $_GET['inftype'] == '1'): ?>
    <b>x1, y1 </b>- Значение скорости Download интернета в килобитах\s<br />
    <b>x2, y2 </b>- Значение скорости Upload интернета в килобитах\s<br />
    <b>x3, y3 </b>- Значение скорости Download интернета в килобайтах\s (скорость скачивания)<br />
    <b>x4, y4 </b>- Значение скорости Upload интернета в килобайтах\s<br />
    <br />   
   <?php endif; ?>
   <?php if ($_GET['inftype'] == '2'): ?>
    <b>x1, y1 </b>- Значение IP адреса<br />
    <br />    
   <?php endif; ?>
   <?php if ($_GET['inftype'] == '3'): ?>
    <b>x1, y1 </b>- Значение Яндекс ТиЦ<br />
    <b>x2, y2 </b>- Значение Google PR<br />
    <br />    
   <?php endif; ?>  
   <?php if ($_GET['inftype'] == '4'): ?>
    <b>x1, y1 </b>- Дата апдейта `Яндекс ТиЦ`<br />
    <b>x2, y2 </b>- Дата апдейта `Яндекс поиск`<br />
    <b>x3, y3 </b>- Дата апдейта `Яндекс каталог`<br />
    <b>x4, y4 </b>- Дата апдейта `Google PR`<br />
    <br />    
   <?php endif; ?>   
   <u>*** Если параметр отсутствует - значение не будет отображаться на информере!!</u><br /><br />
  </li>
  </ul>
	
  <ul>
  <li style="margin-left: 12px">
   Для установки цвета значения используйте формат параметров:<br /><br />
   [<b>x</b> | <b>y</b>][<b>номер_параметра</b>]color:[<b>цвет_в_hex_формате</b>]<br /><br />
   Пример установки красного цвета для параметра <b>x1</b> - <u>x1color:#FF0000</u><br />
   По умолчанию цвет "черный" (#000000)<br /><br />
   <u>** Параметр <b>y</b> не используется.</u>   
   <br /><br />
  </li>
  </ul>
  
  <ul>
  <li style="margin-left: 12px">
   Для установки процента непрозрачности текста параметров используйте формат:<br /><br />
   [<b>x</b> | <b>y</b>][<b>номер_параметра</b>]transperent:[<b>число_от_0_до_100</b>]<br /><br />
   Параметр определяет степень непрозрачности текста на изображении по шкале от 0 до 100, где 0 - полная прозрачность, 100 - полная непрозрачность. Уровень прозрачности определяется в процентном соотношении.<br />
   Пример установки уровня непрозрачности 70% для параметра <b>x1</b>: <u>x1transperent:70</u><br />
   По умолчанию: 100<br /><br />
   <u>** Параметр <b>y</b> не используется.</u>
   <br /><br />   
  </li>
  </ul>
  
  <ul>
  <li style="margin-left: 12px">
   Для установки градуса наклона текста параметра используйте формат:<br /><br />
   [<b>x</b> | <b>y</b>][<b>номер_параметра</b>]angle:[<b>число_градус_наклона</b>]<br /><br />
   Параметр определяет угол наклона текста.<br />
   Пример установки вертикального положения для параметра <b>x1</b>: <u>x1angle:90</u><br />
   По умолчанию: 0 - "горизонтально"<br /><br />
   <u>** Параметр <b>y</b> не используется.</u>
   <br /><br />   
  </li>
  </ul>
  
  <ul>
  <li style="margin-left: 12px">
   Для установки размера текста используйте формат:<br /><br />
   [<b>x</b> | <b>y</b>][<b>номер_параметра</b>]size:[<b>число_размер_шрифта_в_пикслях</b>]<br /><br />
   Параметр определяет размер шрифта текста.<br />
   Пример установки размера шрифта 16px для параметра <b>x1</b>: <u>x1size:16</u><br />
   По умолчанию: 12<br /><br />
   <u>** Параметр <b>y</b> не используется.</u>
   <br /><br />   
  </li>
  </ul>
  
  <ul>
  <li style="margin-left: 12px">
   Для установки шрифта текста используйте формат:<br /><br />
   [<b>x</b> | <b>y</b>][<b>номер_параметра</b>]font:[<b>идентификатор_шрифта_загруженного_на_сайт</b>]<br /><br />
   Параметр определяет шрифт текста отображаемого параметра. Для указания шрифта используется указание идентификатора шрифта, загруженного на сайта в разделе <a href="<?php echo @W_SITEPATH; ?>
account/admfontssection/" target="_blank">шрифтов</a>. Для вставки идентификатора шрифта используйте выбор шрифта ниже. При отсутствии указанного шрифта или указании 0 - используется шрифт Arial<br />
   Пример установки шрифта Arial для параметра <b>x1</b>: <u>x1font:0</u><br />
   По умолчанию: 0 (Arial)<br /><br />
   <u>** Параметр <b>y</b> не используется.</u>
   <br /><br />   
  </li>
  </ul>
  
  <ul>
  <li style="margin-left: 12px">
   Дополнительные параметры для всех видов информеров:<br /><br />
   <b>xURL</b>:[позиция_по_x] и yURL:[позиция_по_y]<br /><br />
   Если параметр(ы) установлены - в указанные координаты выводит текст "хоста сайта".<br />
   На параметр "хоста сайта" действуют все вышеописанные параметры форматирования текста.<br />
   Пример отображения хоста сайта в координатах x=10, y=10 - <u>xURL:10,yURL:10</u><br />
   По умолчанию: <b>не выводится</b>
   <br /><br />
   
   <b>xREPcolor</b>:цвет_в_hex_формате<br /><br />
   Использование данного параметра включает информеру возможность смены цвета при выборе информера.<br />
   Если параметр установлен - посетитель сможет выбрать цвет информера. Указанный в данном параметре цвет будет 
   заменен на цвет, который выбирет посетитель.<br />
   Пример: установив параметр как <b>xREPcolor:#FF0000</b> - если посетитель выбирит например синий (#0000FF) при выборе информера - установленный в данном параметре цвет (красный #FF0000) будет заменен на синий. "Заменены будут все вхождения красного цвета на синий."<br />
   По умолчанию: <b>не используется</b>
   <br /><br />   
  </li>
  </ul>
   
  </div>
  
  <div class="typelabel">
  <input type="button" value="&nbsp;Вставить цвет&nbsp;" class="butt" name="addcolor" id="addcolor"><label style="margin-left: 6px; color: #FFFFFF; background: #FFFFFF" id="addcolorlabel" for="addcolor">&nbsp;color&nbsp;</label>
  <label style="margin-left: 12px">
  Шрифт: 
  <select id="textfont" name="textfont" style="width: 284px">
    <option selected="selected" value="0">Arial</option>
    <?php $_from = $this->_tpl_vars['adm_object']->GetResult('fonts'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
	 <option value="<?php echo $this->_tpl_vars['val']['iditem']; ?>
"><?php echo $this->_tpl_vars['adm_object']->substr($this->_tpl_vars['val']['fontname'],0,-4); ?>
</option>	 
	<?php endforeach; endif; unset($_from); ?>    
   </select>
   <input type="button" value="&nbsp;Вставить&nbsp;" onclick="AddFontNamed()" class="butt">
  </label>
  </div>  
  
  <div class="typelabel">
   <textarea class="int_text" style="height: 100px; width: 95%" name="list" id="list"><?php if ($_GET['modifyimage']): ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('list','updatesactionnew','do',$this->_tpl_vars['adm_object']->GetResult('imageinfo.options')); ?>
<?php else: ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('list','updatesactionnew'); ?>
<?php endif; ?></textarea>
  </div>  
  
  <?php if (! $_GET['modifyimage']): ?>
  <div class="typelabel">
   <input type="checkbox"<?php if ($this->_tpl_vars['adm_object']->CheckPostValue('imageuse')): ?> checked="checked"<?php endif; ?> style="cursor: pointer" name="imageuse" id="imageuse"><label for="imageuse" style="cursor: pointer">&nbsp;Добавить активным информером</label>
  </div>
  <?php endif; ?>  

<?php echo '
<script type="text/javascript">
 function AddFontNamed() {
  InsertObhvatData($(\'#textfont\').val(), \'\', \'list\');	
 }//AddFontNamed
 
 $(\'#addcolor\').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		InsertObhvatData(\'#\'+hex, \'\', \'list\');		
		$(\'#addcolorlabel\').css(\'background\', \'#\'+hex);
		$(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor($(\'#addcolorlabel\').css(\'background\'));
	}
 })
 .bind(\'keyup\', function(){
	$(this).ColorPickerSetColor($(\'#addcolorlabel\').css(\'background\'));
 });	
</script>
'; ?>

  
 <input type="hidden" value="do" name="updatesactionnew">
 <div class="typelabel"><input type="submit" value="&nbsp;<?php if (! $_GET['modifyimage']): ?>Добавить файл<?php else: ?>Изменить надстройки информера<?php endif; ?>&nbsp;" class="button" name="rb" id="rb"><?php if ($_GET['modifyimage']): ?><label style="margin-left: 6px"><input type="button" value="&nbsp;Предварительный просмотр&nbsp;" class="butt" name="prew" id="prew" onclick="ActionPrewiev('')"></label><?php endif; ?>
 </div>
 </form>
 
 <?php if ($_GET['modifyimage']): ?>
 <div style="margin-top: 18px"><b>Предварительный просмотр</b></div>
 <div style="margin-top: 4px">
  <label id="coordinateslabel"></label><label id="fixcoordinateslabel" style="margin-left: 16px"></label>
  <label id="getxucolor" style="margin-left: 14px"><label id="datacolorxycolor" style="font-weight: bold"></label> 
  &nbsp;<a href="javascript:" onclick="CheckForColorXY('<?php echo $_GET['modifyimage']; ?>
')">Цвет под X Y</a></label>
 </div>
 
 <div style="margin-top: 6px">
  <div id="imageprev"><img id="imageobj" src="<?php echo @W_SITEPATH; ?>
account/adminformersfiles/&getimage=<?php echo $_GET['modifyimage']; ?>
"></div>
 </div>
 <div id="selcolorlabeldiv" style="margin-top: 4px; display: none; visibility: hidden">
  <a href="javascript:" id="selcolorlabel" title="#000000">Тест смены цвета</a>
 </div>
 
 <div style="margin-top: 14px"></div> 
 <?php echo '
 <script type="text/javascript">   
  //---------
  var ImageX = 0;
  var ImageY = 0;
  var ImageFixX = 0;
  var ImageFixY = 0;
  var imageMap = false;
  
  function PrepResdata(data) {
   $(\'#datacolorxycolor\').html(data);	
  }//PrepResdata
  
  function CheckForColorXY(ident) {
   $(\'#datacolorxycolor\').html(\'<u>Получение цвета..</u>\'); 	
   var toolpath = globalsectionpath + \'account/adminformersfiles/\';	
   SendDefaultRequest(toolpath, \'is_ajax_mode=1&image=\'+ident + \'&x=\' + ImageFixX + \'&y=\' + ImageFixY, \'PrepResdata\');	
  }//CheckForColorXY
  
  function FixXY() {	
   $(\'#fixcoordinateslabel\').html(
    \'<b>X:</b> <b style="color:#FF0000">\'+ImageFixX+\'</b>\'+
    \'<b style="margin-left: 4px">Y:</b> <b style="color:#FF0000">\'+ImageFixY+\'</b>\'
   );
  }//FixXY
  
  function ShowXY(x,y) {
   ImageFixX = x;
   ImageFixY = y;		
   $(\'#coordinateslabel\').html(
    \'<b>X:</b> \'+x+\'<label style="margin-left: 4px">Y:</label> \'+y
   );	
  }//ShowXY
  
  function findPosX(obj) {
   var currleft = 0;
   if (obj.offsetParent)
    while (obj.offsetParent) {
      currleft += obj.offsetLeft
      obj = obj.offsetParent;
    }
   else if (obj.x) currleft += obj.x;
   return currleft;
  }//findPosX

  function findPosY(obj) {
   var currtop = 0;
   if (obj.offsetParent)
    while (obj.offsetParent) {
      currtop += obj.offsetTop
      obj = obj.offsetParent;
    }
   else if (obj.y) currtop += obj.y;
   return currtop;
  }//findPosY
  
  function getObj(name) { return document.getElementById(name); }
  
  function initmove() {	
   ImageX = 0;
   ImageY = 0;
   ImageFixX = 0;
   ImageFixY = 0;
   imageMap = getObj("imageobj");
   imageMap.onmouseover = getCoords;
   FixXY();
   ShowXY(ImageX, ImageY);  
  }//initmove
  
  function moveDot(cursor) {
   if(!cursor) { var cursor = window.event; }
   var x = 0;
   var y = 0;
   if (cursor.pageX || cursor.pageY) {
    x = cursor.pageX;
    y = cursor.pageY;
   }
   else if (cursor.clientX || cursor.clientY) {
    x = cursor.clientX + document.body.scrollLeft;
    y = cursor.clientY + document.body.scrollTop;
   }
   x -= ImageX;
   y -= ImageY;
   ShowXY(x, y);  
  }//moveDot
  
  function getCoords() {
   ImageX = findPosX(imageMap);
   ImageY = findPosY(imageMap);
   imageMap.onmousemove = moveDot;
   imageMap.onmouseover = moveDot;
   imageMap.onclick     = FixXY;
  }//getCoords
  
  function ActionForVisibleRepColor() {
   var opt = $(\'#list\').val();
   var selcolorvisible = str_replace(\'xREPcolor\', \'\', opt) != opt;
   $(\'#selcolorlabeldiv\').css(\'display\', (selcolorvisible) ? \'block\' : \'none\');
   $(\'#selcolorlabeldiv\').css(\'visibility\', (selcolorvisible) ? \'visible\' : \'hidden\');    	
  }//ActionForVisibleRepColor
  
  function ActionPrewiev(col) {
   var options = str_replace(\'#\', \'_r_\', trim($(\'#list\').val()));   	
   options = encodeURIComponent(options);
   var path = globalsectionpath + \'account/adminformersfiles/&getimage='; ?>
<?php echo $_GET['modifyimage']; ?>
<?php echo '\';
   path = path + \'&optimg=\' + options;
   if (col) { path = path + \'&repcol=\'+str_replace(\'#\', \'_r_\', col); } 
   path = path + \'&r=\' + Math.random();   
   $(\'#imageprev\').html(\'<img id="imageobj" src="\'+path+\'">\');
   initmove();
   //check for show select color
   ActionForVisibleRepColor();      	
  }//ActionPrewiev
  
  $(\'#selcolorlabel\').ColorPicker({
	 onSubmit: function(hsb, hex, rgb, el) {
	  $(\'#selcolorlabel\').attr(\'title\', \'#\'+hex);
	  ActionPrewiev(\'#\'+hex);
	  $(el).ColorPickerHide();		
	 },
	 onBeforeShow: function () { $(this).ColorPickerSetColor($(\'#selcolorlabel\').attr(\'title\')); }
    })
    .bind(\'keyup\', function(){ $(this).ColorPickerSetColor($(\'#selcolorlabel\').attr(\'title\')); });
  
  $(document).ready(function(){ initmove(); ActionForVisibleRepColor(); });	
 </script>
 '; ?>
 
 <?php endif; ?>
 
 <?php if ($_POST['updatesactionnew'] == 'do'): ?>
 <div style="margin-top: 10px">
  <?php if ($this->_tpl_vars['adm_object']->error): ?>
   <label style="color: #FF0000"><?php echo $this->_tpl_vars['adm_object']->error; ?>
</label>
  <?php else: ?>
   <label style="color: #008000"><?php if (! $_GET['modifyimage']): ?>Файл успешно добавлен!<?php else: ?>Надстройки информера успешно изменены!<?php endif; ?></label>
  <?php endif; ?>
 </div>
 <?php endif; ?>
<?php endif; ?>
</div>
<?php else: ?> 
 <?php if ($_GET['statisticinfo']): ?>
  
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "adm_account/adminformersfiles/adm_adminformersfiles_stat_list.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   
 <?php else: ?>
 
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "adm_account/adminformersfiles/adm_adminformersfiles_sect_list.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  
 <?php endif; ?> 
<?php endif; ?>
</div>