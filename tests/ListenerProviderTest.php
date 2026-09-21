<?php

namespace Ttpryg\EventDispatcher\Tests;

use PHPUnit\Framework\TestCase;
use Ttpryg\EventDispatcher\Provider\ListenerProvider;

class SampleEvent {}

class ListenerProviderTest extends TestCase
{
    public function test_registers_and_retrieves_listeners_for_event(): void
    {
        $listenerProvider = new ListenerProvider;
        $called = false;

        $listenerProvider->addListener(SampleEvent::class, function (SampleEvent $sampleEvent) use (&$called): void {
            $called = true;
        });

        $sampleEvent = new SampleEvent;
        $listeners = iterator_to_array($listenerProvider->getListenersForEvent($sampleEvent));

        $this->assertCount(1, $listeners);
        $listeners[0]($sampleEvent);
        $this->assertTrue($called);
    }
}
