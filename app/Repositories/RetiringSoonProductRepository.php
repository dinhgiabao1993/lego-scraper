<?php

namespace App\Repositories;

use App\Models\RetiringSoonProduct;
use Carbon\Carbon;

class RetiringSoonProductRepository implements RetiringSoonProductRepositoryInterface
{
    public function persist(RetiringSoonProduct $product)
    {
        $product->save();
    }

    public function bulkCreate(array $products)
    {
        RetiringSoonProduct::insert($products);
    }

    public function updateStockStatusIfScrapedBelow(Carbon $dateTime, string $stockStatus)
    {
        RetiringSoonProduct::where('scraped_at', '<' , $dateTime)->update(['stock_status' => $stockStatus]);
    }

    public function findOneByMarketplaceExternalId(string $marketplace, int $externalId)
    {
        return RetiringSoonProduct::where('external_id', $externalId)
            ->where('marketplace', $marketplace)
            ->first();
    }

    public function paginate(array $filter)
    {
        $query = self::makeQuery($filter);
        return $query->orderBy('spotted_at', 'DESC')->paginate();
    }

    public function list(array $filter)
    {
        $query = self::makeQuery($filter);
        return $query->get();
    }

    public function findAllByMarketplaceExternalId(array $marketplaceExternalIds)
    {
        $query = RetiringSoonProduct::query();
        foreach ($marketplaceExternalIds as $item) {
            $query->orWhere(function($q) use ($item) {
                $q->where('external_id', $item['external_id']);
                $q->where('marketplace', $item['marketplace']);
            });
        }
        return $query->get();
    }

    private static function makeQuery(array $filter)
    {
        $query = RetiringSoonProduct::query();
        if (!empty($filter['external_id'])) {
            $query->where('external_id', $filter['external_id']);
        }
        if (!empty($filter['marketplace'])) {
            $query->where('marketplace', $filter['marketplace']);
        }
        if (!empty($filter['currency'])) {
            $query->where('currency', $filter['currency']);
        }
        if (!empty($filter['name'])) {
            $query->where('name', 'like', "%{$filter['name']}%");
        }
        if (!empty($filter['stock_Status'])) {
            $query->where('stock_Status', $filter['stock_Status']);
        }
        if (!empty($filter['spotted_from'])) {
            $query->where('spotted_at', '>=', $filter['spotted_from']);
        }
        if (!empty($filter['spotted_to'])) {
            $query->where('spotted_at', '<=', $filter['spotted_to']);
        }
        if (!empty($filter['scraped_from'])) {
            $query->where('scraped_at', '>=', $filter['scraped_from']);
        }
        if (!empty($filter['scraped_to'])) {
            $query->where('scraped_at', '<=', $filter['scraped_to']);
        }
        if (!empty($filter['price_from'])) {
            $query->where('price', '>=', $filter['price_from']);
        }
        if (!empty($filter['price_to'])) {
            $query->where('price', '<=', $filter['price_to']);
        }
        if (!empty($filter['sale_price_from'])) {
            $query->where('sale_price', '>=', $filter['sale_price_from']);
        }
        if (!empty($filter['sale_price_to'])) {
            $query->where('sale_price', '<=', $filter['sale_price_to']);
        }
        if (!empty($filter['disacount_percentage_from'])) {
            $query->where('disacount_percentage', '>=', $filter['disacount_percentage_from']);
        }
        if (!empty($filter['disacount_percentage_to'])) {
            $query->where('disacount_percentage', '<=', $filter['disacount_percentage_to']);
        }
        if (!empty($filter['disacount_amount_from'])) {
            $query->where('disacount_amount', '>=', $filter['disacount_amount_from']);
        }
        if (!empty($filter['disacount_amount_to'])) {
            $query->where('disacount_amount', '<=', $filter['disacount_amount_to']);
        }
        return $query;
    }
}