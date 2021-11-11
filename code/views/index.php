<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="/templates/css/style.css">
</head>

<body>
	<div class="contain">
		<form action="#" id="ajax-form" class="form-gs contain__form-gs" method="post">
			<input type="hidden" name="form-id" value="form-contact">
			<div class="title-form">Введите строку</div>
			<div class="form-gs__item">
				<label for="str-form" class="label-form">Строка с (): </label><input type="text" class="input-form"
					name="str-form" value="">
			</div>
			<div class="form-gs__item">
				<button class="but-send">Отправить</button>
			</div>
		</form>
		<br>
		<div class="result-form"><?php echo $textError;?></div>
	</div>
</body>

</html>