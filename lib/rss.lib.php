<?php
 /** Управление rss лентами проекта
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 class w_rss_object extends w_defext {
  private $lineBreak = "\r\n";  
  protected
   $control;   
    
  function __construct(w_Control_obj $control) {
   parent::__construct(); 
   $this->control = & $control; 
  }    
  
  function SendHeader() {
   @header('Content-Type: text/xml; charset=utf-8'); 
  }//SendHeader
   
  private function GetHeadBlock($body) {
   return '<?xml version="1.0" encoding="utf-8"?>'.$this->lineBreak.
   '<rss version="2.0">'.$this->lineBreak.
   $body.
   '</rss>';    
  }//GetHeadBlock
  
  private function GetDateTimeFormatted($data, $named=false) {
   $time = @strtotime($data);  
   $res  = array(
    'time'  => @date('r', $time),
    'stamp' => $time
   );
   return (!$named) ? $res : $res[$named];
  }//GetDateTimeFormatted
  
  /**
  * $info = array(
  *  'name' =>
  *  'link' =>
  *  'description' => 
  *  'date' =>
  *  'lastdate'
  * )
  */ 
  private function GetChannelBlock($info, $items) { 
   $space = '  ';
   $res = $space.'<channel>'.$this->lineBreak;
   
   $res .= "$space$space<title>{$info['name']}</title>{$this->lineBreak}";
   
   $res .= "$space$space<link>{$info['link']}</link>{$this->lineBreak}";
   
   $res .= "$space$space<description><![CDATA[{$info['description']}]]></description>{$this->lineBreak}";
   
   if (isset($info['date']))
    $res .= "$space$space<pubDate>".$this->GetDateTimeFormatted($info['date'], 'time')."</pubDate>{$this->lineBreak}";
   
   if (isset($info['lastdate']))
    $res .= "$space$space<lastBuildDate>".$this->GetDateTimeFormatted($info['lastdate'], 'time').
    "</lastBuildDate>{$this->lineBreak}";
   
   $res .= $items.$this->lineBreak;
    
   return $res.$space.'</channel>'.$this->lineBreak;    
  }//GetArticlesSectionInfo
  
  function GetRssArticlesSectionBlock($sectionName) {
   $list = $this->control->GetNewsSectionListElements(false, $sectionName, "datecreate DESC");
   
   $path = 'http://'.W_HOSTMYSITE.'/'.(($list) ? $list[0]['opt']['pathobjects'].'/' : '');
   
   $channel_info = array(
    'name'        => W_HOSTMYSITE.' :: '.(($list) ? $list[0]['opt']['newstitletospec'] : 'Unknow'),
    'link'        => $path,
    'description' => ($list) ? "RSS feed of {$list[0]['opt']['newstitletospec']}" : 'Unknow',
    'lastdate'    => ($list) ? $list[0]['data']['datecreate'] : $this->GetThisDateTime()   
   );
   
   $space = '  ';
   $items = '';
   
   foreach ($list as $data) { 
    $items .= "{$this->lineBreak}{$space}$space<item>{$this->lineBreak}";
    
    $items .= "$space$space$space<title>{$data['data']['sname']}</title>{$this->lineBreak}";
    
    $items .= "$space$space$space<link>".$path.$data['data']['iditem']."/</link>{$this->lineBreak}";
    
    $items .= "$space$space$space<description><![CDATA[".
    $this->control->strings->CorrectTextFromDB($data['data']['sdescr'], false, true, false, 450, true).
    "]]></description>{$this->lineBreak}";
    
    $time = $this->GetDateTimeFormatted($data['data']['datecreate']);
  
    $items .= "$space$space$space<pubDate>{$time['time']}</pubDate>{$this->lineBreak}";
    $items .= "$space$space$space<pubDateUT>{$time['stamp']}</pubDateUT>{$this->lineBreak}";
    
    $items .= "$space$space$space<guid>".$path.$data['data']['iditem']."/</guid>{$this->lineBreak}";
    
    $items .= "$space$space</item>";
   }   
   return $this->GetHeadBlock($this->GetChannelBlock($channel_info, $items));
  }//GetRssArticlesSectionBlock
  
  function GetRssArticleSection($sectionID) { 
   if ($sdata = $this->control->GetNewsSectionInfoData($sectionID, true)) {
    
    $sect_data = array(
     'data' => $sdata,
     'opt'  => $this->control->GetNewsSectionInfoData($sdata, false, true)
    );     
 
   } else { $sect_data = false; }
   
   $name = (!$sect_data) ? 'Unknow' : $sect_data['data']['sname'];
   $path = 'http://'.W_HOSTMYSITE.'/'.(($sect_data && $sect_data['opt']['pathobjects']) ? 
   $sect_data['opt']['pathobjects'].'/'.$sectionID.'/' : 'news/'.$sectionID.'/');
   
   $channel_info = array(
    'name'        => W_HOSTMYSITE.' :: '.$name,
    'link'        => $path,
    'description' => "RSS feed of $name",
    'lastdate'    => ($sect_data) ? $sect_data['data']['datecreate'] : $this->GetThisDateTime()   
   );   
   
   $space = '  ';
   $items = '';
   
   $articles_list = (!$sect_data) ? false : $this->control->db->mPost(
    "select iditem,datecreate,newtitle,newdata,contenttype from {$this->control->tables_list['newslist']} where ".
    "newtype='$sectionID' order by datecreate DESC limit ".W_NEWSPERPAGEINPUBLICSECT
   );   
   
   if ($articles_list) {
    $firstID = false;
    while ($row = $this->control->db->GetLineArray($articles_list)) { 

     if (!$firstID) { 
      $channel_info['lastdate'] = $row['datecreate'];
      $firstID = true; 
     }
     
     $link = $path.$row['iditem'].'/';
    
     $items .= "{$this->lineBreak}{$space}$space<item>{$this->lineBreak}";
    
     $items .= "$space$space$space<title>{$row['newtitle']}</title>{$this->lineBreak}";
    
     $items .= "$space$space$space<link>$link</link>{$this->lineBreak}";
    
     $items .= "$space$space$space<description><![CDATA[".
     $this->control->strings->CorrectTextFromDB($row['newdata'], false, true, $row['contenttype'], 450, true).
     "]]></description>{$this->lineBreak}";
    
     $time = $this->GetDateTimeFormatted($row['datecreate']);
  
     $items .= "$space$space$space<pubDate>{$time['time']}</pubDate>{$this->lineBreak}";
     $items .= "$space$space$space<pubDateUT>{$time['stamp']}</pubDateUT>{$this->lineBreak}";
    
     $items .= "$space$space$space<guid>$link</guid>{$this->lineBreak}";
    
     $items .= "$space$space</item>";
    }
   }
   return $this->GetHeadBlock($this->GetChannelBlock($channel_info, $items));     
  }//GetRssArticleSection
    
  function GetRssObjectCommentsBlock($filesID, $objectID) {
   require_once W_LIBPATH.'/files.lib.php';
   
   $obj = w_dw_files_object::CreateFromObjectID($filesID, $objectID, $this->control, true);   
   
   $name = (!$obj) ? 'Unknow' : $obj->GetName(); 
   $link = (!$obj) ? 'http://'.W_HOSTMYSITE : 'http://'.W_HOSTMYSITE.$obj->GetPath();
       
   $channel_info = (!$obj) ? array(
   
    'name'        => W_HOSTMYSITE.' :: Unknow',
    'link'        => $link,
    'description' => 'RSS feed of '.W_HOSTMYSITE,
    'lastdate'    => $this->GetThisDateTime(),
   
   ) : array(
   
    'name'        => W_HOSTMYSITE.' :: '.$name,
    'link'        => $link,
    'description' => "RSS feed of comments for $name",
    'lastdate'    => $obj->GetResult('block.datecreate'),
        
   );
   
   $count = 10;
   $objIDcomment = false;
   
   if ($obj) {    
    switch ($filesID) {       
     case '1': $objIDcomment = '0'; $count = $obj->GetResult('info.setinfo.perpagecount'); break;    
     case '2': $objIDcomment = '1'; $count = $obj->GetResult('info.commperpa'); break;         
    }        
   }   
 
   $comments = (!$obj) ? false : $this->control->db->mPost(
    "select iditem,datecreate,commsource from {$this->control->tables_list['commtbl']} where commfor='".
    $obj->GetID()."' and commisactive='1' and objectid='$objIDcomment' order by datecreate DESC limit $count"
   );
   
   $space = '  ';
   $items = '';
     
   if ($comments) {
    $firstID = false;
    while ($row = $this->control->db->GetLineArray($comments)) {
        
     if (!$firstID) { 
      $channel_info['lastdate'] = $row['datecreate'];
      $firstID = true; 
     }   
     
     $items .= "{$this->lineBreak}{$space}$space<item>{$this->lineBreak}";
    
     $items .= "$space$space$space<title>Re: $name</title>{$this->lineBreak}";
    
     $items .= "$space$space$space<link>$link#comment{$row['iditem']}</link>{$this->lineBreak}";
    
     $items .= "$space$space$space<description><![CDATA[".
     $this->control->strings->CorrectTextFromDB($row['commsource'], false, true, false, 450, true).
     "]]></description>{$this->lineBreak}";
    
     $time = $this->GetDateTimeFormatted($row['datecreate']);
  
     $items .= "$space$space$space<pubDate>{$time['time']}</pubDate>{$this->lineBreak}";
     $items .= "$space$space$space<pubDateUT>{$time['stamp']}</pubDateUT>{$this->lineBreak}";
    
     $items .= "$space$space$space<guid>$link#comment{$row['iditem']}</guid>{$this->lineBreak}";
    
     $items .= "$space$space</item>"; 
         
    }   
   } 
   if (isset($obj)) unset($obj);   
   return $this->GetHeadBlock($this->GetChannelBlock($channel_info, $items));     
  }//GetRssArticleCommentsBlock
    
 }//w_rss_object   
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>