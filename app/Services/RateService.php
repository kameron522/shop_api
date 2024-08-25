<?php

namespace App\Services;

use App\Base\ServiceWrapper;
use App\Base\Traits\UuidGenerator;
use App\Models\Product;
use App\Models\Rate;
use Illuminate\Http\Request;

class RateService
{
    use UuidGenerator;

    public function AllRates()
    {
        return app(ServiceWrapper::class)(
            function ()
            {
                return response()->json(['rates' => Rate::latest()->get()]);
            }
        );
    }

    public function AddRateProduct($product_id)
    {
        return app(ServiceWrapper::class)(
            function() use($product_id)
            {
                $rate = Rate::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product_id,
                ]);
                return $rate;
            },
            'Rate Added'
        );
    }

    public function GetRateAverage($product_id)
    {
        return app(ServiceWrapper::class)(
            function() use($product_id)
            {
                $product = Product::where('id', $product_id)->first();
                $product->rate_sum += request()->rate_value;
                $product->rate_counts += 1;
                $product->rate_avg = $product->rate_sum / $product->rate_counts;
                $product->save();

                return $product;
            }
        );
    }

}
