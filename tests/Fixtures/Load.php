<?php

declare(strict_types=1);

namespace Sauber\Container\Tests\Fixtures;

class Load
{
    public function __construct(
        private Test $test,
    ) {}

    public function test(): Test
    {
        return $this->test;
    }
}
