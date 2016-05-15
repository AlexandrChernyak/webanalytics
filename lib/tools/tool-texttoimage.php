<?php
 /** Модуль управления инструментом `нанесение текста на изображение`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_texttoimage extends w_toolitem_noajax_method {
  const FILE_IDENT = 'image';
  /** доступные типы картинок по умолчанию */	
  private $image_types = array(".gif", ".jpg", ".png", ".jpeg"/*, ".ico", ".bmp"*/);		
  protected
   $result;
   
  function __construct(w_Control_obj $control, $section_id) {
   parent::__construct($control, $section_id);
   //список поддерживаемых типов изображений
   if ($this->GetToolLimitInfoEx('imagetypes') && @is_array($this->GetToolLimitInfoEx('imagetypes'))) {
	$this->image_types = $this->GetToolLimitInfoEx('imagetypes');
   }	
  }//__construct
  
  /** список допустимых типов изображений */
  function GetListTypes() {
   return $this->control->GenerateArrayString($this->image_types,', ', '"<b>', '"</b>');	
  }//GetListTypes    
       
  function _DoActionThisTool() {		  	 
   if ($this->GetToolLimitInfoEx('maximagesize')) {
    $this->result = array(
	 'maxsize' => ss_HTMLPageInfo::GetSizeStrX($this->GetToolLimitInfoEx('maximagesize') * 1024)
	);	
   }
   //инициализация диалога выбора цвета
   /* css */
   $this->AddSectionInfoNew('csslist', 'colordlg/colorpicker.php');
   /* js */
   $this->AddSectionInfoNew('jslist', 'colordlg/colorpicker.js');
   $this->AddSectionInfoNew('jslist', 'colordlg/eye.js');
   $this->AddSectionInfoNew('jslist', 'colordlg/utils.js');
   $this->AddSectionInfoNew('jslist', 'colordlg/layout.js?ver=1.0.2'); 
   //список шрифтов
   if (!$this->result) $this->result = array();
   $this->result['fonts'] = $this->control->GetFontList();
   //check requst   
   if ($_POST['doactiontool'] != 'do') { return false; } 
   if (!$this->result) $this->result = array();   
   //ok проверка загрузки изображения
   $filetypeIDstr = @strrchr($_FILES[self::FILE_IDENT]["name"], "." );
   if (!$filetypeIDstr) { return $this->SetError($this->GetText('fileformatnotmatch')); }
   $filetypeIDstr = $this->strtolower($filetypeIDstr);
   //проверка соответствия типу
   if (!@in_array($filetypeIDstr, $this->image_types)) { 
   	return $this->SetError($this->GetText('filetypenoident', array($filetypeIDstr, $this->GetListTypes()))); 
   }
   //ok проверка размера
   $bytesize = $_FILES[self::FILE_IDENT]["size"];   
   $bytesize = @round($bytesize / 1024, 2);
   if ($this->GetToolLimitInfoEx('maximagesize') && $bytesize > $this->GetToolLimitInfoEx('maximagesize')) {
   	return $this->SetError(
	 $this->GetText('filesizenomathon', array($bytesize, $this->GetToolLimitInfoEx('maximagesize'), 
	 ($bytesize - $this->GetToolLimitInfoEx('maximagesize'))))
	); 
   }
   //пустой файл
   if ($bytesize <= 0) { return $this->SetError($this->GetText('fileisempty')); }
   //ok
   if (!@is_uploaded_file($_FILES[self::FILE_IDENT]['tmp_name'])) { 
    return $this->SetError($this->GetText('errorindwloadfile')); 
   }
   //ok action
   require_once W_LIBPATH.'/graph.lib.php';
   /* проверка параметров наложения */
   //текст
   $_POST['txt'] = ($_POST['txt'] == '') ? W_HOSTMYSITE : $_POST['txt'];
   //размер
   if (!$_POST['fontsize'] || !@is_numeric($_POST['fontsize']) || $_POST['fontsize'] <= 0) {
	$_POST['fontsize'] = 12;
   }
   //цвет текста
   $_POST['color'] = (!$_POST['color']) ? '#000000' : $_POST['color'];
   //непрозрачность
   if (!@is_numeric($_POST['transperent']) || $_POST['transperent'] > 100 || $_POST['transperent'] < 0) {
	$_POST['transperent'] = 70;
   }
   //угол наклона
   if ($_POST['angle'] == '' || !@is_numeric($_POST['angle'])) { $_POST['angle'] = 0; }
   //шрифт текста
   $_POST['textfont'] = $this->control->GetFont($_POST['textfont'], true);
   if (!$_POST['textfont']) { return $this->SetError($this->GetText('noidentfontdata')); }
   //положение по горизонтали
   switch ($_POST['textpositionX']) {
	case 'left':
	case 'center':
	case 'right': break;
	default:
	 if ($_POST['textpositionX'] == '' || !@is_numeric($_POST['textpositionX'])) { $_POST['textpositionX'] = 10; }
	 break;
   }
   //положение по вертикали
   switch ($_POST['textpositionY']) {
	case 'top':
	case 'center':
	case 'down': break;
	default:
	 if ($_POST['textpositionY'] == '' || !@is_numeric($_POST['textpositionY'])) { $_POST['textpositionY'] = 10; }
	 break;
   }
   //отступ от края изображения
   if ($_POST['border'] == '' || !@is_numeric($_POST['border'])) { $_POST['border'] = 10; }
   //create general image  
   $image = w_image_obj::CreateFromFile($_FILES[self::FILE_IDENT]['tmp_name'], $filetypeIDstr);
   if (!$image) { return $this->SetError('Error in create image data!'); }
   //отрисовка изображения scr
   $text_info = $image->GetStrWidth($_POST['txt'], $_POST['fontsize'], $_POST['textfont']['filename'], $_POST['angle']);
   if (!$text_info) { return $this->SetError('Error in get input text info!'); }
   //высота и ширина блока отрисоки
   $w = $text_info['w'] + $_POST['border'] * 2;
   $h = $text_info['h'] + $_POST['border'] * 2;
   //выбор формата
   if (@in_array($filetypeIDstr, array('.jpg', '.jpeg', '.bmp'))) {
    //текст
	$this->DoText($image, $w, $h, $this->GetTransperent(false), $text_info);	
   } else {
	//сделать блок
	$scr = w_image_obj::CreateSimply($w, $h, '', true);
	$x = $text_info['rect']['left'] + ($w / 2) - ($text_info["w"] / 2);
	$y = $text_info['rect']['top'] + ($h / 2) - ($text_info["h"] / 2);	
	$scr->WriteTTFText(
     $_POST['txt'], $_POST['textfont']['filename'], $x, $y, $_POST['color'], $_POST['fontsize'], $_POST['angle']
    );
    //координаты отрисовки
    $position = $this->GetPosition($w, $h, $image);
    //отрисовка изображения
    $image->CopyImage($scr, $position['x'], $position['y'], false, true, $this->GetTransperent());
    $scr->DestroyImage();
   }
   //вывод   
   $data = $image->OutImageTo();    
   $image->FreeImage();
   //вывести
   $this->control->WriteDownLoadFileHeader($_FILES[self::FILE_IDENT]["name"], @strlen($data)); 
   echo $data;
   exit; 
      
   return true;   	
  }//_DoActionThisTool
  
  /** позиция элемента на изображении */
  protected function GetPosition($Itemwidth, $ItemHeight, w_image_obj $im, $is_text=false) {
   $x = 0; $y = 0;
   $w = $im->GetImageWidth();
   $h = $im->GetImageHeight();
   //горизонтально
   switch ($_POST['textpositionX']) {
  	case 'left'   : $x = ($is_text) ? $_POST['border'] : $x; break;
	case 'center' : $x = @floor($w / 2) - @floor($Itemwidth / 2); break;
	case 'right'  : $x = ($is_text) ? ($w - $Itemwidth - $_POST['border']) : ($w - $Itemwidth); break; 
	default       : $x = $_POST['textpositionX']; break;
   }	
   //вертикально
   switch ($_POST['textpositionY']) {
  	case 'top'    : $y = ($is_text) ? $_POST['border'] : $y;  break;
	case 'center' : $y = @floor($h / 2) - (($is_text) ? 0 : @floor($ItemHeight / 2)); break;
	case 'down'   : $y = ($is_text) ? ($h - $ItemHeight) : ($h - $ItemHeight); break;
	default       : $y = $_POST['textpositionY']; break;
   }
   return array(
    'x' => $x,
    'y' => $y
   );   	
  }//GetPosition
  
  /** отрисовка текста поверх изображения */
  protected function DoText(w_image_obj $im, $w, $h, $alpha=0, $text_info=false) {   
   $position = $this->GetPosition($w, $h, $im, true);
   $x = $text_info['rect']['left'] + $position['x'];
   $y = $text_info['rect']['top'] +  $position['y'];   
   $im->WriteTTFText(
    $_POST['txt'], $_POST['textfont']['filename'], $x, $y, 
	$_POST['color'], $_POST['fontsize'], $_POST['angle'], $alpha
   );
   return true;   	
  }//DoText
  
  /** идентификатор прозрачности */
  protected function GetTransperent($isnoJPG=true) {
   return ($isnoJPG) ? $_POST['transperent'] : @round(127 - ((127 * $_POST['transperent']) / 100));   	
  }//GetTransperent
  	
 }//w_toolitem_texttoimage

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>