<?php

namespace App\Controllers;

use App\Models\Message;
use App\Models\Image;

class MessageAdminController extends BaseController
{
    public function index()
    {
        if (!in_array($this->auth->user()['id'], ADMIN_ID)) {
            return 0;
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
        $messageModel->add($userId, boolval($_FILES['userfile']['tmp_name']), $_POST['text']);
        if (!empty($_FILES['userfile']['tmp_name'])) {
            $imageModel->add($_FILES['userfile']['tmp_name']);
        }
        $this->redirect('/message/indexAdmin');
    }


}
