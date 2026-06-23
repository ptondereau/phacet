<?php

declare(strict_types = 1);

namespace PHacet\Tests\Fixture;

use PHacet\Attribute\Positional;

final class MigrateCommand
{
    public function __construct(
        #[Positional]
        public string $target,
    ) {
    }
}
