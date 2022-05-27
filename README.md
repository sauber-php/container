<a href="https://supportukrainenow.org/"><img src="https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/banner-direct.svg" width="100%"></a>

# Container

<!-- BADGES_START -->
![GitHub release (latest by date)](https://img.shields.io/github/v/release/sauber-php/container)
![tests](https://github.com/sauber-php/container/workflows/run-tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/sauber-php/container.svg?style=flat-square)](https://packagist.org/packages/phpfox/container)
![GitHub](https://img.shields.io/github/license/sauber-php/container)
<!-- BADGES_END -->

This is the repository for the DI Container used in the Sauber PHP Framework.

## Installation

You should not need to install this package, as it comes pre-installed with the Sauber PHP Framework, however
if you want to use this outside of the framework please use composer:

```bash
composer require sauber-php/container
```

## Usage

To use the container, you can manually add definitions:

```php
$container = new Container(
    definitions: [
        UserRepositoryInterface::class => UserRepository::class,
    ],
);

$repository = $container->get(
    id: UserRepositoryInterface::class,
);
```

To make a new container with injected callables:

```php
$injectors = [
    UserRepositoryInterface::class => UserRepository::class,
];

$container = Container::make(
    injectors: $injectors,
);

$repository = $container->get(
    id: UserRepositoryInterface::class,
);
```

## Testing

To run the tests:

```bash
./vendor/bin/pest
```

## Static Analysis

To check the static analysis:

```bash
./vendor/bin/phpstan analyse
```

## Changelog

Please see [the Changelog](CHANGELOG.md) for more information on what has changed recently.
