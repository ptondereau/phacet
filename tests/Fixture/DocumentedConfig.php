<?php

declare(strict_types = 1);

namespace PHacet\Tests\Fixture;

use PHacet\Attribute\Help;
use PHacet\Attribute\Hidden;
use PHacet\Attribute\Named;
use PHacet\Attribute\Positional;
use PHacet\Attribute\Secret;

final class DocumentedConfig
{
    public function __construct(
        #[Named(short: 'H'), Help('Address to bind to')]
        public string $host = '127.0.0.1',
        #[Secret]
        public string $apiKey = 'sk-default',
        #[Hidden]
        public bool $debug = false,
        #[Positional]
        public ?string $configPath = null,
    ) {
    }
}
