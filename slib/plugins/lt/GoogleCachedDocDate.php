<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** кэш google
 * @author [Eugene]
 * @copyright 2012
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 
 final class ss_Plugin_GoogleCachedDocDate extends ss_Plugin_GenTemplate {  	
  const LINK_QUERY = 'http://webcache.googleusercontent.com/search?q=cache:[url_real_host_no_www]/+&cd=1&hl=en&ct=clnk';
  
  private $month_replased = array(
   'jan' => '01', 'feb' => '02',
   'mar' => '03', 'apr' => '04',
   'may' => '05', 'jun' => '06',
   'jul' => '07', 'aug' => '08',
   'sep' => '09', 'oct' => '10',
   'nov' => '11', 'dec' => '12'
  );
  
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'GoogleCachedDocDate', 'Google Cache', 2);	 
  }//__construct  
  
  function GetCachURLmd5() { return @md5($this->strtolower($this->GetConnect()->url_real_host_without_www)); }
  
  function ExecPlugin(ss_ConnectQuery &$Request) {      
   if (!$Request->RequestGET($this->GetConnect()->ReplaceCorrect(self::LINK_QUERY))) {
    return $this->SetError($Request->res_error);
   }  
   if (@preg_match("/(([0-9]{2}[\s]+[a-z]{3}[\s]+[0-9]{4})[\s]+([0-9]{2}:[0-9]{2}:[0-9]{2}))[\s]*gmt/isu", 
    $Request->GetData(), $arr)) {       
    
    $losts = $date = @trim($arr[2]);
    
    foreach ($this->month_replased as $name => $value) {
	 $date = @str_ireplace($name, $value, $date);
	 if ($losts != $date) { break; }
    }
    
    if ($date) {    
     $lst = @explode(' ', $date);
     if ($lst && @count($lst) >= 3) {
      
      $date = $lst[2].'-'.$lst[1].'-'.$lst[0];
     
      $time = $arr[3];
      return $date.(($time) ? " $time" : '');     
     }           
    } 
           
   }   
   return $this->SetError('No Date found!');      	
  }//ExecPlugin  
  	
 }//ss_Plugin_GoogleCachedDocDate
 //-----------------------------------------------------------------
 /* Copyright (с) 2012 forwebm.net */ 
?>