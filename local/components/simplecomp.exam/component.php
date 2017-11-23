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
	$arParams["CACHE_TIME"] = 1800000;

//if(!is_array($arParams["ID_CATEGORTY"]))
	//$arParams["ID_CATEGORTY"] = 1;

if((!empty($arParams["ID_CATEGORTY"])) &&
	(!empty($arParams["ID_NEWS"])) &&
		(!empty($arParams["CODE_PROPERTY_NEWS"]))
   )
{
	if(!CModule::IncludeModule("iblock"))
	{
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	if ($this->StartResultCache())
{
	$Razdels = [];
	$arResult = [];
	$count =0;
	$arSelect = Array("ID","NAME",$arParams["CODE_PROPERTY_NEWS"]);
	$arFilter = Array("IBLOCK_ID"=>$arParams["ID_CATEGORTY"],  'ACTIVE'=>'Y', "!".$arParams["CODE_PROPERTY_NEWS"] = false);
	$Sections = CIBlockSection::GetList(Array(), $arFilter, false, $arSelect);
	while ($Section = $Sections->Fetch()){
		$Razdels[] = $Section; 
	}
	$id_sect= array_column($Razdels,"ID");

	$arSelect = Array("ID","IBLOCK_SECTION_ID","NAME","PROPERTY_PRICE","PROPERTY_ARTNUMBER", "PROPERTY_MATERIAL");
	$arFilter = Array("IBLOCK_ID"=>$arParams["ID_CATEGORTY"], "SECTION_ID"=>$id_sect, 'ACTIVE'=>'Y');
	$Elems = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while ($Elem = $Elems->Fetch()){
		foreach($Razdels as &$item) {
			if($Elem['IBLOCK_SECTION_ID']==$item['ID']) {
				$item['ITEMS'][] = $Elem;
				$count++;
			}
		}
	}
	
	$arResult['COUNT'] = $count;
	$arSelect = Array("ID","NAME","ACTIVE_FROM");
	$arFilter = Array("IBLOCK_ID"=>$arParams["ID_NEWS"],  'ACTIVE'=>'Y');
	$News = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	$i=0;
	while ($idNews = $News->Fetch()) {
		$arResult['ITEMS'][$i] = $idNews; 
		foreach($Razdels as &$item1) {
			foreach($item1['UF_NEWS_LINK'] as &$link) {
				if($idNews['ID']==$link) {
					$arResult['ITEMS'][$i]['ITEMS'][] = $item1;
				}
			}
		}
		$i++;
	}
	
	$this->SetResultCacheKeys(array("ITEMS","COUNT",));
	$this->IncludeComponentTemplate();
	
	
	}
	global $APPLICATION;
	$APPLICATION->SetTitle("В каталоге товаров представлено товаров: ".$arResult['COUNT']);
}
else
	{
		$this->AbortResultCache();
	}


?>
