# samson

Задание 1
файлы 
\local\template\test\footer.php
и
\local\template\test\scripts\send_error.php 
В футере лежит JS код, который отрабатывает действие пользователя, этот же код продублирован в \local\template\test\js\test.js, но не задействован, комментарии в коде.

------------------------------------------------------------

Задание 2
Сделал через стандартный компонент bitrix:catalog.compare.result и bitrix:catalog.compare.list
Не делал JS обращение скрипту, но в нем описал с какими параметрами требуется обращение.
В ответ увидим JSON. Все по аналогии с третьим заданием, добавления в корзину (но стандартный компонент работает через GET). В третьем я сделал JS, ajax обращение к бэкенду. 

\local\compare.php
Тут расположен компонент сравнения, с принудительным включением параметра для отображения только различающихся свойств
bitrix:catalog.compare.result

\local\template\test\scripts\get_compare.php
тут расположен bitrix:catalog.compare.list
Который выдает JS скрипт через тему set_compare, чтобы, установить всем товарам, который подгрузились на странице свойство, что они находятся в спсике сравнения.

------------------------------------------------------------ 

Задание 3 
\local\get-info-element.php
на этой странице на JS создаются строки, подгружается информация о товаре.
сделана проверка, после ввода 7 символов подгрузка начинается автоматически, нет необходимости нажимать какие-то кнопки
Товар подгружается в блок под вводимой строкой.
В этом помогает скрипт на бэкенде \local\template\test\scripts\get_element.php 
По XML_ID сразу возвращаем обратно ID товара

Далее рядом с товаром есть кнопка добавить в корзину, обращается к скрипту
\local\template\test\scripts\basket-add-Id.php
Там мы ищем добавляем товар в корзину уже по известному ID. В кол-ве 1 штука, без увеличения при повторном добавлении.


