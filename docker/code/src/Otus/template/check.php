<? include('header.php') ?>

<h1>Результаты проверки</h1>
<div>
    <p>Была введена строка: <?= $str ?></p>
    <p>Количество символов в строке: <?= $strlen ?></p>
    <p>Корректность скобок в строке: <?= $msg ?></p>
</div>
<a href="/" class="btn btn-primary">Вернуться</a>

<? include('footer.php') ?>