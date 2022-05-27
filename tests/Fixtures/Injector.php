<?php

declare(strict_types=1);

namespace Sauber\Container\Tests\Fixtures;

class Injector
{
    /**
     * @return array<class-string,class-string>
     */
    public function __invoke(): array
    {
        return [
            TestContract::class => Test::class,
        ];
    }
}