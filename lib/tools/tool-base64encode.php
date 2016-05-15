<?php
 /** Модуль управления инструментом `base64 шифрования`
 * @author [Eugene]
 * @copyright 2012
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_base64encode extends w_toolitem_noajax_method {	
  protected
   $result;
      
  private function ConvertCharset($s, $f='base64_encode') {      
   $_POST['charsetuse'] = (!$_POST['charsetuse']) ? 'UTF-8' : $this->strtoupper($_POST['charsetuse']);   
   if (!$_POST['charsetuse'] || $_POST['charsetuse'] == 'UTF-8') return $f($s);
   
   switch ($f) {
    
    case 'base64_encode': return $f(@iconv('UTF-8', $_POST['charsetuse'], $s));
    case 'base64_decode': return @iconv($_POST['charsetuse'], 'UTF-8', $f($s));   
    default: return $f($s); 
         
   }
  }//ConvertCharset
  
  private function ToCharSet($s) {   
   if (!$_POST['charsetuse'] || $_POST['charsetuse'] == 'UTF-8') return $s;
   return @iconv('UTF-8', $_POST['charsetuse'], $s);    
  }//ToCharSet
      
  function _DoActionThisTool() {	  	    
   if ($_POST['doactiontool'] != 'do') { return false; }  
     
   $this->result = array(
    'encode' => $this->ConvertCharset($_POST['source']), 
    'decode' => $this->ConvertCharset($_POST['source'], 'base64_decode')      
   );     
    
   if ($this->ToCharSet($_POST['source']) != $this->ConvertCharset($this->result['decode'])) {
    $this->result['decode'] = '(no encoded string)';
   }    
   
   $this->result['encode'] = $this->HTMLspecialChars($this->result['encode']); 
   $this->result['decode'] = $this->HTMLspecialChars($this->result['decode']);
     
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_base64encode

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2012 forwebm.net */
?>