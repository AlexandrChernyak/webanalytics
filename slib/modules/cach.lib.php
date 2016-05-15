<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** Модуль управление кэшом проекта
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 interface ss_Cach_Object_Interface {
  function Read();
  function Write($value);  	
 }
 //----------------------------------------------------------------- 
 abstract class ss_Cach_Object implements ss_Cach_Object_Interface {
  protected
   $objInfo;
  
  function __construct() {
   $this->objInfo = false;	
  }
  
  function SetObjInfo($objInfo) { 
   $this->objInfo = $objInfo; 
  }
  
  function GetObjInfo() { 
   return $this->objInfo; 
  }
  
  function GetInfo($id) {
   return ($this->objInfo && isset($this->objInfo[$id])) ? $this->objInfo[$id] : false;	
  }
  
  abstract function UpdateCach();
  abstract function DeleteCachItem();  
  	
 }//ss_Cach_Object 
 //-----------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>