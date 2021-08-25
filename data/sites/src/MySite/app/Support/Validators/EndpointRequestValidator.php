<?php

declare(strict_types=1);

namespace MySite\app\Support\Validators;


use JetBrains\PhpStorm\Pure;
use MySite\app\Support\Contracts\RequestValidator;
use MySite\app\Support\Dto\ValidatorResult;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class EndpointRequestValidator
 * @package MySite\app\Support\Validators
 */
class EndpointRequestValidator extends BaseValidator implements RequestValidator
{

    /**
     * @var ValidatorResult
     */
    private ValidatorResult $validatorResult;

    /**
     * EndpointRequestValidator constructor.
     */
    #[Pure] public function __construct()
    {
        $this->validatorResult = new ValidatorResult();
    }

    /**
     * @inheritDoc
     */
    public function validate(ServerRequestInterface $request): ValidatorResult
    {
        $object = $this->parseJsonRequest($request);

        if (!$object) {
            $this->validatorResult->setFail(true);
            return $this->validatorResult;
        }

        $this->setValidated($object);

        $this->checkFail();

        return $this->validatorResult;
    }

    /**
     * @param object $object
     */
    private function setValidated(object $object): void
    {
        $this->validatorResult->addValidated(
            'http_referer',
            $object->http_referer ?? null
        );

        $this->validatorResult->addValidated(
            'query_string',
            $object->query_string ?? null
        );

        $this->validatorResult->addValidated(
            'redirected_query_string',
            $object->redirected_query_string ?? null
        );

        $this->validatorResult->addValidated(
            'user_ip',
            $object->user_ip ?? null
        );

        $this->validatorResult->addValidated(
            'user_agent',
            $object->user_agent ?? null
        );
    }

    private function checkFail()
    {
        $validated = $this
            ->validatorResult
            ->validated();

        $fail = true;
        array_walk(
            $validated,
            static function ($elem) use (&$fail) {
                if ($fail) {
                    $fail = !boolval($elem);
                }
            }
        );

        if ($fail) {
            $this
                ->validatorResult
                ->setMessage('All fields are null');
        }

        $this->validatorResult->setFail($fail);
    }
}
