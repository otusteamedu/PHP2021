## Unit-tests

### MakePaymentValidator: unit/Repetitor202/validators/MakePaymentValidatorTestCase
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


### OrderPepository: unit/Repetitor202/repositories/OrderPepositoryTestCase


### MoneyServiceAFacade: unit/Repetitor202/facades/MoneyServiceAFacadeTestCase


### ?? PaymentController: unit/Repetitor202/controllers/PaymentControllerTestCase



## Integration-tests

### front-back: Front(иммитатор запроса)-Back-~~MoneyServiceA~~(mock)-~~Repository~~(mock)
чтобы это реализовать, можно использовать api-tests.

фронт как бы реальный не участвует в тэстах. чисто иммитация отправка запроса с фронта ($this->postJson('make-payment', self::VALID_PARAMS))
может быть все-таки это считается юнит-тестом?

важно архитектуру бэка организовать как DI-container. как еще можно делать, чтоб потом удобно было заглушки расставлять?)
по идее я это сделал, но вот замокать так и не получилось.
правда, для интереса попробовал в Laravel это сделать, и прокатило:
```
PaymentController
    public function __construct(OrderRepository $repository, MoneyServiceAFacade $moneyServiceAFacade)
    {
        $this->repository = $repository;
        $this->moneyServiceAFacade = $moneyServiceAFacade;
    }

PaymentControllerTest
    public function testSuccessMockRepository(): void
    {
        $this->mock(IOrderRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('setOrderIsPaid')
                ->once()
                ->andReturn(true);
        });

        $response = $this->postJson('make-payment', self::VALID_PARAMS);

        $this->assertEquals(200, $response->getStatusCode());
    }
```

### back-repository: Front(иммитатор запроса)-Back-~~MoneyServiceA~~(mock)-Repository

### back-moneyService: Front(иммитатор запроса)-Back-MoneyServiceA-~~Repository~~(mock)

### moneyService-repository: Front(иммитатор запроса)-~~Back~~-MoneyServiceA-Repository (!!! UNREAL)



## System-tests

### selenium: Front-Back-MoneyServiceA-Repository
тут по идее надо так. взять Selenium, написать тесты которые будут иммитировать заполнение полей и сабмитить.
заглушки поставить в этом случае не получиться.

!!?? если же мы реально вручную позаполняем форму на фронте, то это уже то ли ручное тестировоние, 
то ли приемочное ???

### codeception: Front(иммитатор запроса)-Back-MoneyServiceA-Repository
Я понимаю это так. Надо через codeception написать api-tests, заглушки нигде не ставить.
Получается, конкретно в нашем случае: если мы как-то через codeception попытаемся написать системные тесты, 
не нужно ставить заглушки,
иначе сразу тест приравняется к интеграционному !! ????