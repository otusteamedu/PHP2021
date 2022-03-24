<?php
declare(strict_types=1);

namespace APP;

class Close
{
	public function closeSocket($socketRead, $fileRead)
	{
		socket_close($socketRead);
		unlink($fileRead);
	}
}