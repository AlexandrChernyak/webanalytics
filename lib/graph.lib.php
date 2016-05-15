<?php
 /** Модуль управления графическими объектами
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 /** общий класс изображения */
 abstract class w_graph_def extends w_defext {
  
  function __construct() {
   parent::__construct();	
  }//__construct
  
  /** перевод hex цвет в rgb (#FF0000 = 255,0,0) */
  function hex_to_rgb($hex) {
   if ($this->substr($hex, 0, 1) == '#') $hex = $this->substr($hex, 1);
   if ($this->strlen($hex) == 3) { $hex = $this->substr($hex, 0, 1).$this->substr($hex, 0, 1).
   $this->substr($hex, 1, 1).$this->substr($hex, 1, 1).$this->substr($hex, 2, 1).$this->substr($hex, 2, 1); }
   $rgb = array(0,0,0);
   if($this->strlen($hex) != 6) { return $rgb; }
   $rgb['R'] = hexdec($this->substr($hex,0,2));
   $rgb['G'] = hexdec($this->substr($hex,2,2));
   $rgb['B'] = hexdec($this->substr($hex,4,2));
   return $rgb;
  }//hex_to_rgb
  
  /** получение идентификатора цвета */
  function GetColorID($hex, $img, $alpha=0) {
   $rgb = $this->hex_to_rgb($hex);
   return ($img) ? @imagecolorallocatealpha($img, $rgb['R'], $rgb['G'], $rgb['B'], $alpha) : false;   	
  }//GetColorID
    
  static function calculateTextBox($text,$fontFile,$fontSize,$fontAngle) {
   $rect = imagettfbbox($fontSize,$fontAngle,$fontFile,$text); 
   $minX = min(array($rect[0],$rect[2],$rect[4],$rect[6]));
   $maxX = max(array($rect[0],$rect[2],$rect[4],$rect[6]));
   $minY = min(array($rect[1],$rect[3],$rect[5],$rect[7]));
   $maxY = max(array($rect[1],$rect[3],$rect[5],$rect[7]));
   return array(
    "left"   => abs($minX),
    "top"    => abs($minY),
    "width"  => $maxX - $minX,
    "height" => $maxY - $minY,
    "box"    => $rect
   );
  }//calculateTextBox

  /** получение длины текста */
  function GetStrWidth($str, $size, $fontfile, $angle = 0) {
   $data = self::calculateTextBox($str, $fontfile, $size, $angle);  
   return array('h' => $data['height'], 'w' => $data['width'], 'data' => $data['box'], 'rect' => $data);   	
  }//GetStrWidth
  
  /** разрушение изображения */
  function DestroyImage($img) { return (!$img) ? false : @imagedestroy($img); }
  
  /** изображение с сохранением прозрачности
  * @img - image resource
  * @newWidth - int or false - если необходимо изменить ширину изображения
  * @newHeight - int or false - если необходимо изменить высоту изображения
  * @AutoCorrect - bool автоматически корреткировать высоту и ширину при изминении размеров
  *  
  * @return - image resource    
  */
  function ConvertToTransperent($img, $newWidth=false, $newHeight=false, $AutoCorrect=true) {
   if (!$img) { return false; }	
   $w = @imagesx($img);
   $h = @imagesy($img);
   //корреткировка высоты и ширины
   if (($newWidth !== false || $newHeight !== false) && ($w != $newWidth || $h != $newHeight)) {
	//корректировка изменения отдельных высот
	if ($newWidth === false) $newWidth = $w;
	if ($newHeight === false) $newHeight = $h;
	//авторазмер
   	if ($AutoCorrect && ($newHeight != $h || $newWidth != $w)) {
	 $x = 1.0;
	 if ($w > $newWidth) $x = $newWidth / $w;
	 if (($h * $x) > $newHeight) $x = $newHeight / $h;
	 $newWidth  = @round($w * $x);
     $newHeight = @round($h * $x);
	}
	$canvas = @imagecreatetruecolor($newWidth, $newHeight);		
   } else {
   	//не изменять размеры   
    $canvas  = @imagecreatetruecolor($w, $h);
   } 
   @imagesavealpha($canvas, true);
   $tcolor = @imagecolorallocatealpha($canvas, 0, 0, 0, 127);
   @imagefill($canvas, 0, 0, $tcolor);
   $red = @imagecolorallocate($canvas, 255, 0, 0);
   @imagefilledellipse($canvas, 400, 300, 400, 300, $red);
   //изменить размер
   if ($newHeight && $newWidth && ($w != $newWidth || $h != $newHeight)) {
    @imagecopyresampled($canvas, $img, 0, 0, 0, 0, $newWidth, $newHeight, $w, $h); 
   } else {
	//не изменять размер
	@imagecopy($canvas, $img, 0, 0, 0, 0, $w, $h);
   }	
   @imagedestroy($img);
   return $canvas;   	
  }//ConvertToTransperent  
  
  /** копирование изображение на изображение */
  function CopyImage($image, $to, $toX=0, $toY=0, $doTransperentImage=false, $doTransperentTo=false, $pct=100) {   	
   if ($doTransperentImage) { $image = $this->ConvertToTransperent($image); }
   if ($doTransperentTo) { $to = $this->ConvertToTransperent($to); }	
   $w = @imagesx($image);
   $h = @imagesy($image);
   @imagecopymerge($to, $image, $toX, $toY, 0, 0, $w, $h, $pct);   
   return $to;	
  }//CopyImage  
  	
 }//w_graph_def 
 //-------------------------------------------------------------------------------------
 /** изображение */
 class w_image_obj extends w_graph_def {
  const INCER_TRANSPERENT_IMAGE = 3;		
  /** поддерживаемые типы файлов */
  private static $image_types = array("gif", "jpg", "png", "jpeg", "bmp", "ico");
  /** изображения без поддержки прозрачности */
  private static $no_transp_images = array("jpeg", "jpg", "bmp");
  /** библиотеки поддерживаемых форматов */
  private static $lib_files = array(
   'ico' => '/ather_lib/graph/ico_images.php',
   'bmp' => '/ather_lib/graph/bmp_images.php'
  ); 
  	
  /** изображение */
  var $img = null;
  /** тип изображения */
  var $img_type = 'png';
  /** качество quality (для jpeg, png) */
  var $quality  = false;
  /** фильтры (для png) */
  var $filters  = false;
  
  function __construct($img, $type) {
   parent::__construct();	
   $this->img = $img;
   $this->img_type = $type;   	
  }//__construct
  
  protected static function TypeFromString($str) {
   return (!$str) ? false : ((@substr($str, 0, 1) == '.') ? @substr_replace($str, '', 0, 1) : $str);	
  }//TypeFromString 
  
  /** инициализация библиотеки */
  protected static function RequiredLib($name) {
   if (!isset(self::$lib_files[$name]) || !@file_exists(W_SITEDIR . self::$lib_files[$name])) { 
   	return false; 
   }
   require_once W_SITEDIR . self::$lib_files[$name];
   return true;   	
  }//RequiredLib
  
  /** проверка инициализации библиотеки */
  protected static function CheckForRequiredLib($name, $funcname='imagecreatefrom') {
   return self::RequiredLib($name) && (!$funcname || @function_exists($funcname.$name));	
  }//CheckForRequiredLib
  
  /** получение поддерживаемых форматов */
  static function GetSupportedFormats() { return self::$image_types; }
  
  /** создание из файла */
  static function CreateFromFile($filename, $type=false, $fromurl=false) {  	
   if (!$fromurl && !@file_exists($filename)) { return false; }	
   if (!$type) { $type = @strrchr($filename, "." ); }
   if (!$type = strtolower(self::TypeFromString($type))) { return false; }
   $img = null;   
   switch ($type) {
	case 'gif' : $img = (!@function_exists('imagecreatefromgif')) ? false : @imagecreatefromgif($filename); break;
	case 'jpg' :
	case 'jpeg': $img = @imagecreatefromjpeg($filename); break;
	case 'png' : $img = @imagecreatefrompng($filename); break;
	case 'ico' : $img = (!self::CheckForRequiredLib('ico')) ? false : @imagecreatefromico($filename); break;
	case 'bmp' : $img = (!self::CheckForRequiredLib('bmp')) ? false : @imagecreatefrombmp($filename); break;
	//no support 	
	default: return false;
   }
   return (!$img) ? false : new w_image_obj($img, $type);   	
  }//CreateFromFile
  
  /** создание пустого объекта */
  static function CreateEmpty() {
   return new w_image_obj(null, false);	
  }//CreateEmpty 
  
  /** создание изображения из строки */
  static function CreateFromString($data, $type) {
   if (!$data || !$img = @imagecreatefromstring($data)) { return false; }
   return new w_image_obj($img, strtolower(self::TypeFromString($type)));   	
  }//CreateFromString
  
  /** создание пустого чистого изображения */
  static function CreateSimply($width, $height, $bgcolor='#000000', $transperent=false) {
   $image = @imagecreate($width, $height);      
   $image = new w_image_obj($image, 'png');
   if ($transperent) {
    $color = @ImageColorAllocate($image->img, 255, 255, 255);
    @imagecolortransparent($image->img, $color); 
   } elseif ($bgcolor) { $color = $image->GetColorID($bgcolor, $image->img); }	   
   return $image;	
  }//CreateSimply
  
  /** цвет под x, y
  * @return string hex цвет  
  */
  function colorAt($x, $y) {
   if (!$this->img) { return false; }
   $h = $this->GetImageHeight();
   $w = $this->GetImageWidth();
   if ($x < 0 || $x > $w || $y < 0 || $y > $h) { return false; }   		
   $rgb = @imagecolorsforindex($this->img, @imagecolorat($this->img, $x, $y));
   $rgb_arr = array('r' => $rgb['red'], 'g' => $rgb['green'], 'b' => $rgb['blue']);   
   foreach ($rgb_arr as $name => &$value) {
	$value = @dechex(($value <= 0) ? 0 : (($value >= 255) ? 255 : $value));	
	if ($this->strlen($value) == 1) { $value = '0'.$value; }
   }
   return $this->strtoupper('#'.$rgb_arr['r'].$rgb_arr['g'].$rgb_arr['b']);
  }//colorAt  
  
  /** замена цвета на указанный цвет
  * @colorSearch - string hex color
  * @colorReplace - string hexcolor
  * 
  * @alpha - int прозрачность цвета замены (заменяемого)
  * 
  * @return bool  
  */
  function ReplaceColor($colorSearch, $colorReplace, $alpha=false) {
   if (!$this->img || !$colorReplace || !$colorSearch) { return false; }   
   $width  = $this->GetImageWidth();
   $height = $this->GetImageHeight();   
   $colorSearch = $this->hex_to_rgb($colorSearch);       
   $colorReplaceX = false;   
   for($x=0; $x<$width; $x++) {
   	for($y=0; $y<$height; $y++) {	
   	 $rgb = @imagecolorsforindex($this->img, @imagecolorat($this->img, $x, $y)); 
   	 $r = $rgb['red'];
   	 $g = $rgb['green'];
   	 $b = $rgb['blue'];   	 
	 $alpha1 = ($alpha === false && isset($rgb['alpha'])) ? $rgb['alpha'] : (($alpha === false) ? 0 : $alpha);    
   	 if ($colorSearch['R'] == $r && $colorSearch['G'] == $g && $colorSearch['B'] == $b) {
	  if ($colorReplaceX === false) { $colorReplaceX = $this->GetColorID($colorReplace, $this->img, $alpha1); }
	  @imagesetpixel($this->img, $x, $y, $colorReplaceX);	  		
	 }	 			
   	}   	
   }
   return true;   	
  }//ReplaceColor
  
  /** вывод изображения в браузер */
  protected function _OutImageTo($format, $asString=false) {
   if (!$this->img || !$format) { return false; }
   if ($asString) { 
   	@ob_start();
   	@call_user_func('image'.$format, $this->img);
   	$data = @ob_get_clean();
	return $data;	    
   }
   return @call_user_func('image'.$format, $this->img);   	
  }//_OutImageTo
  
  /** вывести изображение как png 
  * @asString - bool если true - вернет иконку строкой, или выведет в браузер
  * 
  * @return - если $asString - string, иначе bool  
  */  
  function OutAsPng($asString=false) { return $this->_OutImageTo('png', $asString); }
  
  /** вывести изображение как gif 
  * @asString - bool если true - вернет иконку строкой, или выведет в браузер
  * 
  * @return - если $asString - string, иначе bool  
  */
  function OutAsGif($asString=false) { return $this->_OutImageTo('gif', $asString); }
  
  /** вывести изображение как jpeg 
  * @asString - bool если true - вернет иконку строкой, или выведет в браузер
  * 
  * @return - если $asString - string, иначе bool  
  */
  function OutAsJpeg($asString=false) {return $this->_OutImageTo('jpeg', $asString); }
  
  /** вывести изображение как ico 
  * @asString - bool если true - вернет иконку строкой, или выведет в браузер
  * 
  * @return - если $asString - string, иначе bool  
  */
  function OutAsIco($asString=false) {
   return (!self::CheckForRequiredLib('ico', 'image')) ? false : $this->_OutImageTo('ico', $asString);
  }//OutAsIco
  
  /** вывести изображение как bmp 
  * @asString - bool если true - вернет иконку строкой, или выведет в браузер
  * 
  * @return - если $asString - string, иначе bool  
  */
  function OutAsBmp($asString=false) {
   return (!self::CheckForRequiredLib('bmp', 'image')) ? false : $this->_OutImageTo('bmp', $asString);
  }//OutAsIco
  
  /** вывод изображения в браузер или файл
  * @return bool  
  */
  function OutImage($tofile=false) {
   if (!$this->img || !$this->img_type) { return false; }      
   switch ($this->img_type) {
	case 'gif':  return ($tofile) ? @imagegif($this->img, $tofile) : @imagegif($this->img);
	case 'jpg':
	case 'jpeg': 
	 return ($this->quality !== false) ? (($tofile) ? @imagejpeg($this->img, $tofile, $this->quality) : 
	 @imagejpeg($this->img)) : (($tofile) ? @imagejpeg($this->img, $tofile) : @imagejpeg($this->img));	 
	case 'png':  
	 return ($tofile) ? (($this->quality !== false && $this->filters !== false) ? 
	 @imagepng($this->img, $tofile, $this->quality, $this->filters) : @imagepng($this->img, $tofile)) : 
	 @imagepng($this->img);
	case 'ico': 
	 return (!self::CheckForRequiredLib('ico', 'image')) ? false : @imageico($this->img, ($tofile) ? $tofile : '');
	case 'bmp': 
	 return (!self::CheckForRequiredLib('bmp', 'image')) ? false : @imagebmp($this->img, ($tofile) ? $tofile : '');
	//no supported  
	default: return false;
   }   	
  }//OutImage 
  
  /** вывод изображения в переменную
  * @return string  
  */
  function OutImageTo() {
   @ob_start();
   $this->OutImage();
   $data = @ob_get_clean();
   return $data;	
  }//OutImageTo
  
  /** установка параметров Jpeg */
  function SetJpegParameters($quality=false) { $this->quality = $quality; }
  
  /** установка параметров png */
  function SetPngParameters($quality=false, $filters=false) {
   $this->filters = $filters;
   $this->quality = $quality;	
  }//SetPngParameters
  
  /** ширина */
  function GetImageWidth() { return (!$this->img) ? false : @imagesx($this->img); }
  
  /** высота */
  function GetImageHeight() { return (!$this->img) ? false : @imagesy($this->img); }
  
  /** изменить размеры изображения (прозрачность сохраняется)
  * @return bool  
  */
  function ResizeImage($newWidth, $newHeigh, $autoCorrect=false) {
   if (!$this->img) { return false; }
   $this->img = $this->ConvertToTransperent($this->img, $newWidth, $newHeigh, $autoCorrect);	
   return true;	
  }//ResizeImage
  
  /** разрушить изображение */
  function DestroyImage() { return parent::DestroyImage($this->img); }	
  
  /** разрушить изображение
  * alias to DestroyImage with parameter
  * Если указан параметр $img - попытается разрушить его, или основной   
  */
  function FreeImage($img=false) { return (!$img) ? $this->DestroyImage() : parent::DestroyImage($img); }
  
  /** запись текста на изображение */
  function WriteTTFText($text, $fontname, $x, $y, $color='#000000', $size=12, $angle=0, $alpha=0) {
   return (!$this->img) ? false : 
   @imagettftext(
    $this->img, $size, $angle, $x, $y, $this->GetColorID($color, $this->img, $alpha), $fontname, $text  
   );	
  }//WriteTTFText
  
  /** копирование изображения на текущее изображение
  * @image - resource or w_image_obj  
  */
  function CopyImage($image, $toX=0, $toY=0, $doTransperentImage=false, $doTransperentTo=false, $pct=100) {
   if (!$this->img) { return false; }			
   return $this->img = parent::CopyImage(
    (@is_object($image)) ? $image->img : $image, $this->img, $toX, $toY, 
	$doTransperentImage, $doTransperentTo, $pct
   );   	
  }//CopyImage
  
  /** вывод заголовка изображения */
  function OutImageHeaderType() { @header("Content-type: image/".$this->img_type); } 
  
  /** проверка поддержки прозрачности */
  function IsSupportTransperent() { return $this->img && !@in_array($this->img_type, self::$no_transp_images); }
  
  /** получение степени непрозрачности для отрисовки
  * Если прозрачность не поддерживается - значение от 0 до 127
  * Если прозрачность поддерживается - значение от 0 до 100
  * Используетсядля рисования текста или копировании изображения.    
  */
  protected function GetNoTransperentValue($value) {
   $value = ($value < 0 || $value > 100) ? 100 : $value;	
   return ($this->IsSupportTransperent()) ? $value : @round(127 - ((127 * $value) / 100));   	
  }//GetNoTransperentValue
  
  /** получение реальной ширины и высоты текста
  *   в зависимости от возможности поддерживать прозрачность,
  *   если прозрачность поддерживается - учитывается отступ от края для
  *   корректной отрисовки на изображении без потери прозрачного фона исходного изображения     
  */
  function GetRealHeightAndWidth($text, $size, $fontfile, $angle=0) {
   if (!$text_info = $this->GetStrWidth($text, $size, $fontfile, $angle)) { return false; }
   $incer = ($this->IsSupportTransperent()) ? self::INCER_TRANSPERENT_IMAGE : 0;
   return array(
    'w' => $text_info['w'] + $incer,
    'h' => $text_info['h'] + $incer
   );   	
  }//GetRealHeightAndWidth
  
  /** отрисовка текста на изображение без потери прозрачности фона исходного изображения
  * @return false or array(
  *  'w' => реальная ширина текста
  *  'h' => реальная высота текста 
  * )  
  */
  function WriteTextToImage($text, $fontfile, $x, $y, $color='#000000', $size=12, 
   $angle=0,$notransperent=100, $additional_width=0) {
    
   if (!$this->img) { return false; }
   //text info
   if (!$text_info = $this->GetStrWidth($text, $size, $fontfile, $angle)) { return false; }
   //прозрачность
   $notransperent = $this->GetNoTransperentValue($notransperent); 
   //ширина высота
   $w = $text_info['w'];
   $h = $text_info['h'];
     
   //только текст
   if (!$this->IsSupportTransperent()) {
   	$x = $text_info['rect']['left'] + $x;
    $y = $text_info['rect']['top']  + $y;
	$this->WriteTTFText($text, $fontfile, $x, $y, $color, $size, $angle, $notransperent);
   } else {
   	//скопировать сохранив прозрачность фона
   	$w+=self::INCER_TRANSPERENT_IMAGE;
    $h+=self::INCER_TRANSPERENT_IMAGE;
    
    if ($additional_width == -1) {
      $w*=2;
    }    
    
	$scr = w_image_obj::CreateSimply($w, $h, '', true);
	$x1 = $text_info['rect']['left'] + 1;// + ($w / 2) - ($text_info["w"] / 2);
	$y1 = $text_info['rect']['top'] + 1;// + ($h / 2) - ($text_info["h"] / 2);
	$scr->WriteTTFText($text, $fontfile, $x1, $y1, $color, $size, $angle);
	$this->CopyImage($scr, $x, $y, false, true, $notransperent);
	$scr->DestroyImage();	
   }
   //ok finish
   return array('w'=>$w, 'h'=>$h);
  }//WriteTextToImage
    	
 }//w_image_obj
 //-------------------------------------------------------------------------------------
 /** объект информера, запись, чтение и т.д */
 class w_informer_graph_obj extends w_defext {
  protected 
   $control,
   $options,
   $idents,
   $imageinfo;
  var $image; 	
  
  function __construct(w_Control_obj $control, $identifies, $imageinfo, $options, $image) {
   parent::__construct();
   $this->control = $control;
   $this->idents  = $identifies;
   $this->imageinfo = $imageinfo;
   $this->options = ($options !== false) ? $options : self::PrepereParamsStr($imageinfo['options']);
   $this->image = $image;	
  }//__construct	
  
  /** получение идентификатора числового из строки */
  static function GetPositionParameters($ident, $str) {
   return (@preg_match('/'.$ident.':([0-9]*)/is', $str, $arr)) ? $arr[1] : false;	
  }//GetPositionParameters
  
  /** получение идентификатора цвета из строки */
  static function GetColorParameters($ident, $str) {
   return (@preg_match('/'.$ident.':([#0-9a-z]*)/is', $str, $arr)) ? $arr[1] : false;	
  }//GetPositionParameters
  
  /** получение идентификатора угола наклона из строки */
  static function GetAngleParameters($ident, $str) {
   return (@preg_match('/'.$ident.':([0-9\-]*)/is', $str, $arr)) ? $arr[1] : false;	
  }//GetPositionParameters
  
  /** обработка строки параметров */
  static function PrepereParamsStr($data) {
   return @preg_replace("/[^a-z:0-9,#\r\n]/is", '', $data);	
  }//PrepereParamsStr
  
  /** создание элемента класса */
  static function CreateObj(w_Control_obj $control, $identifies, $imageinfo, $options, $filename=false) {
   $filename = (!$filename) ? W_DEFAULTINFORMERSPATH.'/'.$imageinfo['dwname'] : $filename;
   $image = w_image_obj::CreateFromFile($filename, $imageinfo['imagetype']);   	
   return (!$imageinfo || !$image) ? false : new w_informer_graph_obj(
    $control, $identifies, $imageinfo, $options, $image
   );	
  }//CreateObj
  
  /** обработка элемента */
  protected function ProcessedElement($name, $value) {
   if (!$this->image) { return false; }
   //repl color
   if ($name == 'REPLcolor') { return true; }
   //позиция
   $x = self::GetAngleParameters('x'.$name, $this->options);
   $y = self::GetAngleParameters('y'.$name, $this->options);
   if ($x === false || $x == '' || $y === false || $y == '') { return false; }
   //цвет замены
   $color_repl = self::GetColorParameters('xREPcolor', $this->options);
   //цвет
   $color = self::GetColorParameters('x'.$name.'color', $this->options);
   $color = (!$color) ? '#000000' : $color;
   if (isset($this->idents['REPLcolor']) && $color == $color_repl) {
	$color = @str_replace('_r_', '#', $this->idents['REPLcolor']);
   }  
   //прозрачность
   $transperent = self::GetPositionParameters('x'.$name.'transperent', $this->options);
   $transperent = ($transperent === false || $transperent == '') ? 100 : $transperent;
   //угол наклона
   $angle = self::GetAngleParameters('x'.$name.'angle', $this->options);
   $angle = ($angle === false || $angle == '') ? 0 : $angle;
   //размер текста
   $size = self::GetPositionParameters('x'.$name.'size', $this->options);
   $size = (!$size) ? 12 : $size;
   //шрифт
   $font = self::GetPositionParameters('x'.$name.'font', $this->options);
   $font = (!$font) ? 0 : $font;
   $font = $this->control->GetFont($font, true);
   $font = ($font) ? $font['filename'] : 'Arial';
   //ok отрисовка данных
   $this->image->WriteTextToImage($value, $font, $x, $y, $color, $size, $angle, $transperent, -1);
   return true;   	
  }//ProcessedElement  
		
  /** замена цвета элемента */
  protected function ProcessReplaceColor($value) {  	
   if (!$value) { return false; }	
   $color = self::GetColorParameters('xREPcolor', $this->options);
   if (!$color) { return false; }
   //replace $color to $value
   return $this->image->ReplaceColor(@str_replace('_r_', '#', $color), @str_replace('_r_', '#', $value)); 	
  }//ProcessReplaceColor
  
  /** отработка данных, отрисовка на изображение
  * @return bool  
  */
  function ProcessPaint() {
   if (!$this->idents || !$this->image) { return false; }
   $this->image->ResizeImage(false, false);	
   $replace_color = false;   
   foreach ($this->idents as $name => $value) {
   	if ($name) { $this->ProcessedElement($name, $value); }
	//repl color
	if ($name == 'REPLcolor' && !$replace_color) { $replace_color = $value; }   
   }
   //replace color
   if ($replace_color) { $this->ProcessReplaceColor($replace_color); }
   return true;   	
  }//ProcessPaint 
  
  /** вывод текущего изображения в браузер
  * @return bool  
  */
  function OutImage($setheaderinfo=true, $tofile=false) {
   if (!$this->image) { return false; }
   if ($setheaderinfo) { $this->image->OutImageHeaderType(); }
   return $this->image->OutImage($tofile);   	
  }//OutImage
  
  /** вывод текущего изображения в переменную
  * @return string or false  
  */
  function OutImageTo() { return (!$this->image) ? false : $this->image->OutImageTo(); }
  
  /** уничтожение изображения */
  function DestroyImage() { if ($this->image) { $this->image->DestroyImage(); } }
	
 }//w_informer_graph_obj
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>