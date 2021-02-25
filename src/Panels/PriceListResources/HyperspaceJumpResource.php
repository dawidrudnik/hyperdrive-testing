<?php

declare(strict_types=1);

namespace Hyperdrive\Panels\PriceListResources;

use Hyperdrive\Player\Navigator\HyperspaceJumpOption;
use JetBrains\PhpStorm\ArrayShape;

class HyperspaceJumpResource extends BaseResource
{
    #[ArrayShape([
        "Name" => "string",
        "Price" => "int",
    ])]
    public function __invoke(HyperspaceJumpOption $jumpOption): array
    {
        $name = $jumpOption->__toString();
        $price = $jumpOption->getPrice();

        return $this->toArray($name, $price);
    }
}
