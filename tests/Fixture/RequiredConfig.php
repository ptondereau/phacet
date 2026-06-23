<?php

declare(strict_types = 1);

namespace PHacet\Tests\Fixture;

final class RequiredConfig
{
    public function __construct(
        public string $token,
        public int $retries = 3,
    ) {
    }
}
