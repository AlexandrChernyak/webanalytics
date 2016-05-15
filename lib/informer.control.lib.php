<?php
 /** Модуль обработки и отображения информеров
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */  
 //-------------------------------------------------------
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 //-------------------------------------------------------
 /** шаблон элементов */
 abstract class w_informer_gen_obj extends w_defext {		
  var $control = null;	
  
  function __construct(w_Control_obj $control) {	
   parent::__construct();
   $this->control = $control;  
  }//__construct	
  
  /** экранирование метода вывода текста по ресурсам */
  function GetText($name, $list=false, $def=false) { return $this->control->GetText($name, $list, $def); }
  
  /** возвращает параметр из массива $this->result
  *   В качестве пути по массиву указывается ключ с разделителем,
  *   пример:
  *   GetResult('item')
  *   или
  *   GetResult('item.subitem')
  *   или 
  *   GetResult('item.subitem.subitem')
  *   и т.д. В качестве вложения используется точка в имени ключа результата        
  */
  function GetResult($name='', $subname='', $data=false) {
   if (!isset($this->result)) { return false; }	
   $data = ($data !== false) ? $data : $this->result;	
   if (!$name) { return $data; }
   if ($subname) { $name .= '.'.$subname; }	
   $s   = $name;
   $s1  = $this->StrFetch($s, '.');
   $val = false;
   while ($s || $s1) {
   	if (($val === false && !isset($data[$s1])) || ($val !== false && !isset($val[$s1]))) { return false; }
    $val = ($val === false) ? $data[$s1] : $val[$s1];    
	$s1  = $this->StrFetch($s, '.');	
   }
   return $val; 
  }//GetResult    
  	
 }//w_informer_gen_obj
 //-------------------------------------------------------
 /** объект информеров */
 class w_informer_obj extends w_informer_gen_obj {
  /* элементы значений предварительного просмотра информеров */
  const INETSPEED_DW_KBIT = 5420;
  const INETSPEED_UP_KBIT = 6350;
  const INETSPEED_DW_KBYT = 350.6;
  const INETSPEED_UP_KBYT = 640.3;
  const PRCY_CY = 100;
  const PRCY_PR = 3;
  /** каталог временных изображений информеров */
  private $images_path = W_DEFAULTINFORMERSPATH;
  /** обновлять данные каждые минут */
  private $update_values_every_min = 4320; //4320 = 3 дня
  /** обновлять информер, если такой уже существует */
  private $update_if_exists = true;	
  protected 
   $result,
   $informType;
   
  function __construct(w_Control_obj $control, $informerType, $update_values_every_min=null, $update_if_exists=true) {
   parent::__construct($control);
   $this->informType = $informerType;
   $this->result = false;
   $this->images_path .= '/temp';
   if (!@file_exists($this->images_path)) { @mkdir($this->images_path, 0777); }
   if ($update_values_every_min !== null) { $this->update_values_every_min = $update_values_every_min; }
   $this->update_if_exists = $update_if_exists;    	
  }//__construct
  
  /** вывод изображения о несуществующем параметре */
  static function ShowNoExistsImage() {
   @header("Content-type: image/png");
   @readfile(W_SITEDIR.'/img/items/noimage.png');
   return true;	
  }//ShowNoExistsImage
  
  /** получение данных указанного информера */
  function GetInformerSourceInfo($informerid, $onlyActive=true) {
   if (!$informerid = $this->CorrectSymplyString($informerid)) { return false; }
   return $this->control->db->GetLineArray($this->control->db->mPost(
    "select * from {$this->control->tables_list['definform']} where iditem='$informerid'".
	(($onlyActive) ? " and imageuse='1'" : "")." limit 1"
   ));   	
  }//GetInformerSourceInfo
  
  /** получение данных о текущей записи активного информера
  *   Добавляет поле `minlast` - int - количество минут, которое прошло с
  *   момента последнего запроса информера
  *   Добавляется поле `updatelast` - int - количество минут с последнего обновления данных    
  */
  function GetActiveInformerInfo($activeID) {
   if (!$activeID = $this->CorrectSymplyString($activeID)) { return false; }   
   return $this->control->db->GetLineArray($this->control->db->mPost(
    "select *, TIME_TO_SEC(TIMEDIFF(NOW(), `datelast`)) / 60 AS `minlast`, ".
	"TIME_TO_SEC(TIMEDIFF(NOW(), `dataupdate`)) / 60 AS `updatelast` from ".
    $this->control->tables_list['infactive']." where informtype='{$this->informType}'".
	" and iditem='$activeID' limit 1"
   ));   	
  }//GetActiveInformerInfo 
  
  /** получение списка информеров для предварительного просмотра 
  * @return false or array(
  *  []array(
  *   'section'   => array() - полная информация о секции
  *   'informers' => array(
  *    [номер_столбца] = array(
  *      [] - array() - полная информация о информере ( + добавляется параметр 
  *           usecolorselecter - bool - true если можно менять цвет, false - если нет )
  * 
  *     )
  *    'trcount' => int - колочество строк
  *    'tdcount' => int - кол-во столбцов
  *    'usecolorchangeids' => array() - список идентификаторов, которые могут сменять цвет    
  *   )  
  *  )    
  * )  
  */
  function GetInformersList($onliActive=true) {	
   //list sections
   if (!$sections = $this->control->db->GetTable(
    $this->control->tables_list['informsec'], "informtype='{$this->informType}' order by datecreat" 
   )) { return false; }
   $result = array();
   //req gr lib
   require_once W_LIBPATH.'/graph.lib.php';
   //ok fetch
   while ($section = $this->control->db->GetLineArray($sections)) {
	//get all informers
	$informers = $this->control->db->GetTable($this->control->tables_list['definform'],
	"sectionid='{$section['iditem']}' and informtype='{$this->informType}'".(($onliActive) ? " and imageuse='1'" : "")
	);
	if (!$informers) { continue; }
	$items = array();	
	//fetch informers
	if ($section['colcount']) {			
	 $incer = 0; $tr_count = 1;	$usecolorchangeids = array();	
	 while ($informer = $this->control->db->GetLineArray($informers)) {	
	  if ($incer > $section['colcount'] - 1) { $incer = 0; $tr_count++; } 
	  if (!isset($items[$incer])) { $items[$incer] = array(); }	
	  //возможность смены цвета
	  $informer['usecolorselecter'] = w_informer_graph_obj::GetColorParameters('xREPcolor', $informer['options']);	  
	  if ($informer['usecolorselecter']) { $usecolorchangeids[] = $informer['iditem']; }
	  //add inf source
	  $items[$incer][] = $informer;
	  $incer++;		 	
	 }	 	 
	 if ($items) { 
	  $result[] = array(
	   'section'           => $section,          //секция 
	   'informers'         => $items,            //список информеров по столбцам
	   'trcount'           => $tr_count,         //всего сток (от 1)
	   'tdcount'           => @count($items),    //всего столбцов (от 1)
	   'usecolorchangeids' => $usecolorchangeids //список selecters
	  ); 
	 }
	}	 	
   }
   return $result;   	
  }//GetInformersList
  
  /** получение изображения информера для предварительного просмотра */
  function GetInformerImage($imageid, $imageoptions=false, $onlyactive=true, $REPLcolor=false, $rightstrparam=false) {
   $image_info = $this->GetInformerSourceInfo($imageid, $onlyactive);   
   $filename = (!$image_info) ? false : W_DEFAULTINFORMERSPATH.'/'.$image_info['dwname'];
   //нет изображения
   if (!$image_info || !@file_exists($filename)) { return self::ShowNoExistsImage(); }
   //options
   if ($imageoptions === false) { $imageoptions = $image_info['options']; }
   //identifies
   $idents = false;
   switch ($image_info['informtype']) {
   	//Информеры скорости интернета
	case '1':
	 if ($rightstrparam) { $data_params = $this->GetSpeedListFromStr($rightstrparam); }
	 $idents = (!$rightstrparam) ? array(
	  '1' => ss_HTMLPageInfo::GetSizeStrX(self::INETSPEED_DW_KBIT * 1024, 'it/s'),   //x1 - download kbit 
	  '2' => ss_HTMLPageInfo::GetSizeStrX(self::INETSPEED_UP_KBIT * 1024, 'it/s'),   //x2 - upload kbit
	  '3' => ss_HTMLPageInfo::GetSizeStrX(self::INETSPEED_DW_KBYT * 1024, 'yte/s'),  //x3 - download kbyte
	  '4' => ss_HTMLPageInfo::GetSizeStrX(self::INETSPEED_UP_KBYT * 1024, 'yte/s')   //x4 - upload kbyte 
	 ) : array(
	  '1' => ss_HTMLPageInfo::GetSizeStrX($data_params['dwkbit'] * 1024, 'it/s'),
	  '2' => ss_HTMLPageInfo::GetSizeStrX($data_params['upkbit'] * 1024, 'it/s'),
	  '3' => ss_HTMLPageInfo::GetSizeStrX($data_params['dwkbyte'] * 1024, 'yte/s'),
	  '4' => ss_HTMLPageInfo::GetSizeStrX($data_params['upkbyte'] * 1024, 'yte/s')	 
	 );
	 break;
	//Информеры IP адреса
	case '2':
	 $idents = array(
	  '1' => $this->GetCurrentIP() //x1 - ip
	 );
	 break;
	//Информеры ТиЦ PR
	case '3':
	 $idents = array(
	  '1' => self::PRCY_CY, //x1 - cy
	  '2' => self::PRCY_PR  //x2 - pr
	 );
	 break; 
    //updates informer
    case '4': $idents = $this->control->GetEngineUpdatesInfoDateOnly(); break; 
    /* */ 
	default: return false;	
   }  
   $idents['URL'] = W_HOSTMYSITE;
   if ($REPLcolor) { $idents['REPLcolor'] = $REPLcolor; }
   //require graph lib
   require_once W_LIBPATH.'/graph.lib.php'; 
   //ok action
   $image = w_informer_graph_obj::CreateObj($this->control, $idents, $image_info, $imageoptions, $filename);
   if (!$image->ProcessPaint()) { return self::ShowNoExistsImage(); };
   $image->OutImage();
   $image->DestroyImage();
   return true;	
  }//GetInformerImage
  
  /** отрисовка данных на изображении
  * @imageid int идентификатор информера
  * @data - строка с параметрами отрисовки
  *   
  * @return false or array(
  *  'image'         => изображение w_informer_graph_obj
  *  'informerinfo'  => данные информера
  * )
  */
  protected function DoUpdateImage($imageid, $data, $onlyactive=true) {
   if (!$data) { return false; }   
   //данные информера
   $image_info = $this->GetInformerSourceInfo($imageid, $onlyactive);   
   $filename = (!$image_info) ? false : W_DEFAULTINFORMERSPATH.'/'.$image_info['dwname'];
   //нет изображения
   if (!$image_info || !@file_exists($filename)) { return false; }
   //options
   $idents_list = false;
   switch ($this->informType) {
    //скорость интернета
    case '1': $idents_list = array('dwkbit', 'upkbit', 'dwkbyte', 'upkbyte');  break;
    //ip informer
    case '2': $idents_list = array('ip');  break;
    //pr cy
    case '3': $idents_list = array('cy', 'pr');  break;
    //updates
    case '4': $idents_list = array('cy', 'yasearch', 'yaca', 'pr');  break;
    //unknow type
    default: return false;   	
   }
   if (!$idents_list) { return false; }
   $values = array();
   $incer = 1;
   foreach ($idents_list as $name) {
	$values["$incer"] = $this->control->ReadOption($name, $data);
	if ($values["$incer"] === false) { $values["$incer"] = '?'; } else 
	//correct speed values
	{
	 if ($this->informType == '1' && @is_numeric($values["$incer"])) {
	  $suff = 'it/s';	
	  switch ($name) { case 'dwkbyte':  case 'upkbyte': $suff = 'yte/s'; break; }
	  $values["$incer"] = ss_HTMLPageInfo::GetSizeStrX($values["$incer"] * 1024, $suff);	  	
	 }	 	
	}
	$incer++;	
   }
   $values['URL'] = W_HOSTMYSITE;
   //replace color
   $repl = $this->control->ReadOption('REPLcolor', $data);   
   if ($repl) { $values['REPLcolor'] = $repl; }
   //require graph lib
   require_once W_LIBPATH.'/graph.lib.php'; 
   //ok action
   $image = w_informer_graph_obj::CreateObj($this->control, $values, $image_info, $image_info['options'], $filename);
   if (!$image->ProcessPaint()) { return false; };
   $data = array(
	'informerinfo'  => $image_info,
	'image'         => $image
   ); 
   return $data;   	
  }//DoUpdateImage  
  
  /** получение данных скорости интернета из строки параметра */
  protected function GetSpeedListFromStr($stringIdent, $repl='-') {  	
   $str = $stringIdent;
   $stringIdent = $this->StrFetch($str, '.');
   if ($repl) { $stringIdent = @str_replace($repl, '.', $stringIdent); }      
   $str = $stringIdent;
   //download kbit speed
   $dw = $this->StrFetch($str, '_');
   if ($dw == '' || !@is_numeric($dw)) { $dw = '0'; }
   //upload speed
   $up = $str; //$this->StrFetch($str, '_');
   if ($up == '' || !@is_numeric($up)) { $up = '0'; }
   //download kbyte
   $dwKBYTE = (!$dw) ? '0' : @round($dw / 8, 2);
   //upload kbyte
   $upKBYTE = (!$up) ? '0' : @round($up / 8, 2);
   return array(
    'dwkbit' => $dw, 'dwkbyte' => $dwKBYTE, 'upkbit' => $up, 'upkbyte' => $upKBYTE
   );	
  }//GetSpeedListFromStr
  
  /** получение данных информера
  * @return string or false
  * возвращает строку в виде параметров данных  
  */
  protected function GetInformerValues($stringIdent, $REPLcolor=false) {
   $result = false;	   
   switch ($this->informType) {
   	//скорость интернета
	case '1':
	 $result = '';
	 //формат скорость в kбитах download_скорость uplod.png 5485_6532.png
	 $str = $stringIdent;
	 $stringIdent = $this->StrFetch($str, '.');
	 $stringIdent = @str_replace('-', '.', $stringIdent);
	 $str = $stringIdent;
	 //download kbit speed
	 $dw = $this->StrFetch($str, '_');
	 if ($dw == '' || !@is_numeric($dw)) { $dw = '?'; }
	 $result = $this->control->WriteOption('dwkbit', $dw, $result);
	 //upload speed
	 $up = $str; //$this->StrFetch($str, '_');
	 if ($up == '' || !@is_numeric($up)) { $up = '?'; }
	 $result = $this->control->WriteOption('upkbit', $up, $result);
	 //download kbyte
	 $dwKBYTE = (!$dw || $dw == '?') ? '?' : @round($dw / 8, 2);
	 $result = $this->control->WriteOption('dwkbyte', $dwKBYTE, $result);
	 //upload kbyte
	 $upKBYTE = (!$up || $up == '?') ? '?' : @round($up / 8, 2);
	 $result = $this->control->WriteOption('upkbyte', $upKBYTE, $result); 
	break;
	//ip адрес
	case '2': 
	 $result = '';
	 $stringIdent = (@preg_match('/(\d+).(\d+).(\d+).(\d+)/', $stringIdent)) ? $stringIdent : '?.?.?.?';	 
	 $result = $this->control->WriteOption('ip', $stringIdent, $result); 
	break;
	//пр тиц
	case '3':
	 $result = '';
	 $http = new ss_HTTP_obj();
	 $pr = '?';
	 $cy = '?';
	 //получить новые значения
	 if ($http->SetURL($stringIdent)) {
	  $pr = ($http->RunPluginEx(SS_GOOGLEPR, $error, $value)) ? $value['value'] : '?';
	  $cy = ($http->RunPluginEx(SS_YANDEXCY, $error, $value)) ? $value['value'] : '?';	  	
	 }
	 unset($http);
	 $result = $this->control->WriteOption('cy', $cy, $result);
	 $result = $this->control->WriteOption('pr', $pr, $result);	 
	break;
    //updates
    case '4':
     $result = '';
     $data = $this->control->GetEngineUpdatesInfoDateOnly();    
     $list = array(
      'cy'       => $data['1'], 
      'yasearch' => $data['2'],
      'yaca'     => $data['3'],
      'pr'       => $data['4']
     );
     foreach ($list as $name => $value) {
      $data = $this->control->WriteOption($name, $value, $result);
      if ($data !== false) { $result = $data; }        
     }
    break;	
   }
   if ($REPLcolor) { $result = $this->control->WriteOption('REPLcolor', $REPLcolor, $result); }
   return $result;   	
  }//GetInformerValues
  
  /** получение идентификатора активного информера по идентификатору
  * Добавляет поле `minlast` - int - количество минут, которое прошло с
  * момента последнего запроса информера
  * Добавляет поле `updatelast` - int - кол-во минут с последнего обновления данных    
  */
  protected function GetActiveInformerRecord($identname) {
   return $this->control->db->GetLineArray($this->control->db->mPost(
    "select *, TIME_TO_SEC(TIMEDIFF(NOW(), `datelast`)) / 60 AS `minlast`, ".
	"TIME_TO_SEC(TIMEDIFF(NOW(), `dataupdate`)) / 60 AS `updatelast` from ".
    $this->control->tables_list['infactive']." where informtype='{$this->informType}'".
	" and Lower(identuse)=Lower('$identname') limit 1"
   ));	
  }//GetActiveInformerRecord
  
  /** создание нового информера
  * @identname - string (идентификатор информера, форматы:
  *  - для информера ip: содержать должен ip адрес
  *  - для скорости интернета: строку формата: xx_xx.png ,где: xx - скорость загружки в Kbit\s
  *    xx (второй) - скорость Upload вKbit\s
  *  - для информера пр, тиц - хост проверяемого сайта 
  * )
  * @informerID - int - идентификатор информера
  * @emailinform - string - e-mail, на который уведомлять о скором удалении информера запростой  
  *   
  * @return false or array() - информация о активном информере  
  */
  function CreateNewInformerRecord($identname, $informerID, $emailinform='', $REPLcolor=false) {
   if (!$identname = $this->CorrectSymplyString($identname)) { return false; }	
   //повтор, обновить
   if ($this->update_if_exists && $record = $this->GetActiveInformerRecord($identname)) { 
   	return $this->UpdateInformerRecord($record, $informerID, $REPLcolor); 
   }    
   //создать новый
   if (!$values = $this->GetInformerValues($identname, $REPLcolor)) { return false; }   
   if (!$image = $this->DoUpdateImage($informerID, $values)) { return false; }
   //create new params
   $result_info = array(
    'datestart'  => $this->GetThisDateTime(),            
	'datelast'   => $this->GetThisDateTime(),
	'dataupdate' => $this->GetThisDateTime(),           
	'regcount'   => 1,        
	'identuse'   => $identname,           
	'sdata'      => $this->CorrectSymplyString($values),                   
	'infimage'   => $informerID,                    
	'informtype' => $this->informType,                    
	'informlink' => $this->CorrectSymplyString(@getenv("HTTP_REFERER")),                   
	'infoemail'  => $emailinform, 
    'imagefile'  => $this->GenerateNewImageTempFilename($image['informerinfo']['imagetype'])             
   );
   //create image file
   if (!$image['image']->OutImage(false, $this->images_path.'/'.$result_info['imagefile'])) { return false; }
   //create record
   if (!$this->control->db->INSERTAction('infactive', $result_info)) { 
    //remove new file
    if (@file_exists($this->images_path.'/'.$result_info['imagefile'])) { 
	 @unlink($this->images_path.'/'.$result_info['imagefile']); 
	}
	return false;		
   }
   //ok get id
   $result_info['iditem'] = $this->control->db->InseredIndex();
   //ok
   return $result_info;   	
  }//CreateNewInformerRecord
  
  /** генерация нового имени */
  protected function GenerateNewImageTempFilename($type, $isfirst=true) {
   $res = md5("_".$this->GetThisDateTime()."_temd_".
   $this->generate_password(5)).(($this->substr($type, 0, 1) == '.') ? "$type" : ".$type");
   if (!$isfirst) { return $res; }
   while (@file_exists($this->images_path.'/'.$res)) { $res = $this->GenerateNewImageTempFilename($type, false); }
   return $res;   	
  }//GenerateNewImageTempFilename
  
  /** обновление информера */
  function UpdateInformerRecord($recordInfo, $informerID=false, $REPLcolor=false) {
   if (!$values = $this->GetInformerValues($recordInfo['identuse'], $REPLcolor)) { return $recordInfo; }
   //изображение
   if (!$image = $this->DoUpdateImage((($informerID) ? $informerID : $recordInfo['infimage']), $values)) { 
   	return $recordInfo; 
   }
   //параметры
   $temp_recordInfo = $recordInfo;
   $recordInfo['datelast']   = $this->GetThisDateTime();
   $recordInfo['dataupdate'] = $this->GetThisDateTime();
   $recordInfo['regcount']++;
   $recordInfo['sdata'] = $this->CorrectSymplyString($values);
   $recordInfo['informlink'] = $this->CorrectSymplyString(@getenv("HTTP_REFERER"));
   if ($informerID) { $recordInfo['infimage'] = $informerID; }   
   $last_file_name = $recordInfo['imagefile'];
   //новое имя файла
   $recordInfo['imagefile'] = $this->GenerateNewImageTempFilename($image['informerinfo']['imagetype']); 
   //create a new image file
   if (!$image['image']->OutImage(false, $this->images_path.'/'.$recordInfo['imagefile'])) {
	return $temp_recordInfo;
   }
   //update record info
   if (!$this->control->db->UPDATEAction('infactive', array(
    'datelast'   => $recordInfo['datelast'],
    'dataupdate' => $recordInfo['dataupdate'],
    'regcount'   => $recordInfo['regcount'],
    'sdata'      => $recordInfo['sdata'],
    'informlink' => $recordInfo['informlink'],
    'imagefile'  => $recordInfo['imagefile'],
	'infimage'   => $recordInfo['infimage']    
   ), "iditem='{$recordInfo['iditem']}'", "1")) { 
   	//delete temp no active file
   	if (@file_exists($this->images_path.'/'.$recordInfo['imagefile'])) { 
	 @unlink($this->images_path.'/'.$recordInfo['imagefile']); 
	}	  
	//restore last info 
	return $temp_recordInfo;    
   }
   //удалить старый файл
   if (@file_exists($this->images_path.'/'.$last_file_name)) { @unlink($this->images_path.'/'.$last_file_name); }
   //free temp image   
   $image['image']->DestroyImage();
   return $recordInfo;   	
  }//UpdateInformerRecord
  
  /** получение информера */
  function GetRealInformerImage($id) {
   if (!$record = $this->GetActiveInformerInfo($id)) { return self::ShowNoExistsImage(); }
   //проверка обновления
   if ($this->update_values_every_min && $record['updatelast'] >= $this->update_values_every_min) {
	$record = $this->UpdateInformerRecord($record, false, $this->control->ReadOption('REPLcolor', $record['sdata']));
   }
   //get an image
   if (!@file_exists($this->images_path.'/'.$record['imagefile'])) { return self::ShowNoExistsImage(); }
   $type = $record['imagefile'];
   $s = $this->StrFetch($type, '.');
   if (!$type) { $type = '*'; }
   @header("Content-type: image/$type");
   @readfile($this->images_path.'/'.$record['imagefile']);
   //обновить статистику
   $this->control->db->UPDATEAction('infactive', 
    array(
    'datelast'   => $this->GetThisDateTime(),
    'regcount'   => $record['regcount'] + 1,
    'informlink' => $this->CorrectSymplyString(@getenv("HTTP_REFERER"))    
    ), "iditem='{$record['iditem']}'", "1"
   );   
   return true;   	
  }//GetRealInformerImage
  
  /** удаление устаревших записей информеров
  * @control - объект w_Control_obj
  * @informerType - int тип информера
  * @lastminute - int количество минут, если запрос информера позже чем $lastminute назад - 
  *               удалить запись информера, если 0 - не удалять
  * @checkeverymin - int пытаться удалить устаревшие записи каждые $checkeverymin минут, 
  *               если 0 - ничего не будет    
  */
  static function DeleteOldRecords($control, $informerType, $lastminute, $checkeverymin) {
   if (!$lastminute || !$control->CheckForCanActionOperation($informerType, $checkeverymin)) { return false; }
   $records = $control->db->mPost(
    "select iditem, imagefile from {$control->tables_list['infactive']} where informtype='$informerType' and ".
    "TIME_TO_SEC(TIMEDIFF(NOW(), `datelast`)) / 60 >= $lastminute"
   );
   if (!$records) { return false; }   
   while ($row = $control->db->GetLineArray($records)) {   	
	$filename = W_DEFAULTINFORMERSPATH.'/temp/'.$row['imagefile'];
	if ($row['imagefile'] && @file_exists($filename)) { @unlink($filename); }
	$control->db->Delete($control->tables_list['infactive'], "iditem='{$row['iditem']}'", '1');
   }   
   return true;   	
  }//DeleteOldRecords
	
 }//w_informer_obj
 //-------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */	  
?>