<?php

declare(strict_types=1);

namespace MySite\app\Services\YouTubeParser\Services\Grabbers;


use GuzzleHttp\Exception\GuzzleException;
use MySite\app\Support\Definitions\GrabberDefinition;
use MySite\app\Support\Facades\Http;

/**
 * Class BaseGrabber
 * @package MySite\app\Services\YouTubeParser\Services\Grabbers
 */
abstract class BaseGrabber
{
    use GrabberDefinition;

    /**
     * @var string|null
     */
    protected ?string $url = null;

    /**
     * @var string|null
     */
    protected ?string $nextPageToken = null;


    public function handle(): bool
    {
        $result = true;
        if ($this->nextPageToken) {
            $result = static::handle();
        }
        return $result;
    }

    /**
     * @return mixed
     * @throws GuzzleException
     */
    protected function requestHandle(): mixed
    {
        $answer = null;

        if ($this->url) {
            $request = Http::get($this->url);
            if ($request->successful()) {
                $answer = $request->json();
            }
        }

        return $answer;
    }
}
