<?php

 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_analysis extends w_toolitem_noajax_method {
  /** дополнительные идентификаторы извлечения информации для топ по ключевым словам 
      для включения - измените значение false на true у необходимых параметров
      p.s включая параметры, они не будут отображаться на странице, для этого нужно будет самостоятельно
	  добавить отображение их в шаблоне. включение лишь включает парсинг данных параметров.
      Для отображения в шаблоне используются теже имена параметров, пример:
      $val.wordstat или $val.wordstat2 и т.д  
  */
  private $use_in_top_by_keywords_addons = array(
   'wordstat'  => false, //показов в месяц по яндексу wordstat.yandex.ru
   'wordstat2' => false, //кол-во запросов в Yandex за месяц по данным direct.yandex.ru
   'jump_li'   => false, //число переходов на страницы по данным liveinternet.ru
   'price'     => false  //Стоимость - Оценочная стоимость продвижения сайта в первую 10-ку результатов поиска 
  );		 	
  protected
   $http,
   $result,
   $dodeletecachonread;
  /** идентификаоры, значение которых показывать в истории */ 
  public static $items_to_use = array(
   'id_cy_value', 'id_pr_value', 'id_lidaystat_value', 'id_limonthstat_value'  
  ); 
  
  function FlagExists() {
   return @file_exists(W_SITEDIR.'/img/items/flag/'.$this->GetResult('pageinfo.servergeo').'.gif');	
  }//FlagExists
  
  function GetFlagName() { return W_SITEPATH.'img/items/flag/'.$this->GetResult('pageinfo.servergeo').'.gif'; }
  
  function GetConstantElementValue($class, $name='LINK_QUERY') {
   $const = @constant("$class::$name");
   return (!$const) ? false : $this->http->ReplaceCorrect($const);  	
  }//GetConstantElementValue
  
  function LinkToEngineItem($linkid, $query) {
   return $this->GetConstantElementValue('ss_BlockConstantValue', $linkid) . @urlencode($query);
  }//LinkToEngineItem
  
  private function ProcessGeneralSysItems() { 
    $this->result = array();           
            
    $html = new ss_HTTP_obj();
    if (!$html->SetURL($_POST['url'])) {
      print 'Error in parse URL!';
      exit;          
    }
    
    //данные о странице
    $this->result['gensys1'] = ($html->RunPluginEx2(SS_SOLOMONOPLUGIN, $error, $value, $cachDate)) ? $value : false;
    
    if ($this->result['gensys1']) {
     
     if ($cachDate) $this->result['gensys1']['cacheddate'] = $cachDate; 
     
     foreach ($this->result['gensys1'] as $name => &$value) {
        
       if ($name == 'igood') {
        $value = @str_replace('/', ' of ', $value);
        continue;
       }         
        
       if (!isset($this->result['gensys1'][$name.'_l1'])) continue;
       
       $i = 1;
       $this->result['gensys1'][$name.'-list2w'] = array();
       while (isset($this->result['gensys1'][$name.'_l'.$i])) {
        
        $this->result['gensys1'][$name.'-list2w']["$i"] = $this->result['gensys1'][$name.'_l'.$i]; 
        
        $i++;
       }       
              
     }                       
    }
    
    //данные о странице
    if ($this->GetToolLimitInfoEx('pagespeedapi')) {
     @sleep(0.4);
     $params = array(
      'key' => $this->GetToolLimitInfoEx('pagespeedapi'),
      'ref' => 'http://'.W_HOSTMYSITE  
     );
     if ($this->GetToolLimitInfoEx('pagespeedapi-userip')) {
      $params['userIp'] = $this->control->GetCurrentIP();   
     }
     
     if ($_POST['dp'] && $this->control->IsOnline()) $params['ignorecach'] = 1;
                  
     $this->result['gensys2'] = ($html->RunPluginEx2(SS_PAGESPEEDONLINE, $error, $value2, $cachDate2, $params)) ? 
      $value2 : false;
     
     if ($this->result['gensys2'] && $cachDate2) $this->result['gensys2']['cacheddate'] = $cachDate2; 
       
    }
    
    //majesticseo
    @sleep(0.4);
    $this->result['gensys3'] = ($html->RunPluginEx2(SS_MAJESTICSEOGENERALINFO, $error, $value3, $cachDate3)) ? 
      $value3 : false;   
    if ($this->result['gensys3'] && $cachDate3) $this->result['gensys3']['cacheddate'] = $cachDate3;    
    
   
    $this->control->smarty->assign('tool_object', $this);
    print $this->control->smarty->fetch('tools/contentcheck/tpl_block-general-sys-items-list.tpl');
    exit;  
  }//ProcessGeneralSysItems
  
  /** обработка ajax запроса */
  protected function PreloadAjaxItems() {
    
   //обработка общих показателей
   if ($_POST['spparams3']) $this->ProcessGeneralSysItems();       
    
   //require lib file
   require_once W_SITEDIR.'/lib/p.history.lib.php';
   if (!$history = w_historyparamslisten::CreateFromURL($this->control, $_POST['host'])) { return false; }         
   //url is ok, action to paramsXML
   $ignoreitems = array();
   if ($this->GetToolLimitInfoEx('showonlyactualy')) {	
   	if ($_POST['LiDayStatistic']) { $ignoreitems[] = 'id_lidaystat_value'; }
   	if ($_POST['LiMonthStatistic']) { $ignoreitems[] = 'id_limonthstat_value'; }
   }
   //get only relevant values
   $items = (!$ignoreitems) ? self::$items_to_use : array();
   if ($ignoreitems) {
   	foreach (self::$items_to_use as $itemname) {
	 if (!@in_array($itemname, $ignoreitems)) { $items[] = $itemname; }	 	
	}
   }	
   //action   
   if ($_POST['getparams']) {
	print $history->GenerateLineCharSettengsXML($items);
	return true;	
   }
   //action to get data CSV
   if ($_POST['getdata']) {  
   	$count = $this->GetToolLimitInfoEx('grathcount'); 	
	print $history->GenerateLineChartDataCSV($items, ($count && @is_numeric($count)) ? $count : 0);
	return true;
   }   	
  }//PreloadAjaxItems
  
  protected function GetResultByValueID($way) {
   return ($this->GetResult($way) === false) ? '' : $this->GetResult($way);	
  }//GetResultByValueID
  
  function IsUpdateResults() {
   return ($this->dodeletecachonread && $this->control->IsOnline()); 
  }//IsUpdateResults
  
  function _DoActionThisTool() {	
   //check for ajax run
   if ($this->IsAjax()) { $this->PreloadAjaxItems(); exit; }
   //default action   		  	 
   $this->dodeletecachonread = !$this->CheckForGetQuery();
   if ($_POST['doactiontool'] != 'do') { 
   	if (!isset($_GET['t2']) || !$_GET['t2']) { return false; }
	$_POST['url'] = ($_GET['plink']) ? $_GET['plink'] : $_GET['t2'];
	$_POST['doactiontool'] = 'do';    
   }
   $this->InitJsFiles();
   $http = new ss_HTTP_obj();
   $this->http = $http;  
   if (!$http->SetURL($_POST['url'])) { return $this->SetError('Error in parse url!'); }
   //на запрос только хост
   $http->SetURL($http->url_host);
   $_POST['url'] = $http->url_host;
   //параметры выполнение
   $error  = ''; $cachdateupdate = false;
   //выполнить обращение при необходимости
   $params = array('dorequsturl' => 1);
   //кэшировать данные при гет запросе
   if (!$this->dodeletecachonread && !$this->GetToolLimitInfoEx('docachonget')) {
   	if (!@is_array($params)) { $params = array(); }
	$params['ignorecach'] = true;
   }   
   //обновлять кэш при запросе из пост запроса
   if ($this->IsUpdateResults()) {//($this->dodeletecachonread) {
   	//обновить кэш
    if ($this->GetToolLimitInfoEx('docachonpost')) { $params['dodeletecachonread'] = 1; } else {
     //не использовать кэш	
	 $params['ignorecach'] = true;	
	}      
   }
   //выполнение
   if (!$http->RunPluginEx2(SS_URLANALIZE, $error, $this->result, $cachdateupdate, $params)) {
	return $this->SetError((!$error) ? $this->GetText('erroractiontool', array('URL analisis')) : $error);
   }
   //save items as history data
   if ($this->GetToolLimitInfoEx('enabledphistory')) {
    require_once W_SITEDIR.'/lib/p.history.lib.php';
    if ($history = w_historyparamslisten::CreateFromURL($this->control, $http->url_real_host)) {    
     //add new
     $history->WriteNewHistoryData(array(
	  'id_cy_value'          => $this->GetResultByValueID('cyvalue.value'),
	  'id_pr_value'          => $this->GetResultByValueID('prvalue.value'),
	  'id_lidaystat_value'   => $this->GetResultByValueID('LIvalue.LiDayStatistic'),
	  'id_limonthstat_value' => $this->GetResultByValueID('LIvalue.LiMonthStatistic')
	 ),($cachdateupdate) ? $cachdateupdate : false, 
	 /* $this->dodeletecachonread*/ !$cachdateupdate && $this->GetToolLimitInfoEx('updatehistoryifexists'));    
     unset($history);
    } 
   } 
   //дополнительная информация анализа
   //все сайты на ip
   $this->result['ipinfolink'] = ss_Plugin_GenDomainsOnIP::LINK_QUERY.$this->GetResult('pageinfo.ip');
   //статистика по LI изображением
   $this->result['listatgraph'] = $http->ReplaceCorrect(ss_Plugin_ActionLIstatSite::LINK_IMAGE_LI);
   //размер заголовка
   $this->result['headersize'] = 
   $http->GetDataSizeStr(($this->GetResult('pageinfo.robots')) ? $this->strlen($this->GetResult('pageinfo.robots')) : 0);
   //добавление результатов по топу в поисковиках
   if ($this->GetToolLimitInfoEx('usemegaindextop') && $this->GetToolLimitInfoEx('megaindexlogin')) {
    $params2 = array(
	 'login'    => $this->GetToolLimitInfoEx('megaindexlogin'),
	 'password' => $this->GetToolLimitInfoEx('megaindexpass')
	);
	/* добавление дополнительных значений по топу */
	foreach ($this->use_in_top_by_keywords_addons as $topitem => $topvalue) {
	 if ($topvalue) { $params2[$topitem] = 1; }	
	}
    if (isset($params['ignorecach']) && $params['ignorecach']) { $params2['ignorecach'] = 1; }
    if (isset($params['dodeletecachonread']) && $params['dodeletecachonread']) { $params2['dodeletecachonread'] = 1; }
    //action
	if ($http->RunPluginEx2(SS_URLINTOPBYKEYWORDS, $error, $value, $cachdateupdate2, $params2)) {
	 $this->result['intop_engine'] = $value;
	 if ($cachdateupdate2) { $this->result['intop_engine_cached_day'] = $cachdateupdate2; }	 
    } else { $this->result['intop_engine_error'] = $error; }
   }
   //записать в историю
   if (!$cachdateupdate) { $this->AddDataToHistory($http->url_host); }
   //дата последнего обновления информации, если используется кэш и данные из кэша
   if ($cachdateupdate) { $this->result['cachlastupdatedate'] = $cachdateupdate; }   
   return true;   	
  }//_DoActionThisTool
  
  function NextUpdateDate() {
   if ($this->IsUpdateResults() || !$this->result['cachlastupdatedate'] || $this->control->IsOnline()) { return false; }
   if (isset($this->result['lastupdatenexttime'])) return $this->result['lastupdatenexttime'];
   
   $time = @strtotime($this->result['cachlastupdatedate']);
   $date_time_array = @getdate($time);
   
   $time = @date("Y-m-d H:i:s", @mktime(
    $date_time_array['hours'], $date_time_array['minutes'], $date_time_array['seconds'], $date_time_array['mon'],
    $date_time_array['mday'] + 5, $date_time_array['year']
   ));
    
   return $this->result['lastupdatenexttime'] = ss_Plugin_GenWhoisDomainEx::GetDateDiffInterval2(
    $this->GetThisDateTime(), $time
   );    
  }//NextUpdateDate  
  	
 }//w_toolitem_analysis

 //-------------------------------------------------------------------------------------

?>