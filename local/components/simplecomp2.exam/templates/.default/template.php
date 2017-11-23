<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

?>

<div class="simple2">
	<p>---</p>
	<p><b>Каталог:</b></p>
	<ul>
	<?foreach($arResult['ITEMS'] as $arItems):?>
		<li><?echo $arItems['NAME']?></li>
			<ul>
				<?foreach($arItems['ITEMS'] as $arIt):?>
					<li><?=$arIt['NAME']." - ".$arIt["PROPERTY_PRICE_VALUE"]." - ".$arIt["PROPERTY_MATERIAL_VALUE"]." - ".$arIt["PROPERTY_ARTNUMBER_VALUE"]." - ".$arIt["TEMP_URL"]?></li>
				<?endforeach?>
			</ul>
	<?endforeach?>
	</ul>
</div>
<?

?>