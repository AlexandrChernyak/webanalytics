<?php
 /** Управление вложениями проекта
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 class w_dw_files_object extends w_defext { 
  protected
   $result,
   $control; 
  
  public static $error = '';  
    
  function __construct(w_Control_obj $control, $result) {
   parent::__construct(); 
   $this->control = & $control; 
   $this->result = $result; 
  }  
  
  /** возвращает параметр из массива $data
  *   В качестве пути по массиву указывается ключ с разделителем,
  *   пример:
  *   GetResult('item')
  *   или
  *   GetResult('item.subitem')
  *   или 
  *   GetResult('item.subitem.subitem')
  *   и т.д. В качестве вложения используется точка в имени ключа результата        
  */
  static function GetResult2($name='', $subname='', $data, w_Control_obj $control) {
   if (!isset($data)) { return false; }		
   if (!$name) { return $data; }
   if ($subname) { $name .= '.'.$subname; }	
   $s   = $name;
   $s1  = $control->StrFetch($s, '.');
   $val = false;
   while ($s || $s1) {
   	if (($val === false && !isset($data[$s1])) || ($val !== false && !isset($val[$s1]))) { return false; }
    $val = ($val === false) ? $data[$s1] : $val[$s1];    
	$s1  = $control->StrFetch($s, '.');	
   }
   return $val; 
  }//GetResult 
  
  static function CreateFromObjectID($filesID, $objectID, w_Control_obj $control, $nounsetinfo=false) {
    
   //check it  
   if (!$objectID || !@is_numeric($objectID) || $objectID < 1) {
    return self::SetError2($control->GetText('nospecifiedidentfilesid'));
   } 
   
   $result = array();  
       
   switch ($filesID) {
    case '1': //articles/news/records
     
     if (!$result['info'] = $control->GetNewsSectionItemTypeData($objectID)) {
      return self::SetError2($control->GetText('nospecifiedidentfilesid'));        
     }   
     
     $path = W_SITEPATH.((self::GetResult2('info.setinfo.pathobjects', '', $result, $control)) ? 
     self::GetResult2('info.setinfo.pathobjects', '', $result, $control) : 'news').'/';
     
     $path2 = array(
      array(
       'name' => ($result['info']['setinfo']['newstitletospec']) ? $result['info']['setinfo']['newstitletospec'] : 'News',
       'path' => $path
      ),
      array(
       'name' => self::GetResult2('info.section.sname', '', $result, $control),
       'path' => $path . self::GetResult2('info.data.newtype', '', $result, $control).'/'
      ),
      array(
       'name' => self::GetResult2('info.data.newtitle', '', $result, $control),
       'path' => $path . self::GetResult2('info.data.newtype', '', $result, $control).'/'.
                 self::GetResult2('info.data.iditem', '', $result, $control).'/',
       'isend'=> true
      )     
     );
      
     $result['block'] = array(
      'name'       => self::GetResult2('info.data.newtitle', '', $result, $control),
      'path'       => $path . self::GetResult2('info.data.newtype', '', $result, $control).'/'.
                      self::GetResult2('info.data.iditem', '', $result, $control).'/',
      'id'         => self::GetResult2('info.data.iditem', '', $result, $control),
      'idfiles'    => $filesID,
      'sectname'   => self::GetResult2('info.section.sname', '', $result, $control),//$control->GetText('recordstitlenamed'),
      'sectpath'   => $path . self::GetResult2('info.data.newtype', '', $result, $control).'/',
      'sectionw'   => $path2,
      'datecreate' => self::GetResult2('info.data.datecreate', '', $result, $control)
     );  
    
    break;
    case '2': //personal pages
     
     require_once W_LIBPATH.'/sp.page.lib.php';
     if (!$result['info'] = w_sp_page_object::GetPageByRealId($objectID, $control)) {
      return self::SetError2($control->GetText('nospecifiedidentfilesid'));  
     }
     
     if ($result['info']['lang'] != $control->GetActiveLanguage() ||
         $result['info']['skin'] != $control->GetActiveSkin()) {
         
       return self::SetError2($control->GetText('nospecifiedidentfilesid'));                   
     }
     
     $result['block'] = array(
      'name'       => self::GetResult2('info.ttitle', '', $result, $control),
      'path'       => W_SITEPATH . self::GetResult2('info.sid', '', $result, $control),
      'id'         => self::GetResult2('info.iditem', '', $result, $control),
      'idfiles'    => $filesID,
      'sectname'   => $control->GetText('genhostdomain'), //$control->GetText('recordstitlenamedpers'),
      'sectpath'   => W_SITEPATH, //false,
      'sectionw'   => false,
      'datecreate' => self::GetResult2('info.datecreate', '', $result, $control)
     );    
    
    break;
     
    default: return self::SetError2($control->GetText('nospecifiedidentfiles'));    
   }    
   
   if (!$nounsetinfo) unset($result['info']);
   
   $obj = new w_dw_files_object($control, $result);
   return $obj;    
  }//CreateFromObjectID
  
  static function SetError2($e) { self::$error = $e; return false; }
    
  function GetResult($name='', $subname='', $data=false) {
   return self::GetResult2($name, $subname, ($data === false) ? $this->result : $data, $this->control);
  }//GetResult 
  
  function GetError() { return self::$error; } 
  function SetError($e) { return self::SetError2($e); }
  
  /** название объекта */
  function GetName() { return $this->result['block']['name']; }
  
  /** полный каталог к объекту (html путь) */
  function GetPath() { return $this->result['block']['path']; }
  
  /** ID объекта */
  function GetID() { return $this->result['block']['id']; }
  
  /** ID типа вложения */
  function GetFilesTypeID() { return $this->result['block']['idfiles']; }
  
  /** имя секции, в которой находится объект */
  function GetSectionName() { return $this->result['block']['sectname']; }
  
  /** путь к секции, в которой находится объект или false, если пути нет */
  function GetSectionPath() { return $this->result['block']['sectpath']; }
  
  /** вложенный путь к объекту, array() */
  function GetFullPath() { return $this->result['block']['sectionw']; }
  
  /** получить список файлов объекта */
  function GetFilesList() {
   if (isset($this->result['fileslist'])) { return $this->result['fileslist']; } else {   
    $list = $this->control->db->mPost(
     "select * from {$this->control->tables_list['filestblst']} where fsection='".$this->GetFilesTypeID()."' and ".
     "fobjectid='".$this->GetID()."'"
    );
    $this->result['fileslist'] = array();
    while ($row = $this->control->db->GetLineArray($list)) {
      $this->result['fileslist'][] = $row; 
    }   
   }
   return $this->result['fileslist'];    
  }//GetFilesList
  
  /** получение списка групп файлов */
  function GetFilesGroups() {
   if (isset($this->result['filesgroupslist'])) { return $this->result['filesgroupslist']; } 
   $files = $this->GetFilesList();
   $names = array();
   foreach ($files as $item) {
    if ($item['groupname'] && !@in_array($item['groupname'], $names)) {
      $names[] = $item['groupname'];   
    }    
   }    
   return $this->result['filesgroupslist'] = $names;
  }//GetFilesGroups
  
  static function _GetFileInfo($ID, w_Control_obj $control) {
    if (!$ID = $control->CorrectSymplyString($ID)) { return false; }
    
    if (!$item = $control->db->GetLineArray($control->db->mPost(
     "select * from {$control->tables_list['filestblst']} where iditem='$ID' limit 1"
    ))) { return false; }
   
    //get file
    $item['fullfilename'] = W_FILESPATH.'/files/'.$item['rname'];
    return $item;    
  }//_GetFileInfo
  
  static function RemoveFile($ID, w_Control_obj $control) {   
   if (!$info = self::_GetFileInfo($ID, $control)) { return false; }
   //remove file
   if (@file_exists($info['fullfilename'])) { @unlink($info['fullfilename']); }
   //remove record
   $control->db->Delete($control->tables_list['filestblst'], "iditem='{$info['iditem']}'", "1");
   return true;       
  }//RemoveFile
  
  /** удаление файла */
  function DeleteFile($ID) { return self::RemoveFile($ID, $this->control); }
  
  function DeleteAllFiles($filesID, $objectID) {
    return self::RemoveAllObjectFiles($filesID, $objectID, $this->control);
  }//DeleteAllFiles
  
  /** удаление всех файлов */
  static function RemoveAllObjectFiles($filesID, $objectID, w_Control_obj $control) {
   $list = $control->db->mPost(
    "select iditem from {$control->tables_list['filestblst']} where fobjectid='$objectID' ".
    "and fsection='$filesID'"
   );
   while ($row = $control->db->GetLineArray($list)) {
    self::RemoveFile($row['iditem'], $control);    
   }   
  }//RemoveAllObjectFiles
  
  /** скачивание файла */
  function DownLoadFile($ID, $incstatistic=false) {
   if (!$info = self::_GetFileInfo($ID, $this->control)) { return false; }
   //if file exists
   if (!@file_exists($info['fullfilename'])) { return false; }
   //create file header
   $this->control->WriteDownLoadFileHeader($info['fname'], $info['fsize']);
   //update count
   if ($incstatistic) {
    $this->control->db->UPDATEAction('filestblst', array('dwcount' => $info['dwcount'] + 1),
    "iditem='{$info['iditem']}'", "1");
   }
   //read file
   @readfile($info['fullfilename']);
   exit;    
  }//$fileInfo   
    
 }//w_dw_files_object   
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>