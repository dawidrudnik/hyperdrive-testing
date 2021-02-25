<?php

declare(strict_types=1);

namespace Hyperdrive\PriceList;

use Symfony\Component\Yaml\Yaml;

class PriceList
{
    protected const FilePath = "./resources/price-list.yaml";

    public static function getFuelValues(): array
    {
        $data = Yaml::parseFile(self::FilePath);
        return $data["Fuel"];
    }

    public static function getHyperspaceJumpValues(string $name): array
    {
        $data = Yaml::parseFile(self::FilePath);
        return $data["Hyperspace-jump"][$name];
    }

    public static function getMapPrice(): int
    {
        $data = Yaml::parseFile(self::FilePath);
        return $data["Map"]["price"];
    }
}
