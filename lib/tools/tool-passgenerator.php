<?php
 /** Модуль управления инструментом `генератор паролей`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_passgenerator extends w_toolitem_noajax_method {	
  protected
   $result,
   $shashlist;
  	
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->shashlist = null;	
  }//__construct
      
  function GetHashList() {
   if ($this->shashlist !== null) { return $this->shashlist; }
   return $this->shashlist = @hash_algos();	
  }//GetHashList
  
  function EncodeToUTF8($s) { return @iconv('windows-1251', 'UTF-8', $s); }
  
  //получение списка символов
  protected function GetSourceCharsArray($casedata, $lang, $controlsym, $numb) {
   if ($lang == 2 || ($lang != 1 && $casedata == 0)) { 	
    $list_a1 = @array_map(
     array('w_toolitem_passgenerator', 'EncodeToUTF8'),
	 @range(@iconv('UTF-8', 'windows-1251', 'а'), @iconv('UTF-8', 'windows-1251', 'я'))
    );
    $list_a2 = @array_map(
     array('w_toolitem_passgenerator', 'EncodeToUTF8'),
	 @range(@iconv('UTF-8', 'windows-1251', 'А'), @iconv('UTF-8', 'windows-1251', 'Я'))
    );	
   }
   $result = array();
   switch ($lang) {
    case 1: 
	 switch ($casedata) {
	  case 1: $result   = @array_merge($result, range('A','Z')); break;
	  case 2: $result   = @array_merge($result, range('a','z')); break;
	  default : $result = @array_merge($result, range('A','Z'), range('a','z')); break;	
	 }	 
	break;
	case 2:
	 switch ($casedata) {
	  case 1: $result   = @array_merge($result, $list_a2); break;
	  case 2: $result   = @array_merge($result, $list_a1); break;
	  default : $result = @array_merge($result, $list_a2, $list_a1); break;	
	 }	
	break;
	default :
	 switch ($casedata) {
	  case 1: $result   = @array_merge($result, range('A','Z'), $list_a2); break;
	  case 2: $result   = @array_merge($result, range('a','z'), $list_a1); break;
	  default : $result = @array_merge($result, range('A','Z'), $list_a2, range('a','z'), $list_a1); break;	
	 }	
	break;	
   }
   if ($numb) { $result = @array_merge($result, range(0,9)); }
   if ($controlsym) {
	$str = '~`!@#$%^&*()_+{}[]:;"<>,./?|\\';
	for ($i=0; $i <= $this->strlen($str); $i++) {
	 $srt = @$this->substr($str, $i, 1);
	 if ($srt != '') { $result[] = $srt; }	
	}
   }
   return $result;   	
  }//GetSourceCharsArray
  
  /** параметры
  * @params - array(
  *  'casedata' = 0-любой регистр символов
  *                1-только верхний регистр символов
  *                2-только нижний регистр символов
  *   'length'   = длина пароля
  *   'lang'     = 0-и английский и русский языки
  *                1-только английский
  *                2-только русский
  *   'numb'     = true-использовать цыфры при генерации
  *   'controlsym'= true-использовать управляющие символы'
  *   'hashfunc' = '' или метод хэша
  * 
  * ) 
  */   
  protected function GeneratePass($params=null) {
   $data = array(
    'casedata'   => 0,
	'length'     => 10,
	'lang'       => 1,
	'numb'       => true,
	'controlsym' => false,
	'hashfunc'   => ''
   );
   if ($params) { foreach ($data as $key => $val) { if (@key_exists($key, $params)) { $data[$key] = $params[$key]; } } }
   $chart = $this->GetSourceCharsArray($data['casedata'], $data['lang'], $data['controlsym'], $data['numb']);      
   $scount = @count($chart);
   if ($scount <= 0) { return $this->_DoHashed('', $data['hashfunc']); }
   $result = '';
   for ($i=1; $i<=$data['length']; $i++) {
    $result .= $chart[@rand(0,$scount-1)];		
   }
   return $this->_DoHashed($result, $data['hashfunc']);   	
  }//GeneratePass
  
  protected function _DoHashed($str, $name) { return (!$name) ? $str : @hash($name, $str); }    
      
  function _DoActionThisTool() {	  	 
   if ($_POST['doactiontool'] != 'do') { return false; }
   //проверка параметров
   $_POST['casedata'] = (!@is_numeric($_POST['casedata'])) ? '0' : $_POST['casedata'];
   $_POST['width'] = (!$_POST['width'] || !@is_numeric($_POST['width']) || $_POST['width'] < 0 || $_POST['width'] > 300) ?
   10 : $_POST['width'];
   $_POST['lang'] = (!@is_numeric($_POST['lang'])) ? '1' : $_POST['lang'];
   //инициализация паараметров
   $params = array(
    'casedata'   => $_POST['casedata'],
    'length'     => $_POST['width'],
    'lang'       => $_POST['lang'],
    'numb'       => $this->CheckPostValue('numb'),
    'controlsym' => $this->CheckPostValue('controlsym'),
    'hashfunc'   => $_POST['hashcreate']    
   );
   //генерация      
   $this->result = array(
    'data' => $this->GeneratePass($params)
   );     
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_passgenerator

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>