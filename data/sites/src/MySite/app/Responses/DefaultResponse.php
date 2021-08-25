<?php


namespace MySite\app\Responses;


use Psr\Http\Message\ResponseInterface;

class DefaultResponse extends BaseResponse
{

    /**
     * @inheritDoc
     */
    public function getResponse(?string $message = null): ResponseInterface
    {
        if ($message) {
            $this->setMessage($message);
        }

        $this->response->getBody()->write(
            json_encode(
                [
                    'message' => $this->message,
                    'code' => $this->code
                ]
            )
        );

        return $this->response->withStatus($this->code);
    }
}
