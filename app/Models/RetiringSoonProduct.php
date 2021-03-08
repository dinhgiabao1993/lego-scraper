<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RetiringSoonProduct extends Model
{
    const MARKETPLACE_US = 'US';
    const MARKETPLACE_UK = 'UK';
    const MARKETPLACES = [
        self::MARKETPLACE_UK,
        self::MARKETPLACE_US,
    ];

    const STOCK_STATUS_AVAILABLE = 'available';
    const STOCK_STATUS_OUT_OF_STOCK = 'out_of_stock';
    const STOCK_STATUS_CALL_TO_ACTION = 'cta';
    const STOCK_STATUSES = [
        self::STOCK_STATUS_AVAILABLE,
        self::STOCK_STATUS_OUT_OF_STOCK,
        self::STOCK_STATUS_CALL_TO_ACTION,
    ];

    protected $dates = [
        'spotted_at',
        'scraped_at',
    ];

    public function getExternalId()
    {
        return $this->external_id;
    }

    public function setExternalId(int $externalId)
    {
        $this->external_id = $externalId;
        return $this;
    }

    public function getMarketplace()
    {
        return $this->marketplace;
    }

    public function setMarketplace(string $marketplace)
    {
        $this->marketplace = $marketplace;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
        return $this;
    }

    public function getSalePrice()
    {
        return $this->sale_price;
    }

    public function setSalePrice(?float $salePrice)
    {
        $this->sale_price = $salePrice;
        return $this;
    }

    public function getDiscountPercentage()
    {
        return $this->discount_percentage;
    }

    public function setDiscountPercentage(?float $discountPercentage)
    {
        $this->discount_percentage = $discountPercentage;
        return $this;
    }

    public function getDiscountAmount()
    {
        return $this->discount_amount;
    }

    public function setDiscountAmount(?float $discountAmount)
    {
        $this->discount_amount = $discountAmount;
        return $this;
    }

    public function getStockStatus()
    {
        return $this->stock_status;
    }

    public function setStockStatus(string $stockStatus)
    {
        $this->stock_status = $stockStatus;
        return $this;
    }

    public function getScrapedAt()
    {
        return $this->scraped_at;
    }

    public function setScrapedAt(Carbon $scrapedAt)
    {
        $this->scraped_at = $scrapedAt;
        return $this;
    }

    public function getSpottedAt()
    {
        return $this->spotted_at;
    }

    public function setSpottedAt(Carbon $spottedAt)
    {
        $this->spotted_at = $spottedAt;
        return $this;
    }
}