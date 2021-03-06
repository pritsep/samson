<?
    // --------------------------------------
?>
<script type="text/javascript">
// для наглядности, код лежит в footer.php 
// использую JQuery, библиотека работоспособна, хоть сторонняя (новая версия), хоть в ядре JS от Битрикса
// при сборке проекта до конца, этот код необходимо будет уложить в файл.js, вместе со всеми используемыми функциями JS, который затем подключается внизу
$(document).keydown(function(e){
    if ((e.keyCode == 10 || e.keyCode == 13) && e.ctrlKey) {
        var txt_sel = window.getSelection().toString();
        var url_page = location.href;
        if(txt_sel != '' ) {
            // здесь можно дополнительно проверить текст по каким-либо параметрам (например область выделения, слишком большая или слишком малая и др.)

            $.ajax({ // инициализируем ajax запрос
                type: 'POST', // отправляем в POST формате
                url: '/local/templates/test/scripts/send_error.php', // путь до обработчика
                dataType: 'json', // ответ ждем в json формате
                data: { "TXT_SEL":txt_sel, "URL_PAGE":url_page}, // данные для отправки
                beforeSend: function(data) { // событие до отправки
                    // Тут можно сделать какую либо индикацию пользователю начала отправки (на случай медленного интернета или задержек)    
                },
                success: function(data){ // событие после удачного обращения к серверу и получения ответа
                    if (data['error']) { // если обработчик вернул ошибку
                        alert(data['error']); // покажем её текст
                    } else { // если все прошло ок
                        alert("Благодарим пользователя за помощь");
                    }
                 },
               error: function (xhr, ajaxOptions, thrownError) { // в случае каких либо ошибок по пути к запросу... 
                    alert(xhr.status); // можем показать ответ пользователю, но пользователь может не его понять 
                    alert(thrownError); // и текст ошибки
                 },
               complete: function(data) { // событие после любого исхода
                    // если включали индикацию, отключаем ее
                 }                       
            });            
        }
    }
});
</script>