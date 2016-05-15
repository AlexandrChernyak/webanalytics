<?php /* Smarty version 2.6.26, created on 2013-11-14 14:41:34
         compiled from advertisingt.tpl */ ?>

<div><strong>Мы предлагаем Вам разместить Вашу рекламу у нас на сайте!</strong></div>
<div>Вы можете воспользоваться следующими вариантами размещения рекламы у нас:</div>
<div style="margin-top: 14px">
 
 <div style="margin-bottom: 15px; background: #F0F0F0; padding: 3px">
 <strong>1. Размещение ссылки на `Витрину ссылок`</strong>
 </div>
 <div style="padding-left: 3px">
 <div>Разместить ссылку Вы можете <a href="<?php echo @W_SITEPATH; ?>
vitrinalinks/new=1">здесь</a> (для размещения ссылки необходима регистрация)</div>
 <div>На Ваше усмотрение - ссылка может быть индексируемой или нет, `жирной` (&lsaquo;b&rsaquo;) или `обычной`. Витрина ссылок отображается на ВСЕХ страницах сайта.</div>
 </div>
 
 <?php if ($this->_tpl_vars['adv_object']->GetPlaceList()): ?>
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
 </script>
 '; ?>

  
 <div style="margin-bottom: 15px; margin-top: 30px; background: #F0F0F0; padding: 3px">
 <strong>2. Размещение Вашего баннера на нашем сайте</strong>
 </div> 
 <div style="padding-left: 3px"> 
  <div>
   <div>Вы можете выбрать наиболее подходящее место (или несколько мест) для размещения баннера(ов) из указанных ниже.</div>
   <div>Для добавления баннера Вам необходимо зарегистрироваться. Добавить баннер Вы можете в личном кабинете, в разделе `<a href="<?php echo @W_SITEPATH; ?>
account/my-banners-list/" target="_blank">Мои баннеры</a>`</div>
  </div>
  <div style="margin-top: 10px">
  
  <?php $_from = $this->_tpl_vars['adv_object']->GetPlaceList(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
    <div style="margin: 4px; margin-left: 0; margin-top: 15px; padding: 4px; border: 1px solid #D2D2D2">
	 <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
       <tr>
       
        <td valign="top" align="left" width="50px" style="padding-right: 4px">
		 <img src="<?php echo @W_SITEPATH; ?>
img/ico/general/places_visited.png" border="0">
		</td>	
		
	    <td valign="top" align="left">
		 <div><strong><?php echo $this->_tpl_vars['val']['groupname']; ?>
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
	          <?php if ($this->_tpl_vars['val']['filesuse']): ?>
               <label style="color: #008000">Да</label>
              <?php else: ?>
               <em>(нет)</em>
              <?php endif; ?>
	         </td>
	        </tr>
            
            <?php if ($this->_tpl_vars['val']['filesuse']): ?>
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="150px" class="line_item">
              Максимальный размер	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          <?php echo $this->_tpl_vars['adv_object']->GetMaxSize($this->_tpl_vars['val']); ?>

	         </td>
	        </tr>           
            <?php endif; ?>
            
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
  
  </div>
 </div>
 <?php endif; ?>
</div>