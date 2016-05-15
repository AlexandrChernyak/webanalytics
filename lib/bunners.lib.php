<?php
 /** Управление рекламой баннеров проекта
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 class w_adv_bunners_object extends w_defext { 
  const PAY_TRANSACTION_NAMBER = 21; /* не менять */  
  protected
   $control,
   $result;   
    
  function __construct(w_Control_obj $control) {
   parent::__construct(); 
   $this->control = & $control; 
  }  
  
  static function RemoveBanner($bannerID, w_Control_obj $control) {  
   if (@is_array($bannerID)) { $data = $bannerID; } else {    
    if (!$bannerID = $control->CorrectSymplyString($bannerID)) { return false; }
    $data = $control->db->GetLineArray($control->db->mPost(
     "select iditem,rname from {$control->tables_list['bunnerlist']} where iditem='$bannerID' limit 1"
    ));   
   }  
   if (!$data) { return false; }   
   if ($data['rname'] && @file_exists(W_FILESPATH.'/images/'.$data['rname'])) {
    @unlink(W_FILESPATH.'/images/'.$data['rname']);
   }  
   $control->db->Delete($control->tables_list['bunnerlist'], "iditem='{$data['iditem']}'", "1");   
  }//RemoveBanner 
  
  static function RemoveAllBanners($groupID, w_Control_obj $control) {
   if (!$groupID = $control->CorrectSymplyString($groupID)) { return false; } 
   $list = $control->db->mPost(
    "select iditem,rname from {$control->tables_list['bunnerlist']} where groupid='$groupID'"
   );
   while ($row = $control->db->GetLineArray($list)) {
    self::RemoveBanner($row, $control);
   } 
   return true;    
  }//RemoveAllBanners
  
  static function GetGroupInfo($groupID, w_Control_obj $control) {
   return $control->db->GetLineArray($control->db->mPost(
    "select * from {$control->tables_list['bunnerssec']} where iditem='$groupID' and groupactive='1' limit 1"
   ));    
  }//GetGroupInfo
  
  static function BannersInGroupCount($groupID, w_Control_obj $control) { 
   return $control->GetCountInTable(
    'iditem', 'bunnerlist', "where activeobj='1' and ispayed='1' and groupid='$groupID'"
   );     
  }//BannersInGroupCount
  
  /**
    1 - нет доступа ни к одному из файлов баннеров
    2 - нет цен
    3 - нет размеров
    4 - не активно
    5 - превышено максимальное кол-во
  */
  static function GetGroupAccessType($placeInfo, w_Control_obj $control) {
   if (!$placeInfo['groupactive']) { return 4; }
   
   elseif (!$placeInfo['filesuse'] && !$placeInfo['linksuse']) { return 1; }
   
   elseif ($placeInfo['pricetolook'] <= 0 && $placeInfo['pricetodays'] <= 0) { return 2; }
   
   elseif (!$placeInfo['groupwidth'] || !$placeInfo['groupheight']) { return 3; } 
   
   elseif ($placeInfo['maxbunners'] && $placeInfo['maxbunners'] <= self::BannersInGroupCount($placeInfo['iditem'], $control)) { return 5; }
   
   else { return 0; }    
  }//GetGroupAccessType
  
  //clear old banners
  static function ClearAllOldBanners($userid=false, w_Control_obj $control) {      
   $addwhere = ($userid) ? "and t1.userid='$userid' and " : 'and'; 
   $result = false;   
   $list = $control->db->mPost(
    "select t1.iditem,t1.rname from {$control->tables_list['bunnerlist']} as t1 INNER JOIN {$control->tables_list['bunnerssec']} as t2 ON (t1.groupid=t2.iditem and t2.clearonoffbun='1' and t1.ispayed='0' and t1.activeobj='1' $addwhere TIMEDIFF(ADDTIME(t1.datecreate, '0 24:00:00.000000'), NOW()) < 0)"
   ); 
   while ($row = $control->db->GetLineArray($list)) {
    if (!$result) { $result = true; }
    self::RemoveBanner($row, $control);
   } 
   return $result;    
  }//ClearAllOldBanners
  
  protected function GetMyBannersCount($active=1) {
   $ispayed = ($active) ? " and ispayed='1' and activeobj='1'" : " and (ispayed='0' or activeobj='0')";        
   return $this->control->GetCountInTable(
    'iditem', 'bunnerlist', "where userid='{$this->control->userdata['iduser']}'".$ispayed
   );    
  }//GetMyBannersCount  
  
  function GetResult($name='', $subname='', $data=false) {  
   return w_dw_files_object::GetResult2(
    $name, $subname, ($data === false) ? $this->result : $data, $this->control
   );
  }//GetResult 
  
  function GetPlaceList() {
   $this->result['placelist'] = array();
   $list = $this->control->db->mPost(
    "select * from {$this->control->tables_list['bunnerssec']} where groupactive='1' and lang='".
    $this->control->GetActiveLanguage()."'"
   );
   while ($row = $this->control->db->GetLineArray($list)) {
    $this->result['placelist'][] = $row;
   }
   return $this->result['placelist'];    
  }//GetPlaceList
  
  protected function SetError($s) { 
   $this->result['error'] = $s;
   return false;
  }//SetError
  
  protected function ExecMyBannersWithAjaxMode() {
   $result = '';
   
   switch ($_POST['pt']) {
    
    //add time to banner
    case '1':
     
     if (!$_POST['id'] = $this->CorrectSymplyString($_POST['id'])) {
      return 'Unknow banner ID!';  
     }
     
     if (!$_POST['value'] || !@is_numeric($_POST['value'])) { return 'Unknow interval for add!'; }
     
     if (!$item = $this->control->db->GetLineArray($this->control->db->mPost(
      "select * from {$this->control->tables_list['bunnerlist']} where iditem='{$_POST['id']}' and ".
      "activeobj='1' and ispayed='1' and userid='{$this->control->userdata['iduser']}' limit 1"
     ))) {
      $result = 'Unknow banner ID!';
      break;  
     }
     
     if (!$group = self::GetGroupInfo($item['groupid'], $this->control)) {
      $result = 'Unknow group ID';
      break;  
     }

     
     $price = 0;
     $pricedescr = '';
     $params = array();
     $leftitem = 0;
     
     switch ($item['setbytype']) {
        
      //by looks
      case '0':
       
       if ($_POST['value'] < 100) { return 'Value not in interval >= 100 hits!'; }
       if ($group['pricetolook'] <= 0) { return 'No defined price for this place per 1000 hits!'; }
       
       $price = ($_POST['value'] * $group['pricetolook'] / 1000);
       
       $pricedescr = $this->control->GetText('pricebannerlookcount', array(
        $group['groupname'], $_POST['value']
       )); 
       
       $params['forlooks'] = ($item['forlooks'] + $_POST['value']);      
       $leftitem = ($params['forlooks'] - $item['lookcount']);
       
      break;
      
      //by days
      case '1':
      
       if ($_POST['value'] < 1) { return 'Value not in interval >= 1 days!'; }
       if ($group['pricetodays'] <= 0) { return 'No defined price for this place per 1 day!'; }
       
       $price = ($_POST['value'] * $group['pricetodays']);
      
       $pricedescr = $this->control->GetText('pricebannerdayscount', array(
        $group['groupname'], $_POST['value']
       ));
       
       $params['fordays'] = ($item['fordays'] + $_POST['value']);
       $leftitem = ($params['fordays'] - $item['lookdcount']);
      
      break;  
        
      default: $result = 'Unknow set banner time type!'; break;  
     }
     
     if ($result) { break; }
     
     if ($price <= 0) {
      $result = 'No defined price for this banner place!';
      break;  
     }
     
     if ($result = $this->control->MoneyProcess($this->control->userdata, 
      $pricedescr, ($this->control->userdata['iduser'] + self::PAY_TRANSACTION_NAMBER), $price, false, 'sub'
     )) { return $result; }
     
     //ok, update element
     if (!$this->control->db->UPDATEAction('bunnerlist', $params, "iditem='{$item['iditem']}'", "1")) {
      return 'Error in update banner record ['.$this->control->db->GetError().']';  
     }
     
     //ok, done
     $result = $leftitem;
     
     //inform user about activate banner
     $this->control->DoMailX(
      $this->control->userdata['useremail'], 
      $this->control->GetText('activatebannertitle', array(
       $group['groupname'], W_HOSTMYSITE
      )), 
      $this->control->GetText('banneractivatemessage', array($group['groupname'], 
       ($params['forlooks']) ? $params['forlooks'] : 0,
       ($params['fordays']) ? $params['fordays'] : 0,      
      )).$this->control->GetText('bottmessageline')
     );
     
     //inform administrator about new banner
     $this->control->DoMailX(W_ADMINEMAIL, $this->control->GetText('activatebannertitle', array(
       $group['groupname'], W_HOSTMYSITE
      )).' by '.$this->control->userdata['username'],
      $this->control->GetText('activatebanneraddwadmin', array(
       $this->control->userdata['username'], $group['groupname'],
       'http://'.W_HOSTMYSITE.'/account/admbunnerscontrol/?group='.$group['iditem']
      )).$this->control->GetText('bottmessageline')     
     );            
    
    break;    
    
    default: $result = 'Unknow action ID'; break;
   }
    
   return $result; 
  }//ExecMyBannersWithAjaxMode
  
  function ExecMyBanners() {   
   if (@defined('W_IS_AJAX_MODE_RUN')) {  print $this->ExecMyBannersWithAjaxMode();  exit; }
          
   //run default mode banners 
   require_once W_LIBPATH.'/files.lib.php';
   $this->result = array(
    'acount' => $this->GetMyBannersCount(),
    'icount' => $this->GetMyBannersCount(0)
   ); 
   
   //добавление баннера
   if ($_GET['new']) {
    //no selected
    if (!$_GET['placeb']) { return true; }
    
    //get group info
    $_GET['placeb'] = $this->CorrectSymplyString($_GET['placeb']);
    $this->result['groupinfo'] = self::GetGroupInfo($_GET['placeb'], $this->control);
    
    //доступ к добавлению
    if ($this->result['groupinfo']) {
     
     //тип доступа
     $this->result['accesstoadd'] = self::GetGroupAccessType($this->result['groupinfo'], $this->control);
     if ($this->result['accesstoadd']) { return false; }
                   
    } else { return true; }
    
    //ok, список допустимых типов файлов
    $this->result['filetypeslist'] = array(".gif", ".jpg", ".png", ".jpeg");
    //add flash, if access is
    if ($this->result['groupinfo']['useflash']) {
     $this->result['filetypeslist'][] = ".swf";  
    }
    
    //file size, (max file size), if files download is active
    if ($this->result['groupinfo']['filesuse']) {
     $this->result['filesizedwload'] = $this->result['groupinfo']['maxfilesize'] * 1024;        
    } else {
     $this->result['filesizedwload'] = false;   
    }
    
    //check to add
    if ($_POST['doactionaddbannerex'] != 'do') { return true; }
    
    //---------------------- banner file type
    $err_unknow = 'Unknow banner type!';
    $FILE_INFO  = false;
    
    $params = array(
     'groupid' => $this->result['groupinfo']['iditem'],
     'userid'  => $this->control->userdata['iduser']
    );
    
    switch ($_POST['banntype']) {
     
     //file   
     case '0':
      if (!$this->result['groupinfo']['filesuse']) { return $this->SetError($err_unknow); }             
       
      $FILE_INFO = $this->control->UpLoadFile(
        'bfile', $this->result['filetypeslist'], $this->result['groupinfo']['maxfilesize'], 
        W_FILESPATH.'/images/', 0, 0, false, -1, '' 
      ); 
      
      if ($FILE_INFO['result']) { return $this->SetError($FILE_INFO['result']); }
      
      $FILE_INFO['fullfilename'] = W_FILESPATH.'/images/'.$FILE_INFO['newname'];
      if (!@file_exists($FILE_INFO['fullfilename'])) { 
       return $this->SetError('Error in download banner file. File not exists!'); 
      }
            
      //check width and height
      if ($FILE_INFO['type'] != '.swf' && (!$this->result['groupinfo']['widthpersent'] || !$this->result['groupinfo']['heightpersent'])) {
            
       require_once W_LIBPATH.'/graph.lib.php';
       
       if (!$image = w_image_obj::CreateFromFile($FILE_INFO['fullfilename'], $FILE_INFO['type'])) {
        @unlink($FILE_INFO['fullfilename']);
        return $this->SetError('Error in get Image Width and Height! Image file is invalid'); 
       }
       
       //width
       if (!$this->result['groupinfo']['widthpersent']) {      
        
        if (!$w = $image->GetImageWidth()) {
          @unlink($FILE_INFO['fullfilename']);
          return $this->SetError('Error in file format! This is not Image file, or file is invalid!');  
        }      
                
        if ($w > $this->result['groupinfo']['groupwidth']) { 
         @unlink($FILE_INFO['fullfilename']);   
         return $this->SetError($this->control->GetText('imgwidthnomatch', array($w)));
        }
        $params['widthobj'] = $w;
                 
       } else { $params['widthobj'] = $this->result['groupinfo']['groupwidth']; }
       
       //height
       if (!$this->result['groupinfo']['heightpersent']) {      
        
        if (!$h = $image->GetImageHeight()) {
          @unlink($FILE_INFO['fullfilename']);
          return $this->SetError('Error in file format! This is not Image file, or file is invalid!');  
        }
        
        if ($h > $this->result['groupinfo']['groupheight']) {  
         @unlink($FILE_INFO['fullfilename']);   
         return $this->SetError($this->control->GetText('imgheightnomatch', array($h)));
        }  
        $params['heightobj'] = $h;
               
       } else { $params['heightobj'] = $this->result['groupinfo']['groupheight']; }
              
       $image->DestroyImage();        
      } else {
        //w and h, check and read
        
        $params['widthobj']  = $this->result['groupinfo']['groupwidth']; 
        $params['heightobj'] = $this->result['groupinfo']['groupheight'];
        
      }
      
      if ($FILE_INFO['type'] == '.swf') {
        $params['isflashobj'] = 1;
      }
      
      //fileinfo
      $params['rname']   = $FILE_INFO['newname'];
      $params['sizeobj'] = $FILE_INFO['filesizebyte'];     
                      
     break;
      
     //link 
     case '1': 
      if (!$this->result['groupinfo']['linksuse']) {        
        return $this->SetError($err_unknow);
      }
      
      if (!$_POST['blink'] = trim($this->CorrectSymplyString($_POST['blink']))) {      
       return $this->SetError($this->control->GetText('setalinktobannerfile'));
      }
      
      if ($this->strtolower($_POST['blink']) == 'http://') {
       return $this->SetError($this->control->GetText('setalinktobannerfile')); 
      } 
      
      $params['lname'] = $this->substr($_POST['blink'], 0, 210);
      
      if ($this->result['groupinfo']['useflash']) {
       $params['isflashobj'] = ($this->CheckPostValue('isflashobj')) ? 1 : 0;
      } 
    
      //check width and height
      if (!$this->result['groupinfo']['useflash'] || !$this->CheckPostValue('isflashobj')) {
            
       require_once W_LIBPATH.'/graph.lib.php';
       
       if (!$image = w_image_obj::CreateFromFile($_POST['blink'], false, true)) {
        return $this->SetError('Error in get Image Width and Height! Image file is invalid'); 
       }
       
       //width
       if (!$this->result['groupinfo']['widthpersent']) {      
        
        if (!$w = $image->GetImageWidth()) {
          return $this->SetError('Error in file format! This is not Image file, or file is invalid!');  
        }      
                
        if ($w > $this->result['groupinfo']['groupwidth']) {   
         return $this->SetError($this->control->GetText('imgwidthnomatch', array($w)));
        }
        $params['widthobj'] = $w;
                 
       } else { $params['widthobj'] = $this->result['groupinfo']['groupwidth']; }
       
       //height
       if (!$this->result['groupinfo']['heightpersent']) {      
        
        if (!$h = $image->GetImageHeight()) {
          return $this->SetError('Error in file format! This is not Image file, or file is invalid!');  
        }
        
        if ($h > $this->result['groupinfo']['groupheight']) {    
         return $this->SetError($this->control->GetText('imgheightnomatch', array($h)));
        }  
        $params['heightobj'] = $h;
               
       } else { $params['heightobj'] = $this->result['groupinfo']['groupheight']; }
              
       $image->DestroyImage();        
      } else {
        //w and h, check and read
        
        $params['widthobj']  = $this->result['groupinfo']['groupwidth']; 
        $params['heightobj'] = $this->result['groupinfo']['groupheight'];
        
      }       
      
     break;
     
     default: return $this->SetError($err_unknow);   
    }
    
    //ok, href check
    if (!$_POST['hreflink'] = trim($this->CorrectSymplyString($_POST['hreflink']))) {
     if ($FILE_INFO) @unlink($FILE_INFO['fullfilename']);   
     return $this->SetError($this->control->GetText('setalinktohrefdataf'));   
    }
    
    if ($this->strtolower($_POST['hreflink']) == 'http://') {
     if ($FILE_INFO) @unlink($FILE_INFO['fullfilename']);   
     return $this->SetError($this->control->GetText('setalinktohrefdataf')); 
    }
    
    $params['hrefdata'] = $this->substr($_POST['hreflink'], 0, 170);
    
    $price = 0.00;
    $pricedescr = '';
    $err_unknow = 'Unknow set banner type';
    
    switch ($_POST['paytype']) {
     
     //look count
     case '0':
      
      if ($this->result['groupinfo']['pricetolook'] <= 0) {
       if ($FILE_INFO) @unlink($FILE_INFO['fullfilename']); 
       return $this->SetError($err_unknow); 
      }
      
      if (!$_POST['forlooks'] || !@is_numeric($_POST['forlooks']) || $_POST['forlooks'] < 100) {
       if ($FILE_INFO) @unlink($FILE_INFO['fullfilename']); 
       return $this->SetError($this->control->GetText('bannocorrectcountlook')); 
      }
      
      $price = ($_POST['forlooks'] * $this->result['groupinfo']['pricetolook'] / 1000);
      
      if ($price <= 0) { 
       if ($FILE_INFO) @unlink($FILE_INFO['fullfilename']);
       return $this->SetError($err_unknow);  
      }  
      
      $pricedescr = $this->control->GetText('pricebannerlookcount', array(
       $this->result['groupinfo']['groupname'], $_POST['forlooks']
      ));
      
      $params['setbytype'] = 0;
      $params['forlooks']  = $_POST['forlooks'];     
     
     break;
     
     //days count
     case '1':
      
      if ($this->result['groupinfo']['pricetodays'] <= 0) {
       if ($FILE_INFO) @unlink($FILE_INFO['fullfilename']); 
       return $this->SetError($err_unknow); 
      }
      
      if (!$_POST['fordays'] || !@is_numeric($_POST['fordays']) || $_POST['fordays'] < 1) {
       if ($FILE_INFO) @unlink($FILE_INFO['fullfilename']); 
       return $this->SetError($this->control->GetText('bannocorrectcountday')); 
      }
      
      $price = ($_POST['fordays'] * $this->result['groupinfo']['pricetodays']);
      
      if ($price <= 0) { 
       if ($FILE_INFO) @unlink($FILE_INFO['fullfilename']);
       return $this->SetError($err_unknow);  
      }
      
      $pricedescr = $this->control->GetText('pricebannerdayscount', array(
       $this->result['groupinfo']['groupname'], $_POST['fordays']
      ));
      
      $params['setbytype'] = 1;
      $params['fordays']   = $_POST['fordays'];
      
     break;
     
     default: 
      if ($FILE_INFO) { @unlink($FILE_INFO['fullfilename']); }
      return $this->SetError($err_unknow);        
    }
    
    //pay this
    if (!$this->result['groupinfo']['usemoder']) {
      
      $error = $this->control->MoneyProcess($this->control->userdata, 
       $pricedescr, ($this->control->userdata['iduser'] + self::PAY_TRANSACTION_NAMBER), $price, false, 'sub'
      );
      
      if ($error) { 
       if ($FILE_INFO) @unlink($FILE_INFO['fullfilename']);
       return $this->SetError($error); 
      }
      
      $params['activeobj'] = 1;
      $params['ispayed'] = 1;  
    } 
    
    $params['datecreate'] = $this->GetThisDateTime();
    $params['datenow']    = $this->GetThisDate();    
    
    //create new record
    if (!$this->control->db->INSERTAction('bunnerlist', $params)) {
     if ($FILE_INFO) @unlink($FILE_INFO['fullfilename']);
     return $this->SetError('Error in add new banner record ['.$this->control->db->GetError().']');   
    }
        
    if (!$this->result['groupinfo']['usemoder']) {
     $this->result['acount']++;
    } else {
     $this->result['icount']++; 
    }
    
    //inform administrator, if moder is actually
    if ($this->result['groupinfo']['usemoder']) {  
        
     $this->control->DoMailX(W_ADMINEMAIL, $this->control->GetText('banneraddtomoderst').' ['.W_HOSTMYSITE.']',
      $this->control->GetText('banneraddtomoderstdata', array(
       $this->control->userdata['username'], $this->result['groupinfo']['groupname'],
       'http://'.W_HOSTMYSITE.'/account/admbunnerscontrol/?group='.$this->result['groupinfo']['iditem'].
       '&onlybanner='.$this->control->db->InseredIndex()              
      )).$this->control->GetText('bottmessageline') 
     );    
      
    } else {
        
     //inform user about activate banner
     $this->control->DoMailX(
      $this->control->userdata['useremail'], 
      $this->control->GetText('activatebannertitle', array(
       $this->result['groupinfo']['groupname'], W_HOSTMYSITE
      )), 
      $this->control->GetText('banneractivatemessage', array(
       $this->result['groupinfo']['groupname'], 
       ($params['forlooks']) ? $params['forlooks'] : 0,
       ($params['fordays']) ? $params['fordays'] : 0,      
      )).$this->control->GetText('bottmessageline')
     );
     
     //inform administrator about new banner
     $this->control->DoMailX(W_ADMINEMAIL, $this->control->GetText('activatebannertitle', array(
       $this->result['groupinfo']['groupname'], W_HOSTMYSITE
      )).' by '.$this->control->userdata['username'],
      $this->control->GetText('activatebanneraddwadmin', array(
       $this->control->userdata['username'], $this->result['groupinfo']['groupname'],
       'http://'.W_HOSTMYSITE.'/account/admbunnerscontrol/?group='.$this->result['groupinfo']['iditem']
      )).$this->control->GetText('bottmessageline')     
     ); 
             
    }   
 
    return true; 
   }
   
   //action from list items
   $is_modified = false;
   
   switch ($_POST['actionlistmakes']) {
   	//delete all items
	case 'dall': $this->DeleteAllUserBanners(); $is_modified = true; break;
	//del selected items
	case 'delete': 
     $count = ($_GET['moderl']) ? $this->result['icount'] : $this->result['acount'];
     $this->TransformPostItems(array($this, 'DeleteUserBannerItem'), $count);
     $is_modified = true;
    break;  	 
   }
   
   //clear old banners, only if moderation section is active
   if ($_GET['moderl'] && self::ClearAllOldBanners(
       $this->control->userdata['iduser'], $this->control) && !$is_modified
   ) {
    $is_modified = true;
   }  
   
   //restore count
   if ($is_modified) {     
    $this->result['acount'] = $this->GetMyBannersCount();
    $this->result['icount'] = $this->GetMyBannersCount(0);
    if ($_GET['payitem']) { $_GET['payitem'] = false; }
   } 
   
   //pay one of banner item
   if ($_GET['payitem'] && @is_numeric($_GET['payitem'])) {
    
    $_GET['payitem'] = $this->CorrectSymplyString($_GET['payitem']);
    $this->result['payerror'] = '';
    
    if ($info = $this->control->db->GetLineArray($this->control->db->mPost(
     "select * from {$this->control->tables_list['bunnerlist']} where ispayed='0' and activeobj='1' and ".
     "iditem='{$_GET['payitem']}' and userid='{$this->control->userdata['iduser']}' limit 1"
    ))) {
     
     //ok, pay it
     $price = 0.00;
     $pricedescr = '';
     $groupinfo = self::GetGroupInfo($info['groupid'], $this->control);     
     $params2 = array();
     
     switch ($info['setbytype']) {
      //looks
      case '0':
       
       if (!$groupinfo['pricetolook'] || $groupinfo['pricetolook'] <= 0) {
        $this->result['payerror'] = 'Price not defined!';
        break;
       }
       
       $price = ($info['forlooks'] * $groupinfo['pricetolook'] / 1000);
      
       $pricedescr = $this->control->GetText('pricebannerlookcount', array(
        $groupinfo['groupname'], $info['forlooks']
       ));
       
       $params2['forlooks'] = $info['forlooks'] * 2;
        
      break;
      //days
      case '1':
       
       if (!$groupinfo['pricetodays'] || $groupinfo['pricetodays'] <= 0) {
        $this->result['payerror'] = 'Price not defined!';
        break;
       }
       
       $price = ($info['fordays'] * $groupinfo['pricetodays']);
      
       $pricedescr = $this->control->GetText('pricebannerdayscount', array(
        $groupinfo['groupname'], $info['fordays']
       ));
       
       $params2['fordays'] = $info['fordays'] * 2;
       
      break;
      //error      
      default: $this->result['payerror'] = 'Unknow pay type!'; break;  
     }   
     
     if ($price > 0) {
      //pay
        
      $this->result['payerror'] = $this->control->MoneyProcess($this->control->userdata, 
       $pricedescr, ($this->control->userdata['iduser'] + self::PAY_TRANSACTION_NAMBER), $price, false, 'sub'
      );
      
      if ($this->result['payerror']) {
       $this->result['payerror'] = $this->CorrectSymplyString($this->result['payerror']);        
      } else {
       
       $params2['ispayed']    = 1;
       $params2['datecreate'] = $this->GetThisDateTime();
       $params2['datenow']    = $this->GetThisDate();
       
       if ($params2['datenow'] != $info['datenow']) {
        $params2['looktoday']  = 0;
        $params2['visittoday'] = 0;
       }       
        
       //update information
       if ($this->control->db->UPDATEAction('bunnerlist', $params2, "iditem='{$info['iditem']}'", "1")) {
        
        $this->result['acount']++;
        $this->result['icount']--;
        $this->result['payerror'] = 'Successfully: '.$this->CorrectSymplyString($pricedescr);
        
        //inform user about activate banner
        $this->control->DoMailX(
         $this->control->userdata['useremail'], 
         $this->control->GetText('activatebannertitle', array(
          $groupinfo['groupname'], W_HOSTMYSITE
         )), 
         $this->control->GetText('banneractivatemessage', array($groupinfo['groupname'], 
          ($info['forlooks']) ? $info['forlooks'] : 0,
          ($info['fordays']) ? $info['fordays'] : 0,      
         )).$this->control->GetText('bottmessageline')
        );
     
        //inform administrator about new banner
        $this->control->DoMailX(W_ADMINEMAIL, $this->control->GetText('activatebannertitle', array(
          $groupinfo['groupname'], W_HOSTMYSITE
         )).' by '.$this->control->userdata['username'],
         $this->control->GetText('activatebanneraddwadmin', array(
          $this->control->userdata['username'], $groupinfo['groupname'],
          'http://'.W_HOSTMYSITE.'/account/admbunnerscontrol/?group='.$groupinfo['iditem']
         )).$this->control->GetText('bottmessageline')     
        );               
        
       } else {
        
        $this->result['payerror'] = 'Error in modify banner record!';
        
       }          
      }
        
        
     }             
    }    
   }   
   
   //get banners list
   $active = ($_GET['moderl']) ? 0 : 1;
   $ispayed = ($active) ? " and ispayed='1' and activeobj='1'" : " and (ispayed='0' or activeobj='0')";
   
   $list = $this->control->db->mPost(
    "select *,ADDTIME(datecreate, '0 24:00:00.000000') as hoursleft from ".
    "{$this->control->tables_list['bunnerlist']} where userid='{$this->control->userdata['iduser']}'".
    "$ispayed order by iditem DESC"
   );   
   
   $result = array();
   while ($row = $this->control->db->GetLineArray($list)) {  
    $row['webimagefile'] = ($row['rname']) ? W_SITEPATH.W_FILESWEBPATH.'/images/'.$row['rname'] : $row['lname'];
    $row['groupinfo']    = self::GetGroupInfo($row['groupid'], $this->control);
    if ($row['groupinfo']) {
     
     if (!$row['ispayed']) {     
       switch ($row['setbytype']) {      
        //for looks
        case '0':
         
         if ($row['groupinfo']['pricetolook'] <= 0) {
          $row['pricetopay'] = 0;
          break;  
         }
         
         $row['pricetopay'] = ($row['forlooks'] * $row['groupinfo']['pricetolook'] / 1000);
         
        break;       
        //for days
        case '1':
         
         if ($row['groupinfo']['pricetodays'] <= 0) {
          $row['pricetopay'] = 0;
          break;  
         }
         
         $row['pricetopay'] = ($row['fordays'] * $row['groupinfo']['pricetodays']);
                
        break;       
        //unknow
        default: $row['pricetopay'] = 0; break;        
       }
       
       if ($row['groupinfo']['clearonoffbun'] && $row['activeobj'] && !$row['ispayed']) {
        $row['forpayislast'] = ss_Plugin_GenWhoisDomainEx::GetDateDiffInterval2(
         $this->GetThisDateTime(), $row['hoursleft']
        );
       }       
     }   
     
     //hide today looks, visits if date is diff
     if ($row['datenow'] && $row['datenow'] != $this->GetThisDate()) {
       $row['looktoday']  = 0;
       $row['visittoday'] = 0;               
     }
        
     $result[] = $row;    
    }
   }
   
   $this->result['datalist'] = $result;
   return true;
  }//ExecMyBanners 
  
  static function GetCTR2($bannerInfo) {
   $value = 0;
   if ($bannerInfo['lookcount']) {
    $value = ($bannerInfo['visitcount'] / $bannerInfo['lookcount']) * 100;
   }
   return "$value%";    
  }//GetCTR2
  
  function GetCTR($bannerInfo) {
   return self::GetCTR2($bannerInfo); 
  }//GetCTR
  
  //run for items list (every item)
  function TransformPostItems($iter, $perpage_count=15) {
   if (!$perpage_count) { return false; } 
   for ($i=0; $i<=$perpage_count; $i++) {
	if ($this->CheckPostValue('chid'.$i) && isset($_POST['idm'.$i]) && $_POST['idm'.$i]) {
	 @call_user_func($iter, $this->CorrectSymplyString($_POST['idm'.$i]));	 	
	}	
   }
   return true;      	
  }//TransformPostItems
  
  protected function DeleteUserBannerItem($id) {  
   if (@is_array($id)) { $data = $id; } else {
    $data = $this->control->db->GetLineArray($this->control->db->mPost(
     "select iditem,rname,userid from {$this->control->tables_list['bunnerlist']} where ".
     "userid='{$this->control->userdata['iduser']}' and iditem='$id' limit 1" 
    ));    
   }  
   if (!$data || $data['userid'] != $this->control->userdata['iduser']) { return false; }   
   self::RemoveBanner($data, $this->control);
   return true;    
  }//DeleteUserBannerItem
  
  protected function DeleteAllUserBanners() {
   $active  = ($_GET['moderl']) ? 0 : 1;
   $ispayed = ($active) ? " and ispayed='1' and activeobj='1'" : " and (ispayed='0' or activeobj='0')";
   
   $list = $this->control->db->mPost(
    "select iditem,rname,userid from {$this->control->tables_list['bunnerlist']} where ".
    "userid='{$this->control->userdata['iduser']}'".$ispayed
   );
   
   while ($row = $this->control->db->GetLineArray($list)) {
    $this->DeleteUserBannerItem($row);
   }
   return true; 
  }//DeleteAllUserBanners       
    
 }//w_adv_bunners_object   
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>