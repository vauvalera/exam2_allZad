<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"IBLOCK_CATALOG" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_CAT"),
			"TYPE" => "STRING"
		),
		"IBLOCK_CLASSIFIC" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_CLASS"),
			"TYPE" => "STRING"
		),
		"TEMP_URL" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("TEMPLATE_URL"),
			"TYPE" => "STRING"
		),
		"CODE_PROP" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CODE_PROPERTY"),
			"TYPE" => "STRING"
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>18000),

	),
);
?>
