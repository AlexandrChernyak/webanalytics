<?php /* Smarty version 2.6.26, created on 2016-05-15 08:54:41
         compiled from tools/tpl_massdomcheck.tpl */ ?>
<div style="margin-top: 5px">
 <div style="margin-bottom: 12px">
  <img src="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetToolImageStyle($this->_tpl_vars['tool_object']->section_id,128,'',''); ?>
" style="width: 64px; height: 64px; float: left; margin-right: 6px">
  
  <?php if ($this->_tpl_vars['tool_object']->GetToolLimitInfoEx('tdescr')): ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText($this->_tpl_vars['tool_object']->GetToolLimitInfoEx('tdescr')); ?>
<?php else: ?>
  Данный инструмент поможет Вам выполнить проверку доступности доменов для регистрации.
  <?php endif; ?>
  
  <div style="clear: both;"></div>
 </div>

 <?php if (! $this->_tpl_vars['tool_object']->canrun): ?>
  <div style="margin-top: 25px">
  <?php if ($this->_tpl_vars['tool_object']->onlyforadmin): ?>
  Инструмент временно отключен администратором! Приносим извинения за неудобства.. Пожалуйста, повторите попытку позже.
  <?php else: ?>  
  Для использования данного инструмента требуется авторизация на сайте. Пожалуйста, авторизируйтесь или <a href="<?php echo @W_SITEPATH; ?>
register/" target="_blank">зарегистрируйтесь</a> для получения доступа к инструменту.
  <?php endif; ?> 
  </div>
 <?php else: ?>
 
 <?php echo '
 <script type="text/javascript">  
  var PathHost = \''; ?>
<?php echo @W_SITEPATH; ?>
<?php echo '\';
  var PathRequstAction = PathHost + \'tools/massdomcheck/\';
  var ErrorsList = new Array();
  ErrorsList[\'nocorrectpage\']      = \''; ?>
<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText('nocorrectpage'); ?>
<?php echo '\';
  ErrorsList[\'nourlsforanalize\']   = \''; ?>
<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText('nourlsforanalize'); ?>
<?php echo '\';
  ErrorsList[\'gotonextitemlist\']   = \''; ?>
<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText('gotonextitemlist'); ?>
<?php echo '\';
  ErrorsList[\'ispausedactionbe\']   = \''; ?>
<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText('ispausedactionbe',$this->_tpl_vars['tool_object']->GetLimitCount()); ?>
<?php echo '\';
  ErrorsList[\'ispausedonactionl\']  = \''; ?>
<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText('ispausedonactionl'); ?>
<?php echo '\';
  ErrorsList[\'isprocessactionit\']  = \''; ?>
<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText('isprocessactionit'); ?>
<?php echo '\';
  ErrorsList[\'preperetostartajax\'] = \''; ?>
<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText('preperetostartajax'); ?>
<?php echo '\';
  ErrorsList[\'preptopausedajms\']   = \''; ?>
<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText('preptopausedajms'); ?>
<?php echo '\';
  ErrorsList[\'actionisstoppedb\']   = \''; ?>
<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText('actionisstoppedb'); ?>
<?php echo '\';
  ErrorsList[\'actionisfinishedb\']  = \''; ?>
<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText('actionisfinishedb'); ?>
<?php echo '\';
  ErrorsList[\'actiontopaynolimit\'] = \''; ?>
<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText('actiontopaynolimit',$this->_tpl_vars['tool_object']->GetToolLimitInfoEx('price')); ?>
<?php echo '\';
  ErrorsList[\'actiontopayststusq\'] = \''; ?>
<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText('actiontopayststusq'); ?>
<?php echo '\';
  	
  function DoSetDefUrl(ident) {
   var str = '; ?>
'<?php echo @W_HOSTMYSITE; ?>
';<?php echo '
   var obj = $(\'#\'+ident);
   var sou = trim(obj.val());
   obj.val(((sou == \'\') ? \'\' : sou + "\\r\\n") + str); 
   obj.focus();  	
  }//DoSetDefUrl
  function ClearVal(ident) { $(\'#\'+ident).val(\'\'); $(\'#\'+ident).focus(); }	
 </script>
 <script type="text/javascript" src="'; ?>
<?php echo @W_SITEPATH; ?>
<?php echo 'athemes/SIMPLE/ajax_mass_tools.js"></script>
 '; ?>

<div class="typelabel"><label id="red">*</label> Список сайтов <label class="prep_label_analisys">(пример: <a href="javascript:" onclick="DoSetDefUrl('urls')"><?php echo @W_HOSTMYSITE; ?>
</a>, или <a href="javascript:" onclick="ClearVal('urls')">очистить</a> список)</label><?php if (isset ( $this->_tpl_vars['tool_object'] ) && ! $this->_tpl_vars['tool_object']->IsNoLimitTool()): ?><span id="paysourcefornolimit">
, &nbsp;Не более: <?php echo $this->_tpl_vars['tool_object']->GetLimitCount(); ?>
<?php if ($this->_tpl_vars['CONTROL_OBJ']->IsOnline()): ?>, <label class="prep_label_analisys"><a href="javascript:" onclick="ProcessPayLimitOff('paysourcefornolimit')">Снять за (<label style="color: #000000"><?php echo $this->_tpl_vars['tool_object']->GetToolLimitInfoEx('price'); ?>
 USD</label>)</a></label>
<?php endif; ?><?php endif; ?></span></div>
<div class="typelabel">  
   <textarea class="int_text" style="height: 100px; width: 95%" name="urls" id="urls"><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('urls','doactiontool'); ?>
</textarea>
  </div>
<div class="typelabel">
   <input id="startb" type="submit" name="button" class="button" value="&nbsp;Начать проверку&nbsp;" 
   onclick="StartChecking('urls', false, true)">&nbsp;
   <input id="pauseb" disabled="disabled" type="button" name="Submit" class="button" value="&nbsp;Приостановить&nbsp;" onclick="PausedChecking()">&nbsp;
   <input id="stopb" disabled="disabled" type="button" name="Submit" class="button" value="&nbsp;Остановить&nbsp;" onclick="StopChecking()">
</div>
<div style="margin-top: 12px"></div>
  
<div id="getprocessedid"></div>

<div style="margin-top: 12px"></div>
<div id="processedsource"></div>
 
 <?php endif; ?> 
</div>