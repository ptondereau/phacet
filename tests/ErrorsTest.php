<?php

declare(strict_types = 1);

namespace PHacet\Tests;

use PHacet\Exception\MappingError;
use PHacet\Exception\MissingRequired;
use PHacet\Layered;
use PHacet\Tests\Fixture\RequiredConfig;
use PHacet\Tests\Fixture\ServerConfig;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ErrorsTest extends TestCase
{
    #[Test]
    public function it_aggregates_every_coercion_failure_into_one_error(): void
    {
        try {
            Layered::for(ServerConfig::class)->values([
                'port' => 'not-a-number',
                'tls' => 'maybe',
            ])->build();
            self::fail('Expected a MappingError.');
        } catch (MappingError $error) {
            self::assertCount(2, $error->failures);
            self::assertStringContainsString('port', $error->report());
            self::assertStringContainsString('tls', $error->report());
        }
    }

    #[Test]
    public function it_reports_a_missing_required_field(): void
    {
        try {
            Layered::for(RequiredConfig::class)->values([])->build();
            self::fail('Expected a MappingError.');
        } catch (MappingError $error) {
            self::assertCount(1, $error->failures);
            self::assertInstanceOf(MissingRequired::class, $error->failures[0]);
            self::assertStringContainsString('token', $error->report());
        }
    }
}
