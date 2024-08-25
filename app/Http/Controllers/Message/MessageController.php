<?php

namespace App\Http\Controllers\Message;


use App\Base\Traits\FinalValidation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\MessageStoreRequest;
use App\Http\Requests\Message\MessageDeleteRequest;
use App\Http\Requests\Message\MessageUpdateRequest;
use App\Models\Message;
use App\Services\MessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(private MessageService $messageService)
    {
    }

    public function index()  // current user sent and received messages
    {
        $result = $this->messageService->AllUserMessages();
        return $result;
    }

    public function store(MessageStoreRequest $request, $receiver_id)
    {
        $result = $this->messageService->SendMessage(FinalValidation::isImageInRequest($request, 'Message'), $receiver_id);
        return $result;
    }


    public function update(MessageUpdateRequest $request, Message $message)
    {
        $result = $this->messageService->UpdateMessage(FinalValidation::isImageInRequest($request, 'Message', $message), $message);
        return $result;
    }

    public function destroy(MessageDeleteRequest $request, Message $message)
    {
        $result = $this->messageService->DeleteMessage($message);
        return $result;
    }
}
