<?php

namespace Paykassa;

/**
 * Class PaykassaSci
 * @package Paykassa
 *
 * @version 0.4
 * @see https://paykassa.pro/docs/#api-SCI
 */
class PaykassaSci extends PaykassaBase
{
    const V = '0.4';

    const ENV_SCI_ID = 'PAYKASSA_SCI_ID';
    const ENV_SCI_KEY = 'PAYKASSA_SCI_KEY';

    public function __construct(int $id = null, string $key = null)
    {
        if (function_exists('env')) {
            $id = env(self::ENV_SCI_ID, $id);
            $key = env(self::ENV_SCI_KEY, $key);
        }

        $url = 'https://paykassa.pro/sci/' . self::V . '/';
        parent::__construct($id, $key, $url);
    }

    /**
     * Get cryptocurrency address for deposit
     * @see https://paykassa.pro/docs/#api-SCI-sci_create_order_get_data
     */
    public function getAddress(array $params): array
    {
        return $this->request('sci_create_order_get_data', $params);
    }

    /**
     * Get a link to payment
     * @see https://paykassa.pro/docs/#api-SCI-sci_create_order
     */
    public function getInvoice(array $params): array
    {
        return $this->request('sci_create_order', $params);
    }

    /**
     * Check payment (for IPN)
     * @see https://paykassa.pro/docs/#api-SCI-sci_confirm_order
     */
    public function checkPayment(string $hash): array
    {
        return $this->request('sci_confirm_order', [
            'private_hash' => $hash,
        ]);
    }
}