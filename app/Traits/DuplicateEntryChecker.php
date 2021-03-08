<?php

namespace App\Traits;

use Illuminate\Database\QueryException;

trait DuplicateEntryChecker
{
    private static function isDuplicateEntry(\Exception $e)
    {
        return $e instanceof QueryException && $e->errorInfo[1] == 1062;
    }
}