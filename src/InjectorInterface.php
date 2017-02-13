<?php

namespace carlosV2\Communism;

use ReflectionException;

interface InjectorInterface
{
    /**
     * @param string $property
     * @param mixed  $value
     *
     * @throws ReflectionException
     */
    public function inject($property, $value);

    /**
     * @param string   $property
     * @param callable $callback
     *
     * @throws ReflectionException
     */
    public function replace($property, $callback);
}
