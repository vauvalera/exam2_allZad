<?
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("MyClass", "OnBeforeIBlockElementUpdateHandler"));

AddEventHandler("main", "OnBeforeEventAdd", array("MyClass", "OnBeforeEventAddHandler"));

AddEventHandler("main", "OnBuildGlobalMenu", array("MyClass", "OnBuildGlobalMenu"));

class MyClass
{
    // создаем обработчик события "OnBeforeIBlockElementUpdate"
    function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
        if (CModule::IncludeModule("iblock")){
            if(($arFields['IBLOCK_ID']===IBLOCK_PRODUCT) && ($arFields['ACTIVE'] !== "Y")) {
            $Elem = CIBlockElement::GetByID($arFields['ID']);
                if($res = $Elem->Fetch()) {
                    $show_count = $res['SHOW_COUNTER'];
                 }
                 if($show_count>=2){
                    global $APPLICATION;
                    $APPLICATION->ThrowException("Товар невозможно деактивировать, у него [".$show_count."] просмотров");
                    return false;
                 }
            }
       }
    }
    
    
	function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
	{
        
        if($event === "FEEDBACK_FORM") {
            global $USER;
            if($USER->IsAuthorized()) {
                $arFields['AUTHOR'] = "Пользователь авторизован: ".$USER->GetID()." (".$USER->GetLogin().") ".$USER->GetFullName()." данные из формы:".$arFields['AUTHOR'];
                
            }
            else {
                 $arFields['AUTHOR'] = "Пользователь не авторизован, данные из
формы:".$arFields['AUTHOR'];
                 
            }
            
            CEventLog::Add(array(
                "SEVERITY" => "SECURITY",
            "AUDIT_TYPE_ID" => $event,
            "MODULE_ID" => "main",
            "ITEM_ID" => $dbUser['ID'],
            "DESCRIPTION" => "Замена данных в отсылаемом письме – ".$arFields['AUTHOR']
      ));
        
        }
        
		
	}
    function OnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu)
    {
        global $USER;
        if((in_array('5',$USER->GetUserGroupArray())) || !(in_array('1',$USER->GetUserGroupArray()))) {
            unset($aGlobalMenu['global_menu_desktop']);
            foreach($aModuleMenu as $k =>$v) {
                if(($aModuleMenu[$k]['parent_menu']==="global_menu_settings") ||
                    ($aModuleMenu[$k]['parent_menu']==="global_menu_services") ||
                  ($aModuleMenu[$k]['items_id']==="menu_iblock"))
                        unset($aModuleMenu[$k]);
                }
           }

    }
}

