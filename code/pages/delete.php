<?php require_once('../vendor/autoload.php');

use App\Application;

$app = new Application();
$heroes = $app->showAll();
$title = 'Удаление' ?>
<!doctype html>
<?php require_once '../parts/head.php' ?>
<body>
<main>
    <div class="wrapper">
        <svg class="green_icon" viewBox="0 0 126 141" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 24.6327H5.229C2.338 24.6327 0 22.271 0 19.3664C0 16.4618 2.338 14.1 5.229 14.1H42V7.05C42 3.27825 45.318 0 49 0H77C80.682 0 84 3.27825 84 7.05V14.1H120.778C123.662 14.1 126 16.4618 126 19.3664C126 22.271 123.662 24.6327 120.778 24.6327H119V133.449C119 137.616 115.864 141 112 141C91.889 141 34.111 141 14 141C10.136 141 7 137.616 7 133.449V24.6327ZM108.5 24.6327H17.5V130.425H108.5V24.6327ZM78.75 42.3C75.852 42.3 73.5 44.6688 73.5 47.5875V107.513C73.5 110.431 75.852 112.8 78.75 112.8C81.648 112.8 84 110.431 84 107.513V47.5875C84 44.6688 81.648 42.3 78.75 42.3ZM47.25 42.3C44.352 42.3 42 44.6688 42 47.5875V107.513C42 110.431 44.352 112.8 47.25 112.8C50.148 112.8 52.5 110.431 52.5 107.513V47.5875C52.5 44.6688 50.148 42.3 47.25 42.3ZM73.5 14.1V10.575H52.5V14.1H73.5Z"
                  fill="#1DF576"/>
        </svg>
        <h1 class="success_title">Удаление из базы</h1>
        <?php foreach ($heroes as $hero) { ?>
            <div class="delete">
                <span class="delete__nickname"><?php echo $hero->getNickname() ?></span>
                <a href="/app.php?action=delete&id=<?php echo $hero->getId() ?>" class="delete__link">
                    <svg class="red_icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 3.752L19.577 0L11.806 9.039L4.159 0.031L0 4.309C2.285 7.194 5.284 10.212 8.362 13.017L0.197 22.464L1.54 23.951C3.518 22.616 7.521 19.578 11.745 15.993C16.049 19.663 20.051 22.656 21.974 23.999L23.423 22.721L15.169 12.997C18.456 10.024 21.753 6.643 24 3.752Z"/>
                    </svg>
                </a>
            </div>
        <?php } ?>
        <a href="/" class="button button_delete">Назад</a>
    </div>
</main>
</body>
</html>
