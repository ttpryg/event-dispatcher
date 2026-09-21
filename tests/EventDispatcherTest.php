<?php

namespace Ttpryg\EventDispatcher\Tests;

use PHPUnit\Framework\TestCase;
use Ttpryg\EventDispatcher\Contracts\StoppableEventInterface;
use Ttpryg\EventDispatcher\Dispatcher\EventDispatcher;
use Ttpryg\EventDispatcher\Provider\ListenerProvider;

class SimpleTestEvent
{
    public int $counter = 0;
}

class StoppableTestEvent implements StoppableEventInterface
{
    public bool $stopped = false;

    public function isPropagationStopped(): bool
    {
        return $this->stopped;
    }
}

class EventDispatcherTest extends TestCase
{
    public function test_dispatches_event_to_listeners(): void
    {
        $listenerProvider = new ListenerProvider;
        $listenerProvider->addListener(SimpleTestEvent::class, function (SimpleTestEvent $simpleTestEvent): void {
            $simpleTestEvent->counter++;
        });

        $eventDispatcher = new EventDispatcher($listenerProvider);
        $simpleTestEvent = new SimpleTestEvent;
        $dispatched = $eventDispatcher->dispatch($simpleTestEvent);

        $this->assertSame($simpleTestEvent, $dispatched);
        $this->assertEquals(1, $simpleTestEvent->counter);
    }

    public function test_stops_propagation_for_stoppable_event(): void
    {
        $listenerProvider = new ListenerProvider;
        $calls = 0;

        $listenerProvider->addListener(StoppableTestEvent::class, function (StoppableTestEvent $stoppableTestEvent) use (&$calls): void {
            $calls++;
            $stoppableTestEvent->stopped = true;
        });

        $listenerProvider->addListener(StoppableTestEvent::class, function (StoppableTestEvent $stoppableTestEvent) use (&$calls): void {
            $calls++;
        });

        $eventDispatcher = new EventDispatcher($listenerProvider);
        $stoppableTestEvent = new StoppableTestEvent;
        $eventDispatcher->dispatch($stoppableTestEvent);

        $this->assertEquals(1, $calls);
    }
}
