<?php
 /** Обработка инициализации секций распределения
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //------------------------------------------------------------------------------------- 
 class w_get_prepere_parser {   
  /** 
    идентификаторы, имена которых различаются   
  */
  public static $replace_sections = array(
   'restore'         => 'restorepsw',
   'activate'        => 'activateact',
   'pay'             => 'paystatus',
   'userinfo'        => 'userinfoget',
   'account'         => 'accountff',
   'updates'         => 'engineupdateslist',
   'tools'           => 'toolsaction',
   'vitrinalinks'    => 'linksvitrinasection',
   'news'            => 'newslisten',
   'articles'        => 'newslisten',
   'feedback'        => 'feedbackpt',
   'goto'            => 'gotositeredirect',
   'panel'           => 'panelitemsaction',
   'xml'             => 'xmlapiproject',
   'download'        => 'downloadfile',
   'advertising'     => 'advertisingpagefile', 
   'informer-images' => 'informer-images-id',
   'rss'             => 'rss-list-thread', 
  );  
  
  private static function PrepereQuery(w_Control_obj $control, &$data) {  
   $uquery = @trim($data['wtquery']);
   unset($data['wtquery']);
   
   if ($uquery) {
    $s = $control->StrFetch($uquery, '=');
    if ($s) {
      $data[$s] = $uquery;     
    }     
   }      
  }//PrepereGet 
  
  private static function ErrorPage(&$data, $code='404') {
   $data['section'] = 'errordocument';
   $data['errcode'] = $code;
   return false;    
  }//ErrorPage
  
  private static function IgnorePathSlash(w_Control_obj $control, &$path) {
   if (!$path) { return false; } 
   while ($control->substr($path, 0, 1) == '/') { $path = @substr_replace($path, '', 0, 1); }  
   return (!$path) ? false : true; 
  }//IgnorePathSlash
  
  private static function PrepereDinamicSection(
    w_Control_obj $control, &$section, &$data, &$path, &$dinamictype, &$sectionname) {
   
   $sectionname = $section;
   
   //check news listen
   if ($listitem = $control->db->GetLineArray($control->db->mPost(
    "select iditem from {$control->tables_list['newssectq']} where lang='".$control->GetActiveLanguage().
    "' and LOCATE('[pathobjects]{$section}[/pathobjects]', soptions)<>0 order by datecreate limit 1"
   ))) {
     
     $sectionname = 'newslisten';
     $dinamictype = 1;
     return true;   
           
   }
    
   //check for special pages
   if ($listitem = $control->db->GetLineArray($control->db->mPost(
    "select iditem from {$control->tables_list['tplitemsl']} where lang='".$control->GetActiveLanguage()."' and ".
    "skin='".$control->GetActiveSkin()."' and sid='$section' limit 1"
   ))) {
    
    if ($path) { return false; }
    
    require_once W_LIBPATH.'/sp.page.lib.php';
    
    if (!@file_exists(w_sp_page_object::GetTemplateFileNameEX($control, $listitem['iditem'], true))) {
     return false;        
    }  
    
    $dinamictype = 2;
    $sectionname = 'specialdinamicpagesection';
    return true;
    
   }  
   
   return false; 
  }//PrepereDinamicSection
  
  private static function GetParameter(w_Control_obj $control, $named, &$data, &$path) {
   $s = $control->StrFetch($path, '/'); 
   if ($s != '') {
    $data[$named] = $control->CorrectSymplyString($s);
    return true;  
   }   
   return false; 
  }//GetParameter
  
  private static function PreperePath(w_Control_obj $control, &$data) {
   $path = @trim($data['wtpath']);
   unset($data['wtpath']); 
   
   if (!self::IgnorePathSlash($control, $path)) { return false; }      
   $section = $control->CorrectSymplyString($control->StrFetch($path, '/'));
   
   if (!$section) { return false; }
   $dinamictype = false;
  
   //static section
   if (isset(self::$replace_sections[$section])) {   
    $section_name = self::$replace_sections[$section];    
   } 
   //dinamic section   
   elseif (!self::PrepereDinamicSection($control, $section, $data, $path, $dinamictype, $section_name)) {
        
   }  
   $data['section'] = $control->CorrectSymplyString($section_name);
   
   //parse sections
   switch ($section_name) {
    
    //регистрация
    case 'register': self::GetParameter($control, 'p', $data, $path); break;
    
    //восстановление пароля
    case 'restorepsw': self::GetParameter($control, 'nepsw', $data, $path); break;
    
    //активация аккаунта
    case 'activateact': self::GetParameter($control, 'fromurl', $data, $path); break;
    
    //выход
    case 'exit': $control->ExitOfAccount(); $control->LocaleToHost(); exit;
    
    //оповещение о платеже
    case 'paystatus': break;
    
    //информация о пользователе
    case 'userinfoget': self::GetParameter($control, 'user', $data, $path); break;
        
    //кабинет
    case 'accountff':
      
      if (self::GetParameter($control, 'hrzd', $data, $path)) {
        if (self::GetParameter($control, 'hrzd2', $data, $path)) {
 
        }
      }
     
    break;
    
    //updates
    case 'engineupdateslist': self::GetParameter($control, 'p', $data, $path); break;
    
    //инструменты
    case 'toolsaction':
     
      if (self::GetParameter($control, 't1', $data, $path)) {
        if (self::GetParameter($control, 't2', $data, $path)) {
 
        }
      }     
     
    break;
    
    //витрина ссылок
    case 'linksvitrinasection': 
     
     if ($path && $control->substr($path, 0, 1) != '?') {
       $s = $control->StrFetch($path, '=');
       if ($s) {
        $data[$s] = ($path) ? '1' : '0';        
       }        
     }    
    
    break;
    
    //новости
    case 'newslisten':
    
      //if (isset(self::$replace_sections[$section])) {
       $data['identway'] = $section;   
      //} else {        
        //preload section info          
      //} 

      if (self::GetParameter($control, 'ntype', $data, $path)) {
        if (self::GetParameter($control, 'vari2', $data, $path)) {
          if (self::GetParameter($control, 'vari', $data, $path)) {
           
           $data['vari'] = $data['vari2'].'/'.$data['vari']; 
            
          } else { $data['vari'] = $data['vari2']; }             
        }        
      }
    break;
    
    //обратная связь
    case 'feedbackpt':  break;
    
    //перенаправления
    case 'gotositeredirect':
     
     if (!self::GetParameter($control, 'urlid', $data, $path)) {
      return self::ErrorPage($data);  
     }   
     
     if ($path) {
      $data['paramslist'] = $path;  
     }      
    
    break;
    
    //панель оптимизатора
    case 'panelitemsaction': self::GetParameter($control, 'manageuser', $data, $path); break;
    
    //xml
    case 'xmlapiproject': break; 
    
    //независимые страницы
    case 'specialdinamicpagesection': $data['pageid'] = $section; break; 
    
    //загрузка файлов
    case 'downloadfile':
      
      if (self::GetParameter($control, 'filesid', $data, $path)) {
        if (self::GetParameter($control, 'objectsid', $data, $path)) {
            if (self::GetParameter($control, 'attachid', $data, $path)) {
                
            }
        }
      }     
    
    break;
    
    //advertising on our site
    case 'advertisingpagefile': break;  
    
    //informers images list, quick get, as like original image file (image-1.png etc.)
    case 'informer-images-id':
     
     if (self::GetParameter($control, 'inftypeid', $data, $path)) {
       if (self::GetParameter($control, 'imgtypeid', $data, $path)) {
        
        switch ($data['inftypeid']) {            
         case '1': $tool_ident = 'internetspeed'; break;
         case '2': $tool_ident = 'ipinformer'; break;
         case '3': $tool_ident = 'prcyinformer'; break;
         case '4': $tool_ident = 'updatesinformer'; break;
         default: exit('Unknow Informer Type!');             
        }
        
        $img_id = $control->StrFetch($data['imgtypeid'], '-');
        $img_id = ($data['imgtypeid']) ? $control->StrFetch($data['imgtypeid'], '.') : false;
        
        if (!$img_id || !@is_numeric($img_id) || $img_id <= 0) {
          exit('Unknow Image resource!');  
        }        
                
        //load option data
        @define('SIMPLY_CONNECT_PRELOAD_OPTIONS', 1);
        require_once W_LIBPATH.'/preloadoptions.lib.php';  
        pr_options_preload::QuickPreloadToolOptions($tool_ident, $control);
        pr_options_preload::QuickPreloadGeneralSiteSubOptions($control);
        
        //check informer Item
        @define('ISENGINEDSW', 1);
        require_once W_SEOLIBPATH.'/engine.php';
        require_once W_LIBPATH.'/informer.control.lib.php';
        
        $inform_obj = new w_informer_obj($control, $data['inftypeid'], 
         self::GetToolOpt($tool_ident, 'updateeveryminute'),
         self::GetToolOpt($tool_ident, 'updateifexistsinf')
        );
        
        $inform_obj->GetRealInformerImage($img_id); 
        unset($inform_obj);    
        exit;
        
       } else {
        
        exit('Unknow Image resource!');
        
       }
        
     } else {
        
      exit('Unknow Image Type!');
     
     }         
    break;
    
    //rss feed
    case 'rss-list-thread':
     
     require_once W_LIBPATH.'/rss.lib.php';
     $rss = new w_rss_object($control);
     
     self::GetParameter($control, 'filesid', $data, $path);
     if (!isset($data['filesid']) || !$data['filesid'] || !@is_numeric($data['filesid']) || $data['filesid'] < 1) {
      $data['filesid'] = 1;  
     }
     
     $content = '';        
     self::GetParameter($control, 'objectid', $data, $path);
     
     if (!isset($data['objectid']) || !$data['objectid']) $data['objectid'] = 0;
     
     if (!@is_numeric($data['objectid'])) { 
      $data['objectid'] = $control->CorrectSymplyString($data['objectid']);
      
      if (self::GetParameter($control, 'sectionid', $data, $path)) {
        
       $data['sectionid'] = $control->CorrectSymplyString($data['sectionid']);
       $content = $rss->GetRssArticleSection($data['sectionid']); 
              
      } else {
        
       $content = $rss->GetRssArticlesSectionBlock($data['objectid']); 
        
      }         
     } else {
      
      $content = $rss->GetRssObjectCommentsBlock($data['filesid'], $data['objectid']);  
        
     }     
     
     $rss->SendHeader();
     echo $content;
     unset($rss);
     exit;
    break;
    
    
    //dinamic section
    default:     
     
     return self::ErrorPage($data);
   }
   return true;    
  }//PreperePath
  
  static function GetToolOpt($toolID, $option) {
   global $_TOOLSNOLIMITACTIVATIONDATAINFO;
   return (!isset($_TOOLSNOLIMITACTIVATIONDATAINFO[$toolID][$option])) ? false : 
   $_TOOLSNOLIMITACTIVATIONDATAINFO[$toolID][$option];    
  }//GetToolOpt
  
  static function Prepere(w_Control_obj $control, &$data) {
   self::PrepereQuery($control, $data);
   self::PreperePath($control, $data);
  }//Prepere
  
  
 }//w_get_prepere_parser
 //-------------------------------------------------------------------------------------

 /* ********************** prepere url */
 w_get_prepere_parser::Prepere($CONTROL_OBJ, $_GET);
   
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>