<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        // TODO: Make normal validation
        $request->validate([
            'card_holder' => 'required',
            'card_expiration' => 'required',
            'order_nubmer' => 'required',
        ]);
    }
}
