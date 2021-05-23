<?

namespace App\Controllers;

use \Core\View;
use \Core\Controller;
use Exception;

class Messages extends Controller
{

    private $message;

    public function indexAction()
    {
        
        $this->message = $_POST['message'];
        
        $result = self::validator($this->message);

        View::renderJson(['result' => $result]);
    }
    

    static function validEmptyMessage(String $msg) : bool{
        if(strlen($msg) == 0){
            return false;
        }else{
            return true;
        }
    }

    static function isBracketsBalanced2($input){
        $input = preg_replace("/[^() ]/u","", $input);
        $repl = str_replace([")"],["(r"], $input);
        $result = preg_replace('/([\[({])(?R)*\1r/', "", $repl);
    
        return mb_strlen($result) == 0;
    }

  

    static function validator(String $msg){
        try {
         
            $validEmptyMessage = self::validEmptyMessage($msg);
            $validCloseBrackets = self::isBracketsBalanced2($msg);
            
            if(!$validEmptyMessage){
                throw new Exception('Строка не должна быть пустой');
            }

            if(!$validCloseBrackets){
                throw new Exception('В строке не верный баланс скобок');
            }

            return [
                'code' => 200,
                'message' => 'Все хорошо'
            ];

        } catch (Exception $e) {
            return [
                'code' => 400,
                'message' => $e->getMessage()
            ];
        }
    }


}