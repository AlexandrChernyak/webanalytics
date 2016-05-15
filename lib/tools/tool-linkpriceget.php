<?php
 /** Модуль управления инструментом `цена ссылки с сайта`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_linkpriceget extends w_tools_def_mass_ajax {
  const W_COUNT_OF_URL_ANALISYS = 8;
  const W_SLEEP_INTERVAL = 0.5;  
  const W_PAYTRANSACTIONNUMBER = 9; /* не изменять */
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
    'host' => ($http->SetURL($this->GetCurrentItem())) ? $http->url_host : false
   );
   if ($this->result['host']) {   
	$error  = $value = '';
	$cy = ($http->RunPluginEx(SS_YANDEXCY, $error, $value)) ? $value['value'] : false;
	$pr = ($cy !== false && $http->RunPluginEx(SS_GOOGLEPR, $error, $value)) ? $value['value'] : false;
	//сбор параметров
	if ($cy !== false && $pr !== false) {
	 $params = array('cy' => $cy, 'pr' => $pr);		
	 //получение параметров
	 $params['uv'] = 1;	
	 $this->result['uv1'] = ($http->RunPluginEx(SS_LINKPROCEFROMSITE, $error, $value, $params)) ? $value : false;
	 //uv2
	 if ($this->CheckPostValue('uv2')) {
	  $params['uv'] = 2;	
	  $this->result['uv2'] = ($http->RunPluginEx(SS_LINKPROCEFROMSITE, $error, $value, $params)) ? $value : false;
	 }
	 //uv3
	 if ($this->CheckPostValue('uv3')) {
	  $params['uv'] = 3;	
	  $this->result['uv3'] = ($http->RunPluginEx(SS_LINKPROCEFROMSITE, $error, $value, $params)) ? $value : false;
	 }
	}		
   }   
   //source
   $this->PrintDefaultSourceDataInfo('tpl_linkpriceget_t_r.tpl', 'tpl_linkpriceget_t_r_add_row.tpl', true); 	
   exit;	
  }//_DoActionThisTool  
  	 
 }//w_toolitem_linkpriceget

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>