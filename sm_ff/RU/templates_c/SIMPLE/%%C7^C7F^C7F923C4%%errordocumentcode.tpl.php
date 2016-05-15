<?php /* Smarty version 2.6.26, created on 2013-11-12 17:56:11
         compiled from errordocumentcode.tpl */ ?>
<div>
 <?php if ($_GET['errcode'] == '404'): ?>
  The requested URL <u><?php echo $_SERVER['REQUEST_URI']; ?>
</u> was not found on this server. 
 <?php endif; ?>
 
 <?php if ($_GET['errcode'] == '403'): ?>
  You don't have permission to access <u><?php echo $_SERVER['REQUEST_URI']; ?>
</u> on this server. 
 <?php endif; ?>
 
 <?php if ($_GET['errcode'] == '401'): ?>
  This server could not verify that you are authorized to access the document requested. Either you supplied the wrong credentials (e.g., bad password), or your browser doesn't understand how to supply the credentials required. 
 <?php endif; ?>
 
 <?php if ($_GET['errcode'] == '400'): ?>
  There was an error in your request. 
 <?php endif; ?>
</div>