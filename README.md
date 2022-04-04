### старый код в папке old, новый в new

После рефакторинга кода согласно принципам solid 
проверка правильности ввода данных выведена в отдельный 
класс Check из Application. 

В новый класс Check перенесены переменные:

private $openBracket = '('; -> static $openBracket = '(';

private $closeBracket = ')'; -> static $closeBracket = ')';

Так же функция проверки пары checkBracketPairs() перенесена 
в класс Check;


