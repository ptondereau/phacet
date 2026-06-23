<?php

declare(strict_types = 1);

namespace PHacet\Tests\Fixture;

final class LoggingConfig
{
    public function __construct(
        public LogLevel $level = LogLevel::Info,
    ) {
    }
}
