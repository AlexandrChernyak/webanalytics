<?php /* Smarty version 2.6.26, created on 2013-11-14 13:59:02
         compiled from adm_account/adm_admmain.tpl */ ?>
<div style="margin-top: 4px">
 <?php echo '
 <script type="text/javascript">
  function PrepereToSendItem(th) {
   if (!confirm(\'Вы действительно хотите выполнить выбранную операцию?\')) { return false; }	
   $(\'#globalbodydata\').css(\'cursor\', \'wait\');
   th.rb.disabled = true;
   return true;	
  }//PrepereToSendItem	
 </script>
 '; ?>


 <div style="border-bottom: 1px solid #C0C0C0; padding-bottom: 4px; margin-top: 18px"><b>Информация проекта</b></div>
 <div style="margin-top: 4px">
  <span style="width: 100%">
   <table width="100%" cellpadding="0" cellspacing="0" border="0">
    
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Версия проекта	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 <strong>v 2.0 (wm-scripts edition)</strong>     
	</td>
   </tr>
   
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Дата сборки	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 <strong>14.11.2013</strong>     
	</td>
   </tr>
   
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Инструментов	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 <strong><?php echo $this->_tpl_vars['adm_object']->GetResult('eiC'); ?>
</strong>     
	</td>
   </tr> 
        
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Оригинал проекта, информация	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 <a href="http://wm-scripts.ru" target="_blank">pr-cy.wm-scripts.ru</a>     
	</td>
   </tr>       
    
   </table>
  </span> 
 </div>
 
  
 <div style="border-bottom: 1px solid #C0C0C0; padding-bottom: 4px; margin-top: 18px"><b>Кэш</b>  (<?php echo $this->_tpl_vars['adm_object']->GetResult('allcachsize'); ?>
)</div>
 <div style="margin-top: 4px">
  <form method="post" name="c1" id="c1" onsubmit="return PrepereToSendItem(this)">
   <div>
    Кэш средних данных (числовые значения и прочее..) - <b><?php echo $this->_tpl_vars['adm_object']->GetResult('sizesortcach'); ?>
</b>
    <span style="margin-left: 6px">
	 <input type="submit" value="&nbsp;Очистить&nbsp;" name="rb" id="rb" class="button">
	</span>
   </div>
   <input type="hidden" value="do" name="c1tableclear">
  </form>  
 </div>
 
 <div style="margin-top: 6px">
  <form method="post" name="c2" id="c2" onsubmit="return PrepereToSendItem(this)">
   <div>
    Кэш больших данных (строки, блоки и т.д) - <b><?php echo $this->_tpl_vars['adm_object']->GetResult('sizelongcach'); ?>
</b>
    <span style="margin-left: 6px">
	 <input type="submit" value="&nbsp;Очистить&nbsp;" name="rb" id="rb" class="button">
	</span>
   </div>
   <input type="hidden" value="do" name="c2tableclear">
  </form>  
 </div>
 
 <div style="margin-top: 6px">
  <form method="post" name="c2" id="c2" onsubmit="return PrepereToSendItem(this)">
   <div>
    Вся история показателей сайтов - <b><?php echo $this->_tpl_vars['adm_object']->GetResult('sizehistory'); ?>
</b>
    <span style="margin-left: 6px">
	 <input type="submit" value="&nbsp;Очистить&nbsp;" name="rb" id="rb" class="button">
	</span>
   </div>
   <input type="hidden" value="do" name="c3tableclear">
  </form>  
 </div> 
 
 <div style="margin-top: 6px">
  <form method="post" name="c2" id="c2" onsubmit="return PrepereToSendItem(this)">
   <div>
    <div>Очистить указанный кэш:</div>
    <div style="margin-top: 2px">    
     <select size="1" name="getcach">
	  <?php $_from = $this->_tpl_vars['adm_object']->GetCachSpecialFormatList(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['plname'] => $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
       <option value="<?php echo $this->_tpl_vars['val']; ?>
"<?php if ($_POST['getcach'] == $this->_tpl_vars['val']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['val']; ?>
</option>      
      <?php endforeach; endif; unset($_from); ?>
     </select>    
     <span style="margin-left: 6px">
	  <input type="submit" value="&nbsp;Очистить&nbsp;" name="rb" id="rb" class="button">
	 </span>
    </div> 
   </div>
   <input type="hidden" value="do" name="c4tableclearSpec">
  </form>  
 </div>
 
 <div style="border-bottom: 1px solid #C0C0C0; padding-bottom: 4px; margin-top: 18px"><b>xml api</b></div>
 <div style="margin-top: 4px">
 <?php $_from = $this->_tpl_vars['adm_object']->GetResult('xmlsettings.apitypes'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['ident'] => $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
  <div style="margin-top: 6px">
   <div><strong><?php echo $this->_tpl_vars['val']['name']; ?>
</strong></div>
   <div style="margin-top: 10px; margin-left: 7px">
   <span style="width: 100%">
   <table width="100%" cellpadding="0" cellspacing="0" border="0">
   
   <?php $this->assign('apiinformationdataall', $this->_tpl_vars['adm_object']->GetApiInformationAll($this->_tpl_vars['val']['id'])); ?>
   
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Статус:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 <?php if ($this->_tpl_vars['val']['enabled'] && $this->_tpl_vars['adm_object']->GetResult('xmlsettings.enabled')): ?>
     <label style="color: #008000">активен</label>
     <?php else: ?>
     <label style="color: #FF0000">недоступен</label>
     <?php endif; ?>     
	</td>
   </tr>
   
   <?php if ($this->_tpl_vars['val']['descriptionid']): ?>
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Описание:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetText($this->_tpl_vars['val']['descriptionid']); ?>
     
	</td>
   </tr>
   <?php endif; ?>
   
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Тип api:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 <?php echo $this->_tpl_vars['ident']; ?>
     
	</td>
   </tr>   
   
   <?php if ($this->_tpl_vars['val']['price']['count'] && ! $this->_tpl_vars['CONTROL_OBJ']->CheckPrivateApiUser($this->_tpl_vars['val']['private'])): ?>
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Цена за <?php echo $this->_tpl_vars['val']['price']['count']; ?>
 запросов:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 <?php if ($this->_tpl_vars['val']['price']['value']): ?>
      <?php echo $this->_tpl_vars['val']['price']['value']; ?>
 USD
     <?php else: ?>
     <em>(не используется)</em>
     <?php endif; ?>     
	</td>
   </tr>  

   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Запросов бесплатно (сутки):	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 <?php if ($this->_tpl_vars['val']['price']['freecount']): ?>
      <?php echo $this->_tpl_vars['val']['price']['freecount']; ?>

     <?php elseif ($this->_tpl_vars['val']['price']['value']): ?>
      <em>(нет)</em>
     <?php else: ?>
      <em>(неограничено)</em>
     <?php endif; ?>     
	</td>
   </tr>
   <?php endif; ?>
   
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Запросов всего:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 <?php echo $this->_tpl_vars['apiinformationdataall']['reqcount']; ?>
     
	</td>
   </tr>
  
   <tr>
	<td valign="center" align="left" height="22px" width="230px" class="named_space" style="border-bottom: 1px solid #F0F0F0">
	 Запросов сегодня:	 
	</td>
	<td valign="center" align="left" height="22px" style="border-bottom: 1px solid #F0F0F0">
	 <?php echo $this->_tpl_vars['apiinformationdataall']['nowcount']; ?>
     
	</td>
   </tr>      
  
   </table>
   </span>
   </div>
  </div>
 <?php endforeach; endif; unset($_from); ?>
 </div>
 
</div>