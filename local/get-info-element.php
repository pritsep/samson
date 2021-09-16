<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$app = \Bitrix\Main\Page\Asset::getInstance();

// подключаем в хедер jquery (Если мы знаем что библиотека не подкчлюена, можем её подключить на этой странце)
$app->addJs("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js");
?>
<div class="main">
    <button class="addElement">Добавить строку для ввода XML_ID</button>
    <div class="new-input"></div>
</div>

<script>
    // запрос товара, по введенному ID
    function getElement($input) {
        if ($input.value.length > 7) { // чтобы не долбить сервер, начнем отправлять запросы, когда введем весь код (для примера 7 значный)
            var $xmlId = $input.value;
            var divId = $($input).data("id");
            $.ajax({ // инициализируем ajax запрос
                type: 'POST', // отправляем в POST формате
                url: '/local/templates/test/scripts/get_element.php', // путь до обработчика
                dataType: 'json', // ответ ждем в json формате
                data: {"XML_ID": $xmlId}, // данные для отправки
                beforeSend: function (data) { // событие до отправки
                    // Тут можно сделать какую либо индикацию пользователю начала отправки (на случай медленного интернета или задержек)
                },
                success: function (data) { // событие после удачного обращения к серверу и получения ответа
                    if (data['error']) { // если обработчик вернул ошибку
                        alert(data['error']); // покажем её текст
                    } else { // если все прошло ок
                        $('#info'+divId).html(data['info']);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) { // в случае каких либо ошибок по пути к запросу...
                    alert(xhr.status); // можем показать ответ пользователю, но пользователь может не его понять
                    alert(thrownError); // и текст ошибки
                },
                complete: function (data) { // событие после любого исхода
                    // если включали индикацию, отключаем ее
                }
            });
        }
    }

    // добавление в корзину
    function addCard($idProduct) {
        $.ajax({ // инициализируем ajax запрос
            type: 'POST', // отправляем в POST формате
            url: '/local/templates/test/scripts/basket-add-Id.php', // путь до обработчика
            dataType: 'json', // ответ ждем в json формате
            data: {"ID": $idProduct}, // данные для отправки
            beforeSend: function (data) { // событие до отправки
                // Тут можно сделать какую либо индикацию пользователю начала отправки (на случай медленного интернета или задержек)
            },
            success: function (data) { // событие после удачного обращения к серверу и получения ответа
                if (data['error']) { // если обработчик вернул ошибку
                    alert(data['error']); // покажем её текст
                } else { // если все прошло ок
                    $("#btn"+$idProduct).html('Добавлено в корзину');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) { // в случае каких либо ошибок по пути к запросу...
                alert(xhr.status); // можем показать ответ пользователю, но пользователь может не его понять
                alert(thrownError); // и текст ошибки
            },
            complete: function (data) { // событие после любого исхода
                // если включали индикацию, отключаем ее
            }
        });

    }

    let count = 0;
    $('.addElement').click(function () {
        var input = document.createElement("input");
        var btn = document.createElement("span");
        var addCart = document.createElement("a");
        var div = document.createElement("div");
        var divContent = document.createElement("div");
        count++;
        input.setAttribute("type", "text");
        input.setAttribute("data-id", count);
        input.setAttribute("onkeyUp", "getElement(this)");
        btn.innerHTML = "&times; Удалить строку";
        divContent.setAttribute("id", "info" + count);
        divContent.innerHTML = "тут будет информация о позиции" + count;
        btn.setAttribute("class", "del");
        div.append(input, btn, divContent);
        $('.new-input').append(div);
        //изменения
        $(btn).click(function () {
            //getElement(5);
            $(this).parent().remove();
        })
    });
</script>