<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //


    public function payment(PaymentRequest $request) {
        $info = $request;
    }
}
