<?php
 /** Модуль управления инструментом `массовая проверка посещаемости`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_massvischeck extends w_tools_def_mass_ajax {
  const W_COUNT_OF_URL_ANALISYS = 10;
  const W_SLEEP_INTERVAL = 0.4;  
  const W_PAYTRANSACTIONNUMBER = 16; /* не изменять */
  protected 
   $result;
    
  function _DoActionThisTool() {
   if (!$this->CheckAjaxInitMassObj()) { $this->InitJsFiles(); return false; }
   $this->BeginToPayLimitedData();
   if ($this->GetSleepInterval() > 0) { @sleep($this->GetSleepInterval()); }
   $this->control->smarty->assign('tool_object', $this);
   $http = new ss_HTTP_obj();
   $res = $http->SetURL($this->GetCurrentItem()); 
   $this->result = array(
    'url'   => ($res) ? $http->url_real_host : false, 
	'error' => ($res) ? false : 'Error parse URL',
	'host'  => ($res) ? $http->url_host : false
   );
   if ($res && !$this->CheckPostValue('withimage')) {
   	if ($this->GetToolLimitInfoEx('timeout')) { $http->connect_time_out = $this->GetToolLimitInfoEx('timeout'); }
	if (!$http->RunPluginEx(SS_SITESTATISTICSLI, $error, $value)) {
	 $this->result['error'] = ($error) ? $error : 'Error run stat plugin!';	 	
	} else { 
	 //ok
	 $this->result['data'] = $value;
	 $this->result['link'] = $http->ReplaceCorrect(ss_Plugin_ActionLIstatSite::LINK_IMAGE_LI);	 	
	}	
   } elseif ($res && $this->CheckPostValue('withimage')) {
	$this->result['image'] = $http->ReplaceCorrect(ss_Plugin_ActionLIstatSite::LINK_IMAGE_LI);
	$this->result['link']  = $http->ReplaceCorrect(ss_Plugin_ActionLIstatSite::LINK_TO_VIEW);
   }
   //source
   $this->PrintDefaultSourceDataInfo('tpl_massvischeck_t_r.tpl', 'tpl_massvischeck_t_r_add_row.tpl', true); 	
   exit;	
  }//_DoActionThisTool  
  	 
 }//w_toolitem_massvischeck

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>