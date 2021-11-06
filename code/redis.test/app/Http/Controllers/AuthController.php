<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Auth;
use App\Services\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class AuthController extends Controller
{

    public function __construct(private Auth $authService, private View $viewService)
    {
    }

    /**
     *
     * Get Auth token.
     *
     * @OA\Post(
     *     path="/api/login",
     *
     *     @OA\RequestBody(
     *        required=true,
     *        description="Pass user credentials",
     *        @OA\JsonContent(
     *           required={"email","password"},
     *           @OA\Property(property="email", type="string", format="email", example="raphaelle.fritsch@example.net"),
     *           @OA\Property(property="password", type="string", format="password", example="123456"),
     *        ),
     *     ),
     *
     *     @OA\Response(response="200", description="OK", @OA\JsonContent()),
     *     @OA\Response(response="default", description="Error", @OA\JsonContent())
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $email = $request->email;
        $password = $request->password;

        return $this->authService->auth($email, $password);
    }

}
