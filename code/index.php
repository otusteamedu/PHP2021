<!DOCTYPE HTML>
<html lang="ru">
<?php $title = 'Event Analytics';

include_once 'parts/head.php' ?>
<body>
<header>
    <svg viewBox="0 0 135 135" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M67.5 135C104.779 135 135 104.779 135 67.5C135 30.2208 104.779 0 67.5 0C30.2208 0 0 30.2208 0 67.5C0 104.779 30.2208 135 67.5 135Z"
              fill="#1ABC9C"/>
        <path d="M73.0371 62.5166V22.9658C73.0371 22.9658 109.688 22.526 112.588 62.5166H73.0371Z"
              fill="#F39C12"
              stroke="black"
              stroke-width="2"
              stroke-miterlimit="10"/>
        <path d="M67.5 27.9492C45.6569 27.9492 27.9492 45.6569 27.9492 67.5C27.9492 89.3431 45.6569 107.051 67.5 107.051C89.3436 107.051 107.051 89.3431 107.051 67.5H67.5V27.9492Z"
              fill="#E74C3C"
              stroke="black"
              stroke-width="2"
              stroke-miterlimit="10"/>
    </svg>
    <h1>Events Analytics</h1>
    <h2>Домашняя работа №11</h2>
</header>
<div class="wrapper">
    <div class="menu">
        <span class="button add button_active">Добавить</span>
        <span class="button search">Найти</span>
        <span class="button delete">Удалить всё</span>
    </div>
    <h3 class="delete-question">Уверены что хотите удалить всё?!</h3>
    <form action="app.php" method="post" target="send">
        <label for="storage">Хранилище</label>
        <select name="storage" id="storage">
            <option>Redis</option>
            <option>ElasticSearch</option>
        </select>
        <label for="event">Событие</label>
        <input required type="text" name="event" id="event">
        <label for="priority">Приоритет</label>
        <input required type="number" name="priority" id="priority">
        <label for="conditions">Условие возникновения</label>
        <input required type="text" name="conditions" id="conditions">
        <input type="hidden" name="action" value="add" id="action">
        <input type="submit" value="Выполнить" class="button button_active">
    </form>
</div>
<script src="js/script.js"></script>
</body>
</html>
