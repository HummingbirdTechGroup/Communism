<?php

namespace spec\carlosV2\Communism;

abstract class TestingParentObject
{
    /**
     * @var mixed
     */
    private $parentProperty;

    /**
     * @param mixed $parentProperty
     */
    public function __construct($parentProperty)
    {
        $this->parentProperty = $parentProperty;
    }

    /**
     * @return mixed
     */
    public function getParentProperty()
    {
        return $this->parentProperty;
    }
}
