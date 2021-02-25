<?php

declare(strict_types=1);

namespace Hyperdrive\Panels;

use Hyperdrive\Panels\PriceListResources\FuelResource;
use Hyperdrive\Panels\PriceListResources\HyperspaceJumpResource;
use Hyperdrive\Panels\PriceListResources\MapResource;
use Hyperdrive\PriceList\PriceList;

class PriceListPanel extends BasePanel
{
    protected array $priceList;

    public function __construct()
    {
        parent::__construct();
        $this->priceList = PriceList::getData();
    }

    public function show(): void
    {
        $table = $this->createTable($this->priceList);
        $this->cli->table($table);
    }

    private function createTable(array $data): array
    {
        $fuelResource = new FuelResource();
        $mapResource = new MapResource();
        $hyperspaceJumpResource = new HyperspaceJumpResource();

        return [
            $fuelResource($data["Fuel"]),
            $mapResource($data["Map"]),
            $hyperspaceJumpResource($data["Hyperspace-jump"]["short"]),
            $hyperspaceJumpResource($data["Hyperspace-jump"]["long"]),
        ];
    }
}
