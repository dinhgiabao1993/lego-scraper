<?php

namespace App\Services;

use Carbon\Carbon;

interface RetiringSoonProductServiceInterface
{
    /**
     * @param array $data
     * @param bool $notifyNewProducts
     */
    public function bulkUpdateFromScrapedData(array $data, bool $notifyNewProducts = true);

    /**
     * @param Carbon $dateTime
     */
    public function markAsOutOfStockIfScrapedBelow(Carbon $dateTime);

    /**
     * @param array $filter
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(array $filter);
}