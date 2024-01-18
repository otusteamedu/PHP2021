<!doctype html>
<?php $title = 'Super Hero Storage';

require_once 'parts/head.php' ?>
<body>
<header>
    <div class="logo">
        <svg viewBox="0 0 121 121" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.2"
                  d="M60.1582 120.658C26.9336 120.658 0 93.7246 0 60.5C0 93.9131 26.9336 121 60.1582 121C93.3828 121 120.316 93.9131 120.316 60.5C120.316 93.7246 93.3828 120.658 60.1582 120.658Z"
                  fill="#B71C1C"/>
            <path opacity="0.2"
                  d="M60.1582 0.341825C93.3828 0.341825 120.316 27.2754 120.316 60.5C120.316 27.0869 93.3828 0 60.1582 0C26.9336 0 0 27.0869 0 60.5C0 27.2754 26.9336 0.341825 60.1582 0.341825Z"
                  fill="white"/>
            <path d="M60.1582 120.658C93.3826 120.658 120.316 93.7244 120.316 60.5C120.316 27.2755 93.3826 0.341812 60.1582 0.341812C26.9337 0.341812 0 27.2755 0 60.5C0 93.7244 26.9337 120.658 60.1582 120.658Z"
                  fill="#F44336"/>
            <path d="M120.182 64.4789L96.1895 40.4861L94.5888 38.8854L94.4965 47.3987L84.1767 36.7291H75.015C75.2631 36.8667 88.0149 49.6428 88.1244 49.7058C86.5377 49.7199 84.7379 49.7325 82.8245 49.7401C82.7383 49.6529 76.3415 43.254 76.161 43.0805C75.986 42.892 75.803 42.715 75.619 42.5391C69.6058 36.0827 58.3493 36.8823 57.4282 36.8823C47.8011 37.0885 42.9566 39.2378 40.524 41.4803C40.3299 41.2862 36.7659 36.7936 36.651 36.6786C34.1568 36.6786 28.1527 36.6786 28.1527 36.6786L15.1311 49.2531C15.8879 50.2594 21.287 57.4251 22.6639 58.8156C22.6659 58.8 22.6704 58.7838 22.6729 58.7682C22.8781 59.0057 27.2699 64.3438 27.7408 64.8147C28.0685 65.2281 29.5815 67.1364 31.448 69.4364C34.0187 72.5718 37.2519 76.4317 38.9575 78.1368C38.9605 78.1342 38.9641 78.1317 38.9671 78.1292C39.1526 78.3253 44.5886 84.3244 45.253 84.9894C48.3864 88.2282 60.0645 102.199 60.0645 102.199L60.1083 102.148C60.7995 102.839 76.2906 118.364 76.3606 118.448C100.487 111.717 118.494 90.325 120.182 64.4789Z"
                  fill="url(#paint0_linear_3_235)"/>
            <path opacity="0.2"
                  d="M28.1527 36.6781C28.1527 36.6781 34.1568 36.6781 36.6509 36.6781C36.8248 36.5591 36.9983 36.4447 37.1707 36.3363C35.1379 36.3363 28.1527 36.3363 28.1527 36.3363L15.0398 49.131C15.0398 49.131 15.0736 49.1759 15.131 49.2526L28.1527 36.6781Z"
                  fill="#BF360C"/>
            <path d="M15.131 49.253C15.8878 50.2594 21.2869 57.4251 22.6638 58.8156C23.8486 50.8195 30.7471 40.7069 36.6514 36.6781C34.1573 36.6781 28.1532 36.6781 28.1532 36.6781L15.131 49.253Z"
                  fill="#FFEB3B"/>
            <path opacity="0.2"
                  d="M84.1767 36.729C84.1767 36.729 84.2977 37.1208 84.3184 37.7485C84.3406 36.9211 84.1767 36.3877 84.1767 36.3877H74.3747C74.3747 36.3877 74.6217 36.5102 75.015 36.729H84.1767Z"
                  fill="#BF360C"/>
            <path d="M75.015 36.729C76.4877 37.5468 80.1389 39.7868 81.7376 42.7044C83.8284 40.8955 84.2851 38.9887 84.3189 37.7485C84.2982 37.1208 84.1772 36.729 84.1772 36.729H75.015Z"
                  fill="#FFEB3B"/>
            <path opacity="0.2"
                  d="M57.4281 36.8813C58.6044 36.8813 76.6404 35.5745 79.0801 49.7476C87.183 49.7476 94.4728 49.6317 94.4728 49.6317L94.5887 38.8859L105.183 49.4799L105.277 49.367L94.5887 38.5677L94.4728 49.426C94.4728 49.426 87.183 49.5434 79.0801 49.5434C76.6404 35.2226 58.6049 36.543 57.4281 36.543C38.356 36.9554 38.051 45.0796 38.0893 46.3722C38.1261 44.5608 39.2837 37.27 57.4281 36.8813Z"
                  fill="#BF360C"/>
            <path d="M94.4728 49.6317C94.4728 49.6317 87.183 49.7476 79.0801 49.7476C76.6404 35.5745 58.6048 36.8813 57.4281 36.8813C39.2837 37.27 38.1261 44.5608 38.0893 46.3712C38.0918 46.4574 38.0958 46.5134 38.0964 46.5346C38.3615 54.7661 56.4979 54.1208 57.5879 54.1208C89.4195 51.8903 92.0916 65.2427 92.0916 65.2427L105.183 49.4794L94.5892 38.8854L94.4728 49.6317Z"
                  fill="#FFEB3B"/>
            <path d="M38.9564 78.1373C48.8457 69.9904 58.5171 79.0523 58.2993 80.3299C70.5717 80.9248 81.6694 80.7509 82.0834 74.0626C82.1101 71.2327 78.8587 70.0877 73.1364 69.4363C63.6072 68.3625 47.2303 68.6398 27.7402 64.8152C28.0679 65.2286 29.5809 67.1368 31.4474 69.4368C34.0176 72.5718 37.2513 76.4322 38.9564 78.1373Z"
                  fill="#FFEB3B"/>
            <path d="M74.12 85.6443C72.5455 86.1505 61.2854 89.415 45.2524 84.9894C48.3858 88.2282 60.0639 102.199 60.0639 102.199L74.12 85.6443Z"
                  fill="#FFEB3B"/>
            <defs>
                <linearGradient id="paint0_linear_3_235"
                                x1="35.5838"
                                y1="28.7999"
                                x2="106.257"
                                y2="99.4731"
                                gradientUnits="userSpaceOnUse">
                    <stop stop-color="#212121" stop-opacity="0.2"/>
                    <stop offset="1" stop-color="#212121" stop-opacity="0"/>
                </linearGradient>
            </defs>
        </svg>
        <h1>Super Hero Storage</h1>
    </div>
    <menu>
        <li class="button_active menu-button" data-action="add">Добавить</li>
        <li class="menu-button" data-action="search">Найти</li>
        <a class="menu-button" href="/pages/show_all.php">Показать всех</a>
        <a class="menu-button" href="/pages/update.php">Обновить</a>
        <a class="menu-button" href="pages/delete.php" data-action="delete">Удалить</a>
    </menu>
</header>
<main>
    <form action="app.php" method="post">
        <label for="nickname">Псевдоним:</label>
        <input id="nickname" name="nickname" type="text" placeholder="Бэтмен">
        <label for="real_name">Настоящее имя:</label>
        <input id="real_name" name="real_name" type="text" placeholder="Брюс Бенер">
        <label for="super_force">Супер-сила:</label>
        <input id="super_force" name="super_force" type="text" placeholder="Деньги">
        <input id="action" type="hidden" name="action" value="add">
        <input type="submit" class="button" value="Добавить">
    </form>
</main>
<script src="js/script.js"></script>
</body>
</html>
