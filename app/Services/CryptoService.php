<?php

namespace App\Services;

use App\Models\CPTicker;
use App\Models\CPTickerQuote;
use Illuminate\Support\Str;
use Mockery\Exception;

class CryptoService
{
    private $endpoint = 'https://api.coinpaprika.com/v1/';
    protected $client;

    protected $cpTicker;
    public function __construct() {}
    public function getCryptoTickers() {
        try {
            // TODO: This needs a timer internally to check for updated tickets or pull existing
            if($tickers = $this->getTickers()) {
                return $tickers;
            }
            $client = new \GuzzleHttp\Client();
            $request = $client->get($this->endpoint.'tickers');
            $response = json_decode($request->getBody()->getContents(), true);
            $tickerModel = new CPTicker();
            $data = $this->mapTickersToModel($response);
            $quoteArray = $this->extractQuotesFromTickers($data);
            $update = $tickerModel->upsert($data, 'cp_id');
            CPTickerQuote::upsert($quoteArray, ['type','cp_id']);
            return $update;
        }catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
        return '';
    }

    protected function extractQuotesFromTickers(&$tickers) {
        $quoteArray = [];
        for($i = 0; $i < count($tickers); $i++) {
            $quoteArray = array_merge($quoteArray, $tickers[$i]['quotes']);
            unset($tickers[$i]['quotes']);
        }
        return $quoteArray;
    }

    public function getTickers() {
        return CPTicker::with('Quote')->paginate(100);
    }

    public function mapTickersToModel($tickers)
    {
        return array_map(function($item) {
            $quotes = [];
            $tickerId = Str::uuid()->toString();
            foreach($item['quotes'] as $type => $quote) {
                array_push($quotes, [
                    'id' => Str::uuid()->toString(),
                   'ticker_id' => $tickerId,
                   'type' => $type ,
                    'cp_id' => $item['id'],
                    'price' => $quote['price'],
                    'volume_24h' => $quote['volume_24h'],
                    'volume_24h_change_24h' => $quote['volume_24h_change_24h']
                ]);
            }
            return [
                'id' => $tickerId,
                'cp_id'=> $item['id'],
                'name' => $item['name'],
                'symbol' => $item['symbol'],
                'quotes' => $quotes,
            ];
        }, $tickers);
    }
}
