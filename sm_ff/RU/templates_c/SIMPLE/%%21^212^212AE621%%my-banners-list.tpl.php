<?php /* Smarty version 2.6.26, created on 2016-05-15 09:18:50
         compiled from account/my-banners-list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'account/my-banners-list.tpl', 808, false),)), $this); ?>
 <?php if (! $this->_tpl_vars['CONTROL_OBJ']->IsOnline()): ?>error<?php else: ?>

 <?php echo '
 <style type="text/css">
  .line_item { border-bottom: 1px solid #EBEBEB; height: 22px; }
 </style>
 <script type="text/javascript">
  function DoHigl3(th, n) {	
   if (n) { $(th).css(\'background\',\'#F9FAFB\'); } else {   	
    $(th).css(\'background\', \'none\');		
   }	
  }//DoHigl	
  function DoHigl4(th, n) {	
   if (n) { $(th).css(\'background\',\'#DDE0E7\'); } else {   	
    $(th).css(\'background\', \'none\');		
   }	
  }//DoHigl
 </script>
 '; ?>

   
 <div style="margin-bottom: 15px; background: #F0F0F0; padding: 3px">
 <a href="<?php echo @W_SITEPATH; ?>
account/my-banners-list/?new=1" style="text-decoration: none;<?php if ($_GET['new']): ?> color: #000000<?php endif; ?>">Добавить баннер</a>  <label style="padding: 0 2px 0 2px">|</label>  <a style="text-decoration: none;<?php if (! $_GET['new'] && ! $_GET['moderl']): ?> color: #000000<?php endif; ?>" href="<?php echo @W_SITEPATH; ?>
account/my-banners-list/?moderl=0">Все активные баннеры (<label style="color: #000000"><?php echo $this->_tpl_vars['mybanner_obj']->GetResult('acount'); ?>
</label>)</a>  <label style="padding: 0 2px 0 2px">|</label>  <a style="text-decoration: none;<?php if (! $_GET['new'] && $_GET['moderl']): ?> color: #000000<?php endif; ?>" href="<?php echo @W_SITEPATH; ?>
account/my-banners-list/?moderl=1">Все НЕ активные баннеры (<label style="color: #000000"><?php echo $this->_tpl_vars['mybanner_obj']->GetResult('icount'); ?>
</label>)</a>
 </div> 

 <?php if ($_GET['new']): ?>
  <div style="margin-top: 4px">
 
  <?php if (! $_GET['placeb']): ?>
 
 <?php if (! $this->_tpl_vars['mybanner_obj']->GetPlaceList()): ?>
  <div style="color: #FF0000">В данный момент мест для показа баннеров нет.</div>
 <?php else: ?>
 
   <div><strong>Выберите место, в котором желаете разместить баннер!</strong></div>
   
   <?php $_from = $this->_tpl_vars['mybanner_obj']->GetResult('placelist'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
    <div style="margin: 4px; margin-top: 15px; padding: 4px; border: 1px solid #D2D2D2">
	 <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
       <tr>
       
        <td valign="top" align="left" width="50px" style="padding-right: 4px">
		 <img src="<?php echo @W_SITEPATH; ?>
img/ico/general/places_visited.png" border="0">
		</td>	
		
	    <td valign="top" align="left">
		 <div><a href="<?php echo @W_SITEPATH; ?>
account/my-banners-list/?new=1&placeb=<?php echo $this->_tpl_vars['val']['iditem']; ?>
"><strong><?php echo $this->_tpl_vars['val']['groupname']; ?>
</strong></a></div>
		 <div style="margin-top: 4px;">
		  
          <div>
          <span style="width: 100%">
           <table width="100%" cellpadding="0" cellspacing="0" border="0">	        
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Загружать баннеры	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          <?php if ($this->_tpl_vars['val']['filesuse']): ?>
               <label style="color: #008000">Да</label>
              <?php else: ?>
               <em>(нет)</em>
              <?php endif; ?>
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Ссылки на баннеры
             </td>
	         <td valign="center" align="left" class="line_item">
	          <?php if ($this->_tpl_vars['val']['linksuse']): ?>
               <label style="color: #008000">Да</label>
              <?php else: ?>
               <em>(нет)</em>
              <?php endif; ?>
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Flash баннеры	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          <?php if ($this->_tpl_vars['val']['useflash']): ?>
               <label style="color: #008000">Да</label>
              <?php else: ?>
               <em>(нет)</em>
              <?php endif; ?>
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Размеры места	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          Ширина: <?php echo $this->_tpl_vars['val']['groupwidth']; ?>
<?php if ($this->_tpl_vars['val']['widthpersent']): ?>%<?php else: ?>px<?php endif; ?>, Высота: <?php echo $this->_tpl_vars['val']['groupheight']; ?>
<?php if ($this->_tpl_vars['val']['heightpersent']): ?>%<?php else: ?>px<?php endif; ?>
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Цена за 1000 показов	           
             </td>
	         <td valign="center" align="left" class="line_item">
	           <?php if ($this->_tpl_vars['val']['pricetolook'] > 0): ?>
                <label style="color: #008000"><?php echo $this->_tpl_vars['val']['pricetolook']; ?>
 USD</label>
               <?php else: ?>
                <em>(не используется)</em>
               <?php endif; ?> 
	         </td>
	        </tr>
            
            <?php $this->assign('itemdescrit', $this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextFromDB($this->_tpl_vars['val']['groupdescr'])); ?>
          
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" <?php if ($this->_tpl_vars['itemdescrit']): ?>class="line_item"<?php else: ?> height="22px"<?php endif; ?>>
              Цена за 1 день показов	           
             </td>
	         <td valign="center" align="left" <?php if ($this->_tpl_vars['itemdescrit']): ?>class="line_item"<?php else: ?> height="22px"<?php endif; ?>>
	           <?php if ($this->_tpl_vars['val']['pricetodays'] > 0): ?>
                <label style="color: #008000"><?php echo $this->_tpl_vars['val']['pricetodays']; ?>
 USD</label>
               <?php else: ?>
                <em>(не используется)</em>
               <?php endif; ?> 
	         </td>
	        </tr>

	       </table>       
          </span>         
          </div>
          
          <?php if ($this->_tpl_vars['itemdescrit']): ?>
          <div style="margin-top: 14px">
           <?php echo $this->_tpl_vars['itemdescrit']; ?>
          
          </div>
          <?php endif; ?>
                   
		 </div>
		</td>
		
       </tr>
      </table>
	 </span>
	</div>    
   <?php endforeach; endif; unset($_from); ?>
 
 <?php endif; ?>
 <?php else: ?>
    
  <?php if (! $this->_tpl_vars['mybanner_obj']->GetResult('groupinfo')): ?>
   <div style="color: #FF0000">Место не найдено!</div>
  <?php else: ?> 
     
    <div style="margin: 4px; margin-top: 15px; padding: 4px; border: 1px solid #D2D2D2">
	 <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
       <tr>
       
        <td valign="top" align="left" width="50px" style="padding-right: 4px">
		 <img src="<?php echo @W_SITEPATH; ?>
img/ico/general/places_visited.png" border="0">
		</td>	
		
	    <td valign="top" align="left">
		 <div>Место: <strong><?php echo $this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.groupname'); ?>
</strong></div>
		 <div style="margin-top: 4px;">
		  
          <div>
          <span style="width: 100%">
           <table width="100%" cellpadding="0" cellspacing="0" border="0">	        
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Загружать баннеры	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.filesuse')): ?>
               <label style="color: #008000">Да</label>
              <?php else: ?>
               <em>(нет)</em>
              <?php endif; ?>
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Ссылки на баннеры
             </td>
	         <td valign="center" align="left" class="line_item">
	          <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.linksuse')): ?>
               <label style="color: #008000">Да</label>
              <?php else: ?>
               <em>(нет)</em>
              <?php endif; ?>
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Flash баннеры	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.useflash')): ?>
               <label style="color: #008000">Да</label>
              <?php else: ?>
               <em>(нет)</em>
              <?php endif; ?>
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Размеры места	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          Ширина: <?php echo $this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.groupwidth'); ?>
<?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.widthpersent')): ?>%<?php else: ?>px<?php endif; ?>, Высота: <?php echo $this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.groupheight'); ?>
<?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.heightpersent')): ?>%<?php else: ?>px<?php endif; ?>
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Цена за 1000 показов	           
             </td>
	         <td valign="center" align="left" class="line_item">
	           <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.pricetolook') > 0): ?>
                <label style="color: #008000"><?php echo $this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.pricetolook'); ?>
 USD</label>
               <?php else: ?>
                <em>(не используется)</em>
               <?php endif; ?> 
	         </td>
	        </tr>
            
            <?php $this->assign('itemdescrit', $this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextFromDB($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.groupdescr'))); ?>
          
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" <?php if ($this->_tpl_vars['itemdescrit']): ?>class="line_item"<?php else: ?> height="22px"<?php endif; ?>>
              Цена за 1 день показов	           
             </td>
	         <td valign="center" align="left" <?php if ($this->_tpl_vars['itemdescrit']): ?>class="line_item"<?php else: ?> height="22px"<?php endif; ?>>
	           <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.pricetodays') > 0): ?>
                <label style="color: #008000"><?php echo $this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.pricetodays'); ?>
 USD</label>
               <?php else: ?>
                <em>(не используется)</em>
               <?php endif; ?> 
	         </td>
	        </tr>

	       </table>       
          </span>         
          </div>
          
          <?php if ($this->_tpl_vars['itemdescrit']): ?>
          <div style="margin-top: 14px">
           <?php echo $this->_tpl_vars['itemdescrit']; ?>
          
          </div>
          <?php endif; ?>
                   
		 </div>
		</td>
		
       </tr>
      </table>
	 </span>
	</div>  
  
      <div style="margin-top: 16px; padding-left: 3px">
    
    <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('accesstoadd') == 1): ?>
     <div style="color: #FF0000">
      В данный момент все доступные виды использования баннеров данного места отключены!
     </div>
    <?php elseif ($this->_tpl_vars['mybanner_obj']->GetResult('accesstoadd') == 2): ?>
     <div style="color: #FF0000">
      В данный момент место не может быть активно! Нет активных цен на размещение баннеров!
     </div>
    <?php elseif ($this->_tpl_vars['mybanner_obj']->GetResult('accesstoadd') == 3): ?>
     <div style="color: #FF0000">
      В данный момент место не может быть активно! Не указаны размеры места!
     </div>
    <?php elseif ($this->_tpl_vars['mybanner_obj']->GetResult('accesstoadd') == 4): ?>
     <div style="color: #FF0000">
      В данный момент место не может быть активно! Место отключено!
     </div>
    <?php elseif ($this->_tpl_vars['mybanner_obj']->GetResult('accesstoadd') == 5): ?>
     <div style="color: #FF0000">
      В данный момент место не может быть активно! Превышено максимальное кол-во баннеров на место!
     </div>
    <?php else: ?>
     
     <?php echo '
     <script type="text/javascript">
      var priceforgetmp = 0;
     
	  function DoSend(th) {   
	   
	   if (priceforgetmp <= 0) { 
	     alert(\'Укажите корректно все параметры!\');
         return false;  
	   }       
       
       var usem = \''; ?>
<?php echo $this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.usemoder'); ?>
<?php echo '\';
       var s = \'Вы действительно хотите добавить баннер по указанным Вами параметрам. Если добавление баннера пройдет успешно, \';
       
       if (usem == \'0\') {
        if (!confirm(s+\'с Вашего баланса будет снята сумма, в размере `\'+priceforgetmp+\' USD`! Продолжить?\')) {
         return false;   
        }        
       } else {
        if (!confirm(s+\'у Вас будет 24 часа для оплаты с момента подтверждения администратором. По итечении 24 часов, если оплата не будет произведена - баннер будет удален! (в случае успешной проверки администратором - Вам на e-mail будет отправлено соответствующее уведомление)\')) { return false; }        
       }       
       
       th.rb.disabled = true;
       $(\'#globalbodydata\').css(\'cursor\', \'wait\'); 
       return true;
	  }//DoSend
      
      function SelBannerType(eraiseitem, selid, blid) {
       
       var bunnttl = document.getElementById(selid);
       if (!bunnttl) { return false; }
       
       $(\'#\' + blid + bunnttl.value).css({visibility: \'visible\', display: \'block\'});
       
       var idath = (bunnttl.value == \'0\') ? \'1\' : \'0\';
       idath = document.getElementById(blid + idath);
       
       if (idath) {
        if (eraiseitem) {
         
         $(this).remove();   
            
        } else {  $(idath).css({visibility: \'hidden\', display: \'none\'}); } 
       }              
        
      }//SelBanType
   
      
      var priced = new Array();
      priced[0] = false;
      priced[1] = false;      
      
      '; ?>

      <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.pricetodays')): ?>
       priced[1] = <?php echo $this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.pricetodays'); ?>
;      
      <?php endif; ?>
      <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.pricetolook')): ?>
       priced[0] = <?php echo $this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.pricetolook'); ?>
;      
      <?php endif; ?>
      <?php echo '
      
      function GenerateTotalSum() {
       
       var s = \'(неизвестно)\';
       priceforgetmp = 0;
       
       var ptype = document.getElementById(\'paytype\');
       if (!ptype) { return SetTotalSt(s); }
       
       switch (ptype.value) {
        
        case \'0\':
         var fl = document.getElementById(\'forlooks\');
         if (!fl || !IisInteger(fl.value, true) || fl.value < 100) { return SetTotalSt(s); }                
         fl = priceforgetmp = (fl.value * priced[0] / 1000);      
         return SetTotalSt(fl + \' USD\');
        break;
        
        case \'1\':
         var fl = document.getElementById(\'fordays\');
         if (!fl || !IisInteger(fl.value, true) || fl.value < 1) { return SetTotalSt(s); }                 
         fl = priceforgetmp = (fl.value * priced[1]);
         return SetTotalSt(fl + \' USD\');        
        break;
        
        default: return SetTotalSt(s);        
       }        
      }//GenerateTotalSum
      
      function SetTotalSt(s) { $(\'#priceban\').html(s); return false; }
      
     </script>    
     '; ?>

     
     <form method="post" name="nbanneradd" id="nbanneradd"<?php if ($this->_tpl_vars['mybanner_obj']->GetResult('filesizedwload') !== false): ?> enctype="multipart/form-data"<?php endif; ?> onsubmit="return DoSend(this)">
      
     
     <div class="typelabel">Выберите тип баннера, который Вы хотите разместить</div>
     <div class="typelabel">
     <select size="1" style="width: 350px" name="banntype" id="banntype" onchange="SelBannerType(false, 'banntype', 'typedbyid')">
      <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.filesuse')): ?>
	  <option value="0"<?php if ($_POST['banntype'] == '0'): ?> selected="selected"<?php endif; ?>>Загрузить баннер на сайт</option>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.linksuse')): ?>
      <option value="1"<?php if ($_POST['banntype'] == '1'): ?> selected="selected"<?php endif; ?>>Использовать ссылку на файл баннера</option>
      <?php endif; ?>
     </select>
     </div>
     
     <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.filesuse')): ?>
     <div id="typedbyid0"<?php if ($_POST['banntype'] != '0'): ?> style="visibility: hidden; display: none"<?php endif; ?>>
      <div class="typelabel"><label id="red">*</label> Укажите файл баннера (форматы: <?php echo $this->_tpl_vars['CONTROL_OBJ']->GenerateArrayString($this->_tpl_vars['mybanner_obj']->GetResult('filetypeslist'),', ','"<b>','"</b>'); ?>
<?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.maxfilesize')): ?>, максимальный размер: <b><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetStrSizeFromBytes($this->_tpl_vars['mybanner_obj']->GetResult('filesizedwload')); ?>
</b>)<?php endif; ?></div>    
      <div class="typelabel">
       <input type="file" size="20" style="width: 95%; height: 22px" class="inpt" name="bfile" id="bfile">       
      </div>           
     </div>
     <?php endif; ?>
     
     
     <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.linksuse')): ?>
     <div id="typedbyid1"<?php if ($_POST['banntype'] != '1'): ?> style="visibility: hidden; display: none"<?php endif; ?>>
      <div class="typelabel"><label id="red">*</label> Укажите ссылку на файл баннера в интернете (форматы: <?php echo $this->_tpl_vars['CONTROL_OBJ']->GenerateArrayString($this->_tpl_vars['mybanner_obj']->GetResult('filetypeslist'),', ','"<b>','"</b>'); ?>
)<br />
      <div style="font-size: 95%; color: #808080">(необходимо указать ПРЯМУЮ ссылку на файл указанного типа (изображения<?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.useflash')): ?> или flash ролика<?php endif; ?>)!)</div>
      </div>    
      <div class="typelabel">
       <input type="text" class="inpt" style="width: 94%" name="blink" id="blink" maxlength="210" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('blink','doactionaddbannerex','do','http://'); ?>
">       
      </div>
      
      <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.useflash')): ?>
      <div class="typelabel">
       <input type="checkbox" <?php if ($this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('isflashobj')): ?> checked="checked" <?php endif; ?>style="cursor: pointer" name="isflashobj" id="isflashobj"><label for="isflashobj" style="cursor: pointer">&nbsp;Файл по указанной ссылке является flash роликом</label>  
      </div>
      <?php endif; ?>
                
     </div>
     <?php endif; ?>
     
     
     <div class="typelabel">
      <label id="red">*</label> Укажите адрес ссылки, на который посетитель будет переходить при нажатии на баннер<br />
      <div style="font-size: 95%; color: #808080">(указывайте полный адрес ссылки, вместе с <strong>http://</strong>)</div>
     </div>
     <div class="typelabel">
      <input type="text" class="inpt" style="width: 94%" name="hreflink" id="hreflink" maxlength="170" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('hreflink','doactionaddbannerex','do','http://'); ?>
">       
     </div>
     
     
     <div class="typelabel">
      <label id="red">*</label> Как Вы хотите показывать рекламу?<br />
      <div style="font-size: 95%; color: #808080">(указывается тип размещения баннера, на указанный срок или на указанное кол-во показов баннера. **после добавления, тип размещения изменить будет невозможно**. Цены на размещение баннера указаны в описании данного места (см. выше в описании).)</div>
     </div>
     <div class="typelabel">
      <select size="1" style="width: 350px" name="paytype" id="paytype" onchange="SelBannerType(false, 'paytype', 'paytypeidblock'); GenerateTotalSum();">
       <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.pricetolook') > 0): ?>
       <option value="0"<?php if ($_POST['paytype'] == '0'): ?> selected="selected"<?php endif; ?>>На указанное кол-во показов баннера</option>
       <?php endif; ?>
       <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.pricetodays') > 0): ?>
       <option value="1"<?php if ($_POST['paytype'] == '1'): ?> selected="selected"<?php endif; ?>>На указанное кол-во дней показов баннера</option>
       <?php endif; ?>       
      </select>
     </div> 
     
     <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.pricetolook') > 0): ?>
     <div id="paytypeidblock0"<?php if ($_POST['paytype'] != '0'): ?> style="visibility: hidden; display: none"<?php endif; ?>>     
      <div class="typelabel"><label id="red">*</label> Укажите кол-во показов, на которое Вы хотите разместить баннер<br />
      <div style="font-size: 95%; color: #808080">
       (указывайте целое числовое значение, минимальное кол-во показов - 100)
      </div>      
      </div>    
      <div class="typelabel">
       <input type="text" class="inpt" style="width: 346px" name="forlooks" id="forlooks" maxlength="210" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('forlooks','doactionaddbannerex','do','1000'); ?>
" onchange="GenerateTotalSum()" onblur="GenerateTotalSum()">       
      </div>                   
     </div>
     <?php endif; ?>
     
     <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.pricetodays') > 0): ?>
     <div id="paytypeidblock1"<?php if ($_POST['paytype'] != '1'): ?> style="visibility: hidden; display: none"<?php endif; ?>>     
      <div class="typelabel"><label id="red">*</label> Укажите кол-во дней показов, на которое Вы хотите разместить баннер<br />
      <div style="font-size: 95%; color: #808080">
       (указывайте целое числовое значение, минимальное кол-во дней показов - 1. День оплаты и начало показа баннера считается первым днем показов `Если оплата и старт показов выполняется в 23:00 - в первый день баннер будет показан только час, во второй день счетчик показов будет увеличен!`. т.е первый день считается не полным, а с момента начала показа баннера и до завершения текущего дня `до 24:00` `сейчас: <?php echo $this->_tpl_vars['mybanner_obj']->GetThisTime(); ?>
`)
      </div>      
      </div>    
      <div class="typelabel">
       <input type="text" class="inpt" style="width: 346px" name="fordays" id="fordays" maxlength="210" value="<?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPostElement('fordays','doactionaddbannerex','do','30'); ?>
" onchange="GenerateTotalSum()" onblur="GenerateTotalSum()">       
      </div>                   
     </div>
     <?php endif; ?>
     
     <div style="margin-top: 12px; background: #F0F0F0; padding: 3px">
      Сумма размещения баннера: <strong id="priceban">(неизвестно)</strong>
     </div>
     
     <input type="hidden" value="do" name="doactionaddbannerex" />     
     <div class="typelabel" style="margin-top: 12px">
      <input type="submit" value="&nbsp;Добавить баннер&nbsp;" class="button" name="rb" id="rb">
     </div>   
    
    </form>
    
    <?php if ($_POST['doactionaddbannerex'] == 'do'): ?>
     <div style="margin-top: 6px">
      <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('error')): ?>
        <div style="color: #FF0000"><?php echo $this->_tpl_vars['mybanner_obj']->GetResult('error'); ?>
</div>
      <?php else: ?>
        <div style="color: #008000">Баннер успешно добавлен!<?php if ($this->_tpl_vars['mybanner_obj']->GetResult('groupinfo.usemoder')): ?> После проверки администратором, Вы сможете оплатить размещение Вашего баннера! В случае успешной проверки, Вам на почту прийдет сообщение, информирующее Вас о активации баннера для оплаты и размещения на сайте!<?php endif; ?></div>
      <?php endif; ?>
     </div>
    <?php endif; ?>
    
    <?php echo '
    <script type="text/javascript"> 
     
     SelBannerType(false, \'banntype\', \'typedbyid\'); 
     SelBannerType(false, \'paytype\', \'paytypeidblock\');
          
     jQuery(document).ready(function() {  
      GenerateTotalSum();
     });
     
    </script>
    '; ?>

        
    
    <?php endif; ?>
   </div>   
  
  <?php endif; ?>
 <?php endif; ?> 
 </div>
 <?php else: ?>
  
  
<?php echo '
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = '; ?>
<?php if ($_GET['moderl']): ?><?php echo $this->_tpl_vars['mybanner_obj']->GetResult('icount'); ?>
<?php else: ?><?php echo $this->_tpl_vars['mybanner_obj']->GetResult('acount'); ?>
<?php endif; ?>;<?php echo '  
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
   alert(\'Выделите хотя бы один баннер!\'); return false; 
  }
  th.actioncountmess.value = count;
  if (th.actionlistmakes.value == \'delete\') {
   if (!confirm(\'Вы действительно хотите удалить [\'+count+\'] баннеров?\')) { return false; }
  } else 
  if (th.actionlistmakes.value == \'dall\') {
   if (!allsaveenabled) { alert(\'Нет данных для удаления!\'); return false; }	
   if (!confirm(\'Вы действительно хотите удалить все баннеры?\')) { return false; }	
  }
  else { alert(\'Неизвестный идентификатор операции!\'); return false; }
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
  var f = document.getElementById(\'vnewsform\');
  if (!f) { return ; }
  f.actionlistmakes.value = a;   	
 }//SetActionP   	
 function SetCheckByLine(ident) {
  var ch = $(\'#chid\'+ident);
  ch.attr(\'checked\', (ch.attr(\'checked\')) ? false : true);
  CheckItem(ident);   	
 }//SetCheckByLine
 
 var globalaccountpath = \''; ?>
<?php echo @W_SITEPATH; ?>
account/my-banners-list/<?php echo '\';
 
 function PayOneBannerItem(price, id) {
  var path = globalaccountpath + \'?moderl='; ?>
<?php echo $_GET['moderl']; ?>
<?php echo '\';
   
  if (!confirm("Вы действительно хотите оплатить стоимость размещения баннера?\\r\\nС Вашего баланса будет снята сумма в размере "+price+" USD (активация показов выбранного баннера)\\r\\nПродолжить?")) { return false; } 
    
  path = path + \'&payitem=\' + id;
  document.location = path;    
 }//PayOneBannerItem
 
 var onlineisworking = false;
 var globdatalink = \'\'; 
 var globalbannerid = 0;
 
 function AddToMyDisplays(price, id, typed) {
    
  if (onlineisworking) {
   return alert(\'В данный момент операция выполнятся! Пожалуйста, дождитесь окончания выполнения операции..\'); 
  }
    
  var s = \'\';
  var v = 0;
  
  if (typed == \'0\') {
   var r = prompt(\'Укажите кол-во показов, которое Вы хотите добавить баннеру! (каждые 1000 показов - \'+price+\' USD, минимальная ставка - 100 показов!)\', "1000");
   
   if (r == null || !r || !IisInteger(r, true) || r < 100) {
    if (r === null) { return false; }
    return alert(\'Необходимо указать числовое значение кол-ва показов не меньше 100!\');
   }  
   
   v = (price * r / 1000);
   s = r + \' показов\';
   
  } else {
    
   var r = prompt(\'Укажите кол-во дней показов, которое Вы хотите добавить баннеру! (каждый 1 день показов - \'+price+\' USD, минимальная ставка - 1 день показов!)\', "30");
   
   if (r == null || !r || !IisInteger(r, true) || r < 1) {
    if (r === null) { return false; }
    return alert(\'Необходимо указать числовое значение кол-ва дней показов не меньше 1!\');
   }
   
   v = (price * r);
   s = r + \' дней показов\';    
    
  }
  
  //ok send info
  if (!confirm(\'Вы действительно хотите продлить показ баннера на [\'+s+\']? С Вашего баланса будет снята сумма, в размере [\'+v+\' USD]\'+"\\r\\nПродолжить?")) { return false; }
    
    
  onlineisworking = true;
  globalbannerid = id;
  globdatalink = $(\'#addtodisplaybanner\'+id).html();
  
  $(\'#addtodisplaybanner\'+id).html(
   \'<label style="color: #0000FF; font-size: 95%">Выполняется, пожалуйста, подождите..</label>\'
  );
  
  SendDefaultRequest(
   globalaccountpath, \'is_ajax_mode=1&type=\'+typed+\'&pt=1&id=\'+id+\'&value=\'+r, \'PrepereRequestAddData\'
  );
  
  //addtodisplaybanner  link
  //totalcount  total 
    
 }
 
 function PrepereRequestAddData(data) {
  $(\'#addtodisplaybanner\'+globalbannerid).html(globdatalink);  
  
  onlineisworking = false;
  if (data == \'\') { return false; }
  
  if (!IisInteger(data, true)) { return alert(data); }
  
  $(\'#totalcount\'+globalbannerid).html(data);
  
  return alert(\'Срок размещения успешно продлен!\');    
    
 }//PrepereRequestData
 
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
  <input type="submit" value="&nbsp;Удалить все баннеры&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 200px;">
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
	<td class="h_td" valign="center" align="left"><span style="margin-left: 3px">Баннер</span></td>
	<td class="h_td2" valign="center" align="center" width="130px">Создан</td>
   </tr>	
   <?php echo '
   <style type="text/css">
	.llw { display: inline-block; margin-left: 8px; vertical-align: baseline; padding-left: 20px; }
   </style>
   '; ?>

   <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('datalist')): ?>
	<?php $_from = $this->_tpl_vars['mybanner_obj']->GetResult('datalist'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
	 <tr onmouseover="DoHigl(this, 1, <?php echo ($this->_foreach['val']['iteration']-1); ?>
)" onmouseout="DoHigl(this, 0, <?php echo ($this->_foreach['val']['iteration']-1); ?>
)" id="t_r_<?php echo ($this->_foreach['val']['iteration']-1); ?>
">
     <td class="sth1" valign="center" align="left" width="20px" 
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8<?php if (! $this->_tpl_vars['val']['activeobj']): ?>; background: #F7DCDC<?php endif; ?>">
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
      <div style="padding-right: 3px">
              <?php if ($this->_tpl_vars['val']['isflashobj']): ?>      
       <div id="flsource<?php echo $this->_tpl_vars['val']['iditem']; ?>
">    
        <object  classid="clsid27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="<?php echo $this->_tpl_vars['val']['widthobj']; ?>
<?php if ($this->_tpl_vars['val']['groupinfo']['widthpersent']): ?>%<?php endif; ?>" height="<?php echo $this->_tpl_vars['val']['heightobj']; ?>
<?php if ($this->_tpl_vars['val']['groupinfo']['heightpersent']): ?>%<?php endif; ?>" id="refbunner<?php echo $this->_tpl_vars['val']['iditem']; ?>
" align="middle">
         <param name="allowScriptAccess" value="always" />
         <param name="allowFullScreen" value="false" />
         <param name="movie" value="<?php echo $this->_tpl_vars['val']['webimagefile']; ?>
" />
         <param name="quality" value="high" />
         <embed src="<?php echo $this->_tpl_vars['val']['webimagefile']; ?>
" quality="high" bgcolor="#ffffff" width="100%" height="<?php echo $this->_tpl_vars['val']['heightobj']; ?>
<?php if ($this->_tpl_vars['val']['groupinfo']['heightpersent']): ?>%<?php endif; ?>" name="refbunner<?php echo $this->_tpl_vars['val']['iditem']; ?>
" id="refbunner<?php echo $this->_tpl_vars['val']['iditem']; ?>
" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer"/>
        </object>
       </div>
       <?php else: ?>     
       <img src="<?php echo $this->_tpl_vars['val']['webimagefile']; ?>
" border="0" alt="Banner" width="<?php echo $this->_tpl_vars['val']['widthobj']; ?>
<?php if ($this->_tpl_vars['val']['groupinfo']['widthpersent']): ?>%<?php endif; ?>" height="<?php echo $this->_tpl_vars['val']['heightobj']; ?>
<?php if ($this->_tpl_vars['val']['groupinfo']['heightpersent']): ?>%<?php endif; ?>" />       	  
       <?php endif; ?>       
      </div>
      
      <div style="margin-top: 4px">
      <span style="width: 100%">            
       <table width="100%" cellpadding="0" cellspacing="0" border="0">	        

         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Ссылка	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       <a href="<?php echo $this->_tpl_vars['val']['hrefdata']; ?>
" target="_blank"><?php echo $this->_tpl_vars['val']['hrefdata']; ?>
</a>
	      </td>
	     </tr>
                     
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Показов	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       всего: <?php echo $this->_tpl_vars['val']['lookcount']; ?>
<?php if ($this->_tpl_vars['val']['setbytype'] == 0): ?> из <?php echo $this->_tpl_vars['val']['forlooks']; ?>
<?php endif; ?>, сегодня: <?php echo $this->_tpl_vars['val']['looktoday']; ?>

	      </td>
	     </tr>
                  <?php if ($this->_tpl_vars['val']['setbytype'] == 1): ?>
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Показан дней	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       <?php echo $this->_tpl_vars['val']['lookdcount']; ?>
 из <?php echo $this->_tpl_vars['val']['fordays']; ?>

	      </td>
	     </tr>  
         
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Осталось дней	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       <label id="totalcount<?php echo $this->_tpl_vars['val']['iditem']; ?>
"><?php echo smarty_function_math(array('equation' => "x - y",'x' => $this->_tpl_vars['val']['fordays'],'y' => $this->_tpl_vars['val']['lookdcount']), $this);?>
</label>
           
           <?php if ($this->_tpl_vars['val']['activeobj'] && $this->_tpl_vars['val']['ispayed']): ?>
            <label id="addtodisplaybanner<?php echo $this->_tpl_vars['val']['iditem']; ?>
" style="margin-left: 4px">
             <a href="javascript:" style="font-size: 95%" onclick="AddToMyDisplays('<?php echo $this->_tpl_vars['val']['groupinfo']['pricetodays']; ?>
', '<?php echo $this->_tpl_vars['val']['iditem']; ?>
', '1')">продлить</a>           
            </label>        
           <?php endif; ?>           
	      </td>
	     </tr>   
                      
         <?php elseif ($this->_tpl_vars['val']['setbytype'] == 0): ?>
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Осталось показов	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       <label id="totalcount<?php echo $this->_tpl_vars['val']['iditem']; ?>
"><?php echo smarty_function_math(array('equation' => "x - y",'x' => $this->_tpl_vars['val']['forlooks'],'y' => $this->_tpl_vars['val']['lookcount']), $this);?>
</label>
           
           <?php if ($this->_tpl_vars['val']['activeobj'] && $this->_tpl_vars['val']['ispayed']): ?>
            <label id="addtodisplaybanner<?php echo $this->_tpl_vars['val']['iditem']; ?>
" style="margin-left: 4px">
             <a href="javascript:" style="font-size: 95%" onclick="AddToMyDisplays('<?php echo $this->_tpl_vars['val']['groupinfo']['pricetolook']; ?>
', '<?php echo $this->_tpl_vars['val']['iditem']; ?>
', '0')">продлить</a>           
            </label>        
           <?php endif; ?>            
	      </td>
	     </tr>                
         <?php endif; ?>
         
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Место размещения	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       <?php echo $this->_tpl_vars['val']['groupinfo']['groupname']; ?>

	      </td>
	     </tr>
         
         <?php if ($this->_tpl_vars['val']['sizeobj']): ?>
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Размер файла баннера	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetStrSizeFromBytes($this->_tpl_vars['val']['sizeobj']); ?>

	      </td>
	     </tr>         
         <?php endif; ?>         
         
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" <?php if (! $this->_tpl_vars['val']['groupinfo']['clearonoffbun'] || ! $this->_tpl_vars['val']['forpayislast']): ?>height="22px"<?php else: ?>class="line_item"<?php endif; ?>>
           Статус	           
          </td>
	      <td valign="center" align="left" <?php if (! $this->_tpl_vars['val']['groupinfo']['clearonoffbun'] || ! $this->_tpl_vars['val']['forpayislast']): ?>height="22px"<?php else: ?>class="line_item"<?php endif; ?>>
	       <?php if (! $this->_tpl_vars['val']['activeobj']): ?>
           <em style="color: #993300">Ожидает проверки администратором</em>
           <?php elseif (! $this->_tpl_vars['val']['ispayed']): ?>
           <em style="color: #333399">Ожидает оплаты</em>
           <label style="margin-left: 4px; font-size: 95%"><a style="margin-right: 3px" href="javascript:" onclick="PayOneBannerItem('<?php echo $this->_tpl_vars['val']['pricetopay']; ?>
', '<?php echo $this->_tpl_vars['val']['iditem']; ?>
')"><strong>оплатить<?php if ($this->_tpl_vars['val']['pricetopay']): ?> <?php echo $this->_tpl_vars['val']['pricetopay']; ?>
 USD на <?php if ($this->_tpl_vars['val']['setbytype'] == 0): ?><?php echo $this->_tpl_vars['val']['forlooks']; ?>
 показов<?php else: ?><?php echo $this->_tpl_vars['val']['fordays']; ?>
 дней<?php endif; ?>
           <?php endif; ?></strong></a></label>
           <?php else: ?>
           <em style="color: #0000FF">Оплачен, показ баннера активен</em>
           <?php endif; ?>
	      </td>
	     </tr>
         
         <?php if ($this->_tpl_vars['val']['groupinfo']['clearonoffbun'] && $this->_tpl_vars['val']['forpayislast']): ?>
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" height="22px">
           Срок на оплату	           
          </td>
	      <td valign="center" align="left" height="22px">
	       <?php echo $this->_tpl_vars['val']['forpayislast']; ?>

	      </td>
	     </tr>        
         <?php endif; ?>


	   </table>                  
      </span>
      </div>
      
      <!-- <div style="height: 6px; display: block"></div> -->	  	 
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
    <td valign="center" align="center" class="btn_n" colspan="3">
     Нет баннеров!
     <script type="text/javascript">
	  document.getElementById('checkallitems').disabled = true;
     </script>
    </td>
   </tr> 
   <?php endif; ?> 
 </table> 
 </span>
 </div> 
 <input type="hidden" value="0" name="actioncountmess">
 <input type="hidden" value="none" name="actionlistmakes"> 
</form>
 <script type="text/javascript">
 SetEnabled();
 <?php if ($this->_tpl_vars['mybanner_obj']->GetResult('payerror')): ?>
  alert('<?php echo $this->_tpl_vars['mybanner_obj']->GetResult('payerror'); ?>
');
 <?php endif; ?>   
 </script>
 
 <?php endif; ?>
<?php endif; ?>