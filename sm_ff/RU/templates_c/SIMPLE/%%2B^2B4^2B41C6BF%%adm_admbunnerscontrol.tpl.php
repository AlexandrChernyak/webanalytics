<?php /* Smarty version 2.6.26, created on 2016-05-15 09:18:51
         compiled from adm_account/adm_admbunnerscontrol.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'adm_account/adm_admbunnerscontrol.tpl', 262, false),)), $this); ?>

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


<?php if ($_GET['group']): ?>
 
 <div style="margin: 7px 1px 12px 1px">
 <a<?php if (! $_GET['new']): ?> style="color: #000000"<?php endif; ?> href="<?php echo @W_SITEPATH; ?>
account/admbunnerscontrol/?group=<?php echo $_GET['group']; ?>
<?php if ($_GET['oldpage']): ?>&page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?><?php if ($_GET['grouppage']): ?>&grouppage=<?php echo $_GET['grouppage']; ?>
<?php endif; ?>&shorttype=<?php echo $_GET['shorttype']; ?>
">Все баннеры блока (<label style="color: #000000"><?php echo $this->_tpl_vars['adm_object']->GetResult('bcount'); ?>
</label>)</a> 
 
 <label style="padding-left: 10px"><a href="<?php echo @W_SITEPATH; ?>
account/admbunnerscontrol/<?php if ($_GET['grouppage']): ?>?page=<?php echo $_GET['grouppage']; ?>
<?php endif; ?>"> << Вернуться к местам (блокам) (<label style="color: #000000"><?php echo $this->_tpl_vars['adm_object']->GetResult('gcount'); ?>
</label>)</a></label>
 
 <label style="padding-left: 10px">
  Статусы: <a title="Все статусы баннеров" href="<?php echo @W_SITEPATH; ?>
account/admbunnerscontrol/?group=<?php echo $_GET['group']; ?>
<?php if ($_GET['oldpage']): ?>&page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?><?php if ($_GET['grouppage']): ?>&grouppage=<?php echo $_GET['grouppage']; ?>
<?php endif; ?><?php if ($_GET['onlyuser']): ?>&onlyuser=<?php echo $_GET['onlyuser']; ?>
<?php endif; ?>">Все</a>, 
  <a title="Активные баннеры" href="<?php echo @W_SITEPATH; ?>
account/admbunnerscontrol/?group=<?php echo $_GET['group']; ?>
<?php if ($_GET['oldpage']): ?>&page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?><?php if ($_GET['grouppage']): ?>&grouppage=<?php echo $_GET['grouppage']; ?>
<?php endif; ?>&shorttype=1<?php if ($_GET['onlyuser']): ?>&onlyuser=<?php echo $_GET['onlyuser']; ?>
<?php endif; ?>" style="background: #D5F0DF;">OK</a>,
  <a title="Ожидающие проверки администратором" href="<?php echo @W_SITEPATH; ?>
account/admbunnerscontrol/?group=<?php echo $_GET['group']; ?>
<?php if ($_GET['oldpage']): ?>&page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?><?php if ($_GET['grouppage']): ?>&grouppage=<?php echo $_GET['grouppage']; ?>
<?php endif; ?>&shorttype=2<?php if ($_GET['onlyuser']): ?>&onlyuser=<?php echo $_GET['onlyuser']; ?>
<?php endif; ?>" style="background: #F7DCDC;">CHECK</a>, 
  <a title="Ожидающие оплаты" href="<?php echo @W_SITEPATH; ?>
account/admbunnerscontrol/?group=<?php echo $_GET['group']; ?>
<?php if ($_GET['oldpage']): ?>&page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?><?php if ($_GET['grouppage']): ?>&grouppage=<?php echo $_GET['grouppage']; ?>
<?php endif; ?>&shorttype=3<?php if ($_GET['onlyuser']): ?>&onlyuser=<?php echo $_GET['onlyuser']; ?>
<?php endif; ?>" style="background: #E8E5C2;">WAIT</a>,  
 </label>
   
 </div>
  
  
<?php echo '
<script type="text/javascript">
 var list_items = new Array(); 
 var allsaveenabled = '; ?>
<?php if (! $this->_tpl_vars['adm_object']->GetResult('bcount')): ?>0<?php else: ?>1<?php endif; ?>;<?php echo '  
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
  if (th.actionlistmakes.value == \'enabled\') {
   if (!confirm(\'Вы действительно хотите подтвердить [\'+count+\'] баннеров?\')) { return false; }
  } else
  if (th.actionlistmakes.value == \'disabled\') {
   if (!confirm(\'Вы действительно хотите отменить подтверждение [\'+count+\'] баннеров?\')) { return false; }
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
   setElementOpacity(document.getElementById(\'ena\'), 0.3);
   setElementOpacity(document.getElementById(\'dna\'), 0.3);
   return ;	 
  }
  setElementOpacity(document.getElementById(\'did\'), 1);
  setElementOpacity(document.getElementById(\'ena\'), 1);
  setElementOpacity(document.getElementById(\'dna\'), 1);
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
  <input type="submit" value="&nbsp;Удалить все баннеры&nbsp;" class="deletemessbut" name="adid" id="adid" onclick="SetActionP('dall')" style="//width: 200px;">
 </span>
 
 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Подтвердить&nbsp;" class="activatelistit" name="ena" id="ena" onclick="SetActionP('enabled')" style="//width: 80px;">
 </span>

 <span style="margin-left: 8px">
  <input type="submit" value="&nbsp;Отмена подтверждения&nbsp;" class="deactivatelistit" name="dna" id="dna" onclick="SetActionP('disabled')" style="//width: 100px;">
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
	<td class="h_td2" valign="center" align="center" width="130px">Дата</td>
   </tr>	
   <?php echo '
   <style type="text/css">
	.llw { display: inline-block; margin-left: 8px; vertical-align: baseline; padding-left: 20px; }
   </style>
   '; ?>

   <?php if ($this->_tpl_vars['adm_object']->GetResult('data.source') && $this->_tpl_vars['adm_object']->GetResult('group')): ?>
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
	 style="border-left: 1px solid #E3E4E8; border-right: 1px solid #E3E4E8; background: <?php if (! $this->_tpl_vars['val']['activeobj']): ?>#F7DCDC<?php elseif (! $this->_tpl_vars['val']['ispayed']): ?>#E8E5C2<?php else: ?>#D5F0DF<?php endif; ?>">
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
           Разместил	           
          </td>
	      <td valign="center" align="left" class="line_item">
	      <a target="_blank" href="<?php echo @W_SITEPATH; ?>
account/admuserslisten/&filter1=9&lcstr=<?php echo $this->_tpl_vars['val']['username']; ?>
"><?php echo $this->_tpl_vars['val']['username']; ?>
</a><?php if ($_GET['onlyuser'] != $this->_tpl_vars['val']['userid']): ?>, <a href="<?php echo @W_SITEPATH; ?>
account/admbunnerscontrol/?group=<?php echo $this->_tpl_vars['val']['groupid']; ?>
&onlyuser=<?php echo $this->_tpl_vars['val']['userid']; ?>
&shorttype=<?php echo $_GET['shorttype']; ?>
" style="font-size: 95%; margin-left: 4px">все баннеры пользователя</a><?php endif; ?>
	      </td>
	     </tr>
                     
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Показов	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       всего: <?php echo $this->_tpl_vars['val']['lookcount']; ?>
, сегодня: <?php echo $this->_tpl_vars['val']['looktoday']; ?>

	      </td>
	     </tr>
         
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Кликов по баннеру	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       всего: <?php echo $this->_tpl_vars['val']['visitcount']; ?>
, сегодня: <?php echo $this->_tpl_vars['val']['visittoday']; ?>

	      </td>
	     </tr>
                  <?php if ($this->_tpl_vars['val']['setbytype'] == 1): ?>
         <tr onmouseover="DoHigl4(this, 1)" onmouseout="DoHigl4(this, 0)">
	      <td valign="center" align="left" width="150px" class="line_item">
           Показан дней	           
          </td>
	      <td valign="center" align="left" class="line_item">
	       <?php echo $this->_tpl_vars['val']['lookdcount']; ?>

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
	      </td>
	     </tr>                
         <?php endif; ?>
         
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
     На этом месте нет баннеров!
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
  <div style="margin: 7px 1px 12px 1px">
 <a href="<?php echo @W_SITEPATH; ?>
account/admbunnerscontrol/?new=1<?php if ($_GET['page']): ?>&oldpage=<?php echo $_GET['page']; ?>
<?php endif; ?>"<?php if ($_GET['new'] && ! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?> style="color: #000000"<?php endif; ?>>Добавить место</a> | <a<?php if (! $_GET['new']): ?> style="color: #000000"<?php endif; ?> href="<?php echo @W_SITEPATH; ?>
account/admbunnerscontrol/<?php if ($_GET['oldpage']): ?>?page=<?php echo $_GET['oldpage']; ?>
<?php endif; ?>">Все места баннеров (<label style="color: #000000"><?php echo $this->_tpl_vars['adm_object']->GetResult('gcount'); ?>
</label>)</a>   
 </div>
 
 <?php if (! $_GET['new']): ?>
    
  <?php if (! $this->_tpl_vars['adm_object']->GetResult('data.source')): ?>
   <div style="text-align: center; padding: 6px; margin-top: 25px"><b>Нет активных мест!</b></div>
  <?php else: ?>
   <?php echo '
    <script type="text/javascript">
	 function DeleteSelectedElementSection(ident) {
	  if (!confirm("Вы действительно хотите удалить выбранное место? Все баннеры, размещенные в данном месте будет удалены!\\r\\nПродолжить?")) {
	   return false;	
	  }	
	  var ppf = '; ?>
'<?php echo @W_SITEPATH; ?>
account/admbunnerscontrol/<?php if ($_GET['page']): ?>?page=<?php echo $_GET['page']; ?>
<?php endif; ?>'<?php echo ';  
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
		 <img src="<?php echo @W_SITEPATH; ?>
img/ico/general/places_visited.png" border="0">
		</td>	
		
	    <td valign="top" align="left">
		 <div><a title="Просмотр баннеров блока" href="<?php echo @W_SITEPATH; ?>
account/admbunnerscontrol/?group=<?php echo $this->_tpl_vars['val']['iditem']; ?>
<?php if ($_GET['page']): ?>&grouppage=<?php echo $_GET['page']; ?>
<?php endif; ?>"><strong><?php echo $this->_tpl_vars['val']['groupname']; ?>
</strong></a><label style="margin-left: 6px; font-size: 95%; color: #333399"><i>(баннеров: <?php echo $this->_tpl_vars['adm_object']->GetBunnersCount($this->_tpl_vars['val']['iditem']); ?>
)</i></label></div>
		 <div style="margin-top: 4px;">
		  
          <div>
          <span style="width: 100%">
           <table width="100%" cellpadding="0" cellspacing="0" border="0">
	        <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              Статус	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          <?php if ($this->_tpl_vars['val']['groupactive']): ?>
               <label style="color: #0000FF">Работает</label>
              <?php else: ?>
               <em>(не работает)</em>
              <?php endif; ?>
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              Файлы баннеров	           
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
	         <td valign="center" align="left" width="140px" class="line_item">
              Ссылки баннеров	           
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
	         <td valign="center" align="left" width="140px" class="line_item">
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
	         <td valign="center" align="left" width="140px" class="line_item">
              Модерация баннеров	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          <?php if ($this->_tpl_vars['val']['usemoder']): ?>
               <label style="color: #008000">Да</label>
              <?php else: ?>
               <em>(нет)</em>
              <?php endif; ?>
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              Размеры	           
             </td>
	         <td valign="center" align="left" class="line_item">
	          Ширина: <?php echo $this->_tpl_vars['val']['groupwidth']; ?>
<?php if ($this->_tpl_vars['val']['widthpersent']): ?>%<?php else: ?>px<?php endif; ?>, Высота: <?php echo $this->_tpl_vars['val']['groupheight']; ?>
<?php if ($this->_tpl_vars['val']['heightpersent']): ?>%<?php else: ?>px<?php endif; ?>
	         </td>
	        </tr>
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              За 1000 показов	           
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
            
            <tr onmouseover="DoHigl3(this, 1)" onmouseout="DoHigl3(this, 0)">
	         <td valign="center" align="left" width="140px" class="line_item">
              За 1 день показов	           
             </td>
	         <td valign="center" align="left" class="line_item">
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
          <div style="margin-top: 10px">
          <div style="color: #646464">Для вывода баннеров используйте код:</div>
          <textarea style="width: 95%; height: 100px; background: transparent; border: 1px solid transparent" readonly="readonly">Если необходимо вывести в нужном месте шаблона место баннеров, используйте конструкцию:

<?php echo '{$CONTROL_OBJ->GetBannerPlaceByID('; ?>
<?php echo $this->_tpl_vars['val']['iditem']; ?>
<?php echo ')}'; ?>


----------------------
Для того, чтобы проверить - будет ли место баннеров отображаться или нет, используйте конструкцию типа:

<?php echo '{assign var="bannerplacetemplate" value=$CONTROL_OBJ->GetBannerPlaceByID('; ?>
<?php echo $this->_tpl_vars['val']['iditem']; ?>
<?php echo ')}
{if $bannerplacetemplate}
 {* показываем место баннеров *}
 {$bannerplacetemplate}
{else}
 {* в данной группе нет баннеров, или группы не существует - место не будет отображаться..
    вместо места баннеров можно вывести например предложение добавить баннер и т.д
 *}
{/if}'; ?>
</textarea>
          
          
          </div>
                   
		 </div>
		</td>
		
	    <td valign="top" align="right">
		 <div style="white-space: nowrap;">		 
		 
		 <a href="<?php echo @W_SITEPATH; ?>
account/admbunnerscontrol/?modify=<?php echo $this->_tpl_vars['val']['iditem']; ?>
&new=1<?php if ($_GET['page']): ?>&oldpage=<?php echo $_GET['page']; ?>
<?php endif; ?>" title="Изменить"><img src="<?php echo @W_SITEPATH; ?>
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
 
 <?php else: ?>
    
<?php echo '
 <script type="text/javascript">         
    function PrepereSend(th) {
	 
	 if (!th.groupname.value) {
	  alert(\'Укажите название места!\');
	  th.groupname.focus();
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
     document.getElementById(\'addgroupitem\').actionnewprvmail.value = (n) ? \'act\' : \'prev\';	
    }//SetActionIdent	
 </script>
 '; ?>

 
 
 <form method="post" name="addgroupitem" id="addgroupitem" onsubmit="return PrepereSend(this)">
   
   <?php if ($this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>
   <div style="margin-top: 15px; margin-bottom: 15px; background: #F0F0F0; padding: 3px"><b>Настройка места баннеров</b></div>   
   <?php else: ?>
   <div class="typelabel" style="margin-top: 12px; margin-bottom: 12px; background: #F0F0F0; padding: 3px">
    <b>Общие параметры места</b>
   </div>   
   <?php endif; ?>   
    
   <div class="typelabel"><label id="red">*</label> Название места (до 150 символов)<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (отображается для посетителей, определяет наименование места, где будут отображаться баннеры, например: `В шапке сайта`)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 94%" name="groupname" id="groupname" maxlength="120" value="<?php echo $this->_tpl_vars['adm_object']->GetAsElementP('groupname'); ?>
">
   </div>
     
   <?php if ($_POST['actionnewprvmail'] == 'prev'): ?>
   <div style="padding: 4px; border: 1px solid #666699; margin-bottom: 20px; margin-top: 10px; width: 94%;">
   <?php echo $this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextFromDB($this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextToDB($_POST['groupdescr'])); ?>
  
   </div>
   <?php endif; ?> 
   
   <div class="typelabel">Описание места<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (отображается для посетителей, определяет описание места, где будут отображаться баннеры. Желательно также предоставлять скриншоты того, как будет выглядеть баннер там, где размещается данное место.)
   </div>
   </div>
   <div class="typelabel">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'new_message.tpl', 'smarty_include_vars' => array('ident' => 'groupdescr','source' => $_POST['groupdescr'],'height' => '90px','width' => '95%')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   </div>
   
   <div class="typelabel" style="margin-top: 15px">
    <input type="submit" value="&nbsp;Предварительный просмотр описания&nbsp;" class="button" name="rbp" id="rbp" onclick="SetActionIdent(0)">
   </div>
   
   <div class="typelabel" style="margin-top: 12px; margin-bottom: 12px; background: #F0F0F0; padding: 3px">
    <b>Параметры места</b>
   </div>
   
   
   <div class="typelabel">
    <input type="checkbox" <?php if ($this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('filesuse') || $_POST['actionthissectnnews'] != 'do'): ?> checked="checked" <?php endif; ?>style="cursor: pointer" name="filesuse" id="filesuse"><label for="filesuse" style="cursor: pointer">&nbsp;Разрешить загрузку баннеров на сервер сайта</label>  
   </div>
   
   <div class="typelabel">
    <input type="checkbox" <?php if ($this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('linksuse') || $_POST['actionthissectnnews'] != 'do'): ?> checked="checked" <?php endif; ?>style="cursor: pointer" name="linksuse" id="linksuse"><label for="linksuse" style="cursor: pointer">&nbsp;Разрешить указывать ссылку на баннер, размещенный на стороннем сайте</label>  
   </div>
   
   <div class="typelabel">
    <input type="checkbox" <?php if ($this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('useflash') || $_POST['actionthissectnnews'] != 'do'): ?> checked="checked" <?php endif; ?>style="cursor: pointer" name="useflash" id="useflash"><label for="useflash" style="cursor: pointer">&nbsp;Разрешить использование flash баннеров</label>  
   </div>
   
   <div class="typelabel">
    <input type="checkbox" <?php if ($this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('usemoder') || $_POST['actionthissectnnews'] != 'do'): ?> checked="checked" <?php endif; ?>style="cursor: pointer" name="usemoder" id="usemoder"><label for="usemoder" style="cursor: pointer">&nbsp;Отправлять баннеры на проверку администратору перед их публикацией</label><br />
    <div style="font-size: 95%; color: #7E7E7E">
    (если администратор подтверждает разрешение на размещение баннера - пользователь может оплатить показ баннера, после чего баннер станет активным в указанном месте)
    </div>  
   </div>
   
   <div class="typelabel">Максимальный размер файла баннера для загрузки (в Kb)<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (определяет максимальный размер файла баннера, если включена поддержка загрузки баннеров на сайт)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="maxfilesize" id="maxfilesize" maxlength="6" value="<?php echo $this->_tpl_vars['adm_object']->GetAsElementP('maxfilesize','actionthissectnnews','do','170'); ?>
">
   </div>
   
   <div class="typelabel">Ширина места<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (определяет ширину блока места, где будут выводиться баннеры. Все баннеры будут размером не больше размера места)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="groupwidth" id="groupwidth" maxlength="3" value="<?php echo $this->_tpl_vars['adm_object']->GetAsElementP('groupwidth','actionthissectnnews','do','250'); ?>
">
   </div>
   
   <div class="typelabel">
    <input type="checkbox" <?php if ($this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('widthpersent')): ?> checked="checked" <?php endif; ?>style="cursor: pointer" name="widthpersent" id="widthpersent"><label for="widthpersent" style="cursor: pointer">&nbsp;Ширина указана в процентах (выключено - в px)</label>  
   </div>
   
   <div class="typelabel">Высота места<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (определяет высоту блока места, где будут выводиться баннеры. Все баннеры будут размером не больше размера места)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="groupheight" id="groupheight" maxlength="3" value="<?php echo $this->_tpl_vars['adm_object']->GetAsElementP('groupheight','actionthissectnnews','do','250'); ?>
">
   </div>
   
   <div class="typelabel">
    <input type="checkbox" <?php if ($this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('heightpersent')): ?> checked="checked" <?php endif; ?>style="cursor: pointer" name="heightpersent" id="heightpersent"><label for="heightpersent" style="cursor: pointer">&nbsp;Высота указана в процентах (выключено - в px)</label>  
   </div>
   
   <div class="typelabel">Максимальное кол-во баннеров в блоке<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (определяет максимальное кол-во баннеров, которое может быть помещено в место. Если кол-во баннеров превысит указанное значение - добавить новый баннер будет невозможно до тех пор, пока кол-во баннеров данного места не уменьшится. Если указано 0 - ограничения нет.)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="maxbunners" id="maxbunners" maxlength="5" value="<?php echo $this->_tpl_vars['adm_object']->GetAsElementP('maxbunners','actionthissectnnews','do','0'); ?>
">
   </div>
   
   <div class="typelabel">
    <input type="checkbox" <?php if ($this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('clearonoffbun') || $_POST['actionthissectnnews'] != 'do'): ?> checked="checked" <?php endif; ?>style="cursor: pointer" name="clearonoffbun" id="clearonoffbun"><label for="clearonoffbun" style="cursor: pointer">&nbsp;Удалять баннер, если условия его показа закончились</label><br />
    <div style="font-size: 95%; color: #7E7E7E">
   (если данный параметр отключен - баннеры не будут удаляться и пользователь сможет в любой момент продлить показ данного баннера в своем кабинете, если включен - как условия показа будут завершены - на следующий день баннер будет удален а пользователю будет отправлено соответствующее сообщение. Баннеры, чьи условия показа завершены - не учавствуют в показе в независимости от того - указан данный параметр или нет.)
   </div>  
   </div>
   
   <div class="typelabel">Цена за 1000 показов баннера (в USD, формат: 0.00)<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (определяет цену за каждые 1000 показов, если пользователь выбрал тип показа - `За указанное кол-во показов`. Если цену указать в 0.00 - возможность размещения баннера за кол-во показов будет недоступна)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="pricetolook" id="pricetolook" maxlength="12" value="<?php echo $this->_tpl_vars['adm_object']->GetAsElementP('pricetolook','actionthissectnnews','do','0.00'); ?>
">
   </div>
   
   <div class="typelabel">Цена за 1 день показов баннера (в USD, формат: 0.00)<br />
   <div style="font-size: 95%; color: #7E7E7E">
   (определяет цену за 1 день показов баннера, если пользователь выбрал тип показа - `За указанный период времени`. Если цену указать в 0.00 - возможность размещения баннера на указанное время будет недоступна)
   </div>
   </div>
   <div class="typelabel">
    <input type="text" class="inpt" style="width: 350px" name="pricetodays" id="pricetodays" maxlength="12" value="<?php echo $this->_tpl_vars['adm_object']->GetAsElementP('pricetodays','actionthissectnnews','do','0.00'); ?>
">
   </div>   
   
   
   <div class="typelabel" style="margin-top: 12px; margin-bottom: 12px; background: #F0F0F0; padding: 3px">
    <b>Выполнить</b>
   </div>
   <div style="font-size: 95%; color: #7E7E7E; position: relative; top: -7px">
   (<strong style="color: #0000FF">прежде чем включать активность места, убедитесь, что код вывода Вы разместили в шаблоне проекта!!</strong>)
   </div>
   
   <div class="typelabel">
    <input type="checkbox"<?php if (! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?> disabled="disabled"<?php endif; ?> <?php if ($this->_tpl_vars['CONTROL_OBJ']->CheckPostValue('groupactive')): ?> checked="checked" <?php endif; ?>style="cursor: pointer; position: relative; top: -7px" name="groupactive" id="groupactive"><label for="groupactive" style="cursor: pointer; position: relative; top: -7px">&nbsp;Активировать место</label> 
   </div>
   
   <div class="typelabel" style="margin-top: 15px">
    <input type="hidden" value="do" name="actionthissectnnews">
   </div> 
   <input type="submit" value="&nbsp;<?php if (! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>Добавить место<?php else: ?>Изменить параметры места<?php endif; ?>&nbsp;" class="button" name="rb" id="rb" onclick="SetActionIdent(1)">&nbsp; 
   <input type="hidden" value="prev" name="actionnewprvmail">
   <input type="hidden" value="ok" name="actionnewsectionnews">
  </form>  
  
  <?php if ($_POST['actionthissectnnews'] == 'do' && ! $_POST['actionthissectionpost_q'] && $_POST['actionnewprvmail'] != 'prev'): ?>
 <div style="margin-top: 10px">
  <?php if ($this->_tpl_vars['adm_object']->error): ?>
   <label style="color: #FF0000"><?php echo $this->_tpl_vars['adm_object']->error; ?>
</label>
  <?php else: ?>
   <label style="color: #008000"><?php if (! $this->_tpl_vars['adm_object']->GetResult('modifyinfo')): ?>Место успешно добавлено!<?php else: ?>Параметры места успешно изменены!<?php endif; ?></label>
  <?php endif; ?>
 </div>
 <?php endif; ?>  

 <?php endif; ?> 
<?php endif; ?>