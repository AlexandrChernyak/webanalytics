<?php
 /** Управление независимыми страницами проекта
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 class w_sp_page_object extends w_defext {
  protected
   $global_data_list_info;
     
  var $control;
  var $info;
  var $options;
    
  function __construct(w_Control_obj $control, $id) {
   parent::__construct(); 
   $this->control = & $control;
   $this->info = self::GetPageById($id, $this->control);  
  }  
  
  /** получение данных по идентификатору */
  static function GetPageById($id, w_Control_obj $control, $lang=false, $skin=false) { 
   if (!$id = $control->CorrectSymplyString($id)) { return false; }
   
   $lang = (!$lang) ? $control->GetActiveLanguage() : $lang;
   $skin = (!$skin) ? $control->GetActiveSkin() : $skin; 
    
   if (!$listitem = $control->db->GetLineArray($control->db->mPost(
    "select * from {$control->tables_list['tplitemsl']} where lang='$lang' and skin='$skin' and sid='$id' limit 1"
   ))) { return false; }
     
   return $listitem;    
  }//GetPageById
  
  static function GetPageByRealId($id, w_Control_obj $control) {
   if (!$id = $control->CorrectSymplyString($id)) { return false; }
    
   if (!$listitem = $control->db->GetLineArray($control->db->mPost(
    "select * from {$control->tables_list['tplitemsl']} where iditem='$id' limit 1"
   ))) { return false; }
     
   return $listitem;      
  }//GetPageByRealId 
  
  static function GetTemplateFileNameEX(w_Control_obj $control, $id, $fullname=false) {
   $filename = 'sp-pages'; $short = 't-'.$id.'.tpl';
   if ($fullname) { 
    $filename = $control->smarty->template_dir.$filename;
    if (!@file_exists($filename)) { @mkdir($filename, 0777); }
   }
   return $filename.'/'.$short; 
  }//GetTemplateFileNameEX
  
  static function DeleteTemplateFileName(w_Control_obj $control, $id) { 
   $file = self::GetTemplateFileNameEX($control, $id, true);
   $file_mini = self::GetTemplateFileNameEX($control, $id);
   
   @$control->smarty->clear_cache($file_mini);
   if (@file_exists($file)) { @unlink($file); }    
  }//DeleteTemplateFileName
  
  static function DeletePage(w_Control_obj $control, $id) {
   self::DeleteTemplateFileName($control, $id);   
   $control->db->Delete($control->tables_list['tplitemsl'], "iditem='$id'", '1');   
   //remove comments
   $control->db->Delete($control->tables_list['commtbl'], "commfor='$id' and objectid='1'");     
  }//DeletePage
  
  static function WritePage(w_Control_obj $control, $id, $content, $clearcatch=false) {   
   @file_put_contents(self::GetTemplateFileNameEX($control, $id, true), $content);
   if ($clearcatch) {
    @$control->smarty->clear_cache(self::GetTemplateFileNameEX($control, $id)); 
   } 
  }//WritePage
  
  static function ReadPage(w_Control_obj $control, $id) {
   $file = self::GetTemplateFileNameEX($control, $id, true);
   return (!@file_exists($file)) ? '' : @file_get_contents($file);    
  }//ReadPage
  
  function ExecPage() { 
   global $_GLOBALUSECOMMENTOPTIONS;
    
   $this->options = $this->control->GetNewsSectionInfoData($this->info, false, true, false, 1);  
   $this->global_data_list_info = array();
   
   //check to add new comment     
	if ($_POST['actionthissectionpost'] == 'do' && $_POST['actionnewprvmail'] == 'act' && 
        $this->control->IsOnline() && $this->options['enabled']) {
	 
     $check_code = (isset($_SESSION["sendnumbt"])) ? $_SESSION["sendnumbt"] : '';    
   	 $_SESSION["sendnumbt"] = $this->control->generate_password(7);  
       
	 //add record	
	 $this->global_data_list_info['addstatus'] = $this->control->DoActionAddNewComment(array(
	  'commentsource' => $_POST['commentsource'],
	  'useinform'     => $this->control->CheckPostValue('useinform'),
	  'restcode'      => (isset($_POST['restcode'])) ? $_POST['restcode'] : '',
	  'commtype'      => $this->info['iditem'],
	  'commfor'       => $this->info['iditem'],
	  'pathtorestore' => $this->GetFullPath(),
	  'commentto'     => $this->GetTitle(),
	  'codeorig'      => $check_code	 
	 ), 1, $this->options);
	 
	 if ($this->global_data_list_info['addstatus'] == '1') { 
	   $this->control->LocaleToHost($this->GetPagePath()); 
     }
         		
	}  
   
   if (!isset($_GLOBALUSECOMMENTOPTIONS['1'])) {
    $_GLOBALUSECOMMENTOPTIONS['1'] = array();
   }
   
   $_GLOBALUSECOMMENTOPTIONS['1'][$this->info['iditem']] = $this->options;   	     
  }//ExecPage
  
  /** получение информации о странице */
  private function GetInfo($id) { return (!$this->info) ? false : $this->info[$id]; }
  
  /** получение заголовка страницы 
  *   @return string or === false
  */
  function GetTitle() { return $this->GetInfo('ttitle'); }
  
  /** получение ключевых слов страницы
  *   @return string or === false
  */
  function GetKeywords() { return $this->GetInfo('tkeywords'); }
  
  /** получение описания страницы
  *   @return string or === false
  */
  function GetDescription() { return $this->GetInfo('tdescript'); }
  
  /** получение названия для пути навигации проекта
  *   Если пусто - передается заголовок страницы (title)
  *   @return string or === false 
  */
  function GetProjectWayName() { 
   return ($this->GetInfo('tpathname')) ? $this->GetInfo('tpathname') : $this->GetTitle();
  }//GetProjectWayName
  
  /** получение идентификатора пути страницы
  *   @return string or === false 
  */
  function GetPagePath() { return $this->GetInfo('sid'); }
  
  /** язык страницы
  *   @return string or === false
  */
  function GetLang() { return $this->GetInfo('lang'); }
  
  /** тема страницы
  *   @return string or === false 
  */
  function GetSkin() { return $this->GetInfo('skin'); }
  
  /** кол-во просмотров страницы
  *   @return int or === false
  */
  function GetLookCount() { return $this->GetInfo('lookcount'); }
  
  /** увеличивать просмотры автоматически/вручную из текста
  *   @return bool (true, if look count is auto increment) 
  */
  function GetIncerAutoMode() { return $this->GetInfo('iautolook'); }
  
  /** добавлять слэш `/` в конце пути страницы или нет.
  *   Пример: http://site.com/mypage + /
  *   @return bool
  */
  function GetSlashEndIf() { return $this->GetInfo('slashaddte'); }
  
  /** получение корректного пути страницы, включая слэши как начальные, так и конечные
  *   Пример /mypage/
  *   @beginSH - bool (если true - добавляет начальный слэш, /mypage ) - default true
  *   @endSH - bool (если true - добавляет конечный слэш, mypage/ ) - default true
  *   
  *   @return string
  */
  function GetNormalPagePath($beginSH=true, $endSH=true) {
   if (!$s = $this->GetPagePath()) { return false; }
   
   if ($beginSH) { $s = '/'.$s; }
   if ($endSH) { $s .= '/'; }
    
   return $s; 
  }//GetNormalPagePath 
  
  /** получение полного html пути до сраницы от корня проекта, пример:
  *   /mypage/ или /project/mypage/ 
  *   @return string
  */
  function GetFullPath() { return W_SITEPATH.$this->GetNormalPagePath(false, $this->GetSlashEndIf()); } 
  
  /** получение имени файла шаблона 
  *   @return string
  */  
  function GetTemplateFileName($fullname=false) {
   return self::GetTemplateFileNameEX($this->control, $this->info['iditem'], $fullname); 
  }//GetTemplateFileName
  
  /** погрузка контента шаблона страницы
  *   @return string
  */
  function GetTemplatePageSource() { return self::ReadPage($this->control, $this->info['iditem']); }
  
  /** получение даты создания страницы 
  *   @return string
  */
  function GetPageCreatedDateTime() { return $this->GetInfo('datecreate'); }
  
  /** увеличение кол-ва просмотров на указанное значение
  *   @tocount int, на какое кол-во увеличить просмотры страницы (default 1)
  *   
  *   @return bool
  */
  function IncLookCount($tocount=1) {
   $L = $this->GetLookCount();
   if ($L === false) { return false; }
   
   $L+=$tocount;
   $this->info['lookcount'] = $L;
      
   $this->control->db->UPDATEAction('tplitemsl', array('lookcount' => $L), "iditem={$this->info['iditem']}", "1");
   return true; 
  }//IncLookCount 
  
  /** получение блока `Вложения` файлов `по умолчанию`, возвращает текст стандартного
  *   блока файлов, прикрепленных к странице.
  *  @return string
  */
  function GetDefaultAttachmentsBlock() {
   //require_once W_LIBPATH.'/files.lib.php';
   
   //if (!$block = w_dw_files_object::CreateFromObjectID(2, $this->info['iditem'], $this->control)) {
   // return '';
   //}
   
   $filesID = 2;
   $this->control->smarty->assign('filesid', $filesID);
   $this->control->smarty->assign('objectid', $this->info['iditem']);
   
   return $this->control->smarty->fetch('items/attachments-default-block.tpl');    
  }//GetDefaultAttachmentsBlock
  
  /** получение списка файлов, присоедененных к странице в виде массива,
  *   для возможности выстроить блок файлов самостоятельно по нужному
  *   критерию
  * @return array(
  *  
  *  [имя_группы] => array(
  *   
  *   [] => array(
  *    все поля таблицы файлов в бд.
  *   ) 
  * 
  *  ) 
  * 
  * )
  * [имя_группы] - содержит название группы, в которой размещаются файлы.
  * если файл определен как `без группы` - имя группы будет равно [-]
  * и данный элемент массива будет первым.
  */
  function GetAttachmentsList() {   
   return $this->control->GetAttachmentsObjectList(2, $this->info['iditem']);       
  }//GetAttachmentsList
  
  /** получение блока комментариев `по умолчанию`.
  *  Позволяет подключить к странице комментарии. Возвращает в виде строки
  *  для последующего вывода в необходимом месте.
  *  @return string
  */
  function GetCommentsBlock() {
   
   $this->global_data_list_info['commentscount'] = 
   (!$this->options['enabled']) ? 0 : $this->control->GetCommentCountForElement(
    $this->info['iditem'], $this->info['iditem'], 1
   );
   
   $this->global_data_list_info['commentsdata'] = $this->control->db->GetDataByPages(
    "select * from {$this->control->tables_list['commtbl']} where commfor='{$this->info['iditem']}' ".
    "and commisactive='1' and objectid='1' order by datecreate DESC", 
    $_GET['page'], $this->options['perpagecount'], $this->global_data_list_info['commentscount'], 
	$this->GetFullPath().'?page=', '#comments', '', '' 
   );  
   
   $this->global_data_list_info['commentusecaptcha'] = $this->options['withcaptcha'];
   $this->global_data_list_info['iditem'] = $this->info['iditem'];
   $this->global_data_list_info['ttitle'] = $this->GetTitle();
   
   $this->control->smarty->assign('global_data_list_info', $this->global_data_list_info); 
   return $this->control->smarty->fetch('items/comments_data_head_item.tpl');    
  }//GetCommentsBlock 
  
  /** получение ссылки на rss канал комментариев страницы 
  * @return string      
  */  
  function GetRssURL() { 
   return W_SITEPATH."rss/2/{$this->info['iditem']}"; 
  }//GetRssURL
  
 }//w_sp_page_object   
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>