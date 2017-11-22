<?
include("const.php");
if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/deactiv.php"))
require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/deactiv.php");

if (Bitrix\Main\Loader::IncludeModule("iblock"))
{
    global $APPLICATION;
    $page = $APPLICATION->GetCurPage();
    $arSelect = Array("PROPERTY_U_TITLE", "PROPERTY_U_DESCRIPTION");
    $arFilter = Array("IBLOCK_ID"=>IBLOCK_META, "NAME" =>$page);
    $res = CIBlockElement::GetList(
                    Array(),
                    $arFilter,
                    false,
                    false,
                    $arSelect
                    )->Fetch();
    
    $APPLICATION->SetPageProperty("title",$res['PROPERTY_U_TITLE_VALUE']);
    $APPLICATION->SetPageProperty("description",$res['PROPERTY_U_DESCRIPTION_VALUE']);

}
   
?>