<?php

declare(strict_types=1);

use Hyperdrive\GalaxyAtlas\GalaxyAtlasBuilder;
use Hyperdrive\GameInstance;
use Hyperdrive\Player\PlayerProfile;

require "./vendor/autoload.php";

$player = new PlayerProfile("Dawid");
$atlas = GalaxyAtlasBuilder::buildFromYaml("./resources/routes.yaml");

(new GameInstance($atlas, $player))->start();