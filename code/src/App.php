<?php
#Строгая типизация
declare(strict_types=1);

namespace App;

use App\FormValide\FormValide;


class App
{	
	private $formId;
	private $strForm;

	public function __construct() {
		$this->formId = $_POST['form-id'];
		$this->$strForm = $_POST['str-form'];
	}
	
	public function run(): void
	{

		set_time_limit(0);
		ob_implicit_flush();

		

		/*
		*Проверяем поля формы на пустоту
		*/
		if(isset($this->formId) && !empty($this->formId)){
			if(isset($this->$strForm) && !empty($this->$strForm)){

				$formValide = new FormValide($this->$strForm); 
				$formValide->Index();
				exit;

			}else{
				header('HTTP/1.1 400 Bad Request');
				$textError = '<span class="text-error">Поле со строкой не заполнено!</span>';

			}
		}

		require_once(ROOT.'/views/index.php');
		
	}

}