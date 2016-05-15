<?php
 /** Модуль управления инструментом `проверка пр по датацентрам`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_prbydcgoogle extends w_tools_def_mass_ajax {
  const W_COUNT_OF_URL_ANALISYS = 5;
  const W_SLEEP_INTERVAL = 0.5;  
  const W_PAYTRANSACTIONNUMBER = 8; /* не изменять */
  protected 
   $result,
   $items,
   $count; 	
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->items = false;
   $this->count = false;	
  }//__construct
  
  /** получение массива элементов для обработки */
  function GetDCItems() {
   if ($this->items !== false) { return $this->items; }
   $this->items = array();
   //направление извлечения датацентров
   $direction = $this->GetToolLimitInfoEx('direct');
   switch ($direction) {
	case 'DESC': break;
	default: $direction = ''; break;
   }
   //количество
   $limit = ($this->IsNoLimitTool()) ? '' : $this->GetLimitCount();
   $limit = ($limit && @is_numeric($limit) && $limit > 0) ? (" limit ".($limit + 1)) : '';      
   //список датацентров
   $res = $this->control->db->mPost(
    "select data from {$this->control->tables_list['googlecen']} where enabledit='1' order by datecreat $direction".$limit
   );
   while ($row = $this->control->db->GetLineArray($res)) {
	$this->items[] = $row['data'];
   }
   return $this->items;   	
  }//GetDCitems
  
  /** список по разделителям */
  function GetDCItemsList($separation="\n") {
   $res = '';
   foreach ($this->GetDCItems() as $item) {
	$res .= ((!$res) ? $item : ($separation.$item));	
   }
   return $res;	
  }//GetDCItemsList
  
  /** общее количество датацентров */
  function GetDCItemsCount() {
   if ($this->count !== false) { return $this->count; }
   return $this->count = $this->control->GetCountInTable('iditem', 'googlecen', "where enabledit='1'");   	
  }//GetDCItemsCount    
     
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
    'result' => $http->SetURL($this->CorrectSymplyString($_POST['url']))
   );
   //ссылка запроса
   $this->result['link'] = ($http->url_host) ? $this->CorrectLinkToProtocol($http->url_self) : 
   $this->CorrectLinkToProtocol($this->CorrectSymplyString($_POST['url']));
   $this->result['link_no_http'] = 
   ($this->strtolower($this->substr($this->result['link'], 0, 7)) == 'http://') ? 
   $this->substr($this->result['link'], 7) : $this->result['link'];
   //остальные параметры
   //if ($this->result['result']) {
	$error  = $value = '';
	$params = array($this->CorrectSymplyString($this->GetCurrentItem()));
	$ok = $this->result['result'] && $http->RunPluginEx(SS_GOOGLEPR, $error, $value, $params);
	//data
	$this->result['pr']   = ($ok) ? $value['value'] : false;
	$this->result['host'] = ($ok) ? $value['host'] : false;
	$this->result['time'] = ($ok) ? $this->ClearBreake($value['time']) : false;	
   //}   
   //source
   $this->PrintDefaultSourceDataInfo('tpl_prbydcgoogle_t_r.tpl', 'tpl_prbydcgoogle_t_r_add_row.tpl', true); 	
   exit;	
  }//_DoActionThisTool  
  	 
 }//w_toolitem_prbydcgoogle

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>