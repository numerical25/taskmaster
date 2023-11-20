<?php

namespace App\Http\Controllers;

use App\Services\CryptoService;
use Illuminate\Http\Request;
use Mockery\Exception;

class CryptoController extends Controller
{
    protected $cryptoService;
    public function __construct(CryptoService $cryptoService)
    {
        $this->cryptoService = $cryptoService;
    }

    //
    public function getCPTickers() {
        try {
            $response = $this->cryptoService->getTickers();
            return $response;
        } catch (Exception $e) {
            return response()->json(['message' => 'There was a issue retrieving the ticker data']);
        }
    }
}
