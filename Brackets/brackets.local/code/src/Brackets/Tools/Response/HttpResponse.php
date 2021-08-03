<?php


declare(strict_types=1);


namespace Brackets\Tools\Response;


final class HttpResponse
{

    private int $code;
    private string $text;
    private string $content;

    public function __construct(int $code, string $text, string $content = "")
    {
        $this->code = $code;
        $this->text = $text;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

}