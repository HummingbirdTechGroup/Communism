<?php

namespace carlosV2\Communism;

interface ExtractorInterface
{
    /**
     * @param string $property
     *
     * @return mixed
     */
    public function extract($property);
}
