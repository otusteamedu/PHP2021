<?php

namespace App\Infrastructure\Controllers;

use App\Application\ValueObject\Email;
use App\Domain\Models\User;
use App\Infrastructure\Controllers\BaseController;
use GUMP;

class FrontController extends BaseController
{

    private function gumpAction($post)
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

    /**
     * Главная страница
     */
    public function index()
    {
        $this->view->render('front/index');
    }

    /**
     * Регистрация
     */
    public function register()
    {
        $isValid = $this->gumpAction($_POST);
        $error = [];
        if ($isValid !== true) {
            $error = $isValid;
            foreach ($error as $key => $value) {
                $error[$key] = strip_tags($value);
            }
            $this->view->render('front/register', ['error' => $error, 'result' => 'Register failed']);
            return 0;
        }
        $userModel = new User();
        $user = $userModel->get($_POST['email']);
        if (!empty($user)) {
            return 0;
        }
        $userModel->add($_POST);
        $this->sendEmail->send(new Email($_POST['email']));
        $this->view->render('front/register', ['error' => $error, 'result' => 'Register success']);
    }

    /**
     * Вход
     */
    public function login()
    {
        if ($_POST['email'] && $_POST['password']) {
            $userModel = new User();
            $user = $userModel->get($_POST['email']);
            if (password_verify($_POST['password'], $user['password']) && $user) {

                $this->auth->login($user);
                if (in_array($this->auth->user()['id'], ADMIN_ID)) {
                    $this->redirect('message/indexAdmin');
                }
                $this->redirect('message/index');
                exit();
            }
        }
        $this->view->render('front/login', ['log' => 'Неверно введен email или пароль']);
    }
}