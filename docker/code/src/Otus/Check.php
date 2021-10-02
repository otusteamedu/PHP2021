<?php

namespace Otus;

use Otus\PageInterface;

class Check implements PageInterface
{
	private $str;
	private $strlen;
	private $msg;

	public function __construct($str) {
		$this->str = $str;
		$this->msg = $this->exam();
		$this->strlen = strlen($this->str);
	}

	public function template(): string {
		return 'check';
	}

	public function params(): array {
		$params = ['str'=>$this->str, 'msg'=>$this->msg, 'strlen'=>$this->strlen];
		return $params;
	}

	private function exam(): string {
		// Сравнение количества открытых и закрытых скобок
		$str_cor = substr_count($this->str, '(') != substr_count($this->str, ')') ? false : true;
		// Если количество одинаковое, проверяем корректность
		if($str_cor){
			$bkt = 0;
			foreach(str_split($this->str) as $symb){
				switch ($symb) {
					case '(':
						$bkt++;
						break;
					case ')':
						$bkt--;
						break;
				}
				if($bkt < 0) break;
			}
			if($bkt != 0) $str_cor = false;
		}
		$str_msg = $str_cor ? 'Все открытые скобки закрыты' : 'Ошибка! В строке присутствуют незакрытые скобки';

		return $str_msg;
	}
}