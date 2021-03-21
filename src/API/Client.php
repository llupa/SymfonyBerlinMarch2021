<?php

namespace App\API;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

class Client implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    public function post(string $uri, array $payload): ResponseInterface
    {
        $this->logger->info(__METHOD__, [$uri]);

        sleep(random_int(1, 2));

        return new MockResponse(json_encode($payload), ['location' => $uri]);
    }

    public function get(string $uri, array $payload): ResponseInterface
    {
        $this->logger->info(__METHOD__, [$uri]);

        sleep(random_int(1, 2));

        return new MockResponse(json_encode($payload), ['location' => $uri]);
    }

    public function put(string $uri, array $payload): ResponseInterface
    {
        $this->logger->info(__METHOD__, [$uri]);

        sleep(random_int(1, 2));

        return new MockResponse(json_encode($payload), ['location' => $uri]);
    }

    public function delete(string $uri, array $payload): ResponseInterface
    {
        $this->logger->info(__METHOD__, [$uri]);

        sleep(random_int(1, 2));

        return new MockResponse(json_encode($payload), ['location' => $uri]);
    }
}
