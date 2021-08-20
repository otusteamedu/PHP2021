<?php

declare(strict_types=1);

namespace MySite\app\Controllers;

use MySite\app\Services\YoutubeChannel\YoutubeChannelService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class IndexController
 * @package MySite\app\Controllers
 */
class IndexController extends BaseController
{

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $response = 'No data';
        $topChannels = (new YoutubeChannelService())->getTopChannels(1);
        if (count($topChannels->getItems()) == 1) {
            $response = current($topChannels->getItems());
        }
        return $this->prepareResponse($response);
    }


}
