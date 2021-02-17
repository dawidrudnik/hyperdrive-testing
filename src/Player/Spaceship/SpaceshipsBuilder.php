<?php

declare(strict_types=1);

namespace Hyperdrive\Player\Spaceship;

use Hyperdrive\Contracts\BuilderContract;
use Illuminate\Support\Collection;
use Symfony\Component\Yaml\Yaml;

class SpaceshipsBuilder implements BuilderContract
{
    protected function __construct()
    {
    }

    public static function buildFromRoutesArray(array $data): Collection
    {
        $spaceship = collect();
        self::buildSpaceship($spaceship, $data);

        return $spaceship;
    }

    public static function buildFromYaml(string $filePath): Collection
    {
        $spaceship = collect();
        $pilotsData = Yaml::parseFile($filePath);
        self::buildSpaceship($spaceship, $pilotsData);

        return $spaceship;
    }

    protected static function buildSpaceship(Collection &$spaceship, array $spaceshipData): void
    {
        foreach ($spaceshipData as $pilotData) {
            $spaceship->add(new Spaceship($pilotData));
        }
    }
}
