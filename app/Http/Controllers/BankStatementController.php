<?php

namespace App\Http\Controllers;

use App\Jobs\BankStatementJob;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;

class BankStatementController extends Controller
{

    public function request(Request $request, BankStatementJob $job)
    {

        $email = $request->query->get('email');
       // $job = new BankStatementJob;
        $job->setEmail($email);

        try {
            app(Dispatcher::class)->dispatch($job);
        } catch (\Exception $e) {
            return 'Ошибка ' . $e->getMessage();
        }

        return 'Запрос отправлен';

    }

}
