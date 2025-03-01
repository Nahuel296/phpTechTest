<?php

namespace Infrastructure\Event;

use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class EventDispatcher
{
    private EventDispatcherInterface $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function dispatch(object $event)
    {
        $this->dispatcher->dispatch($event);
    }
}
