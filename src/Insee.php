<?php

namespace Axeldotdev\Insee;

class Insee
{
    public Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function access_token()
    {
        $token = base64_encode(config('insee.consumer_key') . ':' . config('insee.consumer_secret'));

        $result = $this->client->post('https://api.insee.fr/token', [
            'headers' => [
                'Content-Type'  => 'application/x-www-form-urlencoded',
                'Authorization' => 'Basic ' . $token,
            ],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
        ]);

        $result = json_decode($result->getBody());

        return $result->access_token;
    }

    public function get(string $type, ?string $code = null, array $query = [])
    {
        $code = $code ? '/' . str_replace(' ', '', $code) : '';

        $result = $this->client->get('https://api.insee.fr/entreprises/sirene/V3/' . $type . $code, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->access_token(),
            ],
            'http_errors' => false,
            'query' => $query,
        ]);

        return json_decode($result->getBody());
    }

    public function siren($siren)
    {
        return $this->get('siren', $siren);
    }

    public function siret($siret)
    {
        return $this->get('siret', $siret);
    }
}
