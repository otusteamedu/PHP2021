<html>
	<head>
		<style>
			.wrapper {
				position: absolute;
				top: 40%;
				left: 40%;
				margin: -125px 0 0 -125px;
			}
			input, textarea {
				margin-top: 20px;
			}
		</style>
	</head>
	<body>
		<div class="wrapper">
			<h1>Запрос банковской выписки</h1>
			<form action="app.php" method="post" target="send">
				<div id="content">
					<div id="content_left" class="content">
						<label for="client_id">
							Идентификатор клиента банка
						</label><br>
						<input type="text" name="client_id"><br>
						<label for="client_email">
							Почта для получения выписки
						</label><br>
						<input type="text" name="client_email"><br>
						<label for="period">
							Получение выписки за период
						</label><br>
						<div name="period">
							С : <input type="date" name="date_from"> По: <input type="date" name="date_to"><br>
						</div>
						<input type="hidden" name="request_type" value="request">
						<input type="submit" value="Запросить">
					</div>
				</div>
			</form>
		</div>


	</body>
</html>
