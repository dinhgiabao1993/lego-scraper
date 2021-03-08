<?php

namespace App\Traits;

trait CurrencyMapper {
    private static function getCurrenciesMap() {
        return [
            'USD' => '$',
            'GBP' => '£',
        ];
    }

    private static function codeToSign(string $code)
    {
        return self::getCurrenciesMap()[$code] ?? false;
    }

    private static function signToCode(string $sign)
    {
        return array_search($sign, self::getCurrenciesMap());
    }
}