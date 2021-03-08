<?php

namespace App\Services;

use App\Jobs\NotifyNewProducts;
use App\Models\RetiringSoonProduct;
use App\Repositories\RetiringSoonProductRepositoryInterface;
use App\Traits\DuplicateEntryChecker;
use App\Traits\GeneralExceptionRaiser;
use App\Traits\ValidationRules;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;

class RetiringSoonProductService implements RetiringSoonProductServiceInterface
{
    use ValidationRules, GeneralExceptionRaiser, DuplicateEntryChecker;

    private $repository;

    public function __construct(RetiringSoonProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function bulkUpdateFromScrapedData(array $data, bool $notifyNewProducts = true)
    {
        $newProducts = [];
        self::validate($data, self::bulkCreateRules());
        $existingProducts = $this->getExistingByScrapedData($data);
        foreach ($data as $row) {
            $key = self::generateKeyFromMarketplaceExternalId(
                $row['marketplace'],
                $row['external_id']
            );
            if ($newProduct = $this->persistWithScrapedDataRow(Arr::get($existingProducts, $key), $row)) {
                $newProducts[] = $newProduct;
            }
        }
        if ($notifyNewProducts && $newProducts) {
            dispatch(new NotifyNewProducts($newProducts));
        }
    }

    public function markAsOutOfStockIfScrapedBelow(Carbon $dateTime)
    {
        $this->repository->updateStockStatusIfScrapedBelow($dateTime, RetiringSoonProduct::STOCK_STATUS_OUT_OF_STOCK);
    }

    public function paginate(array $filter)
    {
        self::validate($filter, self::listRules());
        return $this->repository->paginate($filter);
    }

    private function persistWithScrapedDataRow(?RetiringSoonProduct $existingProduct, array $scrapedDataRow)
    {
        $product = $existingProduct ?: new RetiringSoonProduct;
        try {
            self::mapProductObjectWithDataRow($product, $scrapedDataRow);
            $this->repository->persist($product);
            return !$existingProduct ? $product : false;
        } catch (QueryException $e) {
            if (self::isDuplicateEntry($e)) {
                $product = $this->repository->findOneByMarketplaceExternalId(
                    $product->getMarketplace(),
                    $product->getExternalId()
                );
                self::mapProductObjectWithDataRow($product, $scrapedDataRow);
                $this->repository->persist($product);
                return false;
            }
            throw $e;
        }
    }

    private function getExistingByScrapedData(array $scrapedData)
    {
        $keyBy = [];
        $filter = self::getFilterFromScrapedData($scrapedData);
        $existingProducts = $this->repository
                                ->findAllByMarketplaceExternalId($filter)
                                ->all();
        foreach ($existingProducts as $product) {
            $key = self::generateKeyFromMarketplaceExternalId(
                $product->getMarketplace(),
                $product->getExternalId()
            );
            $keyBy[$key] = $product;
        }
        return $keyBy;
    }

    private static function generateKeyFromMarketplaceExternalId(string $marketplace, int $externalId)
    {
        return "{$externalId}@@{$marketplace}";
    }

    private static function getFilterFromScrapedData(array $scrapedData)
    {
        $filters = [];
        foreach ($scrapedData as $row) {
            $filters[] = [
                'marketplace' => $row['marketplace'],
                'external_id' => $row['external_id'],
            ];
        }
        return $filters;
    }

    private static function mapProductObjectWithDataRow(RetiringSoonProduct $product, array $row)
    {
        $product->setExternalId($row['external_id'])
            ->setMarketplace($row['marketplace'])
            ->setUrl($row['url'])
            ->setName($row['name'])
            ->setCurrency($row['currency'])
            ->setPrice($row['price'])
            ->setSalePrice($row['sale_price'] ?: null)
            ->setDiscountAmount($row['discount_amount'] ?: null)
            ->setDiscountPercentage($row['discount_percentage'] ?: null)
            ->setStockStatus($row['stock_status'])
            ->setScrapedAt(Carbon::createFromTimestamp($row['scraped_at']));
        if (!$product->exists) {
            $product->setSpottedAt(Carbon::createFromTimestamp($row['scraped_at']));
        }
        return $product;
    }

    private static function validate(array $data, array $rules)
    {
        $validator = validator($data, $rules);
        if ($validator->fails()) {
            self::raiseGeneralException('Validation failed', $validator->getMessageBag()->all());
        }
    }
}