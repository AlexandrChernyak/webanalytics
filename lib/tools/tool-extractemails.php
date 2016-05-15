<?php
 /** Модуль управления инструментом `извлечение e-mail адресов`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_extractemails extends w_tools_def_mass_ajax {	
  const W_COUNT_OF_URL_ANALISYS = 10;
  const W_SLEEP_INTERVAL = 0.5;  
  const W_PAYTRANSACTIONNUMBER = 10; /* не изменять */ 	
  protected
   $result;
  
  /** тип извлечения
  *   0 - ссылки,
  *   1 - e-mail'ы   
  */
  protected function GetExtractType() { return 1; }//GetExtractType
  
  /** следующее вхождение */
  protected function _NextRun(ss_HTMLTagParser &$parser) {
   switch ($this->GetExtractType()) {
   	//email
	case 1: return $parser->GetEmailFromText();
	//url
	default: return $parser->GetTag();	
   }   	
  }//_NextRun
  
  /** запись элемента */
  protected function WriteItemToPage($s) {
   if (!$s = trim($this->CorrectSymplyString($s))) { return false; };   
   print $this->ToJavaScriptEval("AddNewItemData('$s'); ").';';   	
  }//WriteItemToPage
  
  /** процесс извлечения */
  protected function DoProcessExtract(ss_HTTP_obj $http) {
   $parser = new ss_HTMLTagParser();
   $http->SetParserTag('a', $parser);
   //обход всех элементов текста
   while ($this->_NextRun($parser)) {
	switch ($this->GetExtractType()) {
	 //email
	 case 1: if ($parser->TagSource) { $this->WriteItemToPage($this->strtolower($parser->TagSource)); } break;
	 //url
	 default:
	  $ok = false;
	  $href = $parser->GetParamValue('href');
	  if (!$href) { break; }
	  //полный формат ссылки
	  $orig = $this->CheckPostValue('asoriginal');
	  $href2 = $http->CorrectLinkToHostAndPort(
	   $http->url_host, $http->url_protocol, $http->url_self, $href, false, true
	  );
	  if (!trim($href)) { break; }
	  //проверка выборки
	  switch ($http->GetLinkType($http->url_host, $href2)) {
	   case SS_IK_LINK_ERROR  : break;
	   case SS_IK_LINK_INSIDE : $ok = $this->CheckPostValue('inside'); break;
	   case SS_IK_LINK_OUTSIDE: $ok = $this->CheckPostValue('outside'); break;
	   case SS_IK_LINK_SUBDOM : $ok = $this->CheckPostValue('subdom'); break;	
	  }   
	  //запись
	  if ($ok) { $this->WriteItemToPage($this->strtolower(($orig) ? $href : $href2)); }	  
	 break;	
	}
   }
   //удалить дубликаты
   //if ($this->result) { $this->result = @array_unique($this->result); }   
  }//DoProcessExtract
         
  function _DoActionThisTool() {	  	 
   if (!$this->CheckAjaxInitMassObj()) { $this->InitJsFiles(); return false; }
   //проверка запроса активации снятия лимита
   $this->BeginToPayLimitedData();
   //ok next
   if ($this->GetSleepInterval() > 0) { sleep($this->GetSleepInterval()); }
   $this->control->smarty->assign('tool_object', $this);
   $http = new ss_HTTP_obj();   
   $this->result = array();
   //лимит
   $this->PrintLimitCountOfItems();
   //запрос ссылки
   if ($http->RequestGET($this->GetCurrentItem())) { $this->DoProcessExtract($http); } 
   exit;        
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_extractemails

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>