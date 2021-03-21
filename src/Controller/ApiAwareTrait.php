<?php

namespace App\Controller;

use App\API\Client;

trait ApiAwareTrait
{
    /**
     * @var Client
     */
    protected $api;

    public function setApi(Client $client): void
    {
        $this->api = $client;
    }
}
