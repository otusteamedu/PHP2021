<?php require_once('../vendor/autoload.php');

use App\Application;

$app = new Application();
$heroes = $app->showAll(); ?>
<!doctype html>
<?php require_once '../parts/head.php' ?>
<body>
<main>
    <div class="wrapper">
        <svg class="green_icon" viewBox="0 0 154 154" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M149.446 128.703L117.262 96.7675C123.502 87.0144 127.11 75.4518 127.11 63.0744C127.11 28.2968 98.6 0 63.552 0C28.504 0 0 28.2968 0 63.0744C0 97.8519 28.504 126.149 63.5585 126.149C75.4179 126.149 86.5272 122.908 96.0329 117.275L128.501 149.492C142.365 163.23 163.316 142.46 149.446 128.703ZM19.7032 63.0744C19.7032 39.083 39.3805 19.5576 63.5585 19.5576C87.7364 19.5576 107.414 39.0766 107.414 63.0744C107.414 87.0722 87.7364 106.591 63.5585 106.591C39.3805 106.591 19.7032 87.0657 19.7032 63.0744ZM32.7007 51.7556C45.5301 22.2461 88.7258 25.6661 96.8606 56.5616C80.4746 37.4789 51.6409 35.4256 32.7007 51.7556Z"/>
        </svg>
        <h1 class="success_title">Все супеп-герои в базе</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Псевдоним</th>
                <th>Настоящее имя</th>
                <th>Супер-сила</th>
            </tr>
            <?php foreach ($heroes as $hero) { ?>
                <tr>
                    <td><?php echo $hero->getId() ?></td>
                    <td><?php echo $hero->getNickname() ?></td>
                    <td><?php echo $hero->getRealName() ?></td>
                    <td><?php echo $hero->getForce() ?></td>
                </tr>
            <?php } ?>
        </table>
        <a href="/" class="button">Назад</a>
    </div>
</main>
</body>
</html>
