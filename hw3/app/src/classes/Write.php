<?php
declare(strict_types=1);

namespace APP;

class Write
{
	public function writeMessage($fileSocket, $message)
	{
		$lenMessage = strlen($message);

		$socket = socket_create(AF_UNIX, SOCK_STREAM, 0);

		socket_connect($socket, $fileSocket);

		socket_send($socket, $message, $lenMessage, MSG_DONTROUTE);
		
		socket_close($socket);
	}
}