<main>
    <form action="request.php" method="post">
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
