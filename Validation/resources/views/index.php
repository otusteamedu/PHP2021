<div class="container" style=" margin-top: 49px">
    <form method="post">
        <div class="form-group">
            <label for="inputString">Верификация строки со скобками</label>
            <input type="text" class="form-control" id="stringValidation"
                   placeholder="Введите строку содержащую ()())(">
            <small id="stringHelp" class="form-text"></small>
        </div>
        <button type="submit" class="btn btn-primary" id="button">Submit</button>
    </form>
</div>
<script>

    $('#button').click((e) => {
        let value = $('#stringValidation').val();
        const regex = /[()]+/g;
        let result = value.match(regex);

        e.preventDefault();

        let formData = new FormData();
        formData.append('string', value)
        if (value.length < 0 || !result) {
            $('#stringHelp').text('Заполните поле! Или строка не содержит скобки').css('color', 'red');
            return;
        }
        $('#stringValidation').val(result.join(''))
        axios.post(`send-message`, formData).then((resp) => {
            $('#stringHelp').text(resp.data.response).css('color', 'green')
            clearData(value)
        }, (err) => {
            if (err.response.status === 400) {
                $('#stringHelp').text(err.response.data).css('color', 'red')
                clearData(value)
            }
        })
    })

    function clearData() {
        let interval = setInterval(() => {
            $('#stringHelp').text(' ')
            clearInterval(interval)
        }, 1000)
    }
</script>