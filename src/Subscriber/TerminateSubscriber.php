<?php

namespace App\Subscriber;

use App\API\ApiObjectBus;
use App\Controller\ApiAwareInterface;
use App\Controller\ApiAwareTrait;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class TerminateSubscriber implements ApiAwareInterface, EventSubscriberInterface
{
    use ApiAwareTrait;

    private $bus;

    public function __construct(ApiObjectBus $bus)
    {
        $this->bus = $bus;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::TERMINATE  => 'onTerminate',
            ConsoleEvents::TERMINATE => 'onTerminate',
        ];
    }

    public function onTerminate(): void
    {
        foreach ($this->bus->all() as $item) {
            $this->api->request($item->getType(), $item->getUri(), $item->getPayload());
        }
    }
}
