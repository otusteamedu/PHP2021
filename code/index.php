<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказ выписки</title>
</head>
<body>

<form action="App.php" method="post" enctype="multipart/form-data">
	ID Telegram <input type="text" name="id_telegram" /><br />
    Запрос банковской выписки:<br />
    Период с : <input type="date" name="date_with" /> по <input type="date" name="date_before" />
	<input type="submit" value="Запросить" />
</form>

</body>
</html>


