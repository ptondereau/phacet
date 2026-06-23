<?php

declare(strict_types = 1);

namespace PHacet\Source;

use PHacet\Shape\Shape;

interface Source
{
    /**
     * @return array<string, mixed> sparse map of dotted leaf path to raw value
     */
    public function read(Shape $shape): array;
}
