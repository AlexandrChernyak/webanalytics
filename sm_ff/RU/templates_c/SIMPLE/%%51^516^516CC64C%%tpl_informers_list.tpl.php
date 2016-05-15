<?php /* Smarty version 2.6.26, created on 2013-11-12 22:23:08
         compiled from tools/informers/tpl_informers_list.tpl */ ?>
<div style="margin-top: 5px">
 <?php echo '
 <script type="text/javascript">
 var globalimagepath = \''; ?>
<?php echo @W_SITEPATH; ?>
tools/<?php echo $this->_tpl_vars['tool_object']->section_id; ?>
/&getimage=<?php echo '\';
 var rppr = \''; ?>
<?php if ($this->_tpl_vars['tool_object']->GetResult('rightstrparam')): ?><?php echo $this->_tpl_vars['tool_object']->GetResult('rightstrparam'); ?>
<?php endif; ?><?php echo '\';
 
 function ShHdBlElementL(th, ident) {	   
  var hd = ($(\'#\'+ident).css(\'visibility\') == \'hidden\') ? true : false; 
  $(th).html((hd) ? \'Скрыть\' : \'Показать\');
  $(\'#\'+ident).css(\'visibility\', (hd) ? \'visible\' : \'hidden\');
  $(\'#\'+ident).css(\'display\', (hd) ? \'block\' : \'none\');
 }//ShHdBlElement
 function DoSelectInformerX(infid) {
  $(\'#selectedinformer\').val(infid);	
 }//DoSelectInformerX 
 </script> 
 '; ?>

 
  <?php $_from = $this->_tpl_vars['tool_object']->GetResult('infdata'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
 <div style="margin-top: 18px; border-bottom: 1px solid #969696; padding-bottom: 5px; width: 96%">
 <b><?php echo $this->_tpl_vars['val']['section']['secname']; ?>
</b>
 <label style="color: #000000; margin-left: 6px">[
 <a style="font-size: 95%" href="javascript:" onclick="ShHdBlElementL(this, 'blockL<?php echo $this->_tpl_vars['val']['section']['iditem']; ?>
')">Скрыть</a>
 ]</label>
 </div>	  
 <div style="margin-top: 12px; width: 95%; padding-left: 6px" id="blockL<?php echo $this->_tpl_vars['val']['section']['iditem']; ?>
">
  <?php if (! $this->_tpl_vars['val']['informers']): ?>
   <div style="margin-left: 4px">Информеры не обнаружены!</div>
  <?php else: ?>
      <span style="width: 100%">
    <table width="100%" cellpadding="0" cellspacing="0">
     <?php unset($this->_sections['trindex']);
$this->_sections['trindex']['name'] = 'trindex';
$this->_sections['trindex']['start'] = (int)0;
$this->_sections['trindex']['loop'] = is_array($_loop=$this->_tpl_vars['val']['trcount']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['trindex']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['trindex']['show'] = true;
$this->_sections['trindex']['max'] = $this->_sections['trindex']['loop'];
if ($this->_sections['trindex']['start'] < 0)
    $this->_sections['trindex']['start'] = max($this->_sections['trindex']['step'] > 0 ? 0 : -1, $this->_sections['trindex']['loop'] + $this->_sections['trindex']['start']);
else
    $this->_sections['trindex']['start'] = min($this->_sections['trindex']['start'], $this->_sections['trindex']['step'] > 0 ? $this->_sections['trindex']['loop'] : $this->_sections['trindex']['loop']-1);
if ($this->_sections['trindex']['show']) {
    $this->_sections['trindex']['total'] = min(ceil(($this->_sections['trindex']['step'] > 0 ? $this->_sections['trindex']['loop'] - $this->_sections['trindex']['start'] : $this->_sections['trindex']['start']+1)/abs($this->_sections['trindex']['step'])), $this->_sections['trindex']['max']);
    if ($this->_sections['trindex']['total'] == 0)
        $this->_sections['trindex']['show'] = false;
} else
    $this->_sections['trindex']['total'] = 0;
if ($this->_sections['trindex']['show']):

            for ($this->_sections['trindex']['index'] = $this->_sections['trindex']['start'], $this->_sections['trindex']['iteration'] = 1;
                 $this->_sections['trindex']['iteration'] <= $this->_sections['trindex']['total'];
                 $this->_sections['trindex']['index'] += $this->_sections['trindex']['step'], $this->_sections['trindex']['iteration']++):
$this->_sections['trindex']['rownum'] = $this->_sections['trindex']['iteration'];
$this->_sections['trindex']['index_prev'] = $this->_sections['trindex']['index'] - $this->_sections['trindex']['step'];
$this->_sections['trindex']['index_next'] = $this->_sections['trindex']['index'] + $this->_sections['trindex']['step'];
$this->_sections['trindex']['first']      = ($this->_sections['trindex']['iteration'] == 1);
$this->_sections['trindex']['last']       = ($this->_sections['trindex']['iteration'] == $this->_sections['trindex']['total']);
?> 
      <tr>
	   <?php unset($this->_sections['tdindex']);
$this->_sections['tdindex']['name'] = 'tdindex';
$this->_sections['tdindex']['start'] = (int)0;
$this->_sections['tdindex']['loop'] = is_array($_loop=$this->_tpl_vars['val']['tdcount']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tdindex']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['tdindex']['show'] = true;
$this->_sections['tdindex']['max'] = $this->_sections['tdindex']['loop'];
if ($this->_sections['tdindex']['start'] < 0)
    $this->_sections['tdindex']['start'] = max($this->_sections['tdindex']['step'] > 0 ? 0 : -1, $this->_sections['tdindex']['loop'] + $this->_sections['tdindex']['start']);
else
    $this->_sections['tdindex']['start'] = min($this->_sections['tdindex']['start'], $this->_sections['tdindex']['step'] > 0 ? $this->_sections['tdindex']['loop'] : $this->_sections['tdindex']['loop']-1);
if ($this->_sections['tdindex']['show']) {
    $this->_sections['tdindex']['total'] = min(ceil(($this->_sections['tdindex']['step'] > 0 ? $this->_sections['tdindex']['loop'] - $this->_sections['tdindex']['start'] : $this->_sections['tdindex']['start']+1)/abs($this->_sections['tdindex']['step'])), $this->_sections['tdindex']['max']);
    if ($this->_sections['tdindex']['total'] == 0)
        $this->_sections['tdindex']['show'] = false;
} else
    $this->_sections['tdindex']['total'] = 0;
if ($this->_sections['tdindex']['show']):

            for ($this->_sections['tdindex']['index'] = $this->_sections['tdindex']['start'], $this->_sections['tdindex']['iteration'] = 1;
                 $this->_sections['tdindex']['iteration'] <= $this->_sections['tdindex']['total'];
                 $this->_sections['tdindex']['index'] += $this->_sections['tdindex']['step'], $this->_sections['tdindex']['iteration']++):
$this->_sections['tdindex']['rownum'] = $this->_sections['tdindex']['iteration'];
$this->_sections['tdindex']['index_prev'] = $this->_sections['tdindex']['index'] - $this->_sections['tdindex']['step'];
$this->_sections['tdindex']['index_next'] = $this->_sections['tdindex']['index'] + $this->_sections['tdindex']['step'];
$this->_sections['tdindex']['first']      = ($this->_sections['tdindex']['iteration'] == 1);
$this->_sections['tdindex']['last']       = ($this->_sections['tdindex']['iteration'] == $this->_sections['tdindex']['total']);
?>
	    <td valign="center" align="left" style="padding: 3px">
		 <?php if (! isset ( $this->_tpl_vars['val']['informers'][$this->_sections['tdindex']['index']][$this->_sections['trindex']['index']] )): ?>
		  &nbsp;
		 <?php else: ?>
		  <div>
		   <span style="width: 100%">
		    <table width="100%" cellpadding="0" cellspacing="0">
		     <tr>
			  <td valign="center" align="center" style="padding: 3px; width: 24px"> 
			   <input type="radio" style="cursor: pointer" name="checkimage" id="imgid<?php echo $this->_tpl_vars['val']['informers'][$this->_sections['tdindex']['index']][$this->_sections['trindex']['index']]['iditem']; ?>
" onclick="<?php if ($this->_tpl_vars['onselectiten']): ?><?php echo $this->_tpl_vars['onselectiten']; ?>
<?php else: ?>DoSelectInformerX<?php endif; ?>('<?php echo $this->_tpl_vars['val']['informers'][$this->_sections['tdindex']['index']][$this->_sections['trindex']['index']]['iditem']; ?>
')">
			  </td>
			  <td valign="center" align="left" style="padding: 3px">
			   <label for="imgid<?php echo $this->_tpl_vars['val']['informers'][$this->_sections['tdindex']['index']][$this->_sections['trindex']['index']]['iditem']; ?>
" style="cursor: pointer">
			    
				<div><img id="image_<?php echo $this->_tpl_vars['val']['informers'][$this->_sections['tdindex']['index']][$this->_sections['trindex']['index']]['iditem']; ?>
" src="<?php echo @W_SITEPATH; ?>
tools/<?php echo $this->_tpl_vars['tool_object']->section_id; ?>
/&getimage=<?php echo $this->_tpl_vars['val']['informers'][$this->_sections['tdindex']['index']][$this->_sections['trindex']['index']]['iditem']; ?>
<?php if ($this->_tpl_vars['tool_object']->GetResult('rightstrparam')): ?>&rightstrparam=<?php echo $this->_tpl_vars['tool_object']->GetResult('rightstrparam'); ?>
<?php endif; ?>"></div>
				
								<?php if ($this->_tpl_vars['val']['informers'][$this->_sections['tdindex']['index']][$this->_sections['trindex']['index']]['usecolorselecter']): ?>
				<div style="margin-top: 4px" id="seldiv<?php echo $this->_tpl_vars['val']['informers'][$this->_sections['tdindex']['index']][$this->_sections['trindex']['index']]['iditem']; ?>
" title="#000000">
				 <a href="javascript:" id="selcolor<?php echo $this->_tpl_vars['val']['informers'][$this->_sections['tdindex']['index']][$this->_sections['trindex']['index']]['iditem']; ?>
" title="<?php echo $this->_tpl_vars['val']['informers'][$this->_sections['tdindex']['index']][$this->_sections['trindex']['index']]['iditem']; ?>
">Выбрать цвет</a>
				</div>
				<input type="hidden" value="" name="colorInput<?php echo $this->_tpl_vars['val']['informers'][$this->_sections['tdindex']['index']][$this->_sections['trindex']['index']]['iditem']; ?>
" id="colorInput<?php echo $this->_tpl_vars['val']['informers'][$this->_sections['tdindex']['index']][$this->_sections['trindex']['index']]['iditem']; ?>
">				
				<?php endif; ?>			
				
							    
			   </label>
			  </td>
			 </tr>
		    </table>
		   </span>
		  </div>
		 <?php endif; ?>		 
		</td>
	   <?php endfor; endif; ?>
	  </tr>
     <?php endfor; endif; ?>
    </table>
   </span>
      
   <?php if ($this->_tpl_vars['val']['usecolorchangeids']): ?>
    <?php echo '
	<script type="text/javascript">      
     $(\''; ?>
<?php echo $this->_tpl_vars['CONTROL_OBJ']->GenerateArrayString($this->_tpl_vars['val']['usecolorchangeids'],', ','#selcolor'); ?>
<?php echo '\').ColorPicker({
	 onSubmit: function(hsb, hex, rgb, el) {	  
	  var id = $(el).attr(\'title\');	
	  $(\'#seldiv\'+id).attr(\'title\', \'#\'+hex);
	  $(\'#colorInput\'+id).val(\'#\'+hex);  
	  $(\'#image_\'+id).attr(\'src\', globalimagepath + id + \'&replc=_r_\' + hex + ((rppr) ? \'&rightstrparam=\' + rppr : \'\'));	  
	  $(el).ColorPickerHide();
	 },
	 onBeforeShow: function () {	
	  $(this).ColorPickerSetColor($(\'#seldiv\'+$(this).attr(\'title\')).attr(\'title\')); 
	 } })
    .bind(\'keyup\', function(){ 
	  $(this).ColorPickerSetColor($(\'#seldiv\'+$(this).attr(\'title\')).attr(\'title\')); 
	 });
    </script>
	'; ?>

   <?php endif; ?>
   
  <?php endif; ?>   
 </div>
 <?php endforeach; endif; unset($_from); ?> 
 <input type="hidden" value="" name="selectedinformer" id="selectedinformer">  
</div>