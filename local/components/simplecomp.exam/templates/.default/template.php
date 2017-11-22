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
<pre><?//print_r($arResult);?></pre>
<div class="MyComponent">

	<b><?=GetMessage('CATALOG')?></b>
	<ul></ul>
	<?foreach($arResult['ITEMS'] as $arItems):?>
	<li><?echo $arItems['NAME']?> - <?echo $arItems['ACTIVE_FROM']?>(
	<?foreach($arItems['ITEMS'] as $arTemp):?>
		<?echo $arTemp['NAME'];?>
	<?endforeach;?>)
	<?foreach($arItems['ITEMS'] as $arTemp):?>
	<ul>
		<?foreach($arTemp['ITEMS'] as $arTemp2):?>
			<li>
			<?echo $arTemp2['NAME']?> - <?echo $arTemp2['PROPERTY_PRICE_VALUE']?> - <?echo $arTemp2['PROPERTY_MATERIAL_VALUE']?> - <?echo $arTemp2['PROPERTY_ARTNUMBER_VALUE']?>
			</li>
		<?endforeach;?>
	</ul>
	<?endforeach;?>
	</li>
	<?endforeach;?>
</div>
