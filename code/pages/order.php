<!doctype html>
<html lang="ru">
<?php use App\Helpers\Locales;

$TITLE = 'Ваш заказ готов!';

require_once 'parts/head.php'; ?>
<body>
<main class="order">
    <h2>Состав вашего блюда:</h2>
    <div class="ingredients">
        <?php $localesHelper = new Locales();

        foreach ($arIngredients as $ingredient) { ?>
            <div class="ingredient">
                <img src="img/<?= $ingredient->name ?>.png" alt="" class="ingredient__img">
                <p class="ingredient__name"><?= $localesHelper->getLocales($ingredient->name) . '. ' ?>
                    <span class="ingredient__amount">Количество: <?= $ingredient->amount ?></span>
                    <?php if ($ingredient->custom) { ?>
                    <span class="ingredient__custom">(Дополнительный ингридиент)</span>
                    <?php } ?>
                </p>
            </div>
        <?php } ?>
    </div>
</main>
<script src="js/script.js"></script>
</body>
</html>
