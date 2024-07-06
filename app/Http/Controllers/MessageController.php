<?php

namespace App\Http\Controllers;

use App\Events\MessageSentEvents;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request, Message $message)
    {
        $reqDatas = $request->safe();

        try {
            $message->msg_body = $reqDatas->body;
            $message->msg_attachment = $reqDatas->attachment == null ? null :
                Storage::disk('public')->put('message_attachment', $reqDatas->attachment);
            $message->user_id = $request->user()->id;
            $message->room_id = $reqDatas->room_id;
            $message->save();

            MessageSentEvents::dispatch($message->makeHidden(['id'])->toArray(), $reqDatas->room_id);

            return response()->json([
                'status' => "200",
                'message' => "Message Successfully Send",
                'data' => [
                    $message
                ], 200
            ]);
        } catch (Exception $th) {
            return response(
                [
                    'status' => "500",
                    'message' => $th,
                ],
                500
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
