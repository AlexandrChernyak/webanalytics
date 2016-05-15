<?php
 /** Модуль управления инструментом `генератор опечаток слепой печати`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_typosinkeyboard extends w_toolitem_noajax_method {
  const W_COUNT_OF_CHARS_ANALISYS = 2000;
  const W_SLEEP_INTERVAL = 0.2;	
  protected
   $lines,
   $result,
   $flags;	
  
  function GetLines() { return ($this->lines) ? $this->lines : array(); }
  function GetLimitCount() { 
   return ($this->GetToolLimitInfoEx('maxcharscount') === false) ? 
   self::W_COUNT_OF_CHARS_ANALISYS : $this->GetToolLimitInfoEx('maxcharscount'); 
  }//GetLimitCount
  
  protected function PrepereLinesList() {       
   if (!$this->lines = $_POST['lines']) { return $this->SetError('No text for generate'); }
   if ($this->CheckPostValue('tolowercase')) { $this->lines = $this->strtolower($this->lines); }  
   if ($this->CheckPostValue('deletemorespaces')) {
	while (@$this->strpos($this->lines, "  ") !== false) { 
	 $this->lines = @str_replace("  ", " ", $this->lines); 
	}
   }  
   $_POST['wordscounttransp'] = (!$_POST['wordscounttransp']) ? 0 : ((!@is_numeric($_POST['wordscounttransp'])) ? 3 :
   $_POST['wordscounttransp']); 
   return true;   	
  }//PrepereLinesList
  
  function RequredFlags() {
   $filename = W_LIBPATH.'/tools_items/wrong_words_list.const.php';
   if (!@file_exists($filename)) { return $this->SetError('Not found one of System lib file!'); }
   require_once $filename;
   $this->flags = array(
    'rules' => $CHARS_LIST_MAP_MISTAKES
   );    
   return true;	
  }//RequredFlags
  
  protected function GetReplacedChar($ch) {
   $count = $this->strlen($ch);
   if ($count > 1) {
   	$str = '';
	for ($i=0; $i<$count; $i++) {
	 $str .= $this->GetReplacedChar($this->substr($ch, $i, 1));
	}
	return (!$str) ? $ch : $str;	
   }	  	
   if (!isset($this->flags['rules']['words'][$ch])) { return $ch; }
   $data = $this->flags['rules']['words'][$ch];
   return $data[@rand(0, @count($data))];   	
  }//GetReplacedChar 
  
  protected function ConvertOneCharToTransp($ch) {
   $count = $this->strlen($ch);
   if ($count > 1) {
   	$str = '';
	for ($i=0; $i<$count; $i++) {
	 $str .= $this->ConvertOneCharToTransp($this->substr($ch, $i, 1));
	}
	return (!$str) ? $ch : $str;	
   }	  	
   return (!isset($this->flags['rules']['keyboardrepl'][$ch])) ? $ch : $this->flags['rules']['keyboardrepl'][$ch];
  }//ConvertOneCharToTransp
  
  function ChTable($s, $ext) { return @preg_match("/[$ext]/u", $s); }
  
  function CorrectCount($source) {
   $source = @preg_replace("/[^a-zа-я]/ui", '', $source);
   return $this->strlen($source);   	
  }//CorrectCount
   
  function ProcessedListen() {
   if (!$this->RequredFlags()) { return false; }	
   $data = '';
   $englishrepl = $_POST['wordscounttransp'];
   $withenglish = $this->CheckPostValue('withenglish');
   $tolowercase = $this->CheckPostValue('tolowercase');
   $count = $this->strlen($this->lines);
   $maxprocesscount = ($this->GetLimitCount() > 0) ? $this->GetLimitCount() : false;
   $percentrepl = (!$_POST['percentrepl'] || !@is_numeric($_POST['percentrepl'])) ? 0 : $_POST['percentrepl'];
   $percentrepl = @round($percentrepl);
   if ($percentrepl < 0) { $percentrepl = 0; } elseif ($percentrepl > 100) { $percentrepl = 100; }
   $_POST['percentrepl'] = $percentrepl;
   $corrdctlength = $this->CorrectCount($this->lines);
   $replfor = @round(($corrdctlength * $percentrepl) / 100);
   if ($replfor < 0) { $replfor = 0; }
   $interval = ($replfor <= 0) ? 0 : @round($corrdctlength / $replfor);
   if ($interval < 0) { $interval = 0; }
   $incer = 1;
   $replcount = 0;
   $lasten = false;
   $wordsreplecednow = 0;
   $allwordsinenglish = 0;
   $fromtransp = false;
   //action
   $i = 0;   
   $en_word = 0;
   while ($i < $count) {
   	$ch = $this->substr($this->lines, $i, 1);
	$up = !$tolowercase && $this->ChTable($ch, 'A-ZА-Я');		
	if ($up || $this->ChTable($ch, 'a-zа-я')) {
	 if ($up) { $ch = $this->strtolower($ch); }
	 //process to replace
	 $en = $lasten = $this->ChTable($ch, 'a-z'); 
	 if (!$percentrepl || $incer != $interval || $replcount >= $replfor) { 
	  $ch_new = $ch; 
	  if ($percentrepl) { $incer++; }
	 } else {
	  $ch_new = ($en && !$withenglish) ? $ch : $this->GetReplacedChar($ch); 
	  $incer = 1;
	  $replcount++; 	
	 }
	 $fromtransp = false;
	 //char is replaced, action to invert
	 if ($englishrepl) {
	  if ($en) { $en_word++; if ($wordsreplecednow) { $wordsreplecednow = 0; } } elseif (!$lasten && $en_word > 1) {
	   $ch_new = $this->ConvertOneCharToTransp($ch_new);
	   $fromtransp = true;
	  }
	 }
	 $data .= ($up) ? $this->strtoupper($ch_new) : $ch_new;	
	} else {		
	 if ($englishrepl) {	
	  if ($englishrepl && $wordsreplecednow >= $englishrepl) { 
	   $wordsreplecednow = 0; $en_word = 0; 
	  } else { $wordsreplecednow++; }
	  if ($fromtransp) { $allwordsinenglish++; $fromtransp = false; }
	 }	
	 $data .= $ch;	
	}
	$i++;
   }
   $this->result['result'] = $this->HTMLspecialChars($data);
   $this->result['statinfo'] = array(
    //всего замен на опечатки
	'replfor' => $replfor,
	//интервал замен, символов
	'interval' => $interval,
	//русских слов в английской раскладке
	'allwordsinenglish' => $allwordsinenglish
   );
   //return ($this->result) ? true : $this->SetError('No Results generated, no text for generate!');
   return true;	
  }//ProcessedListen 
    	
  function _DoActionThisTool() {
   if ($_POST['doactiontool'] != 'do') { return false; }
   $this->flags = false;
   $this->result = array();
   if (!$this->PrepereLinesList()) { return false; }
   return $this->ProcessedListen();   	
  }//_DoActionThisTool
  	
 }//w_toolitem_typosinkeyboard

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>