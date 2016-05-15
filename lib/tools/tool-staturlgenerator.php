<?php
 /** Модуль управления инструментом `генератор статических url`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_staturlgenerator extends w_toolitem_noajax_method {	
  protected
   $result,
   $rules_list;
   
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $rules_list = null;	
  }//__construct
  
  protected function CombineRules() {
   if ($this->rules_list !== null) { return $this->rules_list; }	
   $rules = array('wL', 'wR');
   $result = '';
   foreach ($rules as $rule) {
	if ($this->CheckPostValue($rule)) {
	 $result .= ($result) ? ','.$this->substr($rule, 1) : $this->substr($rule, 1);	 	
	}	
   }
   return $this->rules_list = ($result) ? " [$result]" : '';	
  }//CombineRules
  
  /** обработка одного элемента ссылки */
  protected function ProcessURLItem($url) {
   if (!$url = trim($url)) { return false; }
   $P = @parse_url($url);
   if (!$P || !isset($P['path'])) { return false; }
   // / symbols
   while ($this->strlen($P['path']) >= 0 && $this->substr($P['path'], 0, 1) == '/') {
	$P['path'] = @substr_replace($P['path'], '', 0, 1);
   }
   if (!$P['path']) { return false; }
   //ok path is
   $s    = $P['path'];
   $path = $this->StrFetch($s, '.');
   if (!$path) { $path = 'index'; }
   //ok список путей
   $query  = $P['path'];
   $query1 = '';
   $s  = ($P['query']) ? $P['query'] : '';
   $s1 = $this->StrFetch($s, '&');
   $incer = 1;
   $incer_var = 1;
   while ($s || $s1) {
   	//values
	$value = $s1;
	$name  = $this->StrFetch($value, '=');
	if ($name) {  	
	 //path
	 $path .= (($incer == 1) ? '/' : '').(($value) ? $name : '([^/]+)').'/';
	 //real path	
	 $val_data = $name.'='.(($value) ? $value : '$'.$incer_var);
	 $query1 .= ($query1) ? '&'.$val_data : $val_data;	
	 $incer++;
	 if (!$value) { $incer_var++; }
	}	
	$s1 = $this->StrFetch($s, '&');
   }
   //сформировать
   $path = '^'.$path.'?$ '.$query.(($query1) ? '?'.$query1 : '').$this->CombineRules();
   $this->result['result'] .= 'RewriteRule '.$this->HTMLspecialChars($path)."\r\n";
   return true;   	
  }//ProcessURLItem
       
  function _DoActionThisTool() {	  	 
   if ($_POST['doactiontool'] != 'do') { return false; }   
   $this->result = array(
    'result' => "RewriteEngine On\r\n\r\n"
   );   
   $_POST['source'] = $this->ClearBreake($_POST['source'], true, false);
   $limit = $this->GetToolLimitInfoEx('maxurlcount');
   $s  = $_POST['source'];
   $s1 = $this->StrFetch($s, "\n");
   $incer = 0;
   while ($s || $s1) {
	if ($limit && $limit > 0 && $incer >= $limit) { break; } 
	$this->ProcessURLItem($s1);
	$incer++;	
	$s1 = $this->StrFetch($s, "\n");
   }  
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_staturlgenerator

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>