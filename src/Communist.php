<?php

namespace carlosV2\Communism;

use ReflectionException;
use ReflectionProperty;

final class Communist implements ExtractorInterface, InjectorInterface
{
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
        return $this->extractByClassName(get_class($this->object), $property);
    }

    /**
     * @inheritDoc
     */
    public function inject($property, $value)
    {
        $this->injectByClassName(get_class($this->object), $property, $value);
    }

    /**
     * @inheritDoc
     */
    public function replace($property, callable $callback)
    {
        $this->inject($property, $callback($this->extract($property)));
    }

    /**
     * @param string $property
     * @param mixed  $value
     */
    public function __set($property, $value)
    {
        $this->inject($property, $value);
    }

    /**
     * @param string $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        return $this->extract($property);
    }

    /**
     * @param string $property
     * @param array  $arguments
     */
    public function __call($property, $arguments)
    {
        $this->replace($property, $arguments[0]);
    }

    /**
     * @param string $className
     * @param string $property
     *
     * @return mixed
     *
     * @throws ReflectionException
     */
    private function extractByClassName($className, $property)
    {
        try {
            $rflProperty = new ReflectionProperty($className, $property);
            $rflProperty->setAccessible(true);
            return $rflProperty->getValue($this->object);
        } catch (ReflectionException $e) {
            if (($parentClass = get_parent_class($className)) !== false) {
                return $this->extractByClassName($parentClass, $property);
            } else {
                throw $e;
            }
        }
    }

    /**
     * @param string $className
     * @param string $property
     * @param mixed  $value
     *
     * @throws ReflectionException
     */
    private function injectByClassName($className, $property, $value)
    {
        try {
            $rflProperty = new ReflectionProperty($className, $property);
            $rflProperty->setAccessible(true);
            $rflProperty->setValue($this->object, $value);
        } catch (ReflectionException $e) {
            if (($parentClass = get_parent_class($className)) !== false) {
                $this->injectByClassName($parentClass, $property, $value);
            } else {
                throw $e;
            }
        }
    }
}
