<?php

namespace spec\carlosV2\Communism;

use PhpSpec\ObjectBehavior;

class CommunistSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new TestingObject(1, 2));
    }

    function it_is_an_Extractor()
    {
        $this->shouldBeAnInstanceOf('carlosV2\Communism\ExtractorInterface');
    }

    function it_is_an_Injector()
    {
        $this->shouldBeAnInstanceOf('carlosV2\Communism\InjectorInterface');
    }

    function it_extracts_an_object_property()
    {
        $this->extract('property')->shouldReturn(1);
    }

    function it_extracts_a_parent_object_property()
    {
        $this->extract('parentProperty')->shouldReturn(2);
    }

    function it_throws_an_exception_if_the_object_property_does_not_exists_when_extracting()
    {
        $this->shouldThrow('\ReflectionException')->duringExtract('unknownProperty');
    }

    function it_injects_into_an_object_property()
    {
        $this->inject('property', 'a');

        $this->extract('property')->shouldReturn('a');
    }

    function it_injects_into_a_parent_object_property()
    {
        $this->inject('parentProperty', 'b');

        $this->extract('parentProperty')->shouldReturn('b');
    }

    function it_throws_an_exception_if_the_object_property_does_not_exists_when_injecting()
    {
        $this->shouldThrow('\ReflectionException')->duringInject('unknownProperty', 'c');
    }

    function it_replaces_an_object_property()
    {
        $this->replace('property', function ($value) { return '@' . $value; });

        $this->extract('property')->shouldReturn('@1');
    }

    function it_replaces_a_parent_object_property()
    {
        $this->replace('parentProperty', function ($value) { return '*' . $value; });

        $this->extract('parentProperty')->shouldReturn('*2');
    }

    function it_throws_an_exception_if_the_object_property_does_not_exists_when_replacing()
    {
        $this->shouldThrow('\ReflectionException')->duringReplace('unknownProperty', function () {});
    }
}
