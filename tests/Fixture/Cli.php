<?php

declare(strict_types = 1);

namespace PHacet\Tests\Fixture;

use PHacet\Attribute\Counted;
use PHacet\Attribute\Named;
use PHacet\Attribute\Subcommand;

final class Cli
{
    public function __construct(
        #[Subcommand]
        public ServeCommand|MigrateCommand $command,
        #[Named(short: 'v'), Counted]
        public int $verbosity = 0,
    ) {
    }
}
