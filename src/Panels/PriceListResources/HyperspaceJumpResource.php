<?php

declare(strict_types=1);

namespace Hyperdrive\Panels\PriceListResources;

use JetBrains\PhpStorm\ArrayShape;

class HyperspaceJumpResource extends BaseResource
{
    #[ArrayShape([
        "Name" => "string",
        "Price" => "int",
    ])]
    public function __invoke(array $hyperspaceJumpValues): array
    {
        $name = "Hyperspace Jump - {$hyperspaceJumpValues["distance"]} planets";
        $price = $hyperspaceJumpValues["price"];

        return $this->toArray($name, $price);
    }
}
