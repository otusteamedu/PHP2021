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
        <?php
            $fn = [
                'apin@enex.market',
                'somemail_193@mail.ru',
                'wrong@mail',
                '   ',
                'anotherwrong.com',
                'dfgh1234.@mail.com',
                'prst@rambler.ru.',
                '.dot@dot.com',
            ];
            foreach($fn as $val)
            {
                  echo "<input name=EMAIL_LIST[] value=$val><br>";
            }
        ?>
        <input type="submit" value="Проверить">
    </form>
</div>
</body>
</html>