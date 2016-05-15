{* группировка инструментов, отображение списка инструментов по идентификатору - результат сохранения 
 $groupiddata - идентификатор группы
*}
<div style="padding-left: 2px; padding-top: 4px; font-size: 95%">
  {assign var="grtoolslistX" value=$adm_object->CombineToolsListByGroupIdentifier($groupiddata)}
  <span style="width: 100%">
  {if !$grtoolslistX}
   Нет инструментов
  {else}
  <table width="100%" cellpadding="0" cellspacing="0" id="tbshorting{$groupiddata}"> 
   {section name=trindex start=0 loop=$grtoolslistX.count step=1}
   <tr>
    
   <td valign="top" align="left" width="50%">
    {if $grtoolslistX.data1[trindex].name}
     <a title="Изменить настройки инструмента" href="{$smarty.const.W_SITEPATH}account/admtoolsoptions/&toolid={$grtoolslistX.data1[trindex].name}" target="_blank"><img id="imgid{$grtoolslistX.data1[trindex].iditem}" src="{$CONTROL_OBJ->GetToolImageStyle($grtoolslistX.data1[trindex].name, 16, '', '')}" style="width: 16px; height: 16px; float: left; margin-right: 6px"></a>  
     <a target="_blank" id="lname{$grtoolslistX.data1[trindex].iditem}" href="{$smarty.const.W_SITEPATH}tools/{$grtoolslistX.data1[trindex].name}/" style="font-size: 95%">{$CONTROL_OBJ->GetText($grtoolslistX.data1[trindex].value.descr)}</a>
     
     <input type="hidden" name="hidisitenttool{$grtoolslistX.data1[trindex].iditem}" value="{$grtoolslistX.data1[trindex].name}"/>
     <input type="hidden" name="hidisitenttoolid" value="{$grtoolslistX.data1[trindex].iditem}"/>
     
    {/if}
   </td>
  
   <td valign="top" align="left" width="50%">
    {if $grtoolslistX.data2[trindex].name}
     <a title="Изменить настройки инструмента" href="{$smarty.const.W_SITEPATH}account/admtoolsoptions/&toolid={$grtoolslistX.data2[trindex].name}" target="_blank"><img id="imgid{$grtoolslistX.data2[trindex].iditem}" src="{$CONTROL_OBJ->GetToolImageStyle($grtoolslistX.data2[trindex].name, 16, '', '')}" style="width: 16px; height: 16px; float: left; margin-right: 6px"></a>  
     <a target="_blank" id="lname{$grtoolslistX.data2[trindex].iditem}" href="{$smarty.const.W_SITEPATH}tools/{$grtoolslistX.data2[trindex].name}/" style="font-size: 95%">{$CONTROL_OBJ->GetText($grtoolslistX.data2[trindex].value.descr)}</a>
     
     <input type="hidden" name="hidisitenttool{$grtoolslistX.data2[trindex].iditem}" value="{$grtoolslistX.data2[trindex].name}"/>
     <input type="hidden" name="hidisitenttoolid" value="{$grtoolslistX.data2[trindex].iditem}"/>
    {/if}  
   </td>  
   
   </tr>
   {/section} 
  </table>
  
  
  {literal}
  
  <style type="text/css">
  .sectionmoveitem{/literal}{$groupiddata}{literal} { padding: 4px 2px 4px 2px; background: #D6D6D6; border-bottom: 2px solid #FFFFFF; }
  .sectionmoveitem{/literal}{$groupiddata}{literal}:hover { background: #DFDFDF; color: #0000FF; }
  </style>
    
    <script type="text/javascript">
      var globaliddatalist{/literal}{$groupiddata}{literal} = 0;
    
      function PrepereToGetResultListH{/literal}{$groupiddata}{literal}(data) {
       var idgroup = globaliddatalist{/literal}{$groupiddata}{literal};
       
       $('#selecttoolslistgroup'+idgroup).html(
        '<a href="javascript:" onclick="DoSelectToolsForGroup(\''+idgroup+'\')"'+
        ' style="font-size: 95%">Выбрать инструменты</a>'
       );
       //set data
       $('#toolsgrouplist'+idgroup).html((!data) ? 'Нет инструментов' : data);  
      }//PrepereToGetResultListH  
      
      function PrepereToGetResultList{/literal}{$groupiddata}{literal}(data) {        
        if (!data) { return false; }       
        $("#dialog_shorttool"+data).dialog('close');
        
        $('#selecttoolslistgroup'+data).html(
         '<label style="color: #0000FF; font-size: 95%">Приминение списка, подождите..</label>'
        );    
        globaliddatalist{/literal}{$groupiddata}{literal} = data;    
        SendDefaultRequest(
         global_path_element, 'is_ajax_mode=1&typed=shortget&groupid='+data,
         'PrepereToGetResultListH'+data
        );         
      }//PrepereToGetResultList  
      
	  function PreloadToolsForShort{/literal}{$groupiddata}{literal}() {        
        var gtoolid='{/literal}{$groupiddata}{literal}';
        
        $('#p_id_short'+gtoolid).hide();
        $('#p_sortsectionslistparam'+gtoolid).html('');
        
        $('#tbshorting'+gtoolid).find('input[name="hidisitenttoolid"]').each(function (i) {         
          var idtoolid = this.value;                                        
          if (!idtoolid) { return true; }
          
          var toolnameid = false;
          $('input[name="hidisitenttool'+idtoolid+'"]').each(function () {
            toolnameid = this.value;            
          });          
          if (!toolnameid) { return true; }
          
          var nameid = $('#lname'+idtoolid).html();                      
          if (!nameid) { nameid = 'Unknow Tool Name'; }
          
          var idsrc = $('#imgid'+idtoolid).attr('src');                              
                   
          
          $('#p_sortsectionslistparam'+gtoolid).append('<div class="sectionmoveitem'+gtoolid+
          '" iditemelem="'+idtoolid+'">'+
	      ((idsrc) ? '<img src="'+idsrc+'" style="width: 16px; height: 16px; float: left; margin-right: 6px">':'')+
          '<label style="margin-left: 4px">' + nameid + '</label>' +            
          '</div>'); 
          
          return true;             
            
        });
        
        $('#p_sortsectionslistparam'+gtoolid).sortable({ opacity: 0.6, cursor: 'move'});        
        
        $("#dialog_shorttool"+gtoolid).dialog({
          title: "Порядок инструментов", 
          width:  450,            
          height: 500,
          position: ["center","top"],         
          modal: true,
          resizable: true,
          buttons: {
           'Применить': function () {
            
              var query = '';
              $('#p_sortsectionslistparam'+gtoolid + ' div').each(function (i) {
                
                var itemtomoveid2 = $(this).attr('iditemelem');
                if (itemtomoveid2 && itemtomoveid2 != 'undefined') {                
                 query = query + ((query) ? (','+itemtomoveid2) : itemtomoveid2);
                }                
              
              });  
              
              if (query == '') {
               $(this).dialog("close");                
              } else {
                
                $('#p_id_short'+gtoolid).show();
                SendDefaultRequest(
                 global_path_element, 'is_ajax_mode=1&typed=short&value='+query+'&groupid='+gtoolid,
                 'PrepereToGetResultList'+gtoolid
                );
                
              }
              
            
           },
           'Отмена': function () { $(this).dialog("close"); }       
          }          
        });   
        
	  }//PreloadToolsForShort
    </script>
  
  
  {/literal}
    

 <!-- настройки параметров (управление)  -->
 <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable ui-resizable" style="display: none; visibility: hidden">
  <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
     <span id="ui-dialog-title-dialog" class="ui-dialog-title">Сортировка инструментов</span>
     <a class="ui-dialog-titlebar-close ui-corner-all" href="#"><span class="ui-icon ui-icon-closethick">close</span></a>
  </div>
  <div style="height: 200px; min-height: 109px; width: auto;" class="ui-dialog-content ui-widget-content" id="dialog_shorttool{$groupiddata}">
   <div class="typelabel" style="font-size: 11px; padding-bottom: 3px; border-bottom: 1px dashed #C0C0C0">Используйте перемещение блоков вверх\вниз для настройки положения инструментов</div>
   
   <div id="p_id_short{$groupiddata}" style="margin: 4px 2px; color: #0000FF">Сохранение, подождите..</div>
   
   <div class="typelabel" id="p_sortsectionslistparam{$groupiddata}" style="margin-top: 8px">
	     
   </div>	      
  </div>
 </div>
    
    {if $grtoolslistX.count > 1}
    <div style="padding-top: 8px" align="right">
      <a style="font-size: 95%" href="javascript:" onclick="PreloadToolsForShort{$groupiddata}()">Изменить порядок инструментов</a>
    </div>
    {/if}
    
    
  {/if}
  </span>
</div>