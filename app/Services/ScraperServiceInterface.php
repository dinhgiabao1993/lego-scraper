<?php

namespace App\Services;

interface ScraperServiceInterface
{
    /**
     * @param string $marketplace
     * @return array
     */
    public function getAllRetiringSoon(string $marketplace);

    /**
     * @param string $marketplace
     * @param int $page
     * @return array
     */
    public function getRetiringSoon(string $marketplace, int $page = 1);
}