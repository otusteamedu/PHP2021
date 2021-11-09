<?php

class FormValide{/*Start Class*/

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

		if($this->valideString($this->textValide)==true){
			$res = '200';
		}else{
			$res = '400';
		}

		header("Location: result.php?res=$res");

		return true;	
	}	
}/*End Class*/


/*
*Проверяем поля формы на пустоту
*/
if(isset($_POST['form-id']) && !empty($_POST['form-id'])){

	if(isset($_POST['str-form']) && !empty($_POST['str-form'])){

		$formValide = new FormValide($_POST['str-form']); 
		$formValide->Index();

		exit;
	}else{
		header('HTTP/1.1 400 Bad Request');
		$textError = '<span class="text-error">Поле со строкой не заполнено!</span>';
	}
}
