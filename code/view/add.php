<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="wrapper">
    <?php require_once 'parts/header.php';

    if($result[0]['_shards']['successful']) {
        $message = 'Данные успешно добавлены';
        require_once 'parts/success.php';
    } else {
        require_once 'parts/failure.php';
    } ?>
    <a href="index.php" class="red-button red-button_link">
        <svg viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.5 12.4561V8.9375C16.5 8.5855 16.3652 8.2335 16.0971 7.964C15.829 7.69587 15.477 7.5625 15.125 7.5625C14.773 7.5625 14.421 7.69587 14.1529 7.964L5.5 16.5L14.1529 25.0346C14.421 25.3028 14.773 25.4375 15.125 25.4375C15.477 25.4375 15.829 25.3028 16.0971 25.0346C16.3652 24.7665 16.5 24.4131 16.5 24.0625V20.6401C20.2812 20.7336 24.4131 21.4184 27.5 26.125V24.75C27.5 18.3796 22.6875 13.1409 16.5 12.4561Z" fill="black"/>
        </svg>
        Назад
    </a>
</div>
</body>
</html>
