<? include('header.php') ?>

<h1>Форма проверки строки</h1>
<p>Проверка строки соответствия закрытых и открытых скобок в строке</p>
<form method="POST" class="container-fluid" action="/check">
    <div class="form-group row">
        <input class="form-control col-7" name="string"><br />
        <div class="col-5">
            <button class="btn btn-primary" type="submit">Отправить</button>
        </div>
    </div>
</form>

<? include('footer.php') ?>