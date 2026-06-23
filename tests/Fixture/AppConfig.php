<?php

declare(strict_types = 1);

namespace PHacet\Tests\Fixture;

final class AppConfig
{
    public function __construct(
        public ServerConfig $server = new ServerConfig(),
        public string $name = 'app',
    ) {
    }
}
