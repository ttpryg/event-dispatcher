# EventDispatcher Library (`ttpryg/event-dispatcher`)

PSR-14 Compliant Event Dispatcher & Listener Provider standalone PHP 8.1+ library.

## 🌳 Directory Tree Structure

```
event-dispatcher/
├── composer.json
├── src/
│   ├── Contracts/
│   │   ├── EventDispatcherInterface.php
│   │   ├── ListenerProviderInterface.php
│   │   └── StoppableEventInterface.php
│   ├── Dispatcher/
│   │   └── EventDispatcher.php
│   ├── Provider/
│   │   └── ListenerProvider.php
│   └── Exceptions/
│       └── InvalidListenerException.php
├── tests/
│   ├── EventDispatcherTest.php
│   └── ListenerProviderTest.php
└── README.md
```

---

## 🌟 Key Features

- **PSR-14 Compliant**: Standard Event Dispatcher, Listener Provider, and Stoppable Event Contracts.
- **Framework Agnostic**: Pure PHP 8.1+ with zero external runtime dependencies.
- **Stoppable Events**: Supports halting event propagation pipeline when `isPropagationStopped()` returns true.

---

## 🚀 Usage Example

```php
use Ttpryg\EventDispatcher\Provider\ListenerProvider;
use Ttpryg\EventDispatcher\Dispatcher\EventDispatcher;

class UserRegisteredEvent
{
    public function __construct(public readonly string $userId) {}
}

// 1. Initialize Listener Provider
$provider = new ListenerProvider();
$provider->addListener(UserRegisteredEvent::class, function (UserRegisteredEvent $event) {
    echo "User registered: " . $event->userId;
});

// 2. Initialize Dispatcher & Dispatch Event
$dispatcher = new EventDispatcher($provider);
$dispatcher->dispatch(new UserRegisteredEvent("user-123"));
```

---

## 📄 License
MIT License.
