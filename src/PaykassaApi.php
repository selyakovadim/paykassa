<?php

namespace Paykassa;

use GuzzleHttp\Client;

/**
 * Class PaykassaApi
 * @package Paykassa
 *
 * @version 0.5
 * @see https://paykassa.pro/docs/#api-API
 */
class PaykassaApi
{
    const V = '0.5';
    private $client;

    public function __construct(int $id = null, string $key = null)
    {
        $this->api_id = $id;
        $this->api_key = $key;

        if (function_exists('env')) {
            $this->api_id = env('PAYKASSA_API_ID', $id);
            $this->api_key = env('PAYKASSA_API_KEY', $key);
        }

        $this->client = new Client([
            'base_uri' => 'https://paykassa.pro/api/' . self::V . '/',
        ]);
    }

    private function post(string $endpoint, array $params = []): array
    {
        $response = $this->client->request('POST', 'index.php', [
            'form_params' => array_merge($params, [
                'func' => $endpoint,
                'api_id' => $this->api_id,
                'api_key' => $this->api_key,
            ]),
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Get Balance of merchant
     * @see https://paykassa.pro/docs/#api-API-api_get_shop_balance
     */
    public function getBalance(int $shop): array
    {
        return $this->post('api_get_shop_balance', [
            'shop' => $shop,
        ]);
    }

    /**
     * Instant payment
     * @see https://paykassa.pro/docs/#api-API-api_payment
     */
    public function makePayment(array $params): array
    {
        return $this->post('api_payment', $params);
    }
}