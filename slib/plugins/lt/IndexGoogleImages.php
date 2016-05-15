<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** index images google
 * @author [Eugene]
 * @copyright 2012
 * @url http://forwebm.net
 */
 //----------------------------------------------------------------- 
 final class ss_Plugin_IndexGoogleImages extends ss_Plugin_IndexTemplate {  
  const LINK_QUERY = 'https://www.google.com/search?q=site:[url_real_host_no_www]&hl=en&newwindow=1&prmd=imvns&source=lnms&tbm=isch';
   
  function __construct(ss_Plugin_obj_List $AOwner) {	 
   parent::__construct($AOwner, 'IndexGoogleImages', 'Google Image Index', 3);	 
  }//__construct
  
  function ExecPlugin(ss_ConnectQuery &$Request) {
   $connect = $this->GetConnect();    
   $type_number = 0;
   $link_query = '';
   if (!$this->_DoActionDefaultData($Request, self::LINK_QUERY, $type_number, $link_query)) { 
   	return false; 
   }
   switch ($type_number) {
	case 0: /* default */ return $this->_DoParseResultsGoogleData($Request);	
   }
   $this->SetUnknowNameError();
   return false;      	
  }//ExecPlugin 
    	
 }//ss_Plugin_IndexGoogleImages
 //-----------------------------------------------------------------
 /* Copyright (с) 2012 forwebm.net */ 
?>