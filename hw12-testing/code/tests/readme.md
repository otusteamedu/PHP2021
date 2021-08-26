## Unit-tests

### unit/Repetitor202/validators/MakePaymentValidatorTestCase
p.s.
Идея следующая.
Контроллер получает валидный json-объект,
превращает в массив,
нужные параметры конвертирует (в нашем случае нуждается в конвертации только параметр sum),
затем параметры передаются на валидацию,
и уже потом дальше...
Получается, класс MakePaymentValidatorTestCase тестирует входящий array

#### 1. testSuccess
input: valid array
output: получаем объет класса ValidatorResultDto со значением свойства isValid = true
(ValidatorResultDto.isValid - true) 

#### 2. testNullParams
input: null
output: ValidatorResultDto.isValid - false, ValidatorResultDto.message - Input params are invalid

#### 3. testCardHolderIsAbsent
input: array without card_holder
output: ValidatorResultDto.isValid - false

#### ...