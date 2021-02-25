<?php

declare(strict_types=1);

namespace Hyperdrive\Panels\PriceListResources;

use JetBrains\PhpStorm\ArrayShape;

class MapResource extends BaseResource
{
    #[ArrayShape([
        "Name" => "string",
        "Price" => "int",
    ])]
    public function __invoke(array $mapValues): array
    {
        $name = "Unlocking the map";
        $price = $mapValues["price"];

        return $this->toArray($name, $price);
    }
}
