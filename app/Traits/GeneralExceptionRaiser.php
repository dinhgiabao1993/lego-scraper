<?php

namespace App\Traits;

use App\Exceptions\GeneralException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

trait GeneralExceptionRaiser
{
    private static function raiseGeneralException(string $message, array $errorData = [], int $httpCode = Response::HTTP_OK)
    {
        $exception = new GeneralException($message);
        $exception->setErrorData($errorData);
        $exception->setHttpCode($httpCode);
        throw $exception;
    }

    private static function handleUnexpectedException(\Exception $exception, string $message = null, int $httpCode = Response::HTTP_OK)
    {
        $generalException = new GeneralException($message ?? $exception->getMessage());
        $generalException->setHttpCode($httpCode);
        $logMessage = ($message ?? 'Unexecpted error') . ': ' . $exception->getMessage();
        Log::error($logMessage, $exception->getTrace());
        throw $generalException;
    }
}