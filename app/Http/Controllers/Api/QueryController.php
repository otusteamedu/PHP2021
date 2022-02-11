<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class QueryController extends Controller
{
    private $broker;

    public function __construct(AMQPStreamConnection $broker)
    {
        $this->broker = $broker;
        dd($this->broker);
    }

    public function create(Request $request)
    {
        dd(3);
    }
}
