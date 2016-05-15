<?php
 /** Модуль управления инструментом `информер pr cy`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_prcyinformer extends w_toolitem_noajax_method {
  /** тип информеров */
  const CUR_INFORMER_TYPE = 3; //информер pr cy 			
  protected
   $result,
   $inf;
   
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->inf = null;   	
  }//__construct     
   
  /** объект информеров */
  protected function CheckInf() {
   if ($this->inf !== null) { return $this->inf; }
   require_once W_LIBPATH.'/informer.control.lib.php';
   return $this->inf = new w_informer_obj(
    $this->control, self::CUR_INFORMER_TYPE, $this->GetToolLimitInfoEx('updateeveryminute'),
    $this->GetToolLimitInfoEx('updateifexistsinf')
   );	
  }//CheckInf
  
  /** удаление устаревших данных информеров */
  protected function DeleteOldInformers() {
   require_once W_LIBPATH.'/informer.control.lib.php';
   return w_informer_obj::DeleteOldRecords($this->control, self::CUR_INFORMER_TYPE, 
    $this->GetToolLimitInfoEx('deleteoldaccminf'), $this->GetToolLimitInfoEx('checkfordeletels')
   );   	
  }//DeleteOldInformers      
       
  function _DoActionThisTool() {		  	 
   //show image for template
   if ($_GET['getimage'] && $this->CheckInf()->GetInformerImage($_GET['getimage'], false, true, $_GET['replc'])) { exit; }
   //show informer image
   if ($_GET['t2'] && @is_numeric($_GET['t2']) && $_GET['q'] == 'get') {
	$this->CheckInf()->GetRealInformerImage($_GET['t2']);
	exit;	
   }   	
   //check requst      
   if ($_POST['doactiontool'] != 'do') { return $this->DeleteOldInformers(); }   
   $http = new ss_HTTP_obj();
   if (!$http->SetURL($_POST['url'])) { return $this->SetError('Error in parse URL!'); }
   $_POST['url'] = $this->CorrectSymplyString($http->url_host);
   $this->result = array();
   //check url exists
   if ($this->GetToolLimitInfoEx('checkforurlexists') && $_POST['actinp'] == 'select') {
	if (!$http->RequestAction()) { 
	 $_POST['actinp'] = 'select';
	 return $this->SetError(($http->res_error) ? $http->res_error : 'Error in get url data!'); 
	}	
   }
   //сбросить начальный этап
   $_POST['actinp'] = '';      
   //получение кода информера
   if ($_POST['selectedinformer']) {	   		
	$identname = $_POST['url'];
	$this->result['newinf'] = $this->CheckInf()->CreateNewInformerRecord(
	 $identname, $_POST['selectedinformer'], '', $_POST['colorInput'.$_POST['selectedinformer']]
	);
	return true;	
   }   
   /* css */
   $this->AddSectionInfoNew('csslist', 'colordlg/colorpicker.php');
   /* js */
   $this->AddSectionInfoNew('jslist', 'colordlg/colorpicker.js');
   $this->AddSectionInfoNew('jslist', 'colordlg/eye.js');
   $this->AddSectionInfoNew('jslist', 'colordlg/utils.js');
   $this->AddSectionInfoNew('jslist', 'colordlg/layout.js?ver=1.0.2');
   //показать список информеров
   $this->result['infdata'] = $this->CheckInf()->GetInformersList();  
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_prcyinformer

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>