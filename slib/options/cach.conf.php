<?php
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 /** Модуль управления настройками глобального кэша пакета 
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 //-----------------------------------------------------------------
 /* пустой экземпляр класса кэша. Используется только в качестве шаблона 
    в качестве информации о получаемых данных, например при чтении кэша или 
	обновлении кэша используется метод:
	
	$this->GetInfo($id)
	предоставляет следующую информацию:
	$this->GetInfo('url') = объект ss_ConnectQuery анализируемого сайта
	$this->GetInfo('plugins') = объект ss_Plugin_obj_List (список плагинов)
	$this->GetInfo('plugin') = объект, наследник от ss_Plugin_obj (текущий плагин)
	
	при чтении и сохранении кэша - данные могут приходить и уходить в виде массивов
	Рекомендуется сохранить и считывать данные при помощи метода 
	serialize и unserialize
	однако данные поступают в исходном состоянии и строки лучше пропускать через 
	методы экранирования и т.д
	
	
 class My_Cach_Listener extends ss_Cach_Object {
  
  //чтение из кэша. false если чтение из кэша не прошло, или значение
  function Read() { return false; }
  //запись в кэш  
  function Write($value) { return false; }
  //создание
  function __construct() {
   parent::__construct();
  }
  //обновление кэша, удаление например устаревших данных
  function UpdateCach() { return false; } 
  //принудительно удаляет кэш текущего элемента
  function DeleteCachItem() { return false; } 
  	
 }//My_Cach_Listener
 		 
 */
 class My_Cach_Listener extends ss_Cach_Object {
  /** объект сайта */
  private $control = null; 
    
  function __construct() {
   global $CONTROL_OBJ;	
   parent::__construct();
   $this->control = $CONTROL_OBJ;
  }//__construct
    
  /** дублирование элемента id */
  protected function GetId() { 
   return $this->GetInfo('plugin')->GetPluginID(); 
  }//GetId
  
  /** экранирование данных */
  function EncodeData($data) {
   //строковые элементы	
   if (!@is_array($data)) {
   	$data = (string) $data;  	
    $data = $this->control->ClearBreake($data, true, false);
    $data = @str_replace("\n", ":nnbr:", $data);
    return $this->control->db->EscapeString($data);    
   }
   //вложение по циклу
   return @array_map(array($this, 'EncodeData'), $data);    	
  }//EncodeData
  
  /** деэкранирование данных */
  function DecodeData($data) {
   //строковые данные
   if (!@is_array($data)) {	return @stripslashes(@str_replace(":nnbr:", "\n", $data)); }
   //вложение по циклу
   return @array_map(array($this, 'DecodeData'), $data);   	
  }//EncodeData  
  
  /** подготовка данных для записи */
  protected function PrepereToWrite($data) {  
   return $this->EncodeData(@serialize($this->EncodeData($data)));   	
  }//PrepereToWrite
  
  /** подготовка данных для чтения */
  protected function PrepereToRead($data) { 	  	   	
   return $this->DecodeData(@unserialize($data));   	
  }//PrepereToRead
  
  /** получение идентификатора списка секции кэша */
  protected function GetCachGroupIdentList() {
   return $this->GetInfo('plugin')->GetCachURLmd5();   	
  }//GetCachGroupIdentList
  
  /** чтение из кэша. false если чтение из кэша не прошло, или значение */
  function Read() { 
   if (!$id = $this->GetId()) { return false; }
   if (!$uid = $this->GetCachGroupIdentList()) { return false; }
   $table = $this->GetTableName();
   $res = $this->control->db->GetLineArray($this->control->db->mPost(
    "select data, datecreat from $table where ident='$id' and identlist='$uid' limit 1"    
   ));
   if (!$res) { return false; }
   $this->GetInfo('plugin')->lastupdatecachdate = $res['datecreat'];
   return $this->PrepereToRead($res['data']);
   //return (!$res) ? false : $this->PrepereToRead($res['data']);   	  
  }//Read
  
  /** запись в кэш */  
  function Write($value) {  	
   if (!$id = $this->GetId()) { return false; }
   if (!$uid = $this->GetCachGroupIdentList()) { return false; }
   $table = $this->GetTableName();   
   $value = $this->PrepereToWrite($value);
   $date  = $this->control->GetThisDateTime();   
   $this->control->db->mPost(
    "INSERT INTO $table SET ident='$id', identlist='$uid', datecreat='$date', data='$value'"
   ); 
   return true;    
  }//Write
  
  /** идентификатор таблици кэша */
  protected function GetTableName() {
   return ($this->GetInfo('plugin')->GetFlagUseLongData()) ? $this->control->tables_list['cachlong'] :
   $this->control->tables_list['cachshort'];	
  }//GetTableName

  /** обновление кэша, удаление устаревших данных */
  function UpdateCach() { 
   $days = $this->GetInfo('plugin')->GetPluginStoredDays();
   $id = $this->GetId();
   if (!$days || $days <= 0 || !$id) { return false; }
   //идентификатор таблици кэша
   $table = $this->GetTableName();
   //обновление   
   $this->control->db->mPost(
    "delete from $table where ident='$id' and DATEDIFF(NOW(),DATE(datecreat)) > $days"
   );
   return true; 
  }//UpdateCach
  
  /** принудительное удаление кэша текущих данных */
  function DeleteCachItem() {
   if (!$id = $this->GetId()) { return false; }
   if (!$uid = $this->GetCachGroupIdentList()) { return false; }
   $table = $this->GetTableName();
   $this->control->db->mPost(
    "delete from $table where ident='$id' and identlist='$uid' limit 1"  
   );
   return true;  
  }//DeleteCachItem  
  	
 }//My_Cach_Listener
 //-----------------------------------------------------------------
 
 /*
   Элемент кэша по умолчанию для плагинов. Должен представлять класс, наследник от 
   ss_Cach_Object (описан в модуле /modules/cach.lib.php) 
   
   false, если кэш использовать необходимости нет,
   или экземпляр класса для обработки
 */ 
 $_SS_CACH_EVENT_CLASS_LISTENER_WS = /* false */ new My_Cach_Listener();  
 //-----------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>