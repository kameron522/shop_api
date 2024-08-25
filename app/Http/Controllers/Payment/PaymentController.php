<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PaymentStoreRequest;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(private PaymentService $paymentService)
    {
    }


    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        $result = $this->paymentService->CreatePayment($request);
        return $result;
    }


    public function show(string $id)
    {
        //
    }

}
