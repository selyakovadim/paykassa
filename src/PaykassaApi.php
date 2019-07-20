<?php

namespace Paykassa;

/**
 * Class PaykassaApi
 * @package Paykassa
 *
 * @version 0.5
 * @see https://paykassa.pro/docs/#api-API
 */
class PaykassaApi extends PaykassaBase
{
    const V = '0.5';

    const PAYKASSA_ID = 'PAYKASSA_API_ID';
    const PAYKASSA_KEY = 'PAYKASSA_API_KEY';

    public function __construct($id = null, $key = null)
    {
        if (function_exists('env')) {
            $this->api_id = env(self::PAYKASSA_ID, $id);
            $this->api_key = env(self::PAYKASSA_KEY, $key);
        }

        $url = 'https://paykassa.pro/api/' . self::V . '/';
        parent::__construct($id, $key, $url);
    }

    /**
     * Get Balance of merchant
     * @see https://paykassa.pro/docs/#api-API-api_get_shop_balance
     */
    public function getBalance(int $shop): array
    {
        return $this->request('api_get_shop_balance', [
            'shop' => $shop,
        ]);
    }

    /**
     * Instant payment
     * @see https://paykassa.pro/docs/#api-API-api_payment
     */
    public function makePayment(array $params): array
    {
        return $this->request('api_payment', $params);
    }
}