<?php

namespace carlosV2\Communism;

use ReflectionException;

interface ExtractorInterface
{
    /**
     * @param string $property
     *
     * @return mixed
     *
     * @throws ReflectionException
     */
    public function extract($property);

    /**
     * @param string   $property
     * @param callable $callback
     *
     * @throws ReflectionException
     */
    public function replace($property, $callback);
}
