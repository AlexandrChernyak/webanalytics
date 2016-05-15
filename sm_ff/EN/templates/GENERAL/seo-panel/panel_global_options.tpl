{* 
  блок настроек панели 

*}
 <div class="typelabel">
 <input type="checkbox" style="cursor: pointer"{if $PANEL_CONTROL->GetPanelOption('NOEXISTSURL')} checked="checked"{/if} name="NOEXISTSURL" id="NOEXISTSURL"><label for="NOEXISTSURL" style="cursor: pointer">&nbsp; Allow addition of non-existing sites in the panel.</label>
 </div>  
 
 <div class="typelabel">Number of the dates (the latest) on the chart history. 0 - all dates.</div>
 <div class="typelabel">
  <input type="text" class="inpt" style="width: 98%" name="COUNTONGRAPH" id="COUNTONGRAPH" value="{if !$PANEL_CONTROL->GetPanelOption('COUNTONGRAPH')}0{else}{$PANEL_CONTROL->GetPanelOption('COUNTONGRAPH')}{/if}" maxlength="3">
 </div>
 
 <div class="typelabel">
 <input type="checkbox" style="cursor: pointer"{if $PANEL_CONTROL->GetPanelOption('NODISPLAYSELECTPARAM')} checked="checked"{/if} name="NODISPLAYSELECTPARAM" id="NODISPLAYSELECTPARAM"><label for="NODISPLAYSELECTPARAM" style="cursor: pointer">&nbsp; When you update the indicators, to update all the parameters of the selected sites (no display window for selecting options for upgrade)</label>
 </div> 
 
 <div class="typelabel">
 <input type="checkbox" style="cursor: pointer"{if $PANEL_CONTROL->GetPanelOption('NODISPLAYNOTNEEDUPDATEDLOG')} checked="checked"{/if} name="NODISPLAYNOTNEEDUPDATEDLOG" id="NODISPLAYNOTNEEDUPDATEDLOG"><label for="NODISPLAYNOTNEEDUPDATEDLOG" style="cursor: pointer">&nbsp; Do not write in the log information, if the parameter does not need to be updated.</label>
 </div>
 
 
 <div class="typelabel">Enter the username and key systems to be able to use Yandex.XML for processing the values from a Yandex. If any option has its own settings Yandex.XML - these settings will be overridden personal settings option, if you disable Y.xml parameters - these settings are activated again for the request to Yandex.</div>
 
 <div class="typelabel">Login Yandex.XML</div>
 <div class="typelabel">
  <input type="text" class="inpt" style="width: 98%" name="YXMLLOGIN" id="YXMLLOGIN" value="{if $PANEL_CONTROL->GetPanelOption('YXMLLOGIN')}{$PANEL_CONTROL->GetPanelOption('YXMLLOGIN')}{/if}" maxlength="150">
 </div>
 
 <div class="typelabel">Key Yandex.XML</div>
 <div class="typelabel">
  <input type="text" class="inpt" style="width: 98%" name="YXMLKEY" id="YXMLKEY" value="{if $PANEL_CONTROL->GetPanelOption('YXMLKEY')}{$PANEL_CONTROL->GetPanelOption('YXMLKEY')}{/if}" maxlength="150">
 </div>
 
 <div class="typelabel">
 <input type="checkbox" style="cursor: pointer"{if $PANEL_CONTROL->GetPanelOption('CANADDEXISTSPARAM')} checked="checked"{/if} name="CANADDEXISTSPARAM" id="CANADDEXISTSPARAM"><label for="CANADDEXISTSPARAM" style="cursor: pointer">&nbsp; Allow the addition of one and the same parameter more than once.</label>
 </div>