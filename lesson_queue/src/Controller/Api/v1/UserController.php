<?php
declare(strict_types=1);

namespace App\Controller\Api\v1;

use App\Service\SubscriptionService;
use App\Service\TweetService;
use App\Service\UserService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\View\View;

/**
 * @author Mikhail Kamorin aka raptor_MVK
 *
 * @copyright 2020, raptor_MVK
 *
 * @Annotations\Route("/api/v1/user")
 */
final class UserController extends AbstractFOSRestController
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Annotations\Post("")
     *
     * @RequestParam(name="login")
     */
    public function addUserAction(string $login): View
    {
        $userId = $this->userService->saveUser($login);
        [$data, $code] = $userId === null ?
            [['success' => false, 400]] :
            [['success' => true, 'userId' => $userId], 200];

        return View::create($data, $code);
    }
}