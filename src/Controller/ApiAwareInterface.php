<?php

namespace App\Controller;

use App\API\Client;

interface ApiAwareInterface
{
    public function setApi(Client $client): void;
}
