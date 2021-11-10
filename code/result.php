<?php 
	$res = $_GET['res'];
	$result = '';

	if(isset($res) && !empty($res)){

		if($res=='200'){
			header('HTTP/1.1 200 OK');
			$result = '<span class="text-ok">200 OK</span>';
		}else{
			header('HTTP/1.1 400 Bad Request');
			$result = '<span class="text-error">400 Bad Request</span>';
		}
	}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Result page</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="text">
		<div class="text-block">
			<span class="text-result">Результат HTTP статуса: <?php echo $result;?></span>
		</div>
		<div class="but">
			<a href="index.php" class="link-return">Вернуться к форме</a>
		</div>
	</div>
</body>

</html>