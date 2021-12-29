<?php

declare(strict_types=1);

namespace MySite\app\Responses;


use Laminas\Diactoros\Response;
use MySite\app\Features\FastFood\Contracts\FastFoodFactoryContract;
use MySite\domain\Support\Constants\HttpConstants;
use Psr\Http\Message\ResponseInterface;

/**
 * Class BaseResponse
 * @package MySite\app\Responses
 */
abstract class BaseResponse
{

    /**
     * @var Response
     */
    protected Response $response;

    /**
     * @var int
     */
    protected int $code = HttpConstants::OK;

    /**
     * @var string|null
     */
    protected ?string $message = null;

    public function __construct()
    {
        $this->response = new Response();
    }

    /**
     * @param string|null $message
     * @return ResponseInterface
     */
    abstract public function getResponse(?string $message = null): ResponseInterface;

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return BaseResponse
     */
    public function setCode(int $code): BaseResponse
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return BaseResponse
     */
    public function setMessage(?string $message): BaseResponse
    {
        $this->message = $message;
        return $this;
    }
}
