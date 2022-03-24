<?php
declare(strict_types=1);

namespace APP;

class Open
{
	public function openSockets($fileRead)
	{
		$socketRead = socket_create(AF_UNIX, SOCK_STREAM, 0);
		if (file_exists($fileRead)) {
			unlink($fileRead);
		}
		socket_bind($socketRead, $fileRead);
		socket_listen($socketRead, 5);

		return $socketRead;
	}
}