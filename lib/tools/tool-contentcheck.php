<?php
 /** Модуль управления инструментом `анализ контента сайта`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_contentcheck extends w_toolitem_noajax_method {	
  protected
   $http,
   $result,
   $dodeletecachonread;
  
  /** раскрытие стандартного массива */
  function GetWordListByArray($list, $separator=", ") {
   if (!$list || !@is_array($list)) { return ''; }
   return @implode($separator, @array_unique(@array_map(array($this, 'strtolower'), $list)));   	
  }//GetWordListByArray
  
  /** проверка присутствия группы тэгов */
  function CheckForExists($tags, $separator=',', $allmath=false) {
   $list = @explode($separator, $tags);
   if (!$list) { return false; }
   $ok = false;
   foreach ($list as $tag) {
	$ok = $this->GetResult($tag);
	if (!$allmath && $ok) { return true; } 
	elseif ($allmath && !$ok) { return false; }			
   }
   return $ok;   	
  }//CheckForExists
  
  function IsUpdateResults() {
   return ($this->dodeletecachonread && $this->control->IsOnline()); 
  }//IsUpdateResults
  
  private function ProcessGeneralSysItems() { 
    $this->result = array();           
            
    $html = new ss_HTTP_obj();
    if (!$html->SetURL($_POST['url'])) {
      print 'Error in parse URL!';
      exit;          
    }
    
    //данные о странице
    //$this->result['gensys1'] = ($html->RunPluginEx2(SS_SOLOMONOPLUGIN, $error, $value, $cachDate)) ? $value : false;
//    
//    if ($this->result['gensys1']) {
//     
//     if ($cachDate) $this->result['gensys1']['cacheddate'] = $cachDate; 
//     
//     foreach ($this->result['gensys1'] as $name => &$value) {
//        
//       if ($name == 'igood') {
//        $value = @str_replace('/', ' of ', $value);
//        continue;
//       }         
//        
//       if (!isset($this->result['gensys1'][$name.'_l1'])) continue;
//       
//       $i = 1;
//       $this->result['gensys1'][$name.'-list2w'] = array();
//       while (isset($this->result['gensys1'][$name.'_l'.$i])) {
//        
//        $this->result['gensys1'][$name.'-list2w']["$i"] = $this->result['gensys1'][$name.'_l'.$i]; 
//        
//        $i++;
//       }       
//              
//     }                       
//    }
    
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
    //@sleep(0.4);
//    $this->result['gensys3'] = ($html->RunPluginEx2(SS_MAJESTICSEOGENERALINFO, $error, $value3, $cachDate3)) ? 
//      $value3 : false;   
//    if ($this->result['gensys3'] && $cachDate3) $this->result['gensys3']['cacheddate'] = $cachDate3;
    
    
    $this->control->smarty->assign('tool_object', $this);
    print $this->control->smarty->fetch('tools/contentcheck/tpl_block-general-sys-items-list.tpl');
    exit;  
  }//ProcessGeneralSysItems
  
  private function PreloadAjaxItems() {
   
   //обработка общих показателей
   if ($_POST['spparams3']) $this->ProcessGeneralSysItems(); 
    
  }//PreloadAjaxItems
  
  function _DoActionThisTool() {
    
   if ($this->IsAjax()) { $this->PreloadAjaxItems(); exit; } 
    
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
   $_POST['url'] = $http->url_self_no_protocol;
   //параметры выполнение
   $error  = ''; $cachdateupdate = false;
   $params = array(
    'dorequsturl' => 1, //выполнять запрос только при новом обращении
    //обрабатывать указанные тэги
    'gettagssource' => array(
     //получить тэг description из группы мета (анализировать содержимое тэга)
	 'metadescription' => array(
      'id'        => 'descriptioninfo',
	  'name'      => 'meta',
	  'ones'      => 1,	 
	  'action'    => 1,
	  'separ'     => ' ',	 
	  'nameValue' => 'description',
	  'nameAttr'  => array('name', 'http-equiv'),
	  'valueAttr' => 'content'
	 )
	 //
	),
	//делить ключевые слова по пробелу
	'keywordsbyspace' => (isset($_POST['separatorkeywords']) && $_POST['separatorkeywords'] == 1) ? true : false
   );
   //добавим для анализа h1 - h6 тэги (не анализировать, просто получить содержимое)
   for ($i=1; $i<=6; $i++) {
	$params['gettagssource']['h'.$i.'t'] = array(
	  'id'    => 'h'.$i.'info',
	  'name'  => 'h'.$i,
	  'ones'  => 0	 
	);	
   }    
   //кэшировать данные при гет запросе
   if (!$this->dodeletecachonread && !$this->GetToolLimitInfoEx('docachonget')) {
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
   if (!$http->RunPluginEx2(SS_CONTENTANALIZE, $error, $this->result, $cachdateupdate, $params)) {
	return $this->SetError((!$error) ? $this->GetText('erroractiontool', array('Content analisys')) : $error);
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
  	
 }//w_toolitem_contentcheck

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>