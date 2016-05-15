<?php
 /** Модуль управления инструментом `транслит переводчик строк`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_stringtranslit extends w_toolitem_noajax_method {	
  protected
   $result;
  
  /** сортировка массива */
  function CheckElements($a, $b) {
   $a = $this->strlen($a);	
   $b = $this->strlen($b);	  	
   return ($a == $b) ? 0 : (($a < $b) ? 1 : -1);		
  }//CheckElements 
  
  /** транслит */
  protected function _DoTranslitConvert($s, $toback=false) { 
   //шаблон замен	
  	$list = array(
        'А' => 'A',  'Б' => 'B',  'В' => 'V',    'Г' => 'G',   'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH',
        'З' => 'Z',  'И' => 'I',  'Й' => 'I\'',  'К' => 'K',   'Л' => 'L', 'М' => 'M', 'Н' => 'N',  'О' => 'O',
        'П' => 'P',  'Р' => 'R',  'С' => 'S',    'Т' => 'T',   'У' => 'U', 'Ф' => 'F', 'Х' => 'H',  'Ц' => 'C',
        'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH',  'Ъ' => '`',   'Ы' => 'Y', 'Ь' => '\'','Э' => 'JE', 'Ю' => 'YU',
        'Я' => 'YA', 
		'а' => 'a',  'б' => 'b',  'в' => 'v',    'г' => 'g',   'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 
		'з' => 'z',  'и' => 'i',  'й' => 'i\'',  'к' => 'k',   'л' => 'l', 'м' => 'm', 'н' => 'n',  'о' => 'o',  
		'п' => 'p',  'р' => 'r',  'с' => 's',    'т' => 't',   'у' => 'u', 'ф' => 'f', 'х' => 'h',  'ц' => 'c', 
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',  'ъ' => '`',   'ы' => 'y', 'ь' => '\'','э' => 'je', 'ю' => 'yu', 
		'я' => 'ya'
	);
	if ($toback) {
	 //не дать замены на мягкий и твердый заглавные	
	 unset($list['Ъ']);
	 unset($list['Ь']);
	 //отсортировать по (сперва идет замена самых длинных фраз)
     @uasort($list, array($this, 'CheckElements'));	
	}   
	//заменить по шаблону 
    return @strtr($s, ($toback) ? @array_flip($list) : $list); 
  }//TranslitConvert  
       
  function _DoActionThisTool() {	  	 
   if ($_POST['doactiontool'] != 'do') { return false; }   
   $this->result = array(
    'result' => $this->HTMLspecialChars($this->_DoTranslitConvert($_POST['source'], $this->CheckPostValue('back')))
   );   
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_stringtranslit

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>