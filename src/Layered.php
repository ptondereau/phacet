<?php

declare(strict_types = 1);

namespace PHacet;

use PHacet\Help\HelpFormatter;
use PHacet\Shape\Shape;
use PHacet\Source\ArgvSource;
use PHacet\Source\ArraySource;
use PHacet\Source\EnvSource;
use PHacet\Source\FileSource;
use PHacet\Source\Source;

/**
 * @template T of object
 */
final readonly class Layered
{
    /**
     * @param class-string<T> $target
     * @param list<Source> $sources
     */
    private function __construct(
        private string $target,
        private array $sources,
    ) {
    }

    /**
     * @template TFor of object
     * @param class-string<TFor> $target
     * @return self<TFor>
     */
    public static function for(string $target): self
    {
        return new self($target, []);
    }

    /**
     * @return self<T>
     */
    public function source(Source $source): self
    {
        return new self($this->target, [...$this->sources, $source]);
    }

    /**
     * @param array<string, mixed> $values
     * @return self<T>
     */
    public function values(array $values): self
    {
        return $this->source(new ArraySource($values));
    }

    /**
     * @param list<string> $paths
     * @return self<T>
     */
    public function files(array $paths): self
    {
        $layered = $this;
        foreach ($paths as $path) {
            $layered = $layered->source(new FileSource($path));
        }

        return $layered;
    }

    /**
     * @param array<string, string>|null $env
     * @return self<T>
     */
    public function env(string $prefix, ?array $env = null): self
    {
        return $this->source(new EnvSource($prefix, $env));
    }

    /**
     * @param list<string> $argv
     * @return self<T>
     */
    public function args(array $argv): self
    {
        return $this->source(new ArgvSource($argv));
    }

    /**
     * @return T
     */
    public function build(): object
    {
        $shape = Shape::of($this->target);

        $merged = [];
        foreach ($this->sources as $source) {
            foreach ($source->read($shape) as $path => $value) {
                $merged[$path] = $value;
            }
        }

        /** @var T */
        return ( new Hydrator() )->hydrate($shape, PathTree::expand($merged));
    }

    public function help(): string
    {
        return ( new HelpFormatter() )->format(Shape::of($this->target));
    }
}
