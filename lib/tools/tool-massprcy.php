<?php
 /** Модуль управления инструментом `массовая проверка пр тиц`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_massprcy extends w_tools_def_mass_ajax {
  const W_COUNT_OF_URL_ANALISYS = 10;
  const W_SLEEP_INTERVAL = 0.5;  
  const W_PAYTRANSACTIONNUMBER = 7; /* не изменять */
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
    'result' => ($http->SetURL($this->GetCurrentItem())) ? $http->SetURL($http->url_host) : false
   );
   //ссылка запроса
   $this->result['link'] = ($http->url_host) ? $http->url_host : $this->CorrectLinkToProtocol($this->GetCurrentItem());
   //остальные параметры
   if ($this->result['result']) {
	$this->result['cy_www'] = $http->ReplaceCorrect(ss_Plugin_GenYandexCY::LINK_CY_IMAGE_WWW);
	$this->result['cy_no_www'] = $http->ReplaceCorrect(ss_Plugin_GenYandexCY::LINK_CY_IMAGE_NO_WWW);
	$error = $value = '';
	$this->result['pr'] = ($http->RunPluginEx(SS_GOOGLEPR, $error, $value)) ? $value['value'] : false;		
   }   
   //source
   $this->PrintDefaultSourceDataInfo('tpl_massprcy_t_r.tpl', 'tpl_massprcy_t_r_add_row.tpl', true); 	
   exit;	
  }//_DoActionThisTool  
  	 
 }//w_toolitem_massprcy

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>