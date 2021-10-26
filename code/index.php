<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Homework 1</title>
</head>
<body>
	<div>
		<?php
			error_reporting(E_ALL & ~E_NOTICE);
			// Memcached
			$memcached = new Memcached; 
			$memcached->addServer('memcached', 11211);

			if ($memcached->getStats()) {
				echo 'Memcached works!<br>';
			}

			// Redis
			$redis = new Redis();

			$res = $redis->connect(
			  'dbRedis',
			  6379
			);

			try {
				if ($redis->auth('pass123')) {
					echo 'Redis connected!';
				}
			} catch(Exception $e) {
				echo 'Redis auth error: ' . $e->getMessage();
			}
		?>
	</div>
</body>
</html>