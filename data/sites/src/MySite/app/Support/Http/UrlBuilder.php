<?php


namespace MySite\app\Support\Http;


use JetBrains\PhpStorm\Pure;

class UrlBuilder
{
    /**
     * @var string
     */
    private string $params = '?';

    /**
     * UrlBuilder constructor.
     * @param string $url
     */
    public function __construct(
        private string $url
    ) {
        $lastElem = substr($this->url, -1);
        if ($lastElem == '/') {
            $this->url = substr($this->url, 0, -1);
        }
    }

    /**
     * @param string $element
     * @return $this
     */
    public function joinPart(string $element): static
    {
        $this->url .= '/' . $element;
        return $this;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function joinParam(string $key, mixed $value): static
    {
        if ($value) {
            $this->params .= '&' . $key . '=' . $value;
        }
        return $this;
    }

    /**
     * @return string
     */
    #[Pure] public function url(): string
    {
        $result = $this->url;
        if (strlen($this->params) > 1) {
            $result .= $this->params;
        }
        return $result;
    }
}
