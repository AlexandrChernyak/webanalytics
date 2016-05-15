<?php
 /** Модуль управления инструментом `punycode конвертер`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_punycodeconv extends w_tools_def_mass_ajax {
  const W_COUNT_OF_URL_ANALISYS = 10;
  const W_SLEEP_INTERVAL = 0.3;  
  const W_PAYTRANSACTIONNUMBER = 6; /* не изменять */
  protected 
   $result;	
      
  function _DoActionThisTool() {
   if (!$this->CheckAjaxInitMassObj()) { $this->InitJsFiles(); return false; }
   //проверка запроса активации снятия лимита
   $this->BeginToPayLimitedData();
   //ok next
   if ($this->GetSleepInterval() > 0) { sleep($this->GetSleepInterval()); }
   $this->control->smarty->assign('tool_object', $this);
   $http = new ss_HTTP_obj();
   //результат запроса   
   $this->result = array(
    'encode' => $http->PunEncode($this->GetCurrentItem()),
	'decode' => $http->PunDecode($this->GetCurrentItem()) 
   );
   //source
   $this->PrintDefaultSourceDataInfo('tpl_punycodeconv_t_r.tpl', 'tpl_punycodeconv_t_r_add_row.tpl', true); 	
   exit;	
  }//_DoActionThisTool  
  	 
 }//w_toolitem_punycodeconv

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>