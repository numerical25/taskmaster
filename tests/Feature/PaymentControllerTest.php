<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_payment(): void
    {
        $response = $this->post('/api/payment/stripejs/payment-intent',
        [
            'amount' => 22.59,
            'description' => 'Payment from store',
            'payment_method' => 'card'
        ]);
        $response->assertStatus(200);
    }

    public function test_capture_payment_fail(): void
    {
        $response = $this->post('/api/payment/stripejs/capture',
            [
                'client_secret' => 'pi_34352534',
            ]);
        $response->assertStatus(200);
    }
}
