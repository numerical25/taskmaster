<?php

namespace App\Services;

use Stripe\StripeClient;

class PaymentService
{
    private $secreteKey = "sk_test_51HmfvEJYfVQAz0AAbYhEKlQEnwsnipwyrVXFnvDDuKybUJDVr9jCq5ZUIoEFXsM6a5hdAgYb8uPGYR7myQwViMZE00byS5p2xf";
    private $stripe;
    public function __construct() {
        $this->stripe = new StripeClient($this->secreteKey);
    }

    public function oneTimePayment($request) {
        $this->stripe->paymentIntents->create([
            'amount' => $request->amount
        ]);
    }
}
