<?php

namespace Axeldotdev\Insee;

use GuzzleHttp\Client;
use stdClass;

class Metadata
{
    public Client $client;
    public string $token;
    public string $type;
    public string $subtype;

    public function __construct(Client $client, string $token)
    {
        $this->client = $client;
        $this->token = $token;
    }

    public function cjn2(): self
    {
        $this->type = 'codes';
        $this->subtype = 'cj/n2';

        return $this;
    }

    public function cjn3(): self
    {
        $this->type = 'codes';
        $this->subtype = 'cj/n3';

        return $this;
    }

    public function nafr2Class(): self
    {
        $this->type = 'codes';
        $this->subtype = 'nafr2/classe';

        return $this;
    }

    public function nafr2SubClass(): self
    {
        $this->type = 'codes';
        $this->subtype = 'nafr2/sousClasse';

        return $this;
    }

    public function find(string $code): stdClass
    {
        return $this->request($code);
    }

    public function request(?string $code = null): stdClass
    {
        $code = $code ? '/' . str_replace(' ', '', $code) : '';

        $result = $this->client->get('https://api.insee.fr/metadonnees/V1/' . $this->type . '/' . $this->subtype . $code, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
            'http_errors' => false,
        ]);

        /** @var stdClass */
        return json_decode($result->getBody());
    }
}
