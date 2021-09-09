<?php

declare(strict_types=1);

namespace MySite\app\Controllers;

use MySite\app\Responses\DefaultResponse;
use MySite\domain\Support\Facades\Queue;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class IndexController
 * @package MySite\app\Controllers
 */
final class IndexController extends BaseController
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $result = false;

        $postData = $this->parseJsonRequest($request);

        if (isset($postData->id)) {
            $result = Queue::pushRaw(
                json_encode(['id' => $postData->id])
            );
        }
        return (new DefaultResponse())
            ->getResponse(
                json_encode(
                    [
                        'success' => $result
                    ]
                )
            );
    }


}
