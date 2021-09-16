<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?><!DOCTYPE html><?
?><html lang="<?= LANGUAGE_ID ?>"><?
    ?><head><?
        ?><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><?
        ?><meta http-equiv="X-UA-Compatible" content="IE=edge"><?
        ?><meta name="viewport" content="width=device-width,initial-scale=1"><?
        ?><title><? $APPLICATION->ShowTitle() ?></title><?
        ?><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script><?

        $APPLICATION->ShowHead(); 
?></head><?
?><body><?
?><div id="panel"><? $APPLICATION->ShowPanel(); ?></div><?
