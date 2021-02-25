<?php

declare(strict_types=1);

namespace Hyperdrive\Panels\Options;

use JetBrains\PhpStorm\ArrayShape;

class HyperspaceJumpOptions
{
    #[ArrayShape([
        "short" => "string",
        "long" => "string",
        "quit" => "string",
    ])]
    public function __invoke(int $shortDistance, int $longDistance): array
    {
        return [
            "short" => "Short jump - {$shortDistance} planets",
            "long" => "Long jump - {$longDistance} planets",
            "quit" => "Quit",
        ];
    }
}
