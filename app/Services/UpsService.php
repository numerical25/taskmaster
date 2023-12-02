<?php

namespace App\Services;
use GuzzleHttp\Client;
class UpsService
{
    protected $client;
    protected $accessKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->accessKey = config('ups.access_key');
    }

    public function getShippingRate($fromZip, $toZip, $weight)
    {
        $url = 'https://wwwcie.ups.com/ship/v1/rating/Shop';

        $response = $this->client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'AccessLicenseNumber' => $this->accessKey,
            ],
            'json' => [
                'RatingServiceSelectionRequest' => [
                    'Request' => [
                        'RequestAction' => 'Rate',
                        'RequestOption' => 'Shop',
                    ],
                    'Shipment' => [
                        'Shipper' => [
                            'PostalCode' => $fromZip,
                        ],
                        'ShipTo' => [
                            'PostalCode' => $toZip,
                        ],
                        'Package' => [
                            'PackagingType' => [
                                'Code' => '02', // Code for your packaging type
                            ],
                            'PackageWeight' => [
                                'Weight' => $weight,
                                'UnitOfMeasurement' => [
                                    'Code' => 'LBS',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
