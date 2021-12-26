<?php

namespace App\Application\Services;

use App\Application\DTO\MessageDTO;
use App\Domain\Models\Image;
use App\Domain\Models\Message;
use Exception;
use Symfony\Component\HttpFoundation\Request;


class MessageAdmin extends BaseService
{
    public function index(Request $request)
    {
        if (!in_array($this->authService->user()['id'], Config::getApp('ADMIN_ID'))) {
            throw new Exception('user is not admin');
        }
        $messageModel = new Message();
        $imageModel = new Image();
        if (empty($request->query->all())) {
            $allMessages = $messageModel->getAll();
            $messageModel->delete(key($_GET));
            return $this->view->render('front/messageAdmin', ['allMessages' => $allMessages, 'allIdWithImages' => $messageModel->getAllIdWithImages()]);
        }
        if ($this->authService->quest()) {
            throw new \Exception('Permission denied');
        }
        $userId = $this->authService->user()['id'];
        $message = new MessageDTO($userId, boolval($_FILES['userfile']['tmp_name']), $request->get('text'));
        $messageModel->add($message);
        if (!empty($_FILES['userfile']['tmp_name'])) {
            $imageModel->add($_FILES['userfile']['tmp_name']);
        }
        return $this->redirect('/message/indexAdmin');
    }
}