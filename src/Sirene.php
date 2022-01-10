<?php

namespace Axeldotdev\Insee;

use GuzzleHttp\Client;
use stdClass;

class Sirene
{
    public Client $client;
    public string $token;
    public string $type;

    public function __construct(Client $client, string $token)
    {
        $this->client = $client;
        $this->token = $token;
    }

    public function companies(): self
    {
        $this->type = 'siren';

        return $this;
    }

    public function establishments(): self
    {
        $this->type = 'siret';

        return $this;
    }

    public function all(): stdClass
    {
        return $this->request();
    }

    public function get(string $query): stdClass
    {
        return $this->request($query);
    }

    public function find(string $code): stdClass
    {
        return $this->request($code);
    }

    public function request(?string $code = null): stdClass
    {
        $code = $code ? '/' . str_replace(' ', '', $code) : '';

        $result = $this->client->get('https://api.insee.fr/entreprises/sirene/V3/' . $this->type . $code, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
            'http_errors' => false,
        ]);

        /** @var stdClass */
        return json_decode($result->getBody());
    }
}
