<?php

declare(strict_types = 1);

namespace PHacet\Tests\Fixture;

use PHacet\Attribute\Named;

final class ServeCommand
{
    public function __construct(
        #[Named]
        public int $workers = 1,
    ) {
    }
}
