<?php

declare(strict_types = 1);

namespace Sauber\Container;

use Closure;
use Psr\Container\ContainerInterface;
use League\Container\ReflectionContainer;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use League\Container\Container as LeagueContainer;

final class Container implements ContainerInterface
{
    private LeagueContainer $baseContainer;

    /**
     * @param array<array<class-string,class-string>> $definitions
     */
    public function __construct(
        private readonly array $definitions = []
    ) {
        $this->baseContainer = (new LeagueContainer())->delegate(
            container: new ReflectionContainer(),
        );

        foreach ($this->definitions as $id => $concrete) {
            $this->baseContainer->add(
                id: $id,
                concrete: $concrete,
            );
        }
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function get(string $id): mixed
    {
        if (array_key_exists($id, $this->definitions) && is_callable($this->definitions[$id])) {
            $this->baseContainer->add(
                id: $id,
                concrete: $this->definitions[$id]($this),
            );
        }

        return $this->baseContainer->get(
            id: $id,
        );
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return $this->baseContainer->has(
            id: $id,
        );
    }

    /**
     * @param array<int, class-string<Closure>> $injectors
     */
    public static function make(array $injectors): ContainerInterface
    {
        $definitions = [];

        foreach ($injectors as $injector) {
            $definitions = array_merge((new $injector())());
        }

        return new self(
            definitions: $definitions
        );
    }
}
