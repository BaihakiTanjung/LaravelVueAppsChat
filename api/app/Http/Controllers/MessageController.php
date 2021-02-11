<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function fetchMessages()
    {
        // fetch message
        $message = Message::all();
        // return
        return response()->json($message);
    }

    public function sendMessage()
    {
        // fake auth login id
        $user = Auth::loginUsingId(request('user_id'));;

        // save data message
        $message = new Message;
        $message->user_id = request('user_id');
        $message->message = request('message');
        $message->save();

        // broardcast event
        broadcast(new MessageEvent($message, $user))->toOthers();

        // return
        return ['status' => 'Message Sent!'];
    }
}
