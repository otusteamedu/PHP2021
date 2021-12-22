<?php

namespace App\Infrastructure\Controllers;


use App\Domain\Models\Image;
use App\Domain\Models\Message;

class MessageController extends BaseController
{
    public function index()
    {
        $messageModel = new Message();
        $imageModel = new Image();
        if (empty($_POST)) {
            $allMessages = $messageModel->getAll();
            return $this->view->render('front/message', ['allMessages' => $allMessages, 'allIdWithImages' => $messageModel->getAllIdWithImages()]);
        }
        if ($this->auth->quest()) {
            throw new \Exception('Permission denied');
        }
        //Добавляем данные в базу данных
        $userId = $this->auth->user()['id'];
        $messageModel->add($userId, boolval($_FILES['userfile']['tmp_name']), $_POST['text']); //Передавать user_ID, картинку, текст
        if (!empty($_FILES['userfile']['tmp_name'])) {
            $imageModel->add($_FILES['userfile']['tmp_name']);
        }
        $this->redirect('/message/index');
    }
}