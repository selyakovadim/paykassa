<?php

namespace Paykassa;

use GuzzleHttp\Client;

/**
 * Class PaykassaSci
 * @package Paykassa
 *
 * @version 0.4
 * @see https://paykassa.pro/docs/#api-SCI
 */
class PaykassaSci
{
    const V = '0.4';
    private $client;

    public function __construct(int $id = null, string $key = null)
    {
        $this->sci_id = $id;
        $this->sci_key = $key;

        if (function_exists('env')) {
            $this->sci_id = env('PAYKASSA_SCI_ID', $id);
            $this->sci_key = env('PAYKASSA_SCI_KEY', $key);
        }

        $this->client = new Client([
            'base_uri' => 'https://paykassa.pro/sci/' . self::V . '/',
        ]);
    }

    private function post(string $endpoint, array $params = []): array
    {
        $response = $this->client->request('POST', 'index.php', [
            'form_params' => array_merge($params, [
                'func' => $endpoint,
                'sci_id' => $this->sci_id,
                'sci_key' => $this->sci_key,
            ]),
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Get cryptocurrency address for deposit
     * @see https://paykassa.pro/docs/#api-SCI-sci_create_order_get_data
     */
    public function getAddress(array $params): array
    {
        return $this->post('sci_create_order_get_data', $params);
    }

    /**
     * Get a link to payment
     * @see https://paykassa.pro/docs/#api-SCI-sci_create_order
     */
    public function getInvoice(array $params): array
    {
        return $this->post('sci_create_order', $params);
    }

    /**
     * Check payment (for IPN)
     * @see https://paykassa.pro/docs/#api-SCI-sci_confirm_order
     */
    public function checkPayment(string $hash): array
    {
        return $this->post('sci_confirm_order', [
            'private_hash' => $hash,
        ]);
    }
}