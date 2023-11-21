<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function stripeJsCapture(PaymentRequest $request) {
        $info = $request;
        $amount = $request->get('amount');
        $description = $request->get('description');
    }
}
