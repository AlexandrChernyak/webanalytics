<?php
 /** модуль страницы реклама на сайте
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 class w_adv_page_object extends w_defext {
  protected
   $control,
   $result;  
  
  function __construct(w_Control_obj $control) {
   parent::__construct();
   $this->control = & $control; 
   require_once W_LIBPATH.'/files.lib.php';
   $this->result = array();
  }  
  
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
  
  function GetMaxSize($data) {
   return $this->control->GetStrSizeFromBytes($data['maxfilesize'] * 1024);     
  }//GetMaxSize 
    
 }//w_adv_page_object
 //-------------------------------------------------------------------------------------
 $CONTROL_OBJ->smarty->assign('adv_object', new w_adv_page_object($CONTROL_OBJ)); 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>