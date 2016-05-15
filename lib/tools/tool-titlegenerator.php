<?php
 /** Модуль управления инструментом `генератор заголовоков`
 * @author [Eugene]
 * @copyright 2011
 * @url http://forwebm.net
 */
 if (!@defined('W_ENGINED_L')) exit('Can`t access to this file data!');
 //-------------------------------------------------------------------------------------

 /** генератор заголовоков */
 class w_toolitem_titlegenerator extends w_toolitem_noajax_method {	
  protected
   $result,
   $aL, $aC, $aR,
   $cL, $cC, $cR,
   $temp_list;
  
  protected function IsTitle() { return true; }
  
  protected function CombineListResult($a1, $a2, $a3) {
   $str = "$a1 $a2".(($a3) ? " $a3" : '');
   $url = ($this->IsTitle()) ? $str : $this->HTMLspecialChars(
    '<a href="'.$this->GetURL().'"'.$this->GetTarget().'>'.$str.'</a>'
   );
   //add
   $this->result['liststring'] .= ($this->result['liststring']) ? "\r\n".$url : $url;
   //добавить в список
   $this->result['list'][] = $url; 	
  }//CombineListResult
  
  function ActionListItem($s) {
   if (!$s = trim($s)) { return ''; }
   $this->temp_list[] = $s;
   return $s;   	
  }//ActionListItem 
  
  protected function DoCompereList($list) {
   $this->temp_list = array();
   @array_map(array($this, 'ActionListItem'), $list);
   return $this->temp_list;   	
  }//DoCompereList
       
  function _DoActionThisTool() {	  	 
   if ($_POST['doactiontool'] != 'do') { return false; }   
   $this->result = array(
    'list'       => array(),
    'liststring' => '',
    'count'      => 0
   );
   //get lists
   $_POST['leftlinks']   = /*$this->strtolower(*/$this->ClearBreake($_POST['leftlinks'], true, false);
   $_POST['centerlinks'] = /*$this->strtolower(*/$this->ClearBreake($_POST['centerlinks'], true, false);
   $_POST['rightlinks']  = /*$this->strtolower(*/$this->ClearBreake($_POST['rightlinks'], true, false);
   $this->aL = /*@array_unique(*/$this->DoCompereList(@explode("\n", trim($_POST['leftlinks'])));
   $this->aC = /*@array_unique(*/$this->DoCompereList(@explode("\n", trim($_POST['centerlinks'])));
   $this->aR = /*@array_unique(*/$this->DoCompereList(@explode("\n", trim($_POST['rightlinks'])));
   if (!$this->aL) { $this->aL = array(); }
   if (!$this->cL) { $this->cL = array(); }
   if (!$this->rL) { $this->rL = array(); }
   $this->cL = @count($this->aL);
   $this->cC = @count($this->aC);
   $this->cR = @count($this->aR);
   //корректировка центральной части блока
   if (!$this->cC || $this->cC <= 0) {
    $this->cC = $this->cR;
    $this->aC = $this->aR;
    $this->cR = 0;   	
   } 
   //generate 
   for ($i=0; $i<=$this->cL-1; $i++) {
    if (!trim($this->aL[$i])) { continue; }
    for ($j=0; $j<=$this->cC-1; $j++) {
	 if (!trim($this->aC[$j])) { continue; }	 
	 if (!$this->cR || $this->cR <= 0) {
	  $this->CombineListResult($this->aL[$i], $this->aC[$j], '');
	  $this->result['count']++;
	 } else {
      for ($k=0; $k<=$this->cR-1; $k++) {
	   if (!trim($this->aR[$k])) { continue; }
	   $this->CombineListResult($this->aL[$i], $this->aC[$j], $this->aR[$k]);
	   $this->result['count']++;
      }//k
	 }		
    }//j	
   }//i      
   return true;   	
  }//_DoActionThisTool
  	
 }//w_toolitem_titlegenerator

 //-------------------------------------------------------------------------------------
 /* Copyright (с) 2011 forwebm.net */
?>