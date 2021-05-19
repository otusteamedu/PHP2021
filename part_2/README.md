# ДЗ

## Часть 2

### Команды для установки пакета

####composer install
```
composer require rom4ik_otus/composer
```
####git clone
```
git clone https://github.com/Rom4ik4/first-package.git
```

### Подключение

```php
require __DIR__ . '/vendor/autoload.php';

use App\HelloWorld;

(new HelloWorld())->print();
```