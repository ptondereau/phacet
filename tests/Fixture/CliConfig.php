<?php

declare(strict_types = 1);

namespace PHacet\Tests\Fixture;

use PHacet\Attribute\Counted;
use PHacet\Attribute\Named;
use PHacet\Attribute\Positional;

final class CliConfig
{
    public function __construct(
        #[Named(short: 'v'), Counted]
        public int $verbosity = 0,
        #[Positional]
        public ?string $input = null,
    ) {
    }
}
