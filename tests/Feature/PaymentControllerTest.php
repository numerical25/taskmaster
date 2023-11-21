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
        $response = $this->post('/api/payment/stripejs/capture',
        [
            'amount' => 22.59,
            'description' => 'Payment from store'
        ]);
        $response->assertStatus(200);
    }
}
