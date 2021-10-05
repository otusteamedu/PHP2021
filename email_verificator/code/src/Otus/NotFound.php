<?php

namespace Otus;

use Otus\PageInterface;

class NotFound implements PageInterface
{
	public function showPage(): void {
		header("HTTP/1.0 404 Not Found");
		echo '<p>The page is not found</p>';
	}
}