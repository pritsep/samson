<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('sale');
\Bitrix\Main\Loader::includeModule('catalog');
\Bitrix\Main\Loader::includeModule('iblock');

if ($_POST) { // если передан массив POST
    $ProductId = htmlspecialchars($_POST["ID"]); // пишем данные в переменные и экранируем спецсимволы

    /*
     *
     * теоретически можно сделать еще проверку, на возможность добавить товар в корзину, но так как
     * пользователь делает это прямо сейчас, то можно пропустить этот вариант
     *
    $element_Id = \Bitrix\Iblock\Elements\ElementCatalogTable::getList([ // учитываем что API для D7 в инфоблоке указан как Catalog
        'select' => ['ID'],
        'filter' => [
            'XML_ID' => $_REQUEST["XML_ID"]
        ],
    ])->fetchObject();
    */


    // Получаем корзину пользователя, вдруг там что-то уже лежит, чтобы не затереть, нужно получить готовую корзину
    if (!CModule::IncludeModule("sale")) return;
    $basket = \Bitrix\Sale\BasketBase::loadItemsForFUser(1, 's1');

    //Тут можно сделать дополнительные проверки, в зависимости от функционала магазина и необходимости.
    // Напрмиер Если товар уже есть в корзине, то можно сделать разные условия, либо добавить ему количество,
    // либо игнорировать, и просто оставить в корзине, а может быть наоборот удалить из карзины

    // Добавляем товар в корзину
    $product = array('PRODUCT_ID' => $ProductId, 'QUANTITY' => 1);
    $result = \Bitrix\Catalog\Product\Basket::addProductToBasket($basket, $product, array('SITE_ID' => 's1'));

    // Сохраняем корзину в БД.
    // Учитываем сейчас только ту корзину, которая формируется, и не оформлена в заказ
    if (!$result->isSuccess()) {
        $json['error'] = 'Ошибка добавления товара'; // ошибок не было
    }
    $basket->save();
    $json['error'] = 0; // ошибок не было
    echo json_encode($json); // выводим положительный ответ

} else { // если массив POST не был передан, опять же это будет странным, но ошибку обработаем на всякий случай (взломы, или роботы)
    echo 'false'; // высылаем овтет
}

