<?php

namespace App\Repositories;

use App\Models\RetiringSoonProduct;
use Carbon\Carbon;

interface RetiringSoonProductRepositoryInterface
{
    /**
     * @param RetiringSoonProduct $product
     */
    public function persist(RetiringSoonProduct $product);

    /**
     * @param RetiringSoonProduct[] $product
     */
    public function bulkCreate(array $products);

    /**
     * @param Carbon $dateTime
     * @param string $stockStatus
     */
    public function updateStockStatusIfScrapedBelow(Carbon $dateTime, string $stockStatus);

    /**
     * @param string $marketplace
     * @param int $externalId
     * @return RetiringSoonProduct|null
     */
    public function findOneByMarketplaceExternalId(string $marketplace, int $externalId);

    /**
     * @param array $filter
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(array $filter);

    /**
     * @param array $filter
     * @return RetiringSoonProduct[]|Illuminate\Database\Eloquent\Collection
     */
    public function list(array $filter);

    /**
     * @param array $marketplaceExternalIds
     * @return RetiringSoonProduct[]|Illuminate\Database\Eloquent\Collection
     */
    public function findAllByMarketplaceExternalId(array $marketplaceExternalIds);
}