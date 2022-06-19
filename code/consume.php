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
			<form action="/api/v1/consume" method="post" target="consume">
				<div id="content">
					<div id="content_left" class="content">
						<input type="hidden" name="request_type" value="consume">
						<input type="submit" value="Обработка сообщений">
					</div>
				</div>
			</form>
		</div>


	</body>
</html>
