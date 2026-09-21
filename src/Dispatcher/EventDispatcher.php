<?php

namespace Ttpryg\EventDispatcher\Dispatcher;

use Ttpryg\EventDispatcher\Contracts\EventDispatcherInterface;
use Ttpryg\EventDispatcher\Contracts\ListenerProviderInterface;
use Ttpryg\EventDispatcher\Contracts\StoppableEventInterface;

class EventDispatcher implements EventDispatcherInterface
{
    public function __construct(
        private readonly ListenerProviderInterface $listenerProvider
    ) {}

    public function dispatch(object $event): object
    {
        if ($event instanceof StoppableEventInterface && $event->isPropagationStopped()) {
            return $event;
        }

        foreach ($this->listenerProvider->getListenersForEvent($event) as $listener) {
            $listener($event);

            if ($event instanceof StoppableEventInterface && $event->isPropagationStopped()) {
                break;
            }
        }

        return $event;
    }
}
