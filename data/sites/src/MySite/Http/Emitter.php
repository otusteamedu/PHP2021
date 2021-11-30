<?php


namespace MySite\Http;

/**
 * Class Emitter
 * @package MySite\Http
 */
class Emitter
{

    /**
     * @param Response $response
     * @return bool
     */
    public function emit(Response $response): bool
    {
        $this->emitStatusLine($response);
        $this->emitBody($response);
        return true;
    }

    private function emitStatusLine(Response $response): void
    {
        $statusCode = $response->getStatusCode();

        header(
            sprintf(
                'HTTP/%s %d %s',
                $response->getProtocolVersion(),
                $statusCode,
                $response->getReasonPhrase()
            ),
            true,
            $statusCode
        );
    }

    /**
     * @param Response $response
     */
    private function emitBody(Response $response): void
    {
        echo $response->getBody();
    }
}
