<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class GeneralException extends \Exception
{
    protected $httpCode = Response::HTTP_OK;
    protected $errorData = [];

    public function getHttpCode()
    {
        return $this->httpCode;
    }

    public function setHttpCode(int $httpCode)
    {
        $this->httpCode = $httpCode;
        return $this;
    }

    public function getErrorData()
    {
        return $this->errorData;
    }

    public function setErrorData(array $errorData)
    {
        $this->errorData = $errorData;
        return $this;
    }

    public function render()
    {
        return response(json_encode([
            'success' => false,
            'message' => $this->getMessage(),
            'errors' => $this->getErrorData(),
        ]), $this->getHttpCode());
    }
}