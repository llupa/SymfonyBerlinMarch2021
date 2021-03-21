<?php

namespace App\API\Object;

interface ApiObjectInterface
{
    public function getPayload(): array;

    public function getUri(): string;

    public function getType(): string;
}
