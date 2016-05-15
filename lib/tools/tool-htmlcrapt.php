<?php
 /** Модуль управления инструментом `зашифровка html`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_htmlcrapt extends w_toolitem_noajax_method {	
  protected
   $result;
  
  protected function js_urlencode($str) {
    $str = @iconv('UTF-8', 'UTF-16', $str);    
    $out = '';
	for ($i = 0; $i < @mb_strlen($str, 'UTF-16'); $i++) {
     $out .= '%u'.bin2hex(@mb_substr($str, $i, 1, 'UTF-16'));
    }
    return $out;
  }//js_urlencode
      
  function _DoActionThisTool() {	  	 
   if ($_POST['doactiontool'] != 'do') { return false; }
   //корректировка длины
   if ($this->GetToolLimitInfoEx('maxcharscount') && $this->strlen($_POST['source']) > 
   $this->GetToolLimitInfoEx('maxcharscount')) {    
	 $_POST['source'] = $this->substr($_POST['source'], 0, $this->GetToolLimitInfoEx('maxcharscount')); 
   }      
   //результат
   $this->result = array(
    'result' => 
	'<script type="text/javascript">'."\r\n".
	'<!-- encodyd by '.W_HOSTMYSITE.' -->'."\r\n".
	'<!--'."\r\n".
	'document.write(unescape(\''.	
	$this->js_urlencode($_POST['source']).
	'\'));'."\r\n".
	'//-->'."\r\n".
	'</script>'
   );     
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_htmlcrapt

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>