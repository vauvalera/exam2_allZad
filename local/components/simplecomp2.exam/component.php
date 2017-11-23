<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


/*************************************************************************
	Processing of received parameters
*************************************************************************/
if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 1800;

if(!empty($arParams["IBLOCK_CATALOG"]) &
   !empty($arParams["IBLOCK_CLASSIFIC"]) &
   !empty($arParams["CODE_PROP"]) 
   )
{

	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	$this->StartResultCache(false, $USER->GetGroups());
	$arSelect = array(
		"ID",
		"NAME",
		"PROPERTY_FIRM",
		"PROPERTY_PRICE",
		"PROPERTY_MATERIAL",
		"PROPERTY_ARTNUMBER"
	);

	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_CATALOG"],
		"ACTIVE_DATE" => "Y",
		"ACTIVE"=>"Y",
		"CHECK_PERMISSIONS"=>"Y",
		"!PROPERTY_".$arParams['CODE_PROP'] => false
	);

	$CatElement = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	
	$Elements = [];
	while ($Elem = $CatElement ->Fetch())
	{
		$Elem['TEMP_URL'] = $arParams['TEMP_URL'].$Elem['ID']."/";
		$Elements[] = $Elem;
	}

	$arSelect = array(
		"ID",
		"NAME",
	);

	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_CLASSIFIC"],
		"ACTIVE_DATE" => "Y",
		"ACTIVE"=>"Y",
		"CHECK_PERMISSIONS"=>"Y",
	);
	$ClassElement = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	$i=0;
	while ($ClElem = $ClassElement->Fetch())
	{
		$arResult['ITEMS'][$i] = $ClElem;
			foreach($Elements as $element) {
				if($element['PROPERTY_FIRM_VALUE']==$ClElem['ID']) 
					$arResult['ITEMS'][$i]['ITEMS'][] = $element;
			}
		$i++;
	}
	$arResult['COUNT'] = $i;
 
	$this->SetResultCacheKeys(array(
		"ITEMS",
		"COUNT"
		));
	global $APPLICATION;
	$APPLICATION->SetTitle('Разделов: '.$arResult['COUNT']);
		$this->IncludeComponentTemplate();
}
else
	{
		$this->AbortResultCache();
	}

?>
