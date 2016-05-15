<?php /* Smarty version 2.6.26, created on 2016-05-15 08:35:23
         compiled from tools/contentcheck/tpl_block-general-sys-items-list.tpl */ ?>
<?php if (! $this->_tpl_vars['tool_object']->IsAjax()): ?>
<?php echo '
 <script type="text/javascript">
  var globalpatht = \''; ?>
<?php echo @W_SITEPATH; ?>
<?php echo '\';
  var toolpathitr = globalpatht + \'tools/'; ?>
<?php echo $this->_tpl_vars['tool_object']->section_id; ?>
<?php echo '/\';
  var url_p = \''; ?>
<?php echo $this->_tpl_vars['url_p']; ?>
<?php echo '\'; 
  var d_updates = \''; ?>
<?php if ($this->_tpl_vars['tool_object']->IsUpdateResults()): ?>1<?php else: ?>0<?php endif; ?><?php echo '\';
 
  function PrepereResultXML(data) { $(\'#gen-sys-info-block-data\').html(data); }   
    
  $(document).ready(function() {
	 $(\'#gen-sys-info-block-data\').html(
	  \'<div class="typelabel">Подготовка данных..</div>\' +
      \'<div class="typelabel"><img src="\'+globalpatht+\'athemes/SIMPLE/img/ajax-loader.gif" border="0"></div>\'
	 );	 
     SendDefaultRequest(toolpathitr, \'is_ajax_mode=1&spparams3=1&url=\'+url_p+\'&dp=\'+d_updates, \'PrepereResultXML\');	  
  });
      
 </script>
'; ?>


<div id="gen-sys-info-block-data">
  Поддержка JavaScript отключена!
</div>

<?php else: ?>

  <?php if (! $this->_tpl_vars['tool_object']->GetResult('gensys1') && ! $this->_tpl_vars['tool_object']->GetResult('gensys2') && ! $this->_tpl_vars['tool_object']->GetResult('gensys3')): ?>
 <div style="color: #FF0000">Нет данных для отображения! Проверьте доступность блока или источников!</div>
 <?php else: ?>
 
  <?php if ($this->_tpl_vars['tool_object']->GetResult('gensys1')): ?>   
    <div><strong>Общие данные показателей сайта ( <ins style="font-weight: normal"><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys1.host'); ?>
</ins> )</strong> (от solomono)<?php if ($this->_tpl_vars['tool_object']->GetResult('gensys1.cacheddate')): ?><label style="margin-left: 6px; font-size: 85%">[последнее обновление: <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['tool_object']->GetResult('gensys1.cacheddate')); ?>
 &nbsp; (<?php echo $this->_tpl_vars['tool_object']->GetResult('gensys1.cacheddate'); ?>
)]</label><?php endif; ?></div>
    <div style="margin-top: 6px">
    
    <div><span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	    
        <td class="sth1" valign="top" align="left" style="padding-bottom: 3px">
		 <div class="typelabel">
         
		  <div class="typelabel">Всего зеркал домена: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys1.mr'); ?>
</strong></div>	
          <div class="typelabel">Кол-во доменов на том же IP: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys1.ip'); ?>
</strong></div>
          <div class="typelabel">Кол-во доменов, на которые ссылается сайт: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys1.dout'); ?>
</strong></div>
          <div class="typelabel">Кол-во анкоров: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys1.anchors'); ?>
</strong></div>
          <div class="typelabel">Кол-во исходящих анкоров: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys1.anchors_out'); ?>
</strong></div>  
          
          <div class="typelabel">Кол-во iGood доноров: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys1.igood'); ?>
</strong></div>
          
		 </div>		  
		</td>
        
	    <td class="sth1" valign="top" align="left">
         <div class="typelabel">
		  
          <div class="typelabel">Кол-во ссылок на домен: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys1.hin'); ?>
</strong></div>
          <?php if ($this->_tpl_vars['tool_object']->GetResult('gensys1.hin-list2w')): ?>
           <div style="padding-left: 4px; font-size: 95%">&rsaquo;&rsaquo; По уровню вложенности:  
           <?php $_from = $this->_tpl_vars['tool_object']->GetResult('gensys1.hin-list2w'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['uvname'] => $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
            <label>
            <?php if (($this->_foreach['val']['iteration']-1) > 0): ?>, <?php endif; ?>Ув<?php echo $this->_tpl_vars['uvname']; ?>
: <strong><?php echo $this->_tpl_vars['val']; ?>
</strong>
            </label>           
           <?php endforeach; endif; unset($_from); ?>           
           </div>
          <?php endif; ?>                  
          
          <div class="typelabel">Кол-во доноров: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys1.din'); ?>
</strong></div>
          <?php if ($this->_tpl_vars['tool_object']->GetResult('gensys1.din-list2w')): ?>
           <div style="padding-left: 4px; font-size: 95%">&rsaquo;&rsaquo; По уровню вложенности:  
           <?php $_from = $this->_tpl_vars['tool_object']->GetResult('gensys1.din-list2w'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['uvname'] => $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
            <label>
            <?php if (($this->_foreach['val']['iteration']-1) > 0): ?>, <?php endif; ?>Ув<?php echo $this->_tpl_vars['uvname']; ?>
: <strong><?php echo $this->_tpl_vars['val']; ?>
</strong>
            </label>           
           <?php endforeach; endif; unset($_from); ?>           
           </div>
          <?php endif; ?>
                    
          <div class="typelabel">Исходящие (внешние) ссылки домена: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys1.hout'); ?>
</strong></div>
          <?php if ($this->_tpl_vars['tool_object']->GetResult('gensys1.hout-list2w')): ?>
           <div style="padding-left: 4px; font-size: 95%">&rsaquo;&rsaquo; По уровню вложенности:  
           <?php $_from = $this->_tpl_vars['tool_object']->GetResult('gensys1.hout-list2w'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['uvname'] => $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
            <label>
            <?php if (($this->_foreach['val']['iteration']-1) > 0): ?>, <?php endif; ?>Ув<?php echo $this->_tpl_vars['uvname']; ?>
: <strong><?php echo $this->_tpl_vars['val']; ?>
</strong>
            </label>           
           <?php endforeach; endif; unset($_from); ?>           
           </div>
          <?php endif; ?>          
          
          
		 </div>
		</td>
        
       </tr>
      </table>
	 </span></div>
    
    </div>   
  <?php endif; ?>  
  
  
  <?php if ($this->_tpl_vars['tool_object']->GetResult('gensys3')): ?>
    <div<?php if ($this->_tpl_vars['tool_object']->GetResult('gensys1')): ?> style="margin-top: 15px"<?php endif; ?>><strong>Общие данные показателей сайта ( <ins style="font-weight: normal"><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys3.Item'); ?>
</ins> )</strong> (от majesticseo)<?php if ($this->_tpl_vars['tool_object']->GetResult('gensys3.cacheddate')): ?><label style="margin-left: 6px; font-size: 85%">[последнее обновление: <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['tool_object']->GetResult('gensys3.cacheddate')); ?>
 &nbsp; (<?php echo $this->_tpl_vars['tool_object']->GetResult('gensys3.cacheddate'); ?>
)]</label><?php endif; ?></div>
    <div style="margin-top: 6px">
    
    <div><span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	    
        <td class="sth1" valign="top" align="left" style="padding-bottom: 3px">
		 <div class="typelabel">
         
		  <div class="typelabel">Количество обратных ссылок: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys3.ExtBackLinks'); ?>
</strong></div>
          
          <div class="typelabel">Количество ссылающихся доменов: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys3.RefDomains'); ?>
</strong></div>  
          
          <div class="typelabel">Ссылается IP адресов: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys3.RefIPs'); ?>
</strong></div>
          
		 </div>		  
		</td>
        
	    <td class="sth1" valign="top" align="left">
         <div class="typelabel">
		  
          <div class="typelabel">Проиндексировано majesticseo: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys3.IndexedURLs'); ?>
</strong></div>
              
          <div class="typelabel">Подсети: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys3.RefSubNets'); ?>
</strong></div>         
                       
		 </div>
		</td>
        
       </tr>
      </table>
	 </span></div>
    
    </div>     
  <?php endif; ?>
  
 
  <?php if ($this->_tpl_vars['tool_object']->GetResult('gensys2')): ?>
    <div<?php if ($this->_tpl_vars['tool_object']->GetResult('gensys1') || $this->_tpl_vars['tool_object']->GetResult('gensys3')): ?> style="margin-top: 15px"<?php endif; ?>><strong>Общие данные статистики анализа страницы</strong><?php if ($this->_tpl_vars['tool_object']->GetResult('gensys2.cacheddate')): ?><label style="margin-left: 6px; font-size: 85%">[последнее обновление: <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetLastIntervalInDays($this->_tpl_vars['tool_object']->GetResult('gensys2.cacheddate')); ?>
 &nbsp; (<?php echo $this->_tpl_vars['tool_object']->GetResult('gensys2.cacheddate'); ?>
)]</label><?php endif; ?></div>
    <div style="margin-top: 6px">
    
    <div><span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
       <tr onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	    
        <td class="sth1" valign="top" align="left" style="padding-bottom: 3px">
		 <div class="typelabel">
         
		  <div class="typelabel">Общий процент скорости загрузки страницы: <strong style="color: #008000"><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys2.score'); ?>
%</strong></div>
          
          <div class="typelabel">Страница подключает ресурсов: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys2.numberResources'); ?>
</strong>, хостов: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys2.numberHosts'); ?>
</strong></div>
          
          <div class="typelabel">Общий размер запроса: <strong><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetStrSizeFromBytes($this->_tpl_vars['tool_object']->GetResult('gensys2.totalRequestBytes')); ?>
</strong></div>
          	
          <div class="typelabel">Размер html кода страницы: <strong><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetStrSizeFromBytes($this->_tpl_vars['tool_object']->GetResult('gensys2.htmlResponseBytes')); ?>
</strong></div>
          
          <div class="typelabel">Общий размер изображений на странице: <strong><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetStrSizeFromBytes($this->_tpl_vars['tool_object']->GetResult('gensys2.imageResponseBytes')); ?>
</strong></div>         
          
          
		 </div>		  
		</td>
        
	    <td class="sth1" valign="top" align="left">
         <div class="typelabel">
		  
          <div class="typelabel">Всего CSS файлов подключено: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys2.numberCssResources'); ?>
</strong>, общим размером: <strong><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetStrSizeFromBytes($this->_tpl_vars['tool_object']->GetResult('gensys2.cssResponseBytes')); ?>
</strong></div>
          
          <div class="typelabel">Всего JavaScript файлов подключено: <strong><?php echo $this->_tpl_vars['tool_object']->GetResult('gensys2.numberJsResources'); ?>
</strong>, общим размером: <strong><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetStrSizeFromBytes($this->_tpl_vars['tool_object']->GetResult('gensys2.javascriptResponseBytes')); ?>
</strong></div>
          
          <div class="typelabel">Размер остальных ресурсов: <strong><?php echo $this->_tpl_vars['CONTROL_OBJ']->GetStrSizeFromBytes($this->_tpl_vars['tool_object']->GetResult('gensys2.otherResponseBytes')); ?>
</strong></div>          
                      
		 </div>
		</td>
        
       </tr>
      </table>
	 </span></div>
    
    </div>     
  <?php endif; ?>
 
 <?php endif; ?>

<?php endif; ?>