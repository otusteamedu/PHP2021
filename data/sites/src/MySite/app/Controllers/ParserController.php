<?php

declare(strict_types=1);

namespace MySite\app\Controllers;


use GuzzleHttp\Exception\GuzzleException;
use MySite\app\Services\YoutubeChannel\YoutubeChannelService;
use MySite\app\Services\YouTubeParser\YouTubeParserService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class ParserController
 * @package MySite\app\Controllers
 */
class ParserController extends BaseController
{


    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function parseChannel(ServerRequestInterface $request): ResponseInterface
    {
        $youTubeChannelDTO = (new YouTubeParserService($request))->run();
        return $this->prepareResponse(
            json_encode(
                [
                    'result' => (new YoutubeChannelService())->saveChannel($youTubeChannelDTO)
                ]
            )
        );
    }
}
