<?php

namespace App\Services;

use App\Base\ServiceWrapper;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderService
{
    public function AddOrder(Request $request)
    {
        return app(ServiceWrapper::class)(
            function() use($request)
            {
                $order = Order::create();
                $order->user_id = auth()->id();
                $order->product_id = $request->product;
                $order->save();

                return $order;
            },
            'Your order added'
        );
    }

    public function DeleteOrder(Request $request)
    {
        return app(ServiceWrapper::class)(
            function() use($request)
            {
                $order = Order::where('product_id', $request->product)->where('user_id', auth()->id())->first();
                if(!isset($order))
                    return 'No order to delete';

                return $order->delete();
            },
            'Order Deleted'
        );
    }

}
