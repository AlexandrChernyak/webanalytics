<?php
 /** Модуль управления инструментом `генератор иконки favorit`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 class w_toolitem_favoritgenerator extends w_toolitem_noajax_method {
  const FILE_IDENT = 'image';
  /** доступные типы картинок по умолчанию */	
  private $image_types = array(".gif", ".jpg", ".png", ".jpeg", ".ico"/*, ".bmp"*/);		
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
   if ($_POST['doactiontool'] != 'do') { return false; } 
   if (!$this->result) $this->result = array();   
   //ok првоерка загрузки изображения
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
   //create   
   $image = w_image_obj::CreateFromFile($_FILES[self::FILE_IDENT]['tmp_name'], $filetypeIDstr);
   if (!$image) { return $this->SetError('Error in create image data!'); }
   if (!$image->ResizeImage(16, 16)) { return $this->SetError('Can`t convert image!'); }
   //размер изображения   
   $data = ($_POST['formatfav'] == 1) ? /*$image->OutAsIco(true)*/$image->OutAsBmp(true) : $image->OutAsPng(true); 
   $image->FreeImage(); 
   //вывести
   $this->control->WriteDownLoadFileHeader('favicon.'.(($_POST['formatfav'] == 1) ? 'ico' : 'png'), @strlen($data)); 
   echo $data;
   exit; 
      
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_favoritgenerator

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>