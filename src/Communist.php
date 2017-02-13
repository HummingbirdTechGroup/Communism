<?php

namespace carlosV2\Communism;

use ReflectionException;
use ReflectionProperty;

final class Communist implements ExtractorInterface, InjectorInterface
{
    /**
     * @var ReflectionProperty[]
     */
    private static $properties = array();

    /**
     * @var object
     */
    private $object;

    /**
     * @param object $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * @inheritDoc
     */
    public function extract($property)
    {
        return $this->getReflectionProperty(get_class($this->object), $property)->getValue($this->object);
    }

    /**
     * @inheritDoc
     */
    public function inject($property, $value)
    {
        $this->getReflectionProperty(get_class($this->object), $property)->setValue($this->object, $value);
    }

    /**
     * @inheritDoc
     */
    public function replace($property, $callback)
    {
        $this->inject($property, $callback($this->extract($property)));
    }

    /**
     * @param string $property
     * @param mixed  $value
     *
     * @throws ReflectionException
     */
    public function __set($property, $value)
    {
        $this->inject($property, $value);
    }

    /**
     * @param string $property
     *
     * @return mixed
     *
     * @throws ReflectionException
     */
    public function __get($property)
    {
        return $this->extract($property);
    }

    /**
     * @param string $property
     * @param array  $arguments
     *
     * @throws ReflectionException
     */
    public function __call($property, $arguments)
    {
        $this->replace($property, $arguments[0]);
    }

    /**
     * @param string $className
     * @param string $property
     *
     * @return ReflectionProperty
     *
     * @throws ReflectionException
     */
    private function getReflectionProperty($className, $property)
    {
        if (!isset(self::$properties[$className])) {
            self::$properties[$className] = array();
        }

        if (!isset(self::$properties[$className][$property])) {
            try {
                $rflProperty = new ReflectionProperty($className, $property);
                $rflProperty->setAccessible(true);
            } catch (ReflectionException $e) {
                if (($parentClass = get_parent_class($className)) !== false) {
                    $rflProperty = $this->getReflectionProperty($parentClass, $property);
                } else {
                    throw $e;
                }
            }

            self::$properties[$className][$property] = $rflProperty;
        }

        return self::$properties[$className][$property];
    }
}
