<?php

namespace App\Http\Controllers;

use App\Jobs\BankStatementInterface;
use App\Jobs\BankStatementJob;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;

class BankStatementController extends Controller
{
    private BankStatementInterface $job;

    public function __construct(BankStatementInterface $job)
    {
        $this->job = $job;
    }

    public function request(Request $request)
    {

        $email = $request->query->get('email');
       // $job = new BankStatementJob;
        $this->job->setEmail($email);

        try {
            app(Dispatcher::class)->dispatch($this->job);
        } catch (\Exception $e) {
            return 'Ошибка ' . $e->getMessage();
        }

        return 'Запрос отправлен';

    }

}
