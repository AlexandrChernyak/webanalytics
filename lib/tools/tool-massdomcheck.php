<?php
 /** Модуль управления инструментом `проверка занятости домена`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_massdomcheck extends w_tools_def_mass_ajax {
  const W_COUNT_OF_URL_ANALISYS = 10;
  const W_SLEEP_INTERVAL = 0.4;  
  const W_PAYTRANSACTIONNUMBER = 2; /* не изменять */
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
   $res = $http->SetURL($this->GetCurrentItem());
   $this->result = array(
    'ip'   => ($res) ? $http->GetURLip($http->url_real_host) : false,
    'host' => $this->strtolower(($res) ? $http->url_host : $this->GetCurrentItem()),
   );         
   $this->result['result'] = ($res && $this->result['ip']) ? 
   $this->strtolower($http->url_real_host) != $this->strtolower($this->result['ip']) : false;    
   //source
   $this->PrintDefaultSourceDataInfo('tpl_massdomcheck_table_result.tpl', 'tpl_massdomcheck_table_result_add_row.tpl', true); 	
   exit;	
  }//_DoActionThisTool  
  	 
 }//w_toolitem_massdomcheck

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>