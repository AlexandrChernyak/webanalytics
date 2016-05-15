<?php
 /** Модуль управления инструментом `проверка установленной ссылки`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_checklinktoback extends w_tools_def_mass_ajax {
  const W_COUNT_OF_URL_ANALISYS = 5;
  const W_SLEEP_INTERVAL = 0.5;  
  const W_PAYTRANSACTIONNUMBER = 12; /* не изменять */
  protected 
   $result,
   $incerp; 	
  
  /** обработка ссылки */
  function PrepereLinkToGet($plugin, $parser, $originallink, $correctlink, $typelink, $text, $innoindex, $nofollow) {
   $this->incerp++;	
   if (!$originallink = $this->strtolower(trim($originallink))) { return 2; }
   //не соответствует
   if ($originallink != $_POST['url']) { return 2; }
   //noindex
   if ($this->CheckPostValue('nonoindex') && $innoindex) { $this->result['noindex'] = true; }
   //nofollow
   if ($this->CheckPostValue('nonofollow') && $nofollow) { $this->result['nofollow'] = true; }
   //text
   if ($_POST['txt'] && $_POST['txt'] != $this->strtolower($this->CorrectSymplyString($text))) {
	$this->result['textnomatch'] = true;
   }
   //ok
   $this->result['set'] = true;
   //number
   $this->result['linknumber'] = $this->incerp;
   return 0; 	
  }//PrepereLinkToGet   
     
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
    'result' => $_POST['url'] && $http->RequestGET($this->GetCurrentItem()),
    'set'    => false
   );
   $this->result['httpcode'] = $http->res_http_code;
   $this->result['time'] = $http->res_time_query;   
   //ссылка
   $this->result['link'] = $http->url_self_no_protocol;
   if ($this->result['result']) {
	$_POST['url'] = $this->strtolower($_POST['url']);
	if ($_POST['txt']) { $_POST['txt'] = $this->strtolower($this->CorrectSymplyString($_POST['txt'])); }
   	//noindex robots
   	if ($this->CheckPostValue('norobots') || $this->CheckPostValue('norobotsf')) {
   	 $robots = $http->GetMetaRobots();
   	 if ($robots) { $robots = @explode(',', $this->strtoupper(@str_replace(' ', '', $robots))); }
   	}	
	$this->result['pnoindex']  = $robots && $this->CheckPostValue('norobots') && @in_array('NOINDEX', $robots);
	$this->result['pnofollow'] = $robots && $this->CheckPostValue('norobotsf') && @in_array('NOFOLLOW', $robots);	  	
	//action
	if (!$this->result['pnoindex']) {
	 $error  = $value = '';
     $params = array(
      'usestrongregext' => 1,
      'fetch_proc'      => array($this, 'PrepereLinkToGet'),
      'ignoredoubled'   => false	 
     ); 	  
     $list = false;
     $this->incerp = 0;    
     $http->RunPluginEx(SS_PAGELINKSLIST, $error, $list, $params);
	}	
   } else {
	//error
	$this->result['error'] = ($http->res_error) ? $http->res_error : 'Error in get parameters..';
   }     
   //source
   $this->PrintDefaultSourceDataInfo('tpl_checklinktoback_t_r.tpl', 'tpl_checklinktoback_t_r_add_row.tpl', true); 	
   exit;	
  }//_DoActionThisTool  
  	 
 }//w_toolitem_checklinktoback

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>