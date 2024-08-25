<?php

namespace App\Services;

use App\Base\ServiceWrapper;
use App\Base\Traits\MsgValidation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class MessageService
{
    public function AllUserMessages()
    {
        return app(ServiceWrapper::class)(fn() => Message::where('sender_id', auth()->id())->orWhere('receiver_id', auth()->id()))->get();
    }

    public function SendMessage(array $inputs, $receiver_id)
    {
        return app(ServiceWrapper::class)(
            function() use($inputs, $receiver_id)
            {
                User::where('id', $receiver_id)->firstOrFail();
                if(!MsgValidation::HasTxtOrImg())
                    return ["fill at least on field", 422];

                $message = Message::create($inputs);
                $message->sender_id = auth()->id();
                $message->receiver_id = $receiver_id;
                $message->save();
                return $message;
            }
        );
    }

    public function UpdateMessage(array $inputs, object $message)
    {
        return app(ServiceWrapper::class)(
            function() use($inputs, $message)
            {
                if(!MsgValidation::HasTxtOrImg())
                    return ["fill at least on field", 422];
                return $message->update($inputs);
            }
        );
    }

    public function DeleteMessage(object $message)
    {
        return app(ServiceWrapper::class)(
            function() use($message)
            {
                if($message->image)
                    Storage::disk('liara')->delete($message->image);
                return $message->delete();
            }
        );
    }
}
