<?php

namespace Ttpryg\EventDispatcher\Provider;

use Ttpryg\EventDispatcher\Contracts\ListenerProviderInterface;
use Ttpryg\EventDispatcher\Exceptions\InvalidListenerException;

class ListenerProvider implements ListenerProviderInterface
{
    /** @var array<string, array<callable>> */
    private array $listeners = [];

    public function addListener(string $eventType, callable $listener): self
    {
        if (! is_callable($listener)) {
            throw new InvalidListenerException('Listener must be a valid callable.');
        }

        $this->listeners[$eventType][] = $listener;

        return $this;
    }

    public function getListenersForEvent(object $event): iterable
    {
        $listeners = [];

        foreach ($this->listeners as $eventType => $typeListeners) {
            if ($event instanceof $eventType || $event instanceof $eventType) {
                foreach ($typeListeners as $typeListener) {
                    $listeners[] = $typeListener;
                }
            }
        }

        return $listeners;
    }
}
