<?php

namespace Dmigrishin\Testproject;

class App
{
   
   public function run()
   {
      $method = strtolower($_SERVER['REQUEST_METHOD']);
      
      switch($method){
         case "post":
            $this->processParameters($_POST);
            break;

         case "get":
            http_response_code(404);   
            break;

         default:
            http_response_code(404);   
         break;

      }
   }

   private function processParameters($data){
      if(isset($data['string']) && $this->validateParameters($data['string']))
      {
         http_response_code(200);

         exit();
      }
      else {
         http_response_code(400);
         exit();
      }
   }
   
   private function validateParameters($param){
         
      if((substr($param,0,1))<>'('){
      
         //('Строка должна начинаться с открытия скобок');
         return false;
      };
      
      $leftparenthesis = substr_count($param,'(');
      $rightparenthesis = substr_count($param,')');
      $diff = $leftparenthesis - $rightparenthesis;
      
      if ($diff <> 0) {
         return false; 
      }
      return true;
   }
}