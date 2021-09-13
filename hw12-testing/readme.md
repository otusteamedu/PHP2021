# Deployment
```
# cd hw12-testing

cp .env.example .env

# add record to /etc/hosts
sudo bash -c "echo \"192.168.42.2   application.local\" >> /etc/hosts"

docker-compose up -d

docker-compose exec app composer install


# run tests
for phpunit - phpunit
for codeception -  codecept run
```

# PhpUnit-tests (unit/integration/system)
## Unit-tests

### MakePaymentValidator: tests/PhpUnit/unit/Repetitor202/validators/MakePaymentValidatorTestCase
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
(подробнее: ~смотреть код~)


### OrderPepository: tests/PhpUnit/unit/Repetitor202/repositories/OrderPepositoryTestCase
// как я понял из задания, перед проведением платежа в базе уже дожна быть запись с соответствующим ордером
// (должен совпадать набор полей: order_number, sum)
по идее если все ок => true, else false (подробнее: ~смотреть код~)

### MoneyServiceAFacade
по идее через юнит тесты не гоняем, все-таки это ж чисто довольно простой фасад

### PaymentController
по идее контроллеры на юнит-тестах не гоняют особо



## Integration-tests

### back-FRONT: Front(иммитатор запроса)-Back-~~MoneyServiceA~~(mock)-~~Repository~~(mock)
tests/PhpUnit/integration/FrontBackTestCase - по итогу все закомментировано, т.к. проверяется через системные тесты

тут вот что хочется понять.
1) в задании в качетсве примера приведен модульный тест:
```
1. Модульные тесты:

a. Если card_holder содержит более одного пробела, то
тестируемый метод возвращает 400 с сообщением об ошибке;
```
но это ж по идее уже интеграционный тест ???
или же:
фронт как бы реальный не участвует в тэстах. чисто иммитация отправка запроса с фронта ($this->postJson('make-payment', self::VALID_PARAMS))
и тогда считается юнит-тестом ???

2) допустим я пишу такой тест:
[тест (версия 1)]
```
public function testSuccess()
    {
        $params = MakePaymentValidatorTestCase::VALID_PARAMS;

        $moneyStatusMessageDto = new StatusMessageDto();
        $moneyStatusMessageDto->setStatus(200);
        $this->mock(MoneyServiceAFacade::class, function (MockInterface $mock) use ($moneyStatusMessageDto) {
            $mock->shouldReceive('pay')
                ->andReturn($moneyStatusMessageDto);
        });

        $this->mock(IOrderRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('setOrderIsPaid')
                ->andReturn(true);
        });

        $response = $this->http->request('POST', 'make-payment', ['json' => $params]);

        $this->assertEquals(200, $response->getStatusCode());
    }
```
я замокал и сам установил, что вернут методы репозиторий и фасадДенежногоСервиса и смотрю на ответ.
в моем понимании я так тестирую интеграцию фронта и бэка ???

как только я допишу одну строчку ->once()
[тест (версия 2)]
```
public function testSuccess()
    {
        $params = MakePaymentValidatorTestCase::VALID_PARAMS;

        $moneyStatusMessageDto = new StatusMessageDto();
        $moneyStatusMessageDto->setStatus(200);
        $this->mock(MoneyServiceAFacade::class, function (MockInterface $mock) use ($moneyStatusMessageDto) {
            $mock->shouldReceive('pay')
                ->once() // --------------- вот эта строчка, она проверяет, что метод pay фасада сработал
                ->andReturn($moneyStatusMessageDto);
        });

        $this->mock(IOrderRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('setOrderIsPaid')
                ->andReturn(true);
        });

        $response = $this->http->request('POST', 'make-payment', ['json' => $params]);

        $this->assertEquals(200, $response->getStatusCode());
    }
```
=> мой тест аввтоматически станет системным ???


и если это так, то тест (версия 1) в интеграционный вносить не надо, 
достаточно с одной лишней строкой кода хранить его [тест (версия 2)] в системных тестах???

### back-MONEYsERVICE: Front(иммитатор запроса)-Back-MoneyServiceA-~~Repository~~(mock)
в принципе, чего лишний раз деньги ради теста переводить. эта связка вполне адекватно протестируется
за счет системных тестов.

### MONEYsERVICE-REPOSITORY: Front(иммитатор запроса)-~~Back~~-MoneyServiceA-Repository
!!! UNREAL


## System-tests

### без моков tests/PhpUnit/system/NoMockSystemTestCase
### с моками репозитория и денежного сервиса tests/PhpUnit/system/WithMockSystemTestCase



# Codeception-tests (integration/system)
tests/codecept/api/ApiCest

ввиду того, что мокать не получилось, набросал чисто парочку тестов;
считаю, что тут все тесты системные ???


# Selenium-tests (system)
по идее при помощи селениума можно провести более приближенные к реальности системные тесты
(в плане клика на кнопки, вывод всплывающих сообщений)
но если в случае PhpUnit или Codeception можно репозиторий и СервисОплаты замокать, 
то в случае с селениумом все придется делать в реале (если только не написать параллельный специальный для тестов api)
правильно рассуждаю ???
