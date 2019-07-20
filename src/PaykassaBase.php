<?php

namespace Paykassa;

use GuzzleHttp\Client;

abstract class PaykassaBase
{
    protected $id;
    protected $key;

    private $client;

    public function __construct(int $id, string $key, string $url)
    {
        $this->id = $id;
        $this->key = $key;

        $this->client = new Client([
            'base_uri' => $url,
        ]);
    }

    protected function request(string $endpoint, array $params = []): array
    {
        $response = $this->client->request('POST', 'index.php', [
            'form_params' => array_merge($params, [
                'func' => $endpoint,
                'sci_id' => $this->id,
                'sci_key' => $this->key,
            ]),
        ]);

        return json_decode($response->getBody(), true);
    }
}