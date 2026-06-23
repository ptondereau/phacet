<?php

declare(strict_types = 1);

namespace PHacet\Tests\Fixture;

use PHacet\Attribute\Flatten;

final class FlatConfig
{
    public function __construct(
        #[Flatten]
        public ServerConfig $server = new ServerConfig(),
        public string $name = 'app',
    ) {
    }
}
