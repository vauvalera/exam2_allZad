<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("NAME"),
	"DESCRIPTION" => GetMessage("DESCRIPTION"),
	"ICON" => "/images/photo_view.gif",
	"CACHE_PATH" => "Y",
	"SORT" => 1,
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "simp1",
			"NAME" => GetMessage("SECTION_NAME"),
			"SORT" => 1,
		)
	),
);

?>