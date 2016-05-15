<?php
 /** Модуль управления инструментом `проверка доступноси сайта ping\tracerout`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_pingtracerout extends w_tools_gen_obj {
  const W_SLEEP_INTERVAL = 0.3;
  const W_MAXSTEPSCOUNT = 5; //максимальное количество прыжков
  const W_CURRENTCOUNT = 5; //по умолчанию количество прыжков выбрано	
  protected
   $http,
   $result,
   $list;
  	
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->result = false;
   $this->list = false;	
  }//__construct	
  
  function GetHttp() { return $this->http; }
  function GetResult() { return $this->result; }
  
  /** получение списка количества прыжков для выбора пользователем */
  function GetStepsCountList() {
   if ($this->list !== false) { return $this->list; }	
   $res = array();
   $count = $this->GetMaxSteps();
   $index = $this->GetCurrentStepsUser();
   if (!$count || $count <= 0) { return $res; }
   for ($i=1; $i<=$count; $i++) {
	$res[] = array(
	 'value'    => $i,
	 'selected' => ($i == $index)
	);	
   }
   return $this->list = $res;	
  }//GetStepsCountList
  
  function GetCurrentStepsUser() {
   return (@is_numeric($_POST['count']) && $_POST['count'] > 0 && $_POST['count'] <= $this->GetMaxSteps()) ? 
	$_POST['count'] : $this->GetCurSteps();	
  }//GetCurrentStepsUser
  
  protected function GetMaxSteps() { return ($val = $this->GetToolLimitInfoEx('maxsteps')) ? $val : self::W_MAXSTEPSCOUNT; }
  protected function GetCurSteps() { return ($val = $this->GetToolLimitInfoEx('stepsel')) ? $val : self::W_CURRENTCOUNT; }
  	
  function _DoActionThisTool() {
   if ($_POST['doactiontool'] != 'do') { return false; }
   $http = new ss_HTTP_obj();
   $this->http = $http;
   if (!$http->SetURL($_POST['url'])) { return $this->SetError('Error in parse url!'); }
   $_POST['url'] = $http->url_host;
   $error = $value = '';
   //параметры проверки
   $params = array(
    'sleep' => $this->GetSleepInterval(),
    'count' => $this->GetCurrentStepsUser()  
   );	  
   if (!$http->RunPluginEx(SS_TCPPINGACTION, $error, $this->result, $params)) {
	return $this->SetError((!$error) ? $this->GetText('erroractiontool', array('Ping')) : $error);
   }
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_pingtracerout

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>