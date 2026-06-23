<?php

declare(strict_types = 1);

namespace PHacet\Tests\Fixture;

enum LogLevel: string
{
    case Debug = 'debug';
    case Info = 'info';
    case Error = 'error';
}
