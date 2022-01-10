<?php

namespace Axeldotdev\Insee;

use GuzzleHttp\Client;

class Insee
{
    public Client $client;

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

    public function sirene()
    {
        return new Sirene($this->client, $this->token());
    }

    public function metadata()
    {
        return new Metadata($this->client, $this->token());
    }
}
