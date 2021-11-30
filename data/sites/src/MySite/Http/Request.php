<?php


namespace MySite\Http;

/**
 * Class Request
 * @package MySite\Http
 */
class Request
{
    /**
     * @var array|null
     */
    private ?array $post = null;

    /**
     * @return array
     */
    public function getParsedBody(): array
    {
        return $this->post ?? $_POST;
    }

    /**
     * @param array $data
     */
    public function withParsedBody(array $data): void
    {
        $this->post = $data;
    }
}
