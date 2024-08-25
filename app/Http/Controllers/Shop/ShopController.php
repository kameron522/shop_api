<?php

namespace App\Http\Controllers\Shop;

use App\Base\Traits\DeleteImage;
use App\Base\Traits\FinalValidation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\ShopCreateRequest;
use App\Http\Requests\Shop\ShopDeleteRequest;
use App\Http\Requests\Shop\ShopUpdateRequest;
use App\Models\Shop;
use App\Services\ShopService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct(private ShopService $shopService)
    {
    }

    public function index()
    {
        $result = $this->shopService->AllShops();
        return $result;
    }


    public function store(ShopCreateRequest $request)
    {
        $result = $this->shopService->CreateShop(FinalValidation::isImageInRequest($request, 'Shop'));
        return $result;
    }


    public function show(object $shop)
    {
        $result = $this->shopService->ShopDetails($shop);
        return $result;
    }


    public function update(ShopUpdateRequest $request, Shop $shop)
    {
        $result = $this->shopService->UpdateShop(FinalValidation::isImageInRequest($request, 'Shop', $shop), $shop);
        return $result;
    }


    public function destroy(ShopDeleteRequest $request , Shop $shop)
    {
        $result = $this->shopService->DeleteShop($shop);
        return $result;
    }

    public function delImg($shop_id)
    {
        $shop = Shop::where('id', $shop_id)->firstOrFail();
        return DeleteImage::PerformDelete($shop);
    }
}
