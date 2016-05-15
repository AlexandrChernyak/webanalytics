<?php /* Smarty version 2.6.26, created on 2016-05-15 08:40:03
         compiled from tools/tpl_toolhistorylist.tpl */ ?>
<?php if ($this->_tpl_vars['tool_object']->GetHistoryData()): ?>
<div style="margin-top: 8px">
 <?php echo '
 <style type="text/css">
  .h_th1x, .h_tdx, .h_td2x { 
   border: 1px solid #E3E4E8; background: #F2F4F4; height: 25px; border-bottom: none; border-right: none; 
   border-right: none; font-weight: bold; 
  }
  .h_tdx { border-left: none; }
  .h_td2x { border-right: 1px solid #E3E4E8; border-left: none; }
  .btn_nx { border: 1px solid #E3E4E8; border-top: none; height: 25px; margin-top: 4px; }
  .sth1x { border-bottom: 1px solid #E3E4E8; height: 25px; border-top: none; }	
 </style>
 <script type="text/javascript">
  function DoHiglx(th, n) {	
   if (n) { $(th).css(\'background\',\'#F9FAFB\'); } else {   	
    $(th).css(\'background\', \'none\');		
   }	
  }//DoHigl	
 </script>
 '; ?>
 
 <div><?php if (! $this->_tpl_vars['descriptrecords']): ?>Всего проверено сайтов:<?php else: ?><?php echo $this->_tpl_vars['descriptrecords']; ?>
<?php endif; ?> <b><?php echo $this->_tpl_vars['tool_object']->GetHistoryData('','recordscount'); ?>
</b></div>
 <div style="margin-top: 12px">
 <span style="width: 100%">
  <table width="<?php if (! $this->_tpl_vars['tablewidth']): ?>100%<?php else: ?><?php echo $this->_tpl_vars['tablewidth']; ?>
<?php endif; ?>" cellpadding="0" cellspacing="0" border="0">  
    <thead>	
     <tr>
 
      <th class="h_th1x" valign="center" align="left">
       <label style="margin-left: 4px;">URL</label>
      </th>
  	  
      <th class="h_td2x" valign="center" align="right" width="130px">
       <label style="margin-right: 4px;">Дата</label>
      </th>
      
     </tr>   	
    </thead>   
    
    <?php $_from = $this->_tpl_vars['tool_object']->GetHistoryData('','source'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
     <tr onmouseover="DoHiglx(this, 1)" onmouseout="DoHiglx(this, 0)">      
      <td class="sth1x" valign="center" align="left" style="border-left: 1px solid #E3E4E8; padding-left: 4px">
  	   <?php if ($this->_tpl_vars['noindexlinks']): ?><noindex><?php endif; ?><a <?php if ($this->_tpl_vars['noindexlinks']): ?>rel="nofollow" <?php endif; ?>href="<?php echo @W_SITEPATH; ?>
tools/<?php echo $this->_tpl_vars['tool_object']->section_id; ?>
/<?php echo $this->_tpl_vars['val']['linkcheck']; ?>
" target="_blank"><?php echo $this->_tpl_vars['tool_object']->CorrectURLLink($this->_tpl_vars['val']['linkcheck'],50); ?>
</a><?php if ($this->_tpl_vars['noindexlinks']): ?></noindex><?php endif; ?>  
      </td>
         
      <td class="sth1x" valign="center" align="right" width="130px" style="border-right: 1px solid #E3E4E8; padding-right: 4px">
       <?php echo $this->_tpl_vars['val']['datecreat']; ?>

      </td>    
     </tr>  
    <?php endforeach; endif; unset($_from); ?>

  </table>
  <div style="text-align: right; margin-top: 10px"><?php echo $this->_tpl_vars['tool_object']->GetHistoryData('','pagestext'); ?>
</div>
 </span>
 </div>  
</div>
<?php endif; ?>