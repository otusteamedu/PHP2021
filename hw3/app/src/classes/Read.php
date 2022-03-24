<?php
declare(strict_types=1);

namespace APP;

class Read
{
	public function readMessage($socket) :string
	{
		$connect = socket_accept($socket);

		while (true) {
			$message = socket_read($connect, 1024);

			if (!empty($message)) {
				break;
			}
		}
		
		return $message;
	}
}