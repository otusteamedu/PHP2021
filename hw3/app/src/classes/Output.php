<?php
declare(strict_types=1);

namespace APP;

class Output
{
	public function setOutput()
	{
		header('Content-Type: text/plain;');
		set_time_limit(0);
		ob_implicit_flush();
	}
}