<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rate\RateIndexRequest;
use App\Http\Requests\Rate\RateStoreRequest;
use App\Models\Product;
use App\Models\Rate;
use App\Models\User;
use App\Services\RateService;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function __construct(private RateService $rateService)
    {
    }

    public function store($product_id)
    {
        if($this->HasRated($product_id))
            return response()->json(['error' => 'you have already sumbited rating on this product!'], status: 400);

        $created_rate = $this->rateService->AddRateProduct($product_id);
        $rate_avg = $this->rateService->GetRateAverage($product_id);

        return [$created_rate, $rate_avg];
    }


    public function HasRated($product_id)
    {
        $rate = Rate::where('product_id', $product_id)->where('user_id', auth()->id())->first();
        if($rate)
            return true;
        return false;
    }

}
