<?php require_once 'emails.php'; ?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Домашняя работа 5 - Сети, протоколы. Балансировка, безопасность</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="main-wrapper">
    <h1>Домашняя работа 5 - Сети, протоколы. Балансировка. Безопасность.</h1>
    <form action="app.php" method="post" target="send">
        <?php
        foreach ($arEmails as $email) {
            echo "<input name='EMAILS[]' value=$email>";
        }
        ?>
        <input type="submit" value="Проверить">
    </form>
</div>
</body>
</html>
