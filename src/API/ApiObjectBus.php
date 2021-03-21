<?php

namespace App\API;

use App\API\Object\ApiObjectInterface;

class ApiObjectBus
{
    private $data = [];

    public function push(ApiObjectInterface $object): void
    {
        $this->data[] = $object;
    }

    /**
     * @return ApiObjectInterface[]
     */
    public function all(): array
    {
        return $this->data;
    }
}
