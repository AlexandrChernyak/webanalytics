<?php /* Smarty version 2.6.26, created on 2013-11-14 13:10:25
         compiled from account/ref-banner-file.tpl */ ?>

<div>
 <a href="<?php echo @W_SITEPATH; ?>
account/ref-banner/"<?php if (! $_GET['flash']): ?> style="color: #000000"<?php endif; ?>>Обычные баннеры</a><label style="margin: 0 5px 0 5px">|</label><a href="<?php echo @W_SITEPATH; ?>
account/ref-banner/&flash=1"<?php if ($_GET['flash']): ?> style="color: #000000"<?php endif; ?>>Flash баннеры</a>
</div>
<div style="margin-top: 20px">
 <?php $this->assign('blist', $this->_tpl_vars['CONTROL_OBJ']->GetReferBannersList($_GET['flash'])); ?>
 <?php echo '
 <script type="text/javascript">
  function ShHideElementFlash(th, ident) {   
   $(\'#rp\'+ident).css(\'visibility\', (th.checked) ? \'visible\' : \'hidden\');
   $(\'#rp\'+ident).css(\'display\', (th.checked) ? \'block\' : \'none\');
  }//ShHideElementFlash	
  
  function ShHdBlElementA(th, ident) {	   
   var hd = ($(\'#\'+ident).css(\'visibility\') == \'hidden\') ? true : false; 
   $(th).html((hd) ? \'Скрыть\' : \'Показать\');
   $(\'#\'+ident).css(\'visibility\', (hd) ? \'visible\' : \'hidden\');
   $(\'#\'+ident).css(\'display\', (hd) ? \'block\' : \'none\');
  }//ShHdBlElementA
  
  function GetCodeElement(ident, typelink, isfl) {
   var myhostpath = '; ?>
'<?php echo @W_HOSTMYSITE; ?>
';<?php echo '
   var myhostpathmini = '; ?>
'<?php echo @W_SITEPATH; ?>
';<?php echo '  
   isfl = (isfl == \'0\') ? false : true;   
   if (!isfl) {
    var link = $(\'#\'+typelink+ident).text();
   }
   var source = \'\';
   if (isfl) {
    source =  trim($(\'#flsource\'+ident).html());    
   } else {
    source = $(\'#imsource\'+ident).html();
   }  
   source = str_replace(myhostpathmini+\'pfiles/images/\', \'http://\'+myhostpath+\'/pfiles/images/\', source);
   if (!isfl) {
    source = \'<a href="\'+link+\'" target="_blank">\'+source+\'</a>\';   
   } 
   $(\'#code\'+ident).val(source);
  }
 </script>
 '; ?>

 <?php if (! $this->_tpl_vars['blist']): ?><div style="margin-left: 4px">Нет активных баннеров!</div><?php else: ?>
  <?php $_from = $this->_tpl_vars['blist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rname'] => $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
 
   <div class="analisislabelid" style="margin-top: 15px;"><strong><?php echo $this->_tpl_vars['rname']; ?>
</strong><label style="color: #000000; margin-left: 6px">[ <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElementA(this, 'block_<?php echo $this->_tpl_vars['ref']['iditem']; ?>
')">Скрыть</a> ]</label></div>
   <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="block_<?php echo $this->_tpl_vars['ref']['iditem']; ?>
">    
    <?php $_from = $this->_tpl_vars['val']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['ref'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['ref']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['ref']):
        $this->_foreach['ref']['iteration']++;
?>
   
    <div style="margin: 10px 2px 2px 2px">
    <?php if (! $this->_tpl_vars['ref']['isflash']): ?>
     <div id="imsource<?php echo $this->_tpl_vars['ref']['iditem']; ?>
"><img src="<?php echo @W_SITEPATH; ?>
pfiles/images/<?php echo $this->_tpl_vars['ref']['bfilename']; ?>
" border="0"></div>
    <?php else: ?>       
     
     <div id="flsource<?php echo $this->_tpl_vars['ref']['iditem']; ?>
">    
     <object  classid="clsid27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0"<?php if ($this->_tpl_vars['ref']['bwidth']): ?> width="<?php echo $this->_tpl_vars['ref']['bwidth']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['ref']['bheight']): ?> height="<?php echo $this->_tpl_vars['ref']['bheight']; ?>
"<?php endif; ?> id="refbunner<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" align="middle">
     <param name="allowScriptAccess" value="always" />
     <param name="allowFullScreen" value="false" />
     <param name="movie" value="<?php echo @W_SITEPATH; ?>
pfiles/images/<?php echo $this->_tpl_vars['ref']['bfilename']; ?>
" />
     <param name="quality" value="high" />
     <embed src="<?php echo @W_SITEPATH; ?>
pfiles/images/<?php echo $this->_tpl_vars['ref']['bfilename']; ?>
" quality="high" bgcolor="#ffffff"<?php if ($this->_tpl_vars['ref']['bwidth']): ?> width="<?php echo $this->_tpl_vars['ref']['bwidth']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['ref']['bheight']): ?> height="<?php echo $this->_tpl_vars['ref']['bheight']; ?>
"<?php endif; ?> name="refbunner<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" id="refbunner<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer"/>
     </object>
     </div>
      
    <?php endif; ?>
    </div>
    
    <div style="padding-left: 2px">
    
     <div style="margin-top: 6px">
      <input type="checkbox" style="cursor: pointer" name="ch<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" id="ch<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" onclick="ShHideElementFlash(this, '<?php echo $this->_tpl_vars['ref']['iditem']; ?>
')" /><label for="ch<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" style="cursor: pointer"> Показать код баннера</label>
     </div>
     
     <div id="rp<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" style="visibility: hidden; display: none">
      <div style="margin-top: 15px; padding-left: 4px">
       
       <div>
        
        <?php if ($this->_tpl_vars['ref']['isflash']): ?>
        <div>
        <input type="radio" style="cursor: pointer" name="sel<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" id="sel1<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" onclick="GetCodeElement('<?php echo $this->_tpl_vars['ref']['iditem']; ?>
', 'lp1', '<?php echo $this->_tpl_vars['ref']['isflash']; ?>
')" /><label for="sel1<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" id="lp1<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" style="cursor: pointer; padding-left: 4px">Как указано в ролике</label>
        </div>
        <?php else: ?>      
       
        <div>
        <input type="radio" style="cursor: pointer" name="sel<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" id="sel1<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" onclick="GetCodeElement('<?php echo $this->_tpl_vars['ref']['iditem']; ?>
', 'lp1', '<?php echo $this->_tpl_vars['ref']['isflash']; ?>
')" /><label for="sel1<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" id="lp1<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" style="cursor: pointer; padding-left: 4px">http://<?php echo @W_HOSTMYSITE; ?>
/?p=<?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['iduser']; ?>
</label>
        </div>
        <div style="margin-top: 4px">
         <input type="radio" style="cursor: pointer" name="sel<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" id="sel2<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" onclick="GetCodeElement('<?php echo $this->_tpl_vars['ref']['iditem']; ?>
', 'lp2', '<?php echo $this->_tpl_vars['ref']['isflash']; ?>
')" /><label for="sel2<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" id="lp2<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" style="cursor: pointer; padding-left: 4px">http://<?php echo @W_HOSTMYSITE; ?>
/register/<?php echo $this->_tpl_vars['CONTROL_OBJ']->userdata['iduser']; ?>
</label>
        </div>
        <?php endif; ?>
            
       </div>
       
       <div style="margin-top: 6px"><textarea class="int_text" style="height: <?php if ($this->_tpl_vars['ref']['isflash']): ?>150px<?php else: ?>50px<?php endif; ?>; width: 95%" readonly="readonly" onclick="this.select()" name="code<?php echo $this->_tpl_vars['ref']['iditem']; ?>
" id="code<?php echo $this->_tpl_vars['ref']['iditem']; ?>
"></textarea></div>
      </div>
     </div>
     
     <div style="margin-top: 6px">&nbsp;</div> 
    
    </div> 
    <?php endforeach; endif; unset($_from); ?>
   </div>
  <?php endforeach; endif; unset($_from); ?>
 <?php endif; ?>
</div>