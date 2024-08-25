<?php

namespace App\Services;

use App\Base\ServiceWrapper;
use App\Base\Traits\UuidGenerator;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentService
{
    use UuidGenerator;
    public function CreatePayment(Request $request)
    {
        return app(ServiceWrapper::class)(
            function() use($request)
            {
                $payment = Payment::create();
                $payment->payment_id = UuidGenerator::Uuid(Payment::all());
                $payment->user_id = auth()->id();
                $payment->product_id = $request->product;
                $payment->is_paid = true;
                $payment->save();

                return $payment;
            },
            'Transaction successfull'
        );
    }

}
