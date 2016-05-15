<?php
 /** модуль обработки запросов xml api
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 /*
  error code:
  
  -2 - Ошибка инициализации оплаты запросов
  -1 - Функция simplexml_load_string недоступна на сервере
  
  1  - Пустой xml запрос
  2  - Отправлен некорректный запрос
  3  - Не указан hash код пользователя
  4  - Не определен тип возвращаемых xml данных
  5  - Неизвестный тип возвращаемых xml данных
  6  - Api недоступен или отключен администратором 
  7  - Неверный hash код пользователя
  8  - Аккаунт не поддерживает xml api
  9  - Вы исчерпали дневной лимит запросов для используемого типа api
  10 - На Вашем счете недостаточно средств для выполнения запросов
  11 - Произошла ошибка при оплате выполнения запросов
  12 - Ошибка финализации запроса, пожалуйста, повторите запрос. (счетчик не изменен)
  
  
 Запрос-----------
 <?xml version="1.0" encoding="UTF-8"?> 	
 <request> 	
	<charset>UTF-8</charset>
    <code>специальный api код</code>
    <apitype>тип запроса</apitype>
    <error>отображать или нет текст ошибки</error>
	 	
 </request>
 
 ответ-------------
 <?xml version="1.0" encoding="кодировка"?>
 <seotools version="версия проекта">
  <request>
   элементы, отправленные в запросе  
  </request>
  <response>
   <datetime>дата и время в формате Y-m-d H:i:s</datetime>
    
   <errorcode>код ошибки или тэг отсутствует</errorcode>
   <error>если ошибка и передан положительный параметр error - содерит текст ошибки (английский язык)</error>
   
   <results>
    результаты если нет ошибок, или код ошибки = 0
   </results>
  
  </response>
 </seotools> 
 */ 
 //-------------------------------------------------------------------------------------
 class w_api_project extends w_defext {
  const W_DEFANSWERCHARSET = 'UTF-8';
  const W_SEOTOOLSVERSION  = '1.3.5';
  const W_TRANSACTIONNUMB  = 18;
  const W_OUTGENERATOREX   = 'Do';  
  protected
   $xml,
   $error,
   $control,
   $header,
   $options,
   $identifity,
   $apiRecordInfo,
   $bodyObject,
   $nRecord;  
    
  function __construct(w_Control_obj $control, $apioptions) {
   parent::__construct();
   $this->control = $control;
   $this->xml = '';
   $this->error = 0;
   $this->identifity = false;
   $this->apiRecordInfo = false;
   $this->bodyObject = '';
   $this->nRecord = false;
   $this->header = array(
    'charset' => self::W_DEFANSWERCHARSET,
    'code'    => '',
    'apitype' => ''
   );    
   $this->options = $apioptions;
  }//__construct  
  
  protected function ReturnWithError($errorcode) { 
   if ($this->error != $errorcode) { $this->error = $errorcode; }
   return false; 
  }//ReturnWithError
  
  protected function ReadXMLData() { 
   if ($this->strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') { return $this->ReturnWithError(1); }
   if (!$this->options['enabled']) { return $this->ReturnWithError(6); }   
   $this->xml = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : @file_get_contents("php://input");
   if (!$this->xml) { return $this->ReturnWithError(1); }
   //parse xml request
   if (!@function_exists('simplexml_load_string')) { return $this->ReturnWithError(-1); }
   if (!$xml = @simplexml_load_string($this->xml)) { return $this->ReturnWithError(2); }  
   foreach ($xml as $name => $item) {
    $item = (string) $item;
    $this->header[$name] = $this->HTMLspecialChars(@trim($item));     
   }
   if (!$this->header['charset']) { $this->header['charset'] = self::W_DEFANSWERCHARSET; } else {
    $this->header['charset'] = $this->strtoupper($this->header['charset']);
   }
   if (!$this->header['code']) { return $this->ReturnWithError(3); } 
   if (!$this->header['apitype']) { return $this->ReturnWithError(4); }  
   return true; 
  }//ReadXMLData
  
  protected function TerminateWithError($error=false) {
   if ($error !== false) { $this->error = $error; } 
   print $this->GenerateAnswerHeader(
    '  <errorcode>'.$this->error.'</errorcode>'.(($this->header['error']) ? $this->ConvertError() : '')
   );
   exit;    
  }//TerminateWithError
  
  protected function ConvertError() {
   $s = ''; 
   switch ($this->error) { 
    case -2:
     $s = "Error initializing payment requests";
     break;
    case -1: 
     $s = 'simplexml_load_string function is not available on the server';
     break;
    case 0:
     $s = 'No Errors';
     break;   
    case 1:
     $s = 'Empty xml request';     
     break;   
    case 2:
     $s = "Sent an invalid request";
     break;   
    case 3:
     $s = "Not specified hash user code";
     break;   
    case 4:
     $s = "Not specified type of the returned xml data";
     break;
    case 5:
     $s = "Unknow type of the returned xml data";
     break;
    case 6:
     $s = "Api unavailable or administratively disabled";
     break;
    case 7:
     $s = "Incorrect hash code user";
     break;
    case 8:
     $s = "Account does not support xml api";
     break; 
    case 9:
     $s = "You have reached the daily limit for this type of query api";
     break; 
    case 10:
     $s = "On your account not enough money to perform queries";
     break;
    case 11:
     $s = "An error occurred while payment queries";
     break;
    case 12:
     $s = "Error finalizing the request, please try again. (the counter is not changed)";
     break;            
   } 
   return ($s) ? "\r\n  <error>$s</error>\r\n" : ''; 
  }//ConvertError
  
  protected function GenerateAnswerHeader($body) {
   $data  = '<?xml version="1.0" encoding="'.$this->header['charset'].'"?>'."\r\n";
   $data .= '<seotools version="'.self::W_SEOTOOLSVERSION.'">'."\r\n";
   $data .= " <request>\r\n";
   foreach ($this->header as $name => $value) {
    $data .= "  <$name>$value</$name>\r\n";    
   }   
   $data .= " </request>\r\n";
   $data .= " <response>\r\n";
   $data .= "  <datetime>".$this->GetThisDateTime()."</datetime>\r\n";
   $data .= "  <host>".W_HOSTMYSITE."</host>\r\n";
   if ($this->identifity) {
    $data .= "  <username>".$this->identifity['username']."</username>\r\n";       
   }
   $data .= @rtrim($body)."\r\n";   
   $data .= " </response>\r\n";
   $data .= '</seotools>';
   @header('Content-Type: text/xml; charset='.$this->header['charset']); 
   return ($this->header['charset'] == 'UTF-8') ? $data : @iconv('UTF-8', $this->header['charset'], $data);   
  }//GenerateAnswerHeader
  
  protected function InitIdentifity() {
   $code = $this->strtolower($this->header['code']);
   $this->identifity = $this->control->db->GetLineArray($this->control->db->mPost(
    "select * from {$this->control->tables_list['users']} where ".
    "Lower(md5(CONCAT(iduser,datereg,'".$this->GetSessionIdentify()."',username,userhash)))='$code' limit 1"
   ));
   if (!$this->identifity) { return $this->ReturnWithError(7); }
   if (
    !$this->identifity['genoptions'] || $this->control->userdata['userlocked'] ||
    !$this->control->ReadOption('USEXMLAPI', $this->identifity['genoptions'])) { 
     return $this->ReturnWithError(8); 
   }   
   return true;  
  }//InitIdentifity
  
  protected function CorrectApiRecordCountElement(&$apiRecord) {
   if ($this->nRecord || !isset($apiRecord['iditem'])) { return true; }
   $d = $this->GetThisDate();
   if ($apiRecord['nowdater'] != $d) {
    $apiRecord['nowdater'] = $d;
    $apiRecord['nowcount'] = 1;    
   } else {
    $apiRecord['nowcount']++;    
   }  
   $apiRecord['reqcount']++;
   return true;    
  }//CorrectApiRecordCountElement
  
  protected function CheckAccessByAccount() {
   return isset(
    $this->options['apitypes'][$this->header['apitype']]['private'][$this->strtolower($this->identifity['username'])]
   );    
  }//CheckAccessByUserName
  
  protected function CheckApiRecordAccess(&$apiRecord, $price) {
   if ($apiRecord['usecount'] < 0) { $apiRecord['usecount'] = 0; }
   if (!$price['count'] || (!$price['value'] && !$price['freecount']) || $this->CheckAccessByAccount()) { return true; }
   //access by req stat
   $d = $this->GetThisDate();
   //free access
   if ($price['freecount'] && $apiRecord['nowdater'] != $d) {
    if (!$price['value'] || ($price['value'] && $price['freecount'] > $apiRecord['usecount'])) {    
     $apiRecord['usecount'] = $price['freecount'] - 1;
     return true;
    }     
   }
   if ($apiRecord['usecount'] > 0) { $apiRecord['usecount']--; return true; }
   //default   
   if (!$price['value']) { return $this->ReturnWithError(9); }
   if ($this->identifity['purcedata'] < $price['value']) { return $this->ReturnWithError(10); }
   if ($this->control->MoneyProcess(
    $this->identifity, "Payment requests api ({$price['count']}) for [".
    $this->options['apitypes'][$this->header['apitype']]['name']."]",
    ($this->identifity['iduser'] + self::W_TRANSACTIONNUMB), $price['value'], false, 'sub' 
   )) { return $this->ReturnWithError(11); }
   //set new elements
   $apiRecord['usecount'] = $price['count'];
   if (isset($apiRecord['iditem'])) {    
    if (!$this->control->db->UPDATEAction('xmpapitemp', 
     array('usecount' => $apiRecord['usecount']), "iditem='{$apiRecord['iditem']}'", "1"
    )) {
     return $this->ReturnWithError(-2);    
    }  
   } else {   
    if (!$this->control->db->INSERTAction('xmpapitemp', $apiRecord)) { return $this->ReturnWithError(-2); }
    $apiRecord['iditem'] = $this->control->db->InseredIndex();
    $this->nRecord = true;
   }
   $apiRecord['usecount']--;
   return true;   
  }//CheckApiRecordAccess
  
  protected function PrepereApiRecordAccess() {
   $apiRecord = $this->control->GetApiInformationBlock(
    $this->options['apitypes'][$this->header['apitype']]['id'], $this->identifity['iduser'], true
   );
   $price = $this->options['apitypes'][$this->header['apitype']]['price'];
   if (!$apiRecord) {
    $apiRecord = array(
     'apiid'    => $this->options['apitypes'][$this->header['apitype']]['id'],
     'userid'   => $this->identifity['iduser'],
     'reqcount' => 1,
     'usecount' => $price['freecount'],
     'nowcount' => 1,
     'nowdater' => $this->GetThisDate()
    );    
   }
   //ok, follow if
   if (!$this->CheckApiRecordAccess($apiRecord, $price)) { return false; }
   $this->CorrectApiRecordCountElement($apiRecord);
   $this->apiRecordInfo = $apiRecord;
   return true;    
  }//PrepereApiRecordAccess
  
  protected function ContinueApiRecordAccess() {
   if ($this->error) { $this->TerminateWithError(); } 
   if (!isset($this->apiRecordInfo['iditem'])) {
    if (!$this->control->db->INSERTAction('xmpapitemp', $this->apiRecordInfo)) { $this->TerminateWithError(12); } 
   } else {
    $id = $this->apiRecordInfo['iditem'];
    unset($this->apiRecordInfo['iditem']);
    $ok = false;
    if ($this->nRecord) {
     $ok = $this->control->db->UPDATEAction('xmpapitemp', 
      array('usecount' => $this->apiRecordInfo['usecount']), "iditem='$id'", "1"
     );        
    } else {   
     $ok = $this->control->db->UPDATEAction('xmpapitemp', $this->apiRecordInfo, "iditem='$id'", "1");     
    }
    if (!$ok) { $this->TerminateWithError(12); }   
   }
   print $this->GenerateAnswerHeader("  <results>\r\n".@rtrim($this->bodyObject)."\r\n  </results>");    
  }//ContinueApiRecordAccess
  
  function Process() {
   if (!$this->ReadXMLData()) { $this->TerminateWithError(); }
   if (!isset($this->options['apitypes'][$this->header['apitype']])) { $this->TerminateWithError(5); }
   //ok, get access
   if (!$this->InitIdentifity()) { $this->TerminateWithError(); }
   if (!$this->options['apitypes'][$this->header['apitype']]['enabled']) { $this->TerminateWithError(6); } 
   if (!$this->PrepereApiRecordAccess()) { $this->TerminateWithError(); }  
   $event_mode = self::W_OUTGENERATOREX.$this->options['apitypes'][$this->header['apitype']]['event'];
   $this->$event_mode();
   $this->ContinueApiRecordAccess();    
  }//Process
  
  protected function DoUpdatesListGenerator() {
   $options = $this->options['apitypes'][$this->header['apitype']]; $br = "\r\n";
   $this->bodyObject .= '   <updates url="http://'.W_HOSTMYSITE.'/updates/" maxcount="'.
   (($options['options']['maxcount']) ? $options['options']['maxcount'] : 'unlimited').'">'.$br;
   //list
   if (!$this->header['count'] || !@is_numeric($this->header['count'])) { $this->header['count'] = 4; }
   $this->header['count'] = $this->CorrectSymplyString($this->header['count']);
   if ($this->header['count'] > $options['options']['maxcount']) {
    $this->header['count'] = $options['options']['maxcount'];
   }
   $settings_get = array(
    '1' => array('id' => 'cy', 'name' => 'Yandex CY'), 
    '2' => array('id' => 'yasearch', 'name' => 'Yandex Search'),
    '3' => array('id' => 'yaca', 'name' => 'Yandex Catalog'),
    '4' => array('id' => 'pr', 'name' => 'Google PR')
   );
   foreach ($settings_get as $id => $item) {
    $space = '    ';
    if (isset($this->header[$item['id']]) && !$this->header[$item['id']]) { continue; }
    $data = $this->control->db->mPost(
     "select * from {$this->control->tables_list['updates']} where engtype='$id' ".
     "order by dateupd DESC limit {$this->header['count']}"
    );
    $this->bodyObject .= $space.'<update id="'.$item['id'].'" description="'.$item['name'].'">'.$br;
    while ($row = $this->control->db->GetLineArray($data)) {
     $this->bodyObject .= $space.' <item id="2'.$row['iditem'].'" timestamp="'.@strtotime($row['dateupd']).
     '" tzone="MSK">'.$br.$space.'  '.$row['dateupd'].$br.$space.' </item>'.$br;     
    }    
    $this->bodyObject .= $space."</update>$br";
   }   
   $this->bodyObject .= "   </updates>";
   return true; 
  }//DoUpdatesListGenerator
  
  protected function DoShLinksListGenerator() {
   $br = "\r\n"; $space = '    ';
   $list = $this->control->db->mPost("select * from {$this->control->tables_list['linksvit']} order by ldate DESC");
   $count = (!$list) ? 0 : $this->control->db->GetRowCountBd($list);
   $this->bodyObject .= '   <shlinks url="http://'.W_HOSTMYSITE.'/vitrinalinks/" count="'.$count.'">'.$br;
   while ($row = $this->control->db->GetLineArray($list)) {
    $this->bodyObject .= $space.'<item id="'.$row['iditem'].'" date="'.$row['ldate'].'" host="'.$row['lhost'].
    '" url="'.$row['lurl'].'" bold="'.$row['isbolded'].'" indexed="'.$row['isindexed'].'" country="'.
    $row['lfromcountr'].'">'.$br.$space.' '.$row['ltext'].$br.$space.'</item>'.$br;
   } 
   $this->bodyObject .= "   </shlinks>";
   return true; 
  }//DoShLinksListGenerator
   
 }//w_api_project
 //-------------------------------------------------------------------------------------
 $api = new w_api_project($CONTROL_OBJ, $_API_CONFIGURATION_PACK);
 $api->Process(); 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>