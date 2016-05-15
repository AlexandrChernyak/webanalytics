<?php /* Smarty version 2.6.26, created on 2016-05-15 09:06:46
         compiled from vitrina_links.tpl */ ?>
<div style="margin-top: 4px">
 <div><a<?php if ($_GET['new']): ?> style="color: #000000"<?php endif; ?> href="<?php echo @W_SITEPATH; ?>
vitrinalinks/new=1">Добавить ссылку</a><?php if ($_GET['new']): ?><span style="display: inline-block; margin-left: 12px"><a href="<?php echo @W_SITEPATH; ?>
vitrinalinks/">Список ссылок</a></span><?php endif; ?></div>
 
 <div style="margin-top: 16px">
  <?php if (! $_GET['new']): ?>
  
   <?php if (! $this->_tpl_vars['global_data_list_info']['data']): ?>
   <div style="margin-left: 5px">Нет активных ссылок!</div>
   <?php else: ?>
   
     <div style="margin-top: 10px; border: 1px dashed #C0C0C0; padding: 3px">
	  Всего ссылок: <b><?php echo $this->_tpl_vars['global_data_list_info']['count']; ?>
</b>
	 </div>
	 <div style="margin-top: 14px"></div>
   
    <?php echo '
    <script type="text/javascript">
    function DoHigl(th, n) {	
     if (n) { $(th).css(\'background\',\'#F9FAFB\'); } else {   	
      $(th).css(\'background\', \'none\');		
     }	
    }//DoHigl	
    </script>
    '; ?>

    <?php $_from = $this->_tpl_vars['global_data_list_info']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
    <div style="margin-top: 12px" onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)" style="padding: 2px">
	 <span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
      <tr>
      
	   <td valign="top" align="left" width="140px">
	    <img src="http://mini.site-shot.com/1024x768/120/jpeg/?http://<?php echo $this->_tpl_vars['val']['lhost']; ?>
" width="120" height="90">
	   </td>
	   
	   <td valign="top" align="left">
	    <div><?php if (! $this->_tpl_vars['val']['isindexed']): ?><noindex><?php endif; ?><?php if ($this->_tpl_vars['val']['isbolded']): ?><b><?php endif; ?><a href="http://<?php echo $this->_tpl_vars['val']['lurl']; ?>
"<?php if (! $this->_tpl_vars['val']['isindexed']): ?> rel="nofollow"<?php endif; ?> target="_blank"><?php echo $this->_tpl_vars['val']['ltext']; ?>
</a><?php if ($this->_tpl_vars['val']['isbolded']): ?></b><?php endif; ?><?php if (! $this->_tpl_vars['val']['isindexed']): ?></noindex><?php endif; ?></div>
	    <div style="color: #969696; font-size: 95%; margin-top: 4px"><noindex><?php echo $this->_tpl_vars['val']['lurl']; ?>
</noindex></div>
	    <div style="color: #969696; font-size: 95%; margin-top: 4px"><?php echo $this->_tpl_vars['val']['ldate']; ?>
</div>
	   </td>
	   
      </tr>
     </table>
	 </span>
	</div>
    <?php endforeach; endif; unset($_from); ?>
   <?php endif; ?> 
  
  <?php else: ?>
     <?php if (! $this->_tpl_vars['CONTROL_OBJ']->IsOnline()): ?>
    <div style="color: #FF0000">Пожалуйста, авторизируйтесь или зарегистрируйтесь..</div>   
   <?php else: ?>
    <?php if (! $this->_tpl_vars['_VITRINALINKSOPTIONS']['enabled'] || ! $this->_tpl_vars['_VITRINALINKSOPTIONS']['defprice'] || $this->_tpl_vars['_VITRINALINKSOPTIONS']['defprice'] < 0): ?>
     <div style="color: #FF0000">Добавление ссылок на витрину временно закрыто администратором..</div>
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
		 var price = GetPriced();
		 if (!price) { alert(\'Не определена сумма добавления ссылки!\'); return false; }
		 //confirm
		 if (!confirm("Вы действительно хотите добавить ссылку на витрину ссылок?\\r\\nПо выбранному Вами типу ссылки с Вашего баланса будет снята сумма в размере ["+ price + " USD]\\r\\n\\r\\nВы действительно хотите продолжить?")) {
		  return false;	
		 }		 
		 $(\'#globalbodydata\').css(\'cursor\', \'wait\');
         th.rb.disabled = true;
		 return true; 	
		}//PrepereSent
		
		function SetTyped(n) { $(\'#ptype\').val(n); $(\'#summprice\').html(GetPriced() + \' USD\'); }
		
		function GetPriced() {
		 var price = $(\'#ptype\').val();
		 if (!price) { $(\'#ptype\').val(1); price = 1; }
		 if (price == \'1\') { return \''; ?>
<?php echo $this->_tpl_vars['_VITRINALINKSOPTIONS']['defprice']; ?>
<?php echo '\'; } else 
		 if (price == \'2\') { return \''; ?>
<?php echo $this->_tpl_vars['_VITRINALINKSOPTIONS']['boldprice']; ?>
<?php echo '\'; } else
		 if (price == \'3\') { return \''; ?>
<?php echo $this->_tpl_vars['_VITRINALINKSOPTIONS']['indexprice']; ?>
<?php echo '\'; } else
		 if (price == \'4\') { return \''; ?>
<?php echo $this->_tpl_vars['_VITRINALINKSOPTIONS']['indexboldprice']; ?>
<?php echo '\'; } else
		 return \'0\';		 	
		}//GetPriced
      </script>
     '; ?>

     
     <div style="margin-top: 10px; border: 1px dashed #C0C0C0; padding: 3px">
	  При добавлении ссылки, добавленный вами URL встает на первое место витрины.<br />
	  Добаленный после вашего URL, сдвигает Ваш на 1 позицию вниз. 
	  После <b><?php echo $this->_tpl_vars['_VITRINALINKSOPTIONS']['countinblock']; ?>
</b> добавленных ссылок Ваш URL перестает отображаться на
	  витринах сайта (за исключением 
	  <a href="<?php echo @W_SITEPATH; ?>
vitrinalinks/" target="_blank">страницы</a> списка витрины). 
	  На странице списка витрины отображаются все <b><?php echo $this->_tpl_vars['_VITRINALINKSOPTIONS']['countinpage']; ?>
</b> ссылок.
	  Ссылка удаляется навсегда после <b><?php echo $this->_tpl_vars['_VITRINALINKSOPTIONS']['countinpage']; ?>
</b> сдвигов.
	 </div>
	 <div style="margin-top: 14px"></div>
	 
	 
     <form method="post" name="addlink" id="addlink" onsubmit="return PrepereSent(this)">
      <div class="typelabel"><label id="red">*</label> URL ссылки (до 120 символов)</div>
      <div class="typelabel">
       <input type="text" class="inpt" style="width: 300px" name="url" id="url" maxlength="120" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('url','addaction'); ?>
" onclick="RestInp(this)" onblur="RestInp(this)">
      </div>
      
      <div class="typelabel"><label id="red">*</label> Текст ссылки (до 80 символов)</div>
      <div class="typelabel">
       <input type="text" class="inpt" style="width: 300px" name="urltext" id="urltext" maxlength="80" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('urltext','addaction'); ?>
" onclick="RestInp(this)" onblur="RestInp(this)">
      </div>
      
      <div class="typelabel">
       <input type="radio"<?php if ($_POST['addaction'] != 'do' || $_POST['ptype'] == '1'): ?> checked="checked"<?php endif; ?> style="cursor: pointer" name="selecttype" id="setdeflink" onclick="SetTyped(1)"><label for="setdeflink" style="cursor: pointer">&nbsp;Стандартная ссылка</label>
      </div>
      
      <?php if ($this->_tpl_vars['_VITRINALINKSOPTIONS']['boldprice']): ?>
       <div class="typelabel">
       <input type="radio"<?php if ($_POST['addaction'] == 'do' && $_POST['ptype'] == '2'): ?> checked="checked"<?php endif; ?> style="cursor: pointer" name="selecttype" id="setboldlink" onclick="SetTyped(2)"><label for="setboldlink" style="cursor: pointer">&nbsp;Жирная ссылка (<b>bold</b>)</label>
      </div>
      <?php endif; ?>
      
      <?php if ($this->_tpl_vars['_VITRINALINKSOPTIONS']['indexprice']): ?>
       <div class="typelabel">
       <input type="radio"<?php if ($_POST['addaction'] == 'do' && $_POST['ptype'] == '3'): ?> checked="checked"<?php endif; ?> style="cursor: pointer" name="selecttype" id="setdefindex" onclick="SetTyped(3)"><label for="setdefindex" style="cursor: pointer">&nbsp;Стандартная ссылка (индексируемая) (без тэга &lt;noindex&gt;)</label>
      </div>
      <?php endif; ?>
      
      <?php if ($this->_tpl_vars['_VITRINALINKSOPTIONS']['indexboldprice']): ?>
       <div class="typelabel">
       <input type="radio"<?php if ($_POST['addaction'] == 'do' && $_POST['ptype'] == '4'): ?> checked="checked"<?php endif; ?> style="cursor: pointer" name="selecttype" id="setboldindex" onclick="SetTyped(4)"><label for="setboldindex" style="cursor: pointer">&nbsp;Жирная ссылка (индексируемая) (<b>bold</b> + без тэга &lt;noindex&gt;)</label>
      </div>
      <?php endif; ?>  
	  
	  <div class="typelabel" style="margin-top: 15px">
	   Сумма размещения ссылки: <b id="summprice">0 USD</b>
	  </div>    
      
      <div class="typelabel" style="margin-top: 15px">
       <input type="submit" value="&nbsp;Отправить&nbsp;" class="button" name="rb" id="rb">
      </div>
      
      <input type="hidden" value="do" name="addaction">
      <input type="hidden" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('ptype','addaction'); ?>
" name="ptype" id="ptype">
     </form>   
     
     <?php echo '
     <script type="text/javascript">
	  $(\'#summprice\').html(GetPriced() + \' USD\');
     </script>
     '; ?>

     
     <div style="margin-top: 18px">
     <?php if ($_POST['addaction'] == 'do'): ?>
      <?php if ($this->_tpl_vars['global_data_list_info']['error']): ?>
       <div style="color: #FF0000"><?php echo $this->_tpl_vars['global_data_list_info']['error']; ?>
</div>
	  <?php else: ?>
	   <div style="color: #008000">Ссылка успешно добавлена!</div>
	  <?php endif; ?>      
     <?php endif; ?>
	 </div>  
     
    <?php endif; ?> 
   <?php endif; ?>
  <?php endif; ?>
 </div> 
</div>