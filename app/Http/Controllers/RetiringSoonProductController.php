<?php

namespace App\Http\Controllers;

use App\Services\RetiringSoonProductServiceInterface;
use Illuminate\Http\Request;

class RetiringSoonProductController extends Controller
{
    private $service;

    public function __construct(RetiringSoonProductServiceInterface $service)
    {
        $this->service = $service;
    }

    public function paginate(Request $request)
    {
        return [
            'success' => true,
            'data' => $this->service->paginate($request->all()),
        ];
    }
}