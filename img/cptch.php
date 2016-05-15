<?php
 /** Вывод изображения каптчи
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 @ini_set('display_errors', 0);
 @error_reporting(E_ALL & ~E_NOTICE);
 //-------------------------------------------------------------------------------------
 session_start();
 //-------------------------------------------------------------------------------------
 class w_graph_elements {

  private function hex_to_rgb($hex, $def) {
   if(substr($hex,0,1) == '#')  $hex = substr($hex,1);
   if(strlen($hex) == 3) { $hex = substr($hex,0,1).substr($hex,0,1).
   substr($hex,1,1).substr($hex,1,1).substr($hex,2,1).substr($hex,2,1); }
   $rgb = $def;
   if(strlen($hex) != 6) { return $rgb; }
   $rgb['R'] = hexdec(substr($hex,0,2));
   $rgb['G'] = hexdec(substr($hex,2,2));
   $rgb['B'] = hexdec(substr($hex,4,2));
   return $rgb;
  }//hex_to_rgb	
	
  function PaintImage($bordercolor, $bgcolor, $linescolor, $textcolor, $width=61, $height=20, $size=4) {	    	
   $bordercolor = @$this->hex_to_rgb($bordercolor, array('R'=>195,'G'=>204,'B'=>206));
   $bgcolor = @$this->hex_to_rgb($bgcolor, array('R'=>241,'G'=>243,'B'=>244));
   $linescolor = @$this->hex_to_rgb($linescolor, array('R'=>194,'G'=>194,'B'=>133));   
   $textcolor = @$this->hex_to_rgb($textcolor, array('R'=>4,'G'=>82,'B'=>148));
   $text = 'error';
   if (isset($_GET['tim']) && ($_GET['tim'] != '')) {
	$text = ($_SESSION["sendnumb".$_GET['tim']] != '') ? $_SESSION["sendnumb".$_GET['tim']] : $text;
   }      
   $width  = (!$width || !@is_numeric($width)) ? 61 : $width;
   $height = (!$height || !@is_numeric($height) || ($height < 10)) ? 20 : $height;     
   $size = (!$size || !@is_numeric($size)) ? 4 : $size;
   $img = imagecreate($width, $height);//create inage
   @imagecolorallocate($img, $bgcolor['R'], $bgcolor['G'] ,$bgcolor['B']);
   $rectcolor = imagecolorallocate($img, $bordercolor['R'], $bordercolor['G'] ,$bordercolor['B']); 
   @imagerectangle($img, 0, 0, $width-1, $height-1, $rectcolor); //rect act
   $textcolor = imagecolorallocate($img, $textcolor['R'], $textcolor['G'] ,$textcolor['B']);
   $textcolor_sub = imagecolorallocate($img, $linescolor['R'], $linescolor['G'] ,$linescolor['B']);
   for ($i=3; $i<=$width-2; $i+=3) {
    @imageline($img, $i, 3, $i, $height-4, $textcolor_sub);//lines paint	
   }
   $min_y = 5;
   $max_y = ($height - $min_y * 2) - imagefontheight($size);
   $x = 3;
   $x_step = @imagefontwidth($size);      
   for ($i=0; $i<=strlen($text)-1; $i++) {    
	$ch = $text[$i];
	$y  = rand($min_y, $max_y);
	@imagechar($img, $size, $x, $y, $ch, $textcolor);
	$x+=$x_step;
	if ($x > $width - $x_step) { break; }	
   }
   //@imagestring($img, 3, 5, 3, $text, $textcolor);//paint code  
   @imagepng($img); //out  
   @imagedestroy($img); //free    	
  }//PaintImage 
	
 }//w_graph_elements 
 //-------------------------------------------------------------------------------------
 $gr = new w_graph_elements();
 $gr->PaintImage($_GET['br'], $_GET['bg'], $_GET['ln'], $_GET['tx'], $_GET['w'], $_GET['h'], $_GET['s']); 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>