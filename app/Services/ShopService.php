<?php

namespace App\Services;

use App\Base\ServiceWrapper;
use App\Models\Shop;
use Illuminate\Support\Facades\Storage;

class ShopService
{
    public function AllShops()
    {
        return app(ServiceWrapper::class)(fn() => Shop::latest()->get());
    }

    public function CreateShop(array $inputs)
    {
        return app(ServiceWrapper::class)(
            function() use($inputs)
            {
                $shop = Shop::create($inputs);
                $shop->user_id = auth()->id();
                $shop->save();
                return $shop;
            }
        );
    }

    public function ShopDetails(object $shop)
    {
        return app(ServiceWrapper::class)(fn() => $shop);
    }

    public function UpdateShop(array $inputs, object $shop)
    {
        return app(ServiceWrapper::class)(fn() => $shop->update($inputs));
    }

    public function DeleteShop(object $shop)
    {
        return app(ServiceWrapper::class)(
            function() use($shop)
            {
                if ($shop->image)
                    Storage::disk('liara')->delete($shop->image);
                return $shop->delete();
            }
        );
    }
}
