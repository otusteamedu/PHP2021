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
    <h1>Домашняя работа 4</h1>
    <form action="app.php" method="post" target="send">
        <label for="STRING_TO_CHECK">Введите строку для проверки:</label><br>
        <textarea name="STRING_TO_CHECK" rows="5" cols="40"></textarea><br>
        <input type="submit" value="Проверить">
    </form>
</div>

</body>
</html>
