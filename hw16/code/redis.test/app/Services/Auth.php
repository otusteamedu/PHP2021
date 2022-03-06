<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\JsonResponse;

interface Auth
{

    /**
     * @param string|null $login
     * @param string|null $password
     * @return JsonResponse
     */
    public function auth(?string $login, ?string $password): JsonResponse;

}
