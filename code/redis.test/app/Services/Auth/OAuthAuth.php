<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Dto\ApiAnswerDTO;
use App\Services\Auth;
use App\Services\View;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class OAuthAuth implements Auth
{

    private const EMPTY_FIELDS_ERROR = 'Поля e-mail и пароль должны быть заполнены!';

    private const ERROR_4XX_DESCRIPTION = 'Неверные логин/пароль';

    private const ERROR_5XX_DESCRIPTION = 'Что-то пошло не так';

    private const ERROR_UNKNOWN = 'Неизвестная ошибка';

    public function __construct(private View $viewService, private Client $httpClient)
    {
    }

    /**
     * @inheritDoc
     */
    public function auth(?string $login, ?string $password): JsonResponse
    {
        if (empty($login) || empty($password)) {
            return $this->returnApiAnswer(
                false,
                self::EMPTY_FIELDS_ERROR,
                Response::HTTP_BAD_REQUEST
            );
        }

        try {
            $result = $this->httpClient->post(config('service.passport.login_endpoint'), [
                'form_params' => [
                    'client_secret' => config('service.passport.client_secret'),
                    'grant_type' => config('service.passport.grant_type'),
                    'client_id' => config('service.passport.client_id'),
                    'username' => $login,
                    'password' => $password,
                ],
            ]);

            return $this->returnApiAnswer(
                $result->getStatusCode() == Response::HTTP_OK,
                json_decode((string)$result->getBody(), true),
                $result->getStatusCode()
            );
        } catch (ClientException $e) {
            return $this->returnApiAnswer(
                false,
                self::ERROR_4XX_DESCRIPTION,
                $e->getCode()
            );
        } catch (ServerException $e) {
            return $this->returnApiAnswer(
                false,
                self::ERROR_5XX_DESCRIPTION,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        } catch (\Throwable $e) {
            return $this->returnApiAnswer(
                false,
                self::ERROR_UNKNOWN,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    private function returnApiAnswer(bool $success, mixed $data, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        $answer = new ApiAnswerDTO($success, $data, $statusCode);
        return $this->viewService->apiAnswer($answer);
    }

}
