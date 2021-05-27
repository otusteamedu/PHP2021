<?php


namespace MySite\Features\MailChecker;

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

        if (isset($post['email']) && $this->checkEmail($post['email'])) {
            $response->withStatus(self::OK, 'OK');
        }

        return $response;
    }

    /**
     * @param string $email
     * @return bool
     */
    private function checkEmail(string $email): bool
    {
        $result = false;
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $explodedEmail = explode('@', $email);
            if (is_array($explodedEmail)) {
                $host = $explodedEmail[1];
                $result = checkdnsrr($host, 'MX');
            }
        }
        return $result;
    }
}
