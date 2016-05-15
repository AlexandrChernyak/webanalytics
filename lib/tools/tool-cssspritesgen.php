<?php
 /** Модуль управления инструментом `объединение изображений CSS Sprites`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_cssspritesgen extends w_toolitem_noajax_method {	
  const FILE_IDENT = 'image';  
  private static $files_type = array(".gif", ".jpg", ".png", ".jpeg", ".ico",/* ".bmp"*/);  
  protected
   $result; 
  /** максимальное кол-во изображений */
  var $msximagescount = 30;
  	
  function GetListTypes() { return $this->control->GenerateArrayString(self::$files_type,', ', '"<b>', '"</b>'); }
    
  function _DoActionThisTool() {
   if ($this->GetToolLimitInfoEx('maximagesize')) {
    $this->result = array(
	 'maxsize' => ss_HTMLPageInfo::GetSizeStrX($this->GetToolLimitInfoEx('maximagesize') * 1024)
	);	
   } else { $this->result = array(); }
   
   if ($this->GetToolLimitInfoEx('maximagescount')) {
    $this->msximagescount = $this->GetToolLimitInfoEx('maximagescount');
   }
      
   //инициализация диалога выбора цвета
   /* css */
   $this->AddSectionInfoNew('csslist', 'colordlg/colorpicker.php');
   /* js */
   $this->AddSectionInfoNew('jslist', 'colordlg/colorpicker.js');
   $this->AddSectionInfoNew('jslist', 'colordlg/eye.js');
   $this->AddSectionInfoNew('jslist', 'colordlg/utils.js');
   $this->AddSectionInfoNew('jslist', 'colordlg/layout.js?ver=1.0.2');  
    
   //ok, follow to action
   if ($_POST['doactiontool'] != 'do') { return true; }
   
   //check it
   if (!$_POST['countimageslst'] || !@is_numeric($_POST['countimageslst'])) {
    return $this->SetError('No found Elements count ID!');
   }
   
   if ($_POST['countimageslst'] > $this->msximagescount) {
    $_POST['countimageslst'] = $this->msximagescount;
   }
   
   if (!$_POST['padimage'] || !@is_numeric($_POST['padimage']) || $_POST['padimage'] <= 0) {
    $_POST['padimage'] = 0;    
   }
   
   $_POST['bgcol'] = @trim($_POST['bgcol']);
   if (!$_POST['bgcol'] || $this->substr($_POST['bgcol'], 0, 1) != '#') {
    $_POST['bgcol'] = false;
   }
   
   switch ($_POST['imagettp']) {
    case '.png':
    case '.gif':
    case '.jpg': break;    
    default: return $this->SetError('Unknow final Image type!');
   } 
   
   //ok parse them
   return $this->ParseImagesList();   	
  }//_DoActionThisTool
  
  protected function ParseImagesList() {
   $this->result['list'] = array();
   
   //get all params
   $max_width = $max_height = $image_height = $image_width = 0;  
   require_once W_LIBPATH.'/graph.lib.php';
   
   for ($i=1; $i <= $_POST['countimageslst']; $i++) {
    if (!isset($_FILES[self::FILE_IDENT.$i]["name"]) || !$_FILES[self::FILE_IDENT.$i]["name"]) { continue; }
    
    $name = $_FILES[self::FILE_IDENT.$i]["name"];
    $ft = $this->strtolower(@strrchr($name, "." ));
    
    if (!$ft || !@in_array($ft, self::$files_type)) { continue; }
     
    if (!$bytesize = $_FILES[self::FILE_IDENT.$i]["size"]) { continue; }
    
    $bytesize = @round($bytesize / 1024, 2);
   
    if ($this->GetToolLimitInfoEx('maximagesize') && $bytesize > $this->GetToolLimitInfoEx('maximagesize')) {
   	 continue; 
    }
        
    $filename = $_FILES[self::FILE_IDENT.$i]['tmp_name'];
    if (!@is_uploaded_file($filename)) { continue; }
            
//    if ($ft == '.ico') {
           
     if (!$ico = w_image_obj::CreateFromFile($filename, $ft)) { continue; }
     $w = $ico->GetImageWidth();
     $h = $ico->GetImageHeight();
     $ico->DestroyImage();
      
//    } else {    
//     
//     if (!$pic_info = @getimagesize($filename)) { continue; }  
//     $w = $pic_info[0];
//     $h = $pic_info[1];
//     
//    }    
    
    if (!$w || !$h) { continue; }
    
    if ($max_width < $w) $max_width = $w;
    if ($max_height < $h) $max_height = $h;
    
    switch ($_POST['imagealign']) {
     case 'vertical'  : $image_height += ($h + $_POST['padimage']); break;
     case 'gorizontal': $image_width += ($w + $_POST['padimage']); break;
     default: continue; 
    }
    
    //combine info pack
    $j = '';
    while (isset($this->result['list'][((!$j) ? '' : "$j-").$name])) {
     if (!$j) { $j = 1; } else { $j++; }        
    }
    
    $name = ((!$j) ? '' : "$j-").$name;
    
    $this->result['list'][$name] = array(     
      'w' => $w,
      'h' => $h,
      'filename' => $filename,
      'type' => $ft   
    );
    
   } //for 
    
   if (!$image_height) $image_height = $max_height;
   if (!$image_width) $image_width = $max_width;
   
   if (!$image_height || !$image_width) { return $this->SetError('No Images for CSS Sprites found!'); }
   
   //ok, generate them
      
   //$image = w_image_obj::CreateSimply(
   // $image_width, $image_height, ($_POST['bgcol']) ? $_POST['bgcol'] : '', ($_POST['bgcol']) ? false : true 
   //);
   
   $image = $this->CreateImage($image_width, $image_height, $_POST['imagettp']);
   
   if (!$image) { return $this->SetError('Can`t create final Image!'); }
   
   //action to
   $top = 0;
   $left = 0;
   
   $cssfile = "/* CSS file for Sprites, generated by ".W_HOSTMYSITE." */\r\n\r\n";
   $cssfile .= " .sprites-class {\r\n   background:url(sprites-image{$_POST['imagettp']});\r\n }\r\n\r\n\r\n";  
   
   $index = 0;
   foreach ($this->result['list'] as $name => &$item) {
    
    if (!$item_image = w_image_obj::CreateFromFile($item['filename'], $item['type'])) {
     $item['error'] = true;   
    } else {   
        
     $index++;
     $cssfile .= " /*  #$index For get Image `$name` (width: {$item['w']}px, height: {$item['h']}px) use ".
     "style `background-position`\r\n"; 
     
     
     //@imagecopy($image->img, $item_image->img, $left, $top, 0, 0, $item['w'], $item['h']);
     //$image->ResizeImage(false, false);
     
     @imagecopy($image, $item_image->img, $left, $top, 0, 0, $item['w'], $item['h']);        
    }
        
    switch ($_POST['imagealign']) {
     case 'vertical'  : 
      if ($item_image) {
       
       $cssfile .= "  style=\"background-position: 0 ".(($top) ? -$top : $top).'px'; 
  
      }
      $top += ($item['h'] + $_POST['padimage']); 
     break;
     
     case 'gorizontal': 
      if ($item_image) {
       
       $cssfile .= "  style=\"background-position: ".(($left) ? -$left : $left).'px 0';  
        
      }
      $left += ($item['w'] + $_POST['padimage']); 
     break;
    }
    
    if ($item_image) {
        
     if ($this->CheckPostValue('setwh')) {
       $cssfile .= "; width: {$item['w']}px; height: {$item['h']}px"; 
     }     
     
     $cssfile .= "\"\r\n */\r\n\r\n\r\n";   
     $item_image->DestroyImage();
     //unset($item_image);   
    }     
   }    
    
   $data = '';
   switch ($_POST['imagettp']) {
    case '.png': $data = $this->_OutImageTo($image, 'png', true); break;  //$data = $image->OutAsPng(true);  break;   
    case '.gif': $data = $this->_OutImageTo($image, 'gif', true); break; //$data = $image->OutAsGif(true); break;
    case '.jpg': $data = $this->_OutImageTo($image, 'jpeg', true); break; //$data = $image->OutAsJpeg(true); break;    
    default: return $this->SetError('Unknow final Image type!');
   }
   
   @imagedestroy($image);     
   
   require_once W_SITEDIR.'/ather_lib/zip.class.php';
   $zip = new Zip();      
   
   $zip->setComment("CSS file and Image for Sprites,\ngenerated by ".W_HOSTMYSITE);
   
   $zip->addFile($data, "sprites-image{$_POST['imagettp']}");
   $zip->addFile($cssfile, 'sprites.css');
   
   $zip->sendZip("sprites.zip");   
   exit;    
  }//ParseImagesList
  
  protected function CreateImage($w, $h, $type) {      
    $img = @imagecreatetruecolor($w, $h); 
    
    if ($type == '.png') { 
     @imagealphablending($img, false);
     @imagesavealpha($img, true);
    }
    
    if ($_POST['bgcol']) {
      
      $tcolor = $this->GetColorID($_POST['bgcol'], $img);
      @imagefill($img, 0, 0, $tcolor);
      return $img;  
        
    }         
    
    if ($type == '.png') {    
     $tcolor = @imagecolorallocatealpha($img, 0, 0, 0, 127);
     @imagefill($img, 0, 0, $tcolor);
 
     $red = @imagecolorallocate($img, 255, 0, 0);
     @imagefilledellipse($img, 400, 300, 400, 300, $red);
    } 
    
    elseif ($type == '.gif') {
      
      $tcolor = @imagecolorallocate($img, 255, 255, 255);
      @imagefill($img, 0, 0, $tcolor);
      @imagecolortransparent($img, $tcolor);        
     
    }
    
    return $img;      
  }//CreateImage
  
  protected function _OutImageTo($image, $format, $asString=false) {
   if ($asString) { 
   	@ob_start();
   	@call_user_func('image'.$format, $image);
   	$data = @ob_get_clean();
	return $data;	    
   }
   return @call_user_func('image'.$format, $image);   	
  }//_OutImageTo
  
  protected function hex_to_rgb($hex) {
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
  
  protected function GetColorID($hex, $img, $alpha=0) {
   $rgb = $this->hex_to_rgb($hex);
   return ($img) ? @imagecolorallocatealpha($img, $rgb['R'], $rgb['G'], $rgb['B'], $alpha) : false;   	
  }//GetColorID    
  	
 }//w_toolitem_cssspritesgen

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>