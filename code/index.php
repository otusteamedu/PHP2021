<!DOCTYPE HTML>
<html>
<head>
    <style>
        .wrapper {
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -125px 0 0 -125px;
        }
        input, textarea {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <h1>Домашняя работа 6</h1>
    <form action="app.php" method="post" target="send">
        <label for="EMAIL">Введите почтовый адрес для проверки</label>
        <input name="EMAIL"><br>
        <input type="submit" value="Проверить">
    </form>
</div>
</body>
</html>