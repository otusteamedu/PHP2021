<? include('header.php') ?>

<h1>Результаты проверки</h1>
<div>
    <p>Был указан почтовый адрес: <?= $email ?></p>
    <p>Результат проверки: <?= $msg ?></p>
</div>
<a href="/" class="btn btn-primary">Вернуться</a>

<? include('footer.php') ?>