<?php /* Smarty version 2.6.26, created on 2016-05-15 09:10:10
         compiled from tools/tpl_prcyinformer.tpl */ ?>
<div style="margin-top: 5px">
 
 <div style="margin-bottom: 12px">
 <img src="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetToolImageStyle($this->_tpl_vars['tool_object']->section_id,128,'',''); ?>
" style="width: 64px; height: 64px; float: left; margin-right: 6px">
 
 <?php if ($this->_tpl_vars['tool_object']->GetToolLimitInfoEx('tdescr')): ?><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText($this->_tpl_vars['tool_object']->GetToolLimitInfoEx('tdescr')); ?>
<?php else: ?>
 Данный инструмент предоставляет Вам возможность создать информер параметров <b>Google PR</b> и <b>Яндекс ТиЦ</b> Вашего сайта. Выбрать подходящий Вам информер, сменить цвет информера, получать достоверную и свежую информацию о `основных` показателях Вашего сайта в любой момент времени.
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
 
 <?php if ($_POST['doactiontool'] == 'do' && $_POST['actinp'] != 'select'): ?>
 <?php echo '
 <script type="text/javascript">
  function GetInformCodeCheck(th) {	
   if (!th.selectedinformer.value) {
	alert(\'Выберите информер, который хотите использовать!\');
	return false;
   }
   $(\'#globalbodydata\').css(\'cursor\', \'wait\');
   th.rb.disabled = true;
   return true;   	
  }//GetInformCodeCheck 	
 </script>
 '; ?>

 <?php else: ?>
 <?php echo '
 <script type="text/javascript">
  function DoSetDefUrl(ident) {
   var str = '; ?>
'<?php echo @W_HOSTMYSITE; ?>
';<?php echo '
   var obj = $(\'#\'+ident);
   obj.val(str); 
   obj.focus();  	
  }//DoSetDefUrl
  function PrepereToSend(th) {
   if (trim(th.url.value) == \'\') {
	alert(\'Укажите URL!\');
	th.url.focus();
	return false;
   }
   $(\'#globalbodydata\').css(\'cursor\', \'wait\');
   th.rb.disabled = true;   
   return true;	
  }//PrepereToSend  	
 </script>
 '; ?>

 <?php endif; ?>
 <form method="post" name="tollform" id="toolform" onsubmit="return <?php if ($_POST['doactiontool'] == 'do' && $_POST['actinp'] != 'select'): ?>GetInformCodeCheck<?php else: ?>PrepereToSend<?php endif; ?>(this)">
  
  <div class="typelabel"><label id="red">*</label> URL<?php if ($_POST['doactiontool'] != 'do' || $_POST['actinp'] == 'select'): ?><label class="prep_label_analisys">(пример: <a href="javascript:" onclick="DoSetDefUrl('url')"><?php echo @W_HOSTMYSITE; ?>
</a>)</label><?php endif; ?></div>
  <div class="typelabel">
   <input type="text" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('url','doactiontool'); ?>
" style="width: 98%" class="inpt" name="url" id="url" maxlength="198" <?php if ($_POST['doactiontool'] == 'do' && $_POST['actinp'] != 'select'): ?> readonly="readonly"<?php endif; ?>>
  </div>  
  
  <?php if ($_POST['doactiontool'] != 'do' || $_POST['actinp'] == 'select'): ?>
  <div class="typelabel" style="margin-top: 12px">
   <input type="submit" value="&nbsp;Выбрать информер&nbsp;" class="button" name="rb" id="rb">
  </div>
  <input type="hidden" value="select" name="actinp"> 
  <?php endif; ?>
  
  <input type="hidden" value="do" name="doactiontool">
    
  <?php if ($_POST['doactiontool'] == 'do' && isset ( $this->_tpl_vars['tool_object'] )): ?>
  
   <?php if ($_POST['actinp'] == 'select' && $this->_tpl_vars['tool_object']->error): ?> 
    <div style="margin-top: 14px; margin-left: 4px; color: #FF0000"><?php echo $this->_tpl_vars['tool_object']->error; ?>
</div>  
   <?php else: ?>  
   
   <?php if ($_POST['selectedinformer']): ?>
        <div style="margin-top: 25px">
     <div class="typelabel">HTML код информера</div>
     
     <div class="typelabel">
	  <?php if (! $this->_tpl_vars['tool_object']->GetResult('newinf.iditem')): ?>
	   <div style="color: #FF0000; margin-left: 4px">Ошибка регистрации информера!</div>	   
	  <?php else: ?>
	  <textarea class="int_text" style="height: 100px; width: 95%"><!-- PR CY informer by <?php echo @W_HOSTMYSITE; ?>
 begin -->
<a href="http://<?php echo @W_HOSTMYSITE; ?>
" target="_blank" title="Посетить <?php echo @W_HOSTMYSITE; ?>
"><img border="0" src="http://<?php echo @W_HOSTMYSITE; ?>
/informer-images/3/image-<?php echo $this->_tpl_vars['tool_object']->GetResult('newinf.iditem'); ?>
.tif" alt="informer pr cy"></a>
<!-- PR CY informer by <?php echo @W_HOSTMYSITE; ?>
 end --></textarea>
        
       
<div class="typelabel" style="margin-top: 6px">BB код для блога или форума</div>
	   <div class="typelabel">
	   <textarea class="int_text" style="height: 100px; width: 95%">[url=http://<?php echo @W_HOSTMYSITE; ?>
][img]http://<?php echo @W_HOSTMYSITE; ?>
/informer-images/3/image-<?php echo $this->_tpl_vars['tool_object']->GetResult('newinf.iditem'); ?>
.tif[/img][/url]</textarea>
	   </div> 
	  
	   <div class="typelabel">Предварительный просмотр</div>
	   <div class="typelabel">
	   <!-- PR CY informer by <?php echo @W_HOSTMYSITE; ?>
 begin -->
	   <a href="http://<?php echo @W_HOSTMYSITE; ?>
" target="_blank" title="Посетить <?php echo @W_HOSTMYSITE; ?>
"><img border="0" src="http://<?php echo @W_HOSTMYSITE; ?>
/informer-images/3/image-<?php echo $this->_tpl_vars['tool_object']->GetResult('newinf.iditem'); ?>
.tif" alt="informer pr cy"></a>
	   <!-- PR CY informer by <?php echo @W_HOSTMYSITE; ?>
 end -->
	   </div>
	  
	  <?php endif; ?>
	  
	  <div class="typelabel" style="margin-top: 14px"><a href="<?php echo @W_SITEPATH; ?>
tools/<?php echo $this->_tpl_vars['tool_object']->section_id; ?>
/">&lt;&lt; К началу</a></div>  
	 
	 </div>    
    </div>    
   <?php else: ?>
    <div style="margin-top: 25px"> 
     <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tools/informers/tpl_informers_list.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>
    
    <?php if ($this->_tpl_vars['tool_object']->GetResult('infdata')): ?>
    <div class="typelabel" style="margin-top: 17px">
     <input type="submit" value="&nbsp;Получить код информера&nbsp;" class="button" name="rb" id="rb">
    </div>
    <?php else: ?>
     <div style="margin-top: 17px">Нет активных информеров!</div>
    <?php endif; ?>
    
   <?php endif; ?>
   
   <?php endif; ?>	   
  <?php endif; ?>
      
 </form>
 
 <?php endif; ?> 
</div>