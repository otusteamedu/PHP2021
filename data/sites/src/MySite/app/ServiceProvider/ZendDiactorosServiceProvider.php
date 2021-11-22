<?php
declare(strict_types = 1);

namespace MySite\app\ServiceProvider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\ServerRequestFactory;

class ZendDiactorosServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        Response::class,
        SapiEmitter::class,
        ServerRequest::class
    ];

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->getContainer()->add(Response::class);
        $this->getContainer()->share(SapiEmitter::class);
        $this->getContainer()->share(ServerRequest::class, function () {
            return ServerRequestFactory::fromGlobals(
                $_SERVER,
                $_GET,
                $_POST,
                $_COOKIE,
                $_FILES
            );
        });
    }
}
