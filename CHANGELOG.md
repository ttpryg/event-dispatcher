# Changelog

All notable changes to `ttpryg/event-dispatcher` will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.1.0] - 2026-10-18

### Added

- Root `ExceptionInterface` marker interface (`Ttpryg\EventDispatcher\Exceptions\ExceptionInterface`)
  that extends `Throwable` and is implemented by every custom exception, so consumers can
  catch all library-specific errors with a single type.
- `.editorconfig` for consistent editor settings across the project.

### Changed

- Added `declare(strict_types=1)` to all source files that were missing it.

## [1.0.0] - 2026-09-21

### Added

- Initial release: PSR-14 compatible event dispatcher with a `ListenerProvider`
  (listener registration by event class/name), `Dispatcher`, and the
  `InvalidListenerException` guard for malformed listener registrations.
