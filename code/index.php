<!doctype html>
<html lang="ru">
<?php
$TITLE = 'Shot Burger';

require_once 'parts/head.php'; ?>
<body>
<header>
    <img class="logo" src="img/Burger-Shot-Logo-Vector.png" alt="">
</header>
<main>
    <form action="app.php" method="post">
        <label for="email">Почта для уведомлений:</label>
        <input name="email" type="email" placeholder="pupkin@mail.ru" required>
        <label for="meal">Основное блюдо:</label>
        <select name="meal" id="meal">
            <option value="Burger">Блидер бургер</option>
            <option value="Hotdog">Хот-дог</option>
            <option value="Sandwich">Сендвич</option>
        </select>
        <label for="second_meal">Дополнительно блюдо:</label>
        <div class="checkboxes">
            <div class="checkbox-block">
                <input type="checkbox" name="client_ingredients[]" value="potato">
                <span>Картошка</span>
            </div>
            <div class="checkbox-block">
                <input type="checkbox" name="client_ingredients[]" value="nuggets">
                <span>Наггетсы</span>
            </div>
            <div class="checkbox-block">
                <input type="checkbox" name="client_ingredients[]" value="chicken_wings">
                <span>Куриные крылышки</span>
            </div>
        </div>
        <input type="submit" value="Заказать!">
    </form>
</main>
<script src="js/script.js"></script>
</body>
</html>
