<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Результаты поиска по видео</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="wrapper">
    <?php require_once 'parts/header.php' ?>
    <h2>Найдено</h2>
    <ol>
        <?php foreach ($result['data'] as $searchItem) { ?>
            <div class="search-item">
                <svg width="35" height="30" viewBox="0 0 35 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M34.2857 30H0V0H34.2857V30ZM5.71429 28.5714V22.8571H1.42857V28.5714H5.71429ZM27.1429 28.5714V1.42857H7.14286V28.5714H27.1429ZM32.8571 28.5714V22.8571H28.5714V28.5714H32.8571ZM24.2857 15L11.4286 22.1429V7.85714L24.2857 15ZM28.5714 15.7143V21.4286H32.8571V15.7143H28.5714ZM5.71429 21.4286V15.7143H1.42857V21.4286H5.71429ZM12.8571 19.7143L21.3443 15L12.8571 10.2857V19.7143ZM28.5714 8.57143V14.2857H32.8571V8.57143H28.5714ZM5.71429 14.2857V8.57143H1.42857V14.2857H5.71429ZM28.5714 1.42857V7.14286H32.8571V1.42857H28.5714ZM5.71429 7.14286V1.42857H1.42857V7.14286H5.71429Z"
                          fill="#FF0000"/>
                </svg>
                <li><?php echo $searchItem['_source']['title'] ?></li>
            </div>
        <?php } ?>
    </ol>
    <a href="index.php" class="red-button red-button_link">
        <svg viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.5 12.4561V8.9375C16.5 8.5855 16.3652 8.2335 16.0971 7.964C15.829 7.69587 15.477 7.5625 15.125 7.5625C14.773 7.5625 14.421 7.69587 14.1529 7.964L5.5 16.5L14.1529 25.0346C14.421 25.3028 14.773 25.4375 15.125 25.4375C15.477 25.4375 15.829 25.3028 16.0971 25.0346C16.3652 24.7665 16.5 24.4131 16.5 24.0625V20.6401C20.2812 20.7336 24.4131 21.4184 27.5 26.125V24.75C27.5 18.3796 22.6875 13.1409 16.5 12.4561Z"
                  fill="black"/>
        </svg>
        Назад
    </a>
</div>
</body>
</html>
