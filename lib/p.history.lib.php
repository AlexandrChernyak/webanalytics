<?php
 /** Модуль управления историей проверок
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------
 /** история */
 class w_historyparamslisten extends w_defext {  	
  protected 
   $control,
   $url,
   $table,
   $urltoshowblock,
   $tablenamesh;
   
  /** идентификаторы параметров */ 
  public static $params_idents = array(
   //тиц
   'id_cy_value' => array(
    'color'       => '0D8ECF', //цвет графика
    'color_hover' => 'FF0F00', //цвет активного
    'selected'    => '1'       //по умолчанию включено отображение подстказки
   ),
   //yaca
   'id_yaca_dir_value' => array(
    'color'       => '',
    'color_hover' => 'FF0F00',
    'selected'    => '0',
    'hidden'      => '1'
   ),
   //dmoz
   'id_dmoz_dir_value' => array(
    'color'       => '',
    'color_hover' => 'FF0F00',
    'selected'    => '0',
    'hidden'      => '1'
   )   
  ); 
  
  function __construct(w_Control_obj $control, $tablenamesh='chhistory') {
   parent::__construct();
   $this->control = $control;
   $this->tablenamesh = $tablenamesh;
   $this->table = $this->control->tables_list[$tablenamesh]; 
   $this->urltoshowblock = false;  	
  }//__construct
  
  /** создание по URL */
  public static function CreateFromURL(w_Control_obj $control, $url, $tablenamesh='chhistory') {
   $history = new w_historyparamslisten($control, $tablenamesh);
   if (!$history->SetURL($url)) { unset($history); return false; }
   return $history;	
  }//CreateFromURL
  
  /** проверка идентификатора */
  static function ValidIdentifier($identname) { return isset(self::$params_idents[$identname]); }
  
  /** получение имени идентификатора */
  function GetIdentifierName($identname) {
   $result = (!$identname) ? false : $this->control->GetText($identname.':paramname');
   return (!$result) ? 'Unknow parameter' : $result;   	
  }//GetIdentifierName
  
  /** получение всех идентификаторов из строки
  * @str - string   
  * @return array or false 
  */
  static function GetAllIdentifiers($str) {
   return ($str && @preg_match_all('/\[([a-z_\-]*?)\]/isU', $str, $arr) && @is_array($arr[1])) ? $arr[1] : false; 
  }//GetAllIdentifiers
  
  /** установка url */
  function SetURL($url) { return $this->url = trim($this->strtolower($this->control->CorrectSymplyString($url))); }
  function SetShowURL($url) { $this->urltoshowblock = $url; }  
  
  /** url */
  function GetURL() { return $this->url; }
  
  /** чтение параметров сайта
  * @readType - int type, 0 - with max elements, 1 - first, 2 - last  
  */
  function ReadURLParamsAndBuildList($readType=0) {
   switch ($readType) {
	case  1: $order = "iditem"; break;
	case  2: $order = "iditem DESC"; break;
	default: $order = "(CHAR_LENGTH(valuesid) - CHAR_LENGTH(REPLACE(valuesid,'[',''))) div CHAR_LENGTH('[') DESC"; break;
   }  	
   $res = $this->control->db->GetLineArray($this->control->db->mPost(
    "select valuesid from {$this->table} where urlident='{$this->url}' order by $order limit 1"
   ));
   return (!$res) ? false : self::GetAllIdentifiers($res['valuesid']);   	
  }//ReadURLParamsAndBuildList
  
  /** генерация настроек графика (линейного)
  * @foritems - array or false
  * @ignoreitems - array or false   
  */
  function GenerateLineCharSettengsXML($foritems=false/*, $ignoreitems=false*/) {
   if ($foritems === false) { $foritems = $this->ReadURLParamsAndBuildList(); }
   $xml = '<settings><font>Tahoma</font><hide_bullets_count>18</hide_bullets_count><data_type>csv</data_type><background><alpha>90</alpha><border_alpha>10</border_alpha></background><plot_area><margins><left>50</left><right>40</right><bottom>65</bottom></margins></plot_area><grid><x><alpha>10</alpha><approx_count>9</approx_count></x><y_left><tick_length>0</tick_length><alpha>10</alpha></y_left></grid><axes><x><width>1</width><color>0D8ECF</color></x><y_left><width>1</width><color>0D8ECF</color></y_left></axes><values><x><rotate>90</rotate></x></values><indicator><color>0D8ECF</color><x_balloon_text_color>FFFFFF</x_balloon_text_color><line_alpha>50</line_alpha><selection_color>0D8ECF</selection_color><selection_alpha>20</selection_alpha></indicator><legend><values><enabled>1</enabled><width>60</width><align>left</align></values></legend><zoom_out_button><text>'.$this->control->GetText('showallitemslabel', false, 'Show All').'</text><text_color_hover>FF0F00</text_color_hover></zoom_out_button><help><button><color>FCD202</color><text_color>000000</text_color><text_color_hover>FF0F00</text_color_hover></button><balloon><text>'.$this->control->GetText('graphhelpidentuse').'</text><color>FCD202</color><text_color>000000</text_color></balloon></help><graphs>';
   //add graphs
   $item_id = 0;
   foreach ($foritems as $item) {
   	//if ($ignoreitems && @in_array($item, $ignoreitems)) { continue; }
   	
    $info = (!isset(self::$params_idents[$item])) ? array(
     'color'       => '',
     'color_hover' => 'FF0F00',
     'selected'    => '1'   
    ) : self::$params_idents[$item];
    
   	if (!$info) { continue; }   	
	$xml .= '<graph gid="'.$item_id.'"><title>'.$this->GetIdentifierName($item).'</title>';	
	//get all params
	foreach ($info as $name => $value) {
	 $xml .= ('<'.$name.'>'.$value.'</'.$name.'>');	 	
	}	
	$xml .= '</graph>';
	$item_id++;
   }
   //next follow
   $xml .= '</graphs><labels><label lid="0"><text><![CDATA['.$this->control->GetText('grathtitlelabelid', array(($this->urltoshowblock) ? " <font color=\"#0000FF\"><u>{$this->urltoshowblock}</u></font>" : '')).']]></text><y>25</y><text_size>13</text_size><align>center</align></label></labels></settings>';
   return $xml;   	
  }//GenerateLineCharSettengsXML
  
  /** генерация значений графика (линейного)
  * @foritems - array or false  
  */
  function GenerateLineChartDataCSV($foritems=false, $limit=0) {
   if ($foritems === false) { $foritems = $this->ReadURLParamsAndBuildList(); }
   //select for all items current url
   $list = $this->control->db->mPost(
    "select valuesid,datecreate from {$this->table} where urlident='{$this->url}' order by datecreate".
	(($limit > 0) ? " limit $limit" : "")    
   );
   //parse
   $csv = '';
   while ($row = $this->control->db->GetLineArray($list)) {
	$str = (!$row['valuesid']) ? '' : @stripcslashes($row['valuesid']);
	$csv .= (($csv) ? ("\n".$row['datecreate']) : $row['datecreate']);	
	foreach ($foritems as $item) {
	 $val = $this->control->ReadOption($item, $str);
	 $csv .= ';'.(($val === false) ? '' : $val);		
	}	
   }
   //correct if, no data found
   if (!$csv) {
   	$csv = '?';   	
	foreach ($foritems as $item) { $csv .= ';';	}	
   }   
   return $csv;   	
  }//GenerateLineChartDataCSV
  
  /** создание новых записей истории
  * @items - array(
  *  'идентификатор' => значение
  * )
  * 
  * @date - string - дата проверки, если false - текущая дата
  * @updateifexists - bool - обновлять или нет завись, если такая дата уже существует
  */
  function WriteNewHistoryData($items, $date=false, $updateifexists=false) {
   if (!$items) { return false; }	
   if (!$date) { $date = $this->GetThisDate(); } elseif ($this->strpos($date, ':') !== false) {
	$date2 = $date;
	$date  = $this->StrFetch($date2, " ");
	if (!$date) { $date = $this->GetThisDate(); }
   }	
   //date is ok, check exists
   $row = $this->control->db->GetLineArray($this->control->db->mPost(
    "select iditem from {$this->table} where datecreate='$date' and urlident='{$this->url}' limit 1"
   ));
   if ($row && !$updateifexists) { return false; }
   //items for save
   $items_write = array('valuesid' => '');
   if (!$row) {
	$items_write['datecreate'] = $date; 
    $items_write['urlident']   = $this->url;	
   }
   //combine
   foreach ($items as $name => $value) {
	$items_write['valuesid'] = $this->control->WriteOption($name, $value, $items_write['valuesid']);	
   }
   //update, insert        
   if ($row) {
	$this->control->db->UPDATEAction($this->tablenamesh, $items_write, "iditem='{$row['iditem']}'", "1", true); 
   } else {
	$this->control->db->INSERTAction($this->tablenamesh, $items_write, true);
   }
   return true;	
  }//WriteNewHistoryData	
	
 }//w_historyparamslisten 
 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>