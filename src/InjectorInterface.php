<?php

namespace carlosV2\Communism;

interface InjectorInterface
{
    /**
     * @param string $property
     * @param mixed  $value
     */
    public function inject($property, $value);
}
