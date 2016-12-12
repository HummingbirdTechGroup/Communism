<?php

namespace spec\carlosV2\Communism;

class TestingObject extends TestingParentObject
{
    /**
     * @var mixed
     */
    private $property;

    /**
     * @param mixed $property
     * @param mixed $parentProperty
     */
    public function __construct($property, $parentProperty)
    {
        parent::__construct($parentProperty);
        $this->property = $property;
    }

    /**
     * @return mixed
     */
    public function getProperty()
    {
        return $this->property;
    }
}
