<?php
 /** инициализация настроек сайта
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
//-------------------------------------------------------------------------------------
 class pr_options_preload extends w_defext {
  /* идентификаторы надстроек, типы */
  public static $gensuboptions = array(
   'string', 'boolean', 'integer', 'int', 'double', 'float', 'stringex'   
  );	
  protected
   $control;
   
  function __construct(w_Control_obj $control) {
   parent::__construct();
   $this->control = $control;	
  }//__construct
  
  protected function GetOption($optid) {
   return $this->control->db->GetLineArray($this->control->db->mPost(
    "select optsource from {$this->control->tables_list['opttbllst']} where optident='$optid' limit 1"
   ));	
  }//GetOption
  
  protected function ReadParam($name, $source, &$rvalue) {
   $source = (@is_array($source)) ? $source['optsource'] : $source;
   if ($source === false) { $source = ''; }
   $rvalue = false;
   $dvalue = $this->control->ReadOption($this->strtoupper($name), $source);
   if ($dvalue === false) { return false; }
   $dvalue = @unserialize(@stripslashes($dvalue));
   $rvalue = (@is_string($dvalue)) ? @stripslashes($dvalue) : $dvalue;
   return true;  	
  }//ReadParam
  
  /** загрузка надстроек указанного инструмента */
  function PreloadToolOption($toolident) {
   global $_TOOLSNOLIMITACTIVATIONDATAINFO;
   if (!$toolident || !isset($_TOOLSNOLIMITACTIVATIONDATAINFO[$toolident]) || 
       !$_TOOLSNOLIMITACTIVATIONDATAINFO[$toolident]) { return false; }   
   if ($result = $this->GetOption($this->strtolower('toolopt_'.$toolident))) {
    //ok load data 
    if ($result['optsource']) {
	 foreach ($_TOOLSNOLIMITACTIVATIONDATAINFO[$toolident] as $name => &$value) {
	  if ($this->ReadParam($toolident.'_'.$name, $result, $rvalue)) { $value = $rvalue; }		 	
	 }			
    }    
	return true;  	
   }
   return false;   	
  }//PreloadToolOption
  
  /** загрузка всех параметров всех инструментов */
  function PreloadOptionsOfAllTools() {
   global $_TOOLSNOLIMITACTIVATIONDATAINFO;
   foreach ($_TOOLSNOLIMITACTIVATIONDATAINFO as $name => $item) {
	$this->PreloadToolOption($name);
   }
   return true;   	
  }//PreloadOptionsOfAllTools
  
  /** автовыбор загрузки инструмента, инструментов */
  function PreloadToolOptionAuto() {
   global $_TOOLSNOLIMITACTIVATIONDATAINFO;
   if ($_GET['section'] != 'xmlapiproject' && $this->control->GetActiveSkin() == 'GENERAL') { 
    return $this->PreloadOptionsOfAllTools(); 
   }
   /* use, only if need to use tool options */	
   switch ($_GET['section']) {
    case 'toolsaction': 
     $ident = ($_GET['t1'] && isset($_TOOLSNOLIMITACTIVATIONDATAINFO[$_GET['t1']])) ? 
	 $this->CorrectSymplyString($_GET['t1']) : false;
     break;
    case 'accountff':
     //specify sections for load
     switch ($_GET['hrzd']) {
      case 'admtoolsoptions':
      case 'admtoolsimages': break;
      
      default: return false;        
     } 
     //get
     $ident = ($_GET['toolid'] && isset($_TOOLSNOLIMITACTIVATIONDATAINFO[$_GET['toolid']])) ? 
     $this->CorrectSymplyString($_GET['toolid']) : false; 	
     break;
    default: return false; 	
   }
   //select type
   return ($ident) ? $this->PreloadToolOption($ident) : $this->PreloadOptionsOfAllTools();   	
  }//PreloadToolOptionAuto
  
  /** загрузка надстроек сайта */
  function PreloadGeneralSiteSubOptions() {
   global $_GLOBALDINAMICCONSTOPTIONS;
   if (!W_LOADSUBOPTIONSIFAJAX && @defined('W_IS_AJAX_MODE_RUN')) { return false; }
   if (!$result = $this->GetOption('general_sub_options')) { return false; } 
   foreach ($_GLOBALDINAMICCONSTOPTIONS as $name => $item) {
    if (!$name || !$item['type'] || !@in_array($item['type'], self::$gensuboptions)) { continue; }		
   	if (@defined($name) || !$this->ReadParam($name, $result, $rvalue)) { continue; }
   	@define($name, $rvalue);   	
   }	
   return true;   	
  }//PreloadGeneralSiteSubOptions
  
  static function QuickPreloadGeneralSiteSubOptions($CONTROL_OBJ) {
   $item = new pr_options_preload($CONTROL_OBJ);
   $res  = $item->PreloadGeneralSiteSubOptions();
   unset($item);
   return $res;   	
  }//QuickPreloadGeneralSiteSubOptions
  
  static function QuickPreloadToolOptions($toolid, $CONTROL_OBJ) {
   $item = new pr_options_preload($CONTROL_OBJ);
   $res  = $item->PreloadToolOption($toolid);
   unset($item);
   return $res;   	
  }//QuickPreloadToolOptions
  
  /** удаление надстройки */
  static function DeleteOption($ident, $CONTROL_OBJ) {
   if (!$ident = $CONTROL_OBJ->strtolower($CONTROL_OBJ->CorrectSymplyString($ident))) { return false; }
   return $CONTROL_OBJ->db->Delete($CONTROL_OBJ->tables_list['opttbllst'], "optident='$ident'", "1");   	
  }//DeleteOption 
   		
 }//pr_options_preload
 //-------------------------------------------------------------------------------------
 if (!@defined('SIMPLY_CONNECT_PRELOAD_OPTIONS')) {
    
  $preload_option_object = new pr_options_preload($CONTROL_OBJ);
  /** загрузка надстроек сайта */
  $preload_option_object->PreloadGeneralSiteSubOptions(); 
  /** загрузка настроек инструментов */
  $preload_option_object->PreloadToolOptionAuto(); 
 
  unset($preload_option_object); 
  //------------------------------------------------------------------------------------- 
  /** динамические параметры, подтверждение */
  require_once W_LIBPATH.'/confi/dinamic.conf.php';
  /** preload skins description */
  foreach ($_GLOBAL_SKIN_LIST as $namesk => &$descrsk) {
   if ($descrsk) { $descrsk = $CONTROL_OBJ->GetText($descrsk); }	
  }
  
 }
 //-------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>