<? include('header.php') ?>

<h1>Форма проверки e-mail адреса</h1>
<p>Введите электрронный адрес для проверки:</p>
<form method="POST" class="container-fluid" action="/check">
    <div class="form-group row">
        <input class="form-control col-7" name="email"><br />
        <div class="col-5">
            <button class="btn btn-primary" type="submit">Отправить</button>
        </div>
    </div>
</form>

<? include('footer.php') ?>