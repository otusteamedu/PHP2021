<?php

namespace App\Application\Services;

use App\Application\ValueObject\Email;
use App\Domain\Models\User;
use GUMP;
use Symfony\Component\HttpFoundation\Request;


class Auth extends BaseService
{
    /**
     * Главная страница
     */
    public function index()
    {
        return $this->view->render('front/index');
    }

    /**
     * Регистрация
     */
    public function register(Request $request)
    {
        $isValid = $this->validate($request->query->all());
        $error = [];
        if ($isValid !== true) {
            $error = $isValid;
            foreach ($error as $key => $value) {
                $error[$key] = strip_tags($value);
            }
            return $this->view->render('front/register', ['error' => $error, 'result' => 'Register failed']);
        }
        $userModel = new User();
        $user = $userModel->get($request->get('email'));
        if (!empty($user)) {
            return 0;
        }
        $userModel->add($request->query->all());
        $this->sendEmail->send(new Email($request->get('email')));
        return $this->view->render('front/register', ['error' => $error, 'result' => 'Register success']);
    }

    /**
     * Вход
     */
    public function login(Request $request)
    {
        if ($request->get('email') && $request->get('password')) {
            $userModel = new User();
            $user = $userModel->get($request->get('email'));
            if (password_verify($request->get('password'),
                $request->get('password')) && $user) {
                $this->authService->login($user);
                if (in_array($this->authService->user()['id'], Config::getApp('ADMIN_ID'))) {
                    return $this->redirect('message/indexAdmin');
                }
                return $this->redirect('message/index');
            }
        }
        return $this->view->render('front/login', ['log' => 'Неверно введен email или пароль']);
    }

    private function validate($post)
    {
        $data = [
            'username' => $post['name'],
            'password' => $post['password'],
            'email' => $post['email']
        ];

        $validated = GUMP::is_valid($data, array(
            'username' => 'required|alpha_numeric|max_len,100|min_len,6',
            'password' => 'required|max_len,100|min_len,6',
            'email' => 'required|valid_email'
        ));

        if ($validated === true) {
            return true;
        }
        return $validated;
    }
}