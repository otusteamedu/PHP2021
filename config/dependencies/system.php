<?php

return [
  'UserManager' => function (\Psr\Container\ContainerInterface $container) {
//    return new \App\Classes\Services\UserManager($container->get('Mailer'));
    return new \App\Classes\Services\UserManager($container->get('Mailer'));
  },
    'Mailer' => DI\factory(function () {
        return new \App\Classes\Libs\Mailer();
    }),
    'ProductService' => DI\factory(function () {
        return new \App\Classes\Services\ProductService();
    }),
];