<?php


namespace MySite\app\Responses;


use MySite\app\Features\FastFood\Contracts\FastFoodFactoryContract;
use Psr\Http\Message\ResponseInterface;

class ProductResponse extends BaseResponse
{

    /**
     * @inheritDoc
     */
    public function getResponse(FastFoodFactoryContract $product): ResponseInterface
    {
        $this->response->getBody()->write(
            json_encode(
                [
                    'status' => $product->getStatus(),
                    'name' => $product->getName(),
                    'toppings' => $product->getToppings()->getItems()
                ]
            )
        );

        return $this->response->withStatus($this->code);
    }
}
