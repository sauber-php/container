<?php

declare(strict_types=1);

use Sauber\Container\Container;
use Sauber\Container\Tests\Fixtures\Injector;
use Sauber\Container\Tests\Fixtures\Load;
use Sauber\Container\Tests\Fixtures\Test;
use Sauber\Container\Tests\Fixtures\TestContract;

it('can resolve from the container automatically without configuring it', function () {
    $container = new Container();

    expect(
        $container->get(
            id: Test::class
        ),
    )->toBeInstanceOf(Test::class);
});

it('can resolve integers', function (int $integer) {
    $container = new Container(
        definitions: [
            Test::class => $integer,
        ],
    );

    expect(
        $container->get(
            id: Test::class,
        ),
    )->toEqual($integer);
})->with('integers');

it('can resolve strings', function (string $string) {
    $container = new Container(
        definitions: [
            Test::class => $string,
        ]
    );

    expect(
        $container->get(
            id: Test::class,
        ),
    )->toEqual($string);
})->with('strings');

it('can resolve Closures', function (string $string) {
    $container = new Container(
        definitions: [
            Test::class => fn () => $string,
        ]
    );

    expect(
        $container->get(
            id: Test::class,
        ),
    )->toEqual($string);
})->with('strings');

it('uses reflection to resolve classes', function () {
    $container = new Container();

    $load = $container->get(
        id: Load::class,
    );

    expect(
        $load,
    )->toBeInstanceOf(
        Load::class
    )->and(
        $load->test(),
    )->toBeInstanceOf(
        Test::class
    );
});

it('can make a container', function () {
    $container = Container::make(
        injectors: [Injector::class],
    );

    expect(
        $container->get(
            id: TestContract::class,
        ),
    )->toBeInstanceOf(Test::class);
});
