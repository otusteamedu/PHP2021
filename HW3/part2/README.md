# custom package install 
```
composer require nkazarynava/composer-test
```
#git repo:
```
git clone https://github.com/nkazarynava/composer-test.git
```
# usage:
```
require __DIR__ . '/../vendor/autoload.php';
use ComposerTestNamespace\HelloWorld;
$testObj = new HelloWorld();
$testObj->tryLog("Log message");
```