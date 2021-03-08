<?php

namespace App\Traits;

use App\Models\RetiringSoonProduct;

trait ValidationRules
{
    private static function bulkCreateRules()
    {
        return [
            '*' => 'required|array',
            '*.marketplace' => 'required|in:' . join(',', RetiringSoonProduct::MARKETPLACES),
            '*.external_id' => 'required|integer|min:1',
            '*.url' => 'required|url',
            '*.name' => 'required',
            '*.currency' => 'required|string|size:3',
            '*.price' => 'required|numeric|min:0',
            '*.sale_price' => 'nullable|numeric|min:0',
            '*.discount_percentage' => 'nullable|numeric|min:0|max:100',
            '*.discount_amount' => 'nullable|numeric|min:0',
            '*.stock_status' => 'required|in:' . join(',', RetiringSoonProduct::STOCK_STATUSES),
            '*.scraped_at' => 'required|integer',
        ];
    }

    private static function listRules()
    {
        sleep(3);
        return [
            'external_id' => 'nullable|integer|min:1',
            'marketplace' => 'nullable|in:' . join(',', RetiringSoonProduct::MARKETPLACES),
            'name' => 'nullable|string',
        ];
    }
}