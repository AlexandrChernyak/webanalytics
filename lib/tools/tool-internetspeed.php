<?php
 /** Модуль управления инструментом `скорость соединения с интернет`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_internetspeed extends w_toolitem_noajax_method {
  /** тип информеров */
  const CUR_INFORMER_TYPE = 1; //информер скорости интернета		
  protected
   $http,
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
   if (!$this->IsAjax()) { 
    //show image for template
    if ($_GET['getimage'] && $this->CheckInf()->GetInformerImage(
	 $_GET['getimage'], false, true, $_GET['replc'],
	 (($_SESSION[md5($this->section_id.'_getimage')] != 'do') ? false : $_GET['rightstrparam'])
	)) { exit; }
    //show informer image
    if ($_GET['t2'] && @is_numeric($_GET['t2']) && $_GET['q'] == 'get') {
	 $this->CheckInf()->GetRealInformerImage($_GET['t2']);
	 exit;	
    } 	  
	/* css */
    $this->AddSectionInfoNew('csslist', 'colordlg/colorpicker.php');
    /* js */
    $this->AddSectionInfoNew('jslist', 'colordlg/colorpicker.js');
    $this->AddSectionInfoNew('jslist', 'colordlg/eye.js');
    $this->AddSectionInfoNew('jslist', 'colordlg/utils.js');
    $this->AddSectionInfoNew('jslist', 'colordlg/layout.js?ver=1.0.2');
	$_SESSION[md5($this->section_id.'_getimage')] = 'do';  
	return $this->DeleteOldInformers(); 
   }   
   //для обработки элементов, повтор на случай
   $this->control->smarty->assign('tool_object', $this);
   //создание информера
   if ($this->CheckPostValue('selectinf')) {
	//rep color
	$_POST['rcolor'] = ($_POST['rcolor']) ? @str_replace('_r_', '#', $_POST['rcolor']) : false;
	//ident
	$identname = $_POST['dw'].'_'.$_POST['up'].'.png';	
	//create
	$this->result = array(
	 'newinf' => $this->CheckInf()->CreateNewInformerRecord($identname, $_POST['infid'], '', $_POST['rcolor'])
	);
	print $this->control->smarty->fetch('tools/informers/tpl_inf_inet_speed_result.tpl');
	exit;
   }   
   //получение списка информеров
   if ($this->CheckPostValue('getinflist')) {	   	
    $this->result = array(
	 'infdata'       => $this->CheckInf()->GetInformersList(),
	 'rightstrparam' => $_POST['dw'].'_'.$_POST['up'].'.png'
	);	
	print $this->control->smarty->fetch('tools/informers/tpl_informers_list.tpl');	
	exit;
   }   
   //пришел запрос на текст download
   if ($this->CheckPostValue('getdata')) {
   	$filename = W_FILESPATH.'/files/';
   	if (!$_POST['type'] || !@file_exists($filename."test{$_POST['type']}.bin")) {
	 $_POST['type'] = '1024';	
	}
	$filename .= "test{$_POST['type']}.bin";
	if (!@file_exists($filename)) { return false; }
	//print '<noscript>';   	
	@readfile($filename);
	//print '</noscript>';	
   } else {
	//запрос на текст upload
	print "<script type=\"text/javascript\">
     parent.PrepereRequestDataUpload(1); 		
	</script>";
   }
   //прекратить выполнение, вернуть данные
   exit;  	     
   //return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_internetspeed

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>