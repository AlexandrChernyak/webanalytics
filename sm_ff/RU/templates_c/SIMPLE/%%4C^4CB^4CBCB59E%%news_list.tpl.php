<?php /* Smarty version 2.6.26, created on 2013-11-14 13:48:28
         compiled from news_list.tpl */ ?>
<div style="margin-top: 4px">
 <?php if ($this->_tpl_vars['global_data_list_info']['error']): ?>
  <div style="margin-left: 4px; color: #FF0000"><?php echo $this->_tpl_vars['global_data_list_info']['error']; ?>
</div>
 <?php else: ?>
    <?php if ($this->_tpl_vars['global_data_list_info']['info']): ?>
  
   <div style="text-align: right; margin-bottom: 6px; padding-right: 3px;">
    <a title="RSS канал комментариев" href="<?php echo @W_SITEPATH; ?>
rss/1/<?php echo $this->_tpl_vars['global_data_list_info']['info']['iditem']; ?>
" target="_blank"><img src="<?php echo @W_SITEPATH; ?>
img/ico/general/feed.png" alt="rss" border="0" /></a>
   </div>
       
   <div>
   <?php if ($this->_tpl_vars['global_data_list_info']['info']['dwnameimg']): ?>
    <img src="<?php echo @W_SITEPATH; ?>
pfiles/images/<?php echo $this->_tpl_vars['global_data_list_info']['info']['dwnameimg']; ?>
" border="0" style="float: left; margin-right: 10px; margin-bottom: 5px" alt="<?php echo $this->_tpl_vars['global_data_list_info']['info']['newtitle']; ?>
" title="<?php echo $this->_tpl_vars['global_data_list_info']['info']['newtitle']; ?>
">
   <?php endif; ?> 
   
   <div><?php echo $this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextFromDB($this->_tpl_vars['global_data_list_info']['info']['newdata'],false,false,$this->_tpl_vars['global_data_list_info']['info']['contenttype']); ?>
</div>
   
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "items/attachments-default-block.tpl", 'smarty_include_vars' => array('filesid' => 1,'objectid' => $this->_tpl_vars['global_data_list_info']['info']['iditem'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   
   <div style="margin-top: 3px; border-bottom: 1px solid #969696; width: 20%">
    &nbsp;
   </div>
   <div style="margin-top: 6px; font-size: 95%">
   Дата добавления: <?php echo $this->_tpl_vars['global_data_list_info']['info']['datecreate']; ?>
, просмотров: <?php echo $this->_tpl_vars['global_data_list_info']['info']['newlooks']; ?>

   </div>
   <div style="margin-top: 8px"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "items/add_bookmarcks_block.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
   
   <?php if ($this->_tpl_vars['global_data_list_info']['commentsdata']): ?>
   <div style="margin-top: 16px">
    <div id="comments" style="">Комментарии: <b><?php echo $this->_tpl_vars['global_data_list_info']['commentscount']; ?>
</b></div>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "items/comments_data_block.tpl", 'smarty_include_vars' => array('commfor' => $this->_tpl_vars['global_data_list_info']['iditem'],'commdescr' => $this->_tpl_vars['global_data_list_info']['info']['newtitle'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   </div>
   <?php endif; ?> 
   
   </div>
  <?php else: ?>
    <?php echo '
    <script type="text/javascript">
    function DoHigl(th, n) {	
     if (n) { $(th).css(\'background\',\'#F9FAFB\'); } else {   	
      $(th).css(\'background\', \'none\');		
     }	
    }//DoHigl	
    </script>
    '; ?>

   <?php if ($this->_tpl_vars['global_data_list_info']['selectsection']): ?>
        
    <?php $this->assign('listnewssections', $this->_tpl_vars['CONTROL_OBJ']->GetNewsSectionListElements(false,$_GET['identway'])); ?>
    
    <?php if (! $this->_tpl_vars['listnewssections']): ?>	
    <div style="margin-top: 10px; padding: 4px" onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
     <span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
     <tr>
	  <td valign="top" align="left" width="54px">
	   <img src="<?php echo @W_SITEPATH; ?>
img/ico/general/news_site.png" border="0">
	  </td>
	  <td valign="top" align="left">
	   <div><b><a href="<?php echo @W_SITEPATH; ?>
news/1/">Новости сайта</a></b></div>
	   <div style="margin-top: 4px; font-size: 95%; color: #808080">
	    Новости последних изменений сайта. Обновление инструментов, создание разделов, акции и прочее..
	   </div>
	  </td>
     </tr>
     </table>
	 </span>
	</div>
    
    <div style="margin-top: 10px; padding: 4px" onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
     <span style="width: 100%">
	 <table width="100%" cellpadding="0" cellspacing="0">
     <tr>
	  <td valign="top" align="left" width="54px">
	   <img src="<?php echo @W_SITEPATH; ?>
img/ico/general/news_internet.png" border="0">
	  </td>
	  <td valign="top" align="left">
	   <div><b><a href="<?php echo @W_SITEPATH; ?>
news/2/">Новости интернета</a></b></div>
	   <div style="margin-top: 4px; font-size: 95%; color: #808080">
	    Новости последних событий во всемирной сети Интернет.
	   </div>
	  </td>
     </tr>
     </table>
	 </span>
	</div>	
	
	<div style="padding: 4px; margin-top: 16px"><b><i>Нет активных разделов!</i></b></div>
	
	<?php else: ?>
     
     <div style="text-align: right; margin-bottom: 6px; padding-right: 3px;">
      <a title="RSS канал" href="<?php echo @W_SITEPATH; ?>
rss/1/<?php echo $this->_tpl_vars['CONTROL_OBJ']->CorrectSymplyString($_GET['identway']); ?>
" target="_blank"><img src="<?php echo @W_SITEPATH; ?>
img/ico/general/feed.png" alt="rss" border="0" /></a>
     </div>
    
    
     <?php $_from = $this->_tpl_vars['listnewssections']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
     <?php $this->assign('itemdescrit', $this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextFromDB($this->_tpl_vars['val']['data']['sdescr'])); ?>   
     <div style="margin-top: 10px; padding: 4px" onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
      <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0">
      <tr>
	   <td valign="top" align="left" width="54px">
	    <img src="<?php echo $this->_tpl_vars['val']['avatar']; ?>
" border="0">
	   </td>
	   <td valign="top" align="left">
	    <div><b><a href="<?php echo @W_SITEPATH; ?>
<?php echo $this->_tpl_vars['val']['opt']['pathobjects']; ?>
/<?php echo $this->_tpl_vars['val']['data']['iditem']; ?>
/"><?php echo $this->_tpl_vars['val']['data']['sname']; ?>
</a></b><label style="padding-left: 6px; font-size: 95%; color: #969696"><em>(Содержит: <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetPublicNewsCount($this->_tpl_vars['val']['data']['iditem']); ?>
)</em></label></div>
	    <div style="margin-top: 4px; font-size: 95%; color: #808080">
	     <?php if (! $this->_tpl_vars['itemdescrit']): ?>Нет описания<?php else: ?><?php echo $this->_tpl_vars['itemdescrit']; ?>
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
        <span style="width: 100%">
     <?php if (! $this->_tpl_vars['global_data_list_info']['data']['source']): ?>
      <div style="margin-left: 4px">
	  <?php if ($this->_tpl_vars['section_info']['sectiondataopt'] && $this->_tpl_vars['section_info']['sectiondataopt']['noelementstext']): ?>
	   <?php echo $this->_tpl_vars['section_info']['sectiondataopt']['noelementstext']; ?>

	  <?php else: ?>	  
	   Нет новостей!
	  <?php endif; ?>
	  </div>
     <?php else: ?>  
     
     <div style="text-align: right; margin-bottom: 6px; padding-right: 3px;">
      <a title="RSS канал" href="<?php echo @W_SITEPATH; ?>
rss/1/<?php echo $this->_tpl_vars['CONTROL_OBJ']->CorrectSymplyString($_GET['identway']); ?>
/<?php echo $this->_tpl_vars['CONTROL_OBJ']->CorrectSymplyString($_GET['ntype']); ?>
" target="_blank"><img src="<?php echo @W_SITEPATH; ?>
img/ico/general/feed.png" alt="rss" border="0" /></a>
     </div>     
        
	  <?php $_from = $this->_tpl_vars['global_data_list_info']['data']['source']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
	  <div style="margin-top: <?php if (($this->_foreach['val']['iteration']-1) == 0): ?>6px<?php else: ?>28px<?php endif; ?>; padding: 3px;" onmouseover="DoHigl(this, 1)" onmouseout="DoHigl(this, 0)">
	  <span style="width: 100%">
	  <table width="100%" cellpadding="0" cellspacing="0" border="0">
	  <tr>
	   <td valign="top" align="left" style="<?php if (! $this->_tpl_vars['val']['dwnameimg'] || ! $this->_tpl_vars['global_data_list_info']['showimages']): ?>width: 0px<?php else: ?>width: 68px<?php endif; ?>">
	    <?php if ($this->_tpl_vars['val']['dwnameimg'] && $this->_tpl_vars['global_data_list_info']['showimages']): ?>
	     <img src="<?php echo @W_SITEPATH; ?>
pfiles/images/<?php echo $this->_tpl_vars['val']['dwnameimg']; ?>
" border="0" width="64" height="64" alt="<?php echo $this->_tpl_vars['val']['newtitle']; ?>
" title="<?php echo $this->_tpl_vars['val']['newtitle']; ?>
">
	    <?php endif; ?>
	   </td>
	   
	   <td valign="top" align="left">
	    <div><b><a href="<?php echo @W_SITEPATH; ?>
<?php if ($this->_tpl_vars['section_info']['sectiondataopt']['pathobjects']): ?><?php echo $this->_tpl_vars['section_info']['sectiondataopt']['pathobjects']; ?>
<?php else: ?>news<?php endif; ?>/<?php echo $_GET['ntype']; ?>
/<?php echo $this->_tpl_vars['val']['iditem']; ?>
/<?php if ($_GET['page']): ?>oldpage=<?php echo $_GET['page']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['val']['newtitle']; ?>
</a></b></div>
	    <div style="margin-top: 4px; font-size: 95%; color: #808080">
            
		 <?php echo $this->_tpl_vars['CONTROL_OBJ']->strings->CorrectTextFromDB($this->_tpl_vars['val']['newdata'],false,true,$this->_tpl_vars['val']['contenttype'],180,true); ?>
 
         
		</div>
		<div style="margin-top: 4px; font-size: 95%">
		<?php echo $this->_tpl_vars['CONTROL_OBJ']->DateTimeToSpecialFormat($this->_tpl_vars['val']['datecreate']); ?>
  Просмотров: <?php echo $this->_tpl_vars['val']['newlooks']; ?>
, комментариев: <?php echo $this->_tpl_vars['CONTROL_OBJ']->GetCommentCountForElement($_GET['ntype'],$this->_tpl_vars['val']['iditem']); ?>
 
		</div>
			    
	   </td>	   
	  </tr>
	  </table>
	  </span>
	  </div>
      <?php endforeach; endif; unset($_from); ?>
     <div style="text-align: right; margin-top: 10px"><?php echo $this->_tpl_vars['global_data_list_info']['data']['pagestext']; ?>
</div>
     <?php endif; ?>
    </span>   
   <?php endif; ?>  
  <?php endif; ?> 
 <?php endif; ?> 
</div>