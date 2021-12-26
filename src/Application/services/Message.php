<?php

namespace App\Application\Services;

use App\Application\DTO\MessageDTO;
use App\Domain\Models\Image;
use App\Domain\Models\Message as MessageModel;
use Symfony\Component\HttpFoundation\Request;


class Message extends BaseService
{
    private $messageMapper;
    
    public function __construct(AuthInterface $authService, 
                                ViewMapperInterface $view, 
                                SendEmail $sendEmail, 
                                MessageMapperInterface $messageMapper)
    {
        $this->messageMapper = $messageMapper;
        parent::__construct($authService, $view, $sendEmail);
    }

    public function index(Request $request)
    {
        $imageModel = new Image();
        if (empty($request->query->all())) {
            $allMessages = $this->messageMapper->getAll();
            return $this->view->render('front/message', ['allMessages' => $allMessages, 'allIdWithImages' => $this->messageMapper->getAllIdWithImages()]);
        }
        if ($this->authService->quest()) {
            throw new \Exception('Permission denied');
        }
        //Добавляем данные в базу данных
        $userId = $this->authService->user()['id'];
        $message = new MessageDTO($userId, boolval($_FILES['userfile']['tmp_name']), $request->get('text'));
        $this->messageMapper->add($message); //Передавать user_ID, картинку, текст
        if (!empty($_FILES['userfile']['tmp_name'])) {
            $imageModel->add($_FILES['userfile']['tmp_name']);
        }
        $this->redirect('/message/index');
    }
}