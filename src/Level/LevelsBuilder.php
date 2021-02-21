<?php

declare(strict_types=1);

namespace Hyperdrive\Level;

use Hyperdrive\Contracts\BuilderContract;
use Symfony\Component\Yaml\Yaml;

class LevelsBuilder implements BuilderContract
{
    public static function buildFromArray(array $data): LevelsCollection
    {
        $levelsCollection = new LevelsCollection();
        self::buildSpaceship($levelsCollection, $data);

        return $levelsCollection;
    }

    public static function buildFromYaml(string $filePath): LevelsCollection
    {
        $levelsCollection = new LevelsCollection();
        $levelsData = Yaml::parseFile($filePath);
        self::buildSpaceship($levelsCollection, $levelsData);

        return $levelsCollection;
    }

    protected static function buildSpaceship(LevelsCollection &$levelsCollection, array $levelsData): void
    {
        foreach ($levelsData as $key => $difficultyLevelData) {
            $levelsCollection->addLevel(new Level($difficultyLevelData + ["name" => $key]));
        }
    }
}