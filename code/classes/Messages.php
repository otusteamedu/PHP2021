<?

class Messages{

    private $message;

    function __construct() {
        $this->message = $_POST['message'];
        self::validater($this->message);
    }

    static function validEmptyMessage(String $msg) : bool{
        if(strlen($msg) == 0){
            return false;
        }else{
            return true;
        }
    }

    static function isBracketsBalanced (String $input) : bool {
        $costs = [
            '(' =>  10,
             ')' => -10
           ];
           $brackets = str_split ($input);
           $opened = [- $costs [end ($brackets)]];
           $balance = 0;
         
           while (($bracket = array_pop ($brackets)) !== NULL) {
         
             $cost = $costs [$bracket];
             $balance += $cost;
         
             if ($cost < 0)
             
               $opened [] = - $cost;
               
             else if ($cost == end ($opened))
             
               array_pop ($opened);
         
             else
             
               return FALSE;
           }
         
           return $balance == 0;
        
      }

    static function validater(String $msg){
        try {
         
            $validEmptyMessage = self::validEmptyMessage($msg);
            $validCloseBrackets = self::isBracketsBalanced($msg);
            
            if(!$validEmptyMessage || !$validCloseBrackets){
                throw new Exception('Error');
            }            

        } catch (Exception $e) {
            header("HTTP/1.0 400 Bad Request"); 
        }
    }

}

$messages = new Messages();
