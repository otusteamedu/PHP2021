<?php

namespace App\Http\Controllers;

use App\Services\Events\Event;
use App\Services\Events\EventService;
use Illuminate\Http\Request;


class EventController extends Controller
{

    public function __invoke(Request $request){

        return view('home', []);
    }




}
