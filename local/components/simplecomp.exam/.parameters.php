<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array(
	"-" => GetMessage("IBLOCK_ANY"),
);
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"ID_CATEGORTY" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("ID_CATEGORTY"),
			"TYPE" => "STRING",
		),
		"ID_NEWS" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("ID_NEWS"),
			"TYPE" => "STRING",
		),
		"CODE_PROPERTY_NEWS" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CODE_PROPERTY_NEWS"),
			"TYPE" => "STRING",
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>180),
	),
);
?>
