<?php
 /** Модуль управления инструментом `получение перенаправлений сайта`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_urlredirectedl extends w_tools_def_mass_ajax {
  const W_COUNT_OF_URL_ANALISYS = 10;
  const W_SLEEP_INTERVAL = 0.5;  
  const W_PAYTRANSACTIONNUMBER = 4; /* не изменять */
  protected 
   $result;
  var $redirectlist = array(); 	
  
  function GetRedirectCount() { return (!$this->redirectlist) ? 0 : @count($this->redirectlist); }
  function GetIndexNumber($val) { return $val + 1; }
  function ReplaceStrBreaks($val) { return @str_replace("\n", '<br>', $this->ClearBreake($val, true, false)); }
     
  function _DoActionThisTool() {
   if (!$this->CheckAjaxInitMassObj()) { $this->InitJsFiles(); return false; }
   //проверка запроса активации снятия лимита
   $this->BeginToPayLimitedData();
   //ok next
   if ($this->GetSleepInterval() > 0) { sleep($this->GetSleepInterval()); }
   $this->control->smarty->assign('tool_object', $this);
   $http = new ss_HTTP_obj();
   //параметры запроса сайта
   if ($this->GetToolLimitInfoEx('timeout')) { $http->connect_time_out = $this->GetToolLimitInfoEx('timeout'); }   
   //результат запроса
   $this->result = array(
    'result' => ($http->SetURL($this->GetCurrentItem())) ? $http->RequestAction('HEAD') : false
   );
   //ссылка запроса
   $this->result['link'] = ($http->url_self) ? $http->url_self : $this->CorrectLinkToProtocol($this->GetCurrentItem());
   //остальные параметры
   if ($this->result['result']) {
	$this->result['speed'] = $http->GetSpeedAsStr($http->res_load_speed);
	$this->result['time']  = $http->res_time_query;
	$this->result['size']  = $http->GetDataSizeStr($http->res_url_size);
	$this->redirectlist    = $http->res_redirect_list;
	$this->result['redil'] = $http->res_redirect_link;	
   }   
   $this->result['error']     = $http->res_error;
   $this->result['httpcode']  = $http->res_http_code;
   //source
   $this->PrintDefaultSourceDataInfo('tpl_urlredirectedl_t_r.tpl', 'tpl_urlredirectedl_t_r_add_row.tpl', true); 	
   exit;	
  }//_DoActionThisTool  
  	 
 }//w_toolitem_urlredirectedl

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>