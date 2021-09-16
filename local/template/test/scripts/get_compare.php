<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

global $APPLICATION;

/** Чтобы по умолчанию режим ajax был включен **/
$_REQUEST["ajax_action"] = "Y";
$APPLICATION->IncludeComponent(
    "bitrix:catalog.compare.list",
    "set_compare",
    Array(
        "ACTION_VARIABLE" => "action",
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "COMPARE_URL" => "/catalog/compare/",
        "DETAIL_URL" => "",
        "IBLOCK_ID" => "26",
        "IBLOCK_TYPE" => "catalog",
        "NAME" => "COMPARE_LIST",
        "POSITION" => "top left",
        "POSITION_FIXED" => "Y",
        "PRODUCT_ID_VARIABLE" => "id"
    )
);
