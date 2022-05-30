<?php

namespace App\Http\Controllers\Youtubechannel;

use App\Http\Controllers\Controller;
use App\Models\Youtubechannel;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function  __invoke(Youtubechannel $youtubechannel){
     return view('youtubechannels.show', ['youtubechannel' => $youtubechannel]);
    }
}