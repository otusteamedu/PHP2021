<?php

namespace Otus;

use Otus\PageInterface;

class Check implements PageInterface
{
	private $str;
	private $strlen;
	private $msg;

	public function __construct($email) {
		$this->email = $email;
		$this->msg = $this->exam();
		$this->strlen = strlen($this->str);
	}

	public function template(): string {
		return 'check';
	}

	public function params(): array {
		$params = ['email'=>$this->email, 'msg'=>$this->msg, 'strlen'=>$this->strlen];
		return $params;
	}

	private function exam(): string {
		$str_msg = 'Неправильный e-mail';
		if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
		    $parts_arr = explode('@', $this->email);
		    $domain = array_pop($parts_arr);
		    $check_mx = getmxrr($domain, $mxhosts);

		    $str_msg = $check_mx ? 'Корректный e-mail' : $str_msg;

			
		}
		return $str_msg;
	}
}