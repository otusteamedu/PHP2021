<?php

declare(strict_types=1);

namespace MySite\app\Responses;


use Psr\Http\Message\ResponseInterface;

/**
 * Class CreateResponse
 * @package MySite\app\Responses
 */
class CreateResponse extends BaseResponse
{

    /**
     * @inheritDoc
     */
    public function getResponse(?string $message = null): ResponseInterface
    {
        $this->setCode(201);

        $this->response->getBody()->write(
            json_encode(
                [
                    'message' => 'created',
                    'code' => $this->code
                ]
            )
        );

        return $this->response->withStatus($this->code);
    }
}
