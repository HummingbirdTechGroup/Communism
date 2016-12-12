<?php

use carlosV2\Communism\Communist;
use carlosV2\Communism\ExtractorInterface;
use carlosV2\Communism\InjectorInterface;

if (!function_exists('From')) {
    /**
     * @param object $object
     *
     * @return ExtractorInterface
     */
    function From($object)
    {
        return new Communist($object);
    }
}

if (!function_exists('To')) {
    /**
     * @param object $object
     *
     * @return InjectorInterface
     */
    function To($object)
    {
        return new Communist($object);
    }
}
