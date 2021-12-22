<?php

namespace App\Infrastructure\Controllers;

use App\DTO\MessageDTO;
use App\Models\Message;
use App\Models\Image;

class MessageAdminController extends BaseController
{
    public function index()
    {
        if (!in_array($this->auth->user()['id'], ADMIN_ID)) {
            throw new Exception('user is not admin');
        }
        $messageModel = new Message();
        $imageModel = new Image();
        if (empty($_POST)) {
            $allMessages = $messageModel->getAll();
            $messageModel->delete(key($_GET));
            return $this->view->render('front/messageAdmin', ['allMessages' => $allMessages, 'allIdWithImages' => $messageModel->getAllIdWithImages()]);
        }
        if ($this->auth->quest()) {
            throw new \Exception('Permission denied');
        }
        $userId = $this->auth->user()['id'];
        $message = new MessageDTO($userId, boolval($_FILES['userfile']['tmp_name']), $_POST['text']);
        $messageModel->add($userId, boolval($_FILES['userfile']['tmp_name']), $_POST['text']);
        if (!empty($_FILES['userfile']['tmp_name'])) {
            $imageModel->add($_FILES['userfile']['tmp_name']);
        }
        $this->redirect('/message/indexAdmin');
    }


}
