<?php

namespace App\Services;

use App\Models\RetiringSoonProduct;
use App\Traits\GeneralExceptionRaiser;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class ScraperService implements ScraperServiceInterface
{
    use GeneralExceptionRaiser;

    public function getAllRetiringSoon(string $marketplace)
    {
        if (!in_array($marketplace, RetiringSoonProduct::MARKETPLACES)) {
            self::raiseGeneralException('Invalid marketplace');
        }
        $products = [];
        $page = 1;
        $hasMore = true;
        while ($hasMore) {
            $data = $this->getRetiringSoon($marketplace, $page, true);
            $page++;
            $hasMore = $data['has_more'];
            array_push($products, ...$data['products']);
        }
        return $products;
    }

    public function getRetiringSoon(string $marketplace, int $page = 1, bool $checkHasMore = false)
    {
        if (!in_array($marketplace, RetiringSoonProduct::MARKETPLACES)) {
            self::raiseGeneralException('Invalid marketplace');
        }
        exec("MARKETPLACE='{$marketplace}' PAGENUMBER='{$page}' npm run scrape", $output, $exitStatus);
        self::handleScrapeError($output, $exitStatus);
        $response = json_decode(Arr::last($output), true);
        $data = [
            'products' => Arr::get($response, 'products', []),
        ];
        if ($checkHasMore) {
            $data['has_more'] = Arr::get($response, 'has_more', false);
        }
        return $data;
    }

    private static function handleScrapeError(array $output, int $exitStatus)
    {
        $response = json_decode(Arr::last($output), true);
        if ($exitStatus || !$response) {
            Log::error('Cannot crawl data at the moment: exit code ' . $exitStatus, $output);
            self::raiseGeneralException('Cannot crawl data at the moment');
        }
        if (!Arr::get($response, 'success')) {
            self::raiseGeneralException(Arr::get($response, 'error', 'Cannot crawl data at the moment'));
        }
    }
}