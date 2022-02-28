
$(document).ready(function () {
    $(".but-send").click(
        function () {
            sendAjaxForm('result-form', 'ajax-form', '/');
            return false;
        }
    );
});

function sendAjaxForm(result_form, ajax_form, url) {
    $.ajax({
        url: url, //url страницы (action_ajax_form.php)
        type: "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#" + ajax_form).serialize(),  // Сеарилизуем объект
        success: function (response) { //Данные отправлены успешно
            result = $parseJSON(response);
            $('#result-form').html('Имя: ' + result.name+ '<br>Телефон: ' + result.phone + '<br>Email: ' + result.email);
        },
        error: function (response) { // Данные не отправлены
            $('#result-form').html('Ошибка. Данные не отправлены.');
        }
    });
}

