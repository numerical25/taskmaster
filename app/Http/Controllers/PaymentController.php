<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    protected $paymentService;
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function stripeJsCapture(PaymentRequest $request) {
        try {
            $this->paymentService->stripeJsPaymentIntent($request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'There was a issue with the payment'], 300);
        }
    }
}
