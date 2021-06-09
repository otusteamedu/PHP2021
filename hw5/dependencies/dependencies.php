<?php

$containerBuilder = new DI\ContainerBuilder();

$dependencies = [
    App\Cache\CacheInterface::class => DI\autowire(App\Cache\Memcached::class)
        ->constructor(DI\get('cache')),
    App\Validator\EmailValidatorInterface::class => DI\autowire(App\Validator\EmailValidator::class),
    App\Http\Interfaces\HandlerInterface::class => DI\autowire(App\Http\Handler\Handler::class),
    App\Http\Server::class => DI\autowire(App\Http\Server::class),
    App\Http\Interfaces\EmitterInterface::class => DI\autowire(App\Http\Response\Emitter::class)
];

$containerBuilder->addDefinitions(
    \yaml_parse_file('/etc/config.yml'),
    $dependencies,
);

return $containerBuilder->build();
