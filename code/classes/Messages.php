<?

class Messages{

    private $message;

    function __construct() {
        $this->message = $_POST['message'];
        
        if(self::validEmptyMessage($this->message) && self::validCloseBrackets($this->message)){
            header("HTTP/1.0 200 Bad Request");
        }else{
            header("HTTP/1.0 400 Bad Request"); 
        }
    }

    static function validEmptyMessage($msg){
        if(strlen($msg) == 0){
            return false;
        }else{
            return true;
        }
    }

    static function validCloseBrackets($msg){
        $br1 = substr_count($msg,'(');
        $br2 = substr_count($msg , ')');

        if($br1 == $br2){
            return true;
        }else{
            return false;
        }
    }



}

$messages = new Messages();
