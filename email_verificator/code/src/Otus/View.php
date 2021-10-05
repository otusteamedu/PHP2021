<?php

namespace Otus;

class View
{
	private $template;
	private $data;

	public function __construct($template, $data = null) {
		$this->template = __DIR__ . '/template/' . $template . '.php';
		$this->data = $data;
	}

	public function render(): void {
		try{
	        if($this->data){
		        extract($this->data);
	        }
	        ob_start(); 
	        include($this->template); 
	        echo ob_get_clean(); 
	    }
	    catch(Exception $e){
		    echo $e->getMessage();
		}
	}


}