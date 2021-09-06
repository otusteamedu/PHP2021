<?php

declare(strict_types=1);

namespace MySite\app\Controllers;

use MySite\app\Responses\DefaultResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * Class IndexController
 * @package MySite\app\Controllers
 */
class IndexController extends BaseController
{
    /**
     * @return ResponseInterface
     */
    public function index(): ResponseInterface
    {
        return (new DefaultResponse())->getResponse('Hello World');
    }
}
