<?php

namespace Angecode\LaravelIproSoft\Entities\Property;

use Angecode\LaravelIproSoft\Entities\IproEntity;
use Illuminate\Support\Collection;

class CustomRate extends IproEntity
{
    public int $id;

    public string $month;

    public ?string $notes;

    public Collection $weekPriceList;

    /**
     * @codeCoverageIgnore
     * @param array $data
     * @return Collection
     */
    protected function parseWeekPriceList(array $data): Collection
    {
        $collection = new Collection();
        foreach ($data as $itemData) {
            $collection->add(CustomRateAmountGroup::fromArray($itemData));
        }

        return $collection;
    }
}
