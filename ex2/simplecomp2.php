<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент2");
?><?$APPLICATION->IncludeComponent(
	"simplecomp2.exam", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_CATALOG" => "2",
		"IBLOCK_CLASSIFIC" => "7",
		"TEMP_URL" => "/ex2/simplecomp2/",
		"CODE_PROP" => "FIRM",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "18000"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>