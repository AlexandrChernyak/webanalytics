{* 
  блок настроек панели 

*}
 <div class="typelabel">
 <input type="checkbox" style="cursor: pointer"{if $PANEL_CONTROL->GetPanelOption('NOEXISTSURL')} checked="checked"{/if} name="NOEXISTSURL" id="NOEXISTSURL"><label for="NOEXISTSURL" style="cursor: pointer">&nbsp; Разрешить добавление несуществующих сайтов в панель.</label>
 </div>  
 
 <div class="typelabel">Кол-во дат (последних) на графике истории. 0 - все даты проверки.</div>
 <div class="typelabel">
  <input type="text" class="inpt" style="width: 98%" name="COUNTONGRAPH" id="COUNTONGRAPH" value="{if !$PANEL_CONTROL->GetPanelOption('COUNTONGRAPH')}0{else}{$PANEL_CONTROL->GetPanelOption('COUNTONGRAPH')}{/if}" maxlength="3">
 </div>
 
 <div class="typelabel">
 <input type="checkbox" style="cursor: pointer"{if $PANEL_CONTROL->GetPanelOption('NODISPLAYSELECTPARAM')} checked="checked"{/if} name="NODISPLAYSELECTPARAM" id="NODISPLAYSELECTPARAM"><label for="NODISPLAYSELECTPARAM" style="cursor: pointer">&nbsp; При обновлении показателей, обновлять все параметры выбранных сайтов (не отображать окно выбора параметров для обновления)</label>
 </div> 
 
 <div class="typelabel">
 <input type="checkbox" style="cursor: pointer"{if $PANEL_CONTROL->GetPanelOption('NODISPLAYNOTNEEDUPDATEDLOG')} checked="checked"{/if} name="NODISPLAYNOTNEEDUPDATEDLOG" id="NODISPLAYNOTNEEDUPDATEDLOG"><label for="NODISPLAYNOTNEEDUPDATEDLOG" style="cursor: pointer">&nbsp; Не записывать в лог информацию, если параметр не нуждается в обновлении.</label>
 </div>
 
 
 <div class="typelabel">Укажите Логин и Ключ системы Яндекс.XML для возможности использовать Яндекс.XML при обработки значений от Яндекса. Если какой-либо параметр имеет свои настройки Яндекс.XML - данные настройки будут перекрыты персональными настройками параметра, при отключении Я.xml параметра - данные настройки вновь активируются для запросов к Яндексу.</div>
 
 <div class="typelabel">Логин от Яндекс.XML</div>
 <div class="typelabel">
  <input type="text" class="inpt" style="width: 98%" name="YXMLLOGIN" id="YXMLLOGIN" value="{if $PANEL_CONTROL->GetPanelOption('YXMLLOGIN')}{$PANEL_CONTROL->GetPanelOption('YXMLLOGIN')}{/if}" maxlength="150">
 </div>
 
 <div class="typelabel">Ключ Яндекс.XML</div>
 <div class="typelabel">
  <input type="text" class="inpt" style="width: 98%" name="YXMLKEY" id="YXMLKEY" value="{if $PANEL_CONTROL->GetPanelOption('YXMLKEY')}{$PANEL_CONTROL->GetPanelOption('YXMLKEY')}{/if}" maxlength="150">
 </div>
 
 <div class="typelabel">
 <input type="checkbox" style="cursor: pointer"{if $PANEL_CONTROL->GetPanelOption('CANADDEXISTSPARAM')} checked="checked"{/if} name="CANADDEXISTSPARAM" id="CANADDEXISTSPARAM"><label for="CANADDEXISTSPARAM" style="cursor: pointer">&nbsp; Разрешить добавление одного и того же параметра более одного раза.</label>
 </div>