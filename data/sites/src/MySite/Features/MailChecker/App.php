<?php

declare(strict_types=1);

namespace MySite\Features\MailChecker;

use MySite\Features\MailChecker\Dto\EmailValidate;
use MySite\Features\MailChecker\Services\EmailService;
use MySite\Http\HttpCodes;
use MySite\Http\Request;
use MySite\Http\Response;

/**
 * Class App
 * @package MySite\Features\MailChecker
 */
class App implements HttpCodes
{

    /**
     * @param Request $request
     * @return Response
     */
    public function run(Request $request): Response
    {
        $post = $request->getParsedBody();

        $response = new Response();
        $response->withStatus(self::BAD_REQUEST, 'BAD REQUEST');

        if (isset($post['email'])) {
            $emailValidateDto = EmailValidate::createFromString($post['email']);

            EmailService::validate($emailValidateDto);

            if ($emailValidateDto->isValid()) {
                $response->withStatus(self::OK, 'OK');
            }
        }

        return $response;
    }
}
