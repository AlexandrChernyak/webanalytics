<?php
 /** Модуль обработки секции администратора
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */  
 //-------------------------------------------------------
 if (!@defined('ISENGINEDSW')) exit('Can`t access to this file data!');
 //-------------------------------------------------------
 /** шаблон элементов */
 abstract class w_admin_gen_obj extends w_defext {	
  private $tabledata = null;	
  var $section_id = '';
  var $control = null;
  var $global_user_info = false;
  var $global_string_identifier = false;
  var $globalnogettext = false;
  var $error = false;
  var $file_section = '';
  var $secondpath_first = '';	
  
  function __construct(w_Control_obj $control, $section_id) {
   global $global_user_info;	
   parent::__construct();
   $this->section_id = $section_id;
   $this->control = $control;
   $this->global_user_info = $global_user_info;
   $this->file_section = 'adm_account/adm_'.$this->section_id.'.tpl';   
  }//__construct	
  
  /** выполнение */
  function ActionThisSection() {
   $this->SetSection_file($this->file_section);
   if ($this->global_string_identifier) {
	$this->AddSectionWay($this->global_string_identifier);
    $this->SetSection_stitle($this->global_string_identifier);
    $this->SetSection_title($this->global_string_identifier);
   }
   if ($this->globalnogettext) { $this->globalnogettext = false; }
   $this->control->smarty->assign('adm_object', $this);
   if (!$this->control->isadminstatus) { return false; }
   $this->_DoActionThisSection();   	
  }//ActionThisTool
  
  abstract function _DoActionThisSection();
  
  /** получение информации о секции */
  function GetSectionInfo($name) {
   global $section_info;	
   return (isset($section_info[$name])) ? $section_info[$name] : '';   	
  }//GetSectionInfo
  
  /** установка информации о секции
  * @name - string идентификатор информации о секции
  * @value - string значение
  */
  function SetSectionInfo($name, $value) {
   global $section_info;
   $section_info[$name] = $value;   	
  }//SetSectionInfo
  
  private function GetIdentByItOffSelf($stringident) {
   return ($this->globalnogettext) ? $stringident : $this->control->GetText($stringident);	
  }//GetIdentByItOffSelf
  
  /** методы быстрой установки информации о секции */
  function SetSection_stitle($stringident) { 	 
   $this->SetSectionInfo('stitle', $this->GetIdentByItOffSelf($stringident)); 
  }//SetSection_stitle
  
  function SetSection_file($filename) { $this->SetSectionInfo('file', $filename); }
  
  function SetSection_title($stringident) {	 
   $this->SetSectionInfo('title', $this->GetIdentByItOffSelf($stringident).' - '.$this->GetSectionInfo('title')); 
  }//SetSection_title  
  
  /** получение пути всего */
  function GetAllSectionWay() {
   global $section_way;
   return $section_way;	
  }//GetAllSectionWay
  
  /** добавление пути секции
  * @stringident - идентификатор строкового ресурса текущего языка
  * @path - пусть от /секция/
  */
  function AddSectionWay($stringident, $path='') {
   global $section_way;    
   return $section_way[] = array(
    'name' => $this->GetIdentByItOffSelf($stringident),
    'path' => W_SITEPATH.'account/'.$this->section_id.'/'.$this->secondpath_first.$path
   );   	
  }//AddSectionWay
  
  /** добавление информации о секции */
  function AddSectionInfoNew($name, $value) {
   global $section_info;
   if (isset($section_info[$name])) {
	return $section_info[$name][] = $value;
   }	
   $section_info[$name] = array($value);
   return $value;   	
  }//AddSectionInfoNew 
  
  /** экранирование метода вывода текста по ресурсам */
  function GetText($name, $list=false, $def=false) { return $this->control->GetText($name, $list, $def); }
    
  /** установка ошибки, возврат false */
  function SetError($str) { $this->error = $str; return false; }
  
  function CorrectURLLink($url, $count=0) {	
   if ($count <= 0 || $this->strlen($url) < $count) { return $url; }
   return $this->substr($url, 0, ($count > 3) ? ($count - 3) : $count).(($count > 3) ? '...' : '');	
  }//CorrectURLLink
  
  function CorrectLinkToProtocol($link) {
   $P = @parse_url($link);
   return ((isset($P['scheme'])) ? '' : 'http://').$link;	
  }//CorrectLinkToProtocol
  
  /** запрос по ajax */
  function IsAjax() { return @defined('W_IS_AJAX_MODE_RUN'); }
  
  /** количество элементов на 1 страницу */
  function GetPerPageCount($tablename) { return 15; }
  
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
  
  /** получение данных из базы по указанной таблице ($_GET[$pageident] - активная страница) */
  function GetTableData($tablename, $select, $records_count, $pageident='page', $listinfo='', $path1='') {
   if (!$pageident && $this->tabledata) { return $this->GetResult($listinfo, '', $this->tabledata); }	 
   if ($this->tabledata !== null) { return $this->tabledata; }	
   $perpage = $this->GetPerPageCount($tablename);	
   if (!$perpage || $perpage < 0) { return false; }       
   if (!$records_count) { return $this->tabledata = false; }
   return $this->tabledata = $this->control->db->GetDataByPages(
    $select, $_GET[$pageident], $perpage, $records_count, 
	W_SITEPATH.'account/'.$this->section_id.'/&'.$pageident.'=', $path1, '', ''
   );    	
  }//GetHistoryData
  
  /** выполнить действие для списка элементов */
  function TransformPostItems($iter, $perpage_count=15) {
   if (!$perpage_count) { return false; } 
   for ($i=0; $i<=$perpage_count; $i++) {
	if ($this->CheckPostValue('chid'.$i) && isset($_POST['idm'.$i]) && $_POST['idm'.$i]) {
	 @call_user_func($iter, $this->CorrectSymplyString($_POST['idm'.$i]));	 	
	}	
   }
   return true;      	
  }//TransformPostItems     
  	
 }//w_admin_gen_obj
 //-------------------------------------------------------
 /** раздел шрифтов */
 class w_admin_admfontssection extends w_admin_gen_obj {
  const FILE_IDENT = 'font';	
  //максимальный размер файла шрифта (0 - без ограничений)	
  const MAX_FILE_SIZE_KB = 2048;
  //количество элементов на сраницу
  const PERPAGE_COUNT = 15;
  //допустимые типы шрифтов
  private static $files_type = array('.ttf');	
  protected 
   $result;
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'admfontssectionn';	
  }//__construct
  
  /** список допустимых типов изображений */
  function GetListTypes() {
   return $this->control->GenerateArrayString(self::$files_type,', ', '"<b>', '"</b>');	
  }//GetListTypes
  
  /** добавление шрифта */
  protected function AddNewFontFile() {
   //загрузка файла	
   $FILE_INFO = $this->control->UpLoadFile(
    self::FILE_IDENT, self::$files_type, self::MAX_FILE_SIZE_KB, W_FONTSFILESPATH.'/', 0, 0, false, -1, '' 
   );   
   //проверка данных
   if ($FILE_INFO['result']) { return $this->SetError($FILE_INFO['result']); }
   //ok action
   $FILE_INFO['originalname'] = $this->substr($this->CorrectSymplyString($FILE_INFO['originalname']), 0, 99);
   $query = 
   "INSERT INTO {$this->control->tables_list['fontslist']} SET ".
   "datecreat='".$this->GetThisDateTime()."', fontname='{$FILE_INFO['originalname']}', ".
   "fontsize='{$FILE_INFO['filesizebyte']}', dwname='{$FILE_INFO['newname']}'";
   //write
   if (!$this->control->db->mPost($query)) {
   	if (@file_exists(W_FONTSFILESPATH.'/'.$FILE_INFO['newname'])) { @unlink(W_FONTSFILESPATH.'/'.$FILE_INFO['newname']); } 
   	return $this->SetError('Error in add new file data'); 
   }
   //restore count
   $this->result['count'] = $this->control->GetCountInTable('iditem', 'fontslist');
   //ok out
   return true;	
  }//AddNewFontFile
  
  /** количество элементов на 1 страницу */
  function GetPerPageCount($tablename) { return self::PERPAGE_COUNT; }
  
  /** размер файла строкой */
  function GetSizeItem($bytes) { return ss_HTMLPageInfo::GetSizeStrX($bytes); }
  
  /** скачать файл */
  protected function DoDownLoadFile() {
   $res = $this->control->GetFont($_GET['downloadfile']);
   if (!$res || !$res['iditem']) { return false; }
   //ok get   
   $this->control->WriteDownLoadFileHeader($res['fontname'], $res['fontsize']);
   @readfile($res['filename']);
   return true;   	
  }//DoDownLoadFile
  
  /** удалить все файлы */
  protected function ActionDeleteAll() {
   $result = $this->control->db->GetTable($this->control->tables_list['fontslist']);
   while ($row = $this->control->db->GetLineArray($result)) {
    //delete file    
    if (@file_exists(W_FONTSFILESPATH.'/'.$row['dwname'])) { @unlink(W_FONTSFILESPATH.'/'.$row['dwname']); }
    //delete record
    $this->control->db->Delete($this->control->tables_list['fontslist'], "iditem='{$row['iditem']}'", '1');	
   }
   return true;   	
  }//ActionDeleteAll
  
  /** удалить указанные элементы */
  protected function DeleteFormItem($id) {
   $item = $this->control->GetFont($id);
   if (!$item || !$item['iditem']) { return false; }
   //delete file
   if (@file_exists($item['filename'])) { @unlink($item['filename']); }
   //delete record
   $this->control->db->Delete($this->control->tables_list['fontslist'], "iditem='{$item['iditem']}'", '1');	
   return true;   
  }//DeleteFormItem
  
  /** включить шрифт */
  protected function ActionToEnabledItem($id) {
   return $this->control->db->mPost(
    "update {$this->control->tables_list['fontslist']} SET fontuse='1' where fontuse<>'1' and iditem='$id' limit 1"   
   );	
  }//ActionToEnabledItem
  
  /** отключить шрифт */
  protected function ActionToDisabledItem($id) {
   return $this->control->db->mPost(
    "update {$this->control->tables_list['fontslist']} SET fontuse='0' where fontuse<>'0' and iditem='$id' limit 1"   
   );	
  }//ActionToEnabledItem
  
  function _DoActionThisSection() {
   //скачать файл
   if ($_GET['downloadfile'] && $this->DoDownLoadFile()) { exit; }   	
   //всего шрифтов
   $this->result = array(
    'count'   => $this->control->GetCountInTable('iditem', 'fontslist'),
    'maxsize' => ss_HTMLPageInfo::GetSizeStrX(self::MAX_FILE_SIZE_KB * 1024)
   );
   //добавление шрифта
   if ($_GET['new']) { return ($_POST['updatesactionnew'] == 'do') ? $this->AddNewFontFile() : true; }
   //action from list
   $is_modified = false;
   switch ($_POST['actionlistmakes']) {
   	//удалить все элементы
	case 'dall': 
	 $this->ActionDeleteAll(); $is_modified = true; break;
	//удалить выбранные элементы
	case 'delete': 
	 $this->TransformPostItems(array($this, 'DeleteFormItem'), $this->GetPerPageCount(''));
	 $is_modified = true;
	 break;	
	//включить
	case 'enabled': 
	 $this->TransformPostItems(array($this, 'ActionToEnabledItem'), $this->GetPerPageCount('')); break;
	//отключить
	case 'disabled': 
	 $this->TransformPostItems(array($this, 'ActionToDisabledItem'), $this->GetPerPageCount('')); break;  
   }  
   //restore count
   if ($is_modified) { $this->result['count'] = $this->control->GetCountInTable('iditem', 'fontslist'); } 
   //listen
   $this->result['data'] = $this->GetTableData('fontslist', 
    "select * from {$this->control->tables_list['fontslist']} order by datecreat DESC", $this->result['count']
   );   	
  }//_DoActionThisSection	
	
 }//w_admin_admfontssection
 //-------------------------------------------------------
 /** раздел информеров */
 class w_admin_adminformersfiles extends w_admin_gen_obj {
  const FILE_IDENT = 'image';	
  //максимальный размер файла изображения (0 - без ограничений)	
  const MAX_FILE_SIZE_KB = 2048;
  //количество элементов на сраницу
  const PERPAGE_COUNT = 10;
  //количество разделов на страницу
  const PERPAGE_SECTIONS_COUNT = 15;
  //кол-во записей на страницу в разделе статистики использования информера
  const PERPAGE_INFORMER_RECORDS = 15;
  //параметры для отрисовки предварительного просмотра
  const INETSPEED_DW_KBIT = 5420;
  const INETSPEED_UP_KBIT = 6350;
  const INETSPEED_DW_KBYT = 350.6;
  const INETSPEED_UP_KBYT = 640.3;
  const PRCY_CY = 100;
  const PRCY_PR = 3; 
  //допустимые типы изображений
  private static $files_type = array(".gif", ".jpg", ".png", ".jpeg"/*, ".bmp"*/);	
  protected 
   $result,
   $tempinfoids;
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'adminformersfilesp';
   $this->tempinfoids = array();	
  }//__construct
  
  /** список допустимых типов изображений */
  function GetListTypes() {
   return $this->control->GenerateArrayString(self::$files_type,', ', '"<b>', '"</b>');	
  }//GetListTypes
  
  /** получить тип информеров */
  protected function GetInformersType() {
   $_GET['inftype'] = $this->CorrectSymplyString($_GET['inftype']);	
   return (!$_GET['inftype'] || !@is_numeric($_GET['inftype'])) ? 1 : $_GET['inftype'];   	
  }//GetInformersType
  
  /** получить текущий раздел информеров */
  protected function GetSectionType($correctitem=false) {
   if ($correctitem !== false) {
    $correctitem = $this->CorrectSymplyString($correctitem);	
    return (!$correctitem || !@is_numeric($correctitem)) ? 0 : $correctitem;	
   }  	
   //correct post item
   $_GET['sections'] = $this->CorrectSymplyString($_GET['sections']);	
   return (!$_GET['sections'] || !@is_numeric($_GET['sections'])) ? 0 : $_GET['sections'];
  }//GetSectionType
  
  /** элемент сравнения секции */
  protected function GetWhereIfSection() {
   if (!$section = $this->CorrectSymplyString($this->GetSectionType())) { return ''; }
   return " and sectionid='$section'";   	
  }//GetWhereIfSection 
  
  /** обновление надстроек */
  protected function UpdateImageSubOptions($id) {
   if (!$id = $this->CorrectSymplyString($id)) { return false; }	
   $_POST['list'] = self::PrepereParamsStr($_POST['list']);	   
   return $this->control->db->mPost(
    "update {$this->control->tables_list['definform']} SET options='".$this->ReplaceOptionsString($_POST['list'])
	."', sectionid='".$this->GetSectionType($_POST['idsection'])."' where iditem='$id' limit 1"   
   );    	
  }//UpdateImageSubOptions
  
  /** корректировка текста надстроек */
  protected function ReplaceOptionsString($str) {
   $str = trim($this->CorrectSymplyString($this->ClearBreake($str, true, true, '', ',')));
   while ($this->strpos($str, ',,') !== false) { $str = @str_replace(',,', ',', $str); }
   return $str;    	
  }//ReplaceOptionsString
  
  /** добавление изображения */
  protected function AddNewImageInformerFile() {
   //загрузка файла	
   $FILE_INFO = $this->control->UpLoadFile(
    self::FILE_IDENT, self::$files_type, self::MAX_FILE_SIZE_KB, W_DEFAULTINFORMERSPATH.'/', 0, 0, false, -1, '' 
   );   
   //проверка данных
   if ($FILE_INFO['result']) { return $this->SetError($FILE_INFO['result']); }
   //координаты
   $_POST['list'] = self::PrepereParamsStr($_POST['list']); 
   //write
   if (!$this->control->db->INSERTAction('definform', array(
    'informtype' => $this->GetInformersType(),
    'datecreat'  => $this->GetThisDateTime(),
    'imagename'  => $this->substr($this->CorrectSymplyString($FILE_INFO['originalname']), 0, 99),
    'imagesize'  => $FILE_INFO['filesizebyte'],
    'dwname'     => $FILE_INFO['newname'],
    'imagetype'  => $FILE_INFO['type'],
	'options'    => $this->ReplaceOptionsString($_POST['list']),
	'imageuse'   => ($this->CheckPostValue('imageuse')) ? '1' : '0',
	'sectionid'  => $this->GetSectionType($_POST['idsection'])   
   ))) {
   	//error in insert record
	if (@file_exists(W_DEFAULTINFORMERSPATH.'/'.$FILE_INFO['newname'])) { 
	 @unlink(W_DEFAULTINFORMERSPATH.'/'.$FILE_INFO['newname']); 
	} 
   	return $this->SetError('Error in add new file data');
   }
   //restore count
   $this->result['count'] = $this->GetTableCount();
   //ok out
   return true;	
  }//AddNewFontFile
  
  /** количество элементов на 1 страницу */
  function GetPerPageCount($tablename) { 
   switch ($tablename) {
	case 'infactive': return self::PERPAGE_INFORMER_RECORDS;
	case 'informsec': return self::PERPAGE_SECTIONS_COUNT;
	default : return self::PERPAGE_COUNT;	
   }
  }//GetPerPageCount
  
  /** размер файла строкой */
  function GetSizeItem($bytes) { return ss_HTMLPageInfo::GetSizeStrX($bytes); }
  
  /** количество изображений в секции */
  function GetTableCount() {	
   return $this->control->GetCountInTable(
    'iditem', 'definform', "where informtype='".$this->GetInformersType()."'".$this->GetWhereIfSection()
   );	
  }//GetTableCount
  
  /** удалить все файлы */
  protected function ActionDeleteAll() {
   $result = $this->control->db->GetTable($this->control->tables_list['definform']);
   while ($row = $this->control->db->GetLineArray($result)) {
    //delete file    
    if (@file_exists(W_DEFAULTINFORMERSPATH.'/'.$row['dwname'])) { @unlink(W_DEFAULTINFORMERSPATH.'/'.$row['dwname']); }
    //delete record
    $this->control->db->Delete($this->control->tables_list['definform'], 
	"iditem='{$row['iditem']}' and informtype='".$this->GetInformersType()."'".$this->GetWhereIfSection(), '1');	
   }
   return true;   	
  }//ActionDeleteAll
  
  /** удалить указанные элементы */
  protected function DeleteFormItem($id) {
   $item = $this->control->db->GetLineArray($this->control->db->GetTable(
    $this->control->tables_list['definform'], "iditem='$id'", "1"
   ));
   if (!$item || !$item['iditem']) { return false; }
   //filename
   $item['filename'] = W_DEFAULTINFORMERSPATH.'/'.$item['dwname'];
   //delete file
   if (@file_exists($item['filename'])) { @unlink($item['filename']); }
   //delete record
   $this->control->db->Delete($this->control->tables_list['definform'], "iditem='{$item['iditem']}'", '1');	
   return true;   
  }//DeleteFormItem
  
  /** включить изображение */
  protected function ActionToEnabledItem($id) {
   return $this->control->db->mPost(
    "update {$this->control->tables_list['definform']} SET imageuse='1' where imageuse<>'1' and iditem='$id' limit 1"   
   );	
  }//ActionToEnabledItem
  
  /** отключить изображение */
  protected function ActionToDisabledItem($id) {
   return $this->control->db->mPost(
    "update {$this->control->tables_list['definform']} SET imageuse='0' where imageuse<>'0' and iditem='$id' limit 1"   
   );	
  }//ActionToEnabledItem
  
  /** вывод изображения о несуществующем параметре */
  protected function ShowNoExistsImage() {
   @Header("Content-type: image/png");
   @readfile(W_SITEDIR.'/img/items/noimage.png');
   return true;	
  }//ShowNoExistsImage
  
  /** получить данные о изображении */
  protected function GetImageInfo($id) {	
   if (!$id = $this->CorrectSymplyString($id)) { return false; }
   return $this->control->db->GetLineArray($this->control->db->mPost(
    "select * from {$this->control->tables_list['definform']} where iditem='$id' limit 1"
   )); 	
  }//GetImageInfo
  
  /** получение цвета на изображении */
  protected function GetColorOnImage($imgid, $x, $y) {
   if (!$imgid = $this->CorrectSymplyString($imgid)) { return false; }	
   $image_info = $this->GetImageInfo($imgid);
   $filename = (!$image_info) ? false : W_DEFAULTINFORMERSPATH.'/'.$image_info['dwname'];
   if (!$image_info || !@file_exists($filename)) { return false; }
   //register graph lib
   require_once W_LIBPATH.'/graph.lib.php';
   $image = w_image_obj::CreateFromFile($filename, $image_info['imagetype']);
   $color = $image->colorAt($x, $y);   
   $image->DestroyImage();
   return ($color) ? $color : false;   	
  }//GetColorOnImage
  
  /** отображение изображения предпросмотра */
  protected function _DoShowImageFile($imageid=false, $imageoptions=false, $replcolor=false) {   	
   $image_info = $this->GetImageInfo($imageid);   
   $filename = (!$image_info) ? false : W_DEFAULTINFORMERSPATH.'/'.$image_info['dwname'];
   //нет изображения
   if (!$image_info || !@file_exists($filename)) { return $this->ShowNoExistsImage(); }
   //options
   if ($imageoptions === false) { $imageoptions = $image_info['options']; }
   //identifies
   $idents = false;
   switch ($image_info['informtype']) {
   	//Информеры скорости интернета
	case '1':
	 $idents = array(
	  '1' => ss_HTMLPageInfo::GetSizeStrX(self::INETSPEED_DW_KBIT * 1024, 'it/s'),   //x1 - download kbit 
	  '2' => ss_HTMLPageInfo::GetSizeStrX(self::INETSPEED_UP_KBIT * 1024, 'it/s'),   //x2 - upload kbit
	  '3' => ss_HTMLPageInfo::GetSizeStrX(self::INETSPEED_DW_KBYT * 1024, 'yte/s'),  //x3 - download kbyte
	  '4' => ss_HTMLPageInfo::GetSizeStrX(self::INETSPEED_UP_KBYT * 1024, 'yte/s')   //x4 - upload kbyte 
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
    /*  */
      
	default: return false;	
   }  
   $idents['URL'] = W_HOSTMYSITE;
   if ($replcolor) { $idents['REPLcolor'] = @str_replace('_r_', '#', $replcolor); }
   //require graph lib
   require_once W_LIBPATH.'/graph.lib.php'; 
   //ok action
   $image = w_informer_graph_obj::CreateObj($this->control, $idents, $image_info, $imageoptions, $filename);
   if (!$image->ProcessPaint()) { return $this->ShowNoExistsImage(); };
   $image->OutImage();
   $image->DestroyImage();
   return true;  	
  }//_DoShowImageFile
  
  /** количество разделов */
  protected function GetSectionsCount() {
   return $this->control->GetCountInTable('iditem', 'informsec', "where informtype='".$this->GetInformersType()."'");	
  }//GetSectionsCount
  
  /** корректировка данных под секцию */
  protected function CorrectSectionDataToget() {
   //name
   $_POST['sname'] = $this->substr($this->CorrectSymplyString($_POST['sname']), 0, 99);
   if (!$_POST['sname']) { return $this->SetError($this->GetText('nonameforsection')); }
   //columns count   
   $_POST['scols'] = $this->CorrectSymplyString($_POST['scols']);   
   if (!$_POST['scols'] || !@is_numeric($_POST['scols']) || $_POST['scols'] <= 0 || $_POST['scols'] > 99) {
	$_POST['scols'] = 2;
   }
   return true;   	
  }//CorrectSectionDataToget  
  
  /** добавление \ изменение раздела */
  protected function AddModifySectionData($domodify=false, $modifySectionId=false) {
   //add new
   if (!$domodify) {
	if (!$this->CorrectSectionDataToget()) { return false; }
	//check for double aded
	$section = $this->control->db->GetLineArray($this->control->db->mPost(
	 "select iditem from {$this->control->tables_list['informsec']} where ".
	 "informtype='".$this->GetInformersType()."' and Lower(secname)=Lower('{$_POST['sname']}') limit 1"
	));
	if ($section) { return $this->SetError($this->GetText('sectisexistsnow', array($_POST['sname']))); }
	//ok add
	$this->control->db->INSERTAction('informsec', array(
	 'datecreat'  => $this->GetThisDateTime(),
	 'secname'    => $_POST['sname'],
	 'informtype' => $this->GetInformersType(),
	 'colcount'   => $_POST['scols']	 
	));
	//retype count
	$this->result['count'] = $this->GetSectionsCount();
	return true;	
   }
   //modify -----
   if (!$modifySectionId = $this->CorrectSymplyString($modifySectionId)) { 
   	return $this->SetError('Unknow section ID!'); 
   }
   //prepere data
   if (!$this->CorrectSectionDataToget()) { return false; }
   //ok check alridy
   $section = $this->control->db->GetLineArray($this->control->db->mPost(
	"select iditem from {$this->control->tables_list['informsec']} where ".
    "informtype='".$this->GetInformersType()."' and iditem<>'$modifySectionId' and ".
	"Lower(secname)=Lower('{$_POST['sname']}') limit 1"
   ));
   if ($section) { return $this->SetError($this->GetText('sectisexistsnow', array($_POST['sname']))); }
   //ok modify
   $this->control->db->mPost(
    "update {$this->control->tables_list['informsec']} SET secname='{$_POST['sname']}', ".
	"colcount='{$_POST['scols']}' where iditem='$modifySectionId' limit 1"
   );
   return true;  	
  }//AddModifySectionData
  
  /** получить данные секции */
  protected function GetSectionInfoData($sectionid) {
   if (!$sectionid = $this->CorrectSymplyString($sectionid)) { return false; }  	
   return $this->control->db->GetLineArray($this->control->db->mPost(
	"select * from {$this->control->tables_list['informsec']} where iditem='$sectionid' limit 1"
   ));   	
  }//GetSectionInfoData
  
  /** удаление указанной секции */
  protected function DeleteFormItemSect($sectionid) {  	
   if (!$sectionid = $this->CorrectSymplyString($sectionid)) { return false; }
   //delete informers
   $result = $this->control->db->mPost(
    "select iditem, dwname  from {$this->control->tables_list['definform']} where sectionid='$sectionid'"
   );
   //remove all informers from current section
   while ($item = $this->control->db->GetLineArray($result)) {
    //filename
    $item['filename'] = W_DEFAULTINFORMERSPATH.'/'.$item['dwname'];
    //delete file
    if (@file_exists($item['filename'])) { @unlink($item['filename']); }
    //delete record
    $this->control->db->Delete($this->control->tables_list['definform'], "iditem='{$item['iditem']}'", '1');	
   }
   //remove section
   $this->control->db->Delete($this->control->tables_list['informsec'], "iditem='$sectionid'", '1');
   return true;   	
  }//DeleteFormItemSect
  
  /** удаление всех секций */
  protected function ActionDeleteAllSect() {
   $result = $this->control->db->mPost(
    "select iditem from {$this->control->tables_list['informsec']} where informtype='".$this->GetInformersType()."'"
   );
   while ($row = $this->control->db->GetLineArray($result)) {
	//delete section
	$this->DeleteFormItemSect($row['iditem']);		
   }   	
   return true;
  }//ActionDeleteAllSect
  
  /** обработка разделов информеров */
  protected function _ActionSectionList() {
   //всего разделов
   $this->result = array(
    'count'   => $this->GetSectionsCount()
   );
   //modify section
   if ($_GET['modifysect']) {
   	if ($_POST['addinformsection'] == 'do' && !$this->AddModifySectionData(true, $_GET['modifysect'])) { return false; }
	//get info
	$this->result['data'] = $this->GetSectionInfoData($_GET['modifysect']);
	if ($this->result['data']) { return true; }	
   }   
   //добавление секции
   if ($_GET['new']) { return ($_POST['addinformsection'] == 'do') ? $this->AddModifySectionData() : true; }
   //action from list   
   $is_modified = false;
   switch ($_POST['actionlistinvitecode']) {
   	//удалить все разделы
	case 'dall': 
	 $this->ActionDeleteAllSect(); $is_modified = true; break;
	//удалить выбранные разделы
	case 'delete': 
	 $this->TransformPostItems(array($this, 'DeleteFormItemSect'), $this->GetPerPageCount('informsec'));
	 $is_modified = true;
	 break; 
   }  
   //restore count
   if ($is_modified) { $this->result['count'] = $this->GetSectionsCount(); } 
   //listen
   $this->result['data'] = $this->GetTableData('informsec', 
    "select * from {$this->control->tables_list['informsec']} where informtype='".$this->GetInformersType().
	"' order by datecreat DESC", $this->result['count'], 'page', '', 
	'&inftype='.$this->GetInformersType().'&sectionslist=1&sections='.$this->GetSectionType()
   );   
   return true;	
  }//_ActionSectionList
  
  /** получение количества информеров в разделе */
  function GetInformersCountInSection($sectionid) {
   if (!$sectionid = $this->CorrectSymplyString($sectionid)) { return false; }
   return $this->control->GetCountInTable('iditem', 'definform', "where sectionid='$sectionid'");
  }//GetInformersCountInSection
  
  /** получение списка секций текущего типа информеров */
  protected function GetSectionList() {	
   $data = array();	
   $result = $this->control->db->mPost(
    "select * from {$this->control->tables_list['informsec']} where informtype='".$this->GetInformersType()."'"
   );
   while ($row = $this->control->db->GetLineArray($result)) { $data[] = $row; }   	
   return $this->result['sections'] = $data;   	
  }//GetSectionList
  
  /** получение статистики информера, данные о запросах */
  function GetInformerInfo($informerInfo, $path, $subpath='') {
   if (!$informerInfo || !$informerInfo['iditem']) { return false; }
   if (isset($this->tempinfoids[$informerInfo['iditem']])) {   	
   	return (!$this->tempinfoids[$informerInfo['iditem']]) ? false : $this->GetResult(
	 $path, $subpath, $this->tempinfoids[$informerInfo['iditem']]
	); 
   }
   //общие данные
   $info = $this->control->db->GetLineArray($this->control->db->mPost(
    "select sum(regcount) as `allrequist`, count(iditem) as `allcount` from {$this->control->tables_list['infactive']} ".
    "where infimage='{$informerInfo['iditem']}'"
   ));
   $data = array(
    //всего запросов к данному счетчику
    'allrequist' => (!$info['allrequist']) ? 0 : $info['allrequist'],
    //всего людей используют счетчик
    'peoplesuse' => (!$info['allcount']) ? 0 : $info['allcount']
   );
   //информационные данные
   $info = (!$data['peoplesuse']) ? false : $this->control->db->GetLineArray($this->control->db->mPost(
    "select datelast from {$this->control->tables_list['infactive']} where infimage='{$informerInfo['iditem']}' ".
    "order by datelast DESC"
   ));
   //дата последнего запроса информера
   if ($info) { 
    $data['lastquery']    = ($info && $info['datelast']) ? $info['datelast'] : false;
	$data['lastquerystr'] = ($data['lastquery']) ? $this->control->GetLastIntervalInDays(
	 $data['lastquery'], $this->GetThisDateTime()
	) : false;
   }   
   //assign
   $this->tempinfoids[$informerInfo['iditem']] = $data;
   return (!$data) ? false : $this->GetResult($path, $subpath, $data);	
  }//GetInformerInfo
  
  /** количество записей информера */
  protected function GetRecordsInfCount() {
   return $this->control->GetCountInTable('iditem', 'infactive', "where infimage='{$_GET['statisticinfo']}'");	
  }//GetSectionsCount
  
  /** удаление записи информера */
  protected function DeleteFormItemInfRecord($recordid) {  	
   if (!$recordid = $this->CorrectSymplyString($recordid)) { return false; }
   //delete files
   $result = $this->control->db->mPost(
    "select imagefile from {$this->control->tables_list['infactive']} where iditem='$recordid' limit 1"
   );
   if (!$result) { return false; }
   //remove file
   $filename = W_DEFAULTINFORMERSPATH.'/temp/'.$result['imagefile'];
   if ($result['imagefile'] && @file_exists($filename)) { @unlink($filename); }
   //remove record
   $this->control->db->Delete($this->control->tables_list['infactive'], "iditem='$recordid'", '1');
   return true;   	
  }//DeleteFormItemInfRecord
  
  /** удаление всех записей информера */
  protected function ActionDeleteAllInfRecords() {
   $result = $this->control->db->mPost(
    "select iditem from {$this->control->tables_list['infactive']} where infimage='{$_GET['statisticinfo']}'"
   );
   while ($row = $this->control->db->GetLineArray($result)) {
	//delete
	$this->DeleteFormItemInfRecord($row['iditem']);		
   }   	
   return true;
  }//ActionDeleteAllInfRecords
  
  /** обработка данных информации о информере */
  protected function _DoActionInformerStatisticInfo() {
   //всего разделов
   $this->result = array('count' => $this->GetRecordsInfCount());
   //action from list   
   $is_modified = false;
   switch ($_POST['actionlistinvitecode']) {
   	//удалить все записи
	case 'dall': 
	 $this->ActionDeleteAllInfRecords(); $is_modified = true; break;
	//удалить выбранные записи
	case 'delete': 
	 $this->TransformPostItems(array($this, 'DeleteFormItemInfRecord'), $this->GetPerPageCount('infactive'));
	 $is_modified = true;
	 break; 
   }  
   //restore count
   if ($is_modified) { $this->result['count'] = $this->GetRecordsInfCount(); } 
   //listen
   $this->result['data'] = $this->GetTableData('infactive', 
    "select * from {$this->control->tables_list['infactive']} where infimage='".$_GET['statisticinfo'].
	"' order by datestart DESC", $this->result['count'], 'page', '', 
	'&inftype='.$this->GetInformersType().'&sections='.$this->GetSectionType().
	'&statisticinfo='.$_GET['statisticinfo'].(($_GET['oldpage']) ? "&oldpage={$_GET['oldpage']}" : '')
   );  
   //info
   $this->GetInformerInfo(array('iditem'=>$_GET['statisticinfo']), 'qq');
   $this->result['info'] = (!isset($this->tempinfoids[$_GET['statisticinfo']])) ? false : 
   $this->tempinfoids[$_GET['statisticinfo']]; 
   return true;	
  }//_DoActionInformerStatisticInfo
  
  /** идентификатор инструмента по идентификатору типа информера */
  protected function GetToolIdentByInfType($id) {
   switch ($id) {
	case '':
	case '1': return 'internetspeed';
	case '2': return 'ipinformer';
	case '3': return 'prcyinformer';
    case '4': return 'updatesinformer';	
   }
   return false;	
  }//GetToolIdentByInfType
  
  /** остаток минут от текущей даты */
  function GetLastMinuteInfo($date, $toolident, $optident, $dostringL='', $dostringR='') {
   global $_TOOLSNOLIMITACTIVATIONDATAINFO;
   if (!$toolident = $this->GetToolIdentByInfType($toolident)) { return false; }
   if (
    !$date || !$toolident || !isset($_TOOLSNOLIMITACTIVATIONDATAINFO[$toolident]) || 
    !isset($_TOOLSNOLIMITACTIVATIONDATAINFO[$toolident][$optident])
   ) { return false; }
   //check
   $int = $_TOOLSNOLIMITACTIVATIONDATAINFO[$toolident][$optident];
   if (!$int || $int < 0) { return false; }
   //get interval
   $diff = $this->control->DateDiff(
    'n', $this->control->GetIntDateFromStr($date, true), $this->control->GetIntDateFromStr($this->GetThisDateTime(), true)
   );   
   $diff = ($diff < 0 || $diff > $int) ? 0 : ($int - $diff);
   $diff = ($diff < 0) ? 0 : $diff;
   return $dostringL.$diff.$dostringR;   	
  }//GetLastMinuteInfo
  
  /** корректировка цвета элемента */
  function GetColorInformer($recordinfo) {
   $color = $this->control->ReadOption('REPLcolor', $recordinfo['sdata']);
   if (!$color) { return false; }
   return @str_replace('_r_', '#', $color);	
  }//GetColorInformer  
  
  function _DoActionThisSection() {
   //обработка информации о выбранном информере
   if ($_GET['statisticinfo'] && @is_numeric($_GET['statisticinfo'])) { 
   	$_GET['statisticinfo'] = $this->CorrectSymplyString($_GET['statisticinfo']);
	return $this->_DoActionInformerStatisticInfo(); 
   }  	
   //обработка разделов информеров
   if ($_GET['sectionslist']) { return $this->_ActionSectionList(); }	
   //get color
   if ($this->IsAjax() && $_POST['image'] && @is_numeric($_POST['x']) && @is_numeric($_POST['y'])) {
	$color = $this->GetColorOnImage($_POST['image'], $_POST['x'], $_POST['y']);
	$color = ($color) ? '<span style="background: '.$color.'; display: inline-block; width: 30px">&nbsp;</span>
	<label style="margin-left: 6px">'.$color.'</label>' : '?';
	print $color; exit;
   }   
   //get an image
   if ($_GET['getimage']) { 
   	$options = (isset($_GET['optimg'])) ? self::PrepereParamsStr(@str_replace('_r_', '#', $_GET['optimg'])) : false;
   	if ($this->_DoShowImageFile($_GET['getimage'], ($options) ? $options : false, $_GET['repcol'])) { exit; }
   }      	  	
   /* css */
   $this->AddSectionInfoNew('csslist', 'colordlg/colorpicker.php');
   /* js */
   $this->AddSectionInfoNew('jslist', 'colordlg/colorpicker.js');
   $this->AddSectionInfoNew('jslist', 'colordlg/eye.js');
   $this->AddSectionInfoNew('jslist', 'colordlg/utils.js');
   $this->AddSectionInfoNew('jslist', 'colordlg/layout.js?ver=1.0.2');  	     	
   //всего изображений
   $this->result = array(
    'count'   => $this->GetTableCount(),
    'maxsize' => ss_HTMLPageInfo::GetSizeStrX(self::MAX_FILE_SIZE_KB * 1024)
   );
   //список секций
   $this->GetSectionList();
   //шрифты
   $this->result['fonts'] = $this->control->GetFontList();
   //modify suboptions
   if ($_GET['modifyimage']) {
   	if ($_POST['updatesactionnew'] == 'do') { $this->UpdateImageSubOptions($_GET['modifyimage']); }
	//get info		
	$this->result['imageinfo'] = $this->GetImageInfo($_GET['modifyimage']);
	if ($this->result['imageinfo']) { return true; }	
   }   
   //добавление изображения
   if ($_GET['new']) { return ($_POST['updatesactionnew'] == 'do') ? $this->AddNewImageInformerFile() : true; }
   //action from list
   $is_modified = false;
   switch ($_POST['actionlistmakes']) {
   	//удалить все элементы
	case 'dall': 
	 $this->ActionDeleteAll(); $is_modified = true; break;
	//удалить выбранные элементы
	case 'delete': 
	 $this->TransformPostItems(array($this, 'DeleteFormItem'), $this->GetPerPageCount(''));
	 $is_modified = true;
	 break;	
	//включить
	case 'enabled': 
	 $this->TransformPostItems(array($this, 'ActionToEnabledItem'), $this->GetPerPageCount('')); break;
	//отключить
	case 'disabled': 
	 $this->TransformPostItems(array($this, 'ActionToDisabledItem'), $this->GetPerPageCount('')); break;  
   }  
   //restore count
   if ($is_modified) { $this->result['count'] = $this->GetTableCount(); } 
   //listen
   $this->result['data'] = $this->GetTableData('definform', 
    "select * from {$this->control->tables_list['definform']} where ".
	"informtype='".$this->GetInformersType()."'".$this->GetWhereIfSection().
	" order by datecreat DESC", $this->result['count'], 'page', 
	'', '&inftype='.$this->GetInformersType().'&sections='.$this->GetSectionType()
   );   	
  }//_DoActionThisSection
  
  /** обработка строки параметров */
  static function PrepereParamsStr($data) {
   return @preg_replace("/[^a-z:0-9,#\r\n]/is", '', $data);	
  }//PrepereParamsStr
  	
 }//w_admin_adminformersfiles
 //-------------------------------------------------------  
 /** раздел витрины ссылок */
 class w_admin_admlinksvitrina extends w_admin_gen_obj {	
  protected 
   $result;
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'linksvitrinasect';	
  }//__construct
  
  /** удалить все */
  protected function ActionDeleteAll() {
   return $this->control->db->mPost("delete from {$this->control->tables_list['linksvit']}");   	
  }//ActionDeleteAll
  
  /** удалить указанные элементы */
  protected function DeleteFormItem($id) {	
   $this->control->db->Delete($this->control->tables_list['linksvit'], "iditem='$id'", '1');	
   return true;   
  }//DeleteFormItem
  
  function GetFlagName($ss) { return W_SITEPATH.'img/items/flag/'.$ss.'.gif'; }
  
  /** добавление ссылки */
  protected function AddNewLink() {
   $_POST['url'] = $this->substr($this->CorrectSymplyString($_POST['url']), 0, 120);
   $_POST['urltext'] = $this->substr($this->CorrectSymplyString($_POST['urltext']), 0, 80);
   $html = new ss_HTTP_obj();
   if (!$html->SetURL($_POST['url'])) { return $this->SetError('Error parse url!'); }
   if ($_POST['urltext'] == '') { $_POST['urltext'] = $_POST['url']; }
   $this->control->db->INSERTAction('linksvit', array(
    'ldate'    => $this->GetThisDateTime(),
    'ltext'    => $_POST['urltext'],
    'lurl'     => $html->url_self_no_protocol,
    'lhost'    => $html->url_real_host,
    'isbolded' => (@in_array($_POST['ptype'], array('2', '4'))) ? 1 : 0,
    'isindexed'=> (@in_array($_POST['ptype'], array('3', '4'))) ? 1 : 0
   ));
   $this->result['count'] = $this->control->GetCountInTable('iditem', 'linksvit');
   return true;   	
  }//AddNewLink
  
  /** получение информации о ссылке */
  protected function GetLinkInformation() {
   if (!$_GET['modify'] = $this->CorrectSymplyString($_GET['modify'])) { return false; }
   return $this->result['modifyinfo'] = $this->control->db->GetLineArray($this->control->db->mPost(
    "select * from {$this->control->tables_list['linksvit']} where iditem='{$_GET['modify']}' limit 1"
   ));   	
  }//GetLinkInformation
  
  /** изменение ссылки */
  protected function ModifyLink() {
   if (!$this->result['modifyinfo']) { return false; } 
   $_POST['url'] = $this->substr($this->CorrectSymplyString($_POST['url']), 0, 120);
   $_POST['urltext'] = $this->substr($this->CorrectSymplyString($_POST['urltext']), 0, 80);
   $html = new ss_HTTP_obj();
   if (!$html->SetURL($_POST['url'])) { return $this->SetError('Error parse url!'); }
   if ($_POST['urltext'] == '') { $_POST['urltext'] = $_POST['url']; }
   $this->control->db->UPDATEAction('linksvit', array(
    'ltext'    => $_POST['urltext'],
    'lurl'     => $html->url_self_no_protocol,
    'lhost'    => $html->url_real_host,
    'isbolded' => (@in_array($_POST['ptype'], array('2', '4'))) ? 1 : 0,
    'isindexed'=> (@in_array($_POST['ptype'], array('3', '4'))) ? 1 : 0
   ), "iditem='{$this->result['modifyinfo']['iditem']}'", "1");
   return $this->GetLinkInformation();
  }//ModifyLink  
  
  function _DoActionThisSection() { 		 	
   //всего ссылок
   $this->result = array(
    'count' => $this->control->GetCountInTable('iditem', 'linksvit')
   );
   //изменение ссылки
   if ($_GET['modify'] && $this->GetLinkInformation()) {
   	if ($_POST['actionthissectionpost'] != 'do') {
	 $_POST['url'] = $this->GetResult('modifyinfo.lurl');
	 $_POST['urltext'] = $this->GetResult('modifyinfo.ltext'); 
	 if ($this->GetResult('modifyinfo.isbolded') && $this->GetResult('modifyinfo.isindexed')) {
	  $_POST['ptype'] = '4';	
	 } 
	 elseif ($this->GetResult('modifyinfo.isbolded')) { $_POST['ptype'] = '2'; }
	 elseif ($this->GetResult('modifyinfo.isindexed')) { $_POST['ptype'] = '3'; }
	 else { $_POST['ptype'] = '1'; }
	 $_POST['actionthissectionpost'] = 'do';
	 $_POST['actionthissectionpost_q'] = '1';	 	
	 return true;	
	} else { return $this->ModifyLink(); }
   }   
   //добавление ссылки
   if ($_GET['new']) { 
   	return ($_POST['actionthissectionpost'] == 'do') ? $this->AddNewLink() : true; 
   }
   //action from list
   $is_modified = false;
   switch ($_POST['actionlistmakes']) {
   	//удалить все элементы
	case 'dall': 
	 $this->ActionDeleteAll(); $is_modified = true; break;
	//удалить выбранные элементы
	case 'delete': 
	 $this->TransformPostItems(array($this, 'DeleteFormItem'), $this->GetPerPageCount(''));
	 $is_modified = true;
	 break;	 
   }  
   //restore count
   if ($is_modified) { $this->result['count'] = $this->control->GetCountInTable('iditem', 'linksvit'); } 
   //listen
   $this->result['data'] = $this->GetTableData('linksvit', 
    "select * from {$this->control->tables_list['linksvit']} order by ldate DESC", $this->result['count']
   );   	
  }//_DoActionThisSection	
	
 }//w_admin_admlinksvitrina
 //-------------------------------------------------------
 /** раздел новостей */
 class w_admin_admnewsitems extends w_admin_gen_obj {
  const FILE_IDENT = 'image';	
  //максимальный размер файла изображения (0 - без ограничений)	
  const MAX_FILE_SIZE_KB = 2048;
  //допустимые типы изображений
  private static $files_type = array(".gif", ".jpg", ".png", ".jpeg"/*, ".bmp"*/); 		
  protected 
   $result,
   $sectioninfo,
   $sectionopt;
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->sectioninfo = false;
   $this->sectionopt = false;
   if (!$this->GetNewsType()) {	$this->global_string_identifier = 'allsectionslistentblck'; }  
    elseif ($this->sectioninfo = $control->GetNewsSectionInfoData(
	 $this->GetNewsType(), false, false, $this->GetLang())
	) {	 	
	$this->CheckForCanGetSectionOptions();	
    $this->globalnogettext = true;
	$this->global_string_identifier = ($this->sectionopt['newstitletospec']) ? 
	$this->sectionopt['newstitletospec'] : 'No section'; 	
   }
   else {    
    switch ($this->GetNewsType()) {
   	 //internet
	 case '2': $this->global_string_identifier = 'admnewssectinterne'; break;
	 //site
	 case '1': $this->global_string_identifier = 'admnewssectsite'; break;
	 //def
	 default: 	
	  $this->globalnogettext = true;
	  $this->global_string_identifier = 'Unknow section';
	  break;
    }
   }
   $this->CheckForCanGetSectionOptions();
   if ($this->sectionopt && $this->sectionopt['newstitletospec']) {
   	$this->globalnogettext = true;
    $this->global_string_identifier = $this->sectionopt['newstitletospec'];	
   }   
   $this->secondpath_first = '&ntype='.$this->GetNewsType().'&lang='.$this->GetLang();   	
  }//__construct
  
  function CheckForCanGetSectionOptions() {
   global $_GLOBALUSECOMMENTOPTIONS;
   if ($this->sectionopt) { return false; }
   $this->sectionopt = (isset($_GLOBALUSECOMMENTOPTIONS['0'][$this->GetNewsType()])) ? 
   $_GLOBALUSECOMMENTOPTIONS['0'][$this->GetNewsType()] : false;  
  }//CheckForCanGetSectionOptions
  
  /** список допустимых типов изображений */
  function GetListTypes() {
   return $this->control->GenerateArrayString(self::$files_type,', ', '"<b>', '"</b>');	
  }//GetListTypes
  
  /** активный язык */
  function GetLang() { 
   return ($_GET['lang']) ? $this->CorrectSymplyString($_GET['lang']) : $this->control->GetActiveLanguage(); 
  }//GetLang
  
  /** количество новостей на 1 страницу */
  function GetPerPageCount($tablename) { 
   switch ($tablename) {
	case 'newssectq': return 10; //разделы
	default: return 15; //новости
   }
  }//GetPerPageCount
  
  /** тип новостей */
  function GetNewsType() { return ($_GET['ntype'] && @is_numeric($_GET['ntype'])) ? $_GET['ntype'] : '0'; }
  
  /** удаление комментариев новости */
  protected function DeleteNewsComments($info) {
   return $this->control->db->Delete(
    $this->control->tables_list['commtbl'], "commfor='{$info['iditem']}' and objectid='0'"
   );   	
  }//DeleteNewsComments
  
  /** получение кол-ва комментариев к новости */
  function GetCommentsCountForNews($newsinfo) {
   return $this->control->GetCommentCountForElement($newsinfo['newtype'],/* $this->GetNewsType(), */$newsinfo['iditem']);	
  }//GetCommentsCountForNews
  
  /** удаление элемента */
  protected function DeleteRecordData($info) {
   if (!$info) { return false; }
   $filename = ($info['dwnameimg']) ? (W_FILESPATH.'/images/'.$info['dwnameimg']) : false;
   if ($filename && @file_exists($filename)) { @unlink($filename); }
   $this->DeleteNewsComments($info);
   $this->control->db->Delete($this->control->tables_list['newslist'], "iditem='{$info['iditem']}'", "1");
   
   //remove files of record
   require_once W_LIBPATH.'/files.lib.php';
   w_dw_files_object::RemoveAllObjectFiles(1, $info['iditem'], $this->control);
   
   return true;   	
  }//DeleteRecordData
  
  function GetNtypeWhere($andstr=' and ') {
   return ((!$this->GetNewsType()) ? '' : ("newtype='".$this->GetNewsType()."'".$andstr));	
  }//GetNtypeWhere
  
  /** удалить все */
  protected function ActionDeleteAll() {
   $result = $this->control->db->mPost(
    "select iditem, dwnameimg, newtype from {$this->control->tables_list['newslist']} ".
	"where ".$this->GetNtypeWhere()."lang='".$this->GetLang()."'"
   );	
   while ($row = $this->control->db->GetLineArray($result)) {
	$this->DeleteRecordData($row);
   }	
   return true;     	
  }//ActionDeleteAll
  
  /** удалить указанные элементы */
  protected function DeleteFormItem($id) {
   return $this->DeleteRecordData($this->GetNewsRecord($id));   
  }//DeleteFormItem
  
  /** переместить элемент */
  protected function MoveToFormItem($id) {
   if ($_POST['identtomoveelement'] == '' || !@is_numeric($_POST['identtomoveelement'])) { return false; }
   if (!$id = $this->CorrectSymplyString($id)) { return false; }
   //ok, correct
   if (!$this->control->db->UPDATEAction('newslist', array(
    'newtype' => $this->CorrectSymplyString($_POST['identtomoveelement'])
   ), "iditem='$id'", "1")) { return false; }
   //ok, correct comments list
   $this->control->db->UPDATEAction('commtbl', array(
    'commtype' => $this->CorrectSymplyString($_POST['identtomoveelement'])
   ), "commfor='$id'");  	
  }//MoveToFormItem
  
  /** получение информации о новости */
  protected function GetNewsRecord($id) {
   if (!$id = $this->CorrectSymplyString($id)) { return false; }
   return $this->control->db->GetLineArray($this->control->db->mPost(
    "select * from {$this->control->tables_list['newslist']} where iditem='$id' limit 1"
   ));   
  }//GetNewsRecord
    
  /** получение информации о новости изменения */
  protected function GetNewsInformation() {
   return $this->result['modifyinfo'] = $this->GetNewsRecord($_GET['modify']);	
  }//GetLinkInformation
  
  protected function GetNewsSectionInformation() {
  	global $_GLOBALUSECOMMENTOPTIONS;
  	if (!$_GET['modify'] || !$_GET['assection']) { return false; } 	
  	$this->result['modifyinfo'] = array(
	 'data'   => $this->control->GetNewsSectionInfoData($_GET['modify'], false, false, $this->GetLang()),
	 'opt'    => false,
	 'avatar' => false 
	);
	if (!$this->result['modifyinfo']['data']) { return false; }
	$this->result['modifyinfo']['opt'] = $_GLOBALUSECOMMENTOPTIONS['0'][$this->result['modifyinfo']['data']['iditem']];
	//read avatar
	if (!$this->result['modifyinfo']['data']['soptions']) { $this->result['modifyinfo']['data']['soptions'] = ''; }	
	$avatar = $this->control->ReadOption('AVATAR', $this->result['modifyinfo']['data']['soptions']);
	$file = (!$avatar) ? false : (W_FILESPATH.'/images/'.$avatar);
	$this->result['modifyinfo']['data']['avatar'] =
	W_SITEPATH.(($avatar && $file && @file_exists($file)) ? ('pfiles/images/'.$avatar) : 'img/ico/general/news_site.png');
	return $this->result['modifyinfo'];
  }//GetNewsSectionInformation 
  
  /** добавление новости */
  protected function AddNewNews() {
   if (!$_POST['title'] = $this->CorrectSymplyString($_POST['title'])) { 
    return $this->SetError($this->GetText('pleasuresettitle'));
   }
   if (!$_POST['source']) { return $this->SetError($this->GetText('pleasuresetsource')); }
   //check exists
   if (W_NEWSCANBEEXISTSALRIDY) {   	
	$item = $this->control->db->GetLineArray($this->control->db->mPost(
	 "select iditem from {$this->control->tables_list['newslist']} where newtype='".$this->GetNewsType()."' ".
	 "and Lower(newtitle)=Lower('{$_POST['title']}') and lang='".$this->GetLang()."' limit 1"
	));
	if ($item) { return $this->SetError($this->GetText('newsalridyexistsw', array($_POST['title']))); }
   }
   //ok, check load image	
   $FILE_INFO = ($_FILES[self::FILE_IDENT]['name']) ? $this->control->UpLoadFile(
    self::FILE_IDENT, self::$files_type, self::MAX_FILE_SIZE_KB, W_FILESPATH.'/images/', 0, 0, false, -1, '' 
   ) : false;   
   if ($FILE_INFO && $FILE_INFO['result']) { return $this->SetError($FILE_INFO['result']); }
   $_POST['keywordsnews'] = @$this->substr(@trim($this->CorrectSymplyString($_POST['keywordsnews'])), 0, 250);
   $_POST['tdescription'] = @$this->substr(@trim($this->CorrectSymplyString($_POST['tdescription'])), 0, 250);
   //ok add
   
   $source = ($this->CheckPostValue('contenttype')) ? $this->control->db->EscapeString($_POST['source']) : 
   $this->control->strings->CorrectTextToDB($_POST['source']);
   
   if (!$this->control->db->INSERTAction('newslist', array(
    'datecreate'   => $this->GetThisDateTime(),
    'newtype'      => $this->GetNewsType(),
    'newtitle'     => $this->substr($_POST['title'], 0, 200),
    'newdata'      => $source,
    'dwnameimg'    => ($FILE_INFO && $FILE_INFO['newname']) ? $FILE_INFO['newname'] : '',
	'lang'         => $this->GetLang(),
    'keywords'     => $_POST['keywordsnews'],
    'tdescription' => $_POST['tdescription'],
    'contenttype'  => ($this->CheckPostValue('contenttype')) ? 1 : 0,    
   ))) { 
    //error in insert record
	if ($FILE_INFO && $FILE_INFO['newname'] && @file_exists(W_FILESPATH.'/images/'.$FILE_INFO['newname'])) { 
	 @unlink(W_FILESPATH.'/images/'.$FILE_INFO['newname']); 
	}
	return $this->SetError('Error in add news record!');	
   }
   $this->result['count'] = $this->GetNewsCount();   
   return true;
  }//AddNewNews
  
  /** изменение новости */
  protected function ModifyNews() {
   if (!$this->result['modifyinfo']) { return $this->SetError('No record information found!'); }
   if (!$_POST['title'] = $this->CorrectSymplyString($_POST['title'])) { 
    return $this->SetError($this->GetText('pleasuresettitle'));
   }
   if (!$_POST['source']) { return $this->SetError($this->GetText('pleasuresetsource')); }
   //check exists
   if (W_NEWSCANBEEXISTSALRIDY) {   	
	$item = $this->control->db->GetLineArray($this->control->db->mPost(
	 "select iditem from {$this->control->tables_list['newslist']} where newtype='".$this->GetNewsType()."' ".
	 "and iditem<>'{$this->result['modifyinfo']['iditem']}' and lang='".$this->GetLang()."' and ".
	 "Lower(newtitle)=Lower('{$_POST['title']}') limit 1"
	));
	if ($item) { return $this->SetError($this->GetText('newsalridyexistsw', array($_POST['title']))); }
   }
   //ok, check load image	
   $FILE_INFO = ($_FILES[self::FILE_IDENT]['name']) ? $this->control->UpLoadFile(
    self::FILE_IDENT, self::$files_type, self::MAX_FILE_SIZE_KB, W_FILESPATH.'/images/', 0, 0, false, -1, '' 
   ) : false;   
   if ($FILE_INFO && $FILE_INFO['result']) { return $this->SetError($FILE_INFO['result']); }
   $_POST['keywordsnews'] = @$this->substr(@trim($this->CorrectSymplyString($_POST['keywordsnews'])), 0, 250);
   $_POST['tdescription'] = @$this->substr(@trim($this->CorrectSymplyString($_POST['tdescription'])), 0, 250);
   
   //correct source value
   $source = ($this->CheckPostValue('contenttype')) ? $this->control->db->EscapeString($_POST['source']) : 
   $this->control->strings->CorrectTextToDB($_POST['source']);   
   
   //image is, action to replace
   if (!$this->control->db->UPDATEAction('newslist', array(
    'newtitle'     => $this->substr($_POST['title'], 0, 200),
    'newdata'      => $source,
    'dwnameimg'    => ($FILE_INFO && $FILE_INFO['newname']) ? $FILE_INFO['newname'] : '',
    'keywords'     => $_POST['keywordsnews'],
    'tdescription' => $_POST['tdescription'],
    'contenttype'  => ($this->CheckPostValue('contenttype')) ? 1 : 0,       
   ), "iditem='{$this->result['modifyinfo']['iditem']}'", "1")) { 
    //error in update record
	if ($FILE_INFO && $FILE_INFO['newname'] && @file_exists(W_FILESPATH.'/images/'.$FILE_INFO['newname'])) { 
	 @unlink(W_FILESPATH.'/images/'.$FILE_INFO['newname']); 
	}
	return $this->SetError('Error in modify news record!');	
   }
   //ok, remove old image file
   if ($this->result['modifyinfo']['dwnameimg'] && @file_exists(
    W_FILESPATH.'/images/'.$this->result['modifyinfo']['dwnameimg'])
   ) { @unlink(W_FILESPATH.'/images/'.$this->result['modifyinfo']['dwnameimg']); }
   //success, reload record info
   return $this->GetNewsInformation();		
  }//ModifyNews
  
  //content data by type of source content formatted/html
  function GetNormalDescriptionSource($post_name) {
   return ($this->CheckPostValue('contenttype')) ? $this->HTMLspecialChars(@stripcslashes($_POST[$post_name])) :
   $_POST[$post_name];    
  }//GetNormalDescriptionSource
  
  //prev source content by type data formatted/html
  function GetPrevSourceData($post_name) {
   return ($this->CheckPostValue('contenttype')) ? $_POST[$post_name] : 
   $this->control->strings->CorrectTextFromDB($this->control->strings->CorrectTextToDB($_POST[$post_name]));  
  }//GetPrevSourceData
  
  /** получение кол-ва новостей */
  protected function GetNewsCount($lang=false) {  	
   return $this->control->GetCountInTable(
    'iditem', 'newslist', "where ".$this->GetNtypeWhere()."lang='".(($lang === false) ? $this->GetLang() : $lang)."'"
   );	   
  }//GetNewsCount
  
  function GetSpecialNewsCount($ntype) {
   return $this->control->GetCountInTable(
    'iditem', 'newslist', "where ".((!$ntype) ? '' : ("newtype='".$ntype."' and "))."lang='".$this->GetLang()."'"
   );   	
  }//GetSpecialNewsCount
  
  /** получение кол-ва разделов */
  protected function GetNewsSectionsCount($lang=false) {
   return $this->control->GetCountInTable(
    'iditem', 'newssectq', "where lang='".(($lang === false) ? $this->GetLang() : $lang)."'"
   );	
  }//GetNewsSectionsCount
  
  /** генерация списка языков */
  protected function CombineLanguage() {
   global $_GLOBAL_LANGUAGE_LIST;	
   $this->result['language'] = array();
   foreach ($_GLOBAL_LANGUAGE_LIST as $name => $value) {
	$this->result['language'][] = array(
	 'id'    => $name,
	 'name'  => $value,
	 'count' => $this->GetNewsCount($name)
	);	
   } 	
  }//CombineLanguage
  
  /** получение информации о указанном разделе */
  function GetSectionInfoData($sectionid, $path) {
   if ($this->GetResult('newssectionsresultsinfos.'.$sectionid) === false) {
	if (!isset($this->result['newssectionsresultsinfos'])) {
	 $this->result['newssectionsresultsinfos'] = array();	
	}
	$this->result['newssectionsresultsinfos'][$sectionid] = $this->control->GetNewsSectionInfoData(
	 $sectionid, true, false, $this->GetLang()
	);
   }    
   return $this->GetResult('newssectionsresultsinfos.'.$sectionid, $path);
  }//GetSectionInfoData
  
  /** обработка элементов раздела добавления\изменения */
  protected function PreperePostParamsSection() {
   //name
   if (!$_POST['sname'] = $this->CorrectSymplyString($_POST['sname'])) {
	return $this->SetError($this->GetText('p_selectnewsection'));
   }
   $_POST['sname'] = $this->substr($_POST['sname'], 0, 120);
   //count per page
   $_POST['w-perpagecount'] = ($_POST['w-perpagecount'] && @is_numeric($_POST['w-perpagecount']) && 
   $_POST['w-perpagecount'] > 0) ? $_POST['w-perpagecount'] : 15;
   //path
   if (!$_POST['w-pathobjects'] || @preg_replace("/[a-zа-я\-_]/iU", '', $_POST['w-pathobjects'])) {
    return $this->SetError($this->GetText('setcorrectnameofpathnews'));	
   }
   $_POST['w-pathobjects'] = $this->substr($_POST['w-pathobjects'], 0, 120);
   //named host section
   if (!$_POST['w-newstitletospec'] = $this->CorrectSymplyString($_POST['w-newstitletospec'])) {
	return $this->SetError($this->GetText('selsectionnameof'));
   }
   $_POST['w-newstitletospec'] = $this->substr($_POST['w-newstitletospec'], 0, 120);
   return true; 	
  }//PreperePostParamsSection
  
  private function GetPostBool($name) {  return ($this->CheckPostValue($name)) ? 1 : 0; }
  
  private function WriteNewOptionSection(&$list, $name, $asbool=true, $sname=false) {
   $r = $this->control->WriteOption(
    $name, ($asbool) ? $this->GetPostBool('w-'.$name) : $_POST[(($sname === false) ? ('w-'.$name) : $sname)], $list
   );
   if ($r === false) { return false; }
   $list = $r;	
  }//WriteNewOptionSection
  
  /** сборка параметров раздела */
  protected function CombineSectionNewsParamsToString($res=false) {
   $result = ($res !== false) ? $res : ''; 
   //bool
   $this->WriteNewOptionSection($result, 'enabled');
   $this->WriteNewOptionSection($result, 'withmodercomment');
   $this->WriteNewOptionSection($result, 'withcaptcha');
   $this->WriteNewOptionSection($result, 'showimages');
   //string
   $this->WriteNewOptionSection($result, 'perpagecount', false);
   $this->WriteNewOptionSection($result, 'pathobjects', false);
   $this->WriteNewOptionSection($result, 'newstitletospec', false); 
   $this->WriteNewOptionSection($result, 'noelementstext', false); 
   return $result;	
  }//CombineSectionNewsParamsToString
  
  /** добавление нового раздела */
  protected function AddNewNewsSection() {
   //correct values
   if (!$this->PreperePostParamsSection()) { return false; }   
   //check exists
   $item = $this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem from {$this->control->tables_list['newssectq']} where Lower(sname)=Lower('{$_POST['sname']}')".
	" and lang='".$this->GetLang()."' limit 1"
   ));
   if ($item) { return $this->SetError($this->GetText('p_sectisexistsalr', array($_POST['sname']))); }
   //ok add
   if (!$this->control->db->INSERTAction('newssectq', array(  
    'sname'      => $_POST['sname'],
    'sdescr'     => $this->control->strings->CorrectTextToDB($_POST['wsource']),
    'soptions'   => $this->CombineSectionNewsParamsToString(),
    'lang'       => $this->GetLang(),
    'datecreate' => $this->GetThisDateTime()	    
   ))) { 
	return $this->SetError('Error in add news record!');	
   }
   $this->result['rcount'] = $this->GetNewsSectionsCount();   
   return true;
  }//AddNewNewsSection
  
  /** удаление раздела */
  protected function ActionToDeleteSectionOfNews($sectionid) {
   if (!$info = $this->control->GetNewsSectionInfoData($sectionid, true, false, $this->GetLang())) { return false; }
   if ($info['soptions']) { 	
    $avatar = $this->control->ReadOption('AVATAR', $info['soptions']);
    $file = (!$avatar) ? false : (W_FILESPATH.'/images/'.$avatar);
    //remove file
    if ($file && @file_exists($file)) { @unlink($file); }
   }
   //remove record
   if ($this->control->db->Delete($this->control->tables_list['newssectq'], "iditem='{$info['iditem']}'", "1")) {
	$this->result['rcount'] = $this->GetNewsSectionsCount();
   }   	
  }//ActionToDeleteSectionOfNews
  
  function GetAsElementP($name, $ifname='actionthissectnnews', $ifvalue='do', $defvalue='') {
   return $this->control->GetPostElement($name, $ifname, $ifvalue, $defvalue, $_POST['actionnewprvmail'] == 'act');	
  }//GetAsElementP
  
  /** изменения раздела */
  protected function ModifyNewsSection() {	
   //default params
   if ($_POST['actionthissectnnews'] == 'do') { 
	//read correct
	if (!$this->PreperePostParamsSection()) { return false; } 
    //check exists
    $item = $this->control->db->GetLineArray($this->control->db->mPost(
     "select iditem from {$this->control->tables_list['newssectq']} where Lower(sname)=Lower('{$_POST['sname']}')".
	 " and lang='".$this->GetLang()."' and iditem<>'{$this->result['modifyinfo']['data']['iditem']}' limit 1"
    ));
    if ($item) { return $this->SetError($this->GetText('p_sectisexistsalr', array($_POST['sname']))); }
	//ok modify
    if (!$this->control->db->UPDATEAction('newssectq', array(  
     'sname'      => $_POST['sname'],
     'sdescr'     => $this->control->strings->CorrectTextToDB($_POST['wsource']),
     'soptions'   => $this->CombineSectionNewsParamsToString($this->GetResult('modifyinfo.data.soptions'))
    ), "iditem='{$this->result['modifyinfo']['data']['iditem']}'", "1")) { 
	 return $this->SetError('Error in update news section record!');	
    }
	return true;
   }   
   //image param   
   if ($_POST['actionthissectnnews4'] == 'do') {
   	//for correct values on read general elements  
   	$this->SetForModifySectionInfo();	
	//check load image	
    $FILE_INFO = ($_FILES[self::FILE_IDENT]['name']) ? $this->control->UpLoadFile(
     self::FILE_IDENT, self::$files_type, self::MAX_FILE_SIZE_KB, W_FILESPATH.'/images/', 0, 0, false, -1, '' 
    ) : false;   
    if ($FILE_INFO && $FILE_INFO['result']) { return $this->SetError($FILE_INFO['result']); }
	//ok, check follow
    if (!$str = $this->GetResult('modifyinfo.data.soptions')) { $str = ''; }
    $avatar = $this->control->ReadOption('AVATAR', $str);
    //ignore    
    if ((!$FILE_INFO || !$FILE_INFO['newname']) && !$avatar) { return true; }    
    //ok, next
    $file = (!$avatar) ? false : (W_FILESPATH.'/images/'.$avatar);
	//remove all
    if ((!$FILE_INFO || !$FILE_INFO['newname']) && $file && @file_exists($file)) { 
	 @unlink($file);
	 return true; //no remove element from record options, it removed at next time automatically on set
	}
	//no need to replace
	if (!$FILE_INFO || !$FILE_INFO['newname']) { return true; }	
	//replace to new
	$r = $this->control->WriteOption('AVATAR', $FILE_INFO['newname'], $str);
	if ($r !== false) { $str = $r; }
	//write record   
    if (!$this->control->db->UPDATEAction('newssectq', array('soptions' => $str), 
	"iditem='{$this->result['modifyinfo']['data']['iditem']}'", "1")) { 
     //error in update record
	 if ($FILE_INFO && $FILE_INFO['newname'] && @file_exists(W_FILESPATH.'/images/'.$FILE_INFO['newname'])) { 
	  @unlink(W_FILESPATH.'/images/'.$FILE_INFO['newname']); 
	 }
	 return $this->SetError('Error in modify news section record!');	
    }
    //ok, remove old image file
    if ($file && @file_exists($file)) { @unlink($file); }
    return $this->GetNewsSectionInformation();	
   }   
   return true;   	
  }//ModifyNewsSection
  
  private function SetForModifySectionInfo() {
   $_POST['sname']              = $this->GetResult('modifyinfo.data.sname');	 
   $_POST['w-perpagecount']     = $this->GetResult('modifyinfo.opt.perpagecount');
   $_POST['w-pathobjects']      = $this->GetResult('modifyinfo.opt.pathobjects');
   $_POST['w-newstitletospec']  = $this->GetResult('modifyinfo.opt.newstitletospec');
   $_POST['w-noelementstext']   = $this->GetResult('modifyinfo.opt.noelementstext');	 	 
   $_POST['w-enabled']          = ($this->GetResult('modifyinfo.opt.enabled')) ? 1 : 0;
   $_POST['w-withmodercomment'] = ($this->GetResult('modifyinfo.opt.withmodercomment')) ? 1 : 0;
   $_POST['w-withcaptcha']      = ($this->GetResult('modifyinfo.opt.withcaptcha')) ? 1 : 0;
   $_POST['w-showimages']       = ($this->GetResult('modifyinfo.opt.showimages')) ? 1 : 0;
   $_POST['wsource'] = $this->control->strings->CorrectTextForModify($this->GetResult('modifyinfo.data.sdescr'));
	 
   $_POST['actionthissectnnews'] = 'do';
   $_POST['actionnewprvmail']    = 'act';
   $_POST['actionthissectionpost_q'] = '1';	
   return true;
  }//SetForModifySectionInfo
  
  /** управление разделами */
  protected function ActionToControlSectionsListen() {
   //modify
   if ($_GET['modify'] && $this->GetNewsSectionInformation()) {
    if ($_POST['actionthissectnnews'] == 'do' || $_POST['actionthissectnnews4'] == 'do') {	 	
     return ($_POST['actionnewprvmail'] == 'prev') ? true : $this->ModifyNewsSection();	
    } else { 
	 return $this->SetForModifySectionInfo();
    }
   }
   //add
   if ($_GET['new']) { 
   	return ($_POST['actionthissectnnews'] == 'do' && $_POST['actionnewprvmail'] == 'act') ? 
	$this->AddNewNewsSection() : true; 
   }   
   //delete
   if ($_GET['qdelete']) { $this->ActionToDeleteSectionOfNews($_GET['qdelete']); }  
   //listen   
   $this->result['data'] = $this->GetTableData('newssectq', 
    "select * from {$this->control->tables_list['newssectq']} where lang='".$this->GetLang()."' order by datecreate DESC", 
	$this->result['rcount'], 'page', '', '&ntype='.$this->GetNewsType().'&assection=1&lang='.$this->GetLang()
   );
   //correct
   if ($this->result['data']['source']) {
	foreach ($this->result['data']['source'] as &$item) {
	 if (!$item['soptions']) { $item['soptions'] = ''; }	
	 $avatar = $this->control->ReadOption('AVATAR', $item['soptions']);
	 $file = (!$avatar) ? false : (W_FILESPATH.'/images/'.$avatar);
	 $item['avatar'] = W_SITEPATH.(($avatar && $file && @file_exists($file)) ? 
	 ('pfiles/images/'.$avatar) : 'img/ico/general/news_site.png');	 	
	}
   }   	
  }//ActionToControlSectionsListen
  
  function _DoActionThisSection() {	 		 	
   //всего новостей
   $this->result = array(
    'count'   => $this->GetNewsCount(),
    'maxsize' => ss_HTMLPageInfo::GetSizeStrX(self::MAX_FILE_SIZE_KB * 1024),
    'rcount'  => $this->GetNewsSectionsCount()
   );
   //языки
   $this->CombineLanguage(); 
   //управление секциями
   if ($_GET['assection']) { return $this->ActionToControlSectionsListen(); }
   //изменение новости
   if ($_GET['modify'] && $this->GetNewsInformation()) {
   	if ($_POST['actionthissectionpost'] != 'do') {
	 $_POST['title']  = $this->GetResult('modifyinfo.newtitle');
         
     $_POST['contenttype']  = $this->GetResult('modifyinfo.contenttype');
     $_POST['source'] = ($_POST['contenttype']) ? $this->GetResult('modifyinfo.newdata') :
	 $this->control->strings->CorrectTextForModify($this->GetResult('modifyinfo.newdata'));     
     
     $_POST['keywordsnews'] = $this->GetResult('modifyinfo.keywords');
     $_POST['tdescription'] = $this->GetResult('modifyinfo.tdescription');
	 
	 $_POST['actionthissectionpost'] = 'do';
	 $_POST['actionthissectionpost_q'] = '1';	 	
	 return true;	
	} else { return ($_POST['actionnewprvmail'] == 'prev') ? true : $this->ModifyNews(); }
   }   
   //добавление новости
   if ($_GET['new']) { 
   	return ($_POST['actionthissectionpost'] == 'do' && $_POST['actionnewprvmail'] == 'act') ? 
	$this->AddNewNews() : true; 
   }
   //action from list
   $is_modified = false;
   switch ($_POST['actionlistmakes']) {
   	//удалить все элементы
	case 'dall': 
	 $this->ActionDeleteAll(); $is_modified = true; break;
	//удалить выбранные элементы
	case 'delete': 
	 $this->TransformPostItems(array($this, 'DeleteFormItem'), $this->GetPerPageCount('newslist'));
	 $is_modified = true;
	 break;
	//переместить записи
	case 'moveto':
	 $this->TransformPostItems(array($this, 'MoveToFormItem'), $this->GetPerPageCount('newslist'));
	 $is_modified = true;
	 break;  	 
   }  
   //restore count
   if ($is_modified) { $this->result['count'] = $this->GetNewsCount(); $this->CombineLanguage(); } 
   //listen   
   $this->result['data'] = $this->GetTableData('newslist', 
    "select * from {$this->control->tables_list['newslist']} where ".$this->GetNtypeWhere().	
	"lang='".$this->GetLang()."' order by datecreate DESC", 
	$this->result['count'], 'page', '', '&ntype='.$this->GetNewsType().'&lang='.$this->GetLang()
   );   	
  }//_DoActionThisSection	
	
 }//w_admin_admnewsitems
 //-------------------------------------------------------
 /** раздел комментариев */
 class w_admin_admcommentslist extends w_admin_gen_obj { 			
  protected 
   $result,
   $dump,
   $sectioninfo_news;
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'admcommentslabel';
   $this->dump = array();
   $this->sectioninfo_news = array();   	
  }//__construct
  
  /** загрузка идентификатора раздела, инициализации параметров, кэширование результатов */
  function PreloadSectionInfoDataObj($ident) {
   global $_GLOBALUSECOMMENTOPTIONS;	
   if (!$ident = $this->CorrectSymplyString($ident)) { return false; } 
   
   if (isset($this->sectioninfo_news[$ident])) { return $this->sectioninfo_news[$ident]; } 
   
   switch ($this->GetObjectType()) {    
    //special pages
    case '1':    
     $data = $this->control->db->GetLineArray($this->control->db->mPost(
      "select * from {$this->control->tables_list['tplitemsl']} where iditem='$ident' limit 1"   
     ));     
    break;
    
    //like news object
    default:     
     $data = $this->control->db->GetLineArray($this->control->db->mPost(
      "select * from {$this->control->tables_list['newssectq']} where iditem='$ident' limit 1"   
     ));    
    break;       
   }
   
   if (!$data) { return $this->sectioninfo_news[$ident] = false; }   
   
   $_GLOBALUSECOMMENTOPTIONS[$this->GetObjectType()][$data['iditem']] = 
   $this->control->GetNewsSectionInfoData($data, false, true, false, $this->GetObjectType());
   
   return $this->sectioninfo_news[$ident] = $data;    	
  }//PreloadSectionInfoDataObj
  
  /** инициализация списка разделов */
  function GetCommentsSectionsListByNews() {
   
   if (isset($this->dump['cachlistsectionsitems'])) { return $this->dump['cachlistsectionsitems']; }
    
   $result = array(); 
   $ntype2 = $ntypevalue = false;
   
   switch ($this->GetObjectType()) {    
    //news
    case '0':

     $list = $this->control->db->mPost("select * from {$this->control->tables_list['newssectq']} order by lang");
     
     while ($row = $this->control->db->GetLineArray($list)) {
   	  $row['countinfo'] = $this->GetCommentCountInNTypeListen($row['iditem']);
      if ($row['countinfo']['active'] || $row['countinfo']['inactive']) { 
       
       $result[] = $row;
       $ntypevalue = $row['iditem'];
       
       if (!$ntype2 && $this->GetCommType() == $row['iditem']) { $ntype2 = true; } 
        
      }   	
     }
     
     if (!$ntype2 && $ntypevalue) { $_GET['ntype'] = $ntypevalue; }    
    
    break;
    
    //special pages
    case '1':
     
     $list = $this->control->db->mPost(
      "select * from {$this->control->tables_list['tplitemsl']} where lang='".$this->control->GetActiveLanguage().
      "' and skin='".$this->control->GetActiveSkin()."' order by datecreate DESC"
     );
     
     while ($row = $this->control->db->GetLineArray($list)) {
   	  $row['countinfo'] = $this->GetCommentCountInNTypeListen($row['iditem']);
      if ($row['countinfo']['active'] || $row['countinfo']['inactive']) {
       
       $row['sname'] = $row['ttitle'];
       $ntypevalue = $row['iditem'];
       
       if (!$ntype2 && $this->GetCommType() == $row['iditem']) { $ntype2 = true; } 
        
       $result[] = $row; 
      }   	
     }     
     
     if (!$ntype2 && $ntypevalue) { $_GET['ntype'] = $ntypevalue; }
    
    break;  
   }
   
   return $this->dump['cachlistsectionsitems'] = $result;   	
  }//GetCommentsSectionsListByNews
  
  /** количество комментариев на 1 страницу */
  function GetPerPageCount($tablename) { return 10; }
  
  /** тип комментариев */
  function GetCommType() { return ($_GET['ntype'] && @is_numeric($_GET['ntype']) ? $_GET['ntype'] : 1); } 
  function GetObjectType() { return ($_GET['oid'] && @is_numeric($_GET['oid']) ? $_GET['oid'] : 0); }
  
  /** фильтр активности */
  function GetActiveFilter($onlyvalue=false) {
   switch ($_GET['active']) {
	case '0':
	case '1': return ($onlyvalue) ? $_GET['active'] : " and commisactive='{$_GET['active']}'";		
   }
   return '';   	
  }//GetActiveFilter
  
  /** получение праметра комментариев, предварительная погрузка данных */
  function GetCommentOption($ident) {
   global $_GLOBALUSECOMMENTOPTIONS;   
   return (!$this->PreloadSectionInfoDataObj($this->GetCommType()) || 
   !isset($_GLOBALUSECOMMENTOPTIONS[$this->GetObjectType()][$this->GetCommType()][$ident])) ? false :
   $_GLOBALUSECOMMENTOPTIONS[$this->GetObjectType()][$this->GetCommType()][$ident];   	
  }//GetCommentOption
  
  /** получение имени объекта комментария */
  function GetObjectName($commsntinfo) {    
   switch ($this->GetObjectType()) {   
    //news
    case '0':   
	 if (isset($this->dump[$commsntinfo['commfor']])) { return $this->dump[$commsntinfo['commfor']]; }        
	 $obj = $this->control->db->GetLineArray($this->control->db->mPost(
	  "select newtitle from {$this->control->tables_list['newslist']} where iditem='{$commsntinfo['commfor']}' limit 1"
	 )); 
	 return $this->dump[$commsntinfo['commfor']] = ($obj) ? $obj['newtitle'] : '';		  
    break;
    
    //special pages
    case '1':    
     if (isset($this->dump[$commsntinfo['commfor']])) { return $this->dump[$commsntinfo['commfor']]; } 
	 $obj = $this->control->db->GetLineArray($this->control->db->mPost(
	  "select ttitle from {$this->control->tables_list['tplitemsl']} where iditem='{$commsntinfo['commfor']}' limit 1"
	 )); 
     return $this->dump[$commsntinfo['commfor']] = ($obj) ? $obj['ttitle'] : '';   
    break;    
   }
   return '';   	
  }//GetObjectName
  
  /** получение ссылки на объект */
  function GetObjectLink($commsntinfo) {
   switch ($this->GetObjectType()) {  
    //news
    case '0': 
      return W_SITEPATH.$this->GetCommentOption('pathobjects')."/{$commsntinfo['commtype']}/{$commsntinfo['commfor']}/";
    //special pages   
    case '1':
      return W_SITEPATH.$this->GetCommentOption('pathobjects');     
   } 
   return '';   
  }//GetObjectLink
    
  /** удалить все комментарии */
  protected function ActionDeleteAll() {
   return $this->control->db->mPost(
    "delete from {$this->control->tables_list['commtbl']} where commtype='".$this->GetCommType()."' and objectid='".
    $this->GetObjectType()."'".$this->GetActiveFilter()
   );	     	
  }//ActionDeleteAll
  
  /** удалить указанные элементы */
  protected function DeleteFormItem($id) {
   return $this->control->db->Delete($this->control->tables_list['commtbl'], "iditem='$id'", "1");   
  }//DeleteFormItem
  
  /** включить указанные элементы */
  protected function ActionToEnabledItem($id) {
   if (!$commrecord = $this->control->db->GetLineArray($this->control->db->mPost(
    "select * from {$this->control->tables_list['commtbl']} where iditem='$id' and commisactive='0' limit 1"
   ))) { return false; }
   //ok, get user author info
   if (!$userinfo_comment = $this->control->GetUserInfo($commrecord['username'])) { return false; }
   //restore last info items
   $this->control->db->UPDATEAction(
    'commtbl', array('comminform' => 0), 
    "commtype='{$commrecord['commtype']}' and objectid='{$commrecord['objectid']}' and ".
    "commfor='{$commrecord['commfor']}' and username='{$commrecord['username']}' and ".
    "iditem<>'{$commrecord['iditem']}'"
   );
   //activate comment
   $this->control->db->UPDATEAction('commtbl', array('commisactive' => 1), "iditem='{$commrecord['iditem']}'", "1");
   //comment is ok, inform current comment user
   if (!$this->control->isadminstatus) {
    $this->control->DoMailX(
    $userinfo_comment['useremail'], 
    $this->GetText('addnewcomment3', array(W_HOSTMYSITE, $this->GetObjectName($commrecord))), 
    $this->GetText('addcommenttomoderinformok', array($this->GetObjectName($commrecord), W_HOSTMYSITE,
     'http://'.W_HOSTMYSITE.'/'.$this->GetCommentOption('pathobjects').'/'.
	 $commrecord['commtype'].'/'.$commrecord['commfor'].'/'
    ))
    );	
   }
   //inform all users
   $result = $this->control->db->mPost(
    "select username from {$this->control->tables_list['commtbl']} where comminform='1' and ".
    "commtype='{$commrecord['commtype']}' and objectid='{$commrecord['objectid']}'".
    " and commfor='{$commrecord['commfor']}' and iditem<>'{$commrecord['iditem']}' ".
    "and username<>'{$commrecord['username']}'"
   );
   $list_users = '';
   while ($row = $this->control->db->GetLineArray($result)) {
    if ($this->strpos($list_users, " {$row['username']} ") == false && 
    $userinfo = $this->control->GetUserInfo($row['username'])) {
     $list_users .= " {$row['username']} ";
     //inform about new comment
	 $this->control->DoMailX(
      $userinfo['useremail'], 
      $this->GetText('addnewcommentinf', array(W_HOSTMYSITE, $this->GetObjectName($commrecord))), 
      $this->GetText('newcommentbeaddedtoitem', array(
       $commrecord['username'], $this->GetObjectName($commrecord), W_HOSTMYSITE, 
	   'http://'.W_HOSTMYSITE.'/'.$this->GetCommentOption('pathobjects').'/'.
	   $commrecord['commtype'].'/'.$commrecord['commfor'].'/'
      ))
     );	  	
    }	 	
   }
   return true;
  }//DeleteFormItem
  
  /** отключить указанные элементы */
  protected function ActionToDisabledItem($id) {
   return $this->control->db->UPDATEAction('commtbl', array('commisactive' => 0), "iditem='$id'", "1"); 	
  }//ActionToEnabledItem

  /** получение информации о комментарии */
  protected function GetCommRecord($id) {
   if (!$id = $this->CorrectSymplyString($id)) { return false; }
   return $this->control->db->GetLineArray($this->control->db->mPost(
    "select * from {$this->control->tables_list['commtbl']} where iditem='$id' limit 1"
   ));   
  }//GetCommRecord
    
  /** получение информации о комментарии изменения */
  protected function GetCommInformation() {
   return $this->result['modifyinfo'] = $this->GetCommRecord($_GET['modify']);	
  }//GetCommInformation
  
  /** изменение комментария */
  protected function ModifyComm() {
   if (!$this->result['modifyinfo']) { return $this->SetError('No record information found!'); }
   if (!$_POST['commentsource']) { return $this->SetError($this->GetText('setcommentsource')); }
   $this->control->db->UPDATEAction('commtbl', array(
    'commsource' => $this->control->strings->CorrectTextToDB($_POST['commentsource'])    
   ), "iditem='{$this->result['modifyinfo']['iditem']}'", "1");
   //success, reload record info
   return $this->GetCommInformation();		
  }//ModifyComm
  
  /** получение кол-ва комментариев */
  protected function GetCommCount($active=false) {  	
   return (!$this->dump['cachlistsectionsitems']) ? 0 : $this->control->GetCountInTable(
    'iditem', 'commtbl', "where commtype='".$this->GetCommType()."' and objectid='".$this->GetObjectType()."'".
    (($active === false) ? $this->GetActiveFilter() : " and commisactive='$active'")
   );	
  }//GetCommCount
  
  /** указанный идентификатор кол-ва комментариев */
  protected function GetCommentCountInNTypeListen($ntype) {
   return array(
    'active'   => $this->control->GetCountInTable(
      'iditem', 'commtbl', "where commtype='$ntype' and objectid='".$this->GetObjectType()."' and commisactive='1'"
    ),
    'inactive' => $this->control->GetCountInTable(
      'iditem', 'commtbl', "where commtype='$ntype' and objectid='".$this->GetObjectType()."' and commisactive='0'"
    )
   );  	
  }//GetCommentCountInNTypeListen 
  
  function _DoActionThisSection() { 
   //refresh sections list
   $this->GetCommentsSectionsListByNews();    
   //всего комментариев
   $this->result = array(
    'count'       => $this->GetCommCount(),    
    'countmoder'  => $this->GetCommCount(0),
    'countpublic' => $this->GetCommCount(1)
   );
   $this->result['allcount'] = $this->result['countmoder'] + $this->result['countpublic'];
   //изменение комментария
   if ($_GET['modify'] && $this->GetCommInformation()) {
   	if ($_POST['actionthissectionpost'] != 'do') {
	 $_POST['commentsource'] = $this->control->strings->CorrectTextForModify($this->GetResult('modifyinfo.commsource')); 
	 
	 $_POST['actionthissectionpost'] = 'do';
	 $_POST['actionthissectionpost_q'] = '1';	 	
	 return true;	
	} else { return ($_POST['actionnewprvmail'] == 'prev') ? true : $this->ModifyComm(); }
   }   
   //action from list
   $is_modified = false;
   switch ($_POST['actionlistmakes']) {
   	//удалить все элементы
	case 'dall': $this->ActionDeleteAll(); $is_modified = true; break; 
	//удалить выбранные элементы
	case 'delete': 
	 $this->TransformPostItems(array($this, 'DeleteFormItem'), $this->GetPerPageCount('commtbl'));
	 $is_modified = true;
	 break;
	//включить
	case 'enabled': 
	 $this->TransformPostItems(array($this, 'ActionToEnabledItem'), $this->GetPerPageCount('commtbl')); 
	 $is_modified = true;
	 break;
	//отключить
	case 'disabled': 
	 $this->TransformPostItems(array($this, 'ActionToDisabledItem'), $this->GetPerPageCount('commtbl')); 
	 $is_modified = true;
	 break;    	 
   }  
   //restore count
   if ($is_modified) { 
   	$this->result['count']       = $this->GetCommCount();
	$this->result['countmoder']  = $this->GetCommCount(0);
	$this->result['countpublic'] = $this->GetCommCount(1);
	$this->result['allcount']    = $this->result['countmoder'] + $this->result['countpublic'];   
   } 
   //listen
   $this->result['data'] = $this->GetTableData('commtbl', 
    "select * from {$this->control->tables_list['commtbl']} where commtype='".$this->GetCommType()."' and ".
    "objectid='".$this->GetObjectType()."'".$this->GetActiveFilter().
    " order by datecreate DESC", $this->result['count'], 'page', '', 
	'&ntype='.$this->GetCommType().'&active='.$this->GetActiveFilter(true)
   );   	
  }//_DoActionThisSection	
	
 }//w_admin_admcommentslist 
 //-------------------------------------------------------
 /** раздел параметров инструментов */
 class w_admin_admtoolsoptions extends w_admin_gen_obj {
  /* допустимые типы надстроек для обработки */	
  private $mathtypes = array(
   'boolean', 'integer', 'int', 'double', 'string', 'array', 'float'
  );
  /* строковые идентификаторы выбора */
  private $selectstrings = array(
   'descr', 'keywords', 'Ldescr', 'tdescr', 'metadesc'
  );
  protected 
   $result,
   $dump;
  var $resetstr = ''; 
  
  function __construct(w_Control_obj $control, $section_id) {
   global $_TOOLSNOLIMITACTIVATIONDATAINFO;		
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'admtoolsoptions';
   $this->result = array(
    'toolinfo' => ($this->ToolOptionExists($_GET['toolid'])) ? $_TOOLSNOLIMITACTIVATIONDATAINFO[$_GET['toolid']] : false
   );
   $this->dump = array();      	
  }//__construct
  
  /** существование надстроек */
  function ToolOptionExists($toolid, $name=false) {
   global $_TOOLSNOLIMITACTIVATIONDATAINFO;
   return ($name) ? isset($_TOOLSNOLIMITACTIVATIONDATAINFO[$toolid][$name]) : 
   isset($_TOOLSNOLIMITACTIVATIONDATAINFO[$toolid]);
  }//ToolOptionExists
  
  /** подкаталог на надстройку инструментов */
  protected function AddSubPath() {
   global $section_way, $_TOOLSNOLIMITACTIVATIONDATAINFO;
   if ($_GET['toolid'] && $this->ToolOptionExists($_GET['toolid'], 'descr')) {
	$section_way[] = array(
     'name' => $this->control->GetText('toolconfigureopt', array(
	  $this->GetText($_TOOLSNOLIMITACTIVATIONDATAINFO[$_GET['toolid']]['descr'])
	 )),
     'path' => W_SITEPATH.'account/'.$this->section_id.'/&toolid='.$_GET['toolid']
    );  
    $this->SetSectionInfo(
	 'stitle', $this->GetSectionInfo('stitle').' - '.
	 $this->GetText($_TOOLSNOLIMITACTIVATIONDATAINFO[$_GET['toolid']]['descr'])
	);
   }	
  }//AddSubPath
  
  /** тип переменной */
  function GetVarType($var) { return @strtolower(@gettype($var)); }
  
  /** расшифровка массива */
  function GetArrayAsString($arr) { return @implode("\n", $arr); }
  
  /** список строк */
  function GetStrings($default) {
   $result1 = array();
   if (isset($this->dump['stringslist'])) { $result1 = $this->dump['stringslist']; } else {   
    $list = $this->control->db->mPost(
     "select strident, strdescr from {$this->control->tables_list['stringstb']} where lang='".
	 $this->control->GetActiveLanguage()."'"
    );
    while ($row = $this->control->db->GetLineArray($list)) {
	 $result1[] = array(
	  'ident'    => $row['strident'],
	  'strdescr' => $row['strdescr'],
	  'isselect' => false
	 );	 
    }
    $this->dump['stringslist'] = $result1;
   }
   //def value
   $default_val = ($default) ? array(
	'ident'    => $default,
	'strdescr' => $this->GetText('defaultvaluedtr'),
	'isselect' => true
   ) : false;
   //correct descript
   if ($default_val) {
    foreach ($result1 as $res) {
	 if ($res['ident'] == $default) {
	  $default_val['strdescr'] = $res['strdescr'];
	  break;	  	
	 }	
    }
   }
   //init res
   $result = ($default) ? array($default_val) : array();
   $result[] = array(
    'ident'    => "0",
    'strdescr' => $this->GetText('emptyvaluestrp'),
    'isselect' => (!$default)
   ); 
   $result[] = array(
    'ident'    => "0",
	'strdescr' => '-----------------',
	'isselect' => false
   ); 
   //marge
   return @array_merge($result, $result1); 	
  }//GetStrings
    
  function _DoActionThisSection() { 
   global $_TOOLSNOLIMITACTIVATIONDATAINFO;			 	
   //add subpath
   $this->AddSubPath();   
   if (!$this->result['toolinfo']) { return true; }
   /* css */
   $this->AddSectionInfoNew('csslist', 'ui/old/jquery.ui.all.css');
   $this->AddSectionInfoNew('csslist', 'combobox.jquery.css');
   /* js */
   $this->AddSectionInfoNew('jslist', 'jquery.ui.custom.min.js');
   $this->AddSectionInfoNew('jslist', 'combobox.jquery.js');
   
   //check for reset options
   if ($_POST['dorestoresuboptions'] == 'do') {
   	$toolid = $this->CorrectSymplyString($this->strtolower('toolopt_'.$_GET['toolid']));
	//delete old options, and repaire default
	pr_options_preload::DeleteOption($toolid, $this->control);
	//pr_options_preload::QuickPreloadToolOptions($toolid, $this->control);
	//nex, load as defaut
	$_POST['actiontosavetoolopt'] = '';	
	$this->resetstr = $this->GetText('optionsisresetedrestpage');
   } 
   //выстраивание списка идентификаторов
   $this->result['fieldslist'] = array();
   $query_data = '';   
   foreach ($this->result['toolinfo'] as $name => $value) {
   	$valuetype = $this->GetVarType($value);
    if (!$valuetype || !@in_array($valuetype, $this->mathtypes)) { continue; }
    if (!$this->control->lang->IdentExists('toolopt_'.$name)) { continue; }
    //combine    
    $data = array(
     'toolid' => $_GET['toolid'],
	 'name'   => $name,
	 'type'   => $valuetype,
	 'value'  => $value,
	 'descr'  => $this->GetText('toolopt_'.$name),
	 'fname'  => $_GET['toolid'].'_'.$name,
	 'select' => @in_array($name, $this->selectstrings)
	);
	//check for modify
	if ($_POST['actiontosavetoolopt'] == 'do') {
	 $ok = false;
	 switch ($data['type']) {
	  case 'boolean': $data['value'] = $this->CheckPostValue($data['fname']); $ok = true; break;
	  default:
	   if (!isset($_POST[$data['fname']])) { break; }
	   $pst = trim($this->ClearBreake($_POST[$data['fname']], true, false));
	   $pst = (!$pst) ? '' : $pst;	    
	   $data['value'] = ($data['type'] == 'array') ? @explode("\n", $pst) : $this->CorrectSymplyString($pst); 
	   $ok = true; 	   
	   break;	
	 }
	 if ($ok && !$this->error) {  	
	  //if ($data['type'] != 'string' && $data['type'] != 'array' && !@settype($data['value'], $data['type'])) { 
	  // $this->SetError('Error in assign option type! ['.$data['descr'].']'); 
	  //} else {
	   //prepere data 
	   if (@is_array($data['value'])) {
	   	foreach ($data['value'] as &$item) { $item = $this->CorrectSymplyString($item); }
	   	$pst = $data['value'];
	   } else { $pst = $data['value']; }
	   //assign new item	   
	   $_TOOLSNOLIMITACTIVATIONDATAINFO[$_GET['toolid']][$name] = $data['value'];
	   //combine string	   	   
	   $pst = $this->control->db->EscapeString(@serialize($pst));
	   $query_data = $this->control->WriteOption($this->strtoupper($_GET['toolid'].'_'.$name), $pst, $query_data, false);
	  //}		  	
	 }	 	 	
	}
	//add for show	
	$this->result['fieldslist'][] = $data;	
   } 
   //save data
   if ($_POST['actiontosavetoolopt'] == 'do' && $query_data && !$this->error) {   	
    $optident = $this->strtolower('toolopt_'.$_GET['toolid']);    
	//check exists	
    if ($this->control->db->GetLineArray($this->control->db->mPost(
	 "select iditem from {$this->control->tables_list['opttbllst']} where optident='$optident' limit 1"
	))) {
	 if (!$this->control->db->UPDATEAction('opttbllst', array('optsource' => $query_data), "optident='$optident'", "1")) { 
	  return $this->SetError('Error in modify tool options!'); }
	} else {	    	
   	 if (!$this->control->db->INSERTAction('opttbllst', array(
	  'optident'  => $optident,
	  'optsource' => $query_data 
	 ))) { return $this->SetError('Error in write tool options!'); }
	}   	
   }        	
  }//_DoActionThisSection	
	
 }//w_admin_admtoolsoptions 
 //-------------------------------------------------------
 /** раздел таблицы строк */
 class w_admin_admstringstable extends w_admin_gen_obj { 			
  protected 
   $result;
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'admstringstablesec';  	
  }//__construct
  
  function GetLabelWhere($an=' and') {
   if (!$_GET['ilabel']) { return ''; }
   return "$an labelid='".$this->CorrectSymplyString($_GET['ilabel'])."'";    
  }//GetLabelWhere
  
  /** количество строк на 1 страницу */
  function GetPerPageCount($tablename) { return 15; }
    
  /** удалить все строки */
  protected function ActionDeleteAll() {
   return $this->control->db->mPost(
    "delete from {$this->control->tables_list['stringstb']}".$this->GetLabelWhere(' where')
   );	     	
  }//ActionDeleteAll
  
  /** удалить указанные элементы */
  protected function DeleteFormItem($id) {
   return $this->control->db->Delete($this->control->tables_list['stringstb'], "strident='$id'");   
  }//DeleteFormItem
     
  /** получение кол-ва строк */
  protected function GetStringsCount() {  	
   return $this->control->GetCountInTable(
    'iditem', 'stringstb', "where lang='".$this->control->GetActiveLanguage()."'".$this->GetLabelWhere()
   );	
  }//GetStringsCount
  
  /** выстраивание блока полей ввода строк */
  protected function CombineFieldsList(&$stringslistids) {
   global $_GLOBAL_LANGUAGE_LIST;
   $stringslistids = '';
   //current language	
   $lang = $this->control->GetActiveLanguage();
   $lang_descr = 
   (isset($_GLOBAL_LANGUAGE_LIST[$lang])) ? $_GLOBAL_LANGUAGE_LIST[$lang].' ('.$lang.')' : 'Unknow Language ('.$lang.')';
   $result = array();
   //add current language as first
   $result[] = array(
    'id'    => $lang,
    'descr' => $lang_descr,
    'fid1'  => 'name_'.$lang,
    'fid2'  => 'data_'.$lang,
    'name'  => (isset($_POST['name_'.$lang])) ? $this->CorrectSymplyString($_POST['name_'.$lang]) : '',
    'data'  => (isset($_POST['data_'.$lang])) ? $this->HTMLspecialChars($_POST['data_'.$lang]) : ''
   );
   $stringslistids .= '"name_'.$lang.'", "data_'.$lang.'"';
   //add all ather languages
   foreach ($_GLOBAL_LANGUAGE_LIST as $name => $value) {
   	if ($lang == $name) { continue; }
	$result[] = array(
     'id'    => $name,
     'descr' => (!$value) ? 'Unknow Language ('.$name.')' : $value.' ('.$name.')',
     'fid1'  => 'name_'.$name,
     'fid2'  => 'data_'.$name,
     'name'  => (isset($_POST['name_'.$name])) ? $this->CorrectSymplyString($_POST['name_'.$name]) : '',
     'data'  => (isset($_POST['data_'.$name])) ? $this->HTMLspecialChars($_POST['data_'.$name]) : ''
    );
	if ($stringslistids) { $stringslistids .= ', '; }
	$stringslistids .= '"name_'.$name.'", "data_'.$name.'"';	
   }
   return $result;   	
  }//CombineFieldsList
  
  protected function GetLabelID() {
   if (!$_POST['labelid'] && isset($_POST['labelid2']) && $_POST['labelid2']) {
    $_POST['labelid'] = $_POST['labelid2'];    
   }
   return $this->substr($this->CorrectSymplyString($_POST['labelid']), 0, 80);  
  }//GetLabelID
  
  /** добавление строки */
  protected function AddNewString() {
   global $_GLOBAL_LANGUAGE_LIST;
   //check ident
   if (!$_POST['ident'] = $this->strtolower($this->CorrectSymplyString($_POST['ident']))) {
	return $this->SetError($this->GetText('setidentnametoset'));
   }
   //check system ids
   if ($this->control->lang->IdentExists($_POST['ident'])) {
	return $this->SetError($this->GetText('issystemidentuse', array($_POST['ident'])));
   }   
   //check exists   
   if ($this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem from {$this->control->tables_list['stringstb']} where strident='{$_POST['ident']}' and ".
    "lang='".$this->control->GetActiveLanguage()."' limit 1"
   ))) { 
   	return $this->SetError($this->GetText('identisalrexists', array($_POST['ident']))); 
   }
   //correct
   $_POST['ident'] = $this->substr($_POST['ident'], 0, 120);
   //fetch list   
   foreach ($_GLOBAL_LANGUAGE_LIST as $name => $value) {
   	//name
   	$_POST['name_'.$name] = 
	(isset($_POST['name_'.$name])) ? $this->substr($this->CorrectSymplyString($_POST['name_'.$name]), 0, 150) : 'Unknow name';
   	//data
   	$_POST['data_'.$name] = (isset($_POST['data_'.$name])) ? $_POST['data_'.$name] : 'Unknow data';
   	//check for add
   	if (!$this->control->db->GetLineArray($this->control->db->mPost(
     "select iditem from {$this->control->tables_list['stringstb']} where strident='{$_POST['ident']}' and ".
     "lang='$name' limit 1"
    ))) {	 	
	 //add new
	 if (!$this->control->db->INSERTAction('stringstb', array(
	  'strident'  => $_POST['ident'],
	  'strdescr'  => $_POST['name_'.$name],
	  'lang'      => $name,
	  'strsource' => $this->control->db->EscapeString($_POST['data_'.$name]),
      'labelid'   => $this->GetLabelID(),	  
	 ))) { return $this->SetError('Error in add string ['.$this->control->db->GetError().'] for ['.$value.' ('.$name.')]'); }
    }
   } 
   $this->result['count'] = $this->GetStringsCount();   
   return $this->DeleteInActiveStrings($_POST['ident']);   	
  }//AddNewString
  
  /** получение информации изменения */
  protected function GetStringInformation() {
   global $_GLOBAL_LANGUAGE_LIST;
   if (!$_GET['modify'] = $this->CorrectSymplyString($_GET['modify'])) { return $this->result['modifyinfo'] = false; }
   $result = false;
   foreach ($_GLOBAL_LANGUAGE_LIST as $name => $value) {
	if ($item = $this->control->db->GetLineArray($this->control->db->mPost(
     "select * from {$this->control->tables_list['stringstb']} where strident='{$_GET['modify']}' and ".
     "lang='$name' limit 1"
    ))) {
     //get first string label
     if (!$result) { $this->result['modifyinfolabel'] = $item['labelid']; }
        
     //break if add, modify data
     if ($_POST['actionthissectionpost'] == 'do') {
	  $result = true;
	  break;	
	 }	 	
	 //get info
	 $_POST['name_'.$name] = $item['strdescr'];
	 $_POST['data_'.$name] = @stripcslashes($item['strsource']);
	 if (!$result) { $result = true; }	
	}	
   }  
   if ($result) { $_POST['ident'] = $_GET['modify']; } 
   return $this->result['modifyinfo'] = $_POST['ident'];	
  }//GetStringInformation
  
  /** удаление неактивных строк (несуществующих языков) */
  protected function DeleteInActiveStrings($ident) {
   global $_GLOBAL_LANGUAGE_LIST;
   $result = $this->control->db->mPost(
    "select iditem, lang from {$this->control->tables_list['stringstb']} where strident='$ident'"
   );
   while ($row = $this->control->db->GetLineArray($result)) {
	if ($row['lang'] != W_LANGUAGEDEFAULT && !isset($_GLOBAL_LANGUAGE_LIST[$row['lang']])) {
	 $this->control->db->Delete($this->control->tables_list['stringstb'], "iditem='{$row['iditem']}'", "1");	
	}	
   }
   return true;   	
  }//DeleteInActiveStrings
  
  /** изменение строки */
  protected function ModifyString() {
   global $_GLOBAL_LANGUAGE_LIST;
   if (!$this->result['modifyinfo']) { return $this->SetError('No identifier found!'); } 
   foreach ($_GLOBAL_LANGUAGE_LIST as $name => $value) {
   	//name
   	$_POST['name_'.$name] = 
	(isset($_POST['name_'.$name])) ? $this->substr($this->CorrectSymplyString($_POST['name_'.$name]), 0, 150) : 'Unknow name';
   	//data
   	$_POST['data_'.$name] = (isset($_POST['data_'.$name])) ? $_POST['data_'.$name] : 'Unknow data'; 	
   	//check for add
   	if (!$item = $this->control->db->GetLineArray($this->control->db->mPost(
     "select iditem from {$this->control->tables_list['stringstb']} where strident='{$this->result['modifyinfo']}' and ".
     "lang='$name' limit 1"
    ))) {	 	
	 //add new
	 if (!$this->control->db->INSERTAction('stringstb', array(
	  'strident'  => $this->result['modifyinfo'],
	  'strdescr'  => $_POST['name_'.$name],
	  'lang'      => $name,
	  'strsource' => $this->control->db->EscapeString($_POST['data_'.$name]),
      'labelid'   => $this->GetLabelID(),	  
	 ))) { return $this->SetError('Error in add string ['.$this->control->db->GetError().'] for ['.$value.' ('.$name.')]'); }
    } else {
	 //update string
	 $this->control->db->UPDATEAction('stringstb', array(
	  'strdescr'  => $_POST['name_'.$name],
	  'lang'      => $name,
	  'strsource' => $this->control->db->EscapeString($_POST['data_'.$name]),
      'labelid'   => $this->GetLabelID(),	  
	 ), "iditem='{$item['iditem']}'", "1");		
	}   	
   }
   return $this->DeleteInActiveStrings($this->result['modifyinfo']);    	
  }//ModifyString
  
  function _DoActionThisSection() { 		 	
   //всего строк
   $this->result = array('count' => $this->GetStringsCount());
   //изменение строки
   if ($_GET['new'] && $_GET['modify'] && $this->GetStringInformation()) {
   	//блок элементов
    $this->result['blockcheck'] = '';
    $this->result['blocklist'] = $this->CombineFieldsList($this->result['blockcheck']);
	//action    	
	return ($_POST['actionthissectionpost'] != 'do') ? true : $this->ModifyString();
   }   
   //блок элементов
   $this->result['blockcheck'] = '';
   $this->result['blocklist'] = $this->CombineFieldsList($this->result['blockcheck']);
   //добавление строки   
   if ($_GET['new']) { return ($_POST['actionthissectionpost'] != 'do') ? true : $this->AddNewString(); }  
   //action from list
   $is_modified = false;
   switch ($_POST['actionlistmakes']) {
   	//удалить все элементы
	case 'dall': $this->ActionDeleteAll(); $is_modified = true; break; 
	//удалить выбранные элементы
	case 'delete': 
	 $this->TransformPostItems(array($this, 'DeleteFormItem'), $this->GetPerPageCount('stringstb'));
	 $is_modified = true;
	 break;   	 
   }  
   //restore count
   if ($is_modified) { $this->result['count'] = $this->GetStringsCount(); } 
   //listen
   $this->result['data'] = $this->GetTableData('stringstb', 
    "select * from {$this->control->tables_list['stringstb']} where lang='".$this->control->GetActiveLanguage()."'".
    $this->GetLabelWhere()." order by strident", $this->result['count'], 'page', '', 
    (($_GET['ilabel']) ? '&ilabel='.$this->CorrectSymplyString($_GET['ilabel']) : '')
   );   	
  }//_DoActionThisSection
  
  function GetLabelsList() {
   if (isset($this->result['labelslist'])) { return $this->result['labelslist']; }  
   $list = $this->control->db->mPost(
    "select labelid from {$this->control->tables_list['stringstb']} where lang='".$this->control->GetActiveLanguage()."'".
    " order by labelid"
   ); 
   $this->result['labelslist'] = array();
   while ($row = $this->control->db->GetLineArray($list)) {
    
    if ($row['labelid'] && !@in_array($row['labelid'], $this->result['labelslist']))
     $this->result['labelslist'][] = $row['labelid'];  
   
   } 
   return $this->result['labelslist']; 
  }//GetLabelsList	
	
 }//w_admin_admstringstable 
 //-------------------------------------------------------
 /** раздел надстроек сайта */
 class w_admin_admgeneralsuboptions extends w_admin_gen_obj {
  const GENERALSUBOPTIONSID = 'general_sub_options';	 			
  protected 
   $result,
   $dump;
  var $resetstr = ''; 
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'admgeneralsubopt';
   $this->dump = array();  	
  }//__construct
  
  /** список строк */
  function GetStrings($default) {
   $result1 = array();
   if (isset($this->dump['stringslist'])) { $result1 = $this->dump['stringslist']; } else {   
    $list = $this->control->db->mPost(
     "select strident, strdescr from {$this->control->tables_list['stringstb']} where lang='".
	 $this->control->GetActiveLanguage()."'"
    );
    while ($row = $this->control->db->GetLineArray($list)) {
	 $result1[] = array(
	  'ident'    => $row['strident'],
	  'strdescr' => $row['strdescr'],
	  'isselect' => false
	 );	 
    }
    $this->dump['stringslist'] = $result1;
   }
   //def value
   $default_val = ($default) ? array(
	'ident'    => $default,
	'strdescr' => $this->GetText('defaultvaluedtr'),
	'isselect' => true
   ) : false;
   //correct descript
   if ($default_val) {
    foreach ($result1 as $res) {
	 if ($res['ident'] == $default) {
	  $default_val['strdescr'] = $res['strdescr'];
	  break;	  	
	 }	
    }
   }
   //init res
   $result = ($default) ? array($default_val) : array();
   $result[] = array(
    'ident'    => "0",
    'strdescr' => $this->GetText('emptyvaluestrp'),
    'isselect' => (!$default)
   ); 
   $result[] = array(
    'ident'    => "0",
	'strdescr' => '-----------------',
	'isselect' => false
   ); 
   //marge
   return @array_merge($result, $result1); 	
  }//GetStrings
  
  function _DoActionThisSection() {
   global $_GLOBALDINAMICCONSTOPTIONS;	 		 	
   /* css */
   $this->AddSectionInfoNew('csslist', 'ui/old/jquery.ui.all.css');
   $this->AddSectionInfoNew('csslist', 'combobox.jquery.css');
   /* js */
   $this->AddSectionInfoNew('jslist', 'jquery.ui.custom.min.js');
   $this->AddSectionInfoNew('jslist', 'combobox.jquery.js');
   //check for reset suboptions
   if ($_POST['dorestoresuboptions'] == 'do') {
	//delete old options, and repaire default
	pr_options_preload::DeleteOption(self::GENERALSUBOPTIONSID, $this->control);
	//pr_options_preload::QuickPreloadGeneralSiteSubOptions($this->control);
	//nex, load as defaut
	//if (isset($_POST['actiontosavetoolopt'])) { unset($_POST['actiontosavetoolopt']); }
	$_POST['actiontosavetoolopt'] = '';	
	$this->resetstr = $this->GetText('optionsisresetedrestpage');
   }
   //выстраиваем блок элементов
   $this->result['data'] = array(); $query_data = ''; 
   foreach ($_GLOBALDINAMICCONSTOPTIONS as $name => $item) {  	
   	if (!$name || !$item['type'] || !@in_array($item['type'], pr_options_preload::$gensuboptions)) { continue; }   	
	if (!@defined($name) || !$this->control->lang->IdentExists($name.'_dsc')) { continue; }	
	//combine    
    $data = array(
	 'name'   => $name,
	 'value'  => @constant($name),
	 'descr'  => $this->GetText($name.'_dsc'),
	 'type'   => $item['type']
	);
	if ($_POST['actiontosavetoolopt'] == 'do') {
	 //корректировка данных
	 switch ($item['type']) {
	  //список
	  case 'string':
	   $_POST[$name]  = $this->CorrectSymplyString($_POST[$name]);
	   $_POST[$name]  = (!$_POST[$name]) ? '' : $_POST[$name];	 
	   $data['value'] = $_POST[$name];
	  break;
	  //логическое
	  case 'boolean': $data['value'] = $this->CheckPostValue($name); break;
	  //остальные воспринимать как строки (универсальные, числа или строки определяются автоматически)
	  default: $data['value'] = $_POST[$name] = $this->CorrectSymplyString($_POST[$name]); break;		
	 }	 	 	 
	 //combine string	   	   
	 $pst = $this->control->db->EscapeString(@serialize($_POST[$name]));
	 $query_data = $this->control->WriteOption($this->strtoupper($name), $pst, $query_data, false);		
	}
	$this->result['data'][] = $data;	
   }
   if ($_POST['actiontosavetoolopt'] == 'do' && $query_data && !$this->error) {
	$optident = self::GENERALSUBOPTIONSID;    
	//check exists	
    if ($this->control->db->GetLineArray($this->control->db->mPost(
	 "select iditem from {$this->control->tables_list['opttbllst']} where optident='$optident' limit 1"
	))) {
	 if (!$this->control->db->UPDATEAction('opttbllst', array('optsource' => $query_data), "optident='$optident'", "1")) { 
	  return $this->SetError('Error in modify options!'); }
	} else {	    	
   	 if (!$this->control->db->INSERTAction('opttbllst', array(
	  'optident'  => $optident,
	  'optsource' => $query_data 
	 ))) { return $this->SetError('Error in write options!'); }
	}
   }
   return true;    	
  }//_DoActionThisSection	
	
 }//w_admin_admgeneralsuboptions 
 //-------------------------------------------------------
 /** раздел перенаправлений ссылок */
 class w_admin_admredirectlktable extends w_admin_gen_obj { 			
  protected 
   $result;
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'admredirectlktable';  	
  }//__construct
  
  /** количество ссылок на 1 страницу */
  function GetPerPageCount($tablename) { return 10; }
    
  /** удалить все ссылки */
  protected function ActionDeleteAll() {
   return $this->control->db->mPost("delete from {$this->control->tables_list['redirtbl']}");	     	
  }//ActionDeleteAll
  
  /** удалить указанные элементы */
  protected function DeleteFormItem($id) {
   return $this->control->db->Delete($this->control->tables_list['redirtbl'], "iditem='$id'", "1");   
  }//DeleteFormItem
     
  /** получение кол-ва ссылок */
  protected function GetLinksCount() { return $this->control->GetCountInTable('iditem', 'redirtbl'); } 
  
  /** добавление ссылки */
  protected function AddNewLink() {
   //check ident
   if (!$_POST['href'] = $this->CorrectSymplyString($_POST['href'])) {
	return $this->SetError($this->GetText('setlinkhreftoredir'));
   }  
   $_POST['href'] = $this->substr($_POST['href'], 0, 240);
   //check exists   
   if ($item = $this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem from {$this->control->tables_list['redirtbl']} where Lower(rhref)=Lower('{$_POST['href']}') limit 1"
   ))) { 
   	return $this->SetError($this->GetText('linkhrefisexistsnw', array($item['iditem']))); 
   }
   //ok, add action
   if (!$this->control->db->INSERTAction('redirtbl', array(
    'datecreate' => $this->GetThisDateTime(),
    'rhref'      => $_POST['href'],
    'rdescr'     => (!$_POST['descr']) ? 'No name' : $this->substr($this->CorrectSymplyString($_POST['descr']), 0, 100)    
   ))) { return $this->SetError('Error in create new href data..'); }
   //ok recreate count data    
   $this->result['count'] = $this->GetLinksCount();   
   return true;   	
  }//AddNewLink 
  
  /** получение информации изменения */
  protected function GetLinkInformation() {
   if (!$_GET['modify'] = $this->CorrectSymplyString($_GET['modify'])) { return $this->result['modifyinfo'] = false; }
   $this->result['modifyinfo'] = $this->control->db->GetLineArray($this->control->db->mPost(
    "select * from {$this->control->tables_list['redirtbl']} where iditem='{$_GET['modify']}' limit 1"
   ));
   if ($_POST['actionthissectionpost'] != 'do' && $this->result['modifyinfo']) {
	$_POST['href']  = $this->result['modifyinfo']['rhref'];
	$_POST['descr'] = $this->result['modifyinfo']['rdescr'];
   } 
   return $this->result['modifyinfo'];	
  }//GetLinkInformation
  
  /** изменение ссылки */
  protected function ModifyLink() {
   if (!$this->result['modifyinfo']) { return $this->SetError('No identifier found!'); } 
   //check ident
   if (!$_POST['href'] = $this->CorrectSymplyString($_POST['href'])) {
	return $this->SetError($this->GetText('setlinkhreftoredir'));
   }  
   $_POST['href'] = $this->substr($_POST['href'], 0, 240);
   //check exists   
   if ($item = $this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem from {$this->control->tables_list['redirtbl']} where iditem<>'{$this->result['modifyinfo']['iditem']}' ".
	"and Lower(rhref)=Lower('{$_POST['href']}') limit 1"
   ))) { 
   	return $this->SetError($this->GetText('linkhrefisexistsnw', array($item['iditem']))); 
   }
   //ok, update action
   if (!$this->control->db->UPDATEAction('redirtbl', array(
    'rhref'      => $_POST['href'],
    'rdescr'     => (!$_POST['descr']) ? 'No name' : $this->substr($this->CorrectSymplyString($_POST['descr']), 0, 100)    
   ), "iditem='{$this->result['modifyinfo']['iditem']}'", "1")) { return $this->SetError('Error in update href.'); }
   //ok, reload info
   return $this->GetLinkInformation();    	
  }//ModifyLink
  
  function _DoActionThisSection() { 		 	
   //всего ссылок
   $this->result = array('count' => $this->GetLinksCount());
   //изменение ссылки
   if ($_GET['new'] && $_GET['modify'] && $this->GetLinkInformation()) {
   	if ($_POST['actionthissectionpost'] != 'do') {
	 $_POST['href']  = $this->GetResult('modifyinfo.rhref');
	 $_POST['descr'] = $this->GetResult('modifyinfo.rdescr'); 
	 
	 $_POST['actionthissectionpost'] = 'do';
	 $_POST['actionthissectionpost_q'] = '1';	 	
	 return true;	
	} else { return $this->ModifyLink(); }
   }   
   //добавление ссылки   
   if ($_GET['new']) { return ($_POST['actionthissectionpost'] != 'do') ? true : $this->AddNewLink(); }  
   //action from list
   $is_modified = false;
   switch ($_POST['actionlistmakes']) {
   	//удалить все элементы
	case 'dall': $this->ActionDeleteAll(); $is_modified = true; break; 
	//удалить выбранные элементы
	case 'delete': 
	 $this->TransformPostItems(array($this, 'DeleteFormItem'), $this->GetPerPageCount('redirtbl'));
	 $is_modified = true;
	 break;   	 
   }  
   //restore count
   if ($is_modified) { $this->result['count'] = $this->GetLinksCount(); } 
   //listen
   $this->result['data'] = $this->GetTableData('redirtbl', 
    "select * from {$this->control->tables_list['redirtbl']} order by datecreate DESC",	$this->result['count']
   );   	
  }//_DoActionThisSection	
	
 }//w_admin_admredirectlktable 
 //-------------------------------------------------------
 /** раздел управления пользователями */
 class w_admin_admuserslisten extends w_admin_gen_obj { 			
  protected 
   $result,
   $ustable;
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'admuserslistenstrtbl';
   $this->ustable = $this->control->tables_list['users']; 
   if ($_GET['lcstr']) { $_GET['lcstr'] = $this->CorrectSymplyString($_GET['lcstr']); }
   if (!$_GET['perpage'] || !@is_numeric($_GET['perpage']) || $_GET['perpage'] < 1 || $_GET['perpage'] > 1000) {
    $_GET['perpage'] = 10;
   } 	
  }//__construct
  
  /** количество пользователей на 1 страницу */
  function GetPerPageCount($tablename) { return $this->CorrectSymplyString($_GET['perpage']); }
  
  /** условие отбора */
  protected function GetWhere() {
   $where = '';
   switch ($_GET['filter1']) {
	case '1': $where = " where confreg='1' and userlocked=''"; break;
	case '2': $where = " where userlocked<>''"; break;
	case '3': $where = " where confreg='0'"; break;
	case '4': $where = " where (confreg='0') or (userlocked<>'')"; break;
	case '5': $where = " where purcedata<=0"; break;
	case '6': $where = " where purcedata>0"; break;
    case '7': $where = " where LOCATE('{$_GET['lcstr']}', username)<>0"; break;
    case '8': $where = " where LOCATE('{$_GET['lcstr']}', useremail)<>0"; break;	
    case '9': $where = " where username='{$_GET['lcstr']}'"; break;
   }  	
   return $where;	
  }//GetWhere
  
  /** условие сортировки */
  protected function GetOrder() {
   $order = ' order by username';
   switch ($_GET['filter2']) {
	case '1': $order = ' order by username DESC'; break;
	case '2': $order = ' order by useremail'; break;
	case '3': $order = ' order by useremail DESC'; break;
	case '4': $order = ' order by datereg'; break;
	case '5': $order = ' order by datereg DESC'; break;
	case '6': $order = ' order by datelastin'; break;
	case '7': $order = ' order by datelastin DESC'; break;
	case '8': $order = ' order by purcedata'; break;
	case '9': $order = ' order by purcedata DESC'; break;	
   }
   return $order;   	
  }//GetOrder
  
  /** получение кол-ва пользователей */
  protected function GetUsersCount($def=false) { 
   return $this->control->GetCountInTable('iduser', 'users', ($def) ? '' : $this->GetWhere()); 
  }//GetUsersCount 
  
  /** получение идентификатора пути */
  function GetPath1() {
   $list = '';
   if ($_GET['filter1'] && @is_numeric($_GET['filter1'])) { $list .= '&filter1='.$_GET['filter1']; }	
   if ($_GET['filter2'] && @is_numeric($_GET['filter2'])) { $list .= '&filter2='.$_GET['filter2']; }
   if ($_GET['lcstr']) { $list .= '&lcstr='.$_GET['lcstr']; }
   if ($_GET['perpage'] && $_GET['perpage'] != 10) { $list .= '&perpage='.$_GET['perpage']; }	
   return $list;	
  }//GetPath1
  
  /** кол-во комментариев пользователя */
  function GetCommentsCountByUser($username) {
   return $this->control->GetCountInTable('iditem', 'commtbl', "where username='$username'");   	
  }//GetCommentsCountByUser
  
  /** balance action , no messages, by default action */
  protected function ActionToBalanceDo(&$userinfo, $summ, $type) {
   if (!$userinfo) { return 'No user identifier found!'; }
   if (!@is_numeric($summ)) { return $this->GetText('errorpaycheckpar'); }
   switch ($type) {
	case 'sub':
	 $userinfo['purcedata']-=$summ;
	 if ($userinfo['purcedata'] < 0) { $userinfo['purcedata'] = 0.00; }	 
	break;
	case 'add': $userinfo['purcedata']+=$summ; break;
	case 'set': $userinfo['purcedata'] = $summ; break;	
	default: return 'Unknow action type `'.$type.'`';
   }
   //update record
   if (!$this->control->db->UPDATEAction('users', array(
    'purcedata' => $userinfo['purcedata']
   ), "iduser='{$userinfo['iduser']}'", "1")) { return 'Error in update balance value on user record!'; }
   return '';
  }//ActionToBalanceDo
  
  /** action from ajax mode */
  protected function ActionAjaxMode() {
   $userinfo = $this->control->GetUserInfo($_POST['usid'], true);
   $_POST['value'] = $this->CorrectSymplyString($_POST['value']);   
   if (!$userinfo) {
	print 'alert("User with specified identifier not found!");';	
   } else {   
   	$this->SetError(''); 	
    //switch action type
    $ident = '';
    switch ($_POST['type']) {
	 //change email
	 case '1': 
	  $ident = 'email';
	  //check email
	  if (!$this->validmail($_POST['value'])) { $this->SetError('E-mail is invalid!'); break; }
	  //check alridy exists
	  if ($this->control->db->GetLineArray($this->control->db->mPost(
	   "select iduser from {$this->ustable} where iduser<>'{$userinfo['iduser']}' and ".
	   "Lower(useremail)=Lower('{$_POST['value']}') limit 1"
	  ))) { $this->SetError($this->GetText('emailalridyisset')); break; }
	  //ok, action
	  if (!$this->control->db->UPDATEAction('users', array(
	   'useremail' => $_POST['value']
	  ), "iduser='{$userinfo['iduser']}'", "1")) { $this->SetError('Error in modify email record!'); break; }
	  //ok replace
	  print '$("#email_source'.$_POST['usid'].'").html("'.$_POST['value'].'");';	
	 break;
	 //change url
	 case '2':
	  $ident = 'url';
	  if ($_POST['value'] == '('.$this->GetText('noresulttext').')') { $_POST['value'] = ''; }
	  //action
	  if (!$this->control->db->UPDATEAction('users', array(
	   'usersite' => $_POST['value']
	  ), "iduser='{$userinfo['iduser']}'", "1")) { $this->SetError('Error in modify url record!'); break; }
	  //ok replace
	  print '$("#url_source'.$_POST['usid'].'").html("'.
	  ((!$_POST['value']) ? '('.$this->GetText('noresulttext').')' : $_POST['value']).
	  '");';
	 break;
	 //balance change
	 case '3':
	  $ident = 'balance';
	  $this->SetError(($this->CheckPostValue('checkwithmessages') ? 
	   $this->control->MoneyProcess(
	    $userinfo, $_POST['pricedescr'], $userinfo['iduser'] + 15, $_POST['value'], false, $_POST['balanceaction'], true, true
	   ) : $this->ActionToBalanceDo($userinfo, $_POST['value'], $_POST['balanceaction'])
	  ));
	  if ($this->error) { break; }
	  if ($this->CheckPostValue('checkwithmessages')) {
	   if (!$userinfo = $this->control->GetUserInfo($userinfo['iduser'], true)) {
		$this->SetError('Error in get user info!'); break;
	   }	
	  }
	  $userinfo['purcedata']+=0.00;
	  //action to replace
	  print '$("#balance_source'.$_POST['usid'].'").html("'.$userinfo['purcedata'].'");';
	  //print '$("#balance_source'.$_POST['usid'].'").css("color", "'.(($userinfo['purcedata']) ? '#008000' : '#000000').'");'; 
	 break;
     
     /* history tarnsactions */
     case '4':     
      $this->control->smarty->assign('username', $_POST['value']);
      print $this->control->smarty->fetch('adm_account/items/users-money-history-list.tpl');       
      exit;
     break;
     
     /* seo panel links */
     case '5':
      $this->control->smarty->assign('username', $_POST['value']);
      $this->control->smarty->assign('userid', $_POST['usid']);
      print $this->control->smarty->fetch('adm_account/items/users-seo-panel-sites.tpl');
      exit;     
     break;
     
     /* delete sites from seo panel */
     case '6':
      $s = $_POST['value'];
      $_POST['value'] = @explode(',', $_POST['value']);
      $_POST['usid'] = $this->CorrectSymplyString($_POST['usid']);
           
      foreach ($_POST['value'] as $item) {       
        $item = $this->CorrectSymplyString($item);
        $this->control->db->Delete($this->control->tables_list['psitelist'], 
        "userid='{$_POST['usid']}' and iditem='$item'", "1");       
      }     
            
      print $s;
      exit;
     break;
     
     /* delete user from group */
     case '7':
            
      $_POST['groupiditem'] = $this->CorrectSymplyString($_POST['groupiditem']);
      $_POST['iduser'] = $this->CorrectSymplyString($_POST['iduser']);
      $_POST['iditem'] = $this->CorrectSymplyString($_POST['iditem']);    
      
      $this->control->db->Delete($this->control->tables_list['groupusrs'], "iditem='{$_POST['iditem']}'", "1");    
      
      print "{groupiditem:'{$_POST['groupiditem']}', iduser:'{$_POST['iduser']}', iditem:'{$_POST['iditem']}'}";
      exit;
     break;
     
     /*  */
     
         
     	 
	 //unknow command
	 default: print 'alert("Unknow command identifier!");'; break;
    }
   }
   print 'alert("'.(($this->error) ? $this->error : $this->GetText('optionsissavedok')).'");';	 
   //restore all process labels 
   print '$("#'.$ident.'_link'.$_POST['usid'].'").html("'.$this->GetText('modifylabeliditemstr').'");';
   print '$("#'.$ident.'_'.$_POST['usid'].'").html("");';  	
   exit;
  }//ActionAjaxMode
  
  function GetSeoPanelSites($sectionid, $userid) {    
   $list = $this->control->db->mPost(
    "select * from {$this->control->tables_list['psitelist']} where userid='$userid'".
    (($sectionid) ? " and sectionid='$sectionid'" : "")." order by shortident ASC"
   );  
   $res = array();
   $index = 0;
   while ($row = $this->control->db->GetLineArray($list)) {
    $row['bgcolorsetbe'] = $index;
    $index = !$index;
    $res[] = $row;
   }
   return $res;      
  }//GetSeoPanelSites
  
  function GetSeoPanelSitesCount($userid) {
    return $this->control->GetCountInTable('iditem', 'psitelist', "where userid='$userid'");
  }//GetSeoPanelSitesCount
  
  /** добавление нового пользователя */
  protected function AddNewUser() {
   $this->SetError($this->control->AddNewUser(
    $_POST['newlogin'], $_POST['newemail'], $_POST['newpass'], $_POST['newsite'], '', '2', 1, '2', true
   ));
   if (!$this->error) { $this->result['count'] = $this->GetUsersCount(); }
   return !$this->error;
  }//AddNewUser
  
  /** удаление пользователя */
  protected function DeleteFormItem($id) {
   if (!$userinfo = $this->control->GetUserInfo($id, true)) { return false; }
   //remove all comments
   $this->control->db->Delete($this->control->tables_list['commtbl'], "username='{$userinfo['username']}'");
   //remove all finance records
   $this->control->db->Delete($this->control->tables_list['moneyhis'], "username='{$userinfo['username']}'");
   //remove all mail
   $this->control->db->Delete($this->control->tables_list['insmail'], "fromuser='{$userinfo['username']}'");
   //remove all referals
   $this->control->db->Delete($this->control->tables_list['refersl'], "touserid='{$userinfo['iduser']}'"); 
   //remove data from seo panel
   $this->control->db->Delete($this->control->tables_list['psitelist'], "userid='{$userinfo['iduser']}'");
   $this->control->db->Delete($this->control->tables_list['poptionst'], "userid='{$userinfo['iduser']}'");
   $this->control->db->Delete($this->control->tables_list['pparamstb'], "userid='{$userinfo['iduser']}'");
   $this->control->db->Delete($this->control->tables_list['psections'], "username='{$userinfo['username']}'");
   //remove api records
   $this->control->db->Delete($this->control->tables_list['xmpapitemp'], "userid='{$userinfo['iduser']}'");
   //remove from groups
   $this->control->db->Delete($this->control->tables_list['groupusrs'], "userid='{$userinfo['iduser']}'");      
   //remove all user banners
   require_once W_LIBPATH.'/bunners.lib.php';
   $list = $this->control->db->mPost(
    "select iditem,rname from {$this->control->tables_list['bunnerlist']} where userid='{$userinfo['iduser']}'"
   );
   while ($row = $this->control->db->GetLineArray($list)) {
    w_adv_bunners_object::RemoveBanner($row, $this->control);
   } 
   //remove user info
   $this->control->DeleteUserAvatar($userinfo['username']);
   $this->control->db->Delete($this->control->tables_list['users'], "iduser='{$userinfo['iduser']}'", "1");   
   return true;	
  }//DeleteFormItem
  
  /** разблокировать */
  protected function EnabledFormItem($id) {
   return $this->control->db->UPDATEAction('users', array('userlocked' => ''), "iduser='$id' and userlocked<>''", "1");	
  }//EnabledFormItem
  
  /** заблокировать */
  protected function DisabledFormItem($id) {
   return $this->control->db->UPDATEAction('users', array('userlocked' => $_POST['disabledstr']), "iduser='$id'", "1"); 	
  }//DisabledFormItem
  
  /** экспорт данных */
  protected function DoExportData() {
   $file = '';
   $result = $this->control->db->mPost("select * from {$this->ustable}".$this->GetWhere().$this->GetOrder());
   while ($row = $this->control->db->GetLineArray($result)) {
	$line = $_POST['saveformat'];
	$line = @str_replace('[name]',    $row['username'], $line);
	$line = @str_replace('[email]',   $row['useremail'], $line);
	$line = @str_replace('[url]',     $row['usersite'], $line);
	$line = @str_replace('[balance]', $row['purcedata'], $line);
	$line = @str_replace('[n]', "\n", $line);
	$line = @str_replace('[lock]',    $row['userlocked'], $line);
	$line = @str_replace('[date]',    $row['datereg'], $line);
	$line = @str_replace('[datex]',   $row['datelastin'], $line);
	$file .= $line."\n";	
   }
   Header("Pragma: no-cache"); 
   Header("Cache-control: no-cache, must-revalidate"); 
   Header("Expires: Mon, 01 Jan 1990 01:01:01 GMT"); 
   Header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");
   header('Content-Type: application/octetstream');
   header("Accept-Ranges: bytes");
   header("Content-Length: ".$this->strlen($file)); 
   header('Content-Disposition: attachment; filename="usersinfo_'.$this->GetThisDate().'.txt";');
   print $file;
   exit;	
  }//DoExportData
  
  function _DoActionThisSection() { 		 	
   if ($this->IsAjax()) { return $this->ActionAjaxMode(); }  
   //export
   if ($_POST['saveitemsaction'] == 'do') { return $this->DoExportData(); }   
   /* css */
   $this->AddSectionInfoNew('csslist', 'ui/jquery-ui-1.8.11.custom.css');
   $this->AddSectionInfoNew('csslist', 'panel/css.css');
   /* js */
   $this->AddSectionInfoNew('jslist', 'jquery.ui.custom.min.js');  
   $this->result = array();
   //count
   $this->result['count'] = $this->GetUsersCount();
   //count all
   if ($this->GetWhere()) {	$this->result['count_all'] = $this->GetUsersCount(true); }   
   //add new user
   if ($_GET['new']) { return ($_POST['newuseraction'] != 'do') ? true : $this->AddNewUser(); }
   
   //action from list
   $is_modified = false;
   switch ($_POST['actionlistmakes']) { 
	//удалить выбранные элементы
	case 'delete': 
	 $this->TransformPostItems(array($this, 'DeleteFormItem'), $this->GetPerPageCount('users'));
	 $is_modified = true;
	break;
	//разблокировать
	case 'enabled': $this->TransformPostItems(array($this, 'EnabledFormItem'), $this->GetPerPageCount('users')); break;
    //заблокировать
	case 'disabled':
	 $_POST['disabledstr'] = $this->substr($this->CorrectSymplyString($_POST['disabledstr']), 0, 250);
	 if (!$_POST['disabledstr']) { break; }
	 $this->TransformPostItems(array($this, 'DisabledFormItem'), $this->GetPerPageCount('users')); break;	 
	break;	   	 
    //активировать e-mail
    case 'emailactive1': 
      $this->TransformPostItems(array($this, 'ActivateEmailItem'), $this->GetPerPageCount('users')); 
    break;
    //деактивировать e-mail
    case 'emailactive0': 
      $this->TransformPostItems(array($this, 'DeActivateEmailItem'), $this->GetPerPageCount('users'));
    break; 
    //добавление в группы
    case 'settogroup':
     if ($_POST['groupaddparam'] && @is_numeric($_POST['groupaddparam'])) {     
       if ($this->control->db->GetLineArray($this->control->db->mPost(
        "select iditem from {$this->control->tables_list['glbsectlst']} where iditem='{$_POST['groupaddparam']}' limit 1"
       ))) {        
        $this->TransformPostItems(array($this, 'AddUserToGroup'), $this->GetPerPageCount('users'));
       }        
     }    
    break;   
   }   
   //restore count
   if ($is_modified) { 
   	$this->result['count'] = $this->GetUsersCount();
	if ($this->GetWhere()) { $this->result['count_all'] = $this->GetUsersCount(true); }    
   }  
   //listen
   $this->result['data'] = $this->GetTableData('users', 
    "select * from {$this->ustable}".$this->GetWhere().$this->GetOrder(),	
	$this->result['count'], 'page', '', $this->GetPath1()
   );   	
  }//_DoActionThisSection	
  
  /** активировать e-mail */
  protected function ActivateEmailItem($id) {
   return $this->control->db->UPDATEAction('users', array('confreg' => '1'), "iduser='$id' and confreg<>'1'", "1");	
  }//ActivateEmailItem
  
  /** деактивировать e-mail */
  protected function DeActivateEmailItem($id) {
   return $this->control->db->UPDATEAction('users', array('confreg' => '0'), "iduser='$id' and confreg<>'0'", "1");	
  }//ActivateEmailItem
  
  /** добавление пользователя в группу */
  protected function AddUserToGroup($id) {   
   if ($this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem from {$this->control->tables_list['groupusrs']} where groupid='".
    $_POST['groupaddparam']."' and userid='$id' limit 1"       
   ))) { return true; }  
           
   $this->control->db->INSERTAction('groupusrs', array(
    'groupid'    => $_POST['groupaddparam'],
    'userid'     => $id,
    'datecreate' => $this->GetThisDateTime()       
   )); 

   return true;    
  }//AddUserToGroup
	
 }//w_admin_admuserslisten 
 //-------------------------------------------------------
 /** группировка инструментов */
 class w_admin_admgroupingtools extends w_admin_gen_obj { 			
  protected 
   $result,
   $dump;
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'admsectiongroupingtools'; 
   $this->dump = array(); 	
  }//__construct
  
  /** список строк */
  function GetStrings($default) {
   $result1 = array();
   if (isset($this->dump['stringslist'])) { $result1 = $this->dump['stringslist']; } else {   
    $list = $this->control->db->mPost(
     "select strident, strdescr from {$this->control->tables_list['stringstb']} where lang='".
	 $this->control->GetActiveLanguage()."'"
    );
    while ($row = $this->control->db->GetLineArray($list)) {
	 $result1[] = array(
	  'ident'    => $row['strident'],
	  'strdescr' => $row['strdescr'],
	  'isselect' => false
	 );	 
    }
    $this->dump['stringslist'] = $result1;
   }
   //def value
   $default_val = ($default) ? array(
	'ident'    => $default,
	'strdescr' => $this->GetText('defaultvaluedtr'),
	'isselect' => true
   ) : false;
   //correct descript
   if ($default_val) {
    foreach ($result1 as $res) {
	 if ($res['ident'] == $default) {
	  $default_val['strdescr'] = $res['strdescr'];
	  break;	  	
	 }	
    }
   }
   //init res
   $result = ($default) ? array($default_val) : array();
   if ($default_val) {
    $result[] = array(
     'ident'    => "0",
	 'strdescr' => '-----------------',
	 'isselect' => false
    );
   }	 
   //marge
   return @array_merge($result, $result1); 	
  }//GetStrings
  
  /** получение информации о группе */
  protected function GetGroupInformation() {	
   if (!$_GET['modify'] = $this->CorrectSymplyString($_GET['modify'])) { return $this->result['modifyinfo'] = false; }
   $this->result['modifyinfo'] = $this->control->db->GetLineArray($this->control->db->mPost(
    "select * from {$this->control->tables_list['tgroupslt']} where iditem='{$_GET['modify']}' limit 1"
   )); 
   return $this->result['modifyinfo'];
  }//GetGroupInformation
  
  /** изменение группы */
  protected function ModifyGroup() {
   if (!$this->result['modifyinfo']) { return $this->SetError('Unknow group ID'); }
   if (!$_POST['identifiername'] = $this->CorrectSymplyString($_POST['identifiername'])) {
	return $this->SetError('Set Group Identifier!');
   }
   $_POST['nm'] = (!@is_numeric($_POST['nm'])) ? 0 : $this->CorrectSymplyString($_POST['nm']);
   //ok, check exists
   if ($this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem from {$this->control->tables_list['tgroupslt']} where ".
	"nameident='{$_POST['identifiername']}' and iditem<>'{$this->result['modifyinfo']['iditem']}' limit 1" 
   ))) { return $this->SetError($this->GetText('groupisalridyexists', array($_POST['identifiername']))); }
   //ok, modify
   if (!$this->control->db->UPDATEAction('tgroupslt', array(
    'nameident' => $_POST['identifiername'],
    'posident'  => $_POST['nm']
   ), "iditem='{$this->result['modifyinfo']['iditem']}'", "1")) { 
   	return $this->SetError('Error update group record!'); 
   }
   //reload info
   return $this->GetGroupInformation();   	
  }//ModifyGroup
  
  /** добавление новой группы */
  protected function AddGroup() {
   if (!$_POST['identifiername'] = $this->CorrectSymplyString($_POST['identifiername'])) {
	return $this->SetError('Set Group Identifier!');
   }
   $_POST['nm'] = (!@is_numeric($_POST['nm'])) ? 0 : $this->CorrectSymplyString($_POST['nm']);
   //ok, check exists
   if ($this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem from {$this->control->tables_list['tgroupslt']} where ".
	"nameident='{$_POST['identifiername']}' limit 1" 
   ))) { return $this->SetError($this->GetText('groupisalridyexists', array($_POST['identifiername']))); }
   //ok, insert new record
   if (!$this->control->db->INSERTAction('tgroupslt', array(
    'nameident'  => $_POST['identifiername'],
    'posident'   => $_POST['nm'],
    'datecreate' => $this->GetThisDateTime()
   ))) { return $this->SetError('Error insert new group record!'); }
   //reload count
   $this->result['count'] = $this->control->GetCountInTable('iditem', 'tgroupslt');
   return true;
  }//AddGroup
  
  function GetPerPageCount($tablename) { return 6; }
  
  /** список инструментов, принадлежащих указанной группе */
  function GetToolsListOfGroup($groupid, $onlylist=false) {
   if (!$groupid = $this->CorrectSymplyString($groupid)) { return false; }
   //ok, get all tools in group
   $list = $this->control->db->mPost(
    "select * from {$this->control->tables_list['tgroupslx']} where groupid='$groupid' order by shortid"
   );
   if ($onlylist) { return $list; }
   $result = array();
   while ($row = $this->control->db->GetLineArray($list)) {
    $result[] = $row;   
   }
   return ($result) ? $result : false;  
  }//GetToolsListOfGroup
  
  /** построение списка инструментов по идентификатору группы */
  function CombineToolsListByGroupIdentifier($groupid) {
   $list = $this->GetToolsListOfGroup($groupid, true);
   if (!$list) { return false; }
   $result = array(
    'data1'  => array(),
    'data2'  => array(),
    'count'  => 0
   );
   //initialize tools params
   $this->PreloadToolsItemsSettings();
   $index = 0;
   //combine
   while ($tool = $this->control->db->GetLineArray($list)) {
    if (!$tool['toolident'] || !isset($this->dump['toolslistitemsdata'][$tool['toolident']])) { $item = false; } 
    $item = $this->dump['toolslistitemsdata'][$tool['toolident']]; 
	if ($index == 0) {
	 $result['data1'][] = array(
	  'name'   => $tool['toolident'],
	  'value'  => $item,
      'iditem' => $tool['iditem']
	 );	
	 $index++;
	 continue;
	}
	$result['data2'][] = array(
	 'name'   => $tool['toolident'],
	 'value'  => $item,
     'iditem' => $tool['iditem']
	);	
	$index = 0;
   }
   $result['count'] = @count($result['data1']);
   return (!$result['count']) ? false : $result;    
  }//CombineToolsListByGroupIdentifier
  
  /** погрузка параметров инструметов */
  protected function PreloadToolsItemsSettings() {
   global $_TOOLSNOLIMITACTIVATIONDATAINFO;
   if (!isset($this->dump['toolslistitemsdata'])) {
    require_once W_LIBPATH.'/preloadoptions.lib.php';
    $preload_option_object = new pr_options_preload($this->control);
    $preload_option_object->PreloadOptionsOfAllTools();
    unset($preload_option_object);
    $this->dump['toolslistitemsdata'] = $_TOOLSNOLIMITACTIVATIONDATAINFO;    
   }
   return true;    
  }//PreloadToolsItemsSettings 
  
  /** имя инструмента по идентификатору */
  function GetToolNameById($id) {
   $this->PreloadToolsItemsSettings();
   $id_unknow = 'Unknow Tool';
   //ok, get by data
   if (!isset($this->dump['toolslistitemsdata'][$id])) { return $id_unknow; }
   $named = ($this->dump['toolslistitemsdata'][$id]['descr']) ? $this->GetText(
    $this->dump['toolslistitemsdata'][$id]['descr']
   ) : '';   
   return ($named) ? $named : $id_unknow;      
  }//GetToolNameById
  
  function IsCheckedItem($toolid) {
   if (!$this->result['selftoolslistgroup']) { return false; }  
   foreach ($this->result['selftoolslistgroup'] as $item) {
    if ($item['toolident'] == $toolid) { return true; }    
   } 
   return false; 
  }//IsCheckedItem
  
  protected function ActionFromAjaxModeRun() {
   $this->result = array('item' => 'ajax');
   switch ($_POST['typed']) {
    //get group elements
    case 'get':
     //check group id
     if (!$_POST['groupid'] || !@is_numeric($_POST['groupid'])) { print 'Error: Invalid Group ID!'; exit; }
     //ok, preload all toolsoptions
     $this->PreloadToolsItemsSettings();
     $_POST['groupid'] = $this->CorrectSymplyString($_POST['groupid']);
     //ok, fetch items by default template
     $this->result['selftoolslistgroup'] = $this->GetToolsListOfGroup($_POST['groupid']);
     $this->result['optionslistitemstools'] = $this->dump['toolslistitemsdata'];
     //ok, out    
     print $this->control->smarty->fetch('adm_account/grouping/grouping-tools-list.tpl');   
    break;
    //set new group tools list
    case 'set':
     //check
     if (!$_POST['groupid'] || !@is_numeric($_POST['groupid'])) { print 'Error: Invalid Group ID!'; exit; }
     $_POST['groupid'] = $this->CorrectSymplyString($_POST['groupid']);
     $this->PreloadToolsItemsSettings();
     //get list elements
     $_POST['data'] = @explode('|', $_POST['data']);
     //ok, process save, remove
     $this->control->db->Delete($this->control->tables_list['tgroupslx'], "groupid='{$_POST['groupid']}'");
     $this->result['selftoolslistgroup'] = array();
     foreach ($_POST['data'] as $name) {
      $name = $this->CorrectSymplyString($name);  
      if (!isset($this->dump['toolslistitemsdata'][$name])) { continue; }
      if ($this->control->db->INSERTAction('tgroupslx', array(
       'toolident' => $name,
       'groupid'   => $_POST['groupid']
      ))) {
       $this->result['selftoolslistgroup'][] = array(
        'iditem'    => $this->control->db->InseredIndex(),
        'toolident' => $name,
        'groupid'   => $_POST['groupid']
       );
      }        
     }
     //pass parameters
     $this->result['optionslistitemstools'] = $this->dump['toolslistitemsdata'];
     $this->control->smarty->assign('groupiddata', $_POST['groupid']);   
     //get data
     print $this->control->smarty->fetch('adm_account/grouping/grouping-tools-list-result.tpl');  
    break; 
    //short group tools
    case 'short':
     //check group id
     if (!$_POST['groupid'] || !@is_numeric($_POST['groupid'])) { print ''; exit; }     
     if (!$_POST['value']) { print ''; exit; }
     
     $index = 0;
     foreach (@explode(',', $_POST['value']) as $item) {
       $item = $this->CorrectSymplyString($item); 
       if (!$item || !@is_numeric($item)) { continue; }
     
       $this->control->db->UPDATEAction('tgroupslx', array('shortid' => $index), "iditem='$item'", "1");
      $index++;  
     } 
     print $_POST['groupid'];    
    break;  
    //get from short
    case 'shortget':
     //check group id
     if (!$_POST['groupid'] || !@is_numeric($_POST['groupid'])) { print 'Error: Invalid Group ID!'; exit; }
     //ok, preload all toolsoptions
     $this->PreloadToolsItemsSettings();
     $_POST['groupid'] = $this->CorrectSymplyString($_POST['groupid']);
     //ok, fetch items by default template
     $this->result['selftoolslistgroup'] = $this->GetToolsListOfGroup($_POST['groupid']);
     $this->result['optionslistitemstools'] = $this->dump['toolslistitemsdata'];
     $this->control->smarty->assign('groupiddata', $_POST['groupid']);
     //ok, out    
     print $this->control->smarty->fetch('adm_account/grouping/grouping-tools-list-result.tpl');  
    break;
                  
    //by def, if error found
    default: print 'Error: Unknow Operation ID!';
   }  
   print ''; 
   exit; 
  }//ActionFromAjaxModeRun
  
  function _DoActionThisSection() {
   if ($this->IsAjax()) { return $this->ActionFromAjaxModeRun(); }    
   $this->result = array(
    'count' => $this->control->GetCountInTable('iditem', 'tgroupslt')
   );
   if ($_GET['new']) {		 	
    /* css */
    $this->AddSectionInfoNew('csslist', 'ui/old/jquery.ui.all.css');
    $this->AddSectionInfoNew('csslist', 'combobox.jquery.css');
    /* js */
    $this->AddSectionInfoNew('jslist', 'combobox.jquery.js');
   } else {
    $this->AddSectionInfoNew('csslist', 'ui/jquery-ui-1.8.11.custom.css');
   }   
   $this->AddSectionInfoNew('jslist', 'jquery.ui.custom.min.js');   
   //изменение группы
   if ($_GET['modify'] && $this->GetGroupInformation()) {
   	if ($_POST['actionthissectionpost4'] != 'do') {
	 $_POST['nm']  = $this->GetResult('modifyinfo.posident'); 	 
	 $_POST['actionthissectionpost4']  = 'do';
	 $_POST['actionthissectionpost_q'] = '1';	 	
	 return true;	
	} else { return ($_POST['actionnewprvmail'] == 'prev') ? true : $this->ModifyGroup(); }
   }
   //добавление группы
   if ($_GET['new']) { return ($_POST['actionthissectionpost4'] == 'do') ? $this->AddGroup() : true; }
   //удаление группы
   if ($_GET['delete']) {
    if ($_GET['delete'] = $this->CorrectSymplyString($_GET['delete'])) {
     //delete tool items
     $this->control->db->Delete($this->control->tables_list['tgroupslx'], "groupid='{$_GET['delete']}'");
     //delete group
     $this->control->db->Delete($this->control->tables_list['tgroupslt'], "iditem='{$_GET['delete']}'", "1");
     //reload count
     $this->result['count'] = $this->control->GetCountInTable('iditem', 'tgroupslt');
    }    
   }   
   //groups list  
   $this->result['data'] = $this->GetTableData('tgroupslt', 
    "select * from {$this->control->tables_list['tgroupslt']} order by datecreate DESC",
    $this->result['count'], 'page' 
   ); 	
  }//_DoActionThisSection	
	
 }//w_admin_admgroupingtools 
 //-------------------------------------------------------
 /** раздел администратора */
 class w_admin_admmain extends w_admin_gen_obj { 			
  protected 
   $result;
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'admsectiongeneralinf';  	
  }//__construct
  
  protected function GetTableSize($tblname) {
   $row = $this->control->db->GetLineArray($this->control->db->mPost(
    "SHOW TABLE STATUS LIKE '".$this->control->tables_list[$tblname]."'"
   ));
   $this->result['size_'.$tblname] = (!$row) ? 0 : ($row['Data_length']+$row['Index_length']);
   return ss_HTMLPageInfo::GetSizeStrX($this->result['size_'.$tblname]);   	
  }//GetTableSize
  
  function GetCachSpecialFormatList() {
   global $_GLOBAL_CONST_PLUGIN_IDS_LIST; 
   return $_GLOBAL_CONST_PLUGIN_IDS_LIST;     
  }//GetCachSpecialFormatList 
  
  protected function PrepereToClearCach() {
   //clear specelements
   if ($_POST['c4tableclearSpec'] == 'do' && $_POST['getcach']) {
    $_POST['getcach'] = $this->CorrectSymplyString($_POST['getcach']);  
    $this->control->db->Delete($this->control->tables_list['cachlong'], "ident='{$_POST['getcach']}'");
    $this->control->db->Delete($this->control->tables_list['cachshort'], "ident='{$_POST['getcach']}'");   
   }
   //clear all    
   $tb = '';
   if ($_POST['c1tableclear'] == 'do') { $tb = 'cachshort'; }
   elseif ($_POST['c2tableclear'] == 'do') { $tb = 'cachlong'; } 
   elseif ($_POST['c3tableclear'] == 'do') { $tb = 'chhistory'; }
   else { return false; }
   return (!$tb) ? false : $this->control->db->mPost("TRUNCATE TABLE ".$this->control->tables_list[$tb]);   	
  }//PrepereToClearCach
  
  function GetApiInformationAll($apiID) {
   $data = $this->control->db->GetLineArray($this->control->db->mPost(
    "select sum(reqcount) as reqcount from {$this->control->tables_list['xmpapitemp']} where apiid='$apiID'"
   ));
   $data2 = $this->control->db->GetLineArray($this->control->db->mPost(
    "select sum(nowcount) as nowcount from {$this->control->tables_list['xmpapitemp']}".
    " where apiid='$apiID' and nowdater='".$this->GetThisDate()."'"
   ));
   return array(
    'reqcount' => (!$data  || !@is_numeric($data['reqcount'])) ? 0 : $data['reqcount'], 
    'nowcount' => (!$data2 || !@is_numeric($data2['nowcount'])) ? 0 : $data2['nowcount']
   );
  }//GetApiInformationAll
  
  function _DoActionThisSection() {
   global $_TOOLSNOLIMITACTIVATIONDATAINFO;
   require_once W_LIBPATH.'/confi/api.conf.php';	
   //очистка таблиц
   $this->PrepereToClearCach();   	  
   //данные	   		 	
   $this->result = array(
    'sizesortcach'  => $this->GetTableSize('cachshort'),
    'sizelongcach'  => $this->GetTableSize('cachlong'),
    'sizehistory'   => $this->GetTableSize('chhistory'),
    'allcachsize'   => ss_HTMLPageInfo::GetSizeStrX(
	                    $this->result['size_cachshort'] + 
						$this->result['size_cachlong'] + 
						$this->result['size_chhistory']
					   ),
    'eV'            => '1.4.7',
    'eD'            => '20.05.2012 13:30',
	'eiC'           => @count($_TOOLSNOLIMITACTIVATIONDATAINFO),
    'xmlsettings'   => $_API_CONFIGURATION_PACK,    
   );     	
  }//_DoActionThisSection	
	
 }//w_admin_admmain 
 //-------------------------------------------------------
 /** раздел реферальных баннеров */
 class w_admin_admrefbunners extends w_admin_gen_obj {
  const FILE_IDENT = 'image';	
  //максимальный размер файла изображения (0 - без ограничений)	
  const MAX_FILE_SIZE_KB = 2048;
  //допустимые типы изображений
  private static $files_type = array(".gif", ".jpg", ".png", ".jpeg"/*, ".bmp"*/, ".swf");    
  protected 
   $result;
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'admrefbunnerssection';  	
  }//__construct
  
  /** всего баннеров */
  protected function GetBunnersCount() { return $this->control->GetCountInTable('iditem', 'refbunner'); }
  
  /** список допустимых типов изображений */
  function GetListTypes() { return $this->control->GenerateArrayString(self::$files_type,', ', '"<b>', '"</b>'); }
  
  function GetPerPageCount($tablename) { return 10; }
  
  /** add new */
  protected function AddNewImageBunner() {
   $FILE_INFO = ($_FILES[self::FILE_IDENT]['name']) ? $this->control->UpLoadFile(
    self::FILE_IDENT, self::$files_type, self::MAX_FILE_SIZE_KB, W_FILESPATH.'/images/', 0, 0, false, -1, '' 
   ) : false;   
   if ($FILE_INFO && $FILE_INFO['result']) { return $this->SetError($FILE_INFO['result']); }
   if (!$FILE_INFO) { return $this->SetError('Error in Upload Image file!'); }   
   $isflash = ($FILE_INFO['type'] != '.swf') ? 0 : 1;   
   $w = 0;
   $h = 0;
   if (!$isflash) { 
    require_once W_LIBPATH.'/graph.lib.php';
    $image = w_image_obj::CreateFromFile(W_FILESPATH.'/images/'.$FILE_INFO['newname']);
    if (!$image) { return $this->SetError('Error in Upload Image file!'); }
    $h = $image->GetImageHeight();
    if (!$h) { $h = 0; }
    $w = $image->GetImageWidth();
    if (!$w) { $w = 0; }
   } else {
    $image = false;
    $w = (!$_POST['wflash'] || !@is_numeric($_POST['wflash'])) ? 0 : $_POST['wflash'];
    $h = (!$_POST['hflash'] || !@is_numeric($_POST['hflash'])) ? 0 : $_POST['hflash'];
   } 
   //image is ok, create record
   if (!$this->control->db->INSERTAction('refbunner', array(
    'bfilename'  => $FILE_INFO['newname'],
    'bofilename' => $FILE_INFO['originalname'],
    'bheight'    => $h,
    'bwidth'     => $w,
    'bsize'      => (!$FILE_INFO['filesizebyte'] || !@is_numeric($FILE_INFO['filesizebyte'])) ? 0 : 
                    $FILE_INFO['filesizebyte'],
    'isflash'    => $isflash
   ))) {
    //remove temp image an error found
    if ($FILE_INFO && $FILE_INFO['newname'] && @file_exists(W_FILESPATH.'/images/'.$FILE_INFO['newname'])) { 
	 @unlink(W_FILESPATH.'/images/'.$FILE_INFO['newname']); 
	}
    if ($image) { $image->FreeImage(); }
    return $this->SetError('Error in create new bunner record (mysql error) ['.$this->control->db->GetError().']');    
   }
   if ($image) { $image->FreeImage(); }
   $this->result['count']++;
   return true;
  }//AddNewImageBunner
   
  function GetImageFileSizeEX($sb) { return ss_HTMLPageInfo::GetSizeStrX($sb); }
  
  function DeleteFormItem($itemID) {
   if (!$itemID = $this->CorrectSymplyString($itemID)) { return false; }
   //get record info
   $data = $this->control->db->GetLineArray($this->control->db->mPost(
    "select bfilename from {$this->control->tables_list['refbunner']} where iditem='$itemID' limit 1"
   ));
   if (!$data) { return false; }
   //ok, remove image data
   $this->RemoveImageData($data);   
   $this->control->db->Delete($this->control->tables_list['refbunner'], "iditem='$itemID'", "1");
   return true;        
  }//DeleteFormItem
  
  protected function ActionDeleteAll() {
   $list = $this->control->db->mPost("select bfilename from {$this->control->tables_list['refbunner']}");
   while ($row = $this->control->db->GetLineArray($list)) {
    $this->RemoveImageData($row);    
   }
   return $this->control->db->mPost("TRUNCATE TABLE ".$this->control->tables_list['refbunner']);   
  }//ActionDeleteAll
  
  protected function RemoveImageData($itemData) {   
   if (@file_exists(W_FILESPATH.'/images/'.$itemData['bfilename'])) { 
    @unlink(W_FILESPATH.'/images/'.$itemData['bfilename']); 
   } 
  }//RemoveImageData
  
  protected function CorrectChangeElements() {
   if (!$_POST['value'] = $this->CorrectSymplyString($_POST['value'])) { $_POST['value'] = 0; } 
   elseif (!@is_numeric($_POST['value'])) { print ''; exit; }
   if (!$_POST['id'] = $this->CorrectSymplyString($_POST['id'])) { print ''; exit; }
   $items = ($_POST['type'] == 'h') ? array('bheight' => $_POST['value']) : array('bwidth' => $_POST['value']);
   if ($this->control->db->UPDATEAction('refbunner', $items, "iditem='{$_POST['id']}'", "1")) {
    print $_POST['value'];
   } else {
    print '';
   }
   exit; 
  }//CorrectChangeElements
    
  function _DoActionThisSection() {
   if ($this->IsAjax()) {
    $this->result = array();
    $this->CorrectChangeElements();    
   }    
   $this->result = array(
    'count'   => $this->GetBunnersCount(),
    'maxsize' => ss_HTMLPageInfo::GetSizeStrX(self::MAX_FILE_SIZE_KB * 1024)
   );   
   //add new bunner   
   if ($_GET['new']) { return ($_POST['actionthissectionpost'] != 'do') ? true : $this->AddNewImageBunner(); }
   //action from list
   $is_modified = false;
   switch ($_POST['actionlistmakes']) {
   	//remove all
	case 'dall': 
	 $this->ActionDeleteAll(); $is_modified = true; break;
	//remove selected items
	case 'delete': 
	 $this->TransformPostItems(array($this, 'DeleteFormItem'), $this->GetPerPageCount('refbunner'));
	 $is_modified = true;
	 break;  	 
   }  
   //restore count
   if ($is_modified) { $this->result['count'] = $this->GetBunnersCount(); }      
   //listen   
   $this->result['data'] = $this->GetTableData('refbunner', 
    "select * from {$this->control->tables_list['refbunner']}", $this->result['count'], 'page', '', ''
   );          	
  }//_DoActionThisSection	
	
 }//w_admin_admrefbunners 
//-------------------------------------------------------
 /** раздел отдельных страниц проекта */
 class w_admin_admpspageslist extends w_admin_gen_obj {    
  protected 
   $result;
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'admspecpageslistnamemenu';
   
   if ($_GET['group'] && $this->GetGroupInfo($_GET['group'], 'xgroupinfo')) {   
    $this->AddSectionWay($this->global_string_identifier);
    $this->SetSection_title($this->global_string_identifier);
    $this->globalnogettext = true;   
    $this->global_string_identifier = $this->GetResult('xgroupinfo.groupname');  
    $path = '?group='.$_GET['group'].(($_GET['grouppage']) ? ('&grouppage='.$_GET['grouppage']) : '');  
    $this->AddSectionWay($this->global_string_identifier, $path);       
    $this->SetSection_stitle($this->global_string_identifier);
    $this->SetSection_title($this->global_string_identifier);
    $this->global_string_identifier = '';    
   }  	
  }//__construct
 
  function GetPerPageCount($tablename) { 
   switch ($tablename) {
    case 'tplitemsl': return 15;
    default: return 10;
   } 
  }//GetPerPageCount
  
  function GetGroupID() { return $_GET['group']; }
  
  /** всего разделов */
  protected function GetGroupsCount() {
   return $this->control->GetCountInTable('iditem', 'glbsectlst', "where groupid='0'"); 
  }//GetGroupsCount
  
  /** where для выборки страниц по секции */
  protected function GetWhereForPagesList($groupid) {
   $res = '';
   if ($groupid = $this->CorrectSymplyString($groupid)) {
    if (@is_numeric($groupid)) {
     $res .= "sectionid='$groupid' and ";
    }
   }   
   $res .= "lang='".$this->control->GetActiveLanguage()."' and skin='".$this->control->GetActiveSkin()."'";
   return "where $res";    
  }//GetWhereForPagesList
  
  /** всего страниц в группе, 0 - во всех группах */
  function GetPagesCount($groupid) {
   return $this->control->GetCountInTable('iditem', 'tplitemsl', $this->GetWhereForPagesList($groupid)); 
  }//GetPagesCount
  
  /** получение кол-ва комментариев к новости */
  function GetCommentsCountForNews($id) {
   return $this->control->GetCommentCountForElement($id, $id, 1);	
  }//GetCommentsCountForNews
  
  protected function DeletePageItem($id) {
   if (!$id = $this->CorrectSymplyString($id)) { return false; }  
   
   require_once W_LIBPATH.'/sp.page.lib.php';
   w_sp_page_object::DeletePage($this->control, $id); 
   
   require_once W_LIBPATH.'/files.lib.php';
   w_dw_files_object::RemoveAllObjectFiles(2, $id, $this->control);       
  }//DeletePageItem
 
  /** delete specified group, all of them */
  protected function DeleteGroup($groupid, $deletegrouptoo=true) {    
   if (!$groupid = $this->CorrectSymplyString($groupid)) { return false; }
   $list = $this->control->db->mPost(
    "select iditem from {$this->control->tables_list['tplitemsl']} ".$this->GetWhereForPagesList($groupid)
   );
   require_once W_LIBPATH.'/sp.page.lib.php';
   require_once W_LIBPATH.'/files.lib.php';
   while ($row = $this->control->db->GetLineArray($list)) {    
    w_sp_page_object::DeletePage($this->control, $row['iditem']);
    w_dw_files_object::RemoveAllObjectFiles(2, $row['iditem'], $this->control);    
   }   
   if ($deletegrouptoo) {
    $this->control->db->Delete($this->control->tables_list['glbsectlst'], "iditem='$groupid'", '1');
    $this->result['gcount'] = $this->GetGroupsCount();
   }
   return true;    
  }//DeleteGroup
  
  function GetAsElementP($name, $ifname='actionthissectnnews', $ifvalue='do', $defvalue='') {
   return $this->control->GetPostElement($name, $ifname, $ifvalue, $defvalue, $_POST['actionnewprvmail'] == 'act');	
  }//GetAsElementP
    
  protected function GetGroupInfo($id=false, $nameresult='modifyinfo') {
   if (!$id) { 
    if (!$_GET['modify'] = $this->control->CorrectSymplyString($_GET['modify'])) { return false; }
   }
   $id = (!$id) ? $_GET['modify'] : $id;   
   if (!$this->result[$nameresult] = $this->control->db->GetLineArray($this->control->db->mPost(
    "select * from {$this->control->tables_list['glbsectlst']} where iditem='$id' limit 1"
   ))) { return false; }  
   return $this->result[$nameresult];        
  }//GetGroupInfo
  
  protected function GetPageInfo() {
   if (!$_GET['modify'] = $this->control->CorrectSymplyString($_GET['modify'])) { return false; } 
   require_once W_LIBPATH.'/sp.page.lib.php';
   return $this->result['modifyinfo'] = w_sp_page_object::GetPageByRealId($_GET['modify'], $this->control);  
  }//GetPageInfo
  
  private function SetGroupInfoForModify() {
   $_POST['groupname']  = $this->GetResult('modifyinfo.groupname');	 
   $_POST['groupdescr'] = $this->control->strings->CorrectTextForModify($this->GetResult('modifyinfo.groupdescr'));
	 
   $_POST['actionthissectnnews'] = 'do';
   $_POST['actionnewprvmail']    = 'act';
   $_POST['actionthissectionpost_q'] = '1';	
   return true;
  }//SetGroupInfoForModify 
  
  private function ModifyGroup() {
   //name check
   if (!$_POST['groupname'] = $this->CorrectSymplyString($_POST['groupname'])) {
    return $this->SetError('Set the Name of group!');
   }     
   //check exists
   $item = $this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem from {$this->control->tables_list['glbsectlst']} ".
    "where groupid='0' and Lower(groupname)=Lower('{$_POST['groupname']}') ".
    "and iditem<>'{$this->result['modifyinfo']['iditem']}' limit 1"
   )); 
   if ($item) { return $this->SetError($this->GetText('p_sectisexistsalr', array($_POST['groupname']))); }    
   //ok modify
   if (!$this->control->db->UPDATEAction('glbsectlst', array(  
    'groupname'  => $_POST['groupname'],
    'groupdescr' => trim($this->control->strings->CorrectTextToDB($_POST['groupdescr']))
   ), "iditem='{$this->result['modifyinfo']['iditem']}'", "1")) { 
    return $this->SetError('Error in update group record!');	
   }
   return true;        
  }//ModifyGroup 
  
  private function InsertNewGroup() {
   //name check
   if (!$_POST['groupname'] = $this->CorrectSymplyString($_POST['groupname'])) {
    return $this->SetError('Set the Name of group!');
   }  
   //check exists
   $item = $this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem from {$this->control->tables_list['glbsectlst']} ".
    "where groupid='0' and Lower(groupname)=Lower('{$_POST['groupname']}') limit 1"
   ));
   if ($item) { return $this->SetError($this->GetText('p_sectisexistsalr', array($_POST['groupname']))); }
   //ok, insert
   if (!$this->control->db->INSERTAction('glbsectlst', array(  
    'groupname'  => $_POST['groupname'],
    'groupdescr' => trim($this->control->strings->CorrectTextToDB($_POST['groupdescr'])),
    'datecreate' => $this->GetThisDateTime()    
   ))) { 
    return $this->SetError('Error in add group record!');	
   }
   $this->result['gcount']++;
   return true;           
  }//InsertNewGroup
  
  function HiglPHP($s) { return w_string_obj::HiglPHPCode($s, $this->control); }
  
  protected function CorrectSID() {
   $_POST['sid'] = @str_replace(' ', '-', $_POST['sid']);
   $_POST['sid'] = @preg_replace("/[^a-zA-Zа-яА-ЯёЁ0-9\-_\.]/u", '', $_POST['sid']);
   if (!$_POST['sid']) { return $this->SetError('Set the Page Identifier path!'); }
   $_POST['sid'] = $this->substr($_POST['sid'], 0, 149);
   return true; 
  }//CorrectSID
  
  protected function ModifyPage() {
   if (!$this->result['modifyinfo']) { return $this->SetError('No record information found!'); }  
   if (!$this->CorrectSID()) { return false; } 
   if (!trim($_POST['ttitle'])) { return $this->SetError('Set the Page title!'); }
   //check system exists 
   if (isset(w_get_prepere_parser::$replace_sections[$this->strtolower($_POST['sid'])])) {
    return $this->SetError($this->GetText('pageidentifierisexists'));
   }    
   //check for exists
   if ($item = $this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem from {$this->control->tables_list['tplitemsl']} where ".
    "iditem<>'{$this->result['modifyinfo']['iditem']}' and sid='{$_POST['sid']}' limit 1"
   ))) { return $this->SetError($this->GetText('pageidentifierisexists')); }
   //ok update    
   if ($this->control->db->UPDATEAction('tplitemsl', array(
    'sid'        => $_POST['sid'],
    'tkeywords'  => $this->substr($_POST['tkeywords'], 0, 249),
    'tdescript'  => $this->substr($_POST['tdescript'], 0, 249),
    'ttitle'     => $this->substr($_POST['ttitle'], 0, 249),
    'tpathname'  => $this->substr($_POST['tpathname'], 0, 249),
    'lang'       => $this->control->GetActiveLanguage(),
    'skin'       => $this->control->GetActiveSkin(),
    'iautolook'  => ($this->CheckPostValue('iautolook')) ? 1 : 0,
    'slashaddte' => ($this->CheckPostValue('slashaddte')) ? 1 : 0,
    'commperpa'  => ($_POST['commperpa'] && @is_numeric($_POST['commperpa'])) ? $_POST['commperpa'] : 15,
    'commcheck'  => ($this->CheckPostValue('commcheck')) ? 1 : 0,
    'commcaptcha'=> ($this->CheckPostValue('commcaptcha')) ? 1 : 0,      
   ), "iditem='{$this->result['modifyinfo']['iditem']}'", "1", true)) {
    //ok
    $_POST['tsource'] = @stripcslashes($_POST['tsource']);
    require_once W_LIBPATH.'/sp.page.lib.php';
    w_sp_page_object::WritePage($this->control, $this->result['modifyinfo']['iditem'], $_POST['tsource'], true);    
   } else {
    return $this->SetError('Error in modify PageInfo record, ['.$this->control->db->GetError().']');
   }
   return true;    
  }//ModifyPage 
  
  function GetPageSize($id) {
    require_once W_LIBPATH.'/sp.page.lib.php';
    $file = w_sp_page_object::GetTemplateFileNameEX($this->control, $id, true);
    if (@file_exists($file)) {
      $file = @filesize($file);   
    } else {
      $file = 0;  
    }
    return ss_HTMLPageInfo::GetSizeStrX($file);      
  }//GetPageSize
  
  function GetFileName($id) {
   require_once W_LIBPATH.'/sp.page.lib.php';
   return w_sp_page_object::GetTemplateFileNameEX($this->control, $id);  
  }//GetFileName
  
  protected function AddPage() {
   if (!$this->CorrectSID()) { return false; }
   if (!trim($_POST['ttitle'])) { return $this->SetError('Set the Page title!'); }
   //check system exists 
   if (isset(w_get_prepere_parser::$replace_sections[$this->strtolower($_POST['sid'])])) {
    return $this->SetError($this->GetText('pageidentifierisexists'));
   }   
   //check for exists
   if ($item = $this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem from {$this->control->tables_list['tplitemsl']} where sid='{$_POST['sid']}' limit 1"
   ))) { return $this->SetError($this->GetText('pageidentifierisexists')); }
   //ok write
   if ($this->control->db->INSERTAction('tplitemsl', array(
    'sid'        => $_POST['sid'],
    'tkeywords'  => $this->substr($_POST['tkeywords'], 0, 249),
    'tdescript'  => $this->substr($_POST['tdescript'], 0, 249),
    'ttitle'     => $this->substr($_POST['ttitle'], 0, 249),
    'tpathname'  => $this->substr($_POST['tpathname'], 0, 249),
    'lang'       => $this->control->GetActiveLanguage(),
    'skin'       => $this->control->GetActiveSkin(),
    'iautolook'  => ($this->CheckPostValue('iautolook')) ? 1 : 0,
    'slashaddte' => ($this->CheckPostValue('slashaddte')) ? 1 : 0, 
    'sectionid'  => $this->GetGroupID(), 
    'datecreate' => $this->GetThisDateTime(),
    'commperpa'  => ($_POST['commperpa'] && @is_numeric($_POST['commperpa'])) ? $_POST['commperpa'] : 15,
    'commcheck'  => ($this->CheckPostValue('commcheck')) ? 1 : 0,
    'commcaptcha'=> ($this->CheckPostValue('commcaptcha')) ? 1 : 0,
   ), true)) {
    //ok
    $this->result['pcount']++;
    $ident = $this->control->db->InseredIndex();
    $_POST['tsource'] = @stripcslashes($_POST['tsource']);
    require_once W_LIBPATH.'/sp.page.lib.php';
    w_sp_page_object::WritePage($this->control, $ident, $_POST['tsource']);    
   } else {
    return $this->SetError('Error in add PageInfo record, ['.$this->control->db->GetError().']');
   }  
   return true;    
  }//AddPage
    
  function _DoActionThisSection() {
   $this->result = array();
   if (!$_GET['group']) {
    /*  управление разделами */
     
     $this->result['gcount'] = $this->GetGroupsCount();   
     //modify
     if ($_GET['modify'] && $this->GetGroupInfo()) {
      if ($_POST['actionthissectnnews'] == 'do' || $_POST['actionthissectnnews4'] == 'do') {	 	
       return ($_POST['actionnewprvmail'] == 'prev') ? true : $this->ModifyGroup();	
      } else { 
	   return $this->SetGroupInfoForModify();
      }
     }
     //add
     if ($_GET['new']) { 
   	  return ($_POST['actionthissectnnews'] == 'do' && $_POST['actionnewprvmail'] == 'act') ? 
      $this->InsertNewGroup() : true; 
     }   
     //delete
     if ($_GET['qdelete']) { $this->DeleteGroup($_GET['qdelete']); }  
     //listen   
     $this->result['data'] = $this->GetTableData('glbsectlst', 
      "select * from {$this->control->tables_list['glbsectlst']} where groupid='0' order by datecreate DESC", 
	  $this->result['gcount'], 'page'
     );     
    
   } else {
    /* управление страницами */ 
    
     $this->result['pcount'] = $this->GetPagesCount($this->GetGroupID());
     $this->result['gcount'] = $this->GetGroupsCount();
     
     if ($_GET['new']) {
      /* css */
      $this->AddSectionInfoNew('csslist', 'ui/jquery-ui-1.8.11.custom.css');
      /* js */
      $this->AddSectionInfoNew('jslist', 'jquery.ui.custom.min.js');
     }
     
     //изменение страницы
     if ($_GET['modify'] && $this->GetPageInfo()) {
   	  if ($_POST['actionthissectionpost'] != 'do') {
   	    
       require_once W_LIBPATH.'/sp.page.lib.php';
              
	   $_POST['sid']        = $this->GetResult('modifyinfo.sid');
       $_POST['tkeywords']  = $this->GetResult('modifyinfo.tkeywords');
       $_POST['tdescript']  = $this->GetResult('modifyinfo.tdescript');
       $_POST['ttitle']     = $this->GetResult('modifyinfo.ttitle');
       $_POST['tpathname']  = $this->GetResult('modifyinfo.tpathname');
       $_POST['iautolook']  = $this->GetResult('modifyinfo.iautolook');
       $_POST['slashaddte'] = $this->GetResult('modifyinfo.slashaddte');      
       $_POST['commperpa']  = $this->GetResult('modifyinfo.commperpa');
       $_POST['commcheck']  = $this->GetResult('modifyinfo.commcheck');
       $_POST['commcaptcha']= $this->GetResult('modifyinfo.commcaptcha');    
       $_POST['tsource']    = w_sp_page_object::ReadPage($this->control, $this->GetResult('modifyinfo.iditem'));
       $_POST['tsource']    = @stripcslashes($_POST['tsource']);
       
	   $_POST['actionthissectionpost'] = 'do';
	   $_POST['actionthissectionpost_q'] = '1';	
        	
	   return true;	
	  } else { return ($_POST['actionnewprvmail'] == 'prev') ? true : $this->ModifyPage(); }
     }     
     
     //добавление страницы
     if ($_GET['new']) { 
   	  return ($_POST['actionthissectionpost'] == 'do' && $_POST['actionnewprvmail'] == 'act') ? $this->AddPage() : true; 
     }     
     
     //action from list
     $is_modified = false;
     switch ($_POST['actionlistmakes']) {
   	  //удалить все элементы
	  case 'dall': 
	   $this->DeleteGroup($this->GetGroupID(), false); $is_modified = true; break;
	  //удалить выбранные элементы
	  case 'delete': 
	   $this->TransformPostItems(array($this, 'DeletePageItem'), $this->GetPerPageCount('tplitemsl'));
	   $is_modified = true;
	   break;  	 
     }  
     //restore count
     if ($is_modified) { $this->result['pcount'] = $this->GetPagesCount($this->GetGroupID()); } 
     //listen   
     $this->result['data'] = $this->GetTableData('tplitemsl', 
      "select * from {$this->control->tables_list['tplitemsl']} ".$this->GetWhereForPagesList($this->GetGroupID()).	
	  " order by datecreate DESC", $this->result['pcount'], 'page'
     );     

   }      	
  }//_DoActionThisSection	
	
 }//w_admin_admpspageslist
 //-------------------------------------------------------
 /** изображения инструментов */
 class w_admin_admtoolsimages extends w_admin_gen_obj { 
  const FILE_IDENT_16 = 'image16';
  const FILE_IDENT_64 = 'image64';  	
  //максимальный размер файла изображения (0 - без ограничений)	
  const MAX_FILE_SIZE_KB_16 = 750;
  const MAX_FILE_SIZE_KB_64 = 1024;
  //допустимые типы изображений
  private static $files_type = array(".gif", ".jpg", ".png", ".jpeg", ".ico");
      
  protected 
   $result;
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'admtoolsimagesdescrtext';  	
  }//__construct
  
  /** существование надстроек */
  function ToolOptionExists($toolid, $name=false) {
   global $_TOOLSNOLIMITACTIVATIONDATAINFO;
   return ($name) ? isset($_TOOLSNOLIMITACTIVATIONDATAINFO[$toolid][$name]) : 
   isset($_TOOLSNOLIMITACTIVATIONDATAINFO[$toolid]);
  }//ToolOptionExists
  
  function GetToolParam($id, $name) {
   global $_TOOLSNOLIMITACTIVATIONDATAINFO;
   if (!$this->ToolOptionExists($id, $name)) { return ''; }
   return ($name) ? $_TOOLSNOLIMITACTIVATIONDATAINFO[$id][$name] : '';   
  }//GetToolParam
  
  /** подкаталог на надстройку инструментов */
  protected function AddSubPath() {
   global $section_way, $_TOOLSNOLIMITACTIVATIONDATAINFO;
   if ($_GET['toolid'] && $this->ToolOptionExists($_GET['toolid'], 'descr')) {
	$section_way[] = array(
     'name' => $this->control->GetText('toolconfigureopticons', array(
	  $this->GetText($_TOOLSNOLIMITACTIVATIONDATAINFO[$_GET['toolid']]['descr'])
	 )),
     'path' => W_SITEPATH.'account/'.$this->section_id.'/?toolid='.$_GET['toolid']
    );  
    $this->SetSectionInfo(
	 'stitle', $this->GetSectionInfo('stitle').' - '.
	 $this->GetText($_TOOLSNOLIMITACTIVATIONDATAINFO[$_GET['toolid']]['descr'])
	);
   }	
  }//AddSubPath
  
  /** список допустимых типов изображений */
  function GetListTypes() {
   return $this->control->GenerateArrayString(self::$files_type,', ', '"<b>', '"</b>');	
  }//GetListTypes  
  
  protected function SetNewImageFile($FILE_INFO, $imageName='image16') {
   if (!$this->CheckDownLoadedImage($FILE_INFO, $imageName)) { return false; } 
    
    $imageID = false;  
    if ($image_record = $this->control->GetToolImageRecord($_GET['toolid'])) {  
        
      $ok = $this->control->db->UPDATEAction('toolimglst', array(
       $imageName => ($FILE_INFO && $FILE_INFO['newname']) ? $FILE_INFO['newname'] : ''
      ), "iditem='{$image_record['iditem']}'", "1");
      $imageID = $image_record['iditem']; 
      
      if ($ok && @file_exists(W_FILESPATH.'/images/'.$image_record[$imageName])) {
        @unlink(W_FILESPATH.'/images/'.$image_record[$imageName]);
      }
              
    } else {
      
      $ok = $this->control->db->INSERTAction('toolimglst', array(
       'toolid'   => $this->CorrectSymplyString($_GET['toolid']),
       'skin'     => $this->control->GetActiveSkin(),
       $imageName => ($FILE_INFO && $FILE_INFO['newname']) ? $FILE_INFO['newname'] : ''
      ));
      $imageID = $this->control->db->InseredIndex();   
        
    }
    
    if (!$ok && $FILE_INFO && $FILE_INFO['newname'] && @file_exists(W_FILESPATH.'/images/'.$FILE_INFO['newname'])) { 
	 @unlink(W_FILESPATH.'/images/'.$FILE_INFO['newname']); 
	}
    
    if (!$ok) { return $this->SetError('Error in set New Image - ['.$this->control->db->GetError().']'); }
    
    //remove, if empty all images
    if ($imageID) {
      $item = $this->control->db->GetLineArray($this->control->db->mPost(
       "select image16,image64 from {$this->control->tables_list['toolimglst']} where iditem='$imageID' limit 1"  
      ));   
      if (!$item['image16'] && !$item['image64']) {
       $this->control->db->Delete($this->control->tables_list['toolimglst'], "iditem='$imageID'", "1"); 
      }        
    }
    return true;     
  }//SetNewImageFile
  
  protected function CheckDownLoadedImage($FILE_INFO, $imageName='image16') {
   if ($FILE_INFO && $FILE_INFO['result']) { return $this->SetError($FILE_INFO['result']); }
   
   if (!$FILE_INFO || !$FILE_INFO['newname']) { return true; }
   $filename = W_FILESPATH.'/images/'.$FILE_INFO['newname'];
   
   require_once W_LIBPATH.'/graph.lib.php';
   $image = w_image_obj::CreateFromFile($filename, $FILE_INFO['imagetype']);
   
   if (!$image) { @unlink($filename); return true; }
   
   $w = $image->GetImageWidth();
   $h = $image->GetImageHeight();
   $Mhw = 0; 
   
   switch ($imageName) {
    case 'image16': $Mhw = 16; break;
    case 'image64': $Mhw = 64; break;    
   }
   
   //resize
   if (($h > $Mhw || $w > $Mhw) && $this->CheckPostValue('resize'.$imageName)) {
    if ($image->ResizeImage(($w > $Mhw) ? $Mhw : $w, ($h > $Mhw) ? $Mhw : $h)) {
     $h = $Mhw;
     $w = $Mhw;
     $image->OutImage($filename);       
    } else { @unlink($filename); return $this->SetError('Error in resize Image file!'); }   
   }
   
   unset($image);
   
   if ($h > $Mhw) { @unlink($filename); return $this->SetError($this->GetText('imgheightnomatch', array($h))); }
   if ($w > $Mhw) { @unlink($filename); return $this->SetError($this->GetText('imgwidthnomatch', array($w))); }
    
   return true; 
  }//CheckDownLoadedImage
  
  function _DoActionThisSection() {	
   //add subpath
   $this->AddSubPath();
   //gen info
   $this->result = array(
    'maxsize64' => ss_HTMLPageInfo::GetSizeStrX(self::MAX_FILE_SIZE_KB_64 * 1024),
    'maxsize16' => ss_HTMLPageInfo::GetSizeStrX(self::MAX_FILE_SIZE_KB_16 * 1024)
   );
   
   //ok, load x16 image
   if ($_POST['doloadimage16'] == 'do') {
    
    $FILE_INFO = ($_FILES[self::FILE_IDENT_16]['name']) ? $this->control->UpLoadFile(
     self::FILE_IDENT_16, self::$files_type, self::MAX_FILE_SIZE_KB_16, W_FILESPATH.'/images/', 0, 0, false, -1, '' 
    ) : false;
    
    return $this->SetNewImageFile($FILE_INFO, 'image16');
   }
   
   //ok, load x64 image
   elseif ($_POST['doloadimage64'] == 'do') {
    
    $FILE_INFO = ($_FILES[self::FILE_IDENT_64]['name']) ? $this->control->UpLoadFile(
     self::FILE_IDENT_64, self::$files_type, self::MAX_FILE_SIZE_KB_64, W_FILESPATH.'/images/', 0, 0, false, -1, '' 
    ) : false;
    
    return $this->SetNewImageFile($FILE_INFO, 'image64');      
   }   	 	             
    	
  }//_DoActionThisSection	
	
 }//w_admin_admtoolsimages 
 //-------------------------------------------------------
 /** группы пользователей */
 class w_admin_admusersgroups extends w_admin_gen_obj { 
  protected 
   $result;
   
  var $adedusers = 0; 
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'admadmusersgroupstext';
   
   if ($_GET['group'] && $this->GetGroupInfo($_GET['group'], 'xgroupinfo')) {   
    $this->AddSectionWay($this->global_string_identifier);
    $this->SetSection_title($this->global_string_identifier);
    $this->globalnogettext = true;   
    $this->global_string_identifier = $this->GetResult('xgroupinfo.groupname');  
    $path = '?group='.$_GET['group'].(($_GET['grouppage']) ? ('&grouppage='.$_GET['grouppage']) : '');  
    $this->AddSectionWay($this->global_string_identifier, $path);       
    $this->SetSection_stitle($this->global_string_identifier);
    $this->SetSection_title($this->global_string_identifier);
    $this->global_string_identifier = '';    
   }     	
  }//__construct

  function GetPerPageCount($tablename) { 
   switch ($tablename) {
    case 'groupusrs': return 15; //пользователи в группе
    default: return 10; //группы
   } 
  }//GetPerPageCount
  
  function GetGroupID() { return $_GET['group']; }
  
  /** всего разделов */
  protected function GetGroupsCount() {
   return $this->control->GetCountInTable('iditem', 'glbsectlst', "where groupid='1' and lang='".
   $this->control->GetActiveLanguage()."'"); 
  }//GetGroupsCount
  
  /** всего пользователей в группе */
  function GetUsersCount($groupid) {
   return $this->control->GetCountInTable('iditem', 'groupusrs', "where groupid='$groupid'"); 
  }//GetUsersCount  
  
  /** delete specified group, all of them */
  protected function DeleteGroup($groupid, $deletegrouptoo=true) {    
   if (!$groupid = $this->CorrectSymplyString($groupid)) { return false; }   
   //remove all users
   $this->control->db->Delete($this->control->tables_list['groupusrs'], "groupid='$groupid'");
   //remove group  
   if ($deletegrouptoo) {
    $this->control->db->Delete($this->control->tables_list['glbsectlst'], "iditem='$groupid'", '1');
    $this->result['gcount'] = $this->GetGroupsCount();
   }
   return true;    
  }//DeleteGroup  
  
  function GetAsElementP($name, $ifname='actionthissectnnews', $ifvalue='do', $defvalue='') {
   return $this->control->GetPostElement($name, $ifname, $ifvalue, $defvalue, $_POST['actionnewprvmail'] == 'act');	
  }//GetAsElementP
  
  protected function GetGroupInfo($id=false, $nameresult='modifyinfo') {
   if (!$id) { 
    if (!$_GET['modify'] = $this->control->CorrectSymplyString($_GET['modify'])) { return false; }
   }
   $id = (!$id) ? $_GET['modify'] : $id;   
   if (!$this->result[$nameresult] = $this->control->db->GetLineArray($this->control->db->mPost(
    "select * from {$this->control->tables_list['glbsectlst']} where iditem='$id' limit 1"
   ))) { return false; }  
   return $this->result[$nameresult];        
  }//GetGroupInfo
  
  private function SetGroupInfoForModify() {
   $_POST['groupname']  = $this->GetResult('modifyinfo.groupname');	 
   $_POST['groupdescr'] = $this->control->strings->CorrectTextForModify($this->GetResult('modifyinfo.groupdescr'));
	 
   $_POST['actionthissectnnews'] = 'do';
   $_POST['actionnewprvmail']    = 'act';
   $_POST['actionthissectionpost_q'] = '1';	
   return true;
  }//SetGroupInfoForModify
  
  private function ModifyGroup() {
   //name check
   if (!$_POST['groupname'] = $this->CorrectSymplyString($_POST['groupname'])) {
    return $this->SetError('Set the Name of group!');
   }     
   //check exists
   $item = $this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem from {$this->control->tables_list['glbsectlst']} ".
    "where groupid='1' and Lower(groupname)=Lower('{$_POST['groupname']}') ".
    "and iditem<>'{$this->result['modifyinfo']['iditem']}' and lang='".$this->control->GetActiveLanguage()."' limit 1"
   )); 
   if ($item) { return $this->SetError($this->GetText('p_sectisexistsalr', array($_POST['groupname']))); }    
   //ok modify
   if (!$this->control->db->UPDATEAction('glbsectlst', array(  
    'groupname'  => $_POST['groupname'],
    'groupdescr' => trim($this->control->strings->CorrectTextToDB($_POST['groupdescr']))
   ), "iditem='{$this->result['modifyinfo']['iditem']}'", "1")) { 
    return $this->SetError('Error in update group record!');	
   }
   return true;        
  }//ModifyGroup 
  
  private function InsertNewGroup() {
   //name check
   if (!$_POST['groupname'] = $this->CorrectSymplyString($_POST['groupname'])) {
    return $this->SetError('Set the Name of group!');
   }  
   //check exists
   $item = $this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem from {$this->control->tables_list['glbsectlst']} ".
    "where groupid='1' and Lower(groupname)=Lower('{$_POST['groupname']}') and lang='".
    $this->control->GetActiveLanguage()."' limit 1"
   ));
   if ($item) { return $this->SetError($this->GetText('p_sectisexistsalr', array($_POST['groupname']))); }
   //ok, insert
   if (!$this->control->db->INSERTAction('glbsectlst', array(  
    'groupname'  => $_POST['groupname'],
    'groupdescr' => trim($this->control->strings->CorrectTextToDB($_POST['groupdescr'])),
    'lang'       => $this->control->GetActiveLanguage(),
    'datecreate' => $this->GetThisDateTime(),
    'groupid'    => '1'    
   ))) { 
    return $this->SetError('Error in add group record!');	
   }
   $this->result['gcount']++;
   return true;           
  }//InsertNewGroup         
  
  function _DoActionThisSection() {	    
   $this->result = array();
   if (!$_GET['group']) {
    /*  управление разделами */
     
     $this->result['gcount'] = $this->GetGroupsCount();   
     //modify
     if ($_GET['modify'] && $this->GetGroupInfo()) {
      if ($_POST['actionthissectnnews'] == 'do' || $_POST['actionthissectnnews4'] == 'do') {	 	
       return ($_POST['actionnewprvmail'] == 'prev') ? true : $this->ModifyGroup();	
      } else { 
	   return $this->SetGroupInfoForModify();
      }
     }
     //add
     if ($_GET['new']) { 
   	  return ($_POST['actionthissectnnews'] == 'do' && $_POST['actionnewprvmail'] == 'act') ? 
      $this->InsertNewGroup() : true; 
     }   
     //delete
     if ($_GET['qdelete']) { $this->DeleteGroup($_GET['qdelete']); }  
     //listen   
     $this->result['data'] = $this->GetTableData('glbsectlst', 
      "select * from {$this->control->tables_list['glbsectlst']} where groupid='1' and lang='".
      $this->control->GetActiveLanguage()."' order by datecreate DESC", 
	  $this->result['gcount'], 'page'
     );     
    
   } else {
    /* управление пользователями группы */
    $this->result['pcount'] = $this->GetUsersCount($this->GetGroupID());
    $this->result['gcount'] = $this->GetGroupsCount();
    
    //add users
    if ($_GET['new']) {
     
     if (!$_POST['usnames'] = trim($_POST['usnames'])) { return $this->SetError('No Users for Add found!'); }
     
     $_POST['usnames'] = $this->ClearBreake($_POST['usnames'], true, false);
     $list = @explode("\n", $_POST['usnames']);   
     
     if (!$list) { return $this->SetError('No Users for Add found!'); }
     
     $_POST['usnames'] = '';
     
     $this->adedusers = 0;
     foreach ($list as $user) {
      if (!$user = $this->CorrectSymplyString($user)) { continue; }
      
      if (!$info = $this->control->GetUserInfo($user)) { continue; }
      
      if ($this->control->db->GetLineArray($this->control->db->mPost(
       "select iditem from {$this->control->tables_list['groupusrs']} where groupid='".
       $this->GetGroupID()."' and userid='{$info['iduser']}' limit 1"       
      ))) { continue; }
           
      if (!$this->control->db->INSERTAction('groupusrs', array(
       'groupid'    => $this->GetGroupID(),
       'userid'     => $info['iduser'],
       'datecreate' => $this->GetThisDateTime()       
      ))) { continue; }     
      
      $this->adedusers++;
      $this->result['pcount']++; 
      $_POST['usnames'] .= $info['username']."\r\n";        
     }        
     
     return true;    
    }
     
    //action from list
    $is_modified = false;
    switch ($_POST['actionlistmakes']) {
   	 //удалить все элементы
	 case 'dall': 
	  $this->DeleteGroup($this->GetGroupID(), false); $is_modified = true; break;
	 //удалить выбранные элементы
	 case 'delete': 
	  $this->TransformPostItems(array($this, 'DeleteUserItem'), $this->GetPerPageCount('groupusrs'));
	  $is_modified = true;
	  break;  	 
    }  
    //restore count
    if ($is_modified) { $this->result['pcount'] = $this->GetUsersCount($this->GetGroupID()); } 
    //listen   
    $this->result['data'] = $this->GetTableData('groupusrs', 
     "select * from {$this->control->tables_list['groupusrs']} where groupid='".$this->GetGroupID()
     ."' order by datecreate DESC", $this->result['pcount'], 'page', '', '&group='.$this->GetGroupID()
    );
    
   }        	 	               	
  }//_DoActionThisSection
  
  protected function DeleteUserItem($id) {
   if (!$id = $this->CorrectSymplyString($id)) { return false; }
   $this->control->db->Delete($this->control->tables_list['groupusrs'], "iditem='$id'", "1"); 
   return true; 
  }//DeleteUserItem
	
 }//w_admin_admusersgroups 
 //-------------------------------------------------------
 /** файлы (вложения для блоков) */
 class w_admin_admfilescontrol extends w_admin_gen_obj { 
  const FILE_IDENT = 'sfile';	
  //максимальный размер файла (0 - без ограничений)	
  const MAX_FILE_SIZE_KB = 6750;
  //допустимые типы файлов
  private static $files_type = array(".rar", ".zip");    
  protected 
   $result;
   
  var $errorglobal = false;
  var $obj = null;  
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'admfilescontroltext';     	
  }//__construct
  
  function GetListTypes() {
   return $this->control->GenerateArrayString(self::$files_type,', ', '"<b>', '"</b>');	
  }//GetListTypes
  
  function GetAsElementP($name, $ifname='actionthissectnnews', $ifvalue='do', $defvalue='') {
   return $this->control->GetPostElement($name, $ifname, $ifvalue, $defvalue, $_POST['actionnewprvmail'] == 'act');	
  }//GetAsElementP
  
  function GetPerPageCount($tablename) { 
    return 10; 
  }//GetPerPageCount
  
  function OptionIsSelected($data, $id) {
   return (@is_array($data) && @in_array($id, $data));    
  }//OptionIsSelected
  
  function GetUsersGroups() {
   if (isset($this->result['usergroups'])) { return $this->result['usergroups']; }
   return $this->result['usergroups'] = $this->control->GetAvaileableUserGroups();    
  }//GetUsersGroups
  
  protected function GetFilesCount() {
    return $this->control->GetCountInTable(
     'iditem', 'filestblst', "where fobjectid='{$_GET['pid']}' and fsection='{$_GET['fid']}'"
    );
  }//GetFilesCount
  
  protected function GetFileInfo($id=false, $nameresult='modifyinfo') {
   if (!$id) { 
    if (!$_GET['modify'] = $this->control->CorrectSymplyString($_GET['modify'])) { return false; }
   }
   $id = (!$id) ? $_GET['modify'] : $id;   
   if (!$this->result[$nameresult] = $this->control->db->GetLineArray($this->control->db->mPost(
    "select * from {$this->control->tables_list['filestblst']} where iditem='$id' limit 1"
   ))) { return false; }  
   return $this->result[$nameresult];        
  }//GetGroupInfo
  
  protected function PrepereFileParams() {
   $_POST['groupname'] = $this->substr(trim($_POST['groupname']), 0, 80);
   if (!$_POST['groupname'] && $_POST['groupname2']) {
     $_POST['groupname'] = $this->substr(trim($_POST['groupname2']), 0, 80);    
   } 
   
   if (!$_POST['pricevalue'] || !@is_numeric($_POST['pricevalue']) || $_POST['pricevalue'] <= 0) {
    $_POST['pricevalue'] = '0.00';
   }
   
   if (!$_POST['paydescr'] = trim($this->substr($_POST['paydescr'], 0, 240))) {
    $_POST['paydescr'] = $this->GetText('payfilesdescriptionhistory');
   }

   if (!@is_array($_POST['fromgroupso'])) { $_POST['fromgroupso'] = array(); }
   if (!@is_array($_POST['pricefreefr'])) { $_POST['pricefreefr'] = array(); }
   if (!@is_array($_POST['lockgroups'])) { $_POST['lockgroups'] = array(); }    
  }//PrepereFileParams
  
  protected function InsertNewFile() {
   $this->PrepereFileParams();
   
   //download file  	
   $FILE_INFO = $this->control->UpLoadFile(
    self::FILE_IDENT, self::$files_type, self::MAX_FILE_SIZE_KB, W_FILESPATH.'/files/', 0, 0, false, -1 
   );   
   //check data
   if ($FILE_INFO['result']) { return $this->SetError($FILE_INFO['result']); }
   $FILE_INFO['originalname'] = $this->substr($this->CorrectSymplyString($FILE_INFO['originalname']), 0, 120);
   
   //ok, add new record
   if (!$this->control->db->INSERTAction('filestblst', array(
    'fname'       => $this->CorrectSymplyString($FILE_INFO['originalname']),
    'rname'       => $FILE_INFO['newname'],
    'fsection'    => $_GET['fid'],
    'fobjectid'   => $_GET['pid'],
    'fsize'       => $FILE_INFO['filesizebyte'],
    'groupname'   => $_POST['groupname'],
    'onlyonline'  => ($this->CheckPostValue('onlyonline')) ? '1' : '0',
    'onlyadmins'  => ($this->CheckPostValue('onlyadmins')) ? '1' : '0',
    'fromgroupso' => @serialize($_POST['fromgroupso']),
    'useprice'    => ($this->CheckPostValue('useprice') && $_POST['pricevalue']) ? '1' : '0',
    'pricevalue'  => $_POST['pricevalue'],
    'paydescr'    => $_POST['paydescr'],
    'pricefreefr' => @serialize($_POST['pricefreefr']),
    'lockgroups'  => @serialize($_POST['lockgroups']),
    'datecreate'  => $this->GetThisDateTime(),
    'filetip'     => trim($this->control->strings->CorrectTextToDB($_POST['filetip'])),
    'shcountw'    => ($this->CheckPostValue('shcountw')) ? '1' : '0',   
   ), true)) { 
    if ($FILE_INFO['newname'] && @file_exists(W_FILESPATH.'/files/'.$FILE_INFO['newname'])) {
      @unlink(W_FILESPATH.'/files/'.$FILE_INFO['newname']);  
    }
    return $this->SetError('Error in add file record ['.$this->control->db->GetError().']'); 
   }
   //ok
   $this->result['count']++;
   return true;
  }//InsertNewFile
  
  protected function ModifyFile() {
   
   //modify file data
   if ($_GET['modifytype']) {
    
    $FILE_INFO = $this->control->UpLoadFile(
     self::FILE_IDENT, self::$files_type, self::MAX_FILE_SIZE_KB, W_FILESPATH.'/files/', 0, 0, false, -1 
    );   
    //check data
    if ($FILE_INFO['result']) { return $this->SetError($FILE_INFO['result']); }
    $FILE_INFO['originalname'] = $this->substr($this->CorrectSymplyString($FILE_INFO['originalname']), 0, 120);
    
    if (!$this->control->db->UPDATEAction('filestblst', array(
     'fname'       => $this->CorrectSymplyString($FILE_INFO['originalname']),
     'rname'       => $FILE_INFO['newname'],
     'fsize'       => $FILE_INFO['filesizebyte'],     
    ), "iditem='".$this->GetResult('modifyinfo.iditem')."'", "1", true)) {
        
     if ($FILE_INFO['newname'] && @file_exists(W_FILESPATH.'/files/'.$FILE_INFO['newname'])) {
      @unlink(W_FILESPATH.'/files/'.$FILE_INFO['newname']);  
     }
     return $this->SetError('Error in modify file record ['.$this->control->db->GetError().']');  
    }
    
    //remove old file, success rusult
    if ($this->GetResult('modifyinfo.rname') && @file_exists(W_FILESPATH.'/files/'.$this->GetResult('modifyinfo.rname'))) {
     @unlink(W_FILESPATH.'/files/'.$this->GetResult('modifyinfo.rname'));  
    }
    
    $this->result['modifyinfo']['rname'] = $FILE_INFO['newname'];
    $this->result['modifyinfo']['fname'] = $FILE_INFO['originalname'];
    $this->result['modifyinfo']['fsize'] = $FILE_INFO['filesizebyte'];
    
    return true;
   } 
   
   //modify settings
   $this->PrepereFileParams();
   
   if (!$this->control->db->UPDATEAction('filestblst', array(
    'groupname'   => $_POST['groupname'],
    'onlyonline'  => ($this->CheckPostValue('onlyonline')) ? '1' : '0',
    'onlyadmins'  => ($this->CheckPostValue('onlyadmins')) ? '1' : '0',
    'fromgroupso' => @serialize($_POST['fromgroupso']),
    'useprice'    => ($this->CheckPostValue('useprice') && $_POST['pricevalue']) ? '1' : '0',
    'pricevalue'  => $_POST['pricevalue'],
    'paydescr'    => $_POST['paydescr'],
    'pricefreefr' => @serialize($_POST['pricefreefr']),
    'lockgroups'  => @serialize($_POST['lockgroups']),
    'filetip'     => trim($this->control->strings->CorrectTextToDB($_POST['filetip'])), 
    'shcountw'    => ($this->CheckPostValue('shcountw')) ? '1' : '0',   
   ), "iditem='".$this->GetResult('modifyinfo.iditem')."'", "1", true)) { 
    
    return $this->SetError('Error in modify file record ['.$this->control->db->GetError().']'); 
   }
     
   return true;    
  }//GetFileInfo
  
  protected function GetAsArrayInfo($name) {  
   $_POST[$name] = $this->GetResult('modifyinfo.'.$name);
   if ($_POST[$name]) {
    $_POST[$name] = @unserialize(@stripcslashes($_POST[$name]));
    if (!$_POST[$name] || !@is_array($_POST[$name])) {
      $_POST[$name] = array(); 
    }    
   } else { $_POST[$name] = array(); }   
  }//GetAsArrayInfo
  
  private function SetFileInfoForModify() {
   $_POST['groupname']  = $this->GetResult('modifyinfo.groupname');
   $_POST['onlyonline'] = $this->GetResult('modifyinfo.onlyonline');
   $_POST['shcountw'] = $this->GetResult('modifyinfo.shcountw');   	 
   $_POST['onlyadmins'] = $this->GetResult('modifyinfo.onlyadmins');
   $_POST['useprice']   = $this->GetResult('modifyinfo.useprice');
   $_POST['pricevalue'] = $this->GetResult('modifyinfo.pricevalue');  
   $_POST['paydescr']   = ($this->GetResult('modifyinfo.paydescr') ? $this->GetResult('modifyinfo.paydescr') : 
                          $this->GetText('payfilesdescriptionhistory'));
   $_POST['filetip']    = $this->control->strings->CorrectTextForModify($this->GetResult('modifyinfo.filetip'));
   
   $this->GetAsArrayInfo('fromgroupso');
   $this->GetAsArrayInfo('pricefreefr');
   $this->GetAsArrayInfo('lockgroups');
   
	 
   $_POST['actionthissectnnews'] = 'do';
   $_POST['actionnewprvmail']    = 'act';
   $_POST['actionthissectionpost_q'] = '1';	
   return true;
  }//SetFileInfoForModify  
  
  function GetFileSize($size) { return ss_HTMLPageInfo::GetSizeStrX($size); }
  
  function _DoActionThisSection() {	         
   require_once W_LIBPATH.'/files.lib.php';      
   //get info
   if (!$files = w_dw_files_object::CreateFromObjectID($_GET['fid'], $_GET['pid'], $this->control)) {
    $this->errorglobal = true;
    return $this->SetError(w_dw_files_object::$error);    
   }  
   
   if ($_GET['dwfile'] && @is_numeric($_GET['dwfile'])) {
    $files->DownLoadFile($_GET['dwfile']);
   }
   
   $this->obj = $files;
   
   $this->result = array(
    'count'   => $this->GetFilesCount(),
    'maxsize' => $this->GetFileSize(self::MAX_FILE_SIZE_KB * 1024),
   );
   
   //modify
   if ($_GET['modify'] && $this->GetFileInfo()) {    
    if ($_POST['actionthissectnnews'] == 'do' || $_POST['actionthissectnnews4'] == 'do') {	 	
     return ($_POST['actionnewprvmail'] == 'prev') ? true : $this->ModifyFile();	
    } else { 
     return $this->SetFileInfoForModify();
    }
   }
   
   //add
   if ($_GET['new']) { 
    return ($_POST['actionthissectnnews'] == 'do' && $_POST['actionnewprvmail'] == 'act') ? 
    $this->InsertNewFile() : true; 
   }
    
   //action from list
   $is_modified = false;
   switch ($_POST['actionlistmakes']) {
   	//удалить все элементы
	case 'dall': $this->DeleteAllFiles(); $is_modified = true; break;
	//удалить выбранные элементы
	case 'delete': 
     $this->TransformPostItems(array($this, 'DeleteFileItem'), $this->GetPerPageCount('filestblst'));
     $is_modified = true;
    break;  	 
   }  
   //restore count
   if ($is_modified) { $this->result['count'] = $this->GetFilesCount(); }     
   //listen   
   $this->result['data'] = $this->GetTableData('filestblst', 
    "select * from {$this->control->tables_list['filestblst']} where fobjectid='{$_GET['pid']}' ".
    "and fsection='{$_GET['fid']}' order by datecreate DESC", $this->result['count'], 'page', '',
    "&fid={$_GET['fid']}&pid={$_GET['pid']}"
   );          	 	               	
  }//_DoActionThisSection
  
  protected function DeleteFileItem($id) {
   $this->obj->DeleteFile($id);
   return true;    
  }//DeleteFileItem
  
  protected function DeleteAllFiles() {
   return $this->obj->DeleteAllFiles($_GET['fid'], $_GET['pid']);    
  }//DeleteAllFiles
	
 }//w_admin_admfilescontrol
 //-------------------------------------------------------
 /** баннеры проекта */
 class w_admin_admbunnerscontrol extends w_admin_gen_obj {     
  protected 
   $result;  
  
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   $this->global_string_identifier = 'admbunnerscontroltext';
   $this->result = array(); 
   
   if ($_GET['group'] && $this->GetGroupInfo($_GET['group'], 'xgroupinfo')) {   
    $this->AddSectionWay($this->global_string_identifier);
    $this->SetSection_title($this->global_string_identifier);
    $this->globalnogettext = true;   
    $this->global_string_identifier = $this->GetResult('xgroupinfo.groupname');  
    $path = '?group='.$_GET['group'].(($_GET['grouppage']) ? ('&grouppage='.$_GET['grouppage']) : '');  
    $this->AddSectionWay($this->global_string_identifier, $path);       
    $this->SetSection_stitle($this->global_string_identifier);
    $this->SetSection_title($this->global_string_identifier);
    $this->global_string_identifier = '';    
   }       	
  }//__construct

  function GetPerPageCount($tablename) { 
   switch ($tablename) {
    case 'bunnerlist': return 6; //баннеры в группе
    default: return 5; //группы
   } 
  }//GetPerPageCount
  
  function GetGroupID() { return $_GET['group']; }
  
  /** всего разделов */
  protected function GetGroupsCount() {
   return $this->control->GetCountInTable(
    'iditem', 'bunnerssec', "where lang='".$this->control->GetActiveLanguage()."'"
   ); 
  }//GetGroupsCount
  
  /** всего баннеров в группе */
  function GetBunnersCount($groupid) {
   return $this->control->GetCountInTable(
    'iditem', 'bunnerlist', "where groupid='$groupid'".$this->GetAdditionalWhere('')
   ); 
  }//GetBunnersCount  
  
  /** delete specified group, all of them */
  protected function DeleteGroup($groupid, $deletegrouptoo=true) {    
   if (!$groupid = $this->CorrectSymplyString($groupid)) { return false; }   
   //remove all bunners
   require_once W_LIBPATH.'/bunners.lib.php';
   w_adv_bunners_object::RemoveAllBanners($groupid, $this->control);
   //remove group  
   if ($deletegrouptoo) {
    $this->control->db->Delete($this->control->tables_list['bunnerssec'], "iditem='$groupid'", '1');
    $this->result['gcount'] = $this->GetGroupsCount();
   }
   return true;    
  }//DeleteGroup 
  
  /** delete specified banner */
  protected function DeleteBannerItem($id) {
   return w_adv_bunners_object::RemoveBanner($id, $this->control); 
  }//DeleteBannerItem 
    
  function GetAsElementP($name, $ifname='actionthissectnnews', $ifvalue='do', $defvalue='') {
   return $this->control->GetPostElement($name, $ifname, $ifvalue, $defvalue, $_POST['actionnewprvmail'] == 'act');	
  }//GetAsElementP
  
  protected function GetGroupInfo($id=false, $nameresult='modifyinfo') {
   if (!$id) { 
    if (!$_GET['modify'] = $this->control->CorrectSymplyString($_GET['modify'])) { return false; }
   }
   $id = (!$id) ? $_GET['modify'] : $id;   
   if (!$this->result[$nameresult] = $this->control->db->GetLineArray($this->control->db->mPost(
    "select * from {$this->control->tables_list['bunnerssec']} where iditem='$id' limit 1"
   ))) { return false; }  
   return $this->result[$nameresult];        
  }//GetGroupInfo
  
  private function SetGroupInfoForModify() {
   $_POST['groupname']  = $this->GetResult('modifyinfo.groupname');	 
   $_POST['groupdescr'] = $this->control->strings->CorrectTextForModify($this->GetResult('modifyinfo.groupdescr'));

   $_POST['filesuse']      = $this->GetResult('modifyinfo.filesuse');
   $_POST['linksuse']      = $this->GetResult('modifyinfo.linksuse');
   $_POST['usemoder']      = $this->GetResult('modifyinfo.usemoder');
   $_POST['useflash']      = $this->GetResult('modifyinfo.useflash');   
   $_POST['maxfilesize']   = $this->GetResult('modifyinfo.maxfilesize');
   $_POST['groupwidth']    = $this->GetResult('modifyinfo.groupwidth');
   $_POST['widthpersent']  = $this->GetResult('modifyinfo.widthpersent');
   $_POST['groupheight']   = $this->GetResult('modifyinfo.groupheight');
   $_POST['heightpersent'] = $this->GetResult('modifyinfo.heightpersent');
   $_POST['maxbunners']    = $this->GetResult('modifyinfo.maxbunners');
   $_POST['clearonoffbun'] = $this->GetResult('modifyinfo.clearonoffbun');
   $_POST['pricetolook']   = $this->GetResult('modifyinfo.pricetolook');
   $_POST['pricetodays']   = $this->GetResult('modifyinfo.pricetodays');
   $_POST['groupactive']   = $this->GetResult('modifyinfo.groupactive');
	 
   $_POST['actionthissectnnews'] = 'do';
   $_POST['actionnewprvmail']    = 'act';
   $_POST['actionthissectionpost_q'] = '1';	
   return true;
  }//SetGroupInfoForModify  
  
  protected function PrepereGroupsParams() {
   if (!$_POST['groupname'] = $this->CorrectSymplyString($_POST['groupname'])) {
    $_POST['groupname'] = 'Unnamed place';
   }
   
   if (!$_POST['maxfilesize'] || !@is_numeric($_POST['maxfilesize']) || $_POST['maxfilesize'] <= 0) {
    $_POST['maxfilesize'] = 170;
   }
   
   if (!@is_numeric($_POST['groupwidth'])) {
    $_POST['groupwidth'] = 0;
   } elseif ($this->CheckPostValue('widthpersent') && $_POST['groupwidth'] > 100) {
    $_POST['groupwidth'] = 100;
   } elseif ($_POST['groupwidth'] < 0) {
    $_POST['groupwidth'] = 0;
   }
   
   if (!@is_numeric($_POST['groupheight'])) {
    $_POST['groupheight'] = 0;
   } elseif ($this->CheckPostValue('heightpersent') && $_POST['groupheight'] > 100) {
    $_POST['groupheight'] = 100;
   } elseif ($_POST['groupheight'] < 0) {
    $_POST['groupheight'] = 0;
   }
   
   if (!@is_numeric($_POST['pricetolook']) || $_POST['pricetolook'] < 0) {
    $_POST['pricetolook'] = 0.00;
   }
   
   if (!@is_numeric($_POST['pricetodays']) || $_POST['pricetodays'] < 0) {
    $_POST['pricetodays'] = 0.00;
   }  
  }//PrepereGroupsParams  
  
  private function ModifyGroup() {
   if (!$this->GetResult('modifyinfo')) { return false; }
   $this->PrepereGroupsParams();
      
   if (!$this->control->db->UPDATEAction('bunnerssec', array(
    'groupname'     => $this->substr($_POST['groupname'], 0, 150),
    'groupdescr'    => trim($this->control->strings->CorrectTextToDB($_POST['groupdescr'])),  
    'linksuse'      => ($this->CheckPostValue('linksuse')) ? 1 : 0,
    'usemoder'      => ($this->CheckPostValue('usemoder')) ? 1 : 0,
    'useflash'      => ($this->CheckPostValue('useflash')) ? 1 : 0,
    'widthpersent'  => ($this->CheckPostValue('widthpersent')) ? 1 : 0,
    'heightpersent' => ($this->CheckPostValue('heightpersent')) ? 1 : 0,
    'clearonoffbun' => ($this->CheckPostValue('clearonoffbun')) ? 1 : 0,
    'filesuse'      => ($this->CheckPostValue('filesuse')) ? 1 : 0,
    'groupactive'   => ($this->CheckPostValue('groupactive')) ? 1 : 0,
    'maxfilesize'   => $_POST['maxfilesize'],    
    'groupwidth'    => $_POST['groupwidth'],
    'groupheight'   => $_POST['groupheight'],
    'maxbunners'    => $_POST['maxbunners'],
    'pricetolook'   => $_POST['pricetolook'],
    'pricetodays'   => $_POST['pricetodays'],       
   ), "iditem='{$this->result['modifyinfo']['iditem']}'", "1")) {
    return $this->SetError('Error in modify place ['.$this->control->db->GetError().']');
   }     
    
   return true;        
  }//ModifyGroup  
  
  private function InsertNewGroup() {
   $this->PrepereGroupsParams();    
   //ok, insert
   if (!$this->control->db->INSERTAction('bunnerssec', array(  
    'groupname'     => $this->substr($_POST['groupname'], 0, 150),
    'groupdescr'    => trim($this->control->strings->CorrectTextToDB($_POST['groupdescr'])),  
    'linksuse'      => ($this->CheckPostValue('linksuse')) ? 1 : 0,
    'usemoder'      => ($this->CheckPostValue('usemoder')) ? 1 : 0,
    'useflash'      => ($this->CheckPostValue('useflash')) ? 1 : 0,
    'widthpersent'  => ($this->CheckPostValue('widthpersent')) ? 1 : 0,
    'heightpersent' => ($this->CheckPostValue('heightpersent')) ? 1 : 0,
    'clearonoffbun' => ($this->CheckPostValue('clearonoffbun')) ? 1 : 0,
    'filesuse'      => ($this->CheckPostValue('filesuse')) ? 1 : 0,
    'groupactive'   => ($this->CheckPostValue('groupactive')) ? 1 : 0,
    'maxfilesize'   => $_POST['maxfilesize'],    
    'groupwidth'    => $_POST['groupwidth'],
    'groupheight'   => $_POST['groupheight'],
    'maxbunners'    => $_POST['maxbunners'],
    'pricetolook'   => $_POST['pricetolook'],
    'pricetodays'   => $_POST['pricetodays'],
    'lang'          => $this->control->GetActiveLanguage(),    
   ))) { 
    return $this->SetError('Error in add place record! ['.$this->control->db->GetError().']');	
   }
   $this->result['gcount']++;
   return true;           
  }//InsertNewGroup
  
  function _DoActionThisSection() {	         
   if (!$_GET['group']) {
    /*  управление разделами */
     
     $this->result['gcount'] = $this->GetGroupsCount();   
     //modify
     if ($_GET['modify'] && $this->GetGroupInfo()) {
      if ($_POST['actionthissectnnews'] == 'do' || $_POST['actionthissectnnews4'] == 'do') {	 	
       return ($_POST['actionnewprvmail'] == 'prev') ? true : $this->ModifyGroup();	
      } else { 
	   return $this->SetGroupInfoForModify();
      }
     }
     //add
     if ($_GET['new']) { 
   	  return ($_POST['actionthissectnnews'] == 'do' && $_POST['actionnewprvmail'] == 'act') ? 
      $this->InsertNewGroup() : true; 
     }   
     //delete
     if ($_GET['qdelete']) { $this->DeleteGroup($_GET['qdelete']); }  
     //listen   
     $this->result['data'] = $this->GetTableData('bunnerssec', 
      "select * from {$this->control->tables_list['bunnerssec']} where lang='".
      $this->control->GetActiveLanguage()."' order by iditem DESC", 
	  $this->result['gcount'], 'page'
     );       
   } else {
    
    //управление баннерами
    require_once W_LIBPATH.'/bunners.lib.php';
    $_GET['group'] = $this->CorrectSymplyString($_GET['group']);
    
    $this->result['gcount'] = $this->GetGroupsCount();
    $this->result['group']  = w_adv_bunners_object::GetGroupInfo($_GET['group'], $this->control); 
    $this->result['bcount'] = $this->GetBunnersCount($_GET['group']);   
    
    //action from list items
    $is_modified = false;
   
    switch ($_POST['actionlistmakes']) {
   	 //удалить все элементы
	 case 'dall': $this->DeleteGroup($_GET['group'], false); $is_modified = true; break;
	 //удалить выбранные элементы
 	 case 'delete':    
      $this->TransformPostItems(array($this, 'DeleteBannerItem'), $this->GetPerPageCount('bunnerlist'));
      $is_modified = true;
     break;  	 
     //подтвердить
     case 'enabled':
      $this->TransformPostItems(array($this, 'EnabledBannerItem'), $this->GetPerPageCount('bunnerlist'));
      //$is_modified = true;
     break;
     //снять подтверждение
     case 'disabled':
      $this->TransformPostItems(array($this, 'DisabledBannerItem'), $this->GetPerPageCount('bunnerlist'));
      //$is_modified = true;
     break;
    }  
    
    //clear all old banners
    if (w_adv_bunners_object::ClearAllOldBanners(false, $this->control) && !$is_modified) {
     $is_modified = true;
    }
    
    //restore count
    if ($is_modified) { $this->result['bcount'] = $this->GetBunnersCount($_GET['group']); }    
    
    //listen   
    $this->result['data'] = $this->GetTableData('bunnerlist', 
     "select t1.*,ADDTIME(t1.datecreate, '0 24:00:00.000000') as hoursleft,t2.username from ".
     "{$this->control->tables_list['bunnerlist']} as t1 INNER JOIN {$this->control->tables_list['users']} as t2".
     " ON (t1.groupid='{$_GET['group']}' and t1.userid=t2.iduser".$this->GetAdditionalWhere().")".
     " order by t1.iditem DESC", $this->result['bcount'], 'page', '', 
     (($_GET['onlyuser'] && @is_numeric($_GET['onlyuser'])) ? "&onlyuser={$_GET['onlyuser']}" : '').
     (($_GET['shorttype'] && @is_numeric($_GET['shorttype'])) ? "&shorttype={$_GET['shorttype']}" : '').
     '&group='.$_GET['group']
    );
    
    if ($this->result['data']['source']) {
     foreach ($this->result['data']['source'] as &$item) {
       
      $item['groupinfo'] = $this->result['group'];
      $item['webimagefile'] = ($item['rname']) ? W_SITEPATH.W_FILESWEBPATH.'/images/'.$item['rname'] : $item['lname'];  
      
      //hide today looks, visits if date is diff
      if ($item['datenow'] && $item['datenow'] != $this->GetThisDate()) {
        $item['looktoday']  = 0;
        $item['visittoday'] = 0;               
      }
           
      if (!$item['ispayed'] && $item['groupinfo']['clearonoffbun'] && $item['activeobj']) {
       $item['forpayislast'] = ss_Plugin_GenWhoisDomainEx::GetDateDiffInterval2(
        $this->GetThisDateTime(), $item['hoursleft']
       );
      }       
       
     }        
    }         
   }          	 	               	
  }//_DoActionThisSection
  
  function GetCTR($bannerInfo) { return w_adv_bunners_object::GetCTR2($bannerInfo); }
  
  protected function GetAdditionalWhere($tbn='t1.') { 
   if ($_GET['onlybanner'] && @is_numeric($_GET['onlybanner'])) {
    return " and {$tbn}iditem='{$_GET['onlybanner']}'";
   }
   
   $res = '';
   
   switch ($_GET['shorttype']) {
    
    //only active
    case '1': $res = " and {$tbn}ispayed='1' and {$tbn}activeobj='1'"; break;
    
    //on chech
    case '2': $res = " and {$tbn}activeobj='0'"; break;
    
    //wait for payment
    case '3': $res = " and {$tbn}ispayed='0' and {$tbn}activeobj='1'"; break;
    
   }        
   
   if ($_GET['onlyuser'] && @is_numeric($_GET['onlyuser'])) {
    $res .= " and {$tbn}userid='{$_GET['onlyuser']}'";
   }
   
   return $res; 
  }//GetAdditionalWhere
  
  protected function EnabledBannerItem($id) {
    
   if (!$item = $this->control->db->GetLineArray($this->control->db->mPost(
    "select t1.iditem,t2.username,t2.useremail from {$this->control->tables_list['bunnerlist']} as t1 ".
    "INNER JOIN {$this->control->tables_list['users']} as t2 ON (t1.iditem='$id' and t1.userid=t2.iduser ".
    "and t1.activeobj='0') limit 1"    
   ))) { return false; }
     
   $this->control->db->UPDATEAction('bunnerlist', array(
    'activeobj'  => 1,
    'datecreate' => $this->GetThisDateTime()
   ), "iditem='$id'", "1");
   
   //inform about
   $this->control->DoMailX($item['useremail'], $this->control->GetText('activateuserbannerst', W_HOSTMYSITE),
    $this->control->GetText('activateuserbannerstdata', array(
    $item['username'], W_HOSTMYSITE, 
    'http://'.W_HOSTMYSITE.'/account/my-banners-list/?moderl=1'     
   )).$this->control->GetText('bottmessageline')); 
    
  }//EnabledBannerItem
  
  protected function DisabledBannerItem($id) {  
   $this->control->db->UPDATEAction(
    'bunnerlist', array('activeobj' => 0), "iditem='$id' and activeobj='1'", "1"
   );    
  }//DisabledBannerItem 
	
 }//w_admin_admbunnerscontrol
 //-------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>