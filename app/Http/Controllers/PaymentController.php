<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Http\Requests\StripeJsPaymentCaptureRequest;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    protected $paymentService;
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function stripeJsCapture(StripeJsPaymentCaptureRequest $request) {
        try {
            return $this->paymentService->stripeJsCapture($request->id());
        } catch (\Exception $e) {
            return response()->json(['message' => 'There was a issue with the payment'], 300);
        }
        return response()->json(['message' => 'Payment Success!']);
    }

    public function stripeJsPaymentIntent(PaymentRequest $request) {
        try {
            return $this->paymentService->stripeJsPaymentIntent($request);
        } catch (\Exception $e) {
            return response()->json(['message' => 'There was a issue with the payment'], 300);
        }
        return response()->json(['message' => 'Payment Success!']);
    }
}
