<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
    }


    public function store(Request $request)
    {
        $result = $this->orderService->AddOrder($request);
        return $result;
    }


    public function destroy(Request $request)
    {
        $result = $this->orderService->DeleteOrder($request);
        return $result;
    }
}
