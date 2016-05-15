<?php
 /** модуль загрузки файла пользователем
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 class w_downloadfile_ext extends w_defext {
  const USERS_GROUPS_STYLED = 'text-decoration: underline; color: #016C6C'; 
  const TRANSACTION_NUMBER = 20; //не менять !!
  protected 
   $control;
  
  var $fileObject;
  var $fileInfo;
  var $error = '';
  var $globalerror = false; 
  var $usergroups = false;
  var $online = false;
  var $priced = false;
  /** разрешение скачать
   *  0 - скачивать без ограничения
   *  1 - только после авторизации
   *  2 - только для админов
   *  3 - только для групп
   *  4 - запрещенные группы
   *  5 - файл не найден
   *  
   */ 
  var $accesstype = 0; 
  var $showform = false;
  var $noshowgroupsinfo = false;
   
    
  function __construct(w_Control_obj $control, $fileInfo, /*w_dw_files_object*/ $fileObjectInfo) {
   parent::__construct();
   $this->fileInfo = $fileInfo;
   $this->fileObject = $fileObjectInfo;
   $this->control = & $control;    
  }//__construct
  
  protected function SetError($s) {
    $this->error = $s;
    return false;
  }//SetError
  
  function CheckUserGroups($checkforGroups) {
   if (!$checkforGroups && (!$this->usergroups || !$this->usergroups['data'])) { return false; } 
   foreach ($this->usergroups['data'] as $item) {
    if (@in_array($item['groupiditem'], $checkforGroups)) { return true; }
   }
   return false;    
  }//CheckUserGroups
  
  protected function CanDownLoad() {
    
   $this->accesstype = 0;
   $this->showform = true;
   
   //file not found
   if (!@file_exists($this->fileInfo['fullfilename'])) {
    $this->accesstype = 5;
    $this->showform = false;
    return false;
   }
   
   //lock
   if ($this->online && $this->fileInfo['lockgroups'] && $this->CheckUserGroups($this->fileInfo['lockgroups'])) {
    $this->accesstype = 4;
    $this->showform = false;
    return false;    
   }
   
   //onlie 
   if ($this->fileInfo['onlyonline'] && !$this->online) { 
    $this->accesstype = 1;
    $this->showform = false;
    return false; 
   }
   
   //admins
   if ($this->fileInfo['onlyadmins'] && !$this->control->isadminstatus) { 
    $this->accesstype = 2;
    $this->showform = false;
    return false; 
   }
      
   //priced
   if ($this->priced) { 
    
    if (!$this->online) {
     $this->accesstype = 1;
     $this->showform = false;
     return false;        
    }
    
    if ($this->fileInfo['pricefreefr'] && $this->CheckUserGroups($this->fileInfo['pricefreefr'])) {
     $this->priced = false;
    } 
    
    return true;  
   }
   
   //for groups
   if ($this->fileInfo['fromgroupso']) {
    
    if (!$this->online) {
     $this->accesstype = 1;
     $this->showform = false;
     return false;        
    }
    
    $this->accesstype = 3;
    if (!$this->CheckUserGroups($this->fileInfo['fromgroupso'])) {     
     if (!$this->priced) {   
      $this->showform = false;
      return false;        
     }
    } else { $this->noshowgroupsinfo = true; }      
   }   
   
   return true;  
  }//CanDownLoad
  
  function ExecFile() {
   
   if (!$this->fileObject) { 
    $this->globalerror = true;
    return $this->SetError(w_dw_files_object::$error); 
   }
   
   if (!$this->fileInfo) {
    $this->globalerror = true;
    return $this->SetError('File not found!');    
   }
   
   //ok, parse groups
   $this->fileInfo['fromgroupso'] = @unserialize($this->fileInfo['fromgroupso']);
   $this->fileInfo['pricefreefr'] = @unserialize($this->fileInfo['pricefreefr']);
   $this->fileInfo['lockgroups']  = @unserialize($this->fileInfo['lockgroups']);
   
   $this->online = $this->control->IsOnline();
   $this->priced = $this->fileInfo['useprice'] && $this->fileInfo['pricevalue'] > 0;
   
   if ($this->online) {
    $this->usergroups = $this->control->GetUserGroups(
     $this->control->userdata['iduser'], self::USERS_GROUPS_STYLED
    );
   }
   
   $can_download = $this->CanDownLoad();
   if ($_POST['actiontogetfile'] != 'do') { return true; }
   
   if (!$can_download) { return $this->SetError($this->control->GetText('errorindownloadfile')); }
   
   //pay file
   if ($this->priced) {
    
    $descr = ($this->fileInfo['paydescr']) ? $this->fileInfo['paydescr'] : 
    $this->control->GetText('payfilesdescriptionhistory');
    
    $this->error = $this->control->MoneyProcess(
     $this->control->userdata, @str_replace('@s', $this->fileInfo['fname'], $descr),
     ($this->control->userdata['iduser'] + self::TRANSACTION_NUMBER), 
     $this->fileInfo['pricevalue'], false, 'sub' 
    );
    
    if ($this->error) { return false; }
    
    //send file to mailbox
    $this->control->DoMailWithFile(
     $this->control->userdata['useremail'], 
     $this->control->GetText('subjdownloadfiledata', array($this->fileInfo['fname'], W_HOSTMYSITE)), 
     $this->control->GetText('bodydownloadfiledata', array($this->fileInfo['fname'])).
     $this->control->GetText('bottmessageline'),
     $this->fileInfo['fullfilename'], 
     $this->fileInfo['fname']     
    );
   }
   
   //download
   $this->fileObject->DownLoadFile($this->fileInfo['iditem'], true);
   return $this->SetError('Error in download file!');
  }//ExecFile  
    
 }//w_downloadfile_ext 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>