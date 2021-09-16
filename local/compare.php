<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

global $APPLICATION;

/** Чтобы по умолчанию режим ajax был включен **/
$_REQUEST["ajax_action"] = "Y";
$_REQUEST["DIFFERENT"]="Y"; // это если принудительно хотим показать только различающиеся
$APPLICATION->IncludeComponent (
"bitrix:catalog.compare.result",
    "",
    Array(
        "AJAX_MODE" => "Y",
        "NAME" => "COMPARE_LIST",
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "26",
        "FIELD_CODE" => array(),
        "PROPERTY_CODE" => array(),
        "OFFERS_FIELD_CODE" => array(),
        "OFFERS_PROPERTY_CODE" => array(),
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_ORDER" => "asc",
        "DETAIL_URL" => "",
        "BASKET_URL" => "/personal/basket.php",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "USE_PRICE_COUNT" => "Y",
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "DISPLAY_ELEMENT_SELECT_BOX" => "Y",
        "AJAX_OPTION_SHADOW" => "Y",
        "AJAX_OPTION_JUMP" => "Y",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "Y",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
    )
);

/*
 * через jquery Ajax обращаемся к странице, где указан только один компонент
 * ?action=ADD_TO_COMPARE_LIST&id= - доавляем товар к сравнению
 * ?action=DELETE_FROM_COMPARE_LIST&id= - удаляем товар из сравнения
 *
 * эти параметры через ajax получаем в этом скрипте
 */
