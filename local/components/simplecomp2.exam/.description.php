<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("T_NAME"),
	"DESCRIPTION" => GetMessage("T_DESCRIPTION"),
	"CACHE_PATH" => "Y",
	"SORT" => 2,
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "simp1",
			"NAME" => GetMessage("T_NAME_PATH"),
			"SORT" => 2,
		)
	),
);

?>