# EventDispatcher Library (`ttpryg/event-dispatcher`)

A lightweight, PSR-14 compliant Event Dispatcher & Listener Provider for PHP 8.1+.

---

## 🌟 Key Features

- **PSR-14 Compliant**: Fully compatible with PSR-14 contracts (`EventDispatcherInterface`, `ListenerProviderInterface`, `StoppableEventInterface`).
- **Framework Agnostic**: Clean, decoupled design that works in any PHP application or framework.
- **Stoppable Events Support**: Safely halt propagation chains when `isPropagationStopped()` returns true.
- **Strictly Typed**: Built with modern PHP 8.1+ features (readonly properties, strict types).

---

## 📦 Installation

Install the package via Composer:

```bash
composer require ttpryg/event-dispatcher
```

> **Requirements:** PHP 8.1 or higher.

---

## 🚀 Quick Start

### 1. Define an Event

```php
namespace App\Event;

use Psr\EventDispatcher\StoppableEventInterface;

class UserRegisteredEvent implements StoppableEventInterface
{
    private bool $stopped = false;

    public function __construct(
        public readonly string $userId,
        public readonly string $email
    ) {}

    public function isPropagationStopped(): bool
    {
        return $this->stopped;
    }

    public function stopPropagation(): void
    {
        $this->stopped = true;
    }
}
```

### 2. Register Listeners & Dispatch

```php
use Ttpryg\EventDispatcher\Provider\ListenerProvider;
use Ttpryg\EventDispatcher\Dispatcher\EventDispatcher;
use App\Event\UserRegisteredEvent;

// 1. Initialize Listener Provider
$provider = new ListenerProvider();

// Register listener (Closure or callable)
$provider->addListener(UserRegisteredEvent::class, function (UserRegisteredEvent $event) {
    echo "Welcome email sent to: " . $event->email;
});

// 2. Initialize Dispatcher & Dispatch Event
$dispatcher = new EventDispatcher($provider);
$dispatcher->dispatch(new UserRegisteredEvent("usr_101", "user@example.com"));
```

---

## 🌳 Architecture

```text
event-dispatcher/
├── src/
│   ├── Dispatcher/
│   │   └── EventDispatcher.php
│   ├── Provider/
│   │   └── ListenerProvider.php
│   └── Exceptions/
│       └── InvalidListenerException.php
├── tests/
│   ├── EventDispatcherTest.php
│   └── ListenerProviderTest.php
└── composer.json
```

---

## 🧪 Testing

Run the test suite using PHPUnit:

```bash
composer test
# or
./vendor/bin/phpunit
```

---

## 📄 License

This project is open-sourced software licensed under the [MIT License](LICENSE).