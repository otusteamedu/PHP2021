<?php

namespace App\FormValide;

class FormValide{

	public $textValide;

	public function __construct($name) {
		$this->textValide = $name;

	}

	/*
	*Проверка строки на наличие экранирующих символов
	*/
	protected function testInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	/*
	*Верификация строки со скобками
	*/
	protected function valideString($string){

		$counter = 0;
		$openBracket = ['(',];
		$closedBracket = [')',];

		$length = strlen($string);

		for($i = 0; $i<$length; $i++){
			$char = $string[$i];

			if(in_array($char, $openBracket)){
				$counter ++;
			}elseif(in_array($char, $closedBracket)){
				$counter --;
			}

			if($counter<0){
				break;
			}
		}

		if($counter != 0) { return false;}
		
		return true;
	}

	public function Index(){

		$result = '';

		if($this->valideString($this->textValide)==true){
			header('HTTP/1.1 200 OK');
			$result = '<span class="text-ok">200 OK</span>';
		}else{
			header('HTTP/1.1 400 Bad Request');
			$result = '<span class="text-error">400 Bad Request</span>';
		}

		require_once(ROOT.'/views/result.php');

	}	
}


