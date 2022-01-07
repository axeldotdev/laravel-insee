<?php

namespace Axeldotdev\Insee;

use GuzzleHttp\Client;
use stdClass;

class Insee
{
    public Client $client;
    public string $type;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function token(): string
    {
        $result = $this->client->post('https://api.insee.fr/token', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Basic '
                    . base64_encode(config('insee.consumer_key')
                    . ':' . config('insee.consumer_secret')),
            ],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
        ]);

        /** @var stdClass */
        $result = json_decode($result->getBody());

        return $result->access_token;
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
                'Authorization' => 'Bearer ' . $this->token(),
            ],
            'http_errors' => false,
        ]);

        /** @var stdClass */
        return json_decode($result->getBody());
    }
}
